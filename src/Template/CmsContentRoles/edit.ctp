<?php $this->layout = null ?>
<h4><?= __('Edit Cms Content Role'); ?></h4>
<hr/>
<div>
    <?= $this->Form->create($cmsContentRole) ?>
    <?= $this->Form->input('cms_contents_id', ['options' => $cmsContents]); ?>
    <?= $this->Form->input('roles_id', ['options' => $roles]); ?>
    <?= $this->Form->input('params'); ?>
    <hr/>
    <div class="text-center">
        <?= $this->Form->button(__('Save'), ['class' => 'btn btn-success']) ?>  
    </div>
    <?= $this->Form->end() ?>
</div>