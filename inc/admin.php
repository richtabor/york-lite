<?php
/**
 * Custom admin functions for this theme.
 *
 * @package York
 */
 


/**
 * Post meta additions.
 */
if( is_admin() ) {
	require get_template_directory() . '/inc/meta/metaboxes.php';
    require get_template_directory() . '/inc/meta/meta-page.php';
	require get_template_directory() . '/inc/meta/meta-post.php';
	require get_template_directory() . '/inc/meta/meta-portfolio.php';
}



/**
 * Load TGM.
 */
require_once get_template_directory() . '/inc/plugins/plugins.php';



/**
 * Pro upgrade functions.
 * Warning: Don't just remove or delete these lines below.
 * You will get errors. 
 */
require get_template_directory() . '/inc/upgrade/upgrade-setup.php';    
require get_template_directory() . '/inc/upgrade/upgrade.php';  



/**
 * Theme feedback class.
 */
if( is_admin() ) {
	require get_template_directory() . '/inc/feedback.php';
}



/**
 * Register and enqueue a custom stylesheet in the WordPress admin.
 */
function york_enqueue_admin_style() {
     wp_register_style( 'admin_style', get_template_directory_uri() . '/css/admin-style.css', false, YORK_VERSION );
     wp_enqueue_style(  'admin_style' );

     wp_enqueue_style(  'wp-color-picker' );        
        
}
add_action( 'admin_enqueue_scripts', 'york_enqueue_admin_style' );



/**
 * Enqueue a script in the WordPress admin, for edit.php, post.php and post-new.php.
 *
 * @param int $hook Hook suffix for the current admin page.
 */
function york_enqueue_admin_script($hook) {
    global $pagenow, $wp_customize;
    
	if( $hook != 'edit.php' ) {
        wp_enqueue_script( 'meta', get_template_directory_uri() . '/inc/meta/js/meta.js', array( 'jquery' ), YORK_VERSION, true );
        wp_enqueue_script( 'wp-color-picker' );  
    }


    if ( 'widgets.php' === $pagenow || isset( $wp_customize ) ) {
        wp_enqueue_media();
        wp_enqueue_script( 'widget-image-upload', get_template_directory_uri() . '/js/src/admin.js', array( 'jquery' ), YORK_VERSION, true );
        wp_enqueue_script('jquery');
        wp_enqueue_script('jquery-ui-core');//enables UI
    }

}
add_action('admin_enqueue_scripts', 'york_enqueue_admin_script');



/**
 * TinyMCE callback function to insert 'styleselect' into the $buttons array
 */
function york_mce_formats_button( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
// Register our callback to the appropriate filter
add_filter('mce_buttons_2', 'york_mce_formats_button');



/**
 * TinyMCE Callback function to filter the MCE settings
 * 
 */
function york_mce_before_init_insert_formats( $init_array ) {  
    // Define the style_formats array
    $style_formats = array(  
        // Each array child is a format with it's own settings
        array(  
            'title'     => esc_html__( 'Highlight', 'york' ),  
            'inline'    => 'span',
            'classes'   => 'yorkup--highlight',
            'wrapper'   => false,
        ),
        array(  
            'title'     => esc_html__( 'Button', 'york' ),   
            'inline'    => 'span',
            'classes'   => 'button',
            'wrapper'   => false,
        ),
    );  
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode( $style_formats );  
    
    return $init_array;  
} 
// Attach callback to 'tiny_mce_before_init'
add_filter( 'tiny_mce_before_init', 'york_mce_before_init_insert_formats' );