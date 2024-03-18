<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header('Content-Type:application/json');

    /*$contents = file_get_contents('https://sport.betkanyonvip.net/Prematch/SearchEvents?searchStr=barcelona&stakeTypes=1&stakeTypes=702&langId=2&partnerId=107&countryCode=UA');
    var_dump($contents);*/
  
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://sport.betkanyonvip.net/Prematch/SearchEvents?searchStr='.urlencode($_GET['search']).'&stakeTypes=1&stakeTypes=702&langId=2&partnerId=107&countryCode=UA');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');


    
    $headers = array();
    //$headers[] = 'Access-Control-Allow-Origin: *';
    //$headers[] = 'Content-Type:application/json';
    $headers[] = 'Authority: sport.betkanyonvip.net';
    $headers[] = 'Dnt: 1';
    $headers[] = 'Sec-Ch-Ua-Mobile: ?0';
    $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.81 Safari/537.36';
    $headers[] = 'Sec-Ch-Ua-Platform: ^^Windows^^\"\"';
    $headers[] = 'Content-Type: application/x-www-form-urlencoded';
    $headers[] = 'Accept: */*';
    $headers[] = 'Sec-Fetch-Site: same-origin';
    $headers[] = 'Sec-Fetch-Mode: cors';
    $headers[] = 'Sec-Fetch-Dest: empty';
    $headers[] = 'Referer: https://sport.betkanyonvip.net/SportsBook/Home/';
    $headers[] = 'Accept-Language: en,tr;q=0.9,pt-BR;q=0.8,pt;q=0.7,tr-TR;q=0.6,en-US;q=0.5';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  
    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);

    echo $result;

?>