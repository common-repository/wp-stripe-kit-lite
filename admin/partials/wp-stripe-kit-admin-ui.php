<?php
/**
 * Admin UI include file.
 *
 * @since      0.0.1
 *
 * @package    WP_Stripe_Kit_Lite
 * @subpackage WP_Stripe_Kit_Lite/admin/partials
 */
?>
<div class="wrap">
	<h2 class="alh-wsk-lite-heading-2"><?php _e('WP Stripe Kit Lite Settings','alh-wp-stripe-kit-lite'); ?></h2>
	<form method="post" action="options.php">
		<?php settings_fields($option_group); ?>
		<?php do_settings_sections($option_group); ?>
		<div>
			<p class="alh-wsk-lite-heading-1"><strong><?php _e('Stripe Options','alh-wp-stripe-kit-lite'); ?></strong></p>
		</div>
		<div class="alh-wsk-lite-input-label alh-wsk-lite-input-label-lh" ><?php _e('Live Mode','alh-wp-stripe-kit-lite'); ?></div>
		<div class="alh-wsk-lite-flipswitch">
			<input type="checkbox" name="<?php echo $live_mode_on;?>" class="alh-wsk-lite-flipswitch-cb" id="<?php echo $live_mode_on;?>" <?php echo esc_attr( get_option($live_mode_on) ) == 'on' ? 'checked="checked"' : ''; ?>>
			<label class="alh-wsk-lite-flipswitch-label" for="<?php echo $live_mode_on ?>">
				<div class="alh-wsk-lite-flipswitch-inner"></div>
				<div class="alh-wsk-lite-flipswitch-switch"></div>
			</label>
		</div>
		<div>
			<p><?php _e('Add your Stripe API keys from your','alh-wp-stripe-kit-lite'); ?> <a href="https://dashboard.stripe.com/account/apikeys" target="_blank"><?php _e('Stripe Dashboard','alh-wp-stripe-kit-lite'); ?></a></p>
		</div>
		<div>
			<strong><label for="<?php echo $test_sk;?>" class="alh-wsk-lite-input-label"><?php _e('Test Secret Key:','alh-wp-stripe-kit-lite'); ?></label></strong><br>
			<input type="text" name="<?php echo $test_sk;?>" value="<?php echo get_option($test_sk); ?>" class="alh-wsk-lite-input-text-field" />
		</div>
		<div>
			<strong><label for="<?php echo $test_pk;?>" class="alh-wsk-lite-input-label"><?php _e('Test Publish Key:','alh-wp-stripe-kit-lite'); ?></label></strong><br>
			<input type="text" name="<?php echo $test_pk;?>" value="<?php echo get_option($test_pk); ?>" class="alh-wsk-lite-input-text-field" />
		</div>
		<div>
			<strong><label for="<?php echo $live_sk;?>" class="alh-wsk-lite-input-label"><?php _e('Live Secret Key:','alh-wp-stripe-kit-lite'); ?></label></strong><br>
			<input type="text" name="<?php echo $live_sk;?>" value="<?php echo get_option($live_sk); ?>" class="alh-wsk-lite-input-text-field" />
		</div>
		<div>
			<strong><label for="<?php echo $live_pk;?>" class="alh-wsk-lite-input-label"><?php _e('Live Publish Key:','alh-wp-stripe-kit-lite'); ?></label></strong><br>
			<input type="text" name="<?php echo $live_pk;?>" value="<?php echo get_option($live_pk); ?>" class="alh-wsk-lite-input-text-field" />
		</div>
		<div>
			<p class="alh-wsk-lite-heading-1"><strong><?php _e('Checkout Button CSS Properties','alh-wp-stripe-kit-lite'); ?></strong></p>
			<p><?php _e('CSS was created using','alh-wp-stripe-kit-lite'); ?> <a href="http://www.bestcssbuttongenerator.com" target="_blank">http://www.bestcssbuttongenerator.com</a>.</p>
		<div>
		<div>
			<p class="alh-wsk-lite-label"><strong><?php _e('Replace CSS Properties Below With Default?','alh-wp-stripe-kit-lite'); ?> <a href="#" id="alh-wsk-lite-checkout-button-css-restore" class="alh-wsk-lite-link-button" data-wp-action="<?php echo $wp_action;?>" data-admin-action="get-checkout-button-default-css" data-normal-id="<?php echo $checkout_button_normal_css;?>" data-hover-id="<?php echo$checkout_button_hover_css;?>" data-active-id="<?php echo $checkout_button_active_css;?>"><?php _e('Yes','alh-wp-stripe-kit-lite'); ?></a></strong></p>
		</div>
		<div>
			<strong><label for="<?php echo $checkout_button_normal_css;?>" class="alh-wsk-lite-input-label"><?php _e('Normal State:','alh-wp-stripe-kit-lite'); ?></label></strong><br>
			<textarea type="text" name="<?php  echo $checkout_button_normal_css;?>" id="<?php echo $checkout_button_normal_css;?>" class="alh-wsk-lite-input-textarea-field" /><?php echo get_option($checkout_button_normal_css); ?></textarea>
		</div>
		<div>
			<strong><label for="<?php echo $checkout_button_hover_css;?>" class="alh-wsk-lite-input-label"><?php _e('Hover State:','alh-wp-stripe-kit-lite'); ?></label></strong><br>
			<textarea type="text" name="<?php echo $checkout_button_hover_css;?>" id="<?php echo$checkout_button_hover_css;?>" class="alh-wsk-lite-input-textarea-field" /><?php echo get_option($checkout_button_hover_css); ?></textarea>
		</div>
		<div>
			<strong><label for="<?php echo $checkout_button_active_css;?>" class="alh-wsk-lite-input-label"><?php _e('Active (Down) State:','alh-wp-stripe-kit-lite'); ?></label></strong><br>
			<textarea type="text" name="<?php echo $checkout_button_active_css;?>" id="<?php echo$checkout_button_active_css;?>" class="alh-wsk-lite-input-textarea-field" /><?php echo get_option($checkout_button_active_css); ?></textarea>
		</div>
		<div>
			<input type="checkbox" name="<?php echo$uninstall_save_settings;?>" id="<?php echo $uninstall_save_settings;?>" <?php echo esc_attr( get_option($uninstall_save_settings) ) == 'on' ? 'checked="checked"' : ''; ?>>
			<span><?php _e( 'Preserve your settings when uninstalling this plugin.<br>Overrides Wordpress default of deleting plugin data when deleting plugin. Useful when upgrading or re-installing.', 'alh-wp-stripe-kit-lite' ); ?></span>
		</div>
		<?php submit_button(); ?>
	</form>
</div>
