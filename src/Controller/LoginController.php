<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Login Controller
 *
 *
 * @method \App\Model\Entity\Login[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LoginController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index() {
        $this->viewBuilder()->setLayout('blank');
        if ($this->request->is(['post'])) {
            
            $postData = $this->request->getData();
            $this->log($postData,'debug');
            $res = $this->RequestUrl->postRequest(APIURL . 'login', $postData);
            //$res = json_decode($res, true);
            $this->log($res,'debug');
            if ($res['result'] == true) {
                $user = $res['user'];
                $this->Auth->setUser($user);
                return $this->redirect(['controller' => 'dashboard']);
            }
        }
    }

}
