<?php
    $data = json_decode(file_get_contents( 'php://input' ),true);
     if ($data['method'] == 'withdraw') {
         $datas = array(
                'trans_id' => $data['transactionId'],
                'payer_trans_id' => $data['session_id'],
                'message' => '',
                'status' => $data['statu'],
                'method' => $data['method'],
                'amount' =>  '',
                'key' => '12345'
         );
         
         do {
            $ch = curl_init('https://expresshavale.com/callback_paygiga_withdraw?'.http_build_query($datas));
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $c = curl_exec($ch);
            $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            echo $c;
        } while ($status != 200);
     } else {
         $datas = array(
                'trans_id' => $data['transactionId'],
                'payer_trans_id' => $data['session_id'],
                'message' => '',
                'status' => $data['statu'],
                'method' => $data['method'],
                'amount' =>  '',
                'key' => '12345'
         );
         
         do {
            $ch = curl_init('https://expresshavale.com/callback_paygiga?'.http_build_query($datas));
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $c = curl_exec($ch);
            $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            echo 'döndü+';
        } while ($status != 200);
         
     }
        
?>