<?php
/**
 * Upgrade variables.
 *
 * @package @@pkg.name
 * @version @@pkg.version
 * @author  @@pkg.author
 * @license @@pkg.license
 */

if ( ! defined( 'YORK_UPGRADE_URL' ) ) :
	/**
	 * Set constant for the upgrade purchase url.
	 */
	define( 'YORK_UPGRADE_URL', 'https://themebeans.com/checkout?edd_action=add_to_cart&download_id=75780' );
endif;

if ( ! defined( 'YORK_INFO_URL' ) ) :
	/**
	 * Set constant for the informational post about the upgrade.
	 */
	define( 'YORK_INFO_URL', 'https://themebeans.com/wordpress-themes/introducing-charmed-pro/' );
endif;

if ( ! defined( 'YORK_PRO_NAME' ) ) :
	/**
	 * Set constant for the name of the upgradeable theme.
	 * We use this just in case the theme name is modified.
	 */
	define( 'YORK_PRO_NAME', 'York' );
endif;
