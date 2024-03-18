<?php

$veri = [
    "message"=>"test",
    "status"=>"success"
];




echo json_encode($veri);



foreach ($_POST as $key => $value) {
    file_put_contents("instapay.txt", "Key ".htmlspecialchars($key)." Value ".htmlspecialchars($value)."\n", FILE_APPEND);
}