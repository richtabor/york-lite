<?php
/**
 * Flickr Widget.
 *
 * @package @@pkg.name
 * @version @@pkg.version
 * @author  @@pkg.author
 * @license @@pkg.license
 */

add_action( 'widgets_init', create_function( '', 'return register_widget("Bean_Flickr_Widget");' ) );

/**
 * Main Bean_Flickr_Widget Class.
 *
 * @since 1.0.0
 */
class Bean_Flickr_Widget extends WP_Widget {

	/**
	 * Construct the widget.
	 */
	function __construct() {
		parent::__construct(
			'bean_flickr', // Base ID.
			esc_html__( 'Flickr Photos', '@@textdomain' ), // Widget Name.
			array(
				'description' => esc_html__( 'Add a Flickr feed widget.', '@@textdomain' ),
				'customize_selective_refresh' => true,
			)
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

		$title = apply_filters( 'widget_title', $instance['title'] );
		$flickr_id = $instance['flickrID'];
		$type = $instance['type'];
		$display = $instance['display'];
		$desc = $instance['desc'];

		$allowed_html_array = array(
			'aside' => array(
				'class' => array(),
				'id' => array(),
			),
		);

		echo wp_kses( $before_widget, $allowed_html_array );

		$allowed_title_array = array(
			'h6' => array(
				'class' => array(),
			),
		);

		if ( $title ) {
			echo wp_kses( $before_title, $allowed_title_array ) . esc_html( $title ) . wp_kses( $after_title, $allowed_title_array );
		}

		if ( '' !== $type   ) {
			switch ( $type ) {
				case 'User':
					$type = 'user';
					break;
				case 'Group':
					$type = 'group';
					break;
			}
		}

		if ( '' !== $display ) {
			switch ( $display ) {
				case 'Random':
					$display = 'random';
					break;
				case 'Latest':
					$display = 'latest';
					break;
			}
		} ?>
		
		<?php if ( '' !== $desc ) : ?>
			<p><?php echo esc_html( $desc ); ?></p>
		<?php endif; ?>
		
		<div class="flickr-image-wrapper">
			<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=8&amp;display=<?php echo esc_js( $display ); ?>&amp;size=s&amp;layout=x&amp;source=<?php echo esc_js( $type ); ?>&amp;<?php echo esc_js( $type ); ?>=<?php echo esc_js( $flickr_id ); ?>"></script>
		</div>
		
		<?php
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
		$instance['flickrID'] = strip_tags( $new_instance['flickrID'] );
		$instance['desc'] = stripslashes( $new_instance['desc'] );
		$instance['type'] = $new_instance['type'];
		$instance['display'] = $new_instance['display'];

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

		$defaults = array(
			'title' => '',
			'flickrID' => '',
			'type' => 'User',
			'desc' => '',
			'display' => 'Latest',
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title / Intro:', '@@textdomain' ); ?></label>
		<input type="text" class="widefat" id="<?php echo esc_html( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
		
		<p style="margin-top: -8px;">
		<textarea class="widefat" rows="5" cols="15" id="<?php echo esc_html( $this->get_field_id( 'desc' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'desc' ) ); ?>"><?php echo esc_html( $instance['desc'] ); ?></textarea>
		</p>
		
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'flickrID' ) ); ?>"><?php esc_html_e( 'Flickr ID:', '@@textdomain' ); ?> (<a target="_blank" href="http://idgettr.com/">idGettr</a>)</label>
		<input type="text" class="widefat" id="<?php echo esc_html( $this->get_field_id( 'flickrID' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'flickrID' ) ); ?>" value="<?php echo esc_html( $instance['flickrID'] ); ?>" />
		</p>
		
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'type' ) ); ?>"><?php esc_html_e( 'Type:', '@@textdomain' ); ?></label>
		<select id="<?php echo esc_html( $this->get_field_id( 'type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'type' ) ); ?>" class="widefat">
			<option <?php if ( 'User' === $instance['type'] ) { echo 'selected="selected"'; } ?>>User</option>
			<option <?php if ( 'Group' === $instance['type'] ) { echo 'selected="selected"'; } ?>>Group</option>
		</select> 
		</p>
		
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'display' ) ); ?>"><?php esc_html_e( 'Display:', '@@textdomain' ); ?></label>
		<select id="<?php echo esc_html( $this->get_field_id( 'display' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'display' ) ); ?>" class="widefat">
			<option <?php if ( 'Random' === $instance['display'] ) { echo 'selected="selected"'; } ?>>Random</option>
			<option <?php if ( 'Latest' === $instance['display'] ) { echo 'selected="selected"'; } ?>>Latest</option>
		</select>
		</p>
		
	<?php
	}
}
