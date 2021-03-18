<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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
	exit; // Exit if accessed directly
}

$tdl_options = eva_global_var();

	//woocommerce_before_single_product_summary
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
	
	add_action( 'woocommerce_before_single_product_summary_sale_flash', 'woocommerce_show_product_sale_flash', 10 );
	add_action( 'woocommerce_before_single_product_summary_product_images', 'woocommerce_show_product_images', 20 );
	
	//woocommerce_single_product_summary
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
	
	add_action( 'woocommerce_single_product_summary_single_title', 'woocommerce_template_single_title', 5 );
	add_action( 'woocommerce_single_product_summary_single_rating', 'woocommerce_template_single_rating', 10 );
	add_action( 'woocommerce_single_product_summary_single_price', 'woocommerce_template_single_price', 10 );
	add_action( 'woocommerce_single_product_summary_single_excerpt', 'woocommerce_template_single_excerpt', 20 );
	add_action( 'woocommerce_single_product_summary_single_add_to_cart', 'woocommerce_template_single_add_to_cart', 30 );
	add_action( 'woocommerce_single_product_summary_single_meta', 'woocommerce_template_single_meta', 40 );
	add_action( 'woocommerce_single_product_summary_single_sharing', 'woocommerce_template_single_sharing', 50 );
	
	//woocommerce_after_single_product_summary
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
	
	add_action( 'woocommerce_after_single_product_summary_data_tabs', 'woocommerce_output_product_data_tabs', 10 );

	//custom actions
	add_action( 'woocommerce_before_main_content_breadcrumb', 'woocommerce_breadcrumb', 20, 0 );
	add_action( 'woocommerce_product_summary_thumbnails', 'woocommerce_show_product_thumbnails', 20 );

	$product_design = (!empty($tdl_options['tdl_product_design'])) ? $tdl_options['tdl_product_design'] : 'default'; 
	if (isset($_GET["product_design"])) $product_design = $_GET["product_design"];
?>



<div class="page-header"></div>

<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

<div class="product_wrapper <?php echo esc_attr($product_design); ?>">
<div class="row">
	<div class="large-12 xlarge-10 xxlarge-9 large-centered columns"> 

	<?php
		/**
		 * woocommerce_before_single_product hook.
		 *
		 * @hooked wc_print_notices - 10
		 */
		 do_action( 'woocommerce_before_single_product' );

		 if ( post_password_required() ) {
		 	echo get_the_password_form();
		 	return;
		 }
	?>

		<div class="product_content_wrapper">

		<?php do_action( 'woocommerce_before_single_product' ); ?>

			<div class="row">

			<?php if (esc_attr($product_design) == "default") : ?>
				<div class="large-1 columns product_summary_thumbnails_wrapper">
					<div><?php do_action( 'woocommerce_product_summary_thumbnails' ); ?>&nbsp;</div>
				</div><!-- .columns -->	

				<div id="single-image" class="large-5 columns">				
			<?php else: ?>
				<div id="single-image" class="large-6 columns">				
			<?php endif; ?>

					<div class="product-images-wrapper">

						<?php				
							if ( (isset($tdl_options['tdl_catalog_mode'])) && ($tdl_options['tdl_catalog_mode'] == 0) ) {
								wc_get_template( 'loop/sale-flash.php' );
							}
							do_action( 'woocommerce_before_single_product_summary_product_images' );
							do_action( 'woocommerce_before_single_product_summary' );
						?>
					</div>
				</div><!-- .columns -->	
				


				<?php if (esc_attr($product_design) == "default") : ?>
				<div class="large-6 xxlarge-5 columns">
					<div class="product_infos">					
				<?php else: ?>
				<div class="large-6 xxlarge-5 columns" data-sticky-container>
					<div class="product_infos" data-sticky data-sticky-on="large" data-anchor="single-image" data-check-every="50" data-margin-top="7">		


				<?php endif; ?>

					<div class="product-inner-data">
							<div class="top_bar_shop_single">
								<?php eva_back_button() ?>
								<?php eva_products_nav(); ?>
								<div class="clearfix"></div>
							</div>


							 <div class="product_summary_top">

        						
								<?php
									do_action( 'woocommerce_single_product_summary_single_rating' );		
									do_action( 'woocommerce_single_product_summary_single_title' );
									
									if ( post_password_required() ) {
										echo get_the_password_form();
										return;
									}
								?>


							</div><!--.product_summary_top-->

						<?php
							do_action( 'woocommerce_single_product_summary_single_price' );
							do_action( 'woocommerce_single_product_summary_single_excerpt' );
							if ( (isset($tdl_options['tdl_catalog_mode'])) && ($tdl_options['tdl_catalog_mode'] == 0) ) {
								do_action( 'woocommerce_single_product_summary_single_add_to_cart' );
							}
						?>	

						<div class="product-buttons">
							<?php
								eva_share();
								eva_size_chart();
								do_action( 'woocommerce_single_product_summary' );

							?>								
						</div>
					</div>


					
					</div>

				</div><!-- .columns -->
			</div><!-- .row -->
		</div><!-- .product_content_wrapper -->

	</div><!-- .columns -->
</div><!-- .row -->
</div>

<div class="row">
	<div class="large-12 large-centered columns description-section">
		<?php do_action( 'woocommerce_single_product_summary_single_meta' ); ?>
		<?php do_action( 'woocommerce_after_single_product_summary_data_tabs' ); ?>
	</div><!-- .columns -->
</div><!-- .row -->

<div class="row">
	<div class="large-9 large-centered columns">
		<?php
			do_action( 'woocommerce_single_product_summary_single_sharing' );
			do_action( 'woocommerce_after_single_product_summary' );
		?>     
	</div><!-- .columns -->
</div><!-- .row -->

<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
