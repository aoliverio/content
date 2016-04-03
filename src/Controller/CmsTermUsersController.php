<?php

namespace Content\Controller;

use Content\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * CmsTermUsers Controller
 *
 * @property \Content\Model\Table\CmsTermUsersTable $CmsTermUsers
 */
class CmsTermUsersController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->CmsTermUsers = TableRegistry::get('Content.CmsTermUsers');
        $query = $this->CmsTermUsers->find('all');
        $query->contain(['CmsTerms', 'Users']);
        $query->where($this->filteredWhereConditions());        
        $query->limit(1000);
        $this->set('data', $query->toArray());
        $this->set('_serialize', ['data']);
    }
    
    /**
     * View method
     *
     * @param string|null $id Cms Term User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $cmsTermUser = $this->CmsTermUsers->get($id, [
            'contain' => ['CmsTerms', 'Users']
        ]);
        $this->set('cmsTermUser', $cmsTermUser);
        $this->set('_serialize', ['cmsTermUser']);
    }
    
    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $cmsTermUser = $this->CmsTermUsers->newEntity();
        if ($this->request->is('post')) {
            $cmsTermUser = $this->CmsTermUsers->patchEntity($cmsTermUser, $this->request->data);
            if ($this->CmsTermUsers->save($cmsTermUser)) {
                $this->Flash->success(__('The cms term user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cms term user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cmsTermUser'));
        $this->set('_serialize', ['cmsTermUser']);
        $this->filteredSelectOptions();
    }
    
    /**
     * Edit method
     *
     * @param string|null $id Cms Term User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $cmsTermUser = $this->CmsTermUsers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cmsTermUser = $this->CmsTermUsers->patchEntity($cmsTermUser, $this->request->data);
            if ($this->CmsTermUsers->save($cmsTermUser)) {
                $this->Flash->success(__('The cms term user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cms term user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cmsTermUser'));
        $this->set('_serialize', ['cmsTermUser']);
        $this->filteredSelectOptions();
    }
    
    /**
     * Delete method
     *
     * @param string|null $id Cms Term User id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $cmsTermUser = $this->CmsTermUsers->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($this->CmsTermUsers->delete($cmsTermUser)) {
                $this->Flash->success(__('The cms term user has been deleted.'));
            } else {
                $this->Flash->error(__('The cms term user could not be deleted. Please, try again.'));
            }
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('cmsTermUser'));
    }
    
    /**
     * Filter method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function filter($action = 'set') {
        $cmsTermUser = $this->CmsTermUsers->newEntity();
        if ($this->request->session()->check('CmsTermUsers')) {
            $session = $this->request->session()->read('CmsTermUsers');
            $cmsTermUser = $this->CmsTermUsers->patchEntity($cmsTermUser,  $session);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($action == 'unset') {
                $this->request->session()->delete('CmsTermUsers');
            } else {
                $this->request->session()->write('CmsTermUsers', $this->request->data);
            }
            $this->Flash->success(__('The cms term user has been saved.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('cmsTermUser'));
        $this->set('_serialize', ['cmsTermUser']);
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
        $cmsTerms = $this->CmsTermUsers->CmsTerms->find('list', ['limit' => 200]);
        $users = $this->CmsTermUsers->Users->find('list', ['limit' => 200]);
        $this->set(compact('cmsTerms', 'users'));
    }
    
}