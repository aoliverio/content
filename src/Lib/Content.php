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
 * Content function collection
 */
Class Content {

    /**
     * Using table
     *
     * @var type 
     */
    protected $ContentTable = 'CmsContents';

    /**
     * Contend unique id
     *
     * @var type 
     */
    public $id = null;

    /**
     * Default type = page
     *
     * @var type 
     */
    public $type_id = 1;

    /**
     * Default type = draft
     *
     * @var type 
     */
    public $status_id = 1;

    /**
     * Content options
     *
     * @var type 
     */
    public $options = [];

    /**
     * Create new Content in CmsContents table.
     * 
     * @param type $config
     */
    public function __construct($options = null) {

        if (isset($options))
            extract($options);

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

    /**
     * Find related Content records.
     *
     * 
     * @param type $content_id
     * @param type $params
     * @return type
     */
    public function getRelated($content_id, $params = []) {

        extract($params);

        $this->CmsContent = TableRegistry::get('CmsContents');
        $query = $this->CmsContent->find('all');
        $query->where(['parent' => $content_id]);

        if (isset($type_id))
            $query->where(['cms_content_type_id' => intval($type_id)]);

        if (isset($status_id))
            $query->where(['cms_content_status_id' => intval($status_id)]);
        else
            $query->where(['cms_content_status_id' => 1]);

        $query->order('menu_order');
        return $query->toArray();
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

}
