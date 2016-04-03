<?php

namespace Content\Controller;

use Content\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * CmsTermRelationships Controller
 *
 * @property \Content\Model\Table\CmsTermRelationshipsTable $CmsTermRelationships
 */
class CmsTermRelationshipsController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->CmsTermRelationships = TableRegistry::get('Content.CmsTermRelationships');
        $query = $this->CmsTermRelationships->find('all');
        $query->contain(['CmsContents', 'CmsTermTaxonomies']);
        $query->where($this->filteredWhereConditions());        
        $query->limit(1000);
        $this->set('data', $query->toArray());
        $this->set('_serialize', ['data']);
    }
    
    /**
     * View method
     *
     * @param string|null $id Cms Term Relationship id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $cmsTermRelationship = $this->CmsTermRelationships->get($id, [
            'contain' => ['CmsContents', 'CmsTermTaxonomies']
        ]);
        $this->set('cmsTermRelationship', $cmsTermRelationship);
        $this->set('_serialize', ['cmsTermRelationship']);
    }
    
    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $cmsTermRelationship = $this->CmsTermRelationships->newEntity();
        if ($this->request->is('post')) {
            $cmsTermRelationship = $this->CmsTermRelationships->patchEntity($cmsTermRelationship, $this->request->data);
            if ($this->CmsTermRelationships->save($cmsTermRelationship)) {
                $this->Flash->success(__('The cms term relationship has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cms term relationship could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cmsTermRelationship'));
        $this->set('_serialize', ['cmsTermRelationship']);
        $this->filteredSelectOptions();
    }
    
    /**
     * Edit method
     *
     * @param string|null $id Cms Term Relationship id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $cmsTermRelationship = $this->CmsTermRelationships->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cmsTermRelationship = $this->CmsTermRelationships->patchEntity($cmsTermRelationship, $this->request->data);
            if ($this->CmsTermRelationships->save($cmsTermRelationship)) {
                $this->Flash->success(__('The cms term relationship has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cms term relationship could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cmsTermRelationship'));
        $this->set('_serialize', ['cmsTermRelationship']);
        $this->filteredSelectOptions();
    }
    
    /**
     * Delete method
     *
     * @param string|null $id Cms Term Relationship id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $cmsTermRelationship = $this->CmsTermRelationships->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($this->CmsTermRelationships->delete($cmsTermRelationship)) {
                $this->Flash->success(__('The cms term relationship has been deleted.'));
            } else {
                $this->Flash->error(__('The cms term relationship could not be deleted. Please, try again.'));
            }
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('cmsTermRelationship'));
    }
    
    /**
     * Filter method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function filter($action = 'set') {
        $cmsTermRelationship = $this->CmsTermRelationships->newEntity();
        if ($this->request->session()->check('CmsTermRelationships')) {
            $session = $this->request->session()->read('CmsTermRelationships');
            $cmsTermRelationship = $this->CmsTermRelationships->patchEntity($cmsTermRelationship,  $session);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($action == 'unset') {
                $this->request->session()->delete('CmsTermRelationships');
            } else {
                $this->request->session()->write('CmsTermRelationships', $this->request->data);
            }
            $this->Flash->success(__('The cms term relationship has been saved.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('cmsTermRelationship'));
        $this->set('_serialize', ['cmsTermRelationship']);
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
        $cmsContents = $this->CmsTermRelationships->CmsContents->find('list', ['limit' => 200]);
        $cmsTermTaxonomies = $this->CmsTermRelationships->CmsTermTaxonomies->find('list', ['limit' => 200]);
        $this->set(compact('cmsContents', 'cmsTermTaxonomies'));
    }
    
}