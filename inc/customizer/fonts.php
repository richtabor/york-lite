<?php
/**
 * Fonts functionality
 *
 * @package @@pkg.name
 * @version @@pkg.version
 * @author  @@pkg.author
 * @license @@pkg.license
 */

/**
 * Enqueue fonts from the Customizer.
 */
function york_enqueue_fonts() {
	$default = array(
		'default',
		'Default',
		'arial',
		'Arial',
		'courier',
		'Courier',
		'verdana',
		'Verdana',
		'trebuchet',
		'Trebuchet',
		'georgia',
		'Georgia',
		'times',
		'Times',
		'tahoma',
		'Tahoma',
		'helvetica',
		'Helvetica',
	);

	$fonts = array();

	$body_font_family = get_theme_mod( 'body_font_family' );
	$header_font_family = get_theme_mod( 'pagetitle_font_family' );

	if ( '' != $body_font_family ) {
		$fonts[] = $body_font_family;
	}

	if ( '' != $header_font_family ) {
		$fonts[] = $header_font_family;
	}

	$fonts = array_unique( $fonts );

	foreach ( $fonts as $font ) {
		if ( ! in_array( $font, $default ) ) {
			york_enqueue_google_fonts( $font );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'york_enqueue_fonts' );

/**
 * Enqueue fonts from the Customizer.
 */
function york_enqueue_google_fonts( $font ) {

	$font = explode( ',', $font );
	$font = $font[0];

	if ( 'Open Sans' == $font ) {
		$font = 'Open Sans:400,600';
	} else {
		$font = $font . ':400,500,700';
	}

	$font = str_replace( '', '+', $font );

	wp_enqueue_style( "york-google-$font", "http://fonts.googleapis.com/css?family=$font", false, null, 'all' );
}
