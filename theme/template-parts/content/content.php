<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Silicon_Beach
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="flex flex-col items-center w-full">
		<div>

			<div class="flex flex-col md:flex-row items-center md:items-center gap-5">
				<div class="w-full md:w-2/5 text-center md:text-left flex items-center justify-center md:justify-start">
					<?php silicon_beach_post_thumbnail(); ?>
				</div>

				<div class=" w-full md:w-3/5">

					<header class="entry-header">
						<?php
						if (is_sticky() && is_home() && ! is_paged()) {
							printf('<span">%s</span>', esc_html_x('Featured', 'post', 'silicon-beach'));
						}
						if (is_singular()) :
							the_title('<h1 class="entry-title">', '</h1>');
						else :
							the_title(sprintf('<h2 class="entry-title text-2xl mb-2"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
						endif;
						?>
					</header><!-- .entry-header -->
					<div <?php silicon_beach_content_class('entry-content'); ?>>
						<?php
						the_excerpt();

						wp_link_pages(
							array(
								'before' => '<div>' . __('Pages:', 'silicon-beach'),
								'after'  => '</div>',
							)
						);
						?>
					</div><!-- .entry-content -->
				</div>

			</div>

			<footer class="entry-footer">
				<?php silicon_beach_entry_footer(); ?>
			</footer><!-- .entry-footer -->

			<div class="divider"></div>


		</div>





	</div>


</article><!-- #post-${ID} -->