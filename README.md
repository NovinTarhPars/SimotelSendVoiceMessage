
# SimotelSendVoiceMessage


<!-- ABOUT THE PROJECT -->
## About The Project
this library created for Send Voice Message in Simotel

## Install Library
```sh
composer require novin-tarh-pars/send-voice-message
```



## Usage

1.Create and set enviroment variable `.env` file
```sh
API_BASE_URL=<YourSimotelApiUrl>           //example https://0.0.0.0/api/v3/autodialer/
API_KEY=<YourSimotelApiToken>              //show or create in simotel admin panel maintenance -> api accounts 
API_USERNAME=<YourSimotelApiUsername>      //show or create in simotel admin panel maintenance -> api accounts
API_PASSWORD=<YourSimotelApiPassword>      //show or create in simotel admin panel maintenance -> api accounts
```

2.Use Class FastSimotelService in your controller
```sh
<?php
require_once './vendor/autoload.php';
use NovinTarhPars\SendVoiceMessage;

/**
 $url = file | ["http://"] : File | URL         // file type mp3,mp4,wav
 $numbers = ["0999999999"] : array
 $options = [
    "interface_context" => "",
    "interface_text" => "",
    "try_interval" => "600",
    "try" => 1,
    "start" => "2020-01-01 17:00",
    "end" => "2020-01-02 17:00",
    "description" => "this campain create by api",
    "count" => 1
 ] : array
*/
SendVoiceMessage::run_fast_campaign($numbers,$url,$options);
```
