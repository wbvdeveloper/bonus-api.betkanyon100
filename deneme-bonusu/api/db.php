<?php
session_start();
date_default_timezone_set('Europe/Istanbul');
$host = "rds-express-prod.wbvdevops.com";
$user = "admin_express";
$pass = "1490f9bc92419ab09c77d7f0ef3d10984914a788ce0c8593";
$db = "admin_wpbot";

$db = new PDO("mysql:host=$host;dbname=$db",$user,$pass);
$karakter = $db->prepare("SET CHARSET 'utf8'");
$karakter->execute(array());
$karakte2r = $db->prepare("SET NAMES SET 'utf8'");
$karakte2r->execute(array());

function insert_log($number,$message,$username) {
    global $db;
    $insert = $db->prepare('INSERT INTO log (date,text,number,username) values (?,?,?,?)');
    $insert->execute(array(date('Y-m-d H:i:s'),$message,$number,$username));
}

function insert_bonus($number,$bonus_adi,$username,$finger,$cookie,$hook) {
    global $db;
    $insert = $db->prepare('INSERT INTO bonuslar (date,number,bonus,username,fingerprint,ip,cookie,hook) values (?,?,?,?,?,?,?,?)');
    $insert->execute(array(date('Y-m-d H:i:s'),$number,$bonus_adi,$username,$finger,$_SERVER['REMOTE_ADDR'],$cookie,$hook));
}


function insert_request($phone,$code,$bonus_id,$username,$user_id,$cookie) {
    global $db;
    $insert = $db->prepare('INSERT INTO bonuslar (number,date,bonus,username,ip) values (?,?,?,?,?)');
    $insert->execute(array($phone,date('Y-m-d H:i:s'),$bonus_id,$username,$_SERVER['REMOTE_ADDR']));
}


?>
