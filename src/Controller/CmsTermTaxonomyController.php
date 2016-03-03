<?php

namespace Content\Controller;

use Content\Controller\AppController;

/**
 * CmsTermTaxonomy Controller
 *
 * @property \Content\Model\Table\CmsTermTaxonomyTable $CmsTermTaxonomy
 */
class CmsTermTaxonomyController extends AppController {

    /**
     * 
     */
    public function initialize() {
        parent::initialize();

        /**
         * Set taxonomy_options
         */
        $taxonomy_options = ['page' => 'page', 'news' => 'news'];
        $this->set('taxonomy_options', $taxonomy_options);
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->paginate = [
            'contain' => ['CmsTerm'],
            'limit' => 1000,
            'maxLimit' => 1000
        ];
        $this->set('data', $this->paginate($this->CmsTermTaxonomy));
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
        $cmsTermTaxonomy = $this->CmsTermTaxonomy->get($id, [
            'contain' => ['CmsTerm', 'CmsTermRelation']
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
        $cmsTermTaxonomy = $this->CmsTermTaxonomy->newEntity();
        if ($this->request->is('post')) {
            $cmsTermTaxonomy = $this->CmsTermTaxonomy->patchEntity($cmsTermTaxonomy, $this->request->data);
            if ($this->CmsTermTaxonomy->save($cmsTermTaxonomy)) {
                $this->Flash->success('The cms term taxonomy has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The cms term taxonomy could not be saved. Please, try again.');
            }
        }
        $cmsTerm = $this->CmsTermTaxonomy->CmsTerm->find('list', ['limit' => 200]);
        $this->set(compact('cmsTermTaxonomy', 'cmsTerm'));
        $this->set('_serialize', ['cmsTermTaxonomy']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Cms Term Taxonomy id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $cmsTermTaxonomy = $this->CmsTermTaxonomy->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cmsTermTaxonomy = $this->CmsTermTaxonomy->patchEntity($cmsTermTaxonomy, $this->request->data);
            if ($this->CmsTermTaxonomy->save($cmsTermTaxonomy)) {
                $this->Flash->success('The cms term taxonomy has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The cms term taxonomy could not be saved. Please, try again.');
            }
        }
        $cmsTerm = $this->CmsTermTaxonomy->CmsTerm->find('list', ['limit' => 200]);
        $this->set(compact('cmsTermTaxonomy', 'cmsTerm'));
        $this->set('_serialize', ['cmsTermTaxonomy']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Cms Term Taxonomy id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $cmsTermTaxonomy = $this->CmsTermTaxonomy->get($id);
        if ($this->CmsTermTaxonomy->delete($cmsTermTaxonomy)) {
            $this->Flash->success('The cms term taxonomy has been deleted.');
        } else {
            $this->Flash->error('The cms term taxonomy could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }

}
