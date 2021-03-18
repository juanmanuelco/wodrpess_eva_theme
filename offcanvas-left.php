<?php 
  $tdl_options = eva_global_var();
  global $yith_wcwl;
?>

<?php if ( has_nav_menu('main_navigation') ) : ?>
<div class="offcanvas_mainmenu">

  <div class="offcanvas_close"></div>

  <?php eva_language_and_currency(); ?>

  <?php if ( (isset($tdl_options['tdl_header_search_bar'])) && ($tdl_options['tdl_header_search_bar'] == "1") ) : ?>
    <?php if ( (isset($tdl_options['tdl_mobile_search_bar'])) && ($tdl_options['tdl_mobile_search_bar'] == "1") ) : ?>
      <div class="mob_inputbox">
        <?php EVA_WOOCOMMERCE_IS_ACTIVE ? get_product_search_form() : get_search_form(true); ?>
      </div>
    <?php endif; ?>
  <?php endif; ?>

  <div class="offcanvas_navigation">

    <nav id="menu">
      <ul class="offcanvas_menu">

          <?php 
              wp_nav_menu(array(
                  'theme_location'  => 'main_navigation',
                  'fallback_cb'     => false,
                  'container'       => false,
                  'link_before'       => '<span><div>',
                  'link_after'       => '</div></span>',
                  'items_wrap'      => '%3$s',
              ));
          ?>

        <!-- Wishlist Button -->
            <?php if ( EVA_WOOCOMMERCE_IS_ACTIVE ) : ?>
              <hr>
            <?php if ( EVA_WISHLIST_IS_ACTIVE ) : ?>
                
                <li class="bot-menu-item wishlist-button">
                    <a class="tools_button" href="<?php echo esc_url($yith_wcwl->get_wishlist_url()); ?>">
                        <span><div>
                          <?php esc_html_e('Wishlist', 'eva'); ?>
                        </div></span>
                    </a>
                </li>

            <?php endif; ?>

            <?php if ( (isset($tdl_options['tdl_offcanvas_myccount'])) && ($tdl_options['tdl_offcanvas_myccount'] == "1") ) : ?>            

            <?php if ( is_user_logged_in() ) : ?>
            <li class="bot-menu-item account-button">
              <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
                <span><div>
                  <?php esc_html_e('My account', 'woocommerce'); ?>
                </div></span>
              </a>
            </li>
            <?php else: ?>
            <li class="bot-menu-item login-button">
              <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
                <span><div>
                  <?php esc_html_e('Login/Register', 'woocommerce'); ?>
                </div></span>
              </a>
            </li>          
            <?php endif; ?>

            <?php if ( is_user_logged_in() ) : ?>
             <li class="bot-menu-item logout-button">
              <a href="<?php echo wp_logout_url( home_url() ); ?>">
                <span><div>
                  <?php esc_html_e('Logout', 'woocommerce'); ?>
                </div></span>
              </a>
            </li>         
            <?php endif; ?>

            <?php endif; ?> 
            
            <?php if ( (isset($tdl_options['tdl_offcanvas_social'])) && ($tdl_options['tdl_offcanvas_social'] == "1") ) : ?>
              <hr>

              <?php eva_socials(); ?>

            <?php endif; ?>

            <?php endif; ?>           

      </ul>
    </nav>
  </div>
</div>
<?php endif; ?>

<div class="offcanvas_sidebars">
  <div class="offcanvas_close"></div>
<?php 
  // Is this a woocommerce page?
  if (EVA_WOOCOMMERCE_IS_ACTIVE && is_woocommerce()):
    if ( is_active_sidebar( 'widgets-product-listing' ) ) : ?>
      <div class="offcanvas_shop_sidebar">
            <div class="widget-area">
                <?php dynamic_sidebar( 'widgets-product-listing' ); ?>
            </div>
        </div>
      <?php endif;  
  endif;          
?>
</div>


