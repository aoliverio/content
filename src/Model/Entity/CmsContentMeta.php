<?php

namespace Content\Model\Entity;

use Cake\ORM\Entity;

/**
 * CmsContentMeta Entity.
 */
class CmsContentMeta extends Entity {

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'cms_content_id' => true,
        'meta_key' => true,
        'meta_value' => true,
        'priority' => true,
        'cms_content' => true,
    ];

}
