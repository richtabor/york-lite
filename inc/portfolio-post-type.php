<?php
/**
 * Filters for the Portfolio Post Type plugin.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package @@pkg.name
 * @author  @@pkg.author
 * @license @@pkg.license
 */

/**
 * Enables block editor support for the Portfolio Post Type plugin.
 *
 * @param array $args Existing arguments.
 *
 * @return array Amended arguments.
 */
function york_portfolioposttype_plugin_args( array $args ) {

	$args['show_in_rest'] = true;

	return $args;
}
add_action( 'portfolioposttype_args', 'york_portfolioposttype_plugin_args' );
