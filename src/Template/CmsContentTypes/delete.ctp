<?php $this->layout = null ?>
<h4><?= __('Delete Cms Content Type'); ?></h4>
<hr/>
<div>
    <?= $this->Form->create($cmsContentType); ?>
    <p><?= __('Are you sure you want to delete # {0}?', $cmsContentType->id); ?></p>
    <hr/>
    <div class="text-center">
        <button class="btn btn-danger" type="submit"><?= __('Confirm') ?></button>  
    </div>
    <?= $this->Form->end(); ?>
</div>