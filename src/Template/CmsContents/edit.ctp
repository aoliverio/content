<?php $this->layout = null ?>
<h4><?= __('Edit Cms Content'); ?></h4>
<hr/>
<div>
    <?= $this->Form->create($cmsContent) ?>
    <?= $this->Form->input('parent_id', ['options' => $parentCmsContents, 'empty' => true]); ?>
    <?= $this->Form->input('name'); ?>
    <?= $this->Form->input('content_title'); ?>
    <?= $this->Form->input('content_description'); ?>
    <?= $this->Form->input('content_excerpt'); ?>
    <?= $this->Form->input('content_expiry'); ?>
    <?= $this->Form->input('content_password'); ?>
    <?= $this->Form->input('cms_content_status_id', ['options' => $cmsContentStatues]); ?>
    <?= $this->Form->input('content_path'); ?>
    <?= $this->Form->input('cms_content_type_id', ['options' => $cmsContentTypes]); ?>
    <?= $this->Form->input('content_mime_type'); ?>
    <?= $this->Form->input('publish_start'); ?>
    <?= $this->Form->input('publish_end'); ?>
    <?= $this->Form->input('guid'); ?>
    <?= $this->Form->input('author_id', ['options' => $authors, 'empty' => true]); ?>
    <?= $this->Form->input('menu_order'); ?>
    <hr/>
    <div class="text-center">
        <?= $this->Form->button(__('Save'), ['class' => 'btn btn-success']) ?>  
    </div>
    <?= $this->Form->end() ?>
</div>