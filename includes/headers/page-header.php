<?php
  $tdl_options = eva_global_var();

  $page_id = "";
    if ( is_single() || is_page() ) {
        $page_id = get_the_ID();
    } else if ( is_home() ) {
        $page_id = get_option('page_for_posts');    
    }

    $page_title_option = 1;
    $subtitle = null;
    $page_header_color_switcher = '';
    
    if ( EVA_ACF_IS_ACTIVE ) {
        $page_title_option = esc_attr(get_field('tdl_hide_title', $page_id));
        $subtitle = get_field('tdl_subtitle', $page_id);
        $page_header_color_switcher = get_field('tdl_bg_change', $page_id);
    }

    if (function_exists('is_order_tracking') && is_order_tracking() || function_exists('is_cart') && is_cart() || function_exists('is_checkout') && is_checkout() || function_exists('is_account_page') && is_account_page()) 
    {
        $page_title_option = 1;
    }



?>

         <!-- Page Header -->
        <?php if ( has_post_thumbnail() ) : ?>
          
          <?php 
          $thumb_id = get_post_thumbnail_id();
          $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
          $thumb_url = $thumb_url_array[0];
          ?>
        
        <div class="page-header" data-stellar-background-ratio="0.6" style="background-image: url(<?php echo esc_url($thumb_url); ?>)">
        <?php else: ?>
     

        <div class="page-header animated fadeIn">
        <?php endif; ?>
          <div class="row">
          <?php if ( $page_title_option == 1 ): ?>
            <div class="title-section <?php echo esc_attr( $page_header_color_switcher ); ?>">
              <?php echo eva_breadcrumbs(); ?>
              <h1 class="page-title"><?php the_title(); ?></h1>
              <?php if ( esc_attr( $subtitle ) ) : ?>
                <div class="term-description"><p><?php echo esc_attr( $subtitle ); ?></p></div>
              <?php endif; ?>
            </div>
          <?php endif; ?>
          </div>
        </div>


