<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
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
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$tdl_options = eva_global_var();

$page_id = wc_get_page_id('shop');

get_header( 'shop' ); 

//woocommerce_before_main_content
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);


//woocommerce_before_shop_loop
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

add_action( 'woocommerce_before_shop_loop_result_count', 'woocommerce_result_count', 20 );
add_action( 'woocommerce_before_shop_loop_catalog_ordering', 'woocommerce_catalog_ordering', 30 );

// Sidebar Settings
$shop_has_sidebar = false;
$shop_sidebar = 'full-width';


if ( 
    is_active_sidebar( 'widgets-product-listing' )
     && (isset($tdl_options['tdl_sidebar_style']))
     && ($tdl_options['tdl_sidebar_style'] == "1") 
)
{
    $shop_has_sidebar = true;
    $shop_sidebar = 'shop-has-sidebar';
} else {
    $shop_has_sidebar = false;
    $shop_sidebar = 'full-width';    
}

if (isset($_GET["shop_sidebar"])) $shop_sidebar = $_GET["shop_sidebar"];

?>

<div id="primary" class="content-area shop-page<?php echo esc_attr($shop_has_sidebar) ? ' '. esc_attr($shop_sidebar):'';?>">

	<?php get_template_part( 'includes/headers/shop', 'header' ); ?>

		<!-- Shop Content Area -->  

		<div id="content" class="site-content" role="main">
			<div class="row">

			<?php if ( $shop_has_sidebar && $shop_sidebar != "full-width" ) : ?>
                           
                <div class="xlarge-2 large-3 columns show-for-large-up sidebar-pos">
                    <div class="shop_sidebar wpb_widgetised_column">                   
						<?php if ( is_active_sidebar( 'widgets-product-listing' ) ) { ?>
                            <div id="secondary" class="widget-area" role="complementary">
                                <?php dynamic_sidebar( 'widgets-product-listing' ); ?>
                            </div>
						<?php } ?>
					</div>
				</div>
                           
				<div id="content-position" class="xlarge-10 large-9 columns content-pos">
                           
				<?php else : ?>
                       
				<div class="large-12 columns">
                           
				<?php endif; ?>


                             <?php 
                            // Find the category + category parent, if applicable
                            $term           = get_queried_object();
                            $parent_id      = empty( $term->term_id ) ? 0 : $term->term_id;
                            $categories     = get_terms('product_cat', array('hide_empty' => 1, 'parent' => $parent_id));
                            ?>
                    
                            <?php                                         
                            $show_categories = FALSE;
            
                            if ( is_shop() && (get_option('woocommerce_shop_page_display') == '') ) $show_categories = FALSE;
                            if ( is_shop() && (get_option('woocommerce_shop_page_display') == 'products') ) $show_categories = FALSE;
                            if ( is_shop() && (get_option('woocommerce_shop_page_display') == 'subcategories') ) $show_categories = TRUE;
                            if ( is_shop() && (get_option('woocommerce_shop_page_display') == 'both') ) $show_categories = FALSE;
                            
                            if ( is_product_category() && (get_option('woocommerce_category_archive_display') == '') ) $show_categories = FALSE;
                            if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'products') ) $show_categories = FALSE;
                            if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'subcategories') ) $show_categories = TRUE;
                            if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'both') ) $show_categories = FALSE;
            
                            if ( is_product_category() && (get_woocommerce_term_meta($parent_id, 'display_type', true) == 'products') ) $show_categories = FALSE;
                            if ( is_product_category() && (get_woocommerce_term_meta($parent_id, 'display_type', true) == 'subcategories' ) ) $show_categories = TRUE;
                            if ( is_product_category() && (get_woocommerce_term_meta($parent_id, 'display_type', true) == 'both') ) $show_categories = FALSE;
                            
                            if ( isset($_GET["s"]) && $_GET["s"] != '' ) $show_categories = FALSE;
                            
                        
                            ?>

                            <!-- Shop Order Bar -->

                            <div class="top_bar_shop">

                                <div class="catalog-ordering">
                                    <?php if ( is_active_sidebar( 'widgets-product-listing' ) ) : ?>
                                        <div class="shop-filter"><span><?php echo esc_html__( 'Filter', 'eva' ); ?></span></div>
                                    <?php endif; ?>
                                    <?php if ( have_posts() ) : ?>
                                            <?php do_action( 'woocommerce_before_shop_loop_result_count' ); ?>
                                    <?php endif; ?>
                                </div> <!--catalog-ordering-->
                                <div class="clearfix"></div>
                            </div><!-- .top_bar_shop-->                            
                            
                            <?php if (!is_paged()) : //show categories only on first page ?>
                                <?php if ($show_categories == TRUE) : ?>
                                    <?php if ($categories) : ?>

                                    <?php 

                                    if ( ( isset($woocommerce_loop['columns']) && $woocommerce_loop['columns'] != "" ) ) {
                                        $categories_per_column = $woocommerce_loop['columns'];
                                    } else {
                                        if ( ( !isset($tdl_options['tdl_categories_per_column']) ) ) {
                                            $categories_per_column = 4;
                                        } else {
                                            $categories_per_column = $tdl_options['tdl_categories_per_column'];
                                            
                                            if (isset($_GET["categories_per_row"])) $categories_per_column = $_GET["categories_per_row"];
                                        }
                                    }

                                    if ($categories_per_column == 6) {
                                        $categories_per_column_xlarge = 6;
                                        $categories_per_column_large = 6;
                                        $categories_per_column_medium = 3;
                                    }

                                    if ($categories_per_column == 5) {
                                        $categories_per_column_xlarge = 5;
                                        $categories_per_column_large = 5;
                                        $categories_per_column_medium = 3;
                                    }

                                    if ($categories_per_column == 4) {
                                        $categories_per_column_xlarge = 4;
                                        $categories_per_column_large = 4;
                                        $categories_per_column_medium = 3;
                                    }

                                    if ($categories_per_column == 3) {
                                        $categories_per_column_xlarge = 3;
                                        $categories_per_column_large = 3;
                                        $categories_per_column_medium = 2;
                                    }

                                    if ($categories_per_column == 2) {
                                        $categories_per_column_xlarge = 2;
                                        $categories_per_column_large = 2;
                                        $categories_per_column_medium = 2;
                                    }

                                    $hover_effect = $tdl_options['tdl_category_view'];
                                    ?>


                                    <ul id="products" class="row product-category-list <?php echo esc_attr($hover_effect); ?> small-up-1 medium-up-<?php echo esc_attr($categories_per_column_medium); ?> large-up-<?php echo esc_attr($categories_per_column_large); ?> xlarge-up-<?php echo esc_attr($categories_per_column_xlarge); ?> xxlarge-up-<?php echo esc_attr($categories_per_column); ?> columns-<?php echo esc_attr($categories_per_column); ?>">

                                        <?php $cat_number = count($categories); ?>
                                                                            
                                        <?php foreach($categories as $category) : ?>
                                                                                
                                        <?php                        
                                            $thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );
                                            $image = wp_get_attachment_url( $thumbnail_id );
                                        ?>
                                    
                                    <?php if ( (isset($tdl_options['tdl_category_view'])) && ($tdl_options['tdl_category_view'] == 'perspective_hover') ) : ?>
                                    <li class="category_grid_item column">
                                        <a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>" class="tilter tilter--1">
                                            <figure class="tilter__figure">
                                                <?php 
                                                    if ( $image ) { ?>
                                                    <img class="tilter__image" src="<?php echo esc_url($image); ?>" alt="<?php echo esc_html($category->name); ?>" />
                                                    <?php  } else {  ?>
                                                    <div class="tilter__image_blank"></div>
                                                <?php   }
                                                ?>
                                                <div class="tilter__deco tilter__deco--shine"><div></div></div>
                                                <div class="tilter__deco tilter__deco--overlay"></div>
                                                <figcaption class="tilter__caption">
                                                    <p class="tilter__description"><?php echo sprintf (_n( '%d item', '%d items', $category->count , 'eva'), $category->count ); ?></p>
                                                    <h3 class="tilter__title"><?php echo esc_html($category->name); ?></h3>
                                                </figcaption>
                                                <div class="tilter__deco--lines"><span></span></div>
                                            </figure>
                                        </a>
                                    </li>
                                    <?php else: ?> 
                                        <li class="category_grid_item column">
                                            <div class="category_grid_box">
                                            <a class="category_item" href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
                                            <div class="category_overlay"></div>
                                                <span class="category_name">
                                                    <span><?php echo sprintf (_n( '%d item', '%d items', $category->count, 'eva' ), $category->count ); ?></span>
                                                    <h3><?php echo esc_html($category->name); ?></h3>
                                                </span>                                            
                                                <?php 
                                                if ( $image ) { ?>
                                                <img class="category_item_bkg" src="<?php echo esc_url($image); ?>" alt="<?php echo esc_html($category->name); ?>" />
                                                    <?php  } else {  ?>
                                                    <div class="category_item_bkg_blank"></div>
                                                <?php   }
                                                ?>                                            
                                                </a>
                                            </div>                                           
                                        </li>
                                    <?php endif; ?>                                     
                                                             

                                                                                
                                        <?php endforeach; ?>
                                    </ul>                                           


                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endif; ?>				


				<?php              
				$show_products = TRUE;
				if ( is_shop() && (get_option('woocommerce_shop_page_display') == 'subcategories') ) $show_products = FALSE;
                if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'subcategories') ) {
                    $term = get_queried_object();
                    $parent = get_term($term->parent, get_query_var('taxonomy') ); // get parent term
                    $children = get_term_children($term->term_id, get_query_var('taxonomy')); // get children


                    if(($parent->term_id!="" && sizeof($children)>0)) {

                        // has parent and child
                        $show_products = FALSE;

                    }elseif(($parent->term_id!="") && (sizeof($children)==0)) {

                        // has parent, no child
                        $show_products = TRUE;

                    }elseif(($parent->term_id=="") && (sizeof($children)>0)) {

                        // no parent, has child
                        $show_products = FALSE;

                    } 
                }
				if ( is_product_category() && (get_woocommerce_term_meta($parent_id, 'display_type', true) == 'subcategories' ) ) $show_products = FALSE;
				if ( isset($_GET["s"]) && $_GET["s"] != '' ) $show_products = TRUE;       
				?>				

				<?php if ($show_products == TRUE) : ?>

					<?php if ( have_posts() ) : ?>

						<?php
							/**
							 * woocommerce_before_shop_loop hook.
							 *
							 * @hooked woocommerce_result_count - 20
							 * @hooked woocommerce_catalog_ordering - 30
							 */
							do_action( 'woocommerce_before_shop_loop' );
						?>

                        <div class="active_filters_ontop"><?php the_widget( 'WC_Widget_Layered_Nav_Filters', array(), array() ); ?></div>

						<?php woocommerce_product_loop_start(); ?>

							<?php while ( have_posts() ) : the_post(); ?>

								<?php wc_get_template_part( 'content', 'product' ); ?>

							<?php endwhile; // end of the loop. ?>

						<?php woocommerce_product_loop_end(); ?>

						<?php
							/**
							 * woocommerce_after_shop_loop hook.
							 *
							 * @hooked woocommerce_pagination - 10
							 */
							do_action( 'woocommerce_after_shop_loop' );
						?>

					<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

						<?php wc_get_template( 'loop/no-products-found.php' ); ?>

					<?php endif; ?>

				<?php endif; ?>

				</div><!-- .columns -->
            </div><!-- .row -->
        </div><!-- #content --> 

</div><!-- #primary -->

<?php get_footer( 'shop' ); ?>
