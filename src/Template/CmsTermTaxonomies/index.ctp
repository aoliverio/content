<div class="panel panel-default">
    <div class="panel-heading">
        <span class="pull-right">
            <small><?= __('Actions:'); ?></small>
            <a class="btn btn-xs" href="<?= $this->Url->build(['controller' => 'cmsTermTaxonomies', 'action' => 'filter']) ?>" data-toggle="modal" data-target="#myModal"><i class="fa fa-filter"></i> <?= __('Filter') ?></a>
            <a class="btn btn-xs" href="<?= $this->Url->build(['controller' => 'cmsTermTaxonomies', 'action' => 'add']) ?>" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> <?= __('Add') ?></a>
        </span>
        <h3 class="panel-title"><i class="fa fa-list"></i> <?= __('Cms Term Taxonomies'); ?></h3>
    </div>
    <div class="panel-body">
        <table id="cmsTermTaxonomy-table" class="table table-striped table-hover dataTable">
            <thead>
                <tr>
                    <th class="check no-sorting">
                        <input id="checkall" class="" type="checkbox" name="" value="" />
                    </th>
                    <th><?= __('Id') ?></th>
                    <th><?= __('Parent Id') ?></th>
                    <th><?= __('Cms Term Id') ?></th>
                    <th><?= __('Cms Content Type Id') ?></th>
                    <th><?= __('Title') ?></th>
                    <th><?= __('Count') ?></th>
                    <th class="actions no-sorting"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $cmsTermTaxonomy): ?>
                    <tr>
                        <td class="check"><input id="" class="" type="checkbox" name="" value="" /></td>
                        <td><?= $this->Number->format($cmsTermTaxonomy->id) ?></td>
                        <td><?= $cmsTermTaxonomy->has('parent_cms_term_taxonomy') ? $this->Html->link($cmsTermTaxonomy->parent_cms_term_taxonomy->title, ['controller' => 'CmsTermTaxonomies', 'action' => 'view', $cmsTermTaxonomy->parent_cms_term_taxonomy->id]) : '' ?></td>
                        <td><?= $cmsTermTaxonomy->has('cms_term') ? $this->Html->link($cmsTermTaxonomy->cms_term->name, ['controller' => 'CmsTerms', 'action' => 'view', $cmsTermTaxonomy->cms_term->id]) : '' ?></td>
                        <td><?= $cmsTermTaxonomy->has('cms_content_type') ? $this->Html->link($cmsTermTaxonomy->cms_content_type->name, ['controller' => 'CmsContentTypes', 'action' => 'view', $cmsTermTaxonomy->cms_content_type->id]) : '' ?></td>
                        <td><?= h($cmsTermTaxonomy->title) ?></td>
                        <td><?= $this->Number->format($cmsTermTaxonomy->count) ?></td>
                        <td class="actions text-right">
                            <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', ['controller' => 'cmsTermTaxonomies', 'action' => 'view', $cmsTermTaxonomy->id], ['escape' => false, 'class' => 'btn btn-xs btn-default', 'title' => __('View')]) ?>
                            <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') . '</span>', ['controller' => 'cmsTermTaxonomies', 'action' => 'edit', $cmsTermTaxonomy->id], ['escape' => false, 'class' => 'btn btn-xs btn-default', 'title' => __('Edit'), 'data-toggle' => 'modal', 'data-target' => '#myModal']) ?>
                            <?= $this->Html->link('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') . '</span>', ['controller' => 'cmsTermTaxonomies', 'action' => 'delete', $cmsTermTaxonomy->id], ['escape' => false, 'class' => 'btn btn-xs btn-danger', 'title' => __('Delete'), 'data-toggle' => 'modal', 'data-target' => '#myModal']) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
