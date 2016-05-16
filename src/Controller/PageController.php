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
        $content = $this->Content->create(['content_type' => $this->type]);
        if (intval($content->id) > 0)
            $this->redirect(['action' => 'edit', $content->id]);
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
            $cmsContent = $this->Content->get($id, ['contain' => []]);
            if ($cmsContent->cms_content_type_id != $this->type_id) {
                $this->Flash->error(__('The Content type is not page'));
                return $this->redirect(['action' => 'index']);
            }
        }
        
        exit('ok');

        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($this->_saveContent($cmsContent)) {

                /**
                 * Save all related elements
                 */
                if (isset($this->request->data['related']['page']) && count($this->request->data['related']['page']))
                    parent::saveRelatedPage($id, $this->request->data['related']['page']);
                if (isset($this->request->data['related']['attached']) && count($this->request->data['related']['attached']))
                    parent::saveRelatedAttached($id, $this->request->data['related']['attached']);
                if (isset($this->request->data['related']['image']) && count($this->request->data['related']['image']))
                    parent::saveRelatedImage($id, $this->request->data['related']['image']);

                if (isset($this->request->data['related']['meta']) && count($this->request->data['related']['meta']))
                    parent::saveRelatedMeta($id, $this->request->data['related']['meta']);

                /**
                 * Delete related contents
                 */
                if (isset($this->request->data['delete_ck']['content_id']))
                    foreach ($this->request->data['delete_ck']['content_id'] as $key => $val) :
                        parent::deleteRelatedContent($key);
                    endforeach;

                /**
                 * Delete related meta
                 */
                if (isset($this->request->data['delete_ck']['meta_id']))
                    foreach ($this->request->data['delete_ck']['meta_id'] as $key => $val) :
                        parent::deleteRelatedMeta($key);
                    endforeach;

                /**
                 * Set FLASH and redirect
                 */
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
        $cmsContent['parent_page_list'] = $this->_getParentPagesList($id);

        /**
         * Set content_status_list
         */
        $cmsContent['content_status_list'] = ['draft' => 'Draft', 'publish' => 'Publish'];

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


        $this->set('data', $cmsContent);
        $this->set('_serialize', ['data']);
    }

}
