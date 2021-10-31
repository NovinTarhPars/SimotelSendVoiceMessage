<?php
namespace App\Controllers;

use App\Controllers\Controller;
use App\Controllers\ApiCurl;

class TrunkController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get($title)
    {
        $title = isset($title) ? $title : "";
        $data = [
            "alike" => "true",
            "conditions" => [ "title" => $title ]
        ];

        $url = $this->api_base_url."trunks/search";
        $method = "GET";
        $result = ApiCurl::sendRequest($url,$method,json_encode($data),$this->getHeaders());
        return $result;
    }
    public function edit()
    {
        $data = [
            "_id" => "",
            "title" => "",
            "status" => "",
            "wait_cache_length" => "",
            "capacity" => "",
            "dial_interval" => ""
        ];

        $url = $this->api_base_url."trunks";
        $method = "PUT";
        $result = ApiCurl::sendRequest($url,$method,json_encode($data),$this->getHeaders());
        return $result;
    }
}