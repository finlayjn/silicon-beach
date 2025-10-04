<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no `home.php` file exists.
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
		if ( have_posts() ) {

			if ( is_paged() ) {
				silicon_beach_the_posts_navigation();
			}

			if ( is_home() && ! is_front_page() ) :
				?>
				<header class="entry-header">
					<h1 class="entry-title"><?php single_post_title(); ?></h1>
				</header><!-- .entry-header -->
				<?php
			endif;

			// Load posts loop.
			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/content/content' );
			}

			// Previous/next page navigation.
			silicon_beach_the_posts_navigation();

		} else {

			// If no content, include the "No posts found" template.
			get_template_part( 'template-parts/content/content', 'none' );

		}
		?>
	</main><!-- #main -->

	<aside id="sidebar" class="w-full lg:w-1/4 sticky top-25 max-h-screen overflow-y-none">
		<?php get_sidebar("sidebar-2"); ?>
	</aside><!-- #sidebar -->
</section><!-- #primary -->

<?php
get_footer();