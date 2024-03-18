<?php
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

    $query = $db->prepare('SELECT * FROM system WHERE bonus = 1');
    $query->execute(array());
    $query = $query->fetch(PDO::FETCH_ASSOC);

    if ($query->rowCount() > 0 && date('H') == 18) {
        $date = date('Y-m-d 18:00:00');
        $alinanlar = $db->prepare('UPDATE alinanlar SET bonus = 0 WHERE son_date < '.$date.'');
        $alinanlar->execute(array());
        $update = $db->prepare('UPDATE system SET bonus = 0');
        $update->execute(array());
    }

?>
