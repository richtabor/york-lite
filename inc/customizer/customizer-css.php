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

	$theme_accent_color 		= get_theme_mod( 'theme_accent_color', '#ff5c5c' );
	$background_color 			= get_theme_mod( 'york_background_color', '#ffffff' );
	$sitetitle_color 			= get_theme_mod( 'york_sitetitle_color', '#000000' );
	$sitetitlehover_color 		= get_theme_mod( 'york_sitetitlehover_color', '#ff5c5c' );
	$navigationicon_color 		= get_theme_mod( 'york_navigationicon_color', '#000000' );
	$navigationiconhover_color 	= get_theme_mod( 'york_navigationiconhover_color', '#000000' );
	$footertext_color 			= get_theme_mod( 'york_footertext_color', '#000000' );
	$footernav_a_color 			= get_theme_mod( 'york_footernav_a_color', '#909090' );
	$footertexthover_color 		= get_theme_mod( 'york_footertexthover_color', '#ff5c5c' );
	$footersocial_color 		= get_theme_mod( 'york_footersocial_color', '#000000' );
	$sidebarsocial_color 		= get_theme_mod( 'york_sidebarsocial_color', '#000000' );
	$overlay_color 				= get_theme_mod( 'york_overlay_color', '#000000' );
	$overlay_text_color 		= get_theme_mod( 'york_overlay_text_color', '#ffffff' );
	$site_logo_width 			= get_theme_mod( 'site_logo_width', '90' );

	// Convert main text hex color to rgba.
	$theme_accent_color_rgb = york_hex2rgb( $theme_accent_color );

	// If the rgba values are empty return early.
	if ( empty( $theme_accent_color_rgb ) ) {
		return;
	}

	$rgb_10_opacity  = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.075)', $theme_accent_color_rgb );
	$rgb_50_opacity  = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.25)', $theme_accent_color_rgb );

	$body_typography_color = get_theme_mod( 'body_typography_color', '#000' );
	$header_typography_color = get_theme_mod( 'header_typography_color', '#000' );
	$body_secondary_typography_color = get_theme_mod( 'body_secondary_typography_color', '#909090' );

	$body_font_family = get_theme_mod( 'body_font_family', 'Playfair Display' );
	$body_font_size = get_theme_mod( 'body_font_size', '18' );
	$body_line_height = get_theme_mod( 'body_line_height', '1.8' );
	$body_letter_spacing = get_theme_mod( 'body_letter_spacing', '0' );
	$body_word_spacing = get_theme_mod( 'body_word_spacing', '0' );

	$pagetitle_font_family = get_theme_mod( 'pagetitle_font_family', 'Playfair Display' );
	$pagetitle_font_size = get_theme_mod( 'pagetitle_font_size', '4.75' );
	$pagetitle_line_height = get_theme_mod( 'pagetitle_line_height', '1.4' );

	$mobile_pagetitle_font_size = get_theme_mod( 'mobile_pagetitle_font_size', '40' );
	$mobile_pagetitle_line_height = get_theme_mod( 'mobile_pagetitle_line_height', '1.4' );

	$bigdesktop_pagetitle_font_size = get_theme_mod( 'bigdesktop_font_size', '90' );
	$bigdesktop_pagetitle_line_height = get_theme_mod( 'bigdesktop_line_height', '1.4' );

	$pagetitle_letter_spacing = get_theme_mod( 'pagetitle_letter_spacing', '0' );
	$pagetitle_word_spacing = get_theme_mod( 'pagetitle_word_spacing', '0' );

	$css =
	'
	body { 
		font-family: '. esc_attr( $body_font_family ) .' !important; 
		font-size: '. esc_attr( $body_font_size ) .'px !important; 
	}

	body #content {
		line-height: '. esc_attr( $body_line_height ) .'em !important; 
	}

	body #content p {
		letter-spacing: '. esc_attr( $body_letter_spacing ) .'px !important; 
		word-spacing: '. esc_attr( $body_word_spacing ) .'px !important;
	}
	
	body .hero .entry-title, 
	body .project-caption,
	body.single .navigation a { 
		font-family: '. esc_attr( $pagetitle_font_family ) .' !important; 
		font-size: '. esc_attr( $mobile_pagetitle_font_size ) .'px !important;              
	}

	@media screen and (max-width: 1920px) and (min-width: 823px) {
		body .hero .entry-title, 
		body .project-caption,
		body.single .navigation a { 
			font-size: '. esc_attr( $pagetitle_font_size ) .'vw !important; 
			line-height: '. esc_attr( $pagetitle_line_height ) .'em !important; 
		}
	}

	@media screen and (min-width: 1920px) {
		body .hero .entry-title, 
		body .project-caption,
		body.single .navigation a {
			font-size: '. esc_attr( $bigdesktop_pagetitle_font_size ) .'px !important; 
			line-height: '. esc_attr( $bigdesktop_pagetitle_line_height ) .'em !important; 
		}
	}
	
	body .project .overlay {
		background:'. esc_attr( $overlay_color ) .';
	}

	body .project .overlay h3 {
		color:'. esc_attr( $overlay_text_color ) .';
	}

	body .lightbox-play svg {
		fill:'. esc_attr( $overlay_text_color ) .';
	}

	body, 
	body .site {
		background-color:'. esc_attr( $background_color ) .' !important;
	}
	
	.custom-logo-link img {
		width: '. esc_attr( $site_logo_width ) .'px;
	}

	body h1.site-logo-link {
		color: '. esc_attr( $sitetitle_color ) .' ;
		border-color: '. esc_attr( $sitetitle_color ) .' ;
	}

	body h1.site-logo-link:hover,
	body h1.site-logo-link:focus {
		border-color: '. esc_attr( $sitetitlehover_color ) .' ;
	}
	
	body h1.site-logo-link a:hover {
		color: '. esc_attr( $sitetitlehover_color ) .'!important;
		border-color: '. esc_attr( $sitetitlehover_color ) .'!important;
	}

	body .mobile-menu-toggle span {
		background:'. esc_attr( $navigationicon_color ) .';
	}

	body .mobile-menu-toggle:hover span,
	body.nav-open .mobile-menu-toggle span {
		background-color:'. esc_attr( $navigationiconhover_color ) .';
	}

	body .site-footer {
		color:'. esc_attr( $footertext_color ) .';
	}

	body .site-footer .footer-navigation a {
		color:'. esc_attr( $footernav_a_color ) .';
	}

	body #colophon.site-footer span a:hover {
		color:'. esc_attr( $footertexthover_color ) .';
	}

	body .site-footer .social-navigation svg { 
		fill:'. esc_attr( $footersocial_color ) .'; 
	}

	body #content a:hover,
	body #content a:focus {
		color:'. esc_attr( $theme_accent_color ) .'!important;
		border-color:'. esc_attr( $theme_accent_color ) .'!important;
	}

	body button,
	body .button,
	body button[disabled]:hover,
	body button[disabled]:focus,
	body input[type="button"],
	body input[type="button"][disabled]:hover,
	body input[type="button"][disabled]:focus,
	body input[type="reset"],
	body input[type="reset"][disabled]:hover,
	body input[type="reset"][disabled]:focus,
	body input[type="submit"],
	body input[type="submit"][disabled]:hover,
	body input[type="submit"][disabled]:focus {
		background-color:'. esc_attr( $theme_accent_color ) .';
	}

	article .yorkup--highlight {
		background-image: linear-gradient(to bottom, '. esc_attr( $rgb_10_opacity ) .', '. esc_attr( $rgb_10_opacity ) .');
	}

	body.single-portfolio .navigation a:hover {
		color:'. esc_attr( $theme_accent_color ) .' !important;
		border-color:'. esc_attr( $theme_accent_color ) .' !important;
	}
	
	body,
	body.single,
	body.page,
	body.home,
	body.blog,
	body button,
	body input,
	body select,
	body textarea,
	p a:hover {
		color: '. esc_attr( $body_typography_color ) .'; 
	}

	body #content a:hover,
	body .main-navigation a:hover {
		color: '. esc_attr( $theme_accent_color ) .'; 
	}
	
	body blockquote {
		border-color: '. esc_attr( $body_typography_color ) .'; 
	}

	body .tagcloud > a,
	body .tagcloud > a:hover,
	body .post-meta a:hover,
	body .project-meta a:hover {
		color: '. esc_attr( $body_typography_color ) .'!important; 
	}
	
	body .cat-links, 
	body .cat-links a,
	body .entry-meta,
	body .entry-meta a,
	body .post-meta a, 
	body .post-meta span, 
	body .post-meta span:before,
	body .project-meta p, 
	body .project-taxonomy,
	body .project-taxonomy a,
	body .project-taxonomy a:before,
	body .project-meta p:before,
	body .widget_bean_tweets a.twitter-time-stamp  {
		color: '. esc_attr( $body_secondary_typography_color ) .'!important; 
	}

	body blockquote cite,
	body blockquote small {
		color: '. esc_attr( $body_secondary_typography_color ) .';
	}

	body h1,
	body h2,
	body h3,
	body h4,
	body h5,
	body .project-caption,
	body .main-navigation a {
		color: '. esc_attr( $header_typography_color ) .'; 
	}

	body.single .navigation a {
		color: '. esc_attr( $header_typography_color ) .' !important; 
	}
	
	@media (min-width: 600px) {
		body .cd-words-wrapper::after,
		body .cd-words-wrapper.selected {
			background-color: '. esc_attr( $header_typography_color ) .'; 
		}
	}

	body .sidebar .social-navigation svg { 
		fill:'. esc_attr( $sidebarsocial_color ) .'; 
	}

	a:hover,
	a:focus,
	body .site-footer a:hover, 
	body .header .project-filter a:hover,
	body .header .main-navigation a:hover,
	body .header .project-filter a.active, 
	.logo_text:hover,
	.current-menu-item a, 
	.page-links a span:not(.page-links-title):hover,
	.page-links span:not(.page-links-title) { color:'. esc_attr( $theme_accent_color ) .'; }

	.cats,
	h1 a:hover, 
	.logo a h1:hover,
	.tagcloud a:hover,
	.entry-meta a:hover,
	.header-alt a:hover,
	.post-after a:hover,
	.bean-tabs > li.active > a,
	.bean-panel-title > a:hover,
	.archives-list ul li a:hover,
	.bean-tabs > li.active > a:hover,
	.bean-tabs > li.active > a:focus,
	.bean-pricing-table .pricing-column li.info:hover { 
		color:'. esc_attr( $theme_accent_color ) .'!important; 
	}

	body .type-post .post-content blockquote::before {
		color:'. esc_attr( $theme_accent_color ) .';
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
		border-color:'. esc_attr( $theme_accent_color ) .'; 
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
	div.jp-volume-bar-value,
	.bean-direction-nav a:hover,
	.bean-pricing-table .table-mast,
	.entry-categories a:hover, 
	.bean-contact-form .bar:before { 
		background-color:'. esc_attr( $theme_accent_color ) .'; 
	}

	.bean-btn { border: 1px solid '. esc_attr( $theme_accent_color ) .'!important; }
	.bean-quote { background-color:'. esc_attr( $theme_accent_color ) .'!important; }
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
