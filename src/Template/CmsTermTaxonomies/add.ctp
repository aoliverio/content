<?php $this->layout = null ?>
<h4><?= __('Add Cms Term Taxonomy'); ?></h4>
<hr/>
<div>
    <?= $this->Form->create($cmsTermTaxonomy) ?>
    <?= $this->Form->input('parent_id', ['options' => $parentCmsTermTaxonomies, 'empty' => true]); ?>
    <?= $this->Form->input('cms_term_id', ['options' => $cmsTerms]); ?>
    <?= $this->Form->input('cms_term_taxonomy_type_id', ['options' => $cmsTermTaxonomyTypes]); ?>
    <?= $this->Form->input('title'); ?>
    <?= $this->Form->input('description'); ?>
    <?= $this->Form->input('count'); ?>
    <hr/>
    <div class="text-center">
        <?= $this->Form->button(__('Save'), ['class' => 'btn btn-success']) ?>  
    </div>
    <?= $this->Form->end() ?>
</div>