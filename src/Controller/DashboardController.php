<?php

namespace Content\Controller;

use Content\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Dashboard Controller
 */
class DashboardController extends AppController {

    /**
     * Display Dashboard/home  template by default
     */
    public function index() {
        $this->viewBuilder()->template('home');
    }

}
