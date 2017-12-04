<?php
/**
 * The header for our theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package @@pkg.name
 * @author  @@pkg.author
 * @license @@pkg.license
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="site clearfix">

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'york-lite' ); ?></a>

	<header id="masthead" class="site-header clearfix">

		<div class="site-header--left">
			<?php york_site_logo(); ?>
		</div>

		<div class="site-header--right">

			<div class="hamburger mobile-menu-toggle">
				<div class="hamburger-box">
					<div class="hamburger-inner"></div>
				</div>
			</div>

		</div>

	</header><!-- .site-header -->

	<div id="content" class="site-content clearfix">

		<?php if ( york_is_frontpage() ) : ?>

			<header class="hero entry-header">

				<div class="hero-wrapper">

					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

				</div>

			</header>

		<?php endif; ?>
