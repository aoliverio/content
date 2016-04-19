<?php

/**
 * 
 */
use Cake\ORM\TableRegistry;

/**
 * 
 */
$breadcrumb = [];

/**
 * 
 */
while (intval($current) > 0) :
    $this->CmsContent = TableRegistry::get('Content.CmsContent');
    $content = $this->CmsContent->get($current);
    $current = $content->parent;
    $item = [
        'slug' => $content->name,
        'label' => $content->content_title
    ];
    $breadcrumb[] = $item;
endwhile;

/**
 * 
 */
$breadcrumb = array_reverse($breadcrumb);

?>
<div style="margin-top: 10px;">
    <ol class="breadcrumb">
        <li><small>Sei in:</small></li>
        <li><a href="<?= $this->Url->build('/')?>">Home</a></li>
        <?php foreach ($breadcrumb as $row) : ?>
            <li><a href="<?= $this->Url->build([$row['slug']])?>"><?= $row['label']; ?></a></li>
        <?php endforeach; ?>
    </ol>
</div>