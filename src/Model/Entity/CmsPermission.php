<?php
namespace Content\Model\Entity;

use Cake\ORM\Entity;

/**
 * CmsPermission Entity.
 */
class CmsPermission extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'sys_user' => true,
        'sys_role' => true,
        'allow' => true,
        'created_user' => true,
        'modified_user' => true,
        'cms_content' => true,
        'cms_term' => true,
    ];
}
