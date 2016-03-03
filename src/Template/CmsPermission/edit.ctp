
<!-- Page title -->
<h1 class="page-header"><?= __('Edit Cms Permission'); ?></h1>
<!-- Actions bar -->
<div class="well well-sm">
    <div class="text-right">
        <small class="text-info pull-left"><?= __('Navigation Bar:') ?></small>
        <?= $this->Html->link(__('List Cms Permission'), ['action' => 'index'], ['escape' => false, 'class' => 'btn btn-success', 'title' => __('List Cms Permission')]) ?>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?= __('Actions') ?> <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                                <li><?= $this->Html->link(__('View Cms Permission'), ['action' => 'view', $cmsPermission->id]) ?></li>
                <li><?=
                    $this->Form->postLink(
                    __('Delete Cms Permission'),
                    ['action' => 'delete', $cmsPermission->id],
                    ['confirm' => __('Are you sure you want to delete # {0}?', $cmsPermission->id)]
                    )
                    ?>
                </li>
                                <li><?= $this->Html->link(__('List Cms Permission'), ['action' => 'index']) ?></li>
                                <li role="separator" class="divider"></li>
                <li><?= $this->Html->link(__('List Cms Term'), ['controller' => 'CmsTerm', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('New Cms Term'), ['controller' => 'CmsTerm', 'action' => 'add']) ?></li>
                                <li role="separator" class="divider"></li>
                <li><?= $this->Html->link(__('List Cms Content'), ['controller' => 'CmsContent', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('New Cms Content'), ['controller' => 'CmsContent', 'action' => 'add']) ?></li>
                            </ul>
        </div>
    </div>
</div>
<!-- Form template -->
<div class="thumbnail">
    <?= $this->Form->create($cmsPermission) ?>
    <?php
                echo $this->Form->input('cms_term_id', ['options' => $cmsTerm, 'label' => 'Cms Term Id', 'class' => 'form-control']);
                            echo $this->Form->input('cms_content_id', ['options' => $cmsContent, 'label' => 'Cms Content Id', 'class' => 'form-control']);
                            echo $this->Form->input('sys_user', ['label' => 'Sys User', 'class' => 'form-control']);
                            echo $this->Form->input('sys_role', ['label' => 'Sys Role', 'class' => 'form-control']);
                            echo $this->Form->input('allow', ['label' => 'Allow', 'class' => 'form-control']);
                    ?>
    <hr/>
    <div id="view-navigation">
        <div class="text-right">
            <button class="btn btn-success" type="submit">Save</button>  
        </div>
    </div>
    </form>
</div>