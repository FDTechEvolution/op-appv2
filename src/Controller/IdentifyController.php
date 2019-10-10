<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Identify Controller
 *
 *
 * @method \App\Model\Entity\Identify[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class IdentifyController extends AppController {
    
    public function otp($user_id = null){
        $this->viewBuilder()->setLayout('blank');
    }
}
