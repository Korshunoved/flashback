<?php
/*
Template Name: HomePage
*/

get_header(); ?>

<style>
.hide-scrollbar ::-webkit-scrollbar-thumb{
    visibility : hidden;
}
</style>
<main class="page-main">
  <div class="container">
    <div class="row justify-content-between">
      <aside class="sidebar col">
        <div class="h2 lg-visible">Upcoming Events</div>
        <ul class="list">
		
		
		<?
		$my_posts6 = new WP_Query;

// делаем запрос
$myposts6 = $my_posts6->query( array(
	'post_type' => 'product',
	'orderby' => 'ID',
	'posts_per_page' => 5000,
	'meta_query' => array(
    array(
      'key'     => '_number_tov',
      'compare' => 'NOT EXISTS'
    ),
  ),
) );
$data=date('d-m-Y');$all=array();
$ter=strtotime($data);
$today=array();
$fut=array();
$past=array();


foreach( $myposts6 as $pst ){
	 $pd=$pst->ID;
	 $dat=get_post_meta( $pd, '_text_dat', true);
	 $er=explode('.',$dat);
	 $tu=$dat;
    $tert=strtotime($tu);
	$all[]=$pd;
	if ($data==$dat)
	{
		
	}
    else
	{
		if ($tert>$ter)
		{
		
			$fut[]=$pd;
		
		}
		else
		{
			
		}
		
	}
	 
}
$pp1=0;
foreach ($fut as $prod)
{
	if ($pp1>3)
	{
		break;
	}
?>
   <li><a href="/event/?id=<?=$prod?>"><img src="<? echo  get_the_post_thumbnail_url( $prod, 'full' );?>" alt=""></a></li>
<?	
	$pp1++;
}
?>

		
		
		
		
		
		
		
		
       
        
        </ul>
      </aside>
     <article class="content padding-right-60">
        <div class="h2">Top Circles</div>
        <div class="menu-product">
		
		 
		 <div class="owl-carousel-slider-3 owl-carousel owl-theme">
       
		  
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
$tar=1;$del=array();
foreach( $users as $user )
{

$my_posts = new WP_Query;
$myposts9 = $my_posts->query( array(
	'post_type' => 'product',
	'meta_query' => array(
        array(
            'key' => '_number_cir',
            'value' => $user->ID,
        ),
    ),
) );
	$gah=array();
	if (!empty($myposts9 ))
	{
	foreach( $myposts9 as $pst )
	{	
$ha=get_post_meta( $pst->ID, '_text_hash', true);
 $ha1=explode(',',$ha);

 foreach ($ha1 as $hop)
 {
	 if (!empty($hop))
	 {
	$gah[]=$hop; 	 
	 }
 
 }
		
		
		
	}
	
}
	$de[$user->ID]=implode(', ',$gah);
}

?>
 <div class="item">
              <ul class="menu-product-list">
			  <?
foreach( $users as $user )
{
	
	   $uro=get_user_meta($user->ID, $wpdb->get_blog_prefix() . 'user_avatar', true);
		?>
		
		
                <li>
                  <div 
				  <?
							  if (strlen($uro)>0) {
							  }
							  else
							  {
								  
								  ?>
								 style="background:url(/wp-content/themes/twentytwentyone/img/svg/circle.svg) 0 0/cover"  
								  <?
							  }
							?>
							
				  
				  
				  class="icon">
                    <?
	
		
			  if (!empty($uro))
				  {
					   echo wp_get_attachment_image( $uro,  array(100,100)); 
				  }
			else
			{
				?>
				
				
				<?
			}
		 
            
			?>
		  
                  </div>
                  <div class="menu-product-desc">
                    <div class="numb"><?=$tar?> .</div>
                    <div>
                      <div style="cursor:pointer" onclick="window.location.href='/circle/?id=<?=$user->ID?>'" class="name"><? echo $fio=get_user_meta( $user->ID, 'fio', true); ?></div>
                      <div class="marka">
					  <?
					  if (!empty($de[$user->ID]))
					  {
						 
					 echo $de[$user->ID];
					  }
					  ?>
					  </div>
                    </div>
                  </div>
                </li>
				<?
				if ($tar%2==0)
				{
					?>
					 </ul>
            </div>
			<div class="item">
              <ul class="menu-product-list">
					<?
					
				}
				?>
				
            
                
				
				
				
          
           
<?
$tar++;
}
		  ?>
         
            </ul>
            </div>

		  
		  
		  </div>
        </div>

        <div class="h2">Newly Added</div>
        <div class="newly-added">
          <div class="owl-carousel-slider-4 owl-carousel owl-theme">
		  <?
		  $my_posts5 = new WP_Query;

// делаем запрос
$myposts5 = $my_posts5->query( array(
	'post_type' => 'product',
	'orderby' => 'ID',
	'posts_per_page' => -1,
	'meta_query' => array(
    array(
      'key'     => '_number_tov',
      'compare' => 'NOT EXISTS'
    ),
  ),
) );

foreach( $myposts5 as $pst ){


 $dat=get_post_meta( $pst->ID, '_text_dat', true);
 
  $er=explode('-',$dat);
	 $tu=$er[0].'.'.$er[1];

?>
		  <div onclick="window.location.href='/event/?id=<?=$pst->ID?>'" class="item">
              <div class="img"><img src="<? echo  get_the_post_thumbnail_url( $pst->ID, 'full' );?>" alt=""></div>
              <div class="h4"><? echo $pst->post_title?>  - <span><?=$tu?></span></div>
            </div>
        
			
         <?
}
		 ?>   
        </div>
        </div>

      </article>
    </div>
  </div>


</main>
<script>
jQuery('html').addClass('hide-scrollbar');
</script>
<?php get_footer(); ?>
