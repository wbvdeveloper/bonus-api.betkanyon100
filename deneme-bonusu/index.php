<?php
    error_reporting();
    session_start();
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
        die('<h4>'.$control['message'].'</h4>');
    }

?>

<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Betkanyon Deneme Bonusu</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="img\favicon.png">
    <link rel="stylesheet" href="css\bootstrap.min.css">
    <link rel="stylesheet" href="css\fontawesome-all.min.css">
    <link rel="stylesheet" href="font\flaticon.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    
    <style>
        .loader {
          border: 16px solid #f3f3f3; /* Light grey */
          border-top: 16px solid #f15e38; /* Blue */
          border-radius: 50%;
          width: 60px;
          height: 60px;
          animation: spin 2s linear infinite;
        }

        @keyframes spin {
          0% { transform: rotate(0deg); }
          100% { transform: rotate(360deg); }
        }
        
        .load-screen {
            display: none;
        }
        
    </style>
    
</head>
<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->      
    
   <div class="load-screen text-center" style="
    background: rgba(0,0,0,0.7);
    position: fixed;
    z-index: 99999;
    width: 100%;
    height: 100%;
    color: #fff;
">
       <div class="loader" style="margin:0 auto;margin-top: 246px;margin-bottom: 9px;"></div>
        <p style="
    color: #fff;
">Yükleniyor..</p>
    </div>
    
    <section class="fxt-template-animation fxt-template-layout1 has-animation">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-12 fxt-bg-color">
                    <div class="fxt-content">
                        <div class="fxt-form">
                            <center>
                                <img style="height:70px;margin-bottom:20px;" src="https://www.betkanyonvip.com/Img/partners/1026/logoBig.png" >
                            </center>
                            <h2>Deneme Bonusu</h2>     
                            <p>Betkanyon'dan 60 TL Spor veya 40 TL Casino Deneme Bonusu!</p>
                            <form method="POST">
                                <p>Lütfen almak istediğiniz bonusu seçiniz.</p>
                                <ul class="bonusSec">
                                    <li data-title="60 TL SPOR DENEME BONUSU" data-type="spor">60 TL SPOR DENEME BONUSU</li>
                                    <li data-title="40 TL CASİNO DENEME BONUSU" data-type="casino">40 TL CASİNO DENEME BONUSU</li>
                                </ul>
                            </form>                  
                            
                            <p class="text-center" style="cursor:pointer;" id="noBonus">Deneme bonusu almak istemiyorum</p>
                                                
                        </div> 
                        
                    </div>
                </div>
                <div class="col-md-6 col-12 fxt-none-767 fxt-bg-img" data-bg-image="img/figure/bg1-l.jpg"></div>
            </div>
        </div>
    </section>
    
    
    <style>
        .bonusSec li {
            background: #f35f38;
            color:#fff;
            margin-bottom: 10px;
            display: block;
            padding: 10px;
            border-radius: 10px;
            cursor: pointer;
            text-align: center;
            font-weight: bold;
        }
    </style>
    
    <!-- jquery-->
    <script src="js\jquery-3.3.1.min.js"></script>
    <!-- Popper js -->
    <script src="js\popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js\bootstrap.min.js"></script>
    <!-- Imagesloaded js -->
    <script src="js\imagesloaded.pkgd.min.js"></script>    
    <!-- Validator js -->
    <script src="js\validator.min.js"></script>
    <!-- Custom Js -->
    <script src="js\main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        
        $(document).on('click','#noBonus', function() {
             Swal.fire({
                  title: 'Deneme bonusu almak istemediğinize emin misiniz ?',
                  text: '',
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Evet',
                  cancelButtonText: 'Hayır'
                }).then((result) => {
                  if (result.value) {
                       $.ajax({
                            type:'POST',
                            data:'id=<?=$_GET['id']?>',
                            url:'ajax/no_bonus.php',
                            success:function(reply) {
                                if (reply.status == 'success') {
                                        window.parent.postMessage({
                                            'func': 'refreshWindow',
                                            'message': ''
                                        }, "*");
                                }
                            }
                        })
                  }
               })
        });
        
        $(document).on('click','.bonusSec li', function(){
            title = $(this).attr('data-title');
            type = $(this).attr('data-type');
            Swal.fire({
              title: 'Bonusu Onayla',
              html: '<p> '+title+' </p> <p> <a target="_blank" href="https://www.betkanyonbonus.net/hc/tr/articles/360012597140-Ki%C5%9Fiye-%C3%96zel-Deneme-Bonusu">Deneme bonusu kurallarını okumak için tıklayınız.</a> <p> Deneme bonusu aldığınızda, kuralları okumuş ve kabul etmiş olursunuz. </p>',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Onayla',
              cancelButtonText: 'İptal Et'
            }).then((result) => {
              if (result.value) {
                 $('.load-screen').show();
                 $.ajax({
                    type:'GET',
                    data:'type='+type+'&id=<?=$_GET['id']?>',
                    url:'ajax/bonus_tanimla.php',
                    success:function(reply) {
                        $('.load-screen').hide();
                        if (reply.status == 'success') {
                            Swal.fire('Bonusunuz Tanımlandı.',reply.message,reply.status);
                            setTimeout(function(){
                                window.parent.postMessage({
                                    'func': 'iframeClose',
                                    'message': 'Message text from iframe.'
                                 }, "*");
                            },2500);
                        } else {
                            Swal.fire('Hata Oluştu',reply.message,reply.status);
                        }
                    }
                }) 
              }
            })
        })
    </script>

</body>

</html>