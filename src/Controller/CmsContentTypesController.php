<?php

namespace Content\Controller;

use Content\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * CmsContentTypes Controller
 *
 * @property \Content\Model\Table\CmsContentTypesTable $CmsContentTypes
 */
class CmsContentTypesController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->CmsContentTypes = TableRegistry::get('Content.CmsContentTypes');
        $query = $this->CmsContentTypes->find('all');
        $query->where($this->filteredWhereConditions());        
        $query->limit(1000);
        $this->set('data', $query->toArray());
        $this->set('_serialize', ['data']);
    }
    
    /**
     * View method
     *
     * @param string|null $id Cms Content Type id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $cmsContentType = $this->CmsContentTypes->get($id, [
            'contain' => ['CmsContents', 'CmsTermTaxonomies']
        ]);
        $this->set('cmsContentType', $cmsContentType);
        $this->set('_serialize', ['cmsContentType']);
    }
    
    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $cmsContentType = $this->CmsContentTypes->newEntity();
        if ($this->request->is('post')) {
            $cmsContentType = $this->CmsContentTypes->patchEntity($cmsContentType, $this->request->data);
            if ($this->CmsContentTypes->save($cmsContentType)) {
                $this->Flash->success(__('The cms content type has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cms content type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cmsContentType'));
        $this->set('_serialize', ['cmsContentType']);
        $this->filteredSelectOptions();
    }
    
    /**
     * Edit method
     *
     * @param string|null $id Cms Content Type id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $cmsContentType = $this->CmsContentTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cmsContentType = $this->CmsContentTypes->patchEntity($cmsContentType, $this->request->data);
            if ($this->CmsContentTypes->save($cmsContentType)) {
                $this->Flash->success(__('The cms content type has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cms content type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cmsContentType'));
        $this->set('_serialize', ['cmsContentType']);
        $this->filteredSelectOptions();
    }
    
    /**
     * Delete method
     *
     * @param string|null $id Cms Content Type id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $cmsContentType = $this->CmsContentTypes->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($this->CmsContentTypes->delete($cmsContentType)) {
                $this->Flash->success(__('The cms content type has been deleted.'));
            } else {
                $this->Flash->error(__('The cms content type could not be deleted. Please, try again.'));
            }
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('cmsContentType'));
    }
    
    /**
     * Filter method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function filter($action = 'set') {
        $cmsContentType = $this->CmsContentTypes->newEntity();
        if ($this->request->session()->check('CmsContentTypes')) {
            $session = $this->request->session()->read('CmsContentTypes');
            $cmsContentType = $this->CmsContentTypes->patchEntity($cmsContentType,  $session);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($action == 'unset') {
                $this->request->session()->delete('CmsContentTypes');
            } else {
                $this->request->session()->write('CmsContentTypes', $this->request->data);
            }
            $this->Flash->success(__('The cms content type has been saved.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('cmsContentType'));
        $this->set('_serialize', ['cmsContentType']);
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