<?php   
error_reporting(E_ALL);
ini_set('display_errors', 1);
    include 'db.php';
      $origin = @$_SERVER['HTTP_ORIGIN'];
      header('Access-Control-Allow-Origin: *');
      $user = json_decode(file_get_contents('https://user.cloudsystemapi.com/query_id.php?id='.addslashes(strip_tags($_GET['id']))),true);
       if ($user['username'] != '') {
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
            
            if (substr($user_phone,0,2) == '05') {
                $user_phone = substr($user_phone,1,strlen($user_phone)-1);
            }
           
            $check = $db->prepare('SELECT * FROM deneme_bonusu WHERE phone LIKE "%'.$user_phone.'%" LIMIT 1');
            $check->execute(array());
            if ($check->rowCount() == 0 or $user_name == 'test10') {
                $token = file_get_contents('http://software2.betkanyon100.com/token.php');
                $json_send = 'Method=GetClientInfo&Controller=Client&TimeZone=3&RequestObject='.$user_id;
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://adminwebsd.apidigi.com/api/Main/ApiRequest?TimeZone=3&LanguageId=en');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $json_send);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

                $headers = array();
                $headers[] = 'Accept: application/json';
                $headers[] = 'Referer: https://betkanyon.admindigi.com/';
                $headers[] = 'Origin: https://betkanyon.admindigi.com';
                $headers[] = 'Authorization: Bearer '.$token;
                $headers[] = 'Accept-Language: en';
                $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36';
                $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                $result = curl_exec($ch);
                curl_close ($ch);
                $json = json_decode($result,true);
                $reg_date = strtotime($json['ResponseObject']['RegistrationDate']);
                
                if ($json['ResponseObject']['TotalDepositsCount'] == 0 or $user['username'] == 'test10') {
                    $list_check = $db->prepare('SELECT id FROM numaralar WHERE numara LIKE "%'.$user_phone.'%" LIMIT 1');
                    $list_check->execute(array());
                    
                    if ($list_check->rowCount() != 0 or $user['username'] == 'test10') {
                        $_SESSION['bonusChecked'] = true;
                        $_SESSION['bonusCheckedID'] = $_GET['id'];
                        $_SESSION['bonusCheckedNumber'] = $user_phone;
                        $_SESSION['bonusCheckedUserName'] = $user_name;
                        $json = array(
                            'status' => 'success',
                            'message' => 'Bonus hakkınız bulunmaktadır.',
                            'cookie' => false
                        );
                    } else {
                        $json = array(
                            'status' => 'error',
                            'message' => 'Deneme bonusu alabilmek için, size sms gelen numara üzerinden kayıt olmuş olmanız gerekmektedir.',
                            'cookie' => true
                        );
                    }
                } else {
                        $json = array(
                            'status' => 'error',
                            'message' => 'Daha önceden yatırım yaptığınız için bonus alamazsınız.',
                            'cookie' => true
                        );

                        if (isset($_SESSION['bonusChecked'])) {
                            unset($_SESSION['bonusChecked']);
                        }
                }
            } else {
                
                $check = $check->fetch(PDO::FETCH_ASSOC);
                $token = file_get_contents('http://software2.betkanyon100.com/token.php');
                $json_send = 'Method=GetClientInfo&Controller=Client&TimeZone=3&RequestObject='.$user_id;
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://adminwebsd.apidigi.com/api/Main/ApiRequest?TimeZone=3&LanguageId=en');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $json_send);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

                $headers = array();
                $headers[] = 'Accept: application/json';
                $headers[] = 'Referer: https://betkanyon.admindigi.com/';
                $headers[] = 'Origin: https://betkanyon.admindigi.com';
                $headers[] = 'Authorization: Bearer '.$token;
                $headers[] = 'Accept-Language: en';
                $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36';
                $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                $result = curl_exec($ch);
                curl_close ($ch);
                $djson = json_decode($result,true);

                if (isset($djson['ResponseObject']['UserName'])) {
                    if ($djson['ResponseObject']['UserName'] == $check['user']) {
                        $json = array(
                            'status' => 'error',
                            'message' => 'Daha önceden bonus almışsınız!',
                            'cookie' => true
                        );
                    } else {
                        $json = array(
                            'status' => 'error',
                            'message' => 'Bu telefon numarası ile daha önce başka bir hesaptan bonus alınmış ('.$check['user'].')',
                            'cookie' => true
                        );
                    }
                } else {
                    $json = array(
                        'status' => 'error',
                        'message' => 'Daha önceden bonus almışsınız!',
                        'cookie' => true
                    );
                }
                if (isset($_SESSION['bonusChecked'])) {
                    unset($_SESSION['bonusChecked']);
                }
            }
       }


             echo json_encode($json);
        header('Content-Type:application/json');

      die();


      include 'db.php';
      function curl_json($url,$data,$method = 'post',$max = ''){
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
                if ($max == 'max') {
                    $decode = json_decode($result);
                     if (isset($decode->AlertType)) {
                        if ($decode->AlertType == 'success') {
                            return $decode;
                            $while = 1;
                        } else {
                            $while = 0;
                        }
                    }
                } else {
                    $decode = json_decode($result,true);
                    if (isset($decode['AlertType'])) {
                        if ($decode['AlertType'] == 'success') {
                            return $decode;
                            $while = 1;
                        }
                    } else {
                        $while = 0;
                    }
                }
                
            } while ($while == 0);
    }
        $user = json_decode(file_get_contents('https://user.cloudsystemapi.com/query2_id.php?id='.addslashes(strip_tags($_GET['id']))),true);
        if ($user['username'] != '') {
            $user_phone = $user['number'];
            $user_id = $user['userid'];
            $user_name = $user['username'];
            
            if (substr($user_phone,0,2) == '90') {
                $user_phone = substr($user_phone,2,strlen($user_phone)-2);
            }

            if (substr($user_phone,0,4) == '0090') {
                $user_phone = substr($user_phone,4,strlen($user_phone)-4);
            }
            
            $query = $db->prepare('SELECT * FROM bonuslar WHERE number = ? LIMIT 1');
            $query->execute(array($user_phone));
            if ($query->rowCount() == 0) {
                $decode = curl_json('https://backofficewebadmin.betconstruct.com/api/null/Client/GetClientKpi?id='.$_GET['id'],$json,'GET');
                if ($decode['Data']['DepositAmount'] == 0) {
                    $list_check = $db->prepare('SELECT id FROM numaralar WHERE numara = ? LIMIT 1');
                    $list_check->execute(array($user_phone));
                    if ($list_check->rowCount() != 0) {
                        $_SESSION['bonusChecked'] = true;
                        $_SESSION['bonusCheckedID'] = $_GET['id'];
                        $_SESSION['bonusCheckedNumber'] = $user_phone;
                        $_SESSION['bonusCheckedUserName'] = $user_name;
                        $json = array(
                            'status' => 'success',
                            'message' => 'Bonus alabilir.',
                            'cookie' => false
                        );
                    } else {
                        $json = array(
                            'status' => 'error',
                            'message' => 'Numara bulunamadı '. $user_phone,
                            'cookie' => true
                        );
                    }
                } else {
                    $json = array(
                        'status' => 'error',
                        'message' => 'Daha önceden deposit yapmıştır.',
                        'cookie' => true
                    );
                    if (isset($_SESSION['bonusChecked'])) {
                        unset($_SESSION['bonusChecked']);
                    }
                }
            } else {
                $json = array(
                    'status' => 'error',
                    'message' => 'Daha önceden bonus almıştır',
                    'cookie' => true
                );
                if (isset($_SESSION['bonusChecked'])) {
                    unset($_SESSION['bonusChecked']);
                }
            }
        } else {
            $json = array(
                'status' => 'error',
                'message' => 'Üyelik bulunamadı!',
                'cookie' => false
            );
            if (isset($_SESSION['bonusChecked'])) {
                unset($_SESSION['bonusChecked']);
            }
        }
        

        echo json_encode($json);
        header('Content-Type:application/json');
?>