<?php

/**
 * 
 */
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
use Cake\Utility\Text;
use Cake\I18n\Time;

/**
 * Get number of element
 */
$this->CmsContent = TableRegistry::get('Content.CmsContent');
$_number_of_page = $this->CmsContent->find('all')->where(['content_type' => 'page'])->count();
$_number_of_news = $this->CmsContent->find('all')->where(['content_type' => 'news'])->count();
$_number_of_attachments = $this->CmsContent->find('all')->where(['content_type' => 'attachments'])->count();
$_number_of_images = $this->CmsContent->find('all')->where(['content_type' => 'images'])->count();
$_number_of_taxonomy = TableRegistry::get('Content.CmsTermTaxonomy')->find('all')->count();
$_number_of_permissions = TableRegistry::get('Content.CmsPermission')->find('all')->count();

/**
 * Set title for Layout block
 */
$this->assign('title', __('Dashboard'));
?>
<div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab"><?= __('Main') ?></a></li>
        <li role="presentation"><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab"><?= __('Tables') ?></a></li>
    </ul>
    <br/>
    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="tab1">
            <div class="row">
                <div class="col-md-4">
                    <div class="well">
                        <h3 class="pull-right"><span class="label label-default"><?= $_number_of_page ?></span></h3>
                        <h2><i class="fa fa-file-text fa-fw"></i> <a href="<?= $this->Url->build(['controller' => 'page']) ?>"><?= __('Pages') ?></a></h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="well">
                        <h3 class="pull-right"><span class="label label-default"><?= $_number_of_news ?></span></h3>
                        <h2><i class="fa fa-newspaper-o fa-fw"></i> <a href="<?= $this->Url->build(['controller' => 'news']) ?>"><?= __('News') ?></a></h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="well">
                        <h3 class="pull-right"><span class="label label-default"><?= $_number_of_taxonomy ?></span></h3>
                        <h2><i class="fa fa-tags fa-fw"></i> <a href="<?= $this->Url->build(['controller' => 'cms_term_taxonomy']) ?>"><?= __('Taxonomy') ?></a></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="well">
                        <h3 class="pull-right"><span class="label label-default"><?= $_number_of_attachments ?></span></h3>
                        <h2><i class="fa fa-paperclip fa-fw"></i> <?= __('Attachments') ?></h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="well">
                        <h3 class="pull-right"><span class="label label-default"><?= $_number_of_images ?></span></h3>
                        <h2><i class="fa fa-picture-o fa-fw"></i> <?= __('Images') ?></h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="well">
                        <h3 class="pull-right"><span class="label label-default"><?= $_number_of_permissions ?></span></h3>
                        <h2><i class="fa fa-lock fa-fw"></i> <a href="<?= $this->Url->build(['controller' => 'cms_permission']) ?>">Permission</a></h2> 
                    </div>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="tab2">
            <h4><?= __('Working with tables') ?></h4>
            <p><?= __('If you want, you can work with database tables directly.') ?></p>
            <hr/>
            <div class="well">
                <a href="<?= $this->Url->build(['controller' => 'cms_content']); ?>">CMS CONTENT</a> - <?= __('They are all web content') ?>
            </div>
            <div class="well">
                <a href="<?= $this->Url->build(['controller' => 'cms_content_meta']); ?>">CMS CONTENT META</a> - <?= __('It adds meta information to the Content.') ?>
            </div>
            <div class="well">
                <a href="<?= $this->Url->build(['controller' => 'cms_term']); ?>">CMS TERM</a> - <?= __('Organize contents according to categories.') ?>
            </div>
            <div class="well">
                <a href="<?= $this->Url->build(['controller' => 'cms_term_taxonomy']); ?>">CMS TERM TAXONOMY</a> - <?= __('Taxonomies to classify web content.') ?>
            </div>
            <div class="well">
                <a href="<?= $this->Url->build(['controller' => 'cms_term_relation']); ?>">CMS TERM RELATION</a> - <?= __('Associate content to taxonomy.') ?>
            </div>
            <div class="well">
                <a href="<?= $this->Url->build(['controller' => 'cms_permission']); ?>">CMS PERMISSION</a> - <?= __('Managing permissions on content.') ?>
            </div> 
        </div>
    </div>
</div>
