<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CsvFile $csvFile
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Csv File'), ['action' => 'edit', $csvFile->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Csv File'), ['action' => 'delete', $csvFile->id], ['confirm' => __('Are you sure you want to delete # {0}?', $csvFile->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Csv Files'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Csv File'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="csvFiles view content">
            <h3><?= h($csvFile->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($csvFile->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Table Name') ?></th>
                    <td><?= h($csvFile->table_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($csvFile->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Num Rows') ?></th>
                    <td><?= $this->Number->format($csvFile->num_rows) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($csvFile->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($csvFile->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
