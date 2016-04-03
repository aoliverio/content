<?php $this->layout = null ?>
<h4><?= __('Edit Cms Content User'); ?></h4>
<hr/>
<div>
    <?= $this->Form->create($cmsContentUser) ?>
    <?= $this->Form->input('cms_contents_id', ['options' => $cmsContents]); ?>
    <?= $this->Form->input('users_id', ['options' => $users]); ?>
    <?= $this->Form->input('params'); ?>
    <hr/>
    <div class="text-center">
        <?= $this->Form->button(__('Save'), ['class' => 'btn btn-success']) ?>  
    </div>
    <?= $this->Form->end() ?>
</div>