<?php
/**
 * The template for displaying the single portfolio posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package @@pkg.name
 * @author  @@pkg.author
 * @license @@pkg.license
 */

get_header();

// Start the loop.
while ( have_posts() ) :

	the_post();

	// Include the single portfolio content template.
	get_template_part( 'components/portfolio/single' );

endwhile;

get_footer();
