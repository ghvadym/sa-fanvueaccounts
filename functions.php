<?php

add_action('wp_enqueue_scripts', 'petite_stories_child_theme_enqueue_styles');
function petite_stories_child_theme_enqueue_styles()
{
    wp_enqueue_style('petite-stories-child-theme-parent-style', get_template_directory_uri() . '/style.css');
}

add_action('after_setup_theme', 'after_setup_theme_call');
function after_setup_theme_call()
{
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page([
            'page_title' => 'Options',
            'menu_title' => 'Options',
            'menu_slug'  => 'theme-general-settings',
            'capability' => 'edit_posts',
            'redirect'   => false,
        ]);
    }
}

function create_post_type($postType, $args = [])
{
    $args = array_merge([
        'public'        => false,
        'show_ui'       => true,
        'has_archive'   => false,
        'menu_position' => 20,
        'hierarchical'  => false,
        'supports'      => ['title', 'excerpt', 'thumbnail', 'editor'],
    ], $args);

    register_post_type($postType, $args);
}

add_action('init', 'create_post_types');
function create_post_types()
{
    create_post_type('social', [
        'menu_icon' => 'dashicons-share',
        'supports'  => ['title', 'thumbnail'],
        'labels'    => [
            'name'          => __('Socials', 'petite-stories-child-theme'),
            'singular_name' => __('Social', 'petite-stories-child-theme'),
            'add_new'       => __('Add New Social', 'petite-stories-child-theme'),
            'add_new_item'  => __('Add New Social', 'petite-stories-child-theme'),
            'view_item'     => __('View Social', 'petite-stories-child-theme'),
            'search_items'  => __('Find Social', 'petite-stories-child-theme'),
            'not_found'     => __('Social isn\'t found', 'petite-stories-child-theme'),
            'menu_name'     => __('Social', 'petite-stories-child-theme'),
        ],
    ]);
}

add_filter('upload_mimes', 'upload_allow_types');
function upload_allow_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    $mimes['webp'] = 'image/webp';

    return $mimes;
}

/* Disable comments */
add_filter('comments_open', '__return_false');

add_shortcode('latest_posts', 'latest_posts_call');

function latest_posts_call($atts, $content = null)
{
    $atts = shortcode_atts([
        'items' => 3,
    ], $atts);

    $posts = get_posts([
        'post_type'   => 'post',
        'post_status' => 'publish',
        'numberposts' => $atts['items'] ?? 3,
    ]);

    if (empty($posts)) {
        echo sprintf('<h3>%s</h3>', __('Posts not found.', 'petite-stories-child-theme'));
        return;
    }
    ?>
    <div class="add-blog-to-sidebar petite-posts-section">
        <div class="all-blog-articles petite-latest-posts">
            <?php foreach ($posts as $post) {
                $terms = get_the_terms($post->ID, 'category');
                $term = $terms[0] ?? '';
                $thumbnail_url = has_post_thumbnail($post->ID) ? get_the_post_thumbnail_url($post, 'petite-stories-noresize') : '';
                $post_url = get_the_permalink($post->ID);
                $author_id = get_the_author_meta('ID');
                $author_name = get_the_author_meta('display_name', $author_id);
                $author_avatar = get_avatar_url($author_id, 32);
                ?>
                <div class="petite-stories-colcade-column">
                    <div class="posts-entry fbox blogposts-list post type-post status-publish format-standard has-post-thumbnail hentry">
                        <div class="featured-img-box">
                            <a href="<?php echo esc_url($post_url); ?>" class="featured-thumbnail">
                                <?php if ($thumbnail_url) { ?>
                                    <img src="<?php echo esc_url($thumbnail_url); ?>" alt="Thumbnail">
                                <?php } ?>
                                <?php if (!empty($term)) { ?>
                                    <div class="featured-img-category">
                                        <?php echo esc_html($term->name); ?>
                                    </div>
                                <?php } ?>
                            </a>
                            <div class="content-wrapper">
                                <header class="entry-header">
                                    <h2 class="entry-title">
                                        <a href="<?php echo esc_url($post_url); ?>" rel="bookmark">
                                            <?php echo esc_html($post->post_title); ?>
                                        </a>
                                    </h2>
                                    <div class="entry-meta">
                                        <div class="blog-data-wrapper">
                                            <?php if ($author_avatar) { ?>
                                                <div class="header-author-container-img-wrapper"
                                                     style="background-image: url(<?php echo esc_url($author_avatar); ?>)"></div>
                                            <?php } ?>
                                            <div class="post-meta-inner-wrapper">
                                                <div class="post-author-wrapper">
                                                    <?php echo esc_html($author_name) ?>,
                                                </div>
                                                <span class="posted-on">
                                            <a href="<?php echo esc_url($post_url); ?>" rel="bookmark">
                                                <time class="entry-date published">
                                                    <?php echo get_the_date('F d, Y', $post->ID); ?>
                                                </time>
                                            </a>
                                        </span>
                                            </div>
                                        </div>
                                    </div>
                                </header>
                                <div class="entry-content">
                                    <p>
                                        <?php echo wp_trim_words($post->post_content, 15, '...'); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php
}

add_shortcode('popular_posts', 'popular_posts_call');

function popular_posts_call($atts, $content = null)
{
    $atts = shortcode_atts([
        'items' => 4,
    ], $atts);

    $posts = get_popular_posts($atts['items'] ?? 4);

    if (empty($posts)) {
        echo sprintf('<h3>%s</h3>', __('Posts not found.', 'petite-stories-child-theme'));
        return;
    }
    ?>
    <div class="add-blog-to-sidebar petite-posts-section">
        <div class="all-blog-articles petite-popular-posts">
            <?php foreach ($posts as $post) {
                $terms = get_the_terms($post->ID, 'category');
                $term = $terms[0] ?? '';
                $thumbnail_url = has_post_thumbnail($post->ID) ? get_the_post_thumbnail_url($post, 'petite-stories-noresize') : '';
                $post_url = get_the_permalink($post->ID);
                $author_id = get_the_author_meta('ID');
                $author_name = get_the_author_meta('display_name', $author_id);
                $author_avatar = get_avatar_url($author_id, 32);
                ?>
                <div class="petite-stories-colcade-column ">
                    <div class="posts-entry fbox blogposts-list post type-post status-publish format-standard has-post-thumbnail hentry">
                        <div class="featured-img-box">
                            <a href="<?php echo esc_url($post_url); ?>" class="featured-thumbnail">
                                <?php if ($thumbnail_url) { ?>
                                    <img src="<?php echo esc_url($thumbnail_url); ?>" alt="Thumbnail">
                                <?php } ?>
                                <?php if (!empty($term)) { ?>
                                    <div class="featured-img-category">
                                        <?php echo esc_html($term->name); ?>
                                    </div>
                                <?php } ?>
                            </a>
                            <div class="content-wrapper">
                                <header class="entry-header">
                                    <h2 class="entry-title">
                                        <a href="<?php echo esc_url($post_url); ?>" rel="bookmark">
                                            <?php echo esc_html($post->post_title); ?>
                                        </a>
                                    </h2>
                                    <div class="entry-meta">
                                        <div class="blog-data-wrapper">
                                            <?php if ($author_avatar) { ?>
                                                <div class="header-author-container-img-wrapper"
                                                     style="background-image: url(<?php echo esc_url($author_avatar); ?>)"></div>
                                            <?php } ?>
                                            <div class="post-meta-inner-wrapper">
                                                <div class="post-author-wrapper">
                                                    <?php echo esc_html($author_name) ?>,
                                                </div>
                                                <span class="posted-on">
                                            <a href="<?php echo esc_url($post_url); ?>" rel="bookmark">
                                                <time class="entry-date published">
                                                    <?php echo get_the_date('F d, Y', $post->ID); ?>
                                                </time>
                                            </a>
                                        </span>
                                            </div>
                                        </div>
                                    </div>
                                </header>
                                <div class="entry-content">
                                    <p>
                                        <?php echo wp_trim_words($post->post_content, 15, '...'); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php
}

function post_meta_data(int $post_id = 0)
{
    if (!$post_id) {
        return;
    }

    $socials = get_field('socials', $post_id);
    $author_id = get_the_author_meta('ID');
    $author_name = get_the_author_meta('display_name', $author_id);
    $author_avatar = get_avatar_url($author_id, 32);
    ?>
    <div class="post-meta">
        <div class="post-meta-row">
            <div class="post-meta-author">
                <?php if ($author_avatar) { ?>
                    <img src="<?php echo esc_url($author_avatar); ?>" alt="Author avatar">
                <?php } ?>
                <span><?php echo esc_html($author_name); ?></span>
            </div>
            <?php if (!empty($socials)) { ?>
                <ul class="post-meta-socials">
                    <?php foreach ($socials as $social) {
                        $social_link = $social['link'] ?? '';
                        $social_id = $social['icon'] ?? '';

                        if (empty($social_id[0]) || !$social_link) {
                            continue;
                        }

                        $social_id = $social_id[0];
                        $thumbnail_url = has_post_thumbnail($social_id) ? get_the_post_thumbnail_url($social_id) : '';

                        if (!$thumbnail_url) {
                            continue;
                        }
                        ?>
                        <li class="wp-social-link">
                            <a href="<?php echo esc_url($social_link); ?>" target="_blank" rel="nofollow" class="wp-block-social-link-anchor">
                                <img src="<?php echo esc_url($thumbnail_url); ?>" alt="Icon image">
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>
        </div>
    </div>
    <?php
}

function get_popular_posts(int $limit = 4)
{
    global $wpdb;
    return $wpdb->get_results("
        SELECT * FROM {$wpdb->prefix}popularpostsdata 
            INNER JOIN wp_posts 
                ON postid = ID 
        WHERE post_status = 'publish' 
          AND post_type = 'post'
        ORDER BY pageviews 
        DESC LIMIT 
        $limit"
    );
}