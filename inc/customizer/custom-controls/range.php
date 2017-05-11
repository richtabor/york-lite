<?php
/**
 * Add a range control for typography options.
 *
 * @package @@pkg.name
 * @version @@pkg.version
 * @author  @@pkg.author
 * @license @@pkg.license
 */

/**
 * Custom control to display a range in the Customizer.
 */
class Bean_Customize_Range_Control extends WP_Customize_Control {

	/**
	 * Set the $type variable to be used in the Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize the Customizer object.
	 * @var string $type Content Name.
	 */
	public $type = 'range';

	/**
	 * Enqueue scripts.
	 */
	public function enqueue() {
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-slider' );
	}

	/**
	 * Render the control's content.
	 */
	public function render_content() {
	?>

	<label>
		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<input style="width: 13%; margin-right: 3%; float: left; text-align: center;" type="text" id="input_<?php echo esc_html( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?>/>
	</label>

	<div style="width: 82%; float: left;" id="slider_<?php echo esc_html( $this->id ); ?>" class="bean_slider"></div>

	<script>
		jQuery(document).ready(function($) {
			$( "#slider_<?php echo esc_html( $this->id ); ?>" ).slider({
				value: <?php echo intval( $this->value() ); ?>,
				min: <?php echo intval( $this->input_attrs['min'] ); ?>,
				max: <?php echo intval( $this->input_attrs['max'] ); ?>,
				step: <?php echo intval( $this->input_attrs['step'] ); ?>,
				slide: function( event, ui ) {
					$( "#input_<?php echo esc_js( $this->id ); ?>" ).val(ui.value).keyup();
				}
			});
			$( "#input_<?php echo esc_html( $this->id ); ?>" ).val( $( "#slider_<?php echo esc_html( $this->id ); ?>" ).slider( "value" ) );
		});
	</script>
	<?php
	}
}
