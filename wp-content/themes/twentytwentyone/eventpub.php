<?php
/**
 * Template Name: eventpub
 * @global wpdb $wpdb WordPress database abstraction object.
 */

get_header();


$wp_query = new WP_Query();

// делаем запрос
$myposts50 = $wp_query->query(array(
    'post_type' => 'product',
    'orderby' => 'ID',
    'posts_per_page' => 5000,
    'meta_query' => array(
        array(
            'key' => '_number_tov',
            'compare' => 'NOT EXISTS'
        ),
    ),
));
$gah = array();
foreach ($myposts50 as $pst) {
    $ha = get_post_meta($pst->ID, '_text_hash', true);
    $ha1 = explode(',', $ha);

    foreach ($ha1 as $hop) {
        if (!empty($hop)) {
            $gah[] = $hop;
        }

    }

}

$result = array_unique($gah);

?>


<main class="page-main events-circles">
    <section class="tags-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-tag">
                    <form method="get" class="form-search">
                        <button>
                            <img src="/wp-content/themes/twentytwentyone/img/svg/search.svg" alt="">
                        </button>
                        <input onkeyup="sert()" onblur="sert()" type="text" id="ser" name="sea" placeholder="e.g #LGBTQ , #NEWYORK , #LATIN , #ELECTRONIC"
                               class="search-input-placeholder-js">
                           <button class="reset" type="reset" onclick="sertReset()">
                              <svg width="26" height="26" aria-hidden="true">
                              <use xlink:href="#icon-close-md"></use>
                              </svg>
                            </button>
                           
                    </form>
                    <div class="tags">
                        <?php  foreach ($result as $tag) {
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="event">
            <div class="h2">Events</div>
            <div class="owl-carousel-slider-5 owl-carousel owl-theme owl-events">
                <?php
                $events_query = [
                    'post_type' => 'product',
                    'orderby' => 'ID',
                    'posts_per_page' => 5000,
                    'meta_query' => array(
                        array(
                            'key' => '_number_tov',
                            'compare' => 'NOT EXISTS'
                        ),
                    ),
                ];

                if( $_GET['search'] ?? false ) {
                    $events_query['s'] = $_GET['search'];
                }

                // делаем запрос
                $events = $wp_query->query($events_query);

                foreach ($events as $event) {
                    $dat = get_post_meta($event->ID, '_text_dat', true);

                    $er = explode('-', $dat);
                    $tu = $er[0] . '.' . $er[1];
                    ?>

                    <div class="item">
                        <a href="/event/?id=<?= $event->ID ?>" class="img">
                            <img src="<?= get_the_post_thumbnail_url($event->ID, 'full'); ?>" alt="">
                            <div class="data"><?= $event->post_title ?>  - <span><?=$tu?></span></div>
                        </a>
                        <div class="md-visible">
                            <div class="h4"><?= $event->post_title ?> - <span><?= $tu ?></span></div>
                            <a href="/event/?id=<?= $event->ID ?>"><img
                                        src="<?= get_the_post_thumbnail_url($event->ID, 'full'); ?>" alt=""></a>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="event">
            <div class="h2">Top Circles</div>
            <div class="owl-carousel-slider-4 owl-carousel owl-theme owl-product">
                <?php

                $users_query = [
                    'role' => 'circle',
                    'orderby' => 'nicename',
                    'order' => 'ASC',
                ];

                if( $_GET['search'] ?? false ) {
                    $users_query['meta_query'] = [
                        [
                            'key' => 'fio',
                            'value' => $_GET['search'],
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
                                
                                if (strlen($uro)>0) {
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
                                    $uro = get_user_meta($user->ID, $wpdb->get_blog_prefix() . 'user_avatar', true);

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

            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>
