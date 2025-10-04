<?php
/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Silicon_Beach
 */

?>

<header id="masthead" class="sticky top-0 z-50">
	<div class="bg-primary">
		<div class="navbar max-w-7xl mx-auto">
			<div class="navbar-start flex flex-col items-start mx-5">
				<?php if (is_front_page()) : ?>

					<h1 class="text-2xl font-bold text-wrap md:text-nowrap md:text-4xl">
						<?php bloginfo('name'); ?>
					</h1>

				<?php else : ?>
					<p class="text-2xl font-bold text-wrap md:text-nowrap md:text-4xl underline-animate">
						<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
							<?php bloginfo('name'); ?>
						</a>
					</p>
				<?php endif; ?>

				<?php
				$silicon_beach_description = get_bloginfo('description', 'display');
				if ($silicon_beach_description || is_customize_preview()) :
				?>
					<p class="text-base"><?php echo $silicon_beach_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
											?></p>
				<?php endif; ?>
			</div>

			<div class="navbar-end mx-5">
				<!-- Mobile Dropdown -->
				<div class="dropdown dropdown-end dropdown-hover lg:hidden">
					<button tabindex="0" class="btn btn-ghost p-2" aria-controls="primary-menu-mobile" aria-expanded="false">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
							<path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7" />
						</svg>
						<span class="sr-only"><?php esc_html_e('Menu', 'silicon-beach'); ?></span>
					</button>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu-mobile',
							'container'      => false,
							'menu_class'     => 'menu menu-xl dropdown-content w-72 p-2 shadow bg-base-100 rounded-box text-primary',
							'items_wrap'     => '<ul id="%1$s" class="%2$s" aria-label="submenu">%3$s</ul>',
						)
					);
					?>
				</div>
				<!-- Desktop Horizontal Menu -->
				<nav id="site-navigation" class="hidden lg:block" aria-label="<?php esc_attr_e('Main Navigation', 'silicon-beach'); ?>">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
							'container'      => false,
							'menu_class'     => 'menu menu-xl menu-horizontal gap-0 xl:gap-2 font-bold navbar-menu',
							'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>'
						)
					);
					?>
				</nav>
			</div>
		</div>
	</div>
	<div class="w-full bg-accent h-3"></div>
</header>