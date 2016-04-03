<?php

namespace Content\Controller;

use Content\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * CmsContentRoles Controller
 *
 * @property \Content\Model\Table\CmsContentRolesTable $CmsContentRoles
 */
class CmsContentRolesController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->CmsContentRoles = TableRegistry::get('Content.CmsContentRoles');
        $query = $this->CmsContentRoles->find('all');
        $query->contain(['CmsContents', 'Roles']);
        $query->where($this->filteredWhereConditions());        
        $query->limit(1000);
        $this->set('data', $query->toArray());
        $this->set('_serialize', ['data']);
    }
    
    /**
     * View method
     *
     * @param string|null $id Cms Content Role id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $cmsContentRole = $this->CmsContentRoles->get($id, [
            'contain' => ['CmsContents', 'Roles']
        ]);
        $this->set('cmsContentRole', $cmsContentRole);
        $this->set('_serialize', ['cmsContentRole']);
    }
    
    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $cmsContentRole = $this->CmsContentRoles->newEntity();
        if ($this->request->is('post')) {
            $cmsContentRole = $this->CmsContentRoles->patchEntity($cmsContentRole, $this->request->data);
            if ($this->CmsContentRoles->save($cmsContentRole)) {
                $this->Flash->success(__('The cms content role has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cms content role could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cmsContentRole'));
        $this->set('_serialize', ['cmsContentRole']);
        $this->filteredSelectOptions();
    }
    
    /**
     * Edit method
     *
     * @param string|null $id Cms Content Role id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $cmsContentRole = $this->CmsContentRoles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cmsContentRole = $this->CmsContentRoles->patchEntity($cmsContentRole, $this->request->data);
            if ($this->CmsContentRoles->save($cmsContentRole)) {
                $this->Flash->success(__('The cms content role has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cms content role could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cmsContentRole'));
        $this->set('_serialize', ['cmsContentRole']);
        $this->filteredSelectOptions();
    }
    
    /**
     * Delete method
     *
     * @param string|null $id Cms Content Role id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $cmsContentRole = $this->CmsContentRoles->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($this->CmsContentRoles->delete($cmsContentRole)) {
                $this->Flash->success(__('The cms content role has been deleted.'));
            } else {
                $this->Flash->error(__('The cms content role could not be deleted. Please, try again.'));
            }
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('cmsContentRole'));
    }
    
    /**
     * Filter method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function filter($action = 'set') {
        $cmsContentRole = $this->CmsContentRoles->newEntity();
        if ($this->request->session()->check('CmsContentRoles')) {
            $session = $this->request->session()->read('CmsContentRoles');
            $cmsContentRole = $this->CmsContentRoles->patchEntity($cmsContentRole,  $session);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($action == 'unset') {
                $this->request->session()->delete('CmsContentRoles');
            } else {
                $this->request->session()->write('CmsContentRoles', $this->request->data);
            }
            $this->Flash->success(__('The cms content role has been saved.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('cmsContentRole'));
        $this->set('_serialize', ['cmsContentRole']);
    }

    /**
     * This function is used to filter where conditions
     * 
     * @return type
     */
    public function filteredWhereConditions() {
        $filter = [];
        return $filter;
    }

    /**
     * This function is used to filter select options
     */
    public function filteredSelectOptions() {
        $cmsContents = $this->CmsContentRoles->CmsContents->find('list', ['limit' => 200]);
        $roles = $this->CmsContentRoles->Roles->find('list', ['limit' => 200]);
        $this->set(compact('cmsContents', 'roles'));
    }
    
}