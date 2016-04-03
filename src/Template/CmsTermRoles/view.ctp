<div class="panel panel-default">
    <div class="panel-heading">
        <span class="pull-right">
            <small><?= __('Actions:'); ?></small>
            <a class="btn btn-xs" href="<?= $this->Url->build(['controller' => 'cmsTermRoles', 'action' => 'index']) ?>"><i class="fa fa-list"></i> <?= __('List') ?></a>
        </span>
        <h3 class="panel-title"><i class="fa fa-search-plus"></i> <?= __('Cms Term Role'); ?></h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6 columns strings">
                <label class="subheader"><?= __('Cms Term') ?></label>
                <p><?= $cmsTermRole->has('cms_term') ? $this->Html->link($cmsTermRole->cms_term->name, ['controller' => 'CmsTerms', 'action' => 'view', $cmsTermRole->cms_term->id]) : '' ?></p>
                <label class="subheader"><?= __('Role') ?></label>
                <p><?= $cmsTermRole->has('role') ? $this->Html->link($cmsTermRole->role->name, ['controller' => 'Roles', 'action' => 'view', $cmsTermRole->role->id]) : '' ?></p>
            </div>
            <div class="col-md-2 columns numbers end">
                <label class="subheader"><?= __('Id') ?></label>
                <p><?= $this->Number->format($cmsTermRole->id) ?></p>
                <hr/>
            </div>
        </div>
    </div>
</div>