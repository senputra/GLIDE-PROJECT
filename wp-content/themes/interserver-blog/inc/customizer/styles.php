<?php
/**
 * @package Interserver Blog
 */
 
/* Convert hexdec color string to rgb(a) string */
 function interserver_blog_hex2rgba($color, $opacity = false) {
 	$def = 'rgb(0,0,0)';
		//Return ib_default if no color provided
		if(empty($color))
          	return $def; 
 		//Sanitize $color if "#" is provided 
        	if ($color[0] == '#' ) {
        		$color = substr( $color, 1 );
       	}
       	//Check if color has 6 or 3 characters and get values
        	if (strlen($color) == 6) {
                	$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        	} elseif ( strlen( $color ) == 3 ) {
                	$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        	} else {
                	return $def;
        }
		$rgb =  array_map('hexdec', $hex);
        $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        return $output;
 }
 
/* Dynamix style with customizer setting */
function interserver_blog_custom_styles($custom_css){
	global $ib_default;
	$custom_css ='';
	/*==================== Header ====================*/

	//Header Slider 
	$slider_height = get_theme_mod('slider_height', $ib_default['slider_height']);
	$slider_custom_height = get_theme_mod('slider_custom_height', $ib_default['slider_custom_height']);
	if($slider_height != $ib_default['slider_height'] ){
		$custom_css .= "#slider{ height:" . intval($slider_custom_height) . "px; }"."\n";
	}

	// Header Style
	$sticky_header = get_theme_mod('sticky_header',$ib_default['sticky_header']);
	if( $sticky_header != $ib_default['sticky_header'] ){
			$custom_css .= ".site-header.static{ position:fixed; }"."\n";
	}

	/*==================== Fonts ====================*/
	$logo_fonts = get_theme_mod('logo_font_family', $ib_default['logo_font_family']);	
	$body_fonts = get_theme_mod('body_font_family', $ib_default['body_font_family']);	
	$headings_fonts = get_theme_mod('headings_font_family', $ib_default['headings_font_family'] );
	if ( $logo_fonts ) {
		$custom_css .= ".site-title a,header.fixed .site-title{ font-family:" . esc_attr($logo_fonts) . ";}"."\n";
	}
	if ( $body_fonts ) {
		$custom_css .= "body,button,input,select,textarea,.site-description { font-family:" . esc_attr($body_fonts) . ";}"."\n";
	}
	if ( $headings_fonts ) {
		$custom_css .= "input[type=\"button\"], input[type=\"reset\"], input[type=\"submit\"], #secondary .widget-title, h1, h2, h3, h4, h5, h6, #cssmenu > ul > li > a,.nivoSlider .nivo-caption,.read-more a,.null-instagram-feed .widget-title,.load_more a, .load_more .loader,.overlay span, .fourofour { font-family:" . esc_attr($headings_fonts) . ";}"."\n";
	}
	
    //Site title
    $site_title_size = get_theme_mod( 'site_title_size', $ib_default['site_title_size'] );
    if ($site_title_size) {
        $custom_css .= ".site-title { font-size:" . intval($site_title_size) . "px; }"."\n";
    }
    //Site description
    $site_desc_size = get_theme_mod( 'site_desc_size', $ib_default['site_desc_size'] );
    if ($site_desc_size) {
        $custom_css .= ".site-description { font-size:" . intval($site_desc_size) . "px; }"."\n";
    }
    //Menu
    $menu_size = get_theme_mod( 'menu_size',  $ib_default['menu_size'] );
    if ($menu_size) {
        $custom_css .= "#cssmenu ul li a { font-size:" . intval($menu_size) . "px; }"."\n";
    }    	    	
	//H1 size
	$h1_size = get_theme_mod( 'h1_size', $ib_default['h1_size'] );
	if ($h1_size) {
		$custom_css .= "h1{ font-size:" . intval($h1_size) . "px; }"."\n";
	}
    //H2 size
    $h2_size = get_theme_mod( 'h2_size', $ib_default['h2_size'] );
    if ($h2_size) {
        $custom_css .= "h2{ font-size:" . intval($h2_size) . "px; }"."\n";
    }
    //H3 size
    $h3_size = get_theme_mod( 'h3_size', $ib_default['h3_size'] );
    if ($h3_size) {
        $custom_css .= "h3{ font-size:" . intval($h3_size) . "px; }"."\n";
    }
    //H4 size
    $h4_size = get_theme_mod( 'h4_size', $ib_default['h4_size'] );
    if ($h4_size) {
        $custom_css .= "h4{ font-size:" . intval($h4_size) . "px; }"."\n";
    }
    //H5 size
    $h5_size = get_theme_mod( 'h5_size', $ib_default['h5_size'] );
    if ($h5_size) {
        $custom_css .= "h5{ font-size:" . intval($h5_size) . "px; }"."\n";
    }
    //H6 size
    $h6_size = get_theme_mod( 'h6_size', $ib_default['h6_size'] );
    if ($h6_size) {
        $custom_css .= "h6{ font-size:" . intval($h6_size) . "px; }"."\n";
    }
    //Body size
    $body_size = get_theme_mod( 'body_size', $ib_default['body_size'] );
    if ($body_size) {
        $custom_css .= "body { font-size:" . intval($body_size) . "px;}"."\n";
    }
	
	
	/*==================== Colors ====================*/
	// Primary color
	$primary_color = get_theme_mod( 'primary_color', $ib_default['primary_color']);
	if($primary_color){
		$custom_css .= "input[type=\"button\"], input[type=\"reset\"], input[type=\"submit\"]{ background-color:" . esc_attr($primary_color) . "}"."\n";
		$custom_css .= ".ip-btn:hover,#btn-scrollup:hover,.nav-links a:hover {background:" . esc_attr($primary_color) . "}"."\n";
		$custom_css .= "a:hover, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,.social-icons a, .footer-bottom .social-icons a:hover{color:" . esc_attr($primary_color) . "}"."\n";
		$custom_css .= ".mainnav {border-color:" . esc_attr($primary_color) . "}"."\n";
	}

	// Secondary color
	$secondary_color = get_theme_mod( 'secondary_color', $ib_default['secondary_color']);
	if($secondary_color){
		$custom_css .="a, .page-title span,.search-form:hover i, #secondary a:hover, h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover, .social-icons a:hover,cat-links a.post-cat, .byline, .hentry .post-cat a:hover, .fourofour { color:" . esc_attr($secondary_color) . "}"."\n";		
		$custom_css .="input[type=\"button\"]:hover, input[type=\"reset\"]:hover, input[type=\"submit\"]:hover,.slide-inner .cta-button,.ip-loader{ background-color: " . esc_attr($secondary_color). " }"."\n";
		$custom_css .= ".ip-btn,#btn-scrollup,.nav-links a {background:" . esc_attr($secondary_color) . "}"."\n";
			
	}

	//Body
	$body_text = get_theme_mod( 'body_text_color', $ib_default['body_text_color'] );
	if ($body_text) {
		$custom_css .= "body { color:" . esc_attr($body_text) . "}"."\n";
	}
	// Header Top Background Color
	$header_top_bg = get_theme_mod( 'header_top_bg', $ib_default['header_top_bg'] );
	if ($header_top_bg) {
		$custom_css .= ".header-top-wrapper { background-color:" . esc_attr($header_top_bg) . "}"."\n";
	}

	// Header Background Color
	$header_bg_color = get_theme_mod( 'header_bg_color', $ib_default['header_bg_color'] );
	$hbcrgba_1 = interserver_blog_hex2rgba($header_bg_color, 1);
	$hbcrgba_2 = interserver_blog_hex2rgba($secondary_color, 1);
	if ($header_bg_color) {
		$custom_css .= ".site-header { background-color:" . esc_attr($hbcrgba_1) . "}"."\n"; 
		$custom_css .= ".site-header.sticky.fixed{ background-color:" . esc_attr($hbcrgba_2) . "}"."\n"; 
	}
	// Slider Text color
	$slider_text_color = get_theme_mod( 'slider_text_color',$ib_default['slider_text_color']);
	if ($slider_text_color) {
		$custom_css .= ".nivo-caption .slider-title{ color:" . esc_attr($slider_text_color) . "}"."\n";	
	}
	//Site title
	$site_title_color = get_theme_mod( 'site_title_color', $ib_default['site_title_color'] );
		$custom_css .= ".site-title a, .site-title a:hover { color:" . esc_attr($site_title_color) . "}"."\n";

	//Site desc
	$site_desc = get_theme_mod( 'site_desc_color', $ib_default['site_desc_color'] );
	if ($site_desc) {
		$custom_css .= ".site-description { color:" . esc_attr($site_desc) . "}"."\n";
	}
	//Menu items color
	$menu_color = get_theme_mod( 'menu_color', $ib_default['menu_color'] );
	if ($menu_color) {
		$custom_css .= "#cssmenu ul li a {color:" . esc_attr($menu_color).";}"."\n";
	}
	//Menu items hover
	$menu_hover_color = get_theme_mod( 'menu_hover_color', $ib_default['menu_hover_color'] );
	if ($menu_hover_color) {
		$custom_css .= "#cssmenu ul li a:hover,.header_info a:hover { color:" . esc_attr($menu_hover_color) . "}"."\n";	
	}
	//Sub menu items color
	$submenu_color = get_theme_mod( 'submenu_color', $ib_default['submenu_color'] );
	if ($submenu_color) {
		$custom_css .= "#cssmenu .sub-menu li a, #cssmenu .sub-menu li a:hover { color:" . esc_attr($submenu_color) . "}"."\n";
	}
	
	//Footer widget area background
	$fw_background = get_theme_mod( 'footer_widgets_background', $ib_default['footer_widgets_background'] );
	if ($fw_background) {
		$custom_css .= ".footer-widgets { background-color:" . esc_attr($fw_background) . "}"."\n";	
	}
	//Footer widget title color
	$fw_title_color = get_theme_mod( 'fw_title_color', $ib_default['fw_title_color'] );
	if ($fw_title_color) {
		$custom_css .= "#footer-widgets .widget-title {color:" . esc_attr($fw_title_color) . "}"."\n";
	}
	//Footer widget text color
	$fw_text_color = get_theme_mod( 'fw_text_color', $ib_default['fw_text_color'] );
	if ($fw_text_color) {
		$custom_css .= ".footer-widgets, #footer-widgets a,#footer-widgets .widget ul li::before{ color:" . esc_attr($fw_text_color) . "}"."\n";	
	}
	//Footer Bottom background
	$footer_bottom_background = get_theme_mod( 'footer_bottom_background', $ib_default['footer_bottom_background'] );
	if ($footer_bottom_background) {
		$custom_css .= ".footer-bottom{ background-color:" . esc_attr($footer_bottom_background) . "}"."\n";	
	}
	//Footer Bottom text color
	$fb_text_color = get_theme_mod( 'fb_text_color', $ib_default['fb_text_color'] );
	if ($fb_text_color) {
		$custom_css .= ".footer-bottom, .footer-bottom .social-icons a{ color:" . esc_attr($fb_text_color) . "}"."\n";	
	}
	
	//Sidebar widget title color
	$sw_title_color = get_theme_mod( 'sw_title_color', $ib_default['sw_title_color'] );
	if ($sw_title_color) {
		$custom_css .= "#secondary .widget-title{ color:" . esc_attr($sw_title_color) . "}"."\n";	
		$custom_css .= "#secondary .widget { border-color:" . esc_attr($sw_title_color) . "}"."\n";	
	}
	//Sidebar color
	$sidebar_text_color = get_theme_mod( 'sidebar_text_color', $ib_default['sidebar_text_color']);
	if ($sidebar_text_color) {
		$custom_css .= "#secondary, #secondary a, #secondary_color .widget ul li::before{ color:" . esc_attr($sidebar_text_color) . "}"."\n";	
	}

    ?>
	<style type="text/css">
	<?php echo $custom_css;?>
	</style>
    <?php }
add_action( 'wp_head', 'interserver_blog_custom_styles' );