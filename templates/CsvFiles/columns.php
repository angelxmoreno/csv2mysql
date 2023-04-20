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
$this->assign('title', 'Csv File: ' . $csvFile->name);
$this->assign('subTitle', 'columns');
$this->assign('contentClass', 'container-fluid');

$this->Breadcrumbs->add('Home', '/');
$this->Breadcrumbs->add($this->getRequest()->getParam('controller'), ['action' => 'index']);
$this->Breadcrumbs->add($csvFile->name);
$this->Breadcrumbs->add('Columns');
$this->assign('breadCrumbs', $this->Breadcrumbs->render());
?>


<div class="csvFiles">
    <h4>Columns</h4>
    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <th scope="row">Name</th>
                <th scope="row">Total Empty Rows</th>
                <th scope="row">Total Unique Values</th>
                <th scope="row">Unique Values ( limit 30 )</th>
            </tr>

            <?php foreach ($analysis->getColumns() as $column): ?>
                <tr>
                    <td><?= Inflector::humanize($column->getName()) ?></td>
                    <td><?= $this->Number->format($column->getNumNulls()) ?></td>
                    <td><?= $this->Number->format($column->getNumValues()) ?></td>
                    <td>
                        <?php
                        if ($column->getNumValues() === $csvFile->num_rows || in_array($column->getName(), ['id', 'created'])) {
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
