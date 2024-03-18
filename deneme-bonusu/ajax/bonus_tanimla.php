<?php
    session_start();
    header('Content-Type: application/json');
    error_reporting(0);
    $control = json_decode(file_get_contents('https://bonus-api.betkanyon100.com/deneme-bonusu/api/check.php?id='.$_GET['id']),true);
    if ($control['status'] == 'success') {
        $user = json_decode(file_get_contents('https://user.cloudsystemapi.com/query_id.php?id='.addslashes(strip_tags($_GET['id']))),true);
        $user_phone = $user['number'];
        $user_id = addslashes(strip_tags($_GET['id']));
        $user_name = $user['username'];  
        
        if (substr($user_phone,0,2) == '90') {
            $user_phone = substr($user_phone,2,strlen($user_phone)-2);
        }

        if (substr($user_phone,0,3) == '+90') {
            $user_phone = substr($user_phone,3,strlen($user_phone)-2);
        }

        if (substr($user_phone,0,4) == '0090') {
            $user_phone = substr($user_phone,4,strlen($user_phone)-4);
        }
        
        $_SESSION['userPhone'] = $user_phone;
        $_SESSION['bonusCheckedID'] = $_GET['id'];
        $_SESSION['bonusCheckedNumber'] = $user_phone;
        $_SESSION['bonusCheckedUserName'] = $user_name;
    } else {
        die();
    }
 
    include '../api/db.php';

    function deneme_bonusu($bonus_type,$number,$buser) {
        global $db;
        
        $multi_control = json_decode(file_get_contents('https://user.cloudsystemapi.com/multi_control.php?username='.$buser.'&phone='.$number),true);
        if (isset($multi_control['count'])) {
            if ($multi_control['count'] == 0) {
                $type = 'kullanici';
                $token['access_token'] = file_get_contents('http://software2.betkanyon100.com/token.php');

                if (isset($token['access_token'])) {

                    $json_send = '{"SkipCount":0,"TakeCount":20,"OrderBy":null,"FieldNameToOrderBy":"","PartnerId":null,"Ids":[],"Emails":[],"UserNames":[{"OperationTypeId":7,"StringValue":"'.$buser.'"}],"FirstNames":[],"LastNames":[],"MobileNumbers":[],"PhoneNumbers":[],"CurrencyIds":[],"DocumentNumbers":[],"RegistrationIps":[],"SportClinetIds":[],"ShebaNumbers":[],"FromList":false}';

                    $token = $token['access_token'];
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, 'https://adminwebsd.apidigi.com/api/Main/ApiRequest?TimeZone=3&LanguageId=en');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, 'Method=GetClients&Controller=Client&TimeZone=3&RequestObject='.$json_send);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

                    $headers = array();
                    $headers[] = 'Accept: application/json';
                    $headers[] = 'Referer: https://betkanyon.admindigi.com/';
                    $headers[] = 'Origin: https://betkanyon.admindigi.com';
                    $headers[] = 'Authorization: Bearer '.file_get_contents('http://software2.betkanyon100.com/token.php');
                    $headers[] = 'Accept-Language: en';
                    $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36';
                    $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    $result = curl_exec($ch);
                    curl_close ($ch);
                    $json = json_decode($result,true);

                    $bulundu = '';
                    $arttir = 0;

                    foreach ($json['ResponseObject']['Entities'] as $user) {
                        if ($type == 'kullanici' && strtolower($user['UserName']) == strtolower($buser)) {
                            $bulundu = $arttir;
                        }
                        $arttir++;
                    }

                    if (is_numeric($bulundu)) {
                        $userId = $json['ResponseObject']['Entities'][$bulundu]['Id'];

                        $json_send = '{"SkipCount":0,"TakeCount":1,"OrderBy":null,"FieldNameToOrderBy":"","PartnerId":null,"CreatedFrom":null,"CreatedBefore":null,"Ids":[{"OperationTypeId":1,"IntValue":'.$userId.'}],"Emails":[],"UserNames":[],"Currencies":[],"LanguageIds":[],"Genders":[],"FirstNames":[],"LastNames":[],"DocumentNumbers":[],"DocumentIssuedBys":[],"MobileNumbers":[],"ZipCodes":[],"IsDocumentVerifieds":[],"PhoneNumbers":[],"RegionIds":[],"Categories":[],"BirthDates":[],"States":[],"CreationTimes":[],"Balances":[],"GGRs":[],"NETGamings":[],"IsEmailVerifieds":[],"IsMobileNumberVerifieds":[],"ReferralIds":[],"LineIds":[],"RegistrationIps":[],"FromList":false}';


                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, 'https://adminwebsd.apidigi.com/api/Main/ApiRequest?TimeZone=3&LanguageId=en');
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, 'Method=GetClients&Controller=Client&TimeZone=3&RequestObject='.$json_send);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
                        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

                        $headers = array();
                        $headers[] = 'Accept: application/json';
                        $headers[] = 'Referer: https://betkanyon.admindigi.com/';
                        $headers[] = 'Origin: https://betkanyon.admindigi.com';
                        $headers[] = 'Authorization: Bearer '.file_get_contents('http://software2.betkanyon100.com/token.php');
                        $headers[] = 'Accept-Language: en';
                        $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36';
                        $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                        $result = curl_exec($ch);
                        curl_close ($ch);
                        $json = json_decode($result,true);

                        if (substr($json['ResponseObject']['Entities'][0]['MobileNumber'],0,4) == '+900') {
                            $digi_number = str_replace('+900','90',$json['ResponseObject']['Entities'][0]['MobileNumber']);
                        } else {
                            $digi_number = str_replace('+90','90',$json['ResponseObject']['Entities'][0]['MobileNumber']);
                        }

                        if (isset($json['ResponseObject']['Entities'][0]['MobileNumber'])) {
                            $query = $db->prepare('SELECT * FROM deneme_bonusu WHERE phone LIKE "%'.$number.'%" LIMIT 1');
                            $query->execute(array());
                            if ($query->rowCount() == 0 or $buser == 'test10') {
                                // $site_phone = substr($json['ResponseObject']['Entities'][0]['MobileNumber'],strlen($json['ResponseObject']['Entities'][0]['MobileNumber'])-10,100);
                                if (substr($json['ResponseObject']['Entities'][0]['MobileNumber'],0,3) == '+90' or $buser == 'test10') {
                                    $para_birimi = $json['ResponseObject']['Entities'][0]['CurrencyId'];
                                    if ($para_birimi == 'TRY') {

                                        $file = file_get_contents('https://user.cloudsystemapi.com/query.php?username='.$buser);
                                        $dechode = json_decode($file,true);
                                        if (substr($dechode['number'],0,4) == '+900') {
                                            $bypass_digi_number = str_replace('+900','90',$dechode['number']);
                                        } else {
                                            $bypass_digi_number = str_replace('+90','90',$dechode['number']);
                                        }
                                       
                                        
                                        if (substr($bypass_digi_number,0,2) == '90') {
                                            $bypass_digi_number = substr($bypass_digi_number,2,strlen($bypass_digi_number)-2);
                                        }

                                        if (substr($bypass_digi_number,0,3) == '+90') {
                                            $bypass_digi_number = substr($bypass_digi_number,3,strlen($bypass_digi_number)-2);
                                        }

                                        if (substr($bypass_digi_number,0,4) == '0090') {
                                            $bypass_digi_number = substr($bypass_digi_number,4,strlen($bypass_digi_number)-4);
                                        }
                                        
                                        if ($bypass_digi_number == $number or $buser == 'test10') {
  

                                            $ch = curl_init();
                                            curl_setopt($ch, CURLOPT_URL, 'https://adminwebsd.apidigi.com/api/Main/ApiRequest?TimeZone=3&LanguageId=en');
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                            curl_setopt($ch, CURLOPT_POSTFIELDS, 'Method=GetClientInfo&Controller=Client&TimeZone=3&RequestObject='.$userId);
                                            curl_setopt($ch, CURLOPT_POST, 1);
                                            curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
                                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                                            $headers = array();
                                            $headers[] = 'Accept: application/json';
                                            $headers[] = 'Referer: https://betkanyon.admindigi.com/';
                                            $headers[] = 'Origin: https://betkanyon.admindigi.com';
                                            $headers[] = 'Authorization: Bearer '.file_get_contents('http://software2.betkanyon100.com/token.php');
                                            $headers[] = 'Accept-Language: en';
                                            $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36';
                                            $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
                                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                                            $result = curl_exec($ch);

                                            $user_json = json_decode($result,true);

                                            $casino_bonusu = 0;
                                            $spor_bonusu = 0;

                                            $ch = curl_init();
                                            curl_setopt($ch, CURLOPT_URL, 'https://adminwebsd.apidigi.com/api/Main/ApiRequest?TimeZone=3&LanguageId=en');
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                            curl_setopt($ch, CURLOPT_POSTFIELDS, 'Method=GetBonusByClientId&Controller=Bonus&TimeZone=3&RequestObject='.$userId);
                                            curl_setopt($ch, CURLOPT_POST, 1);
                                            curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
                                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

                                            $headers = array();
                                            $headers[] = 'Accept: application/json';
                                            $headers[] = 'Referer: https://betkanyon.admindigi.com/';
                                            $headers[] = 'Origin: https://betkanyon.admindigi.com';
                                            $headers[] = 'Authorization: Bearer '.file_get_contents('http://software2.betkanyon100.com/token.php');
                                            $headers[] = 'Accept-Language: en';
                                            $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36';
                                            $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
                                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                                            $result = curl_exec($ch);

                                            $spor_decode = json_decode($result,true);
                                            if ($spor_decode['ResponseObject']['Count'] > 0) {
                                                $spor_bonusu = 1;
                                            } 

                                            $ch = curl_init();
                                            curl_setopt($ch, CURLOPT_URL, 'https://adminwebsd.apidigi.com/api/Main/ApiRequest?TimeZone=3&LanguageId=en');
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                            curl_setopt($ch, CURLOPT_POSTFIELDS, 'Method=GetClientCorrections&Controller=Client&TimeZone=3&RequestObject={"SkipCount":0,"TakeCount":1,"OrderBy":"","FieldNameToOrderBy":"","FromDate":"2019-11-11T21:00:00.000Z","ToDate":"'.date('Y-m-d H:i:s',strtotime('+1 days')).'","ClientId":'.$userId.'}');
                                            curl_setopt($ch, CURLOPT_POST, 1);
                                            curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
                                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                                            $headers = array();
                                            $headers[] = 'Accept: application/json';
                                            $headers[] = 'Referer: https://betkanyon.admindigi.com/';
                                            $headers[] = 'Origin: https://betkanyon.admindigi.com';
                                            $headers[] = 'Authorization: Bearer '.file_get_contents('http://software2.betkanyon100.com/token.php');
                                            $headers[] = 'Accept-Language: en';
                                            $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36';
                                            $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
                                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                                            $result = curl_exec($ch);

                                            $casino_decode = json_decode($result,true);
                                            if ($casino_decode['ResponseObject']['Count'] > 0) {
                                                $casino_bonusu = 1;
                                            } 

                                            if ($spor_bonusu == 0 && $casino_bonusu == 0 && $user_json['ResponseObject']['TotalDepositsCount'] == 0 && $user_json['ResponseObject']['GGR'] == 0 && $user_json['ResponseObject']['TotalBetsAmount'] == 0  && $user_json['ResponseObject']['Balance'] == 0 or $buser == 'test10') {

                                                $query = $db->prepare('SELECT * FROM deneme_bonusu WHERE phone = ? LIMIT 1');
                                                $query->execute(array($number));
                                                if ($query->rowCount() == 0 or $buser == 'test10') {

                                                    $insert = $db->prepare('INSERT INTO deneme_bonusu (user,phone,date,bonus) values (?,?,?,?)');
                                                    $insert->execute(array($buser,$number,date('Y-m-d H:i:s'),$bonus_type));

                                                    if (strtolower($bonus_type) == 'spor') {
                                                        $spor = $db->prepare('SELECT * FROM command WHERE text = ? limit 1');
                                                        $spor->execute(array('50tl-cevap'));
                                                        $spor = $spor->fetch(PDO::FETCH_ASSOC);

                                                        $ch = curl_init();
                                                        curl_setopt($ch, CURLOPT_URL, 'https://adminwebsd.apidigi.com/api/Main/ApiRequest?TimeZone=3&LanguageId=en');
                                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                                        curl_setopt($ch, CURLOPT_POSTFIELDS, 'Method=AddSportBonusToClient&Controller=Bonus&TimeZone=3&RequestObject={"BonusId":16429,"PartnerId":1026,"StartDate":"'.date('Y-m-d').' 00:00:00","PlayerIds":['.$userId.']}');
                                                        curl_setopt($ch, CURLOPT_POST, 1);
                                                        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
                                                        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                                                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                                                        
                                                        /*

                                                        curl_setopt($ch, CURLOPT_PROXY, 'tr17.nordvpn.com');
                                                        curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5); 
                                                        curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'winxbettr@gmail.com:Bet123456'); 
                                                        curl_setopt($ch, CURLOPT_PROXYAUTH, CURLAUTH_BASIC);
*/

                                                        $headers = array();
                                                        $headers[] = 'Accept: application/json';
                                                        $headers[] = 'Referer: https://betkanyon.admindigi.com/';
                                                        $headers[] = 'Origin: https://betkanyon.admindigi.com';
                                                        $headers[] = 'Authorization: Bearer '.file_get_contents('http://software2.betkanyon100.com/token.php');
                                                        $headers[] = 'Accept-Language: en';
                                                        $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36';
                                                        $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
                                                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                                                        $result = curl_exec($ch);


                                                        $decode = json_decode($result,true);

                                                        if ($decode['ResponseCode'] != 0) {
                                                                $ch = curl_init();
                                                                curl_setopt($ch, CURLOPT_URL, 'https://adminwebsd.apidigi.com/api/Main/ApiRequest?TimeZone=3&LanguageId=en');
                                                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                                                curl_setopt($ch, CURLOPT_POSTFIELDS, 'Method=AddSportBonusToClient&Controller=Bonus&TimeZone=3&RequestObject={"BonusId":16429,"PartnerId":1026,"StartDate":"'.date('Y-m-d').' 00:00:00","PlayerIds":['.$userId.']}');
                                                                curl_setopt($ch, CURLOPT_POST, 1);
                                                                curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
                                                                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                                                                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

                                                            /*
                                                                curl_setopt($ch, CURLOPT_PROXY, 'tr17.nordvpn.com');
                                                                curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5); 
                                                                curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'winxbettr@gmail.com:Bet123456'); 
                                                                curl_setopt($ch, CURLOPT_PROXYAUTH, CURLAUTH_BASIC);
                                                                */


                                                                $headers = array();
                                                                $headers[] = 'Accept: application/json';
                                                                $headers[] = 'Referer: https://betkanyon.admindigi.com/';
                                                                $headers[] = 'Origin: https://betkanyon.admindigi.com';
                                                                $headers[] = 'Authorization: Bearer '.file_get_contents('http://software2.betkanyon100.com/token.php');
                                                                $headers[] = 'Accept-Language: en';
                                                                $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36';
                                                                $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
                                                                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                                                                $result = curl_exec($ch);
                                                        }

                                                         $jsonEx = array(
                                                            'status' => 'success',
                                                            'message' => "Bonusunuz tanımlanmıştır."
                                                        );
                                                    }

                                                    if (mb_strtolower($bonus_type,'UTF-8') == 'casino') {
                                                        $spor = $db->prepare('SELECT * FROM command WHERE text = ? limit 1');
                                                        $spor->execute(array('30tl-cevap'));
                                                        $spor = $spor->fetch(PDO::FETCH_ASSOC);

                                                        $ch = curl_init();
                                                        curl_setopt($ch, CURLOPT_URL, 'https://adminwebsd.apidigi.com/api/Main/ApiRequest?TimeZone=3&LanguageId=en');
                                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                                        curl_setopt($ch, CURLOPT_POSTFIELDS, 'Method=CreateDebitBonusCorrection&Controller=Client&TimeZone=3&RequestObject={"ClientId":"'.$userId.'","Info":"40 Casino (Otomatik) 2020 Korona Özel","Amount":40,"AccountTypeId":2,"OperationType":0,"CurrencyId":"TRY"}');
                                                        curl_setopt($ch, CURLOPT_POST, 1);
                                                        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
                                                        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                                                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

                                                        /*
                                                        curl_setopt($ch, CURLOPT_PROXY, 'tr17.nordvpn.com');
                                                        curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5); 
                                                        curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'winxbettr@gmail.com:Bet123456'); 
                                                        curl_setopt($ch, CURLOPT_PROXYAUTH, CURLAUTH_BASIC);
                                                        */

                                                        $headers = array();
                                                        $headers[] = 'Accept: application/json';
                                                        $headers[] = 'Referer: https://betkanyon.admindigi.com/';
                                                        $headers[] = 'Origin: https://betkanyon.admindigi.com';
                                                        $headers[] = 'Authorization: Bearer '.file_get_contents('http://software2.betkanyon100.com/token.php');
                                                        $headers[] = 'Accept-Language: en';
                                                        $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36';
                                                        $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
                                                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                                                        $result = curl_exec($ch);
                                                        $jsonEx = array(
                                                            'status' => "success",
                                                            'message' => "Bonusunuz tanımlanmıştır."
                                                        );
                                                    }
                                                } else {
                                                     $jsonEx = array(
                                                        'status' => 'error',
                                                        'message' => 'Daha önce deneme bonusundan yararlanmışsınız!'
                                                    );
                                                }
                                            } else {
                                                $jsonEx = array(
                                                    'status' => 'error',
                                                    'message' => 'Bonus alma hakkınız bulunmamaktadır.'
                                                );
                                            }
                                        } else {

                                            $jsonEx = array(
                                                'status' => 'error',
                                                'message' => 'Sistemsel bir hata oluştu (124)'
                                            );
                                        }
                                    } else {
                                        $jsonEx = array(
                                            'status' => 'error',
                                            'message' => 'Hesabınızın para birimi TRY olmadığı için bonus alamamaktasınız.'
                                        );
                                    }
                                } else {
                                    $jsonEx = array(
                                        'status' => 'error',
                                        'message' => 'Sadece Türkiye\'ye ait numara ile bonus alabilirsiniz.'
                                    );
                                }
                            } else {
                                $jsonEx = array(
                                    'status' => 'error',
                                    'message' => 'Daha önce deneme bonusundan yararlanmışsınız.'
                                );
                            }
                        } else {
                            $jsonEx = array(
                                'status' => 'error',
                                'message' => 'Sistemsel bir hata oluştu, lütfen aynı işlemi tekrarlayınız.'
                            );
                        }
                    } else {
                        $jsonEx = array(
                            'status' => 'error',
                            'message' => 'Sistemsel bir hata oluştu'
                        );
                    }

                } else {
                    $jsonEx = array(
                        'status' => 'error',
                        'message' => 'Sistemsel bir hata oluştu lütfen daha sonra tekrar deneyiniz. 1'
                    );
                }
            } else {
                $jsonEx = array(
                    'status' => 'error',
                    'message' => 'Bu numara ile daha önce bonus alındığı için, tekrar bonus talebinde bulunamamaktasınız.'.$get
                );
            }
        } else {
            $jsonEx = array(
                'status' => 'error',
                'message' => 'Sistemsel bir hata oluştu, lütfen tekrar deneyiniz. 2'
            );
        }
        return $jsonEx;
    }
    
    echo json_encode(deneme_bonusu($_GET['type'],$_SESSION['bonusCheckedNumber'],$_SESSION['bonusCheckedUserName']));
        
?>

