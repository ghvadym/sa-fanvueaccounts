<?php
if (empty($post)) {
    return;
}

$thumbnail = get_thumbnail_html($post->ID, $post->post_title, 'large');
$advFields = get_field('cards_banner', 'options');

if (isset($bannerNumb)) {
    $advField = $advFields[$bannerNumb] ?? [];
}
?>

<?php if (!empty($banner) && !empty($advField)) { ?>
    <div class="article">
        <?php adv_banner_group($advField); ?>
    </div>
<?php } ?>

<div class="article">
    <div class="article__body">
        <a href="<?php echo get_the_permalink($post); ?>"
           class="article__img">
            <?php echo $thumbnail; ?>
        </a>
        <div class="article__content">
            <h3 class="article__title">
                <a href="<?php echo get_the_permalink($post); ?>">
                    <?php echo esc_html($post->post_title); ?>
                </a>
            </h3>
            <?php if ($post->post_content) { ?>
                <div class="article__text">
                    <?php echo wp_trim_words(strip_tags($post->post_content), 15, '...') ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
