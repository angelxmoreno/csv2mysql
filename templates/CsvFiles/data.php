<?php
/**
 * @var AppView $this
 * @var CsvFile $csvFile
 * @var EntityInterface[]|CollectionInterface $rows
 */

use App\Model\Entity\CsvFile;
use App\View\AppView;
use Cake\Collection\CollectionInterface;
use Cake\Datasource\EntityInterface;

$this->extend('/Common/index');
$this->assign('title', 'Csv File: ' . $csvFile->name);
$this->assign('subTitle', 'data');


$this->Breadcrumbs->add('Home', '/');
$this->Breadcrumbs->add($this->getRequest()->getParam('controller'), ['action' => 'index']);
$this->Breadcrumbs->add($csvFile->name);
$this->Breadcrumbs->add('Data');
$this->assign('breadCrumbs', $this->Breadcrumbs->render());
$this->assign('contentClass', 'container-fluid');
$this->assign('pageControls', $this->element('/page_controls', [
    'mode' => 'view',
    'entity' => $csvFile,
]));
$fields = array_keys($rows->first()->toArray());
?>
<?php if (count($rows) === 0) : ?>
    <p class="lead">Rows found.</p>
<?php else : ?>
    <style>
        th {
            white-space: nowrap;
        }
    </style>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <?php foreach ($fields as $field): ?>
                    <?php if ($field !== 'created'): ?>
                        <th scope="col" class="no-wrap"><?= $this->Paginator->sort($field) ?></th>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($rows as $row) : ?>
                <tr>
                    <?php foreach ($fields as $field): ?>
                        <?php if ($field !== 'created'): ?>
                            <td><?= h($row->get($field)) ?></td>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
