<?php
/**
 * The front page template file.
 *
 * If the user has selected a static page for their homepage, this is what will appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package @@pkg.name
 * @version @@pkg.version
 * @author  @@pkg.author
 * @license @@pkg.license
 */

get_header();

get_template_part( 'components/portfolio' );

get_footer();
