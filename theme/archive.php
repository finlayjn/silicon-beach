<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Silicon_Beach
 */

get_header();
?>

<section id="primary">
	<div class="container mx-auto flex flex-wrap lg:flex-nowrap max-w-7xl p-3 gap-4 my-5">
		<main id="main" class="w-full lg:w-3/4 mx-3">

			<?php if (have_posts()) : ?>

				
				<header class="page-header">
					<?php the_archive_title('<h1 class="page-title">', '</h1>'); ?>
				</header><!-- .page-header -->

			<?php
				// Start the Loop.
				while (have_posts()) :
					the_post();
					get_template_part('template-parts/content/content');

				// End the loop.
				endwhile;

				// Previous/next page navigation.
				silicon_beach_the_posts_navigation();

			else :

				// If no content, include the "No posts found" template.
				get_template_part('template-parts/content/content', 'none');

			endif;
			?>
		</main><!-- #main -->

		<aside id="sidebar" class="w-full lg:w-1/4">
			<div class="card p-0 bg-base-200">
				<div class="card-body">
					<?php get_sidebar("sidebar-2"); ?>
				</div>
			</div>
		</aside><!-- #sidebar -->
	</div>
</section><!-- #primary -->

<?php
get_footer();
