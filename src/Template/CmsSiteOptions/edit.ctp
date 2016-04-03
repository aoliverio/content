<?php $this->layout = null ?>
<h4><?= __('Edit Cms Site Option'); ?></h4>
<hr/>
<div>
    <?= $this->Form->create($cmsSiteOption) ?>
    <?= $this->Form->input('cms_site_id', ['options' => $cmsSites]); ?>
    <?= $this->Form->input('option_key'); ?>
    <?= $this->Form->input('option_value'); ?>
    <?= $this->Form->input('menu_order'); ?>
    <hr/>
    <div class="text-center">
        <?= $this->Form->button(__('Save'), ['class' => 'btn btn-success']) ?>  
    </div>
    <?= $this->Form->end() ?>
</div>