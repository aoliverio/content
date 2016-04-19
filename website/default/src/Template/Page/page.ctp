<?php

/**
 * 
 */
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
use Cake\Utility\Text;
use Cake\I18n\Time;

if ($data) :

    /**
     * Define $this->CmsContent
     */
    $this->CmsContent = TableRegistry::get('Content.CmsContent');

    /**
     * Get related attached
     */
    $query = $this->CmsContent->find('all');
    $query->where(['parent' => $data->id, 'content_type' => 'attached']);
    $query->order(['menu_order']);
    $data['Attached'] = $query->toArray();

    /**
     * Get related images
     */
    $query = $this->CmsContent->find('all');
    $query->where(['parent' => $data->id, 'content_type' => 'image']);
    $query->order(['menu_order']);
    $data['Image'] = $query->toArray();

    /**
     * Get related CmsContentMeta
     */
    $this->CmsContentMeta = TableRegistry::get('CmsContentMeta');
    $query = $this->CmsContentMeta->find('all');
    $query->where(['cms_content_id' => $data->id]);
    $data['CmsContentMeta'] = $query->toArray();
endif;
?>
<span class="pull-right"><small><i class="fa fa-clock-o"></i> <em>Ultimo aggiornamento <?= $data->modified->format('d/m/Y H:i:s') ?></em></small></span>
<h1 class="page-header"><?= $data->content_title; ?></h1>
<div class="text-justify">
    <?= $data->content_description; ?>
</div>

<?php
/**
 * Display Image GALLERY element
 */
if (count($data['Image']) > 0)
    echo $this->element('page-image-gallery', ['data' => $data['Image']]);

/**
 * Display Attached LIST element
 */
if (count($data['Attached']) > 0)
    echo $this->element('page-attached-list', ['data' => $data['Attached']]);
?>

<?php
/**
 * 
 */
$MODULE_AUTOLOAD = TRUE;

/**
 * Processes the modules defined in the meta
 */
foreach ($data->CmsContentMeta as $row) :
    if ($row->meta_key == 'module'):
        $elements = explode('/', $row->meta_value);
        $name = $elements[0];
        $vars = array_shift($elements);
        $params = array();
        foreach ($elements as $row) :
            $param = explode(':', $row);
            $params[$param[0]] = $param[1];
        endforeach;
        if (trim($name) != '' && $this->elementExists($name))
            echo $this->element($name, ['params' => $params]);
        /**
         * 
         */
        $MODULE_AUTOLOAD = FALSE;
    endif;
endforeach;

/**
 * Autoload element with the same name of the page
 */
if ($MODULE_AUTOLOAD)
    if ($this->elementExists($data->name))
        echo $this->element($data->name);