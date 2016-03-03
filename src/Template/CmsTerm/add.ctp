
<!-- Page title -->
<h1 class="page-header"><?= __('Add Cms Term'); ?></h1>
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
                                <li><?= $this->Html->link(__('List Cms Term'), ['action' => 'index']) ?></li>
                                <li role="separator" class="divider"></li>
                <li><?= $this->Html->link(__('List Cms Permission'), ['controller' => 'CmsPermission', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('New Cms Permission'), ['controller' => 'CmsPermission', 'action' => 'add']) ?></li>
                            </ul>
        </div>
    </div>
</div>
<!-- Form template -->
<div class="thumbnail">
    <?= $this->Form->create($cmsTerm) ?>
    <?php
                echo $this->Form->input('name', ['label' => 'Name', 'class' => 'form-control']);
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