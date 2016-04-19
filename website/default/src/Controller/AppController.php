<?php

namespace Site\Controller;

use Cake\Controller\Controller as BaseController;
use Cake\I18n\Number;
use Cake\I18n\Time;
use Cake\Filesystem\File;
use Cake\Filesystem\Folder;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;

/**
 * 
 */
class AppController extends BaseController {

    /**
     * 
     */
    public function initialize() {

        /**
         * 
         */
        Time::setToStringFormat('YYYY-MM-dd');
        $this->loadComponent('Flash');

        /**
         * Define $AuthConf configuration array
         */
        $AuthConf = [
            'table' => 'User',
            'username' => 'email',
            'password' => 'password',
            'md5_hashing' => FALSE,
            'login_redirect' => '/' . SITE_NAME,
            'logout_redirect' => '/' . SITE_NAME,
        ];

        /**
         * Configure::write('User', $user);
         */
        if ($this->request->session()->check('User.id')):
            $this->User = TableRegistry::get($AuthConf['table']);
            $user = $this->User->get($this->request->session()->read('User.id'));
            Configure::write('User', $user);
        endif;

        /**
         * 
         */
        if (isset($this->request->pass[0])):
            if (trim($this->request->pass[0]) == 'login')
                $this->login($AuthConf);
            if (trim($this->request->pass[0]) == 'logout')
                $this->logout($AuthConf);
        endif;

        /**
         * 
         */
        if (!$this->isAuthorized())
            $this->redirect(['login']);
    }

    /**
     * App Login
     * 
     * @param type $options
     * @return type
     */
    private function login($options = []) {
        extract($options);
        if ($this->request->is('post')) {
            $this->User = TableRegistry::get($table);
            $query = $this->User->find('all');
            $query->where([$username => trim($this->request->data['username'])]);

            if ($md5_hashing)
                $query->where([$password => md5($this->request->data['password'])]);
            else
                $query->where([$password => trim($this->request->data['password'])]);

            $user = $query->first();
            if ($user) {
                $this->request->session()->write('User.id', $user->id);
                return $this->redirect($login_redirect);
            } else {
                $this->Flash->set(__('Username or password is incorrect!'), ['element' => 'error']);
            }
        }
    }

    /**
     * App Logout
     */
    private function logout($options = []) {
        extract($options);
        $this->request->session()->destroy();
        $this->Flash->set(__('You are now logged out!'), ['element' => 'success']);
        return $this->redirect($logout_redirect);
    }

    /**
     * Authorized rules
     * 
     * @param type $user
     * @return boolean
     */
    private function isAuthorized() {

        /**
         * Use $permitted to insert name of pages that do not require authentication
         */
        $permitted = ['login', 'logout'];
        if (isset($this->request->pass[0]))
            if (in_array($this->request->pass[0], $permitted))
                return TRUE;

        /**
         * Check if the user is authenticated
         */
        if ($this->request->session()->check('User.id'))
            return TRUE;

        /**
         * Default rule
         */
        return TRUE;
    }

    /**
     * This function is not used at the moment!
     * This function is used to generate the random password
     * 
     * @return type
     */
    protected function randomPassword($length = 8) {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < $length; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }

}
