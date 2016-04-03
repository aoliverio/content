<?php

namespace Content\Controller;

use Content\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * CmsSiteUsers Controller
 *
 * @property \Content\Model\Table\CmsSiteUsersTable $CmsSiteUsers
 */
class CmsSiteUsersController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->CmsSiteUsers = TableRegistry::get('Content.CmsSiteUsers');
        $query = $this->CmsSiteUsers->find('all');
        $query->contain(['CmsSites', 'Users']);
        $query->where($this->filteredWhereConditions());        
        $query->limit(1000);
        $this->set('data', $query->toArray());
        $this->set('_serialize', ['data']);
    }
    
    /**
     * View method
     *
     * @param string|null $id Cms Site User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $cmsSiteUser = $this->CmsSiteUsers->get($id, [
            'contain' => ['CmsSites', 'Users']
        ]);
        $this->set('cmsSiteUser', $cmsSiteUser);
        $this->set('_serialize', ['cmsSiteUser']);
    }
    
    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $cmsSiteUser = $this->CmsSiteUsers->newEntity();
        if ($this->request->is('post')) {
            $cmsSiteUser = $this->CmsSiteUsers->patchEntity($cmsSiteUser, $this->request->data);
            if ($this->CmsSiteUsers->save($cmsSiteUser)) {
                $this->Flash->success(__('The cms site user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cms site user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cmsSiteUser'));
        $this->set('_serialize', ['cmsSiteUser']);
        $this->filteredSelectOptions();
    }
    
    /**
     * Edit method
     *
     * @param string|null $id Cms Site User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $cmsSiteUser = $this->CmsSiteUsers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cmsSiteUser = $this->CmsSiteUsers->patchEntity($cmsSiteUser, $this->request->data);
            if ($this->CmsSiteUsers->save($cmsSiteUser)) {
                $this->Flash->success(__('The cms site user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cms site user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cmsSiteUser'));
        $this->set('_serialize', ['cmsSiteUser']);
        $this->filteredSelectOptions();
    }
    
    /**
     * Delete method
     *
     * @param string|null $id Cms Site User id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $cmsSiteUser = $this->CmsSiteUsers->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($this->CmsSiteUsers->delete($cmsSiteUser)) {
                $this->Flash->success(__('The cms site user has been deleted.'));
            } else {
                $this->Flash->error(__('The cms site user could not be deleted. Please, try again.'));
            }
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('cmsSiteUser'));
    }
    
    /**
     * Filter method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function filter($action = 'set') {
        $cmsSiteUser = $this->CmsSiteUsers->newEntity();
        if ($this->request->session()->check('CmsSiteUsers')) {
            $session = $this->request->session()->read('CmsSiteUsers');
            $cmsSiteUser = $this->CmsSiteUsers->patchEntity($cmsSiteUser,  $session);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($action == 'unset') {
                $this->request->session()->delete('CmsSiteUsers');
            } else {
                $this->request->session()->write('CmsSiteUsers', $this->request->data);
            }
            $this->Flash->success(__('The cms site user has been saved.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('cmsSiteUser'));
        $this->set('_serialize', ['cmsSiteUser']);
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
        $cmsSites = $this->CmsSiteUsers->CmsSites->find('list', ['limit' => 200]);
        $users = $this->CmsSiteUsers->Users->find('list', ['limit' => 200]);
        $this->set(compact('cmsSites', 'users'));
    }
    
}