<?php $this->layout = null ?>
<h4><?= __('Delete Cms Site User'); ?></h4>
<hr/>
<div>
    <?= $this->Form->create($cmsSiteUser); ?>
    <p><?= __('Are you sure you want to delete # {0}?', $cmsSiteUser->id); ?></p>
    <hr/>
    <div class="text-center">
        <button class="btn btn-danger" type="submit"><?= __('Confirm') ?></button>  
    </div>
    <?= $this->Form->end(); ?>
</div>