<?php
namespace Content\Model\Entity;

use Cake\ORM\Entity;

/**
 * CmsTermTaxonomy Entity.
 *
 * @property int $id
 * @property int $parent_id
 * @property \Content\Model\Entity\ParentCmsTermTaxonomy $parent_cms_term_taxonomy
 * @property int $cms_term_id
 * @property \Content\Model\Entity\CmsTerm $cms_term
 * @property int $cms_term_taxonomy_type_id
 * @property \Content\Model\Entity\CmsTermTaxonomyType $cms_term_taxonomy_type
 * @property string $title
 * @property string $description
 * @property int $count
 * @property \Content\Model\Entity\CmsTermRelationship[] $cms_term_relationships
 * @property \Content\Model\Entity\ChildCmsTermTaxonomy[] $child_cms_term_taxonomies
 */
class CmsTermTaxonomy extends Entity
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
