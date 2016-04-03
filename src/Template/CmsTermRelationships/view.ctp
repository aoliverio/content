<div class="panel panel-default">
    <div class="panel-heading">
        <span class="pull-right">
            <small><?= __('Actions:'); ?></small>
            <a class="btn btn-xs" href="<?= $this->Url->build(['controller' => 'cmsTermRelationships', 'action' => 'index']) ?>"><i class="fa fa-list"></i> <?= __('List') ?></a>
        </span>
        <h3 class="panel-title"><i class="fa fa-search-plus"></i> <?= __('Cms Term Relationship'); ?></h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6 columns strings">
                <label class="subheader"><?= __('Cms Content') ?></label>
                <p><?= $cmsTermRelationship->has('cms_content') ? $this->Html->link($cmsTermRelationship->cms_content->name, ['controller' => 'CmsContents', 'action' => 'view', $cmsTermRelationship->cms_content->id]) : '' ?></p>
                <label class="subheader"><?= __('Cms Term Taxonomy') ?></label>
                <p><?= $cmsTermRelationship->has('cms_term_taxonomy') ? $this->Html->link($cmsTermRelationship->cms_term_taxonomy->title, ['controller' => 'CmsTermTaxonomies', 'action' => 'view', $cmsTermRelationship->cms_term_taxonomy->id]) : '' ?></p>
            </div>
            <div class="col-md-2 columns numbers end">
                <label class="subheader"><?= __('Id') ?></label>
                <p><?= $this->Number->format($cmsTermRelationship->id) ?></p>
                <hr/>
                <label class="subheader"><?= __('Menu Order') ?></label>
                <p><?= $this->Number->format($cmsTermRelationship->menu_order) ?></p>
                <hr/>
            </div>
        </div>
    </div>
</div>