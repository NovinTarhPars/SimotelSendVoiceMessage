<?php
namespace App\Controllers;

use App\Controllers\Controller;
use App\Controllers\ApiCurl;
use CURLFILE;

class AnnounceController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function upload($file)
    {
        
        if($file !== ""){
            $data = [
                'file' => new CURLFile($file['tmp_name'])
            ];
            $headers = [
                "X-APIKEY: $this->api_key",
                "Authorization: Basic $this->auth_key"
            ];
            $url = $this->api_base_url."announcements/upload";
            $method = "POST";
            $result = ApiCurl::sendRequest($url,$method,$data,$headers);
            return $result;
        }else{
            return false;
        }
        
    }
    public function get($name)
    {
        $data = [
            "alike" => "true",
            "conditions" => ["name" => $name]
        ];
        $url = $this->api_base_url."announcements";
        $method = "GET";
        $result = ApiCurl::sendRequest($url,$method,json_encode($data),$this->getHeaders());
        return $result;
    }
    public function add($announce_name,$filename)
    {
        $data = [
            "name" => $filename,
            "filename" => $announce_name,
            "description" => ""
        ];

        $url = $this->api_base_url."announcements";
        $method = "POST";
        $result = ApiCurl::sendRequest($url,$method,json_encode($data),$this->getHeaders());
        return $result;
    }

    public function edit($id,$announce_name)
    {
        $data = [
            "_id" => $id,
            "name" => "ttt",
            "filename" => $announce_name,
            "description" => ""
        ];

        $url = $this->api_base_url."announcements";
        $method = "PUT";
        $result = ApiCurl::sendRequest($url,$method,json_encode($data),$this->getHeaders());
        return $result;
    }
    public function delete($id)
    {
        $data = [
            "_id" => $id
        ];

        $url = $this->api_base_url."announcements";
        $method = "DELETE";
        $result = ApiCurl::sendRequest($url,$method,json_encode($data),$this->getHeaders());
        return $result;
    }
}