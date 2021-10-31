<?php

namespace App\Controllers;

class Controller
{
    public $api_base_url;
    public $api_key;
    public $username;
    public $password;
    public $auth_key;
    public function __construct()
    {
        $this->api_base_url = $_ENV['API_BASE_URL'];
        $this->api_key = $_ENV['API_KEY'];
        $this->username = $_ENV['API_USERNAME'];
        $this->password = $_ENV['API_PASSWORD'];
        $this->auth_key = base64_encode($this->username.':'.$this->password);
    }
    public function getHeaders()
    {
        return [
            "X-APIKEY: $this->api_key",
            "Authorization: Basic $this->auth_key",
            "Content-Type: application/json"
        ];
    }
}