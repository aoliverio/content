
<!-- Page title -->
<h1 class="page-header"><?= __('List of Cms Permission'); ?></h1>
<!-- Actions bar -->
<div class="well well-sm">
    <div class="text-right">
        <small class="text-info pull-left"><?= __('Navigation Bar:') ?></small>
        <?= $this->Html->link(__('New Cms Permission'), ['action' => 'add'], ['escape' => false, 'class' => 'btn btn-success', 'title' => __('New Cms Permission')]) ?>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?= __('Actions') ?> <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><?= $this->Html->link(__('New Cms Permission'), ['action' => 'add']) ?></li>
                <li><?= $this->Html->link(__('New Cms Term'), ['controller' => 'CmsTerm', 'action' => 'add']) ?></li>
                <li><?= $this->Html->link(__('New Cms Content'), ['controller' => 'CmsContent', 'action' => 'add']) ?></li>

            </ul>
        </div>
    </div>
</div>
<!-- Index template -->
<div class="cmsPermission thumbnail">
    <!-- Using datatables script for this table -->
    <script>
        $(document).ready(function () {
            $('#cmsPermission-table').dataTable();
        });
    </script>
    <table id="cmsPermission-table" class="table table-striped table-hover">
        <thead>
            <tr>
                <th class="check no-sorting">
                    <input id="checkall" class="" type="checkbox" name="" value="" />
                </th>
                <th><?= __('Id') ?></th>
                <th><?= __('Cms Term Id') ?></th>
                <th><?= __('Cms Content Id') ?></th>
                <th><?= __('Sys User') ?></th>
                <th><?= __('Sys Role') ?></th>
                <th><?= __('Allow') ?></th>
                <th><?= __('Created') ?></th>
                <th class="actions no-sorting"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $cmsPermission): ?>
                <tr>
                    <td><input id="" class="check" type="checkbox" name="" value="" /></td>
                    <td><?= $this->Number->format($cmsPermission->id) ?></td>
                    <td>
                        <?= $cmsPermission->has('cms_term') ? $this->Html->link($cmsPermission->cms_term->name, ['controller' => 'CmsTerm', 'action' => 'view', $cmsPermission->cms_term->id]) : '' ?>
                    </td>
                    <td>
                        <?= $cmsPermission->has('cms_content') ? $this->Html->link($cmsPermission->cms_content->name, ['controller' => 'CmsContent', 'action' => 'view', $cmsPermission->cms_content->id]) : '' ?>
                    </td>
                    <td><?= $this->Number->format($cmsPermission->sys_user) ?></td>
                    <td><?= $this->Number->format($cmsPermission->sys_role) ?></td>
                    <td><?= h($cmsPermission->allow) ?></td>
                    <td><?= h($cmsPermission->created) ?></td>
                    <td class="actions text-right">
                        <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', ['action' => 'view', $cmsPermission->id], ['escape' => false, 'class' => 'btn btn-xs btn-default', 'title' => __('View')]) ?>
                        <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') . '</span>', ['action' => 'edit', $cmsPermission->id], ['escape' => false, 'class' => 'btn btn-xs btn-default', 'title' => __('Edit')]) ?>
                        <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') . '</span>', ['action' => 'delete', $cmsPermission->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cmsPermission->id), 'escape' => false, 'class' => 'btn btn-xs btn-danger', 'title' => __('Delete')]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
