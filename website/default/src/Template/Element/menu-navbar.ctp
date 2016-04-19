<?php

/**
 * 
 */
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
use Cake\Utility\Text;
use Cake\I18n\Time;

/**
 * 
 */
$this->CmsContent = TableRegistry::get('Content.CmsContent');

/**
 * Get content_id
 */
$query = $this->CmsContent->find('all');
$query->where(['name' => 'home']);
$CONTENT_ID = $query->first()->id;

/**
 * Get menu
 */
$query = $this->CmsContent->find('all');
$query->where(['parent' => $CONTENT_ID, 'content_type' => 'page', 'content_status' => 'publish']);
$query->order(['menu_order' => 'ASC', 'content_title' => 'ASC']);
$result = $query->toArray();
?>

<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= $this->Url->build('/' . SITE_NAME); ?>"><i class="fa fa-home"></i></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">  
                <?php foreach ($result as $row): ?>
                    <li><a href="<?= $this->Url->build([$row->name]); ?>"><?= $row->content_title ?></a></li>
                <?php endforeach; ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <i class="fa fa-search"></i>
                        <input type="text" class="form-control" placeholder="Cerca nel sito...">
                    </div>
                </form>
            </ul>
        </div>
    </div>
</nav>