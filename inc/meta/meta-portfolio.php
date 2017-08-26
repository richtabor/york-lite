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
			'title' => esc_html__( 'Portfolio Settings', 'york-lite' ),
			'description' => '',
			'page' => 'portfolio',
			'context' => 'normal',
			'priority' => 'high',
			'fields'   => array(
				array(
					'name' => esc_html__( 'Grid Thumbnail Size:', 'york-lite' ),
					'desc' => esc_html__( 'Select the size of the project thumbnail.', 'york-lite' ),
					'id' => $prefix.'portfolio_grid_size',
					'type' => 'radio',
					'std' => 'project-med',
					'options' => array(
						'project-sml'  => esc_html__( 'Small', 'york-lite' ),
						'project-med'  => esc_html__( 'Medium', 'york-lite' ),
						'project-lrg'  => esc_html__( 'Large', 'york-lite' ),
						'project-xlg'  => esc_html__( 'Xtra-Large', 'york-lite' ),
						),
					),
				array(
					'name' => esc_html__( 'Gallery Images:', 'york-lite' ),
					'desc' => esc_html__( 'Upload, reorder and caption the post gallery.', 'york-lite' ),
					'id' => $prefix .'portfolio_upload_images',
					'type' => 'images',
					'std' => esc_html__( 'Browse & Upload', 'york-lite' ),
					),
				array(
					'name' => esc_html__( 'Date:', 'york-lite' ),
					'id' => $prefix.'portfolio_date',
					'type' => 'checkbox',
					'desc' => esc_html__( 'Display the date.', 'york-lite' ),
					'std' => false,
					),
				array(
					'name' => esc_html__( 'Categories:', 'york-lite' ),
					'id' => $prefix.'portfolio_cats',
					'type' => 'checkbox',
					'desc' => esc_html__( 'Display the portfolio categories.', 'york-lite' ),
					'std' => false,
					),
				array(
					'name' => esc_html__( 'Tags:', 'york-lite' ),
					'id' => $prefix.'portfolio_tags',
					'type' => 'checkbox',
					'desc' => esc_html__( 'Display the portfolio tags.', 'york-lite' ),
					'std' => false,
					),
				array(
					'name' => esc_html__( 'Permalink:', 'york-lite' ),
					'id' => $prefix.'portfolio_permalink',
					'type' => 'checkbox',
					'desc' => esc_html__( 'Display the post permalink.', 'york-lite' ),
					'std' => false,
					),
				array(
					'name' => esc_html__( 'Role:', 'york-lite' ),
					'desc' => esc_html__( 'Display the role.', 'york-lite' ),
					'id' => $prefix.'portfolio_role',
					'type' => 'text',
					'std' => '',
					),
				array(
					'name' => esc_html__( 'Client:', 'york-lite' ),
					'desc' => esc_html__( 'Display the client meta.', 'york-lite' ),
					'id' => $prefix.'portfolio_client',
					'type' => 'text',
					'std' => '',
					),
				array(
					'name' => esc_html__( 'URL:', 'york-lite' ),
					'desc' => esc_html__( 'Display a URL to link to.', 'york-lite' ),
					'id' => $prefix.'portfolio_url',
					'type' => 'text',
					'std' => '',
					),
				array(
					'name' => esc_html__( 'External URL:', 'york-lite' ),
					'desc' => esc_html__( 'Link this portfolio post to an external URL. For example, link this post to your Behance portfolio post.', 'york-lite' ),
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
