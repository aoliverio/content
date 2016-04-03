<?php $this->layout = null ?>
<h4><?= __('Add Cms Term Role'); ?></h4>
<hr/>
<div>
    <?= $this->Form->create($cmsTermRole) ?>
    <?= $this->Form->input('cms_terms_id', ['options' => $cmsTerms]); ?>
    <?= $this->Form->input('roles_id', ['options' => $roles]); ?>
    <?= $this->Form->input('params'); ?>
    <hr/>
    <div class="text-center">
        <?= $this->Form->button(__('Save'), ['class' => 'btn btn-success']) ?>  
    </div>
    <?= $this->Form->end() ?>
</div>