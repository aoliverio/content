<?php $this->layout = null ?>
<h4><?= __('Edit Cms Content Type'); ?></h4>
<hr/>
<div>
    <?= $this->Form->create($cmsContentType) ?>
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