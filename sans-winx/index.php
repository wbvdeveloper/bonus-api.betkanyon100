<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>ŞANS TALEP FORMU</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  
<?php
    $host = "207.154.251.195";
    $user = "admin_bonus";
    $pass = "admin_bonus!";
    $db = "admin_bonus";
    date_default_timezone_set('Europe/Istanbul');
    $db = new PDO("mysql:host=$host;dbname=$db",$user,$pass);
    $karakter = $db->prepare("SET CHARSET 'utf8'");
    $karakter->execute(array());
    $karakte2r = $db->prepare("SET NAMES SET 'utf8'");
    $karakte2r->execute(array());  
    
    if (@$_GET['id']) {
        $query = $db->prepare('SELECT * FROM customer WHERE id = ? and type = 5 LIMIT 1');
        $query->execute(array(addslashes(strip_tags(base64_decode($_GET['id'])))));
        if ($query->rowCount() == 0) {
            die('Aktif değildir');
        }
    } else {
        die('Geçersiz url.');
    }
    
?>
   
   <!-- multistep form -->
<form id="msform">
 
 <img src="_logo.png" style="
    width: 180px;
    padding: 15px;
    background: #000;
    border-radius: 2px;
">
 
  <ul id="progressbar" style="margin-top:50px;">
    <li class="active">TALEP OLUŞTUR</li>
    <li>İŞLEM SONUCU</li>
  </ul>
  <!-- fieldsets -->
  <fieldset>
    <h2 class="fs-title">ŞANS BONUSU</h2>
    <h3 class="fs-subtitle">Lütfen kullanıcı adınızı doğru bir şekilde giriniz.</h3>
    <input type="text" name="text" id="userName" placeholder="Kullanıcı Adı" />
    <input type="button" name="next" style="width:100%;margin:0;" class="next action-button" id="createRequest" style="display:block;" value="TALEBİ OLUŞTUR" />
    <p class="error" style="
    margin-top: 13px;
    font-weight: bold;
    font-size: 15px;
"></p>
  </fieldset>
  <fieldset>
    <img src="logo.png" height="100" style="margin-bottom:23px;" alt="">
    <h2 class="fs-title">TALEBİNİZ ALINDI</h2>
    <h3 class="fs-subtitle">Kısa süre içinde sonuçlanacaktır.</h3>
  </fieldset>

</form>
    
</body>
</html>


<style>
/*custom font*/
@import url(https://fonts.googleapis.com/css?family=Montserrat);

/*basic reset*/
* {margin: 0; padding: 0;}

html {
	height: 100%;
	/*Image only BG fallback*/
	
	/*background = gradient + image pattern combo*/
	background: #eff0f7
}

body {
	font-family: montserrat, arial, verdana;
}
/*form styles*/
#msform {
width: 100%;
    margin: auto;
    text-align: center;
    position: relative;
    margin-top: 48px;
    max-width: 600px;
}
    
    .error {
        display: none;
    }
    
#msform fieldset {
	background: white;
	border: 0 none;
	border-radius: 3px;
	padding: 20px 30px;
	box-sizing: border-box;
	width: 80%;
	margin: 0 10%;
	
	/*stacking fieldsets above each other*/
	position: relative;
}
/*Hide all except first fieldset*/
#msform fieldset:not(:first-of-type) {
	display: none;
}
/*inputs*/
#msform input, #msform textarea {
	padding: 15px;
	border: 1px solid #ccc;
	border-radius: 3px;
	margin-bottom: 10px;
	width: 100%;
	box-sizing: border-box;
	font-family: montserrat;
	color: #2C3E50;
	font-size: 13px;
}
/*buttons*/
#msform .action-button {
    width: 100px;
    background: #000;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 1px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px;
}

.fs-title {
	    font-size: 24px;
    text-transform: uppercase;
    color: #2C3E50;
    margin-bottom: 10px;
    line-height: 31px;
}
.fs-subtitle {
	font-weight: normal;
	font-size: 13px;
	color: #666;
	margin-bottom: 20px;
}
/*progressbar*/
#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    counter-reset: step;
}
#progressbar li {
	list-style-type: none;
    color: #000;
    text-transform: uppercase;
    font-size: 11px;
    width: 50%;
    float: left;
    position: relative;
    font-weight: bold;
}
#progressbar li:before {
	content: counter(step);
	counter-increment: step;
	width: 20px;
	line-height: 20px;
	display: block;
	font-size: 10px;
	color: #333;
	background: white;
	border-radius: 3px;
	margin: 0 auto 5px auto;
}
/*progressbar connectors*/
#progressbar li:after {
	content: '';
	width: 100%;
	height: 2px;
	background: white;
	position: absolute;
	left: -50%;
	top: 9px;
	z-index: -1; /*put it behind the numbers*/
}
#progressbar li:first-child:after {
	/*connector not needed before the first step*/
	content: none; 
}
/*marking active/completed steps green*/
/*The number of the step and the connector before it = green*/
#progressbar li.active:before,  #progressbar li.active:after{
	background: #000;
	color: white;
}




</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.0/jquery.min.js" integrity="sha512-0nVWK03Ud0k6o8wDkri8jxX9zQIn00ZHVud3iqBTwd2bGFwJDQShGVb3+vX1adCRxQckKQrIQMFmIA3tfWe+Mg==" crossorigin="anonymous"></script>
<script>
    $('#createRequest').click(function(){
        userName = $('#userName').val();
        callid = "<?=$_GET['id']?>";
        $.ajax({
            type:'POST',
            data:'username='+userName+'&call_id='+callid,
            url:'ajax.php',
            success:function(reply) {
               if (reply.status == 'error') {
                   $('.error').css('display','block').text(reply.message);
               } else {
                   $('fieldset:first').hide();
                   $('fieldset:eq(1)').show();
                   $('#progressbar li:first').removeClass('active');
                   $('#progressbar li:eq(1)').addClass('active');
               }
            }
        })
    })
</script>