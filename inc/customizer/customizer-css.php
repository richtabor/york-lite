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

	$overlay_color      = get_theme_mod( 'overlay_color', '#000000' );
	$overlay_text_color = get_theme_mod( 'overlay_text_color', '#ffffff' );
	$site_logo_width    = get_theme_mod( 'custom_logo_max_width', '90' );
	$text_color         = get_theme_mod( 'text_color', '#000000' );
	$background_color   = get_theme_mod( 'background_color', '#ffffff' );

	$css =
	'
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

	body,
	body th,
	body input,
	body mark,
	body button,
	body select,
	body textarea,
	body .comment-meta,
	body comment-author,
	body .comment-meta a,
	body .comment-author a,
	body .comment-meta a:hover,
	body .comment-author a:hover,
	body .page-links a,
	body .pagination a,
	body .pagination span,
	body .main-navigation ul ul li a:hover,
	body .page-links a,
	body .main-navigation a,
	body .wp-caption-text,
	body.single .navigation a,
	body .entry-content a:hover,
	body  .entry-content a:focus {
		color:' . esc_attr( $text_color ) . ';
	}

	body .mobile-navigation--arrow:after {
		border-color:' . esc_attr( $text_color ) . ';
	}

	.hamburger-inner, .hamburger-inner::before, .hamburger-inner::after {
		background-color:' . esc_attr( $text_color ) . ';
	}

	.social-navigation svg {
		fill:' . esc_attr( $text_color ) . ';
	}
	';

	wp_add_inline_style( 'york-style', wp_strip_all_tags( $css ) );

}
add_action( 'wp_enqueue_scripts', 'york_customizer_css' );
