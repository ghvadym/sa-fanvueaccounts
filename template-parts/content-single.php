<?php

/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Petite Stories
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('posts-entry fbox'); ?>>
	<header class="entry-header">
		<?php
		if ('post' === get_post_type()) : ?>
			<div class="entry-meta">
				<?php petite_stories_posted_on(); ?>
			</div>
		<?php
			if (is_singular()) :
				the_title('<h1 class="entry-title">', '</h1>');
			else :
				the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
			endif;
		endif; ?>
        <?php post_meta_data(get_the_ID()); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages(array(
			'before' => '<div class="page-links">' . esc_html__('Pages:', 'petite-stories'),
			'after'  => '</div>',
		));

		if (is_single()) : ?>
			<?php if (get_theme_mod('show_posts_categories_tags') == '') : ?>
				<div class="category-and-tags">
					<?php the_category(' '); ?>
					<?php if (has_tag()) : ?>
						<?php the_tags('', ''); ?>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		<?php endif; ?>


	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->