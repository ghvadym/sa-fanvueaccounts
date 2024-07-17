<?php
/*
* Template name: About Us
*/

get_header();
$post = get_post();
$fields = get_fields($post->ID);
?>

<section class="about_hero">
    <div class="container-sm">
        <h1 class="title">
            <?php echo $fields['hero_title'] ?: __('About Us', DOMAIN) ?>
        </h1>
        <?php if (!empty($fields['hero_subtitle'])) { ?>
            <div class="subtitle">
                <?php echo esc_html($fields['hero_subtitle']); ?>
            </div>
        <?php } ?>
        <?php if (has_post_thumbnail($post)) { ?>
            <div class="about_hero__img">
                <?php the_post_thumbnail('full') ?>
            </div>
        <?php } ?>
        <?php if (!empty($fields['hero_btn'])) { ?>
            <div class="about_hero__btn">
                <a href="<?php echo esc_url($fields['hero_btn']['url'] ?? '') ?>"
                   target="<?php echo esc_url($fields['hero_btn']['target'] ?? '_self') ?>"
                   class="card__btn btn">
                    <?php echo $fields['hero_btn']['title']; ?>
                </a>
            </div>
        <?php } ?>
    </div>
</section>

<?php if (!empty($fields['offers'])) { ?>
    <section class="offers">
        <div class="container">
            <?php if (!empty($fields['offers_title'])) { ?>
                <h2 class="title">
                    <?php echo $fields['offers_title']; ?>
                </h2>
            <?php } ?>
            <?php if (!empty($fields['offers_text'])) { ?>
                <div class="subtitle">
                    <?php echo $fields['offers_text']; ?>
                </div>
            <?php } ?>
        </div>
        <div class="offers__slider">
            <div class="swiper-wrapper">
                <?php foreach ($fields['offers'] as $offer) {
                    $offerTitle = $offer['title'] ?? '';
                    $offerText = $offer['text'] ?? '';

                    if (!$offerTitle && !$offerText) {
                        continue;
                    }
                    ?>
                    <div class="offers__slider_item swiper-slide">
                        <div class="offer__item">
                            <?php if ($offerTitle) { ?>
                                <div class="offer__title">
                                    <?php echo esc_html($offerTitle); ?>
                                </div>
                            <?php } ?>
                            <?php if ($offerText) { ?>
                                <div class="offer__text">
                                    <?php echo esc_html($offerText); ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="container">
            <div class="swiper__nav">
                <div class="swiper__nav_item offers__button_prev">
                    <?php get_svg('arrow-left'); ?>
                </div>
                <div class="swiper__nav_item offers__button_next">
                    <?php get_svg('arrow-right'); ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>

<section class="about_cta">
    <div class="container-sm">
        <?php if (!empty($fields['cta_title'])) { ?>
            <h2 class="title_main">
                <?php echo $fields['cta_title']; ?>
            </h2>
        <?php } ?>
        <?php if (!empty($fields['cta_items'])) { ?>
            <div class="about_cta__items">
                <?php foreach ($fields['cta_items'] as $ctaItem) {
                    $ctaText = $ctaItem['text'] ?? '';

                    if (!$ctaText) {
                        continue;
                    }
                    ?>
                    <div class="about_cta__item">
                        <?php echo $ctaText; ?>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
        <?php get_template_part_var('global/socials'); ?>
    </div>
</section>

<?php
get_footer();