<?php

namespace Content\Controller;

use Content\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * CmsTermTaxonomyTypes Controller
 *
 * @property \Content\Model\Table\CmsTermTaxonomyTypesTable $CmsTermTaxonomyTypes
 */
class CmsTermTaxonomyTypesController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->CmsTermTaxonomyTypes = TableRegistry::get('Content.CmsTermTaxonomyTypes');
        $query = $this->CmsTermTaxonomyTypes->find('all');
        $query->where($this->filteredWhereConditions());        
        $query->limit(1000);
        $this->set('data', $query->toArray());
        $this->set('_serialize', ['data']);
    }
    
    /**
     * View method
     *
     * @param string|null $id Cms Term Taxonomy Type id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $cmsTermTaxonomyType = $this->CmsTermTaxonomyTypes->get($id, [
            'contain' => ['CmsTermTaxonomies']
        ]);
        $this->set('cmsTermTaxonomyType', $cmsTermTaxonomyType);
        $this->set('_serialize', ['cmsTermTaxonomyType']);
    }
    
    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $cmsTermTaxonomyType = $this->CmsTermTaxonomyTypes->newEntity();
        if ($this->request->is('post')) {
            $cmsTermTaxonomyType = $this->CmsTermTaxonomyTypes->patchEntity($cmsTermTaxonomyType, $this->request->data);
            if ($this->CmsTermTaxonomyTypes->save($cmsTermTaxonomyType)) {
                $this->Flash->success(__('The cms term taxonomy type has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cms term taxonomy type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cmsTermTaxonomyType'));
        $this->set('_serialize', ['cmsTermTaxonomyType']);
        $this->filteredSelectOptions();
    }
    
    /**
     * Edit method
     *
     * @param string|null $id Cms Term Taxonomy Type id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $cmsTermTaxonomyType = $this->CmsTermTaxonomyTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cmsTermTaxonomyType = $this->CmsTermTaxonomyTypes->patchEntity($cmsTermTaxonomyType, $this->request->data);
            if ($this->CmsTermTaxonomyTypes->save($cmsTermTaxonomyType)) {
                $this->Flash->success(__('The cms term taxonomy type has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cms term taxonomy type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cmsTermTaxonomyType'));
        $this->set('_serialize', ['cmsTermTaxonomyType']);
        $this->filteredSelectOptions();
    }
    
    /**
     * Delete method
     *
     * @param string|null $id Cms Term Taxonomy Type id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $cmsTermTaxonomyType = $this->CmsTermTaxonomyTypes->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($this->CmsTermTaxonomyTypes->delete($cmsTermTaxonomyType)) {
                $this->Flash->success(__('The cms term taxonomy type has been deleted.'));
            } else {
                $this->Flash->error(__('The cms term taxonomy type could not be deleted. Please, try again.'));
            }
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('cmsTermTaxonomyType'));
    }
    
    /**
     * Filter method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function filter($action = 'set') {
        $cmsTermTaxonomyType = $this->CmsTermTaxonomyTypes->newEntity();
        if ($this->request->session()->check('CmsTermTaxonomyTypes')) {
            $session = $this->request->session()->read('CmsTermTaxonomyTypes');
            $cmsTermTaxonomyType = $this->CmsTermTaxonomyTypes->patchEntity($cmsTermTaxonomyType,  $session);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($action == 'unset') {
                $this->request->session()->delete('CmsTermTaxonomyTypes');
            } else {
                $this->request->session()->write('CmsTermTaxonomyTypes', $this->request->data);
            }
            $this->Flash->success(__('The cms term taxonomy type has been saved.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('cmsTermTaxonomyType'));
        $this->set('_serialize', ['cmsTermTaxonomyType']);
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