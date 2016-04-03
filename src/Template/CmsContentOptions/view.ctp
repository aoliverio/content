<div class="panel panel-default">
    <div class="panel-heading">
        <span class="pull-right">
            <small><?= __('Actions:'); ?></small>
            <a class="btn btn-xs" href="<?= $this->Url->build(['controller' => 'cmsContentOptions', 'action' => 'index']) ?>"><i class="fa fa-list"></i> <?= __('List') ?></a>
        </span>
        <h3 class="panel-title"><i class="fa fa-search-plus"></i> <?= __('Cms Content Option'); ?></h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6 columns strings">
                <label class="subheader"><?= __('Cms Content') ?></label>
                <p><?= $cmsContentOption->has('cms_content') ? $this->Html->link($cmsContentOption->cms_content->name, ['controller' => 'CmsContents', 'action' => 'view', $cmsContentOption->cms_content->id]) : '' ?></p>
                <label class="subheader"><?= __('Option Key') ?></label>
                <p><?= h($cmsContentOption->option_key) ?></p>
                <hr/>
            </div>
            <div class="col-md-2 columns numbers end">
                <label class="subheader"><?= __('Id') ?></label>
                <p><?= $this->Number->format($cmsContentOption->id) ?></p>
                <hr/>
                <label class="subheader"><?= __('Menu Order') ?></label>
                <p><?= $this->Number->format($cmsContentOption->menu_order) ?></p>
                <hr/>
            </div>
        </div>
    </div>
</div>