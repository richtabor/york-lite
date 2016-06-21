<?php
/**
 * Add controls for arbitrary heading, description, line
 *
 * @see ttps://developer.wordpress.org/reference/classes/wp_customize_control/
 */



class Bean_Content_Control extends WP_Customize_Control {



     /**
      * Set the $type variable to be used in the Customizer. 
      *
      * @param WP_Customize_Manager $wp_customize the Customizer object.
      */
     public $type = 'content';



	/**
	 * Render the control's content.
	 *
	 * Allows the content to be overriden without having to rewrite the wrapper.
	 *
	 */
	public function render_content() {

		if ( isset( $this->label ) ) {
			echo '<span class="customize-control-title">' . $this->label . '</span>';
		}

		if ( isset( $this->input_attrs['content'] ) ) {
			echo $this->input_attrs['content'];
		}

		if ( isset( $this->description ) ) {
			echo '<span class="">' . $this->description . '</span>';
		}
	}
}