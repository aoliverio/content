<?php
namespace Content\Model\Entity;

use Cake\ORM\Entity;

/**
 * CmsTermRelation Entity.
 */
class CmsTermRelation extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'cms_term_taxonomy_id' => true,
        'cms_content_id' => true,
        'menu_order' => true,
        'created_user' => true,
        'modified_user' => true,
        'cms_term_taxonomy' => true,
        'cms_content' => true,
    ];
}
