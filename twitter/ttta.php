<?php
        error_reporting(E_ALL);
ini_set('display_errors', 1);
        include 'onesignal.php';
        $oneSignal = new oneSignal();
        print_r($oneSignal->sendMessage('Size yeni bir mesaj geldi.','fd9eb864-b57f-4961-b764-7f135acf2f86', 'test','http://software2.betkanyon100.com/bonus/whatsapp-web'));


?>