
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

SendVoiceMessage::run_fast_campaign(string $filename,array $numbers,File $file);
```
