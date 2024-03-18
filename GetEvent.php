<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header('Content-Type:application/json');
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://sport.betkanyonvip.net/Events/GetEvent');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, '{"eventId":'.$_GET['id'].',"langId":4,"partnerId":107,"countryCode":"UA"}');
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

    $headers = array();
    $headers[] = 'Connection: keep-alive';
    $headers[] = 'Accept: application/json, text/javascript, */*; q=0.01';
    $headers[] = 'X-Requested-With: XMLHttpRequest';
    $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.83 Safari/537.36';
    $headers[] = 'Content-Type: application/json; charset=UTF-8';
    $headers[] = 'Origin: https://sport.betkanyon226.com';
    $headers[] = 'Sec-Fetch-Site: same-origin';
    $headers[] = 'Sec-Fetch-Mode: cors';
    $headers[] = 'Sec-Fetch-Dest: empty';
    $headers[] = 'Referer: https://sport.betkanyon226.com/SportsBook/Upcoming/4520?token=-&l=tr&d=d&game=T%C3%BCrkiye-Super-Lig';
    $headers[] = 'Accept-Language: en-US,en;q=0.9,tr;q=0.8,nl;q=0.7,ru;q=0.6';
    $headers[] = 'Cookie: _ga=GA1.2.1359691108.1599229330; _gid=GA1.2.554141458.1599229330; __cfduid=d8ba23685fbb47122b6898cf53904678b1599229330; _gaexp=GAX1.2.hI3tF_JpRBawlyocyRYUtg.18586.1; __zlcmid=101jPY0nD65qCzI; _gat=1; ASP.NET_SesssionId=d13pv4ogns4bajnjutbw2hzg; iOSFix=sport.betkanyon226.com';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);

    echo $result;

?>