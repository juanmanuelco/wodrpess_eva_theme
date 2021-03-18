<?php
$tdl_options = eva_global_var();
if ( EVA_WOOCOMMERCE_IS_ACTIVE ) {
  if (is_shop()) {
    $page_id = wc_get_page_id('shop');
  }
}
$page_header_color_switcher = get_field('tdl_bg_change', $page_id);

if ( EVA_WOOCOMMERCE_IS_ACTIVE ) {
  if ( is_product_category() ) {
    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
    $page_header_color_switcher = get_field('tdl_prodcat_bg_change', $term);
  }
}
 ?>
<div id="header-top-bar" class="<?php echo esc_attr( $page_header_color_switcher ); ?>">
	<div class="topbar_wrapper row">
		<div class="topbar_left">

			<?php if ( (isset($tdl_options['tdl_topbar_login'])) && ($tdl_options['tdl_topbar_login'] == "1") ) : ?>
				<div class="topbar_myaccount topbar-item">
					<?php if ( is_user_logged_in() ) : ?>
					<i class="myaccount-button-icon"></i><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><?php esc_html_e('My account', 'woocommerce'); ?></a>
					<?php else: ?>
					<i class="login-button-icon"></i><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><?php esc_html_e('Login/Register', 'woocommerce'); ?></a>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php if ( (isset($tdl_options['tdl_topbar_contact'])) && ($tdl_options['tdl_topbar_contact'] == "1") ) : ?>
				<div class="topbar_contact topbar-item">
		          <?php if ( (isset($tdl_options['tdl_topbar_contact_icon'])) && ($tdl_options['tdl_topbar_contact_icon'] == "1") ) : ?>
		            <i class="header-contact-icon"></i>
		          <?php endif; ?>
		          <div class="header-contact-desc">
		            <?php if ( isset($tdl_options['tdl_topbar_contact_subtitle']) ) : ?>
		              <span><?php echo _e(esc_attr($tdl_options['tdl_topbar_contact_subtitle']), 'lipoblue'); ?></span>
		            <?php endif; ?>
		            <?php if ( isset($tdl_options['tdl_topbar_contact_title']) ) : ?>
		              <h3><?php echo _e(esc_attr($tdl_options['tdl_topbar_contact_title']), 'lipoblue'); ?></h3>
		            <?php endif; ?>
		          </div>
				</div>
			<?php endif; ?>

		</div>

		<div class="topbar_right">
		<?php if ( (isset($tdl_options['tdl_topbar_social'])) && ($tdl_options['tdl_topbar_social'] == "1") ) : ?>
			<div class="topbar_socials">
				 <?php eva_socials(); ?>
			</div>
		<?php endif; ?>
			<div class="topbar_languages">
				<?php eva_language_and_currency_topbar(); ?>
			</div>
		</div>
	</div>
</div>