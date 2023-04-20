<?php
/**
 * @var App\View\AppView $this
 */
$this->extend('/Common/base');
$this->assign('viewMode', 'view');
echo $this->fetch('content');
