<?php
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

    $etsil = $db->prepare('SELECT * FROM alinanlar');
    $etsil->execute(array());

    foreach ($etsil as $etsil) {
        $str = str_replace('@','',$etsil['twitter']);
        $update = $db->prepare('UPDATE alinanlar SET twitter = ? WHERE id = ? LIMIT 1');
        $update->execute(array($str,$etsil['id']));
    }


?>
