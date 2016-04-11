<?php
namespace Content\Model\Entity;

use Cake\ORM\Entity;

/**
 * CmsContent Entity.
 *
 * @property int $id
 * @property int $parent_id
 * @property \Content\Model\Entity\CmsContent $parent_cms_content
 * @property string $name
 * @property string $content_title
 * @property string $content_description
 * @property string $content_excerpt
 * @property \Cake\I18n\Time $content_expiry
 * @property string $content_password
 * @property int $cms_content_status_id
 * @property \Content\Model\Entity\CmsContentStatue $cms_content_statue
 * @property string $content_path
 * @property int $cms_content_type_id
 * @property \Content\Model\Entity\CmsContentType $cms_content_type
 * @property string $content_mime_type
 * @property \Cake\I18n\Time $publish_start
 * @property \Cake\I18n\Time $publish_end
 * @property int $cms_site_id
 * @property \Content\Model\Entity\CmsSite $cms_site
 * @property string $guid
 * @property int $author_id
 * @property \Content\Model\Entity\Author $author
 * @property int $menu_order
 * @property \Cake\I18n\Time $created
 * @property int $created_by
 * @property \Cake\I18n\Time $modified
 * @property int $modified_by
 * @property \Content\Model\Entity\CmsContentOption[] $cms_content_options
 * @property \Content\Model\Entity\CmsContent[] $child_cms_contents
 * @property \Content\Model\Entity\CmsTermRelationship[] $cms_term_relationships
 */
class CmsContent extends Entity
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
