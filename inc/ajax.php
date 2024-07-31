<?php

register_ajax([
    'load_posts'
]);

function load_posts()
{
    check_ajax_referer('posts-nonce', 'nonce');

    $data = sanitize_post($_POST);
    $page = $data['page'] ?? 1;
    $termId = $data['term'] ?? 0;

    $advFields = get_field('cards_banner', 'options');
    $advItemsCount = !empty($advFields) ? count($advFields) : 0;

    $numberposts = POSTS_PER_PAGE;
    $offset = ($page - 1) * ($numberposts);

    if (empty($data)) {
        wp_send_json_error('There is no data');
        return;
    }

    if ($advItemsCount) {
        $numberposts += $advItemsCount;

        if ($page > 2) {
            $offset += $advItemsCount;
        }

        /*if ($page > 3) {
            $offset += ($advItemsCount + $advItemsCount);
            $numberposts += $advItemsCount;
        }*/
    }

    $args = [
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => $numberposts,
        'paged'          => $page,
        'offset'         => $offset,
        'orderby'        => 'DATE',
        'order'          => 'DESC'
    ];

    if ($termId) {
        $args['tax_query'] = [
            'relation' => 'OR',
            [
                'taxonomy' => 'category',
                'field'    => 'id',
                'terms'    => [$termId]
            ],
            [
                'taxonomy' => 'post_tag',
                'field'    => 'id',
                'terms'    => [$termId]
            ]
        ];
    }

    $query = new WP_Query($args);

    ob_start();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part_var('cards/card-post', [
                'post' => $query->post
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
        'count'     => count($query->posts),
        'end_posts' => ($numberposts * $page - $advItemsCount) >= $query->found_posts
    ]);
}