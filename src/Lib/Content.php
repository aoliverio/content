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
     *
     * @var type 
     */
    public $Site = null;

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
        'author_id' => 1,
        'user_id' => 1,
        'limit' => 1000
    ];

    /**
     *
     * @var type 
     */
    public $Plugin = 'Content';

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
    public $TableName = 'CmsContents';

    /**
     * Create new Content in CmsContents table.
     * 
     * @param type $config
     */
    public function __construct($options = null) {

        $fullTableName = $this->Plugin . '.' . $this->TableName;
        $this->Table = TableRegistry::get($fullTableName);
    }

    /**
     * Get Content by $id
     * 
     * @param type $id
     */
    public function get($id) {

        $content = $this->Table->get($id, ['contain' => ['ParentCmsContents', 'CmsContentStatues', 'CmsContentTypes', 'Authors']]);
        return $content;
    }

    /**
     * Find list of Content filtered by $params
     * 
     * @param type $params
     */
    public function find($params = []) {

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
     * Create new Content item
     * 
     * @param type $data
     */
    public function create($data = []) {

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
        $item->author_id = isset($author_id) ? intval($author_id) : $this->default['author_id'];
        $item->created = date('Y-m-d H:i:s');
        $item->created_user = isset($created_user) ? intval($created_user) : $this->default['user_id'];
        $item->modified = date('Y-m-d H:i:s');
        $item->modified_user = isset($modified_user) ? intval($modified_user) : $this->default['user_id'];

        if ($Table->save($item))
            $this->id = $item->id;
    }

    /**
     * Save the Content item
     * 
     * @param type $data
     */
    public function save($data = []) {
        
    }

    /**
     * Find related Content records.
     * 
     * @param type $content_id
     * @param type $params
     * @return type
     */
    public function getRelated($content_id, $params = []) {

        extract($params);

        $query = $this->Table->find('all');
        $query->where(['parent' => $content_id]);

        if (isset($type) && in_array($type, $this->permittedType)) {
            $query->where(['content_type' => trim($type)]);
        }

        if (isset($status) && in_array($status, $this->permittedStatus)) {
            $query->where(['content_status' => trim($status)]);
        } else {
            $query->where(['content_status' => $this->defaultStatus]);
        }

        $query->order('menu_order');
        return $query->toArray();
    }

    /**
     * Content permittedName
     * 
     * @param type $text
     * @return string
     */
    protected function _getPermittedName($text = null) {

        if (!isset($name))
            return $this->_randomString();

        if (trim($name) == '')
            return $content_id;

        $slugContentName = $slugTarget = strtolower(Inflector::slug($name));
        $iter = 0;

        while (true):
            if ($iter > 0)
                $slugTarget = $slugContentName . '-' . $iter;

            $Table = TableRegistry::get('CmsContents');
            $query = $Table->find('all');
            $query->where(['conditions' => ['id <>' => $content_id, 'name' => $slugTarget]]);

            if ($query->count() == 0)
                return $slugTarget;

            $iter++;
        endwhile;
    }

    /**
     * This function provides a random string.
     * By defualt the string is long 32 characters.
     * 
     * @param type $number
     * @return string
     */
    protected function _randomString($number = 32) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < $number; $i++) :
            $randstring = $characters[rand(0, strlen($characters - 1))];
        endfor;
        return $randstring;
    }

    /**
     * 
     * 
     * @param type $content_id
     * @return type
     */
    protected function _getParentPagesList($content_id) {

        $data = array();
        $query = $this->CmsContent->find('all', ['conditions' => ['id <>' => $content_id, 'content_type' => 'page']]);
        foreach ($query->toArray() as $row):
            $data[$row->id] = '[' . $row->id . '] ' . $row->name;
        endforeach;
        return $data;
    }

    /**
     * This function is used to uplodad file in /uploads/YEAR/MONTH directory 
     * and to create Content record contextually.
     * 
     * 
     * @param type $inputfile
     * @param string $destfile
     * @return boolean
     */
    public function uploadFile($inputfile, $destfile = null) {

        if (strlen(trim($inputfile['name'])) === 0)
            return FALSE;

        $filename = strtolower($inputfile['name']);
        $sourcefile = $inputfile['tmp_name'];
        $file = new File($sourcefile, true, 0775);

        $CONTENT_YEAR = date('Y');
        $CONTENT_MONTH = date('m');
        $UPLOAD_DIR = (Configure::check('DEFAULT_UPLOAD_DIR') ? Configure::read('DEFAULT_UPLOAD_DIR') : WWW_ROOT . 'uploads');
        $folder_dest = new Folder($UPLOAD_DIR);

        if (!$folder_dest->inCakePath($folder_dest->pwd() . DS . $CONTENT_YEAR))
            $folder_dest->create($folder_dest->pwd() . DS . $CONTENT_YEAR);
        $folder_dest->cd($CONTENT_YEAR);

        if (!$folder_dest->inCakePath($folder_dest->pwd() . DS . $CONTENT_MONTH))
            $folder_dest->create($folder_dest->pwd() . DS . $CONTENT_MONTH);
        $folder_dest->cd($CONTENT_MONTH);

        $path = DS . $CONTENT_YEAR . DS . $CONTENT_MONTH . DS;
        $permittedFilename = $this->_permittedFileName($UPLOAD_DIR . $path, $filename);
        $destfile = $folder_dest->pwd() . DS . $permittedFilename;

        if ($file->copy($destfile, true))
            return $path . $permittedFilename;
        else
            return FALSE;
    }

    /**
     * This function is used to remove a specific $path from file system.
     * 
     * @param type $content_path
     * @return boolean
     */
    public function removeFile($path) {
        $UPLOAD_DIR = (Configure::check('DEFAULT_UPLOAD_DIR') ? Configure::read('DEFAULT_UPLOAD_DIR') : WWW_ROOT . 'uploads');
        $file = new File($UPLOAD_DIR . $path);
        return $file->delete();
    }

    /**
     * This function provides the correct filename for the creation of file systems. 
     * 
     * @param type $directory
     * @param type $filename
     * @return string
     */
    public function getPermittedFilename($directory, $filename) {

        $pathInfo = pathinfo($filename);

        $pathInfo['filename'] = substr(Inflector::slug($pathInfo['filename']), 0, 100);

        if (strlen($pathInfo['filename']) < 3)
            $pathInfo['filename'] = $this->_randomString();

        $dir = new Folder($directory);
        $iter = 0;
        do {
            if ($iter == 0)
                $slugFileName = $pathInfo['filename'] . '.' . $pathInfo['extension'];
            else
                $slugFileName = $pathInfo['filename'] . '-' . $iter . '.' . $pathInfo['extension'];
            $data = $dir->find($slugFileName, true);
            $iter++;
        } while (count($data) > 0);
        return $slugFileName;
    }

    /**
     * 
     * 
     * @param type $parent
     * @param type $content_type
     * @return int
     */
    protected function getNextMenuOrder($parent, $content_type) {
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
