<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #page div and all content after
 *
 * @package York
 */

    if ( !is_404() ) : ?>

        	</div><!-- .site-content -->
            
            <?php get_sidebar(); ?>

            <footer id="colophon" class="site-footer animsition">

                <?php if ( is_active_sidebar( 'footer' )  ) : ?>
                    <div class="footer-sidebar widget-area">
                        <?php dynamic_sidebar( 'footer' ); ?>
                    </div>
                <?php endif; ?>

                <div class="site-info">
                    
                    <span class="site-title">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">&copy; <?php echo date("Y") ?> <?php bloginfo( 'name' ); ?></a>
                    </span>
            
                    <span class="site-theme">
                        <a href="https://themebeans.com/themes/york-pro/" class="powered-by-york"><?php printf( esc_html__( '%s by %s', 'york' ), 'York', 'ThemeBeans' ); ?></a>
                    </span>

                </div>

                <?php if ( has_nav_menu( 'footer' ) ) : ?>
                    <nav id="footer-navigation" class="footer-navigation" aria-label="<?php esc_attr_e( 'Footer Menu', 'york' ); ?>">
                        <?php wp_nav_menu( array(
                            'theme_location' => 'footer',
                            'menu_class'     => 'footer-menu',
                            'depth'          => '1',
                        ) ); ?>
                    </nav><!-- .main-navigation -->
                <?php endif; ?>

            </footer><!-- .site-footer -->

        </div><!-- .site -->
        
        <?php
    endif;

    wp_footer(); ?>

    </body>
    
</html>