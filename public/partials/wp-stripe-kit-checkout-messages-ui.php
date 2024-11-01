<?php
/**
 * Messaging HTML and Stripe JS
 *
 * @since      0.0.1
 *
 * @package    ALH_WP_Stripe_Kit_Lite
 * @subpackage ALH_WP_Stripe_Kit_Lite/public/partials
 */
?>
<p class="alh-wsk-lite-checkout-loading-message alh-wsk-lite-checkout-message alh-wsk-lite-center-text"><?php printf(__( '%s', 'alh-wp-stripe-kit-lite' ), $msg_loading);?></p>
<?php 
if (!$stripe_js_is_loaded){?>
<script src="https://checkout.stripe.com/checkout.js"></script>
<?php
	$stripe_js_is_loaded = true; 
}?>
<div class="alh-wsk-lite-checkout-btn-container alh-wsk-lite-center-text">
	<a href="#" class="alh-wsk-lite-pay-btn" data-id="<?php echo $id;?>"><?php echo $checkout_button_label;?></a>
</div>
<p class="alh-wsk-lite-checkout-processing-message alh-wsk-lite-checkout-message alh-wsk-lite-center-text"><?php printf(__( '%s', 'alh-wp-stripe-kit-lite' ), $msg_submitting);?></p>
<p class="alh-wsk-lite-checkout-success-message alh-wsk-lite-checkout-message alh-wsk-lite-center-text"><?php printf(__( '%s', 'alh-wp-stripe-kit-lite' ), $msg_success);?></p>
<p class="alh-wsk-lite-checkout-fail-message alh-wsk-lite-checkout-message alh-wsk-lite-center-text alh-wsk-lite-error-message-text"><?php printf(__( '%s', 'alh-wp-stripe-kit-lite' ), $msg_fail);?></p>