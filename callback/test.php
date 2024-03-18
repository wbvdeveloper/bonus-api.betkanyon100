<?php
include '../ajax/MyFunction.php';

$myFunction = new MyFunction();
$headers = ['Content-Type: application/json','Accept application/json','Authorization: Bearer '.$myFunction->wbFinasToken()];

$clientData = [ 'transaction_id' => 773350,
            'withdraw_id' => 88158103,
            'user_id' => 5304980,
            'site' => 1,
            'status' => 1,
            'payment_method' => 'Ultipays',
            'details' => " Ödendi - Ultipays - 773350 - testttttttttttttt000000000001"
            ];
$response = $myFunction->setCurl('POST', 'https://www.wbfinans.com/api/withdraw/save', $headers, json_encode($clientData), 10, 10);
print_r($response);
