<?php
namespace App\Controllers;

use App\Controllers\Controller;
use App\Controllers\ApiCurl;

class ContactController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get()
    {
        
        $data = [
            "alike" => "true",
            "conditions" => ["name" => $_REQUEST['name']]
        ];

        $url = $this->api_base_url."contacts";
        $method = "GET";
        $result = ApiCurl::sendRequest($url,$method,json_encode($data),$this->getHeaders());
        return $result;
    }
    public function add()
    {
        $data = [
            "name" => "",
            "number" => "",
            "description" => ""
        ];

        $url = $this->api_base_url."contacts";
        $method = "POST";
        $result = ApiCurl::sendRequest($url,$method,json_encode($data),$this->getHeaders());
        return $result;
    }

    public function edit()
    {
        $data = [
            "_id" => "",
            "name" => "",
            "number" => "",
            "description" => ""
        ];

        $url = $this->api_base_url."contacts";
        $method = "PUT";
        $result = ApiCurl::sendRequest($url,$method,json_encode($data),$this->getHeaders());
        return $result;
    }
    public function delete()
    {
        $data = [
            "_id" => ""
        ];

        $url = $this->api_base_url."contacts";
        $method = "DELETE";
        $result = ApiCurl::sendRequest($url,$method,json_encode($data),$this->getHeaders());
        return $result;
    }
}