<?php
if (empty($fields['gallery_title']) && empty($fields['gallery'])) {
    return;
}
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
                <?php
            } ?>
        </div>
    <?php } ?>
</section>
