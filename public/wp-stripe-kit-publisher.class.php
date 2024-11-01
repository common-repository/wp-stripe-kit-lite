<?php
namespace ALH_WP_Stripe_Kit_Lite;
/**
 * File for the ALH_WP_Stripe_Kit_Lite\Publisher class.
 *
 * @since		0.0.1
 *
 * @package		ALH_WP_Stripe_Kit_Lite
 * @subpackage	ALH_WP_Stripe_Kit_Lite\public
 */
/**
 * Publish and process content
 *
 * Registers stylesheet and JavaScript for WP admin. Handles shortcodes. Handles WP admin Ajax requests.
 *
 * @package		ALH_WP_Stripe_Kit_Lite
 * @subpackage	ALH_WP_Stripe_Kit_Lite/public
 */
class Publisher{
	/**
	 * Wordpress Action associated with WP ajax_handler action.
	 *
	 * @since	0.0.1
	 * @access	public
	 * @var		string	Action
	 */
	const WP_ACTION = 'alh_wp_stripe_kit_lite_public_form';
	/**
	 * Initialize the class.
	 *
	 * @since	0.0.1
	 */
	public function __construct(){}
	/**
	 * Register the stylesheets.
	 *
	 * @since	0.0.1
	 * @see		ALH_WP_Stripe_Kit::define_public_hooks()
	 */
	public function enqueue_styles(){
		wp_enqueue_style( 
			ALH_WP_Stripe_Kit::get_plugin_id() . '-public-css', 
			plugin_dir_url( __FILE__ ) . 'css/wp-stripe-kit-public.css', 
			array(), 
			ALH_WP_Stripe_Kit::get_version(), 
			'all' );
	}
	/**
	 * Register the JavaScript.
	 *
	 * @since	0.0.1
	 * @see		ALH_WP_Stripe_Kit::define_public_hooks()
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( 
			ALH_WP_Stripe_Kit::get_plugin_id() . '-public-js', 
			plugin_dir_url( __FILE__ ) . 'js/wp-stripe-kit-public.js',
			array( 'jquery' ), 
			ALH_WP_Stripe_Kit::get_version(), true );

		$the_nonce = wp_create_nonce(ALH_WP_Stripe_Kit::NONCE);
		wp_localize_script( 
			ALH_WP_Stripe_Kit::get_plugin_id() . '-public-js', // Handle 
			ALH_WP_Stripe_Kit::LOCAL_JS_VAR,
			array( 
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'nonce' => $the_nonce
			)
		);
	}
	/**
	 * Register shortcodes.
	 *
	 * @since	0.0.1
	 * @see		ALH_WP_Stripe_Kit::define_public_hooks()
	 */
	public function register_shortcodes() {
		add_shortcode( 'wp-stripe-kit-lite', array( $this, 'process_shortcode_wsl_stripe_kit' ) );
	}
	/**
	 * Shortcode wp-stripe-kit-lite.
	 * Syntax:	[wp-stripe-kit-lite ...][/wp-stripe-kit-lite]
	 * Attribute		Description
	 * ---------		-----------
	 * template		Values:
	 * 				checkout-button
	 * 				subscription-button
	 * 				Default: checkout-button
	 * name			Name Stripe Checkout form
	 * description	Description of payment
	 * descriptor	Statement descriptor checkout-button template.
	 *				Default: description
	 * currency_code
	 *				ISO curency code.
	 *				Default: USD
	 * price		Price per unit ex: 9.99 
	 * quantity		Quantity for checkout-button template.
	 *				Default: 1
	 * stripe_capture_customer_data
	 *				Stripe checkout form captures billing and shipping data. Shipping sent to Stripe in meta data. Appears in payment for checkout-button and in customer for subscription-button.
	 *				Default: false
	 * msg_loading	Optional string with or without HTML for button in place message while Stripe JS is loading.
	 * 				Default = Loading ...
	 * msg_submitting	Optional string with or without HTML for button in place message while payment is being processed on Stripe.
	 * 				Default = Processing ...
	 * msg_success	Optional string with or without HTML for button in place message is payment on Stripe succeeds.
	 * 				Default = Thank you for your order!.
	 * msg_fail	URL Optional string with or without HTML for button in place message is payment on Stripe fails.
	 * 				Default = Something went horribly wrong!.
	 * success_url	URL redirect on successful checkout
	 * fail_url		URL redirect on unsuccessful checkout
	 * product_id	Product id for checkout-button template.  Send to stripe in metadata.
	 * 				Default = description
	 * stripe_plan_id
	 *				Stripe plan id for subscription-button template.
	 * checkout_button_label
	 *				Label for checkout button
	 * 				Default: Checkout
	*/
	public function process_shortcode_wsl_stripe_kit( $attributes, $content = null ) {
		static $checkout_button_style_props_loaded = false;
		static $stripe_js_is_loaded = false;
		$id = uniqid(ALH_WP_Stripe_Kit::get_dom_id_prefix());
		// Replace dashes in attributes key names and copy to $attributes_cleaned
		$attributes_cleaned = array();
		foreach($attributes as $key => $value) {
			$k = str_replace('-', '_', $key);
			$attributes_cleaned[$k] = $value;
		}
		extract( shortcode_atts( array(
			'template' => 'checkout-button',
			'name' => '',
			'description' => '',
			'descriptor' => '',
			'currency_code' => 'USD',
			'price' => 0,
			'quantity' => 1,
			'stripe_capture_customer_data' => 'false',
			'msg_loading' => __('Loading ...','alh-wp-stripe-kit-lite'),
			'msg_submitting' => __('Processing ...','alh-wp-stripe-kit-lite'),
			'msg_success' => __('Thank you for your order!','alh-wp-stripe-kit-lite'),
			'msg_fail' => __('Something went horribly wrong!','alh-wp-stripe-kit-lite'),
			'success_url' => '',
			'fail_url' => '',
			'product_id' => '',
			'stripe_plan_id' => '',
			'checkout_button_label' => 'Checkout'
		), $attributes_cleaned ) );
		//error_log('$attributes_cleaned: ' . print_r($attributes_cleaned,true));
		$template = strtolower($template);
		$capture_customer_data = strtolower($stripe_capture_customer_data);
		// Default statement descriptor
		if (!strlen($descriptor)){ 
			$descriptor = $description;
		}
		// Clean disallowed statement descriptor characters.
		$descriptor = str_replace(array('<', '>', '"', "'"), '', $descriptor);
		if (!strlen($product_id)){ 
			$product_id = $description;
		}
		$rtn = '';
		// Add checkout button style element
		if (!$checkout_button_style_props_loaded){
			$checkout_button_style_props_loaded = true;
			$button_style_props = Settings::get_checkout_button_css_props();
			$rtn .= '<style>';
			$rtn .= '.alh-wsk-lite-pay-btn{';
			$rtn .= $button_style_props[Settings::CHECKOUT_BUTTON_CSS_NORMAL];
			$rtn .= '}';
			$rtn .= '.alh-wsk-lite-pay-btn:hover{';
			$rtn .= $button_style_props[Settings::CHECKOUT_BUTTON_CSS_HOVER];
			$rtn .= '}';
			$rtn .= '.alh-wsk-lite-pay-btn:active{';
			$rtn .= $button_style_props[Settings::CHECKOUT_BUTTON_CSS_ACTIVE];
			$rtn .= '}';
			$rtn .= '</style>';
		}
		$stripe_pk = Settings::get_pk();
		$wp_form_action = self::WP_ACTION;
		$rtn .= '<div id="' . $id . '"';
		$rtn .= ' class="alh-wsk-lite-button-container alh-wsk-lite-center-text">';
		switch ($template){
			case 'subscription-button':
				ob_start();
				include dirname(__FILE__) . '/partials/wp-stripe-kit-checkout-common-ui.php';
				include dirname(__FILE__) . '/partials/wp-stripe-kit-subscription-button-ui.php';
				include dirname(__FILE__) . '/partials/wp-stripe-kit-checkout-messages-ui.php';
				$rtn .= ob_get_clean();
			break;
			case 'checkout-button':
			default:
				ob_start();
				include dirname(__FILE__) . '/partials/wp-stripe-kit-checkout-common-ui.php';
				include dirname(__FILE__) . '/partials/wp-stripe-kit-checkout-button-ui.php';
				include dirname(__FILE__) . '/partials/wp-stripe-kit-checkout-messages-ui.php';
				$rtn .= ob_get_clean();
			break;
		}
		$rtn .= '</div><!-- ' . $id . ' -->';
		//error_log('$rtn: ' . htmlentities($rtn));
		return $rtn;
	}
	/**
	 * Processes the Stripe checkout.
	 *
	 * Reminder the instance is new.
	 * Return values:
	 * 					success true | false default false
	 * 					error added for ui error handing
	 * 						id = request_missing_data | request_invalid | payment_failed | plugin-conflict-stripe
	 *
	 * @return json $rtn_val 
	*/
	public function ajax_button_form_handler(){
		//error_log(print_r($_POST,true));
		// Assume error state
		$rtn_val['success'] = false;
		// Metadata for Stripe
		$metadata = array();
		// Flag missing request data
		$missing_request_data = false;
		// Another theme or plugin has Stripe class declared.
		$min_stripe_version = ALH_WP_Stripe_Kit::get_stripe_min_version();
		$max_stripe_version = ALH_WP_Stripe_Kit::get_stripe_max_version();
		$can_process = false;
		if ( class_exists( 'Stripe\Stripe' ) ) {
			$stripe_version = \Stripe\Stripe::VERSION;
			if (
					version_compare ( $stripe_version, $min_stripe_version, '<' ) 
				|| 
					version_compare ( $stripe_version, $max_stripe_version, '>' ) 
				){
				$rtn_val["error"]["id"] = 'plugin-conflict-stripe';
				$rtn_val["error"]["message"] = 'Unsupported Stripe version ' . $stripe_version  .' already loaded possibly by another plugin or theme. See PHP error log for more details.' ;
				error_log(ALH_WP_Stripe_Kit::PLUGIN_NAME . ': ' . $rtn_val["error"]["message"]); 
				error_log(ALH_WP_Stripe_Kit::PLUGIN_NAME . ' Stripe versions supported: ' . $min_stripe_version . ' to ' . $max_stripe_version); 
			}else{
				$can_process = true;
			}
		}else{
			// Load the Stripe library
			include_once ALH_WP_Stripe_Kit::get_path_to_stripe_lib() . 'init.php';
			$can_process = true;
		}
		if($can_process){
			// Set currency
			$currency = 'USD';
			if (array_key_exists("alh_wsk_currency", $_POST)){
				$currency = sanitize_text_field( $_POST['alh_wsk_currency'] );
			}
			// Required common fields
			if (	!isset($_POST)
				||	!array_key_exists("alh_wsk_template", $_POST)
				||	!array_key_exists("_ajax_nonce", $_POST)
				||	!array_key_exists("alh_wsk_stripe_token", $_POST)
				||	!array_key_exists("alh_wsk_receipt_email", $_POST)
				||	!array_key_exists("alh_wsk_description", $_POST)
				){
				$missing_request_data = true;
			// Prepare common fields
			}else{
				$template = $_POST['alh_wsk_template'];
				$token = sanitize_text_field( $_POST['alh_wsk_stripe_token'] );
				$email = $_POST['alh_wsk_receipt_email'];
				$description = sanitize_text_field( $_POST['alh_wsk_description'] );
				$metadata['email'] = $email;
			}
			// Required subscription-button fields
			if ($template == 'subscription-button'){
				if (	!$missing_request_data
					&&	!array_key_exists("alh_wsk_plan_id", $_POST)
					){
					$missing_request_data = true;
				// Prepare subscription-form fields
				}else{
					$plan_id = sanitize_text_field( $_POST['alh_wsk_plan_id'] );
				}
			}
			// Required checkout-button fields
			if ($template == 'checkout-button'){
				if (	!$missing_request_data
					&&	(
							!array_key_exists("alh_wsk_product_id", $_POST)
						||	!array_key_exists("alh_wsk_amount", $_POST)
						||	!array_key_exists("alh_wsk_price", $_POST)
						||	!array_key_exists("alh_wsk_quantity", $_POST)
						||	!array_key_exists("alh_wsk_statement_descriptor", $_POST)
						)
					){
					$missing_request_data = true;
				// Prepare checkout-button fields
				}else{
					$metadata['product_id'] = sanitize_text_field( $_POST['alh_wsk_product_id']);
					$price = (float) $_POST['alh_wsk_price'];
					$quantity = (float) $_POST['alh_wsk_quantity'];
					$amount = (float) $_POST['alh_wsk_amount'];
					$amount_in_cents = $amount;
					$metadata['price'] = $price;
					$metadata['quantity'] = $quantity;
					$descriptor = sanitize_text_field( $_POST['alh_wsk_statement_descriptor'] );
					$descriptor = substr(strtoupper($descriptor), 0, 22);
				}
			}
			// Customer data fields require validation
			if (	!$missing_request_data 
				&&	array_key_exists("alh_wsk_has_shipping", $_POST) 
				&&	$_POST['alh_wsk_has_shipping']){
				// Validate customer data fields
				if (	!array_key_exists("alh_wsk_shipping_name", $_POST)
					||	!array_key_exists("alh_wsk_shipping_address_1", $_POST)
					||	!array_key_exists("alh_wsk_shipping_address_city", $_POST)
					||	!array_key_exists("alh_wsk_shipping_address_state", $_POST)
					||	!array_key_exists("alh_wsk_shipping_address_postal_code", $_POST)
					||	!array_key_exists("alh_wsk_shipping_address_country", $_POST)
					||	!array_key_exists("alh_wsk_shipping_address_country_code", $_POST)
				){
					$missing_request_data = true;
				// Prepare customer data fields
				}else{
					$metadata['shipping_name'] = sanitize_text_field( $_POST['alh_wsk_shipping_name'] );
					$metadata['shipping_address_line_1'] = sanitize_text_field( $_POST['alh_wsk_shipping_address_1'] );
					$metadata['shipping_city'] = sanitize_text_field( $_POST['alh_wsk_shipping_address_city'] );
					$metadata['shipping_state'] = sanitize_text_field( $_POST['alh_wsk_shipping_address_state'] );
					$metadata['shipping_postal_code'] = sanitize_text_field( $_POST['alh_wsk_shipping_address_postal_code'] );
					$metadata['shipping_country'] = sanitize_text_field( $_POST['alh_wsk_shipping_address_country'] );
					$metadata['shipping_country_code'] = sanitize_text_field( $_POST['alh_wsk_shipping_address_country_code'] );
				}
			}
			// Set request data missing response
			if ($missing_request_data){
				$rtn_val["error"]["id"] = 'request_missing_data';
			}
			// Check if nonce is valid. 
			if (!$missing_request_data){
				// Second argument false = use _ajax_nonce value in $_REQUEST.
				// Third argument false = do not die if invalid nonce
				$is_valid_referer = check_ajax_referer( ALH_WP_Stripe_Kit::NONCE, false, false );
				if(!$is_valid_referer){
					$rtn_val["error"]["id"] = 'request_invalid';
				}
			}
			// No errors, process the request
			if(!isset($rtn_val["error"])){
				$sk = Settings::get_sk();
				\Stripe\Stripe::setApiKey($sk);
				// Select partial using the $_POST template key
				include_once dirname(__FILE__) . '/handlers/wp-stripe-kit-' . $template . '-handler.inc.php';
			}
		}
		//error_log(print_r($rtn_val,true));
		//Respond with JSON content
		header('Content-Type: application/json');
		echo json_encode( $rtn_val );
		wp_die();
	}
}