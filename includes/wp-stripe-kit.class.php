<?php
namespace ALH_WP_Stripe_Kit_Lite;
/**
 * File for the ALH_WP_Stripe_Kit class
 *
 * @since		0.0.1
 *
 * @package		ALH_WP_Stripe_Kit_Lite
 * @subpackage	ALH_WP_Stripe_Kit_Lite/includes
 */
/**
 * The core plugin class.
 *
 * @since		0.0.1
 * @package		ALH_WP_Stripe_Kit_Lite
 * @subpackage	ALH_WP_Stripe_Kit_Lite/includes
 */
class ALH_WP_Stripe_Kit {
	/**
	 * Name of the plugin
	 *
	 * @since	0.0.1
	 * @access	public
	 * @var		string
	 */
	const PLUGIN_NAME = 'WP Stripe Kit Lite';
	/**
	 * The unique identifier of this plugin.
	 *
	 * @since	0.0.1
	 * @access	private
	 * @var		string	$plugin_id
	 */
	private static $plugin_id = 'alh-wp-stripe-kit-lite';
	/**
	 * The prefix to use in the DOM for element ids
	 *
	 * @since	0.0.1
	 * @access	private
	 * @var		string	$dom_id_prefix
	 */
	private static $dom_id_prefix = 'alh-wsk-lite';
	/**
	 * The Wordpress nonce for check_ajax_referer.
	 *
	 * @since	0.0.1
	 * @access	public
	 * @var		string	Nonce
	 */
	const NONCE = 'alh_wsk_lite_nonce';
	/**
	 * Local Javascript var name.
	 *
	 * @since	0.0.1
	 * @access	public
	 * @var		string	Local Javascript var name.
	 */
	const LOCAL_JS_VAR = 'alh_wsk_lite_vars';
	/**
	 * The loader for maintaining and registering all hooks to WP.
	 *
	 * @since	0.0.1
	 * @access	protected
	 * @var		WP_Stripe_Kit_Lite/Loader	$loader	Maintains and registers all hooks to WP.
	 */
	protected $loader;
	/**
	 * The current version of the plugin.
	 *
	 * @since	0.0.1
	 * @access	private
	 * @var		string	$version	The current version of the plugin.
	 */
	private static $version = '1.0.1';
	/**
	 * The path to the plugin folder.
	 *
	 * @since	0.0.1
	 * @access	private
	 * @var		string	$plugin_dir_path	The path to the plugin folder.
	 */
	private static $plugin_dir_path;
	/**
	 * The folder name Stripe PHP library as child of vendors folder.
	 *
	 * @since	0.0.1
	 * @access	private
	 * @var		string	$stripe_dirname	Stripe base folder name no slashes
	 */
	//private static $stripe_dirname = 'stripe-php-3.4.0';
	//private static $stripe_dirname = 'stripe-php-3.19.0';
	private static $stripe_dirname = 'stripe-php-6.7.4';
	/**
	 * Minimum Stripe version
	 *
	 * @since	1.1.1
	 * @access	private
	 * @var		string 
	 */
	private static $stripe_min_version = '3.19.0';
	/**
	 * Maximum Stripe version
	 *
	 * @since	1.1.1
	 * @access	private
	 * @var		string 
	 */
	private static $stripe_max_version = '6.7.4';
	/**
	 * Minimum PHP version
	 *
	 * @since	0.0.1
	 * @access	private
	 * @var		string	$php_version	Stripe folder name
	 */
	private static $php_version = '5.4.0';
	/**
	 * Initiate the core functionality.
	 *
	 * Set the plugin name.
	 * Set the plugin version.
	 * Load the dependencies.
	 * Define the locale.
	 * Set the WP hooks.
	 *
	 * @param	string	$plugin_dir_path	The path to the plugin folder.
	 * @since	0.0.1
	 */
	public function __construct($plugin_dir_path) {
		self::$plugin_dir_path = $plugin_dir_path;
		$this->load_dependencies();
		$this->set_locale();
		$this->define_common_hooks();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}
	/**
	 * Load the required dependencies.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - ALH_WP_Stripe_Kit_Lite\Settings. Wordpress options.
	 * - ALH_WP_Stripe_Kit_Lite\Loader. Orchestrates the hooks of the plugin.
	 * - ALH_WP_Stripe_Kit_Lite\i18n. Defines internationalization functionality.
	 * - ALH_WP_Stripe_Kit_Lite\Admin. Defines all hooks for the admin area.
	 * - ALH_WP_Stripe_Kit_Lite\Publisher. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks with WordPress.
	 *
	 * @since	0.0.1
	 * @access	private
	 */
	private function load_dependencies(){
		/**
		 * ALH_WP_Stripe_Kit_Lite\Settings.
		 */
		require_once self::$plugin_dir_path . '/includes/wp-stripe-kit-settings.class.php';
		/**
		 * ALH_WP_Stripe_Kit_Lite\Checkout_Button_Styles.
		 */
		require_once self::$plugin_dir_path . '/includes/wp-stripe-kit-checkout-button-styles.class.php';
		/**
		 * ALH_WP_Stripe_Kit_Lite\Loader.
		 */
		require_once self::$plugin_dir_path . '/includes/wp-stripe-kit-loader.class.php';
		/**
		 * ALH_WP_Stripe_Kit_Lite\i18n.
		 */
		require_once self::$plugin_dir_path . '/includes/wp-stripe-kit-i18n.class.php';
		/**
		 * ALH_WP_Stripe_Kit_Lite\Admin.
		 */
		require_once self::$plugin_dir_path . '/admin/wp-stripe-kit-admin.class.php';
		/**
		 * ALH_WP_Stripe_Kit_Lite\Publisher.
		 */
		require_once self::$plugin_dir_path . '/public/wp-stripe-kit-publisher.class.php';
		$this->loader = new Loader();
	}
	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the ALH_WP_Stripe_Kit_Lite\i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since	0.0.1
	 * @access	private
	 */
	private function set_locale() {
		$plugin_i18n = new i18n();
		$this->loader->add_action( 
			'plugins_loaded', 
			$plugin_i18n, 
			'load_plugin_textdomain');
	}
	/**
	 * Register all the admin hooks.
	 *
	 * @since	0.0.1
	 * @access	private
	 */
	private function define_common_hooks(){
		$plugin_settings = new Settings();
		$this->loader->add_action( 'admin_init', $plugin_settings, 'update_settings' );
	}
	/**
	 * Register all the admin hooks.
	 *
	 * @since	0.0.1
	 * @access	private
	 */
	private function define_admin_hooks(){
		$plugin_admin = new Admin();

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 
			'wp_ajax_' . $plugin_admin::WP_ACTION, 
			$plugin_admin, 'ajax_handler' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'wp_stripe_kit_register_admin_menu' );
	}
	/**
	 * Register all the public hooks
	 *
	 * Contains ALH_WP_Stripe_Kit_Lite\Publisher.
	 *
	 * @since	0.0.1
	 * @access	private
	 */
	private function define_public_hooks(){
		$plugin_publisher = new Publisher();
		$this->loader->add_action( 'init', $plugin_publisher, 'register_shortcodes' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_publisher, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_publisher, 'enqueue_scripts' );
		$this->loader->add_action( 
			'wp_ajax_' . $plugin_publisher::WP_ACTION, 
			$plugin_publisher, 'ajax_button_form_handler' );
		$this->loader->add_action( 
			'wp_ajax_nopriv_' . $plugin_publisher::WP_ACTION, 
			$plugin_publisher, 'ajax_button_form_handler' );
	}
	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since	0.0.1
	 */
	public function run(){
		$this->loader->run();
	}
	/**
	 * The unique name of the plugin.
	 *
	 * @since	0.0.1
	 * @return	string	Plugin name.
	 */
	public static function get_plugin_id(){
		return self::$plugin_id;
	}
	/**
	 * The DOM id prefix.
	 *
	 * @since	0.0.1
	 * @return	string	The DOM id prefix.
	 */
	public static function get_dom_id_prefix(){
		return self::$dom_id_prefix;
	}
	/**
	 * The reference to ALH_WP_Stripe_Kit\Loader.
	 *
	 * @since	0.0.1
	 * @return	ALH_WP_Stripe_Kit_Lite\Loader
	 */
	public function get_loader(){
		return $this->loader;
	}
	/**
	 * Retrieve the plugin version number.
	 *
	 * @since	0.0.1
	 * @return	string	The plugin version number.
	 */
	public static function get_version(){
		return self::$version;
	}
	/**
	 * Get minimum version number of Stripe.
	 *
	 * @since	0.0.1
	 * @return	string
	 */
	public static function get_stripe_min_version(){
		return self::$stripe_min_version;
	}
	/**
	 * Get maximum version number of Stripe.
	 *
	 * @since	0.0.1
	 * @return	string
	 */
	public static function get_stripe_max_version(){
		return self::$stripe_max_version;
	}
	/**
	 * Path to the Stripe library with trailing slash.
	 *
	 * @since	0.0.1
	 * @return	string	Path to Stripe library with trailing slash.
	 */
	public static function get_path_to_stripe_lib(){
		$path_to_stripe_lib = self::get_path_to_plugin() . 'vendors/' . self::$stripe_dirname . '/';
		return $path_to_stripe_lib;
	}
	/**
	 * Path to plugin directory with trailing slash
	 *
	 * @since	0.0.1
	 * @return	string	Path to plugin directory with trailing slash.
	 */
	public static function get_path_to_plugin(){
		return self::$plugin_dir_path;
	}
}