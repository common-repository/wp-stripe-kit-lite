<?php
namespace ALH_WP_Stripe_Kit_Lite;
/**
 * File for ALH_WP_Stripe_Kit_Lite\Uninstaller class
 *
 * @since		0.0.1
 * @package		ALH_WP_Stripe_Kit_Lite
 * @subpackage	ALH_WP_Stripe_Kit_Lite/includes
 */
/**
 * Uninstall operations.
 *
 * @since		0.0.1
 * @package		ALH_WP_Stripe_Kit_Lite
 * @subpackage	ALH_WP_Stripe_Kit_Lite/includes
 */
class Uninstaller{
	/**
	 * Uninstall plugin.
	 * @since	0.0.1
	 */
	public static function run(){
		Settings::delete_settings();
	}
}