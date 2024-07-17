<?php
if (empty($post)) {
    return;
}

?>

<div class="card__img">
    <?php echo get_thumbnail_html($post->ID, $post->post_title); ?>
</div>
<div class="card__body">
    <h1 class="card__title">
        <?php echo esc_html($post->post_title); ?>
    </h1>
    <?php echo link_html($link ?? '', 'card__btn btn'); ?>
    <?php get_template_part_var('global/card-socials', [
        'socials' => $fields['socials'] ?? []
    ]); ?>
</div>
