<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Logout Controller
 *
 *
 * @method \App\Model\Entity\Logout[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LogoutController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index() {
        $this->request->getSession()->destroy();
        return $this->redirect(['controller' => 'login']);
    }

}
