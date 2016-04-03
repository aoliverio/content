<?php $this->layout = null ?>
<h4><?= __('Delete Cms Term Relationship'); ?></h4>
<hr/>
<div>
    <?= $this->Form->create($cmsTermRelationship); ?>
    <p><?= __('Are you sure you want to delete # {0}?', $cmsTermRelationship->id); ?></p>
    <hr/>
    <div class="text-center">
        <button class="btn btn-danger" type="submit"><?= __('Confirm') ?></button>  
    </div>
    <?= $this->Form->end(); ?>
</div>