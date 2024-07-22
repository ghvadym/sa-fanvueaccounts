<?php
if (empty($fields['gallery_title']) && empty($fields['gallery'])) {
    return;
}

$bannerPosition = 3;
$i = 1;
?>

<section class="single_slider">
    <div class="container">
        <?php if (!empty($fields['gallery_title'])) { ?>
            <h2 class="title_main">
                <?php echo $fields['gallery_title']; ?>
            </h2>
        <?php } ?>
    </div>
    <?php if (!empty($fields['gallery'])) { ?>
        <div class="socials__slider owl-carousel">
            <?php foreach ($fields['gallery'] as $slideImgId) {
                $slideImg = wp_get_attachment_image($slideImgId, 'full');
                if (!$slideImg) {
                    continue;
                }
                ?>
                <div class="socials__slider_item item">
                    <?php echo $slideImg; ?>
                </div>
                <?php if ($i === $bannerPosition) { ?>
                    <div class="socials__slider_item item">
                        <?php get_banner($fields['gallery_banner_img'] ?? 0, $fields['gallery_banner_url'] ?? ''); ?>
                    </div>
                <?php }

                $i++;
            } ?>
        </div>
    <?php } ?>
</section>

<?php if (!empty($fields['gallery_slider_bottom_banner_img'])) { ?>
    <div class="container">
        <?php get_banner(
            !wp_is_mobile() ? ($fields['gallery_slider_bottom_banner_img'] ?? '') : ($fields['gallery_slider_bottom_banner_img_mob'] ?? ''),
            $fields['gallery_slider_bottom_banner_url'] ?? ''
        ); ?>
    </div>
<?php } ?>
