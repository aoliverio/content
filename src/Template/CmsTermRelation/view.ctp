<!-- Page title -->
<h1 class="page-header"><?= __('Details of Cms Term Relation'); ?></h1>
<!-- Actions bar -->
<div class="well well-sm">
    <div class="text-right">
        <small class="text-info pull-left"><?= __('Navigation Bar:') ?></small>
        <?= $this->Html->link(__('List Cms Term Relation'), ['action' => 'index'], ['escape' => false, 'class' => 'btn btn-success', 'title' => __('List Cms Term Relation')]) ?>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?= __('Actions') ?> <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><?= $this->Html->link(__('Edit Cms Term Relation'), ['action' => 'edit', $cmsTermRelation->id]) ?></li>
                <li><?=
                    $this->Form->postLink(
                            __('Delete Cms Term Relation'), ['action' => 'delete', $cmsTermRelation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cmsTermRelation->id)]
                    )
                    ?>
                </li>
                <li><?= $this->Html->link(__('List Cms Term Relation'), ['action' => 'index']) ?></li>
                <li role="separator" class="divider"></li>
                <li><?= $this->Html->link(__('List Cms Term Taxonomy'), ['controller' => 'CmsTermTaxonomy', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('New Cms Term Taxonomy'), ['controller' => 'CmsTermTaxonomy', 'action' => 'add']) ?></li>
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
            <label class="subheader"><?= __('Cms Term Taxonomy') ?></label>
            <p><?= $cmsTermRelation->has('cms_term_taxonomy') ? $this->Html->link($cmsTermRelation->cms_term_taxonomy->title, ['controller' => 'CmsTermTaxonomy', 'action' => 'view', $cmsTermRelation->cms_term_taxonomy->id]) : '' ?></p>
            <label class="subheader"><?= __('Cms Content') ?></label>
            <p><?= $cmsTermRelation->has('cms_content') ? $this->Html->link($cmsTermRelation->cms_content->name, ['controller' => 'CmsContent', 'action' => 'view', $cmsTermRelation->cms_content->id]) : '' ?></p>
        </div>
        <div class="col-md-2 columns numbers end">
            <label class="subheader"><?= __('Id') ?></label>
            <p><?= $this->Number->format($cmsTermRelation->id) ?></p>
            <hr/>
            <label class="subheader"><?= __('Order') ?></label>
            <p><?= $this->Number->format($cmsTermRelation->order) ?></p>
            <hr/>
            <label class="subheader"><?= __('Created User') ?></label>
            <p><?= $this->Number->format($cmsTermRelation->created_user) ?></p>
            <hr/>
            <label class="subheader"><?= __('Modified User') ?></label>
            <p><?= $this->Number->format($cmsTermRelation->modified_user) ?></p>
            <hr/>
        </div>
        <div class="col-md-2 columns dates end">
            <label class="subheader"><?= __('Created') ?></label>
            <p><?= h($cmsTermRelation->created) ?></p>
            <hr/>
            <label class="subheader"><?= __('Modified') ?></label>
            <p><?= h($cmsTermRelation->modified) ?></p>
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
