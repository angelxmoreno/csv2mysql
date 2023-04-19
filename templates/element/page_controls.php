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

$deleteBtn = $this->Form->postLink(__('Delete'), ['action' => 'delete', $identifier], ['confirm' => __('Are you sure you want to delete # {0}?', $identifier), 'title' => __('Delete'), 'class' => 'btn btn-outline-danger']);
$viewBtn = $this->Html->link('View', ['action' => 'view', $identifier], ['title' => __('View'), 'class' => 'btn btn-outline-success']);
$addBtn = '';//$this->Html->link(__('Add'), ['action' => 'add'], ['title' => __('Add'), 'class' => 'btn btn-outline-info']);
$listBtn = $this->Html->link(__('List'), ['action' => 'index'], ['title' => __('List'), 'class' => 'btn btn-outline-info']);
$editBtn = '';//$this->Html->link('Edit', ['action' => 'edit', $identifier], ['title' => __('Edit'), 'class' => 'btn btn-outline-warning']);
?>
<div class="btn-group btn-group-sm mb-2" role="group">
    <?= $mode === 'list' ? $addBtn : '' ?>
    <?= $mode === 'create' ? $listBtn : '' ?>
    <?= $mode === 'edit' ? $listBtn . $viewBtn . $deleteBtn . $addBtn : '' ?>
    <?= $mode === 'view' ? $listBtn . $editBtn . $deleteBtn . $addBtn : '' ?>
</div>

