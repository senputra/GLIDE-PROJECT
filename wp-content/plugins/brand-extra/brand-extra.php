<?php

/*
Plugin Name: Brand Extra
Plugin URI: https://wordpress.org/plugins/brand-extra/
Description: Add widgets, shortcodes, a panel to manage extensions and more to your Brand theme.
Version: 1.2
Author: Massimo Sanfelice | Maxsdesign
Author URI: https://wp-brandtheme.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: brand-extra
*/

/*
* Brand Extra bundles the following third-party resources:
*
* PhotoSwipe v4.1.2 ( http://photoswipe.com/ )
* Copyright (c) 2017 Dmitry Semenovs
* Licensed under MIT
*/

/*
* Brand Extra uses a modified version of the following third-party resources:
*
* WordPress Plugin Installer 1.0 ( https://github.com/dcooney/wordpress-plugin-installer )
* Copyright (c) 2017 Darren Cooney
* Licensed under GPLv2 ( https://github.com/dcooney/wordpress-plugin-installer/blob/master/LICENSE )
*/

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 * Main plugin class with initialization tasks.
 */
class Brand_Extra_Plugin {
	/**
	 * Constructor for this class.
	 */
	public function __construct() {
		/**
		 * Display admin error message if PHP version is older than 5.4.
		 * Otherwise check the active theme.
		 */
		if ( version_compare( phpversion(), '5.4', '<' ) ) {
			add_action( 'admin_notices', array( $this, 'old_php_admin_error_notice' ) );
		}

		else {
			// Set plugin constants.
			$this->set_plugin_constants();

			// Load main class.
			require_once BRAND_EXTRA_PATH . 'inc/brand-extra.php';

			// Instantiate the main plugin class *Singleton*.
			$brand_import_export = Brand_Extra\Brand_Extra::get_instance();

			// Display the admin notice with a link to get all extensions with a discount.
			if( ! get_transient( 'gift-notice' ) )
				if( BRAND_ACTIVE ) {
					add_action( 'admin_notices', array( $this, 'brand_gift_notice' ) );
				}
		}
	}

	/**
	 * Display an admin error notice when PHP is older the version 5.4.
	 * Hook it to the 'admin_notices' action.
	 */
	public function old_php_admin_error_notice() {
		$message = sprintf( esc_html__( 'The %2$sBrand Extra%3$s plugin requires %2$sPHP 5.4+%3$s to run properly. Please contact your hosting company and ask them to update the PHP version of your site to at least PHP 5.4%4$s Your current version of PHP: %2$s%1$s%3$s', 'brand-extra' ), phpversion(), '<strong>', '</strong>', '<br>' );

		printf( '<div class="notice notice-error is-dismissible"><p>%1$s</p></div>', wp_kses_post( $message ) );
	}

	/**
	 * Display an admin notice with a link to get all extensions with a discounte.
	 * Hook it to the 'admin_notices' action.
	 */
	public function brand_gift_notice() {
		$message = sprintf( esc_html__( '%1$sAs a way of saying thanks for using %2$sBrand theme%3$s  we offer you %4$s all our extensions %5$s with a 30%6$s discount. Just click on the button below and fill the form.%7$s', 'brand-extra' ), '<span>', '<strong>', '</strong>', '<a href="' . 'https://wp-brandtheme.com/downloads/brand-bundle' . '">', '</a>', '&#37;', '</span>' );
		$message .= sprintf( esc_html__( '%1$s %2$s GET ALL EXTENSIONS %3$s %4$s NO THANKS %3$s %5$s' ), '<span>', '<a class="button button-primary" href="https://www.wp-brandtheme.com/?edd_action=add_to_cart&download_id=1630&discount=WELCOMEABOARD" target="_blank">', '</a>', '<a class="button delete-notice" href="#">', '</span>' );
		printf( '<div class="notice brand-notice gift-notice"><p>%1$s</p></div>', wp_kses_post( $message ) );
	}


	/**
	 * Set plugin constants.
	 *
	 * Path/URL to root of this plugin, with trailing slash and plugin version.
	 */
	private function set_plugin_constants() {
		// Path/URL to root of this plugin, with trailing slash.
		if ( ! defined( 'BRAND_EXTRA_PATH' ) ) {
			define( 'BRAND_EXTRA_PATH', plugin_dir_path( __FILE__ ) );
		}
		if ( ! defined( 'BRAND_EXTRA_URL' ) ) {
			define( 'BRAND_EXTRA_URL', plugin_dir_url( __FILE__ ) );
		}
		if ( ! defined( 'PHOTOSWIPE_VERSION' ) ) {
			define( 'PHOTOSWIPE_VERSION', '4.1.2' );
		}
		if ( ! defined( 'BRAND_EXTRA_FONTAWESOME_VER' ) ) {
			define( 'BRAND_EXTRA_FONTAWESOME_VER', '4.7.0' );
		}
		if ( ! defined( 'BRAND_EXTRA_VERSION' ) ) {
			define( 'BRAND_EXTRA_VERSION', '1.1' );
		}
		if ( ! defined( 'BRAND_ACTIVE' ) ) {
			// Retrieve active theme.
			$theme = wp_get_theme();
			$brand_active = $theme->template !== 'brand' ? false : true;
			define( 'BRAND_ACTIVE', $brand_active );
		}
	}


}

// Instantiate the plugin class.
$brand_extra_plugin = new Brand_Extra_Plugin();
