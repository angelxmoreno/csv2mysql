<?php
/**
 * @var AppView $this
 * @var string $identifier
 * @var EntityInterface $entity
 * @var string $mode
 */

use App\View\AppView;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Entity;

$entity = $entity ?? null;
$identifier = $identifier ?? null;

if ($entity) {
    if (is_string($entity)) {
        $props = json_decode($entity, true);
        $entity = new Entity($props);
    }
    $identifier = $identifier ?? $entity->id;
}
$options = [
    'class' => 'btn btn-outline-info',
];
$deleteBtn = $this->Form->postLink(__('Delete'), ['action' => 'delete', $identifier], ['confirm' => __('Are you sure you want to delete # {0}?', $identifier), 'title' => __('Delete'), 'class' => 'btn btn-outline-danger']);
$viewBtn = $this->Html->link('Info', ['action' => 'view', $identifier], $options);
$colBtn = $this->Html->link('Columns', ['action' => 'columns', $identifier], $options);
$dataBtn = $this->Html->link('Data', ['action' => 'data', $identifier], $options);
$listBtn = $this->Html->link(__('List'), ['action' => 'index'], $options);
?>
<div class="btn-group btn-group-sm mb-2" role="group">
    <?= $mode === 'view' ? $listBtn . $viewBtn . $colBtn . $dataBtn . $deleteBtn : '' ?>
</div>

