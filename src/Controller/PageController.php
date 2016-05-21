<?php

namespace Content\Controller;

use Content\Lib\Content;
use Content\Controller\AppController;
use Content\Controller\CmsContentsController;
use Cake\ORM\TableRegistry;
use Cake\Controller\Component\AuthComponent;
use Cake\Utility\Inflector;

/**
 * 
 */
class PageController extends AppController {

    /**
     * Use Content\Lib\Content.
     *
     * @var type 
     */
    public $Content = null;

    /**
     * Define Content type_id.
     *
     * @var type 
     */
    public $type_id = 1;

    /**
     * Define Content limit.
     *
     * @var type 
     */
    public $limit = 1000;

    /**
     * Initilize
     */
    public function initialize() {
        parent::initialize();
        $this->Content = new Content();
    }

    /**
     * Retrieve the list of Content, and loads the template for the view in list.
     */
    public function index() {
        $this->set('data', $this->Content->find(['type_id' => $this->type_id, 'limit' => $this->limit]));
        $this->set('_serialize', ['data']);
    }

    /**
     * Create new Content and redirect to edit controller.
     * 
     * @param type $parent
     */
    public function add($parent = null) {
        $content_id = $this->Content->create(['content_type' => $this->type_id]);
        if (intval($content_id) > 0)
            $this->redirect(['action' => 'edit', $content_id]);
        else
            exit(__('Error! Unable to create the content.'));
    }

    /**
     * Edit and save a specific type 'page' Content.
     *
     * @param string|null $id Cms Content id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {

        if ($id) {
            $content = $this->Content->get($id);
            if ($content->cms_content_type_id != $this->type_id) {
                $this->Flash->error(__('The Content type is not page'));
                return $this->redirect(['action' => 'index']);
            }
        }

        exit('ok');

        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($this->_saveContent($cmsContent)) {

                if (isset($this->request->data['related']['page']) && count($this->request->data['related']['page']))
                    $this->_saveRelatedPages($id, $this->request->data['related']['page']);
                if (isset($this->request->data['related']['attached']) && count($this->request->data['related']['attached']))
                    $this->_saveRelatedAttachments($id, $this->request->data['related']['attached']);
                if (isset($this->request->data['related']['image']) && count($this->request->data['related']['image']))
                    $this->_saveRelatedImages($id, $this->request->data['related']['image']);

                if (isset($this->request->data['related']['meta']) && count($this->request->data['related']['meta']))
                    $this->Content->saveOptions($id, $this->request->data['related']['meta']);

                if (isset($this->request->data['delete_ck']['content_id'])) {
                    foreach ($this->request->data['delete_ck']['content_id'] as $key => $val) :
                        $this->Content->delete($key);
                    endforeach;
                }

                if (isset($this->request->data['delete_ck']['meta_id'])) {
                    foreach ($this->request->data['delete_ck']['meta_id'] as $key => $val) :
                        $this->Content->deleteOption($key);
                    endforeach;
                }

                $this->Flash->success('The cms content has been saved.');

                if (isset($this->request->data['button_save_action']))
                    return $this->redirect(['action' => 'edit', $id]);
                else
                    return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The cms content could not be saved. Please, try again.');
            }
        }

        /**
         * Set parent_page_list
         */
        $cmsContent['parent_page_list'] = $this->_getPagesList($id);

        /**
         * Set content_status_list
         */
        $cmsContent['content_status_list'] = ['1' => 'Draft', '2' => 'Publish'];

        /**
         * Set list of taxonomy
         */
        $where = ['taxonomy' => 'page'];
        $cmsContent['list_of_taxonomy'] = parent::getListOfTaxonomy($where);

        /**
         * Set list of taxonomy checked
         */
        $relationTable = TableRegistry::get('CmsTermRelation');
        $query = $relationTable->find()
                ->select(['cms_term_taxonomy_id'])
                ->where(['cms_content_id' => $id]);
        $cmsContent['list_of_taxonomy_checked'] = $query->all();

        /**
         * Set list of user
         */
        $cmsContent['list_of_user'] = parent::getListOfUser();

        /**
         * Set list of user checked
         */
        $cmsPermissionTable = TableRegistry::get('CmsPermission');
        $query = $cmsPermissionTable->find()
                ->select(['sys_user_id'])
                ->where(['cms_content_id' => $id]);
        $cmsContent['list_of_user_checked'] = $query->all();

        /**
         * Set list of role
         */
        $cmsContent['list_of_role'] = parent::getListOfRole();

        /**
         * Set list of role checked
         */
        $cmsPermissionTable = TableRegistry::get('CmsPermission');
        $query = $cmsPermissionTable->find()
                ->select(['sys_role_id'])
                ->where(['cms_content_id' => $id]);
        $cmsContent['list_of_role_checked'] = $query->all();

        /**
         * Create related array
         */
        $cmsContent['related'] = array();

        /**
         * Set related page
         */
        $where = ['parent' => $id, 'content_type' => 'page'];
        $cmsContent['related']['page'] = parent::getListOfContent($where);

        /**
         * Set related image
         */
        $where = ['parent' => $id, 'content_type' => 'image'];
        $cmsContent['related']['image'] = parent::getListOfContent($where);

        /**
         * Set related attached
         */
        $where = ['parent' => $id, 'content_type' => 'attached'];
        $cmsContent['related']['attached'] = parent::getListOfContent($where);

        /**
         * Set related meta
         */
        $where = ['cms_content_id' => $id];
        $cmsContent['related']['meta'] = parent::getListOfMeta($where);

        $cmsContent['content_status_list'] = [
            '1' => 'Draft',
            '2' => 'Publish'
        ];

        $this->set('data', $cmsContent);
        $this->set('_serialize', ['data']);
    }

    /*
     * Manage related Content with protected functions
     * 
     */

    /**
     * This function is used to save related pages of Content.
     * 
     * @param type $parent
     * @param type $items
     */
    protected function _saveRelatedPages($parent_id, $items) {

        $type_id = 1;   // Page
        $status_id = 1; // Draft

        foreach ($items as $row) :
            if ($row['content_title'] != '') :
                $row['parent_id'] = $parent_id;
                $row['cms_content_type_id'] = $type_id;
                $row['cms_content_status_id'] = $status_id;
                $row['menu_order'] = $this->Content->_getNextMenuOrder($parent_id, $type_id);
                $this->Content->create($row);
            endif;
        endforeach;
    }

    /**
     * This function is used to save attachments of Content.
     *  
     * @param type $parent
     * @param type $items
     */
    protected function _saveRelatedAttachments($parent_id, $items) {

        $type_id = 3;   // Attached
        $status_id = 3; // Inherithed

        foreach ($items as $row) :
            $CONTENT_PATH = $this->_uploadFile($row['content_path']);
            if ($CONTENT_PATH) :
                $PATHINFO = pathinfo($CONTENT_PATH);
                $row['content_title'] = (trim($row['content_title']) == '') ? Inflector::humanize($PATHINFO['filename']) : trim($row['content_title']);
                $row['parent_id'] = $parent_id;
                $row['cms_content_type_id'] = $type_id;
                $row['cms_content_status_id'] = $status_id;
                $row['content_path'] = $CONTENT_PATH;
                $row['menu_order'] = $this->Content->_getNextMenuOrder($parent_id, $type_id);
                $this->Content->create($row);
            endif;
        endforeach;
    }

    /**
     * This function is used to save images of Content.
     * 
     * @param type $parent
     * @param type $items
     */
    protected function _saveRelatedImages($parent_id, $items) {

        $type_id = 4;   // Image
        $status_id = 3; // Inherited

        foreach ($items as $item) :
            $CONTENT_PATH = $this->_uploadFile($row['content_path']);
            if ($CONTENT_PATH) :
                $PATHINFO = pathinfo($CONTENT_PATH);
                $item['content_title'] = (trim($row['content_title']) == '') ? Inflector::humanize($PATHINFO['filename']) : trim($row['content_title']);
                $item['parent_id'] = $parent_id;
                $item['cms_content_type_id'] = $type_id;
                $item['cms_content_status_id'] = $status_id;
                $item['content_path'] = $CONTENT_PATH;
                $item['menu_order'] = $this->Content->_getNextMenuOrder($parent_id, $type_id);
                $this->Content->create($item);
            endif;
        endforeach;
    }

    /**
     * 
     * Manage Content options
     * 
     */

    /**
     * Controller function
     * 
     * @param type $content_id
     * @param type $items
     */
    protected function _saveRelatedOption($content_id, $items) {
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
     * 
     * AJAX functions
     * 
     */

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
     * 
     * 
     */

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
        $userTable = TableRegistry::get('SysUser');
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
        $roleTable = TableRegistry::get('SysRole');
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

    /*
     * This function provides the {key, value} of the 'page' Content type.
     * 
     * 
     * @param type $content_id
     * @return type
     */

    protected function _getPagesList($id) {

        $data = [];

        $Table = TableRegistry::get('CmsContents');
        $query = $Table->find('all')
                ->where(['id <>' => $id, 'cms_content_type_id' => $this->type_id]);

        foreach ($query->toArray() as $row):
            $data[$row->id] = '[' . $row->id . '] ' . $row->name;
        endforeach;

        return $data;
    }

}
