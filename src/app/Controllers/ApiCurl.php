<?php
namespace App\Controllers;

class ApiCurl
{

    public function __construct()
    {
        
    }
    public static function sendRequest($url,$method,$data,$headers)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => $headers
        ));
        $response = curl_exec($curl);
        // if (!curl_errno($curl)) {
        //     $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        //     // echo 'response code:'.$httpcode, '<br/>';
        // }
        curl_close($curl);
        return json_decode($response, true);
    }
}