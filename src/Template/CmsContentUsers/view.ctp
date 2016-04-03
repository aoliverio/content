<div class="panel panel-default">
    <div class="panel-heading">
        <span class="pull-right">
            <small><?= __('Actions:'); ?></small>
            <a class="btn btn-xs" href="<?= $this->Url->build(['controller' => 'cmsContentUsers', 'action' => 'index']) ?>"><i class="fa fa-list"></i> <?= __('List') ?></a>
        </span>
        <h3 class="panel-title"><i class="fa fa-search-plus"></i> <?= __('Cms Content User'); ?></h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6 columns strings">
                <label class="subheader"><?= __('Cms Content') ?></label>
                <p><?= $cmsContentUser->has('cms_content') ? $this->Html->link($cmsContentUser->cms_content->name, ['controller' => 'CmsContents', 'action' => 'view', $cmsContentUser->cms_content->id]) : '' ?></p>
                <label class="subheader"><?= __('User') ?></label>
                <p><?= $cmsContentUser->has('user') ? $this->Html->link($cmsContentUser->user->name, ['controller' => 'Users', 'action' => 'view', $cmsContentUser->user->id]) : '' ?></p>
            </div>
            <div class="col-md-2 columns numbers end">
                <label class="subheader"><?= __('Id') ?></label>
                <p><?= $this->Number->format($cmsContentUser->id) ?></p>
                <hr/>
            </div>
        </div>
    </div>
</div>