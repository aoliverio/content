
<!-- Page title -->
<h1 class="page-header"><?= __('Edit Cms Content Meta'); ?></h1>
<!-- Actions bar -->
<div class="well well-sm">
    <div class="text-right">
        <small class="text-info pull-left"><?= __('Navigation Bar:') ?></small>
        <?= $this->Html->link(__('List Cms Content Meta'), ['action' => 'index'], ['escape' => false, 'class' => 'btn btn-success', 'title' => __('List Cms Content Meta')]) ?>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?= __('Actions') ?> <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                                <li><?= $this->Html->link(__('View Cms Content Meta'), ['action' => 'view', $cmsContentMeta->id]) ?></li>
                <li><?=
                    $this->Form->postLink(
                    __('Delete Cms Content Meta'),
                    ['action' => 'delete', $cmsContentMeta->id],
                    ['confirm' => __('Are you sure you want to delete # {0}?', $cmsContentMeta->id)]
                    )
                    ?>
                </li>
                                <li><?= $this->Html->link(__('List Cms Content Meta'), ['action' => 'index']) ?></li>
                                <li role="separator" class="divider"></li>
                <li><?= $this->Html->link(__('List Cms Content'), ['controller' => 'CmsContent', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('New Cms Content'), ['controller' => 'CmsContent', 'action' => 'add']) ?></li>
                            </ul>
        </div>
    </div>
</div>
<!-- Form template -->
<div class="thumbnail">
    <?= $this->Form->create($cmsContentMeta) ?>
    <?php
                echo $this->Form->input('cms_content_id', ['options' => $cmsContent, 'label' => 'Cms Content Id', 'class' => 'form-control']);
                            echo $this->Form->input('meta_key', ['label' => 'Meta Key', 'class' => 'form-control']);
                            echo $this->Form->input('meta_value', ['label' => 'Meta Value', 'class' => 'form-control']);
                            echo $this->Form->input('priority', ['label' => 'Priority', 'class' => 'form-control']);
                    ?>
    <hr/>
    <div id="view-navigation">
        <div class="text-right">
            <button class="btn btn-success" type="submit">Save</button>  
        </div>
    </div>
    </form>
</div>