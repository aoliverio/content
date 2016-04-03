<?php $this->layout = null ?>
<h4><?= __('Add Cms Term Taxonomy Type'); ?></h4>
<hr/>
<div>
    <?= $this->Form->create($cmsTermTaxonomyType) ?>
    <?= $this->Form->input('name'); ?>
    <?= $this->Form->input('title'); ?>
    <?= $this->Form->input('description'); ?>
    <hr/>
    <div class="text-center">
        <?= $this->Form->button(__('Save'), ['class' => 'btn btn-success']) ?>  
    </div>
    <?= $this->Form->end() ?>
</div>