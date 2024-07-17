<?php

get_header();
$post = get_post();
$fields = get_fields($post->ID);
$content = $fields['content'] ?? [];

if (get_field('use_options_banner', 'options')) {
    $optionsThumbnailId = get_field('posts_banner', 'options');
    $bannerUrl = get_field('banner_url', 'options');
    $bannerImg = $optionsThumbnailId ? wp_get_attachment_image($optionsThumbnailId, 'full') : '';
} else {
    $postThumbnailId = get_field('banner_img', $post->ID);
    $bannerUrl = get_field('banner_url', $post->ID);
    $bannerImg = wp_get_attachment_image($postThumbnailId, 'full');
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
        <?php if ($bannerImg) { ?>
            <?php if ($bannerUrl) { ?>
                <a href="<?php echo esc_url($bannerUrl); ?>" class="thumbnail" target="_blank" rel="noopener nofollow">
                    <?php echo $bannerImg; ?>
                </a>
            <?php } else { ?>
                <div class="thumbnail">
                    <?php echo $bannerImg; ?>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
</section>

<section class="section_content">
    <div class="container">
        <div class="single__content">
            <div class="single__content_row">
                <div class="card">
                    <?php get_template_part_var('cards/card-model', [
                        'post'   => $post,
                        'fields' => $fields,
                        'link'   => $getInTouchLink
                    ]); ?>
                </div>
                <?php if (!empty($content[0])) { ?>
                    <div class="text_block">
                        <?php echo $content[0]['text']; ?>
                        <?php echo link_html($getInTouchLink ?? '', 'card__btn btn_light'); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<?php get_template_part_var('single/socials-slider', [
    'fields' => $fields
]); ?>

<?php if (!empty($content[1])) { ?>
    <section class="section_content">
        <div class="container-sm">
            <div class="single__content">
                <?php if (!empty($content[1])) { ?>
                    <div class="text_block">
                        <?php echo $content[1]['text']; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>

<section class="section_content onlyfans_content">
    <div class="container-sm">
        <div class="single__content">
            <div class="single__content_row">
                <?php if (!empty($fields['only_fans_title']) || !empty($fields['only_fans_text'])) { ?>
                    <div class="text_block">
                        <?php if (!empty($fields['only_fans_title'])) { ?>
                            <h2>
                                <?php echo $fields['only_fans_title']; ?>
                            </h2>
                        <?php } ?>
                        <?php if (!empty($fields['only_fans_text'])) { ?>
                            <?php echo $fields['only_fans_text']; ?>
                        <?php } ?>
                    </div>
                <?php } ?>
                <?php if (!empty($fields['only_fans_img'])) { ?>
                    <div class="card">
                        <div class="card__img">
                            <?php if (!empty($fields['only_fans_tag'])) { ?>
                                <div class="card__img_tag">
                                    <?php echo $fields['only_fans_tag']; ?>
                                </div>
                            <?php } ?>
                            <?php echo wp_get_attachment_image($fields['only_fans_img'], 'medium'); ?>
                        </div>
                        <div class="card__body">
                            <?php echo link_html($fields['only_fans_btn'] ?? '', 'card__btn btn'); ?>
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

<?php if (!empty($content) && count($content) > 2) { ?>
    <?php foreach (array_slice($content, 2) as $contentItem) {
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