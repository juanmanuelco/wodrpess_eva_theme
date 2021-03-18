<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
	
	global $post, $product;
	$tdl_options = eva_global_var();

	$pwrapper_class = "";
	$pwrapper_item_class = "";
    $modal_class = "";
	$zoom_class = "";
	$plus_button = "";

	
	if ( (isset($tdl_options['tdl_product_gallery_lightbox'])) && ($tdl_options['tdl_product_gallery_lightbox'] == "1" ) ) {
		$pwrapper_class = "photoswipe-wrapper";
		$pwrapper_item_class = "photoswipe-item";
        $modal_class = "zoom_enabled";
		$zoom_class = "";
    }
	
	if ( (isset($tdl_options['tdl_product_gallery_zoom'])) && ($tdl_options['tdl_product_gallery_zoom'] == "1" ) ) {
		$modal_class = "";
		$zoom_class = "easyzoom el_zoom";
	}

	$product_design = (!empty($tdl_options['tdl_product_design'])) ? $tdl_options['tdl_product_design'] : 'default'; 

	if (isset($_GET["product_design"])) $product_design = $_GET["product_design"];
?>

<?php
    
//Featured
$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
$thumbnail_post    = get_post( $post_thumbnail_id );
$image_title       = get_post_field( 'post_excerpt', $post_thumbnail_id );
$image_src 					= wp_get_attachment_image_src( $post_thumbnail_id, 'shop_thumbnail' );
$image_data_src				= wp_get_attachment_image_src( $post_thumbnail_id, 'shop_single' );
$image_data_src_original 	= wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
$image_link  				= wp_get_attachment_url( $post_thumbnail_id );
$image       				= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
$image_original				= get_the_post_thumbnail( $post->ID, 'full' );
$attachment_count   		= count( $product->get_gallery_image_ids() );

?>

<div class="images">

	<?php if ( has_post_thumbnail() ) { ?>
    
    <div class="product_images">

        
        <?php if ( $product_design == "default")  : ?>
        	<div id="product-images-carousel" class="owl-carousel owl-theme <?php echo esc_html($pwrapper_class); ?> woocommerce-product-gallery__wrapper" data-slider-id="1">
        	<div class="<?php echo esc_html($zoom_class); ?> <?php echo esc_html($pwrapper_item_class); ?>  woocommerce-product-gallery__image">
    	<?php else: ?>
			<div class="<?php echo esc_html($pwrapper_class); ?> woocommerce-product-gallery__wrapper">
			<div class="<?php echo esc_html($zoom_class); ?> <?php echo esc_html($pwrapper_item_class); ?> module woocommerce-product-gallery__image">
    	<?php endif; ?>

		<?php 
			if ( (isset($tdl_options['tdl_product_gallery_lightbox'])) && ($tdl_options['tdl_product_gallery_lightbox'] == "1" ) ) {
		 ?>	
            	<a class="<?php echo esc_html($modal_class); ?> zoom" href="<?php echo wp_kses_post($image_link); ?>"  data-size="<?php echo wp_kses_post($image_data_src_original[1]); ?>x<?php echo wp_kses_post($image_data_src_original[2]); ?>">
                
					<?php echo wp_kses_post($image); ?>  

            	</a>
		 <?php } else { ?>
			 <?php 
				if ( (isset($tdl_options['tdl_product_gallery_zoom'])) && ($tdl_options['tdl_product_gallery_zoom'] == "1" ) ) {
			 ?>
				 <a class="<?php echo esc_html($modal_class); ?> zoom" href="<?php echo wp_kses_post($image_link); ?>"  data-size="<?php echo wp_kses_post($image_data_src_original[1]); ?>x<?php echo wp_kses_post($image_data_src_original[2]); ?>">
				 	<?php echo wp_kses_post($image); ?>
				 </a>
			 <?php } else { ?>
			 	<?php echo wp_kses_post($image); ?>
			 <?php } ?>	
		 		
		 <?php } ?>		

           
            </div>


			<?php
            
			//Thumbs
            
            $attachment_ids = $product->get_gallery_image_ids();
            
            if ( $attachment_ids ) {
                
                foreach ( $attachment_ids as $attachment_id ) {
        
                    $image_link = wp_get_attachment_url( $attachment_id );
        
                    if (!$image_link) continue;
        
                    $image_title       			= esc_attr( get_the_title( $attachment_id ) );
                    $image_src         			= wp_get_attachment_image_src( $attachment_id, 'shop_single_small_thumbnail' );
					$image_data_src    			= wp_get_attachment_image_src( $attachment_id, 'shop_single' );
					$image_data_src_original 	= wp_get_attachment_image_src( $attachment_id, 'full' );
					$image_link        			= wp_get_attachment_url( $attachment_id );
				    $image		      			= wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
					
					?>                    
								
					<div class="<?php echo esc_html($zoom_class); ?> <?php echo esc_html($pwrapper_item_class); ?> module">

					<?php 
						if ( (isset($tdl_options['tdl_product_gallery_lightbox'])) && ($tdl_options['tdl_product_gallery_lightbox'] == "1" ) ) {
					 ?>	
                        <a class="<?php echo esc_html($modal_class); ?> zoom" href="<?php echo esc_url($image_link); ?>" data-size="<?php echo wp_kses_post($image_data_src_original[1]); ?>x<?php echo wp_kses_post($image_data_src_original[2]); ?>">
                    
                            <img class="owl-lazy" src="<?php echo esc_url($image_data_src[0]); ?>" data-src="<?php echo esc_url($image_data_src_original[0]); ?>">

                        </a>
					 <?php } else { ?>
						 <?php 
							if ( (isset($tdl_options['tdl_product_gallery_zoom'])) && ($tdl_options['tdl_product_gallery_zoom'] == "1" ) ) {
						 ?>
						 <a class="<?php echo esc_html($modal_class); ?> zoom" href="<?php echo esc_url($image_link); ?>" data-size="<?php echo wp_kses_post($image_data_src_original[1]); ?>x<?php echo wp_kses_post($image_data_src_original[2]); ?>">
							 <img class="owl-lazy" src="<?php echo esc_url($image_data_src[0]); ?>" data-src="<?php echo esc_url($image_data_src_original[0]); ?>">
						</a>
						 <?php } else { ?>
						 	<img class="owl-lazy" src="<?php echo esc_url($image_data_src[0]); ?>" data-src="<?php echo esc_url($image_data_src_original[0]); ?>">
						 <?php } ?>						 
					 		
					 <?php } ?>						
                        

                        
                    </div>



                    
                	<?php
				
                }
                
            }
            
            ?>

                
    	</div>
        
    </div><!-- /.product_images -->

	<?php

    } else {
    
        echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', wc_placeholder_img_src() ), $post->ID );
    
    }
	
    ?>

</div>
