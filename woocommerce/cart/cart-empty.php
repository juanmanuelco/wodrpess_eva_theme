<?php
/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wc_print_notices();

?>


<div class="row cart-empty">
	<div class="large-10 text-center large-centered columns">

		<div class="empty-cart-box"><span></span></div>

		<h3 class="cart-empty-text"><?php esc_html_e( 'Your cart is currently empty.', 'woocommerce' ) ?></h3>
		
		<?php if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
			<p class="return-to-shop">
				<a class="button btn1 bshadow wc-backward" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
							<span><i class="fa fa-reply" aria-hidden="true"></i><?php _e( 'Return to shop', 'woocommerce' ) ?></span>
				</a>
			</p>
		<?php endif; ?>
	

	</div><!-- .large-10-->
</div><!-- .row-->