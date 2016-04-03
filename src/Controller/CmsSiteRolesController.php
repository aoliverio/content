<?php

namespace Content\Controller;

use Content\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * CmsSiteRoles Controller
 *
 * @property \Content\Model\Table\CmsSiteRolesTable $CmsSiteRoles
 */
class CmsSiteRolesController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->CmsSiteRoles = TableRegistry::get('Content.CmsSiteRoles');
        $query = $this->CmsSiteRoles->find('all');
        $query->contain(['CmsSites', 'Roles']);
        $query->where($this->filteredWhereConditions());        
        $query->limit(1000);
        $this->set('data', $query->toArray());
        $this->set('_serialize', ['data']);
    }
    
    /**
     * View method
     *
     * @param string|null $id Cms Site Role id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $cmsSiteRole = $this->CmsSiteRoles->get($id, [
            'contain' => ['CmsSites', 'Roles']
        ]);
        $this->set('cmsSiteRole', $cmsSiteRole);
        $this->set('_serialize', ['cmsSiteRole']);
    }
    
    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $cmsSiteRole = $this->CmsSiteRoles->newEntity();
        if ($this->request->is('post')) {
            $cmsSiteRole = $this->CmsSiteRoles->patchEntity($cmsSiteRole, $this->request->data);
            if ($this->CmsSiteRoles->save($cmsSiteRole)) {
                $this->Flash->success(__('The cms site role has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cms site role could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cmsSiteRole'));
        $this->set('_serialize', ['cmsSiteRole']);
        $this->filteredSelectOptions();
    }
    
    /**
     * Edit method
     *
     * @param string|null $id Cms Site Role id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $cmsSiteRole = $this->CmsSiteRoles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cmsSiteRole = $this->CmsSiteRoles->patchEntity($cmsSiteRole, $this->request->data);
            if ($this->CmsSiteRoles->save($cmsSiteRole)) {
                $this->Flash->success(__('The cms site role has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cms site role could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cmsSiteRole'));
        $this->set('_serialize', ['cmsSiteRole']);
        $this->filteredSelectOptions();
    }
    
    /**
     * Delete method
     *
     * @param string|null $id Cms Site Role id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $cmsSiteRole = $this->CmsSiteRoles->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($this->CmsSiteRoles->delete($cmsSiteRole)) {
                $this->Flash->success(__('The cms site role has been deleted.'));
            } else {
                $this->Flash->error(__('The cms site role could not be deleted. Please, try again.'));
            }
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('cmsSiteRole'));
    }
    
    /**
     * Filter method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function filter($action = 'set') {
        $cmsSiteRole = $this->CmsSiteRoles->newEntity();
        if ($this->request->session()->check('CmsSiteRoles')) {
            $session = $this->request->session()->read('CmsSiteRoles');
            $cmsSiteRole = $this->CmsSiteRoles->patchEntity($cmsSiteRole,  $session);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($action == 'unset') {
                $this->request->session()->delete('CmsSiteRoles');
            } else {
                $this->request->session()->write('CmsSiteRoles', $this->request->data);
            }
            $this->Flash->success(__('The cms site role has been saved.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('cmsSiteRole'));
        $this->set('_serialize', ['cmsSiteRole']);
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
        $cmsSites = $this->CmsSiteRoles->CmsSites->find('list', ['limit' => 200]);
        $roles = $this->CmsSiteRoles->Roles->find('list', ['limit' => 200]);
        $this->set(compact('cmsSites', 'roles'));
    }
    
}