<?php

namespace Content\Controller;

use Content\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * CmsTermTaxonomies Controller
 *
 * @property \Content\Model\Table\CmsTermTaxonomiesTable $CmsTermTaxonomies
 */
class CmsTermTaxonomiesController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->CmsTermTaxonomies = TableRegistry::get('Content.CmsTermTaxonomies');
        $query = $this->CmsTermTaxonomies->find('all');
        $query->contain(['ParentCmsTermTaxonomies', 'CmsTerms', 'CmsContentTypes']);
        $query->where($this->filteredWhereConditions());        
        $query->limit(1000);
        $this->set('data', $query->toArray());
        $this->set('_serialize', ['data']);
    }
    
    /**
     * View method
     *
     * @param string|null $id Cms Term Taxonomy id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $cmsTermTaxonomy = $this->CmsTermTaxonomies->get($id, [
            'contain' => ['ParentCmsTermTaxonomies', 'CmsTerms', 'CmsContentTypes', 'CmsTermRelationships', 'ChildCmsTermTaxonomies']
        ]);
        $this->set('cmsTermTaxonomy', $cmsTermTaxonomy);
        $this->set('_serialize', ['cmsTermTaxonomy']);
    }
    
    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $cmsTermTaxonomy = $this->CmsTermTaxonomies->newEntity();
        if ($this->request->is('post')) {
            $cmsTermTaxonomy = $this->CmsTermTaxonomies->patchEntity($cmsTermTaxonomy, $this->request->data);
            if ($this->CmsTermTaxonomies->save($cmsTermTaxonomy)) {
                $this->Flash->success(__('The cms term taxonomy has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cms term taxonomy could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cmsTermTaxonomy'));
        $this->set('_serialize', ['cmsTermTaxonomy']);
        $this->filteredSelectOptions();
    }
    
    /**
     * Edit method
     *
     * @param string|null $id Cms Term Taxonomy id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $cmsTermTaxonomy = $this->CmsTermTaxonomies->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cmsTermTaxonomy = $this->CmsTermTaxonomies->patchEntity($cmsTermTaxonomy, $this->request->data);
            if ($this->CmsTermTaxonomies->save($cmsTermTaxonomy)) {
                $this->Flash->success(__('The cms term taxonomy has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cms term taxonomy could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cmsTermTaxonomy'));
        $this->set('_serialize', ['cmsTermTaxonomy']);
        $this->filteredSelectOptions();
    }
    
    /**
     * Delete method
     *
     * @param string|null $id Cms Term Taxonomy id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $cmsTermTaxonomy = $this->CmsTermTaxonomies->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($this->CmsTermTaxonomies->delete($cmsTermTaxonomy)) {
                $this->Flash->success(__('The cms term taxonomy has been deleted.'));
            } else {
                $this->Flash->error(__('The cms term taxonomy could not be deleted. Please, try again.'));
            }
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('cmsTermTaxonomy'));
    }
    
    /**
     * Filter method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function filter($action = 'set') {
        $cmsTermTaxonomy = $this->CmsTermTaxonomies->newEntity();
        if ($this->request->session()->check('CmsTermTaxonomies')) {
            $session = $this->request->session()->read('CmsTermTaxonomies');
            $cmsTermTaxonomy = $this->CmsTermTaxonomies->patchEntity($cmsTermTaxonomy,  $session);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($action == 'unset') {
                $this->request->session()->delete('CmsTermTaxonomies');
            } else {
                $this->request->session()->write('CmsTermTaxonomies', $this->request->data);
            }
            $this->Flash->success(__('The cms term taxonomy has been saved.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('cmsTermTaxonomy'));
        $this->set('_serialize', ['cmsTermTaxonomy']);
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
        $parentCmsTermTaxonomies = $this->CmsTermTaxonomies->ParentCmsTermTaxonomies->find('list', ['limit' => 200]);
        $cmsTerms = $this->CmsTermTaxonomies->CmsTerms->find('list', ['limit' => 200]);
        $cmsContentTypes = $this->CmsTermTaxonomies->CmsContentTypes->find('list', ['limit' => 200]);
        $this->set(compact('parentCmsTermTaxonomies', 'cmsTerms', 'cmsContentTypes'));
    }
    
}
