<?php
/**
 * Theme Metaboxes.
 *
 * @package @@pkg.name
 * @version @@pkg.version
 * @author  @@pkg.author
 * @license @@pkg.license
 */

/**
 * Add metabox function
 */
function york_add_meta_box( $meta_box ) {

	if ( ! is_array( $meta_box ) ) {
		return false;
	}

	$callback = create_function( '$post,$meta_box', 'york_create_meta_box( $post, $meta_box["args"] );' );

	add_meta_box( $meta_box['id'], $meta_box['title'], $callback, $meta_box['page'], $meta_box['context'], $meta_box['priority'], $meta_box );
}

/**
 * Create the various metaboxes
 */
function york_create_meta_box( $post, $meta_box ) {

	if ( ! is_array( $meta_box ) ) {
		return false;
	}

	wp_nonce_field( basename( __FILE__ ), 'york_meta_box_nonce' );

	echo '<table class="index-meta-table form-table">';

	foreach ( $meta_box['fields'] as $field ) {

		$meta = get_post_meta( $post->ID, $field['id'], true );

		echo '<tr><th><label for="'. esc_attr( $field['id'] ) .'" class="'. esc_attr( $field['id'] ) .'"><strong>'. esc_html( $field['name'] ) .'</strong><span>'. wp_kses( $field['desc'], array( 'a' => array( 'href' => array(), 'target' => array() ) ) ) .'</span></label></th>';

		switch ( $field['type'] ) {

			case 'text':
				echo '<td><input type="text" name="york_meta['. esc_attr( $field['id'] ) .']" id="'. esc_attr( $field['id'] ) .'" value="'. ( esc_attr( $meta ) ? esc_attr( $meta ) : esc_attr( $field['std'] ) ) .'" size="30" /></td>';
				break;

			case 'textarea':
				echo '<td><textarea name="york_meta['. esc_attr( $field['id'] ).']" id="'. esc_attr( $field['id'] ) .'" rows="7" cols="5">'. ( esc_attr( $meta ) ? esc_attr( $meta ) : esc_attr( $field['std'] ) ) .'</textarea></td>';
				break;

			case 'file': ?> 
				<script>
				jQuery(function($) {
					var frame;

					$('#<?php echo esc_js( $field['id'] ); ?>_button').on('click', function(e) {
						e.preventDefault();
						
						var options = {
							state: 'insert',
							frame: 'post'
						};

						frame = wp.media(options).open();
						
						// CUSTOMIZE VIEWS
						frame.menu.get('view').unset('gallery');
						frame.menu.get('view').unset('featured-image');
												
						frame.toolbar.get('view').set({
							insert: {
								style: 'primary',
								text: '<?php esc_js( 'Insert', '@@textdomain' ); ?>',
								click: function() {
									var models = frame.state().get('selection'),
									url = models.first().attributes.url;
									$('#<?php echo esc_js($field['id']); ?>').val( url );
									frame.close();
								}
							}
						});
					});
				});
				</script>
			<?php
			break;

			case 'images': ?>
				<script>
				jQuery(function($) {
					var frame,
						images = '<?php echo esc_js( get_post_meta( $post->ID, '_bean_image_ids', true ) ); ?>',
						selection = loadImages(images);

					$('#york_images_upload').on('click', function(e) {
						e.preventDefault();

						var options = {
							title: '<?php esc_html_e( 'Create Gallery', '@@textdomain' ); ?>',
							state: 'gallery-edit',
							frame: 'post',
							selection: selection
						};

						if( frame || selection ) {
							options['title'] = '<?php esc_html_e( 'Edit Gallery', '@@textdomain' ); ?>';
						}

						frame = wp.media(options).open();
						
						frame.menu.get('view').get('cancel').el.innerHTML = '<?php esc_html_e( 'Cancel', '@@textdomain' ); ?>';
						frame.menu.get('view').get('gallery-edit').el.innerHTML = '<?php esc_html_e( 'Edit Gallery', '@@textdomain' ); ?>';
						frame.content.get('view').sidebar.unset('gallery');

						overrideGalleryInsert();
						frame.on( 'toolbar:render:gallery-edit', function() {
							overrideGalleryInsert();
						});
						
						frame.on( 'content:render:browse', function( browser ) {
							if ( !browser ) return;

							browser.sidebar.on('ready', function(){
								browser.sidebar.unset('gallery');
							});

							browser.toolbar.on('ready', function(){
								if(browser.toolbar.controller._state == 'gallery-library'){
									browser.toolbar.$el.hide();
								}
							});
						});
						
						frame.state().get('library').on( 'remove', function() {
							var models = frame.state().get('library');
							if(models.length == 0){
								selection = false;
								$.post(ajaxurl, { ids: '', action: 'york_image_save', post_id: york_ajax.post_id, nonce: york_ajax.nonce });
							}
						});
						
						function overrideGalleryInsert() {
							frame.toolbar.get('view').set({
								insert: {
									style: 'primary',
									text: '<?php esc_html_e( 'Save Gallery', '@@textdomain' ); ?>',

									click: function() {
										var models = frame.state().get('library'),
											ids = '';

										models.each( function( attachment ) {
											ids += attachment.id + ','
										});

										this.el.innerHTML = '<?php esc_html_e( 'Saving&hellip;', '@@textdomain' ); ?>';
										
										$.ajax({
											type: 'POST',
											url: ajaxurl,
											data: { 
												ids: ids, 
												action: 'york_image_save', 
												post_id: york_ajax.post_id, 
												nonce: york_ajax.nonce 
											},
											success: function(){
												selection = loadImages(ids);
												$('#_bean_image_ids').val( ids );
												frame.close();
											},
											dataType: 'html'
										}).done( function( data ) {
											$('.index-meta-thumbnails').html( data );
										}); 
									}
								}
							});
						}
					});
					
					function loadImages( images ) {
						if( images ){
							var shortcode = new wp.shortcode({
								tag:    'gallery',
								attrs:   { ids: images },
								type:   'single'
							});
				
							var attachments = wp.media.gallery.attachments( shortcode );

							var selection = new wp.media.model.Selection( attachments.models, {
								props:    attachments.props.toJSON(),
								multiple: true
							});
			
							selection.gallery = attachments.gallery;
			
							// QUERY ATTACHMENTS
							// SORTING
							selection.more().done( function() {
								selection.props.set({ query: false });
								selection.unmirror();
								selection.props.unset('orderby');
							});
							
							return selection;
						}
						
						return false;
					}
					
				});
				</script>

				<?php
				$meta = get_post_meta( $post->ID, '_bean_image_ids', true );
				$thumbnail_output = '';
				$button_text = ($meta) ? esc_html__('Edit Gallery', '@@textdomain') : $field['std'];
				if( $meta ) {
					$field['std'] = esc_html__('Edit Gallery', '@@textdomain');
					$thumbs = explode(',', $meta);
					$thumbnail_output = '';
					foreach( $thumbs as $thumb ) {
						$thumbnail_output .= '<li>' . wp_get_attachment_image( $thumb, array(40,40) ) . '</li>';
					}
				}

				echo
					'<td>
						<input type="button" class="button" name="' . esc_attr( $field['id'] ). '" id="york_images_upload" value="' . esc_html( $button_text ) .'" />
						<input type="hidden" name="york_meta[_bean_image_ids]" id="_bean_image_ids" value="' . ( $meta ? $meta : 'false' ) . '" />
						<ul class="index-meta-thumbnails">' . $thumbnail_output . '</ul>
					</td>';
				
			break;
				
			case 'select':
				echo'<td><select name="york_meta['. $field['id'] .']" id="'. $field['id'] .'">';
				foreach( $field['options'] as $key => $option ){
					echo '<option value="' . $key . '"';
					if( $meta ){ 
						if( $meta == $key ) echo ' selected="selected"'; 
					} else {
						if( $field['std'] == $key ) echo ' selected="selected"'; 
					}
					echo'>'. $option .'</option>';
				}
				echo'</select></td>';
				break;
				
			case 'radio':
				echo '<td>';
				foreach( $field['options'] as $key => $option ){
					echo '<label class="radio-label"><input type="radio" name="york_meta['. $field['id'] .']" value="'. $key .'" class="radio"';
					if( $meta ){ 
						if( $meta == $key ) echo ' checked="checked"'; 
					} else {
						if( $field['std'] == $key ) echo ' checked="checked"';
					}
					echo ' /> '. $option .'</label> ';
				}
				echo '</td>';
				break;
			
			case 'color':
				if( array_key_exists('val', $field) ) $val = $field['val'];
				if( $meta ) $val = $meta;
				echo '<td class="index-box-'.$field['type'].'">';
				echo '<input data-default-color="'.$field['std'].'" type="text" id="'. $field['id'] .'" name="york_meta[' . $field['id'] .']" value="'.$val.'" class="colorpicker">';
				echo '</div>';
				echo '</td>';
				break;
				
			case 'checkbox':
				echo '<td>';
				$val = '';
				if( $meta ) {
					if( $meta == 'on' ) $val = ' checked="checked"';
				} else {
					if( $field['std'] == 'on' ) $val = ' checked="checked"';
				}

				echo '<input type="hidden" name="york_meta['. $field['id'] .']" value="off" />
				<input type="checkbox" id="'. $field['id'] .'" name="york_meta['. $field['id'] .']" value="on"'. $val .' /><span>'. esc_html__('Yes, please do', '@@textdomain') .'</span>';
				echo '</td>';
				break;
		}
		
		echo '</tr>';
	}
 
	echo '</table>';
}



/**
 * Save metaboxes
 */
function york_save_meta_box( $post_id ) {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return;
	
	if ( !isset($_POST['york_meta']) || !isset($_POST['york_meta_box_nonce']) || !wp_verify_nonce( $_POST['york_meta_box_nonce'], basename( __FILE__ ) ) )
		return;
	
	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) ) return;
	} else {
		if ( !current_user_can( 'edit_post', $post_id ) ) return;
	}
 
	foreach( $_POST['york_meta'] as $key=>$val ){
		update_post_meta( $post_id, $key, $val );
	}

}
add_action( 'save_post', 'york_save_meta_box' );



/**
 * Save images
 */
function york_image_save() {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! isset( $_POST['ids'] ) || !isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'index-ajax' ) )
		return;

	if ( ! current_user_can( 'edit_posts' ) ) {
		return;
	}

	$ids = strip_tags( rtrim( $_POST['ids'], ',' ) );
	update_post_meta( $_POST['post_id'], '_bean_image_ids', $ids );

	$thumbs = explode( ',', $ids );
	$thumbnail_output = '';

	foreach ( $thumbs as $thumb ) {
		$thumbnail_output .= '<li>' . wp_get_attachment_image( $thumb, array( 40,40 ) ) . '</li>';
	}

	echo balanceTags($thumbnail_output);

	die();
}

add_action( 'wp_ajax_york_image_save', 'york_image_save' );



/**
 * Scripts.
 */
function york_metabox_portfolio_scripts() {
	global $post;

	wp_enqueue_script( 'media-upload' );

	if ( isset( $post ) ) {
		wp_localize_script( 'jquery', 'york_ajax', array(
			'post_id' => $post->ID,
			'nonce' => wp_create_nonce( 'index-ajax' ),
		) );
	}
}

add_action( 'admin_enqueue_scripts', 'york_metabox_portfolio_scripts' );
