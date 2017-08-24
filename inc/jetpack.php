<?php
/**
 * Jetpack Compatibility
 *
 * @package @@pkg.name
 * @version @@pkg.version
 * @author  @@pkg.author
 * @license @@pkg.license
 */

if ( ! function_exists( 'york_jetpack_setup' ) ) :
	/**
	 * JetPack compatibilites.
	 */
	function york_jetpack_setup() {
		/**
		 * Let JetPack manage the site logo.
		 * By adding theme support, we declare that this theme does use the default
		 * JetPack Site Logo functionality, if the module is activated.
		 *
		 * See: http://jetpack.me/support/site-logo/
		 */
		add_image_size( 'york-logo', 9999, 9999 );

		add_theme_support( 'site-logo', array( 'size' => 'york-logo' ) );

		/**
		 * Add theme support for Infinite Scroll.
		 *
		 * See: http://jetpack.me/support/infinite-scroll/
		 */
		add_theme_support( 'infinite-scroll', array(
			'container' => 'hfeed',
			'render'    => 'york_scroll_render',
			'footer'    => 'page',
			'wrapper'    => false,
		) );
	}

	add_action( 'after_setup_theme', 'york_jetpack_setup' );

endif;

/**
 * Halves the size of the JetPack site logo to make it retina ready.
 *
 * @param string $html The rendered site-logo html.
 * @param array  $logo The logo-Jetpack object.
 * @param string $size The size of the logo.
 * @see	jetpack_the_site_logo filter in Jetpack.
 */
function york_retina_jetpack_site_logo( $html, $logo, $size ) {

	// Checker, comes from jetpack_the_site_logo.
	if ( ! jetpack_has_site_logo() ) {
		return $html;
	}

	/**
	 * Proceed if the retina_logo Customizer option is selected.
	 */
	if ( true === get_theme_mod( 'retina_logo', true ) ) :

		// Get the image size.
		$image_attachment = wp_get_attachment_image_src( $logo['id'], $size );

		// Half the image size since we want a retina ready image.
		$html = preg_replace( '/width="(\d+)"/i', 'width="' . ( round( $image_attachment[1] / 2 ) ) . '"', $html );
		$html = preg_replace( '/height="(\d+)"/i', 'height="' . ( round( $image_attachment[2] / 2 ) ) . '"', $html );

	endif;

	return $html;
}
add_filter( 'jetpack_the_site_logo', 'york_retina_jetpack_site_logo', 10, 3 );

if ( ! function_exists( 'york_scroll_render' ) ) :
	/**
	 * Define the code that is used to render the posts added by Infinite Scroll.
	 * Create your own york_scroll_render() to override in a child theme.
	 */
	function york_scroll_render() {

		while ( have_posts() ) {
			the_post();

			/*
			 * Include the Post-Format-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */
			get_template_part( 'components/content', get_post_format() );

		}
	}
endif;
