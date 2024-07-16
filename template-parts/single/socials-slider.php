<?php
if (empty($fields['slider'])) {
    return;
}
?>

<section class="single_slider">
    <div class="container">
        <?php if (!empty($fields['slider_title'])) { ?>
            <h2 class="title_main">
                <?php echo $fields['slider_title']; ?>
            </h2>
        <?php } ?>
    </div>
    <div class="socials__slider">
        <div class="swiper-wrapper">
            <?php foreach ($fields['slider'] as $slideImgId) {
                $slideImg = wp_get_attachment_image($slideImgId, 'full');
                if (!$slideImg) {
                    continue;
                }
                ?>
                <div class="socials__slider_item swiper-slide">
                    <?php echo $slideImg; ?>
                </div>
                <?php
            } ?>
        </div>
    </div>
    <div class="container">
        <div class="swiper__nav">
            <div class="swiper__nav_item single__button_prev">
                <?php get_svg('arrow-left'); ?>
            </div>
            <div class="swiper__nav_item single__button_next">
                <?php get_svg('arrow-right'); ?>
            </div>
        </div>
    </div>
</section>
