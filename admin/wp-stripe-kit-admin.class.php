<?php
namespace ALH_WP_Stripe_Kit_Lite;
/**
 * File for the ALH_WP_Stripe_Kit_Lite\Admin class
 *
 * @since		0.0.1
 *
 * @package		ALH_WP_Stripe_Kit_Lite
 * @subpackage	ALH_WP_Stripe_Kit_Lite/admin
 */
/**
 * The admin functionality.
 *
 * @package		ALH_WP_Stripe_Kit_Lite
 * @subpackage	ALH_WP_Stripe_Kit_Lite/admin
*/
class Admin {
	/**
	 * Wordpress Action associated with WP ajax_handler action.
	 *
	 * @since	0.0.1
	 * @access	public
	 * @var		string	Action
	 */
	const WP_ACTION = 'alh_wp_stripe_kit_lite_admin_form';
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since	0.0.1
	 */
	public function __construct(){}
	/**
	 * Admin Menu registered.
	 *
	 * @since	0.0.1
	 * @see		ALH_WP_Stripe_Kit::define_admin_hooks()
	 */
	public function wp_stripe_kit_register_admin_menu(){
		$page_title = ALH_WP_Stripe_Kit::PLUGIN_NAME;
		$menu_title = ALH_WP_Stripe_Kit::PLUGIN_NAME;
		$capability = 'manage_options';
		$menu_slug  = 'alh-wp-stripe-kit-lite';
		$function   = 'display_menu_form';
		$icon_url   = 'dashicons-media-code';
		add_menu_page(	$page_title,
						$menu_title, 
						$capability, 
						$menu_slug, 
						array($this, $function),
						$icon_url);
	}
	/**
	 * Menu form
	 *
	 * @since	0.0.1
	 * @see wp_stripe_kit_register_admin_menu()
	 */
	public function display_menu_form(){
		$wp_action = self::WP_ACTION;
		$option_group = Settings::OPTION_GROUP;
		$live_mode_on = Settings::LIVE_MODE_ON;
		$test_sk = Settings::TEST_MODE_SECRET_KEY;
		$test_pk = Settings::TEST_MODE_PUBLISH_KEY;
		$live_sk = Settings::LIVE_MODE_SECRET_KEY;
		$live_pk = Settings::LIVE_MODE_PUBLISH_KEY;
		$checkout_button_normal_css = Settings::CHECKOUT_BUTTON_CSS_NORMAL;
		$checkout_button_hover_css = Settings::CHECKOUT_BUTTON_CSS_HOVER;
		$checkout_button_active_css = Settings::CHECKOUT_BUTTON_CSS_ACTIVE;
		$uninstall_save_settings = Settings::UNINSTALL_SAVE_SETTINGS;
		include_once dirname(__FILE__) . '/partials/wp-stripe-kit-admin-ui.php';
	}
	/**
	 * Update settings registered.
	 *
	 * @since	0.0.1
	 * @see		ALH_WP_Stripe_Kit::define_admin_hooks()
	 */
	public function update_settings() {
		Settings::update_settings();
	}
	/**
	 * Register the stylesheets. 
	 *
	 * @since	0.0.1
	 * @see		ALH_WP_Stripe_Kit::define_admin_hooks()
	 */
	public function enqueue_styles(){
		/*
			wp_enqueue_style(
				Name of the stylesheet. Should be unique.
				File source
				Stylesheets it depends on
				Stylesheet version number added to URL for cache busting purposes
				Stylesheet media attribute value
			);
		*/
		wp_enqueue_style( 
			ALH_WP_Stripe_Kit::get_plugin_id() . '-admin-css',
			plugin_dir_url( __FILE__ ) . 'css/wp-stripe-kit-admin.css', 
			array(),
			ALH_WP_Stripe_Kit::get_version(),
			'all' );
	}
	/**
	 * Register the JavaScript.
	 *
	 * @since	0.0.1
	 * @see		ALH_WP_Stripe_Kit::define_admin_hooks()
	 */
	public function enqueue_scripts(){
		/*
			wp_enqueue_script(
				Name of the script. Should be unique.
				File source
				Scripts it depends on
				Script version number added to URL for cache busting purposes
				Enqueue the script before </body>
			);
		*/ 
		wp_enqueue_script( 
			ALH_WP_Stripe_Kit::get_plugin_id() . '-admin-js',
			plugin_dir_url( __FILE__ ) . 'js/wp-stripe-kit-admin.js',
			array( 'jquery' ),
			ALH_WP_Stripe_Kit::get_version(),
			true );

		$the_nonce = wp_create_nonce(ALH_WP_Stripe_Kit::NONCE);
		wp_localize_script( 
			ALH_WP_Stripe_Kit::get_plugin_id() . '-admin-js', // Handle 
			ALH_WP_Stripe_Kit::LOCAL_JS_VAR, // JS vars name
			array( 
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'nonce' => $the_nonce
			)
		);
	}
	/**
	 * Processes the Stripe checkout.
	 *
	 * Reminder the instance is new.
	 * Return values:
	 * 					success true | false default false
	 * 					error added for ui error handing
	 * 						id = request_missing_data | request_invalid | payment_failed
	 *
	 * @return json $rtn_val 
	*/
	public function ajax_handler(){
		//error_log(print_r($_POST,true));
		// Assume false
		$rtn_val['success'] = false;
		// Validate common required fields. 
		if (	!isset($_POST)
			||	!array_key_exists("alh_wsk_lite_admin_action", $_POST)
			||	!array_key_exists("_ajax_nonce", $_POST)
			){
			$rtn_val["error"]["id"] = 'request_missing_data';
		}else{
			// Check if nonce is valid. 
			// Second argument false = use _ajax_nonce value in $_REQUEST.
			// Third argument false = do not die if invalid nonce
			$is_valid_referer = check_ajax_referer( ALH_WP_Stripe_Kit::NONCE, false, false );
			if($is_valid_referer){
				if ($_POST['alh_wsk_lite_admin_action'] == 'get-checkout-button-default-css'){
					$checkout_button_styles = new Checkout_Button_Styles();
					if ($checkout_button_styles->is_valid()){
						$id = Settings::CHECKOUT_BUTTON_CSS_NORMAL;
						$rtn_val['normal']['id'] = $id;
						$rtn_val['normal']['css'] = $checkout_button_styles->get_props($id);
						$id = Settings::CHECKOUT_BUTTON_CSS_HOVER;
						$rtn_val['hover']['id'] = $id;
						$rtn_val['hover']['css'] = $checkout_button_styles->get_props($id);
						$id = Settings::CHECKOUT_BUTTON_CSS_ACTIVE;
						$rtn_val['active']['id'] = $id;
						$rtn_val['active']['css'] = $checkout_button_styles->get_props($id);
						$rtn_val['success'] = true;
					}else{
						$rtn_val["error"]["id"] = 'request_failed';
					}
				}
			}else{
				$rtn_val["error"]["id"] = 'request_invalid';
			}
		}
		//error_log(print_r($rtn_val,true));
		//Respond with JSON content
		header('Content-Type: application/json');
		echo json_encode( $rtn_val );
		wp_die();
	}
}