<?php $this->layout = null ?>
<h4><?= __('Edit Cms Content Option'); ?></h4>
<hr/>
<div>
    <?= $this->Form->create($cmsContentOption) ?>
    <?= $this->Form->input('cms_content_id', ['options' => $cmsContents]); ?>
    <?= $this->Form->input('option_key'); ?>
    <?= $this->Form->input('option_value'); ?>
    <?= $this->Form->input('menu_order'); ?>
    <hr/>
    <div class="text-center">
        <?= $this->Form->button(__('Save'), ['class' => 'btn btn-success']) ?>  
    </div>
    <?= $this->Form->end() ?>
</div>