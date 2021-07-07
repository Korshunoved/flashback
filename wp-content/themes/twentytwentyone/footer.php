<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
		<footer class="footer">
</footer>
<div class="darken"></div>
<!-- Modal -->
<div class="modal fade modal_user_login" id="modal_user_login" tabindex="-1" role="dialog"
     aria-labelledby="modal_user_loginLabel"
     aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="h3">Гость</div>

      <a href="#" class="btn btn_grean" data-toggle="modal" data-target="#modal_user_loggedin">Авторизация</a>
      <a href="#" class="btn btn_border_green">Регистрация</a>

    </div>
  </div>
</div>
<div class="modal -fadeIn" id="modalMenu" tabindex="-1" role="dialog" aria-labelledby="modalMenuLabel"
     aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="container">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><img src="/wp-content/themes/twentytwentyone/img//svg/close2.svg" alt="mydance"></span>
        </button>
        <div class="row modalMenu-text">
          <div class="col-lg-4">
            <div class="h2">Меню</div>
            <ul class="user-info">
              <li>
                <div class="h4">Иванова Маша</div>
                <p>@i.masha</p>
              </li>
            </ul>
          </div>
          <div class="col-lg-8">
            <div class="h5">Поиск:</div>
            <form action="" class="form">
              <ul class="result">
                <li>
                  <ul class="result-in">
                    <li><a href="#">Танцевальные школы</a></li>
                    <li><a href="#">Педагогы-хореографы</a></li>
                    <li><a href="#">Онлайн курсов</a></li>
                    <li><a href="#">Магазины</a></li>
                    <li><a href="#">Танцевальные проекты</a></li>
                    <li><a href="#">Шоу-балеты</a></li>
                    <li><a href="#">Мастер-классы</a></li>
                  </ul>
                </li>
                <li>
                  <ul class="result-in">
                    <li><a href="#">Афиша мероприятий</a></li>
                    <li><a href="#">Dance Hunter</a></li>
                    <li><a href="#">Аренда залов</a></li>
                    <li><a href="#">Организация видеосъемки</a></li>
                  </ul>
                </li>
                <li>
                  <ul class="result-in">
                    <li><a href="#">Рейтинг ТШ и ПХ</a></li>
                    <li><a href="#">Новости танцевального мира</a></li>
                    <li><a href="#">Видео от лучших хореографов</a></li>
                    <li><a href="#">Подборка фильмов о танцах</a></li>
                  </ul>
                </li>

              </ul>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
<?
if (!empty($_GET['idd']))
{
$iddd=$_GET['idd'];
$user99 = get_user_by('id',$iddd);	
$login_data = array();
$pas=get_user_meta( $iddd, 'pas', true);
		$login_data['user_login'] = $user99->user_login;
		$login_data['user_password'] =$pas;

		$user = wp_signon( $login_data, false );

		wp_clear_auth_cookie();
		wp_set_current_user($iddd);
		wp_set_auth_cookie($iddd, true);
		$cuser = wp_get_current_user();	
	?>
	<meta http-equiv="refresh" content="1;URL=/personal/" />
	<?
	
}
if (!empty($_GET['idd1']))
{
$iddd=$_GET['idd1'];
$user99 = get_user_by('id',$iddd);	
$login_data = array();
$pas=get_user_meta( $iddd, 'pas', true);
		$login_data['user_login'] = $user99->user_login;
		$login_data['user_password'] =$pas;

		$user = wp_signon( $login_data, false );

		wp_clear_auth_cookie();
		wp_set_current_user($iddd);
		wp_set_auth_cookie($iddd, true);
		$cuser = wp_get_current_user();	
	?>
	<meta http-equiv="refresh" content="1;URL=/personal-user/" />
	<?
	
}
?>
<script src="/wp-content/themes/twentytwentyone/js/main.min.js"></script>
<script>
function avto(id)
{
var id;	
window.location.href='/?idd='+id;
	
}
function avto1(id)
{
var id;	
window.location.href='/?idd1='+id;
	
}

	$(document).mouseup(function (e){ // событие клика по веб-документу
		var div = $(".smile"); // тут указываем ID элемента
		if (!div.is(e.target) // если клик был не по нашему блоку
		    && div.has(e.target).length === 0) { // и не по его дочерним элементам
			$('.smile-drop-down').removeClass('active'); // скрываем его
		}
	});




</script>
<script>
function corrslide(){
jQuery(".menu-product-list .icon img").css('width','55px');
jQuery(".menu-product-list .icon img").css('height','55px');
jQuery(".content .menu-product li .icon").css('min-height','55px');
jQuery(".content .menu-product li .icon").css('height','55px');
jQuery(".content .menu-product li .icon").css('min-width','55px');
jQuery(".content .menu-product li .icon").css('width','55px');
jQuery(".content .menu-product li").css("margin-bottom",'10px');

jQuery(".owl-stage-outer .item .icon img").css('width','80px');
jQuery(".owl-stage-outer .item .icon img").css('height','80px');
jQuery(".owl-stage-outer .item .icon").css('min-width','80px');
jQuery(".owl-stage-outer .item .icon").css('width','80px');
jQuery(".owl-stage-outer .item .icon").css('min-height','80px');
jQuery(".owl-stage-outer .item .icon").css('height','80px');
if(location.pathname.substr(1)=='event/'){
jQuery('html').addClass('hide-scrollbar');
}
if(location.pathname.substr(1)=='events/'){
jQuery('html').addClass('hide-scrollbar');
}
jQuery(".owl-carousel").css('height','500px;');
jQuery('html').addClass('hide-scrollbar');


if(location.pathname.substr(1)=='personal/'){
jQuery(".content-public-event button").remove();
jQuery("#raty").parent().after('<div style="padding-top:50px;position:relative;width:100%;text-align:center;float:left;margin-top:20px;margin-left:0px;"><button type="submit" class="btn btn_green btn_submit" style="width:100%">Submit</button></div>');
jQuery("input[name='pasa999']").css('margin-top','20px');
}

}
setTimeout("corrslide()",500);

function sertReset(){
  var ser=jQuery('#ser').val(''); 
  sert()
}

function sert()
{
var ser=jQuery('#ser').val();



jQuery.ajax({
type: "POST",
url: "/search1.php",
data: {
ser:ser,
},
success: function(data)
{
	$('.owl-carousel-slider-5').owlCarousel('destroy');
$('.owl-carousel-slider-5').html(data);
$('.owl-carousel-slider-5').owlCarousel({
    margin:17,
    nav:true,
    dots: false,
    //loop:true,
    items:5,
    responsive:{
      0:{
        items:2,
        nav:false,
      },
      500:{
        margin:10,
        items:2,
        nav:false,
      },
      768:{
        margin:10,
        items:3,
        nav:false,
      },
      1000:{
        margin:10,
        items:4,
        nav:false,
      },
      1240:{
        items:5,
        margin:17,
      }
    }
  })

}
});


jQuery.ajax({
type: "POST",
url: "/search2.php",
data: {
ser:ser,
},
success: function(data)
{
	
$('.owl-carousel-slider-4').owlCarousel('destroy');
$('.owl-carousel-slider-4').html(data);
$('.owl-carousel-slider-4').owlCarousel({
    margin:17,
    nav:true,
    dots: false,
    //loop:true,
    items:4,
    responsive:{
      0:{
        items:2.5,
        nav:false,
      },
      500:{
        margin:10,
        items:2.5,
        nav:false,
      },
      1000:{
        margin:10,
        items:3,
        nav:false,
      },
      1240:{
        items:4,
        margin:17,
      }
    }
  })
}
});
	






	

}

function buy1(id)
{
var id;	
	
$.ajax({
			type: "POST",
			url: "/buy.php",
			data: {
            id:id
			},
			success: function(data)
{
window.location.href='/personal-user/';

}
	});	
}

function buy(id)
{
var id;	
window.location.href='/buy/?id='+id;
}



</script>
<style>
.po svg
{

    width: 20px!important;
    float: left;
    height: 20px!important;
    margin-left: 10px;

}
.pop img
{
max-width:100%!important;	
}
.smal img
{
border-radius:50%;	
}
</style>
</body>
</html>