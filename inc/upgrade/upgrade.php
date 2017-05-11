<?php
/**
 * Contains the Pro upgrade notification class.
 *
 * @package @@pkg.name
 * @version @@pkg.version
 * @author  @@pkg.author
 * @license @@pkg.license
 */

class York_Upgrade {

	/**
	 * Sets up the upgrade notification.
	 */
	public function __construct() {
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'themebeans_pro_upgrade_scripts' ) );
	}

	/**
	 * Display upgrade notice on customizer page.
	 */
	public function themebeans_pro_upgrade_scripts() {

		wp_enqueue_script( 'york-customizer-upsell', get_template_directory_uri() . '/inc/upgrade/js/upgrade.js', array(), '1.0.0', true );

		wp_localize_script(
			'york-customizer-upsell',
			'themebeans_pro_L10n',
			array(
				'themebeans_pro_url'		=> esc_url( YORK_UPGRADE_URL ),
				'themebeans_pro_label'		=> sprintf( esc_html__( 'Upgrade to %s', '@@textdomain' ), YORK_PRO_NAME ),
				'themebeans_pro_minilabel'	=> esc_html__( 'Pro', '@@textdomain' ),
			)
		);
	}
}

$GLOBALS['York_Upgrade'] = new York_Upgrade();
