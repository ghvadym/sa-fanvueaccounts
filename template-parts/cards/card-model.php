<?php
if (empty($post)) {
    return;
}

if (get_field('use_options_get_in_touch_link', 'options')) {
    $getInTouchLink = get_field('get_in_touch_link', 'options');
} else {
    $getInTouchLink = get_field('get_in_touch_link', $post->ID);
}

?>

<div class="card__img">
    <?php echo get_thumbnail_html($post->ID, $post->post_title); ?>
</div>
<div class="card__body">
    <h1 class="card__title">
        <?php echo esc_html($post->post_title); ?>
    </h1>
    <?php if (!empty($getInTouchLink) && !empty($getInTouchLink['url'])) { ?>
        <a href="<?php echo esc_url($getInTouchLink['url'] ?? '') ?>"
           target="<?php echo esc_url($getInTouchLink['target'] ?? '_self') ?>"
           class="card__btn btn">
            <?php echo esc_html($getInTouchLink['title'] ?: __('Free Nude Photos', DOMAIN)); ?>
        </a>
    <?php } ?>
    <?php get_template_part_var('global/socials', [
        'socials' => $fields['socials'] ?? []
    ]); ?>
</div>
