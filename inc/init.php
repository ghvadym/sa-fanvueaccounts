<?php

const DOMAIN = 'fvacc';

if (!defined('POSTS_PER_PAGE')) {
    define('POSTS_PER_PAGE', get_option('posts_per_page') ?: 12);
}

if (!defined('TOTAL_POSTS')) {
    define('TOTAL_POSTS',  wp_count_posts()->publish);
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