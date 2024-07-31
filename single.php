<?php

get_header();
$post = get_post();
$fields = get_fields($post->ID);
$options = get_fields('options');

$advBannersGallery = $fields['adv_banners_gallery'] ?? [];

if (empty($advBannersGallery)) {
    $advBannersGallery = $options['adv_banners_gallery'] ?? [];
}
?>

<section class="single_hero">
    <div class="container">
        <h1 class="single__title">
            <?php echo $post->post_title; ?>
        </h1>
        <?php adv_banner_group($fields['adv_banner_1'] ?? [], $options['adv_banner_1'] ?? [], 'banner_full_width'); ?>
    </div>
</section>

<section class="section_content">
    <div class="container">
        <div class="single__content">
            <div class="single__content_row">
                <div class="card">
                    <?php get_template_part_var('cards/card-model', [
                        'post'    => $post,
                        'fields'  => $fields,
                        'options' => $options
                    ]); ?>
                </div>
                <?php if (!empty($fields['main_info_text'])) { ?>
                    <div class="text_block">
                        <?php echo $fields['main_info_text']; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<?php get_template_part_var('single/socials-slider', [
    'fields'  => $fields,
    'options' => $options
]); ?>

<?php if (!empty($fields['gallery_text'])) { ?>
    <section class="section_content gallery_text_content">
        <div class="container">
            <div class="single__content">
                <div class="single__content_row">
                    <div class="single__banner">
                        <?php adv_banner_group($fields['adv_banner_4'] ?? [], $options['adv_banner_4'] ?? []); ?>
                    </div>
                    <div class="text_block">
                        <?php echo $fields['gallery_text']; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>

<?php if (!empty($fields['onlyfans_text'])) { ?>
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
                            <?php echo $fields['onlyfans_text']; ?>
                        </div>
                    <?php } ?>
                    <?php if (!empty($fields['adv_banner_5'])) { ?>
                        <div class="single__banner">
                            <?php adv_banner_group($fields['adv_banner_5'] ?? [], $options['adv_banner_5'] ?? []); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>

<?php if (!empty($fields['content'])) {?>
    <?php foreach ($fields['content'] as $contentItem) {
        get_template_part_var('single/content', [
            'content'     => $contentItem,
            'fields'      => $fields,
            'options'     => $options,
        ]);
    } ?>
<?php } ?>

<?php if (!empty($advBannersGallery)) { ?>
    <section class="adv_banners_gallery">
        <div class="container">
            <div class="banners_gallery__list">
                <?php if (!wp_is_mobile()) { ?>
                    <?php foreach ($advBannersGallery as $bannerGalleryItem) { ?>
                        <div class="banners_gallery__item">
                            <?php banner_field($bannerGalleryItem); ?>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="banners_gallery__item">
                        <?php banner_field(end($fields['adv_banners_gallery'])); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>

<?php

get_template_part_var('global/faq', [
    'faq_list' => get_field('faq', $post->ID)
]);

get_footer();