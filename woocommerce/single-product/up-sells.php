<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$tdl_options = eva_global_var();

if ( ( !isset($tdl_options['tdl_related_products_per_view']) ) ) {
	$related_products_per_view = 4;
} else {
	$related_products_per_view = $tdl_options['tdl_related_products_per_view'];
}

if ( $upsells ) : ?>

	<div class="upsells products">

		<div class="row">
		    <div class="large-12 large-centered columns">

			    <div id="products-carousel" data-per-view="<?php echo esc_attr($related_products_per_view); ?>">

					<h2 class="products-upsells-title carousel-title"><?php esc_html_e( 'You may also like&hellip;', 'woocommerce' ) ?></h2>
	 

		            <ul id="products" class="products products-grid owl-carousel owl-theme">

						<?php foreach ( $upsells as $upsell ) : ?>

							<?php
							 	$post_object = get_post( $upsell->get_id() );

								setup_postdata( $GLOBALS['post'] =& $post_object );

								wc_get_template_part( 'content', 'product' ); ?>

						<?php endforeach; ?>

		            </ul>

		        </div>

			</div>
		</div>

	</div>

<?php endif;

wp_reset_postdata();
