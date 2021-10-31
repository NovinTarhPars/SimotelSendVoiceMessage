<?php


namespace NovinTarhPars;

use Dotenv\Dotenv;
use DateTime;
use DateTimeZone;
use App\Controllers\AnnounceController;
use App\Controllers\CampainController;
use App\Controllers\TrunkController;

class SendVoiceMessage
{
    public static function run_fast_campaign($filename,$numbers = [],$file)
    {
        $dotenv = Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT']);
        $dotenv->load();
        $start = $end = new DateTime();
        $start->setTimezone(new DateTimeZone('UTC'));
        $start = $start->modify("-30 minute")->format('Y-m-d H:i');
        $end = $end->modify("+1 hour")->format('Y-m-d H:i');
        $campain_name = generateRandomString(10);
        if((is_file($file) && $file['size'] > 0) || count($numbers) == 0){
            $result = [
                "status" => false,
                "error" => "لطفا اطلاعات را کامل کنید."
            ];
            return $result;
        }
        
        // get trunk 
        $trunks = (new TrunkController())->get("02191303473");
        $trunk_id = $trunks['data'][0]["_id"];

        // upload and create or edit announce
        $announce_controller = new AnnounceController();
        $announce = $announce_controller->get($filename);
        $announce_file = $announce_controller->upload($file);
        if(count($announce['data']) > 0 ) {
            $announce_id = $announce['data'][0]["_id"];
            $announce_controller->edit($announce_id,$announce_file['data']['filename']);
        }else{
            $result= $announce_controller->add($announce_file['data']['filename'],$filename);
            $announce_id = $result['data']['_id'];
        }

        // create campain
        $data = [
            "name" => $campain_name,
            "trunk_manager_id" => $trunk_id,
            "interface_context" => "auto",
            "interface_text" => "",
            "numbers" => $numbers,
            "groups" => [],
            "try_interval" => "600",
            "try" => 1,
            "start" => $start,
            "end" => $end,
            "announcement" => $announce_id,
            "description" => "this campain create by api",
            "count" => 1
        ];
        $campain = (new CampainController())->add($data);
        return $campain;

    }

}