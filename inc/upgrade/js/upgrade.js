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

		// Add a mini-tag to pro sections of the Customizer.
		upsellMini = $('<span class="themebeans-pro-upgrade-link"></span>')
			.text(themebeans_pro_L10n.themebeans_pro_minilabel)
			.css({
				'display' : 'inline-block',
				'background-color' : '#a0a5aa',
				'border-radius' : '2px',
				'color' : '#fff',
				'text-transform' : 'uppercase',
				'margin-top' : '0',
				'padding' : '4px 5px 4px 6px',
				'font-size': '9px',
				'letter-spacing': '1px',
				'line-height': '1.5',
				'clear' : 'both',
				'float' : 'right',
				'margin-right' : '10px'
			})
		;
 
		setTimeout(function () {
			$('#accordion-section-charmed_pro_typography h3, #accordion-section-charmed_pro_colors h3, #accordion-section-charmed_theme_options_contact h3, #accordion-section-charmed_pro_portfolio h3, #accordion-section-charmed_pro_portfolio_cta h3').append(upsellMini);
		}, 200);

}

} )( jQuery );