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
$CmsContent = TableRegistry::get('Content.CmsContent');

/**
 * Get last carousel news, id 55
 */
$CAROUSEL_ID = 55;
$query = $CmsContent->find('all');
$query->contain([
    'CmsTermRelation' => function ($q) use ($CAROUSEL_ID) {
        $q->where(['cms_term_taxonomy_id' => $CAROUSEL_ID]);
        return $q;
    }]);
$query->where(['content_type' => 'news', 'content_status' => 'publish']);
$query->order(['publish_start' => 'DESC']);
$query->limit(3);
$result = $query->toArray();
?>


<div class="row">
    <div class="col-md-12">
            
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <?php $ITER = 0; ?>
            <?php foreach ($result as $row) : ?>
                <?php
                $ITER++;
                $ACTIVE = '';
                if ($ITER == 1)
                    $ACTIVE = ' class="active"';
                ?>
                <li data-target="#carousel-example-generic" data-slide-to="0"<?= $ACTIVE ?>></li>
            <?php endforeach; ?>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <?php $ITER = 0; ?>
            <?php foreach ($result as $row) : ?>
                <?php
                $ITER++;
                $ACTIVE = '';
                if ($ITER == 1)
                    $ACTIVE = ' active"';
                $CmsContent = TableRegistry::get('Content.CmsContent');
                $query = $CmsContent->find('all');
                $query->where(['parent' => $row->id, 'content_type' => 'image']);
                $query->order(['menu_order' => 'DESC']);
                $image = $query->first();
                $image_path = uploadBaseUrl . $image->content_path;
                ?>
                <div class="item<?= $ACTIVE ?>">
                    <img class="img-responsive" src="<?= $image_path ?>"/>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>