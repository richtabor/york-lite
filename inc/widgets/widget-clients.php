<?php
/**
 * Clients Widget.
 *
 * @package @@pkg.name
 * @version @@pkg.version
 * @author  @@pkg.author
 * @license @@pkg.license
 */

add_action( 'widgets_init', create_function( '', 'return register_widget("York_Clients");' ) );

/**
 * Main York_Clients Class.
 *
 * @since 1.0.0
 */
class York_Clients extends WP_Widget {

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
			'york_clients', // Base ID.
			esc_html__( 'Clients', '@@textdomain' ), // Widget Name.
			array(
				'classname' => 'widget--clients', // Classes.
				'description' => esc_html__( 'Displays client social proof.', '@@textdomain' ),
				'customize_selective_refresh' => true,
			)
		);

		$this->defaults = array(
			'image0' => '',
			'image1' => '',
			'image2' => '',
			'image3' => '',
			'image4' => '',
			'image5' => '',
			'image6' => '',
			'image7' => '',
			'image8' => '',
			'image9' => '',
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

		$allowed_html_array = array(
			'aside' => array(
				'class' => array(),
				'id' => array(),
			),
		);

		echo wp_kses( $before_widget, $allowed_html_array );

		echo '<ul class="section-testimonials">';

		// Loop through each image.
		for ( $x = 0; $x <= 9; $x++ ) {

			// Set the image source as a variable.
			$img_src = $instance[ 'image'.$x ];

			// Only output the number of gallery images that have been uploaded.
			if ( $img_src ) {

				echo '<li class="testimonial">';
					echo '<img class="thumb" src="' . esc_url( $img_src ) . '">';
				echo '</li>';
			}
		}

		echo '</ul>';

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

		$new_instance['image0'] = strip_tags( $new_instance['image0'] );
		$new_instance['image1'] = strip_tags( $new_instance['image1'] );
		$new_instance['image2'] = strip_tags( $new_instance['image2'] );
		$new_instance['image3'] = strip_tags( $new_instance['image3'] );
		$new_instance['image4'] = strip_tags( $new_instance['image4'] );
		$new_instance['image5'] = strip_tags( $new_instance['image5'] );
		$new_instance['image6'] = strip_tags( $new_instance['image6'] );
		$new_instance['image7'] = strip_tags( $new_instance['image7'] );
		$new_instance['image8'] = strip_tags( $new_instance['image8'] );
		$new_instance['image9'] = strip_tags( $new_instance['image9'] );

		return $new_instance;
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
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		// Variables to use in the widget.
		$add_text  = esc_html__( 'Add', '@@textdomain' );
		$edit_text = esc_html__( 'Edit', '@@textdomain' );
		?>

		<p>
			<div class="widget-media-container widget-media-container--grid">
	 
			<ul>

				<?php
				for ( $x = 0; $x <= 9; $x++ ) {

					$field_id = 'image'.$x;
					$instance_image = $instance[ 'image'.$x ];

					$img    = ( $instance_image ) ? '' : 'style=display:none;';
					$no_img = ( $instance_image ) ? 'style=display:none;' : '';
					$button = ( $instance_image ) ? $edit_text : $add_text;
					?>
					<li>
						<div class="image-wrap">
							<img id="<?php echo esc_attr( $this->get_field_id( $field_id ) ); ?>-preview" src="<?php echo esc_attr( $instance_image ); ?>" <?php echo esc_attr( $img ); ?> />
							<span class="widget-no-image" id="<?php echo esc_attr( $this->get_field_id( $field_id ) ); ?>-noimg" <?php echo esc_attr( $no_img ); ?>></span></td>
							<input type="text" id="<?php echo esc_attr( $this->get_field_id( $field_id ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $field_id ) ); ?>" value="<?php echo esc_attr( $instance_image ); ?>" class="widget-media-url" />
						</div>
						<div class="buttons-wrap">
							<input type="button" value="<?php echo esc_attr( $button ); ?>" class="button widget-media-upload" id="<?php echo esc_attr( $this->get_field_id( $field_id ) ); ?>-button" />
							 <input type="button" value="<?php echo esc_html( 'Remove', '@@textdomain' ); ?>" class="button widget-media-remove" id="<?php echo esc_attr( $this->get_field_id( $field_id ) ); ?>-remove" <?php echo esc_attr( $img ); ?> />
						</div>
					</li> 
			<?php } ?>

			</ul>
				<br class="clear">
			</div>
		</p>

	<?php
	}
}
