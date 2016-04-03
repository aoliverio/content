<?php

namespace Content\Controller;

use Content\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * CmsContentUsers Controller
 *
 * @property \Content\Model\Table\CmsContentUsersTable $CmsContentUsers
 */
class CmsContentUsersController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->CmsContentUsers = TableRegistry::get('Content.CmsContentUsers');
        $query = $this->CmsContentUsers->find('all');
        $query->contain(['CmsContents', 'Users']);
        $query->where($this->filteredWhereConditions());        
        $query->limit(1000);
        $this->set('data', $query->toArray());
        $this->set('_serialize', ['data']);
    }
    
    /**
     * View method
     *
     * @param string|null $id Cms Content User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $cmsContentUser = $this->CmsContentUsers->get($id, [
            'contain' => ['CmsContents', 'Users']
        ]);
        $this->set('cmsContentUser', $cmsContentUser);
        $this->set('_serialize', ['cmsContentUser']);
    }
    
    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $cmsContentUser = $this->CmsContentUsers->newEntity();
        if ($this->request->is('post')) {
            $cmsContentUser = $this->CmsContentUsers->patchEntity($cmsContentUser, $this->request->data);
            if ($this->CmsContentUsers->save($cmsContentUser)) {
                $this->Flash->success(__('The cms content user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cms content user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cmsContentUser'));
        $this->set('_serialize', ['cmsContentUser']);
        $this->filteredSelectOptions();
    }
    
    /**
     * Edit method
     *
     * @param string|null $id Cms Content User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $cmsContentUser = $this->CmsContentUsers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cmsContentUser = $this->CmsContentUsers->patchEntity($cmsContentUser, $this->request->data);
            if ($this->CmsContentUsers->save($cmsContentUser)) {
                $this->Flash->success(__('The cms content user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cms content user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cmsContentUser'));
        $this->set('_serialize', ['cmsContentUser']);
        $this->filteredSelectOptions();
    }
    
    /**
     * Delete method
     *
     * @param string|null $id Cms Content User id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $cmsContentUser = $this->CmsContentUsers->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($this->CmsContentUsers->delete($cmsContentUser)) {
                $this->Flash->success(__('The cms content user has been deleted.'));
            } else {
                $this->Flash->error(__('The cms content user could not be deleted. Please, try again.'));
            }
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('cmsContentUser'));
    }
    
    /**
     * Filter method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function filter($action = 'set') {
        $cmsContentUser = $this->CmsContentUsers->newEntity();
        if ($this->request->session()->check('CmsContentUsers')) {
            $session = $this->request->session()->read('CmsContentUsers');
            $cmsContentUser = $this->CmsContentUsers->patchEntity($cmsContentUser,  $session);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($action == 'unset') {
                $this->request->session()->delete('CmsContentUsers');
            } else {
                $this->request->session()->write('CmsContentUsers', $this->request->data);
            }
            $this->Flash->success(__('The cms content user has been saved.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('cmsContentUser'));
        $this->set('_serialize', ['cmsContentUser']);
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
        $cmsContents = $this->CmsContentUsers->CmsContents->find('list', ['limit' => 200]);
        $users = $this->CmsContentUsers->Users->find('list', ['limit' => 200]);
        $this->set(compact('cmsContents', 'users'));
    }
    
}