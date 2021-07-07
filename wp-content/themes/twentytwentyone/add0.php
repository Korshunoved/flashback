<?php
/*
Template Name: addevent
*/

get_header(); 
require_once(ABSPATH . 'wp-admin/includes/file.php');
require_once(ABSPATH . 'wp-admin/includes/media.php');
require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	
	
if (!empty($_POST['name9']))
{
	
	
$current_user = wp_get_current_user();
$idi=$current_user->ID;
	
	
	

	$post = array(
	    'post_author' => $idi,
        'post_content'  => $_POST['desa'],
	    'post_excerpt' => $_POST['desa'],
	    'post_status' => "publish",
	    'post_title' => $_POST['name9'], 
	    'post_type' => "product",
	);
 
	//Create post
$post_id = wp_insert_post($post);
 if ($post_id )
 {
	 $attachment_id = media_handle_upload( 'file5', $post_id );
	wp_set_object_terms($post_id, 'simple', 'product_type');     //Тип товара (Простой товар)
  
	update_post_meta( $post_id, '_regular_price', 0);	
	update_post_meta( $post_id, '_price', 0);	
	
	update_post_meta( $post_id, '_text_locat', $_POST['locat']);	
	update_post_meta( $post_id, '_text_dat', $_POST['dat']);	
	update_post_meta( $post_id, '_number_cir', $idi);
	update_post_meta( $post_id, '_thumbnail_id', $attachment_id );
	 'Sussecc';
	 
 }
	
	
	
//wp_set_object_terms($post_id,  15, 'product_cat');

}	

	
	
	
	
	
	
	
	
	
	
	
	
	
if (!empty($_POST['name91']))
{
	
	
$current_user = wp_get_current_user();
$idi=$current_user->ID;
	
	
	

 

 $my_post = array();
$my_post['ID'] = $_GET['id'];
$my_post['post_content'] = $_POST['desa'];
$my_post['post_title'] = $_POST['name91'];
$my_post['post_excerpt'] = $_POST['desa'];
// Обновляем данные в БД
wp_update_post( wp_slash($my_post) );
 
 


if (!empty($_FILES['file5']))
{
	
$attachment_id = media_handle_upload( 'file5', $_GET['id'] );	
update_post_meta( $_GET['id'], '_thumbnail_id', $attachment_id );	
}
	

	if (!empty($_POST['locat']))
	{
	update_post_meta( $_GET['id'], '_text_locat', $_POST['locat']);		
		
	}
	if (!empty($_POST['dat']))
	{
		

	update_post_meta( $_GET['id'], '_text_dat', $_POST['dat']);	
	}
	
	 'Sussecc';

	
	
	
//wp_set_object_terms($post_id,  15, 'product_cat');
	?>
	<meta http-equiv="refresh" content="1;URL=/addevent/?id=<?=$_GET['id']?>" />
	<?
}	




if (!empty($_GET['id']))
{
	
	
$idd=$_GET['id'];


$post = get_post($idd);

$dat=get_post_meta($idd, '_text_dat', true);
 
  $er=explode('.',$dat);
   $loco=get_post_meta($idd, '_text_locat', true);
	
	
	?>
	









<main class="page-public-event">
  <div class="container">
    <div class="row justify-content-between">
      <aside class="sidebar col lg-hide">
        <div class="sidebar-top">
          <svg width="149" height="149" aria-hidden="true">
            <use xlink:href="#icon-smile-green"></use>
          </svg>
          <div>
            <div class="h3"><?
		 $current_user = wp_get_current_user();
echo $fio=get_user_meta( $current_user->ID, 'fio', true);
		?></div>
            <p></p>
          </div>
        </div>
 

		
<img id="ima" src="<? echo  get_the_post_thumbnail_url( $idd, 'medium' );?>" alt="">
		 <ul id="uploadImagesList">
        <li class="item template">
            <span class="img-wrap">
                <a href="javascript:void(0)" id="pica" class="sidebar-img"> <img src="<? echo  get_the_post_thumbnail_url( $idd, 'medium' );?>" alt=""></a>
            </span>
            <span class="delete-link" style="display:none" title="Удалить">Удалить</span>
        </li>
    </ul>
       
      </aside>
	      <form  id="uploadImages" enctype="multipart/form-data" method="post" class="form">
      <article class="content col">
        <ul class="content-public-event-top">
          <li>
            <div class="h3">Event name</div>
            <input required value="<? echo $post->post_title?>" name="name91" type="text">
          </li>
          <li>
            <div class="h3">Location</div>
            <input name="locat" value="<?=$loco?>" type="text">
          </li>
          <li>
			<div class="date-wrapp">
              <div class="h3">Select date</div>
              <input type="text" name="dat" id="data" class="datepicker" placeholder="DD MM YYYY">
              <i class="fa fa-calendar" aria-hidden="true"></i>
            </div>
            <div class="time-wrapp">
              <div class="h3">Select Time</div>
              <input type="time" value="12:00" class="time-input">
            </div>
          </li>
          <li>
            <div class="h3">Description</div>
            <input name="desa" value="<? echo $post->post_content?>" type="text">
          </li>
          <li>
		  
		  
		  
		  
 
    <input type="hidden" name="azaza" value="zazaza">
 
   
		  
		  

		  
            <div class="inputfile-box">
              <input type="file"  onclick="$('#ima').hide();$('.delete-link').click()" name="file5" id="addImages" class="inputfile">
              <label for="addImages">
                <strong></strong>
                <span>Upload Banner</span>
              </label>
            </div>
          </li>
          <li>
<!--            <button type="submit" class="btn btn_light_green" value="">Publish Event</button>-->
            <div class="select">
              <button type="button" class="btn btn_green" onclick="$('#uploadImages').submit()">Publish Event</button>
              <!-- <ul class="select-list" style="display: block;">
                <li><a href="#">As Circle</a></li>
               <li><a href="#">As Influencer</a></li>
              </ul>-->
            </div>

          </li>
        </ul>

        <ul class="tabs nav nav-tabs" id="myTab" role="tablist">
         <!-- <li class="nav-item">
            <a class="nav-link active"  data-toggle="tab" href="#your-event" role="tab"
               aria-controls="your-event"
               aria-selected="false">Your Event</a>
          </li>
          <li class="nav-item">
            <a class="nav-link "  data-toggle="tab" href="#manage-tickets" role="tab"
               aria-controls="manage-tickets" aria-selected="false">Manage Tickets</a>
          </li>-->
        </ul>

           <div  class="tab-content" id="myTabContent">
          <!--<div class="tab-pane fade show active" id="your-event" role="tabpanel" >
            <div class="your-event">
              <div class="img">
                <div class="img-in">
                  <img src="/wp-content/themes/twentytwentyone/img/publick-event/publick-event-sidebar.jpg" alt="">
                </div>
                <div class="h4">Flower Power  - <span>22.07</span></div>
              </div>
              <div class="desc">
                <div class="h3">COUNTDOWN TO EVENT</div>
                <div class="time">
                  <div class="time-number">
                    <div class="item">00</div>
                    <div class="item">:</div>
                    <div class="item">08</div>
                    <div class="item">:</div>
                    <div class="item">54</div>
                  </div>
                  <div class="time-name">
                    <div class="item">hours</div>
                    <div class="item">minutes</div>
                    <div class="item">seconds</div>
                  </div>
                </div>

              </div>
            </div>
          </div>-->
          <div class="tab-pane fade show active" id="manage-tickets" role="tabpanel" >
            <ul class="list-img">
              <li>
                <a href="#" class="img">
                  <img src="/wp-content/themes/twentytwentyone/img/publick-event/list-1.jpg" alt="">
                </a>
                <div class="h4">Basic Ticket - $100</div>
              </li>
              <li>
                <a href="#" class="img">
                  <img src="/wp-content/themes/twentytwentyone/img/publick-event/list-2.jpg" alt="">
                </a>
                <div class="h4">Vip Ticket - $500</div>
              </li>
              <li>
                <a href="#" class="img">
                  <img src="/wp-content/themes/twentytwentyone/img/publick-event/list-3.jpg" alt="">
                </a>
                <div class="h4">Diamond Ticket - $1000</div>
              </li>
              <li>
                <a href="#" class="img">
                  <img src="/wp-content/themes/twentytwentyone/img/publick-event/list-4.jpg" alt="">
                </a>
                <div class="h4">Create new ticket</div>
              </li>
            </ul>
          </div>

        </div>
      </article>
	  </form>
    </div>
  </div>


</main>

	<?
}
else
{
	
	


?>











<main class="page-public-event">
  <div class="container">
    <div class="row justify-content-between">
      <aside class="sidebar col lg-hide">
        <div class="sidebar-top">
          <svg width="149" height="149" aria-hidden="true">
            <use xlink:href="#icon-smile-green"></use>
          </svg>
          <div>
            <div class="h3"><?
		 $current_user = wp_get_current_user();
echo $fio=get_user_meta( $current_user->ID, 'fio', true);
		?></div>
            <p></p>
          </div>
        </div>


		
		
		 <ul id="uploadImagesList">
        <li class="item template">
            <span class="img-wrap">
                <a href="javascript:void(0)" id="pica" class="sidebar-img"> <img src="" alt=""></a>
            </span>
            <span class="delete-link" style="display:none" title="Удалить">Удалить</span>
        </li>
    </ul>
       
      </aside>
	      <form  id="uploadImages" enctype="multipart/form-data" method="post" class="form">
      <article class="content col">
        <ul class="content-public-event-top">
          <li>
            <div class="h3">Event name</div>
            <input required name="name9" type="text">
          </li>
          <li>
            <div class="h3">Location</div>
            <input name="locat" type="text">
          </li>
          <li>
            <div class="date-wrapp">
              <div class="h3">Select date</div>
              <input type="text" name="dat" id="data" class="datepicker" placeholder="DD MM YYYY">
              <i class="fa fa-calendar" aria-hidden="true"></i>
            </div>
            <div class="time-wrapp">
              <div class="h3">Select Time</div>
              <input type="time" value="12:00" class="time-input">
            </div>
          </li>

          <li>
            <div class="h3">Description</div>
            <input name="desa" type="text">
          </li>
          <li>
		  
		  
		  
		  
 
    <input type="hidden" name="azaza" value="zazaza">
 
   
		  
		  

		  
            <div class="inputfile-box">
              <input type="file"  onclick="$('.delete-link').click()" name="file5" id="addImages" class="inputfile">
              <label for="addImages">
                <strong></strong>
                <span>Upload Banner</span>
              </label>
            </div>
          </li>
          <li>
<!--            <button type="submit" class="btn btn_light_green" value="">Publish Event</button>-->
            <div class="select">
              <button type="button" class="btn btn_green" onclick="$('#uploadImages').submit()">Publish Event</button>
              <!-- <ul class="select-list" style="display: block;">
                <li><a href="#">As Circle</a></li>
               <li><a href="#">As Influencer</a></li>
              </ul>-->
            </div>

          </li>
        </ul>

        <ul class="tabs nav nav-tabs" id="myTab" role="tablist">
         <!-- <li class="nav-item">
            <a class="nav-link active"  data-toggle="tab" href="#your-event" role="tab"
               aria-controls="your-event"
               aria-selected="false">Your Event</a>
          </li>
          <li class="nav-item">
            <a class="nav-link "  data-toggle="tab" href="#manage-tickets" role="tab"
               aria-controls="manage-tickets" aria-selected="false">Manage Tickets</a>
          </li>-->
        </ul>

        <div  class="tab-content" id="myTabContent">
          <!--<div class="tab-pane fade show active" id="your-event" role="tabpanel" >
            <div class="your-event">
              <div class="img">
                <div class="img-in">
                  <img src="/wp-content/themes/twentytwentyone/img/publick-event/publick-event-sidebar.jpg" alt="">
                </div>
                <div class="h4">Flower Power  - <span>22.07</span></div>
              </div>
              <div class="desc">
                <div class="h3">COUNTDOWN TO EVENT</div>
                <div class="time">
                  <div class="time-number">
                    <div class="item">00</div>
                    <div class="item">:</div>
                    <div class="item">08</div>
                    <div class="item">:</div>
                    <div class="item">54</div>
                  </div>
                  <div class="time-name">
                    <div class="item">hours</div>
                    <div class="item">minutes</div>
                    <div class="item">seconds</div>
                  </div>
                </div>

              </div>
            </div>
          </div>-->
          <div class="tab-pane fade show active" id="manage-tickets" role="tabpanel" >
            <ul class="list-img">
              <li>
                <a href="#" class="img">
                  <img src="/wp-content/themes/twentytwentyone/img/publick-event/list-1.jpg" alt="">
                </a>
                <div class="h4">Basic Ticket - $100</div>
              </li>
              <li>
                <a href="#" class="img">
                  <img src="/wp-content/themes/twentytwentyone/img/publick-event/list-2.jpg" alt="">
                </a>
                <div class="h4">Vip Ticket - $500</div>
              </li>
              <li>
                <a href="#" class="img">
                  <img src="/wp-content/themes/twentytwentyone/img/publick-event/list-3.jpg" alt="">
                </a>
                <div class="h4">Diamond Ticket - $1000</div>
              </li>
              <li>
                <a href="#" class="img">
                  <img src="/wp-content/themes/twentytwentyone/img/publick-event/list-4.jpg" alt="">
                </a>
                <div class="h4">Create new ticket</div>
              </li>
            </ul>
          </div>

        </div>
      </article>
	  </form>
    </div>
  </div>


</main>
<?
}
?>
	
<script>
 jQuery(document).ready(function ($) {
 
     var maxFileSize = 2 * 1024 * 1024; // (байт) Максимальный размер файла (2мб)
     var queue = {};
     var form = $('form#uploadImages');
     var imagesList = $('#uploadImagesList');
 
     var itemPreviewTemplate = imagesList.find('.item.template').clone();
     itemPreviewTemplate.removeClass('template');
     imagesList.find('.item.template').remove();
 
 
     $('#addImages').on('change', function () {
         var files = this.files;
 
         for (var i = 0; i < files.length; i++) {
             var file = files[i];
 
             if ( !file.type.match(/image\/(jpeg|jpg|png|gif)/) ) {
                 alert( 'Фотография должна быть в формате jpg, png или gif' );
                 continue;
             }
 
             if ( file.size > maxFileSize ) {
                 alert( 'Размер фотографии не должен превышать 2 Мб' );
                 continue;
             }
 
             preview(files[i]);
         }
 
      
     });
 
     // Создание превью
     function preview(file) {
         var reader = new FileReader();
         reader.addEventListener('load', function(event) {
             var img = document.createElement('img');
 
             var itemPreview = itemPreviewTemplate.clone();
 
             itemPreview.find('.img-wrap img').attr('src', event.target.result);
             itemPreview.data('id', file.name);
 
             imagesList.append(itemPreview);
 
             queue[file.name] = file;
 
         });
         reader.readAsDataURL(file);
     }
 
     // Удаление фотографий
     imagesList.on('click', '.delete-link', function () {
         var item = $(this).closest('.item'),
             id = item.data('id');
 
         delete queue[id];
 
         item.remove();
     });
 
 
     // Отправка формы
     form.on('submit', function(event) {
 
         var formData = new FormData(this);
 
         for (var id in queue) {
             formData.append('images[]', queue[id]);
         }
 
         $.ajax({
             url: $(this).attr('action'),
             type: 'POST',
             data: formData,
             async: true,
             success: function (res) {
                 alert(res)
             },
             cache: false,
             contentType: false,
             processData: false
         });
 
         return false;
     });
 
 });
 
</script>
<?php get_footer(); ?>
