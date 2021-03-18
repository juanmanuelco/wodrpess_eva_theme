<?php
  $tdl_options = eva_global_var();

  $page_for_posts = get_option('page_for_posts');
  $blog = get_post($page_for_posts); 

  $page_title_option = 1;
  $subtitle = null;
  $page_header_color_switcher = '';
    
  if ( EVA_ACF_IS_ACTIVE ) {
      $page_title_option = esc_attr(get_field('tdl_hide_title', $page_for_posts));
      $subtitle = get_field('tdl_subtitle', $page_for_posts);
      $page_header_color_switcher = get_field('tdl_bg_change', $page_for_posts);
  }     

?>

         <!-- Page Header -->
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
            <div class="title-section <?php echo esc_attr( $page_header_color_switcher ); ?>">
              <?php echo eva_breadcrumbs(); ?>
              <h1 class="page-title">
              <?php
                if ( is_category() ) :
                  single_cat_title();
    
                elseif ( is_tag() ) :
                  single_tag_title();
    
                elseif ( is_author() ) :
                  /* Queue the first post, that way we know
                   * what author we're dealing with (if that is the case).
                  */
                  the_post();
                  printf( esc_html__( 'Author: %s', 'eva' ), '<span class="vcard">' . get_the_author() . '</span>' );
                  /* Since we called the_post() above, we need to
                   * rewind the loop back to the beginning that way
                   * we can run the loop properly, in full.
                   */
                  rewind_posts();
    
                elseif ( is_day() ) :
                  printf( esc_html__( 'Day: %s', 'eva' ), '<span>' . get_the_date() . '</span>' );
    
                elseif ( is_month() ) :
                  printf( esc_html__( 'Month: %s', 'eva' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );
    
                elseif ( is_year() ) :
                  printf( esc_html__( 'Year: %s', 'eva' ), '<span>' . get_the_date( 'Y' ) . '</span>' );
    
                elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
                  esc_html_e( 'Asides', 'eva' );
    
                elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
                  esc_html_e( 'Images', 'eva');
    
                elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
                  esc_html_e( 'Videos', 'eva' );
    
                elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
                  esc_html_e( 'Quotes', 'eva' );
    
                elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
                  esc_html_e( 'Links', 'eva' );
    
                else :
                  esc_html_e( 'Archives', 'eva' );
    
                endif;
              ?>                
              </h1>
              <?php if ( esc_attr( $subtitle ) ) : ?>
                <div class="term-description"><p><?php echo esc_attr( $subtitle ); ?></p></div>
              <?php endif; ?>
            </div>
          <?php endif; ?>
          </div>
        </div>


