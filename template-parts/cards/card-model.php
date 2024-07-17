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
    <?php if (!empty($link) && !empty($link['url'])) { ?>
        <a href="<?php echo esc_url($link['url'] ?? '') ?>"
           target="<?php echo esc_url($link['target'] ?? '_self') ?>"
           class="card__btn btn">
            <?php echo esc_html($link['title'] ?: __('Free Nude Photos', DOMAIN)); ?>
        </a>
    <?php } ?>
    <?php get_template_part_var('global/socials', [
        'socials' => $fields['socials'] ?? []
    ]); ?>
</div>
