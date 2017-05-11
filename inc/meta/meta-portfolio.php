<?php
/**
 * Portfolio post type metabox(es).
 *
 * @package @@pkg.name
 * @version @@pkg.version
 * @author  @@pkg.author
 * @license @@pkg.license
 */

if ( ! function_exists( 'york_metabox_portfolio' ) ) :
	/**
	 * Create 'portfolio' post type metaboxes.
	 */
	function york_metabox_portfolio() {

		$prefix = '_bean_';

		/**
		 * A metabox for all the post's metadata options.
		 */
		$meta_box = array(
			'id' => 'portfolio-meta',
			'title' => esc_html__( 'Portfolio Settings', '@@textdomain' ),
			'description' => '',
			'page' => 'portfolio',
			'context' => 'normal',
			'priority' => 'high',
			'fields'   => array(
				array(
					'name' => esc_html__( 'Grid Thumbnail Size:', '@@textdomain' ),
					'desc' => esc_html__( 'Select the size of the project thumbnail.', '@@textdomain' ),
					'id' => $prefix.'portfolio_grid_size',
					'type' => 'radio',
					'std' => 'project-med',
					'options' => array(
						'project-sml'  => esc_html__( 'Small', '@@textdomain' ),
						'project-med'  => esc_html__( 'Medium', '@@textdomain' ),
						'project-lrg'  => esc_html__( 'Large', '@@textdomain' ),
						'project-xlg'  => esc_html__( 'Xtra-Large', '@@textdomain' ),
						),
					),
				array(
					'name' => esc_html__( 'Gallery Images:', '@@textdomain' ),
					'desc' => esc_html__( 'Upload, reorder and caption the post gallery.', '@@textdomain' ),
					'id' => $prefix .'portfolio_upload_images',
					'type' => 'images',
					'std' => esc_html__( 'Browse & Upload', '@@textdomain' ),
					),
				array(
					'name' => esc_html__( 'Date:', '@@textdomain' ),
					'id' => $prefix.'portfolio_date',
					'type' => 'checkbox',
					'desc' => esc_html__( 'Display the date.', '@@textdomain' ),
					'std' => false,
					),
				array(
					'name' => esc_html__( 'Views:', '@@textdomain' ),
					'id' => $prefix.'portfolio_views',
					'type' => 'checkbox',
					'desc' => esc_html__( 'Display the view count.', '@@textdomain' ),
					'std' => false,
					),
				array(
					'name' => esc_html__( 'Categories:', '@@textdomain' ),
					'id' => $prefix.'portfolio_cats',
					'type' => 'checkbox',
					'desc' => esc_html__( 'Display the portfolio categories.', '@@textdomain' ),
					'std' => false,
					),
				array(
					'name' => esc_html__( 'Tags:', '@@textdomain' ),
					'id' => $prefix.'portfolio_tags',
					'type' => 'checkbox',
					'desc' => esc_html__( 'Display the portfolio tags.', '@@textdomain' ),
					'std' => false,
					),
				array(
					'name' => esc_html__( 'Permalink:', '@@textdomain' ),
					'id' => $prefix.'portfolio_permalink',
					'type' => 'checkbox',
					'desc' => esc_html__( 'Display the post permalink.', '@@textdomain' ),
					'std' => false,
					),
				array(
					'name' => esc_html__( 'Role:', '@@textdomain' ),
					'desc' => esc_html__( 'Display the role.', '@@textdomain' ),
					'id' => $prefix.'portfolio_role',
					'type' => 'text',
					'std' => '',
					),
				array(
					'name' => esc_html__( 'Client:', '@@textdomain' ),
					'desc' => esc_html__( 'Display the client meta.', '@@textdomain' ),
					'id' => $prefix.'portfolio_client',
					'type' => 'text',
					'std' => '',
					),
				array(
					'name' => esc_html__( 'URL:', '@@textdomain' ),
					'desc' => esc_html__( 'Display a URL to link to.', '@@textdomain' ),
					'id' => $prefix.'portfolio_url',
					'type' => 'text',
					'std' => '',
					),
				array(
					'name' => esc_html__( 'External URL:', '@@textdomain' ),
					'desc' => esc_html__( 'Link this portfolio post to an external URL. For example, link this post to your Behance portfolio post.', '@@textdomain' ),
					'id' => $prefix.'portfolio_external_url',
					'type' => 'text',
					'std' => '',
					),
			),
		);
		york_add_meta_box( $meta_box );
	}

	add_action( 'add_meta_boxes', 'york_metabox_portfolio' );

endif;
