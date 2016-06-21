<?php
/**
 * The file is for creating the portfolio post type meta. 
 * Meta output is defined on the portfolio single editor.
 * Corresponding meta functions are located in framework/metaboxes.php
 *
 *  
 * @package WordPress
 * @subpackage York
 * @author ThemeBeans
 */
 
add_action('add_meta_boxes', 'bean_metabox_portfolio');
function bean_metabox_portfolio(){

$prefix = '_bean_';




/*===================================================================*/
/*  PORTFOLIO FORMAT SETTINGS							   			          							
/*===================================================================*/
$meta_box = array(
	'id' => 'portfolio-type',
	'title' =>  esc_html__('Portfolio Format', 'york'),
	'description' => esc_html__('', 'york'),
	'page' => 'portfolio',
	'context' => 'side',
	'priority' => 'core',
	'fields'   => array(
		array(  
			'name' => esc_html__('Gallery','york'),
			'desc' => esc_html__('','york'),
			'id' => $prefix.'portfolio_type_gallery',
			'type' => 'checkbox',
			'std' => true 
			),	
		array(  
			'name' => esc_html__('Video','york'),
			'desc' => esc_html__('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Available on York Pro','york'),
			'id' => $prefix.'portfolio_type_video',
			'type' => 'checkbox',
			'std' => false 
			),							
	)
);
bean_add_meta_box( $meta_box );





/*===================================================================*/
/*  PORTFOLIO META SETTINGS							   			          							
/*===================================================================*/
$meta_box = array(
	'id' => 'portfolio-meta',
	'title' =>  esc_html__('Portfolio Settings', 'york'),
	'description' => esc_html__('', 'york'),
	'page' => 'portfolio',
	'context' => 'normal',
	'priority' => 'high',
	'fields'   => array(
        array( 
            'name' => esc_html__('Grid Thumbnail Size:', 'york'),
            'desc' => esc_html__('Select the size of the project thumbnail.', 'york'),
            'id' => $prefix.'portfolio_grid_size',
            'type' => 'radio',
            'std' => 'project-med',
            'options' => array(
                'project-sml'  => esc_html__('Small', 'york'),
                'project-med'  => esc_html__('Medium', 'york'),
                'project-lrg'  => esc_html__('Large', 'york'),
                'project-xlg'  => esc_html__('Xtra-Large', 'york'),
                )
            ),
		array( 
			'name' => esc_html__('Gallery Images:','york'),
			'desc' => esc_html__('Upload, reorder and caption the post gallery.','york'),
			'id' => $prefix .'portfolio_upload_images',
			'type' => 'images',
			'std' => esc_html__('Browse & Upload', 'york')
			),
		array(
			'name' => esc_html__('Date:', 'york'),
			'id' => $prefix.'portfolio_date',
			'type' => 'checkbox',
			'desc' => esc_html__('Display the date.', 'york'),
			'std' => false 
			),
		array(
			'name' => esc_html__('Views:', 'york'),
			'id' => $prefix.'portfolio_views',
			'type' => 'checkbox',
			'desc' => esc_html__('Display the view count.', 'york'),
			'std' => false 
			),
		array(
			'name' => esc_html__('Categories:', 'york'),
			'id' => $prefix.'portfolio_cats',
			'type' => 'checkbox',
			'desc' => esc_html__('Display the portfolio categories.', 'york'),
			'std' => false 
			),
		array(
			'name' => esc_html__('Tags:', 'york'),
			'id' => $prefix.'portfolio_tags',
			'type' => 'checkbox',
			'desc' => esc_html__('Display the portfolio tags.', 'york'),
			'std' => false 
			),
        array(
            'name' => esc_html__('Permalink:', 'york'),
            'id' => $prefix.'portfolio_permalink',
            'type' => 'checkbox',
            'desc' => esc_html__('Display the post permalink.', 'york'),
            'std' => false 
            ),
		array(  
			'name' => esc_html__('Role:','york'),
			'desc' => esc_html__('Display the role.','york'),
			'id' => $prefix.'portfolio_role',
			'type' => 'text',
			'std' => ''
			),
		array(  
			'name' => esc_html__('Client:','york'),
			'desc' => esc_html__('Display the client meta.','york'),
			'id' => $prefix.'portfolio_client',
			'type' => 'text',
			'std' => ''
			),	
		array(  
			'name' => esc_html__('URL:','york'),
			'desc' => esc_html__('Display a URL to link to.','york'),
			'id' => $prefix.'portfolio_url',
			'type' => 'text',
			'std' => ''
			),	
		array(  
			'name' => esc_html__('External URL:','york'),
			'desc' => esc_html__('Link this portfolio post to an external URL. For example, link this post to your Behance portfolio post.','york'),
			'id' => $prefix.'portfolio_external_url',
			'type' => 'text',
			'std' => ''
			),				
	)
);
bean_add_meta_box( $meta_box );
}