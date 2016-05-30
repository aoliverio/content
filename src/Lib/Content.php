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
    public $site_id = null;

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

        // Set site_id
        $this->site_id = 1;
    }

    /**
     * Create new empty Content item and store in database.
     * 
     * @param type $data
     * @return boolean
     */
    public function create($item = []) {

        if (isset($item['content_path']) && is_array($item['content_path']))
            $item['content_path'] = $this->File->upload($item['content_path']);
        else
            $item['content_path'] = (isset($item['content_path'])) ? trim($item['content_path']) : '';

        $this->Table = TableRegistry::get($this->TableName);
        $cmsContent = $this->_validateEntry($item);

        if ($this->Table->save($cmsContent))
            return $cmsContent->id;
        else
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

        if (!isset($this->type_id))
            $this->type_id = $this->default['cms_content_type_id'];
        if (!isset($limit))
            $limit = $this->default['limit'];

        $query = $this->Table->find('all');
        $query->contain(['ParentCmsContents', 'CmsContentStatues', 'CmsContentTypes', 'Authors']);
        $query->where([$this->TableName . '.cms_content_type_id' => $this->type_id]);
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
        $cmsContent = $this->_validateEntry($item);

        if ($this->Table->save($cmsContent))
            return $cmsContent->id;
        else
            return false;
    }

    /**
     * This function is used to save related items.
     * 
     * @param type $parent_id
     * @param type $items
     * @param type $params
     */
    public function saveRelatedItems($parent_id, $items, $params = null) {
        foreach ($items as $item) :
            $item = array_merge($item, $params);

            if (isset($item['name']) && trim($item['name']) != '') {
                $this->create($item);
                continue;
            }

            if (isset($item['content_title']) && trim($item['content_title']) != '') {
                $this->create($item);
                continue;
            }
        endforeach;
    }

    /**
     * This function is used to save related options.
     * 
     * @param type $content_id
     * @param type $items
     * @param type $params
     */
    public function saveRelatedOptions($content_id, $items, $params = []) {
        foreach ($items as $item) :
            $item = array_merge($item, $params);
            if (trim($item['option_key']) != '' && trim($item['option_value']) != '') :
                $Table = TableRegistry::get('CmsContentOptions');
                $option = $Table->newEntity();
                $option->cms_content_id = $content_id;
                $option->option_key = $item['option_key'];
                $option->option_value = $item['option_value'];
                $option->menu_order = $this->_getNextMenuOrderOptions($content_id);
                $Table->save($option);
            endif;
        endforeach;
    }

    /**
     * 
     * @param type $id
     * @return boolean
     */
    public function delete($id) {
        $this->Table = TableRegistry::get($this->TableName);
        $this->Table->deleteAll(['id' => $id]);
        return true;
    }

    /**
     * 
     * @param type $parent_id
     * @param type $where
     * @return boolean
     */
    public function deleteRelatedItems($parent_id, $where = null) {
        $this->Table = TableRegistry::get($this->TableName);
        $this->Table->deleteAll(['parent_id' => $parent_id]);
        return true;
    }

    /**
     * 
     * @param type $id
     * @return boolean
     */
    public function deleteRelatedOption($id) {
        $this->Table = TableRegistry::get('CmsContentOptions');
        $this->Table->deleteAll(['id' => $id]);
        return true;
    }

    /**
     * 
     * @param type $parent_id
     * @param type $where
     * @return boolean
     */
    public function deleteRelatedOptions($parent_id, $where = null) {
        $this->Table = TableRegistry::get('CmsContentOptions');
        $this->Table->deleteAll(['parent_id' => $parent_id]);
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
    public function getTaxonomies($content_type_id) {
        return TableRegistry::get('CmsTermTaxonomies')
                        ->find('all')
                        ->where(['cms_content_type_id' => $content_type_id])
                        ->order(['title'])
                        ->toArray();
    }

    /**
     * 
     * @param type $content_id
     * @return type
     */
    public function getCheckedTaxonomies($content_id) {
        return TableRegistry::get('CmsTermRelationships')
                        ->find('all')
                        ->where(['cms_content_id' => $content_id])
                        ->toArray();
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

    private function _validateEntry($item) {

        extract($item);

        $this->Table = TableRegistry::get($this->TableName);
        $cmsContent = $this->Table->newEntity();
        $cmsContent->id = isset($id) ? intval($id) : 0;
        $cmsContent->parent_id = isset($parent_id) ? intval($parent_id) : 0;
        $cmsContent->name = $this->_getPermittedName();
        $cmsContent->content_title = isset($content_title) ? h($content_title) : '';
        $cmsContent->content_description = isset($content_description) ? h($content_description) : '';
        $cmsContent->content_excerpt = isset($content_excerpt) ? h($content_excerpt) : '';
        $cmsContent->cms_content_status_id = isset($cms_content_status_id) ? trim($cms_content_status_id) : $this->default['cms_content_status_id'];
        $cmsContent->cms_content_type_id = isset($cms_content_type_id) ? trim($cms_content_type_id) : $this->default['cms_content_type_id'];
        $cmsContent->content_path = isset($content_path) ? trim($content_path) : '';
        $cmsContent->menu_order = $this->_getNextMenuOrder($cmsContent->parent_id, $cmsContent->cms_content_type_id);
        $cmsContent->publish_start = isset($publish_start) ? trim($publish_start) : date('Y-m-d H:i:s');
        $cmsContent->publish_end = isset($publish_end) ? trim($publish_end) : '0000-00-00 00:00:00';
        $cmsContent->author_id = isset($author_id) ? intval($author_id) : $this->user;
        $cmsContent->site_id = $this->site_id;
        $cmsContent->created = date('Y-m-d H:i:s');
        $cmsContent->created_user = $this->user;
        $cmsContent->modified = date('Y-m-d H:i:s');
        $cmsContent->modified_user = $this->user;

        return $cmsContent;
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

            $result = $this->Table
                    ->find('all')
                    ->where(['conditions' => ['id <>' => $content_id, 'name' => $slugTarget, 'cms_site_id' => $this->site_id]])
                    ->count();

            if ($result == 0)
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
    protected function _getNextMenuOrder($parent_id, $cms_content_type_id) {
        return $this->Table->find('all')
                        ->where(['parent_id' => $parent_id, 'cms_content_type_id' => $cms_content_type_id])
                        ->order(['menu_order' => 'DESC'])
                        ->count() + 1;
    }

    /**
     * This function provide the next menu order value for related Options.
     * 
     * @param type $content_id
     * @return type
     */
    protected function _getNextMenuOrderOptions($content_id) {
        return TableRegistry::get('CmsContentOptions')->find('all')
                        ->where(['cms_content_id' => $content_id])
                        ->order(['menu_order' => 'DESC'])
                        ->count() + 1;
    }

}
