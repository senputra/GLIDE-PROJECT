<?php
/**
 * Theme functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package Interserver Blog
 */

if ( ! function_exists( 'interserver_blog_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function interserver_blog_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Interserver Blog
, use a find and replace
	 * to change 'interserver-blog' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'interserver-blog', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Content width
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 1170; /* pixels */
	}

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	*/
	add_theme_support('post-thumbnails' );
	add_image_size('interserver-blog-large-thumbnail', 850);
	add_image_size('interserver-blog-medium-thumbnail', 550, 400, true);
	add_image_size('interserver-blog-small-thumbnail', 250);

	/*
	 * Enable support for Category Thumbnails 
	*/
	add_theme_support('category-thumbnails');


	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'interserver-blog' ),
		'footer'  => esc_html__( 'Footer Menu', 'interserver-blog' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	Enable support for custom logo
	*/

	add_theme_support( 'custom-logo', array(
	   'height'      => 100,
	   'width'       => 350,
	   'flex-width' => true,
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'interserver_blog_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	// Add Editor Style
	add_editor_style( '/css/editor-style.css' );
}
endif; // interserver_blog_setup
add_action( 'after_setup_theme', 'interserver_blog_setup' );

/**
 * Register widget area.
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function interserver_blog_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'interserver-blog' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	));
	//Footer widget areas
	$widget_areas = get_theme_mod('footer_widgets', '3');
	for ($i=1; $i<=$widget_areas; $i++) {
		register_sidebar( array(
			'name'          => __( 'Footer ', 'interserver-blog' ) . $i,
			'id'            => 'footer-' . $i,
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
	}
}
add_action( 'widgets_init', 'interserver_blog_widgets_init' );


// Fonts
if ( !function_exists('interserver_blog_google_fonts') ) :
function interserver_blog_google_fonts() {
	global $ib_default;
	$logo_font 		= get_theme_mod('logo_font_name', $ib_default['logo_font_name']);
    $body_font 		= get_theme_mod('body_font_name', $ib_default['body_font_name']);
    $headings_font 	= get_theme_mod('headings_font_name', $ib_default['headings_font_name']);

	$fonts = array();
	$fonts[] = esc_attr( str_replace( '+', ' ', $logo_font ) );
	$fonts[] = esc_attr( str_replace( '+', ' ', $body_font ) );
	$fonts[] = esc_attr( str_replace( '+', ' ', $headings_font ) );

	$query_args = array(
		'family' => urlencode( implode( '|', $fonts ) )
	);
	
	if ( $fonts ) {
		$fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css' );
	}
	return $fonts_url;	
}
endif;

function interserver_blog_scripts(){
	global $ib_default;global $wp_query; 
	echo "<script>var header_style;</script>";
	$header_alignment = get_theme_mod('header_alignment',$ib_default['header_alignment']);
	if ($header_alignment != $ib_default['header_alignment']){
	echo "<script>header_style = 'inline';</script>";
	}
	wp_register_style( 'google-fonts', esc_url( interserver_blog_google_fonts() ), array(),null );
	wp_enqueue_style( 'google-fonts' );
	wp_enqueue_style( 'interserver-blog-style', get_stylesheet_uri());
	wp_enqueue_style( 'nivo-slider-style', get_template_directory_uri() . '/css/nivo-slider.css' );
	wp_enqueue_style( 'interserver-blog-fontawesome', get_template_directory_uri() . '/fonts/font-awesome.min.css' );
	wp_enqueue_style( 'interserver-blog-ie9', get_template_directory_uri() . '/css/ie9.css', array( 'interserver-blog-style' ) );
	wp_style_add_data( 'interserver-blog-ie9', 'conditional', 'lte IE 9' );

	wp_enqueue_script( 'nivo-slider', get_template_directory_uri() . '/js/jquery.nivo.slider.js', array('jquery'),'', true );
	wp_enqueue_script( 'interserver-blog-navigation', get_template_directory_uri() . '/js/responsive-nav.js', array(), '20151215', true );

	wp_enqueue_script( 'interserver-blog-custom', get_template_directory_uri() . '/js/custom.js', array('jquery'),'20170504', true );
	wp_enqueue_script( 'interserver-blog-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action('wp_enqueue_scripts','interserver_blog_scripts');


// Load Customizer.
require trailingslashit( get_template_directory() ) . 'inc/customizer.php';

require trailingslashit( get_template_directory() ) . 'inc/customizer/defaults.php';

require trailingslashit( get_template_directory() ) . 'inc/hook/structure.php';

require trailingslashit( get_template_directory() ) . 'inc/hook/basic.php';

require trailingslashit( get_template_directory() ) . 'inc/template-tags.php';

require trailingslashit( get_template_directory() ) . 'inc/jetpack.php';

require trailingslashit( get_template_directory() ) . 'inc/extras.php';

require trailingslashit( get_template_directory() ) . 'inc/customizer/styles.php';

require trailingslashit( get_template_directory() ) . 'lib/tgm/tgm.php';

require trailingslashit( get_template_directory() ) . 'demo-import/demo-setup.php';


if ( !function_exists('interserver_blog_social_icons') ) :
function interserver_blog_social_icons() {
	$fb_link = get_theme_mod('fb_link'); 
	$twit_link = get_theme_mod('twit_link');
	$insta_link = get_theme_mod('insta_link');
	$gplus_link = get_theme_mod('gplus_link');
	$pinterest_link = get_theme_mod('pinterest_link');
	$linked_link = get_theme_mod('linkedin_link');	

	if (!empty($fb_link)) { ?>
        <a title="facebook" class="fb" target="_blank" href="<?php echo esc_url($fb_link); ?>"><i class="fa fa-facebook"></i></a> 
    <?php } 

    if (!empty($twit_link)) { ?>
         <a title="twitter" class="tw" target="_blank" href="<?php echo esc_url($twit_link); ?>"><i class="fa fa-twitter"></i></a>
    <?php } 

    if (!empty($insta_link)) { ?>
        <a title="instagram" class="fb" target="_blank" href="<?php echo esc_url($insta_link); ?>"><i class="fa fa-instagram"></i></a> 
    <?php } 

    if (!empty($gplus_link)) { ?>
        <a title="goopgle-plus" class="tw" target="_blank" href="<?php echo esc_url($gplus_link); ?>"><i class="fa fa-google-plus"></i></a>
    <?php }

	if (!empty($pinterest_link)) { ?>
        <a title="pinterest" class="gp" target="_blank" href="<?php echo esc_url($pinterest_link); ?>"><i class="fa fa-pinterest"></i></a>
    <?php }

    if (!empty($linked_link)) { ?> 
        <a title="linkedin" class="in" target="_blank" href="<?php echo esc_url($linked_link); ?>"><i class="fa fa-linkedin"></i></a>
    <?php } 
}
endif;


function interserver_blog_featured_cat_grid() {
global $ib_default;
    $cid = get_theme_mod('featured_cat', $ib_default['featured_cat']);
	$categories = get_categories( $cid );
	include_once(ABSPATH.'wp-admin/includes/plugin.php');
	if(is_plugin_active( 'category-thumbnails/category-thumbnails.php' )){
	echo '<ul class="cat_listing">';
    foreach ((array) $cid as $cat_id) {
		$cat_name = get_the_category_by_ID($cat_id);
		$cat_link = get_category_link( $cat_id );
		// Display the Category Thumbnails
		if(has_category_thumbnail()){
        $cat_image = get_the_category_thumbnail($cat_id);
		}
		  echo '<li><a class="hovereffect" href="'. esc_url( $cat_link ).'" target="_blank">'. $cat_image.'<div class="overlay"><span>'.esc_html($cat_name).'</span></div></a></li>';
	    } 
	echo '</ul>';
	}
}