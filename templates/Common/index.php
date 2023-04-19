<?php
/**
 * @var App\View\AppView $this
 */
$this->extend('/Common/base');
$this->assign('viewMode', 'list');
?>

<div class="row">
    <div class="col-12">
        <?= $this->element('/pagination') ?>
        <?= $this->fetch('content') ?>
        <?= $this->element('/pagination') ?>
    </div>
</div>
