<?php
$ch = curl_init();

$cookiefile = dirname(__FILE__).'/test.txt';

curl_setopt($ch, CURLOPT_URL, 'https://adminwebsd.apidigi.com/token');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "client_id=4040&grant_type=password&username=kanyonfinans3&password=F57148&g-recaptcha-response=");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);

$headers = array();
$headers[] = 'Accept: application/json, text/plain, */*';
$headers[] = 'Referer: https://betkanyon.admindigi.com/';
$headers[] = 'Origin: https://betkanyon.admindigi.com';
$headers[] = 'Accept-Language: en';
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36';
$headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);

echo $result;

?>