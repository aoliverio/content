<?php $this->layout = null ?>
<h4><?= __('Add Cms Term'); ?></h4>
<hr/>
<div>
    <?= $this->Form->create($cmsTerm) ?>
    <?= $this->Form->input('cms_site_id', ['options' => $cmsSites]); ?>
    <?= $this->Form->input('name'); ?>
    <?= $this->Form->input('title'); ?>
    <?= $this->Form->input('description'); ?>
    <?= $this->Form->input('params'); ?>
    <hr/>
    <div class="text-center">
        <?= $this->Form->button(__('Save'), ['class' => 'btn btn-success']) ?>  
    </div>
    <?= $this->Form->end() ?>
</div>