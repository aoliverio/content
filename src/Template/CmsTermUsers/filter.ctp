<?php $this->layout = null ?>
<h4><?= __('Filter Cms Term User'); ?></h4>
<hr/>
<div>
    <?= $this->Form->create($cmsTermUser); ?>
    <?= __('No filter template are builded. Make your filter here!'); ?>
    <hr/>
    <div class="text-center">
        <button class="btn btn-success" type="submit"><?= __('Filter'); ?></button>  
    </div>
    <?= $this->Form->end(); ?>
</div>