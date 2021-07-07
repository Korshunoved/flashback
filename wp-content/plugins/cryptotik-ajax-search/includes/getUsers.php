<?php

function cryptotik_ajax_search_get_users($search, $role) {
    $users = get_users([
        'meta_query' => [
            [
                'key' => 'fio',
                'value' => $search,
                'compare' => 'LIKE',
            ],
        ],
        'role' => $role,
    ]);

    $result = [];

    if ($users) {
        $i = 0;
        foreach ($users as $user) {
            $result[] = [
                'href' => esc_url('/circle/?id='.$user->ID),
                'name' => esc_html(get_user_meta($user->ID, 'fio', true)),
            ];
            $i++;
        }
    }


    return $result ? $result : [];
}
