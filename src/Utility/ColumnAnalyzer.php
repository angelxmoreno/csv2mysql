<?php
declare(strict_types=1);

namespace App\Utility;

use Cake\ORM\Table;

class ColumnAnalyzer
{
    protected Table $table;

    protected string $name;
    protected ?int $numValues = null;
    protected array $values = [];

    /**
     * @param Table $table
     * @param string $name
     */
    public function __construct(Table $table, string $name)
    {
        $this->table = $table;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getNumValues(): int
    {
        if (is_null($this->numValues)) {
            $field = $this->name;
            $this->numValues = $this->table->find()
                ->distinct($field)
                ->select([$field])
                ->count();
        }
        return $this->numValues;
    }

    public function getValues(?int $limit = 20): array
    {
        if (empty($this->values)) {
            $field = $this->name;
            $query = $this->table->find()
                ->distinct($field)
                ->select([$field]);

            if (!!$limit) {
                $query->limit($limit);
            }
            $this->values = $query->disableHydration()
                ->all()
                ->extract($field)
                ->toList();
        }
        return $this->values;
    }


}
