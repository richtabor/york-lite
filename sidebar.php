<?php
/**
 * The sidebar containing the flyout widget area.
 *
 * @package @@pkg.name
 * @version @@pkg.version
 * @author  @@pkg.author
 * @license @@pkg.license
 */

// Add a class if there is no widget area active.
$is_active = ( ! is_active_sidebar( 'sidebar-1' ) ) ? 'no-widget-area' : 'has-widget-area'; ?> 

<div id="nav-close" class="nav-close-overlay"></div>

<aside id="secondary" class="sidebar <?php echo esc_attr( $is_active ); ?>">
	
	<div class="hamburger hamburger--spin mobile-menu-toggle close-toggle">
		<div class="hamburger-box">
			<div class="hamburger-inner"></div>
		</div>
	</div>
		
	<div class="sidebar--section">
	
		<div class="sidebar--section-inner">
		
			<nav id="site-navigation" class="main-navigation nav primary" aria-label="<?php esc_attr_e( 'Primary Menu', 'york-lite' ); ?>">
				<?php wp_nav_menu( array(
					'theme_location' => 'primary',
					'menu_class'     => 'primary-menu',
					'depth'          => '2',
					'fallback_cb'    => 'york_add_a_menu',
				) ); ?>
			</nav>

		</div>

	</div>

	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<div class="sidebar--section widget-area">
			<div class="sidebar--section-inner">
				<?php dynamic_sidebar( 'sidebar-1' ); ?>
			</div>
		</div>
	<?php endif; ?>

</aside>
