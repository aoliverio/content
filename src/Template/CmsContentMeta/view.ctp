<!-- Page title -->
<h1 class="page-header"><?= __('Details of Cms Content Meta'); ?></h1>
<!-- Actions bar -->
<div class="well well-sm">
    <div class="text-right">
        <small class="text-info pull-left"><?= __('Navigation Bar:') ?></small>
        <?= $this->Html->link(__('List Cms Content Meta'), ['action' => 'index'], ['escape' => false, 'class' => 'btn btn-success', 'title' => __('List Cms Content Meta')]) ?>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?= __('Actions') ?> <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                                <li><?= $this->Html->link(__('Edit Cms Content Meta'), ['action' => 'edit', $cmsContentMeta->id]) ?></li>
                <li><?=
                    $this->Form->postLink(
                    __('Delete Cms Content Meta'),
                    ['action' => 'delete', $cmsContentMeta->id],
                    ['confirm' => __('Are you sure you want to delete # {0}?', $cmsContentMeta->id)]
                    )
                    ?>
                </li>
                                <li><?= $this->Html->link(__('List Cms Content Meta'), ['action' => 'index']) ?></li>
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
                                    <label class="subheader"><?= __('Cms Content') ?></label>
            <p><?= $cmsContentMeta->has('cms_content') ? $this->Html->link($cmsContentMeta->cms_content->name, ['controller' => 'CmsContent', 'action' => 'view', $cmsContentMeta->cms_content->id]) : '' ?></p>
                                                <label class="subheader"><?= __('Meta Key') ?></label>
            <p><?= h($cmsContentMeta->meta_key) ?></p>
            <hr/>
                                </div>
                        <div class="col-md-2 columns numbers end">
                        <label class="subheader"><?= __('Id') ?></label>
            <p><?= $this->Number->format($cmsContentMeta->id) ?></p>
            <hr/>
                        <label class="subheader"><?= __('Priority') ?></label>
            <p><?= $this->Number->format($cmsContentMeta->priority) ?></p>
            <hr/>
                        <label class="subheader"><?= __('Created User') ?></label>
            <p><?= $this->Number->format($cmsContentMeta->created_user) ?></p>
            <hr/>
                        <label class="subheader"><?= __('Modified User') ?></label>
            <p><?= $this->Number->format($cmsContentMeta->modified_user) ?></p>
            <hr/>
                    </div>
                        <div class="col-md-2 columns dates end">
                        <label class="subheader"><?= __('Created') ?></label>
            <p><?= h($cmsContentMeta->created) ?></p>
            <hr/>
                        <label class="subheader"><?= __('Modified') ?></label>
            <p><?= h($cmsContentMeta->modified) ?></p>
            <hr/>
                    </div>
                    </div>
</div>
<div class="row texts">
    <div class="col-md-12 columns ">
        <label class="subheader"><?= __('Meta Value') ?></label>
        <?= $this->Text->autoParagraph(h($cmsContentMeta->meta_value)); ?>
        <hr/>
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
