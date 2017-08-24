( function( api ) {

	// Extends our custom "upgrade-theme" section.
	api.sectionConstructor['upgrade-theme'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
