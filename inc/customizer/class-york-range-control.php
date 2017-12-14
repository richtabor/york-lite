<?php
/**
 * Range Customizer Control
 *
 * @see https://developer.wordpress.org/reference/classes/wp_customize_control/
 *
 * @package @@pkg.name
 * @author  @@pkg.author
 * @license @@pkg.license
 */

/**
 * Custom Range Control
 */
class York_Range_Control extends WP_Customize_Control {

	/**
	 * Set the control type.
	 *
	 * @var $type Customizer type
	 */
	public $type = 'custom-range';

	/**
	 * Get the control default.
	 *
	 * @var $type Customizer type option
	 */
	public $default = 'default';

	/**
	 * Enqueue scripts and styles.
	 */
	public function enqueue() {
		wp_enqueue_style( 'york-customize-range-control', get_theme_file_uri( '/assets/css/customize-range-control.css' ), false, '@@pkg.version', 'all' );
		wp_enqueue_script( 'york-customize-range-control', get_theme_file_uri( '/assets/js/customize-range-control.js' ), array( 'jquery' ), '@@pkg.version', true );
	}

	/**
	 * Render the content.
	 *
	 * @see https://developer.wordpress.org/reference/classes/wp_customize_control/render_content/
	 */
	public function render_content() {

		if ( ! empty( $this->label ) ) : ?>
			<label><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span></label>
		<?php endif; ?>

		<div class="value">
			<span><?php echo esc_attr( $this->value() ); ?></span>
			<input class="track-input" data-default-value="<?php echo esc_attr( $this->default ); ?>" type="number"<?php $this->input_attrs(); ?> value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
			<em><?php echo esc_html( $this->description ); ?></em>
		</div>

		<input class="track" data-default-value="<?php echo esc_attr( $this->default ); ?>" data-input-type="range" type="range"<?php $this->input_attrs(); ?> value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />

		<a type="button" value="reset" class="range-reset"></a>

	<?php
	}
}
