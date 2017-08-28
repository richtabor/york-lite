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

	$accent_color 				= get_theme_mod( 'accent_color', '#ff5c5c' );
	$overlay_color 				= get_theme_mod( 'overlay_color', '#000000' );
	$overlay_text_color 			= get_theme_mod( 'overlay_text_color', '#ffffff' );
	$site_logo_width 			= get_theme_mod( 'custom_logo_max_width', '90' );

	$css =
	'
	body .project .overlay {
		background:'. esc_attr( $overlay_color ) .';
	}

	body .project .overlay h3 {
		color:'. esc_attr( $overlay_text_color ) .';
	}

	body .lightbox-play svg {
		fill:'. esc_attr( $overlay_text_color ) .';
	}
	
	body .custom-logo-link img {
		width: '. esc_attr( $site_logo_width ) .'px;
	}

	body #content a:hover,
	body #content a:focus {
		color:'. esc_attr( $accent_color ) .'!important;
		border-color:'. esc_attr( $accent_color ) .'!important;
	}

	body button,
	body .button,
	body input[type="button"],
	body input[type="reset"],
	body input[type="submit"] {
		background-color:'. esc_attr( $accent_color ) .';
	}

	body.single-portfolio .navigation a:hover {
		color:'. esc_attr( $accent_color ) .' !important;
		border-color:'. esc_attr( $accent_color ) .' !important;
	}

	body #content a:hover,
	body .main-navigation a:hover {
		color: '. esc_attr( $accent_color ) .'; 
	}

	a:hover,
	a:focus,
	body .site-footer a:hover, 
	body .header .main-navigation a:hover,
	.current-menu-item a, 
	.page-links a span:not(.page-links-title):hover,
	.page-links span:not(.page-links-title) { color:'. esc_attr( $accent_color ) .'; }

	.cats,
	h1 a:hover, 
	.logo a h1:hover,
	.tagcloud a:hover,
	.entry-meta a:hover,
	.header-alt a:hover,
	.post-after a:hover,
	.archives-list ul li a:hover { 
		color:'. esc_attr( $accent_color ) .' !important; 
	}

	body .type-post .post-content blockquote::before {
		color:'. esc_attr( $accent_color ) .';
	}

	body button:hover,
	body button:focus,
	body .button:hover,
	body .button:focus,
	body input[type="button"]:hover,
	body input[type="button"]:focus,
	body input[type="reset"]:hover,
	body input[type="reset"]:focus,
	body input[type="submit"]:hover,
	body input[type="submit"]:focus {
		border-color:'. esc_attr( $accent_color ) .'; 
	}

	button:hover,
	button:focus,
	.button:hover,
	.button:focus,
	input[type="button"]:hover,
	input[type="button"]:focus,
	input[type="reset"]:hover,
	input[type="reset"]:focus,
	input[type="submit"]:hover,
	input[type="submit"]:focus,
	.bean-btn,
	.tagcloud a,
	nav a h1:hover, 
	div.jp-play-bar,
	div.jp-volume-bar-value { 
		background-color:'. esc_attr( $accent_color ) .'; 
	}
	';

	/**
	 * Combine the values from above and minifiy them.
	 */
	$css_minified = $css;

	$css_minified = preg_replace( '#/\*.*?\*/#s', '', $css_minified );
	$css_minified = preg_replace( '/\s*([{}|:;,])\s+/', '$1', $css_minified );
	$css_minified = preg_replace( '/\s\s+(.*)/', '$1', $css_minified );

	wp_add_inline_style( 'york-style', wp_strip_all_tags( $css_minified ) );

}
add_action( 'wp_enqueue_scripts', 'york_customizer_css' );
