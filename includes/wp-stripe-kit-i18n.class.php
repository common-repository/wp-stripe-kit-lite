<?php
namespace ALH_WP_Stripe_Kit_Lite;
/**
 * File for the ALH_WP_Stripe_Kit_Lite\i18n class.
 *
 * @since		0.0.1
 *
 * @package		ALH_WP_Stripe_Kit_Lite
 * @subpackage	ALH_WP_Stripe_Kit_Lite/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin so that it is ready for translation.
 *
 * @since		0.0.1
 * @package		ALH_WP_Stripe_Kit_Lite
 * @subpackage	ALH_WP_Stripe_Kit_Lite/includes
 */
class i18n {
	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since	0.0.1
	 */
	public function load_plugin_textdomain() {
//error_log('load_plugin_textdomain');
//error_log(basename(ALH_WP_Stripe_Kit::get_path_to_plugin()).'/languages/');
//error_log(dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/');



		load_plugin_textdomain(
			'alh-wp-stripe-kit-lite',
			false,
			//dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
			basename(ALH_WP_Stripe_Kit::get_path_to_plugin()) . '/languages/'
		);
	}
}