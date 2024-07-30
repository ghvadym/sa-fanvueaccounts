<?php
if (empty($post)) {
    return;
}

$thumbnail = get_thumbnail_html($post->ID, $post->post_title, 'large');
?>

<div class="article">
    <?php if (!empty($banner) && isset($bannerNumb)) { ?>
        <?php if ($advFields = get_field('cards_banner', 'options')) {
            $advField = $advFields[$bannerNumb] ?? []; ?>
            <?php if (!empty($advField)) { ?>
                <div class="banner">
                    <?php if ($advField['type'] === 'html') {
                        echo !empty($advField['html']) ? $advField['html'] : '';
                    } else if ($advField['type'] === 'img') {
                        echo get_banner(
                            $advField['img'] ?? '',
                            $advField['url'] ?? ''
                        );
                    } ?>
                </div>
            <?php } ?>
        <?php } ?>
    <?php } else { ?>
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
    <?php } ?>
</div>
