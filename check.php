<?php

 function checkActiveBonus($player_id) {
    $Check = 0;
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
            $Check = 1;
        }
    }
    print_r($result);
    return $Check;
 }

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
    echo 'Aktif Bonus '.$ActiveBonus.PHP_EOL;
    echo 'Silinen Bonus '.$CanceledBonus.PHP_EOL;
    return $Check;
 }

function CreateBonus($bonus_id,$player_id,$amount) {
    $start_time = date('Y-m-d H:i');
    $finish_time = date('Y-m-d H:i', strtotime("+15 day"));
    
    $Check = 0;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://adminwebsd.apidigi.com/api/Main/ApiRequest?TimeZone=3&LanguageId=en');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'Method=AddWagerBonusToClient&Controller=Bonus&TimeZone=3&RequestObject={"BonusId":'.$bonus_id.',"ClientIds":['.$player_id.'],"SegmentIds":[],"StartDate":"'.$start_time.'","EndDate":"'.$finish_time.'","Amount":'.$amount.',"AutoAdd":true,"AutoDelete":false,"ForceForClient":false}');
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
    if ($result['ResponseObject'] == true) {
        $Check = 1;
    }
    return $Check;
}

CanceledAllBonus(480801);

// echo CreateBonus(21825,480801,111);

// 21825



?>