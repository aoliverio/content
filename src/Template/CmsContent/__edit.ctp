
<!-- Page title -->
<h1 class="page-header"><?= __('Edit Cms Content'); ?></h1>
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
                <li><?= $this->Html->link(__('View Cms Content'), ['action' => 'view', $cmsContent->id]) ?></li>
                <li><?=
                    $this->Form->postLink(
                            __('Delete Cms Content'), ['action' => 'delete', $cmsContent->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cmsContent->id)]
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
<!-- Form template -->
<div class="thumbnail">
<?= $this->Form->create($cmsContent) ?>
    <?php
    echo $this->Form->input('parent', ['label' => 'Parent', 'class' => 'form-control']);
    echo $this->Form->input('name', ['label' => 'Name', 'class' => 'form-control']);
    echo $this->Form->input('content_title', ['label' => 'Content Title', 'class' => 'form-control']);
    echo $this->Form->input('content_description', ['label' => 'Content Description', 'class' => 'form-control']);
    echo $this->Form->input('content_excerpt', ['label' => 'Content Excerpt', 'class' => 'form-control']);
    echo $this->Form->input('content_deadline', ['label' => 'Content Deadline', 'class' => 'form-control']);
    echo $this->Form->input('content_password', ['label' => 'Content Password', 'class' => 'form-control']);
    echo $this->Form->input('content_status', ['label' => 'Content Status', 'class' => 'form-control']);
    echo $this->Form->input('content_path', ['label' => 'Content Path', 'class' => 'form-control']);
    echo $this->Form->input('content_type', ['label' => 'Content Type', 'class' => 'form-control']);
    echo $this->Form->input('content_mime_type', ['label' => 'Content Mime Type', 'class' => 'form-control']);
    echo $this->Form->input('publish_start', ['label' => 'Publish Start', 'class' => 'form-control']);
    echo $this->Form->input('publish_end', ['label' => 'Publish End', 'class' => 'form-control']);
    echo $this->Form->input('author', ['label' => 'Author', 'class' => 'form-control']);
    echo $this->Form->input('order', ['label' => 'Order', 'class' => 'form-control']);
    ?>
    <hr/>
    <div id="view-navigation">
        <div class="text-right">
            <button class="btn btn-success" type="submit">Save</button>  
        </div>
    </div>
</form>
</div>