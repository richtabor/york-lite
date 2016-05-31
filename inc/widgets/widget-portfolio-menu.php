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

        $this->defaults = array(
            'title'  => '',
            'desc'  => '',
            'postcount'  => '',
            'loop'  => '',
        );
    }

    // Display widget
    function widget( $args, $instance ) {
        extract( $args );

        // Merge with defaults
        $instance = wp_parse_args( (array) $instance, $this->defaults );
    
        // Variables
        $desc = $instance['desc'];
        $postcount  = $instance['postcount'];
        $loop  = $instance['loop']; 
        $title  = $instance['title'];  
        
        // Before
        echo balanceTags($before_widget);

        if ( $title ) {
            echo balanceTags($before_title) . esc_html($title) . balanceTags($after_title); 
        }
        
        if ( $desc ) {
            $allowedtags = array(
                'a' => array(
                    'href' => true,
                    'title' => true,
                ),
                'b' => array(),
                'em' => array(),
                'i' => array(),
                'strike' => array(),
                'strong' => array(),
            );
            printf( '<p>%1s</p>', wp_kses( $desc, $allowedtags, '' ) );

        }
        
        echo '<ul>'; 

            //Variable
            if( $loop != '' ) {
                switch ( $loop ) {
                    case 'Most Recent': 
                        $orderby = 'date';
                        $meta_key = ''; 
                        break;
                    case 'Random': 
                        $orderby = 'rand';
                        $meta_key = ''; 
                        break;
                }
            }
                
            $args = array(
                'post_type'     => 'portfolio',
                'order'         => 'DSC',
                'orderby'       => $orderby,
                'meta_key'      => $meta_key,
                'posts_per_page'=> $postcount,
            ); 

            query_posts($args); 

            if ( have_posts() ) : 

                while ( have_posts() ) : the_post(); 
            
                    printf( '<li><a href="%1s" title="%2$s">%2$s</a></li>', 
                        esc_url( get_the_permalink() ), 
                        esc_html( get_the_title() )
                    );

                endwhile; 

            endif; wp_reset_query();
            
        echo '</ul>'; 


        // After
        echo balanceTags($after_widget);
    }
    
    // Update widget
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        
        // Strip tags
        $instance['title'] = stripslashes( $new_instance['title']);
        $instance['desc']  = $new_instance['desc'];
        $instance['loop']  = $new_instance['loop'];
        $instance['postcount']  = $new_instance['postcount'];
    
        return $instance;
    }
            
    // Display widget
    function form( $instance ) {
        
        // Merge with defaults
        $instance = wp_parse_args( (array) $instance, $this->defaults ); ?>
        
        <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Title:', 'york') ?></label>
        <input type="text" class="widefat" id="<?php echo esc_html($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
        </p>
    
        <p style="margin-top: -8px;">
        <textarea class="widefat" rows="5" cols="15" id="<?php echo esc_html($this->get_field_id( 'desc' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'desc' )); ?>"><?php echo balanceTags($instance['desc']); ?></textarea>
        </p>

        <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'postcount' )); ?>"><?php esc_html_e('Number of Posts: (-1 for Infinite)', 'york') ?></label>
        <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'postcount' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'postcount' )); ?>" value="<?php echo esc_attr($instance['postcount']); ?>" />
        </p>
        
        <p>
        <label for="<?php echo $this->get_field_id( 'loop' ); ?>"><?php esc_html_e('Portfolio Loop:', 'york') ?></label>
        <select id="<?php echo $this->get_field_id( 'loop' ); ?>" name="<?php echo $this->get_field_name( 'loop' ); ?>" class="widefat">
            <option <?php if ( 'Most Recent' == $instance['loop'] ) echo 'selected="selected"'; ?>><?php esc_html_e('Most Recent', 'york') ?></option>
            <option <?php if ( 'Random' == $instance['loop'] ) echo 'selected="selected"'; ?>><?php esc_html_e('Random', 'york') ?></option>    
        </select>
        </p>

    <?php
    } //END form
} //END class