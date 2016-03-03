<?php
namespace Content\Model\Entity;

use Cake\ORM\Entity;

/**
 * CmsTermTaxonomy Entity.
 */
class CmsTermTaxonomy extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'parent_id' => true,
        'cms_term_id' => true,
        'taxonomy' => true,
        'title' => true,
        'description' => true,
        'count' => true,
        'created_user' => true,
        'modified_user' => true,
        'parent_cms_term_taxonomy' => true,
        'cms_term' => true,
        'cms_term_relation' => true,
        'child_cms_term_taxonomy' => true,
    ];
}
