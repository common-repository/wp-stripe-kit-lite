(function( $ ) {
	'use strict';
	$('#alh-wsk-lite-checkout-button-css-restore').click(function(e){
		var $cssRestore = $(this);
		var $adminAction = $cssRestore.data('admin-action');
		var $wpAction = $cssRestore.data('wp-action');
		var $normalId = $cssRestore.data('normal-id');
		var $hoverId = $cssRestore.data('hover-id');
		var $activeId = $cssRestore.data('active-id');
		$('#' + $normalId).val('...loading...');
		$('#' + $hoverId).val('...loading...');
		$('#' + $activeId).val('...loading...');
		var dataSend = {};
		dataSend.alh_wsk_lite_admin_action = $adminAction;
		dataSend['_ajax_nonce'] = alh_wsk_lite_vars.nonce;
		dataSend.action = $wpAction;
		$.ajax({
				type:"post",
				url:alh_wsk_lite_vars.ajaxurl,
				data:dataSend,
				dataType:'json',
			})
			.done(function(data, status){
				if (data.success){
					$('#' + data.normal.id).val(data.normal.css);
					$('#' + data.hover.id).val(data.hover.css);
					$('#' + data.active.id).val(data.active.css);
				}
			})
			.fail(function(data, status, error){});
		e.preventDefault();
	});
})( jQuery );