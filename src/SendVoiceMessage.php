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
    private static function test($error){
        return [
            "status" => false,
            "error" => $error
        ];
    }
    public static function run($numbers = [],$url,$options = [])
    {
        if(gettype($url) === 'array'){
            if(!$url['size'] > 0 || count($numbers) == 0){
                return self::test("لطفا اطلاعات را کامل کنید.");
                die;
            }else{
                if(!checkVoiceFile(explode('.',$url['name'])[1])){
                    return self::test("نوع فایل بایستی mp3,mp4,wav باشد.");
                    die;
                }
                $filename = $url['name'];
                $filepath = $url['tmp_name'];
            }
        }else{
            if($url === "" || count($numbers) == 0){
                return self::test("لطفا اطلاعات را کامل کنید.");
                die;
            }else{
                $file_real_name = basename($url);
                $filename = explode('.',basename($url))[0];
                if(!checkVoiceFile(explode('.',$file_real_name)[1])){
                    return self::test("نوع فایل بایستی mp3,mp4,wav باشد.");
                    die;
                }
                $filepath = file_put_contents($file_real_name,file_get_contents($url));
                $filepath = realpath(__DIR__."/../".$file_real_name);
            }
        }
        $dotenv = Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT']);
        $dotenv->load();
        $start = $end = new DateTime();
        $start->setTimezone(new DateTimeZone('UTC'));
        $start = $start->modify("-30 minute")->format('Y-m-d H:i');
        $end = $end->modify("+1 hour")->format('Y-m-d H:i');
        $campain_name = generateRandomString(10);
        
        // get trunk 
        $trunks = (new TrunkController())->get("02191303473");
        $trunk_id = $trunks['data'][0]["_id"];

        // upload and create or edit announce
        $announce_controller = new AnnounceController();
        $announce = $announce_controller->get($filename);
        $announce_file = $announce_controller->upload($filepath);
        unlink($filepath);
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
            "interface_context" => isset($options['interface_context']) ? $options['interface_context'] : "",
            "interface_text" => isset($options['interface_text']) ? $options['interface_text'] : "",
            "numbers" => $numbers,
            "groups" => [],
            "try_interval" => isset($options['try_interval']) ? $options['try_interval'] : "600",
            "try" => isset($options['try']) ? $options['try'] : 1,
            "start" => isset($options['start']) ? $options['start'] : $start,
            "end" => isset($options['end']) ? $options['end'] : $end,
            "announcement" => $announce_id,
            "description" => isset($options['description']) ? $options['description'] : "this campain create by api",
            "count" => isset($options['count']) ? $options['count'] : 1
        ];
        $campain = (new CampainController())->add($data);
        return $campain;

    }

}