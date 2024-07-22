<?php

get_header();
$post = get_post();
$fields = get_fields($post->ID);

if (get_field('use_options_banner', 'options')) {
    if (!wp_is_mobile()) {
        $thumbnailId = get_field('posts_banner', 'options');
    } else {
        $thumbnailId = get_field('posts_banner_mob', 'options');
    }

    $bannerUrl = get_field('banner_url', 'options');
} else {
    if (!wp_is_mobile()) {
        $thumbnailId = get_field('banner_img', $post->ID);
    } else {
        $thumbnailId = get_field('banner_img_mob', $post->ID);
    }

    $bannerUrl = get_field('banner_url', $post->ID);
}

if (get_field('use_options_get_in_touch_link', 'options')) {
    $getInTouchLink = get_field('get_in_touch_link', 'options');
} else {
    $getInTouchLink = get_field('get_in_touch_link', $post->ID);
}
?>

<section class="single_hero">
    <div class="container">
        <h1 class="single__title">
            <?php echo $post->post_title; ?>
        </h1>
        <?php get_banner($thumbnailId, $bannerUrl); ?>
    </div>
</section>

<section class="section_content">
    <div class="container">
        <div class="single__content">
            <div class="single__content_row">
                <div class="card">
                    <?php get_template_part_var('cards/card-model', [
                        'post'   => $post,
                        'fields' => $fields
                    ]); ?>
                </div>
                <?php if (!empty($fields['main_info_text'])) { ?>
                    <div class="text_block">
                        <?php echo $fields['main_info_text'];

                        if (!empty($fields['main_info_link'])) {
                            echo link_html($fields['main_info_link'] ?? [], 'card__btn btn_light');
                        } ?>
                    </div>
                <?php } ?>
                <?php if (!wp_is_mobile() && !empty($fields['main_info_banner_img'])) { ?>
                    <div class="single__banner">
                        <?php get_banner($fields['main_info_banner_img'], $fields['main_info_banner_url'] ?? ''); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<?php get_template_part_var('single/socials-slider', [
    'fields' => $fields
]); ?>

<?php if (!empty($fields['gallery_text'])) { ?>
    <section class="section_content gallery_text_content">
        <div class="container">
            <div class="single__content">
                <div class="single__content_row">
                    <?php if (!empty($fields['gallery_text_banner_img'])) { ?>
                        <div class="single__banner">
                            <?php get_banner(
                                $fields['gallery_text_banner_img'],
                                $fields['gallery_text_banner_url'] ?? ''
                            ); ?>
                        </div>
                    <?php } ?>
                    <div class="text_block">
                        <?php echo $fields['gallery_text']; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>

<section class="section_content additional_content">
    <div class="container-sm">
        <div class="single__content">
            <div class="single__content_row">
                <?php if (!empty($fields['onlyfans_title']) || !empty($fields['onlyfans_text'])) { ?>
                    <div class="text_block">
                        <?php if (!empty($fields['onlyfans_title'])) { ?>
                            <h2>
                                <?php echo $fields['onlyfans_title']; ?>
                            </h2>
                        <?php } ?>
                        <?php echo !empty($fields['onlyfans_text']) ? $fields['onlyfans_text'] : ''; ?>
                    </div>
                <?php } ?>
                <?php if (!empty($fields['onlyfans_banner_img'])) { ?>
                    <div class="card">
                        <div class="card__img">
                            <?php if (!empty($fields['onlyfans_banner_tag'])) { ?>
                                <div class="card__img_tag">
                                    <?php echo $fields['onlyfans_banner_tag']; ?>
                                </div>
                            <?php } ?>

                            <?php if (!empty($fields['onlyfans_banner_link'])) { ?>
                                <a href="<?php echo esc_url($fields['onlyfans_banner_link']) ?>" target="_blank">
                                    <?php echo wp_get_attachment_image($fields['onlyfans_banner_img'], 'large'); ?>
                                </a>
                            <?php } else {
                                echo wp_get_attachment_image($fields['onlyfans_banner_img'], 'large');
                            } ?>
                        </div>
                        <div class="card__body">
                            <?php if (!empty($fields['onlyfans_banner_link'])) { ?>
                                <a href="<?php echo esc_url($fields['onlyfans_banner_link']); ?>" target="_blank" class="card__btn btn">
                                    <?php echo !empty($fields['onlyfans_banner_btn_text']) ? $fields['onlyfans_banner_btn_text'] : __('Subscribe', DOMAIN); ?>
                                </a>
                            <?php } ?>

                            <?php get_template_part_var('global/card-socials', [
                                'socials' => $fields['socials'] ?? []
                            ]); ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<?php if (!empty($fields['content'])) { ?>
    <?php foreach ($fields['content'] as $contentItem) {
        get_template_part_var('single/content', [
            'content' => $contentItem
        ]);
    } ?>
<?php } ?>

<?php

get_template_part_var('global/faq', [
    'faq_list' => get_field('faq', $post->ID)
]);

get_footer();