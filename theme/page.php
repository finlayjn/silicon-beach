<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default. Please note that
 * this is the WordPress construct of pages: specifically, posts with a post
 * type of `page`.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Silicon_Beach
 */

get_header();
?>

<section id="primary" class="container mx-auto flex flex-wrap lg:flex-nowrap max-w-7xl p-3 gap-4">
	<main id="main" class="w-full lg:w-3/4 p-4">

		<?php
		/* Start the Loop */
		while (have_posts()) :
			the_post();

			get_template_part('template-parts/content/content', 'page');

			// If comments are open, or we have at least one comment, load
			// the comment template.
			if (comments_open() || get_comments_number()) {
				comments_template();
			}

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

	<aside id="sidebar" class="w-full lg:w-1/4 sticky top-25 max-h-screen overflow-y-none">
		<?php get_sidebar("sidebar-2"); ?>
	</aside><!-- #sidebar -->
</section><!-- #primary -->

<?php
get_footer();
