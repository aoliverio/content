<?php $this->layout = null ?>
<h4><?= __('Delete Cms Term Taxonomy'); ?></h4>
<hr/>
<div>
    <?= $this->Form->create($cmsTermTaxonomy); ?>
    <p><?= __('Are you sure you want to delete # {0}?', $cmsTermTaxonomy->id); ?></p>
    <hr/>
    <div class="text-center">
        <button class="btn btn-danger" type="submit"><?= __('Confirm') ?></button>  
    </div>
    <?= $this->Form->end(); ?>
</div>