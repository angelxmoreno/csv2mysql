<?php
/**
 * @var AppView $this
 * @var CsvFile[]|CollectionInterface $csvFiles
 */

use App\Model\Entity\CsvFile;
use App\View\AppView;
use Cake\Collection\CollectionInterface;

$this->extend('/Common/index');
$this->assign('title', 'Csv Files');
$this->assign('pageControls', '');
?>
<?php if (count($csvFiles) === 0) : ?>
    <p class="lead">No Csv Files found.</p>
<?php else : ?>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('name') ?></th>
            <th scope="col"><?= $this->Paginator->sort('table_name') ?></th>
            <th scope="col"><?= $this->Paginator->sort('num_rows') ?></th>
            <th scope="col"><?= $this->Paginator->sort('status') ?></th>
            <th scope="col"><?= $this->Paginator->sort('error_message') ?></th>
            <th scope="col"><?= $this->Paginator->sort('created') ?></th>
            <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($csvFiles as $csvFile) : ?>
            <tr>
                <td><?= $this->Number->format($csvFile->id) ?></td>
                <td><?= h($csvFile->name) ?></td>
                <td><?= h($csvFile->table_name) ?></td>
                <td><?= $this->Number->format($csvFile->num_rows) ?></td>
                <td><?= h($csvFile->status) ?></td>
                <td><?= h($csvFile->error_message) ?></td>
                <td><?= h($csvFile->created) ?></td>
                <td><?= h($csvFile->modified) ?></td>
                <td class="actions">
                    <?= $this->element('/table_row_actions', ['entity' => $csvFile]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
