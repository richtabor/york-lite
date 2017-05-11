<?php
/**
 * Video Widget.
 *
 * @package @@pkg.name
 * @version @@pkg.version
 * @author  @@pkg.author
 * @license @@pkg.license
 */

add_action( 'widgets_init', create_function( '', 'return register_widget("York_Video_Widget");' ) );

/**
 * Main York_Video_Widget Class.
 *
 * @since 1.0.0
 */
class York_Video_Widget extends WP_Widget {

	/**
	 * Defaults.
	 *
	 * @since 1.0.0
	 *
	 * @var $defaults array Widget defaults.
	 */
	protected $defaults;

	/**
	 * Construct the widget.
	 */
	function __construct() {
		parent::__construct(
			'bean_video', // Base ID.
			esc_html__( 'Embedded Video', '@@textdomain' ), // Name.
			array(
				'classname' => 'widget--video', // Classes.
				'description' => esc_html__( 'Displays embedded video content.', '@@textdomain' ),
				'customize_selective_refresh' => true,
			)
		);

		$this->defaults = array(
			'title' => '',
			'desc'  => '',
			'embed' => '',
		);
	}

	/**
	 * The Widget Frontend.
	 *
	 * @since 1.0.0
	 *
	 * @param array $args Arguments for this widget.
	 * @param array $instance Merge defaults with this widget.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		// Merge with defaults.
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		$title = $instance['desc'];
		$desc = $instance['desc'];

		$allowed_html_array = array(
			'aside' => array(
				'class' => array(),
				'id' => array(),
			),
		);

		echo wp_kses( $before_widget, $allowed_html_array );

		if ( $title ) {
			echo '<h2>' . esc_html( $title ) . '</h2>';
		}

		if ( $desc ) {
			echo '<p>' . esc_html( $desc ) . '</p>';
		}

		if ( $embed ) {
			echo '<div class="video-frame">';
				echo wp_kses_post( $embed );
			echo '</div>';
		}

		echo wp_kses( $after_widget, $allowed_html_array );
	}

	/**
	 * Saving.
	 *
	 * @since 1.0.0
	 *
	 * @param array $new_instance The older data.
	 * @param array $old_instance The newer data.
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['desc']  = stripslashes( $new_instance['desc'] );
		$instance['embed'] = stripslashes( $new_instance['embed'] );

		return $instance;
	}

	/**
	 * Widget Options.
	 *
	 * @since 1.0.0
	 *
	 * @param array $instance This instance of the widget.
	 */
	function form( $instance ) {

		// Merge with defaults.
		$instance = wp_parse_args( (array) $instance, $this->defaults ); ?>
		
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', '@@textdomain' ); ?></label>
		<input type="text" class="widefat" id="<?php echo esc_html( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
		
		<p style="margin-top: -8px;">
		<textarea class="widefat" rows="5" cols="15" id="<?php echo esc_html( $this->get_field_id( 'desc' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'desc' ) ); ?>"><?php echo esc_html( $instance['desc'] ); ?></textarea>
		</p>
		
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'embed' ) ); ?>"><?php esc_html_e( 'Video Embed Code:', '@@textdomain' ); ?></label>
		<textarea class="widefat" rows="5" cols="15" id="<?php echo esc_html( $this->get_field_id( 'embed' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'embed' ) ); ?>"><?php echo esc_html( $instance['embed'] ); ?></textarea>
		</p>
	<?php
	}
}
