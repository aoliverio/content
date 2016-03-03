
<!-- Page title -->
<h1 class="page-header"><?= __('List of Cms Term'); ?></h1>
<!-- Actions bar -->
<div class="well well-sm">
    <div class="text-right">
        <small class="text-info pull-left"><?= __('Navigation Bar:') ?></small>
        <?= $this->Html->link(__('New Cms Term'), ['action' => 'add'], ['escape' => false, 'class' => 'btn btn-success', 'title' => __('New Cms Term')]) ?>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?= __('Actions') ?> <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><?= $this->Html->link(__('New Cms Term'), ['action' => 'add']) ?></li>
                <li><?= $this->Html->link(__('New Cms Permission'), ['controller' => 'CmsPermission', 'action' => 'add']) ?></li>

            </ul>
        </div>
    </div>
</div>
<!-- Index template -->
<div class="cmsTerm thumbnail">
    <!-- Using datatables script for this table -->
    <script>
        $(document).ready(function () {
            $('#cmsTerm-table').dataTable();
        });
    </script>
    <table id="cmsTerm-table" class="table table-striped table-hover">
        <thead>
            <tr>
                <th class="check no-sorting">
                    <input id="checkall" class="" type="checkbox" name="" value="" />
                </th>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Title') ?></th>
                <th class="actions no-sorting"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $cmsTerm): ?>
                <tr>
                    <td><input id="" class="check" type="checkbox" name="" value="" /></td>
                    <td><?= $this->Number->format($cmsTerm->id) ?></td>
                    <td><?= h($cmsTerm->name) ?></td>
                    <td><?= h($cmsTerm->title) ?></td>
                    <td class="actions text-right">
                        <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', ['action' => 'view', $cmsTerm->id], ['escape' => false, 'class' => 'btn btn-xs btn-default', 'title' => __('View')]) ?>
                        <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') . '</span>', ['action' => 'edit', $cmsTerm->id], ['escape' => false, 'class' => 'btn btn-xs btn-default', 'title' => __('Edit')]) ?>
                        <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') . '</span>', ['action' => 'delete', $cmsTerm->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cmsTerm->id), 'escape' => false, 'class' => 'btn btn-xs btn-danger', 'title' => __('Delete')]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
