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
$query->where(['name' => trim($this->request->pass[0])]);
$CONTENT_ID = $query->first()->id;

/**
 * Get menu
 */
$query = $this->CmsContent->find('all');
$query->where(['parent' => $CONTENT_ID, 'content_type' => 'page', 'content_status' => 'publish']);
$query->order(['menu_order' => 'ASC', 'content_title' => 'ASC']);
$result = $query->toArray();
?>

<h4 class="small-caps">Menù di Pagina:</h4>
<div class="panel panel-well" > 
    <div class="panel-body">
        <form class="form-inline">

            <?php if (!empty($result)) { ?>
                <?php foreach ($result as $row) : ?>
                    <p><a href="<?= $this->Url->build([$row->name]); ?>"><?= $row->content_title; ?></a></p>
                <?php endforeach; ?>
            <?php } else { ?>
                    <div class="text-center small-caps">Nessun elemento trovato</div>
            <?php } ?>
        </form>	
    </div>
</div>
