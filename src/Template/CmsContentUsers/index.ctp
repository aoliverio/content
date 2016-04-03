<div class="panel panel-default">
    <div class="panel-heading">
        <span class="pull-right">
            <small><?= __('Actions:'); ?></small>
            <a class="btn btn-xs" href="<?= $this->Url->build(['controller' => 'cmsContentUsers', 'action' => 'filter']) ?>" data-toggle="modal" data-target="#myModal"><i class="fa fa-filter"></i> <?= __('Filter') ?></a>
            <a class="btn btn-xs" href="<?= $this->Url->build(['controller' => 'cmsContentUsers', 'action' => 'add']) ?>" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> <?= __('Add') ?></a>
        </span>
        <h3 class="panel-title"><i class="fa fa-list"></i> <?= __('Cms Content Users'); ?></h3>
    </div>
    <div class="panel-body">
        <table id="cmsContentUser-table" class="table table-striped table-hover dataTable">
            <thead>
                <tr>
                    <th class="check no-sorting">
                        <input id="checkall" class="" type="checkbox" name="" value="" />
                    </th>
                    <th><?= __('Id') ?></th>
                    <th><?= __('Cms Contents Id') ?></th>
                    <th><?= __('Users Id') ?></th>
                    <th class="actions no-sorting"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $cmsContentUser): ?>
                    <tr>
                        <td class="check"><input id="" class="" type="checkbox" name="" value="" /></td>
                        <td><?= $this->Number->format($cmsContentUser->id) ?></td>
                        <td><?= $cmsContentUser->has('cms_content') ? $this->Html->link($cmsContentUser->cms_content->name, ['controller' => 'CmsContents', 'action' => 'view', $cmsContentUser->cms_content->id]) : '' ?></td>
                        <td><?= $cmsContentUser->has('user') ? $this->Html->link($cmsContentUser->user->name, ['controller' => 'Users', 'action' => 'view', $cmsContentUser->user->id]) : '' ?></td>
                        <td class="actions text-right">
                            <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', ['controller' => 'cmsContentUsers', 'action' => 'view', $cmsContentUser->id], ['escape' => false, 'class' => 'btn btn-xs btn-default', 'title' => __('View')]) ?>
                            <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') . '</span>', ['controller' => 'cmsContentUsers', 'action' => 'edit', $cmsContentUser->id], ['escape' => false, 'class' => 'btn btn-xs btn-default', 'title' => __('Edit'), 'data-toggle' => 'modal', 'data-target' => '#myModal']) ?>
                            <?= $this->Html->link('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') . '</span>', ['controller' => 'cmsContentUsers', 'action' => 'delete', $cmsContentUser->id], ['escape' => false, 'class' => 'btn btn-xs btn-danger', 'title' => __('Delete'), 'data-toggle' => 'modal', 'data-target' => '#myModal']) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
