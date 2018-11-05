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
	if ( ! post_type_exists( 'portfolio' ) ) {
		return;
	}

	// Set the context, based on whether or not Gutenberg is enabled.
	$context = ( function_exists( 'register_block_type' ) ) ? 'side' : 'normal';

	/**
	 * Initiate the metabox.
	 */
	$cmb = new_cmb2_box(
		array(
			'id'           => 'york_portfolio_metabox',
			'title'        => esc_html__( 'Portfolio Settings', 'york-lite' ),
			'object_types' => array( 'portfolio' ),
			'context'      => $context,
			'priority'     => 'high',
		)
	);

	$cmb->add_field(
		array(
			'name'    => esc_html__( 'Grid Thumbnail Size', 'york-lite' ),
			'desc'    => esc_html__( 'Select the size of the project thumbnail.', 'york-lite' ),
			'id'      => '_bean_portfolio_grid_size',
			'type'    => 'radio',
			'default' => 'project-med',
			'options' => array(
				'project-sml' => esc_html__( 'Small', 'york-lite' ),
				'project-med' => esc_html__( 'Medium', 'york-lite' ),
				'project-lrg' => esc_html__( 'Large', 'york-lite' ),
				'project-xlg' => esc_html__( 'Extra Large', 'york-lite' ),
			),
		)
	);
}
add_action( 'cmb2_admin_init', 'york_metaboxes' );
