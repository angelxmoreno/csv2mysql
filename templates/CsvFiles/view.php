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
$this->assign('subTitle', 'info');


$this->Breadcrumbs->add('Home', '/');
$this->Breadcrumbs->add($this->getRequest()->getParam('controller'), ['action' => 'index']);
$this->Breadcrumbs->add($csvFile->name);
$this->Breadcrumbs->add('Info');
$this->assign('breadCrumbs', $this->Breadcrumbs->render());
?>


<div class="csvFiles">
    <h4>File Information</h4>
    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <th scope="row"><?= __('File Name') ?></th>
                <td><?= h($csvFile->name) ?></td>
            </tr>
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
</div>
