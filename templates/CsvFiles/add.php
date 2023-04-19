<?php
/**
* @var AppView $this
 * @var CsvFile $csvFile
 */

use App\Model\Entity\CsvFile;
use App\View\AppView;
use Cake\Collection\CollectionInterface;


$this->extend('/Common/add');
$this->assign('title', 'Csv File');
$this->assign('subTitle', 'create');
?>

<div class="csvFiles form content">
    <?= $this->Form->create($csvFile) ?>
    <fieldset>
        <?php
                echo $this->Form->control('name');
                echo $this->Form->control('table_name');
                echo $this->Form->control('num_rows');
                echo $this->Form->control('status');
                echo $this->Form->control('error_message');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Add'), [
    'class' => 'btn btn-outline-success btn-lg'
    ]) ?>
    <?= $this->Form->end() ?>
</div>
