<?php
get_header();
?>

<section class="search">
    <div class="search__label">
        <?php _e('Search result for', DOMAIN); ?>:
    </div>
    <h1 class="search__title">
        <?php echo htmlspecialchars($_GET['s']); ?>
    </h1>
    <div class="uk-grid archive-cards">
        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post(); ?>
                <div class="uk-width-2-4@m">
                    <?php get_template_part('template-parts/general/post', 'card', [
                        'post' => get_post(),
                    ]); ?>
                </div>
            <?php }
        } else { ?>
            <div class="posts-none">
                <?php _e('Sorry, no content matched your search criteria', 'lula'); ?>
            </div>
        <?php } ?>
    </div>
    <?php get_template_part('components/posts', 'pagination'); ?>
</section>

<?php
get_footer();

