<div class="panel panel-default">
    <div class="panel-heading">
        <span class="pull-right">
            <small><?= __('Actions:'); ?></small>
            <a class="btn btn-xs" href="<?= $this->Url->build(['controller' => 'cmsTermRelationships', 'action' => 'filter']) ?>" data-toggle="modal" data-target="#myModal"><i class="fa fa-filter"></i> <?= __('Filter') ?></a>
            <a class="btn btn-xs" href="<?= $this->Url->build(['controller' => 'cmsTermRelationships', 'action' => 'add']) ?>" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> <?= __('Add') ?></a>
        </span>
        <h3 class="panel-title"><i class="fa fa-list"></i> <?= __('Cms Term Relationships'); ?></h3>
    </div>
    <div class="panel-body">
        <table id="cmsTermRelationship-table" class="table table-striped table-hover dataTable">
            <thead>
                <tr>
                    <th class="check no-sorting">
                        <input id="checkall" class="" type="checkbox" name="" value="" />
                    </th>
                    <th><?= __('Id') ?></th>
                    <th><?= __('Cms Content Id') ?></th>
                    <th><?= __('Cms Term Taxonomy Id') ?></th>
                    <th><?= __('Menu Order') ?></th>
                    <th class="actions no-sorting"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $cmsTermRelationship): ?>
                    <tr>
                        <td class="check"><input id="" class="" type="checkbox" name="" value="" /></td>
                        <td><?= $this->Number->format($cmsTermRelationship->id) ?></td>
                        <td><?= $cmsTermRelationship->has('cms_content') ? $this->Html->link($cmsTermRelationship->cms_content->name, ['controller' => 'CmsContents', 'action' => 'view', $cmsTermRelationship->cms_content->id]) : '' ?></td>
                        <td><?= $cmsTermRelationship->has('cms_term_taxonomy') ? $this->Html->link($cmsTermRelationship->cms_term_taxonomy->title, ['controller' => 'CmsTermTaxonomies', 'action' => 'view', $cmsTermRelationship->cms_term_taxonomy->id]) : '' ?></td>
                        <td><?= $this->Number->format($cmsTermRelationship->menu_order) ?></td>
                        <td class="actions text-right">
                            <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', ['controller' => 'cmsTermRelationships', 'action' => 'view', $cmsTermRelationship->id], ['escape' => false, 'class' => 'btn btn-xs btn-default', 'title' => __('View')]) ?>
                            <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') . '</span>', ['controller' => 'cmsTermRelationships', 'action' => 'edit', $cmsTermRelationship->id], ['escape' => false, 'class' => 'btn btn-xs btn-default', 'title' => __('Edit'), 'data-toggle' => 'modal', 'data-target' => '#myModal']) ?>
                            <?= $this->Html->link('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') . '</span>', ['controller' => 'cmsTermRelationships', 'action' => 'delete', $cmsTermRelationship->id], ['escape' => false, 'class' => 'btn btn-xs btn-danger', 'title' => __('Delete'), 'data-toggle' => 'modal', 'data-target' => '#myModal']) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
