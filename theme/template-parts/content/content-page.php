<?php

/**
 * Template part for displaying pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Silicon_Beach
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<header class="relative w-full mx-auto mb-6 h-[300px]">
    <?php
    $thumb_id = get_post_thumbnail_id();
    $thumb_url = $thumb_id ? wp_get_attachment_image_url($thumb_id, 'full') : '';
    ?>
    <div class="absolute inset-0 w-full h-full">
        <?php if ($thumb_url): ?>
            <img src="<?php echo esc_url($thumb_url); ?>" alt="" class="object-cover w-full h-[300px]">
        <?php endif; ?>
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
    </div>
    <div class="absolute bottom-0 left-0 w-full flex justify-center">
        <div class="max-w-7xl w-full px-7">
            <?php
            if (! is_front_page()) {
                the_title('<h1 class="entry-title text-white text-4xl">', '</h1>');
            } else {
                the_title('<h2 class="entry-title text-white text-4xl">', '</h2>');
            }
            ?>
        </div>
    </div>
</header>


	<section class="container mx-auto flex flex-wrap lg:flex-nowrap max-w-7xl px-7 gap-4">
		<div class="w-full lg:w-3/4">
		<div <?php silicon_beach_content_class('entry-content'); ?>>
			<?php
			the_content();

			wp_link_pages(
				array(
					'before' => '<div>' . __('Pages:', 'silicon-beach'),
					'after'  => '</div>',
				)
			);
			?>
		</div><!-- .entry-content -->
		</div><!-- #main -->
		<aside id="sidebar" class="w-full lg:w-1/4 mb-5">
			<div class="card p-0 bg-base-200">
				<div class="card-body">
					<?php get_sidebar("sidebar-2"); ?>
				</div>
			</div>
		</aside><!-- #sidebar -->
	</section>



</article><!-- #post-<?php the_ID(); ?> -->