<div class="panel panel-default">
    <div class="panel-heading">
        <span class="pull-right">
            <small><?= __('Actions:'); ?></small>
            <a class="btn btn-xs" href="<?= $this->Url->build(['controller' => 'cmsTermTaxonomies', 'action' => 'index']) ?>"><i class="fa fa-list"></i> <?= __('List') ?></a>
        </span>
        <h3 class="panel-title"><i class="fa fa-search-plus"></i> <?= __('Cms Term Taxonomy'); ?></h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6 columns strings">
                <label class="subheader"><?= __('Parent Cms Term Taxonomy') ?></label>
                <p><?= $cmsTermTaxonomy->has('parent_cms_term_taxonomy') ? $this->Html->link($cmsTermTaxonomy->parent_cms_term_taxonomy->title, ['controller' => 'CmsTermTaxonomies', 'action' => 'view', $cmsTermTaxonomy->parent_cms_term_taxonomy->id]) : '' ?></p>
                <label class="subheader"><?= __('Cms Term') ?></label>
                <p><?= $cmsTermTaxonomy->has('cms_term') ? $this->Html->link($cmsTermTaxonomy->cms_term->name, ['controller' => 'CmsTerms', 'action' => 'view', $cmsTermTaxonomy->cms_term->id]) : '' ?></p>
                <label class="subheader"><?= __('Cms Term Taxonomy Type') ?></label>
                <p><?= $cmsTermTaxonomy->has('cms_term_taxonomy_type') ? $this->Html->link($cmsTermTaxonomy->cms_term_taxonomy_type->name, ['controller' => 'CmsTermTaxonomyTypes', 'action' => 'view', $cmsTermTaxonomy->cms_term_taxonomy_type->id]) : '' ?></p>
                <label class="subheader"><?= __('Title') ?></label>
                <p><?= h($cmsTermTaxonomy->title) ?></p>
                <hr/>
            </div>
            <div class="col-md-2 columns numbers end">
                <label class="subheader"><?= __('Id') ?></label>
                <p><?= $this->Number->format($cmsTermTaxonomy->id) ?></p>
                <hr/>
                <label class="subheader"><?= __('Count') ?></label>
                <p><?= $this->Number->format($cmsTermTaxonomy->count) ?></p>
                <hr/>
            </div>
        </div>
    </div>
</div>