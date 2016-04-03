<?php
namespace Content\Model\Entity;

use Cake\ORM\Entity;

/**
 * CmsSiteRole Entity.
 *
 * @property int $id
 * @property int $cms_sites_id
 * @property \Content\Model\Entity\CmsSite $cms_site
 * @property int $roles_id
 * @property \Content\Model\Entity\Role $role
 * @property string $params
 */
class CmsSiteRole extends Entity
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
