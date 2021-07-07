<?php
/*
Template Name: personal
*/

get_header(); 
$ppp=0;
if ( is_user_logged_in() ) {

 $current_user = wp_get_current_user();
$user_meta = get_userdata($current_user->ID);
$user_roles = $user_meta->roles;

if ( in_array( 'circle', $user_roles, true ) ) 
{
$ppp=1;
?>

<?
}
elseif ( in_array( 'contributor', $user_roles, true ) ) 
{

}
elseif ( in_array( 'influencer', $user_roles, true ) ) 
{
header("Location: /personal-user/");
}
elseif ( in_array( 'administrator', $user_roles, true ) ) 
{
?>

<?
}
else
{
header("Location: /personal-user/");
}


}
else
{
	header("Location:/");
}









if ($_POST['pasa999'])
{
	



$userdata = array(
			'user_login' =>$_POST['emu999'],
			'user_pass'  =>$_POST['pasa999'],
			'user_email' =>$_POST['emu999'],
			'role' => 'contributor'
		);

		$user_id = wp_insert_user( $userdata );


update_user_meta( $user_id, 'mainidu1', $current_user->ID);	
update_user_meta( $user_id, 'pas',$_POST['pasa999']);	
update_user_meta( $user_id, 'acce',$_POST['type9']);	
	
}









 $current_user = wp_get_current_user();
$idd=$current_user->ID;

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



?>
<script >
  function hide_menu () {
    var burger = document.querySelector('.header__burger'),
     canvas = document.querySelector('.darken'),
     modal = document.getElementById('menuModal')
    burger.classList.remove('active')
    canvas.classList.remove('block')
    modal.classList.remove('active')
  }
</script>

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
?>






</section>
<main class="page-user page-admin">
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
				if ($ppp>0)
				{
				?>
				<svg width="199" height="199" aria-hidden="true" class="svg-smile">
              <use xlink:href="#icon-circle"></use>
            </svg>
				<?	
				}
				else
				{
					?>
				<svg width="199" height="199" aria-hidden="true" class="svg-smile">
              <use xlink:href="#icon-smile"></use>
            </svg>
				<?
					
				}
				
			}
		 
            
			?>
		  
          
          </div>
        </div>
         <div class="h3">
		 
		 <?
$fio=get_user_meta( $idd, 'fio', true);		

if (strlen($fio)>0)
{
	?><span class="md-hide">
	<?
echo $fio;
?>
</span>	
<?
}
else
{
	?>
	<span class="md-hide">CIRCLE</span> ADMIN
	<?
	
}
		?>
		
		 
		 
		 </div>
        <ul class="tabs nav lg-hide">
          <!--<li><a href="#">Manage Profile</a></li>-->
          <li class="nav-item"><a class="nav-link "  href="/circle-creation/">Contact Info</a></li>
        
          <!--<li><a href="#">Liked </a></li>-->
		    
          <li class="nav-item"><a class="nav-link "  href="/addevent/">Add Event</a></li>
       
          <li class="nav-item">
            <a class="nav-link " data-toggle="tab" href="#tab-sidebar-1" role="tab" aria-controls="tab-sidebar-1"
               aria-selected="false">Ticket Management</a></li>
			   
			   
			   <?
			   if ($ppp>0)
			   {
				 ?>
 <li class="nav-item">
            <a class="nav-link " data-toggle="tab" href="#tab-sidebar-2" role="tab" aria-controls="tab-sidebar-2"
               aria-selected="false">Add Contributors</a></li>
<?				 
			   }
			   ?>
         
			   
			   
			   
			   
			   
          <li class="nav-item ">
            <a class="nav-link " data-toggle="tab" href="#tab-sidebar-3" role="tab" aria-controls="tab-sidebar-3"
               aria-selected="false">Stats</a></li>
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#tab-sidebar-4" role="tab" aria-controls="tab-sidebar-4"
               aria-selected="false">FlashBs</a></li>
          <li class="nav-item verify-ticket">
            <a class="nav-link " data-toggle="tab" href="#tab-sidebar-5" role="tab" aria-controls="tab-sidebar-5"
               aria-selected="false">Verify Ticket</a>
            <svg width="33" height="29" aria-hidden="true" class="svg-smile">
              <use xlink:href="#icon-verify-ticket"></use>
            </svg>
          </li>
          <li class="nav-item">
            <a class="nav-link " data-toggle="tab" href="#tab-sidebar-6" role="tab"
               aria-controls="tab-sidebar-6" aria-selected="false">Withdraw</a></li>
        </ul>
      </aside>
       <article class="content col content-tabs">
        <div class="tab-content" id="myTabContentSidebar">
		
          <div class="tab-pane fade" id="tab-sidebar-1" role="tabpanel">
            <ul class="tabs nav nav-tabs " id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link " data-toggle="tab" href="#tab-1" role="tab"
                   aria-controls="tab-1" aria-selected="false">Your Event</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#tab-2" role="tab"
                   aria-controls="tab-2" aria-selected="false">Manage Tickets</a>
              </li>
            </ul>
            <!--<button type="submit" class="btn btn_green btn_submit" value="">Submit</button>-->
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade" id="tab-1" role="tabpanel">
                <div class="your-event">
				
				     <?
					 $tik=array();
		  foreach ($all as $prod)
		  {

$post = get_post($prod);

 $dat=get_post_meta($prod, '_text_dat', true);
 
  $er=explode('-',$dat);
	 $tu=$er[0].'.'.$er[1];
 
	

			?>
          
 
 
 
		 
             
			  
			  
                  <div class="img">
                    <div class="img-in">
                      <img src="<? echo  get_the_post_thumbnail_url( $prod, 'thumbnail' );?>" alt="">
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
			  
			  
           	<?
			break;
		  }
			?>
				
				
				
                </div>
              </div>
              <div class="tab-pane fade show active" id="tab-2" role="tabpanel">
                <ul class="list-img">
				<?
		 foreach ($all as $prod)
		  {		
$my_posts50 = new WP_Query;

$myposts50 = $my_posts50->query( array(
	'post_type' => 'product',
	'meta_query' => array(
        array(
            'key' => '_number_tov',
            'value' => $prod,
			
        ),
    ),
) );
			foreach( $myposts50 as $pst50 )
			{
$post = get_post($pst50);
$post7=$pst50->ID;
$cen=get_post_meta($post7, '_regular_price', true);

?>
 <li>
                    <a href="/addticket/?id=<?=$post7?>" class="img">
                      <img src="<? echo  get_the_post_thumbnail_url( $post7, 'full' );?>" alt="">
                    </a>
                    <div>
                      <div class="h4"><? echo $post->post_title?> - $<?=$cen?></div>
                    </div>
                  </li>
				  
				
				  
				  
<?
			}
				
		  }	
	
				?>
                </ul>
              </div>
            </div>
          </div>
 
			   <?
			   if ($ppp>0)
			   {
				 ?>
          <div class="tab-pane fade" id="tab-sidebar-2" role="tabpanel">
            <div class="content-public-event">
			<form method="post">
              <ul class="content-public-event-top">
                <li>
                  <div class="inner">
                    <div class="h3">Add Contributor</div>
                    <input type="email" name="emu999" placeholder="Email Address*"><br/>
					<input type="text" name="pasa999" placeholder="Password*">
                  </div>
				  
                  <div class="inner">
                    <div class="h3">Access</div>
                    <div class="select select-border">
                      <a href="#" id="raty" class="slct">Type of Access<i class="fa fa-caret-down" aria-hidden="true"></i></a>
                      <ul  class="drop">
                        <li onclick="
setTimeout(function() {
$('#typ9').val($('#raty').text());
},1000);
						">Admin [full access]</li>
                        <li onclick="setTimeout(function() {
$('#typ9').val($('#raty').text());
},1000);">Editor [Edit text]</li>
                        <li onclick="setTimeout(function() {
$('#typ9').val($('#raty').text());
},1000);">Ticket Control [QR]</li>
                      </ul>
                      <input  id="typ9" type="hidden" name="type9"/>
                    </div>
                  </div>
                </li>
              
              </ul>
              <button type="submit" class="btn btn_green btn_submit-">Submit</button>
			  </form>
            </div>
          </div>
<?
			   }
?>
          <div class="tab-pane fade" id="tab-sidebar-3" role="tabpanel">

            <ul class="tabs nav nav-tabs " id="myTab-2" role="tablist">
              <li class="nav-item">
                <a class="nav-link " data-toggle="tab" href="#tab-status-1" role="tab"
                   aria-controls="tab-status-1" aria-selected="false">Show All</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#tab-status-2" role="tab"
                   aria-controls="tab-status-2" aria-selected="false">Show by Event</a>
              </li>
            </ul>

            <div class="tab-content" id="myTabContent-2">
              <div class="tab-pane fade" id="tab-status-1" role="tabpanel">



                <div class="diagram">
                  <div class="diagram-item">
                    <div class="title">FlashBs</div>
                    <ul class="diagram-item-list">
                      <li>
                        <div class="diagram-bar" style="height: 60%;"><span>60%</span></div>
                        <div class="diagram-name">Sold</div>
                      </li>
                      <li>
                        <div class="diagram-bar" style="height: 40%;"><span>40%</span></div>
                        <div class="diagram-name">Outsanding</div>
                      </li>
                    </ul>
                  </div>

                  <div class="diagram-item">
                    <div class="title">Participation</div>
                    <ul class="diagram-item-list">
                      <li>
                        <div class="diagram-bar" style="height: 95%;"><span>95%</span></div>
                        <div class="diagram-name">Attendees</div>
                      </li>
                      <li>
                        <div class="diagram-bar" style="height: 25%;"><span>25%</span></div>
                        <div class="diagram-name">Noshows</div>
                      </li>
                    </ul>
                  </div>

                  <div class="diagram-item diagram-item-circle">
                    <div class="title">Gender</div>
                    <div id="container-2"></div>
                  </div>

                  <div class="diagram-item diagram-item-vertical">
                    <div class="title">Age</div>
                    <div class="md-visible">
                      <ul class="diagram-item-vertical-list">
                        <li>
                          <div class="diagram-bar" style="height: 30%;"><span>30%</span></div>
                          <div class="diagram-name">18-24</div>
                        </li>
                        <li>
                          <div class="diagram-bar" style="height: 40%;"><span>40%</span></div>
                          <div class="diagram-name">25-30</div>
                        </li>
                        <li>
                          <div class="diagram-bar" style="height: 15%;"><span>15%</span></div>
                          <div class="diagram-name">31-40</div>
                        </li>
                        <li>
                          <div class="diagram-bar" style="height: 10%;"><span>10%</span></div>
                          <div class="diagram-name">41-50</div>
                        </li>
                        <li>
                          <div class="diagram-bar" style="height: 25%;"><span>25%</span></div>
                          <div class="diagram-name">51 +</div>
                        </li>
                      </ul>
                    </div>
                    <div class="md-hide">
                      <ul class="diagram-item-vertical-list">
                        <li>
                          <div class="diagram-name">18-24</div>
                          <div class="diagram-bar" style="width: 30%;"><span>30%</span></div>
                        </li>
                        <li>
                          <div class="diagram-name">25-30</div>
                          <div class="diagram-bar" style="width: 40%;"><span>40%</span></div>
                        </li>
                        <li>
                          <div class="diagram-name">31-40</div>
                          <div class="diagram-bar" style="width: 15%;"><span>15%</span></div>
                        </li>
                        <li>
                          <div class="diagram-name">41-50</div>
                          <div class="diagram-bar" style="width: 10%;"><span>10%</span></div>
                        </li>
                        <li>
                          <div class="diagram-name">51 +</div>
                          <div class="diagram-bar" style="width: 5%;"><span>5%</span></div>
                        </li>
                      </ul>
                    </div>
                  </div>

                  <div class="diagram-item diagram-item-info">
                    <div class="diagram-item-info-list">
                      <div class="title">Average Time In</div>
                      <p class="color-red">21:45hs</p>
                    </div>
                    <div class="diagram-item-info-list">
                      <div class="title">Average Time Out</div>
                      <p class="color-red">03:15hs</p>
                    </div>
                    <div class="diagram-item-info-list">
                      <div class="title">Common Intrests</div>
                      <p class="color-red">#NewYork</p>
                      <p class="color-red">#Dance</p>
                      <p class="color-red">#Trance</p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="tab-pane fade show active" id="tab-status-2" role="tabpanel">
                <div class="diagram">

                  <div class="diagram-item">
                    <div class="title">FlashBs</div>
                    <ul class="diagram-item-list">
                      <li>
                        <div class="diagram-bar" style="height: 60%;"><span>60%</span></div>
                        <div class="diagram-name">Sold</div>
                      </li>
                      <li>
                        <div class="diagram-bar" style="height: 40%;"><span>40%</span></div>
                        <div class="diagram-name">Outsanding</div>
                      </li>
                    </ul>
                  </div>

                  <div class="diagram-item">
                    <div class="title">Participation</div>
                    <ul class="diagram-item-list">
                      <li>
                        <div class="diagram-bar" style="height: 95%;"><span>95%</span></div>
                        <div class="diagram-name">Attendees</div>
                      </li>
                      <li>
                        <div class="diagram-bar" style="height: 25%;"><span>25%</span></div>
                        <div class="diagram-name">Noshows</div>
                      </li>
                    </ul>
                  </div>

                  <div class="diagram-item diagram-item-circle">
                    <div class="title">Gender</div>
                    <div id="container"></div>
                  </div>

                  <div class="diagram-item diagram-item-vertical">
                    <div class="title">Age</div>
                    <div class="md-visible">
                      <ul class="diagram-item-vertical-list">
                        <li>
                          <div class="diagram-bar" style="height: 30%;"><span>30%</span></div>
                          <div class="diagram-name">18-24</div>
                        </li>
                        <li>
                          <div class="diagram-bar" style="height: 40%;"><span>40%</span></div>
                          <div class="diagram-name">25-30</div>
                        </li>
                        <li>
                          <div class="diagram-bar" style="height: 15%;"><span>15%</span></div>
                          <div class="diagram-name">31-40</div>
                        </li>
                        <li>
                          <div class="diagram-bar" style="height: 10%;"><span>10%</span></div>
                          <div class="diagram-name">41-50</div>
                        </li>
                        <li>
                          <div class="diagram-bar" style="height: 25%;"><span>25%</span></div>
                          <div class="diagram-name">51 +</div>
                        </li>
                      </ul>
                    </div>
                    <div class="md-hide">
                      <ul class="diagram-item-vertical-list">
                        <li>
                          <div class="diagram-name">18-24</div>
                          <div class="diagram-bar" style="width: 30%;"><span>30%</span></div>
                        </li>
                        <li>
                          <div class="diagram-name">25-30</div>
                          <div class="diagram-bar" style="width: 40%;"><span>40%</span></div>
                        </li>
                        <li>
                          <div class="diagram-name">31-40</div>
                          <div class="diagram-bar" style="width: 15%;"><span>15%</span></div>
                        </li>
                        <li>
                          <div class="diagram-name">41-50</div>
                          <div class="diagram-bar" style="width: 10%;"><span>10%</span></div>
                        </li>
                        <li>
                          <div class="diagram-name">51 +</div>
                          <div class="diagram-bar" style="width: 5%;"><span>5%</span></div>
                        </li>
                      </ul>
                    </div>
                  </div>

                  <div class="diagram-item diagram-item-info">
                    <div class="diagram-item-info-list">
                      <div class="title">Average Time In</div>
                      <p class="color-red">21:45hs</p>
                    </div>
                    <div class="diagram-item-info-list">
                      <div class="title">Average Time Out</div>
                      <p class="color-red">03:15hs</p>
                    </div>
                    <div class="diagram-item-info-list">
                      <div class="title">Common Intrests</div>
                      <p class="color-red">#NewYork</p>
                      <p class="color-red">#Dance</p>
                      <p class="color-red">#Trance</p>
                    </div>
                  </div>

                </div>
              </div>
            </div>

          </div>

          <div class="tab-pane fade show active" id="tab-sidebar-4" role="tabpanel">
		  
		  
            <ul class="tabs nav nav-tabs nav-tabs-white" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#tab-11" role="tab"
               aria-controls="tab-11" aria-selected="false">Today <span><?=count($today)?></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link " data-toggle="tab" href="#tab-21" role="tab"
               aria-controls="tab-21" aria-selected="false">Upcoming  <span><?=count($fut)?></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link " data-toggle="tab" href="#tab-31" role="tab"
               aria-controls="tab-31" aria-selected="false">Past <span><?=count($past)?></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link " data-toggle="tab" href="#tab-41" role="tab"
               aria-controls="tab-41" aria-selected="false">Full Collection</a>
          </li>
        </ul>

        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="tab-11" role="tabpanel">
		  
		  <?
		  foreach ($today as $prod)
		  {

$post = get_post($prod);

 $dat=get_post_meta( $prod, '_text_dat', true);
 
  $er=explode('-',$dat);
	 $tu=$er[0].'.'.$er[1];
 
 
		  ?>
            <div class="your-event">
              <div style="cursor:pointer"  onclick="window.location.href='/addevent/?id=<?=$prod?>'" class="img">
                <div class="img-in">
                  <img src="<? echo  get_the_post_thumbnail_url( $prod, 'thumbnail' );?>" alt="">
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
          <div class="tab-pane fade" id="tab-21" role="tabpanel">
           
		   
		   
		   <ul class="events-list">
		   
		     <?
		  foreach ($fut as $prod)
		  {

$post = get_post($prod);

 $dat=get_post_meta( $prod, '_text_dat', true);
 
  $er=explode('-',$dat);
	 $tu=$er[0].'.'.$er[1];
 
 
		  ?>
              <li style="cursor:pointer"  onclick="window.location.href='/addevent/?id=<?=$prod?>'">
                <div class="img"><img src="<? echo  get_the_post_thumbnail_url( $prod, 'thumbnail' );?>" alt=""></div>
                <div class="h4"><? echo $post->post_title?> - <span><?=$tu?></span></div>
                <a href="#" class="btn btn_green">BUY NFT</a>
              </li>
           	<?
		  }
			?>
            </ul>
		   
		   
		   
          </div>
          <div class="tab-pane fade" id="tab-31" role="tabpanel">
          
		  <ul class="events-list">
 <?
		  foreach ($past as $prod)
		  {

$post = get_post($prod);

 $dat=get_post_meta( $prod, '_text_dat', true);
 
  $er=explode('-',$dat);
	 $tu=$er[0].'.'.$er[1];
 
 
		  ?>
              <li style="cursor:pointer"  onclick="window.location.href='/addevent/?id=<?=$prod?>'">
                <div class="img"><img src="<? echo  get_the_post_thumbnail_url( $prod, 'thumbnail' );?>" alt=""></div>
                <div class="h4"><? echo $post->post_title?> - <span><?=$tu?></span></div>
                <a href="#" class="btn btn_green">BUY NFT</a>
              </li>
           	<?
		  }
			?>
            </ul>
		  
		  
		  
          </div>
          <div class="tab-pane fade" id="tab-41" role="tabpanel">
           
		   <ul class="events-list">
               <?
		  foreach ($all as $prod)
		  {

$post = get_post($prod);

 $dat=get_post_meta($prod, '_text_dat', true);
 
  $er=explode('-',$dat);
	 $tu=$er[0].'.'.$er[1];
 
 
		  ?>
              <li style="cursor:pointer"  onclick="window.location.href='/addevent/?id=<?=$prod?>'">
                <div class="img"><img src="<? echo  get_the_post_thumbnail_url( $prod, 'thumbnail' );?>" alt=""></div>
                <div class="h4"><? echo $post->post_title?> - <span><?=$tu?></span></div>
                <a href="#" class="btn btn_green">BUY NFT</a>
              </li>
           	<?
		  }
			?>
            </ul>
		   
		   
		   
		   
          </div>
        </div>
		
			
			
			
			
          </div>

          <div class="tab-pane fade" id="tab-sidebar-5" role="tabpanel">
            <div class="not-following">
              <div class="h2">Please use your phone</div>
            </div>
          </div>

          <div class="tab-pane fade" id="tab-sidebar-6" role="tabpanel">Withdraw</div>
        </div>

      </article>
    </div>
  </div>


</main>


<?php get_footer(); ?>
