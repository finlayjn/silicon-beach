<?php
/**
 * Template part for displaying single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Silicon_Beach
 */

?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header mb-4">
		<?php the_title( '<h1 class="entry-title mb-2 text-5xl">', '</h1>' ); ?>

		<?php if ( ! is_page() ) : ?>
			<div class="entry-meta mb-4">
				<?php silicon_beach_entry_meta(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>

		<?php silicon_beach_post_thumbnail(); ?>
	</header><!-- .entry-header -->

	

	<div <?php silicon_beach_content_class( 'entry-content' ); ?>>
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers. */
					__( 'Continue reading<span class="sr-only"> "%s"</span>', 'silicon-beach' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);

		wp_link_pages(
			array(
				'before' => '<div>' . __( 'Pages:', 'silicon-beach' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

</article><!-- #post-${ID} -->
