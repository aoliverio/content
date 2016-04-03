<?php

namespace Content\Controller;

use Content\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * CmsTermRoles Controller
 *
 * @property \Content\Model\Table\CmsTermRolesTable $CmsTermRoles
 */
class CmsTermRolesController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->CmsTermRoles = TableRegistry::get('Content.CmsTermRoles');
        $query = $this->CmsTermRoles->find('all');
        $query->contain(['CmsTerms', 'Roles']);
        $query->where($this->filteredWhereConditions());        
        $query->limit(1000);
        $this->set('data', $query->toArray());
        $this->set('_serialize', ['data']);
    }
    
    /**
     * View method
     *
     * @param string|null $id Cms Term Role id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $cmsTermRole = $this->CmsTermRoles->get($id, [
            'contain' => ['CmsTerms', 'Roles']
        ]);
        $this->set('cmsTermRole', $cmsTermRole);
        $this->set('_serialize', ['cmsTermRole']);
    }
    
    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $cmsTermRole = $this->CmsTermRoles->newEntity();
        if ($this->request->is('post')) {
            $cmsTermRole = $this->CmsTermRoles->patchEntity($cmsTermRole, $this->request->data);
            if ($this->CmsTermRoles->save($cmsTermRole)) {
                $this->Flash->success(__('The cms term role has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cms term role could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cmsTermRole'));
        $this->set('_serialize', ['cmsTermRole']);
        $this->filteredSelectOptions();
    }
    
    /**
     * Edit method
     *
     * @param string|null $id Cms Term Role id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $cmsTermRole = $this->CmsTermRoles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cmsTermRole = $this->CmsTermRoles->patchEntity($cmsTermRole, $this->request->data);
            if ($this->CmsTermRoles->save($cmsTermRole)) {
                $this->Flash->success(__('The cms term role has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cms term role could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cmsTermRole'));
        $this->set('_serialize', ['cmsTermRole']);
        $this->filteredSelectOptions();
    }
    
    /**
     * Delete method
     *
     * @param string|null $id Cms Term Role id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $cmsTermRole = $this->CmsTermRoles->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($this->CmsTermRoles->delete($cmsTermRole)) {
                $this->Flash->success(__('The cms term role has been deleted.'));
            } else {
                $this->Flash->error(__('The cms term role could not be deleted. Please, try again.'));
            }
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('cmsTermRole'));
    }
    
    /**
     * Filter method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function filter($action = 'set') {
        $cmsTermRole = $this->CmsTermRoles->newEntity();
        if ($this->request->session()->check('CmsTermRoles')) {
            $session = $this->request->session()->read('CmsTermRoles');
            $cmsTermRole = $this->CmsTermRoles->patchEntity($cmsTermRole,  $session);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($action == 'unset') {
                $this->request->session()->delete('CmsTermRoles');
            } else {
                $this->request->session()->write('CmsTermRoles', $this->request->data);
            }
            $this->Flash->success(__('The cms term role has been saved.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('cmsTermRole'));
        $this->set('_serialize', ['cmsTermRole']);
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
        $cmsTerms = $this->CmsTermRoles->CmsTerms->find('list', ['limit' => 200]);
        $roles = $this->CmsTermRoles->Roles->find('list', ['limit' => 200]);
        $this->set(compact('cmsTerms', 'roles'));
    }
    
}