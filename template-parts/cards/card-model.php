<?php
if (empty($fields)) {
    return;
}

$imgUrl = !empty($fields['fanvue_img']) ? wp_get_attachment_image_url($fields['fanvue_img'], 'large') : '';
?>

<?php if ($imgUrl) { ?>
    <div class="card__img">
        <img src="<?php echo esc_url($imgUrl); ?>" alt="<?php echo $fields['fanvue_name'] ?? ''; ?>">
    </div>
<?php } ?>
<div class="card__body">
    <?php if (!empty($fields['fanvue_name'])) { ?>

    <?php } ?>
    <h1 class="card__title">
        <?php if (!empty($fields['fanvue_name'])) {
            echo esc_html($fields['fanvue_name']);
        } else {
            echo esc_html($post->post_title);
        } ?>
    </h1>
    <?php if (!empty($fields['fanvue_username'])) { ?>
        <a href="<?php echo esc_url(home_url($fields['fanvue_username'])); ?>" class="card__btn btn">
            <?php _e('Free Nude Photos', DOMAIN); ?>
        </a>
    <?php } ?>
    <?php get_template_part_var('global/card-socials', [
        'socials' => $fields['socials'] ?? []
    ]); ?>
</div>
