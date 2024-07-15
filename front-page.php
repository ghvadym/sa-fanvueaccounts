<?php
/*
* Template name: Home
*/

get_header();

$post_id = get_the_ID();
$fields = get_fields($post_id);

get_template_part_var('home/hero', [
    'fields' => $fields
]);

get_template_part_var('home/search', [
    'fields' => $fields
]);

get_template_part_var('home/top-accounts');

get_template_part_var('home/cta', [
    'fields' => $fields
]);

get_template_part_var('global/faq', [
    'faq_list' => $fields['faq'] ?? []
]);

get_footer();
