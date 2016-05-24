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

/**
 * File class
 */
Class File {

    /**
     * File name
     *
     * @var type 
     */
    public $name = null;

    /**
     * File path
     *
     * @var type 
     */
    public $path = null;

    /**
     * 
     */
    public function __construct() {

        $this->path = WWW_ROOT . 'uploads';
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
    public function upload($inputfile, $destfile = null) {

        if (strlen(trim($inputfile['name'])) === 0)
            return FALSE;

        $filename = strtolower($inputfile['name']);
        $sourcefile = $inputfile['tmp_name'];
        $file = new File($sourcefile, true, 0775);

        $CONTENT_YEAR = date('Y');
        $CONTENT_MONTH = date('m');
        $UPLOAD_DIR = (Configure::check('DEFAULT_UPLOAD_DIR') ? Configure::read('DEFAULT_UPLOAD_DIR') : $this->path);
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
    public function remove($path) {
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
