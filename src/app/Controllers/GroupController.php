<?php
namespace App\Controllers;

use App\Controllers\Controller;
use App\Controllers\ApiCurl;
use CURLFILE;

class GroupController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function upload()
    {
        $filepath = "";
        $data = [
            'file' => new CURLFILE($filepath)
        ];
        $headers = [
            "X-APIKEY: $this->api_key",
            "Authorization: Basic $this->auth_key"
        ];
        $url = $this->api_base_url."groups/upload";
        $method = "POST";
        $result = ApiCurl::sendRequest($url,$method,$data,$headers);
        return $result;
    }
    public function get()
    {
        $data = [
            "alike" => "true",
            "conditions" => ["name" => "" , "description" => ""],
            "pagination" => [
                "start" => 0,
                "count" => 20,
                "sorting" => []
            ]
        ];

        $url = $this->api_base_url."groups";
        $method = "GET";
        $result = ApiCurl::sendRequest($url,$method,json_encode($data),$this->getHeaders());
        return $result;
    }
    public function add()
    {
        $data = [
            "name" => "",
            "numbers" => [],
            "description" => ""
        ];

        $url = $this->api_base_url."groups";
        $method = "POST";
        $result = ApiCurl::sendRequest($url,$method,json_encode($data),$this->getHeaders());
        return $result;
    }

    public function edit()
    {
        $data = [
            "_id" => "",
            "name" => "",
            "numbers" => [],
            "description" => ""
        ];

        $url = $this->api_base_url."groups";
        $method = "PUT";
        $result = ApiCurl::sendRequest($url,$method,json_encode($data),$this->getHeaders());
        return $result;
    }
    public function delete()
    {
        $data = [
            "_id" => ""
        ];

        $url = $this->api_base_url."groups";
        $method = "DELETE";
        $result = ApiCurl::sendRequest($url,$method,json_encode($data),$this->getHeaders());
        return $result;
    }
}