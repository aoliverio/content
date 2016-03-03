
<!-- Page title -->
<h1 class="page-header"><?= __('Edit Cms Term Taxonomy'); ?></h1>
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
                <li><?= $this->Html->link(__('View Cms Term Taxonomy'), ['action' => 'view', $cmsTermTaxonomy->id]) ?></li>
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
<!-- Form template -->
<div class="thumbnail">
    <?= $this->Form->create($cmsTermTaxonomy) ?>
    <?php
    echo $this->Form->input('cms_term_id', ['options' => $cmsTerm, 'label' => 'Term', 'class' => 'form-control']);
    echo $this->Form->input('taxonomy', ['options' => $taxonomy_options, 'label' => 'Taxonomy', 'class' => 'form-control']);
    echo $this->Form->input('title', ['label' => 'Title', 'class' => 'form-control']);
    echo $this->Form->input('description', ['label' => 'Description', 'class' => 'form-control']);
    ?>
    <hr/>
    <div id="view-navigation">
        <div class="text-right">
            <button class="btn btn-success" type="submit">Save</button>  
        </div>
    </div>
</form>
</div>