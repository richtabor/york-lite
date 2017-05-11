<?php
/**
 * Add controls for arbitrary heading, description, line
 *
 * @package @@pkg.name
 * @version @@pkg.version
 * @author  @@pkg.author
 * @license @@pkg.license
 */

/**
 * Custom control to display content in the Customizer.
 */
class Bean_Content_Control extends WP_Customize_Control {

	 /**
	  * Set the $type variable to be used in the Customizer.
	  *
	  * @param WP_Customize_Manager $wp_customize the Customizer object.
	  * @var string $type Content Name.
	  */
	public $type = 'content';

	/**
	 * Render the control's content.
	 * Allows the content to be overriden without having to rewrite the wrapper.
	 */
	public function render_content() {

		if ( isset( $this->label ) ) {
			echo '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
		}

		if ( isset( $this->input_attrs['content'] ) ) {
			echo wp_kses_post( $this->input_attrs['content'] );
		}

		if ( isset( $this->description ) ) {
			echo '<span class="description customize-control-description">' . esc_html( $this->description ) . '</span>';
		}
	}
}
