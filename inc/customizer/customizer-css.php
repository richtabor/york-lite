<?php
/**
 * Enqueues front-end CSS for Customizer options.
 *
 * @package @@pkg.name
 * @author  @@pkg.author
 * @license @@pkg.license
 */

/**
 * Set the Custom CSS via Customizer options.
 */
function york_customizer_css() {

	$overlay_color      = get_theme_mod( 'overlay_color', '#232323' );
	$overlay_text_color = get_theme_mod( 'overlay_text_color', '#ffffff' );
	$site_logo_width    = get_theme_mod( 'custom_logo_max_width', '90' );
	$text_color         = get_theme_mod( 'text_color', '#232323' );
	$heading_color      = get_theme_mod( 'heading_color', '#232323' );
	$background_color   = get_theme_mod( 'background_color', '#ffffff' );

	$css =
	'
	body {
		color:' . esc_attr( $text_color ) . ';
	}

	h1,
	h2,
	h3,
	h4,
	h5,
	h6,
	.main-navigation a,
	.mobile-navigation--arrow {
		color:' . esc_attr( $heading_color ) . ';
	}

	body .sidebar {
		background-color: #' . esc_attr( $background_color ) . ';
	}

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
