(function( $ ) {
	'use strict';
	var checkoutInProgress = false;
	$('.alh-wsk-lite-checkout-loading-message').hide();
	$('.alh-wsk-lite-checkout-btn-container').show();
	$('.alh-wsk-lite-pay-btn').click(function(e){
		if(checkoutInProgress === false){
			checkoutInProgress = true;
		 }else{
			return;e.preventDefault();
		}
		var $payBtn = $(this);
		var errorCount = 0;
		var containerId = $(this).data('id'); 
		var $container = $('#' + containerId);
		var $msgProcessing = $container.find( '.alh-wsk-lite-checkout-processing-message');
		var $msgSuccess = $container.find( '.alh-wsk-lite-checkout-success-message');
		var $msgFailed = $container.find( '.alh-wsk-lite-checkout-fail-message');
		var template = $container.find( '.alh-wsk-lite-template' ).val();
		var description = $container.find( '.alh-wsk-lite-description' ).val();
		var currency = $container.find( '.alh-wsk-lite-currency-code' ).val();


		var captureCustomerData  = $container.find( '.alh-wsk-lite-capture-customer-data' ).val();
		var companyName = $container.find( '.alh-wsk-lite-company-name' ).val();
		var stripeKey = $container.find( '.alh-wsk-lite-stripe-pk' ).val();
		var quantity = $container.find( '.alh-wsk-lite-quantity' ).val();
		var price = $container.find( '.alh-wsk-lite-price' ).val();
		var amount = Number((price * 100  * quantity).toFixed(2));
		var ajaxurl = alh_wsk_lite_vars.ajaxurl;
		var nonce = alh_wsk_lite_vars.nonce;
		var successUrl = $container.find( '.alh-wsk-lite-success-url' ).val();
		var failUrl = $container.find( '.alh-wsk-lite-fail-url' ).val();
		var dataSend = {};
		dataSend.alh_wsk_description = description;
		dataSend.alh_wsk_currency = currency;
		dataSend.action = $container.find( '.alh-wsk-lite-action' ).val();
		dataSend.alh_wsk_template = template;
		dataSend['_ajax_nonce'] = nonce;
		switch (template){
			case 'checkout-button':
				dataSend.alh_wsk_product_id = $container.find( '.alh-wsk-lite-product-id' ).val();
				dataSend.alh_wsk_price = price;
				dataSend.alh_wsk_amount = amount;
				dataSend.alh_wsk_quantity = quantity;
				dataSend.alh_wsk_statement_descriptor = $container.find( '.alh-wsk-lite-statement-descriptor' ).val();
			break;
			case 'subscription-button':
				dataSend.alh_wsk_plan_id = $container.find( '.alh-wsk-lite-stripe-plan-id' ).val();
			break;
		}
		if (!errorCount){
			var stripeConfig = {
				key:stripeKey,
				description:description,
				currency:currency,
				zipCode:true,
				name : companyName,
				closed:function(){
					checkoutInProgress = false;
				},
				token:function(token, args){
					dataSend.alh_wsk_stripe_token = token.id;
					dataSend.alh_wsk_receipt_email = token.email;
					if (typeof args.shipping_name !== "undefined") {
						dataSend.alh_wsk_has_shipping = true;
						dataSend.alh_wsk_shipping_name = args.shipping_name;
						dataSend.alh_wsk_shipping_address_1 = args.shipping_address_line1;
						dataSend.alh_wsk_shipping_address_city = args.shipping_address_city;
						dataSend.alh_wsk_shipping_address_state = args.shipping_address_state;
						dataSend.alh_wsk_shipping_address_postal_code = args.shipping_address_zip;
						dataSend.alh_wsk_shipping_address_country = args.shipping_address_country;
						dataSend.alh_wsk_shipping_address_country_code = args.shipping_address_country_code;
					}
					$msgProcessing.show();
					$payBtn.hide();
					$.ajax({
							type:"post",
							url:ajaxurl,
							data:dataSend,
							dataType:'json',
						})
						.done(function(data, status){
							$msgProcessing.hide();
							if (data.success){
								$msgSuccess.show();
								if (successUrl.length){
									window.location.href = successUrl;
								}
							}else{
								$msgFailed.show();
							}
							checkoutInProgress = false;
						})
						.fail(function(data, status, error){
							$msgProcessing.hide();
							$msgFailed.show();
							if (failUrl.length){
								window.location.href = failUrl;
							}
							checkoutInProgress = false;
						}
					); 
				}
			};
			if (captureCustomerData == 'true'){
				stripeConfig.billingAddress = true;
				stripeConfig.shippingAddress = true;
			}
			var stripeFormHandler = StripeCheckout.configure(stripeConfig);
			stripeFormHandler.open({
				amount:amount
			});
			$(window).on('popstate', function() {
				stripeFormHandler.close();
			});
		}else{
			$msgProcessing.hide();
		}
		e.preventDefault();
	});
})( jQuery );