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
$this->CmsContents = TableRegistry::get('Content.CmsContents');
$_number_of_page = $this->CmsContents->find('all')->where(['cms_content_type_id' => 1, 'cms_site_id' => 1])->count();
$_number_of_news = $this->CmsContents->find('all')->where(['cms_content_type_id' => 2, 'cms_site_id' => 1])->count();
$_number_of_attachments = $this->CmsContents->find('all')->where(['cms_content_type_id' => 3, 'cms_site_id' => 1])->count();
$_number_of_images = $this->CmsContents->find('all')->where(['cms_content_type_id' => 4, 'cms_site_id' => 1])->count();
$_number_of_terms = TableRegistry::get('Content.CmsTerms')->find('all')->count();
$_number_of_permissions = 0;

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
            <!-- Site selector -->
            <div class="alert alert-info">
                <div class="row">
                    <div class="col-md-6">
                        <h2><i class="fa fa-globe fa-fw"></i> <?= __('Sites'); ?></h2>
                    </div>
                    <div class="col-md-6">
                        <label><?= __('Current website:'); ?></label>
                        <?= $this->Form->create(); ?>
                        <select name="current_site_id" class="form-control" onchange="this.form.submit()">
                            <?php foreach ($site_selector as $key => $value) : ?>
                                <?php $selected = ($this->request->session()->read('Content.currentSiteId') == $key) ? ' selected' : ''; ?>
                                <option value="<?= $key; ?>"<?= $selected; ?>><?= $value; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= $this->Form->end(); ?>
                    </div>
                </div>
            </div>
            <!-- Contents overview -->
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
                        <h3 class="pull-right"><span class="label label-default"><?= $_number_of_terms ?></span></h3>
                        <h2><i class="fa fa-tags fa-fw"></i> <a href="<?= $this->Url->build(['controller' => 'cms_terms']) ?>"><?= __('Terms') ?></a></h2>
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
                <a href="<?= $this->Url->build(['controller' => 'cms_contents']); ?>">CMS CONTENTS</a> - <?= __('They are all web content.') ?>
                <hr/>
                <p><a href="<?= $this->Url->build(['controller' => 'cms_content_statues']); ?>">CMS CONTENT STATUES</a></p>
                <p><a href="<?= $this->Url->build(['controller' => 'cms_content_types']); ?>">CMS CONTENT TYPES</a></p>
                <p><a href="<?= $this->Url->build(['controller' => 'cms_content_options']); ?>">CMS CONTENT OPTIONS</a></p>
                <p><a href="<?= $this->Url->build(['controller' => 'cms_content_roles']); ?>">CMS CONTENT ROLES</a></p>
                <p><a href="<?= $this->Url->build(['controller' => 'cms_content_users']); ?>">CMS CONTENT USERS</a></p>
            </div>
            <div class="well">
                <a href="<?= $this->Url->build(['controller' => 'cms_terms']); ?>">CMS TERMS</a> - <?= __('Organize contents according to categories.') ?>
                <hr/>
                <p><a href="<?= $this->Url->build(['controller' => 'cms_term_taxonomies']); ?>">CMS TERM TAXONOMIES</a></p>
                <p><a href="<?= $this->Url->build(['controller' => 'cms_term_taxonomy_types']); ?>">CMS TERM TAXONOMY TYPES</a></p>
                <p><a href="<?= $this->Url->build(['controller' => 'cms_term_relationships']); ?>">CMS TERM RELATIONSHIPS</a></p>
                <p><a href="<?= $this->Url->build(['controller' => 'cms_term_roles']); ?>">CMS CONTENT ROLES</a></p>
                <p><a href="<?= $this->Url->build(['controller' => 'cms_term_users']); ?>">CMS CONTENT USERS</a></p>            
            </div>
            <div class="well">
                <a href="<?= $this->Url->build(['controller' => 'cms_sites']); ?>">CMS SITES</a> - <?= __('Organize contents in sites.') ?>
                <hr/>
                <p><a href="<?= $this->Url->build(['controller' => 'cms_site_options']); ?>">CMS SITE OPTIONS</a></p>    
                <p><a href="<?= $this->Url->build(['controller' => 'cms_site_roles']); ?>">CMS SITE ROLES</a></p>
                <p><a href="<?= $this->Url->build(['controller' => 'cms_site_users']); ?>">CMS SITE USERS</a></p>    
            </div>
        </div>
    </div>
</div>
