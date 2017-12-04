<?php
/**
 * Additional features to allow styling of the templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package @@pkg.name
 * @author  @@pkg.author
 * @license @@pkg.license
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function york_body_classes( $classes ) {
	global $post;

	// Adds a class to the body.
	$classes[] = 'clearfix';

	// Adds a class of post-thumbnail to pages with post thumbnails for hero areas.
	if ( is_customize_preview() ) {
		$classes[] = 'is-customize-preview';
	}

	// Add class on front page.
	if ( is_front_page() && 'posts' !== get_option( 'show_on_front' ) ) {
		$classes[] = 'york-front-page';
	}

	return $classes;
}
add_filter( 'body_class', 'york_body_classes' );

/**
 * Checks to see if we're on the homepage or not.
 */
function york_is_frontpage() {
	return ( is_front_page() && ! is_home() );
}
