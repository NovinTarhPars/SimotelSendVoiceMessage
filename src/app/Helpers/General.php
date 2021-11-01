
<?php

if(!function_exists('generateRandomString')){
        function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
if(!function_exists('checkVoiceFile')){
    function checkVoiceFile($path){
        if(!in_array($path,['mp3','wav','mp4'])){
            return false;
        }
        return true;
    }
}
