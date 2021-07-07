<?php
/*
Template Name: circle
*/
$error='';
get_header(); 




if (!empty($_GET))
{


if (!empty($_GET['follow']))
{

$idd9=$_GET['id'];	
$current_user = wp_get_current_user();
$idi=$current_user->ID;

	if($_GET['follow']=='yes')
	{



$folo=get_user_meta($idi, 'follow', true);
$fol=explode(';',$folo);
$fol[]=$idd9;
$fo=implode(';',$fol);	
	
update_user_meta( $idi, 'follow', $fo);

	
header("Location: /circle/?id=".$idd9); 		
		
		
		
		
	}
elseif($_GET['follow']=='no')
	{
		
$folo=get_user_meta($idi, 'follow', true);
$fol=explode(';',$folo);
$nov=array();
foreach ($fol as $fu)
{
	if ($fu!=$idd9)
	{
		$nov[]=$fu;
	}
	
	
}
$fo=implode(';',$nov);	
	update_user_meta( $idi, 'follow', $fo);	
		header("Location: /circle/?id=".$idd9); 		
		
		
	}
	
}



$idd=$_GET['id'];

$my_posts = new WP_Query;

// делаем запрос
$myposts = $my_posts->query( array(
	'post_type' => 'product',
	'meta_query' => array(
        array(
            'key' => '_number_cir',
            'value' => $idd,
			
        ),
    ),
) );
$data=date('d-m-Y');$all=array();
$ter=strtotime($data);
$today=array();
$fut=array();
$past=array();
foreach( $myposts as $pst ){
	 $pd=$pst->ID;
	 $dat=get_post_meta( $pd, '_text_dat', true);
	 $er=explode('.',$dat);
	 $tu=$dat;
    $tert=strtotime($tu);
	
	if ($data==$dat)
	{
		$today[]=$pd;
	}
    else
	{
		if ($tert>$ter)
		{
			$fut[]=$pd;
		}
		else
		{
			$past[]=$pd;
		}
		
	}
	 
}
foreach ($fut as $fu)
{
$all[]=$fu;	
}

foreach ($today as $too)
{
$all[]=$too;
}

foreach ($past as $ps)
{
$all[]=$ps;
}




$user_meta = get_userdata($_GET['id']);
$user_roles = $user_meta->roles; 




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
					    <div class="baner-default " style="background: url(/wp-content/themes/twentytwentyone/img/ban-backg.jpg)">
  </div>
					  <?
					  
				  }
?>
 
</section>
<main class="page-user circle-profile">
  <div class="container">
    <div class="row justify-content-between">
      <aside class="sidebar col lg-hide">
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
              <use xlink:href="#icon-circle"></use>
            </svg>
				<?
			}
		 
            
			?>
			
          </div>
        </div>
        <div class="h3"><?
		

echo $fio=get_user_meta( $user->ID, 'fio', true);

$insta=get_user_meta( $user->ID, 'insta', true);
$web=get_user_meta( $user->ID, 'web', true);
$twi=get_user_meta( $user->ID, 'twi', true);

$current_user = wp_get_current_user();
$idi=$current_user->ID;

$folo=get_user_meta( $idi, 'follow', true);
$fol=explode(';',$folo);
		?></div>
        <p><?
		
echo $des=$user->description;
		?></p>
        <ul class="social">
          <li>
            <svg width="17" height="17" aria-hidden="true" class="svg-smile">
              <use xlink:href="#icon-insta"></use>
            </svg>
            <a href=""><?=$insta?></a>
          </li>
          <li>
            <svg width="17" height="17" aria-hidden="true" class="svg-smile">
              <use xlink:href="#icon-site"></use>
            </svg>
            <a href="<?=$web?>"><?=$web?></a>
          </li>
          <li>
            <svg width="17" height="13" aria-hidden="true" class="svg-smile">
              <use xlink:href="#icon-telegram"></use>
            </svg>
            <a href=""><?=$twi?></a>
          </li>
        </ul>
<?php if(is_user_logged_in()) 
{

if (in_array($idd, $fol)) 
{
?>
   <a href="/circle/?id=<?=$idd?>&follow=no" class="btn btn_green">UNFOLLOW</a>
<?php 
}
else
{
?>
   <a href="/circle/?id=<?=$idd?>&follow=yes" class="btn btn_green">FOLLOW</a>
<?php 	
}
	
	


} 
else
{
	?>
   <a href="/log-in/" class="btn btn_green">FOLLOW</a>
<?php 
}
?>
     
      </aside>
	  
	<?
if ( in_array( 'circle', $user_roles, true ) ) 
{
?>
 
      <article class="content col">
	     <ul class="tabs nav nav-tabs nav-tabs-white" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#tab-1" role="tab"
               aria-controls="tab-1" aria-selected="false">Today <span><?=count($today)?></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link " data-toggle="tab" href="#tab-2" role="tab"
               aria-controls="tab-2" aria-selected="false">Upcoming  <span><?=count($fut)?></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link " data-toggle="tab" href="#tab-3" role="tab"
               aria-controls="tab-3" aria-selected="false">Past <span><?=count($past)?></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link " data-toggle="tab" href="#tab-4" role="tab"
               aria-controls="tab-4" aria-selected="false">Full Collection</a>
          </li>
        </ul>
        

        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="tab-1" role="tabpanel">
		  
		  <?
		  foreach ($today as $prod)
		  {

$post = get_post($prod);

 $dat=get_post_meta( $prod, '_text_dat', true);
 
  $er=explode('-',$dat);
	 $tu=$er[0].'.'.$er[1];
 
 
		  ?>
            <div class="your-event">
              <div style="cursor:pointer"  onclick="window.location.href='/event/?id=<?=$prod?>'" class="img">
                <div class="img-in">
                  <img src="<? echo  get_the_post_thumbnail_url( $prod, 'full' );?>" alt="">
                </div>
                <div class="h4"><? echo $post->post_title?> - <span><?=$tu?></span></div>
              </div>
              <div class="desc desc_qrcode">
                <div class="h3">NFT</div>
                <div class="qrcode">
                  <svg width="189" height="189" aria-hidden="true" class="svg-smile">
                    <use xlink:href="#icon-qrcode"></use>
                  </svg>
                </div>

              </div>
            </div>
			
			<?
		  }
			?>
			
          </div>
          <div class="tab-pane fade" id="tab-2" role="tabpanel">
           
		   
		   
		   <ul class="events-list">
		   
		     <?
		  foreach ($fut as $prod)
		  {

$post = get_post($prod);

 $dat=get_post_meta( $prod, '_text_dat', true);
 
  $er=explode('-',$dat);
	 $tu=$er[0].'.'.$er[1];
 
 
		  ?>
              <li style="cursor:pointer"  onclick="window.location.href='/event/?id=<?=$prod?>'" >
                <div class="img"><img src="<? echo  get_the_post_thumbnail_url( $prod, 'full' );?>" alt=""></div>
                <div class="h4"><? echo $post->post_title?> - <span><?=$tu?></span></div>
                <a href="#" class="btn btn_green">BUY NFT</a>
              </li>
           	<?
		  }
			?>
            </ul>
		   
		   
		   
          </div>
          <div class="tab-pane fade" id="tab-3" role="tabpanel">
          
		  <ul class="events-list">
 <?
		  foreach ($past as $prod)
		  {

$post = get_post($prod);

 $dat=get_post_meta( $prod, '_text_dat', true);
 
  $er=explode('-',$dat);
	 $tu=$er[0].'.'.$er[1];
 
 
		  ?>
              <li style="cursor:pointer" onclick="window.location.href='/event/?id=<?=$prod?>'" >
                <div class="img"><img src="<? echo  get_the_post_thumbnail_url( $prod, 'full' );?>" alt=""></div>
                <div class="h4"><? echo $post->post_title?> - <span><?=$tu?></span></div>
                <a href="#" class="btn btn_green">BUY NFT</a>
              </li>
           	<?
		  }
			?>
            </ul>
		  
		  
		  
          </div>
          <div class="tab-pane fade" id="tab-4" role="tabpanel">
           
		   <ul class="events-list">
               <?
		  foreach ($all as $prod)
		  {

$post = get_post($prod);

 $dat=get_post_meta( $prod, '_text_dat', true);
 
  $er=explode('-',$dat);
	 $tu=$er[0].'.'.$er[1];
 
 
		  ?>
              <li style="cursor:pointer" onclick="window.location.href='/event/?id=<?=$prod?>'">
                <div class="img"><img src="<? echo  get_the_post_thumbnail_url( $prod, 'full' );?>" alt=""></div>
                <div class="h4"><? echo $post->post_title?> - <span><?=$tu?></span></div>
                <a href="#" class="btn btn_green">BUY NFT</a>
              </li>
           	<?
		  }
			?>
            </ul>
		   
		   
		   
		   
          </div>
        </div>
      </article>
<?
}
elseif ( in_array( 'influencer', $user_roles, true ) ) 
{
?>
 <article class="content col">
        <ul class="tabs nav nav-tabs nav-tabs-flex" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link  " data-toggle="tab" href="#tab-1" role="tab"
               aria-controls="tab-1" aria-selected="false">All Events</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tab-2" role="tab"
               aria-controls="tab-2" aria-selected="false">On Sale <span>2</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#tab-3" role="tab"
               aria-controls="tab-3" aria-selected="false">Past Events <span>30</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link " data-toggle="tab" href="#tab-4" role="tab"
               aria-controls="tab-4" aria-selected="false">Liked <span>2</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link " data-toggle="tab" href="#tab-5" role="tab"
               aria-controls="tab-5" aria-selected="false">Following <span>45</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link " data-toggle="tab" href="#tab-6" role="tab"
               aria-controls="tab-6" aria-selected="false">Followers <span>13.5K</span></a>
          </li>
        </ul>

        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade" id="tab-1" role="tabpanel">

          </div>
          <div class="tab-pane fade" id="tab-2" role="tabpanel">
            <ul class="events-list">
              <li>
                <div class="img"><img src="img/circle-profile/3.jpg" alt=""></div>
                <div class="h4">DIPLO @ LIV - <span>05.06</span></div>
                <div class="flex">
                  <svg width="29" height="26" aria-hidden="true">
                    <use xlink:href="#icon-like"></use>
                  </svg>
                  <a href="#" class="btn btn_green">BUY NFT</a>
                </div>
              </li>
              <li>
                <div class="img"><img src="img/circle-profile/4.jpg" alt=""></div>
                <div class="h4">Deadmau5 @ E11EVEN  - <span>04.06</span></div>
                <div class="flex">
                  <svg width="29" height="26" aria-hidden="true">
                    <use xlink:href="#icon-like"></use>
                  </svg>
                  <a href="#" class="btn btn_green">BUY NFT</a>
                </div>
              </li>
            </ul>
          </div>
          <div class="tab-pane fade show active" id="tab-3" role="tabpanel">

          </div>
          <div class="tab-pane fade" id="tab-4" role="tabpanel">

          </div>
          <div class="tab-pane fade" id="tab-5" role="tabpanel">

          </div>
          <div class="tab-pane fade" id="tab-6" role="tabpanel">

          </div>
        </div>
      </article>
	  
	  
	  
	  
	  
<?
}
	  
	?>  

	  
	  
	  
	  
    </div>
  </div>


</main>


<?php 

}

get_footer(); ?>
