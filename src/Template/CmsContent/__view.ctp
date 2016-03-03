<!-- Page title -->
<h1 class="page-header"><?= __('Details of Cms Content'); ?></h1>
<!-- Actions bar -->
<div class="well well-sm">
    <div class="text-right">
        <small class="text-info pull-left"><?= __('Navigation Bar:') ?></small>
        <?= $this->Html->link(__('List Cms Content'), ['action' => 'index'], ['escape' => false, 'class' => 'btn btn-success', 'title' => __('List Cms Content')]) ?>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?= __('Actions') ?> <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                                <li><?= $this->Html->link(__('Edit Cms Content'), ['action' => 'edit', $cmsContent->id]) ?></li>
                <li><?=
                    $this->Form->postLink(
                    __('Delete Cms Content'),
                    ['action' => 'delete', $cmsContent->id],
                    ['confirm' => __('Are you sure you want to delete # {0}?', $cmsContent->id)]
                    )
                    ?>
                </li>
                                <li><?= $this->Html->link(__('List Cms Content'), ['action' => 'index']) ?></li>
                                <li role="separator" class="divider"></li>
                <li><?= $this->Html->link(__('List Cms Permission'), ['controller' => 'CmsPermission', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('New Cms Permission'), ['controller' => 'CmsPermission', 'action' => 'add']) ?></li>
                                <li role="separator" class="divider"></li>
                <li><?= $this->Html->link(__('List Cms Term Relation'), ['controller' => 'CmsTermRelation', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('New Cms Term Relation'), ['controller' => 'CmsTermRelation', 'action' => 'add']) ?></li>
                            </ul>
        </div>
    </div>
</div>
<!-- Grid template -->
<div class="thumbnail">
    <div class="row">
                <div class="col-md-6 columns strings">
                                    <label class="subheader"><?= __('Name') ?></label>
            <p><?= h($cmsContent->name) ?></p>
            <hr/>
                                                <label class="subheader"><?= __('Content Title') ?></label>
            <p><?= h($cmsContent->content_title) ?></p>
            <hr/>
                                                <label class="subheader"><?= __('Content Password') ?></label>
            <p><?= h($cmsContent->content_password) ?></p>
            <hr/>
                                                <label class="subheader"><?= __('Content Status') ?></label>
            <p><?= h($cmsContent->content_status) ?></p>
            <hr/>
                                                <label class="subheader"><?= __('Content Path') ?></label>
            <p><?= h($cmsContent->content_path) ?></p>
            <hr/>
                                                <label class="subheader"><?= __('Content Type') ?></label>
            <p><?= h($cmsContent->content_type) ?></p>
            <hr/>
                                                <label class="subheader"><?= __('Content Mime Type') ?></label>
            <p><?= h($cmsContent->content_mime_type) ?></p>
            <hr/>
                                </div>
                        <div class="col-md-2 columns numbers end">
                        <label class="subheader"><?= __('Id') ?></label>
            <p><?= $this->Number->format($cmsContent->id) ?></p>
            <hr/>
                        <label class="subheader"><?= __('Parent') ?></label>
            <p><?= $this->Number->format($cmsContent->parent) ?></p>
            <hr/>
                        <label class="subheader"><?= __('Author') ?></label>
            <p><?= $this->Number->format($cmsContent->author) ?></p>
            <hr/>
                        <label class="subheader"><?= __('Order') ?></label>
            <p><?= $this->Number->format($cmsContent->order) ?></p>
            <hr/>
                        <label class="subheader"><?= __('Created User') ?></label>
            <p><?= $this->Number->format($cmsContent->created_user) ?></p>
            <hr/>
                        <label class="subheader"><?= __('Modified User') ?></label>
            <p><?= $this->Number->format($cmsContent->modified_user) ?></p>
            <hr/>
                    </div>
                        <div class="col-md-2 columns dates end">
                        <label class="subheader"><?= __('Content Deadline') ?></label>
            <p><?= h($cmsContent->content_deadline) ?></p>
            <hr/>
                        <label class="subheader"><?= __('Publish Start') ?></label>
            <p><?= h($cmsContent->publish_start) ?></p>
            <hr/>
                        <label class="subheader"><?= __('Publish End') ?></label>
            <p><?= h($cmsContent->publish_end) ?></p>
            <hr/>
                        <label class="subheader"><?= __('Created') ?></label>
            <p><?= h($cmsContent->created) ?></p>
            <hr/>
                        <label class="subheader"><?= __('Modified') ?></label>
            <p><?= h($cmsContent->modified) ?></p>
            <hr/>
                    </div>
                    </div>
</div>
<div class="row texts">
    <div class="col-md-12 columns ">
        <label class="subheader"><?= __('Content Description') ?></label>
        <?= $this->Text->autoParagraph(h($cmsContent->content_description)); ?>
        <hr/>
    </div>
</div>
<div class="row texts">
    <div class="col-md-12 columns ">
        <label class="subheader"><?= __('Content Excerpt') ?></label>
        <?= $this->Text->autoParagraph(h($cmsContent->content_excerpt)); ?>
        <hr/>
    </div>
</div>
<h3 class="page-header"><?= __('Related'); ?></h3>
<div id="view-related">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#cmsPermission" aria-controls="cmsPermission" role="tab" data-toggle="tab"><?= __('Related CmsPermission') ?></a></li>
                <li role="presentation" class="active"><a href="#cmsTermRelation" aria-controls="cmsTermRelation" role="tab" data-toggle="tab"><?= __('Related CmsTermRelation') ?></a></li>
            </ul>
    <!-- Tab panes -->
    <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="cmsPermission">
            <?php if (!empty($cmsContent->cms_permission)): ?>
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
                        <?php foreach ($cmsContent->cms_permission as $cmsPermission): ?>
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
            <div role="tabpanel" class="tab-pane active" id="cmsTermRelation">
            <?php if (!empty($cmsContent->cms_term_relation)): ?>
            <br/>
            <!-- Using datatables script for this table -->
            <script>
                $(document).ready(function () {
                    $('#cmsTermRelation-table').dataTable();
                });
            </script>
            <div class="thumbnail">
                <table id="cmsTermRelation-table" class="table table-striped table-hover">
                    <thead>
                        <tr>
                                                        <th><?= __('Id') ?></th>
                                                        <th><?= __('Cms Term Taxonomy Id') ?></th>
                                                        <th><?= __('Cms Content Id') ?></th>
                                                        <th><?= __('Order') ?></th>
                                                        <th><?= __('Created') ?></th>
                                                        <th><?= __('Created User') ?></th>
                                                        <th><?= __('Modified') ?></th>
                                                        <th><?= __('Modified User') ?></th>
                                                        <th class="actions no-sorting"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cmsContent->cms_term_relation as $cmsTermRelation): ?>
                        <tr>
                            <td><?= h($cmsTermRelation->id) ?></td>
                            <td><?= h($cmsTermRelation->cms_term_taxonomy_id) ?></td>
                            <td><?= h($cmsTermRelation->cms_content_id) ?></td>
                            <td><?= h($cmsTermRelation->order) ?></td>
                            <td><?= h($cmsTermRelation->created) ?></td>
                            <td><?= h($cmsTermRelation->created_user) ?></td>
                            <td><?= h($cmsTermRelation->modified) ?></td>
                            <td><?= h($cmsTermRelation->modified_user) ?></td>
                            <td class="actions text-right">
                                <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', ['controller' => 'CmsTermRelation', 'action' => 'view', $cmsTermRelation->id], ['escape' => false, 'class' => 'btn btn-xs btn-default', 'title' => __('View')]) ?>
                                <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">'. __('Edit') . '</span>', ['controller' => 'CmsTermRelation', 'action' => 'edit', $cmsTermRelation->id], ['escape' => false, 'class' => 'btn btn-xs btn-default', 'title' => __('Edit')]) ?>
                                <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') . '</span>', ['controller' => 'CmsTermRelation', 'action' => 'delete', $cmsTermRelation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cmsTermRelation->id), 'escape' => false, 'class' => 'btn btn-xs btn-danger', 'title' => __('Delete')]) ?>
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
