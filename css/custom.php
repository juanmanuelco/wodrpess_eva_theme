<?php
/**
 * Generated CSS from customizer options.
 *
 * @package Eva
 */

$tdl_options = eva_global_var();

  //convert hex to rgb
  function eva_hex2rgb($hex) {
    $hex = str_replace("#", "", $hex);
    
    if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
    } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
    }
    $rgb = array($r, $g, $b);
    return implode(",", $rgb); // returns the rgb values separated by commas
    //return $rgb; // returns an array with the rgb values
  }

function eva_adjustColorLightenDarken($color_code,$percentage_adjuster = 0) {
    $percentage_adjuster = round($percentage_adjuster/100,2);
    if(is_array($color_code)) {
        $r = $color_code["r"] - (round($color_code["r"])*$percentage_adjuster);
        $g = $color_code["g"] - (round($color_code["g"])*$percentage_adjuster);
        $b = $color_code["b"] - (round($color_code["b"])*$percentage_adjuster);
 
        return array("r"=> round(max(0,min(255,$r))),
            "g"=> round(max(0,min(255,$g))),
            "b"=> round(max(0,min(255,$b))));
    }
    else if(preg_match("/#/",$color_code)) {
        $hex = str_replace("#","",$color_code);
        $r = (strlen($hex) == 3)? hexdec(substr($hex,0,1).substr($hex,0,1)):hexdec(substr($hex,0,2));
        $g = (strlen($hex) == 3)? hexdec(substr($hex,1,1).substr($hex,1,1)):hexdec(substr($hex,2,2));
        $b = (strlen($hex) == 3)? hexdec(substr($hex,2,1).substr($hex,2,1)):hexdec(substr($hex,4,2));
        $r = round($r - ($r*$percentage_adjuster));
        $g = round($g - ($g*$percentage_adjuster));
        $b = round($b - ($b*$percentage_adjuster));
 
        return "#".str_pad(dechex( max(0,min(255,$r)) ),2,"0",STR_PAD_LEFT)
            .str_pad(dechex( max(0,min(255,$g)) ),2,"0",STR_PAD_LEFT)
            .str_pad(dechex( max(0,min(255,$b)) ),2,"0",STR_PAD_LEFT);
    }
}
$mainbgcolor = '#ffffff';
$mainbgcolor_rgb = 'rgb(255,255,255)';
$maincolor_rgb = 'rgb(0,0,0)';
$maincolor_light = null;
$maincolor_lighter = null;
$maincolor_darker = null;
$maincolor_dark = null;

$maincolor = (!empty($tdl_options['tdl_main_color'])) ? $tdl_options['tdl_main_color'] : '#a8e8e2';
$mainbgcolor = (!empty($tdl_options['tdl_main_bg_color'])) ? $tdl_options['tdl_main_bg_color'] : '#ffffff';
$mainbgcolor_rgb = eva_hex2rgb ($mainbgcolor);


if ( (isset($tdl_options['tdl_main_color'])) && (trim($tdl_options['tdl_main_color']) != "" ) ) {
  
  $maincolor_rgb = eva_hex2rgb ($tdl_options['tdl_main_color']);
  $maincolor_light = eva_hex2rgb (eva_adjustColorLightenDarken($tdl_options['tdl_main_color'],-5));
  $maincolor_lighter = eva_hex2rgb (eva_adjustColorLightenDarken($tdl_options['tdl_main_color'],-15));
  $maincolor_darker = eva_hex2rgb (eva_adjustColorLightenDarken($tdl_options['tdl_main_color'],15));
  $maincolor_dark = eva_hex2rgb (eva_adjustColorLightenDarken($tdl_options['tdl_main_color'],35));
}

// Header Styles Settings

$page_id = "";
$page_id = get_the_ID();

// Logo Settings
$site_logo_width = (!empty($tdl_options['tdl_site_logo_width'])) ? $tdl_options['tdl_site_logo_width'] : '200';
$site_logo_height = (!empty($tdl_options['tdl_site_logo_height'])) ? $tdl_options['tdl_site_logo_height'] : '40';
// Stycky Logo Settings
$sticky_logo_width = (!empty($tdl_options['tdl_sticky_logo_width'])) ? $tdl_options['tdl_sticky_logo_width'] : '200';
$sticky_logo_height = (!empty($tdl_options['tdl_sticky_logo_height'])) ? $tdl_options['tdl_sticky_logo_height'] : '40';
// Mobile Logo Settings
$mobile_logo_height = (!empty($tdl_options['tdl_mobile_logo_height'])) ? $tdl_options['tdl_mobile_logo_height'] : '40';

$header_padding = (!empty($tdl_options['tdl_header_padding'])) ? $tdl_options['tdl_header_padding'] : '40';

$notice = '/* Page Styles */';
$page_header_mbottom = '0';
$page_title_option = get_field('tdl_hide_title', $page_id);
$page_header_height = get_field('tdl_header_height', $page_id);
$page_bottom_padding = get_field('tdl_bottom_padding', $page_id);

if ( is_home() || is_single() || is_search() || is_archive() ) {
  $notice = '/* Blog Styles */';
  $page_for_posts = get_option('page_for_posts');
  $page_id = get_post($page_for_posts);
  $page_title_option = 1;
  $page_bottom_padding = 0;
  $page_header_mbottom = '50';
}

if ( EVA_WOOCOMMERCE_IS_ACTIVE ) {
  if ( is_shop() ) {
    $notice = '/* Shop Styles */';
    $page_id = wc_get_page_id('shop');
    $page_header_height = get_field('tdl_header_height', $page_id);
    $page_header_mbottom = '50';
    $page_bottom_padding = 0;
  }
  if ( is_product_category() || is_product_tag() || is_account_page() ) {
    $notice = '/* Shop Category Styles */';
    $page_id = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
    $page_header_height = get_field('tdl_prodcat_header_height', $page_id);
    $page_header_mbottom = '50';
    $page_bottom_padding = 0;
    $page_title_option = 1;
  }
  if ( is_account_page() ) {
    $notice = '/* My Account Styles */';
    $page_id = get_the_ID();
    $page_header_height = get_field('tdl_header_height', $page_id);
  }

  if (function_exists('is_order_tracking') && is_order_tracking() || function_exists('is_cart') && is_cart() || function_exists('is_checkout') && is_checkout() || function_exists('is_account_page') && is_account_page()) {
        $page_title_option = 1;
  }
}

$page_bottom_padding = get_field('tdl_bottom_padding', $page_id);
?>

/***************************************************************/
/*  Logo Styling  **********************************************/
/***************************************************************/

header.site-header .header-wrapper .site-branding {
  min-width: <?php echo esc_html($site_logo_width); ?>px;
}

header.site-header.header--narrow .site-branding {
  min-width: <?php echo esc_html($sticky_logo_width); ?>px;
}

@media screen and (max-width: 39.9375em) {
  header.site-header .header-wrapper .site-branding {
    min-width: 200px;
  }
  header.site-header .header-wrapper .site-branding img {
    height: <?php echo esc_html($mobile_logo_height); ?>px;
  }  
}

header.site-header.header--narrow .site-branding img {
  height: <?php echo esc_html($sticky_logo_height); ?>px;
}


/***************************************************************/
/*  Header Styling  ********************************************/
/***************************************************************/

    <?php echo $notice;?>
    <?php if ( $page_bottom_padding == 1 ): ?>
    #primary.content-area {
        margin-bottom: 0 !important;
    }
    <?php endif; ?>    

    <?php if ( esc_html($page_header_height) ) : ?>
      .page-header {
        height: <?php echo esc_html($page_header_height); ?>px;
        margin-bottom: <?php echo esc_html($page_header_mbottom); ?>px;
      }

    @media screen and (min-width: 40em) and (max-width: 63.9375em) {
      .page-header {
        height: <?php echo esc_html($page_header_height) * ( 100 - 10 ) / 100; ?>px;
      }  
    }
    @media screen and (max-width: 39.9375em) {
      .page-header {
        height: <?php echo esc_html($page_header_height) * ( 100 - 20 ) / 100; ?>px;
      }
    }
    <?php else: ?>

      <?php if ( $page_title_option == 1 ): ?>
        .page-header {
          margin-top: <?php echo esc_html($site_logo_height) + (esc_html($header_padding*2)); ?>px;
          margin-bottom: 50px;
        }

        body[data-topbar="has_topbar"] .page-header {
          margin-top: <?php echo esc_html($site_logo_height) + (esc_html($header_padding*2)) + 44; ?>px;
        }

        @media screen and (max-width: 63.9375em) {
            body[data-topbar="has_topbar"] .page-header {
              margin-top: <?php echo esc_html($site_logo_height) + (esc_html($header_padding*2)); ?>px;
            }    
        }
      <?php else: ?>
        .page-header {
          margin-top: <?php echo esc_html($site_logo_height) + (esc_html($header_padding*2)); ?>px;
          margin-bottom: 10px;
        }
        body[data-topbar="has_topbar"] .page-header {
          margin-top: <?php echo esc_html($site_logo_height) + (esc_html($header_padding*2)) + 44; ?>px;
        } 

        @media screen and (max-width: 63.9375em) {
            body[data-topbar="has_topbar"] .page-header {
              margin-top: <?php echo esc_html($site_logo_height) + (esc_html($header_padding*2)); ?>px;
            }    
        }               
      <?php endif; ?>

      .page-header .title-section {
        margin:20px 0 20px 0;
        position: relative;
      }


    @media screen and (max-width: 39.9375em) {
      <?php if ( $page_title_option == 1 ): ?>
      .page-header,
      body[data-topbar="has_topbar"] .page-header {
        margin-top: <?php echo esc_html($mobile_logo_height) + 50; ?>px;
        margin-bottom: 30px;
      }  
      <?php else: ?>
      .page-header,
      body[data-topbar="has_topbar"] .page-header {
        margin-top: <?php echo esc_html($mobile_logo_height) + 50; ?>px;
        margin-bottom: 0px;
      }  
      <?php endif; ?>
      
      .page-header .title-section {
        margin:10px 0 20px 0;
      }
    }
    <?php endif; ?>


/***************************************************************/
/*  Content Width  *********************************************/
/***************************************************************/

<?php if ( (isset($tdl_options['tdl_maincontent_width'])) && (trim($tdl_options['tdl_maincontent_width']) != "" ) ) : ?>
  .row {
    max-width: <?php echo sprintf("%.3f", $tdl_options['tdl_maincontent_width']/16+2.85714286); ?>rem;  
  }
<?php endif; ?>

<?php if ( (isset($tdl_options['tdl_header_search_bar'])) && ($tdl_options['tdl_header_search_bar'] == "1") ) : ?>
  <?php if ( (isset($tdl_options['tdl_mobile_search_bar'])) && ($tdl_options['tdl_mobile_search_bar'] == "1") ) : ?>
  @media screen and (max-width: 39.9375em) {
    .offcanvas_aside .offcanvas_navigation .mm-menu .mm-panels {top: 160px;}
  }
  <?php else: ?>
    .offcanvas_aside .offcanvas_navigation .mm-menu .mm-panels {top: 100px;}
  <?php endif; ?>
<?php endif; ?>


/***************************************************************/
/*  Color Styling  *********************************************/
/***************************************************************/

/****** Main Background *******/
body, .offcanvas_main_content,
.offcanvas_container,
header.site-header.header--narrow,
header.site-header .header-wrapper .nav .header-nav .menu-trigger,
footer#site-footer .f-copyright .socials .social-icons,
.top_bar_shop_single .products-nav .product-short,
.woocommerce-cart .entry-content .woocommerce .cart-collaterals h2.total-title,
.woocommerce-checkout:not(.woocommerce-order-received) .woocommerce-checkout .checkout_right_wrapper .order_review_wrapper h2 {
  background: <?php echo esc_attr($mainbgcolor); ?>;
}

.offcanvas_overlay:after, .cd-cover-layer, .nl-overlay {
  background: rgba(<?php echo esc_attr($maincolor_rgb); ?>,0.7);
}

header.site-header .header-wrapper .nav .header-nav .menu-trigger div,
header.site-header .header-wrapper .tools ul li a .counter_number,
.mm-listview span div::before,
.language_currency ul li span::before,
.language_currency .wcml_currency_switcher li::before,
.language_currency ul li a::before,
#header-top-bar .topbar_right .topbar_languages .language_currency ul li span:before,
#header-top-bar .topbar_right .topbar_languages .language_currency .wcml_currency_switcher li::before,
#header-top-bar .topbar_right .topbar_languages .language_currency ul li a::before,
.mm-listview hr,
header.site-header .header-wrapper .nav .header-nav .menu-trigger.menu_trigger_4 div span,
header.site-header .header-wrapper .nav .header-nav .menu-trigger.menu_trigger_4 div span:before,
header.site-header .header-wrapper .nav .header-nav .menu-trigger.menu_trigger_4 div span:after,
.cd-search-trigger.search-form-visible::before,
.page-header #breadcrumbs::before, .page-header #breadcrumbs::after,
.button.btn1,
.offcanvas_aside_right .offcanvas_minicart .widget_shopping_cart_content .cart_list li a.remove i,
.widget-area .widget.woocommerce.widget_price_filter .ui-slider .ui-slider-handle,
.widget-area .widget.woocommerce.widget_price_filter .ui-slider .ui-slider-range,
.widget-area .widget.woocommerce.widget_product_tag_cloud a:hover,
input[type="submit"],
#products-carousel .carousel-title::after,
.single_product_summary_upsell h2.products-upsells-title::after,
.button,
.button[disabled],
.woocommerce-checkout:not(.woocommerce-order-received) .checkout_login .notice-border-container,
.woocommerce-cart .entry-content .woocommerce form table tbody td.product-remove .remove,
button[type="submit"],
.my_account_container .myaccount_user .woocommerce-MyAccount-content .my_address_wrapper .shipping_billing_wrapper .edit-link a,
.woocommerce #content table.wishlist_table.cart a.remove,
.woocommerce #content table.wishlist_table.cart a.remove:hover,
.blog-content-area ul.post-categories li,
.format-quote .entry-content blockquote,
.blog-content-area .post_header_meta::before,
.comments_section .comment-respond h3.comment-reply-title small a,
.widget-area .widget.widget_calendar table td a,
h2.shortcode_title::after,
.with_thumb_icon, .no_thumb_icon,
.offcanvas_aside .language_currency ul li span:before,
.offcanvas_aside .language_currency ul li a:before,
.offcanvas_aside .language_currency .wcml_currency_switcher li:before {
  background-color: <?php echo esc_html($maincolor) ?>;
}

@media screen and (max-width: 39.9375em) {
  header.site-header .header-wrapper .nav .header-nav .menu-trigger div,
  header.site-header .header-wrapper .nav .header-nav .menu-trigger {
    background-color: transparent;
  }
}

.select2-dropdown .select2-results__option[aria-selected="true"],
.select2-dropdown .select2-results__option--highlighted[aria-selected],
.select2-results .select2-highlighted {
  background-color: <?php echo esc_html($maincolor) ?>;
}

.button.btn2 {
  background-color: transparent;
}

.button:hover, .button:focus,
input[type="submit"]:hover,
.button[disabled]:hover {
  background-color: rgba(<?php echo esc_html($maincolor_light); ?>,1);
}

.button.btn2:hover, input[type="submit"].btn2:hover {
  background-color: rgba(<?php echo esc_html($maincolor_light); ?>,1);
  border-color: rgba(<?php echo esc_html($maincolor_light); ?>,1);
}


.page-header h1.page-title,
.mm-prev::before, .mm-next::after, .mm-arrow::after,
.mm-menu .mm-navbar > *, .mm-menu .mm-navbar a,
.main-navigation > ul > li.menu-item-has-children > a:after,
.main-navigation ul ul li a:after,
.page-header #breadcrumbs,
.list_shop_categories span,
.page-header .list_shop_categories li i.backtoall::before,
.page-header .list_shop_categories.mobile li a i::before,
.offcanvas_aside_right .offcanvas_minicart .cart-title,
.offcanvas_aside_right .offcanvas_search .search-title,
.page-header .list_shop_categories li span.counter,
.offcanvas_aside_right .offcanvas_minicart .widget_shopping_cart_content .total strong,
.select2-container .select2-selection .select2-selection__arrow::after,
.select2-container.select2-container--open .select2-selection .select2-selection__arrow::after,
.select2-container .select2-choice .select2-arrow::after,
.products .add_to_wishlist::before, .products .yith-wcwl-wishlistaddedbrowse a::before, .products .yith-wcwl-wishlistexistsbrowse a::before,
.woocommerce span.ribbon::before, .woocommerce-page span.ribbon::before,
.widget-area .widget.woocommerce.widget_product_categories ul li span.count,
.woocommerce .star-rating::before,
.woocommerce .star-rating span::before,
.top_bar_shop_single .products-nav .product-btn > a i,
label span,
.top_bar_shop_single .back-btn::before,
.product_infos .box-share-master-container a i,
.product_infos .eva-size-chart a i,
.product_infos .yith-wcwl-add-to-wishlist a::before,
.woocommerce .woocommerce-tabs ul.tabs li a sup,
.woocommerce .woocommerce-tabs #review_form_wrapper .comment-form .stars a::before,
#review_form_wrapper .comment-form .stars.selected a:not(.active)::before,
.woocommerce .woocommerce-tabs #review_form_wrapper .comment-form .stars.selected a:not(.active)::before,
.woocommerce .woocommerce-tabs #review_form_wrapper .comment-form .stars.selected a.active::before,
.variation-select::after,
.offcanvas_aside_left .social-icons li a::before,
footer#site-footer .f-copyright .socials .social-icons a::before,
.woocommerce-message::before, .woocommerce-info::before,
label .required,
.woocommerce-cart .entry-content .woocommerce .cart-collaterals .woocommerce-shipping-calculator h2 a,
.account-forms-container .account-tab-list .account-tab-item .account-tab-link,
.account-forms-container .account-tab-list .account-tab-item.last .account-tab-link::before,
.comment-form .required,
.blog-content-area .entry-content .comment-link p::before,
.blog-content-area .format-link .entry-title i,
.blog-content-area .post_header_meta .post_date::before,
.blog-content-area .post_header_meta .post_categories::before,
.blog-content-area .post_header_meta .box-share-master-container i,
#nav-below .nav-previous-title, #nav-below .nav-next-title,
.widget-area .widget.widget_recent_comments ul li::before,
.widget-area .widget.widget_recent_entries ul li::before,
.blog-list-wrapper .blog-list-item .blog-list-comment i,
.from_the_blog_item .from_the_blog_content_desc .blog-slider-meta span::before,
.comments_section .comment-respond h3.comment-reply-title::before,
.offcanvas_aside_right .offcanvas_sizechart .sizechart-title,
#header-top-bar .topbar_right .topbar_socials .social-icons li a:before {
  color: <?php echo esc_html($maincolor); ?>;
}


.mm-navbar,
header.site-header .header-wrapper .nav .header-nav .menu-trigger.menu_trigger_4 div,
.page-header .list_shop_categories.desktop.active,
.offcanvas_aside_right .offcanvas_minicart .widget_shopping_cart_content .total,
.select2-container .select2-selection,
.page-header .list_shop_categories.mobile li,
.widget-area .widget.woocommerce.widget_product_categories ul li ul.children li::before,
.widget-area .widget.woocommerce.widget_product_categories ul li ul.children li::after,
.widget-area .widget.woocommerce.widget_product_tag_cloud a,
.widget-area .widget.woocommerce.widget_product_tag_cloud a:hover,
.top_bar_shop_single,
.top_bar_shop_single .products-nav .product-btn,
.top_bar_shop_single .products-nav .product-short,
.woocommerce .cart .quantity input.qty,
body[data-form-style="minimal"] .minimal-form-input label:after,
.variation-select,
footer#site-footer .f-copyright .socials .footer-divider,
.select2-choice,
.btn2, input.btn2[type="submit"],
.woocommerce-cart .entry-content .woocommerce .cart-collaterals,
.woocommerce-checkout:not(.woocommerce-order-received) .woocommerce-checkout .checkout_right_wrapper .order_review_wrapper,
.woocommerce-order-received .woocommerce .order_detail_box,
.woocommerce-order-received .woocommerce ul.order_details,
.my_account_container .myaccount_user .woocommerce-MyAccount-navigation,
.my_account_container .order-container .order-info-inside,
.widget-area .widget.widget_calendar table,
.widget-area .widget.widget_calendar table thead,
.track-order-container .track_order_form,
.woocommerce-checkout:not(.woocommerce-order-received) .woocommerce-checkout .checkout_right_wrapper .order_review_wrapper .woocommerce-checkout-review-order-table tfoot tr.order-total,
.woocommerce-cart .entry-content .woocommerce .cart-collaterals .cart_totals table tr:last-child,
#header-top-bar,
#header-top-bar .topbar_left .topbar-item:nth-child(2),
#header-top-bar .topbar_right .topbar_languages .language_currency .wcml_currency_switcher {
    border-color: <?php echo esc_html($maincolor) ?>;
}

.suggestion_results {
  border-color: <?php echo esc_html($maincolor) ?> !important;
}

.button-loader {
  border: 2px solid rgba(<?php echo esc_html($maincolor_rgb); ?>, 0.3);
  border-bottom-color: <?php echo esc_html($maincolor) ?>;
}

.woocommerce-checkout:not(.woocommerce-order-received) .woocommerce-checkout .checkout_left_wrapper .woocommerce-validated input,
.select2-container .select2-selection, .select2-container .select2-choice {
  border-bottom-color: <?php echo esc_html($maincolor) ?> !important;
}

.footer-instagram-section .instagram-pics li a::before,
.widget-area .widget.null-instagram-feed ul li a::before {
  -webkit-box-shadow: inset 0 0 0 0px <?php echo esc_html($maincolor) ?>;
  -moz-box-shadow: inset 0 0 0 0px <?php echo esc_html($maincolor) ?>;
  box-shadow: inset 0 0 0 0px <?php echo esc_html($maincolor) ?>;  
}


.footer-instagram-section .instagram-pics li a:hover::before {
  -webkit-box-shadow: inset 0 0 0 10px <?php echo esc_html($maincolor) ?>;
  -moz-box-shadow: inset 0 0 0 10px <?php echo esc_html($maincolor) ?>;
  box-shadow: inset 0 0 0 10px <?php echo esc_html($maincolor) ?>;  
}


.widget-area .widget.null-instagram-feed ul li a:hover::before {
  -webkit-box-shadow: inset 0 0 0 6px <?php echo esc_html($maincolor) ?>;
  -moz-box-shadow: inset 0 0 0 6px <?php echo esc_html($maincolor) ?>;
  box-shadow: inset 0 0 0 6px <?php echo esc_html($maincolor) ?>;  
}


/***************************************************************/
/*  Links  *****************************************************/
/***************************************************************/


.suggestion_results .guaven_woos_suggestion ul li.guaven_woos_suggestion_list a .guaven_woos_titlediv .woos_sku,
.empty-cart-box span,
.empty-cart-offcanvas-box span,
.page-header .list_shop_categories li a::before,
.page-header .title-section.background--light .list_shop_categories .category_item a.category_item_link::before,
.page-header .title-section.background--dark .list_shop_categories .category_item a.category_item_link::before,
.mm-listview span div::before,
.widget-area .widget.woocommerce.widget_product_categories ul li > a::before,
.woocommerce .woocommerce-tabs ul.tabs li a::before,
.main-navigation > ul > li > a span:after {
  background-color: rgba(<?php echo esc_html($maincolor_rgb); ?>,0.6);
 }

 body[data-color-scheme="mc_dark"] .suggestion_results .guaven_woos_suggestion ul li.guaven_woos_suggestion_list a .guaven_woos_titlediv .woos_sku, body[data-color-scheme="mc_dark"] .empty-cart-box span, body[data-color-scheme="mc_dark"] .empty-cart-offcanvas-box span, body[data-color-scheme="mc_dark"] .page-header .list_shop_categories li a::before, body[data-color-scheme="mc_dark"] .page-header .title-section.background--light .list_shop_categories .category_item a.category_item_link::before, body[data-color-scheme="mc_dark"] .page-header .title-section.background--dark .list_shop_categories .category_item a.category_item_link::before, body[data-color-scheme="mc_dark"] .mm-listview span div::before, body[data-color-scheme="mc_dark"] .widget-area .widget.woocommerce.widget_product_categories ul li > a::before, body[data-color-scheme="mc_dark"] .woocommerce .woocommerce-tabs ul.tabs li a::before,
 body[data-color-scheme="mc_dark"] .main-navigation > ul > li > a span:after {
    background-color: rgba(<?php echo esc_html($maincolor_rgb); ?>,0.3);
}




/***************************************************************/
/*  Box Shadow  ************************************************/
/***************************************************************/

/****** Navigation Button *******/

header.site-header .header-wrapper .nav .header-nav .menu-trigger,
header.site-header .header-wrapper .nav .header-nav .menu-trigger.menu_trigger_2 div,
header.site-header .header-wrapper .nav .header-nav .menu-trigger.menu_trigger_3 div,
header.site-header .header-wrapper .nav .header-nav .menu-trigger.menu_trigger_4 div,
.button.bshadow,
.select2-dropdown,
.select2-drop {
    -webkit-box-shadow: 5px 5px 25px -5px rgba(<?php echo esc_html($maincolor_darker); ?>,.4);
    -moz-box-shadow: 5px 5px 25px -5px rgba(<?php echo esc_html($maincolor_darker); ?>,.4);
    box-shadow: 5px 5px 25px -5px rgba(<?php echo esc_html($maincolor_darker); ?>,.4);
}



header.site-header .header-wrapper .nav .header-nav .menu-trigger:hover,
header.site-header .header-wrapper .nav .header-nav .menu-trigger.menu_trigger_2:hover div,
header.site-header .header-wrapper .nav .header-nav .menu-trigger.menu_trigger_3:hover div,
header.site-header .header-wrapper .nav .header-nav .menu-trigger.menu_trigger_4:hover div,
.offcanvas_aside_right .offcanvas_minicart .widget_shopping_cart_content .cart_list li a.remove:hover i,
.woocommerce-cart .entry-content .woocommerce form table tbody td.product-remove .remove:hover,
.woocommerce #content table.wishlist_table.cart a.remove:hover
 {
    -webkit-box-shadow: 2px 2px 6px 0px rgba(<?php echo esc_html($maincolor_darker); ?>, 0.2);
    -moz-box-shadow: 2px 2px 6px 0px rgba(<?php echo esc_html($maincolor_darker); ?>, 0.2);
    box-shadow: 2px 2px 6px 0px rgba(<?php echo esc_html($maincolor_darker); ?>, 0.2);
}

@media screen and (max-width: 39.9375em) {
header.site-header .header-wrapper .nav .header-nav .menu-trigger.menu_trigger_2 div,
header.site-header .header-wrapper .nav .header-nav .menu-trigger.menu_trigger_3 div,
header.site-header .header-wrapper .nav .header-nav .menu-trigger.menu_trigger_4 div,
header.site-header .header-wrapper .nav .header-nav .menu-trigger.menu_trigger_2:hover div,
header.site-header .header-wrapper .nav .header-nav .menu-trigger.menu_trigger_3:hover div,
header.site-header .header-wrapper .nav .header-nav .menu-trigger.menu_trigger_4:hover div {
  -webkit-box-shadow: none;
  -moz-box-shadow: none;
  box-shadow: none; }
}


/****** Counter *******/

header.site-header .header-wrapper .tools ul li a .counter_number,
.offcanvas_aside_right .offcanvas_minicart .widget_shopping_cart_content .cart_list li a.remove i,
.woocommerce-cart .entry-content .woocommerce form table tbody td.product-remove .remove,
.woocommerce #content table.wishlist_table.cart a.remove {
  -webkit-box-shadow: 2px 2px 10px 0px rgba(<?php echo esc_html($maincolor_darker); ?>, 0.4);
  -moz-box-shadow: 2px 2px 10px 0px rgba(<?php echo esc_html($maincolor_darker); ?>, 0.4);
  box-shadow: 2px 2px 10px 0px rgba(<?php echo esc_html($maincolor_darker); ?>, 0.4);
}

/****** Add to Cart Button *******/

.woocommerce ul.products li.product .product_after_shop_loop_buttons .button,
.woocommerce ul.products li.product .product_after_shop_loop_buttons .added_to_cart,
.woocommerce .woocommerce-pagination ul li span.current,
.woocommerce .top_bar_shop .catalog-ordering .shop-filter,
.description-section .product_meta .product_meta_ins {
  border: 1px solid <?php echo esc_html($maincolor) ?>;
  background-color: rgba(<?php echo esc_html($maincolor_rgb); ?>,0.15);
  -webkit-box-shadow: 3px 3px 0px 0px rgba(<?php echo esc_html($maincolor_rgb); ?>, 0.15), inset 2px 2px 0px 0px rgba(<?php echo esc_html($mainbgcolor_rgb); ?>,1);
  -moz-box-shadow: 3px 3px 0px 0px rgba(<?php echo esc_html($maincolor_rgb); ?>, 0.15), inset 2px 2px 0px 0px rgba(<?php echo esc_html($mainbgcolor_rgb); ?>,1);
  box-shadow: 3px 3px 0px 0px rgba(<?php echo esc_html($maincolor_rgb); ?>, 0.15), inset 2px 2px 0px 0px rgba(<?php echo esc_html($mainbgcolor_rgb); ?>,1);
}

.woocommerce-message, .woocommerce-info {
  border: 1px solid <?php echo esc_html($maincolor) ?>;
  background-color: rgba(<?php echo esc_html($maincolor_rgb); ?>,0.15);
  -webkit-box-shadow: 4px 4px 0px 0px rgba(<?php echo esc_html($maincolor_rgb); ?>, 0.15), inset 3px 3px 0px 0px rgba(<?php echo esc_html($mainbgcolor_rgb); ?>,1);
  -moz-box-shadow: 4px 4px 0px 0px rgba(<?php echo esc_html($maincolor_rgb); ?>, 0.15), inset 3px 3px 0px 0px rgba(<?php echo esc_html($mainbgcolor_rgb); ?>,1);
  box-shadow: 4px 4px 0px 0px rgba(<?php echo esc_html($maincolor_rgb); ?>, 0.15), inset 3px 3px 0px 0px rgba(<?php echo esc_html($mainbgcolor_rgb); ?>,1); 
}



/****** Sticky Header *******/

header.site-header.header--narrow {
  -webkit-box-shadow: 5px 5px 45px -5px rgba(<?php echo esc_html($maincolor_darker); ?>, 0.2);
  -moz-box-shadow: 5px 5px 45px -5px rgba(<?php echo esc_html($maincolor_darker); ?>, 0.2);
  box-shadow: 5px 5px 45px -5px rgba(<?php echo esc_html($maincolor_darker); ?>, 0.2);
}

.woocommerce span.ribbon::before, .woocommerce-page span.ribbon::before {
    text-shadow: 6px 6px 25px rgba(<?php echo esc_html($maincolor_darker); ?>, 0.3);
}


header.site-header {
  padding-top:<?php echo esc_html($header_padding); ?>px;
  padding-bottom:<?php echo esc_html($header_padding); ?>px;
}

@media screen and (max-width: 39.9375em) {
  header.site-header {
    padding-top:25px;
    padding-bottom:25px;
  } 
}

header.site-header .site-branding img {
  height:<?php echo esc_html($site_logo_height); ?>px;
}

@media screen and (max-width: 39.9375em) {
  header.site-header .site-branding img {
    height:auto;
  }  
}

header.site-header.header--narrow {
  height: auto;
}

.single-product .page-header {
    margin-top: <?php echo esc_html($site_logo_height) + (esc_html($header_padding*2)); ?>px;
}


@media screen and (max-width: 39.9375em) {
  .single-product .page-header {
    margin-top: 120px;
  } 
}


/***************************************************************/
/*  Sticky Header  *********************************************/
/***************************************************************/

.single-product .product_wrapper.images_scroll { 
  
<?php if ( (isset($tdl_options['tdl_product_background']['background-color'])) && (trim($tdl_options['tdl_product_background']['background-color']) != "" ) ) : ?>    
    background-color: <?php echo esc_html($tdl_options['tdl_product_background']['background-color']) ?>;
<?php endif; ?>

<?php if ( (isset($tdl_options['tdl_product_background']['background-image'])) && (trim($tdl_options['tdl_product_background']['background-image']) != "" ) ) : ?>    
    background-image: url("<?php echo esc_html($tdl_options['tdl_product_background']['background-image']) ?>");
<?php endif; ?>

<?php if ( (isset($tdl_options['tdl_product_background']['background-repeat'])) && (trim($tdl_options['tdl_product_background']['background-repeat']) != "" ) ) : ?> 
    background-repeat: <?php echo esc_html($tdl_options['tdl_product_background']['background-repeat']) ?>;
<?php endif; ?>

<?php if ( (isset($tdl_options['tdl_product_background']['background-position'])) && (trim($tdl_options['tdl_product_background']['background-position']) != "" ) ) : ?> 
    background-position: <?php echo esc_html($tdl_options['tdl_product_background']['background-position']) ?>;
<?php endif; ?>

<?php if ( (isset($tdl_options['tdl_product_background']['background-size'])) && (trim($tdl_options['tdl_product_background']['background-size']) != "" ) ) : ?> 
    background-size: <?php echo esc_html($tdl_options['tdl_product_background']['background-size']) ?>;
<?php endif; ?>

<?php if ( (isset($tdl_options['tdl_product_background']['background-attachment'])) && (trim($tdl_options['tdl_product_background']['background-attachment']) != "" ) ) : ?> 
    background-attachment: <?php echo esc_html($tdl_options['tdl_product_background']['background-attachment']) ?>;
<?php endif; ?>
  }


/***************************************************************/
/*  Page Loader Colors *****************************************/
/***************************************************************/

  <?php if ( (isset($tdl_options['tdl_page_loader'])) && (trim($tdl_options['tdl_page_loader']) == "1" ) ) : ?>


    #eva-loader-wrapper {
        background:  <?php echo esc_html($tdl_options['tdl_page_loader_bg']); ?>;
      }

    .eva-loader-1 {
      background-color: <?php echo esc_html($tdl_options['tdl_page_loader_color']); ?>;
    }

    .eva-loader-2 {
      border-top: 0.3em solid rgba(<?php echo eva_hex2rgb($tdl_options['tdl_page_loader_color']);?>,.3);
      border-right: 0.3em solid rgba(<?php echo eva_hex2rgb($tdl_options['tdl_page_loader_color']);?>,.3);
      border-bottom: 0.3em solid rgba(<?php echo eva_hex2rgb($tdl_options['tdl_page_loader_color']);?>,.3);
      border-left: 0.3em solid <?php echo esc_html($tdl_options['tdl_page_loader_color']); ?>;
    }

    .eva-loader-3 {border-top-color: <?php echo esc_html($tdl_options['tdl_page_loader_color']); ?>;} 
    .eva-loader-3:before {
      border-top-color: <?php echo esc_html($tdl_options['tdl_page_loader_color']); ?>;
      opacity: 0.5;
      }

    .eva-loader-3:after {
      border-top-color: <?php echo esc_html($tdl_options['tdl_page_loader_color']); ?>;
      opacity: 0.2;
      }

    .eva-loader-4 {
      border: 3px solid <?php echo esc_html($tdl_options['tdl_page_loader_color']); ?>;
    }
    .eva-loader-4:before, .eva-loader-4:after {
      background-color: <?php echo esc_html($tdl_options['tdl_page_loader_color']); ?>;
    }
  <?php endif; ?>
  

<?php if ( (isset($tdl_options['tdl_sticky_menu'])) && (trim($tdl_options['tdl_sticky_menu']) == "1" ) ) : ?>

/***************************************************************/
/*  Sticky Header  *********************************************/
/***************************************************************/

header.site-header {
  position: fixed;
}

  <?php if ( (isset($tdl_options['tdl_sticky_menu_hide'])) && (trim($tdl_options['tdl_sticky_menu_hide']) == "1" ) ) : ?>
  /****** Auto-hide sticky header *******/
  
  header.site-header.header--hidden {
  -webkit-transform: translate3d(0, -100%, 0);
    -ms-transform: translate3d(0, -100%, 0);
      transform: translate3d(0, -100%, 0);
  }
  <?php endif; ?>

  <?php if ( (isset($tdl_options['tdl_sticky_menu_mobile'])) && (trim($tdl_options['tdl_sticky_menu_mobile']) == "0" ) ) : ?>
  @media screen and (max-width: 63.9375em) {
    header.site-header {
      position: absolute;
    }

    header.site-header.header--narrow {
      display:none
    }    
  }
  <?php endif; ?>

<?php endif; ?>