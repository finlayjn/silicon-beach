<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
			get_template_part('template-parts/content/content', 'single');


			echo '<div class="mt-5">';
			if (is_singular('post')) {
				the_post_navigation(
					array(
						'class'     => 'post-navigation',
						'prev_text' => '
				<span class="btn btn-ghost btn-sm md:btn-md normal-case flex items-center gap-2">
					<span aria-hidden="true">←</span>
					<span class="text-left">
						<span class="block text-xs md:text-sm opacity-70">Previous Post</span>
						<span class="block font-semibold">%title</span>
					</span>
				</span>
			',
						'next_text' => '
				<span class="btn btn-ghost btn-sm md:btn-md normal-case flex items-center gap-2">
					<span class="text-right">
						<span class="block text-xs md:text-sm opacity-70">Next Post</span>
						<span class="block font-semibold">%title</span>
					</span>
					<span aria-hidden="true">→</span>
				</span>
			',
					)
				);
			}
			echo "</div>";

			// If comments are open, or we have at least one comment, load
			// the comment template.
			if (comments_open() || get_comments_number()) {
				comments_template();
			}

		// End the loop.
		endwhile;
		?>

	</main><!-- #main -->

	<aside id="sidebar" class="w-full lg:w-1/4 mt-5 mb-5">
		<div class="card p-0 bg-base-200">
			<div class="card-body">
				<?php get_sidebar("sidebar-2"); ?>
			</div>
		</div>
	</aside><!-- #sidebar -->
</section><!-- #primary -->


<?php
get_footer();
