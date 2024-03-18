<?php
header('Content-Type:application/json');
set_time_limit(0);
session_start();
$host = "207.154.251.195";
$user = "admin_bonus";
$pass = "admin_bonus!";
$db = "admin_bonus";
date_default_timezone_set('Europe/Istanbul');
$db = new PDO("mysql:host=$host;dbname=$db",$user,$pass);
$karakter = $db->prepare("SET CHARSET 'utf8'");
$karakter->execute(array());
$karakte2r = $db->prepare("SET NAMES SET 'utf8'");
$karakte2r->execute(array());

if ($_POST) {
    $username = trim(addslashes(strip_tags($_POST['username'])));
    $call_id = base64_decode(trim(addslashes(strip_tags($_POST['call_id']))));
    $site = 2;
    if ($username != '') {
        $query = $db->prepare('SELECT * FROM sans_bonusu WHERE site = 1 and username = ? and status = 0 LIMIT 1');
        $query->execute(array($username));
        if ($query->rowCount() == 0) {
            $insert = $db->prepare('INSERT INTO sans_bonusu (username,amount,tarih,status,site,call_id,ip) values (?,?,?,?,?,?,?)');
            $insert->execute(array($username,0,date('Y-m-d H:i:s'),0,$site,$call_id,$_SERVER['REMOTE_ADDR']));
            if ($insert) {
                $json = array(
                    "status" => "success",
                    "message" => "Şans bonusu talebiniz alınmıştır kısa süre içinde sonuçlanacaktır."
                );
            } else {
                $json = array(
                    "status" => "error",
                    "message" => "Bir hata oluştu lütfen tekrar deneyin."
                );
            }
        } else {
            $json = array(
                "status" => "error",
                "message" => "Aktif bir bekleyen talebiniz bulunmaktadır. Lütfen sonuçlanmasını bekleyin."
            );
        }
    } else {
        $json = array(
            "status" => "error",
            "message" => "Lütfen kullanıcı adınızı yazınız.."
        );
    }
    echo json_encode($json);
}


?>