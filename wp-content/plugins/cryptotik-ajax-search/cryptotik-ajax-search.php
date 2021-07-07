<?php
/**
 * @package Cryptotik Ajax Search
 * @version 0.1

Plugin Name: Cryptotik Ajax Search
Description: Плагин AJAX поиска для Cryptotik
Author: Nikita Germanov
Version: 0.1
Author URI: mailto:nikita_germanov@mail.ru
*/

/*
1) circles - это клубы - user
2) influencer - это примерно - user
3) events - 'post_type' => 'product'
4) tickets - это билеты - postmeta
5) hashtags - это хэштеги - postmeta

//error_reporting(E_ALL);
//ini_set('display_startup_errors', 1);
//ini_set('display_errors', '1');
*/

include plugin_dir_path( __FILE__ ) . 'includes/getUsers.php';
include plugin_dir_path( __FILE__ ) . 'includes/getPosts.php';


function cryptotik_ajax_search()
{
    $queryString = (isset($_POST['queryString']))
        ? trim(sanitize_text_field(wp_unslash($_POST['queryString'])))
        : '';

    $result = [
        'Circles' => cryptotik_ajax_search_get_users($queryString, 'circle'),
        'Influencers' => cryptotik_ajax_search_get_users($queryString, 'influencer'),
        'Events' => cryptotik_ajax_search_get_posts($queryString),
        'Tickets' => cryptotik_ajax_search_get_tickets($queryString),
        'Hashtags' => cryptotik_ajax_search_get_hashtags($queryString),
    ];

    if ($result) {
        echo json_encode($result);
    }
    else {
        echo "empty";
    }
    die();
}
if( wp_doing_ajax() ) {
    add_action('wp_ajax_cryptotik_ajax_search', 'cryptotik_ajax_search');
    add_action('wp_ajax_nopriv_cryptotik_ajax_search', 'cryptotik_ajax_search');
}

function cryptotik_ajax_search_enqueue_scripts() {
    wp_enqueue_style( 'cryptotik-ajax-search-css', plugins_url( 'css/cryptotik-ajax-search.css', __FILE__ ));
    wp_enqueue_script( 'cryptotik-ajax-search', plugins_url('js/cryptotik-ajax-search.js', __FILE__));
}
add_action( 'wp_enqueue_scripts', 'cryptotik_ajax_search_enqueue_scripts', 99);

function cryptotik_ajax_data(){
    wp_localize_script( 'jquery', 'cryptotikAjax',
        array(
            'url' => admin_url('admin-ajax.php')
        )
    );
}
add_action( 'wp_enqueue_scripts', 'cryptotik_ajax_data', 99 );