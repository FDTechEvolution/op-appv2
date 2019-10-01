<?php

namespace App\Controller\Component;

use Cake\Controller\Component;

class RequestUrlComponent extends Component {

    public function getRequest($url, $data = []) {
        if(sizeof($data) >0){
            $url = $url.'?'.http_build_query($data);
        }
        $context = stream_context_create(array(
            'http' => array(
                'method' => 'GET',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                //'content' => http_build_query($params),
                'timeout' => 60
            )
        ));
        
        $resp = file_get_contents($url, FALSE, $context);
        $this->log($data,'debug');
        $resp = json_decode($resp,true);
        return $resp;
    }

    public function postRequest($url, $data = []) {
        $params = $data;

        $context = stream_context_create(array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => http_build_query($params),
                'timeout' => 60
            )
        ));

        $resp = file_get_contents($url, FALSE, $context);

        return $resp;
    }

}
