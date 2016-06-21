<?php
// Register widget
add_action('widgets_init', create_function('', 'return register_widget("York_Portfolio_Menu");'));

class York_Portfolio_Menu extends WP_Widget {

    protected $defaults;

    // Constructor
    function __construct() {
        parent::__construct(
            'york_portfolio_menu', // Base ID
            esc_html__( 'Portfolio Menu', 'york' ), // Name
            array( 
                'classname' => 'widget--portfolio-menu', // Classes
                'description' => esc_html__( 'A custom loop of portfolio posts.', 'york' ), 
                'customize_selective_refresh' => true,
            ) // Args
        );

        $this->defaults = array();
    }

    // Display widget
    function widget( $args, $instance ) {
        extract( $args );
    }
    
    // Update widget
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
    
        return $instance;
    }
            
    // Display widget
    function form( $instance ) {
        
        // Merge with defaults
        $instance = wp_parse_args( (array) $instance, $this->defaults ); ?>
        
        <p><?php esc_html_e('This widget is available on York Pro. Upgrade today to unlock this widget and many other great features.', 'york') ?></p>
        <p style="margin-bottom: 25px;">
        <?php echo sprintf( __( '<a target="_blank" href="%1$s" class="button button-secondary">Learn More</a>', 'york' ), esc_url( PRO_INFO_URL ) ); ?>
        <?php echo sprintf( __( '<a target="_blank" href="%1$s" class="button button-primary">Upgrade Now</a>', 'york' ), esc_url( PRO_UPGRADE_URL ) ); ?></p>
    <?php
    } //END form
} //END class