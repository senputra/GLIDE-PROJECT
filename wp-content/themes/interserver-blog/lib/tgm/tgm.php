<?php
/**
 * Recommended plugins.
 *
 * @package Interserver Blog

 */
 
// TGM Plugin activation.
get_template_part('lib/tgm/class-tgm-plugin','activation');

add_action( 'tgmpa_register', 'interserver_blog_activate_recommended_plugins' );
function interserver_blog_activate_recommended_plugins(){
	$plugins = array(
		array(
			'name'      => 'MailPoet 3 (New)',
            'slug'      => 'mailpoet',
            'required'  =>  false,
		),
		array(
			'name'      => 'WP ULike',
			'slug'      => 'wp-ulike',
			'required'  =>  false,
		),
		array(
			'name'      => 'Category Thumbnails',
			'slug'      => 'category-thumbnails',
			'required'  =>  false,
		),
		array(
			'name'      => 'WP Instagram Widget',
			'slug'      => 'wp-instagram-widget',
			'required'  =>  false,
		),
		array(
			'name'      => 'One Click Demo Import',
            'slug'      => 'one-click-demo-import',
            'required'  =>  false,
		)		
	);
	$config = array();
	tgmpa( $plugins, $config );
}