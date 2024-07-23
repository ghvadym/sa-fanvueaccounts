<?php

get_header();
$post = get_post();
$fields = get_fields($post->ID);
$options = get_fields('options');
?>

<section class="single_hero">
    <div class="container">
        <h1 class="single__title">
            <?php echo $post->post_title; ?>
        </h1>
        <?php echo get_banner(
            get_banner_field('banner_1_img', $fields, $options, true),
            get_banner_field('banner_1_url', $fields, $options)
        ); ?>
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
                        <?php echo $fields['main_info_text'];

                        if (!empty($fields['main_info_link'])) {
                            echo link_html($fields['main_info_link'] ?? [], 'card__btn btn_light');
                        } ?>
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
                    <?php if ($galleryTextBanner = get_banner_field('banner_4_img', $fields, $options)) { ?>
                        <div class="single__banner">
                            <?php echo get_banner(
                                $galleryTextBanner,
                                get_banner_field('banner_4_url', $fields, $options)
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
                    <?php if ($onlyFansBanner = get_banner_field('banner_5_img', $fields, $options)) { ?>
                        <div class="single__banner">
                            <?php echo get_banner(
                                $onlyFansBanner,
                                get_banner_field('banner_5_url', $fields, $options)
                            ); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>

<?php if (!empty($fields['content'])) { $showBanner = true; ?>
    <?php foreach ($fields['content'] as $contentItem) {
        get_template_part_var('single/content', [
            'content'     => $contentItem,
            'fields'      => $fields,
            'options'     => $options,
            'show_banner' => $showBanner
        ]);

        $showBanner = false;
    } ?>
<?php } ?>

<?php

get_template_part_var('global/faq', [
    'faq_list' => get_field('faq', $post->ID)
]);

get_footer();