<?php
namespace Content\Controller;

use Content\Controller\AppController;

/**
 * CmsTermRelation Controller
 *
 * @property \Content\Model\Table\CmsTermRelationTable $CmsTermRelation
   */
class CmsTermRelationController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['CmsTermTaxonomy', 'CmsContent']
        ];
        $this->set('data', $this->paginate($this->CmsTermRelation));
        $this->set('_serialize', ['data']);
    }

    /**
     * View method
     *
     * @param string|null $id Cms Term Relation id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cmsTermRelation = $this->CmsTermRelation->get($id, [
            'contain' => ['CmsTermTaxonomy', 'CmsContent']
        ]);
        $this->set('cmsTermRelation', $cmsTermRelation);
        $this->set('_serialize', ['cmsTermRelation']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cmsTermRelation = $this->CmsTermRelation->newEntity();
        if ($this->request->is('post')) {
            $cmsTermRelation = $this->CmsTermRelation->patchEntity($cmsTermRelation, $this->request->data);
            if ($this->CmsTermRelation->save($cmsTermRelation)) {
                $this->Flash->success('The cms term relation has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The cms term relation could not be saved. Please, try again.');
            }
        }
        $cmsTermTaxonomy = $this->CmsTermRelation->CmsTermTaxonomy->find('list', ['limit' => 200]);
        $cmsContent = $this->CmsTermRelation->CmsContent->find('list', ['limit' => 200]);
        $this->set(compact('cmsTermRelation', 'cmsTermTaxonomy', 'cmsContent'));
        $this->set('_serialize', ['cmsTermRelation']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Cms Term Relation id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cmsTermRelation = $this->CmsTermRelation->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cmsTermRelation = $this->CmsTermRelation->patchEntity($cmsTermRelation, $this->request->data);
            if ($this->CmsTermRelation->save($cmsTermRelation)) {
                $this->Flash->success('The cms term relation has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The cms term relation could not be saved. Please, try again.');
            }
        }
        $cmsTermTaxonomy = $this->CmsTermRelation->CmsTermTaxonomy->find('list', ['limit' => 200]);
        $cmsContent = $this->CmsTermRelation->CmsContent->find('list', ['limit' => 200]);
        $this->set(compact('cmsTermRelation', 'cmsTermTaxonomy', 'cmsContent'));
        $this->set('_serialize', ['cmsTermRelation']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Cms Term Relation id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cmsTermRelation = $this->CmsTermRelation->get($id);
        if ($this->CmsTermRelation->delete($cmsTermRelation)) {
            $this->Flash->success('The cms term relation has been deleted.');
        } else {
            $this->Flash->error('The cms term relation could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }

}
