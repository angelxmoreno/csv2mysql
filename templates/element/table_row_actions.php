<?php
/**
 * @var AppView $this
 * @var EntityInterface $entity
 * @var ?string $controller
 */

use App\View\AppView;
use Cake\Datasource\EntityInterface;

$controller = $controller ?? $this->getRequest()->getParam('controller');

?>
<div class="btn-group btn-group-sm" role="group">
    <?= $this->Html->link(__('View'), ['controller' => $controller, 'action' => 'view', $entity->id], ['title' => __('View'), 'class' => 'btn btn-outline-success']) ?>
    <?= $this->Form->postLink(__('Delete'), ['controller' => $controller, 'action' => 'delete', $entity->id], ['confirm' => __('Are you sure you want to delete # {0}?', $entity->id), 'title' => __('Delete'), 'class' => 'btn btn-outline-danger']) ?>
</div>

