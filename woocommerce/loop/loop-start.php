<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
 
global $woocommerce_loop;
$tdl_options = eva_global_var();
$custom_products_columns = $tdl_options['tdl_products_per_column'];
?>

<?php


if ( ( isset($woocommerce_loop['columns']) && $woocommerce_loop['columns'] != "" ) ) {
	$products_per_column = $woocommerce_loop['columns'];
} else {
	if ( ( !isset($tdl_options['tdl_products_per_column']) ) ) {
		$products_per_column = 4;
	} else {
		$products_per_column = $tdl_options['tdl_products_per_column'];
		
        if (isset($_GET["products_per_column"])) $products_per_column = $_GET["products_per_column"];
	}
}

if ($products_per_column 			== 	6 	) {
	$products_per_column_xlarge 	= 	6 	;
	$products_per_column_large 		= 	6 	;
	$products_per_column_medium 	= 	4 	;
	$products_per_column_small 		= 	2 	;
}

if ($products_per_column 			== 	5	) {
	$products_per_column_xlarge 	= 	5	;
	$products_per_column_large 		= 	5	;
	$products_per_column_medium 	= 	3	;
	$products_per_column_small 		= 	2	;
}

if ($products_per_column 			== 	4	) {
	$products_per_column_xlarge 	= 	4	;
	$products_per_column_large 		= 	4	;
	$products_per_column_medium 	= 	3	;
	$products_per_column_small 		= 	2	;
}

if ($products_per_column 			== 	3	) {
	$products_per_column_xlarge 	= 	3	;
	$products_per_column_large 		= 	3	;
	$products_per_column_medium 	= 	2	;
	$products_per_column_small 		= 	2	;
}

if ($products_per_column 			== 	2	) {
	$products_per_column_xlarge 	= 	2	;
	$products_per_column_large 		= 	2	;
	$products_per_column_medium 	= 	2	;
	$products_per_column_small 		= 	2	;
}

$hover_effect = $tdl_options['tdl_category_view'];

?>

<ul
class="	row visible products products-grid product-category-list <?php echo esc_attr($hover_effect); ?>  
		small-up-<?php 		echo intval($products_per_column_small); 	?> 
		medium-up-<?php 	echo intval($products_per_column_medium); 	?> 
		large-up-<?php 		echo intval($products_per_column_large); 	?> 
		xlarge-up-<?php 	echo intval($products_per_column_xlarge); 	?> 
		xxlarge-up-<?php 	echo intval($products_per_column);			?> 
		 animated fadeIn
">