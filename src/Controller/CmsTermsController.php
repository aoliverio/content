<?php

namespace Content\Controller;

use Content\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * CmsTerms Controller
 *
 * @property \Content\Model\Table\CmsTermsTable $CmsTerms
 */
class CmsTermsController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->CmsTerms = TableRegistry::get('Content.CmsTerms');
        $query = $this->CmsTerms->find('all');
        $query->contain(['CmsSites']);
        $query->where($this->filteredWhereConditions());        
        $query->limit(1000);
        $this->set('data', $query->toArray());
        $this->set('_serialize', ['data']);
    }
    
    /**
     * View method
     *
     * @param string|null $id Cms Term id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $cmsTerm = $this->CmsTerms->get($id, [
            'contain' => ['CmsSites', 'CmsTermTaxonomies', 'CsmTermUsers']
        ]);
        $this->set('cmsTerm', $cmsTerm);
        $this->set('_serialize', ['cmsTerm']);
    }
    
    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $cmsTerm = $this->CmsTerms->newEntity();
        if ($this->request->is('post')) {
            $cmsTerm = $this->CmsTerms->patchEntity($cmsTerm, $this->request->data);
            if ($this->CmsTerms->save($cmsTerm)) {
                $this->Flash->success(__('The cms term has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cms term could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cmsTerm'));
        $this->set('_serialize', ['cmsTerm']);
        $this->filteredSelectOptions();
    }
    
    /**
     * Edit method
     *
     * @param string|null $id Cms Term id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $cmsTerm = $this->CmsTerms->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cmsTerm = $this->CmsTerms->patchEntity($cmsTerm, $this->request->data);
            if ($this->CmsTerms->save($cmsTerm)) {
                $this->Flash->success(__('The cms term has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cms term could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cmsTerm'));
        $this->set('_serialize', ['cmsTerm']);
        $this->filteredSelectOptions();
    }
    
    /**
     * Delete method
     *
     * @param string|null $id Cms Term id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $cmsTerm = $this->CmsTerms->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($this->CmsTerms->delete($cmsTerm)) {
                $this->Flash->success(__('The cms term has been deleted.'));
            } else {
                $this->Flash->error(__('The cms term could not be deleted. Please, try again.'));
            }
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('cmsTerm'));
    }
    
    /**
     * Filter method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function filter($action = 'set') {
        $cmsTerm = $this->CmsTerms->newEntity();
        if ($this->request->session()->check('CmsTerms')) {
            $session = $this->request->session()->read('CmsTerms');
            $cmsTerm = $this->CmsTerms->patchEntity($cmsTerm,  $session);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($action == 'unset') {
                $this->request->session()->delete('CmsTerms');
            } else {
                $this->request->session()->write('CmsTerms', $this->request->data);
            }
            $this->Flash->success(__('The cms term has been saved.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('cmsTerm'));
        $this->set('_serialize', ['cmsTerm']);
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
        $cmsSites = $this->CmsTerms->CmsSites->find('list', ['limit' => 200]);
        $this->set(compact('cmsSites'));
    }
    
}