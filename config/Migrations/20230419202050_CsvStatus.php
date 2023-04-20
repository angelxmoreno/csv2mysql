<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CsvStatus extends AbstractMigration
{
    public $autoId = false;

    /**
     * Up Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-up-method
     * @return void
     */
    public function up(): void
    {

        $this->table('csv_files')
            ->changeColumn('num_rows', 'integer', [
                'default' => '0',
                'limit' => null,
                'null' => true,
                'signed' => false,
            ])
            ->update();
        $this->table('brands_sheet1s')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('name', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('description', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('image_url', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('fragrances')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('item_number', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('name_description', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('gender', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('retail_price', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('cost', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('csv_files')
            ->addColumn('status', 'string', [
                'after' => 'num_rows',
                'default' => 'new',
                'length' => 100,
                'null' => true,
            ])
            ->addColumn('error_message', 'text', [
                'after' => 'status',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'name',
                    'table_name',
                ],
                [
                    'name' => 'name',
                    'unique' => true,
                ]
            )
            ->addIndex(
                [
                    'status',
                ],
                [
                    'name' => 'status',
                ]
            )
            ->update();
    }

    /**
     * Down Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-down-method
     * @return void
     */
    public function down(): void
    {

        $this->table('csv_files')
            ->removeIndexByName('name')
            ->removeIndexByName('status')
            ->update();

        $this->table('csv_files')
            ->changeColumn('num_rows', 'integer', [
                'default' => null,
                'length' => null,
                'null' => false,
            ])
            ->removeColumn('status')
            ->removeColumn('error_message')
            ->update();

        $this->table('brands_sheet1s')->drop()->save();
        $this->table('fragrances')->drop()->save();
    }
}
