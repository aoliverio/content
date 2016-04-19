<?php

namespace Site\Controller;

use Cake\Utility\Inflector;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;

/**
 * 
 */
class PageController extends AppController {

    /**
     * 
     */
    public function initialize() {
        parent::initialize();
    }

    /**
     * 
     */
    public function display() {

        /**
         * 
         */
        $path = func_get_args();

        /**
         * 
         */
        $page = $subpage = null;

        /**
         * Set default template for current request use /config/site.php
         * Configure::read('homeDefaultTemplate')
         * Configure::read('pageDefaultTemplate')
         */
        if (count($path) == 0) {
            $slug = 'home';
            $page = 'home';
            $this->viewBuilder()->layout(Configure::read('homeDefaultTemplate'));
        } else {
            $this->viewBuilder()->layout(Configure::read('pageDefaultTemplate'));
        }

        /**
         * Set page to render
         */
        if (!empty($path[0])) {
            $slug = trim($path[0]);
            $TEMPLATE_VIEW_PATH = Configure::read('Site.pagePath') . 'page_' . Inflector::underscore($path[0]) . '.ctp';
            if (file_exists($TEMPLATE_VIEW_PATH))
                $page = 'page_' . $path[0];
            else
                $page = 'page';
        }

        /**
         * 
         */
        if (!empty($path[1])) {
            $subpage = $path[1];
        }

        /**
         * 
         */
        $this->set(compact('page', 'subpage'));

        /**
         * 
         */
        $this->set('Page', $this);


        /**
         * Set $data
         */
        $data = $this->getContentBySlug($slug);
        $this->set('data', $data);

        /**
         * 
         */
        $this->viewBuilder()->template($page);
    }

    /**
     * Function getContentBySlug
     * 
     * @param type $slug
     * @return type
     */
    protected function getContentBySlug($slug) {
        $this->CmsContent = TableRegistry::get('CmsContent');
        $query = $this->CmsContent->find('all');
        $query->where(['name' => $slug]);
        $data = $query->first();
        return $data;
    }

}
