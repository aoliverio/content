<?php

namespace Content\Controller;

use Content\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * CmsContentMeta Controller
 *
 * @property \Content\Model\Table\CmsContentMetaTable $CmsContentMeta
 */
class CmsContentMetaController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->paginate = [
            'contain' => ['CmsContent'],
            'limit' => 1000,
            'maxLimit' => 1000
        ];
        $this->set('data', $this->paginate($this->CmsContentMeta));
        $this->set('_serialize', ['data']);
    }

    /**
     * View method
     *
     * @param string|null $id Cms Content Meta id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $cmsContentMeta = $this->CmsContentMeta->get($id, [
            'contain' => ['CmsContent']
        ]);
        $this->set('cmsContentMeta', $cmsContentMeta);
        $this->set('_serialize', ['cmsContentMeta']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $cmsContentMeta = $this->CmsContentMeta->newEntity();
        if ($this->request->is('post')) {
            $cmsContentMeta = $this->CmsContentMeta->patchEntity($cmsContentMeta, $this->request->data);
            if ($this->CmsContentMeta->save($cmsContentMeta)) {
                $this->Flash->success('The cms content meta has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The cms content Meta could not be saved. Please, try again.');
            }
        }
        $cmsContent = $this->CmsContentMeta->CmsContent->find('list', ['limit' => 200]);
        $this->set(compact('cmsContentMeta', 'cmsContent'));
        $this->set('_serialize', ['cmsContentMeta']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Cms Content Meta id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $cmsContentMeta = $this->CmsContentMeta->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cmsContentMeta = $this->CmsContentMeta->patchEntity($cmsContentMeta, $this->request->data);
            if ($this->CmsContentMeta->save($cmsContentMeta)) {
                $this->Flash->success('The cms content Meta has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The cms content Meta could not be saved. Please, try again.');
            }
        }
        $cmsContent = $this->CmsContentMeta->CmsContent->find('list', ['limit' => 200]);
        $this->set(compact('cmsContentMeta', 'cmsContent'));
        $this->set('_serialize', ['cmsContentMeta']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Cms Content Meta id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $cmsContentMeta = $this->CmsContentMeta->get($id);
        if ($this->CmsContentMeta->delete($cmsContentMeta)) {
            $this->Flash->success('The cms content Meta has been deleted.');
        } else {
            $this->Flash->error('The cms content Meta could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * This function is invoked in AJAX to save the priority sorting
     * 
     * @return boolean
     */
    public function savePriority() {
        $ITER = 1;
        $metaTable = TableRegistry::get('CmsContentMeta');
        if ($this->request->is('post')) :
            $items = explode(',', $this->request->data['order']);
            foreach ($items as $id) :
                $meta = $metaTable->get($id);
                $meta->priority = $ITER++;
                $metaTable->save($meta);
            endforeach;
        endif;
        exit('ok');
    }

}
