<?php

function send_sms($msg,$phone){

   

    // echo $msg;

    $fields = array(

        "sender_id" => "FSTSMS",

        "message" => $msg,

        "language" => "english",

        "route" => "p",

        "numbers" => $phone,

    );



    $curl = curl_init();



    curl_setopt_array($curl, array(

      CURLOPT_URL => "https://www.fast2sms.com/dev/bulk",

      CURLOPT_RETURNTRANSFER => true,

      CURLOPT_ENCODING => "",

      CURLOPT_MAXREDIRS => 10,

      CURLOPT_TIMEOUT => 30,

      CURLOPT_SSL_VERIFYHOST => 0,

      CURLOPT_SSL_VERIFYPEER => 0,

      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

      CURLOPT_CUSTOMREQUEST => "POST",

      CURLOPT_POSTFIELDS => json_encode($fields),

      CURLOPT_HTTPHEADER => array(

        "authorization: your api key",

        "accept: */*",

        "cache-control: no-cache",

        "content-type: application/json"

      ),

    ));



    $response = curl_exec($curl);

    $err = curl_error($curl);



    curl_close($curl);



    if ($err) {

      echo "cURL Error #:" . $err;

    } 

    // else {

    //   echo $response;

    // }

    



}          



 