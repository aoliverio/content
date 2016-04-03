<?php

namespace Content\Controller;

use Content\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * CmsContentOptions Controller
 *
 * @property \Content\Model\Table\CmsContentOptionsTable $CmsContentOptions
 */
class CmsContentOptionsController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->CmsContentOptions = TableRegistry::get('Content.CmsContentOptions');
        $query = $this->CmsContentOptions->find('all');
        $query->contain(['CmsContents']);
        $query->where($this->filteredWhereConditions());        
        $query->limit(1000);
        $this->set('data', $query->toArray());
        $this->set('_serialize', ['data']);
    }
    
    /**
     * View method
     *
     * @param string|null $id Cms Content Option id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $cmsContentOption = $this->CmsContentOptions->get($id, [
            'contain' => ['CmsContents']
        ]);
        $this->set('cmsContentOption', $cmsContentOption);
        $this->set('_serialize', ['cmsContentOption']);
    }
    
    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $cmsContentOption = $this->CmsContentOptions->newEntity();
        if ($this->request->is('post')) {
            $cmsContentOption = $this->CmsContentOptions->patchEntity($cmsContentOption, $this->request->data);
            if ($this->CmsContentOptions->save($cmsContentOption)) {
                $this->Flash->success(__('The cms content option has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cms content option could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cmsContentOption'));
        $this->set('_serialize', ['cmsContentOption']);
        $this->filteredSelectOptions();
    }
    
    /**
     * Edit method
     *
     * @param string|null $id Cms Content Option id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $cmsContentOption = $this->CmsContentOptions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cmsContentOption = $this->CmsContentOptions->patchEntity($cmsContentOption, $this->request->data);
            if ($this->CmsContentOptions->save($cmsContentOption)) {
                $this->Flash->success(__('The cms content option has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cms content option could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cmsContentOption'));
        $this->set('_serialize', ['cmsContentOption']);
        $this->filteredSelectOptions();
    }
    
    /**
     * Delete method
     *
     * @param string|null $id Cms Content Option id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $cmsContentOption = $this->CmsContentOptions->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($this->CmsContentOptions->delete($cmsContentOption)) {
                $this->Flash->success(__('The cms content option has been deleted.'));
            } else {
                $this->Flash->error(__('The cms content option could not be deleted. Please, try again.'));
            }
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('cmsContentOption'));
    }
    
    /**
     * Filter method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function filter($action = 'set') {
        $cmsContentOption = $this->CmsContentOptions->newEntity();
        if ($this->request->session()->check('CmsContentOptions')) {
            $session = $this->request->session()->read('CmsContentOptions');
            $cmsContentOption = $this->CmsContentOptions->patchEntity($cmsContentOption,  $session);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($action == 'unset') {
                $this->request->session()->delete('CmsContentOptions');
            } else {
                $this->request->session()->write('CmsContentOptions', $this->request->data);
            }
            $this->Flash->success(__('The cms content option has been saved.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('cmsContentOption'));
        $this->set('_serialize', ['cmsContentOption']);
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
        $cmsContents = $this->CmsContentOptions->CmsContents->find('list', ['limit' => 200]);
        $this->set(compact('cmsContents'));
    }
    
}