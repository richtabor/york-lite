<?php
/**
 * Enqueues front-end CSS for Customizer options.
 *
 * @package @@pkg.name
 * @version @@pkg.version
 * @author  @@pkg.author
 * @license @@pkg.license
 */

/**
 * Set the Custom CSS via Customizer options.
 */
function york_customizer_css() {

	$overlay_color 				= get_theme_mod( 'overlay_color', '#000000' );
	$overlay_text_color 			= get_theme_mod( 'overlay_text_color', '#ffffff' );
	$site_logo_width 			= get_theme_mod( 'custom_logo_max_width', '90' );

	$css =
	'
	body .project .overlay {
		background:' . esc_attr( $overlay_color ) . ';
	}

	body .project .overlay h3 {
		color:' . esc_attr( $overlay_text_color ) . ';
	}

	body .custom-logo-link img {
		width: ' . esc_attr( $site_logo_width ) . 'px;
	}
	';

	wp_add_inline_style( 'york-style', wp_strip_all_tags( $css ) );

}
add_action( 'wp_enqueue_scripts', 'york_customizer_css' );
