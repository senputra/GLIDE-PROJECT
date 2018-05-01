<?php
/**
 * Default theme options.
 *
 * @package Interserver Blog
 */

if ( ! function_exists( 'interserver_blog_get_default_theme_options' ) ) :
	/**
	 * Get default theme options
	 *
	 * @since 1.0.0
	 *
	 * @return array default theme options.
	 */
	function interserver_blog_get_default_theme_options() {
		$ib_defaults = array();
		
		/*======== Header Options ========*/
		// Site Layout
		$ib_defaults['site_layout'] = 'boxed';

		// Header Top Bar
		$ib_defaults['hide_header_topbar'] = '0';
		$ib_defaults['null'] = null;

		// Header Type
		$ib_defaults['slider_cat'] = '1';
		$ib_defaults['slider_post_order'] = 'desc';
		$ib_defaults['slider_post_orderby'] = 'none';
		$ib_defaults['slider_num_post'] = '3';
		
		// Header Slider
		$ib_defaults['hide_slider'] = null;
		$ib_defaults['hide_slider_caption'] = null;
		//$ib_defaults['fullwidth_slider'] = null;
		$ib_defaults['slider_height'] = 'full';
		$ib_defaults['slider_custom_height'] = '500';

	
		//Header Styles
		$ib_defaults['sticky_header'] = 'sticky';
		$ib_defaults['header_alignment'] = 'centered';
		
 		/*======== Blog Options ========*/
		//Layout
		$ib_defaults['post_layout'] = 'small_image';
		$ib_defaults['fullwidth_blog'] = '1';	
		$ib_defaults['fullwidth_single'] = null;	
		
		//Content/Excerpts
		$ib_defaults['full_content_home'] = null;
		$ib_defaults['full_content_archives'] = null;
		$ib_defaults['excerpt_length'] = '56';
		//Meta
		$ib_defaults['hide_meta_index'] = null;
		$ib_defaults['hide_meta_single'] = null;

		// Featured Images
		$ib_defaults['index_feat_image'] = null;
		$ib_defaults['post_feat_image'] = null;
	

		$ib_defaults['featured_cat'] = '1,2,3,4';

		/*======== Fonts ========*/
		// Logo Fonts
		$ib_defaults['logo_font_name'] = 'Pacifico:300,400,700,800';
		$ib_defaults['logo_font_family'] = '\'Pacifico\', sans-serif';

		// Body Fonts
		$ib_defaults['body_font_name'] = 'Roboto:400,500,600';
		$ib_defaults['body_font_family'] = '\'Roboto\', sans-serif';
		
		// Heading Fonts
		$ib_defaults['headings_font_name'] = 'Roboto+Slab:300,400,700,800';
		$ib_defaults['headings_font_family'] = '\'Roboto Slab\', serif';
		
		// Font Sizes
		$ib_defaults['site_title_size'] = '60';
		$ib_defaults['site_desc_size'] = '18';
		$ib_defaults['menu_size'] = '16';
		$ib_defaults['h1_size'] = '36';
		$ib_defaults['h2_size'] = '32';
		$ib_defaults['h3_size'] = '26';
		$ib_defaults['h4_size'] = '21';
		$ib_defaults['h5_size'] = '18';
		$ib_defaults['h6_size'] = '16';
		$ib_defaults['body_size'] = '14';
		
		/*======== Colors ========*/
		// Primary Color
		$ib_defaults['primary_color'] = '#000000';
		// Secondary Color
		$ib_defaults['secondary_color'] = '#d96e94';
		// Body Text Color
		$ib_defaults['body_text_color'] = '#333333';
		// Header Top Background Color
		$ib_defaults['header_top_bg'] = '#ffffff';
		// Header Background Color
		$ib_defaults['header_bg_color'] = '#ffffff';
		// Site Title Color
		$ib_defaults['site_title_color'] = '#333333';
		// Site Description Color
		$ib_defaults['site_desc_color'] = '#333333';
		// Menu Items Color
		$ib_defaults['menu_color'] = '#333333';
		// Menu Items Hover Color
		$ib_defaults['menu_hover_color'] = '#d96e94';
		// SubMenu Items Color
		$ib_defaults['submenu_color'] = '#ffffff';
		// Slider Text color
		$ib_defaults['slider_text_color'] = '#333333';	
		// Widgetized Footer Bottom background Color
		$ib_defaults['footer_widgets_background'] = '#ffffff';
		// Footer Widgets Title Color
		$ib_defaults['fw_title_color'] = '#333333';
		// Footer Widget Text Color
		$ib_defaults['fw_text_color'] = '#333333';
		// Footer Bottom background Color
		$ib_defaults['footer_bottom_background'] = '#d96e94';
		// Footer Bottom Text  color
		$ib_defaults['fb_text_color'] = '#ffffff';
		// Sidebar Widget Title Color
		$ib_defaults['sw_title_color'] = '#d96e94';
		// Sidebar Text Color
		$ib_defaults['sidebar_text_color'] = '#333333';
			
		/*======== Footer ========*/		
		// No. of Footer Widgets to display
		$ib_defaults['footer_widgets'] = 1;
		// Footer Copyright
		$ib_defaults['footer_copyright'] = esc_html__( '&copy; Copyright Interserver Theme 2018', 'interserver-blog');
		
		// Pass through filter.
		$ib_defaults = apply_filters( 'interserver_blog_filter_default_theme_options', $ib_defaults );
		return $ib_defaults;
	}
endif;

$ib_default = interserver_blog_get_default_theme_options();