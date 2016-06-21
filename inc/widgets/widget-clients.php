<?php
// Register widget
add_action('widgets_init', create_function('', 'return register_widget("York_Clients");'));

class York_Clients extends WP_Widget {

    protected $defaults;
   
    // Constructor
    function __construct() {
        parent::__construct(
            'york_clients', // Base ID
            esc_html__( 'Clients', 'york-pro' ), // Name
            array( 
                'classname' => 'widget--clients', // Classes
                'description' => esc_html__( 'Displays client social proof.', 'york-pro' ), 
                'customize_selective_refresh' => true,
            ) // Args
        );

        $this->defaults = array();
    }

    // Display widget
    function widget( $args, $instance ) {
        extract( $args );

        // Merge with defaults
        $instance = wp_parse_args( (array) $instance, $this->defaults );
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
        
        <p><?php esc_html_e('This widget is available on York Pro. Upgrade today to display your client logos throughout your site.', 'york') ?></p>
        <p style="margin-bottom: 25px;">
        <?php echo sprintf( __( '<a target="_blank" href="%1$s" class="button button-secondary">Learn More</a>', 'york' ), esc_url( PRO_INFO_URL ) ); ?>
        <?php echo sprintf( __( '<a target="_blank" href="%1$s" class="button button-primary">Upgrade Now</a>', 'york' ), esc_url( PRO_UPGRADE_URL ) ); ?></p>
    <?php
    } //END form
} //END class