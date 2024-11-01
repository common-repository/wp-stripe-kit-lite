<?php
/**
 * HTTP request handler for subscription-button template
 *
 * @since		0.0.1
 *
 * @package		ALH_WP_Stripe_Kit_Lite
 * @subpackage	ALH_WP_Stripe_Kit_Lite/public/handlers
 */
try{
	// Create customer and add to plan. Stripe will charge customer.
	$customer = \Stripe\Customer::create( array(
			'source' => $token,
			'plan' => $plan_id,
			"description" => $description,
			'email' => $email,
			'metadata' => $metadata,
		)
	);
	$rtn_val["success"] = true;
//Stripe could not process request
}catch(\Stripe\Error\InvalidRequest $e){
	$rtn_val["error"]["id"] = 'payment_failed';
}