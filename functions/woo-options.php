<?php 

/**
 * ------------------------------------------------------------------------------------------------
 * Remove product content link
 * ------------------------------------------------------------------------------------------------
 */
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals' );

add_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals' );
add_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 20 );

/**
 * ------------------------------------------------------------------------------------------------
 * WooCommerce enqueues 3 stylesheets by default. You can disable them all with the following snippet
 * ------------------------------------------------------------------------------------------------
 */

add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * ------------------------------------------------------------------------------------------------
 * Add photoswipe template to body
 * ------------------------------------------------------------------------------------------------
 */
add_action( 'eva_after_footer', 'eva_photoswipe_template', 1000 );
if( ! function_exists( 'eva_photoswipe_template' ) ) {
	function eva_photoswipe_template() {
		if( is_singular( 'product' ) )
			get_template_part('woocommerce/single-product/photoswipe');
	}
}

	//==============================================================================
	// WooCommerce Post Count Filter
	//==============================================================================

	if ( ! function_exists('eva_categories_postcount_filter') ) :
	function eva_categories_postcount_filter($variable) {
		$variable = str_replace('(', '', $variable);
		$variable = str_replace(')', '', $variable);
		return $variable;
	}
	add_filter('wp_list_categories','eva_categories_postcount_filter');
	endif;


	//==============================================================================
	// WooCommerce Layered Nav Filter
	//==============================================================================

	if ( ! function_exists('eva_layered_nav_postcount_filter') ) :
	function eva_layered_nav_postcount_filter($variable) {
		$variable = str_replace('(', '', $variable);
		$variable = str_replace(')', '', $variable);
		return $variable;
	}
	add_filter('woocommerce_layered_nav_count','eva_layered_nav_postcount_filter');
	endif;

/******************************************************************************/
/* WooCommerce Wrap Oembed Stuff **********************************************/
/******************************************************************************/
add_filter('embed_oembed_html', 'eva_embed_oembed_html', 99, 4);
function eva_embed_oembed_html($html, $url, $attr, $post_id) {
	return '<div class="video-container">' . $html . '</div>';
}

/**
 * ------------------------------------------------------------------------------------------------
 * WooCommerce Number of Related Products
 * ------------------------------------------------------------------------------------------------
 */
if( ! function_exists( 'woocommerce_output_related_products' ) ) {
	function woocommerce_output_related_products() {
		global $product, $woocommerce; 
		$atts = array(
			'posts_per_page' => '12',
			'orderby'        => 'rand'
		);
		woocommerce_related_products($atts);
	}
}

/**
 * ------------------------------------------------------------------------------------------------
 * Remove WooCommerce styles and scripts
 * ------------------------------------------------------------------------------------------------
 */

function eva_woo_remove_lightboxes() {
         
        // Styles
        wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
         
        // Scripts
        wp_dequeue_script( 'prettyPhoto' );
        wp_dequeue_script( 'prettyPhoto-init' );
        wp_dequeue_script( 'fancybox' );
        wp_dequeue_script( 'enable-lightbox' );
      
}
  
add_action( 'wp_enqueue_scripts', 'eva_woo_remove_lightboxes', 99 );

/**
 * ------------------------------------------------------------------------------------------------
 * Function returns numbers of items in the cart. Filter woocommerce fragments
 * ------------------------------------------------------------------------------------------------
 */

if( ! function_exists( 'eva_cart_data' ) ) {
	add_filter('woocommerce_add_to_cart_fragments', 'eva_cart_data', 30);
	function eva_cart_data( $array ) {
		ob_start();
		eva_cart_count();
		$count = ob_get_clean();
		
		ob_start();
		eva_cart_subtotal();
		$subtotal = ob_get_clean();
		
		$array['.cart-button .cart_items_number'] = $count;
		$array['.cart-button .cart_total'] = $subtotal;
		
		return $array;
	}
}

if( ! function_exists( 'eva_cart_count' ) ) {
	function eva_cart_count() {
		?>
			<span class="cart_items_number counter_number animated rubberBand"><?php echo esc_html(WC()->cart->get_cart_contents_count()); ?></span>
		<?php
	}
}

if( ! function_exists( 'eva_cart_subtotal' ) ) {
	function eva_cart_subtotal() {
		?>
			<span class="cart_total"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
		<?php
	}
}



if ( EVA_WOOCOMMERCE_IS_ACTIVE ) {

/******************************************************************************/
/*******Show Woocommerce Cart Widget Everywhere *******************************/
/******************************************************************************/

	if ( ! function_exists('eva_woocommerce_widget_cart_everywhere') ) :
	function eva_woocommerce_widget_cart_everywhere() { 
	    return false; 
	};
	add_filter( 'woocommerce_widget_cart_is_hidden', 'eva_woocommerce_widget_cart_everywhere', 10, 1 );
	endif;
	
}

/******************************************************************************/
/******* Ajax calls ***********************************************************/
/******************************************************************************/

function eva_refresh_dynamic_contents() {
	global $woocommerce, $yith_wcwl;
    $data = array(
        'cart_count_products' => class_exists('WooCommerce') ? WC()->cart->get_cart_contents_count() : 0,
        'wishlist_count_products' => class_exists('YITH_WCWL') ? yith_wcwl_count_products() : 0,
    );
	wp_send_json($data);
}
add_action( 'wp_ajax_eva_refresh_dynamic_contents', 'eva_refresh_dynamic_contents' );
add_action( 'wp_ajax_nopriv_eva_refresh_dynamic_contents', 'eva_refresh_dynamic_contents' );


/******************************************************************************/
/******* WooCommerce Reviews Tab **********************************************/
/******************************************************************************/

if ( ! function_exists('eva_rename_reviews_tab') ) :
	function eva_rename_reviews_tab($tabs) {
		global $product, $post;
		$reviews_tab_title = esc_html__( 'Reviews', 'woocommerce' ) . '<sup>' . $product->get_review_count() . '</sup>';
		return $reviews_tab_title;
	}
	add_filter( 'woocommerce_product_reviews_tab_title', 'eva_rename_reviews_tab', 98);
endif;


/******************************************************************************/
/* WooCommerce Remove Tabs Titles *********************************************/
/******************************************************************************/

if ( EVA_WOOCOMMERCE_IS_ACTIVE ) {	

	function eva_product_description_heading() {
	    echo "";
	}
	add_filter( 'woocommerce_product_description_heading', 'eva_product_description_heading' );

	
	function eva_product_additional_information_heading() {
	    echo "";
	}
	add_filter( 'woocommerce_product_additional_information_heading', 'eva_product_additional_information_heading' );
	
}


/******************************************************************************/
/****** WOO GET PRODUCT PER PAGE **********************************************/
/******************************************************************************/

	add_filter('loop_shop_per_page', 'eva_loop_shop_per_page');


	// get product count per page
	function eva_loop_shop_per_page() {
		global $tdl_options;

	    parse_str($_SERVER['QUERY_STRING'], $params);

	    // replace it with theme option
	    if ($tdl_options['tdl_product_count']) {
	        $per_page = explode(',', $tdl_options['tdl_product_count']);
	    } else {
	        $per_page = explode(',', '12,24,36');
	    }
	 
	    $item_count = !empty($params['count']) ? $params['count'] : $per_page[0];

	    return $item_count;
	}

/******************************************************************************/
/****** PRODUCT NAVIGATION ****************************************************/
/******************************************************************************/


if( ! function_exists( 'eva_products_nav' ) ) {
	function eva_products_nav() {
	    $next = get_next_post();
	    $prev = get_previous_post();

	    $next = ( ! empty( $next ) ) ? wc_get_product( $next->ID ) : false;
	    $prev = ( ! empty( $prev ) ) ? wc_get_product( $prev->ID ) : false;
		?>
			<div class="products-nav">
				<?php if ( ! empty( $prev ) ): ?>
				<div class="product-btn product-prev">
					<a href="<?php echo esc_url( $prev->get_permalink() ); ?>"><?php _e('Previous product', 'eva'); ?><i class="icon-px-solid-prev"></i></a>
					<div class="thb-wrapper">
						<div class="product-short">
							<a href="<?php echo esc_url( $prev->get_permalink() ); ?>" class="product-thumb">
								<?php echo $prev->get_image(); ?>
							</a>
							<h3><a href="<?php echo esc_url( $prev->get_permalink() ); ?>" class="product-title">
								<?php echo $prev->get_title(); ?>
							</a></h3>
							<span class="price">
								<?php echo $prev->get_price_html(); ?>
							</span>
						</div>
					</div>
				</div>
				<?php endif ?>

				<?php if ( ! empty( $next ) ): ?>
				<div class="product-btn product-next">
					<a href="<?php echo esc_url( $next->get_permalink() ); ?>"><?php _e('Next product', 'eva'); ?><i class="icon-px-solid-next"></i></a>
					<div class="thb-wrapper">
						<div class="product-short">
							<a href="<?php echo esc_url( $next->get_permalink() ); ?>" class="product-thumb">
								<?php echo $next->get_image(); ?>
							</a>
							<h3><a href="<?php echo esc_url( $next->get_permalink() ); ?>" class="product-title">
								<?php echo $next->get_title(); ?>
							</a></h3>
							<span class="price">
								<?php echo $next->get_price_html(); ?>
							</span>
						</div>
					</div>
				</div>
				<?php endif ?>
			</div>
		<?php
	}
}

/******************************************************************************/
/****** Back Button ***********************************************************/
/******************************************************************************/

if( ! function_exists( 'eva_back_button' ) ) {
	function eva_back_button() {
		?>
			<a href="#" class="back-btn"><span><?php esc_html_e('Back', 'eva') ?></span></a>
		<?php
	}
}

/******************************************************************************/
/****** Single Product Ajax Add to Cart ***************************************/
/******************************************************************************/


if( !function_exists( 'eva_ajax_single' ) ) {
	function eva_ajax_single() {
		global $woocommerce, $tdl_options;

		if ( EVA_WOOCOMMERCE_IS_ACTIVE  ) {
			if ( $tdl_options['tdl_product_addtocart_ajax'] ) :
				wp_register_script('eva-ajax-add-to-cart', get_template_directory_uri() . '/js/eva-ajax-add-to-cart.js', array('jquery'), '1.0', TRUE);
				wp_enqueue_script('eva-ajax-add-to-cart');
				wp_localize_script('eva-ajax-add-to-cart', 'eva_js_data_pr', array('cart_url' => $woocommerce->cart->get_cart_url()));
			endif;
		}	
	}

	add_action( 'wp_head', 'eva_ajax_single' );
}


/******************************************************************************/
/****** WOO REMOVE PRODUCT FROM CART ******************************************/
/******************************************************************************/


	if ( ! function_exists('eva_cart_product_remove')){
		function eva_cart_product_remove() {

    		global $wpdb, $woocommerce;

			$id = 0; 
			$variation_id = 0;
			
            if ( ! empty( $_REQUEST['product_id'] ) ) {
                $id = $_REQUEST['product_id'];
            }
            
            if ( ! empty( $_REQUEST['variation_id'] ) ) {
                $variation_id = $_REQUEST['variation_id'];
            }
                                                
            $cart = WC()->cart;
            
            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            	
            	    if ( ($cart_item['product_id'] == $id && $variation_id <= 0) || ($cart_item['variation_id'] == $variation_id && $variation_id > 0 ) ){
            	   		$cart->set_quantity($cart_item_key,0);	
					}           
		
            }
            if ( WC()->tax_display_cart == 'excl' ) {
				$totalamount  = wc_price(WC()->cart->get_cart_subtotal());
			} else {
				$totalamount  = wc_price(WC()->cart->cart_contents_total + WC()->cart->tax_total);
			} 	
   			
   			echo $totalamount;

			die();
    	}

    	add_action( 'wp_ajax_tdl_cart_product_remove', 'eva_cart_product_remove' );
		add_action( 'wp_ajax_nopriv_tdl_cart_product_remove', 'eva_cart_product_remove' );
	}


 ?>