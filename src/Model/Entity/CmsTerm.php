<?php
namespace Content\Model\Entity;

use Cake\ORM\Entity;

/**
 * CmsTerm Entity.
 *
 * @property int $id
 * @property int $cms_site_id
 * @property \Content\Model\Entity\CmsSite $cms_site
 * @property string $name
 * @property string $title
 * @property string $description
 * @property string $params
 * @property \Content\Model\Entity\CmsTermTaxonomy[] $cms_term_taxonomies
 * @property \Content\Model\Entity\CsmTermUser[] $csm_term_users
 */
class CmsTerm extends Entity
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
