<?php $this->layout = null ?>
<h4><?= __('Edit Cms Term User'); ?></h4>
<hr/>
<div>
    <?= $this->Form->create($cmsTermUser) ?>
    <?= $this->Form->input('cms_term_id', ['options' => $cmsTerms]); ?>
    <?= $this->Form->input('user_id', ['options' => $users]); ?>
    <?= $this->Form->input('params'); ?>
    <hr/>
    <div class="text-center">
        <?= $this->Form->button(__('Save'), ['class' => 'btn btn-success']) ?>  
    </div>
    <?= $this->Form->end() ?>
</div>