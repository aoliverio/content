<?php

namespace Content\Controller;

use Content\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * CmsContents Controller
 *
 * @property \Content\Model\Table\CmsContentsTable $CmsContents
 */
class CmsContentsController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->CmsContents = TableRegistry::get('Content.CmsContents');
        $query = $this->CmsContents->find('all');
        $query->contain(['ParentCmsContents', 'CmsContentStatues', 'CmsContentTypes', 'Authors']);
        $query->where($this->filteredWhereConditions());        
        $query->limit(1000);
        $this->set('data', $query->toArray());
        $this->set('_serialize', ['data']);
    }
    
    /**
     * View method
     *
     * @param string|null $id Cms Content id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $cmsContent = $this->CmsContents->get($id, [
            'contain' => ['ParentCmsContents', 'CmsContentStatues', 'CmsContentTypes', 'Authors', 'CmsContentOptions', 'ChildCmsContents', 'CmsTermRelationships']
        ]);
        $this->set('cmsContent', $cmsContent);
        $this->set('_serialize', ['cmsContent']);
    }
    
    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $cmsContent = $this->CmsContents->newEntity();
        if ($this->request->is('post')) {
            $cmsContent = $this->CmsContents->patchEntity($cmsContent, $this->request->data);
            if ($this->CmsContents->save($cmsContent)) {
                $this->Flash->success(__('The cms content has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cms content could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cmsContent'));
        $this->set('_serialize', ['cmsContent']);
        $this->filteredSelectOptions();
    }
    
    /**
     * Edit method
     *
     * @param string|null $id Cms Content id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $cmsContent = $this->CmsContents->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cmsContent = $this->CmsContents->patchEntity($cmsContent, $this->request->data);
            if ($this->CmsContents->save($cmsContent)) {
                $this->Flash->success(__('The cms content has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cms content could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cmsContent'));
        $this->set('_serialize', ['cmsContent']);
        $this->filteredSelectOptions();
    }
    
    /**
     * Delete method
     *
     * @param string|null $id Cms Content id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $cmsContent = $this->CmsContents->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($this->CmsContents->delete($cmsContent)) {
                $this->Flash->success(__('The cms content has been deleted.'));
            } else {
                $this->Flash->error(__('The cms content could not be deleted. Please, try again.'));
            }
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('cmsContent'));
    }
    
    /**
     * Filter method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function filter($action = 'set') {
        $cmsContent = $this->CmsContents->newEntity();
        if ($this->request->session()->check('CmsContents')) {
            $session = $this->request->session()->read('CmsContents');
            $cmsContent = $this->CmsContents->patchEntity($cmsContent,  $session);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($action == 'unset') {
                $this->request->session()->delete('CmsContents');
            } else {
                $this->request->session()->write('CmsContents', $this->request->data);
            }
            $this->Flash->success(__('The cms content has been saved.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('cmsContent'));
        $this->set('_serialize', ['cmsContent']);
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
        $parentCmsContents = $this->CmsContents->ParentCmsContents->find('list', ['limit' => 200]);
        $cmsContentStatues = $this->CmsContents->CmsContentStatues->find('list', ['limit' => 200]);
        $cmsContentTypes = $this->CmsContents->CmsContentTypes->find('list', ['limit' => 200]);
        $authors = $this->CmsContents->Authors->find('list', ['limit' => 200]);
        $this->set(compact('parentCmsContents', 'cmsContentStatues', 'cmsContentTypes', 'authors'));
    }
    
}