<?php
/**
 * @var App\View\AppView $this
 */
$this->extend('/Common/base');
$this->assign('viewMode', 'create');
echo $this->fetch('content');
