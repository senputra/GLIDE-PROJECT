jQuery(function($){

	$(".delete-notice").click(function(el){
		el.preventDefault();
		var data = {
			_ajax_nonce: brand_notice.nonce,
			action: 'brand_delete_notice',
			notice: brand_notice.notice,
		};

		$.post(brand_notice.ajaxurl, data, function(res) {
			if( ! res.error) {
				$('.' + brand_notice.notice).remove();
			} else {
				console.log('There was an error on deleting notice');
			}
		}).fail(function(xhr, textStatus, e) {
			console.log(xhr.responseText);
		});
	});

});
