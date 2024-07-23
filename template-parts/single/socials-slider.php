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
                <?php if ($i === $bannerPosition && $sliderBannerImage = get_banner_field('banner_2_img', $fields, $options ?? [])) { ?>
                    <div class="socials__slider_item item">
                        <?php echo get_banner(
                            $sliderBannerImage,
                            get_banner_field('banner_2_url', $fields, $options ?? [])
                        ); ?>
                    </div>
                <?php }

                $i++;
            } ?>
        </div>
    <?php } ?>
</section>

<?php if ($bannerImage = get_banner_field('banner_3_img', $fields, $options ?? [], true)) { ?>
    <div class="container">
        <?php echo get_banner(
            $bannerImage,
            get_banner_field('banner_3_url', $fields, $options ?? [])
        ); ?>
    </div>
<?php } ?>
