<?php
/**
 * @var AppView $this
 */

use App\View\AppView;

?>
<?php if ($this->Paginator->param('count') > 0): ?>
    <div class="paginator">
        <ul class="pagination justify-content-center">
            <?= $this->Paginator->first('«', ['label' => __('First')]) ?>
            <?= $this->Paginator->prev('‹', ['label' => __('Previous')]) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next('›', ['label' => __('Next')]) ?>
            <?= $this->Paginator->last('»', ['label' => __('Last')]) ?>
        </ul>
        <p class="text-center"><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
<?php endif; ?>
