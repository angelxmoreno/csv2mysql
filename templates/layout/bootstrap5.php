<?php

use App\View\AppView;
use Cake\Core\Configure;

/**
 * @var AppView $this
 */

$this->prepend('css', $this->Html->css([
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',
    'https://cdn.jsdelivr.net/npm/bootswatch@5.2.3/dist/simplex/bootstrap.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/5.1.1/bootstrap-social.min.css',
    'main',
]));
$this->prepend('script', $this->Html->script([
    'https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js',
    '/assets/index',
]));
?>
<!doctype html>
<?= sprintf('<html lang="%s">', Configure::read('App.language', 'en')) ?>
<head>
    <?= $this->Html->charset() ?>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?= $this->fetch('meta') ?>

    <?= $this->fetch('css') ?>
</head>
<body>
<?= $this->element('nav') ?>
<div id="main-container">
    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
</div>
<footer class="py-5 bg-primary">
    <div class="container px-4 px-lg-5">
        <p class="m-0 text-center text-white">
            <?= Configure::read('App.siteName', 'A CakePHP Site') ?> <?= date('Y') ?>
        </p>
    </div>
</footer>
<?= $this->fetch('script') ?>
</body>
</html>
