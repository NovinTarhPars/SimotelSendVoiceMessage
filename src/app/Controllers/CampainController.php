<?php
namespace App\Controllers;

use App\Controllers\Controller;
use App\Controllers\ApiCurl;

class CampainController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function add($data)
    {

        $url = $this->api_base_url."campaigns";
        $method = "POST";
        $result = ApiCurl::sendRequest($url,$method,json_encode($data),$this->getHeaders());
        return $result;
    }
    public function edit()
    {
        $data = [
            "_id" => "",
            "name" => "",
            "trunk_manager_id" => "",
            "interface_context" => "auto",
            "interface_text" => "",
            "numbers" => [],
            "groups" => [],
            "try_interval" => "600",
            "try" => "1",
            "start" => "2021-02-19 15:17",
            "end" => "2021-02-23 15:17",
            "announcement" => "",
            "description" => "",
            "count" => 3
        ];
 
        $url = $this->api_base_url."campaigns";
        $method = "PUT";
        $result = ApiCurl::sendRequest($url,$method,json_encode($data),$this->getHeaders());
        return $result;
    }
    public function delete()
    {
        $data = [
            "_id" => ""
        ];

        $url = $this->api_base_url."campaigns";
        $method = "DELETE";
        $result = ApiCurl::sendRequest($url,$method,json_encode($data),$this->getHeaders());
        return $result;
    }
    public function get()
    {
        $data = [
            "alike" => "true",
            "conditions" => [
                "name" => "",
                "description" => "",
                "status" => "",
                "pagination" => [
                    "start" => 0,
                    "count" => 20,
                    "sorting" => "asc"
                ],
            ]
        ];

        $url = $this->api_base_url."campaigns";
        $method = "GET";
        $result = ApiCurl::sendRequest($url,$method,json_encode($data),$this->getHeaders());
        return $result;
    }
}
