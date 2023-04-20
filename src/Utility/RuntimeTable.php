<?php
declare(strict_types=1);

namespace App\Utility;

use App\Model\Table\TableBase;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\Table as TableOrm;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;
use Migrations\CakeAdapter;
use Migrations\Table as MigrationsTable;
use Phinx\Db\Adapter\MysqlAdapter;

class RuntimeTable
{
    public const TABLE_PREFIX = 'runtime_table';

    public static function tableName(string $tableName): string
    {
        return sprintf('%s_%s', self::TABLE_PREFIX, $tableName);
    }

    protected static function getMigrationsTable(string $tableName): MigrationsTable
    {
        $tableName = self::tableName($tableName);
        $connection = ConnectionManager::get('default');
        $dbConfig = $connection->config();
        $dbConfig['adapter'] = 'mysql';
        $dbConfig['pass'] = $dbConfig['password'];
        $dbConfig['user'] = $dbConfig['username'];
        $dbConfig['name'] = $dbConfig['database'];
        $adapter = new CakeAdapter(new MysqlAdapter($dbConfig), $connection);

        return new MigrationsTable($tableName, [], $adapter);
    }

    public static function createTable(string $tableName, array $columns): void
    {
        $table = self::getMigrationsTable($tableName);

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

    public static function removeTable(string $tableName): void
    {
        $table = self::getMigrationsTable($tableName);
        $table->drop()->save();
    }

    public static function tableExists(string $tableName): bool
    {
        $allTables = ConnectionManager::get('default')->getSchemaCollection()->listTables();
        return in_array(self::tableName($tableName), $allTables);
    }

    public static function loadTable(string $tableName): TableOrm
    {
        $tablePrefixed = self::tableName($tableName);
        $alias = Inflector::camelize($tableName);
        return TableRegistry::getTableLocator()->get($alias, [
            'className' => TableBase::class,
            'table' => $tablePrefixed,
        ]);
    }
}
