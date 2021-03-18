<?php
  $tdl_options = eva_global_var();

  $page_for_posts = get_option('page_for_posts');
  $blog = get_post($page_for_posts);      

  $subtitle = get_field('tdl_subtitle', $page_for_posts);
  $page_title_option = get_field('tdl_hide_title', $page_for_posts);
  $page_header_color_switcher = get_field('tdl_bg_change', $page_for_posts);
?>

        <?php if ( has_post_thumbnail($page_for_posts) ) : ?>
          
        <?php 
        $thumb_id = get_post_thumbnail_id($page_for_posts);
        $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
        $thumb_url = $thumb_url_array[0];
        ?>

        <div class="page-header" data-stellar-background-ratio="0.6" style="background-image: url(<?php echo esc_url($thumb_url); ?>)">
        <?php else: ?>
     

        <div class="page-header animated fadeIn">
        <?php endif; ?>
          <div class="row">
          <?php if ( $page_title_option == 1 ): ?>
            <div class="title-section">
              <?php echo eva_breadcrumbs(); ?>

              <h1 class="page-title"><?php echo esc_attr($blog->post_title); ?></h1>
              <?php if ( esc_attr( $subtitle ) ) : ?>
                <div class="term-description"><p><?php echo esc_attr( $subtitle ); ?></p></div>
              <?php endif; ?>
            </div>
          <?php endif; ?>
          </div>
        </div>


