<!-- Page title -->
<h1 class="page-header"><?= __('Details of Cms Permission'); ?></h1>
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
                                <li><?= $this->Html->link(__('Edit Cms Permission'), ['action' => 'edit', $cmsPermission->id]) ?></li>
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
<!-- Grid template -->
<div class="thumbnail">
    <div class="row">
                <div class="col-md-6 columns strings">
                                    <label class="subheader"><?= __('Cms Term') ?></label>
            <p><?= $cmsPermission->has('cms_term') ? $this->Html->link($cmsPermission->cms_term->name, ['controller' => 'CmsTerm', 'action' => 'view', $cmsPermission->cms_term->id]) : '' ?></p>
                                                <label class="subheader"><?= __('Cms Content') ?></label>
            <p><?= $cmsPermission->has('cms_content') ? $this->Html->link($cmsPermission->cms_content->name, ['controller' => 'CmsContent', 'action' => 'view', $cmsPermission->cms_content->id]) : '' ?></p>
                                </div>
                        <div class="col-md-2 columns numbers end">
                        <label class="subheader"><?= __('Id') ?></label>
            <p><?= $this->Number->format($cmsPermission->id) ?></p>
            <hr/>
                        <label class="subheader"><?= __('Sys User') ?></label>
            <p><?= $this->Number->format($cmsPermission->sys_user) ?></p>
            <hr/>
                        <label class="subheader"><?= __('Sys Role') ?></label>
            <p><?= $this->Number->format($cmsPermission->sys_role) ?></p>
            <hr/>
                        <label class="subheader"><?= __('Created User') ?></label>
            <p><?= $this->Number->format($cmsPermission->created_user) ?></p>
            <hr/>
                        <label class="subheader"><?= __('Modified User') ?></label>
            <p><?= $this->Number->format($cmsPermission->modified_user) ?></p>
            <hr/>
                    </div>
                        <div class="col-md-2 columns dates end">
                        <label class="subheader"><?= __('Created') ?></label>
            <p><?= h($cmsPermission->created) ?></p>
            <hr/>
                        <label class="subheader"><?= __('Modified') ?></label>
            <p><?= h($cmsPermission->modified) ?></p>
            <hr/>
                    </div>
                        <div class="col-md-2 columns booleans end">
                        <label class="subheader"><?= __('Allow') ?></label>
            <p><?= $cmsPermission->allow ? __('Yes') : __('No'); ?></p>
            <hr/>
                    </div>
            </div>
</div>
<h3 class="page-header"><?= __('Related'); ?></h3>
<div id="view-related">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
            </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        </div>
