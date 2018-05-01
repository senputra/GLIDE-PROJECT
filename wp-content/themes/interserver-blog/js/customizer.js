/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				} );
			}
		} );
	} );

	//Primary Color
	wp.customize('primary_color',function( value ) {
		value.bind( function( newval ) {
			$('input[type=\"button\"], input[type=\"reset\"], input[type=\"submit\"]').css('background-color', newval );
		} );
	});
	//Secondary Color
	wp.customize('secondary_color',function( value ) {
		value.bind( function( newval ) {
			$('.site-header.sticky.fixed').css('background-color', newval );
		} );
	});

	//Top Header Background
	wp.customize('header_top_bg',function( value ) {
		value.bind( function( newval ) {
			$('.header-top-wrapper').css('background-color', newval );
		} );
	});
	//Header Background
	wp.customize('header_bg_color',function( value ) {
		value.bind( function( newval ) {
			$('.site-header').css('background-color', newval );
		} );
	});

	//Site title
	wp.customize('site_title_color',function( value ) {
		value.bind( function( newval ) {
			$('.site-title a').css('color', newval );
		} );
	});
	//Site desc
	wp.customize('site_desc_color',function( value ) {
		value.bind( function( newval ) {
			$('.site-description').css('color', newval );
		} );
	});
	//Top level menu items
	wp.customize('top_items_color',function( value ) {
		value.bind( function( newval ) {
			$('#mainnav ul li a').not('#mainnav .sub-menu li a').css('color', newval );
		} );
	});	
	//Sub-menu items
	wp.customize('submenu_items_color',function( value ) {
		value.bind( function( newval ) {
			$('#mainnav .sub-menu li a ').css('color', newval );
		} );
	});
	//Slider text
	wp.customize('slider_text',function( value ) {
		value.bind( function( newval ) {
			$('.text-slider .maintitle, .text-slider .subtitle').css('color', newval );
		} );
	});	
	// Body text color
	wp.customize('body_text_color',function( value ) {
		value.bind( function( newval ) {
			$('body').css('color', newval );
		} );
	});		
	//Sidebar Title color
	wp.customize('sw_title_color',function( value ) {
		value.bind( function( newval ) {
			$('#secondary .widget-title').css('color', newval );
			$('#secondary .widget').css('border-color', newval );
		} );
	});
	//Sidebar Text color
	wp.customize('sidebar_text_color',function( value ) {
		value.bind( function( newval ) {
			$('#secondary, #secondary a, #secondary .widget ul li::before').css('color', newval );
		} );
	});
	//Footer widgets background
	wp.customize('footer_widgets_background',function( value ) {
		value.bind( function( newval ) {
			$('.footer-widgets').css('background-color', newval );
		} );
	});	
	//Footer widgets title color
	wp.customize('fw_title_color',function( value ) {
		value.bind( function( newval ) {
			$('#footer-widgets .widget-title').css('color', newval );
		} );
	});	

	//Footer widgets text color
	wp.customize('fw_text_color',function( value ) {
		value.bind( function( newval ) {
			$('.footer-widgets, #footer-widgets a, #footer-widgets .widget ul li::before').css('color', newval );
		} );
	});	
	//Footer Bottom background
	wp.customize('footer_bottom_background',function( value ) {
		value.bind( function( newval ) {
			$('.footer-bottom').css('background-color', newval );
		} );
	});
	//Footer Bottom text color
	wp.customize('fb_text_color',function( value ) {
		value.bind( function( newval ) {
			$('.footer-bottom,.footer-bottom .social-icons a').css('color', newval );
		} );
	});	

	//Footer color
	wp.customize('footer_color',function( value ) {
		value.bind( function( newval ) {
			$('.site-footer,.site-footer a').css('color', newval );
		} );
	});

} )( jQuery );

jQuery(document).ready(function() {
 var obj = jQuery('#customize-control-featured_cat').find("select");
    jQuery(obj).change(function(event) {
    if(jQuery("select option:selected").length > 3) { 
     alert('You can select upto 3 options only');
     jQuery(this).removeAttr("selected");
  }
});






});