( function( api ) {

	// Extends our custom "triumph-seo" section.
	api.sectionConstructor['triumph-seo'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
