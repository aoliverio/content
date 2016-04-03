<?php

namespace Content\Controller;

use Content\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Content Controller
 *
 * @property \Content\Model\Table\CmsContentTable $CmsContent
 */
class ContentController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {

        /**
         * set lastUpdatedPage
         */
        $query = TableRegistry::get('CmsContents')->find();
        $query->where(['content_type' => 'page']);
        $query->order(['modified' => 'DESC']);
        $this->set('last_page', $query);

        /**
         * set lastUpdatedNews
         */
        $query = TableRegistry::get('CmsContents')->find();
        $query->where(['content_type' => 'news']);
        $query->order(['modified' => 'DESC']);
        $this->set('last_news', $query);

        /**
         * set view
         */
        $this->viewBuilder()->template('dashboard');
    }
    
    /**
     * 
     * 
     * @param type $content_id
     * @param type $params
     */
    public function getImagesById($content_id, $params = array()) {
        $this->CmsContent = TableRegistry::get('CmsContents');
        $query = $this->CmsContent->find('all')
                ->where(['parent' => $content_id, 'content_type' => 'image'])
                ->order('menu_order');
        return $query->toArray();
    }

}
