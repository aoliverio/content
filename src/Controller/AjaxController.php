<?php

namespace Content\Controller;

use Content\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Ajax Controller
 */
class AjaxController extends AppController {

    /**
     * This function save Content menu order from Post data.
     */
    public function saveContentMenuOrder() {
        $iter = 1;
        $Table = TableRegistry::get('CmsContents');
        if ($this->request->is('post')) :
            $items = explode(',', $this->request->data['order']);
            foreach ($items as $id) :
                $content = $Table->get($id);
                $content->menu_order = $iter++;
                $Table->save($content);
            endforeach;
        endif;
        exit('ok');
    }

}
