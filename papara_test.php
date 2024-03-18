<?php
    ini_set('max_execution_time', '0'); 
    set_time_limit(0); 
    session_start();
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
 
    // Connect to gmail
    $imapPath = '{195.140.214.118:143/notls}INBOX';
    $username = 'all@hotmail.cx';
    $password = 'Mail123789';

    $inbox = imap_open($imapPath,$username,$password) or die(imap_last_error());
    $emails = imap_search($inbox,'ALL');

    function turkceDegistir($gelenVeri) {
        $bul  = array('ç', 'Ç', 'ğ', 'Ğ', 'ı', 'İ', 'ö', 'Ö', 'ş', 'Ş', 'ü', 'Ü');
    $degistir = array('c', 'c', 'g', 'g', 'i', 'i', 'o', 'o', 's', 's', 'u', 'u');
        $cikanVeri=str_replace($bul, $degistir, $gelenVeri);
        return $cikanVeri;
    }
    
    $output = '';
    foreach($emails as $mail) {
        $headerInfo = imap_headerinfo($inbox,$mail);
        $emailStructure = imap_fetchstructure($inbox,$mail);
        $yonlendiren = $headerInfo->from[0]->mailbox.'@'.$headerInfo->from[0]->host;
        $papara_hesabi = $headerInfo->to[0]->mailbox.'@'.$headerInfo->to[0]->host;
        if ($yonlendiren == 'bilgi@papara.com') {

            $baslangic     = $headerInfo->udate;
            $bitis         = strtotime(date('Y-m-d H:i:s'));
            $fark        = abs($bitis-$baslangic);
            $toplantiSure= $fark/60;
            
            $temp = $db->prepare('SELECT * FROM islenen_mailler WHERE mail_id = ? LIMIT 1');
            $temp->execute(array($headerInfo->udate));
            if ($temp->rowCount() == 0) {
                if(!isset($emailStructure->parts)) {
                     $message = imap_body($inbox, $mail, FT_PEEK);
                     $message = trim(quoted_printable_decode(imap_qprint($message)));
                     preg_match('#size (.*?),(.*?) TL gönderdi#',$message,$prr);
                     $tutar = str_replace('.','',$prr[1]);
                     $tutar = str_replace(',','',$tutar);
                     preg_match('#<td valign="top"(.*?)>
                    (.*?) size (.*?),(.*?) TL gönderdi#',$message,$prr);
                    $isim = trim($prr[2]);
                    
                     $query = $db->prepare('SELECT id FROM papara_hesaplar WHERE mail = ? LIMIT 1');
                     $query->execute(array(trim($papara_hesabi)));
                     if ($query->rowCount() != 0) {
                            $query = $query->fetch(PDO::FETCH_ASSOC);
                            $papara_id = $query['id'];
                            $query = $db->prepare('SELECT * FROM papara_talepler WHERE papara_id = ?');
                            $query->execute(array($papara_id));
                            foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $papara) {
                                $sim = similar_text(strtolower(turkceDegistir($isim)), strtolower(turkceDegistir($papara['hesap_adi'])), $perc);
                                echo 'İşlenen ('.$toplantiSure.') :'.PHP_EOL;
                                echo turkceDegistir(strtolower($isim)).PHP_EOL;
                                echo turkceDegistir(strtolower($papara['hesap_adi'])).PHP_EOL;
                                echo $perc.PHP_EOL.PHP_EOL;
                                    
                            }
                     }
                }
            }
        } else {
           imap_setflag_full($inbox, $mail, "\\Seen \\Flagged");
        }
    }
 
    imap_expunge($inbox);
    imap_close($inbox);

?>




