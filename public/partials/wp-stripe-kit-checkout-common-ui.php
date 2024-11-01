<?php
/**
 * Common UI for Stripe
 *
 * @since		0.0.1
 *
 * @package		ALH_WP_Stripe_Kit_Lite
 * @subpackage	ALH_WP_Stripe_Kit_Lite/public/partials
 */
?>
<input type="hidden" class="alh-wsk-lite-stripe-pk" value="<?php echo $stripe_pk; ?>"/>
<input type="hidden" class="alh-wsk-lite-action" name="action" value="<?php echo $wp_form_action; ?>"/>
<input type="hidden" class="alh-wsk-lite-template" value="<?php echo $template; ?>"/>
<input type="hidden" class="alh-wsk-lite-currency-code" value="<?php echo $currency_code; ?>"/>
<input type="hidden" class="alh-wsk-lite-price" value="<?php echo $price; ?>"/>
<input type="hidden" class="alh-wsk-lite-capture-customer-data" value="<?php echo $capture_customer_data; ?>"/>
<input type="hidden" class="alh-wsk-lite-company-name" value="<?php echo $name; ?>"/>
<input type="hidden" class="alh-wsk-lite-description" value="<?php echo $description; ?>"/>
<input type="hidden" class="alh-wsk-lite-success-url" value="<?php echo $success_url; ?>"/>
<input type="hidden" class="alh-wsk-lite-fail-url" value="<?php echo $fail_url; ?>"/>