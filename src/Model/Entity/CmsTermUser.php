<?php
namespace Content\Model\Entity;

use Cake\ORM\Entity;

/**
 * CmsTermUser Entity.
 *
 * @property int $id
 * @property int $cms_term_id
 * @property \Content\Model\Entity\CmsTerm $cms_term
 * @property int $user_id
 * @property \Content\Model\Entity\User $user
 * @property string $params
 */
class CmsTermUser extends Entity
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
