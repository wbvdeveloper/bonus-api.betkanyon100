<?php
    header('Content-Type:application/json');
if ($_POST) {
    $datas = json_decode($_POST['data'],true);
    $count = 0;
    foreach($datas as $data){   ### işlemde bazen dizi halinde veriler gelmekte. Bunları ayırıyoruz.
	   if ($data['Type'] == 'Deposit') {
	       $datas = array(
	                'trans_id' => $data['ProcessID'],
	                'payer_trans_id' => $data['URefID'],
	                'message' => '',
	                'status' => $data['Status'],
	                'method' => $data['Type'],
	                'amount' => $data['Amnt'],
	                'key' => '12345'
	        );


	            $ch = curl_init('https://expresshavale.net/callback_cmt?'.http_build_query($datas));
	            curl_setopt($ch, CURLOPT_HEADER, true);
	            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	            $c = curl_exec($ch);
	            $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				       echo $c;
	            //echo 'döndü+';

            //  exit();
            //    sleep(10);

	    } else {
           $datas = array(
	                'trans_id' => $data['ProcessID'],
	                'payer_trans_id' => $data['URefID'],
	                'message' => '',
	                'status' => $data['Status'],
	                'method' => $data['Type'],
	                'amount' => $data['Amnt'],
	                'key' => '12345'
	        );


	            $ch = curl_init('https://expresshavale.net/callback_aninda_withdraw?'.http_build_query($datas));
	            curl_setopt($ch, CURLOPT_HEADER, true);
	            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	            $c = curl_exec($ch);
	            $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	          //  echo 'döndü+';
            //    sleep(10);
          //    exit();
       }







      $count++;
    } #### foreach bitiş ####
    $array = array(
        "status" => "success",
        "count" => $count
    );
    echo json_encode($array);

}else{
  $array = array(
      "status" => "error"
  );
//	echo "Only post";
}

?>
