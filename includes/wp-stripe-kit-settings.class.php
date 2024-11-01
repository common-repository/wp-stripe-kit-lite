<?php
namespace ALH_WP_Stripe_Kit_Lite;
/**
 * File for the WP_Settings class
 *
 * @since		0.0.1
 *
 * @package		ALH_WP_Stripe_Kit_Lite
 * @subpackage	ALH_WP_Stripe_Kit_Lite/includes
 */
/**
 * Settings and Wordpress options
 *
 * @package		ALH_WP_Stripe_Kit_Lite
 * @subpackage	ALH_WP_Stripe_Kit_Lite/admin
  */
class Settings{
	/**
	 * @since	0.0.1
	 * @access	public
	 * @var		string
	 */
	const OPTION_GROUP = 'alh-wp-stripe-kit-lite-group';
	/**
	 * Option key for live mode on.
	 *
	 * @since	0.0.1
	 * @access	public
	 * @var		string	Option key for live mode on
	 */
	const LIVE_MODE_ON = 'alh_wp_stripe_kit_lite_live_mode_on';
	/**
	 * Option key for Stripe test mode secret key.
	 *
	 * @since	0.0.1
	 * @access	public
	 * @var		string	Option key for Stripe test mode secret key
	 */
	const TEST_MODE_SECRET_KEY = 'alh_wp_stripe_kit_lite_test_secret_key';
	/**
	 * Option key for Stripe test mode publish key.
	 *
	 * @since	0.0.1
	 * @access	public
	 * @var		string	Option key for Stripe test mode publish key
	 */
	const TEST_MODE_PUBLISH_KEY = 'alh_wp_stripe_kit_lite_test_publish_key';
	/**
	 * Option key for Stripe live mode secret key.
	 *
	 * @since	0.0.1
	 * @access	public
	 * @var		string	Option key for Stripe live mode secret key
	 */
	const LIVE_MODE_SECRET_KEY = 'alh_wp_stripe_kit_lite_live_secret_key';
	/**
	 * Option key for Stripe live mode publish key.
	 *
	 * @since	0.0.1
	 * @access	public
	 * @var		string	Option key for Stripe live mode publish key
	 */
	const LIVE_MODE_PUBLISH_KEY = 'alh_wp_stripe_kit_lite_live_publish_key';
	/**
	 * Option key for checkout button normal state.
	 *
	 * @since	0.0.1
	 * @access	public
	 * @var		string	CSS
	 */
	const CHECKOUT_BUTTON_CSS_NORMAL = 'alh_wp_stripe_kit_lite_checkout_button_css_normal';
	/**
	 * Option key for checkout button hover state.
	 *
	 * @since	0.0.1
	 * @access	public
	 * @var		string	CSS
	 */
	const CHECKOUT_BUTTON_CSS_HOVER = 'alh_wp_stripe_kit_lite_checkout_button_css_hover';
	/**
	 * Option key for checkout button active state.
	 *
	 * @since	0.0.1
	 * @access	public
	 * @var		string	CSS
	 */
	const CHECKOUT_BUTTON_CSS_ACTIVE = 'alh_wp_stripe_kit_lite_checkout_button_css_active';
	/**
	 * Save the settings on uninstalling the plugin
	 *
	 * @since	0.0.1
	 * @access	public
	 * @var		string	on or blank
	 */
	const UNINSTALL_SAVE_SETTINGS = 'alh_wp_stripe_kit_lite_uninstall_save_settings';
	/**
	 * Constructor
	 *
	 * @since	0.0.1
	 */
	public function __construct(){
		self::initialize_settings();
	}
	/**
	 * Update options registered.
	 *
	 * @since	0.0.1
	 */
	public static function update_settings() {
		register_setting(
			self::OPTION_GROUP,
			self::LIVE_MODE_ON);
		register_setting(
			self::OPTION_GROUP,
			self::TEST_MODE_PUBLISH_KEY);
		register_setting(
			self::OPTION_GROUP,
			self::TEST_MODE_SECRET_KEY );
		register_setting(
			self::OPTION_GROUP,
			self::LIVE_MODE_SECRET_KEY );
		register_setting(
			self::OPTION_GROUP,
			self::LIVE_MODE_PUBLISH_KEY );
		register_setting(
			self::OPTION_GROUP,
			self::CHECKOUT_BUTTON_CSS_NORMAL );
		register_setting(
			self::OPTION_GROUP,
			self::CHECKOUT_BUTTON_CSS_HOVER );
		register_setting(
			self::OPTION_GROUP,
			self::CHECKOUT_BUTTON_CSS_ACTIVE );
		register_setting(
			self::OPTION_GROUP,
			self::UNINSTALL_SAVE_SETTINGS );
	}
	/**
	 * Delete options.
	 *
	 * @since	0.0.1
	 */
	public static function delete_settings(){
		$option_save_settings = self::UNINSTALL_SAVE_SETTINGS;
		$save_settings = get_option($option_save_settings);
		if ( !isset( $save_settings ) || $save_settings != "on" ) {
			delete_option( self::LIVE_MODE_ON );
			delete_option( self::TEST_MODE_SECRET_KEY );
			delete_option( self::TEST_MODE_PUBLISH_KEY );
			delete_option( self::LIVE_MODE_SECRET_KEY );
			delete_option( self::LIVE_MODE_PUBLISH_KEY );
			delete_option( self::CHECKOUT_BUTTON_CSS_NORMAL );
			delete_option( self::CHECKOUT_BUTTON_CSS_HOVER );
			delete_option( self::CHECKOUT_BUTTON_CSS_ACTIVE );
			delete_option( self::UNINSTALL_SAVE_SETTINGS );
		}
	}
	/**
	 * Initialize options.
	 *
	 * @since	0.0.1
	 */
	public static function initialize_settings(){
		$checkout_button_styles = new Checkout_Button_Styles();
		if ($checkout_button_styles->is_valid()){
			$id = self::CHECKOUT_BUTTON_CSS_NORMAL;
			$css_props = $checkout_button_styles->get_props($id);
			add_option($id, $css_props);

			$id = self::CHECKOUT_BUTTON_CSS_HOVER;
			$css_props = $checkout_button_styles->get_props($id);
			add_option($id, $css_props);

			$id = self::CHECKOUT_BUTTON_CSS_ACTIVE;
			$css_props = $checkout_button_styles->get_props($id);
			add_option($id, $css_props);
		}
	}
	/**
	 * Get the checkout button CSS properties.
	 *
	 * @since	0.0.1
	 * @return	array	The normal, hover and active CSS properties
	 */
	public static function get_checkout_button_css_props(){
		$props = array();
		$props[self::CHECKOUT_BUTTON_CSS_NORMAL] = get_option(self::CHECKOUT_BUTTON_CSS_NORMAL);
		$props[self::CHECKOUT_BUTTON_CSS_HOVER] = get_option(self::CHECKOUT_BUTTON_CSS_HOVER);
		$props[self::CHECKOUT_BUTTON_CSS_ACTIVE] = get_option(self::CHECKOUT_BUTTON_CSS_ACTIVE);
		return $props;
	}
	/**
	 * Active Stripe secret API key from settings.
	 *
	 * @since	0.0.1
	 * @return	string	The Stripe secret API key.
	 */
	public static function get_sk(){
		$sk = get_option(self::TEST_MODE_SECRET_KEY);
		if (esc_attr( get_option(self::LIVE_MODE_ON) ) == "on"){
			$sk = get_option(self::LIVE_MODE_SECRET_KEY);
		}
		return $sk;
	}
	/**
	 * Active Stripe public API key from settings.
	 *
	 * @since	0.0.1
	 * @return	string	The Stripe public API key.
	 */
	public static function get_pk(){
		$pk = get_option(self::TEST_MODE_PUBLISH_KEY);
		if (esc_attr( get_option(self::LIVE_MODE_ON) ) == "on"){
			$pk = get_option(self::LIVE_MODE_PUBLISH_KEY);
		}
		return $pk;
	}
}