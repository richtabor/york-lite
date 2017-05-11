<?php
/**
 * The header for our theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package @@pkg.name
 * @version @@pkg.version
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

<?php if ( ! is_404() ) : ?>

	<div id="page" class="hfeed site clearfix">

		<header id="masthead" class="site-header clearfix"> 
				
			<div class="site-header--left">
				<?php york_site_logo(); ?>
			</div>

			<div class="site-header--right"> 

				<?php if ( has_nav_menu( 'primary' ) ) : ?>
					<div class="hamburger hamburger--spin mobile-menu-toggle">
						<div class="hamburger-box">
							<div class="hamburger-inner"></div>
						</div>
					</div>
				<?php endif; ?> 

			</div>

		</header><!-- .site-header -->
		
		<?php
		if ( is_singular( 'page' ) ) :
			/*
			 * Create a hero entry header, if it's added in the page template.
			 */
			$entry_header   = get_post_meta( $post->ID, '_bean_entry_header', true );
			$content        = $post->post_content;
			$visibility     = ( $entry_header ) ? '' : 'site-content--no-header';
		else :
			$entry_header   = false;
			$visibility     = 'site-content--no-header';
		endif;
		?>

		<div id="content" class="site-content animsition <?php echo esc_attr( $visibility ); ?> clearfix">

			<?php if ( $entry_header ) : ?>

				<header class="hero entry-header">

					<div class="hero-wrapper">
						
						<?php
	                    $allowed_html_array = array(
	                        'span' => array(
	                            'class' => array(),
	                        ),
	                        'b' => array(
	                            'class' => array(),
	                        ),
	                        'i' => array(),
	                        'em' => array(),
	                        'strong' => array(),
	                    ); ?>

						<h1 class="entry-title cd-headline letters type"><?php echo wp_kses( $entry_header , $allowed_html_array ); ?></h1>

					</div>

				</header>

			<?php endif;
endif;
