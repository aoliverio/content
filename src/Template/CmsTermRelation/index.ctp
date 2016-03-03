
<!-- Page title -->
<h1 class="page-header"><?= __('List of Cms Term Relation'); ?></h1>
<!-- Actions bar -->
<div class="well well-sm">
    <div class="text-right">
        <small class="text-info pull-left"><?= __('Navigation Bar:') ?></small>
        <?= $this->Html->link(__('New Cms Term Relation'), ['action' => 'add'], ['escape' => false, 'class' => 'btn btn-success', 'title' => __('New Cms Term Relation')]) ?>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?= __('Actions') ?> <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><?= $this->Html->link(__('New Cms Term Relation'), ['action' => 'add']) ?></li>
                <li><?= $this->Html->link(__('New Cms Term Taxonomy'), ['controller' => 'CmsTermTaxonomy', 'action' => 'add']) ?></li>
                <li><?= $this->Html->link(__('New Cms Content'), ['controller' => 'CmsContent', 'action' => 'add']) ?></li>

            </ul>
        </div>
    </div>
</div>
<!-- Index template -->
<div class="cmsTermRelation thumbnail">
    <!-- Using datatables script for this table -->
    <script>
        $(document).ready(function () {
            $('#cmsTermRelation-table').dataTable();
        });
    </script>
    <table id="cmsTermRelation-table" class="table table-striped table-hover">
        <thead>
            <tr>
                <th class="check no-sorting">
                    <input id="checkall" class="" type="checkbox" name="" value="" />
                </th>
                <th><?= __('Id') ?></th>
                <th><?= __('Cms Term Taxonomy') ?></th>
                <th><?= __('Cms Content') ?></th>
                <th><?= __('Order') ?></th>
                <th class="actions no-sorting"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $cmsTermRelation): ?>
                <tr>
                    <td><input id="" class="check" type="checkbox" name="" value="" /></td>
                    <td><?= $this->Number->format($cmsTermRelation->id) ?></td>
                    <td>
                        <?= $cmsTermRelation->has('cms_term_taxonomy') ? $this->Html->link($cmsTermRelation->cms_term_taxonomy->title, ['controller' => 'CmsTermTaxonomy', 'action' => 'view', $cmsTermRelation->cms_term_taxonomy->id]) : '' ?>
                    </td>
                    <td>
                        <?= $cmsTermRelation->has('cms_content') ? $this->Html->link($cmsTermRelation->cms_content->name, ['controller' => 'CmsContent', 'action' => 'view', $cmsTermRelation->cms_content->id]) : '' ?>
                    </td>
                    <td><?= $this->Number->format($cmsTermRelation->order) ?></td>
                    <td class="actions text-right">
                        <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', ['action' => 'view', $cmsTermRelation->id], ['escape' => false, 'class' => 'btn btn-xs btn-default', 'title' => __('View')]) ?>
                        <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') . '</span>', ['action' => 'edit', $cmsTermRelation->id], ['escape' => false, 'class' => 'btn btn-xs btn-default', 'title' => __('Edit')]) ?>
                        <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') . '</span>', ['action' => 'delete', $cmsTermRelation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cmsTermRelation->id), 'escape' => false, 'class' => 'btn btn-xs btn-danger', 'title' => __('Delete')]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
