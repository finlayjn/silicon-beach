<?php
/*
Template Name: Front Page
*/

get_header();
?>

<section id="primary">
	<main id="main">

		<div
			class="hero min-h-[50vh]"
			style="background-image: url(<?php /*echo get_field('header_background_image');*/ ?>);">
			<div class="hero-overlay"></div>
			<div class="hero-content text-primary-content flex items-center justify-between w-full h-full"><!--items-end-->
				<div class="w-1/2 max-w-3xl text-left mx-5"> <!--mb-20-->
					<?php
					$hero_title = get_theme_mod( 'hero_title', 'Welcome to our site!' );
					?>
					<h2 class="mb-5 text-8xl font-bold uppercase leading-[0.85]"><?php echo esc_html( $hero_title ); ?></h2>
					<?php
					$hero_tagline = get_theme_mod(
						'hero_tagline',
						'Please consider subscribing to our newsletter for the latest updates.'
					);
					?>
					<p class="mb-5"><?php echo esc_html( $hero_tagline ); ?></p>
					<form class="flex gap-2 mt-6 text-primary-content">
						<input type="text" name="first_name" placeholder="First Name" class="hero-input" required />
						<input type="text" name="last_name" placeholder="Last Name" class="hero-input" required />
						<input type="email" name="email" placeholder="Email Address" class="hero-input" required />
						<div class="form-control w-1/4 flex items-end">
							<button type="submit" class="btn btn-accent w-full">Submit</button>
						</div>
					</form>
				</div>
				<div class="w-1/2 flex justify-end items-end mx-5">
					<img src="<?php /*echo get_field('logo');*/ ?>" alt="Logo" class="max-w-full h-auto max-h-80">
				</div>
			</div>
		</div>

		<section class="latest-updates">
			<div class="container mx-auto p-10 max-w-7xl">

				<?php
				$latest_posts = new WP_Query(array(
					'posts_per_page' => 4,
				));

				if ($latest_posts->have_posts()) :
					$counter = 0;
					while ($latest_posts->have_posts()) : $latest_posts->the_post();
						$counter++;
						if ($counter === 1) :
				?>
							<article class="latest-post flex flex-wrap lg:flex-nowrap items-top mb-10">
								<div class="w-full lg:w-1/2">
									<h2 class="text-5xl font-bold mb-4">Latest Updates</h2>
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
									<div class="w-full md:w-2/3 lg:w-1/2 lg:pl-6 mt-6 lg:-mt-20 mx-auto lg:mx-0">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail('large', array('class' => 'card shadow-lg')); ?>
										</a>
									</div>
								<?php endif; ?>
							</article>
						<?php else : ?>
							<?php if ($counter === 2) : ?>
								<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
								<?php endif; ?>
								<article class="card bg-base-200 overflow-hidden">
									<?php if (has_post_thumbnail()) : ?>
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail('medium', array('class' => 'w-full h-48 object-cover')); ?>
										</a>
									<?php endif; ?>
									<div class="card-body">
										<h2 class="card-title">
											<a href="<?php the_permalink(); ?>" class="text-primary hover:underline">
												<?php the_title(); ?>
											</a>
										</h2>
										<p>
											<?php
											if (has_post_thumbnail()) {
												echo wp_trim_words(get_the_excerpt(), 30, '...');
												echo ' <a class="text-nowrap" href="' . get_permalink() . '">Read More →</a>';
											} else {
												echo get_the_excerpt();
											}
											?>
										</p>
										<!-- <div class="card-actions justify-end">
											<a href="<?php the_permalink(); ?>" class="btn btn-primary">Read More</a>
										</div> -->
									</div>
								</article>
								<?php if ($counter === 4) : ?>
								</div>
							<?php endif; ?>
						<?php endif; ?>
					<?php
					endwhile;
					wp_reset_postdata();
				else :
					?>
					<p>No updates available at the moment.</p>
				<?php endif; ?>
			</div>
		</section>

		<!-- <section class="bg-black h-40 text-white">
			<p class="text-center text-9xl font-bold">white section</p>
		</section> -->

		<?php
		the_post();
		get_template_part('template-parts/content/content', 'page');
		?>

	</main><!-- #main -->
</section><!-- #primary -->

<?php get_footer(); ?>