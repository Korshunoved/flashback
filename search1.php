<?
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );

$po=$_POST['ser'];


                $events_query = array(
                    'post_type' => 'product',
                    'orderby' => 'ID',
                    'posts_per_page' => 5000,
                   
					'meta_query' => array(
		'relation' => 'AND',
		array(
			 'key' => '_number_tov',
              'compare' => 'NOT EXISTS'
		),
		array(
			'key' => '_text_hash',
			'value' => $po,
			'compare' => 'LIKE',
		)
	)
);
                $events = $wp_query->query($events_query);
				$sp=array();	
                foreach ($events as $event) 
				{
				$sp[]=$event->ID;	
				}
					
		/////////////////////////////			
					
				
                $events_query1 = array(
                    'post_type' => 'product',
                    'orderby' => 'ID',
                    'posts_per_page' => 5000,
                   
					'meta_query' => array(
		'relation' => 'AND',
		array(
			 'key' => '_number_tov',
              'compare' => 'NOT EXISTS'
		),
	)
);


 if (strlen($po)>2)
	  {
                    $events_query1['s'] = $po;
                }

                $events1 = $wp_query->query($events_query1);
			
                foreach ($events1 as $event) 
				{
					
						$sp[]=$event->ID;	
				}	
					
					
					foreach ($sp as $idd)
					{
						$post = get_post($idd);

                    $dat = get_post_meta($idd, '_text_dat', true);

                    $er = explode('-', $dat);
                    $tu = $er[0] . '.' . $er[1];
                    ?>

                    <div class="item">
                        <a href="/event/?id=<?= $idd ?>" class="img">
						<img
                                    src="<?= get_the_post_thumbnail_url($idd, 'full'); ?>" alt="">
									 <div class="data"><?= $post->post_title ?>  - <span><?=$tu?></span></div>
									
									</a>
                        <div class="md-visible">
                            <div class="h4"><?= $post->post_title ?> - <span><?= $tu ?></span></div>
                            <a href="/event/?id=<?= $idd ?>"><img
                                        src="<?= get_the_post_thumbnail_url($idd, 'full'); ?>" alt=""></a>
                        </div>
                    </div>
                    <?php
                }
				
                ?>
