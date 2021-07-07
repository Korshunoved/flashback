<?php
/*
Template Name: public-user
*/

get_header(); 

if (!empty($_GET['id']))
{

$idd=$_GET['id'];
$user_meta = get_userdata($idd);
$user_roles = $user_meta->roles; 
		

if ( in_array( 'subscriber', $user_roles, true ) ) 
{
?>
<section class="section-banner">
<?
	  $user = get_user_by('id', $idd);
	 
$ban=get_user_meta( $user->ID, 'ban', true);
  if (!empty($ban))
				  {
					  ?>
					    <div class="baner-default " style="background: url(<?=$ban?>)">
					  
  </div>
					  <?
					  
				  }
				  else
				  {
					  ?>
					   
  <div class="baner-default green-bg">

  </div>
					  <?
					  
				  }
				  
$sbor=array();
$folo=get_user_meta($idd, 'buytik', true);
$fol=explode(';',$folo);
foreach ($fol as $pop)
{
	
if (!empty($pop))	
{
$idf = get_post_meta($pop, '_number_tov', true);
$sbor[]=$idf;	
}
	
}
				  
				  
?>


</section>




<main class="page-user">
  <div class="container">
    <div class="row justify-content-between">
      <aside class="sidebar col">
        <div class="sidebar-banner-top">
             <div href="#" class="smile">
		  
		   <?
	
		   $uro=get_user_meta($idd, $wpdb->get_blog_prefix() . 'user_avatar', true);
			  if (!empty($uro))
				  {
					   echo wp_get_attachment_image( $uro,  array(100,100)); 
				  }
			else
			{
				?>
				<svg width="199" height="199" aria-hidden="true" class="svg-smile">
              <use xlink:href="#icon-smile"></use>
            </svg>
				<?
			}
		 
            
			?>
		  
          
          </div>
        </div>
        <div class="h3">
		<?
		
echo $fio=get_user_meta( $idd, 'fio', true);
		?>
		</div>

        <p class="text-center"><? echo get_user_meta( $idd, 'goro', true);?>, <? echo get_user_meta( $idd, 'cont', true);?></p>
		
      </aside>
      <article class="content col">
        <ul class="tabs nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true">FlashBs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tab-2" role="tab" aria-controls="tab-2" aria-selected="false">Liked</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tab-3" role="tab" aria-controls="tab-3" aria-selected="false">Following</a>
          </li>
        </ul>

        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade active show" id="tab-1" role="tabpanel">
            <ul class="events-list">
			<?
			foreach( $sbor as $pst )
			{			
$prod=$pst;
$dat=get_post_meta( $prod, '_text_dat', true);
$er=explode('-',$dat);
	 $tu=$er[0].'.'.$er[1];

		  ?>
              <li style="cursor:pointer"  onclick="window.location.href='/event/?id=<?=$prod?>'">
                <div class="img"><img src="<? echo  get_the_post_thumbnail_url( $prod, 'thumbnail' );?>" alt=""></div>
                <div class="h4"><? echo $post->post_title?> - <span><?=$tu?></span></div>
                
              </li>
           	<?
		   }
           ?>
            </ul>
          </div>
          <div class="tab-pane fade" id="tab-2" role="tabpanel">
            <ul class="events-list sm">
             
            </ul>
          </div>
          <div class="tab-pane fade" id="tab-3" role="tabpanel">
            <div class="following-wrapp">
             
			 <?
$folo=get_user_meta( $idd, 'follow', true);
$fol=explode(';',$folo);
foreach ($fol as $cir)
{
	if (!empty($cir))
	{
		   $uro=get_user_meta($cir, $wpdb->get_blog_prefix() . 'user_avatar', true);
			 ?>
			 
			 
			   <div class="item">
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
				<svg width="87" height="87" aria-hidden="true" class="svg-smile">
                    <use xlink:href="#icon-smile"></use>
                  </svg>
				
				<?
			}
		 
            
			?>
				  
                </div>
                <div style="cursor:pointer" onclick="window.location.href='/circle/?id=<?=$cir?>'" class="item-desc">
                  <div class="price"><? echo $fio=get_user_meta( $cir, 'fio', true); ?></div>
                </div>
              </div>
	<?
	}
}
	?>		 
			 
			 
			 
			 
			 
			 
            </div>
          </div>

        </div>
      </article>
    </div>
  </div>


</main>
















<?php 
}
}

get_footer(); ?>
