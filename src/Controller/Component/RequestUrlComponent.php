<?php

namespace App\Controller\Component;

use Cake\Controller\Component;

class RequestUrlComponent extends Component {

    public function getRequest($url, $data = []) {
        if (sizeof($data) > 0) {
            $url = $url . '?' . http_build_query($data);
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
        $this->log($data, 'debug');
        $resp = json_decode($resp, true);
        return $resp;
    }

    public function postRequest($url, $data = []) {
        /*
          $params = $data;
          $resp = null;

          $context = stream_context_create(array(
          'http' => array(
          'method' => 'POST',
          'header' => 'Content-type: application/x-www-form-urlencoded',
          'content' => http_build_query($params),
          'timeout' => 60
          )
          ));

          try {
          $resp = file_get_contents($url, FALSE, $context);
          } catch (Exception $e) {
          $this->log($e->getMessage(),'error');
          }
         * 
         */
        /*
        $post = [
            'username' => 'user1',
            'password' => 'passuser1',
            'gender' => 1,
        ];
         * 
         */

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        // execute!
        $response = curl_exec($ch);

        // close the connection, release resources used
        curl_close($ch);

        // do anything you want with your response
        var_dump($response);



        return $response;
    }

}
