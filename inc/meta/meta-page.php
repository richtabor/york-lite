<?php
/**
 * The file is for creating the portfolio post type meta. 
 * Meta output is defined on the portfolio single editor.
 * Corresponding meta functions are located in framework/metaboxes.php
 *
 *  
 * @package York
 */
 
add_action('add_meta_boxes', 'york_metabox_page');
function york_metabox_page(){

$prefix = '_bean_';

$meta_box = array(
    'id' => 'bean-meta-box-page',
    'title' =>  esc_html__('Page Settings', 'york'),
    'page' => 'page',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => esc_html__('Entry Header', 'york'),
            'desc' => esc_html__('Add a header tagline to this page.', 'york'),
            'id' => $prefix . 'entry_header',
            'type' => 'textarea',
            'std' => 'Rich is an idea maker, a visionary, a creative genius — his mantra is turning nothing into something.'
            ),
    )
);
bean_add_meta_box( $meta_box );
}