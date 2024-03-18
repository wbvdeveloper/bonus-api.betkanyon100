<?php

  include 'db.php';
  header('Content-Type: application/json; charset=utf-8');
        $status = 400;
        $message = 'hatalı metot!';
  if ($_POST) {
      $paid_status = 2;
      $desct = '';
      $payment_short_code = $_POST["payment_short_code"];
      $transaction_id = $_POST["transaction_id"];
      $enduser_username = $_POST["enduser_username"];
      $amount  = $_POST["amount"];
      $fullName = $_POST["fullName"];
      $Token = $_POST["token"];
      $customer_transaction_id = $_POST["customer_transaction_id"];

      $log = file_put_contents('payfix.log', '['.date('Y-m-d H:i:s').'] logger.INFO: Withdraw Callback '. json_encode($_POST).PHP_EOL, FILE_APPEND | LOCK_EX);
      /**
      * If manuel withdraw, we will send callback to wbfinance.com api
      */
      if($enduser_username == 'manuelWithdraw' && strlen($customer_transaction_id) >= 13){

        include '../ajax/MyFunction.php';
        $myFunction = new MyFunction();
        if ($_POST["status"] == 'completed') {
            $paid_status = 1;
        }
        $desct = "Ödendi-Payfix-".$customer_transaction_id;
        $headers = ['Content-Type: application/json','Accept: application/json','Authorization: Bearer '.$myFunction->wbFinasToken()];
        $clientData = [
            'transaction_id' => (int) $customer_transaction_id,
            'withdraw_id'    => (int) $customer_transaction_id,
            'status'         => $paid_status,
            'payment_method' => 'Payfix',
            'details'        => $desct
        ];
        $response = $myFunction->setCurl('POST', 'https://www.wbfinans.com/api/withdraw/manuel/save', $headers, json_encode($clientData), 10, 10);
        $log = file_put_contents('payfix.log', json_encode($response).PHP_EOL, FILE_APPEND | LOCK_EX);
        http_response_code(200);
        echo '{"status" : 200, "message" : ""}';
        exit();
      }


      $cekim = $db->prepare('SELECT id,cekim_id, status,site,player_id,player_username
                            FROM hizli_havale_cekim
                            WHERE cekim_id = ? AND player_username = ?
                            ORDER BY id DESC  LIMIT 1 ');
      $cekim->execute(array($customer_transaction_id,$enduser_username));
      $cekim = $cekim->fetch(PDO::FETCH_ASSOC);
      $message = 'Sistemde böyle bir kayıt mevcut değil.';
      if ($cekim['id'] > 0) {
          $message = 'Daha önce başka bir işlem gördüğü için onaylayamazssınız.';
          if ($cekim['status'] == 0) {
              $message = 'hcallback status : '.$_POST["status"].' olduğu için onaylanmamıştır.';
              if ($_POST["status"] == 'completed') {
                  $desct = "Ödendi-Payfix-".$transaction_id;
                  $withdraw_datble = [1 => 'withdraw', 2 => 'withdraw2', 3 => 'withdraw3', 5 => 'withdraw5'];
                  $table = $withdraw_datble[$cekim['site']];
                  $updateCekim = $db->prepare('UPDATE hizli_havale_cekim SET ref_code = ?, status = ?  WHERE id = ? AND player_id = ? ');
                  $updateCekim->execute([$desct, 1, $cekim['id'],  $cekim['player_id'] ]);
                  $updateWithdraw = $db->prepare('UPDATE '.$table.' SET desct = ?  WHERE withdraw_id = ? ');
                  $updateWithdraw->execute([$desct, $cekim['cekim_id']]);
                  $message = '';
                  $status = 200;
                  $paid_status = 1;
              }
          }
      }

       // wbfinans'a gönderme
      if($status == 200) {
        include '../ajax/MyFunction.php';
        $myFunction = new MyFunction();
        $headers = ['Content-Type: application/json','Accept: application/json','Authorization: Bearer '.$myFunction->wbFinasToken()];
        $clientData = [ 'transaction_id' => $cekim['cekim_id'],
                        'withdraw_id' => $cekim['cekim_id'],
                        'user_id' => $cekim['player_id'],
                        'site' => $cekim['site'],
                        'status' => $paid_status,
                        'payment_method' => 'Payfix',
                        'details' => $desct
                      ];
        $response = $myFunction->setCurl('POST', 'https://www.wbfinans.com/api/withdraw/save', $headers, json_encode($clientData), 10, 10);
      }
  }
  http_response_code($status);
  echo '{"status" : '.$status.', "message" : "'.$message.'"}';
