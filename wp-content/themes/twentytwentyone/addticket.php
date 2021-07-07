<?php
/*
Template Name: addticket
*/

get_header(); 
require_once(ABSPATH . 'wp-admin/includes/file.php');
require_once(ABSPATH . 'wp-admin/includes/media.php');
require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	
 function base58_encode($string)
    {
        $alphabet = '123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz';
        $base = strlen($alphabet);
        if (is_string($string) === false) {
            return false;
        }
        if (strlen($string) === 0) {
            return '';
        }
        $bytes = array_values(unpack('C*', $string));
        $decimal = $bytes[0];
        for ($i = 1, $l = count($bytes); $i < $l; $i++) {
            $decimal = bcmul($decimal, 256);
            $decimal = bcadd($decimal, $bytes[$i]);
        }
        $output = '';
        while ($decimal >= $base) {
            $div = bcdiv($decimal, $base, 0);
            $mod = bcmod($decimal, $base);
            $output .= $alphabet[$mod];
            $decimal = $div;
        }
        if ($decimal > 0) {
            $output .= $alphabet[$decimal];
        }
        $output = strrev($output);
        foreach ($bytes as $byte) {
            if ($byte === 0) {
                $output = $alphabet[0] . $output;
                continue;
            }
            break;
        }
        return (string) $output;
    }	

	
if (!empty($_POST['name90']))
{
	

$current_user = wp_get_current_user();
$idi=$current_user->ID;
	
	
	

	$post7 = array(
	    'post_author' => $idi,
        'post_content'  => $_POST['desa'],
	    'post_excerpt' => $_POST['desa'],
	    'post_status' => "publish",
	    'post_title' => $_POST['name90'], 
	    'post_type' => "product",
	);
 
	//Create post
	if (!get_page_by_title($_POST['name90'], 'OBJECT', 'product') ){
$post_id = wp_insert_post($post7);
	}
 if ($post_id )
 {
	 
	  if (!empty($_POST['png1']))
	{
	///////////////////////////////	
	  $upload_dir = wp_upload_dir();
    $upload_path = str_replace( '/', DIRECTORY_SEPARATOR, $upload_dir['path'] ) . DIRECTORY_SEPARATOR;
    $image_parts = explode(";base64,",$_POST['png1']);
    $decoded = base64_decode($image_parts[1]);
    $filename = '999.png';
    $hashed_filename = md5( $filename . microtime() ) . '_' . $filename;
    $image_upload = file_put_contents( $upload_path . $hashed_filename, $decoded ); 
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    require_once(ABSPATH . 'wp-admin/includes/media.php');
    require_once(ABSPATH . 'wp-admin/includes/file.php');


        // Without that I'm getting a debug error!?




        $file             = array();
        $file['error']    = '';
        $file['tmp_name'] = $upload_path . $hashed_filename;
        $file['name']     = $hashed_filename;
        $file['type']     = 'image/png';
        $file['size']     = filesize( $upload_path . $hashed_filename );
        // upload file to server

        // use $file instead of $image_upload
        $file_return = wp_handle_sideload( $file, array( 'test_form' => false ) );
        $filename = $file_return['file'];
        $attachment = array(
                                             'post_mime_type' => $file_return['type'],
                                             'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
                                             'post_content' => '',
                                             'post_status' => 'inherit',
                                             'guid' => $wp_upload_dir['url'] . '/' . basename($filename)
                                             );



    $attachment_id = wp_insert_attachment( $attachment, $filename );
////////////////////////////////////////////////////	
	}
	else
	{	
    $attachment_id = media_handle_upload( 'file5',$post_id );	
	}
	 
	
	wp_set_object_terms($post_id, 'simple', 'product_type');     //Тип товара (Простой товар)
  
	update_post_meta( $post_id, '_regular_price', $_POST['cen']);	
	update_post_meta( $post_id, '_price', $_POST['cen']);	
	
	update_post_meta( $post_id, '_number_tov',$_POST['idtov']);	
	
	update_post_meta( $post_id, '_number_cop', $_POST['copy']);	
	update_post_meta( $post_id, '_text_fea', $_POST['fea']);	
		

	update_post_meta( $post_id, '_thumbnail_id', $attachment_id );
	
	 'Sussecc';
	 
//////////////////////////////////////////////////
	 
  $current_user = wp_get_current_user();
/*
   $fio=get_user_meta( $current_user->ID, 'ema100', true);
    $pas=get_user_meta( $current_user->ID, 'pas100', true);
    $adr=get_user_meta( $current_user->ID, 'adr100', true);
	*/
	
	 $fio='gntheuGs16373';
    $pas='fbHrbrhHvh1337€$4';
    $adr='X-avax1fm6g9c825jl8lca6czye5l389a0h6mnj08jnqh';
	 
	
	 $ass=get_post_meta($_POST['idtov'], '_text_asset', true);	
	 $nama=$_POST['name90'];
	 $desa='';
	 $desa.=$_POST['desa'].'+';
	 $desa.=$_POST['fea'].'+';
	 $desa.=$_POST['cen'];
	 
$image_url = wp_get_attachment_url($attachment_id);

 
	 
echo $string='{"avalanche":{"version": 1,"type": "generic","title":"'.$nama.'","img": "'.$image_url.'","desc": "'.$desa.'"}}';
$string=iconv('windows-1251','UTF-8//TRANSLIT',$string);
$pay=base58_encode($string);
$pay='Ln2w2UtN64u95uNhhtAHkv2qTsA92ABuBFdSXMUBJcySY6e4FRE84JsXBA4GCtRcRZmC952k4SGjP52FX2SDz1wBRBpmha6PoCUQbHFaufNuinMWdZ7nYk1dC7cbkkE1Y9zTfX3bnwTFczTJkaJxCyevHJ7MWhEi2Ap4zisVbo2APLqL1jcp7FAXK1n7EnnLmAZqTL6KZ7UpbGVTxSk6bxY2AgKqYiYJWtjJS1bRYT63kTq92dwBKEjH5v';
	 
$array = array(
    'jsonrpc' => '2.0',
    'id' => '1',
    'method' => 'avm.mintNFT',
    'params' => array(
        'assetID' =>$ass,
        'payload' => $pay,
        'from' => array(
            '0' => $adr
        ),
        'to' => $adr,
        'minters' => array(
            '0' => $adr
        ),
        'changeAddr' => $adr,
        'username' => $fio,
        'password' => $pas
    )
);	 


	$apiUrl = 'http://18.116.131.159:9650/ext/bc/X'; 
    $message = json_encode($array);
    $requestHeaders = array(
        'Content-type: application/json'
    );
	
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $message);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $requestHeaders);
    $response = curl_exec($ch);
	print_r($response);
	echo curl_error($ch);
	if ($response === FALSE) {
    // Тут-то мы о ней и скажем
    return;
}
	 $otvet=json_decode($response); 
	print_r( $otvet);
$tx=$otvet->result->txID;
update_post_meta( $post_id, '_text_tx',$tx);	
	 
///////////////////////////////////////////////////////	 

 }
	
	
	
//wp_set_object_terms($post_id,  15, 'product_cat');
?>
	<meta http-equiv="refresh" content="1000000000000;URL=/addevent/?id=<?=$_POST['idtov']?>" />
	<?
}	

	
	
	
	
	
	
	
	
	
	
	
	
	
if (!empty($_POST['name910']))
{
	
	
$current_user = wp_get_current_user();
$idi=$current_user->ID;
	
	
	

 

 $my_post = array();
$my_post['ID'] = $_GET['id'];
$my_post['post_content'] = $_POST['desa'];
$my_post['post_title'] = $_POST['name910'];
$my_post['post_excerpt'] = $_POST['desa'];
// Обновляем данные в БД
wp_update_post( wp_slash($my_post) );
 
 

if ($_FILES['file5']['size']>0)
{


	 if (!empty($_POST['png1']))
	{
	///////////////////////////////	
	  $upload_dir = wp_upload_dir();
    $upload_path = str_replace( '/', DIRECTORY_SEPARATOR, $upload_dir['path'] ) . DIRECTORY_SEPARATOR;
    $image_parts = explode(";base64,",$_POST['png1']);
    $decoded = base64_decode($image_parts[1]);
    $filename = '999.png';
    $hashed_filename = md5( $filename . microtime() ) . '_' . $filename;
    $image_upload = file_put_contents( $upload_path . $hashed_filename, $decoded ); 
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    require_once(ABSPATH . 'wp-admin/includes/media.php');
    require_once(ABSPATH . 'wp-admin/includes/file.php');


        // Without that I'm getting a debug error!?




        $file             = array();
        $file['error']    = '';
        $file['tmp_name'] = $upload_path . $hashed_filename;
        $file['name']     = $hashed_filename;
        $file['type']     = 'image/png';
        $file['size']     = filesize( $upload_path . $hashed_filename );
        // upload file to server

        // use $file instead of $image_upload
        $file_return = wp_handle_sideload( $file, array( 'test_form' => false ) );
        $filename = $file_return['file'];
        $attachment = array(
                                             'post_mime_type' => $file_return['type'],
                                             'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
                                             'post_content' => '',
                                             'post_status' => 'inherit',
                                             'guid' => $wp_upload_dir['url'] . '/' . basename($filename)
                                             );



    $attachment_id = wp_insert_attachment( $attachment, $filename );
////////////////////////////////////////////////////	
	}
	else
	{	
    $attachment_id = media_handle_upload( 'file5',$_GET['id'] );	
	}


	update_post_meta( $_GET['id'], '_thumbnail_id', $attachment_id );	


}
	

	if (!empty($_POST['cen']))
	{
	update_post_meta( $_GET['id'], '_regular_price', $_POST['cen']);		
	update_post_meta( $_GET['id'], '_price', $_POST['cen']);		
	}
	if (!empty($_POST['copy']))
	{
	update_post_meta( $_GET['id'], '_number_cop', $_POST['copy']);	
	}
	if (!empty($_POST['fea']))
	{
    update_post_meta(  $_GET['id'], '_text_fea', $_POST['fea']);
	}
	
	
	
	
	
	
	
	
	
	 'Sussecc';

	
	 $eve=get_post_meta($_GET['id'], '_number_tov', true);
	
//wp_set_object_terms($post_id,  15, 'product_cat');
	?>
	<meta http-equiv="refresh" content="1;URL=/addevent/?id=<?=$eve?>" />
	<?
}	







if (!empty($_GET['event']))
{
	
	
$idd=$_GET['event'];


$post = get_post($idd);

$dat=get_post_meta($idd, '_text_dat', true);
$dat1=get_post_meta($idd, '_text_dat1', true);
$hash=get_post_meta($idd, '_text_hash', true);
 $tam1=get_post_meta($idd, '_text_time1', true);
 $tam2=get_post_meta($idd, '_text_time2', true);
 
  $er=explode('.',$dat);
   $loco=get_post_meta($idd, '_text_locat', true);
	
 
  $er7=explode('-',$dat);
	 $tu=$er7[0].'.'.$er7[1];
	 
	 

	
	
	
	
	?>
	

<main class="page-public-event page-public-event-new">
  <div class="container">
  <form  id="uploadImages" enctype="multipart/form-data" method="post" class="form">
  
  
    <div class="modal fade " id="modal__sidebar" tabindex="-1" role="dialog" aria-labelledby="modal__sidebarLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="h4">Set Preview</div>
      <div class="img">
       <div id="jcrop"></div>	  
	<canvas id="canvas"></canvas>
	<input id="png" name="png1"  type="hidden" />
      </div>
      <a href="#" class="btn btn_red" data-dismiss="modal">Upload</a>
      <a href="#" class="btn btn_red" data-dismiss="modal">Change</a>
    </div>
  </div>
</div>

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
		
        <a href="/addevent/?id=<?=$_GET['event'];?>" class="sidebar-img"><img id="ima" src="<? echo  get_the_post_thumbnail_url( $idd, 'full' );?>" alt=""></a>
      </aside>
      <article class="content col">
        <ul class="content-public-event-top">
          <li>
            <div class="inner-flash">
              <div class="h3">Title</div>
              <input name="name90" id="nam" onblur="var tit=$(this).val();var cen=$('#cen').val();$('#tita').text(tit+'-$'+cen)" type="text">
              <div class="bottom-info">Service fee is 2.5%</div>
            </div>

            <div class="inner-flash">
              <div class="h3">Description</div>
              <textarea name="desa" class="lg input"></textarea>
            </div>
            <div class="inner-flash">
              <button type="submit" onclick="$('#uploadImages').submit()" class="btn btn_green" value="">SUBMIT</button>
            </div>
          </li>
          <li>
            <div class="inner-flash">
              <div class="h3">Set The Price</div>
              <input name="cen"  onblur="var cen=$(this).val();var tit=$('#nam').val();$('#tita').text(tit+'-$'+cen)" id="cen" type="text">
            </div>
            <div class="inner-flash">
              <div class="h3">Number of Copies</div>
              <input name="copy" type="text">
            </div>
            <div class="inner-flash">
              <div class="h3">Features</div>
              <textarea name="fea" class="sm input"></textarea>
            </div>
            <div class="inner-flash">
              <div class="inputfile-box">
                 <input type="file"  onclick="$('.delete-link').click();$('#rao').text('Upload File');" name="file5" id="addImages" class="inputfile">
                 <label for="addImages">
                  <strong></strong>
                  <span id="rao">Upload File</span>
                </label>
                <div class="size">PNG, GIF</div>
              </div>
            </div>
          </li>
          <li class="preview-wrapp">
            <div class="inner-flash">
              <div class="h3"> &nbsp;</div>
              <div class="select">
                <button type="button" class="btn btn_green" onclick="$('.select-list').slideToggle();">USD</button>
                <!--<ul class="select-list" style="display: block;">
                  <li><a href="#">EUR</a></li>
                </ul>-->
              </div>
            </div>
            <div class="inner-flash">
              <div class="preview">
                <div class="h3">PREVIEW</div>
				
				
				
				
		 <ul id="uploadImagesList">
        <li class="item template">
            <span class="img-wrap">
                <a href="javascript:void(0)" id="pica" class="img"> 
				<img src="" alt=""></a> 
				
            </span>
			
            <span class="delete-link" style="display:none" title="Удалить">Удалить</span>
        </li>
    </ul>
				<a href="#" id="tita" class="link"></a>
				
				
				
				
				
              </div>
			  
			  
			  
			  
			  
			  
			  
			  
			  
            </div>
          </li>
<input type="hidden" name="idtov" value="<?=$_GET['event']?>">

          <!--          <li>-->
          <!--              &lt;!&ndash; <button type="submit" class="btn btn_light_green" value="">Publish Event</button>&ndash;&gt;-->
          <!--            <div class="select">-->
          <!--              <button type="button" class="btn btn_green" onclick="$('.select-list').slideToggle();">Publish Event</button>-->
          <!--              <ul class="select-list" style="display: block;">-->
          <!--                <li><a href="#">As Circle</a></li>-->
          <!--                <li><a href="#">As Influencer</a></li>-->
          <!--              </ul>-->
          <!--            </div>-->
          <!--          </li>-->

        </ul>
      </article>
    </div>
	</form>
  </div>


</main>

	



	<?
}
else
{
	
	
if (!empty($_GET['id']))
{
	
		
$idd=$_GET['id'];


$post = get_post($idd);

$cop=get_post_meta($idd, '_number_cop', true);
$fea=get_post_meta($idd, '_text_fea', true);
$cen=get_post_meta($idd, '_regular_price', true);
 $tit=$post->post_title;
 $desa=$post->post_content;
 $eve=get_post_meta($idd, '_number_tov', true);
	$post5 = get_post($eve);

?>











<main class="page-public-event page-public-event-new">
  <div class="container">
  <form  id="uploadImages" enctype="multipart/form-data" method="post" class="form">
  
    <div class="modal fade " id="modal__sidebar" tabindex="-1" role="dialog" aria-labelledby="modal__sidebarLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="h4">Set Preview</div>
      <div class="img">
       <div id="jcrop"></div>	  
	<canvas id="canvas"></canvas>
	<input id="png" name="png1"  type="hidden" />
      </div>
      <a href="#" class="btn btn_red" data-dismiss="modal">Upload</a>
      <a href="#" class="btn btn_red" data-dismiss="modal">Change</a>
    </div>
  </div>
</div>
  
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
		
        <a href="/addevent/?id=<?=$eve;?>" class="sidebar-img"><img id="ima" src="<? echo  get_the_post_thumbnail_url( $eve, 'full' );?>" alt=""></a>
      </aside>
      <article class="content col">
        <ul class="content-public-event-top">
          <li>
            <div class="inner-flash">
              <div class="h3">Title</div>
              <input name="name910" id="nam" value="<?=$tit?>" onblur="var tit=$(this).val();var cen=$('#cen').val();$('#tita').text(tit+'-$'+cen)" type="text">
              <div class="bottom-info">Service fee is 2.5%</div>
            </div>

            <div class="inner-flash">
              <div class="h3">Description</div>
              <textarea name="desa" class="lg input"><?=$desa?></textarea>
            </div>
            <div class="inner-flash">
              <button type="submit" onclick="$('#uploadImages').submit()" class="btn btn_green" value="">SUBMIT</button>
            </div>
          </li>
          <li>
            <div class="inner-flash">
              <div class="h3">Set The Price</div>
              <input name="cen"  value="<?=$cen?>" onblur="var cen=$(this).val();var tit=$('#nam').val();$('#tita').text(tit+'-$'+cen)" id="cen" type="text">
            </div>
            <div class="inner-flash">
              <div class="h3">Number of Copies</div>
              <input name="copy" value="<?=$cop?>" type="text">
            </div>
            <div class="inner-flash">
              <div class="h3">Features</div>
              <textarea name="fea"  class="sm input"><?=$fea?></textarea>
            </div>
            <div class="inner-flash">
              <div class="inputfile-box">
                 <input type="file"  onclick="$('.delete-link').click();$('#rao').text('Upload File');" name="file5" id="addImages" class="inputfile">
                 <label for="addImages">
                  <strong></strong>
                  <span id="rao">Upload File</span>
                </label>
                <div class="size">PNG, GIF</div>
              </div>
            </div>
          </li>
          <li class="preview-wrapp">
            <div class="inner-flash">
              <div class="h3"> &nbsp;</div>
              <div class="select">
                <button type="button" class="btn btn_green" onclick="$('.select-list').slideToggle();">USD</button>
                <!--<ul class="select-list" style="display: block;">
                  <li><a href="#">EUR</a></li>
                </ul>-->
              </div>
            </div>
            <div class="inner-flash">
              <div class="preview">
                <div class="h3">PREVIEW</div>
				
				
				
				<img id="ima" src="<? echo  get_the_post_thumbnail_url( $idd, 'full' );?>" alt="">
		 <ul id="uploadImagesList">
        <li class="item template">
            <span class="img-wrap">
                <a href="javascript:void(0)" id="pica" class="img"> 
				<img src="" alt="">
            </span>
			
            <span class="delete-link" style="display:none" title="Удалить">Удалить</span>
        </li>
    </ul>
				<a href="#" id="tita" class="link"><?=$tit?>-$<?=$cen?></a>
				
				
				
				
				
              </div>
			  
			  
			  
			  
			  
			  
			  
			  
			  
            </div>
          </li>


          <!--          <li>-->
          <!--              &lt;!&ndash; <button type="submit" class="btn btn_light_green" value="">Publish Event</button>&ndash;&gt;-->
          <!--            <div class="select">-->
          <!--              <button type="button" class="btn btn_green" onclick="$('.select-list').slideToggle();">Publish Event</button>-->
          <!--              <ul class="select-list" style="display: block;">-->
          <!--                <li><a href="#">As Circle</a></li>-->
          <!--                <li><a href="#">As Influencer</a></li>-->
          <!--              </ul>-->
          <!--            </div>-->
          <!--          </li>-->

        </ul>
      </article>
    </div>
	</form>
  </div>


</main>
<?
}

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
   $('#rao').text('Upload File');
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
<a href="javascript:void(0)" id="mod1" style="display:none" class="sidebar-img" data-toggle="modal" data-target="#modal__sidebar">1</a>



<style>
.jcrop-holder{direction:ltr;text-align:left;}
.jcrop-vline,.jcrop-hline{background:#FFF url(Jcrop.gif);font-size:0;position:absolute;}
.jcrop-vline{height:100%;width:1px!important;}
.jcrop-vline.right{right:0;}
.jcrop-hline{height:1px!important;width:100%;}
.jcrop-hline.bottom{bottom:0;}
.jcrop-tracker{-webkit-tap-highlight-color:transparent;-webkit-touch-callout:none;-webkit-user-select:none;height:100%;width:100%;}
.jcrop-handle{background-color:#333;border:1px #EEE solid;font-size:1px;height:7px;width:7px;}
.jcrop-handle.ord-n{left:50%;margin-left:-4px;margin-top:-4px;top:0;}
.jcrop-handle.ord-s{bottom:0;left:50%;margin-bottom:-4px;margin-left:-4px;}
.jcrop-handle.ord-e{margin-right:-4px;margin-top:-4px;right:0;top:50%;}
.jcrop-handle.ord-w{left:0;margin-left:-4px;margin-top:-4px;top:50%;}
.jcrop-handle.ord-nw{left:0;margin-left:-4px;margin-top:-4px;top:0;}
.jcrop-handle.ord-ne{margin-right:-4px;margin-top:-4px;right:0;top:0;}
.jcrop-handle.ord-se{bottom:0;margin-bottom:-4px;margin-right:-4px;right:0;}
.jcrop-handle.ord-sw{bottom:0;left:0;margin-bottom:-4px;margin-left:-4px;}
.jcrop-dragbar.ord-n,.jcrop-dragbar.ord-s{height:7px;width:100%;}
.jcrop-dragbar.ord-e,.jcrop-dragbar.ord-w{height:100%;width:7px;}
.jcrop-dragbar.ord-n{margin-top:-4px;}
.jcrop-dragbar.ord-s{bottom:0;margin-bottom:-4px;}
.jcrop-dragbar.ord-e{margin-right:-4px;right:0;}
.jcrop-dragbar.ord-w{margin-left:-4px;}
.jcrop-light .jcrop-vline,.jcrop-light .jcrop-hline{background:#FFF;filter:alpha(opacity=70)!important;opacity:.70!important;}
.jcrop-light .jcrop-handle{-moz-border-radius:3px;-webkit-border-radius:3px;background-color:#000;border-color:#FFF;border-radius:3px;}
.jcrop-dark .jcrop-vline,.jcrop-dark .jcrop-hline{background:#000;filter:alpha(opacity=70)!important;opacity:.7!important;}
.jcrop-dark .jcrop-handle{-moz-border-radius:3px;-webkit-border-radius:3px;background-color:#FFF;border-color:#000;border-radius:3px;}
.solid-line .jcrop-vline,.solid-line .jcrop-hline{background:#FFF;}
.jcrop-holder img,img.jcrop-preview{max-width:none;}
</style>
<script>
$("#addImages").change(function(){
	picture(this);$('#mod1').click();
});


$("#form").submit(function(e){
	e.preventDefault();
	//Get cropped image base64 string
	var base64 = $("#png").val();
	//Remove base64 string value from #png input to prevent it form being sent
	$("#png").val("");
	//Get formdata
	formData = new FormData($(this)[0]);
	//Convert base64 string to file blob
	var blob = dataURLtoBlob(base64);
	//Add file blob to the form data
	formData.append("cropped_image[]", blob);
	$.ajax({
		url: "whatever.php",
		type: "POST",
		data: formData,
		contentType: false,
		cache: false,
		processData: false,
		success: function(data){
					alert("Succes");
				},
		error: function(data){
					alert("Error");
				},
		complete: function(data) {
					//Add base64 string value back to #png input
					$("#png").val(base64);
				}
	});
});



var picture_width;
var picture_height;
var crop_max_width = 300;
var crop_max_height = 300;



function picture(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$("#jcrop, #preview").html("").append("<img src=\""+e.target.result+"\" alt=\"\" />");
			picture_width = $("#preview img").width();
			picture_height = $("#preview img").height();
			$("#jcrop  img").Jcrop({
				onChange: canvas,
				onSelect: canvas,
				allowSelect: false,
				allowResize: false,
allowMove: true,
  setSelect:[ 0,0,300,400 ],
				boxWidth: crop_max_width,
				boxHeight: crop_max_height
			});
		}
		reader.readAsDataURL(input.files[0]);
	}
}
function canvas(coords){
	var imageObj = $("#jcrop img")[0];
	var canvas = $("#canvas")[0];
	canvas.width  = coords.w;
	canvas.height = coords.h;
	var context = canvas.getContext("2d");
	context.drawImage(imageObj, coords.x, coords.y, coords.w, coords.h, 0, 0, canvas.width, canvas.height);
	png();
}
function png() {
	var png = $("#canvas")[0].toDataURL('image/png');
	$("#png").val(png);
}






function dataURLtoBlob(dataURL) {
	var BASE64_MARKER = ';base64,';
	if(dataURL.indexOf(BASE64_MARKER) == -1) {
		var parts = dataURL.split(',');
		var contentType = parts[0].split(':')[1];
		var raw = decodeURIComponent(parts[1]);

		return new Blob([raw], {type: contentType});
	}
	var parts = dataURL.split(BASE64_MARKER);
	var contentType = parts[0].split(':')[1];
	var raw = window.atob(parts[1]);
	var rawLength = raw.length;
	var uInt8Array = new Uint8Array(rawLength);
	for(var i = 0; i < rawLength; ++i) {
		uInt8Array[i] = raw.charCodeAt(i);
	}

	return new Blob([uInt8Array], {type: contentType});
}


/**
 * jquery.Jcrop.min.js v0.9.12 (build:20130202)
 * jQuery Image Cropping Plugin - released under MIT License
 * Copyright (c) 2008-2013 Tapmodo Interactive LLC
 * https://github.com/tapmodo/Jcrop
 */
(function(a){a.Jcrop=function(b,c){function i(a){return Math.round(a)+"px"}function j(a){return d.baseClass+"-"+a}function k(){return a.fx.step.hasOwnProperty("backgroundColor")}function l(b){var c=a(b).offset();return[c.left,c.top]}function m(a){return[a.pageX-e[0],a.pageY-e[1]]}function n(b){typeof b!="object"&&(b={}),d=a.extend(d,b),a.each(["onChange","onSelect","onRelease","onDblClick"],function(a,b){typeof d[b]!="function"&&(d[b]=function(){})})}function o(a,b,c){e=l(D),bc.setCursor(a==="move"?a:a+"-resize");if(a==="move")return bc.activateHandlers(q(b),v,c);var d=_.getFixed(),f=r(a),g=_.getCorner(r(f));_.setPressed(_.getCorner(f)),_.setCurrent(g),bc.activateHandlers(p(a,d),v,c)}function p(a,b){return function(c){if(!d.aspectRatio)switch(a){case"e":c[1]=b.y2;break;case"w":c[1]=b.y2;break;case"n":c[0]=b.x2;break;case"s":c[0]=b.x2}else switch(a){case"e":c[1]=b.y+1;break;case"w":c[1]=b.y+1;break;case"n":c[0]=b.x+1;break;case"s":c[0]=b.x+1}_.setCurrent(c),bb.update()}}function q(a){var b=a;return bd.watchKeys
(),function(a){_.moveOffset([a[0]-b[0],a[1]-b[1]]),b=a,bb.update()}}function r(a){switch(a){case"n":return"sw";case"s":return"nw";case"e":return"nw";case"w":return"ne";case"ne":return"sw";case"nw":return"se";case"se":return"nw";case"sw":return"ne"}}function s(a){return function(b){return d.disabled?!1:a==="move"&&!d.allowMove?!1:(e=l(D),W=!0,o(a,m(b)),b.stopPropagation(),b.preventDefault(),!1)}}function t(a,b,c){var d=a.width(),e=a.height();d>b&&b>0&&(d=b,e=b/a.width()*a.height()),e>c&&c>0&&(e=c,d=c/a.height()*a.width()),T=a.width()/d,U=a.height()/e,a.width(d).height(e)}function u(a){return{x:a.x*T,y:a.y*U,x2:a.x2*T,y2:a.y2*U,w:a.w*T,h:a.h*U}}function v(a){var b=_.getFixed();b.w>d.minSelect[0]&&b.h>d.minSelect[1]?(bb.enableHandles(),bb.done()):bb.release(),bc.setCursor(d.allowSelect?"crosshair":"default")}function w(a){if(d.disabled)return!1;if(!d.allowSelect)return!1;W=!0,e=l(D),bb.disableHandles(),bc.setCursor("crosshair");var b=m(a);return _.setPressed(b),bb.update(),bc.activateHandlers(x,v,a.type.substring
(0,5)==="touch"),bd.watchKeys(),a.stopPropagation(),a.preventDefault(),!1}function x(a){_.setCurrent(a),bb.update()}function y(){var b=a("<div></div>").addClass(j("tracker"));return g&&b.css({opacity:0,backgroundColor:"white"}),b}function be(a){G.removeClass().addClass(j("holder")).addClass(a)}function bf(a,b){function t(){window.setTimeout(u,l)}var c=a[0]/T,e=a[1]/U,f=a[2]/T,g=a[3]/U;if(X)return;var h=_.flipCoords(c,e,f,g),i=_.getFixed(),j=[i.x,i.y,i.x2,i.y2],k=j,l=d.animationDelay,m=h[0]-j[0],n=h[1]-j[1],o=h[2]-j[2],p=h[3]-j[3],q=0,r=d.swingSpeed;c=k[0],e=k[1],f=k[2],g=k[3],bb.animMode(!0);var s,u=function(){return function(){q+=(100-q)/r,k[0]=Math.round(c+q/100*m),k[1]=Math.round(e+q/100*n),k[2]=Math.round(f+q/100*o),k[3]=Math.round(g+q/100*p),q>=99.8&&(q=100),q<100?(bh(k),t()):(bb.done(),bb.animMode(!1),typeof b=="function"&&b.call(bs))}}();t()}function bg(a){bh([a[0]/T,a[1]/U,a[2]/T,a[3]/U]),d.onSelect.call(bs,u(_.getFixed())),bb.enableHandles()}function bh(a){_.setPressed([a[0],a[1]]),_.setCurrent([a[2],
a[3]]),bb.update()}function bi(){return u(_.getFixed())}function bj(){return _.getFixed()}function bk(a){n(a),br()}function bl(){d.disabled=!0,bb.disableHandles(),bb.setCursor("default"),bc.setCursor("default")}function bm(){d.disabled=!1,br()}function bn(){bb.done(),bc.activateHandlers(null,null)}function bo(){G.remove(),A.show(),A.css("visibility","visible"),a(b).removeData("Jcrop")}function bp(a,b){bb.release(),bl();var c=new Image;c.onload=function(){var e=c.width,f=c.height,g=d.boxWidth,h=d.boxHeight;D.width(e).height(f),D.attr("src",a),H.attr("src",a),t(D,g,h),E=D.width(),F=D.height(),H.width(E).height(F),M.width(E+L*2).height(F+L*2),G.width(E).height(F),ba.resize(E,F),bm(),typeof b=="function"&&b.call(bs)},c.src=a}function bq(a,b,c){var e=b||d.bgColor;d.bgFade&&k()&&d.fadeTime&&!c?a.animate({backgroundColor:e},{queue:!1,duration:d.fadeTime}):a.css("backgroundColor",e)}function br(a){d.allowResize?a?bb.enableOnly():bb.enableHandles():bb.disableHandles(),bc.setCursor(d.allowSelect?"crosshair":"default"),bb
.setCursor(d.allowMove?"move":"default"),d.hasOwnProperty("trueSize")&&(T=d.trueSize[0]/E,U=d.trueSize[1]/F),d.hasOwnProperty("setSelect")&&(bg(d.setSelect),bb.done(),delete d.setSelect),ba.refresh(),d.bgColor!=N&&(bq(d.shade?ba.getShades():G,d.shade?d.shadeColor||d.bgColor:d.bgColor),N=d.bgColor),O!=d.bgOpacity&&(O=d.bgOpacity,d.shade?ba.refresh():bb.setBgOpacity(O)),P=d.maxSize[0]||0,Q=d.maxSize[1]||0,R=d.minSize[0]||0,S=d.minSize[1]||0,d.hasOwnProperty("outerImage")&&(D.attr("src",d.outerImage),delete d.outerImage),bb.refresh()}var d=a.extend({},a.Jcrop.defaults),e,f=navigator.userAgent.toLowerCase(),g=/msie/.test(f),h=/msie [1-6]\./.test(f);typeof b!="object"&&(b=a(b)[0]),typeof c!="object"&&(c={}),n(c);var z={border:"none",visibility:"visible",margin:0,padding:0,position:"absolute",top:0,left:0},A=a(b),B=!0;if(b.tagName=="IMG"){if(A[0].width!=0&&A[0].height!=0)A.width(A[0].width),A.height(A[0].height);else{var C=new Image;C.src=A[0].src,A.width(C.width),A.height(C.height)}var D=A.clone().removeAttr("id").
css(z).show();D.width(A.width()),D.height(A.height()),A.after(D).hide()}else D=A.css(z).show(),B=!1,d.shade===null&&(d.shade=!0);t(D,d.boxWidth,d.boxHeight);var E=D.width(),F=D.height(),G=a("<div />").width(E).height(F).addClass(j("holder")).css({position:"relative",backgroundColor:d.bgColor}).insertAfter(A).append(D);d.addClass&&G.addClass(d.addClass);var H=a("<div />"),I=a("<div />").width("100%").height("100%").css({zIndex:310,position:"absolute",overflow:"hidden"}),J=a("<div />").width("100%").height("100%").css("zIndex",320),K=a("<div />").css({position:"absolute",zIndex:600}).dblclick(function(){var a=_.getFixed();d.onDblClick.call(bs,a)}).insertBefore(D).append(I,J);B&&(H=a("<img />").attr("src",D.attr("src")).css(z).width(E).height(F),I.append(H)),h&&K.css({overflowY:"hidden"});var L=d.boundary,M=y().width(E+L*2).height(F+L*2).css({position:"absolute",top:i(-L),left:i(-L),zIndex:290}).mousedown(w),N=d.bgColor,O=d.bgOpacity,P,Q,R,S,T,U,V=!0,W,X,Y;e=l(D);var Z=function(){function a(){var a={},b=["touchstart"
,"touchmove","touchend"],c=document.createElement("div"),d;try{for(d=0;d<b.length;d++){var e=b[d];e="on"+e;var f=e in c;f||(c.setAttribute(e,"return;"),f=typeof c[e]=="function"),a[b[d]]=f}return a.touchstart&&a.touchend&&a.touchmove}catch(g){return!1}}function b(){return d.touchSupport===!0||d.touchSupport===!1?d.touchSupport:a()}return{createDragger:function(a){return function(b){return d.disabled?!1:a==="move"&&!d.allowMove?!1:(e=l(D),W=!0,o(a,m(Z.cfilter(b)),!0),b.stopPropagation(),b.preventDefault(),!1)}},newSelection:function(a){return w(Z.cfilter(a))},cfilter:function(a){return a.pageX=a.originalEvent.changedTouches[0].pageX,a.pageY=a.originalEvent.changedTouches[0].pageY,a},isSupported:a,support:b()}}(),_=function(){function h(d){d=n(d),c=a=d[0],e=b=d[1]}function i(a){a=n(a),f=a[0]-c,g=a[1]-e,c=a[0],e=a[1]}function j(){return[f,g]}function k(d){var f=d[0],g=d[1];0>a+f&&(f-=f+a),0>b+g&&(g-=g+b),F<e+g&&(g+=F-(e+g)),E<c+f&&(f+=E-(c+f)),a+=f,c+=f,b+=g,e+=g}function l(a){var b=m();switch(a){case"ne":return[
b.x2,b.y];case"nw":return[b.x,b.y];case"se":return[b.x2,b.y2];case"sw":return[b.x,b.y2]}}function m(){if(!d.aspectRatio)return p();var f=d.aspectRatio,g=d.minSize[0]/T,h=d.maxSize[0]/T,i=d.maxSize[1]/U,j=c-a,k=e-b,l=Math.abs(j),m=Math.abs(k),n=l/m,r,s,t,u;return h===0&&(h=E*10),i===0&&(i=F*10),n<f?(s=e,t=m*f,r=j<0?a-t:t+a,r<0?(r=0,u=Math.abs((r-a)/f),s=k<0?b-u:u+b):r>E&&(r=E,u=Math.abs((r-a)/f),s=k<0?b-u:u+b)):(r=c,u=l/f,s=k<0?b-u:b+u,s<0?(s=0,t=Math.abs((s-b)*f),r=j<0?a-t:t+a):s>F&&(s=F,t=Math.abs(s-b)*f,r=j<0?a-t:t+a)),r>a?(r-a<g?r=a+g:r-a>h&&(r=a+h),s>b?s=b+(r-a)/f:s=b-(r-a)/f):r<a&&(a-r<g?r=a-g:a-r>h&&(r=a-h),s>b?s=b+(a-r)/f:s=b-(a-r)/f),r<0?(a-=r,r=0):r>E&&(a-=r-E,r=E),s<0?(b-=s,s=0):s>F&&(b-=s-F,s=F),q(o(a,b,r,s))}function n(a){return a[0]<0&&(a[0]=0),a[1]<0&&(a[1]=0),a[0]>E&&(a[0]=E),a[1]>F&&(a[1]=F),[Math.round(a[0]),Math.round(a[1])]}function o(a,b,c,d){var e=a,f=c,g=b,h=d;return c<a&&(e=c,f=a),d<b&&(g=d,h=b),[e,g,f,h]}function p(){var d=c-a,f=e-b,g;return P&&Math.abs(d)>P&&(c=d>0?a+P:a-P),Q&&Math.abs
(f)>Q&&(e=f>0?b+Q:b-Q),S/U&&Math.abs(f)<S/U&&(e=f>0?b+S/U:b-S/U),R/T&&Math.abs(d)<R/T&&(c=d>0?a+R/T:a-R/T),a<0&&(c-=a,a-=a),b<0&&(e-=b,b-=b),c<0&&(a-=c,c-=c),e<0&&(b-=e,e-=e),c>E&&(g=c-E,a-=g,c-=g),e>F&&(g=e-F,b-=g,e-=g),a>E&&(g=a-F,e-=g,b-=g),b>F&&(g=b-F,e-=g,b-=g),q(o(a,b,c,e))}function q(a){return{x:a[0],y:a[1],x2:a[2],y2:a[3],w:a[2]-a[0],h:a[3]-a[1]}}var a=0,b=0,c=0,e=0,f,g;return{flipCoords:o,setPressed:h,setCurrent:i,getOffset:j,moveOffset:k,getCorner:l,getFixed:m}}(),ba=function(){function f(a,b){e.left.css({height:i(b)}),e.right.css({height:i(b)})}function g(){return h(_.getFixed())}function h(a){e.top.css({left:i(a.x),width:i(a.w),height:i(a.y)}),e.bottom.css({top:i(a.y2),left:i(a.x),width:i(a.w),height:i(F-a.y2)}),e.right.css({left:i(a.x2),width:i(E-a.x2)}),e.left.css({width:i(a.x)})}function j(){return a("<div />").css({position:"absolute",backgroundColor:d.shadeColor||d.bgColor}).appendTo(c)}function k(){b||(b=!0,c.insertBefore(D),g(),bb.setBgOpacity(1,0,1),H.hide(),l(d.shadeColor||d.bgColor,1),bb.
isAwake()?n(d.bgOpacity,1):n(1,1))}function l(a,b){bq(p(),a,b)}function m(){b&&(c.remove(),H.show(),b=!1,bb.isAwake()?bb.setBgOpacity(d.bgOpacity,1,1):(bb.setBgOpacity(1,1,1),bb.disableHandles()),bq(G,0,1))}function n(a,e){b&&(d.bgFade&&!e?c.animate({opacity:1-a},{queue:!1,duration:d.fadeTime}):c.css({opacity:1-a}))}function o(){d.shade?k():m(),bb.isAwake()&&n(d.bgOpacity)}function p(){return c.children()}var b=!1,c=a("<div />").css({position:"absolute",zIndex:240,opacity:0}),e={top:j(),left:j().height(F),right:j().height(F),bottom:j()};return{update:g,updateRaw:h,getShades:p,setBgColor:l,enable:k,disable:m,resize:f,refresh:o,opacity:n}}(),bb=function(){function k(b){var c=a("<div />").css({position:"absolute",opacity:d.borderOpacity}).addClass(j(b));return I.append(c),c}function l(b,c){var d=a("<div />").mousedown(s(b)).css({cursor:b+"-resize",position:"absolute",zIndex:c}).addClass("ord-"+b);return Z.support&&d.bind("touchstart.jcrop",Z.createDragger(b)),J.append(d),d}function m(a){var b=d.handleSize,e=l(a,c++
).css({opacity:d.handleOpacity}).addClass(j("handle"));return b&&e.width(b).height(b),e}function n(a){return l(a,c++).addClass("jcrop-dragbar")}function o(a){var b;for(b=0;b<a.length;b++)g[a[b]]=n(a[b])}function p(a){var b,c;for(c=0;c<a.length;c++){switch(a[c]){case"n":b="hline";break;case"s":b="hline bottom";break;case"e":b="vline right";break;case"w":b="vline"}e[a[c]]=k(b)}}function q(a){var b;for(b=0;b<a.length;b++)f[a[b]]=m(a[b])}function r(a,b){d.shade||H.css({top:i(-b),left:i(-a)}),K.css({top:i(b),left:i(a)})}function t(a,b){K.width(Math.round(a)).height(Math.round(b))}function v(){var a=_.getFixed();_.setPressed([a.x,a.y]),_.setCurrent([a.x2,a.y2]),w()}function w(a){if(b)return x(a)}function x(a){var c=_.getFixed();t(c.w,c.h),r(c.x,c.y),d.shade&&ba.updateRaw(c),b||A(),a?d.onSelect.call(bs,u(c)):d.onChange.call(bs,u(c))}function z(a,c,e){if(!b&&!c)return;d.bgFade&&!e?D.animate({opacity:a},{queue:!1,duration:d.fadeTime}):D.css("opacity",a)}function A(){K.show(),d.shade?ba.opacity(O):z(O,!0),b=!0}function B
(){F(),K.hide(),d.shade?ba.opacity(1):z(1),b=!1,d.onRelease.call(bs)}function C(){h&&J.show()}function E(){h=!0;if(d.allowResize)return J.show(),!0}function F(){h=!1,J.hide()}function G(a){a?(X=!0,F()):(X=!1,E())}function L(){G(!1),v()}var b,c=370,e={},f={},g={},h=!1;d.dragEdges&&a.isArray(d.createDragbars)&&o(d.createDragbars),a.isArray(d.createHandles)&&q(d.createHandles),d.drawBorders&&a.isArray(d.createBorders)&&p(d.createBorders),a(document).bind("touchstart.jcrop-ios",function(b){a(b.currentTarget).hasClass("jcrop-tracker")&&b.stopPropagation()});var M=y().mousedown(s("move")).css({cursor:"move",position:"absolute",zIndex:360});return Z.support&&M.bind("touchstart.jcrop",Z.createDragger("move")),I.append(M),F(),{updateVisible:w,update:x,release:B,refresh:v,isAwake:function(){return b},setCursor:function(a){M.css("cursor",a)},enableHandles:E,enableOnly:function(){h=!0},showHandles:C,disableHandles:F,animMode:G,setBgOpacity:z,done:L}}(),bc=function(){function f(b){M.css({zIndex:450}),b?a(document).bind("touchmove.jcrop"
,k).bind("touchend.jcrop",l):e&&a(document).bind("mousemove.jcrop",h).bind("mouseup.jcrop",i)}function g(){M.css({zIndex:290}),a(document).unbind(".jcrop")}function h(a){return b(m(a)),!1}function i(a){return a.preventDefault(),a.stopPropagation(),W&&(W=!1,c(m(a)),bb.isAwake()&&d.onSelect.call(bs,u(_.getFixed())),g(),b=function(){},c=function(){}),!1}function j(a,d,e){return W=!0,b=a,c=d,f(e),!1}function k(a){return b(m(Z.cfilter(a))),!1}function l(a){return i(Z.cfilter(a))}function n(a){M.css("cursor",a)}var b=function(){},c=function(){},e=d.trackDocument;return e||M.mousemove(h).mouseup(i).mouseout(i),D.before(M),{activateHandlers:j,setCursor:n}}(),bd=function(){function e(){d.keySupport&&(b.show(),b.focus())}function f(a){b.hide()}function g(a,b,c){d.allowMove&&(_.moveOffset([b,c]),bb.updateVisible(!0)),a.preventDefault(),a.stopPropagation()}function i(a){if(a.ctrlKey||a.metaKey)return!0;Y=a.shiftKey?!0:!1;var b=Y?10:1;switch(a.keyCode){case 37:g(a,-b,0);break;case 39:g(a,b,0);break;case 38:g(a,0,-b);break;
case 40:g(a,0,b);break;case 27:d.allowSelect&&bb.release();break;case 9:return!0}return!1}var b=a('<input type="radio" />').css({position:"fixed",left:"-120px",width:"12px"}).addClass("jcrop-keymgr"),c=a("<div />").css({position:"absolute",overflow:"hidden"}).append(b);return d.keySupport&&(b.keydown(i).blur(f),h||!d.fixedSupport?(b.css({position:"absolute",left:"-20px"}),c.append(b).insertBefore(D)):b.insertBefore(D)),{watchKeys:e}}();Z.support&&M.bind("touchstart.jcrop",Z.newSelection),J.hide(),br(!0);var bs={setImage:bp,animateTo:bf,setSelect:bg,setOptions:bk,tellSelect:bi,tellScaled:bj,setClass:be,disable:bl,enable:bm,cancel:bn,release:bb.release,destroy:bo,focus:bd.watchKeys,getBounds:function(){return[E*T,F*U]},getWidgetSize:function(){return[E,F]},getScaleFactor:function(){return[T,U]},getOptions:function(){return d},ui:{holder:G,selection:K}};return g&&G.bind("selectstart",function(){return!1}),A.data("Jcrop",bs),bs},a.fn.Jcrop=function(b,c){var d;return this.each(function(){if(a(this).data("Jcrop")){if(
b==="api")return a(this).data("Jcrop");a(this).data("Jcrop").setOptions(b)}else this.tagName=="IMG"?a.Jcrop.Loader(this,function(){a(this).css({display:"block",visibility:"hidden"}),d=a.Jcrop(this,b),a.isFunction(c)&&c.call(d)}):(a(this).css({display:"block",visibility:"hidden"}),d=a.Jcrop(this,b),a.isFunction(c)&&c.call(d))}),this},a.Jcrop.Loader=function(b,c,d){function g(){f.complete?(e.unbind(".jcloader"),a.isFunction(c)&&c.call(f)):window.setTimeout(g,50)}var e=a(b),f=e[0];e.bind("load.jcloader",g).bind("error.jcloader",function(b){e.unbind(".jcloader"),a.isFunction(d)&&d.call(f)}),f.complete&&a.isFunction(c)&&(e.unbind(".jcloader"),c.call(f))},a.Jcrop.defaults={allowSelect:!0,allowMove:!0,allowResize:!0,trackDocument:!0,baseClass:"jcrop",addClass:null,bgColor:"black",bgOpacity:.6,bgFade:!1,borderOpacity:.4,handleOpacity:.5,handleSize:null,aspectRatio:0,keySupport:!0,createHandles:["n","s","e","w","nw","ne","se","sw"],createDragbars:["n","s","e","w"],createBorders:["n","s","e","w"],drawBorders:!0,dragEdges
:!0,fixedSupport:!0,touchSupport:null,shade:null,boxWidth:0,boxHeight:0,boundary:2,fadeTime:400,animationDelay:20,swingSpeed:3,minSelect:[0,0],maxSize:[0,0],minSize:[0,0],onChange:function(){},onSelect:function(){},onDblClick:function(){},onRelease:function(){}}})(jQuery);
</script>