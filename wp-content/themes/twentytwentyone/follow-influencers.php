<?php
/*
Template Name: follow-influencers
*/

get_header(); 


?>
<?php
/*
Template Name: follow
*/
get_header(); 


if (!empty($_GET['un']))
{
$current_user = wp_get_current_user();
$idi=$current_user->ID;
$folo=get_user_meta($idi, 'follow', true);
$fol=explode(';',$folo);
$nov=array();
foreach ($fol as $fu)
{
	if ($fu!=$_GET['un'])
	{
		$nov[]=$fu;
	}
	
	
}
$fo=implode(';',$nov);	
	update_user_meta( $idi, 'follow', $fo);	
		header("Location: /follow/?id=".$idd9); 		
	
}


$cir=array();$inf=array();
$current_user = wp_get_current_user();
$idi=$current_user->ID;

$folo=get_user_meta( $idi, 'follow', true);
$fol=explode(';',$folo);
$fol= array_diff($fol, array(''));

if ( (empty($fol))  )
{
	?>
	<main class="page-main events-circles following">
  <div class="container">
    <div class="not-following">
      <div class="h2">You’re not following anyone yet :( </div>
    </div>
  </div>
</main>
	<?
}
else
{
	
foreach ($fol as $ud)
{
	

$user_meta = get_userdata($ud);
$user_roles = $user_meta->roles;

if ( in_array( 'influencer', $user_roles, true ) ) 
{
$inf[]=$ud;  
}
else
{
$cir[]=$ud;  	
}

	
}
if (empty($inf))
{
	?>
	<main class="page-main events-circles following">
  <div class="container">
    <div class="not-following">
      <div class="h2">You’re not following anyone yet :( </div>
    </div>
  </div>
</main>
	<?
}
else
{
?>

<main class="page-main events-circles following">
  <div class="container">
    
    <div class="event">
      <div class="h2">Influencers</div>
	   <?
	  if (!empty($inf))
	  {
		  ?>
		  <div class="owl-carousel-slider-4 owl-carousel owl-theme owl-product">
		  <?
		    foreach ($inf as $use)
		  {
			 

			 
	  ?>
	  
      
	<?  
$uro=get_user_meta($use, $wpdb->get_blog_prefix() . 'user_avatar', true);
if ($uro)
{
?>	
 <div class="item">
          <div class="icon">
            <div class="img">
              <? echo wp_get_attachment_image( $uro,  array(300,300)); ?>
            </div>
            <a href="/follow/?un=<?=$use?>" class="btn btn_red md-hide">
              <span>Unfollow</span>
            </a>
          </div>
          <div class="item-desc">
            <div class="price h3"><? echo $fio=get_user_meta( $use, 'fio', true); ?></div>
            <a href="/circle/?id=<?=$use?>" class="btn btn_red  md-visible">
              <span>-</span>
            </a>
          </div>
        </div>
<?	
}
else
{
?>	
  <div class="item">
          <div class="icon">
            <svg width="132" height="132" aria-hidden="true">
              <use xlink:href="#icon-smile"></use>
            </svg>
            <a href="/follow/?un=<?=$use?>" class="btn btn_red md-hide">
              <span>Unfollow</span>
            </a>
          </div>
          <div class="item-desc">
            <div class="price h3"><? echo $fio=get_user_meta( $use, 'fio', true); ?></div>
            <a href="/circle/?id=<?=$use?>" class="btn btn_red  md-visible">
              <span>-</span>
            </a>
          </div>
        </div>
<?
}

	  ?>
       
		
		
      
		
		
	
		
		
    

	<?
		  }  
		  ?>
		  </div>
		 <? 
	  }
		?>



    </div>
  </div>
</main>
<?
}
}
?>
<?php get_footer(); ?>

<?php get_footer(); ?>
