<?php
/**
 * Metaboxes (CMB2) Compatibility
 *
 * @package @@pkg.name
 * @author  @@pkg.author
 * @license @@pkg.license
 */

/**
 * Define the metabox and field configurations.
 */
function york_metaboxes() {

	// Load this metabox only if a portfolio post type exists.
	if ( post_type_exists( 'portfolio' ) ) {
		/**
		 * Initiate the metabox.
		 */
		$cmb = new_cmb2_box(
			array(
				'id'           => 'york_portfolio_metabox',
				'title'        => esc_html__( 'Portfolio Settings', '@@textdomain' ),
				'object_types' => array( 'portfolio' ),
				'context'      => 'normal',
				'priority'     => 'high',
			)
		);

		$cmb->add_field(
			array(
				'name'    => esc_html__( 'Grid Thumbnail Size', '@@textdomain' ),
				'desc'    => esc_html__( 'Select the size of the project thumbnail.', '@@textdomain' ),
				'id'      => '_bean_portfolio_grid_size',
				'type'    => 'radio',
				'default' => 'project-med',
				'options' => array(
					'project-sml' => esc_html__( 'Small', '@@textdomain' ),
					'project-med' => esc_html__( 'Medium', '@@textdomain' ),
					'project-lrg' => esc_html__( 'Large', '@@textdomain' ),
					'project-xlg' => esc_html__( 'Extra Large', '@@textdomain' ),
				),
			)
		);
	}
}
add_action( 'cmb2_admin_init', 'york_metaboxes' );
