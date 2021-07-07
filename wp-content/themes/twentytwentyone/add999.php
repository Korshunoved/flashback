<?php
  /*
  Template Name: addevent
  */
  
  get_header(); 
  require_once(ABSPATH . 'wp-admin/includes/file.php');
  require_once(ABSPATH . 'wp-admin/includes/media.php');
  require_once(ABSPATH . "wp-admin" . '/includes/image.php');
  	
  	
  function downcounter($date){
  	    $check_time = strtotime($date) - time();
  	    if($check_time <= 0){
  	        return false;
  	    }
  
  	    $days = floor($check_time/86400);
  	    $hours = floor(($check_time%86400)/3600);
  	    $minutes = floor(($check_time%3600)/60);
  	    $seconds = $check_time%60; 
  
  	    $str = '';
  	    if($days > 0) $str .= ($days*24).' ';
  	    if($hours > 0) $str .= $hours.' ';
  	    if($minutes > 0) $str .= $minutes.' ';
  	    if($seconds > 0) $str .= $seconds;
  
  	    return $str;
  	}
  
  
  	/**
  	 * Функция склонения слов
  	 *
  	 * @param mixed $digit
  	 * @param mixed $expr
  	 * @param bool $onlyword
  	 * @return
  	 */
  	function declension($digit,$expr,$onlyword=false){
  	    if(!is_array($expr)) $expr = array_filter(explode(' ', $expr));
  	    if(empty($expr[2])) $expr[2]=$expr[1];
  	    $i=preg_replace('/[^0-9]+/s','',$digit)%100;
  	    if($onlyword) $digit='';
  	    if($i>=5 && $i<=20) $res=$digit.' '.$expr[2];
  	    else
  	    {
  	        $i%=10;
  	        if($i==1) $res=$digit.' '.$expr[0];
  	        elseif($i>=2 && $i<=4) $res=$digit.' '.$expr[1];
  	        else $res=$digit.' '.$expr[2];
  	    }
  	    return trim($res);
  	}	
  	
  if (!empty($_POST['name9']))
  {
  	
  	
  $current_user = wp_get_current_user();
  $idi=$current_user->ID;
  	
  	
  	
  
  	$post = array(
  	    'post_author' => $idi,
          'post_content'  => $_POST['desa'],
  	    'post_excerpt' => $_POST['desa'],
  	    'post_status' => "publish",
  	    'post_title' => $_POST['name9'], 
  	    'post_type' => "product",
  	);
   
  	//Create post
  $post_id = wp_insert_post($post);
   if ($post_id )
   {
  	 $attachment_id = media_handle_upload( 'file5', $post_id );
  	wp_set_object_terms($post_id, 'simple', 'product_type');     //Тип товара (Простой товар)
    
  	update_post_meta( $post_id, '_regular_price', 0);	
  	update_post_meta( $post_id, '_price', 0);	
  	
  	update_post_meta( $post_id, '_text_locat', $_POST['locat']);	
  	
  	update_post_meta( $post_id, '_text_dat', $_POST['dat']);	
  	update_post_meta( $post_id, '_text_dat1', $_POST['dat1']);	
  		
  	update_post_meta( $post_id, '_number_cir', $idi);
  	update_post_meta( $post_id, '_thumbnail_id', $attachment_id );
  	
  	
  	
  	update_post_meta( $post_id, '_text_time1', $_POST['sta']);	
  	update_post_meta( $post_id, '_text_time2', $_POST['end']);
  	
      update_post_meta( $post_id, '_text_hash', $_POST['hash']);
  	
  	
  	 'Sussecc';
  	 
   }
  		?>
<meta http-equiv="refresh" content="1;URL=/personal/" />
<?
  	
  	
  //wp_set_object_terms($post_id,  15, 'product_cat');
  
  }	
  
  	
  	
  	
  	
  	
  	
  	
  	
  	
  	
  	
  	
  	
  if (!empty($_POST['name91']))
  {
  	
  	
  $current_user = wp_get_current_user();
  $idi=$current_user->ID;
  	
  	
  	
  
   
  
   $my_post = array();
  $my_post['ID'] = $_GET['id'];
  $my_post['post_content'] = $_POST['desa'];
  $my_post['post_title'] = $_POST['name91'];
  $my_post['post_excerpt'] = $_POST['desa'];
  // Обновляем данные в БД
  wp_update_post( wp_slash($my_post) );
   
   
  
  if ($_FILES['file5']['size']>0)
  {
  	
  $attachment_id = media_handle_upload( 'file5', $_GET['id'] );
  
  	update_post_meta( $_GET['id'], '_thumbnail_id', $attachment_id );	
  
  
  }
  	
  
  	if (!empty($_POST['locat']))
  	{
  	update_post_meta( $_GET['id'], '_text_locat', $_POST['locat']);		
  		
  	}
  	if (!empty($_POST['dat']))
  	{
  	update_post_meta( $_GET['id'], '_text_dat', $_POST['dat']);	
  	}
  	if (!empty($_POST['dat1']))
  	{
      update_post_meta(  $_GET['id'], '_text_dat1', $_POST['dat1']);
  	}
  	
  	
  	if (!empty($_POST['sta']))
  	{
  	update_post_meta(  $_GET['id'], '_text_time1', $_POST['sta']);	
  	}
  	if (!empty($_POST['end']))
  	{
  	update_post_meta(  $_GET['id'], '_text_time2', $_POST['end']);
  	}
  	if (!empty($_POST['hash']))
  	{
      update_post_meta(  $_GET['id'], '_text_hash', $_POST['hash']);
  	}
  	
  	
  	
  	
  	
  	
  	
  	 'Sussecc';
  
  	
  	
  	
  //wp_set_object_terms($post_id,  15, 'product_cat');
  	?>
<meta http-equiv="refresh" content="1;URL=/addevent/?id=<?=$_GET['id']?>" />
<?
  }	
  
  
  
  
  if (!empty($_GET['id']))
  {
  	
  	
  $idd=$_GET['id'];
  
  
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
  	 
  	 
  	$d=$dat.' '.$tam1.':00';
  	$fut=strtotime($d);
  	$now=strtotime("now");
      $pere=$fut-$now;
  $da=date('Y-m-d H:i:s');
  	$det=downcounter($d);
  	
  	$dey=explode(' ',$det);
  	$hou=$dey[0]+$dey[1];
  	$min=$dey[2];
  	$sec=$dey[3];
  	?>
<main class="page-public-event page-public-event-new">
  <div class="container">
    <form  id="uploadImages" enctype="multipart/form-data" method="post" class="form">
      <div class="row justify-content-between">
        <aside class="sidebar col lg-hide">
          <div class="sidebar-top">
            <?
              $current_user = wp_get_current_user();
               $uro=get_user_meta($current_user->ID, $wpdb->get_blog_prefix() . 'user_avatar', true);
               if (!empty($uro))
                {
              	   echo wp_get_attachment_image( $uro,  array(100,100));
                }
              else
              {
              ?>
            <svg width="149" height="149" aria-hidden="true">
              <use xlink:href="#icon-smile-green"></use>
            </svg>
            <?
              }
               ?>
            <div>
              <div class="h3"><?
                echo $fio=get_user_meta( $current_user->ID, 'fio', true);
                		?></div>
              <p></p>
            </div>
          </div>
          <div class="sidebar-img">
            <img id="ima" src="<? echo  get_the_post_thumbnail_url( $idd, 'full' );?>" alt="">
          </div>
          <ul id="uploadImagesList">
            <li class="item template">
              <span class="img-wrap">
              <a href="javascript:void(0)" id="pica" class="sidebar-img"> <img src="<? echo  get_the_post_thumbnail_url( $idd, 'medium' );?>" alt=""></a>
              </span>
              <span class="delete-link" style="display:none" title="Удалить">Удалить</span>
            </li>
          </ul>
        </aside>
        <article class="content col">
          <ul class="content-public-event-top">
            <li>
              <div class="inner">
                <div class="h3">Event name</div>
                <input required value="<? echo $post->post_title?>" name="name91" type="text">
              </div>
              <div class="inner">
                <div class="date-wrapp">
                  <div class="h3">Select date</div>
                  <ul class="list">
                    <li>
                      <span>Start</span>
                      <input type="text" name="dat" value="<?=$dat?>" id="data" class="datepicker" placeholder="DD MM YYYY">
                      <i class="fa fa-calendar" aria-hidden="true"></i>
                    </li>
                    <li>
                      <span>End</span>
                      <input type="text" name="dat1" value="<?=$dat1?>" id="data1" class="datepicker" placeholder="DD MM YYYY">
                      <i class="fa fa-calendar" aria-hidden="true"></i>
                    </li>
                  </ul>
                </div>
                <div class="time-wrapp">
                  <div class="h3">Select time</div>
                  <ul class="list">
                    <li>
                      <span>Start</span>
                      <input type="time" name="sta" value="<?=$tam1?>" id="sta" value="12:00" class="time-input">
                    </li>
                    <li>
                      <span>End</span>
                      <input type="time" name="end" value="<?=$tam2?>" id="end" value="12:00" class="time-input">
                    </li>
                  </ul>
                </div>
              </div>
            </li>
            <li class="second">
              <div class="inner">
                <div class="h3">Description</div>
                <textarea name="desa" class="input md"><? echo $post->post_content?></textarea>
              </div>
              <input type="hidden" name="azaza" value="zazaza">
              <div class="inner">
                <div class="h3">Hashtags</div>
                <input name="hash" value="<?=$hash?>" type="text">
              </div>
              <div class="inner">
              <div class="h3">Security Level</div>
              <div class="select select-border" style="width: 100%;">
                <a href="#" class="slct active">None<i class="fa fa-caret-down" aria-hidden="true"></i></a>
                <ul class="drop" style="display: block">
                  <li>Required  KYC</li>
                </ul>
                <input type="hidden" name="type"/>
              </div>
            </div>
            </li>
            <li class="location">
              <div class="inner">
                <div class="h3">Location</div>
                <input name="locat" id="locut" value="<?=$loco?>" type="text">
              </div>
              <div class="inner">
                <div class="img" style="position: relative;">
                
                  <div id="coordinates">
                    <!-- Click somewhere on the map. Drag the marker to update the coordinates. -->
                  </div>
                  <div style="display:none">
                    <label>
                    lat
                    <input type="text" id="lat"/>
                    </label>
                    <label>
                    lng
                    <input type="text" id="lng"/>
                    </label>
                  </div>
                  <div id="map" ></div>
                </div>
              </div>
              <div class="inner">
                <div class="inputfile-box">
                  <input type="file"  onclick="$('#ima').hide();$('.delete-link').click();$('#rao').text('Upload Banner');;" name="file5" id="addImages" class="inputfile">
                  <label for="addImages">
                  <strong></strong>
                  <span id="rao">Upload Banner</span>
                  </label>
                  <div class="size">14px X 20px</div>
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
          <ul class="tabs nav nav-tabs" id="myTab" role="tablist">
            <!--<li class="nav-item">
              <a class="nav-link " data-toggle="tab" href="#your-event" role="tab"
                aria-controls="your-event"
                aria-selected="false">Your Event</a>
            </li>-->

            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#manage-tickets" role="tab"
                aria-controls="manage-tickets" aria-selected="false">Manage Tickets</a>
            </li>
			    <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#event-statistics" role="tab"
               aria-controls="event-statistics" aria-selected="false">Event Statistics</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#verify-tickets" role="tab"
               aria-controls="verify-tickets" aria-selected="false">Verify Tickets</a>
          </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <!--<div class="tab-pane fade" id="your-event" role="tabpanel">
              <div class="your-event">
                <div class="img">
                  <div class="img-in">
                    <img src="<? echo  get_the_post_thumbnail_url( $idd, 'medium' );?>" alt="">
                  </div>
                  <div class="h4"><? echo $post->post_title?> - <span><?=$tu?></span></div>
                </div>
                <div class="desc">
                  <div class="h3">COUNTDOWN TO EVENT</div>
                  <div class="time">
                    <div class="time-number">
                      <div class="item"><?=$hou?></div>
                      <div class="item">:</div>
                      <div class="item"><?=$min?></div>
                      <div class="item">:</div>
                      <div class="item"><?=$sec?></div>
                    </div>
                    <div class="time-name">
                      <div class="item">hours</div>
                      <div class="item">minutes</div>
                      <div class="item">seconds</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="select-only">
                <div class="select">
                  <button type="button" class="btn btn_green" onclick="$('#uploadImages').submit()">Publish Event</button>
                </div>
              </div>
            </div>-->
            <div class="tab-pane fade show active" id="manage-tickets" role="tabpanel">
              <ul class="list-img">
                <?	
                  $my_posts5 = new WP_Query;
                  
                  $myposts5 = $my_posts5->query( array(
                  	'post_type' => 'product',
                  	'meta_query' => array(
                          array(
                              'key' => '_number_tov',
                              'value' => $idd,
                  			
                          ),
                      ),
                  ) );
                  			foreach( $myposts5 as $pst5 ){
                  $pd5=$pst5->ID;
                  $cen=get_post_meta($pd5, '_regular_price', true);
                  ?>		
                <li>
                  <a href="/addticket/?id=<?=$pd5?>" class="img">
                  <img src="<? echo  get_the_post_thumbnail_url( $pd5, 'full' );?>" alt="">
                  </a>
                  <div class="h4"><? echo $pst5->post_title?> - $<?=$cen?></div>
                </li>
                <?
                  }
                    ?>
                <li>
                  <a href="/addticket/?event=<?=$idd?>" class="img">
                  <img src="/wp-content/themes/twentytwentyone/img/publick-event/list-4.jpg" alt="">
                  </a>
                  <div class="h4">Create new ticket</div>
                </li>
              </ul>
              <div class="select-only">
                <div class="select">
                  <button type="button" class="btn btn_green" onclick="$('#uploadImages').submit()">Publish Event</button>
                </div>
              </div>
            </div>
			  <div class="tab-pane fade show" id="event-statistics" role="tabpanel">
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

          <div class="tab-pane fade show" id="verify-tickets" role="tabpanel">verify-tickets</div>

			
          </div>
        </article>
      </div>
    </form>
  </div>
</main>
<?
  }
  else
  {
  	
  	
  
  
  ?>
<main class="page-public-event page-public-event-new">
  <div class="container">
    <form  id="uploadImages" enctype="multipart/form-data" method="post" class="form">
      <div class="row justify-content-between">
        <aside class="sidebar col lg-hide">
          <div class="sidebar-top">
            <?
              $uro=get_user_meta($current_user->ID, $wpdb->get_blog_prefix() . 'user_avatar', true);
              if (!empty($uro))
                {
              	   echo wp_get_attachment_image( $uro,  array(100,100));
                }
              else
              {
              ?>
            <svg width="149" height="149" aria-hidden="true">
              <use xlink:href="#icon-smile-green"></use>
            </svg>
            <?
              }
               ?>
            <div>
              <div class="h3"><?
                $current_user = wp_get_current_user();
                echo $fio=get_user_meta( $current_user->ID, 'fio', true);
                ?></div>
              <p></p>
            </div>
          </div>
          <ul id="uploadImagesList">
            <li class="item template">
              <span class="img-wrap">
              <a href="javascript:void(0)" id="pica" class="sidebar-img"> <img src="" alt=""></a>
              </span>
              <span class="delete-link" style="display:none" title="Удалить">Удалить</span>
            </li>
          </ul>
        </aside>
        <article class="content col">
          <ul class="content-public-event-top">
            <li>
              <div class="inner">
                <div class="h3">Event name</div>
                <input required name="name9" type="text">
              </div>
              <div class="inner">
                <div class="date-wrapp">
                  <div class="h3">Select date</div>
                  <ul class="list">
                    <li>
                      <span>Start</span>
                      <input type="text" name="dat" id="data" class="datepicker" placeholder="DD MM YYYY">
                      <i class="fa fa-calendar" aria-hidden="true"></i>
                    </li>
                    <li>
                      <span>End</span>
                      <input type="text" name="dat1" id="data1" class="datepicker" placeholder="DD MM YYYY">
                      <i class="fa fa-calendar" aria-hidden="true"></i>
                    </li>
                  </ul>
                </div>
                <div class="time-wrapp">
                  <div class="h3">Select time</div>
                  <ul class="list">
                    <li>
                      <span>Start</span>
                      <input type="time" name="sta" id="sta" value="12:00" class="time-input">
                    </li>
                    <li>
                      <span>End</span>
                      <input type="time" name="end" id="end" value="12:00" class="time-input">
                    </li>
                  </ul>
                </div>
              </div>
            </li>
            <li class="second">
              <div class="inner">
                <div class="h3">Description</div>
                <textarea name="desa" class="input md"></textarea>
              </div>
              <input type="hidden" name="azaza" value="zazaza">
              <div class="inner">
                <div class="h3">Hashtags</div>
                <input name="hash" type="text">
              </div>
			    <div class="inner">
              <div class="h3">Security Level</div>
              <div class="select select-border" style="width: 100%;">
                <a href="#" class="slct active">None<i class="fa fa-caret-down" aria-hidden="true"></i></a>
                <ul class="drop" style="display: block">
                  <li>Required  KYC</li>
                </ul>
                <input type="hidden" name="type"/>
              </div>
            </div>
            </li>
            <li class="location">
              <div class="inner">
                <div class="h3">Location</div>
                <input id="locut" name="locat" type="text">
              </div>
              <div class="inner">
                <div class="img" style="position: relative;">
                  <img src="/wp-content/themes/twentytwentyone/img/publick-event/location-map.jpg" alt="">
                  <div id="coordinates">
                    <!-- Click somewhere on the map. Drag the marker to update the coordinates. -->
                  </div>
                  <div style="display:none">
                    <label>
                    lat
                    <input type="text" id="lat"/>
                    </label>
                    <label>
                    lng
                    <input type="text" id="lng"/>
                    </label>
                  </div>
                  <div id="map" style="p"></div>
                </div>
              </div>
              <div class="inner">
                <div class="inputfile-box">
                  <input type="file"  onclick="$('.delete-link').click();$('#rao').text('Upload Banner');" name="file5" id="addImages" class="inputfile">
                  <label for="addImages">
                  <strong></strong>
                  <span id="rao">Upload Banner</span>
                  </label>
                  <div class="size">14px X 20px</div>
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
          <ul class="tabs nav nav-tabs" id="myTab" role="tablist">
            <!--<li class="nav-item">
              <a class="nav-link " data-toggle="tab" href="#your-event" role="tab"
                 aria-controls="your-event"
                 aria-selected="false">Your Event</a>
              </li>
              <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#manage-tickets" role="tab"
                 aria-controls="manage-tickets" aria-selected="false">Manage Tickets</a>
              </li>-->
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade"  id="your-event" role="tabpanel">
              <div class="your-event">
                <div class="img">
                  <div class="img-in">
                    <img src="img/publick-event/publick-event-sidebar.jpg" alt="">
                  </div>
                  <div class="h4">Flower Power - <span>22.07</span></div>
                </div>
                <div class="desc">
                  <div class="h3">COUNTDOWN TO EVENT</div>
                  <div class="time">
                    <div id="countdown"></div>
                    <!--                   <div class="time-number">
                      <div class="item">00</div>
                      <div class="item">:</div>
                      <div class="item">08</div>
                      <div class="item">:</div>
                      <div class="item">54</div>
                      </div>
                      <div class="time-name">
                      <div class="item">hours</div>
                      <div class="item">minutes</div>
                      <div class="item">seconds</div>
                      </div> -->
                  </div>
                </div>
              </div>
              <div class="select-only">
                <div class="select">
                  <button type="button" class="btn btn_green" onclick="$('#uploadImages').submit()">Publish Event</button>
                </div>
              </div>
            </div>
            <div  class="tab-pane fade show active" id="manage-tickets" role="tabpanel">
              <ul style="display:none" class="list-img">
                <li>
                  <a href="#" class="img">
                  <img src="img/publick-event/list-1.jpg" alt="">
                  </a>
                  <div class="h4">Basic Ticket - $100</div>
                </li>
                <li>
                  <a href="#" class="img">
                  <img src="img/publick-event/list-2.jpg" alt="">
                  </a>
                  <div class="h4">Vip Ticket - $500</div>
                </li>
                <li>
                  <a href="#" class="img">
                  <img src="img/publick-event/list-3.jpg" alt="">
                  </a>
                  <div class="h4">Diamond Ticket - $1000</div>
                </li>
                <li>
                  <a href="#" class="img">
                  <img src="img/publick-event/list-4.jpg" alt="">
                  </a>
                  <div class="h4">Create new ticket</div>
                </li>
              </ul>
              <div class="btn-block-select">
                <div class="select">
                  <button type="button" class="btn btn_green" onclick="$('#uploadImages').submit()">Publish Event</button>
                </div>
              </div>
            </div>
          </div>
        </article>
      </div>
    </form>
  </div>
</main>
<div id="getting-started"  style="display:none" ></div>
<?
  }
 
  if (!empty($_GET['id']))
  {
	$loco=get_post_meta($_GET['id'], '_text_locat', true);
	 $jop=explode(';',$loco);
	if (strlen($loco)>0)
	{
	$kor='{
     lat: '. $jop[0].',
     lng: '. $jop[1].'
   }';  
	  }
	  else
	  {
		 $kor='{
     lat: 55.74,
     lng: 37.63
   }';	 
	  }
	
   
  }
  else
  {
$kor='{
     lat: 55.74,
     lng: 37.63
   }';	  
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
  $('#rao').text('Upload Banner');
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
  
  
  
  
  
  
  
  
  
  
  
  function updateCoordinates(lat, lng) {
   document.getElementById('lat').value = lat;
   document.getElementById('lng').value = lng;
   var nop=lat+';'+lng;
    document.getElementById('locut').value = nop;
   
   
  }
  
  function initMap() {
   var map, marker;
   var myLatlng = <?=$kor?>;
   document.getElementById('lat').value = myLatlng.lat;
   document.getElementById('lng').value = myLatlng.lng;
  
   map = new google.maps.Map(document.getElementById('map'), {
     zoom: 4,
     center: myLatlng
   });
  
   marker = new google.maps.Marker({
     position: myLatlng,
     map: map,
     draggable: true
   });
  
   marker.addListener('dragend', function(e) {
     var position = marker.getPosition();
     updateCoordinates(position.lat(), position.lng())
   });
  
   map.addListener('click', function(e) {
     marker.setPosition(e.latLng);
     updateCoordinates(e.latLng.lat(), e.latLng.lng())
   });
  
   map.panTo(myLatlng);
  }
  
  
  
 
  
  
</script>

<style>
  #map {
  position: absolute;
  overflow: initial;
  left: 0;
  top: 0;
  width: 100%;
  height: 210px;
  max-height: 100%;
  }
</style>
<?php get_footer(); ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDl7CqZnodN7k0X8KxunhXfZadWUwau0Lw&libraries=places&callback=initMap" async defer></script>
<?
  if (!empty($_GET['id']))
  {
  ?>
  <script src="https://code.highcharts.com/highcharts.js"></script>
<script>
   // Make monochrome colors
    var pieColors = (function () {
      var colors = ['#C2FFA8', '#FF4484'],
        base = Highcharts.getOptions().colors[0],
        i;


      return colors;
    }());

    // Build the chart
    Highcharts.chart('container', {
      chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
      },
      title: {
        text: ''
      },
      tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
      },
      accessibility: {
        point: {
          valueSuffix: '%'
        }
      },
      plotOptions: {
        pie: {
          allowPointSelect: true,
          cursor: 'pointer',
          colors: pieColors,
          dataLabels: {
            enabled: true,
            format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
            distance: -50,
            filter: {
              property: 'percentage',
              operator: '>',
              value: 4
            }
          }
        }
      },
      series: [{
        name: 'Share',
        data: [
          {name: 'Men', y: 33},
          {name: 'Women', y: 67}
        ]
      }]
    });
    Highcharts.chart('container-2', {
      chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
      },
      title: {
        text: ''
      },
      tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
      },
      accessibility: {
        point: {
          valueSuffix: '%'
        }
      },
      plotOptions: {
        pie: {
          allowPointSelect: true,
          cursor: 'pointer',
          colors: pieColors,
          dataLabels: {
            enabled: true,
            format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
            distance: -50,
            filter: {
              property: 'percentage',
              operator: '>',
              value: 4
            }
          }
        }
      },
      series: [{
        name: 'Share',
        data: [
          {name: 'Men', y: 33},
          {name: 'Women', y: 67}
        ]
      }]
    });
</script>
<?
  }
  	?>