<?php
/**
 * Interserver Blog Theme Customizer
 *
 * @package Interserver Blog
 */

if(!function_exists('interserver_blog_customize_register')){
 function interserver_blog_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
    $wp_customize->get_section( 'header_image' )->panel = 'header_options';
    $wp_customize->get_section( 'header_image' )->priority = '13';
  	$wp_customize->get_section( 'colors' )->panel = 'interserver_blog_color_panel';
	$wp_customize->get_section('colors')->title = __( 'General','interserver-blog' );
	$wp_customize->get_section( 'colors' )->priority = '35';
	$wp_customize->remove_control( 'header_textcolor' );
    $wp_customize->remove_control( 'display_header_text' );
	
	// Load customize controls.
	include(locate_template('inc/customizer/controls.php'));

	// Load sanitize option.
	include(locate_template('inc/customizer/sanitize.php'));

	// Load customize defaults.
	include(locate_template('inc/customizer/defaults.php'));

	// Load customize option.
	include(locate_template('inc/customizer/options.php'));
	
}
}
add_action( 'customize_register', 'interserver_blog_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
if(!function_exists('interserver_blog_customize_preview_js')){
function interserver_blog_customize_preview_js() {
	wp_enqueue_script( 'interserver_blog_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
}
add_action( 'customize_preview_init', 'interserver_blog_customize_preview_js' );
