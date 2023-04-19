<?php
declare(strict_types=1);

namespace App\Command;

use App\Model\Table\CsvFilesTable;
use Cake\Chronos\Chronos;
use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\CommandInterface;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\Core\Exception\CakeException;
use Cake\Datasource\ConnectionManager;
use Cake\Shell\Helper\ProgressHelper;
use Cake\Utility\Inflector;
use Cake\Utility\Text;
use League\Csv\Exception;
use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\UnableToProcessCsv;
use Migrations\CakeAdapter;
use Migrations\Table;
use Phinx\Db\Adapter\MysqlAdapter;
use Throwable;

/**
 * CsvImport command.
 *
 * @property Arguments $args
 * @property ConsoleIo $io
 * @property string $filePath
 * @property string $tableName
 * @property int $offSet
 * @property int $limit
 * @property Reader $reader
 * @property CsvFilesTable $CsvFiles
 */
class CsvImportCommand extends Command
{
    public function initialize(): void
    {
        parent::initialize();
        $this->CsvFiles = $this->fetchTable('CsvFiles');
    }

    /**
     * Hook method for defining this command's option parser.
     *
     * @see https://book.cakephp.org/4/en/console-commands/commands.html#defining-arguments-and-options
     * @param ConsoleOptionParser $parser The parser to be defined
     * @return ConsoleOptionParser The built parser.
     */
    public function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        $parser = parent::buildOptionParser($parser);
        $parser->addArgument('filePath', [
            'help' => 'path to the csv file to import',
            'required' => true,
        ]);
        $parser->addArgument('tableName', [
            'help' => 'name of the table to store the csv',
            'required' => false,
        ]);
        $parser->addOption('offSet', [
            'short' => 'o',
            'help' => 'The row offset to start from. Should be the row with the headers.',
            'default' => 0,
            'boolean' => false,
            'required' => false,
        ]);

        $parser->addOption('limit', [
            'short' => 'l',
            'help' => 'The number of rows to import. Omit for all rows',
            'default' => -1,
            'boolean' => false,
            'required' => false,
        ]);
        /**
         * @TODO add header offset option
         * @TODO which csv colum is an identifier
         */
        return $parser;
    }

    /**
     * Implement this method with your command's logic.
     *
     * @param Arguments $args The command arguments.
     * @param ConsoleIo $io The console io
     * @return int The exit code or null for success
     */
    public function execute(Arguments $args, ConsoleIo $io): int
    {
        try {
            $this->io = $io;
            $this->args = $args;
            $this->filePath = $args->getArgument('filePath');
            $this->tableName = $args->getArgument('tableName') ?? $this->tableNameFromFilePath($this->filePath);
            $this->offSet = (int)$args->getOption('offSet');
            $this->limit = (int)$args->getOption('limit');
            if (!is_file($this->filePath)) {
                throw new CakeException('Unable to locate file path: ' . $this->filePath);
            }
            $this->reader = Reader::createFromPath($this->filePath, 'r');
            $this->main();
            return CommandInterface::CODE_SUCCESS;
        } catch (Throwable $exception) {
            $io->error($exception->getMessage());
            return CommandInterface::CODE_ERROR;
        }
    }

    protected function tableNameFromFilePath(string $filePath): string
    {
        $fileName = pathinfo($filePath, PATHINFO_FILENAME);
        $safeName = preg_replace('/[^a-z0-9]/i', '', $fileName);
        return Inflector::tableize($safeName);
    }

    protected function buildTableColumnsFromHeaders(array $headers): array
    {
        $tableHeaders = [];
        foreach ($headers as $header) {
            $tableHeader = Text::slug($header);
            $tableHeader = Inflector::tableize($tableHeader);
            $tableHeader = Inflector::singularize($tableHeader);
            $tableHeader = str_replace('__', '_', $tableHeader);
            $tableHeaders[] = $tableHeader;
        }

        return $tableHeaders;
    }

    protected function tableExists(): bool
    {
        $allTables = ConnectionManager::get('default')->getSchemaCollection()->listTables();
        return in_array($this->tableName, $allTables);
    }

    protected function createTable(array $columns)
    {
        $connection = ConnectionManager::get('default');
        $dbConfig = $connection->config();
        $dbConfig['adapter'] = 'mysql';
        $dbConfig['pass'] = $dbConfig['password'];
        $dbConfig['user'] = $dbConfig['username'];
        $dbConfig['name'] = $dbConfig['database'];
        $adapter = new CakeAdapter(new MysqlAdapter($dbConfig), $connection);

        $table = new Table($this->tableName, [], $adapter);
        $table->addPrimaryKey(['id'])->addColumn('created', 'datetime', [
            'default' => null,
            'limit' => null,
            'null' => true,
        ]);
        foreach ($columns as $column) {
            $table->addColumn($column, 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ]);
        }
        $table->create();
    }

    /**
     * @throws Exception
     * @throws UnableToProcessCsv|Throwable
     */
    protected function main()
    {
        $this->reader->setHeaderOffset($this->offSet);
        $csvHeaders = $this->reader->getHeader();
        $tableHeaders = $this->buildTableColumnsFromHeaders($csvHeaders);
        if (!$this->tableExists()) {
            $this->createTable($tableHeaders);
        }
        $stmt = (new Statement())->offset($this->offSet)->limit($this->limit);

        $table = $this->fetchTable($this->tableName);
        $table->deleteAll([]);
        $records = $stmt->process($this->reader, $tableHeaders);
        $csvFile = $this->CsvFiles->findOrCreate([
            'name' => pathinfo($this->filePath, PATHINFO_FILENAME),
            'table_name' => $this->tableName,
        ]);
        $recordCount = $records->count();
        $csvFile->num_rows = $recordCount;

        $csvFile->status = 'pending';
        $csvFile->error_message = null;
        $this->CsvFiles->saveOrFail($csvFile);
        /** @var ProgressHelper $progress */
        $progress = $this->io->helper('Progress');
        $progress->init([
            'total' => $recordCount,
        ]);


        try {
            $this->io->out(sprintf('Saving %s records', $recordCount));
            foreach ($records as $index => $record) {
                $entity = $table->newEntity($record);
                $entity->set('created', Chronos::now());
                $table->saveOrFail($entity);
                $progress->increment(1);
                $progress->draw();
            }
            $csvFile->status = 'complete';
            $this->CsvFiles->saveOrFail($csvFile);
        } catch (Throwable $exception) {
            $csvFile->status = 'failed';
            $csvFile->error_message = $exception->getMessage();
            $this->CsvFiles->saveOrFail($csvFile);
            throw $exception;
        }
    }
}
