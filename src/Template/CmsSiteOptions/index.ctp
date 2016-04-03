<div class="panel panel-default">
    <div class="panel-heading">
        <span class="pull-right">
            <small><?= __('Actions:'); ?></small>
            <a class="btn btn-xs" href="<?= $this->Url->build(['controller' => 'cmsSiteOptions', 'action' => 'filter']) ?>" data-toggle="modal" data-target="#myModal"><i class="fa fa-filter"></i> <?= __('Filter') ?></a>
            <a class="btn btn-xs" href="<?= $this->Url->build(['controller' => 'cmsSiteOptions', 'action' => 'add']) ?>" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> <?= __('Add') ?></a>
        </span>
        <h3 class="panel-title"><i class="fa fa-list"></i> <?= __('Cms Site Options'); ?></h3>
    </div>
    <div class="panel-body">
        <table id="cmsSiteOption-table" class="table table-striped table-hover dataTable">
            <thead>
                <tr>
                    <th class="check no-sorting">
                        <input id="checkall" class="" type="checkbox" name="" value="" />
                    </th>
                    <th><?= __('Id') ?></th>
                    <th><?= __('Cms Site Id') ?></th>
                    <th><?= __('Option Key') ?></th>
                    <th><?= __('Menu Order') ?></th>
                    <th class="actions no-sorting"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $cmsSiteOption): ?>
                    <tr>
                        <td class="check"><input id="" class="" type="checkbox" name="" value="" /></td>
                        <td><?= $this->Number->format($cmsSiteOption->id) ?></td>
                        <td><?= $cmsSiteOption->has('cms_site') ? $this->Html->link($cmsSiteOption->cms_site->name, ['controller' => 'CmsSites', 'action' => 'view', $cmsSiteOption->cms_site->id]) : '' ?></td>
                        <td><?= h($cmsSiteOption->option_key) ?></td>
                        <td><?= $this->Number->format($cmsSiteOption->menu_order) ?></td>
                        <td class="actions text-right">
                            <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', ['controller' => 'cmsSiteOptions', 'action' => 'view', $cmsSiteOption->id], ['escape' => false, 'class' => 'btn btn-xs btn-default', 'title' => __('View')]) ?>
                            <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') . '</span>', ['controller' => 'cmsSiteOptions', 'action' => 'edit', $cmsSiteOption->id], ['escape' => false, 'class' => 'btn btn-xs btn-default', 'title' => __('Edit'), 'data-toggle' => 'modal', 'data-target' => '#myModal']) ?>
                            <?= $this->Html->link('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') . '</span>', ['controller' => 'cmsSiteOptions', 'action' => 'delete', $cmsSiteOption->id], ['escape' => false, 'class' => 'btn btn-xs btn-danger', 'title' => __('Delete'), 'data-toggle' => 'modal', 'data-target' => '#myModal']) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
