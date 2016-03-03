<?php
namespace Content\Model\Entity;

use Cake\ORM\Entity;

/**
 * CmsContent Entity.
 */
class CmsContent extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'parent' => true,
        'name' => true,
        'content_title' => true,
        'content_description' => true,
        'content_excerpt' => true,
        'content_deadline' => true,
        'content_password' => true,
        'content_status' => true,
        'content_path' => true,
        'content_type' => true,
        'content_mime_type' => true,
        'publish_start' => true,
        'publish_end' => true,
        'author' => true,
        'menu_order' => true,
        'created_user' => true,
        'modified_user' => true,
        'parent_cms_content' => true,
        'child_cms_content' => true,
        'cms_permission' => true,
        'cms_term_relation' => true,
    ];
}
