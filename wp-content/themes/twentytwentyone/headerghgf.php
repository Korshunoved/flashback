<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> <?php twentytwentyone_the_html_classes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php wp_head(); ?>
	
	  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/wp-content/themes/twentytwentyone/css/main.min.css">
<link rel="shortcut icon" href="/favicon.ico">
	
	<style>
		.menu-wrapp .create {
			width: auto;
			max-width: 133px;
			white-space: nowrap;
		}

		@media (min-width: 1024px) {
			.menu-wrapp .create-events {
				margin-right: 10px;
			}
		}

		@media (max-width: 1024px) {
			.menu-wrapp .create {
				margin-bottom: 5px;
			}

			.menu-wrapp .create-events a {
				display: block;
				border-radius: 20px;
			}
		}

		.menu-wrapp ul li.works {
			padding-left: 0;
		}
	</style>
</head>

<body>
<header class="header">
  <div class="container">
    <div class="flex">
      <div class="header-left">
        <a href="/" class="logo">
          <img src="/wp-content/themes/twentytwentyone/img/svg/logo.svg" alt="">
        </a>
        <form action="" class="form-search">
          <button>
            <img src="/wp-content/themes/twentytwentyone/img/svg/search.svg" alt="">
          </button>
          <input type="text" placeholder="Search..." class="search-input-placeholder-js">
        </form>
      </div>

      <div class="menu-wrapp" id="menuModal">
        <ul>
          <li class="active"><a href="/">Home</a></li>
          <li><a href="/events/">Events & Circles</a></li>
          <li><a href="/follow/">Following</a></li>
          <li class="works-"><a href="https://www.flashback.one/about-us">How it Works</a></li> 
        </ul>
        <?php
        if( current_user_can( 'subscriber' )) :
				?>

				<div class="create create-events">
					<a href="/personal/">My Events</a>
				</div>

				<?php endif; ?>

        <div class="create">
		
<?
if ( is_user_logged_in() ) {
	?>
	<a href="javascript:void(0);" onclick="$('.create-list').slideToggle();$('.create').toggleClass('active');">Create</a>
	 <ul class="create-list">
<?
 $current_user = wp_get_current_user();
$user_meta = get_userdata($current_user->ID);
$user_roles = $user_meta->roles; 
		



if ( in_array( 'circle', $user_roles, true ) ) 
{
	
	

	
	
?>
 <li><a href="/personal/">Account</a></li>
<?
}
elseif ( in_array( 'influencer', $user_roles, true ) ) 
{
?>
 <li><a href="/personal/">Account</a></li>
<?
}
elseif ( in_array( 'administrator', $user_roles, true ) ) 
{
?>
 <li><a href="/personal/">Account</a></li>
<?
}
else
{
?>
 <li><a href="/personal-user/">Account</a></li>
 <li><a href="/circle-creation/">Circle</a></li>
<?
}
?>
	  
	   
	   
	  <li><? echo wp_loginout();?></li>
	  </ul>
	<?
}
else {
	?>
	<a href="javascript:void(0);" onclick="$('.create-list').slideToggle();">Create</a>
	 <ul class="create-list">
            <li><a href="/log-in/">Log in</a></li>
            <li><a href="/sign-up2/">Sign Up</a></li>
			
          </ul>
	<?
}
?>
          
          
		  
		 
		 
        </div>
          <div class="smile">
          <a href="#" onclick="$('.smile-drop-down').toggleClass('active')" class="smile-link">
            <svg width="106" height="106" aria-hidden="true" class="svg-smile">
              <use xlink:href="#icon-smile-green"></use>
            </svg>
          </a>
		 <?
		 

if ( is_user_logged_in() ) {		 
		 
if ( in_array( 'circle', $user_roles, true ) ) 
{
	
	
	
?>
 <ul class="smile-drop-down">
            <li>
              <a href="/personal/" class="link">
                <span class="icon">
                 		  
		   <?
	
		   $uro=get_user_meta($current_user->ID, $wpdb->get_blog_prefix() . 'user_avatar', true);
			  if (!empty($uro))
				  {
					   echo wp_get_attachment_image( $uro,  array(50,50)); 
				  }
			else
			{
				?>
				 <svg width="53" height="53" aria-hidden="true" class="svg-smile">
                    <use xlink:href="#icon-smile"></use>
                  </svg>
				<?
			}
		 
            
			?>
                </span>
                <span class="text"><?=get_user_meta( $current_user->ID, 'fio', true);?></span>
              </a>
            </li>
			<?
			
			
				$idup=get_user_meta( $current_user->ID, 'mainidu', true);
					if (!empty($idup))
					{
						
						
						?>
						 <li>
              <a href="javascript:void(0)" onclick="avto('<?=$idup?>') class="link">
                <span class="icon">
                 		  
		   <?
	
		   $uro=get_user_meta($idup, $wpdb->get_blog_prefix() . 'user_avatar', true);
			  if (!empty($uro))
				  {
					   echo wp_get_attachment_image( $uro,  array(50,50)); 
				  }
			else
			{
				?>
				 <svg width="53" height="53" aria-hidden="true" class="svg-smile">
                    <use xlink:href="#icon-smile"></use>
                  </svg>
				<?
			}
		 
            
			?>
                </span>
                <span class="text"><?=get_user_meta( $idup, 'fio', true);;?></span>
              </a>
            </li>
					<?
						
					}
					
			?>
			
			
			
			
			
			
           
            <li>
              <a href="<? echo wp_logout_url()?>" class="link">
                <span class="icon"></span>
                <span class="text">Log Out</span>
              </a>
            </li>
          </ul>
<?
}
elseif ( in_array( 'influencer', $user_roles, true ) ) 
{

?>
 <ul class="smile-drop-down">
            <li>
              <a href="/personal-user/" class="link">
                <span class="icon">
                 
				  
				  
		   <?
	
		   $uro=get_user_meta($current_user->ID, $wpdb->get_blog_prefix() . 'user_avatar', true);
			  if (!empty($uro))
				  {
					   echo wp_get_attachment_image( $uro,  array(50,50)); 
				  }
			else
			{
				?>
				 <svg width="53" height="53" aria-hidden="true" class="svg-smile">
                    <use xlink:href="#icon-smile"></use>
                  </svg>
				<?
			}
		 
            
			?>
				  
				  
                </span>
                <span class="text"><?
				$fio=get_user_meta( $current_user->ID, 'fio', true);
				if (empty($fio))
				{
				echo 'John Doe';
				}
				else
				{
				echo $fio;
				}
				?></span>
              </a>
            </li>
           
            <li>
              <a href="<? echo wp_logout_url()?>" class="link">
                <span class="icon"></span>
                <span class="text">Log Out</span>
              </a>
			 
            </li>
          </ul>

<?
}
elseif ( in_array( 'administrator', $user_roles, true ) ) 
{
?>
 <ul class="smile-drop-down">
            <li>
              <a href="/personal/" class="link">
                <span class="icon">
                 		  
		   <?
	
		   $uro=get_user_meta($current_user->ID, $wpdb->get_blog_prefix() . 'user_avatar', true);
			  if (!empty($uro))
				  {
					   echo wp_get_attachment_image( $uro,  array(50,50)); 
				  }
			else
			{
				?>
				 <svg width="53" height="53" aria-hidden="true" class="svg-smile">
                    <use xlink:href="#icon-smile"></use>
                  </svg>
				<?
			}
		 
            
			?>
                </span>
                <span class="text"><?=$fio=get_user_meta( $current_user->ID, 'fio', true);?></span>
              </a>
            </li>
           
            <li>
              <a href="<? echo wp_logout_url()?>" class="link">
                <span class="icon"></span>
                <span class="text">Log Out</span>
              </a>
			 
            </li>
          </ul>
<?
}
else
{
?>
 <ul class="smile-drop-down">
            <li>
              <a href="/personal-user/" class="link">
                <span class="icon">
                    <?
	
		   $uro=get_user_meta($current_user->ID, $wpdb->get_blog_prefix() . 'user_avatar', true);
			  if (!empty($uro))
				  {
					   echo wp_get_attachment_image( $uro,  array(50,50)); 
				  }
			else
			{
				?>
				 <svg width="53" height="53" aria-hidden="true" class="svg-smile">
                    <use xlink:href="#icon-smile"></use>
                  </svg>
				<?
			}
		 
            
			?>
                </span>
                <span class="text"><?
				$fio=get_user_meta( $current_user->ID, 'fio', true);
				if (empty($fio))
				{
				echo 'John Doe';
				}
				else
				{
				echo $fio;
				}
				?></span>
              </a>
            </li>
			<?
$users = get_users( [
	'role__in'     => array(),
	'role__not_in' => array(),
	'meta_key'     => '',
	'meta_value'   => '',
	'meta_compare' => '',
	'meta_query'   => array(),
	'include'      => array(),
	'exclude'      => array(),
	'orderby'      => 'login',
	'order'        => 'ASC',
	'offset'       => '',
	'search'       => '',
	'search_columns' => array(),
	'number'       => '',
	'paged'        => 1,
	'count_total'  => false,
	'fields'       => 'all',
	'who'          => '',
	'role'=>'circle',
	'has_published_posts' => null,
	'date_query'   => array() // смотрите WP_Date_Query
] );

foreach( $users as $user8 )
{
		 $idup=get_user_meta( $user8->ID, 'mainidu', true);
		 if ($idup==$current_user->ID)
		 {
			?>
			
            <li>
              <a href="javascript:void(0)" onclick="avto('<?=$user8->ID?>')" class="link">
                <span class="icon">
                 
				  
				      <?
	
		   $uro=get_user_meta($user8->ID, $wpdb->get_blog_prefix() . 'user_avatar', true);
			  if (!empty($uro))
				  {
					   echo wp_get_attachment_image( $uro,  array(100,100)); 
				  }
			else
			{
				?>
				  <svg width="53" height="53" aria-hidden="true" class="svg-smile">
                    <use xlink:href="#icon-circle"></use>
                  </svg>
				<?
			}
				  
				  ?>
                </span>
                <span class="text"><? echo $fio=get_user_meta( $user8->ID, 'fio', true); ?></span>
              </a>
            </li>
			
			<?
		 }
}
			?>
            <li>
              <a href="<? echo wp_logout_url()?>" class="link">
                <span class="icon"></span>
                <span class="text">Log Out</span>
              </a>
			  
            </li>
          </ul>
<?
}


}
else
{
	
}
?>

         
		  
		  
		  
		  
        </div>
      </div>
      <button class="header__burger">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <!--        <svg width="32" height="21" aria-hidden="true">-->
        <!--          <use xlink:href="#icon-burger" class="burger"></use>-->
        <!--          <use xlink:href="#icon-burger-active" class="burger-active"></use>-->
        <!--        </svg>-->
      </button>
    </div>
  </div>
</header>

