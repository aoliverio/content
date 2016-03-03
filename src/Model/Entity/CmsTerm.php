<?php
namespace Content\Model\Entity;

use Cake\ORM\Entity;

/**
 * CmsTerm Entity.
 */
class CmsTerm extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'title' => true,
        'description' => true,
        'created_user' => true,
        'modified_user' => true,
        'cms_permission' => true,
    ];
}
