<?php

function checkActiveBonus($player_id) {
    $Check = 0;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://adminwebsd.apidigi.com/api/Main/ApiRequest?TimeZone=3&LanguageId=en');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'Method=GetBonusByClientId&Controller=Bonus&TimeZone=3&RequestObject='.$player_id);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

    $headers = array();
    $headers[] = 'Sec-Fetch-Mode: cors';
    $headers[] = 'Origin: https://betkanyon.admindigi.com';
    $headers[] = 'Accept-Language: en';
    $headers[] = 'Authorization: Bearer '.file_get_contents('https://software2.betkanyon100.com/token_al_ba.php');
    $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
    $headers[] = 'Referer: https://betkanyon.admindigi.com/';
    $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = json_decode(curl_exec($ch),true);
    foreach ($result['ResponseObject']['Entities'] as $bonus) {
        if ($bonus['ClientBonusStatus'] == 2 && $bonus['BonusType'] == 10 or $bonus['ClientBonusStatus'] == 1 && $bonus['BonusType'] == 10) {
            $Check = 1;
        }
    }
    return $Check;
 }
 

function CreateBonus($bonus_id,$player_id,$amount) {
    $start_time = date('Y-m-d H:i');
    $finish_time = date('Y-m-d H:i', strtotime("+15 day"));
    
    $Check = 0;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://adminwebsd.apidigi.com/api/Main/ApiRequest?TimeZone=3&LanguageId=en');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'Method=AddWagerBonusToClient&Controller=Bonus&TimeZone=3&RequestObject={"BonusId":'.$bonus_id.',"ClientIds":['.$player_id.'],"SegmentIds":[],"StartDate":"'.$start_time.'","EndDate":"'.$finish_time.'","Amount":'.$amount.',"AutoAdd":true,"AutoDelete":false,"ForceForClient":false}');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

    $headers = array();
    $headers[] = 'Sec-Fetch-Mode: cors';
    $headers[] = 'Origin: https://betkanyon.admindigi.com';
    $headers[] = 'Accept-Language: en';
    $headers[] = 'Authorization: Bearer '.file_get_contents('https://software2.betkanyon100.com/token_al_ba.php');
    $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
    $headers[] = 'Referer: https://betkanyon.admindigi.com/';
    $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = json_decode(curl_exec($ch),true);
    if ($result['ResponseObject'] == true) {
        $Check = 1;
    }
    return $Check;
}

file_get_contents('http://software2.betkanyon100.com/token_al.php');

    header("Access-Control-Allow-Origin: *");
    header('Content-Type:application/json');

   if (!isset($_GET['jwt'])) {
        die('Only POST method');
    }

    set_time_limit(0);
  session_start();
$host = "rds-bonus-proxy.wbvdevops.com";
$user = "root";
$pass = "1490f9bc92419ab09c77d7f0ef3d10984914a788ce0c8593";
$db = "bonus";
date_default_timezone_set('Europe/Istanbul');
$db = new PDO("mysql:host=$host;dbname=$db",$user,$pass);
$karakter = $db->prepare("SET CHARSET 'utf8'");
$karakter->execute(array());
$karakte2r = $db->prepare("SET NAMES SET 'utf8'");
$karakte2r->execute(array());


include 'jwt/vendor/autoload.php';
use \Firebase\JWT\JWT;
if (!$_GET['user_id']) {
    include 'jwt/vendor/autoload.php';
    $decoded = JWT::decode($_GET['jwt'], '3EF97E3AE324FDA34C73551407D9C39B7AD670D2ABD80A84882B052E09F19B0C', array('HS256'));
    $_GET['id'] = $decoded->external_id;
} else {
    $_GET['id'] = addslashes(strip_tags($_GET['user_id']));
}


    $type = addslashes(stripslashes($_GET['bonus']));
    $bonus_type = addslashes(stripslashes($_GET['type']));

    function tum_bosluk_sil($veri)
{
$veri = str_replace("/s+/","",$veri);
$veri = str_replace(" ","",$veri);
$veri = str_replace(" ","",$veri);
$veri = str_replace(" ","",$veri);
$veri = str_replace("/s/g","",$veri);
$veri = str_replace("/s+/g","",$veri);		
$veri = trim($veri);
return mb_strtolower($veri,'utf8'); 
}; 

    function kontrolsil($player_id) {
        global $db;
        $delete = $db->prepare('DELETE FROM bonus_kontrol WHERE player_id = ? LIMIT 1');
        $delete->execute(array($player_id));
    }

    if ($_GET) {
         
         $query = $db->prepare('SELECT id FROM bonus_kontrol WHERE player_id = ? LIMIT 1');
         $query->execute(array($player_id));
         if ($query->rowCount() != 0) {
             $json = array(
                'status' => 'error',
                'message' => 'Lütfen teknik ekip ile iletişime geçin, bir hata oluştu.'
             );
             kontrolsil($player_id);
             die(json_encode($json));
         }
         
        
         $player_id = addslashes(strip_tags($_GET['id']));
        
         $insert = $db->prepare('INSERT INTO bonus_kontrol (player_id) values (?)');
         $insert->execute(array($player_id));
        
         $handikap_control = $db->prepare('SELECT * FROM special_deal_handikaplar WHERE user_id = ? LIMIT 1');
         $handikap_control->execute(array($player_id));
         $handikap_control_row = $handikap_control->rowCount();
         $handikap_control = $handikap_control->fetch(PDO::FETCH_ASSOC);
        
         $disabled = $db->prepare('SELECT * FROM block_user WHERE user = ? LIMIT 1');
         $disabled->execute(array($player_id));
         if ($disabled->rowCount() != 0) {
             $disabled = $disabled->fetch(PDO::FETCH_ASSOC);
             
             if ($disabled['infinity'] == 1) {
                 $json = array(
                    'status' => 'error',
                    'message' => 'Bonus alma hakkınız engellenmiştir.'
                 );
             } else {
                 $json = array(
                    'status' => 'error',
                    'message' => 'Bonus alma hakkınız geçiçi bir süre engellenmiştir. Bitiş Süresi : '.$disabled['time']
                 );
             }
             kontrolsil($player_id);
             die(json_encode($json));
         }
        
        

        
        
   
        
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://adminwebsd.apidigi.com/api/Main/ApiRequest?TimeZone=3&LanguageId=en');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'Method=GetPaymentRequestsPaging&Controller=PaymentSystem&TimeZone=3&RequestObject={"SkipCount":0,"TakeCount":100,"OrderBy":null,"FieldNameToOrderBy":"","PartnerId":null,"PartnerIds":[],"FromDate":"'.date('Y-m-d',strtotime(date('Y-m-d').'-2 days')).'T21:00:00.000Z","ToDate":"'.date('Y-m-d').'T21:00:00.000Z","Ids":[],"Type":2,"IsCreatedOrUpdate":false,"UserNames":[],"Currencies":[],"CheckHasNote":null,"CheckHasAttantion":null,"Statuses":[],"States":[{"OperationTypeId":1,"IntValue":8}],"Names":[],"CreatorNames":[],"ClientIds":[{"OperationTypeId":1,"IntValue":'.$_GET['id'].'}],"UserIds":[],"PartnerPaymentSettingIds":[],"PaymentSystemIds":[],"BetShopIds":[],"BetShopNames":[],"Amounts":[],"CreationDates":[],"LastUpdateDates":[],"Categories":[],"autoTransferIdram":false,"CurrencyId":null,"AutoRefresh":false}');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();
        $headers[] = 'Sec-Fetch-Mode: cors';
        $headers[] = 'Origin: https://betkanyon.admindigi.com';
        $headers[] = 'Accept-Language: en';
        $headers[] = 'Authorization: Bearer '.file_get_contents('https://software2.betkanyon100.com/token_al_ba.php');
        $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
        $headers[] = 'Referer: https://betkanyon.admindigi.com/';
        $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = json_decode(curl_exec($ch),true);
        
        

        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        
        
        
        

        if (count($result['ResponseObject']['PaymentRequests']['Entities']) != 0) {
            foreach ($result['ResponseObject']['PaymentRequests']['Entities'] as $partner) {
           
                
                if ($partner['Id'] < 7741271) {
                     $json = array(
                        'status' => 'error',
                        'message' => 'Bu yatırım için zaten manuel olarak bonus almışsınız.',
                        'show' => 0
                     );
                     kontrolsil($player_id);
                     die(json_encode($json));
                }
                
                 $code_control = $db->prepare('SELECT * FROM code_kullanim WHERE deposit_id = ? LIMIT 1');
                 $code_control->execute(array($partner['Id']));
                 if ($code_control->rowCount() != 0) {
                     $json = array(
                        'status' => 'error',
                        'message' => 'Son yatırımınıza "Kod ile bonus aldığınızdan" dolayı, bonus alma hakkınız bulunmamaktadır.'
                     );
                     kontrolsil($player_id);
                     die(json_encode($json));
                 }
                
                if ($partner['PaymentSystemName'] == 'TransferToAccount') {
                    $partner['PaymentSystemName'] = 'Havale';
                }
                
                if ($partner['PaymentSystemName'] == 'YapiKredi' or $partner['PaymentSystemName'] == 'GarantiBank' or $partner['PaymentSystemName'] == 'IsBankasiCepmatik' or $partner['PaymentSystemName'] == 'FinansBank' or $partner['PaymentSystemName'] == 'Vakifbank' or $partner['PaymentSystemName'] == 'GarantiOneCepbank' or $partner['PaymentSystemName'] == 'DenizBank' or $partner['PaymentSystemName'] == 'DenizBank' or $partner['PaymentSystemName'] == 'Akbank') {
                    $partner['PaymentSystemName'] = 'Cepbank';
                }
                
                if ($partner['PaymentSystemName'] == 'CoinPayment' or $partner['PaymentSystemName'] == 'Bitcoin' or $partner['PaymentSystemName'] == 'Ethereum' or $partner['PaymentSystemName'] == 'Ripple') {
                    $partner['PaymentSystemName'] = 'Kripto Para';
                }
                
                if ($partner['PaymentSystemName'] == 'JetonWallet') {
                    $partner['PaymentSystemName'] = 'Jeton';
                }
              
                if ($partner['PaymentSystemName'] == 'Hızlı Havale - AnindaPapara') {
                     $partner['PaymentSystemName'] = 'Papara';
                }

                
                if ($partner['PaymentSystemName'] == 'ExpressHavale') {
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, 'https://adminwebsd.apidigi.com/api/Main/ApiRequest?TimeZone=3&LanguageId=en');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, 'Method=GetPaymentRequestInfo&Controller=PaymentSystem&TimeZone=3&RequestObject='.$partner['Id']);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

                    $headers = array();
                    $headers[] = 'Sec-Fetch-Mode: cors';
                    $headers[] = 'Origin: https://betkanyon.admindigi.com';
                    $headers[] = 'Accept-Language: en';
                    $headers[] = 'Authorization: Bearer '.file_get_contents('https://software2.betkanyon100.com/token_al_ba.php');
                    $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
                    $headers[] = 'Referer: https://betkanyon.admindigi.com/';
                    $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36';
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                    $result = json_decode(curl_exec($ch),true);

                    $result = json_decode($result['ResponseObject'],true);

                    $partner['PaymentSystemName'] = $result['AdditionalInfo'][1]['Value'];

                    if ($partner['PaymentSystemName'] == 'Hızlı Havale - Anindahavale') {
                        $partner['PaymentSystemName'] = 'Hızlı Havale';
                    }

                      
                    if ($partner['PaymentSystemName'] == 'Hızlı QR - Bestpay') {
                        $partner['PaymentSystemName'] = 'Hızlı QR';
                    }
                    
                     if ($partner['PaymentSystemName'] == 'Hızlı Havale - AnindaQR') {
                        $partner['PaymentSystemName'] = 'Hızlı QR';
                    }

                    if ($partner['PaymentSystemName'] == 'Hızlı QR - Envoysoft') {
                        $partner['PaymentSystemName'] = 'Hızlı QR';
                    }
                    
                    if ($partner['PaymentSystemName'] == 'Hızlı QR - Envoysoft') {
                        $partner['PaymentSystemName'] = 'Hızlı QR';
                    }

                    if ($partner['PaymentSystemName'] == 'Hızlı Havale - Envoysoft') {
                        $partner['PaymentSystemName'] = 'Hızlı Havale';
                    }

                    if ($partner['PaymentSystemName'] == 'Hızlı havale - Paygiga') {
                        $partner['PaymentSystemName'] = 'Hızlı Havale';
                    }

                    if ($partner['PaymentSystemName'] == 'Hızlı Havale - Bestpaycard') {
                        $partner['PaymentSystemName'] = 'Hızlı Havale';
                    }

                    if ($partner['PaymentSystemName'] == 'CMT-PayTurka') {
                        $partner['PaymentSystemName'] = 'CMT Cüzdan';
                    }

                    if ($partner['PaymentSystemName'] == 'Cep Bank') {
                        $partner['PaymentSystemName'] = 'Cepbank';
                    }
                }
                
                
                $gunluk_limit_define = 1000;
                if ($type != 3) {
                    if ($type != 4) {
                            if ($_GET['bonus'] == 2) {
                                // Çevrimli - No Limit
                                $gunluk_check = $db->prepare('SELECT SUM(bonus_amount) as total FROM verified_bonus WHERE bonus_type = 2 and player_id = ? and created_date LIKE "%'.date('Y-m-d').'%" LIMIT 10');
                                $gunluk_check->execute(array($player_id));
                                $gunluk_check = $gunluk_check->fetch(PDO::FETCH_ASSOC);
                                if ($gunluk_check['total'] == '') {
                                     $gunluk_check['total'] = 0;
                                }

                                if ($handikap_control_row != 0) {
                                    if ($handikap_control['handikap'] == 1) {
                                        $gunluk_limit_define = 1000000;
                                    }
                                 } 

                            } else if ($_GET['bonus'] == 1) {
                                $gunluk_check = $db->prepare('SELECT SUM(bonus_amount) as total FROM verified_bonus WHERE bonus_type = 1 and player_id = ? and created_date LIKE "%'.date('Y-m-d').'%" LIMIT 10');
                                $gunluk_check->execute(array($player_id));
                                $gunluk_check = $gunluk_check->fetch(PDO::FETCH_ASSOC);
                                if ($gunluk_check['total'] == '') {
                                     $gunluk_check['total'] = 0;
                                }
                            }

                             if ($gunluk_check['total'] >= $gunluk_limit_define) {
                             $json = array(
                                'status' => 'error',
                                'message' => 'Günlük bonus alma limitiniz dolmuştur.',
                                 'show' => 0,
                             );
                            kontrolsil($player_id);
                             die(json_encode($json));
                        }
                     } 
                }

                
                 $bonus_check = $db->prepare('SELECT * FROM verified_bonus WHERE deposit_id = ? LIMIT 1');
                 $bonus_check->execute(array($partner['Id']));
                 if ($bonus_check->rowCount() != 0) {
                     $json = array(
                        'status' => 'error',
                        'message' => 'Son yatırımınız için zaten bonus aldığınızdan ötürü, bonus alamamaktasınız.'
                     );
                     kontrolsil($player_id);
                     die(json_encode($json));
                 }
                
                 $bonus_check2 = $db->prepare('SELECT * FROM matched_discount WHERE deposit_id = ? LIMIT 1');
                 $bonus_check2->execute(array($partner['Id']));
                 if ($bonus_check2->rowCount() != 0) {
                     $json = array(
                        'status' => 'error',
                        'message' => 'Bu yatırım için kayıp bonusu almışsınız.'
                     );
                     kontrolsil($player_id);
                     die(json_encode($json));
                 }
                
                  if ($type == 4) {
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, 'https://adminwebsd.apidigi.com/api/Main/ApiRequest?TimeZone=3&LanguageId=en');
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, 'Method=GetClientInfo&Controller=Client&TimeZone=3&RequestObject='.$_GET['id']);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

                        $headers = array();
                        $headers[] = 'Sec-Fetch-Mode: cors';
                        $headers[] = 'Origin: https://betkanyon.admindigi.com';
                        $headers[] = 'Accept-Language: en';
                        $headers[] = 'Authorization: Bearer '.file_get_contents('https://software2.betkanyon100.com/token_al_ba.php');
                        $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
                        $headers[] = 'Referer: https://betkanyon.admindigi.com/';
                        $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36';
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                        $result = json_decode(curl_exec($ch),true);
                        if ($result['ResponseObject']['TotalDepositsCount'] == 1 or $result['ResponseObject']['TotalDepositsCount'] == 2) {
                            if ($result['ResponseObject']['TotalDepositsCount'] == 2) {
                                if (($result['ResponseObject']['TotalDepositsAmount'] - $partner['Amount']) != 50) {
                                     $json = array(
                                        'status' => 'error',
                                        'message' => 'Hoşgeldin bonusu almaya hakkınız yoktur, promosyonlar sayfasından kuralları gözden geçirebilirsiniz.',
                                         'show' => 0,
                                     );
                                     kontrolsil($player_id);
                                     die(json_encode($json));
                                }
                            }
                        } else {
                            $json = array(
                                'status' => 'error',
                                'message' => 'Hoşgeldin bonusu almaya hakkınız yoktur, promosyonlar sayfasından kuralları gözden geçirebilirsiniz.',
                                 'show' => 0,
                             );
                             kontrolsil($player_id);
                             die(json_encode($json));
                        }
                    }
                
                
                 if ($partner['Amount'] >= 100) {
                        $date = date('Y-m-d H:i:s',strtotime($partner['LastUpdateTime']));
                        $baslangic = strtotime($date);
                        $bitis  = strtotime(date('Y-m-d H:i:s'));
                        $fark = abs($bitis-$baslangic);
                        $toplantiSure= $fark/60;
                        if (($toplantiSure/60) > 48) {
                            $json = array(
                                'status' => 'error',
                                'message' => 'Son 48 saat içinde yatırımınız bulunmamaktadır. Eğer yeni yatırım talebi verdiyseniz lütfen onaylanmasını bekleyiniz.'
                            );
                        } else {
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, 'https://adminwebsd.apidigi.com/api/Main/ApiRequest?TimeZone=3&LanguageId=en');
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, 'Method=GetClientInfo&Controller=Client&TimeZone=3&RequestObject='.$_GET['id']);
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

                            $headers = array();
                            $headers[] = 'Sec-Fetch-Mode: cors';
                            $headers[] = 'Origin: https://betkanyon.admindigi.com';
                            $headers[] = 'Accept-Language: en';
                            $headers[] = 'Authorization: Bearer '.file_get_contents('https://software2.betkanyon100.com/token_al_ba.php');
                            $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
                            $headers[] = 'Referer: https://betkanyon.admindigi.com/';
                            $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36';
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                            $result = json_decode(curl_exec($ch),true);
                            
                            $categoryId = $result['ResponseObject']['CategoryId'];
                            
                          if ($handikap_control_row != 0) {
                                if ($handikap_control['handikap'] == 1) {
                                    if ($_GET['bonus'] == 2) {
                                        $gunluk_limit_define = 1000000;
                                    } else {
                                         $gunluk_limit_define = 1000;
                                    }
                                    $result['ResponseObject']['CategoryId'] = 1;
                                }
                            } 
                            
                            if ($result['ResponseObject']['CategoryId'] == 164) {
                                $json = array(
                                    'status' => 'error',
                                    'message' => 'Sitemizde yatırım bonusu hakkınız bulunmamaktadır. Bir hata oldugunu düşünüyor iseniz canlı destekle iletişime geçebilirsiniz.'
                                );
                            } else if ($result['ResponseObject']['CategoryId'] == 168 and $_GET['bonus'] != 1 or $result['ResponseObject']['CategoryId'] == 163 and $_GET['bonus'] != 1) {
                                $json = array(
                                    'status' => 'success',
                                    'message' => 'Bonus talebiniz alınmıştır en kısa süre içerisinde sonuçlanacaktır.'
                                );
                            } else {
                                
                                function minusHour($date,$hour) {
                                    return date('Y-m-d H:i:s', strtotime('-3 hours', strtotime($date)));
                                }

                                $son12 = minusHour(date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s',strtotime($partner['LastUpdateTime'])).'-24 hours')),3);
                                $son12_check = date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s',strtotime($partner['LastUpdateTime'])).'-24 hours'));
                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, 'https://adminwebsd.apidigi.com/api/Main/ApiRequest?TimeZone=3&LanguageId=en');
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                curl_setopt($ch, CURLOPT_POSTFIELDS, 'Method=GetPaymentRequestsPaging&Controller=PaymentSystem&TimeZone=3&RequestObject={"SkipCount":0,"TakeCount":100,"OrderBy":null,"FieldNameToOrderBy":"","PartnerId":null,"PartnerIds":[],"FromDate":"'.$son12.'","ToDate":"'.date('Y-m-d',strtotime(date('Y-m-d H:i:s').'+1 days')).'","Ids":[],"Type":1,"IsCreatedOrUpdate":false,"UserNames":[],"Currencies":[],"CheckHasNote":null,"CheckHasAttantion":null,"Statuses":[],"States":[],"Names":[],"CreatorNames":[],"ClientIds":[{"OperationTypeId":1,"IntValue":'.$_GET['id'].'}],"UserIds":[],"PartnerPaymentSettingIds":[],"PaymentSystemIds":[],"BetShopIds":[],"BetShopNames":[],"Amounts":[],"CreationDates":[],"LastUpdateDates":[],"Categories":[],"autoTransferIdram":false,"CurrencyId":null,"AutoRefresh":false}');
                                curl_setopt($ch, CURLOPT_POST, 1);
                                curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

                                $headers = array();
                                $headers[] = 'Sec-Fetch-Mode: cors';
                                $headers[] = 'Origin: https://betkanyon.admindigi.com';
                                $headers[] = 'Accept-Language: en';
                                $headers[] = 'Authorization: Bearer '.file_get_contents('https://software2.betkanyon100.com/token_al_ba.php');
                                $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
                                $headers[] = 'Referer: https://betkanyon.admindigi.com/';
                                $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36';
                                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                                $result = json_decode(curl_exec($ch),true);

                                if (isset($result['ResponseObject']['PaymentRequests']['Entities'])) {
                                    $cekim_onay = 1;
                                    foreach ($result['ResponseObject']['PaymentRequests']['Entities'] as $cekim) {
                                        if ($cekim['Status'] == 8 and date('Y-m-d H:i:s',strtotime($cekim['CreationTime'])) > $son12_check or $cekim['Status'] == 1 and date('Y-m-d H:i:s',strtotime($cekim['CreationTime'])) > $son12_check) {
                                            $cekim_onay = 0;
                                        }
                                    }

                                    function yuzde($sayi,$yuzde) {
                                        $b = $sayi / 100;
                                        return ceil($b * $yuzde);
                                    }

                                    if ($cekim_onay == 1) {
                                            $ch = curl_init();
                                            curl_setopt($ch, CURLOPT_URL, 'https://adminwebsd.apidigi.com/api/Main/ApiRequest?TimeZone=3&LanguageId=en');
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                            curl_setopt($ch, CURLOPT_POSTFIELDS, 'Method=GetInternetBetsReportPagingWithoutCC&Controller=Report&TimeZone=3&RequestObject={"SkipCount":0,"TakeCount":100,"OrderBy":null,"FieldNameToOrderBy":"","PartnerId":null,"BetDateFrom":"'.minusHour($partner['LastUpdateTime'],3).'","BetDateBefore":"'.date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s').'+1 days')).'","CheckHasNote":null,"IsSettled":false,"IsOriginalCurrency":false,"Ids":[],"ClientIds":[{"OperationTypeId":1,"IntValue":'.$_GET['id'].'}],"Names":[],"UserNames":[],"Categories":[],"ProductIds":[],"ProductNames":[],"ProviderNames":[],"Currencies":[],"RoundIds":[],"DeviceTypes":[],"ClientIps":[],"Countries":[],"States":[],"BetTypes":[],"PossibleWins":[],"BetAmounts":[],"WinAmounts":[],"BetDates":[],"CalculationDate":[],"GGRs":[],"Balances":[],"TotalBetsCounts":[],"TotalBetsAmounts":[],"TotalWinsAmounts":[],"MaxBetAmounts":[],"TotalDepositsCounts":[],"TotalDepositsAmounts":[],"TotalWithdrawalsCounts":[],"TotalWithdrawalsAmounts":[],"Odds":[],"GameCategoryNames":[],"CurrencyId":null}');
                                            curl_setopt($ch, CURLOPT_POST, 1);
                                            curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

                                            $headers = array();
                                            $headers[] = 'Sec-Fetch-Mode: cors';
                                            $headers[] = 'Origin: https://betkanyon.admindigi.com';
                                            $headers[] = 'Accept-Language: en';
                                            $headers[] = 'Authorization: Bearer '.file_get_contents('https://software2.betkanyon100.com/token_al_ba.php');
                                            $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
                                            $headers[] = 'Referer: https://betkanyon.admindigi.com/';
                                            $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36';
                                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                                            $result = json_decode(curl_exec($ch),true);
                                            if ($result['ResponseObject']['Bets']['Count'] == 0 and isset($result['ResponseObject']['Bets']['Count'])) { 
                                                $method = $db->prepare('SELECT * FROM yontemler WHERE name = ? LIMIT 1');
                                                $method->execute(array($partner['PaymentSystemName']));
                                                if ($method->rowCount() != 0) {
                                                    $method = $method->fetch(PDO::FETCH_ASSOC);
                                                   
                                                    $bonus = $db->prepare('SELECT * FROM bonuses WHERE bonus_cevrim = '.$type.' and aktif = 1 and FIND_IN_SET('.$bonus_type.',category) and FIND_IN_SET('.$method['id'].',method_id)');
                                                    $bonus->execute(array());
                                                    
                                                    if ($bonus->rowCount() != 0) {
                                                        $bonus = $bonus->fetch(PDO::FETCH_ASSOC);
                                                        
                                                        if ($bonus['yeni'] == 1) {
                                                            
                                                            
                                                          
                                                            if ($categoryId == 209 && $_GET['type'] == 1 && $_GET['bonus'] == 2) {
                                                                $bonus['yuzde'] = 20;
                                                                $bonus['new_bonus_id'] = 21824;
                                                                $bonus['bonus_name'] = "%20 Çevrimsiz Spor - Yatırım Bonusu";
                                                            }

                                                            
                                                            $gunluk_limit = $gunluk_limit_define;
                                                            $bonus_amount = yuzde($partner['Amount'],$bonus['yuzde']);
                                                            if ($type != 4) {
                                                                if (intval($gunluk_check['total'])+intval($bonus_amount) > $gunluk_limit_define) {
                                                                    $bonus_amount = ceil($gunluk_limit_define - $gunluk_check['total']);
                                                                }
                                                            } else {
                                                                if ($bonus_amount > 1500) {
                                                                    $bonus_amount = 1500;
                                                                }
                                                            }
                                                       
                                                            
                                                            if (CreateBonus($bonus['new_bonus_id'],$player_id,$bonus_amount) == 1) {
                                                                $insert = $db->prepare('INSERT INTO verified_bonus (deposit_id,bonus_id,provider_bonus_id,player_id,created_date,inner_bonus,bonus_type,bonus_method,bonus_amount,bonus_place,amount,active) values (?,?,?,?,?,?,?,?,?,?,?,?)');
                                                                $insert->execute(array($partner['Id'],0,$bonus['new_bonus_id'],$player_id,date('Y-m-d H:i:s'),$bonus['id'],$type,$method['id'],$bonus_amount,$bonus_type,$partner['Amount'],1));
                                                                $json = array(
                                                                    'status' => 'success',
                                                                    'message' => 'Bonus başarıyla tanımlanmıştır. Bol şanslar dileriz.'
                                                                );
                                                            } else {
                                                                $json = array(
                                                                    'status' => 'error',
                                                                    'message' => 'Bonus tanımlanırken bir sorun oluştu, lütfen tekrar ediniz.'
                                                                );
                                                            }
                                                        } else if ($bonus['whereis'] == 1) {

                                                            $gunluk_limit = $gunluk_limit_define;
                                                            $bonus_amount = yuzde($partner['Amount'],$bonus['yuzde']);
                                                            
                                                            if ($type != 4) {
                                                                if (intval($gunluk_check['total'])+intval($bonus_amount) > $gunluk_limit_define) {
                                                                    $bonus_amount = ceil($gunluk_limit_define - $gunluk_check['total']);
                                                                }
                                                            } else {
                                                                if ($bonus_amount > 1500) {
                                                                    $bonus_amount = 1500;
                                                                }
                                                            }
                                                            
                                                            $turn_over = $bonus_amount * $bonus['cevrim_sayi'];
                                                            $bonus_name = $bonus['name_prefix'].' - '.' ( '.$bonus_amount.' TRY )';
                                                            $bonus_name2 = urlencode($bonus_name);
                                                            
                                                            
                                                            $bonus_query = $db->prepare('SELECT * FROM created_bonus WHERE name = ? LIMIT 1');
                                                            $bonus_query->execute(array($bonus_name));
                                                            if ($bonus_query->rowCount() == 1) {
                                                                $bonus_query = $bonus_query->fetch(PDO::FETCH_ASSOC);

                                                                $ch = curl_init();
                                                                curl_setopt($ch, CURLOPT_URL, 'https://adminwebsd.apidigi.com/api/Main/ApiRequest?TimeZone=3&LanguageId=en');
                                                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                                                curl_setopt($ch, CURLOPT_POSTFIELDS, 'Method=AddSportBonusToClient&Controller=Bonus&TimeZone=3&RequestObject={"BonusId":'.$bonus_query['bonus_id'].',"PartnerId":1026,"StartDate":"'.minusHour(date('Y-m-d H:i:s'),3).'","PlayerIds":['.$_GET['id'].']}');
                                                                curl_setopt($ch, CURLOPT_POST, 1);
                                                                curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

                                                                $headers = array();
                                                                $headers[] = 'Sec-Fetch-Mode: cors';
                                                                $headers[] = 'Origin: https://betkanyon.admindigi.com';
                                                                $headers[] = 'Accept-Language: en';
                                                                $headers[] = 'Authorization: Bearer '.file_get_contents('https://software2.betkanyon100.com/token_al_ba.php');
                                                                $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
                                                                $headers[] = 'Referer: https://betkanyon.admindigi.com/';
                                                                $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36';
                                                                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                                                                $result = json_decode(curl_exec($ch),true);
                                                                
                                                                $replay = 1;
                                                                do {
                                                                    $ch = curl_init();
                                                                    curl_setopt($ch, CURLOPT_URL, 'https://adminwebsd.apidigi.com/api/Main/ApiRequest?TimeZone=3&LanguageId=en');
                                                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                                                    curl_setopt($ch, CURLOPT_POSTFIELDS, 'Method=GetBonusByClientId&Controller=Bonus&TimeZone=3&RequestObject='.$_GET['id']);
                                                                    curl_setopt($ch, CURLOPT_POST, 1);
                                                                    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

                                                                    $headers = array();
                                                                    $headers[] = 'Sec-Fetch-Mode: cors';
                                                                    $headers[] = 'Origin: https://betkanyon.admindigi.com';
                                                                    $headers[] = 'Accept-Language: en';
                                                                    $headers[] = 'Authorization: Bearer '.file_get_contents('https://software2.betkanyon100.com/token_al_ba.php');
                                                                    $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
                                                                    $headers[] = 'Referer: https://betkanyon.admindigi.com/';
                                                                    $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36';
                                                                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                                                                    $result = json_decode(curl_exec($ch),true);

                                                                    $bonus_olustur = 0;
                                                                    foreach ($result['ResponseObject']['Entities'] as $bonus_control) {
                                                                        if (tum_bosluk_sil($bonus_control['BonusName']) == tum_bosluk_sil($bonus_name)) {
                                                                            $json = array(
                                                                                'status' => 'success',
                                                                                'message' => 'Bonus başarıyla tanımlanmıştır. Bol şanslar dileriz.'
                                                                            );
                                                                            
                                                                             $insert = $db->prepare('INSERT INTO verified_bonus (deposit_id,bonus_id,provider_bonus_id,player_id,created_date,inner_bonus,bonus_type,bonus_method,bonus_amount,bonus_place,amount,active) values (?,?,?,?,?,?,?,?,?,?,?,?)');
                                                                             $insert->execute(array($partner['Id'],$bonus_query['id'],$bonus_query['bonus_id'],$player_id,date('Y-m-d H:i:s'),$bonus['id'],$type,$method['id'],$bonus_amount,$bonus_type,$partner['Amount'],1));
                                                                            $replay = 0;
                                                                        } else {
                                                                            $replay = 1;
                                                                        }
                                                                        break;
                                                                    }
                                                                } while ($replay > 0);
                                                            } else {
                                                                $ch = curl_init();
                                                                curl_setopt($ch, CURLOPT_URL, 'https://adminwebsd.apidigi.com/api/Main/ApiRequest?TimeZone=3&LanguageId=en');
                                                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                                                curl_setopt($ch, CURLOPT_POSTFIELDS, 'Method=CreateSportBonus&Controller=Bonus&TimeZone=3&RequestObject={"PartnerId":1026,"CurrencyId":"TRY","name":"'.$bonus_name2.'","period":'.$bonus['period_days'].',"BonusType":3,"Amount":'.$bonus_amount.',"WageringTurnover":'.$turn_over.',"MaxCashOut":null,"NonWageringWallet":1,"ExpressOdd":'.$bonus['express_odd'].',"MinWageringOdd":'.$bonus['wagering_odd'].',"SportAllowedBetTypeId":1}');
                                                                curl_setopt($ch, CURLOPT_POST, 1);
                                                                curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

                                                                $headers = array();
                                                                $headers[] = 'Sec-Fetch-Mode: cors';
                                                                $headers[] = 'Origin: https://betkanyon.admindigi.com';
                                                                $headers[] = 'Accept-Language: en';
                                                                $headers[] = 'Authorization: Bearer '.file_get_contents('https://software2.betkanyon100.com/token_al_ba.php');
                                                                $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
                                                                $headers[] = 'Referer: https://betkanyon.admindigi.com/';
                                                                $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36';
                                                                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                                                                $result = json_decode(curl_exec($ch),true);
                                                                
                                                                if ($result['ResponseCode'] == 0) { 

                                                                    $ch = curl_init();
                                                                    curl_setopt($ch, CURLOPT_URL, 'https://adminwebsd.apidigi.com/api/Main/ApiRequest?TimeZone=3&LanguageId=en');
                                                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                                                     curl_setopt($ch, CURLOPT_POSTFIELDS, 'Method=GetSportBonusesPaging&Controller=Bonus&TimeZone=3&&RequestObject={"SkipCount":0,"TakeCount":100,"OrderBy":null,"FieldNameToOrderBy":"","PartnerId":null,"Status":null,"BonusType":null,"StartDate":"'.date('Y-m-d',strtotime(date('Y-m-d').'-2 days')).'T21:00:00.000Z","EndDate":"'.date('Y-m-d',strtotime(date('Y-m-d').'+1 days')).'T21:00:00.000Z","TimeZone":3,"BonusIds":[],"Names":[],"BonusTypes":[],"Currencies":[],"TurnoverFactors":[],"Periods":[],"MaxTransverAmount":[],"Statuses":[],"StartTimes":[],"FinishTimes":[]}');
                                                                    curl_setopt($ch, CURLOPT_POST, 1);
                                                                    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
                                                                    $headers = array();
                                                                    $headers[] = 'Sec-Fetch-Mode: cors';
                                                                    $headers[] = 'Origin: https://betkanyon.admindigi.com';
                                                                    $headers[] = 'Accept-Language: en';
                                                                    $headers[] = 'Authorization: Bearer '.file_get_contents('https://software2.betkanyon100.com/token_al_ba.php');
                                                                    $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
                                                                    $headers[] = 'Referer: https://betkanyon.admindigi.com/';
                                                                    $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36';
                                                                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                                                                    $result = json_decode(curl_exec($ch),true);
                                                                    
                                                                    $bonus_id = 0;
                                                                    foreach ($result['ResponseObject']['Entities'] as $bonus_for) {
                                                                        if (tum_bosluk_sil($bonus_for['Name']) == tum_bosluk_sil($bonus_name)) {
                                                                            $bonus_id = $bonus_for['Id'];
                                                                        } 
                                                                    }

                                                                    if ($bonus_id != 0) {
                                                                        $insert = $db->prepare('INSERT INTO created_bonus (bonus_id,amount,where_is,created_date,name) values (?,?,?,?,?)');
                                                                        $insert->execute(array($bonus_id,$bonus_amount,$bonus['whereis'],date('Y-m-d H:i:s'),$bonus_name));
                                                                        
                                                                        $lastbonusid = $db->lastInsertId();
                                                                        
                                                                        $ch = curl_init();
                                                                        curl_setopt($ch, CURLOPT_URL, 'https://adminwebsd.apidigi.com/api/Main/ApiRequest?TimeZone=3&LanguageId=en');
                                                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                                                        curl_setopt($ch, CURLOPT_POSTFIELDS, 'Method=AddSportBonusToClient&Controller=Bonus&TimeZone=3&RequestObject={"BonusId":'.$bonus_id.',"PartnerId":1026,"StartDate":"'.minusHour(date('Y-m-d H:i:s'),3).'","PlayerIds":['.$_GET['id'].']}');
                                                                        curl_setopt($ch, CURLOPT_POST, 1);
                                                                        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

                                                                        $headers = array();
                                                                        $headers[] = 'Sec-Fetch-Mode: cors';
                                                                        $headers[] = 'Origin: https://betkanyon.admindigi.com';
                                                                        $headers[] = 'Accept-Language: en';
                                                                        $headers[] = 'Authorization: Bearer '.file_get_contents('https://software2.betkanyon100.com/token_al_ba.php');
                                                                        $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
                                                                        $headers[] = 'Referer: https://betkanyon.admindigi.com/';
                                                                        $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36';
                                                                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                                                                        $result = json_decode(curl_exec($ch),true);

                                                                        $replay = 1;
                                                                        do {
                                                                            $ch = curl_init();
                                                                            curl_setopt($ch, CURLOPT_URL, 'https://adminwebsd.apidigi.com/api/Main/ApiRequest?TimeZone=3&LanguageId=en');
                                                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                                                            curl_setopt($ch, CURLOPT_POSTFIELDS, 'Method=GetBonusByClientId&Controller=Bonus&TimeZone=3&RequestObject='.$_GET['id']);
                                                                            curl_setopt($ch, CURLOPT_POST, 1);
                                                                            curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

                                                                            $headers = array();
                                                                            $headers[] = 'Sec-Fetch-Mode: cors';
                                                                            $headers[] = 'Origin: https://betkanyon.admindigi.com';
                                                                            $headers[] = 'Accept-Language: en';
                                                                            $headers[] = 'Authorization: Bearer '.file_get_contents('https://software2.betkanyon100.com/token_al_ba.php');
                                                                            $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
                                                                            $headers[] = 'Referer: https://betkanyon.admindigi.com/';
                                                                            $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36';
                                                                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                                                                            $result = json_decode(curl_exec($ch),true);

                                                                            $bonus_olustur = 0;
                                                                            foreach ($result['ResponseObject']['Entities'] as $bonus_control) {
                                                                                if (tum_bosluk_sil($bonus_control['BonusName']) == tum_bosluk_sil($bonus_name)) {
                                                                                    $json = array(
                                                                                        'status' => 'success',
                                                                                        'message' => 'Bonus başarıyla tanımlanmıştır. Bol şanslar dileriz.'
                                                                                    );
                                                                                    $replay = 0;
                                                                                    
                                                                                    $insert = $db->prepare('INSERT INTO verified_bonus (deposit_id,bonus_id,provider_bonus_id,player_id,created_date,inner_bonus,bonus_type,bonus_method,bonus_amount,bonus_place,amount,active) values (?,?,?,?,?,?,?,?,?,?,?,?)');
                                                                                    $insert->execute(array($partner['Id'],$lastbonusid,$bonus_id,$player_id,date('Y-m-d H:i:s'),$bonus['id'],$type,$method['id'],$bonus_amount,$bonus_type,$partner['Amount'],1));
                                                                                    
                                                                                } else {
                                                                                    $replay = 1;
                                                                                }
                                                                                break;
                                                                            }
                                                                        } while ($replay > 0);
                                                                    } else {
                                                                        $json = array(
                                                                            'status' => 'error',
                                                                            'message' => 'Bonus oluşturulurken bir sorun oluştu, lütfen tekrar ediniz. a'
                                                                        );
                                                                    }

                                                                } else {
                                                                    $json = array(
                                                                        'status' => 'error',
                                                                        'message' => 'Bonus oluşturulurken bir sorun oluştu, lütfen tekrar ediniz. b'
                                                                    );
                                                                } 
                                                            }
                                                        } else if ($bonus['whereis'] == 2) {
                                                            $bonus_amount = yuzde($partner['Amount'],$bonus['yuzde']);
                                                            $turn_over = $bonus_amount * $bonus['cevrim_sayi'];
                                                            $gunluk_limit = $gunluk_limit_define;
                                                            
                                                            if ($type != 4) {
                                                                if (intval($gunluk_check['total'])+intval($bonus_amount) > $gunluk_limit_define) {
                                                                    $bonus_amount = $gunluk_limit - $gunluk_check['total'];
                                                                }
                                                            } else {
                                                                if ($bonus_amount > 1500) {
                                                                    $bonus_amount = 1500;
                                                                }
                                                            }
                                                            
                                                            $ek = '';
                                                            
                                                            if ($bonus_type == 1) {
                                                                $ek = 'Spor ';
                                                            }
                                                            
                                                            if ($bonus_type == 2) {
                                                                $ek = 'Casino ';
                                                            }
                                                            
                                                            $bonus_name = $ek.$bonus['name_prefix'].' - '.' ( '.$bonus_amount.' TRY )';
                                                            $bonus_name2 = urlencode($bonus_name);
                                                            
                                                            
                                                            $replay = 1;
                                                            do {
                                                                $ch = curl_init();
                                                                curl_setopt($ch, CURLOPT_URL, 'https://adminwebsd.apidigi.com/api/Main/ApiRequest?TimeZone=3&LanguageId=en');
                                                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                                                curl_setopt($ch, CURLOPT_POSTFIELDS, 'Method=CreateDebitBonusCorrection&Controller=Client&TimeZone=3&RequestObject={"ClientId":"'.$_GET['id'].'","CurrencyId":"TRY","info":"'.$bonus_name2.'","amount":'.$bonus_amount.',"AccountTypeId":2,"operationType":0}');
                                                                curl_setopt($ch, CURLOPT_POST, 1);
                                                                curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

                                                                $headers = array();
                                                                $headers[] = 'Sec-Fetch-Mode: cors';
                                                                $headers[] = 'Origin: https://betkanyon.admindigi.com';
                                                                $headers[] = 'Accept-Language: en';
                                                                $headers[] = 'Authorization: Bearer '.file_get_contents('https://software2.betkanyon100.com/token_al_ba.php');
                                                                $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
                                                                $headers[] = 'Referer: https://betkanyon.admindigi.com/';
                                                                $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36';
                                                                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                                                                $result = json_decode(curl_exec($ch),true);

                                                                if (isset($result['ResponseObject']['Id'])) {
                                                                    $json = array(
                                                                        'status' => 'success',
                                                                        'message' => 'Bonus başarıyla tanımlanmıştır. Bol şanslar dileriz.'
                                                                    );
                                                                    $replay = 0;
                                                                    $insert = $db->prepare('INSERT INTO verified_bonus (deposit_id,bonus_id,provider_bonus_id,player_id,created_date,inner_bonus,bonus_type,bonus_method,bonus_amount,bonus_place,amount,active) values (?,?,?,?,?,?,?,?,?,?,?,?)');
                                                                    $insert->execute(array($partner['Id'],0,$result['ResponseObject']['Id'],$player_id,date('Y-m-d H:i:s'),$bonus['id'],$type,$method['id'],$bonus_amount,$bonus_type,$partner['Amount'],1));
                                                                    
                                                                } else {
                                                                    $replay = 1;
                                                                }
                                                            } while ($replay > 0);
                                                        }
                                                    } else {
                                                        $json = array(
                                                            'status' => 'error',
                                                            'message' => 'Para yatırma yönteminize ait bonus bulunamadı!'
                                                        );
                                                    }
                                                } else {
                                                    $json = array(
                                                        'status' => 'error',
                                                        'message' => 'Para yatırma yöntemi bulunamadı!'
                                                    );
                                                }
                                            } else {
                                                $json = array(
                                                    'status' => 'error',
                                                    'message' => 'Yatırımınızdan sonra bahis aldığınızdan ötürü çevrimsiz bonus hakkıınız bulunmamaktadır. Kayıp bonusu talebinde bulunabilirsiniz.'
                                                );
                                            }
                                    } else {
                                        $json = array(
                                            'status' => 'error',
                                            'message' => 'Yatırımınızdan önceki 24 saat içerisinde çekiminiz olması sebebi ile size yatırım bonusu tanımlaması yapılamamaktadır fakat kaybınız olması halinde dilerseniz kayıp bonusu talebinde bulunabilirsiniz.'
                                        );
                                    }

                                } else {
                                    $json = array(
                                        'status' => 'error',
                                        'message' => 'Bir sorun oluştu, lütfen tekrar talep oluşturunuz.'
                                    );
                                }
                            }
                        }
                    }
                    else {
                         $json = array(
                            'status' => 'error',
                            'message' => 'Bonus alabilmek için minimum yatırım miktarı 100 TRY\'dir'
                         );
                     }
                
                break;
            } 
        } else {
            $json = array(
                'status' => 'error',
                'message' => 'Son 48 saat içinde yatırımınız bulunmamaktadır.'
            );
        }
    }
    
    kontrolsil($player_id);
    echo json_encode($json);



?>