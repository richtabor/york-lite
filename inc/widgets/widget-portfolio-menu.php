<?php
/**
 * Clients Widget.
 *
 * @package @@pkg.name
 * @version @@pkg.version
 * @author  @@pkg.author
 * @license @@pkg.license
 */

add_action( 'widgets_init', create_function( '', 'return register_widget("York_Portfolio_Menu");' ) );

/**
 * Main York_Portfolio_Menu Class.
 *
 * @since 1.0.0
 */
class York_Portfolio_Menu extends WP_Widget {

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
			'york_portfolio_menu', // Base ID.
			esc_html__( 'Portfolio Menu', '@@textdomain' ), // Widget name.
			array(
				'classname' => 'widget--portfolio-menu', // Classes.
				'description' => esc_html__( 'A custom loop of portfolio posts.', '@@textdomain' ),
				'customize_selective_refresh' => true,
			)
		);

		$this->defaults = array(
			'title'  => '',
			'desc'  => '',
			'postcount'  => '',
			'loop'  => '',
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

		$desc 		= $instance['desc'];
		$postcount  = $instance['postcount'];
		$loop 	 	= $instance['loop'];
		$title  	= $instance['title'];

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

		if ( '' !== $loop ) {
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
			'post_type'      => 'portfolio',
			'order'          => 'DSC',
			'orderby'        => $orderby,
			'meta_key'       => $meta_key,
			'posts_per_page' => $postcount,
		);

		query_posts( $args );

		if ( have_posts() ) :

			while ( have_posts() ) : the_post();

				printf( '<li><a href="%1s" title="%2$s">%2$s</a></li>',
					esc_url( get_the_permalink() ),
					esc_html( get_the_title() )
				);

			endwhile;

		endif;

		wp_reset_postdata();

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
		$instance = $old_instance;
		$instance['title'] = stripslashes( $new_instance['title'] );
		$instance['desc']  = $new_instance['desc'];
		$instance['loop']  = $new_instance['loop'];
		$instance['postcount']  = $new_instance['postcount'];

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
		<label for="<?php echo esc_attr( $this->get_field_id( 'postcount' ) ); ?>"><?php esc_html_e( 'Number of Posts: (-1 for Infinite)', '@@textdomain' ); ?></label>
		<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'postcount' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'postcount' ) ); ?>" value="<?php echo esc_attr( $instance['postcount'] ); ?>" />
		</p>
		
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'loop' ) ); ?>"><?php esc_html_e( 'Portfolio Loop:', '@@textdomain' ); ?></label>
		<select id="<?php echo esc_attr( $this->get_field_id( 'loop' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'loop' ) ); ?>" class="widefat">
			<option <?php if ( 'Most Recent' === $instance['loop'] ) { echo 'selected="selected"'; } ?>><?php esc_html_e( 'Most Recent', '@@textdomain' ); ?></option>
			<option <?php if ( 'Random' === $instance['loop'] ) { echo 'selected="selected"'; } ?>><?php esc_html_e( 'Random', '@@textdomain' ); ?></option>
		</select>
		</p>

	<?php
	}
}
