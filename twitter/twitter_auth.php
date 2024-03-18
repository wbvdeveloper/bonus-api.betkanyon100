<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
    function date_convert($date){
        if ($date == 'son10') {
            $from_date = date('Y-m-d 00:00:00', strtotime('-10 day',strtotime(date('Y-m-d'))));
            $to_date = date('Y-m-d 00:00:00', strtotime('+1 day',strtotime(date('Y-m-d'))));
            return array(
                'from_date' => $from_date,
                'to_date' => $to_date
            );
        }
    }

    function gun_farki($start,$end) {
        $tarih1= new DateTime($start);
        $tarih2= new DateTime($end);
        $interval= $tarih1->diff($tarih2);
        return $interval->format('%a');
    }

    function deneme_bonusu($bonus_type,$number,$buser) {
        global $db;
        
        return array(
                'status' => 'error',
                'message' => 'Deneme bonusu kampanyamız aktif değildir. Diğer bonuslarımıza bakabilirsiniz. https://www.betkanyon164.com/Promotions'
            );
        
        $buser = str_replace('+','_',$buser);
        
        $multi_control = json_decode(file_get_contents('https://user.cloudsystemapi.com/multi_control.php?username='.$buser.'&phone='.$number),true);
        if (isset($multi_control['count'])) {
            if ($multi_control['count'] == 0) {
                $type = 'kullanici';
                $token['access_token'] = file_get_contents('http://software2.betkanyon100.com/token.php');

                if (isset($token['access_token'])) {

                    $json_send = '{"SkipCount":0,"TakeCount":100,"OrderBy":null,"FieldNameToOrderBy":"","PartnerId":null,"Ids":[],"Emails":[],"UserNames":[{"OperationTypeId":7,"StringValue":"'.$buser.'"}],"FirstNames":[],"LastNames":[],"MobileNumbers":[],"PhoneNumbers":[],"CurrencyIds":[],"DocumentNumbers":[],"RegistrationIps":[],"SportClinetIds":[],"ShebaNumbers":[],"FromList":false}';

                    $token = $token['access_token'];
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, 'https://adminwebsd.apidigi.com/api/Main/ApiRequest?TimeZone=3&LanguageId=en');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, 'Method=GetClients&Controller=Client&TimeZone=3&RequestObject='.$json_send);
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
                    curl_close ($ch);
                    $json = json_decode($result,true);

                    $bulundu = '';
                    $arttir = 0;

                    print_r($json['ResponseObject']['Entities']);
                    
                    foreach ($json['ResponseObject']['Entities'] as $user) {
                        if ($type == 'kullanici' && strtolower($user['UserName']) == strtolower($buser)) {
                            $bulundu = $arttir;
                        }
                        $arttir++;
                    }

                    if (is_numeric($bulundu)) {
                        $userId = $json['ResponseObject']['Entities'][$bulundu]['Id'];

                        $json_send = 'Method=GetInternetBetsReportPagingWithoutCC&Controller=Report&TimeZone=3&RequestObject={"SkipCount":0,"TakeCount":100,"OrderBy":null,"FieldNameToOrderBy":"","PartnerId":null,"PartnerIds":[],"BetDateFrom":"'.date('Y-m-d H:i:s',strtotime('-7 days')).'","BetDateBefore":"'.date('Y-m-d H:i:s',strtotime('+3 hours')).'","CheckHasNote":null,"IsSettled":false,"IsOriginalCurrency":false,"Ids":[],"ClientIds":[{"OperationTypeId":1,"IntValue":'.$userId.'}],"Names":[],"UserNames":[],"Categories":[],"ProductIds":[],"ProductNames":[],"ProviderNames":[],"Currencies":[],"RoundIds":[],"DeviceTypes":[],"ClientIps":[],"Countries":[],"States":[{"OperationTypeId":1,"IntValue":1}],"BetTypes":[],"PossibleWins":[],"BetAmounts":[],"WinAmounts":[],"BetDates":[],"CalculationDate":[],"GGRs":[],"Balances":[],"TotalBetsCounts":[],"TotalBetsAmounts":[],"TotalWinsAmounts":[],"MaxBetAmounts":[],"TotalDepositsCounts":[],"TotalDepositsAmounts":[],"TotalWithdrawalsCounts":[],"TotalWithdrawalsAmounts":[],"Odds":[],"GameCategoryNames":[],"CurrencyId":null}';

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
                        
                        if ($json['ResponseObject']['Bets']['TotalBetAmount'] != 0) {
                            $jsonEx = array(
                                'status' => 'success',
                                'message' => 'Twitter 5TL etkinliğinden faydalanmak için sonuçlanmamış kuponunuz olmaması gerekmektedir.'
                            );
                            return $jsonEx;
                        }
                        
                        
                        $json_send = '{"SkipCount":0,"TakeCount":100,"OrderBy":null,"FieldNameToOrderBy":"","PartnerId":null,"CreatedFrom":null,"CreatedBefore":null,"Ids":[{"OperationTypeId":1,"IntValue":'.$userId.'}],"Emails":[],"UserNames":[],"Currencies":[],"LanguageIds":[],"Genders":[],"FirstNames":[],"LastNames":[],"DocumentNumbers":[],"DocumentIssuedBys":[],"MobileNumbers":[],"ZipCodes":[],"IsDocumentVerifieds":[],"PhoneNumbers":[],"RegionIds":[],"Categories":[],"BirthDates":[],"States":[],"CreationTimes":[],"Balances":[],"GGRs":[],"NETGamings":[],"IsEmailVerifieds":[],"IsMobileNumberVerifieds":[],"ReferralIds":[],"LineIds":[],"RegistrationIps":[],"FromList":false}';


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
                            $query = $db->prepare('SELECT * FROM deneme_bonusu WHERE phone = ? LIMIT 1');
                            $query->execute(array($number));
                            if ($query->rowCount() == 0) {
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

                                        if ($digi_number == $number or $bypass_digi_number == $number or $buser == 'test10') {


                                            $ch = curl_init();
                                            curl_setopt($ch, CURLOPT_URL, 'https://adminwebsd.apidigi.com/api/Main/ApiRequest?TimeZone=3&LanguageId=en');
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                            curl_setopt($ch, CURLOPT_POSTFIELDS, 'Method=GetClientInfo&Controller=Client&TimeZone=3&RequestObject='.$userId);
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

                                            $spor_decode = json_decode($result,true);
                                            if ($spor_decode['ResponseObject']['Count'] > 0) {
                                                $spor_bonusu = 1;
                                            } 

                                            $ch = curl_init();
                                            curl_setopt($ch, CURLOPT_URL, 'https://adminwebsd.apidigi.com/api/Main/ApiRequest?TimeZone=3&LanguageId=en');
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                            curl_setopt($ch, CURLOPT_POSTFIELDS, 'Method=GetClientCorrections&Controller=Client&TimeZone=3&RequestObject={"SkipCount":0,"TakeCount":100,"OrderBy":"","FieldNameToOrderBy":"","FromDate":"2018-04-11T21:00:00.000Z","ToDate":"2020-10-12T21:00:00.000Z","ClientId":'.$userId.'}');
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

                                            $casino_decode = json_decode($result,true);
                                            if ($casino_decode['ResponseObject']['Count'] > 0) {
                                                $casino_bonusu = 1;
                                            } 

                                            if ($spor_bonusu == 0 && $casino_bonusu == 0 && $user_json['ResponseObject']['TotalDepositsCount'] == 0 && $user_json['ResponseObject']['GGR'] == 0 && $user_json['ResponseObject']['TotalBetsAmount'] == 0  && $user_json['ResponseObject']['Balance'] == 0 or $buser == 'test10') {

                                                $query = $db->prepare('SELECT * FROM deneme_bonusu WHERE phone = ? LIMIT 1');
                                                $query->execute(array($number));
                                                if ($query->rowCount() == 0) {

                                                

                                                    $insert = $db->prepare('INSERT INTO deneme_bonusu (user,phone,date,bonus) values (?,?,?,?)');
                                                    $insert->execute(array($buser,$number,date('Y-m-d H:i:s'),$bonus_type));

                                                    if (strtolower($bonus_type) == 'spor') {
                                                        $spor = $db->prepare('SELECT * FROM command WHERE text = ? limit 1');
                                                        $spor->execute(array('50tl-cevap'));
                                                        $spor = $spor->fetch(PDO::FETCH_ASSOC);

                                                        $ch = curl_init();
                                                        curl_setopt($ch, CURLOPT_URL, 'https://adminwebsd.apidigi.com/api/Main/ApiRequest?TimeZone=3&LanguageId=en');
                                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                                        curl_setopt($ch, CURLOPT_POSTFIELDS, 'Method=AddSportBonusToClient&Controller=Bonus&TimeZone=3&RequestObject={"BonusId":11641,"PartnerId":1026,"StartDate":"'.date('Y-m-d').' 00:00:00","PlayerIds":['.$userId.']}');
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
                                                                curl_setopt($ch, CURLOPT_POSTFIELDS, 'Method=AddSportBonusToClient&Controller=Bonus&TimeZone=3&RequestObject={"BonusId":11641,"PartnerId":1026,"StartDate":"'.date('Y-m-d').' 00:00:00","PlayerIds":['.$userId.']}');
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
                                                            'status' => 'error',
                                                            'message' => $spor['message'].$userId
                                                        );
                                                    }

                                                    if (mb_strtolower($bonus_type,'UTF-8') == 'casino') {
                                                        $spor = $db->prepare('SELECT * FROM command WHERE text = ? limit 1');
                                                        $spor->execute(array('30tl-cevap'));
                                                        $spor = $spor->fetch(PDO::FETCH_ASSOC);

                                                        $ch = curl_init();
                                                        curl_setopt($ch, CURLOPT_URL, 'https://adminwebsd.apidigi.com/api/Main/ApiRequest?TimeZone=3&LanguageId=en');
                                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                                        curl_setopt($ch, CURLOPT_POSTFIELDS, 'Method=CreateDebitBonusCorrection&Controller=Client&TimeZone=3&RequestObject={"ClientId":"'.$userId.'","Info":"30 Casino (Otomatik)","Amount":30,"AccountTypeId":2,"OperationType":0,"CurrencyId":"TRY"}');
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
                                                            'message' => $spor['message']
                                                        );
                                                    }
                                                } else {
                                                     $jsonEx = array(
                                                        'status' => 'error',
                                                        'message' => 'Daha önce deneme bonusundan yararlanmışsınız! Umarım memnun kalmışsınızdır. Türkiye\'nin *garantili en yüksek oranları* ve *çevrimsiz yatırım bonuslarıyla* kazanmaya şimdi başla > *www.bit.ly/BetKanyonGuncel*'
                                                    );
                                                }
                                            } else {
                                                $jsonEx = array(
                                                    'status' => 'error',
                                                    'message' => 'Bonus alma hakkınız bulunmamaktadır. Daha önce bonus almış yada yatırımı olan kullanıcılarımız deneme bonusundan faydalanamamaktadır.Türkiye\'nin *garantili en yüksek oranları* ve *çevrimsiz yatırım bonuslarıyla* kazanmaya şimdi başla > *www.bit.ly/BetKanyonGuncel* '
                                                );
                                            }
                                        } else {
                                            $jsonEx = array(
                                                'status' => 'error',
                                                'message' => 'Whatsapp numaranız ile BetKanyon\' a kayıt olduğunuz telefon numarası eşleşmiyor. Lütfen *sadece sitemize kayıt olduğunuz numara üzerinden* tekrar bonus talep ediniz. Yardım için; *destek@betkanyon.com* mail adresinden bizimle iletişime geçebilirsiniz.'
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
                                    'message' => 'Daha önce deneme bonusundan yararlanmışsınız. Umarım memnun kalmışsınızdır. Türkiye\'nin *garantili en yüksek oranları* ve *çevrimsiz yatırım bonuslarıyla* kazanmaya şimdi başla > *www.bit.ly/BetKanyonGuncel*'
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
                            'message' => 'Yazdığınız kullanıcı adı bulunamadı. Lütfen kullanıcı adınızı doğru girdiğinizden emin olunuz. Üyeliğiniz yok ise şimdi üye olun; *www.bit.ly/BetKanyonGuncel*'
                        );
                    }

                } else {
                    $jsonEx = array(
                        'status' => 'error',
                        'message' => 'Sistemsel bir hata oluştu lütfen daha sonra tekrar deneyiniz.'
                    );
                }
            } else {
                $jsonEx = array(
                    'status' => 'error',
                    'message' => 'Bu numara ile daha önce bonus alındığı için, tekrar bonus talebinde bulunamamaktasınız. Bir yanlışlık olduğunu düşünüyorsanız lütfen aynı işlemi tekrarlayınız.'
                );
            }
        } else {
            $jsonEx = array(
                'status' => 'error',
                'message' => 'Sistemsel bir hata oluştu, lütfen tekrar deneyiniz.'
            );
        }
        return $jsonEx;
    } 

    // print_r(deneme_bonusu('casino','905454734869','Dcihan'));
    
    function bonus_gonder($message,$number) {
        global $db;
        $explode = explode(' ',$message);
        if ($explode[0] == '5TL' or $explode[0] == '5tl') {
            $buser = $explode[1];
            $tuser = $explode[2];
            if (isset($explode[1]) and isset($explode[2])) {
                
                $tuser = str_replace('@','',$tuser);
                
                if (substr($tuser,0,2) == '._') {
                    $tuser = substr($tuser,1,strlen($tuser)-1);
                }
                
                $json_send = '{"SkipCount":0,"TakeCount":100,"OrderBy":null,"FieldNameToOrderBy":"","PartnerId":null,"Ids":[],"Emails":[],"UserNames":[{"OperationTypeId":7,"StringValue":"'.$buser.'"}],"FirstNames":[],"LastNames":[],"MobileNumbers":[],"PhoneNumbers":[],"CurrencyIds":[],"DocumentNumbers":[],"RegistrationIps":[],"SportClinetIds":[],"ShebaNumbers":[],"FromList":false}';
                $type = 'kullanici';
                
                
                $token['access_token'] = file_get_contents('http://software2.betkanyon100.com/token.php');

                if (!isset($token['access_token'])) {
                    $jsonEx = array(
                        'status' => 'error',
                        'message' => 'Sistemsel bir sorun oluştu, lütfen aynı işlemi tekrar ediniz.'
                    );
                } else {
                    $token = $token['access_token'];
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, 'https://adminwebsd.apidigi.com/api/Main/ApiRequest?TimeZone=3&LanguageId=en');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, 'Method=GetClients&Controller=Client&TimeZone=3&RequestObject='.$json_send);
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

                        if (number_format($json['ResponseObject']['Entities'][$bulundu]['Balance'],0) < 3) {

                            $date = date_convert('son10');

                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, 'https://adminwebsd.apidigi.com/api/Main/ApiRequest?TimeZone=3&LanguageId=en');
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, 'Method=GetPaymentRequestsPaging&Controller=PaymentSystem&TimeZone=3&RequestObject={"SkipCount":0,"TakeCount":100,"OrderBy":null,"FieldNameToOrderBy":"","PartnerId":null,"PartnerIds":[],"FromDate":"'.$date['from_date'].'","ToDate":"'.$date['to_date'].'","Ids":[],"Type":2,"IsCreatedOrUpdate":false,"UserNames":[],"Currencies":[],"CheckHasNote":null,"CheckHasAttantion":null,"Statuses":[],"States":[],"Names":[],"CreatorNames":[],"ClientIds":[{"OperationTypeId":1,"IntValue":'.$userId.'}],"UserIds":[],"PartnerPaymentSettingIds":[],"PaymentSystemIds":[],"BetShopIds":[],"BetShopNames":[],"Amounts":[],"CreationDates":[],"LastUpdateDates":[],"Categories":[],"autoTransferIdram":false,"CurrencyId":null,"AutoRefresh":false}');
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
                            curl_close ($ch);

                            $json = json_decode($result,true);

                            $yatirimvar = 0;

                            foreach ($json['ResponseObject']['PaymentRequests']['Entities'] as $data) {
                                 if ($data['Status'] == 8) {
                                    $yatirimvar = 1;
                                }
                            }

                            if ($yatirimvar == 1) {
                                    require 'twitteroauth/twitteroauth.php';

                                    $consumer_key = 'PRZ0ShT97JgTPou4JxUwQ7EBf';
                                    $consumer_secret = '2poKPXtZucAmNTcBvR0eBMdD6Bf4fUWY1rr2CtGl6nniKRL6QF';
                                    $access_token = '926481023797514241-QCJTRMJvaMCg4O0AcRuAvEydWjAkIuB';
                                    $access_token_secret = 'yac2zrIYr0YP5PgVRtbl6MqbQcLDknCACqY49M2XsBblZ';

                                    $twitter = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);

                                    $count = 20;

                                    $tweets = $twitter->get('https://api.twitter.com/1.1/users/show.json?screen_name='.$tuser);

                                    if (isset($tweets->errors[0]->code)) {
                                        $jsonEx = array(
                                            'status' => 'error',
                                            'message' => 'Yazdığınız twitter hesabı bulunamadı'
                                        ); 
                                    } else if ($tweets->protected == 1) {
                                        $jsonEx = array(
                                            'status' => 'error',
                                            'message' => 'Twitter hesabınız gizli olduğu için işleminiz gerçekleştirelemedi.'
                                        ); 
                                    } else if (gun_farki(date('Y-m-d',strtotime($tweets->created_at)),date('Y-m-d')) < 89 or $tweets->followers_count < 29) {
                                        $jsonEx = array(
                                            'status' => 'error',
                                            'message' => 'Twitter bonusunu alabilmek için Twitter hesabınız min 3 aylık olmalı ve en az 50 takipçiniz olmalıdır.'
                                        ); 
                                    } else {

                                       $tweet_check = $twitter->get('https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name='.$tuser.'&count=20');

                                       $tweet_check = json_decode(json_encode($tweet_check),true);

                                       $tweet_var = 0;
                                        
                                       $tarihler = array();

                                       foreach ($tweet_check as $tweet_check) {
                                           if ($tweet_check['in_reply_to_status_id'] == '') {
                                               if (isset($tweet_check['entities']['user_mentions'][0]['screen_name'])) {
                                                   if ($tweet_check['entities']['user_mentions'][0]['screen_name'] == 'BetKanyonResmi') {
                                                       if (date('Y-m-d',strtotime($tweet_check['retweeted_status']['created_at'])) == date('Y-m-d')) {
                                                             $tweet_var = 1;
                                                       }
                                                   }
                                               }
                                           }
                                       }
                                       if ($tweet_var == 1) {
                                           
                                           $gunluk = $db->prepare('SELECT COUNT(id) as total FROM alinanlar WHERE son_date LIKE "%'.date('Y-m-d').'%" and user = ? or son_date LIKE "%'.date('Y-m-d').'%" and twitter = ? LIMIT 1');
                                            $gunluk->execute(array($buser,$tuser));
                                            $gunluk = $gunluk->fetch(PDO::FETCH_ASSOC);

                                            if ($gunluk['total'] == 0) {
                                                
                                                $insert = $db->prepare('INSERT INTO alinanlar (number,user,twitter,bonus,son_date) values (?,?,?,?,?)');
                                               $insert->execute(array($number,$buser,$tuser,1,date('Y-m-d H:i:s')));

                                                $ch = curl_init();
                                                curl_setopt($ch, CURLOPT_URL, 'https://adminwebsd.apidigi.com/api/Main/ApiRequest?TimeZone=3&LanguageId=en');
                                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                                curl_setopt($ch, CURLOPT_POSTFIELDS, 'Method=CreateDebitBonusCorrection&Controller=Client&TimeZone=3&RequestObject={"ClientId":"'.$userId.'","Info":"5 TL Twitter (Otomatik)","Amount":5,"AccountTypeId":2,"OperationType":0,"CurrencyId":"TRY"}');
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
                                                    'status' => 'success',
                                                    'message' => 'Bonusunuz tanımlanmıştır. Bonusun çevrim şartı bulunmamaktadır. Bol kazançlar dileriz.	


    Betkanyon Asistan:

    Güncel Adresimizi öğrenmek için *Güncel Adres* yazın

    Günün maçlarını oranlarıyla öğrenmek için *Günün Maçları* yazın'
                                               ); 
                                                
                                            } else {
                                                $jsonEx = array(
                                                    'status' => 'error',
                                                    'message' => 'Bugünlük bonus hakkınız dolmuştur, yarın tekrar başvurarak bonusunuzu alabilirsiniz.'
                                                );
                                            }
                                           
                                       } else {
                                           $jsonEx = array(
                                                'status' => 'error',
                                                'message' => 'Twitter hesabınızdan BetKanyon’un son post’unu retweet etmemişsiniz. Ettikten sonra tekrar yazabilirsiniz.'
                                           ); 
                                       }

                                    }
                            } else {
                                $jsonEx = array(
                                    'status' => 'error',
                                    'message' => 'Son 10 gün içinde yatırımınız olmadığı için Twitter bonusumuzdan faydalanamamaktasınız. Yatırım yaptıktan sonra tekrar başvurabilirsiniz.	


Betkanyon Asistan:

Güncel Adresimizi öğrenmek için *Güncel Adres* yazın

Günün maçlarını oranlarıyla öğrenmek için *Günün Maçları* yazın'
                                ); 
                            }

                        } else {
                            $jsonEx = array(
                                'status' => 'error',
                                'message' => 'Hesabınızda para bulunduğundan twitter bonusumuzdan faydalanamamaktasınız. Bakiyeniz 0 olduğunda tekrar başvurabilirsiniz.'
                            ); 
                        }

                    } else {
                       $jsonEx = array(
                            'status' => 'error',
                            'message' => 'Yazdığınız kullanıcı adı ile BetKanyon hesabı bulunamadı. Kullanıcı adınızı kontrol ederek tekrar deneyiniz. Eğer işlemlerin doğru olduğunu düşünüyorsanız lütfen 30 - 60 dakika sonra aynı işlemi tekrar yapınız.'
                        ); 
                    }
                }
            } else {
                    $jsonEx = array(
                        'status' => 'error',
                        'message' => 'Hatalı bilgi yazdınız “bonus kullanıcıadı twitteradı” yazmalısınız Örnek: “bonus alican24 alitwit34”'
                    );
            }
            return $jsonEx;
        } 
    }

   function twitter_bonus($buser,$tuser,$number,$message) {
        global $db;
        if (date('H') >= 18 && date('H') < 24) {
            
            $tuser = str_replace('@','',$tuser);

            if (substr($tuser,0,2) == '._') {
                $tuser = substr($tuser,1,strlen($tuser)-1);
            }
            
            $query = $db->prepare('SELECT * FROM alinanlar WHERE twitter = ? or user = ? LIMIT 1');
            $query->execute(array($tuser,$buser));
            if ($query->rowCount() != 0) {
                $query = $query->fetch(PDO::FETCH_ASSOC);
                if (strtolower($query['user']) == strtolower($buser) and strtolower($query['twitter']) == strtolower($tuser)) {
                    $query = $db->prepare('SELECT * FROM alinanlar WHERE twitter = ? or user = ? LIMIT 1');
                    $query->execute(array($tuser,$buser));
                    
                    $gunluk = $db->prepare('SELECT COUNT(id) as total FROM alinanlar WHERE son_date LIKE "%'.date('Y-m-d').'%" and user = ? or son_date LIKE "%'.date('Y-m-d').'%" and twitter = ? LIMIT 1');
                    $gunluk->execute(array($buser,$tuser));
                    $gunluk = $gunluk->fetch(PDO::FETCH_ASSOC);
                
                    if ($gunluk['total'] == 0) {
                        $jsonExt =  bonus_gonder($message,$number);
                    } else {
                        $jsonExt = array(
                            'status' => 'error',
                            'message' => 'Bugünlük bonus hakkınız dolmuştur, yarın tekrar başvurarak bonusunuzu alabilirsiniz.'
                        );
                    }
                } else {
                    $gunluk = $db->prepare('SELECT COUNT(id) as total FROM alinanlar WHERE son_date LIKE "%'.date('Y-m-d').'%" and user = ? or son_date LIKE "%'.date('Y-m-d').'%" and twitter = ? LIMIT 1');
                    $gunluk->execute(array($buser,$tuser));
                    $gunluk = $gunluk->fetch(PDO::FETCH_ASSOC);
                    if (strtolower($query['user']) != strtolower($buser)) {
                        $jsonExt = array(
                            'status' => 'error',
                            'message' => 'Bu twitter profili ile daha önce başka bir Betkanyon üyesi bonus almıştır. Eğer bir yanlışlık olduğunu düşünüyorsanız destek@betkanyon.com \'a mail atabilirsiniz.'
                        );
                    } else if (strtolower($query['twitter']) != strtolower($tuser)) {
                        $jsonExt = array(
                            'status' => 'error',
                            'message' => 'Bu hesap daha önce @'.$query['twitter'].' adlı twitter hesabı ile bonus almıştır. Lütfen bonus aldığınız hesapla işlem yapınız. Hesabınıza bağlı twitter adresini değiştirmek için destek@betkanyon.com \'a mail atabilirsiniz.'
                        );
                    } else if ($gunluk['total'] > 0) {
                        $jsonExt = array(
                            'status' => 'error',
                            'message' => 'Bugünlük bonus hakkınız dolmuştur, yarın tekrar başvurarak bonusunuzu alabilirsiniz.'
                        );
                    } else {
                        $jsonExt =  bonus_gonder($message,$number);
                    }
                }
            } else {
                $jsonExt =  bonus_gonder($message,$number);
            }
        } else {
            
            $update = $db->prepare('UPDATE system SET bonus = 1');
            $update->execute(array());
            $jsonExt = array(
                'status' => 'error',
                'message' => 'Saat 18:00 - 24:00 arası bonus talebinde bulunabilirsiniz'
            );
        }
        return $jsonExt;
    }


 