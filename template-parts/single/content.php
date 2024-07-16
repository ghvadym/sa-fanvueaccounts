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

<section class="section_content">
    <div class="container">
        <div class="single__content">
            <?php if ($contentTitle) { ?>
                <h2 class="title_main">
                    <?php echo $contentTitle; ?>
                </h2>
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
        </div>
    </div>
</section>
