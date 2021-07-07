<?php
/*
Template Name: vendorinfo
*/

get_header(); 

if (!empty($_POST['sub']))
{
$current_user = wp_get_current_user();
if( $current_user->ID ){
$idi=$current_user->ID;

if (!empty( $_POST['fio']))
{
update_user_meta( $idi, 'fio', $_POST['fio'] );	
}
if (!empty( $_POST['coun']))
{
update_user_meta( $idi, 'coun', $_POST['coun'] );
}
if (!empty( $_POST['city']))
{
update_user_meta( $idi, 'cit', $_POST['city'] );
}
	
	
if (!empty( $_POST['type']))
{
update_user_meta( $idi, 'type', $_POST['type'] );	
}
if (!empty( $_POST['conper']))
{
update_user_meta( $idi, 'conper', $_POST['conper'] );
}
if (!empty( $_POST['ema']))
{
update_user_meta( $idi, 'conema', $_POST['ema'] );
}	
	
if (!empty( $_POST['views']))
{
update_user_meta( $idi, 'often', $_POST['views'] );
}	
	
if (!empty( $_POST['insta']))
{
update_user_meta( $idi, 'insta', $_POST['insta'] );
}
if (!empty( $_POST['web']))
{
update_user_meta( $idi, 'web', $_POST['web'] );
}
if (!empty( $_POST['twi']))
{
update_user_meta( $idi, 'twi', $_POST['twi'] );
}	
	
	
	
	
if (!empty( $_POST['bio']))
{
$user_id = wp_update_user( array(
  'ID'              => $idi,
  'description'      => $_POST['bio'],
 ));
}
	
}
	
}

 $current_user = wp_get_current_user();
 $fio=get_user_meta( $current_user->ID, 'fio', true);
 $coun=get_user_meta( $current_user->ID, 'coun', true);
 $city=get_user_meta( $current_user->ID, 'cit', true);
 
  $type=get_user_meta( $current_user->ID, 'type', true);
 $conper=get_user_meta( $current_user->ID, 'conper', true);
 
  $conema=get_user_meta( $current_user->ID, 'conema', true);
   $bio=$current_user->description;
   
     $often=get_user_meta( $current_user->ID, 'often', true);
	 
	 
	 $inst=get_user_meta( $current_user->ID, 'insta', true);
	 $web=get_user_meta( $current_user->ID, 'web', true);
	 $twi=get_user_meta( $current_user->ID, 'twi', true);
	 
	$ban=get_user_meta( $current_user->ID, 'ban', true);
	

	
	
	
if (!empty($_FILES['file6']))
{
	
$attachment_id = media_handle_upload( 'file6',$current_user->ID );
if ($attachment_id)	
{
	 update_user_meta($current_user->ID, $wpdb->get_blog_prefix() . 'user_avatar', $attachment_id );	
}

}
       
if (!empty($_FILES['file7']))
{
	
$attachment_id1 = media_handle_upload( 'file7',$current_user->ID );	

$urlo=wp_get_attachment_image_url($attachment_id1 );
update_user_meta( $idi, 'ban', $urlo );
}
      

	
?>
<main class="page-login page-circle">
  <div class="container">
    <form  enctype="multipart/form-data" method="post" class="form">

      <div class="row ">
        <div class="col-md-12">
          <div class="logo">
            <a href="#">
			<?
			  $uro=get_user_meta($current_user->ID, $wpdb->get_blog_prefix() . 'user_avatar', true);
			  if (!empty($uro))
				  {
					   echo wp_get_attachment_image( $uro,  array(100,100)); 
				  }
			else
			{
				?>
				<img src="/wp-content/themes/twentytwentyone/img/svg/logo-green.svg" alt="">
				<?
			}
			 ?>
              
            </a>
          </div>
          <div class="h3">Circle creation</div>
        </div>
        <div class="col-md-6">
          <ul class="list">
            <li>
              <input type="text" name="fio" value="<?=$fio?>" required placeholder="Circle Name*" class="input">
            </li>
            <li>
              <ul class="list-in">
                <li><input type="text" name="coun" value="<?=$coun?>" required placeholder="Country*" class="input"></li>
                <li><input type="text" name="city"  value="<?=$city?>" required placeholder="City*" class="input"></li>
              </ul>
            </li>
			
			
			<li>
              <ul class="list-in">
                <li><input type="text" name="insta" value="<?=$inst?>"  placeholder="Instagram" class="input"></li>
                <li><input type="text" name="web"  value="<?=$web?>"  placeholder="Web" class="input"></li>
				  <li><input type="text" name="twi"  value="<?=$twi?>"  placeholder="Twitter" class="input"></li>
              </ul>
            </li>
			
			
			
			
            <li>
              <div class="select">
                <a href="#" id="typ1" class="slct">
				<?
				if (!empty($type))
				{
				echo $type;	
				}
				else
				{
				?>	
				Type of Events<i class="fa fa-caret-down" aria-hidden="true"></i>
				<?
				}
				?>
				
				
				</a>
                <ul onclick="setTimeout(function() {
   $('#typ').val($('#typ1').text())
  }, 2000);" class="drop">
                  <li>Type - 1</li>
                  <li>Type - 1</li>
                  <li>Type - 2</li>
                  <li>Type - 3</li>
                </ul>
                <input name="type" id="typ" type="hidden" name="type"/>
              </div>
            </li>
            <li><input type="text" value="<?=$conper?>" name="conper" required placeholder="Contact Person*" class="input"></li>
            <li><input type="email" value="<?=$conema?>" name="ema" required placeholder="Contact Email*" class="input"></li>
          </ul>
        </div>
        <div class="col-md-6">
          <ul class="list">
            <li><textarea placeholder="Bio" name="bio" class="input"><?=$bio?></textarea></li>
            <li>
              <div class="inputfile-box">
                <input type="file" name="file6" id="input_logo" class="inputfile"
                       data-multiple-caption="{count} files selected" multiple="">
                <label for="input_logo">
                  <strong>Upload</strong>
                  <span>Logo</span>
                </label>
              </div>
            </li>
            <li>
			<?
			if (!empty($ban))
			{
				
				?>
					<img style="width:100px;heigth:auto" src="<?=$ban?>" alt="">
				<?
			}
			?>
              <div class="inputfile-box">
                <input type="file" name="file7" id="input_bnner" class="inputfile"
                       data-multiple-caption="{count} files selected" multiple="">
                <label for="input_bnner">
                  <strong>Upload</strong>
                  <span>Banner</span>
                </label>
              </div>
            </li>
            <li>
              <div class="select">
                <a href="#" id="vi1" class="slct">
				
				<?
				if (!empty($often))
				{
				echo $often;	
				}
				else
				{
				?>	
				How often do you organize events?<i class="fa fa-caret-down" aria-hidden="true"></i></i>
				<?
				}
				?></a>
                <ul  onclick="
				setTimeout(function() {
$('#vi').val($('#vi1').text())
  }, 2000);
				" class="drop">
                  <li>once a day</li>
                  <li>once a month</li>
                  <li>once a year</li>
                </ul>
                <input id="vi" type="hidden" name="views"/>
              </div>
            </li>
          </ul>
        </div>
        <div class="col-md-12">
          <button class="btn btn_light_green" name="sub" value="sub" type="Submit">Submit</button>
        </div>
      </div>
    </form>
  </div>
</main>


<?php get_footer(); ?>
