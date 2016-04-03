<?php

namespace Content\Controller;

use Content\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * CmsSites Controller
 *
 * @property \Content\Model\Table\CmsSitesTable $CmsSites
 */
class CmsSitesController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->CmsSites = TableRegistry::get('Content.CmsSites');
        $query = $this->CmsSites->find('all');
        $query->where($this->filteredWhereConditions());        
        $query->limit(1000);
        $this->set('data', $query->toArray());
        $this->set('_serialize', ['data']);
    }
    
    /**
     * View method
     *
     * @param string|null $id Cms Site id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $cmsSite = $this->CmsSites->get($id, [
            'contain' => ['CmsSiteOptions', 'CmsSiteUsers', 'CmsTerms']
        ]);
        $this->set('cmsSite', $cmsSite);
        $this->set('_serialize', ['cmsSite']);
    }
    
    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $cmsSite = $this->CmsSites->newEntity();
        if ($this->request->is('post')) {
            $cmsSite = $this->CmsSites->patchEntity($cmsSite, $this->request->data);
            if ($this->CmsSites->save($cmsSite)) {
                $this->Flash->success(__('The cms site has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cms site could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cmsSite'));
        $this->set('_serialize', ['cmsSite']);
        $this->filteredSelectOptions();
    }
    
    /**
     * Edit method
     *
     * @param string|null $id Cms Site id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $cmsSite = $this->CmsSites->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cmsSite = $this->CmsSites->patchEntity($cmsSite, $this->request->data);
            if ($this->CmsSites->save($cmsSite)) {
                $this->Flash->success(__('The cms site has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cms site could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cmsSite'));
        $this->set('_serialize', ['cmsSite']);
        $this->filteredSelectOptions();
    }
    
    /**
     * Delete method
     *
     * @param string|null $id Cms Site id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $cmsSite = $this->CmsSites->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($this->CmsSites->delete($cmsSite)) {
                $this->Flash->success(__('The cms site has been deleted.'));
            } else {
                $this->Flash->error(__('The cms site could not be deleted. Please, try again.'));
            }
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('cmsSite'));
    }
    
    /**
     * Filter method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function filter($action = 'set') {
        $cmsSite = $this->CmsSites->newEntity();
        if ($this->request->session()->check('CmsSites')) {
            $session = $this->request->session()->read('CmsSites');
            $cmsSite = $this->CmsSites->patchEntity($cmsSite,  $session);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($action == 'unset') {
                $this->request->session()->delete('CmsSites');
            } else {
                $this->request->session()->write('CmsSites', $this->request->data);
            }
            $this->Flash->success(__('The cms site has been saved.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('cmsSite'));
        $this->set('_serialize', ['cmsSite']);
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
        return false;
    }
    
}