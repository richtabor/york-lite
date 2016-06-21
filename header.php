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

<body <?php body_class( 'clearfix ' ); ?>>
    
    <div hidden><?php get_template_part( 'images/sprite.svg' ); ?></div>
    <div hidden><?php get_template_part( 'images/social.svg' ); ?></div>
    
    <?php
    if ( !is_404() ) : ?>

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
            
            <?php 
            /*
             * Create a hero entry header, if it's added in the page template.
             */
            $entry_header = get_post_meta($post->ID, '_bean_entry_header', true); 
            
            $content = $post->post_content;

            $visibility = ( $entry_header ) ? '' : 'has_no_header' ?>

        	<div id="content" class="site-content animsition <?php echo esc_html($visibility); ?> clearfix">

            <?php
            if ( $entry_header ) : ?>

                <header class="hero entry-header">

                    <div class="hero-wrapper">

                        <h1 class="entry-title"><?php echo balancetags( $entry_header ); ?></h1>

                        <?php
                        if ( is_page_template('template-portfolio.php') ) :
                            if ($content) : 

                                while ( have_posts() ) : the_post();
                                    echo'<div class="entry-content">';
                                        the_content();
                                    echo'</div>';
                               endwhile; 
                            endif; 
                        endif; ?>

                    </div>

                </header>

            <?php endif; 

    endif; 