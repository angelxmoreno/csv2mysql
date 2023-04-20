<?php
/**
 * @var App\View\AppView $this
 */
$this->extend('/Common/base');
$this->assign('viewMode', 'edit');
echo $this->fetch('content');
