<?php

/******************************************************************************/
/* WooCommerce Product Quick View *********************************************/
/******************************************************************************/

if ( EVA_WOOCOMMERCE_IS_ACTIVE ) {	

	// Enqueue wc-add-to-cart-variation

	function eva_product_quick_view_scripts() {	
		wp_enqueue_script('wc-add-to-cart-variation');
	}
	add_action( 'wp_enqueue_scripts', 'eva_product_quick_view_scripts' );

	
	// Load The Product

	function eva_product_quick_view_fn() {		
		if (!isset( $_REQUEST['product_id'])) {
			die();
		}
		$product_id = intval($_REQUEST['product_id']);
		// wp_query for the product
		wp('p='.$product_id.'&post_type=product');
		ob_start();
		get_template_part( 'woocommerce/quick-view' );
		echo ob_get_clean();
		die();
	}	
	add_action( 'wp_ajax_eva_product_quick_view', 'eva_product_quick_view_fn');
	add_action( 'wp_ajax_nopriv_eva_product_quick_view', 'eva_product_quick_view_fn');

	
	// Show Quick View Button

	function eva_product_quick_view_button() {
		global $product;
		$tdl_options = eva_global_var();

		$quickview_color = get_field('tdl_qickview_color');

		if ( (isset($tdl_options['tdl_quick_view'])) && ($tdl_options['tdl_quick_view'] == 1) ) :
			echo '<a href="#" id="product_id_' . $product->get_id() . '" class="button eva_product_quick_view_button '. $quickview_color .'" data-product_id="' . $product->get_id() . '">' . esc_html__( 'Quick View', 'eva') . '</a>';
		endif;
	}
	add_action( 'woocommerce_before_shop_loop_item', 'eva_product_quick_view_button', 5 );
	
}