<?php

namespace Content\Controller;

use Content\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * CmsContentStatues Controller
 *
 * @property \Content\Model\Table\CmsContentStatuesTable $CmsContentStatues
 */
class CmsContentStatuesController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->CmsContentStatues = TableRegistry::get('Content.CmsContentStatues');
        $query = $this->CmsContentStatues->find('all');
        $query->where($this->filteredWhereConditions());        
        $query->limit(1000);
        $this->set('data', $query->toArray());
        $this->set('_serialize', ['data']);
    }
    
    /**
     * View method
     *
     * @param string|null $id Cms Content Statue id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $cmsContentStatue = $this->CmsContentStatues->get($id, [
            'contain' => []
        ]);
        $this->set('cmsContentStatue', $cmsContentStatue);
        $this->set('_serialize', ['cmsContentStatue']);
    }
    
    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $cmsContentStatue = $this->CmsContentStatues->newEntity();
        if ($this->request->is('post')) {
            $cmsContentStatue = $this->CmsContentStatues->patchEntity($cmsContentStatue, $this->request->data);
            if ($this->CmsContentStatues->save($cmsContentStatue)) {
                $this->Flash->success(__('The cms content statue has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cms content statue could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cmsContentStatue'));
        $this->set('_serialize', ['cmsContentStatue']);
        $this->filteredSelectOptions();
    }
    
    /**
     * Edit method
     *
     * @param string|null $id Cms Content Statue id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $cmsContentStatue = $this->CmsContentStatues->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cmsContentStatue = $this->CmsContentStatues->patchEntity($cmsContentStatue, $this->request->data);
            if ($this->CmsContentStatues->save($cmsContentStatue)) {
                $this->Flash->success(__('The cms content statue has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cms content statue could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cmsContentStatue'));
        $this->set('_serialize', ['cmsContentStatue']);
        $this->filteredSelectOptions();
    }
    
    /**
     * Delete method
     *
     * @param string|null $id Cms Content Statue id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $cmsContentStatue = $this->CmsContentStatues->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($this->CmsContentStatues->delete($cmsContentStatue)) {
                $this->Flash->success(__('The cms content statue has been deleted.'));
            } else {
                $this->Flash->error(__('The cms content statue could not be deleted. Please, try again.'));
            }
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('cmsContentStatue'));
    }
    
    /**
     * Filter method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function filter($action = 'set') {
        $cmsContentStatue = $this->CmsContentStatues->newEntity();
        if ($this->request->session()->check('CmsContentStatues')) {
            $session = $this->request->session()->read('CmsContentStatues');
            $cmsContentStatue = $this->CmsContentStatues->patchEntity($cmsContentStatue,  $session);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($action == 'unset') {
                $this->request->session()->delete('CmsContentStatues');
            } else {
                $this->request->session()->write('CmsContentStatues', $this->request->data);
            }
            $this->Flash->success(__('The cms content statue has been saved.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('cmsContentStatue'));
        $this->set('_serialize', ['cmsContentStatue']);
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