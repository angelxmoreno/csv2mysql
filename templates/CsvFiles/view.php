<?php
/**
* @var AppView $this
 * @var CsvFile $csvFile
 */

use App\Model\Entity\CsvFile;
use App\View\AppView;
use Cake\Collection\CollectionInterface;

$this->extend('/Common/view');
$this->assign('entity', $csvFile);
$this->assign('title', 'Csv File');
$this->assign('subTitle', 'view');
?>


<div class="csvFiles view large-9 medium-8 columns content">
    <h4><?= h($csvFile->name) ?></h4>
    <div class="table-responsive">
        <table class="table table-striped">
                                                                        <tr>
                            <th scope="row"><?= __('Name') ?></th>
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
                        <th scope="row"><?= __('Id') ?></th>
                        <td><?= $this->Number->format($csvFile->id) ?></td>
                    </tr>
                                    <tr>
                        <th scope="row"><?= __('Num Rows') ?></th>
                        <td><?= $this->Number->format($csvFile->num_rows) ?></td>
                    </tr>
                                                                            <tr>
                        <th scope="row"><?= __('Created') ?></th>
                        <td><?= h($csvFile->created) ?></td>
                    </tr>
                                    <tr>
                        <th scope="row"><?= __('Modified') ?></th>
                        <td><?= h($csvFile->modified) ?></td>
                    </tr>
                                                </table>
    </div>
                        <div class="text">
                <h4><?= __('Error Message') ?></h4>
                <?= $this->Text->autoParagraph(h($csvFile->error_message)); ?>
            </div>
                    </div>
