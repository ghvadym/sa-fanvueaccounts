<?php

register_ajax([
    'load_posts'
]);

function load_posts()
{
    check_ajax_referer('posts-nonce', 'nonce');

    $data = sanitize_post($_POST);
    $page = $data['page'] ?? 1;
    $search = $data['search'] ?? '';
    $terms = [];

    if (empty($data)) {
        wp_send_json_error('There is no data');
        return;
    }

    $args = [
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => POSTS_PER_PAGE,
        'paged'          => $page,
        'offset'         => ($page - 1) * POSTS_PER_PAGE,
        'orderby'        => 'DATE',
        'order'          => 'DESC'
    ];

    if ($search) {
        $args['s'] = htmlspecialchars($search);
    }

    $posts = new WP_Query($args);

    ob_start();

    if ($posts->have_posts()) {
        while ($posts->have_posts()) {
            $posts->the_post();
            get_template_part_var('cards/card-post', [
                'post' => $posts->post
            ]);
        }
    } else {
        echo '<h3 class="no-posts-message">' . __('Posts not found', DOMAIN) . '</h3>';
    }

    $html = ob_get_contents();
    ob_end_clean();

    wp_send_json([
        'posts'     => $html,
        'append'    => $page > 1,
        'count'     => count($posts->posts),
        'end_posts' => count($posts->posts) < POSTS_PER_PAGE
    ]);
}