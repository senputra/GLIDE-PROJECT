<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...
 *
 * @package Interserver Blog
 */

function interserver_blog_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'interserver_blog_custom_header_args', array(
		'default-image'          => get_template_directory_uri() . '/images/header.jpg',
		'default-text-color'     => '000000',
		'width'                  => 1920,
		'height'                 => 1080,
		'flex-height'            => true,
		'wp-head-callback'       => 'interserver_blog_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'interserver_blog_custom_header_setup' );

if ( ! function_exists( 'interserver_blog_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see interserver_blog_custom_header_setup().
 */
function interserver_blog_header_style() {
	global $default; global $site_header; global $front_header;
	if ( get_header_image() && ( $front_header == 'image' && is_front_page() || $site_header == $default['site_header_type'] && !is_front_page() ) ) {
	?>
	<style type="text/css">
		.header-image {
			background-image: url(<?php echo esc_attr(get_header_image()); ?>);
			display: block;
		}
		@media only screen and (max-width: 1024px) {
			.header-inner {
				display: block;
			}
			.header-image {
				background-image: none;
				height: auto !important;
			}		
		}
	</style>
	<?php
	}
}
endif; // interserver_blog_header_style