<?php
/**
 * Custom admin functions for this theme.
 *
 * @package @@pkg.name
 * @version @@pkg.version
 * @author  @@pkg.author
 * @license @@pkg.license
 */

/**
 * Register and enqueue a custom stylesheet in the WordPress admin.
 */
function york_enqueue_admin_style() {

	wp_enqueue_style( 'york-admin-style', get_theme_file_uri( '/assets/css/admin-style.css' ), false, '@@pkg.version', 'all' );
	wp_enqueue_style( 'wp-color-picker' );

}
add_action( 'admin_enqueue_scripts', 'york_enqueue_admin_style' );

/**
 * Enqueue a script in the WordPress admin, for edit.php, post.php and post-new.php.
 *
 * @param int $hook Hook suffix for the current admin page.
 */
function york_enqueue_admin_script( $hook ) {

	global $pagenow, $wp_customize;

	if ( 'edit.php' !== $hook ) {
		wp_enqueue_script( 'york-meta', get_theme_file_uri( '/assets/js/admin/meta.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'wp-color-picker' );
	}

}
add_action( 'admin_enqueue_scripts', 'york_enqueue_admin_script' );
