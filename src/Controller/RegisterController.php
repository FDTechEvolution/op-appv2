<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Register Controller
 *
 *
 * @method \App\Model\Entity\Register[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RegisterController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index() {
        $this->viewBuilder()->setLayout('blank');
        
        if ($this->request->is(['post'])) {
            $this->RequestUrl = $this->loadComponent('RequestUrl');
            $this->RequestUrl->postRequest(APIURL.'users/create/', $this->request->getData());
        }
        
        
    }
}
