<?php
session_start();
$host = "rds-bonus-proxy.wbvdevops.com";
$user = "root";
$pass = "1490f9bc92419ab09c77d7f0ef3d10984914a788ce0c8593";
$db = "bonus";
date_default_timezone_set('Europe/Istanbul');
$db = new PDO("mysql:host=$host;dbname=$db",$user,$pass);
$karakter = $db->prepare("SET CHARSET 'utf8'");
$karakter->execute(array());
$karakte2r = $db->prepare("SET NAMES SET 'utf8'");
$karakte2r->execute(array());
define('URL','https://bonus-api.betkanyon100.com/');

?>
