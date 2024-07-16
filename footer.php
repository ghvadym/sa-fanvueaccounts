<?php
wp_footer();

if (is_category()) {
    get_template_part_var('global/faq', [
        'faq_list' => get_field('faq', 'options')
    ]);
}

$socials = get_field('socials', 'options');
?>

</main>

<footer id="footer" class="footer">
    <div class="container">
        <div class="footer__body">
            <div class="footer__row">
                <div class="footer__col">
                    <div class="footer__content">
                        <div class="footer__logo logo">
                            <?php logo(); ?>
                        </div>
                        <?php if ($footer_text = get_field('footer_text', 'options')) { ?>
                            <div class="footer__text">
                                <?php echo $footer_text; ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <?php get_widgets([
                    'Footer nav 1',
                    'Footer nav 2',
                ]); ?>
                <?php if (!empty($socials)) { ?>
                    <div class="footer__col footer__socials">
                        <div class="socials__title">
                            <?php _e('Follow us', DOMAIN); ?>
                        </div>
                        <div class="socials">
                            <?php foreach ($socials as $social) {
                                $image_url = $social['img'] ?? '';
                                $link = $social['link'] ?? '';

                                if (!$image_url || !$link) {
                                    continue;
                                }
                                ?>
                                <div class="social__item">
                                    <a href="<?php echo esc_url($link); ?>" target="_blank" rel="noopener nofollow">
                                        <img src="<?php echo esc_url($image_url); ?>" alt="Social">
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="footer__row">
                <?php get_widgets([
                    'Footer nav 3',
                    'Footer nav 4',
                    'Footer nav 5',
                ]); ?>
                <?php if (!empty($socials)) { ?>
                    <div class="footer__col footer__socials">
                        <div class="socials">
                            <?php foreach ($socials as $social) {
                                $image_url = $social['img'] ?? '';
                                $link = $social['link'] ?? '';

                                if (!$image_url || !$link) {
                                    continue;
                                }
                                ?>
                                <div class="social__item">
                                    <a href="<?php echo esc_url($link); ?>" target="_blank" rel="noopener nofollow">
                                        <img src="<?php echo esc_url($image_url); ?>" alt="Social">
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</footer>

</body>
</html>
