<?php
/**
 * HTTP request handler for checkout-button template
 *
 * @since		0.0.1
 *
 * @package		ALH_WP_Stripe_Kit_Lite
 * @subpackage	ALH_WP_Stripe_Kit_Lite/public/handlers
 */
try{
	// Create a Stripe\Charge OOP object
	$charge = \Stripe\Charge::create(array(
		'amount' => $amount_in_cents,
		'currency' => $currency,
		'source' => $token,
		'receipt_email' => $email,
		'statement_descriptor' => $descriptor,
		'description' => $description,
		'metadata' => $metadata,
		)
	);
	$rtn_val["success"] = true;
//Stripe could not process request
}catch(\Stripe\Error\InvalidRequest $e){
	$rtn_val["error"]["id"] = 'payment_failed';
}