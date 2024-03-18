<?php


#### PAY TURKA FİRMASININ İŞLEMLERİN OLUMLU OLDUĞUNDA DÖNDÜĞÜ SONUÇLARI ALIYORUZ.

    $payment_short_code = $_POST["payment_short_code"];
    $transaction_id = $_POST["transaction_id"];
    $enduser_username = $_POST["enduser_username"];
    $amount  = $_POST["amount"];
    $fullName = $_POST["fullName"];
    $Token = $_POST["token"];
    $customer_transaction_id = $_POST["customer_transaction_id"];  
            
   $datas = array(
   'transaction_id'=>$transaction_id,
   'enduser_username'=>$enduser_username,
   'amount'=>$amount,
   'fullName'=>$fullName,
   'customer_transaction_id'=>$customer_transaction_id,
   'token'=>$Token,
   'key'=>'12345'
   
   
   );     

        
        do {
            $ch = curl_init('https://expresshavale.com/callback_cmt?'.http_build_query($datas));
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $c = curl_exec($ch);
            $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
           
        } while ($status != 200);
    
    

    
    $array = array(
        "status" => "success"
    );

    echo json_encode($array);
    header('Content-Type:application/json'); 
    


?>