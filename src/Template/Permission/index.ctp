<?php
$data = array();
?>

<h1 class="page-header"><?= __('Manage Permits'); ?></h1>

<div class="well well-sm">
    <div class="pull-right">
        <input type="submit" class="btn btn-primary" value="<?= __('Filter'); ?>">
        <input type="submit" class="btn btn-success" value="<?= __('Add new Rule'); ?>">
    </div>
    <h4><?= __('Permits Bar'); ?></h4>
    <div class="row">
        <div class="col-md-6">
            <label><?= __('Term'); ?></label>
            <select class="form-control">
                <option></option>
            </select>
            <label><?= __('Content'); ?></label>
            <select class="form-control">
                <option></option>
            </select>
        </div>
        <div class="col-md-6">
            <label><?= __('Role'); ?></label>
            <select class="form-control">
                <option></option>
            </select>
            <label><?= __('User'); ?></label>
            <select class="form-control">
                <option></option>
            </select>
        </div>
    </div>
    <br/>
</div>

<h4 class="page-header"><?= __('Permits Result'); ?></h4>
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
                <th><?= __('Cms Term Id') ?></th>
                <th><?= __('Cms Content Id') ?></th>
                <th><?= __('Sys Role') ?></th>
                <th><?= __('Sys User') ?></th>
                <th><?= __('Allow') ?></th>
                <th class="actions no-sorting"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $cmsPermission): ?>
                <tr>
                    <td>
                        <?= $cmsPermission->has('cms_term') ? $this->Html->link($cmsPermission->cms_term->name, ['controller' => 'CmsTerm', 'action' => 'view', $cmsPermission->cms_term->id]) : '' ?>
                    </td>
                    <td>
                        <?= $cmsPermission->has('cms_content') ? $this->Html->link($cmsPermission->cms_content->name, ['controller' => 'CmsContent', 'action' => 'view', $cmsPermission->cms_content->id]) : '' ?>
                    </td>
                    <td><?= $this->Number->format($cmsPermission->sys_role) ?></td>
                    <td><?= $this->Number->format($cmsPermission->sys_user) ?></td>
                    <td><?= h($cmsPermission->allow) ?></td>
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
