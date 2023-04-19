<?php

use App\View\AppView;
use Cake\Core\Configure;

/**
 * @var AppView $this
 */
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="/">
            <?= Configure::read('App.siteName', 'A CakePHP Site') ?>
        </a>
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <?= $this->NavLink->link('Home', '/') ?>
            </ul>
        </div>
    </div>
</nav>
