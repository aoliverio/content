
<!-- Page title -->
<h1 class="page-header"><?= __('List of Cms Content Meta'); ?></h1>
<!-- Actions bar -->
<div class="well well-sm">
    <div class="text-right">
        <small class="text-info pull-left"><?= __('Navigation Bar:') ?></small>
        <?= $this->Html->link(__('New Cms Content Meta'), ['action' => 'add'], ['escape' => false, 'class' => 'btn btn-success', 'title' => __('New Cms Content Meta')]) ?>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?= __('Actions') ?> <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><?= $this->Html->link(__('New Cms Content Meta'), ['action' => 'add']) ?></li>
                                <li><?= $this->Html->link(__('New Cms Content'), ['controller' => 'CmsContent', 'action' => 'add']) ?></li>
                    
            </ul>
        </div>
    </div>
</div>
<!-- Index template -->
<div class="cmsContentMeta thumbnail">
    <!-- Using datatables script for this table -->
    <script>
        $(document).ready(function () {
            $('#cmsContentMeta-table').dataTable();
        });
    </script>
    <table id="cmsContentMeta-table" class="table table-striped table-hover">
        <thead>
            <tr>
                <th class="check no-sorting">
                    <input id="checkall" class="" type="checkbox" name="" value="" />
                </th>
                                <th><?= __('Id') ?></th>
                                <th><?= __('Cms Content Id') ?></th>
                                <th><?= __('Meta Key') ?></th>
                                <th><?= __('Priority') ?></th>
                                <th><?= __('Created') ?></th>
                                <th><?= __('Created User') ?></th>
                                <th><?= __('Modified') ?></th>
                                <th class="actions no-sorting"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $cmsContentMeta): ?>
            <tr>
                <td><input id="" class="check" type="checkbox" name="" value="" /></td>
                                <td><?= $this->Number->format($cmsContentMeta->id) ?></td>
                                <td>
                    <?= $cmsContentMeta->has('cms_content') ? $this->Html->link($cmsContentMeta->cms_content->name, ['controller' => 'CmsContent', 'action' => 'view', $cmsContentMeta->cms_content->id]) : '' ?>
                </td>
                                <td><?= h($cmsContentMeta->meta_key) ?></td>
                                <td><?= $this->Number->format($cmsContentMeta->priority) ?></td>
                                <td><?= h($cmsContentMeta->created) ?></td>
                                <td><?= $this->Number->format($cmsContentMeta->created_user) ?></td>
                                <td><?= h($cmsContentMeta->modified) ?></td>
                                <td class="actions text-right">
                    <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', ['action' => 'view', $cmsContentMeta->id], ['escape' => false, 'class' => 'btn btn-xs btn-default', 'title' => __('View')]) ?>
                    <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') . '</span>', ['action' => 'edit', $cmsContentMeta->id], ['escape' => false, 'class' => 'btn btn-xs btn-default', 'title' => __('Edit')]) ?>
                    <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') . '</span>', ['action' => 'delete', $cmsContentMeta->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cmsContentMeta->id), 'escape' => false, 'class' => 'btn btn-xs btn-danger', 'title' => __('Delete')]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
