<!-- Page title -->
<h1 class="page-header"><?= __('Details of Cms Term'); ?></h1>
<!-- Actions bar -->
<div class="well well-sm">
    <div class="text-right">
        <small class="text-info pull-left"><?= __('Navigation Bar:') ?></small>
        <?= $this->Html->link(__('List Cms Term'), ['action' => 'index'], ['escape' => false, 'class' => 'btn btn-success', 'title' => __('List Cms Term')]) ?>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?= __('Actions') ?> <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                                <li><?= $this->Html->link(__('Edit Cms Term'), ['action' => 'edit', $cmsTerm->id]) ?></li>
                <li><?=
                    $this->Form->postLink(
                    __('Delete Cms Term'),
                    ['action' => 'delete', $cmsTerm->id],
                    ['confirm' => __('Are you sure you want to delete # {0}?', $cmsTerm->id)]
                    )
                    ?>
                </li>
                                <li><?= $this->Html->link(__('List Cms Term'), ['action' => 'index']) ?></li>
                                <li role="separator" class="divider"></li>
                <li><?= $this->Html->link(__('List Cms Permission'), ['controller' => 'CmsPermission', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('New Cms Permission'), ['controller' => 'CmsPermission', 'action' => 'add']) ?></li>
                            </ul>
        </div>
    </div>
</div>
<!-- Grid template -->
<div class="thumbnail">
    <div class="row">
                <div class="col-md-6 columns strings">
                                    <label class="subheader"><?= __('Name') ?></label>
            <p><?= h($cmsTerm->name) ?></p>
            <hr/>
                                                <label class="subheader"><?= __('Title') ?></label>
            <p><?= h($cmsTerm->title) ?></p>
            <hr/>
                                </div>
                        <div class="col-md-2 columns numbers end">
                        <label class="subheader"><?= __('Id') ?></label>
            <p><?= $this->Number->format($cmsTerm->id) ?></p>
            <hr/>
                        <label class="subheader"><?= __('Created User') ?></label>
            <p><?= $this->Number->format($cmsTerm->created_user) ?></p>
            <hr/>
                        <label class="subheader"><?= __('Modified User') ?></label>
            <p><?= $this->Number->format($cmsTerm->modified_user) ?></p>
            <hr/>
                    </div>
                        <div class="col-md-2 columns dates end">
                        <label class="subheader"><?= __('Created') ?></label>
            <p><?= h($cmsTerm->created) ?></p>
            <hr/>
                        <label class="subheader"><?= __('Modified') ?></label>
            <p><?= h($cmsTerm->modified) ?></p>
            <hr/>
                    </div>
                    </div>
</div>
<div class="row texts">
    <div class="col-md-12 columns ">
        <label class="subheader"><?= __('Description') ?></label>
        <?= $this->Text->autoParagraph(h($cmsTerm->description)); ?>
        <hr/>
    </div>
</div>
<h3 class="page-header"><?= __('Related'); ?></h3>
<div id="view-related">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#cmsPermission" aria-controls="cmsPermission" role="tab" data-toggle="tab"><?= __('Related CmsPermission') ?></a></li>
            </ul>
    <!-- Tab panes -->
    <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="cmsPermission">
            <?php if (!empty($cmsTerm->cms_permission)): ?>
            <br/>
            <!-- Using datatables script for this table -->
            <script>
                $(document).ready(function () {
                    $('#cmsPermission-table').dataTable();
                });
            </script>
            <div class="thumbnail">
                <table id="cmsPermission-table" class="table table-striped table-hover">
                    <thead>
                        <tr>
                                                        <th><?= __('Id') ?></th>
                                                        <th><?= __('Cms Term Id') ?></th>
                                                        <th><?= __('Cms Content Id') ?></th>
                                                        <th><?= __('Sys User') ?></th>
                                                        <th><?= __('Sys Role') ?></th>
                                                        <th><?= __('Allow') ?></th>
                                                        <th><?= __('Created') ?></th>
                                                        <th><?= __('Created User') ?></th>
                                                        <th><?= __('Modified') ?></th>
                                                        <th><?= __('Modified User') ?></th>
                                                        <th class="actions no-sorting"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cmsTerm->cms_permission as $cmsPermission): ?>
                        <tr>
                            <td><?= h($cmsPermission->id) ?></td>
                            <td><?= h($cmsPermission->cms_term_id) ?></td>
                            <td><?= h($cmsPermission->cms_content_id) ?></td>
                            <td><?= h($cmsPermission->sys_user) ?></td>
                            <td><?= h($cmsPermission->sys_role) ?></td>
                            <td><?= h($cmsPermission->allow) ?></td>
                            <td><?= h($cmsPermission->created) ?></td>
                            <td><?= h($cmsPermission->created_user) ?></td>
                            <td><?= h($cmsPermission->modified) ?></td>
                            <td><?= h($cmsPermission->modified_user) ?></td>
                            <td class="actions text-right">
                                <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', ['controller' => 'CmsPermission', 'action' => 'view', $cmsPermission->id], ['escape' => false, 'class' => 'btn btn-xs btn-default', 'title' => __('View')]) ?>
                                <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">'. __('Edit') . '</span>', ['controller' => 'CmsPermission', 'action' => 'edit', $cmsPermission->id], ['escape' => false, 'class' => 'btn btn-xs btn-default', 'title' => __('Edit')]) ?>
                                <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') . '</span>', ['controller' => 'CmsPermission', 'action' => 'delete', $cmsPermission->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cmsPermission->id), 'escape' => false, 'class' => 'btn btn-xs btn-danger', 'title' => __('Delete')]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>    
        </div>
    </div>
    </div>
