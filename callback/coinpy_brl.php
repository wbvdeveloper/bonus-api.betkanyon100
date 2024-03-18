<?php
    if ($_POST) {
        
        $amount = addslashes(strip_tags($_POST['amount1']));
        $id = addslashes(strip_tags($_POST['item_number']));
        $txn_id = addslashes(strip_tags($_POST['txn_id']));
        $status = addslashes(strip_tags($_POST['status']));
        $currency1 = addslashes(strip_tags($_POST['currency1']));
        $currency2 = addslashes(strip_tags($_POST['currency2']));
        $datas = array(
                'trans_id' => $id,
                'payer_trans_id' => $txn_id,
                'message' => '',
                'status' => $status,
                'method' => $currency1.'-'.$currency2,
                'amount' => $amount,
                'key' => '12345'
        );
        file_put_contents("coinpayments.log", json_encode($datas), FILE_APPEND);
        do {
            $ch = curl_init('https://expressbrl.com/callback_coinpayments?'.http_build_query($datas));
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $c = curl_exec($ch);
            $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            file_put_contents("coinpayments.log", $c, FILE_APPEND);
        } while ($status != 200);
        
    }
?>