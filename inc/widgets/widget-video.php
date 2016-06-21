<?php
// Register widget
add_action('widgets_init', create_function('', 'return register_widget("York_Video_Widget");'));

class York_Video_Widget extends WP_Widget 
{
	// Constructor
	function __construct() {
		parent::__construct(
			'bean_profile', // Base ID
			esc_html__( 'Embedded Video', 'york' ), // Name
			array( 
                'classname' => 'widget--video', // Classes
                'description' => esc_html__( 'Displays embedded video content.', 'york' ),
                'customize_selective_refresh' => true, 
            ) // Args
		);
	}

	// Display widget
	function widget( $args, $instance ) 
	{
		extract( $args );
	
		// Variables
		$title = $instance['desc'];
        $desc = $instance['desc'];
		
		// Before
		echo balanceTags($before_widget);
		
        if($title != '') {
            echo '<h2>' . esc_html( $title ) . '</h2>';
        }

		if($desc != '') {
			echo '<p>' . balanceTags( $desc ) . '</p>';
		}
	
		echo '<div class="video-frame">';
	   	echo balanceTags($embed);
		echo '</div>';

		// After
		echo balanceTags($after_widget);
	}
	
	// Update widget
	function update( $new_instance, $old_instance ) 
	{
		$instance = $old_instance;
		
		// Strip tags
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['desc'] = stripslashes( $new_instance['desc'] );
		$instance['embed'] = stripslashes( $new_instance['embed']);
	
		return $instance;
	}
			
	// Display widget
	function form( $instance ) 
	{
		$defaults = array(
			'title' => '',
			'desc' => '',
			'embed' => '',
			);
			
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Title:', 'york') ?></label>
		<input type="text" class="widefat" id="<?php echo esc_html($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>
		
		<p style="margin-top: -8px;">
		<textarea class="widefat" rows="5" cols="15" id="<?php echo esc_html($this->get_field_id( 'desc' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'desc' )); ?>"><?php echo balanceTags($instance['desc']); ?></textarea>
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'embed' ); ?>"><?php esc_html_e('Video Embed Code:', 'york') ?></label>
		<textarea class="widefat" rows="5" cols="15" id="<?php echo esc_html($this->get_field_id( 'embed' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'embed' )); ?>"><?php echo balanceTags($instance['embed']); ?></textarea>
		</p>
	<?php
	} //END form
} //END class