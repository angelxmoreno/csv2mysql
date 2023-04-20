<?php
/**
 * @var App\View\AppView $this
 */


if (!$this->exists('breadCrumbs')) {
    $prefix = $this->getRequest()->getParam('prefix');
    $plugin = $this->getRequest()->getParam('plugin');
    $controller = $this->getRequest()->getParam('controller');
    $action = $this->getRequest()->getParam('action');

    $this->Breadcrumbs->add('Home', '/');
    if ($prefix) {
        $this->Breadcrumbs->add($prefix);
    }
    if ($plugin) {
        $this->Breadcrumbs->add($plugin);
    }
    if ($action === 'index') {
        $this->Breadcrumbs->add($controller);
        $this->Breadcrumbs->add('List');
    } else {
        $this->Breadcrumbs->add($controller, ['action' => 'index']);
        $this->Breadcrumbs->add($action);
    }
    $this->assign('breadCrumbs', $this->Breadcrumbs->render());
}

if ($this->exists('viewMode') && !$this->exists('pageControls')) {
    $this->assign('pageControls', $this->element('/page_controls', [
        'mode' => $this->fetch('viewMode'),
        'entity' => $this->fetch('entity'),
    ]));
}

$contentClass = $this->fetch('contentClass', 'container');
?>
<section class="container">
    <?php if ($this->fetch('title')) : ?>
        <h1 class="d-flex d-inline-flex">
            <?= $this->fetch('title') ?>
        </h1>
        <span><?= $this->fetch('subTitle') ?></span>
        <?= $this->fetch('pageControls', '') ?>
        <hr/>
        <?= $this->fetch('breadCrumbs') ?>
        <hr/>
    <?php endif; ?>
</section>
<section class="<?= $contentClass ?>">
    <?= $this->fetch('content') ?>
</section>
