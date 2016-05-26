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
            $cmsContent = $this->Content->get($id);
            if ($cmsContent->cms_content_type_id != $this->type_id) {
                $this->Flash->error(__('The Content type is not page'));
                return $this->redirect(['action' => 'index']);
            }
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            
            if(!isset($this->request->data['id']))
                $this->request->data['id'] = $id;
            
            if ($this->Content->save($this->request->data)) {

                if (isset($this->request->data['related']['page']) && count($this->request->data['related']['page'])) {
                    $items = $this->request->data['related']['page'];
                    $params = ['parent_id' => $id, 'cms_content_type_id' => 1, 'cms_content_status_id' => 1];
                    $this->Content->saveRelatedItems($id, $items, $params);
                }

                if (isset($this->request->data['related']['attached']) && count($this->request->data['related']['attached'])) {
                    $items = $this->request->data['related']['attached'];
                    $params = ['parent_id' => $id, 'cms_content_type_id' => 3, 'cms_content_status_id' => 3];
                    $this->Content->saveRelatedItems($id, $items, $params);
                }

                if (isset($this->request->data['related']['image']) && count($this->request->data['related']['image'])) {
                    $items = $this->request->data['related']['image'];
                    $params = ['parent_id' => $id, 'cms_content_type_id' => 4, 'cms_content_status_id' => 3];
                    $this->Content->saveRelatedItems($id, $items, $params);
                }

                if (isset($this->request->data['related']['option']) && count($this->request->data['related']['option'])) {
                    $this->Content->saveRelatedOptions($id, $this->request->data['related']['option']);
                }

                if (isset($this->request->data['delete_ck']['content_id'])) {
                    foreach ($this->request->data['delete_ck']['content_id'] as $key => $val) :
                        $this->Content->delete($key);
                    endforeach;
                }

                if (isset($this->request->data['delete_ck']['option_id'])) {
                    foreach ($this->request->data['delete_ck']['option_id'] as $key => $val) :
                        $this->Content->deleteRelatedOption($key);
                    endforeach;
                }

                $this->Flash->success('The cms content has been saved.');

                if (isset($this->request->data['button_save_action'])) {
                    return $this->redirect(['action' => 'edit', $id]);
                } else {
                    return $this->redirect(['action' => 'index']);
                }                
            } else {
                $this->Flash->error('The cms content could not be saved. Please, try again.');
                return $this->redirect(['action' => 'edit', $id]);
            }
        }

        $cmsContent['parent_page_list'] = $this->Content->getPageList($id);
        $cmsContent['content_status_list'] = ['1' => 'Draft', '2' => 'Published'];

        $cmsContent['list_of_taxonomy'] = $this->Content->getTaxonomies($id);
        $cmsContent['list_of_taxonomy_checked'] = $this->Content->getCheckedTaxonomies($id);

        $cmsContent['list_of_user'] = $this->Content->getUsers($id);
        $cmsContent['list_of_user_checked'] = $this->Content->getCheckedUsers($id);

        $cmsContent['list_of_role'] = $this->Content->getRoles($id);
        $cmsContent['list_of_role_checked'] = $this->Content->getCheckedRoles($id);

        $cmsContent['related'] = array();
        $cmsContent['related']['page'] = $this->Content->getRelatedItems($id, ['cms_content_type_id' => 1]);
        $cmsContent['related']['attached'] = $this->Content->getRelatedItems($id, ['cms_content_type_id' => 3]);
        $cmsContent['related']['image'] = $this->Content->getRelatedItems($id, ['cms_content_type_id' => 4]);
        $cmsContent['related']['option'] = $this->Content->getRelatedOptions($id);

        $this->set('data', $cmsContent);
        $this->set('_serialize', ['data']);
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
    public function addRelatedOptionBlock($id = 1) {
        $this->set('id', $id);
        $this->viewBuilder()->layout('ajax');
        $this->viewBuilder()->template('block_add_related_option');
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
    public function editRelatedOption($id) {
        $this->CmsContentOption = TableRegistry::get('CmsContentOption');
        $option = $this->CmsContentOption->get($id, ['contain' => []]);
        $this->set('data', $option);
        $this->set('_serialize', ['data']);
        $this->viewBuilder()->layout('ajax');
        $this->viewBuilder()->template('block_edit_related_option');
    }

    /**
     * This function is invoked in AJAX to save the ordering of the related elements
     * 
     * @return boolean
     */
    public function saveContentsOrder() {
        $ITER = 1;
        $contentTable = TableRegistry::get('CmsContents');
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
     * This function is invoked in AJAX to save the ordering of the related options
     * 
     * @return boolean
     */
    public function saveOptionsOrder() {
        $ITER = 1;
        $contentTable = TableRegistry::get('CmsContentOptions');
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
     * @param type $content_id
     * @param type $sys_user_id
     */
    public function setUserPermit($content_id, $user_id) {
        $permissionTable = TableRegistry::get('CmsContentUsers');
        $permission = $permissionTable->newEntity();
        $permission->cms_content_id = $content_id;
        $permission->user_id = $user_id;
        $permissionTable->save($permission);
        exit('ok');
    }

    /**
     * 
     * 
     * @param type $content_id
     * @param type $sys_user_id
     */
    public function unsetUserPermit($content_id, $user_id) {
        $permissionTable = TableRegistry::get('CmsContentUsers');
        $permissionTable->deleteAll(['cms_content_id' => $content_id, 'user_id' => $user_id]);
        exit('ok');
    }

    /**
     * 
     * 
     * @param type $content_id
     * @param type $sys_user_id
     */
    public function setRolePermit($content_id, $role_id) {
        $permissionTable = TableRegistry::get('CmsContentRoles');
        $permission = $permissionTable->newEntity();
        $permission->cms_content_id = $content_id;
        $permission->role_id = $role_id;
        $permissionTable->save($permission);
        exit('ok');
    }

    /**
     * 
     * 
     * @param type $content_id
     * @param type $sys_user_id
     */
    public function unsetRolePermit($content_id, $role_id) {
        $permissionTable = TableRegistry::get('CmsContentRoles');
        $permissionTable->deleteAll(['cms_content_id' => $content_id, 'role_id' => $role_id]);
        exit('ok');
    }

    /**
     * 
     * 
     * Funzioni da spostare in Lib\Content
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
    public function getListOfOption($where = array(), $limit = 1000) {
        $optionTable = TableRegistry::get('CmsContentOption');
        $query = $optionTable->find('all')
                ->where($where)
                ->order('priority')
                ->limit($limit);
        return $query->all();
    }

}
