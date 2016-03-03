<?php
namespace Content\Controller;

use Content\Controller\AppController;

/**
 * CmsPermission Controller
 *
 * @property \Content\Model\Table\CmsPermissionTable $CmsPermission
   */
class CmsPermissionController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['CmsTerm', 'CmsContent']
        ];
        $this->set('data', $this->paginate($this->CmsPermission));
        $this->set('_serialize', ['data']);
    }

    /**
     * View method
     *
     * @param string|null $id Cms Permission id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cmsPermission = $this->CmsPermission->get($id, [
            'contain' => ['CmsTerm', 'CmsContent']
        ]);
        $this->set('cmsPermission', $cmsPermission);
        $this->set('_serialize', ['cmsPermission']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cmsPermission = $this->CmsPermission->newEntity();
        if ($this->request->is('post')) {
            $cmsPermission = $this->CmsPermission->patchEntity($cmsPermission, $this->request->data);
            if ($this->CmsPermission->save($cmsPermission)) {
                $this->Flash->success('The cms permission has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The cms permission could not be saved. Please, try again.');
            }
        }
        $cmsTerm = $this->CmsPermission->CmsTerm->find('list', ['limit' => 200]);
        $cmsContent = $this->CmsPermission->CmsContent->find('list', ['limit' => 200]);
        $this->set(compact('cmsPermission', 'cmsTerm', 'cmsContent'));
        $this->set('_serialize', ['cmsPermission']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Cms Permission id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cmsPermission = $this->CmsPermission->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cmsPermission = $this->CmsPermission->patchEntity($cmsPermission, $this->request->data);
            if ($this->CmsPermission->save($cmsPermission)) {
                $this->Flash->success('The cms permission has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The cms permission could not be saved. Please, try again.');
            }
        }
        $cmsTerm = $this->CmsPermission->CmsTerm->find('list', ['limit' => 200]);
        $cmsContent = $this->CmsPermission->CmsContent->find('list', ['limit' => 200]);
        $this->set(compact('cmsPermission', 'cmsTerm', 'cmsContent'));
        $this->set('_serialize', ['cmsPermission']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Cms Permission id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cmsPermission = $this->CmsPermission->get($id);
        if ($this->CmsPermission->delete($cmsPermission)) {
            $this->Flash->success('The cms permission has been deleted.');
        } else {
            $this->Flash->error('The cms permission could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }

}
