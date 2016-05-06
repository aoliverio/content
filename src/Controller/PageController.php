<?php

namespace Content\Controller;

use Content\Lib\Content;
use Content\Controller\CmsContentsController;
use Cake\ORM\TableRegistry;
use Cake\Controller\Component\AuthComponent;
use Cake\Utility\Inflector;

/**
 * 
 */
class PageController extends CmsContentsController {

    /**
     * List of Pages
     */
    public function index() {
        $this->CmsContents = TableRegistry::get('Content.CmsContents');
        $query = $this->CmsContents->find('all');
        $query->contain(['ParentCmsContents', 'CmsContentStatues', 'CmsContentTypes', 'Authors']);
        $query->where(['CmsContents.cms_content_type_id' => 1]);
        $query->limit(1000);
        $this->set('data', $query->toArray());
        $this->set('_serialize', ['data']);
    }

    /**
     * Create new Page and redirect to Edit template.
     */
    public function add($parent = NULL) {
        $Content = new Content();
        if (intval($Content->id) > 0)
            $this->redirect(['action' => 'edit', $Content->id]);
        else
            exit(__('Error! Unable to create the content.'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Cms Content id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $this->loadModel('CmsContent');
        $cmsContent = $this->CmsContent->get($id, [
            'contain' => []
        ]);

        /**
         * 
         */
        if ($cmsContent->content_type != 'page') :
            $this->Flash->error('The cms content is not PAGE object');
            return $this->redirect(['action' => 'index']);
        endif;

        /**
         * 
         */
        if ($this->request->is(['patch', 'post', 'put'])) {

            /**
             * Before save the Content
             */
            $cmsContent->parent = (intval($this->request->data['parent']) > 0) ? intval($this->request->data['parent']) : 0;
            $cmsContent->name = parent::_permittedContentName($id, trim($this->request->data['name']));
            $cmsContent->content_title = $this->request->data['content_title'];
            $cmsContent->content_description = $this->request->data['content_description'];
            $cmsContent->content_excerpt = '';
            $cmsContent->content_deadline = $this->request->data['content_deadline'];
            $cmsContent->password = $this->request->data['content_password'];
            $cmsContent->content_status = $this->request->data['content_status'];
            $cmsContent->publish_start = $this->request->data['publish_start'];
            $cmsContent->publish_end = $this->request->data['publish_end'];
            $cmsContent->author = '';
            $cmsContent->modified = date('Y-m-d H:i:s');

            /**
             * Default button_publish_action
             */
            if (isset($this->request->data['button_publish_action']))
                $cmsContent->content_status = 'publish';

            if ($this->CmsContent->save($cmsContent)) {

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

        /**
         * 
         */
        $this->set('data', $cmsContent);
        $this->set('_serialize', ['data']);
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

}
