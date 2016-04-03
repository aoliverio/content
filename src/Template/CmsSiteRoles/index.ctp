<div class="panel panel-default">
    <div class="panel-heading">
        <span class="pull-right">
            <small><?= __('Actions:'); ?></small>
            <a class="btn btn-xs" href="<?= $this->Url->build(['controller' => 'cmsSiteRoles', 'action' => 'filter']) ?>" data-toggle="modal" data-target="#myModal"><i class="fa fa-filter"></i> <?= __('Filter') ?></a>
            <a class="btn btn-xs" href="<?= $this->Url->build(['controller' => 'cmsSiteRoles', 'action' => 'add']) ?>" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> <?= __('Add') ?></a>
        </span>
        <h3 class="panel-title"><i class="fa fa-list"></i> <?= __('Cms Site Roles'); ?></h3>
    </div>
    <div class="panel-body">
        <table id="cmsSiteRole-table" class="table table-striped table-hover dataTable">
            <thead>
                <tr>
                    <th class="check no-sorting">
                        <input id="checkall" class="" type="checkbox" name="" value="" />
                    </th>
                    <th><?= __('Id') ?></th>
                    <th><?= __('Cms Sites Id') ?></th>
                    <th><?= __('Roles Id') ?></th>
                    <th class="actions no-sorting"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $cmsSiteRole): ?>
                    <tr>
                        <td class="check"><input id="" class="" type="checkbox" name="" value="" /></td>
                        <td><?= $this->Number->format($cmsSiteRole->id) ?></td>
                        <td><?= $cmsSiteRole->has('cms_site') ? $this->Html->link($cmsSiteRole->cms_site->name, ['controller' => 'CmsSites', 'action' => 'view', $cmsSiteRole->cms_site->id]) : '' ?></td>
                        <td><?= $cmsSiteRole->has('role') ? $this->Html->link($cmsSiteRole->role->name, ['controller' => 'Roles', 'action' => 'view', $cmsSiteRole->role->id]) : '' ?></td>
                        <td class="actions text-right">
                            <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', ['controller' => 'cmsSiteRoles', 'action' => 'view', $cmsSiteRole->id], ['escape' => false, 'class' => 'btn btn-xs btn-default', 'title' => __('View')]) ?>
                            <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') . '</span>', ['controller' => 'cmsSiteRoles', 'action' => 'edit', $cmsSiteRole->id], ['escape' => false, 'class' => 'btn btn-xs btn-default', 'title' => __('Edit'), 'data-toggle' => 'modal', 'data-target' => '#myModal']) ?>
                            <?= $this->Html->link('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') . '</span>', ['controller' => 'cmsSiteRoles', 'action' => 'delete', $cmsSiteRole->id], ['escape' => false, 'class' => 'btn btn-xs btn-danger', 'title' => __('Delete'), 'data-toggle' => 'modal', 'data-target' => '#myModal']) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
