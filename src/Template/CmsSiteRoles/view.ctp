<div class="panel panel-default">
    <div class="panel-heading">
        <span class="pull-right">
            <small><?= __('Actions:'); ?></small>
            <a class="btn btn-xs" href="<?= $this->Url->build(['controller' => 'cmsSiteRoles', 'action' => 'index']) ?>"><i class="fa fa-list"></i> <?= __('List') ?></a>
        </span>
        <h3 class="panel-title"><i class="fa fa-search-plus"></i> <?= __('Cms Site Role'); ?></h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6 columns strings">
                <label class="subheader"><?= __('Cms Site') ?></label>
                <p><?= $cmsSiteRole->has('cms_site') ? $this->Html->link($cmsSiteRole->cms_site->name, ['controller' => 'CmsSites', 'action' => 'view', $cmsSiteRole->cms_site->id]) : '' ?></p>
                <label class="subheader"><?= __('Role') ?></label>
                <p><?= $cmsSiteRole->has('role') ? $this->Html->link($cmsSiteRole->role->name, ['controller' => 'Roles', 'action' => 'view', $cmsSiteRole->role->id]) : '' ?></p>
            </div>
            <div class="col-md-2 columns numbers end">
                <label class="subheader"><?= __('Id') ?></label>
                <p><?= $this->Number->format($cmsSiteRole->id) ?></p>
                <hr/>
            </div>
        </div>
    </div>
</div>