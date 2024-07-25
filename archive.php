<?php
get_header();
$term = get_queried_object();
$count = $GLOBALS['wp_query']->found_posts;
$queriedObject = get_queried_object();
?>

    <section class="archive">
        <div class="container">
            <h1 class="archive__title title_main">
                <?php echo $term->name; ?>
            </h1>
            <?php get_template_part_var('global/search'); ?>
            <div class="archive__posts">
                <?php if (have_posts()) { ?>
                    <div class="articles">
                        <?php while (have_posts()) { the_post();
                            get_template_part_var('cards/card-post', [
                                'post' => get_post(),
                            ]);
                        } ?>
                    </div>
                    <?php if ($count > POSTS_PER_PAGE) { ?>
                        <div class="articles__btn">
                            <span id="articles_load" class="btn" data-page="1" data-cat="<?php echo $queriedObject->term_id; ?>">
                                <?php _e('Load more', DOMAIN); ?>
                            </span>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <h3 class="posts-none">
                        <?php _e('Sorry, no content matched your search criteria', DOMAIN); ?>
                    </h3>
                <?php } ?>
            </div>
        </div>
    </section>

<?php
get_footer();

