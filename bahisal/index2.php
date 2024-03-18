<?php

    ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

    header("Access-Control-Allow-Origin: *");
    header('Content-Type:application/json');
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

    function curl_json($url,$data,$method = 'post'){
            $while = 0;
            $i = 0;
            do {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                if ($method == 'post') {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($ch, CURLOPT_POST, 1);
                }
                $headers = array();
                $headers[] = 'Connection: keep-alive';
                $headers[] = 'Cache-Control: max-age=0';
                $headers[] = 'Upgrade-Insecure-Requests: 1';
                $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36';
                $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
                $headers[] = 'Sec-Fetch-Site: none';
                $headers[] = 'Sec-Fetch-Mode: navigate';
                $headers[] = 'Sec-Fetch-User: ?1';
                $headers[] = 'Sec-Fetch-Dest: document';
                $headers[] = 'Accept-Language: tr-TR,tr;q=0.9,en-US;q=0.8,en;q=0.7';
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                $result = curl_exec($ch);
                if (curl_errno($ch)) {
                    echo 'Error:' . curl_error($ch);
                }
                curl_close ($ch);
                $decode = json_decode($result,true);
                if (isset($decode['status'])) {
                    return $decode;
                    $while = 1;
                } else {
                    $while = 0;
                }
                if ($i >= 0) {
                    $while = 1;
                }
                
                $i++;
            } while ($while == 0);
    }
    function minusHour($date,$hour,$plus) {
        if ($plus == '+') {
            //$hour = $hour + 4;
            return date('d.m.Y H:i:s', strtotime('+'.$hour.' days', strtotime($date)));
        } else {
            //$hour = $hour + 3;
            return date('d.m.Y H:i:s', strtotime('-'.$hour.' days', strtotime($date)));
        }
    }

    function minusHour2($date) {
        return date('Y-m-d H:i:s', strtotime('+3 hours', strtotime($date)));
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
        
        $category = $db->prepare('SELECT * FROM bahisal_user_category WHERE player_id = ? LIMIT 1');
        $category->execute(array($player_id));
        if ($category->rowCount() == 0) {
            $categoryId = 0;
        } else {
            $category = $category->fetch(PDO::FETCH_ASSOC);
            $categoryId = $category['category_id'];
        }
        
        if ($categoryId == 7) {
            $json = array(
                'status' => 'error',
                'message' => 'Bonus hakkınız yoktur, bir yanlışlık olduğunu düşünüyorsanız Canlı Destek ile iletişime geçebilirsiniz.',
                'info' => ''
            );
            echo json_encode($json);
        } else {
             if ($bonus_type == 1) {
                 $saat = 2;
             } else {
                 $saat = 7;
             }
             $data = array(
                    "id" => $_GET['id'],
                    "type" => "Deposit",
                    "status" => "Tamamlandı",
                    "date1" => minusHour(date('d.m.Y 00:00:00'),$saat,'-'),
                    "date2" => date('d.m.Y 23:59:59')
             );
             $deposits = curl_json('http://software2.betkanyon100.com/pro-api/GetTrans.php',json_encode($data));
            
             if ($deposits['status'] == "success") {
                 if (count($deposits['deposits']) != 0) {
                     $query = $db->prepare('SELECT id FROM bahisal_alinan_bonuslar WHERE deposit_id = ? LIMIT 1');
                     $query->execute(array($deposits['deposits'][0]['id']));
                     $dis_query =$db->prepare('SELECT id FROM bahisal_kayip_bonusu WHERE deposit_id = ? LIMIT 1');
                     $dis_query->execute(array($deposits['deposits'][0]['id']));
                     if ($query->rowCount() == 0 and $dis_query->rowCount() == 0) {
                        $data = array(
                              "id" => $_GET['id'],
                              "viewState" => $deposits['viewState']
                        );
                        $activedBonus = curl_json('http://software2.betkanyon100.com/pro-api/GetActivedBonus.php',json_encode($data));
                        if ($activedBonus['status'] == 'success') {
                            if (count($activedBonus['actived_bonus']) != 0) {
                                $json = array(
                                    'status' => 'error',
                                    'message' => 'Aktif bir bonusunuz bulunduğu için bonus alamamaktasınız. Lütfen bonusunuzu iptal ettikten sonra tekrar deneyin..',
                                    'info' => 'acik_bonus'
                                );
                                echo json_encode($json);
                                die();
                            } 
                        } else {
                            echo json_encode($activedBonus);
                            die();
                        }
                         
                         $data = array(
                              "id" => $_GET['id'],
                              "customerId" => $_GET['customerCode'],
                              "viewState" => $deposits['viewState']
                         );
                         
                         $profile = curl_json('http://software2.betkanyon100.com/pro-api/GetProfile.php',json_encode($data));
                         
                         if ($profile['status'] == "success") {
                             if ($bonus_type == 2) {
                                 $acik_bahis = 0;
                                 $cekims = 0;
                                 if ($profile['open_bet'] != 0) {
                                       $acik_bahis = 1;
                                 }
                             } else {
                                  $acik_bahis = 0;
                                  $cekims = 0;
                                  $data = array(
                                        "id" => $_GET['id'],
                                        "type" => "Withdraw",
                                        "status" => "Tamamlandı",
                                        "date1" => minusHour(date('d.m.Y 00:00:00'),1,'-'),
                                        "date2" => date('d.m.Y 23:59:59'),
                                        "viewState" => $deposits['viewState']
                                 );
                                 $withdraw = curl_json('http://software2.betkanyon100.com/pro-api/GetTrans.php',json_encode($data));
                                 if (count($withdraw['deposits']) != 0) {
                                     $cekims = 1;
                                 } 
                             }
                             
                             if ($bonus_type == 1) {
                                 if (strtotime($profile['last_spor_bet']) > strtotime($deposits['deposits'][0]['date']) or strtotime($profile['last_casino_bet']) > strtotime($deposits['deposits'][0]['date'])) {
                                    $json = array(
                                        'status' => 'error',
                                        'message' => 'Yatırımınızdan sonra bahis aldığınız için yatırım bonusu alamamaktasınız.',
                                        'info' => ''
                                    );
                                    echo json_encode($json);
                                    die();
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
                                 $gunluk_cevrimsiz = $db->prepare('SELECT COALESCE(SUM(bonus_amount),0) as total FROM bahisal_alinan_bonuslar WHERE bonus_category = 2 and player_id = ? and created_date LIKE "%'.date('Y-m-d').'%" LIMIT 10');
                                 $gunluk_cevrimsiz->execute(array($player_id));
                                 $gunluk_cevrimsiz = $gunluk_cevrimsiz->fetch(PDO::FETCH_ASSOC);
                                 if ($gunluk_cevrimsiz['total'] >= $gunluk_cevrimsiz_limit) {
                                     $gunluk_cevrimsiz_dolu = 1;
                                 }

                                 $gunluk_cevrimli = $db->prepare('SELECT COALESCE(SUM(bonus_amount),0) as total FROM bahisal_alinan_bonuslar WHERE bonus_category = 1 and player_id = ? and created_date LIKE "%'.date('Y-m-d').'%" LIMIT 10');
                                 $gunluk_cevrimli->execute(array($player_id));
                                 $gunluk_cevrimli = $gunluk_cevrimli->fetch(PDO::FETCH_ASSOC);
                                 if ($gunluk_cevrimli['total'] >= $gunluk_cevrimli_limit) {
                                     $gunluk_cevrimli_dolu = 1;
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
                             
                             
                             if ($profile['sport_balance']+$profile['casino_balance'] > 3 and $bonus_type == 2) {
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
                                     if ($deposits['deposits'][0]['method'] == 'ExpressPapara Deposit') {
                                         $deposits['deposits'][0]['method'] = 'Papara';
                                     }

                                     $method_query = $db->prepare('SELECT * FROM bahisal_yontemler WHERE name = ? LIMIT 1');
                                     $method_query->execute(array(addslashes(strip_tags($deposits['deposits'][0]['method']))));
                                     if ($method_query->rowCount() != 0) {
                                          if ($bonus_type == 1) {
                                              $hosgeldin = 0;
                                              if ($profile['deposit_count'] == 1) {
                                                    $hosgeldin = 1;
                                              }
                                              
                                              $method_query = $method_query->fetch(PDO::FETCH_ASSOC);
                                              $bonuslar = $db->prepare('SELECT * FROM bahisal_bonuslar WHERE method_id LIKE "%,'.$method_query['id'].',%" and bonus_type <> 6 order by sira asc');
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
                                                   $ozel = $db->prepare('SELECT * FROM bahisal_ozel_anlasmalar WHERE bonus_id = ? and player_id = ? LIMIT 1');
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
                                                            'whereis' => $bonuslar['whereis'],
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
                                                            $gunluk_cevrimli['total'],
                                                            $bonuslar['whereis']
                                                        );
                                                        array_push($bonuslar_array['ÇEVRİMLİ BONUSLAR'],$arr);
                                                    }

                                                    if ($bonuslar['bonus_type'] == 2) {
                                                        if ($gunluk_cevrimsiz_dolu == 0) {

                                                            $arr = array(
                                                                'bonus_id' => $bonuslar['id'],
                                                                'whereis' => $bonuslar['whereis'],
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
                                                                $gunluk_cevrimsiz['total'],
                                                                $bonuslar['whereis']
                                                            );
                                                            array_push($bonuslar_array['ÇEVRİMSİZ BONUSLAR'],$arr);
                                                        }
                                                    }

                                                    if ($bonuslar['bonus_type'] == 4 and $hosgeldin == 1) {
                                                        $arr = array(
                                                            'bonus_id' => $bonuslar['id'],
                                                            'whereis' => $bonuslar['whereis'],
                                                            'bonus_name' => '%'.$bonuslar['yuzde'].' '.$bonuslar['bonus_adi'],
                                                            'bonus_category' => $category,
                                                            'contract' => $bonuslar['kurallar'],
                                                            'daily_limit' => 0,
                                                            'yuzde' => $bonuslar['yuzde'],
                                                        );  
                                                        $gecerli_bonuslar[$bonuslar['id']] = $bonuslar['yuzde'];
                                                        $partner_bonus_id[$bonuslar['id']] = array(
                                                            $bonuslar['partner_bonus_id'],
                                                            $bonuslar['bonus_type'],
                                                            $gunluk_cevrimli['total'],
                                                            $bonuslar['whereis']
                                                        );
                                                        array_push($bonuslar_array['HOŞGELDİN BONUSLARI'],$arr);
                                                    }
                                                }
                                              
                                               if (@$_GET['onay']) {
                                                         $bonus_id = addslashes(strip_tags($_GET['onay']));
                                                         if (isset($gecerli_bonuslar[$bonus_id])) {
                                                             $bonus_amount = $deposits['deposits'][0]['amount'] / 100;
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
                                                             
                                                             if ($partner_bonus_id[$bonus_id][3] == 1) {
                                                                 $data = array(
                                                                        "id" => $_GET['id'],
                                                                        "bonus_id" => $partner_bonus_id[$bonus_id][0],
                                                                        "amount" => $bonus_amount,
                                                                        "viewState" => $deposits['viewState']
                                                                 );
                                                                 $bonus = curl_json('http://software2.betkanyon100.com/pro-api/CreateBonusSpor.php',json_encode($data));
                                                                 if ($bonus['status'] == "success") {
                                                                     $insert = $db->prepare('INSERT INTO bahisal_alinan_bonuslar (deposit_id,bonus_id,created_date,amount,bonus_amount,bonus_category,player_id,ip) values (?,?,?,?,?,?,?,?)');
                                                                     $insert->execute(array($deposits['deposits'][0]['id'],$bonus_id,date('Y-m-d H:i:s'),$deposits['deposits'][0]['amount'],$bonus_amount,$partner_bonus_id[$bonus_id][1],$player_id,$_SERVER['REMOTE_ADDR']));
                                                                     $json = array(
                                                                            'status' => 'success',
                                                                            'message' => 'Bonusunuz başarıyla tanımlanmıştır. <strong>Bonuslar</strong> menüsünden bonusunuzu <strong>aktif etmeniz</strong> gerekmektedir.',
                                                                            'server_response' => $bonus['message'],
                                                                             'info' => ''
                                                                     ); 
                                                                 } else {
                                                                     $json = array(
                                                                        'status' => 'error',
                                                                        'message' => 'Bonus eklenirken bir hata oluştu.',
                                                                        'info' => ''
                                                                    ); 
                                                                 }
                                                             } else {
                                                                 $data = array(
                                                                        "customerID" => $_GET['customerCode'],
                                                                        "bonusID" => $partner_bonus_id[$bonus_id][0],
                                                                        "amount" => $bonus_amount,
                                                                 );
                                                                  
                                                                 $bonus = curl_json('http://software2.betkanyon100.com/pro-api/CreateBonusCasino.php',json_encode($data));
                                                                 
                                                                 if ($bonus['status'] == "success") {
                                                                     $insert = $db->prepare('INSERT INTO bahisal_alinan_bonuslar (deposit_id,bonus_id,created_date,amount,bonus_amount,bonus_category,player_id,ip) values (?,?,?,?,?,?,?,?)');
                                                                     $insert->execute(array($deposits['deposits'][0]['id'],$bonus_id,date('Y-m-d H:i:s'),$deposits['deposits'][0]['amount'],$bonus_amount,$partner_bonus_id[$bonus_id][1],$player_id,$_SERVER['REMOTE_ADDR']));
                                                                     $json = array(
                                                                            'status' => 'success',
                                                                            'message' => 'Bonusunuz başarıyla tanımlanmıştır. <strong>Bonuslar</strong> menüsünden bonusunuzu <strong>aktif etmeniz</strong> gerekmektedir.',
                                                                            'server_response' => $bonus['message'],
                                                                             'info' => ''
                                                                     ); 
                                                                 } else {
                                                                     $json = array(
                                                                        'status' => 'error',
                                                                        'message' => $bonus['message'],
                                                                        'server_response' =>  $bonus,
                                                                        'info' => ''
                                                                    ); 
                                                                 }
                                                             }
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
                                                        $json = array(
                                                            'status' => 'success',
                                                            'message' => 'Başarılı.',
                                                            'method_id' => $method_query['id'],
                                                            'deposit' => $deposits['deposits'][0]['amount'],
                                                            'gunluk_cevrimsiz_limit' => $gunluk_cevrimsiz_limit,
                                                            'gunluk_cevrimli_limit' => $gunluk_cevrimli_limit,
                                                            'bonuslar' => $bonuslar_array,
                                                        );
                                                    }
                                              
                                          } else {
                                                if (isset($_GET['onay'])) {
                                                     $bonus_id = addslashes(strip_tags($_GET['onay']));
                                                     $dquery = $db->prepare('SELECT * FROM bahisal_bonuslar WHERE bonus_type = ? and aktif = ? and id = ? LIMIT 1');
                                                     $dquery->execute(array(6,1,$bonus_id));
                                                     if ($dquery->rowCount() != 0) {
                                                         $insert = $db->prepare('INSERT INTO bahisal_kayip_bonusu (user_id,bonus_id,created_date,finished_date,accept_user,status,amount,yuzde,eklenen,deposit_id,customerId) values (?,?,?,?,?,?,?,?,?,?,?)');
                                                         $insert->execute(array($player_id,$bonus_id,date('Y-m-d H:i:s'),'',0,0,0,0,0,$deposits['deposits'][0]['id'],addslashes(strip_tags($_GET['customerCode']))));
                                                         $json = array(
                                                            'status' => 'success',
                                                            'message' => 'Kayıp Bonusu talebiniz başarıyla alındı. Kayıp bonusu kurallarına uygun olarak <strong>bonus hakkınız var ise</strong>, kısa süre sonra hesabınıza aktarılacaktır.'
                                                         );
                                                     } else {
                                                          $delete = $db->prepare('DELETE FROM istek_blok WHERE player_id = ?');
                                                          $delete->execute(array($player_id));
                                                          $json = array(
                                                            'status' => 'error',
                                                            'message' => 'Bu kayıp bonusu şuanda aktif değil.',
                                                            'info' => ''
                                                          );
                                                     }
                                                     $json = array(
                                                        'status' => 'success',
                                                        'message' => 'Kayıp bonusu talebiniz başarıyla alınmıştır, kısa süre içerisinde sonuçlanacaktır.',
                                                    );
                                                 } else {
                                                     $bonuslar = $db->prepare('SELECT * FROM bahisal_bonuslar WHERE bonus_type = 6 and aktif = 1 order by sira asc');
                                                     $bonuslar->execute(array());

                                                     foreach ($bonuslar->fetchAll(PDO::FETCH_ASSOC) as $bonuslar) {

                                                       $ozel = $db->prepare('SELECT * FROM bahisal_ozel_anlasmalar WHERE bonus_id = ? and player_id = ? LIMIT 1');
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

                                                      $json = array(
                                                        'status' => 'success',
                                                        'message' => 'Başarılı.',
                                                        'deposit' => $deposits['deposits'][0]['amount'],
                                                        'bonuslar' => $bonuslar_array,
                                                    );

                                                 }
                                          }
                                     } else {
                                           $json = array(
                                                'status' => 'error',
                                                'message' => 'Ödeme yöntemi bulunamadı. - ',
                                                'info' => ''
                                           ); 
                                     }
                             } else {
                                 $json = array(
                                    'status' => 'error',
                                    'message' => '24 saat içinde çekiminiz olduğu için yatırım bonusundan yararlanamıyorusunuz.',
                                    'data' => $withdraw['deposits']
                                 );
                             }
                         } else {
                             $json = array(
                                'status' => 'error',
                                'message' => 'Sunucu tarafında bir hata oluştu, lütfen tekrar deneyin. (Hata Kodu : 51)',
                                'info' => '',
                             );
                         }
                     } else {
                         $json = array(
                            'status' => 'error',
                            'message' => 'Daha önce bonus aldığınız için hakkınız bulunmamaktadır.',
                             'info' => '',
                         );
                     }
                 } else {
                     $json = array(
                        'status' => 'error',
                        'message' => 'Son 48 saat içerisinde bir yatırımınız bulunmamaktadır.',
                         'info' => '',
                    );
                 }
             } else {
                 $json = array(
                    'status' => 'error',
                    'message' => 'Sunucu tarafında bir hata oluştu, lütfen tekrar deneyin. (Hata Kodu : 49)',
                     'data' => $deposits,
                     'info' => '',
                 );
                
             }
        }
        
        echo json_encode($json);
    }
?>  


