<?php
/**
 * Main Brand Extra plugin class/file.
 *
 * @package brand-extra
 */

namespace Brand_Extra;

/**
 * Brand Extra class, so we don't have to worry about namespaces.
 */
class Brand_Extra {
	/**
	 * The instance *Singleton* of this class
	 *
	 * @var object
	 */
	private static $instance;

	/**
	 * The resulting page's hook_suffix, or false if the user does not have the capability required.
	 *
	 * @var boolean or string
	 */
	private $plugin_page;

	/**
	 * Free Brand plugins list.
	 *
	 * @var array
	 */
	public $free_brand_plugins = array(
		array(
			'slug' => 'brand-extra',
		),
		array(
			'slug' => 'brand-demo-import',
		),
		array(
			'slug' => 'preloader-plus',
		),
	);

	/**
	 * Free plugins list.
	 *
	 * @var array
	 */
	public $free_rec_plugins = array(
		array(
			'slug' => 'elementor',
		),
		array(
			'slug' => 'contact-form-7',
		),
		array(
			'slug' => 'woocommerce',
		),
	);

	/**
	 * Premium and no WP plugins list.
	 *
	 * @var array
	 */
	public $no_wp_plugins;

	/**
	 * Returns the *Singleton* instance of this class.
	 *
	 * @return Brand_Extra the *Singleton* instance.
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}


	/**
	 * Class construct function, to initiate the plugin.
	 * Protected constructor to prevent creating a new instance of the
	 * *Singleton* via the `new` operator from outside of this class.
	 */
	protected function __construct() {
		// Actions.
		if( BRAND_ACTIVE ) {
			add_action( 'admin_menu', array( $this, 'create_top_menu_page' ) );
			add_action( 'admin_menu', array( $this, 'remove_theme_submenu' ), 999 );
			add_action( 'admin_menu', array( $this, 'create_plugin_page' ) );
		} else {
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		}
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
		add_action( 'wp_ajax_brand_delete_notice', array( $this, 'brand_delete_notice' ) );

		// Loads files
		require_once BRAND_EXTRA_PATH . 'inc/widgets/widgets.php';
		require_once BRAND_EXTRA_PATH . 'inc/shortcodes/shortcodes.php';
		require_once BRAND_EXTRA_PATH . 'inc/brand-plugin-installer.php';

		$this->no_wp_plugins = array(
			array(
				'slug' 			  => 'brand-portfolio',
				'url' 			  => 'https://wp-brandtheme.com/downloads/brand-portfolio',
				'name' 			  => esc_html__( 'Brand Portfolio', 'brand-extra' ),
				'description' => esc_html__( 'Add an awesome portfolio in your Brand theme.', 'brand-extra' ),
				'icons' 		  => BRAND_EXTRA_URL . 'assets/img/brand-portfolio-icon-128x128.jpg',
				'author' 		  => esc_html__( 'Maxsdesign', 'brand-extra' ),
				'author_url' 	=> 'https://wp-brandtheme.com',
			),
			array(
				'slug' 			  => 'brand-import-export',
				'url' 			  => 'https://wp-brandtheme.com/downloads/brand-import-export',
				'name' 			  => esc_html__( 'Brand Import Export', 'brand-extra' ),
				'description' => esc_html__( 'Import and export Brand theme Customizer settings with one click.', 'brand-extra' ),
				'icons' 		  => BRAND_EXTRA_URL . 'assets/img/import-export-icon-128x128.jpg',
				'author' 		  => esc_html__( 'Maxsdesign', 'brand-extra' ),
				'author_url' 	=> 'https://wp-brandtheme.com',
			),
			array(
				'slug' 			  => 'brand-premium',
				'url' 			  => 'https://wp-brandtheme.com/downloads/brand-premium',
				'name' 			  => esc_html__( 'Brand Premium', 'brand-extra' ),
				'description' => esc_html__( 'A collection of extensions to add more features and options in your Brand theme.', 'brand-extra' ),
				'icons' 		  => BRAND_EXTRA_URL . 'assets/img/brand-premium-icon-128x128.jpg',
				'author' 		  => esc_html__( 'Maxsdesign', 'brand-extra' ),
				'author_url' 	=> 'https://wp-brandtheme.com',
			),
		);
	}


	/**
	 * Private clone method to prevent cloning of the instance of the *Singleton* instance.
	 *
	 * @return void
	 */
	private function __clone() {}


	/**
	 * Private unserialize method to prevent unserializing of the *Singleton* instance.
	 *
	 * @return void
	 */
	private function __wakeup() {}


	/**
	 * Creates the main settings page for Brand theme and its plugins if it doesn't exist.
	 */
	public function create_top_menu_page() {
		 global $admin_page_hooks;
		 if( empty( $admin_page_hooks['brand_setting_page'] )) {
			 add_menu_page(
	 				'Brand Theme',
	 				'Brand Theme',
	 				'manage_options',
	 				'brand_setting_page'
	 		);
		 }
	}

	/**
	 * Removes Brand theme settings page from the Appearance menu.
	 */
	public function remove_theme_submenu() {
 		remove_submenu_page( 'themes.php', 'brand_setting_page' );
 	}

	/**
	 * Creates the plugin page and a submenu item in Brand theme menu.
	 */
	public function create_plugin_page() {
		$plugin_page_setup = apply_filters( 'brand_extra/plugin_page_setup', array(
				'parent_slug' => 'brand_setting_page',
				'page_title'  => esc_html__( 'Brand Extra' , 'brand-extra' ),
				'menu_title'  => '<span class="dashicons dashicons-admin-plugins" style="font-size: 16px; color: #ec4848;"></span> <span style="color: #ec4848">' . esc_html__( 'Extensions', 'brand-extra' ) . '</span>',
				'capability'  => 'manage_options',
				'menu_slug'   => 'brand-extra',
			)
		);

		$this->plugin_page = add_submenu_page(
			$plugin_page_setup['parent_slug'],
			$plugin_page_setup['page_title'],
			$plugin_page_setup['menu_title'],
			$plugin_page_setup['capability'],
			$plugin_page_setup['menu_slug'],
			array( $this, 'display_plugin_page' )
		);
	}

	/**
	 * Plugin page display.
	 * Output (HTML) is in another file.
	 */
	public function display_plugin_page() {
		require_once BRAND_EXTRA_PATH . 'views/plugin-page.php';
	}

	/**
	 * Enqueue scripts (JS and CSS)
	 *
	 */
	public function enqueue_scripts() {

			wp_enqueue_style( 'brand-extra-front', BRAND_EXTRA_URL . 'assets/css/brand-extra.css', array() , BRAND_EXTRA_VERSION );
			// Loads FontAwesome stylesheet
			wp_enqueue_style( 'brand-extra-fontawesome', BRAND_EXTRA_URL . '/assets/font-awesome/css/font-awesome.min.css', BRAND_EXTRA_FONTAWESOME_VER );
	}

	/**
	 * Enqueue admin scripts (JS and CSS)
	 *
	 * @param string $hook holds info on which admin page you are currently loading.
	 */
	public function admin_enqueue_scripts( $hook ) {
		// Enqueue the scripts only on the plugin page.
		if ( $this->plugin_page === $hook ) {

			wp_enqueue_style( 'brand-extra-main', BRAND_EXTRA_URL . 'assets/admin/css/main.css', array() , BRAND_EXTRA_VERSION );
		}
		wp_enqueue_script( 'brand-extra-main-js', BRAND_EXTRA_URL . 'assets/admin/js/main.js' , array(), BRAND_EXTRA_VERSION );
		$brand_gift_notice_nonce = wp_create_nonce( 'brand_gift_notice_nonce' );
		wp_localize_script( 'brand-extra-main-js', 'brand_notice', array(
				'ajaxurl'   => admin_url( 'admin-ajax.php' ),
				'nonce'     => $brand_gift_notice_nonce,
				'notice'    => 'gift-notice',
		));
		wp_enqueue_style( 'brand-extra', BRAND_EXTRA_URL . 'assets/admin/css/brand-extra.css', array() , BRAND_EXTRA_VERSION );
	}

	/**
	 * Load the plugin textdomain, so that translations can be made.
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'brand-extra', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
	}

	/**
	 * Delete an admin notice.
	 */
	public function brand_delete_notice() {
		check_ajax_referer( 'brand_gift_notice_nonce' );
		if( isset( $_POST['notice'] ) ) {
			$notice = sanitize_text_field( $_POST['notice'] );
			if( set_transient( $notice, 'notice deleted', 7 * DAY_IN_SECONDS ) ) {
				$response = array(
					'error' => false,
				);
			} else {
				$response = array(
					'error' => true,
				);
			}
			wp_send_json( $response );
		}
	}
}
