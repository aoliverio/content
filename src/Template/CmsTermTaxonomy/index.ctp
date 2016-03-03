
<!-- Page title -->
<h1 class="page-header"><?= __('List of Cms Term Taxonomy'); ?></h1>
<!-- Actions bar -->
<div class="well well-sm">
    <div class="text-right">
        <small class="text-info pull-left"><?= __('Navigation Bar:') ?></small>
        <?= $this->Html->link(__('New Cms Term Taxonomy'), ['action' => 'add'], ['escape' => false, 'class' => 'btn btn-success', 'title' => __('New Cms Term Taxonomy')]) ?>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?= __('Actions') ?> <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><?= $this->Html->link(__('New Cms Term Taxonomy'), ['action' => 'add']) ?></li>
                <li><?= $this->Html->link(__('New Cms Term'), ['controller' => 'CmsTerm', 'action' => 'add']) ?></li>
                <li><?= $this->Html->link(__('New Cms Term Relation'), ['controller' => 'CmsTermRelation', 'action' => 'add']) ?></li>

            </ul>
        </div>
    </div>
</div>
<!-- Index template -->
<div class="cmsTermTaxonomy thumbnail">
    <!-- Using datatables script for this table -->
    <script>
        $(document).ready(function () {
            $('#cmsTermTaxonomy-table').dataTable();
        });
    </script>
    <table id="cmsTermTaxonomy-table" class="table table-striped table-hover">
        <thead>
            <tr>
                <th class="check no-sorting">
                    <input id="checkall" class="" type="checkbox" name="" value="" />
                </th>
                <th><?= __('Id') ?></th>
                <th><?= __('Term') ?></th>
                <th><?= __('Taxonomy') ?></th>
                <th><?= __('Title') ?></th>
                <th><?= __('Count') ?></th>
                <th class="actions no-sorting"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $cmsTermTaxonomy): ?>
                <tr>
                    <td><input id="" type="checkbox" name="" value="" /></td>
                    <td><?= $this->Number->format($cmsTermTaxonomy->id) ?></td>
                    <td>
                        <?= $cmsTermTaxonomy->has('cms_term') ? $this->Html->link($cmsTermTaxonomy->cms_term->name, ['controller' => 'CmsTerm', 'action' => 'view', $cmsTermTaxonomy->cms_term->id]) : '' ?>
                    </td>
                    <td><?= h($cmsTermTaxonomy->taxonomy) ?></td>
                    <td><?= h($cmsTermTaxonomy->title) ?></td>
                    <td class="text-center"><span class="badge"><?= $this->Number->format($cmsTermTaxonomy->count) ?></span></td>
                    <td class="actions text-right">
                        <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', ['action' => 'view', $cmsTermTaxonomy->id], ['escape' => false, 'class' => 'btn btn-xs btn-default', 'title' => __('View')]) ?>
                        <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') . '</span>', ['action' => 'edit', $cmsTermTaxonomy->id], ['escape' => false, 'class' => 'btn btn-xs btn-default', 'title' => __('Edit')]) ?>
                        <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') . '</span>', ['action' => 'delete', $cmsTermTaxonomy->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cmsTermTaxonomy->id), 'escape' => false, 'class' => 'btn btn-xs btn-danger', 'title' => __('Delete')]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
