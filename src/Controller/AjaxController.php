<?php

namespace Content\Controller;

use Content\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Ajax Controller
 */
class AjaxController extends AppController {

    /**
     * This function save Content menu order from Post data.
     */
    public function saveContentMenuOrder() {
        $iter = 1;
        $Table = TableRegistry::get('CmsContents');
        if ($this->request->is('post')) :
            $items = explode(',', $this->request->data['order']);
            foreach ($items as $id) :
                $content = $Table->get($id);
                $content->menu_order = $iter++;
                $Table->save($content);
            endforeach;
        endif;
        exit('ok');
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

}
