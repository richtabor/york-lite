<?php
/**
 * The header for our theme.
 *
 * @package York
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<?php $post_layout = ( get_theme_mod( 'york_portfolio_modal' ) ) ? 'modal-active' : ''; ?>

<body <?php body_class( 'clearfix ' . esc_html($post_layout) ); ?>>
    
    <div hidden><?php get_template_part( 'images/social.svg' ); ?></div>
    
    <div id="page" class="hfeed site clearfix">

        <div class="mobile-menu-toggle close-toggle"><span></span><span></span><span></span></div>
  
        <header id="masthead" class="site-header clearfix"> 
                
            <div class="site-header--left">
                <?php york_site_logo(); ?>
            </div>

            <div class="site-header--right"> 

                <?php if ( has_nav_menu( 'primary' ) ) : ?>
                    <div class="mobile-menu-toggle"><span></span><span></span><span></span></div>
                <?php endif; ?> 

            </div>

        </header><!-- .site-header -->

    	<div id="content" class="site-content clearfix">