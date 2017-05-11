<?php
/**
 * Profile Widget.
 *
 * @package @@pkg.name
 * @version @@pkg.version
 * @author  @@pkg.author
 * @license @@pkg.license
 */

add_action( 'widgets_init', create_function( '', 'return register_widget("York_Profile");' ) );

/**
 * Main York_Profile Class.
 *
 * @since 1.0.0
 */
class York_Profile extends WP_Widget {

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
			'york_profile', // Base ID.
			esc_html__( 'Profile', '@@textdomain' ), // Name.
			array(
				'classname' => 'widget--profile', // Classes.
				'description' => esc_html__( 'Displays a user profile.', '@@textdomain' ),
				'customize_selective_refresh' => true,
			)
		);

		$this->defaults = array(
			'title'  => '',
			'desc'  => '',
			'image'  => '',
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

		$title = $instance['title'];
		$desc  = $instance['desc'];
		$image  = $instance['image'];

		$allowed_html_array = array(
			'aside' => array(
				'class' => array(),
				'id' => array(),
			),
		);

		echo wp_kses( $before_widget, $allowed_html_array );

		if ( $image ) {
			printf( '<div class="profile--avatar"><div class="profile--avatar-wrapper"><img src="%1s" alt="%2s"></div></div>', esc_url( $image ), esc_html( get_bloginfo( 'name' ) ) );
		}

		if ( $title ) {
			printf( '<h2>%1s</h2>', esc_html( $title ) );
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
		$instance['title']  = stripslashes( $new_instance['title'] );
		$instance['desc']   = $new_instance['desc'];
		$instance['image']  = strip_tags( $new_instance['image'] );

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
	
	 	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'desc' ) ); ?>"><?php esc_html_e( 'Description:', '@@textdomain' ); ?></label>
		<textarea class="widefat" rows="5" cols="15" id="<?php echo esc_html( $this->get_field_id( 'desc' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'desc' ) ); ?>"><?php echo esc_html( $instance['desc'] ); ?></textarea>
		</p>

		<p>
			<div class="widget-media-container">
				<div class="widget-media-inner">
				  	
					<?php $img_style    = ( $instance['image'] ) ? '' : 'style=display:none;'; ?>
					<?php $no_img_style = ( $instance['image'] ) ? 'style=display:none;' : ''; ?>

					<img id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>-preview" src="<?php echo esc_attr( $instance['image'] ); ?>" <?php echo esc_attr( $img_style ); ?> />
					<span class="widget-no-image" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>-noimg" <?php echo esc_attr( $no_img_style ); ?>><?php esc_html_e( 'No avatar selected', '@@textdomain' ); ?></span>
				</div>

				<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>" value="<?php echo esc_attr( $instance['image'] ); ?>" class="widget-media-url" />
				<input type="button" value="<?php echo esc_html( 'Remove', '@@textdomain' ); ?>" class="button widget-media-remove" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>-remove" <?php echo esc_attr( $img_style ); ?> />
				<?php $button_text = ( $instance['image'] ) ? esc_html__( 'Change Avatar', '@@textdomain' ) : esc_html__( 'Select Image', '@@textdomain' ); ?>
				<input type="button" value="<?php echo esc_html( $button_text ); ?>" class="button widget-media-upload" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>-button" />
				<br class="clear">
			</div>
		</p>
	<?php
	}
}
