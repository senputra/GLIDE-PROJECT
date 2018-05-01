jQuery(document).ready(function() {
//Preloader
jQuery(window).load(function() {
    // Animate loader off screen
  jQuery(".ib-loader").fadeOut("slow");;

});
});

jQuery(window).load(function() {
	"use strict";
	if( jQuery( '#slider' ).length > 0 ){
	jQuery('.nivoSlider').nivoSlider({
	effect:'fold',
	animSpeed:300,
  pauseTime:1000,
  startSlide:0,
  directionNav:true,
	pauseOnHover:false,
	manualAdvance: false,
	});
	}
});
 
jQuery(document).ready(function() {
  jQuery('.site-title a').each(function(index, element) {
    var heading = jQuery(element);
    var word_array, last_word, first_part;
    word_array = heading.html().split(/\s+/); // split on spaces
    last_word = word_array.pop();             // pop the last word
    first_part = word_array.join(' ');        // rejoin the first words together
    heading.html([first_part, ' <span class="last-word">', last_word, '</span>'].join(''));
  });    
});

jQuery(window).scroll(function() {
  "use strict";
   var scroll = jQuery(window).scrollTop(); 
    if (scroll >= 180) {
        jQuery(".site-header").addClass("fixed");
	 }
	 else {
        jQuery(".site-header").removeClass("fixed");
    }

	if (scroll >= 1000) {
        jQuery('.scrollup').addClass('show');
	 } else {
        jQuery('.scrollup').removeClass('show');
    }
	
});
jQuery('.scrollup').on('click', function() {
			jQuery("html, body").animate({ scrollTop: 0 }, 1000);
			return false;
});
( function( $ ) {
	 if (header_style == "inline"){
		 jQuery(".site-header").addClass("header-inline");
	 }else {
         jQuery(".site-header").removeClass("header-inline");
    }

} )( jQuery );

  jQuery(document).ready(function(){
          jQuery('.load_more a').live('click', function(e){
              e.preventDefault();
              var link = jQuery(this).attr('href');
              jQuery('.load_more').html('<span class="loader"><i class="fa fa-spinner fa-spin" style="font-size:1.5em"></i>Loading More Posts...</span>');
              jQuery.get(link, function(data) {
                  var post = jQuery("#posts .post ", data);
                  jQuery('#posts').append(post);
              });

              jQuery('.load_more').load(link+' .load_more a');

          });

      });