<?php
/**
 * The header for our theme.
 *
 * Displays al the options in the customizer
 *
 * @package Interserver Blog
 */

/*====================== Site Layout ======================*/
$wp_customize->add_section( 'site_layout_sec',
        array(
        'title'      => esc_html__( 'Site Layout', 'interserver-blog' ),
        'capability' => 'edit_theme_options',
        )
    );
    

 $wp_customize->add_setting(
        'site_layout',
        array(
            'default'           => $ib_default['site_layout'],
            'sanitize_callback' => 'interserver_blog_sanitize_site_layout',
        )
    );
    $wp_customize->add_control(
        'site_layout',
        array(
            'type'      => 'radio',
            'priority'  => 29,
            'label'     => __('Site Layout', 'interserver-blog'),
            'section'   => 'site_layout_sec',
            'choices'   => array(
                'boxed'     => __('Boxed', 'interserver-blog'),
                'fullwidth'   => __('Fullwidth', 'interserver-blog'),
            ),
        )
    );
 
/*====================== Header Options ======================*/
   	$wp_customize->add_panel( 'header_options', array(
			'priority'       => 30,
			'capability'     => 'edit_theme_options',
			'title'          => esc_html__('Header Options', 'interserver-blog'),
			'description'    => __('Several settings pertaining my theme', 'interserver-blog'),
	 ) );
	
	/*--------------- Header Top Bar---------------*/
	$wp_customize->add_section( 'header_top_bar',
		array(
		'title'      => esc_html__( 'Header Top Bar', 'interserver-blog' ),
		'capability' => 'edit_theme_options',
		'panel'      => 'header_options',
		)
	);
	
	 $wp_customize->add_setting(
        'hide_header_topbar',
        array(
			'default'    => $ib_default['hide_header_topbar'],
            'sanitize_callback' => 'interserver_blog_sanitize_checkbox',
        )       
    );
    $wp_customize->add_control(
        'hide_header_topbar',
        array(
            'type'      => 'checkbox',
            'label'     => __('Hide Header Top Bar?', 'interserver-blog'),
            'section'   => 'header_top_bar',
        )
    );

/*--------------- Header Style ---------------*/
    $wp_customize->add_section( 'header_style',
        array(
        'title'      => esc_html__( 'Header Style', 'interserver-blog' ),
        'capability' => 'edit_theme_options',
        'panel'      => 'header_options',
        )
    );

    //Sticky header
    $wp_customize->add_setting(
        'sticky_header',
        array(
            'default'           => $ib_default['sticky_header'],
            'sanitize_callback' => 'interserver_blog_sanitize_sticky_header',
        )
    );
    $wp_customize->add_control(
        'sticky_header',
        array(
            'type' => 'radio',
            'priority'    => 10,
            'label' => __('Sticky Header', 'interserver-blog'),
            'section' => 'header_style',
            'choices' => array(
                'sticky'   => __('Sticky', 'interserver-blog'),
                'static'   => __('Static', 'interserver-blog'),
            ),
        )
    );
    //Header Style
    $wp_customize->add_setting(
        'header_alignment',
        array(
            'default'           => $ib_default['header_alignment'],
            'sanitize_callback' => 'interserver_blog_sanitize_header_alignment',
        )
    );
    $wp_customize->add_control(
        'header_alignment',
        array(
            'type'      => 'radio',
            'priority'  => 11,
            'label'     => __('Header Alignment', 'interserver-blog'),
            'section'   => 'header_style',
            'choices'   => array(
                'inline'     => __('Inline', 'interserver-blog'),
                'centered'   => __('Centered (menu and site logo)', 'interserver-blog'),
            ),
        )
    );
     /*----------------- Slider Options ------------------*/
    $wp_customize->add_section('slider_options',
        array(
            'title'         => __('Slider Options', 'interserver-blog'),
            'priority'      => 31
        )
    );

    $wp_customize->add_setting(
        'hide_slider',
        array(
            'default' => $ib_default['hide_slider'],
            'sanitize_callback' => 'interserver_blog_sanitize_checkbox',
        )       
    );
    $wp_customize->add_control(
        'hide_slider',
        array(
            'type'      => 'checkbox',
            'label'     => __('Check to Hide Slider', 'interserver-blog'),
            'section'   => 'slider_options',
        )
    );

    $wp_customize->add_setting(
        'hide_slider_caption',
        array(
            'default' => $ib_default['hide_slider_caption'],
            'sanitize_callback' => 'interserver_blog_sanitize_checkbox',
        )       
    );
    $wp_customize->add_control(
        'hide_slider_caption',
        array(
            'type'      => 'checkbox',
            'label'     => __('Check to Hide Slider Caption', 'interserver-blog'),
            'section'   => 'slider_options',
        )
    );

    $wp_customize->add_setting('slider_cat', array(
        'default' => $ib_default['slider_cat'],
        'sanitize_callback' => 'interserver_blog_sanitize_integer',
    ));

    $wp_customize->add_control(new Interserver_Blog_Category_Control($wp_customize,'slider_setting', array(
        'label' => __('Select Category', 'interserver-blog'),
        'description'   => __('You can show a particular category posts to be displayed in a Slider', 'interserver-blog'),
        'section' => 'slider_options',
        'settings' => 'slider_cat'
        )
   ));

    $wp_customize->add_setting('slider_post_order', array(
        'default' => $ib_default['slider_post_order'],
        'sanitize_callback' => 'interserver_blog_sanitize_post_order',
    ));

    $wp_customize->add_control('slider_post_order', array(
        'type' => 'select',
        'label' => __('Post Order', 'interserver-blog'),
        'description' => __('Select Post Order', 'interserver-blog'),
        'section' => 'slider_options',
        'settings' => 'slider_post_order',
        'choices' => array(
            'asc' => esc_attr__('Ascending', 'interserver-blog'),
            'desc' => esc_attr__('Descending', 'interserver-blog'),
        )
   ));

    $wp_customize->add_setting('slider_post_orderby', array(
        'default' => $ib_default['slider_post_orderby'],
        'sanitize_callback' => 'interserver_blog_sanitize_post_orderby',
    ));

    $wp_customize->add_control('slider_post_orderby', array(
        'type' => 'select',
        'label' => esc_attr__('Show post orderby', 'interserver-blog'),
        'section' => 'slider_options',
        'settings' => 'slider_post_orderby',
        'choices' => array(
            'none' => esc_attr__('None', 'interserver-blog'),
            'date' => esc_attr__('Date', 'interserver-blog'),
            'ID' => esc_attr__('ID', 'interserver-blog'),
            'author' => esc_attr__('Author', 'interserver-blog'),
            'title' => esc_attr__('Title', 'interserver-blog'),
            'rand' => esc_attr__('Random', 'interserver-blog')
        )
    ));

    $wp_customize->add_setting('slider_num_post', array(
        'default' => $ib_default['slider_num_post'],
        'sanitize_callback' => 'interserver_blog_sanitize_integer',
    ));

    $wp_customize->add_control( 'slider_num_post',array(
        'type' => 'number',
        'label' => __('No.of Post', 'interserver-blog'),
        'description' => __('Limit no. of post to display in slider', 'interserver-blog'),
        'section' => 'slider_options',
        'settings' => 'slider_num_post'
        )
   );

    //Slider Height
    $wp_customize->add_setting(
        'slider_height',
        array(
            'default' => $ib_default['slider_height'],
            'sanitize_callback' => 'interserver_blog_sanitize_slider_height',
        )
    );
    $wp_customize->add_control(
        'slider_height',
          array(
            'type'        => 'radio',
            'label'       => __('Slider Height', 'interserver-blog'),
            'section'     => 'slider_options',
            'choices' => array(
                'full'    => __('Full screen', 'interserver-blog'),
                'custom'    => __('Custom', 'interserver-blog'),
            ),
        )
    );  
    
    //Slider Custom Height
    $wp_customize->add_setting(
        'slider_custom_height',
        array(
            'default' => $ib_default['slider_custom_height'],
            'sanitize_callback' => 'absint',
        )
    );
    
    $wp_customize->add_control(
        'slider_custom_height',
        array(
        'label' => __( 'Slider Custom Height', 'interserver-blog' ),
            'section' => 'slider_options',
            'type' => 'number',
            'description'   => __('Slider height in pixels(px)', 'interserver-blog'),  
            'active_callback' => 'interserver_blog_is_custom_slider_height',     
        )
    );
    
    /*--------------- Social Icons ---------------*/
    $wp_customize->add_section( 'ib_social_icons',
        array(
        'title'      => esc_html__( 'Social Icons', 'interserver-blog' ),
        'capability' => 'edit_theme_options',
        )
    );

    $wp_customize->add_setting('fb_link',array(
        'default'   => $ib_default['null'],
        'sanitize_callback' => 'esc_url_raw'    
    ));
    
    $wp_customize->add_control('fb_link',array(
        'label' => esc_html__('Add facebook link here','interserver-blog'),
        'section'   => 'ib_social_icons',
        'settings'   => 'fb_link'
    )); 
    $wp_customize->add_setting('twit_link',array(
        'default'   => $ib_default['null'],
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('twit_link',array(
        'label' => esc_html__('Add twitter link here','interserver-blog'),
        'section'   => 'ib_social_icons',
        'settings'   => 'twit_link'
    ));
     $wp_customize->add_setting('insta_link',array(
        'default'   => $ib_default['null'],
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('insta_link',array(
        'label' => esc_html__('Add instagram link here','interserver-blog'),
        'section'   => 'ib_social_icons',
        'settings'   => 'insta_link'
    ));
    $wp_customize->add_setting('gplus_link',array(
        'default'   => $ib_default['null'],
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('gplus_link',array(
        'label' => esc_html__('Add google plus link here','interserver-blog'),
        'section'   => 'ib_social_icons',
        'settings'   => 'gplus_link'
    ));
    $wp_customize->add_setting('pinterest_link',array(
        'default'   => $ib_default['null'],
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('pinterest_link',array(
        'label' => esc_html__('Add pinterest link here','interserver-blog'),
        'section'   => 'ib_social_icons',
        'settings'   => 'pinterest_link'
    ));
    $wp_customize->add_setting('linkedin_link',array(
        'default'   => $ib_default['null'],
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('linkedin_link',array(
        'label' => esc_html__('Add linkedIn link here','interserver-blog'),
        'section'   => 'ib_social_icons',
        'settings'   => 'linkedin_link'
    ));
   
/*=================Blog Options===================*/
  $wp_customize->add_section( 'blog_options',
    array(
    'title'      => esc_html__( 'Blog Options', 'interserver-blog' ),
    'priority'   => 32,
    'capability' => 'edit_theme_options',
    )
  );
  
  // Post layout
    $wp_customize->add_setting('interserver_blog_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new Interserver_Blog_Info( $wp_customize, 'featured_categories', array(
        'label' => __('Featured Categories', 'interserver-blog'),
        'section' => 'blog_options',
        'settings' => 'interserver_blog_options[info]',
        'priority' => 10
        ) )
    );    

    $wp_customize->add_setting('featured_cat', array(
        'default' => $ib_default['featured_cat'],
        'sanitize_callback' => 'interserver_blog_sanitize_cat',
    ));

    $wp_customize->add_control(new Interserver_Blog_Multiple_Select_Control($wp_customize,'featured_cat', array(
        'type' => 'multiple-select',
        'label' => __('Select Category', 'interserver-blog'),
        'descripton' => __('Select 4 featured Categories to display on Index Page', 'interserver-blog'),
        'section' => 'blog_options',
        'settings' => 'featured_cat',
        'choices' => ib_cats(),
        )
   ));

    $wp_customize->add_setting('interserver_blog_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new Interserver_Blog_Info( $wp_customize, 'layout', array(
        'label' => __('Layout', 'interserver-blog'),
        'section' => 'blog_options',
        'settings' => 'interserver_blog_options[info]',
        'priority' => 10
        ) )
    );    
    $wp_customize->add_setting(
        'post_layout',
        array(
            'default'           => $ib_default['post_layout'],
            'sanitize_callback' => 'interserver_blog_sanitize_post_layout',
        )
    );
    $wp_customize->add_control(
        'post_layout',
        array(
            'type'      => 'radio',
            'label'     => __('Post layout', 'interserver-blog'),
            'section'   => 'blog_options',
            'priority'  => 11,
            'choices'   => array(
                'small_image' => __( 'Small Image Layout', 'interserver-blog' ),
                'large_image' => __( 'Large Image Layout', 'interserver-blog' ),              
            ),
        )
    ); 

    //Full width blog
    $wp_customize->add_setting(
        'fullwidth_blog',
        array(
            'default' => $ib_default['fullwidth_blog'],   
            'sanitize_callback' => 'interserver_blog_sanitize_checkbox',  
        )       
    );
    $wp_customize->add_control(
        'fullwidth_blog',
        array(
            'type'      => 'checkbox',
            'label'     => __('Check to show full width Post layout
 on home and all archieves', 'interserver-blog'),
            'section'   => 'blog_options',
            'priority' => 12
        )
    );
    //Full width singles
    $wp_customize->add_setting(
        'fullwidth_single',
        array(
            'default' => $ib_default['fullwidth_single'],   
            'sanitize_callback' => 'interserver_blog_sanitize_checkbox',  
        )       
    );
    $wp_customize->add_control(
        'fullwidth_single',
        array(
            'type'      => 'checkbox',
            'label'     => __('Check to show full width layout on single posts', 'interserver-blog'),
            'section'   => 'blog_options',
            'priority' => 12
        )
    );
    //Content/excerpt
    $wp_customize->add_setting('interserver_blog_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new Interserver_Blog_Info( $wp_customize, 'content', array(
        'label' => __('Content/Excerpt', 'interserver-blog'),
        'section' => 'blog_options',
        'settings' => 'interserver_blog_options[info]',
        'priority' => 13
        ) )
    );          
    //Full content on home page
    $wp_customize->add_setting(
      'full_content_home',
      array(
      'default' => $ib_default['full_content_home'],   
      'sanitize_callback' => 'interserver_blog_sanitize_checkbox',  
      )   
    );
    $wp_customize->add_control(
        'full_content_home',
        array(
            'type' => 'checkbox',
            'label' => __('Check this box to display the full content of your posts on the home page.', 'interserver-blog'),
            'section' => 'blog_options',
            'priority' => 14,
        )
    );
  //Full content on archieves page
    $wp_customize->add_setting(
      'full_content_archives',
      array(
          'default' => $ib_default['full_content_archives'],     
          'sanitize_callback' => 'interserver_blog_sanitize_checkbox',    
      )   
    );
    $wp_customize->add_control(
        'full_content_archives',
        array(
            'type' => 'checkbox',
            'label' => __('Check this to display the full content of your posts on all archives.', 'interserver-blog'),
            'section' => 'blog_options',
            'priority' => 15,
        )
    );    
    //Excerpt length
    $wp_customize->add_setting(
        'excerpt_length',
        array(
            'default'  => $ib_default['excerpt_length'],
            'sanitize_callback' => 'absint',
         )       
    );
    $wp_customize->add_control( 'excerpt_length', array(
        'type'        => 'number',
        'priority'    => 16,
        'section'     => 'blog_options',
        'label'       => __('Excerpt length', 'interserver-blog'),
        'desc' => __('Choose your excerpt length. Default: 44 words', 'interserver-blog'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 200,
            'step'  => 5,
        ),
    ) );
  
  //Featured images
    $wp_customize->add_setting('interserver_blog_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new Interserver_Blog_Info( $wp_customize, 'images', array(
        'label' => __('Featured images', 'interserver-blog'),
        'section' => 'blog_options',
        'settings' => 'interserver_blog_options[info]',
        'priority' => 21
        ) )
    );     
    //Index featured images
    $wp_customize->add_setting(
        'index_feat_image',
        array(
            'default' => $ib_default['index_feat_image'],   
          'sanitize_callback' => 'interserver_blog_sanitize_checkbox',
        )       
    );
    $wp_customize->add_control(
        'index_feat_image',
        array(
            'type' => 'checkbox',
            'label' => __('Check this box to hide featured images on index, archives etc.', 'interserver-blog'),
            'section' => 'blog_options',
            'priority' => 22,
        )
    );
    //Post featured images
    $wp_customize->add_setting(
        'post_feat_image',
        array(
            'default' => $ib_default['post_feat_image'],   
          'sanitize_callback' => 'interserver_blog_sanitize_checkbox',
        )       
    );
    $wp_customize->add_control(
        'post_feat_image',
        array(
            'type' => 'checkbox',
            'label' => __('Check to hide featured images on single posts', 'interserver-blog'),
            'section' => 'blog_options',
            'priority' => 23,
        )
    );

    //Meta
    $wp_customize->add_setting('interserver_blog_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new Interserver_Blog_Info( $wp_customize, 'meta', array(
        'label' => __('Meta', 'interserver-blog'),
        'section' => 'blog_options',
        'settings' => 'interserver_blog_options[info]',
        'priority' => 17
        ) )
    ); 
    //Hide meta index
    $wp_customize->add_setting(
      'hide_meta_index',
      array(
        'default' => $ib_default['hide_meta_index'],   
        'sanitize_callback' => 'interserver_blog_sanitize_checkbox',
      )   
    );
    $wp_customize->add_control(
      'hide_meta_index',
      array(
        'type' => 'checkbox',
        'label' => __('Check to hide post meta on index/archives', 'interserver-blog'),
        'section' => 'blog_options',
        'priority' => 18,
      )
    );
    //Hide meta on single
    $wp_customize->add_setting(
      'hide_meta_single',
      array(
      'default' => $ib_default['hide_meta_single'],   
        'sanitize_callback' => 'interserver_blog_sanitize_checkbox',
      )   
    );
    $wp_customize->add_control(
      'hide_meta_single',
      array(
        'type' => 'checkbox',
        'label' => __('Check to hide post meta on singles', 'interserver-blog'),
        'section' => 'blog_options',
        'priority' => 19,
      )
    );
    
  /*===================== Fonts ===================*/
  $wp_customize->add_section(
        'interserver_blog_fonts',
        array(
            'title' => __('Fonts', 'interserver-blog'),
            'priority' => 33,
            'description' => __('Google Fonts can be found here: google.com/fonts.', 'interserver-blog'),
        )
    );
 
    //Body fonts title
    $wp_customize->add_setting('interserver_blog_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new Interserver_Blog_Info( $wp_customize, 'body_fonts', array(
        'label' => __('Body fonts', 'interserver-blog'),
        'section' => 'interserver_blog_fonts',
        'settings' => 'interserver_blog_options[info]',
        'priority' => 10
        ) )
    );    
    //Body fonts
    $wp_customize->add_setting(
        'body_font_name',
        array(
            'default' => $ib_default['body_font_name'],
            'sanitize_callback' => 'interserver_blog_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'body_font_name',
        array(
            'label' => __( 'Font name/style', 'interserver-blog' ),
            'section' => 'interserver_blog_fonts',
            'type' => 'text',
            'priority' => 11
        )
    );
    //Body fonts family
    $wp_customize->add_setting(
        'body_font_family',
        array(
            'default' => $ib_default['body_font_family'],
            'sanitize_callback' => 'interserver_blog_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'body_font_family',
        array(
            'label' => __( 'Font family', 'interserver-blog' ),
            'section' => 'interserver_blog_fonts',
            'type' => 'text',
            'priority' => 12
        )
    );
    //Headings fonts title
    $wp_customize->add_setting('interserver_blog_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new Interserver_Blog_Info( $wp_customize, 'headings_fonts', array(
        'label' => __('Headings fonts', 'interserver-blog'),
        'section' => 'interserver_blog_fonts',
        'settings' => 'interserver_blog_options[info]',
        'priority' => 13
        ) )
    );      
    //Headings fonts 
    $wp_customize->add_setting(
        'headings_font_name',
        array(
            'default' => $ib_default['headings_font_name'],
            'sanitize_callback' => 'interserver_blog_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'headings_font_name',
        array(
            'label' => __( 'Font name/style', 'interserver-blog' ),
            'section' => 'interserver_blog_fonts',
            'type' => 'text',
            'priority' => 14
        )
    );
    //Headings fonts family
    $wp_customize->add_setting(
        'headings_font_family',
        array(
            'default' => $ib_default['headings_font_family'],
            'sanitize_callback' => 'interserver_blog_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'headings_font_family',
        array(
            'label' => __( 'Font family', 'interserver-blog' ),
            'section' => 'interserver_blog_fonts',
            'type' => 'text',
            'priority' => 15
        )
    );
     //Logo fonts title
    $wp_customize->add_setting('interserver_blog_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new Interserver_Blog_Info( $wp_customize, 'logo_fonts', array(
        'label' => __('Logo fonts', 'interserver-blog'),
        'section' => 'interserver_blog_fonts',
        'settings' => 'interserver_blog_options[info]',
        'priority' => 7
        ) )
    );    
    //Logo fonts
    $wp_customize->add_setting(
        'logo_font_name',
        array(
            'default' => $ib_default['logo_font_name'],
            'sanitize_callback' => 'interserver_blog_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'logo_font_name',
        array(
            'label' => __( 'Font name/style', 'interserver-blog' ),
            'section' => 'interserver_blog_fonts',
            'type' => 'text',
            'priority' => 8
        )
    );
    //Logo fonts family
    $wp_customize->add_setting(
        'logo_font_family',
        array(
            'default' => $ib_default['logo_font_family'],
            'sanitize_callback' => 'interserver_blog_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'logo_font_family',
        array(
            'label' => __( 'Font family', 'interserver-blog' ),
            'section' => 'interserver_blog_fonts',
            'type' => 'text',
            'priority' => 9
        )
    );


    
    //Font sizes title
    $wp_customize->add_setting('interserver_blog_options[info]', array(
            'type'              => 'info_control',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new Interserver_Blog_Info( $wp_customize, 'font_sizes', array(
        'label' => __('Font sizes', 'interserver-blog'),
        'section' => 'interserver_blog_fonts',
        'settings' => 'interserver_blog_options[info]',
        'priority' => 16
        ) )
    );
    // Site title
    $wp_customize->add_setting(
        'site_title_size',
        array(
            'default'           => $ib_default['site_title_size'],
      'sanitize_callback' => 'absint',
        )       
    );
    $wp_customize->add_control( 'site_title_size', array(
        'type'        => 'number',
        'priority'    => 17,
        'section'     => 'interserver_blog_fonts',
        'label'       => __('Site title', 'interserver-blog'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 90,
            'step'  => 1,
        ),
    ) ); 
    // Site description
    $wp_customize->add_setting(
        'site_desc_size',
        array(
            'default'           => $ib_default['site_desc_size'],
      'sanitize_callback' => 'absint',
        )       
    );
    $wp_customize->add_control( 'site_desc_size', array(
        'type'        => 'number',
        'priority'    => 17,
        'section'     => 'interserver_blog_fonts',
        'label'       => __('Site description', 'interserver-blog'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 50,
            'step'  => 1,
        ),
    ) );  
    // Menu Items size
    $wp_customize->add_setting(
        'menu_size',
        array(
            'default'           => $ib_default['menu_size'],
      'sanitize_callback' => 'absint',
        )       
    );
    $wp_customize->add_control( 'menu_size', array(
        'type'        => 'number',
        'priority'    => 17,
        'section'     => 'interserver_blog_fonts',
        'label'       => __('Menu items', 'interserver-blog'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 50,
            'step'  => 1,
        ),
    ) );           
    //H1 size
    $wp_customize->add_setting(
        'h1_size',
        array(
            'default'           => $ib_default['h1_size'],
      'sanitize_callback' => 'absint',
        )       
    );
    $wp_customize->add_control( 'h1_size', array(
        'type'        => 'number',
        'priority'    => 17,
        'section'     => 'interserver_blog_fonts',
        'label'       => __('H1 font size', 'interserver-blog'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
        ),
    ) );
    //H2 size
    $wp_customize->add_setting(
        'h2_size',
        array(
           'default'           => $ib_default['h2_size'],
      'sanitize_callback' => 'absint',
        )       
    );
    $wp_customize->add_control( 'h2_size', array(
        'type'        => 'number',
        'priority'    => 18,
        'section'     => 'interserver_blog_fonts',
        'label'       => __('H2 font size', 'interserver-blog'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
        ),
    ) );
    //H3 size
    $wp_customize->add_setting(
        'h3_size',
        array(
            'default'           => $ib_default['h3_size'],
      'sanitize_callback' => 'absint',
        )       
    );
    $wp_customize->add_control( 'h3_size', array(
        'type'        => 'number',
        'priority'    => 19,
        'section'     => 'interserver_blog_fonts',
        'label'       => __('H3 font size', 'interserver-blog'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
        ),
    ) );
    //H4 size
    $wp_customize->add_setting(
        'h4_size',
        array(
            'default'           => $ib_default['h4_size'],
      'sanitize_callback' => 'absint',
        )       
    );
    $wp_customize->add_control( 'h4_size', array(
        'type'        => 'number',
        'priority'    => 20,
        'section'     => 'interserver_blog_fonts',
        'label'       => __('H4 font size', 'interserver-blog'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
        ),
    ) );
    //H5 size
    $wp_customize->add_setting(
        'h5_size',
        array(
            'default'           => $ib_default['h5_size'],
      'sanitize_callback' => 'absint',
        )       
    );
    $wp_customize->add_control( 'h5_size', array(
        'type'        => 'number',
        'priority'    => 21,
        'section'     => 'interserver_blog_fonts',
        'label'       => __('H5 font size', 'interserver-blog'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
        ),
    ) );
    //H6 size
    $wp_customize->add_setting(
        'h6_size',
        array(
            'default'           => $ib_default['h6_size'],
      'sanitize_callback' => 'absint',
        )       
    );
    $wp_customize->add_control( 'h6_size', array(
        'type'        => 'number',
        'priority'    => 22,
        'section'     => 'interserver_blog_fonts',
        'label'       => __('H6 font size', 'interserver-blog'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
        ),
    ) );
    //Body
    $wp_customize->add_setting(
        'body_size',
        array(
      'default'           => $ib_default['body_size'],
            'sanitize_callback' => 'absint',
        )       
    );
    $wp_customize->add_control( 'body_size', array(
        'type'        => 'number',
        'priority'    => 23,
        'section'     => 'interserver_blog_fonts',
        'label'       => __('Body font size', 'interserver-blog'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 24,
            'step'  => 1,
        ),
    ) );
  
  /*==================== Footer ====================*/
  $wp_customize->add_section('interserver_blog_footer',
        array(
            'title'         => __('Footer', 'interserver-blog'),
            'priority'      => 34,
     )
    );
  // Footer Widgets
    $wp_customize->add_setting(
        'footer_widgets',
        array(
            'default'           => $ib_default['footer_widgets'],
            'sanitize_callback' => 'interserver_blog_sanitize_footer_widget',
        )
    );
    $wp_customize->add_control(
        'footer_widgets',
        array(
            'type'        => 'radio',
            'label'       => __('Footer Widgets', 'interserver-blog'),
            'section'     => 'interserver_blog_footer',
            'description' => __('Select the number of widget areas you want in the footer. After that, go to Appearance > Widgets and add your widgets.', 'interserver-blog'),
            'choices' => array(
                '1'     => __('One', 'interserver-blog'),
                '2'     => __('Two', 'interserver-blog'),
                '3'     => __('Three', 'interserver-blog'),
                '4'     => __('Four', 'interserver-blog')
            ),
        )
    );
    
  // Footer Copyright
    $wp_customize->add_setting(
        'footer_copyright',
        array(
            'default'           => $ib_default['footer_copyright'],
            'sanitize_callback' => 'interserver_blog_sanitize_text',
        )
    );
     $wp_customize->add_control(
        'footer_copyright',
        array(
           'label' => __( 'Copyright Text', 'interserver-blog' ),
           'section' => 'interserver_blog_footer',
           'type' => 'text'
        ));

  
/*=================== Colors ====================*/
  $wp_customize->add_panel('interserver_blog_color_panel',
        array(
      'capability'     => 'edit_theme_options',
          'priority'       => 35,
      'theme_supports' => '',
          'title'          => __('Colors', 'interserver-blog'),
     )
    );
  // Primary Color
  $wp_customize->add_setting(
        'primary_color',
        array(
            'default'           => $ib_default['primary_color'],
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'primary_color',
            array(
                'label'         => __('Primary color', 'interserver-blog'),
                'section'       => 'colors',
                'settings'      => 'primary_color',
            )
        )
    );
  // Secondary Color
  $wp_customize->add_setting(
        'secondary_color',
        array(
            'default'           => $ib_default['secondary_color'],
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'secondary_color',
            array(
                'label'         => __('Secondary color', 'interserver-blog'),
                'section'       => 'colors',
                'settings'      => 'secondary_color',
            )
        )
    );
  // Body Text Color
  $wp_customize->add_setting(
        'body_text_color',
        array(
            'default'     => $ib_default['body_text_color'],
      'sanitize_callback' => 'sanitize_hex_color',
        )
    );
 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'body_text_color',
            array(
                'label'      => __( 'Body Text Color', 'interserver-blog' ),
                'section'    => 'colors',
                'settings'   => 'body_text_color'
            )
        )
    );
  /*----------------- Header Color ------------------*/
  $wp_customize->add_section('header_colors', 
  array(
    'title'          => __('Header', 'interserver-blog'),
        'panel'     => 'interserver_blog_color_panel',
  ));
  //Top Header background Color
    $wp_customize->add_setting(
        'header_top_bg',
        array(
            'default'           => $ib_default['header_top_bg'],
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_top_bg',
            array(
                'label' => __('Top Header background', 'interserver-blog'),
                'section' => 'header_colors',
            )
        )
    );
  // Header background Color
  $wp_customize->add_setting(
        'header_bg_color',
        array(
            'default'           => $ib_default['header_bg_color'],
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_bg_color',
            array(
                'label' => __('Header background', 'interserver-blog'),
                'section' => 'header_colors',
            )
        )
    );
  //Site Tilte Color
    $wp_customize->add_setting(
        'site_title_color',
        array(
            'default'           => $ib_default['site_title_color'],
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'site_title_color',
            array(
                'label' => __('Site title', 'interserver-blog'),
                'section' => 'header_colors',
            )
        )
    );
  
  //Site Desc Color 
    $wp_customize->add_setting(
        'site_desc_color',
        array(
            'default'           => $ib_default['site_desc_color'],
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'site_desc_color',
            array(
                'label' => __('Site description', 'interserver-blog'),
                'section' => 'header_colors',
            )
        )
    );
  
  // Menu color
  $wp_customize->add_setting(
        'menu_color',
        array(
      'default'           => $ib_default['menu_color'],
            'sanitize_callback' => 'sanitize_hex_color',       
        )
    );
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_color',
            array(
                'label'      => __( 'Menu Item', 'interserver-blog' ),
                'section'    => 'header_colors',
                'settings'   => 'menu_color'
            )
        )
    );
  
  // Menu hover color
  $wp_customize->add_setting(
        'menu_hover_color',
        array(
            'default'           => $ib_default['menu_hover_color'],
            'sanitize_callback' => 'sanitize_hex_color',   
        )
    );
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_hover_color',
            array(
                'label'      => __( 'Menu Item Hover', 'interserver-blog' ),
                'section'    => 'header_colors',
                'settings'   => 'menu_hover_color'
            )
        )
    );
  
  // Sub Menu color
  $wp_customize->add_setting(
        'submenu_color',
        array(
            'default'           => $ib_default['submenu_color'],
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
 
    $wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'submenu_color',
            array(
                'label'      => __( 'Sub Menu Item', 'interserver-blog' ),
                'section'    => 'header_colors',
                'settings'   => 'submenu_color'
            )
        )
    );

  // Slider Text Color
    $wp_customize->add_setting(
        'slider_text_color',
        array(
            'default'           => $ib_default['slider_text_color'],
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'slider_text_color',
            array(
                'label' => __('Slider Text Color', 'interserver-blog'),
                'section' => 'header_colors',
            )
        )
    );
  
  /*----------------- Footer Color ------------------*/
  $wp_customize->add_section('footer_colors', 
  array(
    'title'          => __('Footer', 'interserver-blog'),
        'panel'     => 'interserver_blog_color_panel',
  ));
  
  //Footer Widgets backgound
    $wp_customize->add_setting(
        'footer_widgets_background',
        array(
            'default'           => $ib_default['footer_widgets_background'],
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize,'footer_widgets_background',
            array(
                'label' => __('Footer Widgets Background', 'interserver-blog'),
        'descripton' => __('Change the widgetized Footer Bottom background from here ', 'interserver-blog'),
                'section' => 'footer_colors',
            )
        )
    );
  
  //Fotter Widget Title
    $wp_customize->add_setting(
        'fw_title_color',
        array(
            'default'           => $ib_default['fw_title_color'],
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'fw_title_color',
            array(
                'label' => __('Footer Widget Title', 'interserver-blog'),
                'section' => 'footer_colors',
            )
        )
    );

    //Footer widget text color
    $wp_customize->add_setting(
        'fw_text_color',
        array(
            'default'           => $ib_default['fw_text_color'],
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize,'fw_text_color',
            array(
                'label' => __('Footer Widget Text ', 'interserver-blog'),
                'section' => 'footer_colors',
            )
        )
    );
  
  
  //Footer backgound
    $wp_customize->add_setting(
        'footer_bottom_background',
        array(
            'default'           => $ib_default['footer_bottom_background'],
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize,'footer_bottom_background',
            array(
                'label' => __('Footer Bottom background', 'interserver-blog'),
                'section' => 'footer_colors',
            )
        )
    );
  
  
    //Footer Bottom Text  color
    $wp_customize->add_setting(
        'fb_text_color',
        array(
            'default'           => $ib_default['fb_text_color'],
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize,'fb_text_color',
            array(
                'label' => __('Footer Bottom Text ', 'interserver-blog'),
                'section' => 'footer_colors',
            )
        )
    );

  /*----------------- Sidebar Color ------------------*/
  $wp_customize->add_section('sidebar_colors', 
  array(
    'title'     => __('Sidebar', 'interserver-blog'),
        'panel'     => 'interserver_blog_color_panel',
  ));
  
  //Sidebar Heading color
    $wp_customize->add_setting(
        'sw_title_color',
        array(
            'default'           => $ib_default['sw_title_color'],
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'sw_title_color',
            array(
                'label' => __('Sidebar Widget Title', 'interserver-blog'),
                'section' => 'sidebar_colors',
            )
        )
    );
  
  //Sidebar Text Color
    $wp_customize->add_setting(
        'sidebar_text_color',
        array(
            'default'           => $ib_default['sidebar_text_color'],
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize,'sidebar_text_color',
            array(
                'label' => __('Sidebar Text Color', 'interserver-blog'),
                'section' => 'sidebar_colors',
            )
        )
    );
  
  
  
  