/**
 * Pro links and badges that output on the Customizer.
 */

( function( $ ) {
	
	if ('undefined' !== typeof themebeans_pro_L10n) {
		// Add a upgrade button to the Customizer header.
		upsell = $('<a class="themebeans-pro-upsell-link button-primary"></a>')
			.attr('href', themebeans_pro_L10n.themebeans_pro_url)
			.attr('target', '_blank')
			.text(themebeans_pro_L10n.themebeans_pro_label)
			.css({
				'margin-top' : '9px',
				'clear' : 'both',
			})
		;

		setTimeout(function () {
			$('#customize-info .preview-notice').append(upsell);
		}, 200);

		// Remove accordion click event
		$('.themebeans-pro-upsell-link').on('click', function(e) {
			e.stopPropagation();
		});
}

} )( jQuery );