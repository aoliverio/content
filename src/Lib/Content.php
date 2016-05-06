<?php

/**
 * Content Project (tm) the CMS core plugin (http://www.getcontent.org)
 * Copyright (c) 2016, Antonio Oliverio (http://www.aoliverio.com)
 * 
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) 2016 Antonio Oliverio.
 * @link          http://www.aoliverio.com
 * @author        Antonio Oliverio <antonio.oliverio@gmail.com>
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace Content\Lib;

use Cake\ORM\TableRegistry;

/**
 * Content function collection
 */
Class Content {

    /**
     *
     * @var type 
     */
    protected $ContentTable = 'CmsContents';

    /**
     *
     * @var type 
     */
    public $id = null;

    /**
     * Create new Content in CmsContents table.
     * 
     * @param type $config
     */
    public function __construct($options = null) {

        /**
         * Import variables into the current symbol table from an array.
         */
        if (isset($options))
            extract($options);

        /**
         * Create new Content.
         */
        $Table = TableRegistry::get('CmsContents');
        $Content = $Table->newEntity();
        $Content->parent = isset($parent) ? intval($parent) : 0;
        $Content->name = $this->permittedName();
        $Content->content_title = isset($content_title) ? h($content_title) : '';
        $Content->content_description = isset($content_description) ? h($content_description) : '';
        $Content->content_excerpt = isset($content_excerpt) ? h($content_excerpt) : '';
        $Content->content_status_id = isset($content_status) ? trim($content_status) : 1;
        $Content->content_type_id = isset($content_type) ? trim($content_type) : 1;
        $Content->content_path = isset($content_path) ? trim($content_path) : '';
        $Content->menu_order = isset($menu_order) ? trim($menu_order) : 0;
        $Content->publish_start = isset($publish_start) ? trim($publish_start) : date('Y-m-d H:i:s');
        $Content->publish_end = isset($publish_end) ? trim($publish_end) : '0000-00-00 00:00:00';
        $Content->author_id = isset($author_id) ? intval($author_id) : 1;
        $Content->created = date('Y-m-d H:i:s');
        $Content->created_user = isset($created_user) ? intval($created_user) : 1;
        $Content->modified = date('Y-m-d H:i:s');
        $Content->modified_user = isset($modified_user) ? intval($modified_user) : 1;
        if ($Table->save($Content))
            $this->id = $Content->id;
    }

    /**
     * Content permittedName
     * 
     * @param type $text
     * @return string
     */
    protected function permittedName($text = null) {
        return '1234';
    }

}
