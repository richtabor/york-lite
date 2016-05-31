/**
 * Widgets - Media Upload
 */
jQuery( document ).ready( function() {

    // Upload / Change Image
    function widget_image_upload( button_class ) {
        
        var _custom_media = true,
            _orig_send_attachment = wp.media.editor.send.attachment;

        jQuery( 'body' ).on( 'click', button_class, function(e) {

            var button_id           = '#' + jQuery( this ).attr( 'id' ),
                self                = jQuery( button_id),
                send_attachment_bkp = wp.media.editor.send.attachment,
                button              = jQuery( button_id ),
                id                  = button.attr( 'id' ).replace( '-button', '' );

            _custom_media = true;

            wp.media.editor.send.attachment = function( props, attachment ){

                if ( _custom_media ) {

                    jQuery( '#' + id + '-preview'  ).attr( 'src', attachment.url ).css( 'display', 'block' );
                    jQuery( '#' + id + '-remove'  ).css( 'display', 'inline-block' );
                    jQuery( '#' + id + '-noimg' ).css( 'display', 'none' );
                    jQuery( '#' + id ).val( attachment.url ).trigger( 'change' );  

                } else {

                    return _orig_send_attachment.apply( button_id, [props, attachment] );

                }
            }

            wp.media.editor.open( button );

            return false;
        });
    }
    widget_image_upload( '.widget-media-upload' );

    // Remove Image
    function widget_image_remove( button_class ) {

        jQuery( 'body' ).on( 'click', button_class, function(e) {

            var button              = jQuery( this ),
                id                  = button.attr( 'id' ).replace( '-remove', '' );

            jQuery( '#' + id + '-preview' ).css( 'display', 'none' );
            jQuery( '#' + id + '-noimg' ).css( 'display', 'block' );
            button.css( 'display', 'none' );
            jQuery( '#' + id ).val( '' ).trigger( 'change' );

        });
    }
    widget_image_remove( '.widget-media-remove' );

});

/*global window,jQuery,wp */
var MediaModal = function (options) {
  'use strict';
  this.settings = {
    calling_selector: false,
    cb: function (attachment) {}
  };
  var that = this,
  frame = wp.media.frames.file_frame;

  this.attachEvents = function attachEvents() {
    jQuery(this.settings.calling_selector).on('click', this.openFrame);
  };

  this.openFrame = function openFrame(e) {
    e.preventDefault();

    // Create the media frame.
    frame = wp.media.frames.file_frame = wp.media({
      title: jQuery(this).data('uploader_title'),
      button: {
        text: jQuery(this).data('uploader_button_text')
      },
      library : {
        type : 'image'
      }
    });
        
    // Set filterable state to uploaded to get select to show (setting this
    // when creating the frame doesn't work)
    frame.on('toolbar:create:select', function(){
      frame.state().set('filterable', 'uploaded');
    });

    // When an image is selected, run the callback.
    frame.on('select', function () {
      // We set multiple to false so only get one image from the uploader
      var attachment = frame.state().get('selection').first().toJSON();
      that.settings.cb(attachment);
    });

    frame.on('open activate', function() {
      // Get the link/button/etc that called us
      var $caller = jQuery(that.settings.calling_selector);

      // Select the thumbnail if we have one
      if ($caller.data('thumbnail_id')) {
        var Attachment = wp.media.model.Attachment;
        var selection = frame.state().get('selection');
        selection.add(Attachment.get($caller.data('thumbnail_id')));
      }
    });
        
    frame.open();
  };

  this.init = function init() {
    this.settings = jQuery.extend(this.settings, options);
    this.attachEvents();
  };
  this.init();

  return this;
};

window.MultiPostThumbnails = {
    
    setThumbnailHTML: function(html, id, post_type){
        jQuery('.inside', '#' + post_type + '-' + id).html(html);
    },

    setThumbnailID: function(thumb_id, id, post_type){
        var field = jQuery('input[value=_' + post_type + '_' + id + '_thumbnail_id]', '#list-table');
        if ( field.size() > 0 ) {
            jQuery('#meta\\[' + field.attr('id').match(/[0-9]+/) + '\\]\\[value\\]').text(thumb_id);
        }
    },

    removeThumbnail: function(id, post_type, nonce){
        jQuery.post(ajaxurl, {
            action:'set-' + post_type + '-' + id + '-thumbnail', post_id: jQuery('#post_ID').val(), thumbnail_id: -1, _ajax_nonce: nonce, cookie: encodeURIComponent(document.cookie)
        }, function(str){
            if ( str == '0' ) {
                //alert( setPostThumbnailL10n.error );
            } else {
                MultiPostThumbnails.setThumbnailHTML(str, id, post_type);
            }
        }
        );
    },


    setAsThumbnail: function(thumb_id, id, post_type, nonce){
        var $link = jQuery('a#' + post_type + '-' + id + '-thumbnail-' + thumb_id);
        $link.data('thumbnail_id', thumb_id);
        //$link.text( setPostThumbnailL10n.saving );
        jQuery.post(ajaxurl, {
            action:'set-' + post_type + '-' + id + '-thumbnail', post_id: post_id, thumbnail_id: thumb_id, _ajax_nonce: nonce, cookie: encodeURIComponent(document.cookie)
        }, function(str){
            var win = window.dialogArguments || opener || parent || top;
            //$link.text( setPostThumbnailL10n.setThumbnail );
            if ( str == '0' ) {
                //alert( setPostThumbnailL10n.error );
            } else {
                $link.show();
                //$link.text( setPostThumbnailL10n.done );
                $link.fadeOut( 2000, function() {
                    jQuery('tr.' + post_type + '-' + id + '-thumbnail').hide();
                });
                win.MultiPostThumbnails.setThumbnailID(thumb_id, id, post_type);
                win.MultiPostThumbnails.setThumbnailHTML(str, id, post_type);
            }
        }
        );
    }
}
