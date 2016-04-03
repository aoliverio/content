<?php $this->layout = null ?>
<h4><?= __('Edit Cms Term Relationship'); ?></h4>
<hr/>
<div>
    <?= $this->Form->create($cmsTermRelationship) ?>
    <?= $this->Form->input('cms_content_id', ['options' => $cmsContents]); ?>
    <?= $this->Form->input('cms_term_taxonomy_id', ['options' => $cmsTermTaxonomies]); ?>
    <?= $this->Form->input('menu_order'); ?>
    <hr/>
    <div class="text-center">
        <?= $this->Form->button(__('Save'), ['class' => 'btn btn-success']) ?>  
    </div>
    <?= $this->Form->end() ?>
</div>