<?php

/**
 * Template part for displaying the footer content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Silicon_Beach
 */

?>

<footer id="colophon" class="footer footer-horizontal footer-center bg-primary text-primary-content p-10">
	<aside>
		<?php
		$customizer_logo = get_theme_mod('logo');
		$logo_url = '';

		if ( $customizer_logo ) {
			if ( is_numeric( $customizer_logo ) ) {
				$logo_url = wp_get_attachment_image_url( intval( $customizer_logo ), 'full' );
			} else {
				$logo_url = $customizer_logo;
			}
		}

		if ( $logo_url ) : ?>
			<img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="mb-5 inline-block fill-current w-120 max-w-1/2" />
		<?php endif; ?>
		<p class="font-bold">
			<?php
			$silicon_beach_blog_name = get_bloginfo('name');
			if (! empty($silicon_beach_blog_name)) :
			?>
				<a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
			<?php endif; ?>
			<br />
			<?php
			$silicon_beach_blog_info = get_bloginfo('description');
			if (! empty($silicon_beach_blog_info)) :
			?>
				<?php bloginfo('description'); ?>
			<?php endif; ?>
		</p>
		<p>© <?php echo date('Y');
				echo ' ' . $silicon_beach_blog_name; ?> - All rights reserved</p>
	</aside>

</footer><!-- #colophon -->