<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Register Controller
 *
 *
 * @method \App\Model\Entity\Register[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RegisterController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->viewBuilder()->setLayout('register');
    }

    public function create() {
        if($this->request->is(['post'])){
            $postData = $this->request->getData();
            $this->log($postData, 'debug');
            $this->RequestUrl = $this->loadComponent('RequestUrl');
            $this->RequestUrl->postRequest('http://localhost/git/op-service/users/create/', $postData);
        }
    }
}
