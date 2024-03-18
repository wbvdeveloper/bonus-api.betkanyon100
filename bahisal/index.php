<?php
    header("Access-Control-Allow-Origin: *");
    header('Content-Type:application/json');
    $host = "localhost";
    $user = "admin_bonus";
    $pass = "admin_bonus!";
    $db = "admin_bonus";
    date_default_timezone_set('Europe/Istanbul');
    $db = new PDO("mysql:host=$host;dbname=$db",$user,$pass);
    $karakter = $db->prepare("SET CHARSET 'utf8'");
    $karakter->execute(array());
    $karakte2r = $db->prepare("SET NAMES SET 'utf8'");
    $karakte2r->execute(array());

   function minusHour($date,$hour,$plus) {
        if ($plus == '+') {
            $hour = $hour + 4;
            return date('d-m-y - H:i:s', strtotime('+'.$hour.' hours', strtotime($date)));
        } else {
            $hour = $hour + 3;
            return date('d-m-y - H:i:s', strtotime('-'.$hour.' hours', strtotime($date)));
        }
    }

    function minusHour2($date) {
        return date('Y-m-d H:i:s', strtotime('+3 hours', strtotime($date)));
    }

    function curl_json($url,$data,$method = 'post'){
            $i = 0;
            do {
                $token = file_get_contents('http://software2.betkanyon100.com/winx_token_al.php');
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                if ($method == 'post') {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($ch, CURLOPT_POST, 1);
                }
                curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

                $headers = array();
                $headers[] = 'Origin: https://backoffice.betconstruct.com';
                $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36';
                $headers[] = 'Content-Type: application/json;charset=UTF-8';
                $headers[] = 'Accept: application/json, text/plain, */*';
                $headers[] = 'Referer: https://backoffice.betconstruct.com/index.html';
                $headers[] = 'Access-Control-Allow-Credentials: true';
                $headers[] = 'X-Requested-With: XMLHttpRequest';
                $headers[] = 'Authentication: '.$token;
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                $result = curl_exec($ch);
                if (curl_errno($ch)) {
                    echo 'Error:' . curl_error($ch);
                }
                curl_close ($ch);
                $decode = json_decode($result,true);
                if (isset($decode['AlertType'])) {
                    if ($decode['AlertType'] == 'success') {
                        return $decode;
                        $while = 1;
                    }
                } else {
                    $while = 0;
                }
                
                if ($i >= 10) {
                    $while = 1;
                }
                
                $i++;
                
            } while ($while == 0);
    }

    if ($_GET) {
        
           
        
        $player_id = addslashes(strip_tags($_GET['id']));
      
        if ($player_id == 0) {
            $json = array(
                'status' => 'error',
                'message' => 'Player ID tanınamadı. Lütfen Canlı destek üzerinden iletişime geçin.',
                'info' => ''
            );
            echo json_encode($json);
            die();
        }
        
        $block = $db->prepare('SELECT * FROM istek_blok WHERE player_id = ? LIMIT 1');
        $block->execute(array($player_id));
        if ($block->rowCount() != 0) {
            $json = array(
                'status' => 'error',
                'message' => 'Lütfen birkaç saniye sonra tekrar deneyin.',
                'info' => ''
            );
            echo json_encode($json);
            die();
        }
        
        $insert = $db->prepare('INSERT INTO istek_blok (player_id) values (?)');
        $insert->execute(array($player_id));
        
        $bonus_type = addslashes(strip_tags($_GET['type']));
        if ($bonus_type == 1 or $bonus_type == 2) {
            
        } else {
            
            $delete = $db->prepare('DELETE FROM istek_blok WHERE player_id = ?');
            $delete->execute(array($player_id));
            
            $json = array(
                'status' => 'error',
                'message' => 'Tanımlanmayan bonus türü.',
                'info' => ''
            );
            echo json_encode($json);
            die();
        }
        
        $category = curl_json('https://backofficewebadmin.betconstruct.com/api/tr/Client/GetClientById?id='.$player_id,'','get');
        $category_id = $category['Data']['SportsbookProfileId'];
        
        if ($category['Data']['SportsbookProfileId'] == 7) {
            $delete = $db->prepare('DELETE FROM istek_blok WHERE player_id = ?');
            $delete->execute(array($player_id));
            $json = array(
                'status' => 'error',
                'message' => 'Bonus hakkınız yoktur, bir yanlışlık olduğunu düşünüyorsanız Canlı Destek ile iletişime geçebilirsiniz.',
                'info' => ''
            );
            echo json_encode($json);
        } else if ($category['Data']['SportsbookProfileId'] == 37 and $bonus_type == 1) {
            $delete = $db->prepare('DELETE FROM istek_blok WHERE player_id = ?');
            $delete->execute(array($player_id));
            $json = array(
                'status' => 'error',
                'message' => 'Bonus hakkınız yoktur, kayıp bonusu talebinde bulunabilirsiniz.',
                'info' => ''
            );
            echo json_encode($json);
        } else if ($category['Data']['SportsbookProfileId'] == 14) {
            $delete = $db->prepare('DELETE FROM istek_blok WHERE player_id = ?');
            $delete->execute(array($player_id));
            $json = array(
                'status' => 'success',
                'message' => 'Bonus talebiniz alınmıştır, kısa süre içerisinde sonuçlanacaktır.',
                'info' => ''
            );
            echo json_encode($json);
        } else {
          
         if ($bonus_type == 1) {
             $saat = 48;
         } else {
             $saat = 168;
         }
            
         $data = '{"FromTransactionDateLocal":"","ToTransactionDateLocal":"","FromCreatedDateLocal":"'.minusHour(date('Y-m-d H:i:s'),$saat,'-').'","ToCreatedDateLocal":"","ClientId":'.$player_id.',"ExternalId":"","CashDeskId":"","CurrencyId":"","TypeId":null,"MaxRows":100000,"SkeepRows":0,"Id":"","PaymentSystemId":null,"DefaultCurrencyId":"TRY","AmountFrom":"","AmountTo":"","IsTest":"false"}';
         $deposits = curl_json('https://backofficewebadmin.betconstruct.com/api/tr/Financial/GetDepositsWithdrawalsWithPaging',$data);
            
            
         if ($deposits['Data']['Documents']['Count'] != 0) {
             
             $deposits['Data']['Documents']['Objects'] = array_reverse($deposits['Data']['Documents']['Objects']);

             
             if ($deposits['Data']['Documents']['Objects'][0]['Id'] <= 13843781938) {
                $delete = $db->prepare('DELETE FROM istek_blok WHERE player_id = ?');
                $delete->execute(array($player_id));
                $json = array(
                    'status' => 'error',
                    'message' => 'Daha önce bonus aldığınız için hakkınız bulunmamaktadır.',
                    'info' => ''
                );
                echo json_encode($json);
                 die();
             }
             
             $query = $db->prepare('SELECT id FROM winx_alinan_bonuslar WHERE deposit_id = ? LIMIT 1');
             $query->execute(array($deposits['Data']['Documents']['Objects'][0]['Id']));
             
             
             $dis_query =$db->prepare('SELECT id FROM winxbet_kayip_bonusu WHERE deposit_id = ? LIMIT 1');
             $dis_query->execute(array($deposits['Data']['Documents']['Objects'][0]['Id']));
             if ($query->rowCount() == 0 and $dis_query->rowCount() == 0) {
                  $bonus_date = minusHour2($deposits['Data']['Documents']['Objects'][0]['CreatedLocal']);
                  $profile = curl_json('https://backofficewebadmin.betconstruct.com/api/en/Client/GetClientKpi?id='.$player_id,'','GET');   
                  if ($bonus_type == 2) {
                      $acik_bahis = 0;
                      $cekims = 0;
                       if ($profile['Data']['TotalUnsettledBets'] != 0) {
                           $acik_bahis = 1;
                       }
                  } else {
                      $acik_bahis = 0;
                      $cekims = 0;
                      $cekim_date = minusHour(date('Y-m-d H:i:s',strtotime($deposits['Data']['Documents']['Objects'][0]['CreatedLocal'])),21,'-');
                      $data = '{"ClientId":"'.$player_id.'","ClientLogin":"","Id":"","BetShopId":"","State":"","ByAllowDate":false,"PaymentTypeId":"","IsTest":"","FromDateLocal":"'.$cekim_date.'","ToDateLocal":"'.date('d-m-y - H:i:s').'"}';
                      $cekim_talebi = curl_json('https://backofficewebadmin.betconstruct.com/api/en/Client/GetClientWithdrawalRequestsWithTotals',$data);
                
                      foreach ($cekim_talebi['Data']['ClientRequests'] as $cekimsa) {
                           if ($cekimsa['StateName'] == 'Ödendi') {
                               $cekims = 1;
                           }
                           if ($cekimsa['StateName'] == 'İzin Verildi') {
                               $cekims = 1;
                           }
                          
                           if ($cekimsa['StateName'] == 'Yeni') {
                               $cekims = 1;
                           }
                          
                           if ($cekimsa['StateName'] == 'Beklemede') {
                               $cekims = 1;
                           }
                      }
                  }
                 
                      
                
                 if ($bonus_type == 1) {
                         $data = '{"StartTimeLocal":"'.date('d-m-y - H:i:s',strtotime($deposits['Data']['Documents']['Objects'][0]['CreatedLocal'])).'","EndTimeLocal":"'.date('d-m-y - H:i:s').'","ClientId":'.$player_id.',"CurrencyId":"TRY","MaxRows":10000,"PaymentSystemId":null,"GameId":null,"DocumentTypeId":10}';
                         $get_class = curl_json('https://backofficewebadmin.betconstruct.com/api/tr/Client/GetClientTransactions',$data);
                         foreach ($get_class['Data']['Objects'] as $islemler) {
                            if ($islemler['DocumentTypeName'] == 'Bahis' and strtotime($islemler['CreatedLocal']) > strtotime($deposits['Data']['Documents']['Objects'][0]['CreatedLocal'])) {
                                $delete = $db->prepare('DELETE FROM istek_blok WHERE player_id = ?');
                                $delete->execute(array($player_id));
                                $json = array(
                                    'status' => 'error',
                                    'message' => 'Yatırımınızdan sonra bahis aldığınız için yatırım bonusu alamamaktasınız.',
                                    'info' => ''
                                );
                                echo json_encode($json);
                                die();
                            }
                         }
                     
                     $gunluk_cevrimsiz_dolu = 0;
                     $gunluk_cevrimsiz_limit = 500;
                     $gunluk_cevrimli_dolu = 0;
                     $gunluk_cevrimli_limit = 500;
                     
                     $limit_sorgula = $db->prepare('SELECT * FROM special_limit_winx WHERE player_id = ? order by id desc LIMIT 1');
                     $limit_sorgula->execute(array($player_id));
                     if ($limit_sorgula->rowCount() != 0) {
                         $limit_sorgula = $limit_sorgula->fetch(PDO::FETCH_ASSOC);
                         $gunluk_cevrimsiz_limit = $limit_sorgula['gunluk_cevrimsiz'];
                         $gunluk_cevrimli_limit = $limit_sorgula['gunluk_cevrimli'];
                     }
                     
                     // Çevrimsiz Sorgulama
                     $gunluk_cevrimsiz = $db->prepare('SELECT COALESCE(SUM(bonus_amount),0) as total FROM winx_alinan_bonuslar WHERE bonus_category = 2 and player_id = ? and created_date LIKE "%'.date('Y-m-d').'%" LIMIT 10');
                     $gunluk_cevrimsiz->execute(array($player_id));
                     $gunluk_cevrimsiz = $gunluk_cevrimsiz->fetch(PDO::FETCH_ASSOC);
                     if ($gunluk_cevrimsiz['total'] >= $gunluk_cevrimsiz_limit) {
                         $gunluk_cevrimsiz_dolu = 1;
                     }
                     
                     $gunluk_cevrimli = $db->prepare('SELECT COALESCE(SUM(bonus_amount),0) as total FROM winx_alinan_bonuslar WHERE bonus_category = 1 and player_id = ? and created_date LIKE "%'.date('Y-m-d').'%" LIMIT 10');
                     $gunluk_cevrimli->execute(array($player_id));
                     $gunluk_cevrimli = $gunluk_cevrimli->fetch(PDO::FETCH_ASSOC);
                     if ($gunluk_cevrimli['total'] >= $gunluk_cevrimli_limit) {
                         $gunluk_cevrimli_dolu = 1;
                     }
                     
                 }
                 
                 $data = '{"StartDateLocal":null,"EndDateLocal":null,"BonusType":null,"AcceptanceType":null,"PartnerBonusId":"","ClientId":'.$player_id.'}';
                 $get_class = curl_json('https://backofficewebadmin.betconstruct.com/api/tr/Client/GetClientBonuses',$data);
                 if ($player_id != '145938848') {
                 foreach ($get_class['Data'] as $islemler) {
                    if ($islemler['ResultType'] == 0) {
                        if (isset($_GET['cancel']) == 1) {
                             $data = '{"BonusId":'.$islemler['Id'].',"CancelReason":"Müşteri kendi isteği ile iptal etti. Bonus Sistemi"}';
                             $cancel_bonus = curl_json('https://backofficewebadmin.betconstruct.com/api/en/Client/CancelWageringBonusAsync',$data);
                        } else {
                            $delete = $db->prepare('DELETE FROM istek_blok WHERE player_id = ?');
                            $delete->execute(array($player_id));
                            $json = array(
                                'status' => 'error',
                                'message' => 'Yeni bir bonus alabilmeniz için, eski bonuslarınız iptal edilecektir. Onaylıyor musunuz?',
                                'info' => 'acik_bonus'
                            );
                            echo json_encode($json);
                            die();
                        }
                    }
                 }
                 }
                 if ($acik_bahis == 1 and $bonus_type == 2) {
                     $delete = $db->prepare('DELETE FROM istek_blok WHERE player_id = ?');
                     $delete->execute(array($player_id));
                     $json = array(
                        'status' => 'error',
                        'message' => 'Açıkta bahisiniz olduğu için kayıp bonusu talebinde bulunamazsınız.',
                        'info' => ''
                    );
                    echo json_encode($json);
                    die();
                 }
                 
                 if ($category['Data']['Balance'] > 3 and $bonus_type == 2) {
                     $delete = $db->prepare('DELETE FROM istek_blok WHERE player_id = ?');
                     $delete->execute(array($player_id));
                     $json = array(
                        'status' => 'error',
                        'message' => 'Bakiyeniz bulunduğu için kayıp bonusu talebinde bulunamazsınız.',
                         'info' => ''
                    );
                    echo json_encode($json);
                    die();
                 }
                 
                 if ($cekims == 0) {
                      
                        if ($deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] == 'BankTransfer') {
                          $deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] = 'Havale';
                        }

                        if ($deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] == 'PayGiga') {
                            $deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] = 'Paygiga';
                            $id = $deger['Note'];
                        }

                        if ($deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] == 'BestPayCepBank') {
                            $deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] = 'Bestpaycepbank';
                        }

                        if ($deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] == 'ExpressHavale') {

                            $id = $deger['Note'];
                            $explode = explode('transactionId:',$deposits['Data']['Documents']['Objects'][0]['Note']);
                            $explode = explode('detail:',$explode[1]);

                            $islem_id = $explode[0];
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, 'https://expresshavale.com/kanyon_query.php?id='.$islem_id);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

                            $headers = array();
                            $headers[] = 'Sec-Fetch-Mode: cors';
                            $headers[] = 'Origin: https://betkanyon.admindigi.com';
                            $headers[] = 'Accept-Language: en';
                            $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
                            $headers[] = 'Referer: https://betkanyon.admindigi.com/';
                            $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36';
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                            $result = json_decode(curl_exec($ch),true);
                            curl_close ($ch);

                            $deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] = $result['method'];
                        }

                        if ($deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] == 'BestPayBankTransfer') {
                            $deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] = 'Hızlı Havale';
                        }
                     
                        if ($deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] == 'BestPayCommunityBank') {
                            $deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] = 'Hızlı Havale';
                        }
                     
                        if ($deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] == 'Paygiga') {
                            $deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] = 'Hızlı Havale';
                        }
                     
                        if ($deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] == 'Envoysoft') {
                            $deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] = 'Hızlı Havale';
                        }
                     
                        if ($deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] == 'Hızlı QR Envoy') {
                            $deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] = 'Hızlı Havale';
                        }
                     
            

                        if ($deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] == 'CoinPayments') {
                            $deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] = 'Kripto Para';
                        }

                        if ($deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] == 'KolayHavale') {
                            $deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] = 'Hızlı Havale';
                        }


                        if ($deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] == 'EnvoySoftAutomatic') {
                            $deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] = 'Hızlı Havale';
                        }

                        if ($deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] == 'CMTPayturka') {
                            $deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] = 'CMT Cüzdan';
                        }

                        if ($deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] == 'JetonV3') {
                            $deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] = 'Jeton';
                        }
                     
                        if ($deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] == 'BestPayBitcoin') {
                            $deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] = 'Kripto Para';
                        }
                     
                     
                        if ($deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] == 'RocketPay') {
                            $deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] = 'Hızlı Havale';
                        }


                        if ($deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] == 'HizliQR') {
                            $deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] = 'Hızlı QR';
                        }

                        if ($deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] == 'CepBank') {
                            $deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] = 'Cepbank';
                        }
                      

                        if ($deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] == 'BankTransferBME') {
                            $deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] = 'Havale';
                        }
                      


                        $method_query = $db->prepare('SELECT * FROM yontemler WHERE name = ? LIMIT 1');
                        $method_query->execute(array(addslashes(strip_tags($deposits['Data']['Documents']['Objects'][0]['PaymentSystemName']))));
                        if ($method_query->rowCount() != 0) {
                             if ($bonus_type == 1) {
                                 
                                $hosgeldin = 0;
                                 
                                if ($profile['Data']['DepositCount'] == 1) {
                                       $hosgeldin = 1;
                                }
                                $method_query = $method_query->fetch(PDO::FETCH_ASSOC);
                                $bonuslar = $db->prepare('SELECT * FROM winx_bonuslar WHERE method_id LIKE "%,'.$method_query['id'].',%" and bonus_type <> 6 order by sira asc');
                                $bonuslar->execute(array());
                                $bonuslar = $bonuslar->fetchAll(PDO::FETCH_ASSOC); 
                                 
                                $bonuslar_array = array();
                                
                               
                                if ($hosgeldin == 1) {
                                    $bonuslar_array['HOŞGELDİN BONUSLARI'] = array();
                                }
                                 $bonuslar_array['ÇEVRİMLİ BONUSLAR'] = array();
                                  if ($gunluk_cevrimsiz_dolu == 0) {
                                    $bonuslar_array['ÇEVRİMSİZ BONUSLAR'] = array();
                                }
                                 
                                $gecerli_bonuslar = array();
                                $partner_bonus_id = array();
                                foreach ($bonuslar as $bonuslar) {
                                    
                                   $ozel = $db->prepare('SELECT * FROM winx_ozel_anlasmalar WHERE bonus_id = ? and player_id = ? LIMIT 1');
                                   $ozel->execute(array($bonuslar['id'],$player_id));
                                   if ($ozel->rowCount() != 0) {
                                       $ozel = $ozel->fetch(PDO::FETCH_ASSOC);
                                       $bonuslar['yuzde'] = $ozel['yuzde'];
                                   }
                                    
                                    if ($bonuslar['category'] == 1) {
                                        $category = 'Spor';
                                    } else if ($bonuslar['category'] == 2) {
                                        $category = 'Casino';
                                    }

                                    if ($bonuslar['bonus_type'] == 1) {
                                        $arr = array(
                                            'bonus_id' => $bonuslar['id'],
                                            'bonus_name' => '%'.$bonuslar['yuzde'].' '.$bonuslar['bonus_adi'],
                                            'bonus_category' => $category,
                                            'contract' => $bonuslar['kurallar'],
                                            'daily_limit' => $gunluk_cevrimli['total'],
                                            'yuzde' => $bonuslar['yuzde'],
                                        );  
                                        $gecerli_bonuslar[$bonuslar['id']] = $bonuslar['yuzde'];
                                        $partner_bonus_id[$bonuslar['id']] = array(
                                            $bonuslar['partner_bonus_id'],
                                            $bonuslar['bonus_type'],
                                            $gunluk_cevrimli['total']
                                        );
                                        array_push($bonuslar_array['ÇEVRİMLİ BONUSLAR'],$arr);
                                    }

                                    if ($bonuslar['bonus_type'] == 2) {
                                        if ($gunluk_cevrimsiz_dolu == 0) {
                                            if ($category_id == 31) {
                                                $bonuslar['yuzde'] = 20;
                                                $bonuslar['partner_bonus_id'] = 46807;
                                            }
                                            $arr = array(
                                                'bonus_id' => $bonuslar['id'],
                                                'bonus_name' => '%'.$bonuslar['yuzde'].' '.$bonuslar['bonus_adi'],
                                                'bonus_category' => $category,
                                                'contract' => $bonuslar['kurallar'],
                                                'daily_limit' => $gunluk_cevrimsiz['total'],
                                                'yuzde' => $bonuslar['yuzde'],
                                            );  
                                            $gecerli_bonuslar[$bonuslar['id']] = $bonuslar['yuzde'];
                                            
                                            $partner_bonus_id[$bonuslar['id']] = array(
                                                $bonuslar['partner_bonus_id'],
                                                $bonuslar['bonus_type'],
                                                $gunluk_cevrimsiz['total']
                                            );
                                            array_push($bonuslar_array['ÇEVRİMSİZ BONUSLAR'],$arr);
                                        }
                                    }

                                    if ($bonuslar['bonus_type'] == 4 and $hosgeldin == 1) {
                                        $arr = array(
                                            'bonus_id' => $bonuslar['id'],
                                            'bonus_name' => '%'.$bonuslar['yuzde'].' '.$bonuslar['bonus_adi'],
                                            'bonus_category' => $category,
                                            'contract' => $bonuslar['kurallar'],
                                            'daily_limit' => 0,
                                            'yuzde' => $bonuslar['yuzde'],
                                        );  
                                        $gecerli_bonuslar[$bonuslar['id']] = $bonuslar['yuzde'];
                                        $partner_bonus_id[$bonuslar['id']] = array(
                                            $bonuslar['partner_bonus_id'],
                                            $bonuslar['bonus_type']
                                        );
                                        array_push($bonuslar_array['HOŞGELDİN BONUSLARI'],$arr);
                                    }
                                }
                                if (isset($_GET['onay'])) {
                                     $bonus_id = addslashes(strip_tags($_GET['onay']));
                                     if (isset($gecerli_bonuslar[$bonus_id])) {
                                         $bonus_amount = $deposits['Data']['Documents']['Objects'][0]['Amount'] / 100;
                                         $bonus_amount = $bonus_amount * $gecerli_bonuslar[$bonus_id];
                                         
                                         if ($partner_bonus_id[$bonus_id][1] == 1 or $partner_bonus_id[$bonus_id][1] == 2) {
                                             if ($partner_bonus_id[$bonus_id][1] == 1) {
                                                 $gunluk_kalan = $gunluk_cevrimli_limit - $partner_bonus_id[$bonus_id][2];
                                             }
                                             
                                             if ($partner_bonus_id[$bonus_id][1] == 2) {
                                                 $gunluk_kalan = $gunluk_cevrimsiz_limit - $partner_bonus_id[$bonus_id][2];
                                             }
                                             
                                             if ($bonus_amount >= $gunluk_kalan) {
                                                 $bonus_amount = $gunluk_kalan;
                                             } 
                                         } else {
                                             if ($bonus_amount > 1000) {
                                                 $bonus_amount = 1000;
                                             }
                                         }
                                                                                  
                                         if ($partner_bonus_id[$bonus_id][1] == 1 or $partner_bonus_id[$bonus_id][1] == 4) {
                                             $data = '{"ClientId":'.$player_id.',"CurrencyId":"TRY","DocTypeInt":4,"PaymentSystemId":null,"Amount":"'.$deposits['Data']['Documents']['Objects'][0]['Amount'].'","Info":"ÇEVRİMLİ BONUS ALDIĞI İÇİN BAKİYE SİLİNDİ (OTOMATİK)"}';
                                             $ekle = curl_json('https://backofficewebadmin.betconstruct.com/api/tr/Client/CreateClientPaymentDocument',$data);
                                             if ($ekle['AlertType'] == 'success') {
                                                 $bonus_amount = $bonus_amount + $deposits['Data']['Documents']['Objects'][0]['Amount'];
                                             }
                                         }
                                         
                                         $data = '{"ClientId":'.$player_id.',"Amount":"'.$bonus_amount.'","Type":2,"PartnerBonusId":'.$partner_bonus_id[$bonus_id][0].'}';
                                         $bonus_ekle = curl_json('https://backofficewebadmin.betconstruct.com/api/en/Client/AddClientToBonus',$data);
                                         if ($partner_bonus_id[$bonus_id][1] == 1 or $partner_bonus_id[$bonus_id][1] == 4) {
                                                $bonus_amount = $bonus_amount - $deposits['Data']['Documents']['Objects'][0]['Amount'];
                                         }
                                         
                                         $insert = $db->prepare('INSERT INTO winx_alinan_bonuslar (deposit_id,bonus_id,created_date,amount,bonus_amount,bonus_category,player_id,ip) values (?,?,?,?,?,?,?,?)');
                                         $insert->execute(array($deposits['Data']['Documents']['Objects'][0]['Id'],$bonus_id,date('Y-m-d H:i:s'),$deposits['Data']['Documents']['Objects'][0]['Amount'],$bonus_amount,$partner_bonus_id[$bonus_id][1],$player_id,$_SERVER['REMOTE_ADDR']));
                                         
                                         $delete = $db->prepare('DELETE FROM istek_blok WHERE player_id = ?');
                                         $delete->execute(array($player_id));
                                         
                                         $json = array(
                                                'status' => 'success',
                                                'message' => 'Bonusunuz başarıyla tanımlanmıştır. <strong>Bonuslar</strong> menüsünden bonusunuzu <strong>aktif etmeniz</strong> gerekmektedir.'
                                         ); 
                                     } else {
                                        $delete = $db->prepare('DELETE FROM istek_blok WHERE player_id = ?');
                                        $delete->execute(array($player_id));
                                        $json = array(
                                            'status' => 'error',
                                            'message' => 'Bu bonusu almaya hakkınız yoktur.',
                                            'info' => ''
                                        ); 
                                     }
                                 } else {
                                     $delete = $db->prepare('DELETE FROM istek_blok WHERE player_id = ?');
                                     $delete->execute(array($player_id));
                                    
                                     $json = array(
                                        'status' => 'success',
                                        'message' => 'Başarılı.',
                                        'method_id' => $method_query['id'],
                                        'deposit' => $deposits['Data']['Documents']['Objects'][0]['Amount'],
                                        'gunluk_cevrimsiz_limit' => $gunluk_cevrimsiz_limit,
                                        'gunluk_cevrimli_limit' => $gunluk_cevrimli_limit,
                                        'bonuslar' => $bonuslar_array,
                                    );
                                 }
                             } else {  
                                 if (isset($_GET['onay'])) {
                                     $bonus_id = addslashes(strip_tags($_GET['onay']));
                                     $dquery = $db->prepare('SELECT * FROM winx_bonuslar WHERE bonus_type = ? and aktif = ? and id = ? LIMIT 1');
                                     $dquery->execute(array(6,1,$bonus_id));
                                     if ($dquery->rowCount() != 0) {
                                         $delete = $db->prepare('DELETE FROM istek_blok WHERE player_id = ?');
                                         $delete->execute(array($player_id));
                                         $insert = $db->prepare('INSERT INTO winxbet_kayip_bonusu (user_id,bonus_id,created_date,finished_date,accept_user,status,amount,yuzde,eklenen,deposit_id) values (?,?,?,?,?,?,?,?,?,?)');
                                         $insert->execute(array($player_id,$bonus_id,date('Y-m-d H:i:s'),'',0,0,0,0,0,$deposits['Data']['Documents']['Objects'][0]['Id']));
                                         
                                         $delete = $db->prepare('DELETE FROM istek_blok WHERE player_id = ?');
                                         $delete->execute(array($player_id));
                                         
                                         $json = array(
                                            'status' => 'success',
                                            'message' => 'Kayıp Bonusu talebiniz başarıyla alındı. Kayıp bonusu kurallarına uygun olarak <strong>bonus hakkınız var ise</strong>, kısa süre sonra hesabınıza aktarılacaktır.'
                                         );
                                     } else {
                                          $delete = $db->prepare('DELETE FROM istek_blok WHERE player_id = ?');
                                          $delete->execute(array($player_id));
                                          $json = array(
                                            'status' => 'error',
                                            'message' => 'Kayıp bonusu verisi bulunamadı.',
                                              'info' => ''
                                          );
                                     }
                                     
                                     $delete = $db->prepare('DELETE FROM istek_blok WHERE player_id = ?');
                                     $delete->execute(array($player_id));
                                     
                                     $json = array(
                                        'status' => 'success',
                                        'message' => 'Kayıp bonusu talebiniz başarıyla alınmıştır, kısa süre içerisinde sonuçlanacaktır.',
                                    );
                                 } else {
                                     $bonuslar = $db->prepare('SELECT * FROM winx_bonuslar WHERE bonus_type = 6 and aktif = 1 order by sira asc');
                                     $bonuslar->execute(array());
                                     
                                     foreach ($bonuslar->fetchAll(PDO::FETCH_ASSOC) as $bonuslar) {
                                         
                                      
                                         
                                       $ozel = $db->prepare('SELECT * FROM winx_ozel_anlasmalar WHERE bonus_id = ? and player_id = ? LIMIT 1');
                                       $ozel->execute(array($bonuslar['id'],$player_id));
                                       if ($ozel->rowCount() != 0) {
                                           $ozel = $ozel->fetch(PDO::FETCH_ASSOC);
                                           $bonuslar['yuzde'] = $ozel['yuzde'];
                                           
                                       }
                                         
                                       if ($bonuslar['category'] == 1) {
                                           $category = 'Spor';
                                           if (!isset($bonuslar_array['SPOR KAYIP BONUSLARI'])) {
                                               $bonuslar_array['SPOR KAYIP BONUSLARI'] = array();
                                           }
                                           $arr = array(
                                                'bonus_id' => $bonuslar['id'],
                                                'bonus_name' => '%'.$bonuslar['yuzde'].' '.$bonuslar['bonus_adi'],
                                                'bonus_category' => $category,
                                                'contract' => $bonuslar['kurallar'],
                                                'yuzde' => $bonuslar['yuzde'],
                                            );  
                                            array_push($bonuslar_array['SPOR KAYIP BONUSLARI'],$arr);
                                       }

                                        if ($bonuslar['category'] == 2) {
                                           $category = 'Casino';
                                           if (!isset($bonuslar_array['CASİNO KAYIP BONUSLARI'])) {
                                               $bonuslar_array['CASİNO KAYIP BONUSLARI'] = array();
                                           }
                                           $arr = array(
                                                'bonus_id' => $bonuslar['id'],
                                                'bonus_name' => '%'.$bonuslar['yuzde'].' '.$bonuslar['bonus_adi'],
                                                'bonus_category' => $category,
                                                'contract' => $bonuslar['kurallar'],
                                                'yuzde' => $bonuslar['yuzde'],
                                            );  
                                            array_push($bonuslar_array['CASİNO KAYIP BONUSLARI'],$arr);
                                           
                                       }

                                        if ($bonuslar['category'] == 3) {
                                          
                                            $category = 'Betgames';
                                           if (!isset($bonuslar_array['BETGAMES KAYIP BONUSLARI'])) {
                                               $bonuslar_array['BETGAMES KAYIP BONUSLARI'] = array();
                                           }
                                            
                                           $arr = array(
                                                'bonus_id' => $bonuslar['id'],
                                                'bonus_name' => '%'.$bonuslar['yuzde'].' '.$bonuslar['bonus_adi'],
                                                'bonus_category' => $category,
                                                'contract' => $bonuslar['kurallar'],
                                                'yuzde' => $bonuslar['yuzde'],
                                            );  
                                            array_push($bonuslar_array['BETGAMES KAYIP BONUSLARI'],$arr);
                                           
                                       } 

                                       if ($bonuslar['category'] == 4) {
                                           $category = 'Slot';
                                           if (!isset($bonuslar_array['SLOT KAYIP BONUSLARI'])) {
                                               $bonuslar_array['SLOT KAYIP BONUSLARI'] = array();
                                           }
                                           $arr = array(
                                                'bonus_id' => $bonuslar['id'],
                                                'bonus_name' => '%'.$bonuslar['yuzde'].' '.$bonuslar['bonus_adi'],
                                                'bonus_category' => $category,
                                                'contract' => $bonuslar['kurallar'],
                                                'yuzde' => $bonuslar['yuzde'],
                                            );  
                                            array_push($bonuslar_array['SLOT KAYIP BONUSLARI'],$arr);
                                           
                                       } 

                                       if ($bonuslar['category'] == 5) {
                                           $category = 'S. Spor';
                                           if (!isset($bonuslar_array['SANAL SPOR KAYIP BONUSLARI'])) {
                                               $bonuslar_array['SANAL SPOR KAYIP BONUSLARI'] = array();
                                           }
                                           $arr = array(
                                                'bonus_id' => $bonuslar['id'],
                                                'bonus_name' => '%'.$bonuslar['yuzde'].' '.$bonuslar['bonus_adi'],
                                                'bonus_category' => $category,
                                                'contract' => $bonuslar['kurallar'],
                                                'yuzde' => $bonuslar['yuzde'],
                                            );  
                                            array_push($bonuslar_array['SANAL SPOR KAYIP BONUSLARI'],$arr);
                                           
                                       }
                                        
                                       
                                     }
                                     
                                      $delete = $db->prepare('DELETE FROM istek_blok WHERE player_id = ?');
                                      $delete->execute(array($player_id));
                                     
                                      $json = array(
                                        'status' => 'success',
                                        'message' => 'Başarılı.',
                                        'deposit' => $deposits['Data']['Documents']['Objects'][0]['Amount'],
                                        'bonuslar' => $bonuslar_array,
                                    );
                                     
                                 }
                             }

                        } else {
                             $delete = $db->prepare('DELETE FROM istek_blok WHERE player_id = ?');
                             $delete->execute(array($player_id));
                            
                               $json = array(
                                    'status' => 'error',
                                    'message' => 'Ödeme yöntemi bulunamadı. - ',
                                   'info' => ''
                                ); 
                        }
                  } else {
                     
                     $delete = $db->prepare('DELETE FROM istek_blok WHERE player_id = ?');
                     $delete->execute(array($player_id));
                     
                     $json = array(
                        'status' => 'error',
                        'message' => 'Yatırımınızdan önceki 24 saat içerisinde çekim işleminiz olduğu için, yatırım bonuslarından yararlanamamaktasınız.',
                         'info' => ''
                    );
                  }
             } else {
                 $delete = $db->prepare('DELETE FROM istek_blok WHERE player_id = ?');
                 $delete->execute(array($player_id));
                 $json = array(
                    'status' => 'error',
                    'message' => 'Son yatırım işleminiz için zaten bir bonustan yararlandınız. Eğer kullanmadıysanız <strong>Bonuslar</strong> menüsünden aktifleştirerek kullanabilirsiniz.',
                     'info' => ''
                );
             }
         } else {
             if ($bonus_type == 1) {
                $delete = $db->prepare('DELETE FROM istek_blok WHERE player_id = ?');
                $delete->execute(array($player_id));
                $json = array(
                    'status' => 'error',
                    'message' => '48 saat içerisinde bir yatırımınız bulunmamaktadır.',
                    'info' => ''
                );
             } else {
                 $delete = $db->prepare('DELETE FROM istek_blok WHERE player_id = ?');
                 $delete->execute(array($player_id));
                 $json = array(
                    'status' => 'error',
                    'message' => 'Son bir hafta içerisinde yatırım işleminiz bulunmamaktadır.',
                     'info' => ''
                );
             }
         }
            
        $delete = $db->prepare('DELETE FROM istek_blok WHERE player_id = ?');
        $delete->execute(array($player_id));
          
        echo json_encode($json);
            
        $delete = $db->prepare('DELETE FROM istek_blok WHERE player_id = ?');
        $delete->execute(array($player_id));    
            
        die();
            
        $data = '{"StartTimeLocal":"'.date('d-m',strtotime('-24 hours')).'-20 - '.date('H:i',strtotime('-24 hours')).':00","EndTimeLocal":"'.date('d-m').'-20 - 23:59:59","ClientId":'.$player_id.',"CurrencyId":"TRY","MaxRows":100,"PaymentSystemId":null,"GameId":null,"DocumentTypeId":1}';
        $cekim_talebi = curl_json('https://backofficewebadmin.betconstruct.com/api/en/Client/GetClientTransactions',$data);
        if ($cekim_talebi['AlertType'] == 'success') {
            if ($cekim_talebi['Data']['Count'] == 0) {
                    if ($deposits['AlertType'] == 'success') {
                        if (isset($deposits['Data']['Documents']['Objects'][0])) {
                            $deposit_data = $deposits['Data']['Objects'][0];
                            $query = $db->prepare('SELECT * FROM winx_alinan_bonuslar WHERE deposit_id = ? LIMIT 1');
                            $query->execute(array($deposit_data['ExternalId']));
                            if ($query->rowCount() == 0) {

                                $hosgeldin = 0;

                                if ($deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] == 'BankTransfer') {
                                    $deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] = 'Havale';
                                }

                                if ($deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] == 'PayGiga') {
                                    $deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] = 'Paygiga';
                                    $id = $deger['Note'];
                                }

                                if ($deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] == 'BestPayCepBank') {
                                    $deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] = 'Bestpaycepbank';
                                }

                                if ($deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] == 'ExpressHavale') {

                                    $id = $deger['Note'];
                                    $explode = explode('transactionId:',$deposits['Data']['Documents']['Objects'][0]['Note']);
                                    $explode = explode('detail:',$explode[1]);

                                    $islem_id = $explode[0];
                                    $ch = curl_init();
                                    curl_setopt($ch, CURLOPT_URL, 'https://expresshavale.com/kanyon_query.php?id='.$islem_id);
                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

                                    $headers = array();
                                    $headers[] = 'Sec-Fetch-Mode: cors';
                                    $headers[] = 'Origin: https://betkanyon.admindigi.com';
                                    $headers[] = 'Accept-Language: en';
                                    $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
                                    $headers[] = 'Referer: https://betkanyon.admindigi.com/';
                                    $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36';
                                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                                    $result = json_decode(curl_exec($ch),true);
                                    curl_close ($ch);

                                    $deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] = $result['method'];
                                }

                                if ($deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] == 'BestPayBankTransfer') {
                                    $deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] = 'Hızlı Havale';
                                }

                                if ($deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] == 'CoinPayments') {
                                    $deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] = 'Kripto Para';
                                }

                                if ($deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] == 'KolayHavale') {
                                    $deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] = 'Hızlı Havale';
                                }


                                if ($deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] == 'EnvoySoftAutomatic') {
                                    $deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] = 'Hızlı Havale';
                                }


                                if ($deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] == 'CMTPayturka') {
                                    $deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] = 'CMT Cüzdan';
                                }

                                if ($deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] == 'JetonV3') {
                                    $deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] = 'Jeton';
                                }


                                if ($deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] == 'HizliQR') {
                                    $deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] = 'Hızlı QR';
                                }

                                if ($deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] == 'CepBank') {
                                    $deposits['Data']['Documents']['Objects'][0]['PaymentSystemName'] = 'Cepbank';
                                }

                                $profile = curl_json('https://backofficewebadmin.betconstruct.com/api/en/Client/GetClientKpi?id='.$player_id,'','GET');
                                if ($profile['AlertType'] == 'success') {
                                    if ($profile['Data'][0]['DepositCount'] == 0) {
                                        $hosgeldin = 1;
                                    }

                                    $alinabilecek_bonuslar = array();

                                    $method_query = $db->prepare('SELECT * FROM yontemler WHERE name = ? LIMIT 1');
                                    $method_query->execute(array(addslashes(strip_tags($deposits['Data']['Documents']['Objects'][0]['PaymentSystemName']))));
                                    if ($method_query->rowCount() != 0) {
                                        $method_query = $method_query->fetch(PDO::FETCH_ASSOC);
                                        $bonuslar = $db->prepare('SELECT * FROM winx_bonuslar WHERE method_id LIKE "%,'.$method_query['id'].',%"');
                                        $bonuslar->execute(array());
                                        $bonuslar = $bonuslar->fetchAll(PDO::FETCH_ASSOC);

                                            
                                        
                                        $bonuslar_array = array();
                                        $bonuslar_array['ÇEVRİMLİ BONUSLAR'] = array();
                                        $bonuslar_array['ÇEVRİMSİZ BONUSLAR'] = array();
                                        $bonuslar_array['HOŞGELDİN BONUSLARI'] = array();

                                        foreach ($bonuslar as $bonuslar) {

                                            if ($bonuslar['category'] == 1) {
                                                $category = 'Spor';
                                            } else if ($bonuslar['category'] == 2) {
                                                $category = 'Casino';
                                            }

                                            if ($bonuslar['bonus_type'] == 1) {
                                                $arr = array(
                                                    'bonus_id' => $bonuslar['id'],
                                                    'bonus_name' => $bonuslar['bonus_adi'],
                                                    'bonus_category' => $category,
                                                    'contract' => $bonuslar['kurallar'],
                                                    'yuzde' => $bonuslar['yuzde'],
                                                );  
                                                array_push($bonuslar_array['ÇEVRİMLİ BONUSLAR'],$arr);
                                            }

                                            if ($bonuslar['bonus_type'] == 2) {
                                                
                                                if ($category_id == 31) {
                                                    $bonuslar['yuzde'] = 20;
                                                    $bonuslar['bonus_adi'] = "%20 ÇEVRİMSİZ SPOR YATIRIM BONUSU";
                                                }
                                                
                                                $arr = array(
                                                    'bonus_id' => $bonuslar['id'],
                                                    'bonus_name' => $bonuslar['bonus_adi'],
                                                    'bonus_category' => $category,
                                                    'contract' => $bonuslar['kurallar'],
                                                    'yuzde' => $bonuslar['yuzde'],
                                                );  
                                                array_push($bonuslar_array['ÇEVRİMSİZ BONUSLAR'],$arr);
                                            }

                                            if ($bonuslar['bonus_type'] == 4 and $hosgeldin == 1) {
                                                $arr = array(
                                                    'bonus_id' => $bonuslar['id'],
                                                    'bonus_name' => $bonuslar['bonus_adi'],
                                                    'bonus_category' => $category,
                                                    'contract' => $bonuslar['kurallar'],
                                                    'yuzde' => $bonuslar['yuzde'],
                                                );  
                                                array_push($bonuslar_array['HOŞGELDİN BONUSLARI'],$arr);
                                            }
                                        }

                                        $json = array(
                                            'status' => 'success',
                                            'message' => 'Başarılı.',
                                            'deposit' => $deposits['Data']['Documents']['Objects'][0]['Amount'],
                                            'bonuslar' => $bonuslar_array,
                                        );

                                    } else {
                                        $json = array(
                                            'status' => 'error',
                                            'message' => 'Bu ödeme yöntemine ait bonus bulunamadı!'
                                        );
                                    }
                                } else {
                                    $json = array(
                                        'status' => 'error',
                                        'message' => 'Profil bilgisi alınamadı.'
                                    );
                                }
                            } else {
                                $json = array(
                                    'status' => 'error',
                                    'message' => 'Son yatırımınız için zaten bonus almışsınız.'
                                );
                            }
                        } else {
                            $json = array(
                                'status' => 'error',
                                'message' => 'Son 48 saat içinde yatırımınız bulunmamaktadır.'
                            );
                        }
                    } else {
                        $json = array(
                            'status' => 'error',
                            'message' => 'Bir hata oluştu, lütfen tekrar deneyin. 2',
                            'data' => $deposits
                        );
                    }
                } else {
                    $json = array(
                        'status' => 'error',
                        'message' => 'Son 24 saat içinde yatırımınız bulunmuştur.'
                    );
                }
            } else {
                $json = array(
                    'status' => 'error',
                    'message' => 'Bir hata oluştu tekrar deneyin. 1',
                    'data' => $cekim_talebi
                );
            }
        }
        
        $delete = $db->prepare('DELETE FROM istek_blok WHERE player_id = ?');
        $delete->execute(array($player_id));
        
        // echo json_encode($json);
    
    }
?>