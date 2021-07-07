<?php

function cryptotik_ajax_search_get_posts($search)
{
    return cryptotik_ajax_search_post_query([
        'post_type' => 'product',
        'post_status' => 'publish',
        'orderby' => 'title',
        'posts_per_page' => 100,
        'order' => 'ASC',
        'meta_query' => [
            [
                'key' => '_number_tov',
                'compare' => 'NOT EXISTS',
            ],
        ],
        's' => $search,
    ], 'event');
}

function cryptotik_ajax_search_get_tickets($search) {
    return cryptotik_ajax_search_post_query([
        'post_type' => 'product',
        'post_status' => 'publish',
        'orderby' => 'title',
        'posts_per_page' => 100,
        'meta_query' => [
            [
                'key' => '_number_tov',
                'compare' => '>',
                'value' => 0,
            ],
        ],
        's' => $search,
    ], 'ticket');
}

function cryptotik_ajax_search_get_hashtags($search) {
    return cryptotik_ajax_search_post_query([
        'post_type' => 'product',
        'post_status' => 'publish',
        'orderby' => 'title',
        'posts_per_page' => 100,
        'meta_query' => [
            [
                'key' => '_text_hash',
                'compare' => 'LIKE',
                'value' => $search,
            ],
        ],
    ], 'hashtag');
}

function cryptotik_ajax_search_post_query($args, $type) {

    $Wp_Query = new WP_Query;

    $posts = $Wp_Query->query($args);

    $result = [];

    if ($posts) {
        $i = 0;
        foreach ($posts as $post) {
            setup_postdata($post);
            $result[] = [
                'href' => esc_url('/event/?id=' . $post->ID),
                'name' => esc_html($type === 'hashtag' ? get_post_meta($post->ID, '_text_hash', true) : $posts[$i]->post_title),
            ];
            $i++;
        }
        wp_reset_postdata();
    }

    return $result ? $result : [];
}


//if (strpos($search, "#") > -1) {
//    $tags = strtolower(str_replace(array(' ', '#'), array('-', ''), $search));
//    $args = array(
//        'posts_per_page' => -1,
//        'order' => 'ASC',
//        'orderby' => 'title',
//        'post_type' => 'product',
//        'post_status' => 'publish',
//        'tag' => $tags
//    );
//}
