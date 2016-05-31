<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package York
 */



if ( ! function_exists( 'york_jetpack_setup' ) ) :
function york_jetpack_setup() {

	/*
	 * Let JetPack manage the site logo.
	 * By adding theme support, we declare that this theme does use the default
	 * JetPack Site Logo functionality, if the module is activated. 
	 *
	 * See: http://jetpack.me/support/site-logo/
	 */
    add_image_size( 'york-logo', 9999, 9999 );

    add_theme_support( 'site-logo', array( 'size' => 'york-logo' ) );

    /**
     * Add theme support for Infinite Scroll.
     * See: http://jetpack.me/support/infinite-scroll/
     */
    add_theme_support( 'infinite-scroll', array(
        'container' => 'hfeed', // Don't change this
        'render'    => 'york_scroll_render',
        'footer'    => 'page',
        'wrapper'    => false,
    ) );
}
endif;
add_action( 'after_setup_theme', 'york_jetpack_setup' );



/**
 * Halves the size of the JetPack site logo to make it retina ready.
 *
 * @param	$html string The rendered site-logo html
 * @param	$logo array The logo-Jetpack object
 * @param	$size string The size of the logo
 * @see	jetpack_the_site_logo filter in Jetpack
 */
function york_retina_jetpack_site_logo( $html, $logo, $size ) {
	
	// Checker, comes from jetpack_the_site_logo
	if ( ! jetpack_has_site_logo() ) {
		return $html;
	}
		
	/*
	 * Proceed if the retina_logo Customizer option is selected.
	 */
	if ( get_theme_mod( 'retina_logo' ) == true ) :

		// Get the image size
		$imageAttachment = wp_get_attachment_image_src( $logo['id'], $size );
		
		// Half the image size since we want a retina ready image
		$html = preg_replace( '/width="(\d+)"/i', 'width="' . ( round( $imageAttachment[1] / 2 ) ) . '"', $html );
        $html = preg_replace( '/height="(\d+)"/i', 'height="' . ( round( $imageAttachment[2] / 2 ) ) . '"', $html );
	
	endif;	

	return $html;
}
add_filter( 'jetpack_the_site_logo', 'york_retina_jetpack_site_logo', 10, 3 );



if ( ! function_exists( 'york_scroll_render' ) ) :
/**
 * Define the code that is used to render the posts added by Infinite Scroll.
 * Create your own york_scroll_render() to override in a child theme.
 */
function york_scroll_render() {

    while ( have_posts() ) {
        the_post();
       
        /*
         * Include the Post-Format-specific template for the content.
         * If you want to override this in a child theme, then include a file
         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
         */
        get_template_part( 'template-parts/content', get_post_format() );

    }
}
endif;



if ( ! function_exists( 'york_remove_infinitescroll_css' ) ) :
/**
 * Let's remove unnessary CSS loading.
 */

    // First, make sure Jetpack doesn't concatenate all its CSS
    add_filter( 'jetpack_implode_frontend_css', '__return_false' );

    // Then, remove each CSS file, one at a time
    function york_remove_infinitescroll_css() {
        wp_deregister_style( 'the-neverending-homepage' ); // Infinite Scroll
        wp_deregister_style( 'infinity-twentyten' ); // Infinite Scroll - Twentyten Theme
        wp_deregister_style( 'infinity-twentyeleven' ); // Infinite Scroll - Twentyeleven Theme
        wp_deregister_style( 'infinity-twentytwelve' ); // Infinite Scroll - Twentytwelve Theme
    }

    add_action('wp_print_styles', 'york_remove_infinitescroll_css' );
endif;