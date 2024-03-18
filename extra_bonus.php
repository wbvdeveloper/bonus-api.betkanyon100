<?php
    error_reporting(0);
    if (!isset($_GET['jwt'])) {
        die('Only POST method');
    }

    header("Access-Control-Allow-Origin: *");
    header('Content-Type:application/json');
    set_time_limit(0);
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

$type = addslashes(stripslashes($_GET['bonus']));
$bonus_type = addslashes(stripslashes($_GET['type']));
$period = addslashes(stripslashes($_GET['period']));
include 'jwt/vendor/autoload.php';
use \Firebase\JWT\JWT;
if (!$_GET['user_id']) {
    include 'jwt/vendor/autoload.php';
    $decoded = JWT::decode($_GET['jwt'], '3EF97E3AE324FDA34C73551407D9C39B7AD670D2ABD80A84882B052E09F19B0C', array('HS256'));
    $_GET['id'] = $decoded->external_id;
} else {
    $_GET['id'] = addslashes(strip_tags($_GET['user_id']));
}

if ($_GET) {
    $date1 = '2020-03-14 00:00:00';
    $date2 = '2020-03-15 23:59:59';
    $player_id = addslashes(strip_tags($_GET['id']));
    $query = $db->prepare('SELECT * FROM deposit WHERE date >= "'.$date1.'" and date <= "'.$date2.'" and player_id = ? LIMIT 1');
    $query->execute(array($player_id));
    
    if ($query->rowCount() == 0) {
        $json = array(
            'status' => 'error',
            'message' => 'Bu özel kayıp bonusundan yararlanabilmeniz için hafta sonu boyunca en az bir kez yatırım işlemi yapmanız gerekir.'
        );
    } else {
        $insert = $db->prepare('INSERT INTO extra_bonus (user_id,created_date) values (?,?)');
        $insert->execute(array($player_id,date('Y-m-d H:i:s')));
        $json = array(
            'status' => 'success',
            'message' => "Talebiniz alınmıştır. Ekstra %10 kayıp bonusu Salı günü 12:00'da hesabınıza aktarılacaktır."
        );
    }
}
echo json_encode($json);


?>