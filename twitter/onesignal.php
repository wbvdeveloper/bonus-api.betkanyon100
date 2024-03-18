<?php

class oneSignal
{
    public $apiKey = 'a5065c2c-1de1-4587-9888-decb23339982'; // Api Key
    private $restApiKey = 'NDk2Y2JhMzMtYTVkYS00NzE5LWFmMDctOTUzMmYwMmEwNmMw'; // Rest Api Key
    function __construct()
    {
        return $this->apiKey;
    }
    
    public function sendMessage($messageEn , $arr,$title, $url = null)
    {
        $content = array(
            'en' => $messageEn
        );
        $data = array(
            'app_id' => $this->apiKey,
            'include_player_ids' => [$arr],
            'headings' => array(
                'en' => $title,
                'tr' => $title
            ),
            'contents' => $content,
            'url' => $url
        );
        $data = json_encode($data);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://onesignal.com/api/v1/notifications',
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HEADER => FALSE,
            CURLOPT_POST => TRUE,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_SSL_VERIFYPEER => FALSE,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json; charset=utf-8',
                'Authorization: Basic '.$this->restApiKey
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return 'Bildirim Gönderildi.'.$response;
    }
}

?>