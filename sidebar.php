<?php
/**
* The sidebar containing the flyout widget area.
*
* @package York
*/
?>

<div id="nav-close" class="nav-close-overlay"></div>

<aside id="secondary" class="sidebar <?php if ( ! is_active_sidebar( 'sidebar-1' )  ) { echo 'no-widget-area'; }; ?>">
    
    <div class="sidebar--section">
    
        <div class="sidebar--section-inner">
        
            <?php if ( has_nav_menu( 'primary' ) ) : ?>
                <nav id="site-navigation" class="main-navigation nav primary" aria-label="<?php esc_attr_e( 'Primary Menu', 'york' ); ?>">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu_class'     => 'primary-menu',
                        'depth'         => '1',
                        ) );
                        ?>
                </nav><!-- .main-navigation -->
            <?php endif; 

            /**
             * We're onlying displaying the social navigation if the option is selected in the Customizer.
             */
            if ( get_theme_mod( 'nav_social_icons' ) || is_customize_preview() ) :
            
                /*
                 * If selected in the Customizer.
                 * The visibility classes area used to show/hide the elements in the Customizer live preview.
                 */
                $visibility = ( false == get_theme_mod( 'nav_social_icons' ) ) ? 'hidden' : ''; ?> 
                
                <div class="sidebar-social <?php echo esc_html($visibility); ?>">
                    <?php york_social_navigation(); ?>
                </div>

            <?php endif; ?>

        </div>

    </div>

    <?php if ( is_active_sidebar( 'sidebar-1' )  ) : ?>
        <div class="sidebar--section widget-area">
            <div class="sidebar--section-inner">
                <?php dynamic_sidebar( 'sidebar-1' ); ?>
            </div>
        </div>
    <?php endif; ?>

</aside><!-- .sidebar -->