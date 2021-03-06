<?php
/**
 * Wishlist pages template; load template parts basing on the url
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 2.0.5
 */

global $wpdb, $woocommerce;
$tdl_options = eva_global_var();
?>

<div class="row">
	<div class="large-10 columns large-centered <?php if ( (isset($tdl_options['tdl_catalog_mode'])) && ($tdl_options['tdl_catalog_mode'] == 1) ) : ?>catalog_mode<?php endif;?>">
		<div id="yith-wcwl-messages"></div>
		<?php yith_wcwl_get_template( 'wishlist-' . $template_part . '.php', $atts ) ?>
	</div>
</div>