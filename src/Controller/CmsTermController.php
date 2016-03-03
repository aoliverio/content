<?php
namespace Content\Controller;

use Content\Controller\AppController;

/**
 * CmsTerm Controller
 *
 * @property \Content\Model\Table\CmsTermTable $CmsTerm
   */
class CmsTermController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('data', $this->paginate($this->CmsTerm));
        $this->set('_serialize', ['data']);
    }

    /**
     * View method
     *
     * @param string|null $id Cms Term id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cmsTerm = $this->CmsTerm->get($id, [
            'contain' => ['CmsPermission']
        ]);
        $this->set('cmsTerm', $cmsTerm);
        $this->set('_serialize', ['cmsTerm']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cmsTerm = $this->CmsTerm->newEntity();
        if ($this->request->is('post')) {
            $cmsTerm = $this->CmsTerm->patchEntity($cmsTerm, $this->request->data);
            if ($this->CmsTerm->save($cmsTerm)) {
                $this->Flash->success('The cms term has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The cms term could not be saved. Please, try again.');
            }
        }
        $this->set(compact('cmsTerm'));
        $this->set('_serialize', ['cmsTerm']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Cms Term id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cmsTerm = $this->CmsTerm->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cmsTerm = $this->CmsTerm->patchEntity($cmsTerm, $this->request->data);
            if ($this->CmsTerm->save($cmsTerm)) {
                $this->Flash->success('The cms term has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The cms term could not be saved. Please, try again.');
            }
        }
        $this->set(compact('cmsTerm'));
        $this->set('_serialize', ['cmsTerm']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Cms Term id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cmsTerm = $this->CmsTerm->get($id);
        if ($this->CmsTerm->delete($cmsTerm)) {
            $this->Flash->success('The cms term has been deleted.');
        } else {
            $this->Flash->error('The cms term could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }

}
