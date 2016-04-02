<div class="panel panel-default">
    <div class="panel-heading">
        <span class="pull-right">
            <small><?= __('Actions:'); ?></small>
            <a class="btn btn-xs" href="<?= $this->Url->build(['controller' => 'cmsContents', 'action' => 'index']) ?>"><i class="fa fa-list"></i> <?= __('List') ?></a>
        </span>
        <h3 class="panel-title"><i class="fa fa-search-plus"></i> <?= __('Cms Content'); ?></h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6 columns strings">
                <label class="subheader"><?= __('Parent Cms Content') ?></label>
                <p><?= $cmsContent->has('parent_cms_content') ? $this->Html->link($cmsContent->parent_cms_content->name, ['controller' => 'CmsContents', 'action' => 'view', $cmsContent->parent_cms_content->id]) : '' ?></p>
                <label class="subheader"><?= __('Name') ?></label>
                <p><?= h($cmsContent->name) ?></p>
                <hr/>
                <label class="subheader"><?= __('Content Title') ?></label>
                <p><?= h($cmsContent->content_title) ?></p>
                <hr/>
                <label class="subheader"><?= __('Content Password') ?></label>
                <p><?= h($cmsContent->content_password) ?></p>
                <hr/>
                <label class="subheader"><?= __('Cms Content Statue') ?></label>
                <p><?= $cmsContent->has('cms_content_statue') ? $this->Html->link($cmsContent->cms_content_statue->name, ['controller' => 'CmsContentStatues', 'action' => 'view', $cmsContent->cms_content_statue->id]) : '' ?></p>
                <label class="subheader"><?= __('Content Path') ?></label>
                <p><?= h($cmsContent->content_path) ?></p>
                <hr/>
                <label class="subheader"><?= __('Cms Content Type') ?></label>
                <p><?= $cmsContent->has('cms_content_type') ? $this->Html->link($cmsContent->cms_content_type->name, ['controller' => 'CmsContentTypes', 'action' => 'view', $cmsContent->cms_content_type->id]) : '' ?></p>
                <label class="subheader"><?= __('Content Mime Type') ?></label>
                <p><?= h($cmsContent->content_mime_type) ?></p>
                <hr/>
                <label class="subheader"><?= __('Guid') ?></label>
                <p><?= h($cmsContent->guid) ?></p>
                <hr/>
                <label class="subheader"><?= __('Author') ?></label>
                <p><?= $cmsContent->has('author') ? $this->Html->link($cmsContent->author->name, ['controller' => 'Authors', 'action' => 'view', $cmsContent->author->id]) : '' ?></p>
            </div>
            <div class="col-md-2 columns numbers end">
                <label class="subheader"><?= __('Id') ?></label>
                <p><?= $this->Number->format($cmsContent->id) ?></p>
                <hr/>
                <label class="subheader"><?= __('Menu Order') ?></label>
                <p><?= $this->Number->format($cmsContent->menu_order) ?></p>
                <hr/>
                <label class="subheader"><?= __('Created By') ?></label>
                <p><?= $this->Number->format($cmsContent->created_by) ?></p>
                <hr/>
                <label class="subheader"><?= __('Modified By') ?></label>
                <p><?= $this->Number->format($cmsContent->modified_by) ?></p>
                <hr/>
            </div>
            <div class="col-md-2 columns dates end">
                <label class="subheader"><?= __('Content Expiry') ?></label>
                <p><?= h($cmsContent->content_expiry) ?></p>
                <hr/>
                <label class="subheader"><?= __('Publish Start') ?></label>
                <p><?= h($cmsContent->publish_start) ?></p>
                <hr/>
                <label class="subheader"><?= __('Publish End') ?></label>
                <p><?= h($cmsContent->publish_end) ?></p>
                <hr/>
                <label class="subheader"><?= __('Created') ?></label>
                <p><?= h($cmsContent->created) ?></p>
                <hr/>
                <label class="subheader"><?= __('Modified') ?></label>
                <p><?= h($cmsContent->modified) ?></p>
                <hr/>
            </div>
        </div>
    </div>
</div>