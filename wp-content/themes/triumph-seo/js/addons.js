(function( $ ) {

	'use strict';

	$(function() {

		var data = {};
		data.triumphseo_plugins_list = 'yes';
		$.ajax({
			url: document.URL,
			cache: false,
			type: "get",
			data: data,
			success: function(response) {

				if( $( response ).find('.triumphseo-addons-list').length > 0 ) {

					$('.triumphseo-addons-list').replaceWith( $( response ).find('.triumphseo-addons-list') );
				}
			}
		});
	});

})( jQuery );
