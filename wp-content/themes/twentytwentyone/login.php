<?php
/*
Template Name: login
*/
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
get_header(); 
$error = null;

if(!empty($_POST)) {
	$creds = array();
	$creds['user_login'] = trim($_POST['ema']);
	$creds['user_password'] = trim($_POST['pas']);
	$user = wp_signon($creds, false);

	if($user->errors) {
		$error = 'wrong login or password';
	
	} else {
		custom_login();
	?>
	<meta http-equiv="refresh" content="1;URL=/personal/" />
	<?
		
		$error = null;
	}
}


?>
<main class="page-login">
  <div class="container">
    <div class="row ">
      <div class="col-md-12">
        <div class="logo">
          <a href="#">
            <img src="/wp-content/themes/twentytwentyone/img/svg/logo-green.svg" alt="">
          </a>
        </div>

        <div class="h3">Log In</div>
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
        <form method="post" >
          <input type="email" name="ema" placeholder="Email Adress *" required class="input">
          <input type="password" name="pas" placeholder="Password *" required class="input">
          <button type="submit" name="sub" class="btn btn_green">Log In</button>
		  
		  
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
