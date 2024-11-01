<?php
namespace ALH_WP_Stripe_Kit_Lite;
/**
 * File for the ALH_WP_Stripe_Kit_Lite\Checkout_Button_Styles class
 *
 * @since		0.0.1
 *
 * @package		ALH_WP_Stripe_Kit_Lite
 * @subpackage	ALH_WP_Stripe_Kit_Lite/includes
 */
/**
 * CSS properties for checkout button.
 *
 * @package		ALH_WP_Stripe_Kit_Lite
 * @subpackage	ALH_WP_Stripe_Kit_Lite/admin
  */
class Checkout_Button_Styles{
	/**
	 * Style settings.
	 *
	 * @since	0.0.1
	 * @access	private
	 * @var		array	$style_options
	 */
	private $style_options = array();
	/**
	 * Style settings.
	 *
	 * @since	0.0.1
	 * @access	private
	 * @var		boolean	$is_valid
	 */
	private $is_valid = false;
	/**
	 * Constructor
	 *
	 * @since	0.0.1
	 * @param	string	$style_type. Only valid type is a.
	 */
	public function __construct($style_type = "a"){
		$style_type = strtolower($style_type);
		$this->style_options[Settings::CHECKOUT_BUTTON_CSS_NORMAL] = '';
		$this->style_options[Settings::CHECKOUT_BUTTON_CSS_HOVER] = '';
		$this->style_options[Settings::CHECKOUT_BUTTON_CSS_ACTIVE] = '';
		self::load($style_type);
	}
	/**
	 * Gets the style props by settings option name
	 *
	 * @since	0.0.1
	 * @param	string
	 * @return	string	The style properties. Default is empty string.
	 */
	public function get_props($settings_option_name){
		$style_props = '';
		if (isset($this->style_options[$settings_option_name])){
			$style_props = $this->style_options[$settings_option_name];
		}
		return $style_props;
	}
	/**
	 * If the style properties are valid.
	 *
	 * @since	0.0.1
	 * @param	string
	 * @return	boolean
	 */
	public function is_valid(){
		return $this->is_valid;
	}
	/**
	 * Load the css properties
	 *
	 * @since	0.0.1
	 * @param	string	$style_type
	 * @return	void 
	 */
	private function load($style_type){
		try{
			$this->style_options[Settings::CHECKOUT_BUTTON_CSS_NORMAL] = file_get_contents(ALH_WP_Stripe_Kit::get_path_to_plugin() . 'includes/wp-stripe-kit-admin-checkout-button-style-' . $style_type . '-normal.php');
			$this->style_options[Settings::CHECKOUT_BUTTON_CSS_HOVER] = file_get_contents(ALH_WP_Stripe_Kit::get_path_to_plugin() . 'includes/wp-stripe-kit-admin-checkout-button-style-' . $style_type . '-hover.php');
			$this->style_options[Settings::CHECKOUT_BUTTON_CSS_ACTIVE] = file_get_contents(ALH_WP_Stripe_Kit::get_path_to_plugin() . 'includes/wp-stripe-kit-admin-checkout-button-style-' . $style_type . '-active.php');
			$this->is_valid = true;
		}catch(Exception $e){
			$this->is_valid = false;
		}
	}
}