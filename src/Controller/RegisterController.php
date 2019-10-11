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
            $res = $this->RequestUrl->postRequest(APIURL . 'users/create/', $this->request->getData());

            if ($res['result']) {
                $userId = $res['data']['user_id'];
                $data = ['user_id' => $userId];
                $resSms = $this->RequestUrl->postRequest(APIURL . 'sms/create-and-send-otp-password/', $data);

                return $this->redirect(['controller' => 'identify', 'action' => 'otp', $userId]);
            }
        }
    }

}
