<?php
/**
 * Jetpack Compatibility
 *
 * @package @@pkg.name
 * @author  @@pkg.author
 * @license @@pkg.license
 */

if ( ! function_exists( 'york_jetpack_setup' ) ) :
	/**
	 * JetPack compatibilites.
	 */
	function york_jetpack_setup() {
		/**
		 * Add theme support for Infinite Scroll.
		 *
		 * See: http://jetpack.me/support/infinite-scroll/
		 */
		add_theme_support(
			'infinite-scroll', array(
				'container' => 'hfeed',
				'render'    => 'york_scroll_render',
				'footer'    => 'page',
				'wrapper'   => false,
			)
		);

		// Add theme support for Responsive Videos.
		add_theme_support( 'jetpack-responsive-videos' );
	}

	add_action( 'after_setup_theme', 'york_jetpack_setup' );

endif;

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
			get_template_part( 'components/post/content', get_post_format() );

		}
	}
endif;
