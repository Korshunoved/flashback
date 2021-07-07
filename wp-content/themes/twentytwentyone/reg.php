<?php
/*
Template Name: reg
*/
$error='';
get_header(); 
/*
if (!empty($_POST['ema1']))
{

	$userdata = array(
	'ID'              => 0,  
	'user_pass'       => $_POST['pas1'], 
	'user_login'      => $_POST['ema1'], 
	'user_nicename'   => '',
	'user_url'        => '',
	'user_email'      => $_POST['ema1'],
	'display_name'    => $_POST['ema1'],
	'nickname'        => '',
	'first_name'      => '',
	'last_name'       => '',
	'description'     => '',
	'rich_editing'    => 'true', 
	'user_registered' => date('Y-m-d H:i:s'),
	'role'            => 'subscriber', 
);

$id=wp_insert_user( $userdata );
	if ($id)
	{
	$error = 'Successful registration';

	
		?>
	<meta http-equiv="refresh" content="1;URL=/circle-creation/" />
	<?
		
		
	}
}
*/


?>
<main class="page-signup">
  <div class="container">
    <div class="row ">
      <div class="col-md-12">
        <div class="logo">
          <a href="#">
            <img src="img/svg/logo-green.svg" alt="">
          </a>
        </div>

        <div class="h3">Sign up for FlashBack</div>
      </div>
     
    <div class="col-md-5">
        <div class="login login_social">
          <a href="#" class="btn btn_red">Log In with Google</a>
          <a href="#" class="btn btn_blue">Log In with Facebook</a>
        </div>
      </div>
      <div class="col-md-2">
        <b>or</b>
      </div>
 <div class="col-md-5">
        <form method="post">
          <input type="email" name="ema1" placeholder="Email Adress *" required class="input">
          <input type="password" name="pas1" placeholder="Password *" required class="input">
          <div class="checkbox-info">
            <p>Password must be at least 8 characters and contain 1 special character or number. </p>
            <div class="checkbox-block">
              <input type="checkbox" disabled="disabled" class="checkbox" id="check" checked>
              <label for="check"><span>Stay up to date with Flashback Newsletter</span></label>
            </div>
          </div>
          <button type="submit" name="sub" class="btn btn_green">Sign up with Email</button>
		  
		    <?php if ($error) { ?>
						<div class="alert alert-dismissible alert-danger">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<?php echo $error; ?>
						</div>
					<?php } ?>
		  
		  
		  
        </form>
      </div>
    </div>
  </div>


</main>

<?php get_footer(); ?>
