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
                <?php if ($i === $bannerPosition && !empty($fields['adv_banner_2'])) { ?>
                    <div class="socials__slider_item item">
                        <?php adv_banner_group($fields['adv_banner_2'] ?? [], $options['adv_banner_2'] ?? []); ?>
                    </div>
                <?php }

                $i++;
            } ?>
        </div>
    <?php } ?>
</section>

<?php if (!empty($fields['adv_banner_3'])) { ?>
    <div class="container">
        <?php adv_banner_group($fields['adv_banner_3'] ?? [], $options['adv_banner_3'] ?? [], 'banner_full_width'); ?>
    </div>
<?php } ?>
