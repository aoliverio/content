<!-- Page title -->
<h1 class="page-header"><?= __('Details of Cms Term Taxonomy'); ?></h1>
<!-- Actions bar -->
<div class="well well-sm">
    <div class="text-right">
        <small class="text-info pull-left"><?= __('Navigation Bar:') ?></small>
        <?= $this->Html->link(__('List Cms Term Taxonomy'), ['action' => 'index'], ['escape' => false, 'class' => 'btn btn-success', 'title' => __('List Cms Term Taxonomy')]) ?>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?= __('Actions') ?> <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><?= $this->Html->link(__('Edit Cms Term Taxonomy'), ['action' => 'edit', $cmsTermTaxonomy->id]) ?></li>
                <li><?=
                    $this->Form->postLink(
                            __('Delete Cms Term Taxonomy'), ['action' => 'delete', $cmsTermTaxonomy->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cmsTermTaxonomy->id)]
                    )
                    ?>
                </li>
                <li><?= $this->Html->link(__('List Cms Term Taxonomy'), ['action' => 'index']) ?></li>
                <li role="separator" class="divider"></li>
                <li><?= $this->Html->link(__('List Cms Term'), ['controller' => 'CmsTerm', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('New Cms Term'), ['controller' => 'CmsTerm', 'action' => 'add']) ?></li>
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
            <label class="subheader"><?= __('Cms Term') ?></label>
            <p><?= $cmsTermTaxonomy->has('cms_term') ? $this->Html->link($cmsTermTaxonomy->cms_term->name, ['controller' => 'CmsTerm', 'action' => 'view', $cmsTermTaxonomy->cms_term->id]) : '' ?></p>
            <label class="subheader"><?= __('Title') ?></label>
            <p><?= h($cmsTermTaxonomy->title) ?></p>
            <hr/>
        </div>
        <div class="col-md-2 columns numbers end">
            <label class="subheader"><?= __('Id') ?></label>
            <p><?= $this->Number->format($cmsTermTaxonomy->id) ?></p>
            <hr/>
            <label class="subheader"><?= __('Parent') ?></label>
            <p><?= $this->Number->format($cmsTermTaxonomy->parent) ?></p>
            <hr/>
            <label class="subheader"><?= __('Count') ?></label>
            <p><?= $this->Number->format($cmsTermTaxonomy->count) ?></p>
            <hr/>
            <label class="subheader"><?= __('Created User') ?></label>
            <p><?= $this->Number->format($cmsTermTaxonomy->created_user) ?></p>
            <hr/>
            <label class="subheader"><?= __('Modified User') ?></label>
            <p><?= $this->Number->format($cmsTermTaxonomy->modified_user) ?></p>
            <hr/>
        </div>
        <div class="col-md-2 columns dates end">
            <label class="subheader"><?= __('Created') ?></label>
            <p><?= h($cmsTermTaxonomy->created) ?></p>
            <hr/>
            <label class="subheader"><?= __('Modified') ?></label>
            <p><?= h($cmsTermTaxonomy->modified) ?></p>
            <hr/>
        </div>
    </div>
</div>
<div class="row texts">
    <div class="col-md-12 columns ">
        <label class="subheader"><?= __('Taxonomy') ?></label>
<?= $this->Text->autoParagraph(h($cmsTermTaxonomy->taxonomy)); ?>
        <hr/>
    </div>
</div>
<div class="row texts">
    <div class="col-md-12 columns ">
        <label class="subheader"><?= __('Description') ?></label>
<?= $this->Text->autoParagraph(h($cmsTermTaxonomy->description)); ?>
        <hr/>
    </div>
</div>
<h3 class="page-header"><?= __('Related'); ?></h3>
<div id="view-related">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#cmsTermRelation" aria-controls="cmsTermRelation" role="tab" data-toggle="tab"><?= __('Related CmsTermRelation') ?></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="cmsTermRelation">
<?php if (!empty($cmsTermTaxonomy->cms_term_relation)): ?>
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
    <?php foreach ($cmsTermTaxonomy->cms_term_relation as $cmsTermRelation): ?>
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
                                        <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit') . '</span>', ['controller' => 'CmsTermRelation', 'action' => 'edit', $cmsTermRelation->id], ['escape' => false, 'class' => 'btn btn-xs btn-default', 'title' => __('Edit')]) ?>
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
