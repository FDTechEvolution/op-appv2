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
        if(is_null($user_id) || $user_id ==''){
            return $this->redirect(['controller'=>'login']);
        }
        
        $user = $this->RequestUrl->getRequest(APIURL.'users/get/'.$user_id);
        
        if($this->request->is(['post'])){
            $postData = $this->request->getData();
            if($user['otp'] == $postData['otppassword']){
                $this->RequestUrl->postRequest(APIURL.'users/update/'.$user_id,['otp'=>'','isactive'=>'Y']);
            }else{
                $this->Flash->error('OTP ผิดพลาด กรุณาตรวจสอบข้อมูลอีกครั้ง');
                return $this->redirect(['controller'=>'identify','action'=>'otp',$user_id]);
            }
        }
       
        $this->set(compact('user'));
    }
}
