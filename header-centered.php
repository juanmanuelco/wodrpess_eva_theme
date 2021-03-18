<?php 
global $yith_wcwl, $woocommerce;
$tdl_options = eva_global_var();
if ( EVA_WOOCOMMERCE_IS_ACTIVE ) {
  if (is_shop()) {
    $page_id = wc_get_page_id('shop');
  }
}
$page_header_color_switcher = get_field('tdl_bg_change', $page_id);
$menu_trigger = (!empty($tdl_options['tdl_trigger_menu_style'])) ? $tdl_options['tdl_trigger_menu_style'] : 'menu_trigger_1';


if ( EVA_WOOCOMMERCE_IS_ACTIVE ) {
  if ( is_product_category() ) {
    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
    $page_header_color_switcher = get_field('tdl_prodcat_bg_change', $term);
  }
}
?>

<header class="site-header animate-search <?php echo esc_attr( $page_header_color_switcher ); ?>" role="banner">

	<div class="header-wrapper row">

      <div class="nav">
      <?php if ( has_nav_menu('main_navigation') ) : ?>
        <div class="header-nav">
          <div class="menu-trigger <?php echo esc_attr($menu_trigger) ?>">
            <div><span></span></div>
            <?php if ( $menu_trigger == "menu_trigger_1" ) : ?>
            <span class="menu-title"><?php esc_html_e( 'Menu', 'eva' ); ?></span>
            <?php endif; ?>
          </div>

          <nav class="main-navigation">
            <?php 
              $walker = new rc_scm_walker;
              wp_nav_menu(array(
                  'theme_location'  => 'main_navigation',
                  'fallback_cb'     => false,
                  'container'       => false,
                  'link_before'       => '<span>',
                  'link_after'       => '</span>',                  
                  'items_wrap'      => '<ul class="%1$s">%3$s</ul>',
                  'walker'      => $walker
              ));
            ?>             
          </nav>


        </div> 

      

      <?php endif; ?>
   
      </div><!-- .nav -->

      <div class="site-branding">

        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">

        	<?php if ( ! empty( $tdl_options['tdl_main_logo_noretina']['url'] ) ) : ?>

            <?php 
            if (is_ssl()) {
              $site_logo = str_replace("http://", "https://", $tdl_options['tdl_main_logo_noretina']['url']);
              $site_logo_retina = str_replace("http://", "https://", $tdl_options['tdl_main_logo_retina']['url']);
            } else {
              $site_logo = $tdl_options['tdl_main_logo_noretina']['url'];
              $site_logo_retina = $tdl_options['tdl_main_logo_retina']['url'];
            }
            ?>

        		<!-- Main Logo -->

        		<?php if ( ! empty( $tdl_options['tdl_main_logo_retina']['url'] ) ) : ?>
        			<img class="main-logo dark animated fadeIn" src="<?php echo esc_url($site_logo); ?>" srcset="<?php echo esc_url($site_logo_retina); ?> 2x" alt="logo">
        		<?php else : ?>
        			<img class="main-logo dark animated fadeIn" src="<?php echo esc_url($site_logo); ?>" alt="logo">
        		<?php endif; ?>

        	<?php else : ?>

    				<h1><?php esc_html(bloginfo( 'name' )); ?></h1>
    				<?php if (isset($tdl_options['tdl_logo_description']) && $tdl_options['tdl_logo_description'] == 1) {?>
    					<small><?php echo esc_html(get_bloginfo('description')); ?></small>              
    				<?php } ?>

        	<?php endif; ?>


          <?php if ( ! empty( $tdl_options['tdl_main_logo_noretina_light']['url'] ) ) : ?>

            <?php 
            if (is_ssl()) {
              $site_logo_light = str_replace("http://", "https://", $tdl_options['tdl_main_logo_noretina_light']['url']);
              $site_logo_retina_light = str_replace("http://", "https://", $tdl_options['tdl_main_logo_retina_light']['url']);
            } else {
              $site_logo_light = $tdl_options['tdl_main_logo_noretina_light']['url'];
              $site_logo_retina_light = $tdl_options['tdl_main_logo_retina_light']['url'];
            }
            ?>            

            <!-- Main Logo for Dark Background -->

            <?php if ( ! empty( $tdl_options['tdl_main_logo_retina_light']['url'] ) ) : ?>
              <img class="main-logo light animated fadeIn" src="<?php echo esc_url($site_logo_light); ?>" srcset="<?php echo esc_url($site_logo_retina_light); ?> 2x" alt="logo">
            <?php else : ?>
              <img class="main-logo light animated fadeIn" src="<?php echo esc_url($site_logo_light); ?>" alt="logo">
            <?php endif; ?>
                    
          <?php endif; ?>
        


           <?php if ( ! empty( $tdl_options['tdl_sticky_logo_noretina']['url'] ) ) : ?>

            <?php 
            if (is_ssl()) {
              $site_logo_sticky = str_replace("http://", "https://", $tdl_options['tdl_sticky_logo_noretina']['url']);
              $site_logo_retina_sticky = str_replace("http://", "https://", $tdl_options['tdl_sticky_logo_retina']['url']);
            } else {
              $site_logo_sticky = $tdl_options['tdl_sticky_logo_noretina']['url'];
              $site_logo_retina_sticky = $tdl_options['tdl_sticky_logo_retina']['url'];
            }
            ?>            

            <!-- Sticky Header Logo -->

            <?php if ( ! empty( $tdl_options['tdl_sticky_logo_retina']['url'] ) ) : ?>
              <img class="sticky-logo animated fadeIn" src="<?php echo esc_url($site_logo_sticky); ?>" srcset="<?php echo esc_url($site_logo_retina_sticky); ?> 2x" alt="logo">
            <?php else : ?>
              <img class="sticky-logo animated fadeIn" src="<?php echo esc_url($site_logo_sticky); ?>" alt="logo">
            <?php endif; ?>
                    
          <?php else : ?>
            <div class="sticky-logo">
            <h1><?php esc_html(bloginfo( 'name' )); ?></h1>
            <?php if (isset($tdl_options['tdl_logo_description']) && $tdl_options['tdl_logo_description'] == 1) {?>
              <small><?php echo esc_html(get_bloginfo('description')); ?></small>              
            <?php } ?>              
            </div>


          <?php endif; ?>        


        </a>
      </div><!-- .site-branding -->


      <div class="tools">
        <ul>

        <?php if ( (isset($tdl_options['tdl_header_search_bar'])) && ($tdl_options['tdl_header_search_bar'] == "1") ) : ?>
          <li class="search-button">
            <a href="#search" class="cd-search-trigger cd-text-replace">
              <i class="search-button-icon"></i>
            </a>
          </li>
        <?php endif; ?>
        
        <?php if ( EVA_WOOCOMMERCE_IS_ACTIVE ) : ?> 
          <?php if (class_exists('YITH_WCWL')) : ?>
            <li class="wishlist-button">
              <a href="<?php echo esc_url($yith_wcwl->get_wishlist_url()); ?>">
                <i class="wishlist-button-icon"></i>
                <span class="wishlist_items_number counter_number animated rubberBand"><?php echo yith_wcwl_count_products(); ?></span>
              </a>
            </li>
          <?php endif; ?> 
        <?php endif; ?> 

        <?php if ( EVA_WOOCOMMERCE_IS_ACTIVE ) : ?> 
          <?php if ( (isset($tdl_options['tdl_header_my_account'])) && ($tdl_options['tdl_header_my_account'] == 1) ) : ?>
            <li class="myaccount-button">
              <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
                <i class="myaccount-button-icon"></i>
              </a>
            </li>
          <?php endif; ?> 
        <?php endif; ?>

        <?php if ( EVA_WOOCOMMERCE_IS_ACTIVE ) : ?>   
          <?php if ( (isset($tdl_options['tdl_catalog_mode'])) && ($tdl_options['tdl_catalog_mode'] == 0) ) : ?>
            <li class="cart-button">
              <a href="<?php echo esc_url(WC()->cart->get_cart_url()); ?>">
                  <div class="cart-desc">
                    <span class="cart_total"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
                    <?php esc_html_e( 'Cart', 'eva' ); ?>
                  </div>
                  <i class="cart-button-icon"></i>
                  <span class="cart_items_number counter_number animated rubberBand"><?php echo esc_html(WC()->cart->get_cart_contents_count()); ?></span>
              </a>
            </li>  
          <?php endif; ?>
        <?php endif; ?>               

        </ul>
      </div><!-- .tools -->      
</div>


</header>