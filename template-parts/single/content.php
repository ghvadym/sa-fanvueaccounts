<?php
if (empty($content)) {
    return;
}

$contentImgId = $content['img'] ?? '';
$contentTitle = $content['title'] ?? '';
$contentText = $content['text'] ?? '';

if ($contentImgId) {
    $contentImg = wp_get_attachment_image($contentImgId, 'full');
}
?>

<section class="section_content section_content__main">
    <div class="container-sm">
        <div class="single__content">
            <?php if ($contentTitle) { ?>
                <h2 class="title_main">
                    <?php echo $contentTitle; ?>
                </h2>
            <?php } ?>
            <?php if (!empty($content['adv_banner']) && $content['adv_banner']['position'] === 'top') { ?>
                <div class="single__content__banner">
                    <?php banner_field($content['adv_banner'], 'banner_full_width'); ?>
                </div>
            <?php } ?>
            <?php if (!empty($contentImg)) { ?>
                <div class="single__content_img">
                    <?php echo $contentImg; ?>
                </div>
            <?php } ?>
            <?php if ($contentText) { ?>
                <div class="text_block">
                    <?php echo $contentText; ?>
                </div>
            <?php } ?>
            <?php if (!empty($content['adv_btn'])) { ?>
                <div class="single__content__btn">
                    <?php echo link_html($content['adv_btn'], 'card__btn btn_hot'); ?>
                </div>
            <?php } ?>
            <?php if (!empty($content['adv_banner']) && $content['adv_banner']['position'] === 'bottom') { ?>
                <div class="single__content__banner">
                    <?php banner_field($content['adv_banner'], 'banner_full_width'); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
