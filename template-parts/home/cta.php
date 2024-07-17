<?php
if (empty($fields)) {
    return;
}

$imgUrl = !empty($fields['cta_img']) ? wp_get_attachment_image_url($fields['cta_img'], 'full') : '';
?>

<section class="hero_section">
    <div class="container">
        <div class="cta__row cta__row_reverse">
            <div class="cta__content">
                <?php if (!empty($fields['cta_title'])) { ?>
                    <h1 class="cta__title">
                        <?php echo $fields['cta_title']; ?>
                    </h1>
                <?php } ?>
                <?php if (!empty($fields['cta_text'])) { ?>
                    <div class="cta__subtitle">
                        <?php echo $fields['cta_text']; ?>
                    </div>
                <?php } ?>
                <?php echo link_html($fields['cta_link'] ?? '', 'cta__btn btn'); ?>
            </div>
            <?php if ($imgUrl) { ?>
                <div class="cta__img">
                    <img src="<?php echo esc_url($imgUrl); ?>" alt="Hero Image">
                </div>
            <?php } ?>
        </div>
    </div>
</section>