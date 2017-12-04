<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #page div and all content after
 *
 * @package @@pkg.name
 * @author  @@pkg.author
 * @license @@pkg.license
 */

?>

		</div><!-- .site-content -->

		<?php get_sidebar(); ?>

		<footer id="colophon" class="site-footer">

			<?php if ( is_active_sidebar( 'footer' ) ) : ?>
				<div class="footer-sidebar widget-area">
					<?php dynamic_sidebar( 'footer' ); ?>
				</div>
			<?php endif; ?>

			<?php york_social_navigation(); ?>

			<div class="site-info">

				<span class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">&copy; <?php echo esc_html( date_i18n( __( 'Y', 'york-lite' ) ) ); ?> <?php bloginfo( 'name' ); ?></a>
				</span>

				<span class="site-theme">
					<?php /* translators: 1: theme, 2: designer */ ?>
					<a href="https://themebeans.com/themes/york/" class="powered-by-york"><?php printf( esc_html__( '%1$s by %2$s', 'york-lite' ), 'York', 'ThemeBeans' ); ?></a>
				</span>

			</div>

			<?php if ( has_nav_menu( 'footer' ) ) : ?>
				<nav id="footer-navigation" class="footer-navigation" aria-label="<?php esc_attr_e( 'Footer Menu', 'york-lite' ); ?>">
					<?php wp_nav_menu( array(
						'theme_location' => 'footer',
						'menu_class'     => 'footer-menu',
						'depth'          => '1',
					) ); ?>
				</nav><!-- .main-navigation -->
			<?php endif; ?>

		</footer><!-- .site-footer -->

	</div><!-- .site -->

	<?php wp_footer(); ?>

	</body>

</html>
