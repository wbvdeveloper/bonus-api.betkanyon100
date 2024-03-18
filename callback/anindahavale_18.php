<?php

if ($_POST) {

    $data = json_decode($_POST['data'],true);
    $log = file_put_contents('aninda.log', '['.date('Y-m-d H:i:s').'] logger.INFO: '.$data[0]['Type'].' Callback '.json_encode($data).PHP_EOL, FILE_APPEND | LOCK_EX);

    foreach($data as $data){   ### işlemde bazen dizi halinde veriler gelmekte. Bunları ayırıyoruz.

	   if ($data['Type'] == 'Deposit') {
	       $datas = array(
	                'trans_id' => $data['ProcessID'],
	                 'payer_trans_id' => $data['URefID']."-".$data['ProcessID']."-".$data['BCSubID'],
	                'message' => '',
	                'status' => $data['Status'],
	                'method' => $data['Type'],
	                'amount' => $data['Amnt'],
	                'key' => '12345'
	        );

	        do {
	            $ch = curl_init('https://expresshavale.com/callback_aninda?'.http_build_query($datas));
	            curl_setopt($ch, CURLOPT_HEADER, true);
	            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	            $c = curl_exec($ch);
	            $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	            echo 'döndü+';
	        } while ($status != 200);
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

	        do {
	            $ch = curl_init('https://expresshavale.com/callback_aninda_withdraw?'.http_build_query($datas));
	            curl_setopt($ch, CURLOPT_HEADER, true);
	            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	            $c = curl_exec($ch);
	            $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	            echo 'döndü+';
	        } while ($status != 200);
       }



	    $array = array(
	        "status" => "success"
	    );

	    echo json_encode($array);
	    header('Content-Type:application/json');

    } #### foreach bitiş ####
}else{

	echo "sorun yok";
}

?>
