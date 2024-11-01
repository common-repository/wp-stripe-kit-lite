<?php
namespace ALH_WP_Stripe_Kit_Lite;
const PLUGIN_NAMESPACE = 'ALH_WP_Stripe_Kit_Lite';
//error_log('The ALH WP Stripe Kit Lite bootstrap file');
/**
 * The WP Stripe Kit Lite bootstrap file
 *
 * WordPress plugin admin area information. Registers the activation, deactivation, unintall hooks and starts the plugin. Tested using Wordpress 4.9.6, PHP 7.0.8, Stripe API 2017-08-15,  Stripe PHP library 6.7.4. Stripe PHP library 6.7.4 included. PHP 5.4.0 or greater required. 
 *
 * @since			0.0.1
 * @package			ALH_WP_Stripe_Kit_Lite
 *
 * @wordpress-plugin
 * Plugin Name:		WP Stripe Kit Lite
 * Plugin URI:		https://www.lonhosford.com/wordpress-stripe-plugin-lite
 * Description:		Fast and simple way to accept payments using the Stripe service.
 * Version:			1.1.1
 * Author:			Alonzo Hosford DBA Click Systems Consulting LLC
 * Author URI:		https://www.lonhosford.com/
 * License:			GPL-2.0+
 * License URI:		http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:		alh-wp-stripe-kit-lite
 * Domain Path:		/languages
 */
// Not called within Wordpress framework
if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 * ALH_WP_Stripe_Kit_Lite\Activator.
 */
require_once plugin_dir_path( __FILE__ ) . '/includes/wp-stripe-kit-activator.class.php';
register_activation_hook(   __FILE__, array( PLUGIN_NAMESPACE . '\Activator', 'run' ) );

/**
 * ALH_WP_Stripe_Kit_Lite\Deactivator.
 */
require_once plugin_dir_path( __FILE__ ) . '/includes/wp-stripe-kit-deactivator.class.php';
register_deactivation_hook(   __FILE__, array( PLUGIN_NAMESPACE . '\Deactivator', 'run' ) );
/**
 * ALH_WP_Stripe_Kit_Lite\Uninstaller.
 */
require_once plugin_dir_path( __FILE__ ) . '/includes/wp-stripe-kit-uninstaller.class.php';
register_uninstall_hook(   __FILE__, array( PLUGIN_NAMESPACE . '\Uninstaller', 'run' ) );
/**
 * The core plugin class ALH_WP_Stripe_Kit.
 *
 * @see		ALH_WP_Stripe_Kit
 * @since	0.0.1
 */
require plugin_dir_path( __FILE__ ) . 'includes/wp-stripe-kit.class.php';
/**
 * Begin plugin execution.
 *
 * @since	0.0.1
 */
function run(){
	$plugin = new ALH_WP_Stripe_Kit(plugin_dir_path( __FILE__ ));
	$plugin->run();
}
run();
?>