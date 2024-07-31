<?php

const DOMAIN = 'fvacc';

if (!defined('POSTS_PER_PAGE')) {
    define('POSTS_PER_PAGE', get_option('posts_per_page') ?: 12);
}

if (!defined('TOTAL_POSTS')) {
    define('TOTAL_POSTS',  wp_count_posts()->publish);
}

if (!defined('ADV_ITERATOR_FOR_CARDS')) {
    define('ADV_ITERATOR_FOR_CARDS', wp_is_mobile() ? 3 : 5);
}

$files = [
    'helper',
    'custom_functions',
    'cpt',
    'sidebar',
    'setup',
    'ajax'
];

foreach ($files as $file) {
    require_once("$file.php");
}