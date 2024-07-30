<?php
$terms = get_terms([
    'taxonomy'   => ['category', 'post_tag'],
    'orderby'    => 'count',
    'order'      => 'desc',
    'hide_empty' => true
]);

if (empty($terms)) {
    echo sprintf('<div class="container"><h3>%s</h3></div>', __('There are no categories and hashtags', DOMAIN));
    return;
}
?>

<section class="tags">
    <div class="container">
        <?php if (!empty($fields['tags_title'])) { ?>
            <h2 class="title_main">
                <?php echo $fields['tags_title']; ?>
            </h2>
        <?php } ?>
        <div class="tags__list">
            <?php foreach ($terms as $term) { ?>
                <a href="<?php echo get_term_link($term, $term->taxonomy); ?>" class="tags__item">
                    <?php echo esc_html($term->name); ?>
                </a>
            <?php } ?>
        </div>
        <?php if (!empty($fields['bottom_adv_banner_type'])) { ?>
            <div class="banner">
                <?php if ($fields['bottom_adv_banner_type'] === 'html') {
                    echo !empty($fields['bottom_adv_banner_html']) ? $fields['bottom_adv_banner_html'] : '';
                } else if ($fields['bottom_adv_banner_type'] === 'img') {
                    echo get_banner(
                        !wp_is_mobile() ? ($fields['bottom_adv_banner_img'] ?? '') : ($fields['bottom_adv_banner_img_mob'] ?? ''),
                        $fields['bottom_adv_banner_url'] ?? ''
                    );
                } ?>
            </div>
        <?php } ?>
    </div>
</section>
