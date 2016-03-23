<?php

namespace Content\Controller;

use App\Controller\AppController as BaseController;
use Cake\Core\Configure;

class AppController extends BaseController {

    public function initialize() {
        parent::initialize();

        /**
         * Define Content settings
         */
        Configure::write('Content', [
            'defaultUsersTable' => 'Users',
            'defaultRolesTable' => 'Roles'
        ]);
    }

}
