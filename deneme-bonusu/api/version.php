<?php
     include 'db.php';
     $insert = $db->prepare('INSERT INTO gelen_guncelleme (ip,tarih,agent) values (?,?,?)');
     $insert->execute(array($_SERVER['REMOTE_ADDR'],date('Y-m-d H:i:s'),$_SERVER['HTTP_USER_AGENT']));
?>