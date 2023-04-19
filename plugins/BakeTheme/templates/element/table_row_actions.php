<?php
/**
 * @var AppView $this
 * @var EntityInterface $entity
 * @var ?string $controller
 */

use App\View\AppView;
use Cake\Datasource\EntityInterface;

$controller = $controller ?? $this->getRequest()->getParam('controller');
$canBeApproved = $entity->has('is_approved') && $entity->has('is_active');
$isApproved = $canBeApproved && $entity->get('is_approved') && $entity->get('is_active');
$approvalClass = $isApproved ? 'btn btn-info active disabled' : 'btn btn-outline-info';
$approvalLabel = $isApproved ? 'Approved' : 'Approve';

?>
<div class="btn-group btn-group-sm" role="group">
    <?= $this->Html->link(__('View'), ['controller' => $controller, 'action' => 'view', $entity->id], ['title' => __('View'), 'class' => 'btn btn-outline-success']) ?>
    <?= $this->Html->link(__('Edit'), ['controller' => $controller, 'action' => 'edit', $entity->id], ['title' => __('Edit'), 'class' => 'btn btn-outline-warning']) ?>
    <?= $canBeApproved ? $this->Html->link(__($approvalLabel), ['controller' => $controller, 'action' => 'pending', $entity->id], ['title' => __($approvalLabel), 'class' => $approvalClass]) : '' ?>
    <?= $this->Form->postLink(__('Delete'), ['controller' => $controller, 'action' => 'delete', $entity->id], ['confirm' => __('Are you sure you want to delete # {0}?', $entity->id), 'title' => __('Delete'), 'class' => 'btn btn-outline-danger']) ?>
</div>

