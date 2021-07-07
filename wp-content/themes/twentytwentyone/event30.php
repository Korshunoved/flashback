<?php
/**
 * Template Name: event
 * @global wpdb $wpdb WordPress database abstraction object.
*/
$error = '';
get_header();

if (!empty($_GET)) {
    $idd = $_GET['id'];

    $post = get_post($idd);

    $dat = get_post_meta($idd, '_text_dat', true);

    $er = explode('-', $dat);
    $tu = $er[0] . '.' . $er[1];
    $idu = get_post_meta($idd, '_number_cir', true);
    $user = get_user_by('id', $idu);

    $fio = get_user_meta($user->ID, 'fio', true);

    ?>
    <main class="page-public-event page-user-views">
        <div class="container">
            <div class="row justify-content-between">
                <aside class="sidebar col lg-hide">
                    <a href="#" class="sidebar-img"><img src="<?= get_the_post_thumbnail_url($idd, 'medium'); ?>"
                                                         alt=""></a>
                </aside>
                <article class="content col">
                    <div class="h1"><?= $post->post_title ?> - <span><?= $tu ?></span></div>
                    <div class="h1-urder"><?= $post->post_content ?></div>
                    <div style="cursor:pointer" onclick="window.location.href='/circle/?id=<?= $user->ID ?>'"
                            class="content-icon">
                        <div class="img pop">
                            <?php
                            $uro = get_user_meta($user->ID, $wpdb->get_blog_prefix() . 'user_avatar', true);
                            if (!empty($uro)) {
                                echo wp_get_attachment_image($uro, array(64, 64));
                            } else {
                                ?>
                                <img src="/wp-content/themes/twentytwentyone/img/img-chery.jpg" alt="">
                                <?php
                            }
                            ?>
                        </div>
                        <div class="h3"><?= $fio ?></div>
                    </div>

                    <div class="list-wrapp">
                        <div class="h3">Tickets</div>
                        <ul class="list-img">

                            <?php
                            $my_posts5 = new WP_Query;

                            $myposts5 = $my_posts5->query(array(
                                'post_type' => 'product',
                                'meta_query' => array(
                                    array(
                                        'key' => '_number_tov',
                                        'value' => $_GET['id'],

                                    ),
                                ),
                            ));
                            $m = 0;
                            foreach ($myposts5 as $pst5) {
                                $m++;
                                $pd5 = $pst5->ID;
                                $cen = get_post_meta($pd5, '_regular_price', true);
                                ?>
                                <li>
                                    <a href="#" class="img">
                                        <img src="<?= get_the_post_thumbnail_url($pd5, 'full'); ?>" alt="">
                                    </a>
                                    <div>
                                        <div class="h4"><?= $pst5->post_title ?> - $<?= $cen ?></div>
                                        <div class="btns_buy">
                                            <a href="#" class="btn btn_green">BUY NFT</a>
                                            <a href="#" class="modal__trigger btn-modal" data-modal="modal-<?= $m; ?>"></a>
                                        </div>
										<?
$current_user = wp_get_current_user();
  $idio=$current_user->ID;
  	
										if ($iduo==$idio)
										{
										?>
										
                                        <div class="btns_buy">
                                            <a href="#" class="btn btn_green btn-modal" data-modal="modal_transf-<?= $m; ?>">Transfer</a>
                                            <a href="#" class="btn btn_green btn-modal" data-modal="modal_burn-<?= $m; ?>">Burn</a>
                                        </div>
										
										<?
										}
										?>
                                    </div>
                                </li>

                                <div class="modal modal-share" id="modal-<?= $m; ?>">
								  <div class="modal__inner">
                                    <div class="modal_content">
                                        <a href="#" class="modal__close" data-modal="modal-<?= $m; ?>"></a>
                                        <span class="modal-share--title">Share wi†h Friends</span>
                                        
                                        <div class="modal-list_social">
                                            <a href="#">
                                                <img src="<?= get_template_directory_uri() ?>/img/i_tweet.png" alt="">
                                                <span>Tweet</span>
                                            </a>
                                            <a href="#">
                                                <img src="<?= get_template_directory_uri() ?>/img/i_in.png" alt="">
                                                <span>Share</span>
                                            </a>
                                            <a href="#">
                                                <img src="<?= get_template_directory_uri() ?>/img/i_insta.png" alt="">
                                                <span>Post</span>
                                            </a>
                                            <a href="#">
                                                <img src="<?= get_template_directory_uri() ?>/img/i_fb.png" alt="">
                                                <span>Share</span>
                                            </a>
                                            <a href="#" id="btn_copy_url" onclick="myFunction()">
                                                <img src="<?= get_template_directory_uri() ?>/img/i_copy.png" alt="">
                                                <span>Copy URL</span>
                                            </a>
                                        </div>
                                    </div>
								  </div>
								</div>

                                <div class="modal modal-share" id="modal_transf-<?= $m; ?>">
                                  <div class="modal__inner">
                                    <div class="modal_content">
                                        <a href="#" class="modal__close" data-modal="modal_transf-<?= $m; ?>"></a>
                                        
                                        <div class="modal_cont_b">
                                            <span class="modal-share--title">Transfer Ticket</span>
                                            <span class="modal-share--subtitle">Please input FlashBack ID of a user who you want to transfer your ticket to</span>
                                            <input type="text" class="modal_b_inp" placeholder="Flashback ID">
                                            <div><button class="modal_b_btn">TRANSFER</button></div>
                                        </div>
                                        
                                    </div>
                                  </div>
                                </div>

                                <div class="modal modal-share" id="modal_burn-<?= $m; ?>">
                                  <div class="modal__inner">
                                    <div class="modal_content">
                                        <a href="#" class="modal__close" data-modal="modal_burn-<?= $m; ?>"></a>
                                        
                                        <div class="modal_cont_b">
                                            <span class="modal-share--title">Burn Ticket</span>
                                            <span class="modal-share--subtitle">Are you sure that you want to permanently delete these tickets?</span>
                                            <div class="modal_cont_b_btns">
                                                <button class="modal_v_btn">NO</button>
                                                <button class="modal_v_btn">YES</button>
                                            </div>
                                        </div>

                                    </div>
                                  </div>
                                </div>
                                <div class="modal-overlay"></div>
                            <?php } ?>
                        </ul>
                    </div>

                </article>
            </div>
        </div>
<input style="opacity: 0;" type="text" name="copy_url" id="copy_url" value="<?php $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; echo $actual_link; ?>">
    </main>
    <style>
.modal_cont_b {
    display: flex;
    flex-direction: column;
}

.modal_cont_b_btns {
    margin-top: 15px;
    display: flex;
    justify-content: space-between;
}

.modal_v_btn {
    margin-top: 15px;
    background: #000;
    border-radius: 10px;
    padding: 5px 15px;
    color: #C3FDAB;
    font-size: 18px;
    font-weight: 700;
    border: none;
    width: 40%;
}

.modal_b_inp {
    margin-top: 15px;
    background: #141414;
    opacity: .5;
    padding: 15px;
    border-radius: 15px;
    border: none;
}

.modal-share--subtitle {
    margin-top: 15px;
    font-size: 18px;
    color: #F5175D;
}

.btns_buy {
    display: flex;
    flex-direction: row;
    align-items: center;
}

.modal_b_btn {
    margin-top: 15px;
    background: #F5175D;
    border-radius: 10px;
    padding: 5px 15px;
    color: #C3FDAB;
    font-size: 18px;
    font-weight: 700;
    border: none;
}

.modal__trigger {
    width: 28px;
    height: 26px;
    margin-top: 17px;
    display: block;
    background-image: url('<?= get_template_directory_uri() ?>/img/link_up.svg');
}

.modal {
  display: none;
  position: fixed;
  top: calc(50% - 225px);
  right: 0;
  bottom: 0;
  left: calc(50% - 225px);
  text-align: left;
  z-index: 5555;
  width: 100%;
  height: 100%;
  max-width: 450px;
  max-height: 450px;
}

.modal-active {
  display: block;
}

.modal__bg {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  cursor: pointer;
}

.modal-state {
  display: none;
}

.modal-state:checked + .modal {
  opacity: 1;
  visibility: visible;
}

.modal-state:checked + .modal .modal__inner {
  top: 0;
}

.modal__inner {
    transition: top .25s ease;
    position: absolute;
    top: -20%;
    right: 0;
    bottom: 0;
    left: 0;
    width: 100%;
    max-width: 450px;
    margin: auto;
    overflow: auto;
    background: #C3FDAB;
    border-radius: 30px;
    padding: 1em;
    display: flex;
    align-items: center;
    max-height: 350px;
    text-align: center;
}

.modal__close {
  position: absolute;
  right: 1em;
  top: 1em;
  width: 1.1em;
  height: 1.1em;
  cursor: pointer;
}

.modal__close:after,
.modal__close:before {
  content: '';
  position: absolute;
  width: 2px;
  height: 1.5em;
  background: #ccc;
  display: block;
  transform: rotate(45deg);
  left: 50%;
  margin: -3px 0 0 -1px;
  top: 0;
}

.modal__close:hover:after,
.modal__close:hover:before {
  background: #aaa;
}

.modal__close:before {
  transform: rotate(-45deg);
}

@media screen and (max-width: 768px) {
  
  .modal__inner {
    width: calc(100% - 30px);
    height: 100%;
    box-sizing: border-box;
  }

  .modal__inner::-webkit-scrollbar {
      width: 0;
    }

    .modal_content::-webkit-scrollbar {
      width: 0;
    }

  .modal {
    display: none;
    position: fixed;
    top: 200px;
    right: 0;
    bottom: 0;
    left: 0px;
    text-align: left;
    z-index: 9;
    width: 100%;
    height: 100%;
    max-width: 100%;
    max-height: 450px;
    }
}

.modal-share .modal-share--title {
  font-size: 36px;
  font-weight: 700;
  color: #F5175D;
  text-align: center;
}

.modal-list_social {
    padding-top: 15px;
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: center;
}

.modal-list_social a {
    width: 50%;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    padding: 10px 0;
}

.modal-list_social a span {
    padding-left: 10px;
    color: #F5175D;
}

.modal-overlay {
  display: none;
  z-index: 8;
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
}
    </style>


    <?php

}

get_footer(); ?>