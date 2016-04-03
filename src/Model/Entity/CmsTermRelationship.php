<?php
namespace Content\Model\Entity;

use Cake\ORM\Entity;

/**
 * CmsTermRelationship Entity.
 *
 * @property int $id
 * @property int $cms_content_id
 * @property \Content\Model\Entity\CmsContent $cms_content
 * @property int $cms_term_taxonomy_id
 * @property \Content\Model\Entity\CmsTermTaxonomy $cms_term_taxonomy
 * @property int $menu_order
 */
class CmsTermRelationship extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
