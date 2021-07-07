<?
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );
$po=$_POST['ser'];


                $users_query = [
                    'role' => 'circle',
                    'orderby' => 'nicename',
                    'order' => 'ASC',
                ];

      if (strlen($po)>2)
	  {
		  
		  $users_query['meta_query'] = [
                        [
                            'key' => 'fio',
                            'value' => $po,
                            'compare' => 'LIKE',
                        ],
                    ]; 
		  
	  }
                   
                
                $users = get_users($users_query);

                $tar = 1;

                foreach ($users as $user) { 
				 $uro = get_user_meta($user->ID, $wpdb->get_blog_prefix() . 'user_avatar', true);
				
				?>
                    <div>
                        <div class="item">
                            <a href="/circle/?id=<?= $user->ID; ?>" 
							
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
                                <?php
                               
                                if (!empty($uro)) {
                                    echo wp_get_attachment_image($uro, array(100, 100));
                                } else { ?>
                                  
                                <?php } ?>

                            </a>
                            <div class="item-desc">
                                <div class="numb"><?= $tar; ?> .</div>
                                <div>
                                    <div class="name"><?= get_user_meta($user->ID, 'fio', true); ?></div>
                                </div>
								
                            </div>
                        </div>
                        <div class="md-visible">
                            <div class="item">

                                <a href="/circle/?id=<?= $user->ID ?>" 
								
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
                                    <?php
                                   

                                    if (!empty($uro)) {
                                        echo wp_get_attachment_image($uro, array(100, 100));
                                    }
                                    else { ?>
                                      
                                    <?php } ?>
                                </a>
                                <div class="item-desc">
                                    <div class="numb"><?= $tar; ?> .</div>
                                    <div>
                                        <div style="cursor:pointer"
                                             onclick="window.location.href='/circle/?id=<?= $user->ID; ?>'"
                                             class="name"><?= get_user_meta($user->ID, 'fio', true); ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $tar++;
                } ?>