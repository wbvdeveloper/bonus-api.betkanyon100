<?php 
if ($_POST) {

    $array = array(
        "status" => "success"
    );
    
    
    if ($_POST['type'] != 'withdraw') {
        $data = array(
                'trans_id' => $_POST['provider_transaction_id'],
                'payer_trans_id' => $_POST['ref_code'],
                'message' => $_POST['message'],
                'status' => $_POST['status'],
                'method' => $_POST['type'],
                'amount' => $_POST['amount'],
                'key' => '12345'
        );
        
        do {
            $ch = curl_init('https://expresshavale.com/callback_envoy?'.http_build_query($data));
                curl_setopt($ch, CURLOPT_HEADER, true);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $c = curl_exec($ch);
                $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        } while ($status != 200);
    } else {
        $data = array(
                'trans_id' => $_POST['provider_transaction_id'],
                'payer_trans_id' => $_POST['ref_code'],
                'message' => $_POST['message'],
                'status' => $_POST['status'],
                'method' => $_POST['type'],
                'amount' => $_POST['amount'],
                'key' => '12345'
        );
        do {
            $ch = curl_init('https://expresshavale.com/callback_envoy_withdraw?'.http_build_query($data));
                curl_setopt($ch, CURLOPT_HEADER, true);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $c = curl_exec($ch);
                $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        } while ($status != 200);
        
    }
    
    
    echo json_encode($array);
    header('Content-Type:application/json'); 
}

