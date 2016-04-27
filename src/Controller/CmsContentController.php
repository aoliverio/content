<?php

namespace Content\Controller;

use Content\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Controller\Component\AuthComponent;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Utility\Inflector;
use Cake\Core\Configure;

/**
 * CmsContent Controller
 *
 * @property \Content\Model\Table\CmsContentTable $CmsContent
 */
class CmsContentController extends AppController {

    /**
     * 
     */
    public $permitted_content_type = ['page', 'news', 'attached', 'image'];

    /**
     * 
     */
    public $permitted_content_status = ['draft', 'publish'];

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->set('data', $this->paginate($this->CmsContent));
        $this->set('_serialize', ['data']);


        $query = $this->CmsContent->find('all', [
            'conditions' => ['content_type' => 'news'],
            'limit' => 3,
            'contain' => ['CmsTermRelation']
        ]);
        pr($query->toArray());
        exit;
    }

    /**
     * View method
     *
     * @param string|null $id Cms Content id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $cmsContent = $this->CmsContent->get($id, [
            'contain' => ['CmsPermission', 'CmsTermRelation']
        ]);
        $this->set('cmsContent', $cmsContent);
        $this->set('_serialize', ['cmsContent']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $cmsContent = $this->CmsContent->newEntity();
        if ($this->request->is('post')) {
            $cmsContent = $this->CmsContent->patchEntity($cmsContent, $this->request->data);
            if ($this->CmsContent->save($cmsContent)) {
                $this->Flash->success('The cms content has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The cms content could not be saved. Please, try again.');
            }
        }
        $this->set(compact('cmsContent'));
        $this->set('_serialize', ['cmsContent']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Cms Content id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $cmsContent = $this->CmsContent->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cmsContent = $this->CmsContent->patchEntity($cmsContent, $this->request->data);
            if ($this->CmsContent->save($cmsContent)) {
                $this->Flash->success('The cms content has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The cms content could not be saved. Please, try again.');
            }
        }
        $this->set(compact('cmsContent'));
        $this->set('_serialize', ['cmsContent']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Cms Content id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $this->CmsContent = TableRegistry::get('CmsContent');
        $cmsContent = $this->CmsContent->get($id);
        if ($this->CmsContent->delete($cmsContent)) {
            $this->Flash->success('The cms content has been deleted.');
        } else {
            $this->Flash->error('The cms content could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * Create new Content
     * 
     * @param type $options
     * @return type
     */
    protected function _createNewContent($options = array()) {

        /**
         * Import variables into the current symbol table from an array
         */
        extract($options);

        /**
         * Create new entity
         */
        $contentTable = TableRegistry::get('CmsContent');
        $content = $contentTable->newEntity();
        $content->parent = isset($parent) ? intval($parent) : 0;
        $content->name = $this->_randomString();
        $content->content_title = isset($content_title) ? h($content_title) : '';
        $content->content_description = isset($content_description) ? h($content_description) : '';
        $content->content_excerpt = isset($content_excerpt) ? h($content_excerpt) : '';
        $content->content_status = isset($content_status) ? trim($content_status) : 'draft';
        $content->content_type = isset($content_type) ? trim($content_type) : 'page';
        $content->content_path = isset($content_path) ? trim($content_path) : '';
        $content->menu_order = isset($menu_order) ? trim($menu_order) : 0;
        $content->publish_start = isset($publish_start) ? trim($publish_start) : date('Y-m-d H:i:s');
        $content->publish_end = isset($publish_end) ? trim($publish_end) : '0000-00-00 00:00:00';
        $content->author_id = isset($author_id) ? intval($author_id) : 1;
        $content->created = date('Y-m-d H:i:s');
        $content->created_user = isset($created_user) ? intval($created_user) : 1;
        $content->modified = date('Y-m-d H:i:s');
        $content->modified_user = isset($modified_user) ? intval($modified_user) : 1;

        /**
         * Save and set name of Content
         */
        if ($contentTable->save($content)) :
            $content->name = (!isset($name)) ? $content->id : $this->_permittedContentName($content->id, $name);
            if ($contentTable->save($content))
                return $content->id;
        endif;

        /**
         * If not save Content return FALSE
         */
        return FALSE;
    }

    /**
     * 
     * @param type $name
     * @return type
     */
    protected function _permittedContentName($content_id, $name = NULL) {
        if (!isset($name))
            return $this->_randomString();

        if (trim($name) == '')
            return $content_id;

        $slugContentName = $slugTarget = strtolower(Inflector::slug($name));
        $iter = 0;

        while (TRUE):
            if ($iter > 0)
                $slugTarget = $slugContentName . '-' . $iter;
            $query = $this->CmsContent->find('all', ['conditions' => ['id <>' => $content_id, 'name' => $slugTarget]]);
            if ($query->count() == 0)
                return $slugTarget;
            $iter++;
        endwhile;
    }

    /**
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
     * This function is invoked in AJAX to save the ordering of the elements related
     * 
     * @return boolean
     */
    public function saveMenuOrder() {
        $ITER = 1;
        $contentTable = TableRegistry::get('CmsContent');
        if ($this->request->is('post')) :
            $items = explode(',', $this->request->data['order']);
            foreach ($items as $id) :
                $content = $contentTable->get($id);
                $content->menu_order = $ITER++;
                $contentTable->save($content);
            endforeach;
        endif;
        exit('ok');
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

    /**
     * 
     * List functions
     * 
     */

    /**
     * 
     * @param \Content\Controller\type $contente_type
     * @return \Content\Controller\type
     * @param type $contente_type
     * @return type
     */
    public function getItemsByContentType($contente_type = 'page') {
        $this->CmsContent = TableRegistry::get('Content.CmsContent');
        $query = $this->CmsContent->find('all');
        $query->contain(['CmsTermRelation']);
        $query->where(['content_type' => $contente_type]);
        $query->order(['modified' => 'DESC']);
        return $query->toArray();
    }

    /**
     * 
     * @param type $where
     * @param type $limit
     * @return type
     */
    public function getListOfContent($where = array(), $limit = 1000) {
        $query = $this->CmsContent->find('all')
                ->where($where)
                ->order('menu_order')
                ->limit($limit);
        return $query->all();
    }

    /**
     * 
     * @param type $where
     * @param type $limit
     * @return type
     */
    public function getListOfTaxonomy($where = array(), $limit = 1000) {
        $taxonomyTable = TableRegistry::get('CmsTermTaxonomy');
        $query = $taxonomyTable->find('all')
                ->where($where)
                ->limit($limit);
        return $query->all();
    }

    /**
     * 
     * @param type $where
     * @param type $limit
     * @return type
     */
    public function getListOfUser($where = array(), $limit = 1000) {
        $userTable = TableRegistry::get('Users');
        $query = $userTable->find('all')
                ->where($where)
                ->limit($limit);
        return $query->all();
    }

    /**
     * 
     * @param type $where
     * @param type $limit
     * @return type
     */
    public function getListOfRole($where = array(), $limit = 1000) {
        $roleTable = TableRegistry::get('Roles');
        $query = $roleTable->find('all')
                ->where($where)
                ->limit($limit);
        return $query->all();
    }

    /**
     * 
     * @param type $where
     * @param type $limit
     * @return type
     */
    public function getListOfMeta($where = array(), $limit = 1000) {
        $metaTable = TableRegistry::get('CmsContentMeta');
        $query = $metaTable->find('all')
                ->where($where)
                ->order('priority')
                ->limit($limit);
        return $query->all();
    }

    /**
     * 
     * 
     * @param type $content_id
     * @param type $taxonomy_id
     * @param type $menu_order
     * @return boolean
     */
    public function setContentRelation($content_id, $taxonomy_id, $menu_order = 0) {
        $relationTable = TableRegistry::get('CmsTermRelation');
        $relation = $relationTable->newEntity();
        $relation->cms_content_id = $content_id;
        $relation->cms_term_taxonomy_id = $taxonomy_id;
        $relation->menu_order = $menu_order;
        $relationTable->save($relation);
        exit('ok');
    }

    /**
     *
     * 
     * @param type $content_id
     * @param type $taxonomy_id
     * @return boolean
     */
    public function unsetContentRelation($content_id, $taxonomy_id) {
        $relationTable = TableRegistry::get('CmsTermRelation');
        $relationTable->deleteAll(['cms_content_id' => $content_id, 'cms_term_taxonomy_id' => $taxonomy_id]);
        exit('ok');
    }

    /**
     * 
     * 
     * @param type $content_id
     * @param type $sys_user_id
     */
    public function setUserPermit($content_id, $sys_user_id) {
        $permissionTable = TableRegistry::get('CmsPermission');
        $permission = $permissionTable->newEntity();
        $permission->cms_content_id = $content_id;
        $permission->sys_user_id = $sys_user_id;
        $permissionTable->save($permission);
        exit('ok');
    }

    /**
     * 
     * 
     * @param type $content_id
     * @param type $sys_user_id
     */
    public function unsetUserPermit($content_id, $sys_user_id) {
        $permissionTable = TableRegistry::get('CmsPermission');
        $permissionTable->deleteAll(['cms_content_id' => $content_id, 'sys_user_id' => $sys_user_id]);
        exit('ok');
    }

    /**
     * 
     * 
     * @param type $content_id
     * @param type $sys_user_id
     */
    public function setRolePermit($content_id, $sys_role_id) {
        $permissionTable = TableRegistry::get('CmsPermission');
        $permission = $permissionTable->newEntity();
        $permission->cms_content_id = $content_id;
        $permission->sys_role_id = $sys_role_id;
        $permissionTable->save($permission);
        exit('ok');
    }

    /**
     * 
     * 
     * @param type $content_id
     * @param type $sys_user_id
     */
    public function unsetRolePermit($content_id, $sys_role_id) {
        $permissionTable = TableRegistry::get('CmsPermission');
        $permissionTable->deleteAll(['cms_content_id' => $content_id, 'sys_role_id' => $sys_role_id]);
        exit('ok');
    }

    /**
     * 
     * Related block functions
     * 
     */

    /**
     * 
     * 
     * @param type $id
     */
    public function addRelatedPageBlock($id = 1) {
        $this->set('id', $id);
        $this->viewBuilder()->layout('ajax');
        $this->viewBuilder()->template('block_add_related_page');
    }

    /**
     * 
     * 
     * @param type $id
     */
    public function addRelatedAttachedBlock($id = 1) {
        $this->set('id', $id);
        $this->viewBuilder()->layout('ajax');
        $this->viewBuilder()->template('block_add_related_attached');
    }

    /**
     * 
     * 
     * @param type $id
     */
    public function addRelatedImageBlock($id = 1) {
        $this->set('id', $id);
        $this->viewBuilder()->layout('ajax');
        $this->viewBuilder()->template('block_add_related_image');
    }

    /**
     * 
     * 
     * @param type $id
     */
    public function addRelatedMetaBlock($id = 1) {
        $this->set('id', $id);
        $this->viewBuilder()->layout('ajax');
        $this->viewBuilder()->template('block_add_related_meta');
    }

    /**
     * 
     * @param type $content_id
     */
    public function editRelatedPage($id) {
        $this->CmsContent = TableRegistry::get('CmsContent');
        $cmsContent = $this->CmsContent->get($id, ['contain' => []]);
        $this->set('data', $cmsContent);
        $this->set('_serialize', ['data']);
        $this->viewBuilder()->layout('ajax');
        $this->viewBuilder()->template('block_edit_related_page');
    }

    /**
     * 
     * @param type $content_id
     */
    public function editRelatedAttached($id) {
        $this->CmsContent = TableRegistry::get('CmsContent');
        $cmsContent = $this->CmsContent->get($id, ['contain' => []]);
        $this->set('data', $cmsContent);
        $this->set('_serialize', ['data']);
        $this->viewBuilder()->layout('ajax');
        $this->viewBuilder()->template('block_edit_related_attached');
    }

    /**
     * 
     * @param type $content_id
     */
    public function editRelatedImage($id) {
        $this->CmsContent = TableRegistry::get('CmsContent');
        $cmsContent = $this->CmsContent->get($id, ['contain' => []]);
        $this->set('data', $cmsContent);
        $this->set('_serialize', ['data']);
        $this->viewBuilder()->layout('ajax');
        $this->viewBuilder()->template('block_edit_related_image');
    }

    /**
     * 
     * @param type $content_id
     */
    public function editRelatedMeta($id) {
        $this->CmsContentMeta = TableRegistry::get('CmsContentMeta');
        $meta = $this->CmsContentMeta->get($id, ['contain' => []]);
        $this->set('data', $meta);
        $this->set('_serialize', ['data']);
        $this->viewBuilder()->layout('ajax');
        $this->viewBuilder()->template('block_edit_related_meta');
    }

    /**
     * Controller function
     * 
     * @param type $parent
     * @param type $items
     */
    protected function saveRelatedPage($parent, $items) {
        foreach ($items as $row) :
            if ($row['content_title'] != '') :
                $row['parent'] = $parent;
                $row['content_type'] = 'page';
                $row['content_status'] = 'draft';
                $row['menu_order'] = $this->getNextMenuOrder($parent, 'page');
                $this->_createNewContent($row);
            endif;
        endforeach;
    }

    /**
     * Controller function
     *  
     * @param type $parent
     * @param type $items
     */
    protected function saveRelatedAttached($parent, $items) {
        foreach ($items as $row) :
            $CONTENT_PATH = $this->_uploadFile($row['content_path']);
            if ($CONTENT_PATH) :
                $PATHINFO = pathinfo($CONTENT_PATH);
                $row['content_title'] = (trim($row['content_title']) == '') ? Inflector::humanize($PATHINFO['filename']) : trim($row['content_title']);
                $row['parent'] = $parent;
                $row['content_type'] = 'attached';
                $row['content_status'] = 'inherited';
                $row['content_path'] = $CONTENT_PATH;
                $row['menu_order'] = $this->getNextMenuOrder($parent, 'attached');
                $this->_createNewContent($row);
            endif;
        endforeach;
    }

    /**
     * Controller function
     * 
     * @param type $parent
     * @param type $items
     */
    protected function saveRelatedImage($parent, $items) {
        foreach ($items as $row) :
            $CONTENT_PATH = $this->_uploadFile($row['content_path']);
            if ($CONTENT_PATH) :
                $PATHINFO = pathinfo($CONTENT_PATH);
                $row['content_title'] = (trim($row['content_title']) == '') ? Inflector::humanize($PATHINFO['filename']) : trim($row['content_title']);
                $row['parent'] = $parent;
                $row['content_type'] = 'image';
                $row['content_status'] = 'inherited';
                $row['content_path'] = $CONTENT_PATH;
                $row['menu_order'] = $this->getNextMenuOrder($parent, 'image');
                $this->_createNewContent($row);
            endif;
        endforeach;
    }

    /**
     * Controller function
     * 
     * @param type $content_id
     * @param type $items
     */
    protected function saveRelatedMeta($content_id, $items) {
        foreach ($items as $row) :
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
     * This function is invoked in AJAX for saving data related to an object
     * 
     * @param type $id
     */
    public function saveContent($id = null) {

        $id = (isset($this->request->data['id'])) ? $this->request->data['id'] : $id;
        $this->CmsContent = TableRegistry::get('CmsContent');
        $cmsContent = $this->CmsContent->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->CmsContent->patchEntity($cmsContent, $this->request->data);

            /**
             * Upload file
             */
            $CONTENT_PATH = $this->_uploadFile($this->request->data['content_file']);
            if ($CONTENT_PATH) {
                $cmsContent->content_path = $CONTENT_PATH;
            } else {
                if ($this->request->data['content_file_remove_ck'] == 1) {
                    $this->_removeFile($cmsContent->content_path);
                    $cmsContent->content_path = '';
                }
            }

            /**
             * Save the Content
             */
            if ($this->CmsContent->save($cmsContent)) {
                $this->Flash->success('The cms content has been saved.');
                exit('ok');
            } else {
                $this->Flash->error('The cms content could not be saved. Please, try again.');
                exit('ko');
            }
        }
    }

    /**
     * This function is invoked in AJAX for saving data related to an meta
     * 
     * @param type $id
     */
    public function saveMeta($id = null) {

        $id = (isset($this->request->data['id'])) ? $this->request->data['id'] : $id;
        $this->CmsContentMeta = TableRegistry::get('CmsContentMeta');
        $meta = $this->CmsContentMeta->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->CmsContentMeta->patchEntity($meta, $this->request->data);
            if ($this->CmsContentMeta->save($meta)) {
                $this->Flash->success('The meta has been saved.');
                exit('ok');
            } else {
                $this->Flash->error('The meta could not be saved. Please, try again.');
                exit('ko');
            }
        }
    }

    /**
     * Controller function
     * 
     * @return boolean
     */
    protected function deleteRelatedContent($id = NULL) {
        $this->CmsContent = TableRegistry::get('CmsContent');
        $content = $this->CmsContent->get($id);
        if (trim($content->content_path) != '')
            $this->_removeFile($content->content_path);
        return $this->CmsContent->delete($content);
    }

    /**
     * Controller function
     * 
     * @return boolean
     */
    protected function deleteRelatedMeta($id = NULL) {
        $this->CmsContentMeta = TableRegistry::get('CmsContentMeta');
        $meta = $this->CmsContentMeta->get($id);
        return $this->CmsContentMeta->delete($meta);
    }

    /**
     * 
     * FILE FUNCTIONS - used for content_type: [ attached | image ]
     * 
     */

    /**
     * Uplodad file in /uploads/YEAR/MONTH directory and create Content record
     * 
     * @param type $inputfile
     * @param string $destfile
     * @return boolean
     */
    public function _uploadFile($inputfile, $destfile = NULL) {

        /**
         * 
         */
        if (strlen(trim($inputfile['name'])) === 0)
            return FALSE;

        /**
         * 
         */
        $filename = strtolower($inputfile['name']);
        $sourcefile = $inputfile['tmp_name'];
        $file = new File($sourcefile, true, 0775);

        /**
         * 
         */
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

        /**
         * Save file in filesystem
         */
        if ($file->copy($destfile, true))
            return $path . $permittedFilename;
        else
            return FALSE;
    }

    /**
     * Remove file
     * 
     * @param type $content_path
     * @return boolean
     */
    protected function _removeFile($content_path) {
        $UPLOAD_DIR = (Configure::check('DEFAULT_UPLOAD_DIR') ? Configure::read('DEFAULT_UPLOAD_DIR') : WWW_ROOT . 'uploads');
        $file = new File($UPLOAD_DIR . $content_path);
        return $file->delete();
    }

    /**
     * Function getPermittedFileName
     * 
     * @param string $path
     * @return string
     */
    private function _permittedFileName($directory, $filename) {

        /**
         * Get $pathInfo from $filename
         */
        $pathInfo = pathinfo($filename);

        /**
         * Max limit permitted $filename
         */
        $pathInfo['filename'] = substr(Inflector::slug($pathInfo['filename']), 0, 100);

        /**
         * Min limit permitted $filename
         */
        if (strlen($pathInfo['filename']) < 3)
            $pathInfo['filename'] = $this->_randomString();

        /**
         * 
         */
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
