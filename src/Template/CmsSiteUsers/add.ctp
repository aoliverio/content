<?php $this->layout = null ?>
<h4><?= __('Add Cms Site User'); ?></h4>
<hr/>
<div>
    <?= $this->Form->create($cmsSiteUser) ?>
    <?= $this->Form->input('cms_site_id', ['options' => $cmsSites]); ?>
    <?= $this->Form->input('user_id', ['options' => $users]); ?>
    <?= $this->Form->input('params'); ?>
    <hr/>
    <div class="text-center">
        <?= $this->Form->button(__('Save'), ['class' => 'btn btn-success']) ?>  
    </div>
    <?= $this->Form->end() ?>
</div>