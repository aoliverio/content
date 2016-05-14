<?php

namespace Content\Controller;

use Content\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Content Controller
 *
 * @property \Content\Model\Table\CmsContentTable $CmsContent
 */
class ContentController extends AppController {

    /**
     * 
     * 
     * ???????????????????????
     * 
     * 
     * @param type $content_id
     * @param type $params
     */


    
    /**
     * Get permitted content_name for Content
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

        // Return permitted slug Content
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
     * DEPRECATED
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
     * DEPRECATED
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

}
