<?php
/**
 * @var AppView $this
 * @var CsvFile $csvFile
 * @var TableAnalyzer $analysis
 */

use App\Model\Entity\CsvFile;
use App\Utility\TableAnalyzer;
use App\View\AppView;
use Cake\Utility\Inflector;

$this->extend('/Common/view');
$this->assign('entity', $csvFile);
$this->assign('title', 'Csv File');
$this->assign('subTitle', 'view');
?>


<div class="csvFiles">
    <h4><?= h($csvFile->name) ?></h4>
    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <th scope="row"><?= __('Table Name') ?></th>
                <td><?= h($csvFile->table_name) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Status') ?></th>
                <td><?= h($csvFile->status) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Error Message') ?></th>
                <td><?= h($csvFile->error_message) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Num Rows') ?></th>
                <td><?= $this->Number->format($csvFile->num_rows) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Created') ?></th>
                <td><?= h($csvFile->created) ?></td>
            </tr>
        </table>
    </div>

    <h4>Columns</h4>
    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <th scope="row">Name</th>
                <th scope="row">Total Unique Values</th>
                <th scope="row">Unique Values ( limit 30 )</th>
            </tr>

            <?php foreach ($analysis->getColumns() as $column): ?>
                <tr>
                    <td><?= Inflector::humanize($column->getName()) ?></td>
                    <td><?= $column->getNumValues() ?></td>
                    <td>
                        <?php
                        if($column->getNumValues() === $csvFile->num_rows || in_array($column->getName(), ['id','created'])){
                            echo "MANY";
                        } else {
                            echo implode(', ', $column->getValues(30));
                        }
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
