<?php
/**
 * Page post type metabox(s).
 *
 * @package @@pkg.name
 * @version @@pkg.version
 * @author  @@pkg.author
 * @license @@pkg.license
 */

if ( ! function_exists( 'york_metabox_page' ) ) :
	/**
	 * Create a standard 'page' post type metabox.
	 */
	function york_metabox_page() {

		$prefix = '_bean_';

		$meta_box = array(
			'id' => 'bean-meta-box-page',
			'title' => esc_html__( 'Page Settings', '@@textdomain' ),
			'page' => 'page',
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array(
					'name' => esc_html__( 'Entry Header', '@@textdomain' ),
					'desc' => esc_html__( 'Add a header tagline to this page.', '@@textdomain' ),
					'id' => $prefix . 'entry_header',
					'type' => 'textarea',
					'std' => '',
				),
			),
		);
		york_add_meta_box( $meta_box );
	}

	add_action( 'add_meta_boxes', 'york_metabox_page' );

endif;
