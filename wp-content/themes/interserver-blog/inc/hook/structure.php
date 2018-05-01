<?php
/**
 * Theme functions related to structure.
 *
 * This file contains structural hook functions.
 *
 * @package Interserver Blog
 */

//  Doctype Declaration
if ( ! function_exists( 'interserver_blog_doctype' ) ) :
	function interserver_blog_doctype() {
	?><!DOCTYPE html> <html <?php language_attributes(); ?>><?php
	}
endif;
add_action( 'interserver_blog_action_doctype', 'interserver_blog_doctype', 10 );

// Header Codes
 if ( ! function_exists( 'interserver_blog_head' ) ) :
function interserver_blog_head() { ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif;
	}
	
endif;
add_action( 'interserver_blog_action_head', 'interserver_blog_head', 10 );

// Page Start
if ( ! function_exists( 'interserver_blog_page_start' ) ) :
	function interserver_blog_page_start() {
	?>
    <div id="page" class="hfeed site">
    <?php
	}
endif;
add_action( 'interserver_blog_action_before_page', 'interserver_blog_page_start' );

// Header Top Bar.
if ( ! function_exists( 'interserver_blog_header_top_bar' ) ) :
function interserver_blog_header_top_bar() { 
	global $ib_default;
	$header_topbar = get_theme_mod('hide_header_topbar', $ib_default['hide_header_topbar']);
	$sticky_header = get_theme_mod('sticky_header',$ib_default['sticky_header']);
	
?>
<header id="masthead" class="site-header<?php if($sticky_header == $ib_default['sticky_header'] ){ echo ' '. esc_attr($sticky_header);}?>" role="banner">
<?php
if( !$header_topbar ) { ?>
<div class="header-top-wrapper">
    <div class="header-info">
        <div class="left-info">
			<div class="social-icons">
			<?php interserver_blog_social_icons();?>
            </div>
     	</div>
	    <div class="right-info">
	        <?php get_search_form();?>
	    </div>   	
   </div>
    <div class="clear"></div>
    </div>
<?php }
}
endif;
add_action( 'interserver_blog_action_before_header', 'interserver_blog_header_top_bar', 5);

// Site Branding and Navigation
if ( ! function_exists( 'interserver_blog_site_header' ) ) :
	function interserver_blog_site_header() { ?> 
		<div class="logo-wrap">
		<?php if ( function_exists( 'the_custom_logo' ) && ( has_custom_logo() ) ) : ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo('name'); ?>"><?php the_custom_logo();?></a>
	<?php else : ?>
		<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>	        
	<?php endif;?>
	
		</div>
	<div class="mobile-menu">
	<nav id="cssmenu" class="mainnav" role="navigation">
	<div id="head-mobile"></div>
    <div class="button"></div> 
		 <?php wp_nav_menu( array( 'theme_location'=> 'primary','container'=>'ul','menu_class'=>'main-menu')); ?>
	</nav>
	</div>
<?php }
endif;
add_action( 'interserver_blog_action_header', 'interserver_blog_site_header');

// Header Start.
if ( ! function_exists( 'interserver_blog_header_start' ) ) :
	function interserver_blog_header_start() {
	global $ib_default;
	$site_layout = get_theme_mod('site_layout', $ib_default['site_layout']);
	?><div class="header-wrap"><div class="container <?php echo esc_attr($site_layout);?>"><?php
	}
endif;
add_action( 'interserver_blog_action_before_header', 'interserver_blog_header_start', 10);


// Header End.
if ( ! function_exists( 'interserver_blog_header_end' ) ) :
	function interserver_blog_header_end() {
	?></div><!--End container --></div><!-- End header wrap --></header><!-- End header --><?php
	}
endif;
add_action( 'interserver_blog_action_after_header', 'interserver_blog_header_end', 5);

// Slider
if ( ! function_exists( 'interserver_blog_display_featured_header' ) ) :
	function interserver_blog_display_featured_header (){
		global $ib_default;
		$hide_slider = get_theme_mod('hide_slider', $ib_default['hide_slider']);
		if(! $hide_slider ) {
			// Load Slider 
		get_template_part('template-parts/slider');
		}	
	}
endif;
add_action('interserver_blog_action_after_header','interserver_blog_display_featured_header', 10);
	
// Content Start
if ( ! function_exists( 'interserver_blog_content_start' ) ) :
	function interserver_blog_content_start() {
	?><div id="content" class="site-content"><div class="container"><div class="content-wrapper"><?php
	}
endif;
add_action( 'interserver_blog_action_before_content', 'interserver_blog_content_start' );

// Add Sidebar widget area
if ( ! function_exists( 'interserver_blog_add_sidebar_widget_area' ) ) :
	function interserver_blog_add_sidebar_widget_area() { ?>
    <div id="secondary" class="widget-area" role="complementary">
    	<div id="right-sidebar">
            <div class="sidebar_inner">
			<?php dynamic_sidebar('sidebar-1');?>
			</div>
		</div>
    </div>
    <?php
	}
	endif;
add_action( 'interserver_blog_action_sidebar','interserver_blog_add_sidebar_widget_area');

// Content End
if ( ! function_exists( 'interserver_blog_content_end' ) ) :
	function interserver_blog_content_end() {
	include_once(ABSPATH.'wp-admin/includes/plugin.php');
	if(is_plugin_active( 'mailpoet/mailpoet.php' )){
		$form_widget = new \MailPoet\Form\Widget();
		echo '<div class="newsletter-section">'. $form_widget->widget(array('form' => 1, 'form_type' => 'php')).'</div>';
	}
	?></div><!-- .content-wrapper --></div><!-- .container --></div><!-- #content --><?php
	}
endif;
add_action( 'interserver_blog_action_after_content', 'interserver_blog_content_end' );

// Go to top
if ( ! function_exists( 'interserver_blog_footer_go_to_top' ) ) :
	function interserver_blog_footer_go_to_top() {
		echo '<a href="#page" class="scrollup" id="btn-scrollup"><i class="fa fa-angle-up"></i></a>';
	}
endif;
add_action( 'interserver_blog_action_after', 'interserver_blog_footer_go_to_top', 10);


// Footer Start
if ( ! function_exists( 'interserver_blog_footer_start' ) ) :
	function interserver_blog_footer_start() { ?>
	<footer id="colophon" class="site-footer" role="contentinfo"><?php
	}
endif;
add_action( 'interserver_blog_action_before_footer', 'interserver_blog_footer_start', 5 );



// Footer widget area
if ( ! function_exists( 'interserver_blog_footer_widget_area' ) ) :
	function interserver_blog_footer_widget_area() {
		$widget_areas = get_theme_mod('footer_widgets', '1');
		if ($widget_areas == '4') {
			$cols = 'four-column';
		} elseif ($widget_areas == '3') {
			$cols = 'three-column';
		} elseif ($widget_areas == '2') {
			$cols = 'two-column';
		} else {
			$cols = 'one-column';
		}
	?>
<?php if ( is_active_sidebar('footer-1' || 'footer-2' || 'footer-3'|| 'footer-4')) { ?>
	<div id="footer-widgets" class="footer-widgets widget-area" role="complementary">
		<div class="container">
		<div class="row">
			<?php 
		for($i=1;$i<=$widget_areas*1;$i++){
			if ( is_active_sidebar( 'footer-'.$i ) ) : ?>
				<div class="sidebar-column <?php echo esc_attr($cols); ?>">
					<?php dynamic_sidebar( 'footer-'.$i); ?>
				</div>
			<?php endif; ?>	
			<?php } ?>
		</div>
		</div>	
	</div>
    <?php
	}
	}
endif;
add_action( 'interserver_blog_action_before_footer','interserver_blog_footer_widget_area',10);


// Footer copyright
if ( ! function_exists( 'interserver_blog_footer_copyright' ) ) :
	function interserver_blog_footer_copyright() {
		global $ib_default;
	// Copyright content.
		$copyright_text = get_theme_mod( 'footer_copyright', $ib_default['footer_copyright']);
		if ( ! empty( $copyright_text ) ) {
			$copyright_text = wp_kses_data( $copyright_text );
		}

		// Powered by content.
		$powered_by_text = sprintf( /* translators: %s: theme author */
			esc_html__( 'Theme by %s', 'interserver-blog' ), '<a target="_blank" rel="author" href="https://www.interserver.net/tips/free-wordpress-themes/">' . esc_html__( 'InterServer Web Hosting', 'interserver-blog' ) . '</a>' );
		?>

		<div class="footer-bottom">
			<div class="container">
	    	<?php if ( ! empty( $copyright_text ) ) : ?>
                <div class="copyright">
		    		<?php echo wp_kses_data($copyright_text); ?>
		    	</div><!-- .copyright -->
		    <?php endif; ?>

		    <div class="social-icons">
			<?php interserver_blog_social_icons();?>
            </div>
           </div>
		</div><!-- footer-bottom-->

	    <?php
	}
endif;
add_action( 'interserver_blog_action_footer', 'interserver_blog_footer_copyright', 10 );


// Footer End
if ( ! function_exists( 'interserver_blog_footer_end' ) ) :
	function interserver_blog_footer_end() { ?>
	</footer><!-- #colophon --><?php
	}
endif;
add_action( 'interserver_blog_action_after_footer', 'interserver_blog_footer_end' );


// Page End
if ( ! function_exists( 'interserver_blog_page_end' ) ) :
	function interserver_blog_page_end() {
	?></div><!-- #page --><?php
	}
endif;
add_action( 'interserver_blog_action_after_page', 'interserver_blog_page_end' );