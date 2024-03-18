<?php
        header("Access-Control-Allow-Origin: *");
    header('Content-Type:application/json');
    include 'jwt/vendor/autoload.php';
    use \Firebase\JWT\JWT;
    error_reporting(E_ALL);

    if (!isset($_GET['jwt'])) {
        die('Only POST method');
    }

    ini_set('display_errors', 1);
    function CanceledAllBonus($player_id) {
        $Check = 0;
        $ActiveBonus = 0;
        $CanceledBonus = 0; 

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://adminwebsd.apidigi.com/api/Main/ApiRequest?TimeZone=3&LanguageId=en');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'Method=GetBonusByClientId&Controller=Bonus&TimeZone=3&RequestObject='.$player_id);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();
        $headers[] = 'Sec-Fetch-Mode: cors';
        $headers[] = 'Origin: https://betkanyon.admindigi.com';
        $headers[] = 'Accept-Language: en';
        $headers[] = 'Authorization: Bearer '.file_get_contents('http://software2.betkanyon100.com/token.php');
        $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
        $headers[] = 'Referer: https://betkanyon.admindigi.com/';
        $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = json_decode(curl_exec($ch),true);
        foreach ($result['ResponseObject']['Entities'] as $bonus) {
            if ($bonus['ClientBonusStatus'] == 2 && $bonus['BonusType'] == 10 or $bonus['ClientBonusStatus'] == 1 && $bonus['BonusType'] == 10) {
                $ActiveBonus++;
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://adminwebsd.apidigi.com/api/Main/ApiRequest?TimeZone=3&LanguageId=en');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, 'Method=CancelClientBonus&Controller=Bonus&TimeZone=3&RequestObject={"ClientId":'.$player_id.',"BonusId":'.$bonus['Id'].'}');
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

                $headers = array();
                $headers[] = 'Sec-Fetch-Mode: cors';
                $headers[] = 'Origin: https://betkanyon.admindigi.com';
                $headers[] = 'Accept-Language: en';
                $headers[] = 'Authorization: Bearer '.file_get_contents('http://software2.betkanyon100.com/token.php');
                $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
                $headers[] = 'Referer: https://betkanyon.admindigi.com/';
                $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36';
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                $cancel_result = json_decode(curl_exec($ch),true);
                if ($cancel_result['ResponseObject'] == true) {
                     $CanceledBonus++;
                }
            }
        }
        if ($ActiveBonus == $CanceledBonus) {
            $Check = 1;
        }
        return $Check;
     }
    if ($_GET) {
        $decoded = JWT::decode($_GET['jwt'], '3EF97E3AE324FDA34C73551407D9C39B7AD670D2ABD80A84882B052E09F19B0C', array('HS256'));
        $_GET['id'] = $decoded->external_id;
        $player_id = addslashes(strip_tags($_GET['id']));
        if (CanceledAllBonus($player_id) == 1) {
            $json = array(
                "status" => "success",
                "message" => "Bonus iptal edilmiştir."
            );
        } else {
            $json = array(
                "status" => "error",
                "message" => "Bonus iptal edilirken bir hata oluştu, lütfen canlı desteğe bağlanın."
            );
        }
        
        echo json_encode($json);
    }
?>