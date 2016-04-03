<?php $this->layout = null ?>
<h4><?= __('Edit Cms Site'); ?></h4>
<hr/>
<div>
    <?= $this->Form->create($cmsSite) ?>
    <?= $this->Form->input('name'); ?>
    <?= $this->Form->input('domain'); ?>
    <hr/>
    <div class="text-center">
        <?= $this->Form->button(__('Save'), ['class' => 'btn btn-success']) ?>  
    </div>
    <?= $this->Form->end() ?>
</div>