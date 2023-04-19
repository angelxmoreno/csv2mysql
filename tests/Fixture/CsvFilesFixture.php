<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CsvFilesFixture
 */
class CsvFilesFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'table_name' => 'Lorem ipsum dolor sit amet',
                'num_rows' => 1,
                'created' => '2023-04-19 14:51:00',
                'modified' => '2023-04-19 14:51:00',
            ],
        ];
        parent::init();
    }
}
