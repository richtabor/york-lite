<?php
/**
 * Contains the Pro upgrade notification class.
 *
 * @subpackage inc/upgrade
 */



class ThemeBeans_Pro_Upgrade {



	/**
	 * Sets up the upgrade notification.
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'pro_upgrade_register_menu' ) );
		add_action( 'load-themes.php', array( $this, 'pro_activation_admin_notice' ) );
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'themebeans_pro_upgrade_scripts' ) );
		add_action( 'admin_footer_text', array( $this, 'themebeans_pro_footer_notice' ) );
	}



	/**
	 * Adds an admin notice upon successful activation.
	 */
	public function pro_activation_admin_notice() {
		global $pagenow;

		if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'pro_notification_admin_notice' ), 99 );
		}
	}



	/**
	 * Display an admin notice linking to the more info link provided in upgrade-setup.php
	 */
	public function pro_notification_admin_notice() {
		?>
			<div class="updated notice is-dismissible">
				<p><?php echo sprintf( esc_html__( 'Thanks for choosing %1$s! Did you know that there\'s a "Pro" version of %1$s with some astonishingly neat features? %2$sClick here to learn more about %1$s Pro &rarr;%2$s', 'york' ), esc_html( PRO_NAME ), '<a href="' . esc_url( PRO_INFO_URL ) . '">', '</a>' ); ?></p>
			</div>
		<?php
	}



	/**
	 * Creates the dashboard page.
	 * @see  add_theme_page()
	 */
	public function pro_upgrade_register_menu() {
		add_dashboard_page( 'Buy '.esc_html( PRO_NAME ).' Pro', 'Buy '.esc_html( PRO_NAME ).' Pro - $59', 'read', 'pro-upgrade', array( $this, 'pro_upgrade_redirect' ) );
	}



	/**
	 * The dashbaord page that we created in the pro_upgrade_register_menu() function above. 
	 * This page acts as a purchase redirect upsell link.
	 */
	public function pro_upgrade_redirect() {
		require_once( ABSPATH . 'wp-load.php' );
		require_once( ABSPATH . 'wp-admin/admin.php' );
		require_once( ABSPATH . 'wp-admin/admin-header.php' );
		?>
		    <script type="text/javascript">
		        //<![CDATA[
		            window.location.replace("<?php echo PRO_UPGRADE_URL; ?>");
		        //]]>
		    </script>
		<?php
	}



	/**
	 * Append a pro notification to the admin footer.
	 *
	 * @global	 string $typenow
	 * @param       string $footer_text The existing footer text
	 * @return      string
	 */
	public function themebeans_pro_footer_notice( $footer_text ) {
			$rate_text = sprintf( __( '<a href="%1$s" target="_blank">Learn more about %2$s Pro</a> or <a href="%3$s" target="_blank">upgrade your theme now</a>.', 'york' ),
				esc_html( PRO_INFO_URL ),
				esc_html( PRO_NAME ),
				esc_html( PRO_UPGRADE_URL )
			);

			return str_replace( '</span>', '', $footer_text ) . ' | ' . $rate_text . '</span>';
	}



	/**
	 * Display upgrade notice on customizer page.
	 */
	public function themebeans_pro_upgrade_scripts() {

		// Enqueue the script
		wp_enqueue_script( 'pro-customizer-upsell', get_template_directory_uri() . '/inc/upgrade/js/upgrade.js', array(), '1.0.0', true );

		// Localize the script
		wp_localize_script(
			'pro-customizer-upsell',
			'themebeans_pro_L10n',
			array(
				'themebeans_pro_url'		=> esc_url( PRO_UPGRADE_URL ),
				'themebeans_pro_label'		=> esc_html__( 'Upgrade to '.PRO_NAME.' Pro', 'york' ),
				'themebeans_pro_minilabel'	=> esc_html__( 'Pro', 'york' ),
			)
		);
	}
}



$GLOBALS['ThemeBeans_Pro_Upgrade'] = new ThemeBeans_Pro_Upgrade();