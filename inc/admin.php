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

}
add_action( 'admin_enqueue_scripts', 'york_enqueue_admin_style' );
