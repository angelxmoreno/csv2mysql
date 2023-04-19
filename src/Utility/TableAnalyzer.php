<?php
declare(strict_types=1);

namespace App\Utility;

use Cake\ORM\Table;

class TableAnalyzer
{
    protected Table $table;
    protected ?int $numRows = null;
    protected ?int $numFields = null;
    /** @var ColumnAnalyzer[] */
    protected array $columns = [];

    /**
     * @param Table $table
     */
    public function __construct(Table $table)
    {
        $this->table = $table;
    }

    /**
     * @return int|null
     */
    public function getNumRows(): ?int
    {
        if (is_null($this->numRows)) {
            $this->numRows = $this->table->find()->count();
        }
        return $this->numRows;
    }

    /**
     * @return int|null
     */
    public function getNumFields(): ?int
    {
        if(is_null($this->numFields)) {
            $row = $this->table->find()->first();
            $this->numFields = count($row->toArray());
        }
        return $this->numFields;
    }

    /**
     * @return array
     */
    public function getColumns(): array
    {
        if(empty($this->columns)) {
            $row = $this->table->find()->first();
            $fields = array_keys($row->toArray());
            foreach ($fields as $field) {
                $this->columns[$field] = new ColumnAnalyzer($this->table, $field);
            }
        }
        return $this->columns;
    }
}
