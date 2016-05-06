<?php
/**
 * Template setting
 */
$this->assign('title', __('List of News'));
?>
<!-- Actions bar -->
<div class="well well-sm">
    <div class="text-right">
        <small class="pull-left"><?= __('Navigation Bar:') ?></small>
        <?= $this->Html->link(__('Add News'), ['action' => 'add'], ['escape' => false, 'class' => 'btn btn-success', 'title' => __('Add News')]) ?>
    </div>
</div>
<!-- News panel -->
<div class="panel panel-default">
    <div class="panel-heading">
        <span class="pull-right">
            <small><?= __('Actions:'); ?></small>
            <a class="btn btn-xs" href="<?= $this->Url->build(['controller' => 'cmsContents', 'action' => 'filter']) ?>" data-toggle="modal" data-target="#myModal"><i class="fa fa-filter"></i> <?= __('Filter') ?></a>
            <a class="btn btn-xs" href="<?= $this->Url->build(['controller' => 'cmsContents', 'action' => 'add']) ?>" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> <?= __('Add') ?></a>
        </span>
        <h3 class="panel-title"><i class="fa fa-list"></i> <?= __('News'); ?></h3>
    </div>
    <div class="panel-body">
        <table id="cmsContent-table" class="table table-striped table-hover dataTable">
            <thead>
                <tr>
                    <th class="check no-sorting">
                        <input id="checkall" class="" type="checkbox" name="" value="" />
                    </th>
                    <th><?= __('Id') ?></th>
                    <th><?= __('Parent Id') ?></th>
                    <th><?= __('Name') ?></th>
                    <th><?= __('Content Title') ?></th>
                    <th><?= __('Content Expiry') ?></th>
                    <th><?= __('Content Password') ?></th>
                    <th><?= __('Cms Content Status Id') ?></th>
                    <th class="actions no-sorting"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $cmsContent): ?>
                    <tr>
                        <td class="check"><input id="" class="" type="checkbox" name="" value="" /></td>
                        <td><?= $this->Number->format($cmsContent->id) ?></td>
                        <td><?= $cmsContent->has('parent_cms_content') ? $this->Html->link($cmsContent->parent_cms_content->name, ['controller' => 'CmsContents', 'action' => 'view', $cmsContent->parent_cms_content->id]) : '' ?></td>
                        <td><?= h($cmsContent->name) ?></td>
                        <td><?= h($cmsContent->content_title) ?></td>
                        <td><?= h($cmsContent->content_expiry) ?></td>
                        <td><?= h($cmsContent->content_password) ?></td>
                        <td><?= $cmsContent->has('cms_content_statue') ? $this->Html->link($cmsContent->cms_content_statue->name, ['controller' => 'CmsContentStatues', 'action' => 'view', $cmsContent->cms_content_statue->id]) : '' ?></td>
                        <td class="actions text-right">
                            <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', ['controller' => 'cmsContents', 'action' => 'view', $cmsContent->id], ['escape' => false, 'class' => 'btn btn-xs btn-default', 'title' => __('View')]) ?>
                            <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') . '</span>', ['controller' => 'cmsContents', 'action' => 'edit', $cmsContent->id], ['escape' => false, 'class' => 'btn btn-xs btn-default', 'title' => __('Edit'), 'data-toggle' => 'modal', 'data-target' => '#myModal']) ?>
                            <?= $this->Html->link('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') . '</span>', ['controller' => 'cmsContents', 'action' => 'delete', $cmsContent->id], ['escape' => false, 'class' => 'btn btn-xs btn-danger', 'title' => __('Delete'), 'data-toggle' => 'modal', 'data-target' => '#myModal']) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>