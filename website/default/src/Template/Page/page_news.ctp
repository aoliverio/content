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
$this->layout('page_2cl');
?>

<!-- BACHECA NOTIZIE -->
<?php if (count($this->request->pass) == 1) : ?>
    <?php
    /**
     * Recupera elenco di TermTaxonomy
     */
    $this->CmsTermTaxonomy = TableRegistry::get('Content.CmsTermTaxonomy');
    $query = $this->CmsTermTaxonomy->find('all');
    $query->where(['cms_term_id' => 58, 'taxonomy' => 'news']);
    $risultato_taxonomy = $query->toArray();
    ?>
    <h1 class="page-header"><?= $data->content_title; ?></h1>
    <div>
        <?= $data->content_description; ?>
    </div>
    <?php foreach ($risultato_taxonomy as $row): ?>
        <div class="well">
            <h4><a href="<?= $this->Url->build(['news', $row->id]); ?>"><i class="fa fa-rss"></i>&nbsp;&nbsp;<?= $row->title; ?></a></h4>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<!-- ELENCO NOTIZIE -->
<?php if (count($this->request->pass) == 2) : ?>
    <?php
    /**
     * Recupera Taxonomy 
     */
    $this->CmsTermTaxonomy = TableRegistry::get('Content.CmsTermTaxonomy');
    $taxonomy = $this->CmsTermTaxonomy->get(intval($this->request->pass[1]));
    /**
     * Recupera elenco di News per $taxonomy->id
     */
    $this->CmsContent = TableRegistry::get('Content.CmsContent');
    $query = $this->CmsContent->find('all');
    $query->matching('CmsTermRelation', function ($q) use ($taxonomy) {
        return $q->where(['cms_term_taxonomy_id' => $taxonomy->id]);
    });
    $query->where(['content_type' => 'news', 'content_status' => 'publish']);
    $risultato_news = $query->toArray();
    ?>
    <h1 class="page-header"><?= $taxonomy->title; ?></h1>
    <div>
        <?= $taxonomy->description; ?>
    </div>
    <?= $this->element('news-table', ['taxonomy' => $taxonomy, 'data' => $risultato_news]); ?>
<?php endif; ?>

<!-- DETTAGLIO NOTIZIE -->
<?php if (count($this->request->pass) == 3) : ?>
    <?php
    /**
     * Get News
     */
    $this->CmsContent = TableRegistry::get('Content.CmsContent');
    $data = $this->CmsContent->get(intval($this->request->pass[2]));

    /**
     * Get Related
     */
    if ($data) :
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
    <h1 class="page-header"><?= $data->content_title; ?></h1>
    <div class="alert alert-warning">
        <span class="text-muted">
            <i class="fa fa-2x fa-clock-o"></i>
            <?php
            if ($data->publish_start instanceof Cake\I18n\Time)
                echo 'Pubblicazione: <strong>' . $data->publish_start->format('d/m/Y') . '</strong>';
            if ($data->content_deadline instanceof Cake\I18n\Time)
                echo ' - Scadenza: <strong>' . $data->content_deadline->format('d/m/Y') . '</strong>';
            if ($data->modified instanceof Cake\I18n\Time)
                echo ' - Ultimo aggiornamento: <strong>' . $data->modified->format('d/m/Y H:i:s') . '</strong>';
            ?>
        </span>
    </div>
    <div><?= $data->content_description; ?></div>
    <?php
    /**
     * Display block related
     */
    if (count($data['Image']) > 0)
        echo $this->element('content-image-gallery', ['data' => $data['Image']]);
    if (count($data['Attached']) > 0)
        echo $this->element('content-attached-list', ['data' => $data['Attached']]);
    ?>
<?php endif; ?>