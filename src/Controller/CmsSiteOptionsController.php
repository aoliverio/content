<?php

namespace Content\Controller;

use Content\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * CmsSiteOptions Controller
 *
 * @property \Content\Model\Table\CmsSiteOptionsTable $CmsSiteOptions
 */
class CmsSiteOptionsController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->CmsSiteOptions = TableRegistry::get('Content.CmsSiteOptions');
        $query = $this->CmsSiteOptions->find('all');
        $query->contain(['CmsSites']);
        $query->where($this->filteredWhereConditions());        
        $query->limit(1000);
        $this->set('data', $query->toArray());
        $this->set('_serialize', ['data']);
    }
    
    /**
     * View method
     *
     * @param string|null $id Cms Site Option id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $cmsSiteOption = $this->CmsSiteOptions->get($id, [
            'contain' => ['CmsSites']
        ]);
        $this->set('cmsSiteOption', $cmsSiteOption);
        $this->set('_serialize', ['cmsSiteOption']);
    }
    
    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $cmsSiteOption = $this->CmsSiteOptions->newEntity();
        if ($this->request->is('post')) {
            $cmsSiteOption = $this->CmsSiteOptions->patchEntity($cmsSiteOption, $this->request->data);
            if ($this->CmsSiteOptions->save($cmsSiteOption)) {
                $this->Flash->success(__('The cms site option has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cms site option could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cmsSiteOption'));
        $this->set('_serialize', ['cmsSiteOption']);
        $this->filteredSelectOptions();
    }
    
    /**
     * Edit method
     *
     * @param string|null $id Cms Site Option id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $cmsSiteOption = $this->CmsSiteOptions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cmsSiteOption = $this->CmsSiteOptions->patchEntity($cmsSiteOption, $this->request->data);
            if ($this->CmsSiteOptions->save($cmsSiteOption)) {
                $this->Flash->success(__('The cms site option has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cms site option could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cmsSiteOption'));
        $this->set('_serialize', ['cmsSiteOption']);
        $this->filteredSelectOptions();
    }
    
    /**
     * Delete method
     *
     * @param string|null $id Cms Site Option id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $cmsSiteOption = $this->CmsSiteOptions->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($this->CmsSiteOptions->delete($cmsSiteOption)) {
                $this->Flash->success(__('The cms site option has been deleted.'));
            } else {
                $this->Flash->error(__('The cms site option could not be deleted. Please, try again.'));
            }
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('cmsSiteOption'));
    }
    
    /**
     * Filter method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function filter($action = 'set') {
        $cmsSiteOption = $this->CmsSiteOptions->newEntity();
        if ($this->request->session()->check('CmsSiteOptions')) {
            $session = $this->request->session()->read('CmsSiteOptions');
            $cmsSiteOption = $this->CmsSiteOptions->patchEntity($cmsSiteOption,  $session);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($action == 'unset') {
                $this->request->session()->delete('CmsSiteOptions');
            } else {
                $this->request->session()->write('CmsSiteOptions', $this->request->data);
            }
            $this->Flash->success(__('The cms site option has been saved.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('cmsSiteOption'));
        $this->set('_serialize', ['cmsSiteOption']);
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
        $cmsSites = $this->CmsSiteOptions->CmsSites->find('list', ['limit' => 200]);
        $this->set(compact('cmsSites'));
    }
    
}