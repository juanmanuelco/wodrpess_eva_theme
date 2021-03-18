jQuery(document).ready(function($) {
	"use strict";

	$(document).on("click", ".single_add_to_cart_button", function() {
		
		if($(this).hasClass('product_type_variable')) return true;
		
		if(parseInt(jQuery.data(document.body, "processing")) == 1) return false;
		
		jQuery.data(document.body, "processing", 1);
		jQuery.data(document.body, "processed_once", 0);
		
		var context = this;
		
		var form = $(this).closest('form');
		var button_default_cursor = $("button").css('cursor');
		

		$("button").addClass("loading");
		
		function isElementInViewport (el) {
			if (typeof jQuery === "function" && el instanceof jQuery) {
				el = el[0];
			}
		}

		$.ajax( {
			type: "POST",
			url: form.attr( 'action' ),
			data: form.serialize(),
			success: function( response ) 
			{
	
				$("button").removeClass("loading");

				$('.cd-quick-view').removeClass("is-visible");

				$('.cd-quick-view').hide();

				$('.offcanvas_search').hide();
				$('.offcanvas_sizechart').hide();
				$('.offcanvas_minicart').show();
				$('body').removeClass('overlay-layer');
				setTimeout(function(){
				$("body").addClass("offcanvas_for_cart");

				var right_cart_offCanvasIn = [{
				  e: $(".offcanvas_minicart"),
				  p: {
				    opacity: [1, 0]
				  },
				  o: {
				    duration: 700,
				    delay: 800
				  }
				}];				

				  $.Velocity.RunSequence(right_cart_offCanvasIn);

				window.offcanvas_right();
				}, 100);

				updateCartButtons(response);
				
				
				if($(response).find('.woocommerce-error').length > 0) 
				{
					var div_to_insert = getMessageParentDiv(response, 'woocommerce-error');
					
					if($(document).find('.woocommerce-error').length > 0)
					{

					}
					else
					{
						$(div_to_insert).before($(response).find('.woocommerce-error').wrap('<div>').parent().html());
					}
					
					var is_in_viewport = isElementInViewport($(document).find('.woocommerce-error'));
					
					
					jQuery.data(document.body, "processing", 0);
				} 
				else if($(response).find('.woocommerce-message').length > 0) 
				{
					var div_to_insert = getMessageParentDiv(response, 'woocommerce-message');
					
					if($(document).find('.woocommerce-message').length > 0)
					{

					}
					else
					{
					}

					
					var is_in_viewport = isElementInViewport($(document).find('.woocommerce-message'));
					
					if(!is_in_viewport) 
					{

					}
					
					jQuery.data(document.body, "processing", 0);
				}
				
		
				jQuery.data(document.body, "processed_once", 1);
			}
		} );
		
		return false;
	});
	
	function getCartUrl() 
	{
		return eva_js_data_pr.cart_url;
	}
	
	function getCartButtons() 
	{
		return $("a[href='"+getCartUrl()+"']:visible");
	}
	
	function getMessageParentDiv(response, woocommerce_msg) 
	{
		var default_dom = $(".product.type-product:eq(0)");
		
		if(default_dom.length > 0) 
		{
			return default_dom;
		}
		else
		{
			var scheck_parent_div = $(response).find("."+woocommerce_msg).parent();
			var id = $(response).find("."+woocommerce_msg).parent().attr('id');
			
			if(id)
			{
				return $("#"+id).children().eq($("#"+id).children().length-1);
			}
			else
			{
				var classes = $(response).find("."+woocommerce_msg).parent().attr('class');
				return $(document).find("div[class='"+classes+"']").children().eq($(document).find("div[class='"+classes+"']").children().length-1);
			}
		}
	}
	
	function updateCartButtons(new_source) 
	{
		$(new_source).find('.woocommerce-error').remove();
		$(new_source).find('.woocommerce-message').remove();
		
		var cart_buttons_length = getCartButtons().length;

		if(cart_buttons_length > 0)
		{
			getCartButtons().each(function(index) {
				if($(new_source).find("a[href='"+getCartUrl()+"']:visible").eq(index).length > 0)
				{
					$(this).replaceWith($(new_source).find("a[href='"+getCartUrl()+"']:visible").eq(index));
				}
			});
		}
		
		var $supports_html5_storage = ( 'sessionStorage' in window && window['sessionStorage'] !== null );
		var $fragment_refresh = {
			url: woocommerce_params.ajax_url,
			type: 'POST',
			data: { action: 'woocommerce_get_refreshed_fragments' },
			success: function( data ) {
				if ( data && data.fragments ) {

					$.each( data.fragments, function( key, value ) {
						$(key).replaceWith(value);
					});

					if ( $supports_html5_storage ) {
						sessionStorage.setItem( "wc_fragments", JSON.stringify( data.fragments ) );
						sessionStorage.setItem( "wc_cart_hash", data.cart_hash );
					}

					$('body').trigger( 'wc_fragments_refreshed' );
				}
			}
		};

		$.ajax($fragment_refresh);
	}
});