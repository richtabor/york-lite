jQuery( document ).ready( function($) {
    
    
    //COLORPICKER
    $('.colorpicker').each(function(){
      $(this).wpColorPicker();
    });
    

    //POST FORMAT METABOX SWITCH
    var $linkSettings  = $('#bean-meta-box-link').hide(),
        $audioSettings = $('#bean-meta-box-audio').hide(),
        $gallerySettings = $('#bean-meta-box-gallery').hide(),
        $quoteSettings = $('#bean-meta-box-quote').hide(),
        $postFormat    = $('#post-formats-select input[name="post_format"]');
    $postFormat.each(function() {
        var $this = $(this);
        if( $this.is(':checked') )
            changePostFormat( $this.val() );
    });

    $postFormat.change(function() {
        changePostFormat( $(this).val() );
    });

    function changePostFormat( val ) {
        $linkSettings.hide();
        $audioSettings.hide();
        $gallerySettings.hide();
        $quoteSettings.hide();

        if( val === 'link' ) {
            $linkSettings.show();
        } else if( val === 'audio' ) {
            $audioSettings.show();
        } else if( val === 'image' ) {
            $gallerySettings.show();
        } else if( val === 'gallery' ) {
            $gallerySettings.show();
        } else if( val === 'quote' ) {
            $quoteSettings.show();
        }
    }


    //PORTFOLIO FORMAT METABOX CHECKBOXES
    var  displayGallery = $('#_bean_portfolio_type_gallery'),
        displayAudio = $('#_bean_portfolio_type_audio'),

        portfolioGalleryType = $('#bean-meta-box-portfolio-images'),
        portfolioAudioType = $('#bean-meta-box-portfolio-audio');


    portfolioGalleryType.css('display', 'none');
    portfolioAudioType.css('display', 'none');

    if( displayGallery.is(':checked') ) portfolioGalleryType.css('display', 'block');
    if( displayAudio.is(':checked') ) portfolioAudioType.css('display', 'block');

    displayGallery.click(function(e) {
        if( $(this).is(':checked') ) portfolioGalleryType.css('display', 'block');
        else portfolioGalleryType.css('display', 'none');
    });

    displayAudio.click(function(e) {
        if( $(this).is(':checked') ) portfolioAudioType.css('display', 'block');
        else portfolioAudioType.css('display', 'none');
    });


    //FULLSCREEN SLIDESHOW SETTING
    var portfolioTypeTrigger = jQuery('#_bean_portfolio_layout'),
        $portfolioSlideshow = $('#bean-meta-box-portfolio-slideshow').hide(),
        currentType = portfolioTypeTrigger.val();
    
    changePortfolioFormat(currentType);
        
    portfolioTypeTrigger.change( function() {
       currentType = jQuery(this).val();
       changePortfolioFormat(currentType); 
    });

    $postFormat.change(function() {
        changePortfolioFormat( $(this).val() );
    });

    function changePortfolioFormat( val ) {
        $portfolioSlideshow.hide();

        if( val === 'fullscreen' ) {
            $portfolioSlideshow.show();
        } 
    }
}); 