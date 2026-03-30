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

<section id="primary">

	<?php
	if (is_home() && !is_paged()) :
	?>
		<header>
			<div
				class="hero min-h-[50vh]"
				<?php
				$hero_bg = get_theme_mod('hero_background', '');
				if (is_numeric($hero_bg)) {
					$hero_bg = wp_get_attachment_url((int) $hero_bg);
				}
				?>
				style="background-image: url(<?php echo esc_url($hero_bg); ?>);">
				<!-- <div class="hero-overlay"></div> -->
				<div class="hero-content text-primary-content flex items-center justify-between w-full h-full"><!--items-end-->
					<div class="w-full lg:w-1/2 max-w-3xl text-left mx-3"> <!--mb-20-->
						<?php
						$hero_title = get_theme_mod('hero_title', 'Welcome to our site!');
						?>
						<h2 class="mb-5 text-3xl md:text-8xl font-bold uppercase w-full"><?php echo esc_html($hero_title); ?></h2>
						<?php
						$hero_tagline = get_theme_mod(
							'hero_tagline',
							'Please consider subscribing to our newsletter for the latest updates.'
						);
						?>
						<p class="mb-5"><?php echo esc_html($hero_tagline); ?></p>

						<?php get_sidebar("hero-widgets"); ?>

					</div>


					<div class="w-1/2 hidden justify-end items-end mx-5 lg:flex">
						<?php
						$logo = get_theme_mod('logo', '');
						if (is_numeric($logo)) {
							$logo = wp_get_attachment_url((int) $logo);
						}
						if ($logo) : ?>
							<img src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="max-w-full h-auto max-h-80">
						<?php endif; ?>
					</div>
				</div>
			</div>
			<?php
			// Add featured first post on page 1 only, and capture its ID for skipping in the main loop.
			if (is_home() && !is_paged() && have_posts()) {
				global $wp_query;

				$first_post = $wp_query->posts[0] ?? null;
				if ($first_post instanceof WP_Post) {
					$latest_post_id = $first_post->ID;

					// Prepare template tags for this post without advancing the main loop pointer.
					setup_postdata($first_post);
			?>
					<article class="latest-post flex flex-wrap lg:flex-nowrap items-top container max-w-7xl mx-auto p-3">
						<div class="w-full lg:w-1/2 mx-3">
							<h2 class="text-5xl font-bold mb-4 mt-2">Latest Updates</h2>
							<h3 class="text-3xl font-semibold mb-4">
								<a href="<?php the_permalink(); ?>" class="text-primary hover:underline">
									<?php the_title(); ?>
								</a>
							</h3>
							<p class="mb-4">
								<?php echo the_excerpt(); ?>
							</p>
						</div>
						<?php if (has_post_thumbnail()) : ?>
							<div class="w-full md:w-2/3 lg:w-1/2 lg:pl-6 mt-6 lg:-mt-12 mx-auto lg:mx-0">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail('large', array('class' => 'card shadow-lg')); ?>
								</a>
							</div>
						<?php endif; ?>
					</article>
			<?php
					// Reset global $post after setup_postdata without rewinding the main query pointer.
					wp_reset_postdata();
				}
			}
			?>
		</header>
	<?php
	endif;
	?>

	<div class="container mx-auto flex flex-wrap lg:flex-nowrap max-w-7xl p-3 gap-4">
		<main id="main" class="w-full lg:w-3/4 mx-3">


			<?php
			if (have_posts()) {

				if (is_paged()) {
					silicon_beach_the_posts_navigation();
				}

				if (is_home() && ! is_front_page()) :
			?>
					<header class="entry-header">
						<h1 class="entry-title"><?php single_post_title(); ?></h1>
					</header><!-- .entry-header -->
			<?php
				endif;

				$skip_latest_on_first_page = is_home() && ! is_paged() && isset($latest_post_id);

				// Load posts loop.
				while (have_posts()) {
					the_post();

					if ($skip_latest_on_first_page && get_the_ID() === $latest_post_id) {
						continue;
					}

					get_template_part('template-parts/content/content');
				}

				// Previous/next page navigation.
				silicon_beach_the_posts_navigation();
			} else {

				// If no content, include the "No posts found" template.
				get_template_part('template-parts/content/content', 'none');
			}
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
