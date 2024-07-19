<?php

add_filter('show_admin_bar', '__return_false');
add_filter('use_widgets_block_editor', '__return_false');

add_action('wp_enqueue_scripts', 'wp_enqueue_scripts_call');
function wp_enqueue_scripts_call()
{
    wp_enqueue_style('swiper-styles', FV_THEME_URL . '/dest/lib/swiper-slider/swiper.css');
    wp_enqueue_script('swiper-scripts', FV_THEME_URL . '/dest/lib/swiper-slider/swiper.js');

    //wp_enqueue_style('owl-styles', FV_THEME_URL . '/dest/lib/owl-carousel/owl.css');
    //wp_enqueue_script('owl-scripts', FV_THEME_URL . '/dest/lib/owl-carousel/owl.js');

    wp_enqueue_style('main-style', FV_THEME_URL . '/dest/css/app-style.css');
    wp_enqueue_script('main-scripts', FV_THEME_URL . '/dest/js/app-scripts.js', ['jquery'], time());

    wp_localize_script('main-scripts', 'fvajax', [
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('posts-nonce')
    ]);

    if (is_home() || is_front_page()) {
        wp_enqueue_style('home-styles', FV_THEME_URL . '/dest/css/home.css');
    }

    if (is_archive() || is_tax() || is_tag()) {
        wp_enqueue_style('archive-styles', FV_THEME_URL . '/dest/css/archive.css');
        wp_enqueue_script('archive-scripts', FV_THEME_URL . '/dest/js/archive-scripts.js', ['jquery'], time());
    }

    if (is_single()) {
        wp_enqueue_style('single-style', FV_THEME_URL . '/dest/css/single-post.css');
    }

    if (is_page_template('templates/about-us.php')) {
        wp_enqueue_style('about-style', FV_THEME_URL . '/dest/css/about.css');
    }
}

add_action('after_setup_theme', 'after_setup_theme_call');
function after_setup_theme_call()
{
    register_nav_menus([
        'main_header' => __('Main Header', DOMAIN)
    ]);

    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', [
        'unlink-homepage-logo' => true
    ]);

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

add_action('admin_menu', 'remove_default_post_types');
function remove_default_post_types()
{
    remove_menu_page('edit-comments.php');
}

add_filter('upload_mimes', 'upload_mimes_types');
function upload_mimes_types($types)
{
    $types['svg'] = 'image/svg+xml';
    $types['webp'] = 'image/webp';

    return $types;
}

add_filter('wpseo_breadcrumb_separator', 'wpseo_breadcrumb_separator_call', 10, 1);
function wpseo_breadcrumb_separator_call($separator) {
    return '<svg width="7" height="11" viewBox="0 0 7 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.60646 0.912893L6.55424 4.51989C6.69555 4.64873 6.80765 4.80177 6.88414 4.97024C6.96063 5.13872 7 5.31932 7 5.50172C7 5.68411 6.96063 5.86472 6.88414 6.03319C6.80765 6.20167 6.69555 6.3547 6.55424 6.48354L2.60646 10.0905C1.64618 10.9679 9.00529e-07 10.3412 7.92171e-07 9.10175L0 1.88776C-1.08358e-07 0.648286 1.64618 0.0355155 2.60646 0.912893Z" fill="#564C4C"/></svg>';
};