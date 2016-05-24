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
 * @since         1.0.0
 * @author        Antonio Oliverio <antonio.oliverio@gmail.com>
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace Content\Lib;

use Content\Lib\File;
use Content\Lib\Utility;
use Cake\Utility\Inflector;
use Cake\ORM\TableRegistry;

/**
 * Content class.
 */
Class Content {

    /**
     * Contend id
     *
     * @var type 
     */
    public $id = null;

    /**
     * Content type
     *
     * @var type 
     */
    public $type = null;

    /**
     * Content status
     *
     * @var type 
     */
    public $status = null;

    /**
     * Content options
     *
     * @var type 
     */
    public $options = [];

    /**
     * It is the user who is accessing the Content
     *
     * @var type 
     */
    public $user = null;

    /**
     * External Users table, set Users by default
     *
     * @var type 
     */
    public $userTable = 'Users';

    /**
     * List of users authorized to access the Content.
     * If empty all Users are authorized to access.
     *
     * @var type 
     */
    public $authorizedUsers = [];

    /**
     * It is the role who is accessing the Content
     *
     * @var type 
     */
    public $role = null;

    /**
     * External Roles table, set Roles by default
     *
     * @var type 
     */
    public $roleTable = 'Roles';

    /**
     * List of roles authorized to access the Content.
     * If empty all Roles are authorized to access.
     *
     * @var type 
     */
    public $authorizedRoles = [];

    /**
     * Define permitted Content type.
     *
     * @var type 
     */
    public $permittedTypes = [
        1 => 'page',
        2 => 'news',
        3 => 'attached',
        4 => 'image'
    ];

    /**
     * Define permitted Content status.
     *
     * @var type 
     */
    public $permittedStatues = [
        1 => 'draft',
        2 => 'publish',
        3 => 'review'
    ];

    /**
     * Define $default array.
     *
     * @var type 
     */
    public $default = [
        'cms_content_status_id' => 1,
        'cms_content_type_id' => 1,
        'limit' => 1000
    ];

    /**
     *
     * @var type 
     */
    public $PluginName = 'Content';

    /**
     * Define TableRegistry object using Cake\ORM\TableRegistry
     *
     * @var type 
     */
    public $Table = null;

    /**
     * Define TableName for use Cake\ORM\TableRegistry
     *
     * @var type 
     */
    public $TableName = 'cms_contents';

    /**
     *
     * @var type 
     */
    public $Site = null;

    /**
     *
     * @var type 
     */
    public $Term = null;

    /**
     *
     * @var type 
     */
    public $File = null;

    /**
     * Create new Content in CmsContents table.
     * 
     * @param type $config
     */
    public function __construct($options = null) {

        $fullTableName = $this->PluginName . '.' . $this->TableName;
        $this->Table = TableRegistry::get($fullTableName);

        $this->File = new File();

        // set user from session
        $this->user = 1;

        // set role from session
        $this->role = 1;
    }

    /**
     * Create new empty Content item and store in database.
     * 
     * @param type $data
     * @return boolean
     */
    public function create($data = []) {

        $this->Table = TableRegistry::get($this->TableName);
        extract($data);

        $item = $this->Table->newEntity();
        $item->parent_id = isset($parent_id) ? intval($parent_id) : 0;
        $item->name = $this->_getPermittedName();
        $item->content_title = isset($content_title) ? h($content_title) : '';
        $item->content_description = isset($content_description) ? h($content_description) : '';
        $item->content_excerpt = isset($content_excerpt) ? h($content_excerpt) : '';
        $item->cms_content_status_id = isset($content_status) ? trim($content_status) : $this->default['cms_content_status_id'];
        $item->cms_content_type_id = isset($content_type) ? trim($content_type) : $this->default['cms_content_type_id'];
        $item->content_path = isset($content_path) ? trim($content_path) : '';
        $item->menu_order = isset($menu_order) ? trim($menu_order) : 0;
        $item->publish_start = isset($publish_start) ? trim($publish_start) : date('Y-m-d H:i:s');
        $item->publish_end = isset($publish_end) ? trim($publish_end) : '0000-00-00 00:00:00';
        $item->author_id = isset($author_id) ? intval($author_id) : $this->user;
        $item->created = date('Y-m-d H:i:s');
        $item->created_user = $this->user;
        $item->modified = date('Y-m-d H:i:s');
        $item->modified_user = $this->user;

        if ($this->Table->save($item))
            return $item->id;

        return false;
    }

    /**
     * Get Content by $id params
     * 
     * @param type $id
     */
    public function get($id) {

        if (!$this->_isAuthorizedUser())
            if (!$this->_isAuthorizedRoles())
                return false;

        $content = $this->Table->get($id, ['contain' => ['ParentCmsContents', 'CmsContentStatues', 'CmsContentTypes', 'Authors']]);
        return $content;
    }

    /**
     * Find list of Content filtered by $params
     * 
     * @param type $params
     */
    public function find($params = []) {

        if (!$this->_isAuthorizedUser())
            if (!$this->_isAuthorizedRole())
                return false;

        extract($params);

        if (!isset($type_id))
            $type_id = $default['cms_content_type_id'];
        if (!isset($limit))
            $limit = $default['limit'];

        $query = $this->Table->find('all');
        $query->contain(['ParentCmsContents', 'CmsContentStatues', 'CmsContentTypes', 'Authors']);
        $query->where([$this->TableName . '.cms_content_type_id' => $type_id]);
        $query->limit($limit);

        return $query->toArray();
    }

    /**
     * Save the Content item
     * 
     * @param type $data
     */
    public function save($item) {

        if (!$this->_isAuthorizedUser())
            if (!$this->_isAuthorizedRole())
                return false;

        $this->Table = TableRegistry::get($this->TableName);
        $cmsContent = $this->Table->get($item['id']);
        $cmsContent = $this->Table->patchEntity($cmsContent, $item);
        $this->Table->save($cmsContent);
    }

    /**
     * This function is used to save related items.
     * 
     * @param type $parent_id
     * @param type $items
     */
    public function saveRelatedItems($parent_id, $items, $params = null) {
        foreach ($items as $item) :
            if ($params)
                array_merge($item, $params);
            $this->save($item);
        endforeach;

        /**
         * 
          $parent_id = (isset($item['parent_id'])) ? intval($item['parent_id']) : 0;
          $type_id = (isset($item['cms_content_type_id'])) ? intval($item['cms_content_type_id']) : 1;
          $status_id = (isset($item['cms_content_type_id'])) ? intval($item['cms_content_type_id']) : 1;

          if ($item['content_path'])
          $CONTENT_PATH = $this->File->upload($item['content_path']);
          else
          $CONTENT_PATH = '';

          if ($CONTENT_PATH) :
          $PATHINFO = pathinfo($CONTENT_PATH);
          $item['content_title'] = (trim($item['content_title']) == '') ? Inflector::humanize($PATHINFO['filename']) : trim($item['content_title']);
          $item['parent_id'] = $parent_id;
          $item['cms_content_type_id'] = $type_id;
          $item['cms_content_status_id'] = $status_id;
          $item['content_path'] = $CONTENT_PATH;
          $item['menu_order'] = $this->Content->_getNextMenuOrder($parent_id, $type_id);
          $this->Table->save($item);
          endif;
         * 
         */
    }

    /**
     * This function is used to save related options.
     * 
     * @param type $parent_id
     * @param type $items
     */
    public function saveRelatedOptions($parent_id, $items, $params = null) {
        foreach ($items as $item) :
            if ($params)
                array_merge($item, $params);

            if (trim($row['meta_key']) != '' && trim($row['meta_value']) != '') :
                $metaTable = TableRegistry::get('CmsContentMeta');
                $meta = $metaTable->newEntity();
                $meta->cms_content_id = $content_id;
                $meta->meta_key = $row['meta_key'];
                $meta->meta_value = $row['meta_value'];
                $metaTable->save($meta);
            endif;
        endforeach;
    }

    /**
     * 
     * @param type $id
     * @return boolean
     */
    public function delete($id) {
        return true;
    }

    /**
     * 
     * @param type $parent_id
     * @param type $where
     * @return boolean
     */
    public function deleteRelatedItems($parent_id, $where = null) {
        return true;
    }

    /**
     * 
     * @param type $parent_id
     * @param type $where
     * @return boolean
     */
    public function deleteRelatedOptions($parent_id, $where = null) {
        return true;
    }

    /**
     * Provide the related Content records for a $content_id filtered by $params.
     * 
     * @param type $content_id
     * @param type $filter
     * @return type
     */
    public function getRelatedItems($content_id, $filter = []) {

        $where = array_merge(['parent_id' => $content_id], $filter);

        return $this->Table
                        ->find('all')
                        ->where($where)
                        ->order(['menu_order'])
                        ->toArray();
    }

    /**
     * Provide the Content options for a $content_id.
     * 
     * @param type $content_id
     * @return type
     */
    public function getRelatedOptions($content_id) {

        return TableRegistry::get('CmsContentOptions')
                        ->find('all')
                        ->where(['cms_content_id' => $content_id])
                        ->order(['menu_order'])
                        ->toArray();
    }

    /**
     * 
     * 
     * @param \Content\Lib\type $content_id
     * @return \Content\Lib\stringThis|string * @param \Content\Lib\type $content_id
     * @return \Content\Lib\stringThis|string} of the 'page' Content type.
     */
    public function getPageList($content_id) {

        $data = [];

        $Table = TableRegistry::get('CmsContents');
        $query = $Table->find('all')
                ->where(['id <>' => $content_id, 'cms_content_type_id' => 1]);

        foreach ($query->toArray() as $row):
            $data[$row->id] = '[' . $row->id . '] ' . $row->name;
        endforeach;

        return $data;
    }

    /**
     * 
     * @param type $content_id
     * @return type
     */
    public function getTaxonomies($content_id) {
        return [];
    }

    /**
     * 
     * @param type $content_id
     * @return type
     */
    public function getCheckedTaxonomies($content_id) {
        return [];
    }

    /**
     * 
     * @param type $content_id
     * @return type
     */
    public function getRoles($content_id) {
        return TableRegistry::get('Roles')
                        ->find('all')
                        ->order(['name'])
                        ->toArray();
    }

    /**
     * 
     * @param type $content_id
     * @return type
     */
    public function getCheckedRoles($content_id) {
        return TableRegistry::get('CmsContentRoles')
                        ->find('all')
                        ->where(['cms_content_id' => $content_id])
                        ->toArray();
    }

    /**
     * 
     * @param type $content_id
     * @return type
     */
    public function getUsers($content_id) {
        return TableRegistry::get('Users')
                        ->find('all')
                        ->order(['name'])
                        ->toArray();
    }

    /**
     * 
     * @param type $content_id
     * @return type
     */
    public function getCheckedUsers($content_id) {
        return TableRegistry::get('CmsContentUsers')
                        ->find('all')
                        ->where(['cms_content_id' => $content_id])
                        ->toArray();
    }

    /**
     * This function can be used to check if $user is authorized to access Content.
     * 
     * @return boolean
     */
    protected function _isAuthorizedUser() {

        if (count($this->authorizedUsers) > 0) {
            foreach ($this->authorizedUsers as $authorizedUsers) {
                if ($authorizedUsers->user_id == $this->user)
                    return true;
            }
            return false;
        }
        return true;
    }

    /**
     * This function can be used to check if $role is authorized to access Content.
     * 
     * @return boolean
     */
    protected function _isAuthorizedRole() {

        if (count($this->authorizedRoles) > 0) {
            foreach ($this->authorizedRoles as $authorizedRole) {
                if ($authorizedRole->role_id == $this->role)
                    return true;
            }
            return false;
        }
        return true;
    }

    /**
     * 
     * @param type $content_id
     */
    protected function _setAuthorizedUsers($content_id) {
        $this->authorizedUsers = TableRegistry::get('cms_content_users')
                ->find('all')
                ->where(['cms_contents_id' => $content_id])
                ->toArray();
    }

    /**
     * 
     * @param type $content_id
     */
    protected function _setAuthorizedRoles($content_id) {
        $this->authorizedRoles = TableRegistry::get('cms_content_roles')
                ->find('all')
                ->where(['cms_contents_id' => $content_id])
                ->toArray();
    }

    /**
     * Provide permitted name for Content by passed text
     * 
     * @param type $text
     * @return string
     */
    protected function _getPermittedName($text = null) {

        if (!isset($name))
            return Utility::randomString();

        if (trim($name) == '')
            return $content_id;

        $slugContentName = $slugTarget = strtolower(Inflector::slug($name));
        $iter = 0;

        while (true):
            if ($iter > 0)
                $slugTarget = $slugContentName . '-' . $iter;

            $query = $this->Table->find('all');
            $query->where(['conditions' => ['id <>' => $content_id, 'name' => $slugTarget]]);

            if ($query->count() == 0)
                return $slugTarget;

            $iter++;
        endwhile;
    }

    /**
     * This function provide the next menu order value for related Content.
     * 
     * @param type $parent
     * @param type $content_type
     * @return int
     */
    protected function _getNextMenuOrder($parent, $content_type) {
        $contentTable = TableRegistry::get('CmsContent');
        $query = $contentTable->find('all', [
            'conditions' => ['parent' => $parent, 'content_type' => $content_type],
            'order' => ['menu_order' => 'DESC']
        ]);
        $row = $query->first();
        if ($row)
            return intval($row->menu_order) + 1;
        else
            return 1;
    }

}
