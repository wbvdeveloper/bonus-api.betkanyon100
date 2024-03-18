<?php


    date_default_timezone_set('Europe/Istanbul');

    $host = "rds-express-prod.wbvdevops.com";
    $user = "admin_express";
    $pass = "1490f9bc92419ab09c77d7f0ef3d10984914a788ce0c8593";
    $db = "admin_wpbot";

    function replace_tr($text) {
       $text = trim($text);
       $search = array('Ç','ç','Ğ','ğ','ı','İ','Ö','ö','Ş','ş','Ü','ü');
       $replace = array('c','c','g','g','i','i','o','o','s','s','u','u');
       $new_text = str_replace($search,$replace,$text);
       return $new_text;
    }

    $db = new PDO("mysql:host=$host;dbname=$db",$user,$pass);
    $karakter = $db->prepare("SET CHARSET 'utf8'");
    $karakter->execute(array());
    $karakte2r = $db->prepare("SET NAMES SET 'utf8'");
    $karakte2r->execute(array());

    function sendMessage($phone,$message) {
        global $db;

        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://panel.capiwha.com/send_message.php?apikey=J4NPRICJCX8PA4M5L28D&number=$phone&text=".$message,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        echo $response;

     $insert_log = $db->prepare('INSERT INTO logs (text) values (?)');
     $insert_log->execute(array($response));

    }


    function sendFunction($phone,$type){
        if ($type == 'gunun_maclari') {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://sport.betkanyonvip.com/StaticContent/GetTopEventsList');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, '{"sportId":1,"langId":4,"partnerId":107,"stakeTypes":[1,702]}');
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

            $headers = array();
            $headers[] = 'Accept: application/json, text/javascript, */*; q=0.01';
            $headers[] = 'Referer: https://sport.betkanyon141.com/banner?sportPartner=58131F5F-BD35-4446-815B-8A32D742752C^&l=tr';
            $headers[] = 'Origin: https://sport.betkanyon141.com';
            $headers[] = 'X-Requested-With: XMLHttpRequest';
            $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36';
            $headers[] = 'Content-Type: application/json; charset=UTF-8';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close ($ch);

            $json = json_decode($result,true);

            $ekle = '';
            foreach ($json as $json) {
                $mac_adi = $json['N'];

$ekle .= $mac_adi.'
*1*: '.$json['StakeTypes'][0]['Stakes'][0]['F'].'     *X*: '.$json['StakeTypes'][0]['Stakes'][1]['F'].'     *2*: '.$json['StakeTypes'][0]['Stakes'][2]['F'].'

';
            }
            sendMessage($phone,urlencode($ekle));
        }
    }

    $serialize = json_decode($_POST['data'],true);

    if ($serialize['event'] == 'INBOX') {

        if ($serialize['from'] == '905301830684') {
            die();
        }

        $insert = $db->prepare('INSERT INTO messages (sender,receiver,message,date) values (?,?,?,?)');
        $insert->execute(array($serialize['from'],$serialize['to'],addslashes(strip_tags($serialize['text'])),date('Y-m-d H:i:s')));
        $serialize['text'] = str_replace('5 tl','5tl',trim($serialize['text']));
        $serialize['text'] = str_replace('5 TL','5tl',$serialize['text']);
        $serialize['text'] = str_replace('5 Tl','5tl',$serialize['text']);
        $serialize['text'] = str_replace('5 tL','5tl',$serialize['text']);
        $explode = explode(' ',addslashes(strip_tags($serialize['text'])));
        if ($explode[0] == '5TL' or $explode[0] == '5tl') {
            include 'twitter_auth.php';
            $buser = $explode[1];
            $tuser = $explode[2];
            $message = twitter_bonus($buser,$tuser,$serialize['from'],addslashes(strip_tags($serialize['text'])));
            sendMessage($serialize['from'],urlencode($message['message']));
        } else if (strtolower($explode[0]) == 'spor' and strtolower($explode[1]) == 'deneme' or mb_strtolower($explode[0],'UTF-8') == 'casino' and strtolower($explode[1]) == 'deneme') {
                if (!isset($explode[2])) {
                    if (strtolower($explode[0]) == 'spor') {
                        sendMessage($serialize['from'],urlencode('Spor 50 TL deneme bonusunu almak için, Spor Deneme *Kullanıcıadı* şeklinde yazın'));
                    }
                    if (mb_strtolower($explode[0],'UTF-8') == 'casino') {
                        sendMessage($serialize['from'],urlencode('Casino 30 TL deneme bonusunu almak için, Casino Deneme *Kullanıcıadı* şeklinde yazın'));
                    }
                } else {
                      include 'twitter_auth.php';
                      $message = deneme_bonusu(strtolower($explode[0]),$serialize['from'],$explode[2]);
                      $message['message'] = str_replace('-pushpin','📌',$message['message']);
                      sendMessage($serialize['from'],urlencode($message['message']));
                }
        } else {
            $query = $db->prepare('SELECT * FROM command WHERE text LIKE "%'.$serialize['text'].'%" and special <> 1 LIMIT 1');
            $query->execute(array(trim(replace_tr($serialize['text']))));
            if ($query->rowCount() == 0) {
                $query = $db->prepare('SELECT * FROM command WHERE text = ? LIMIT 1');
                $query->execute(array('bos'));
                $query = $query->fetch(PDO::FETCH_ASSOC);
                $query['message'] = str_replace('-pushpin','📌',$query['message']);
                sendMessage($serialize['from'],urlencode($query['message']));
                $insert_log = $db->prepare('INSERT INTO logs (text) values (?)');
                $insert_log->execute(array('Bu komuta ait mesaj bulunamadı'));
            } else {
                $query = $query->fetch(PDO::FETCH_ASSOC);
                if ($query['special'] == 0) {
                    $insert_log = $db->prepare('INSERT INTO logs (text) values (?)');
                    $insert_log->execute(array('Mesaj cevap verildi.'));
                    $query['message'] = str_replace('-pushpin','📌',$query['message']);
                    sendMessage($serialize['from'],urlencode($query['message']));
                } else {
                    $insert_log = $db->prepare('INSERT INTO logs (text) values (?)');
                    $insert_log->execute(array('Mesaj fonksyion cevap verildi.'));
                    sendFunction($serialize['from'],$query['function']);
                }
            }
        }
    }


    echo $_SERVER['REMOTE_ADDR'];

?>
