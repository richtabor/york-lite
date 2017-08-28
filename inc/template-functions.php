<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package @@pkg.name
 * @version @@pkg.version
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

	/*
	 * If comments are open or we have at least one comment, load up the comment template.
	 *
	 * @link https://codex.wordpress.org/Function_Reference/comments_open/
	 * @link https://codex.wordpress.org/Template_Tags/get_comments_number/
	 */
	if ( comments_open() || get_comments_number() ) :
		$classes[] = 'is-page-with-comments';
	endif;

	return $classes;
}
add_filter( 'body_class', 'york_body_classes' );

/**
 * Checks to see if we're on the homepage or not.
 */
function york_is_frontpage() {
	return ( is_front_page() && ! is_home() );
}

/**
 * Menu fallback.
 *
 * @param  array $args Arguments.
 * @return string
 */
function york_add_a_menu( $args ) {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	extract( $args );

	$link = $link_before . '<a class="add-a-menu" href="' .admin_url( 'nav-menus.php' ) . '">' . $before . 'Add a menu' . $after . '</a>' . $link_after;

	if ( false !== stripos( $items_wrap, '<ul' ) || false !== stripos( $items_wrap, '<ol' ) ) {
		$link = "<li>$link</li>";
	}

	$output = sprintf( $items_wrap, $menu_id, $menu_class, $link );

	if ( ! empty( $container ) ) {
		$output  = "<$container class='$container_class' id='$container_id'>$output</$container>";
	}

	if ( $echo ) {
		echo $output;
	}

	return $output;
}