<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CsvFile $csvFile
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Csv Files'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="csvFiles form content">
            <?= $this->Form->create($csvFile) ?>
            <fieldset>
                <legend><?= __('Add Csv File') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('table_name');
                    echo $this->Form->control('num_rows');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
