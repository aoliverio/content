<div class="panel panel-default">
    <div class="panel-heading">
        <span class="pull-right">
            <small><?= __('Actions:'); ?></small>
            <a class="btn btn-xs" href="<?= $this->Url->build(['controller' => 'cmsContentRoles', 'action' => 'index']) ?>"><i class="fa fa-list"></i> <?= __('List') ?></a>
        </span>
        <h3 class="panel-title"><i class="fa fa-search-plus"></i> <?= __('Cms Content Role'); ?></h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6 columns strings">
                <label class="subheader"><?= __('Cms Content') ?></label>
                <p><?= $cmsContentRole->has('cms_content') ? $this->Html->link($cmsContentRole->cms_content->name, ['controller' => 'CmsContents', 'action' => 'view', $cmsContentRole->cms_content->id]) : '' ?></p>
                <label class="subheader"><?= __('Role') ?></label>
                <p><?= $cmsContentRole->has('role') ? $this->Html->link($cmsContentRole->role->name, ['controller' => 'Roles', 'action' => 'view', $cmsContentRole->role->id]) : '' ?></p>
            </div>
            <div class="col-md-2 columns numbers end">
                <label class="subheader"><?= __('Id') ?></label>
                <p><?= $this->Number->format($cmsContentRole->id) ?></p>
                <hr/>
            </div>
        </div>
    </div>
</div>