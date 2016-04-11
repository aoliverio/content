<?php

namespace Content\Controller;

use App\Controller\AppController as BaseController;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;

class AppController extends BaseController {

    public function initialize() {
        parent::initialize();

        /**
         * Define Content settings
         */
        Configure::write('Content', [
            'defaultUsersTable' => 'Users',
            'defaultRolesTable' => 'Roles',
            'defaultSiteId' => 1
        ]);

        /**
         * Manage site selector
         */
        if ($this->request->is(['patch', 'post', 'put']))
            if (isset($this->request->data['current_site_id']))
                $this->request->session()->write('Content.currentSiteId', intval($this->request->data['current_site_id']));

        $this->CmsSites = TableRegistry::get('Content.CmsSites');
        $sites = $this->CmsSites->find('all')->toArray();
        $site_selector = [];
        foreach ($sites as $row):
            $site_selector[$row->id] = $row->name;
            if (!$this->request->session()->check('Content.currentSiteId'))
                $this->request->session()->write('Content.currentSiteId', $row->id);
        endforeach;
        $this->set(compact('site_selector'));
    }

}
