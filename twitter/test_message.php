<?php

$host = "rds-express-prod.wbvdevops.com";
$user = "admin_express";
$pass = "1490f9bc92419ab09c77d7f0ef3d10984914a788ce0c8593";
$db = "admin_wpbot";

        $db = new PDO("mysql:host=$host;dbname=$db",$user,$pass);
        $karakter = $db->prepare("SET CHARSET 'utf8'");
        $karakter->execute(array());
        $karakte2r = $db->prepare("SET NAMES SET 'utf8'");
        $karakte2r->execute(array());

        function sendMessage($phone,$message) {
            global $db;

            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://panel.capiwha.com/send_message.php?apikey=1SJO8DKBTUHW9QI97GVG&number=$phone&text=".$message,
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

           return $response;
        }

        $gonderilen = 0;

        $query = $db->prepare('SELECT * FROM deneme_bonusu WHERE wp = 0');
        $query->execute(array());
        foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $query) {
            sendMessage($query['phone'],'http://software2.betkanyon100.com/twitter/15-cevrimsiz-asistan.jpg');
            $update = $db->prepare('UPDATE deneme_bonusu SET wp = 1 WHERE id = ? LIMIT 1');
            $update->execute(array($query['id']));
            $rand = rand(40,70);
            $gonderilen++;
            echo 'Yeni mesaj gönderildi. Gönderilen Toplam : '.$gonderilen.' - Telefon :  '.$query['phone'].' - Sonraki Gönderim Saniyesi : '.$rand.PHP_EOL;
            sleep($rand);
        }






?>
