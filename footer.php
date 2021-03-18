<?php
$tdl_options = eva_global_var();
$number_of_widgets = (!empty($tdl_options['tdl_footer_layout'])) ? $tdl_options['tdl_footer_layout'] : '0';

$footer_align_1 = (!empty($tdl_options['tdl_footer_1_align'])) ? $tdl_options['tdl_footer_1_align'] : 'left-align';
$footer_align_2 = (!empty($tdl_options['tdl_footer_2_align'])) ? $tdl_options['tdl_footer_2_align'] : 'left-align';
$footer_align_3 = (!empty($tdl_options['tdl_footer_3_align'])) ? $tdl_options['tdl_footer_3_align'] : 'left-align';
$footer_align_4 = (!empty($tdl_options['tdl_footer_4_align'])) ? $tdl_options['tdl_footer_4_align'] : 'left-align';
$footer_align_5 = (!empty($tdl_options['tdl_footer_5_align'])) ? $tdl_options['tdl_footer_5_align'] : 'left-align';

$footer_text = (!empty($tdl_options['tdl_footer_text'])) ? $tdl_options['tdl_footer_text'] : '&copy; 2017 - Eva Woocommerce Theme. Created by <a href=\'http://www.temashdesign.com\'>TemashDesign</a>';

    if ( $number_of_widgets == 5 ) {
      $grid_class = "small-up-1 large-up-5";
    }

    if ( $number_of_widgets == 4 ) {
      $grid_class = "small-up-1 large-up-4";
    }
    else if ( $number_of_widgets == 3 ) {
      $grid_class = "small-up-1 large-up-3";
    }
    else if ( $number_of_widgets == 2 ) {
      $grid_class = "small-up-1 large-up-2";
    }
    else if ( $number_of_widgets == 1 ) {
      $grid_class = "small-up-1 large-up-1";
    }
?>

      <footer id="site-footer">

        <?php eva_footer_instagram(); ?>

        <?php if( $number_of_widgets !== '0' ) { ?>
        <div class="f-columns widget-area">

        <?php if ( $number_of_widgets == 1 ): ?>
          <div class="row <?php echo esc_attr($grid_class);?>">
            <section class="column column-widget <?php echo esc_attr($footer_align_1);?>">
              <?php if ( is_active_sidebar( 'footer-sidebar-1' ) ) { ?><?php dynamic_sidebar( 'footer-sidebar-1' ); ?><?php } ?>
            </section>
          </div><!-- .row -->
        <?php endif; ?>

        <?php if ( $number_of_widgets == 2 ): ?>
          <div class="row <?php echo esc_attr($grid_class);?>">
            <section class="column column-widget <?php echo esc_attr($footer_align_1);?>">
              <?php if ( is_active_sidebar( 'footer-sidebar-1' ) ) { ?><?php dynamic_sidebar( 'footer-sidebar-1' ); ?><?php } ?>
            </section>
            <section class="column column-widget <?php echo esc_attr($footer_align_2);?>">
              <?php if ( is_active_sidebar( 'footer-sidebar-2' ) ) { ?><?php dynamic_sidebar( 'footer-sidebar-2' ); ?><?php } ?>
            </section>
          </div><!-- .row -->
        <?php endif; ?>

        <?php if ( $number_of_widgets == 3 ): ?>
          <div class="row <?php echo esc_attr($grid_class);?>">
            <section class="column column-widget <?php echo esc_attr($footer_align_1);?>">
              <?php if ( is_active_sidebar( 'footer-sidebar-1' ) ) { ?><?php dynamic_sidebar( 'footer-sidebar-1' ); ?><?php } ?>
            </section>
            <section class="column column-widget <?php echo esc_attr($footer_align_2);?>">
              <?php if ( is_active_sidebar( 'footer-sidebar-2' ) ) { ?><?php dynamic_sidebar( 'footer-sidebar-2' ); ?><?php } ?>
            </section>
            <section class="column column-widget <?php echo esc_attr($footer_align_3);?>">
              <?php if ( is_active_sidebar( 'footer-sidebar-3' ) ) { ?><?php dynamic_sidebar( 'footer-sidebar-3' ); ?><?php } ?>
            </section>
          </div><!-- .row -->
        <?php endif; ?>

        <?php if ( $number_of_widgets == 4 ): ?>
          <div class="row <?php echo esc_attr($grid_class);?>">
            <section class="column column-widget <?php echo esc_attr($footer_align_1);?>">
              <?php if ( is_active_sidebar( 'footer-sidebar-1' ) ) { ?><?php dynamic_sidebar( 'footer-sidebar-1' ); ?><?php } ?>
            </section>
            <section class="column column-widget <?php echo esc_attr($footer_align_2);?>">
              <?php if ( is_active_sidebar( 'footer-sidebar-2' ) ) { ?><?php dynamic_sidebar( 'footer-sidebar-2' ); ?><?php } ?>
            </section>
            <section class="column column-widget <?php echo esc_attr($footer_align_3);?>">
              <?php if ( is_active_sidebar( 'footer-sidebar-3' ) ) { ?><?php dynamic_sidebar( 'footer-sidebar-3' ); ?><?php } ?>
            </section>
            <section class="column column-widget <?php echo esc_attr($footer_align_4);?>">
              <?php if ( is_active_sidebar( 'footer-sidebar-4' ) ) { ?><?php dynamic_sidebar( 'footer-sidebar-4' ); ?><?php } ?>
            </section>
          </div><!-- .row -->
        <?php endif; ?>

        <?php if ( $number_of_widgets == 5 ): ?>
          <div class="row <?php echo esc_attr($grid_class);?>">
            <section class="column column-widget <?php echo esc_attr($footer_align_1);?>">
              <?php if ( is_active_sidebar( 'footer-sidebar-1' ) ) { ?><?php dynamic_sidebar( 'footer-sidebar-1' ); ?><?php } ?>
            </section>
            <section class="column column-widget <?php echo esc_attr($footer_align_2);?>">
              <?php if ( is_active_sidebar( 'footer-sidebar-2' ) ) { ?><?php dynamic_sidebar( 'footer-sidebar-2' ); ?><?php } ?>
            </section>
            <section class="column column-widget <?php echo esc_attr($footer_align_3);?>">
              <?php if ( is_active_sidebar( 'footer-sidebar-3' ) ) { ?><?php dynamic_sidebar( 'footer-sidebar-3' ); ?><?php } ?>
            </section>
            <section class="column column-widget <?php echo esc_attr($footer_align_4);?>">
              <?php if ( is_active_sidebar( 'footer-sidebar-4' ) ) { ?><?php dynamic_sidebar( 'footer-sidebar-4' ); ?><?php } ?>
            </section>
            <section class="column column-widget <?php echo esc_attr($footer_align_5);?>">
              <?php if ( is_active_sidebar( 'footer-sidebar-5' ) ) { ?><?php dynamic_sidebar( 'footer-sidebar-5' ); ?><?php } ?>
            </section>
          </div><!-- .row -->
        <?php endif; ?>

        <?php if ( $number_of_widgets == 6 ) : ?>
        <div class="row">
          <section class="large-2 medium-3 columns column-widget <?php echo esc_attr($footer_align_1);?>">
          <?php if ( is_active_sidebar( 'footer-sidebar-1' ) ) { ?><?php dynamic_sidebar( 'footer-sidebar-1' ); ?><?php } ?>
          </section>
          <section class="large-2 medium-3 columns column-widget <?php echo esc_attr($footer_align_2);?>">
          <?php if ( is_active_sidebar( 'footer-sidebar-2' ) ) { ?><?php dynamic_sidebar( 'footer-sidebar-2' ); ?><?php } ?>
          </section>
          <section class="large-2 medium-3 columns column-widget <?php echo esc_attr($footer_align_3);?>">
          <?php if ( is_active_sidebar( 'footer-sidebar-3' ) ) { ?><?php dynamic_sidebar( 'footer-sidebar-3' ); ?><?php } ?>
          </section>
           <section class="large-4 medium-3 columns column-widget <?php echo esc_attr($footer_align_4);?>">
          <?php if ( is_active_sidebar( 'footer-sidebar-4' ) ) { ?><?php dynamic_sidebar( 'footer-sidebar-4' ); ?><?php } ?>
          </section>
        </div><!-- .row -->
        <?php endif; ?>


        <?php if ( $number_of_widgets == 7 ) : ?>
        <div class="row">
          <section class="large-3 medium-4 columns column-widget <?php echo esc_attr($footer_align_1);?>">
          <?php if ( is_active_sidebar( 'footer-sidebar-1' ) ) { ?><?php dynamic_sidebar( 'footer-sidebar-1' ); ?><?php } ?>
          </section>
          <section class="large-3 medium-4 columns column-widget <?php echo esc_attr($footer_align_2);?>">
          <?php if ( is_active_sidebar( 'footer-sidebar-2' ) ) { ?><?php dynamic_sidebar( 'footer-sidebar-2' ); ?><?php } ?>
          </section>
          <section class="large-6 medium-4 columns column-widget <?php echo esc_attr($footer_align_3);?>">
          <?php if ( is_active_sidebar( 'footer-sidebar-3' ) ) { ?><?php dynamic_sidebar( 'footer-sidebar-3' ); ?><?php } ?>
          </section>
        </div><!-- .row -->
        <?php endif; ?>



        <?php if ( $number_of_widgets == 8 ) : ?>
        <div class="row">
          <section class="large-3 medium-4 columns column-widget <?php echo esc_attr($footer_align_1);?>">
          <?php if ( is_active_sidebar( 'footer-sidebar-1' ) ) { ?><?php dynamic_sidebar( 'footer-sidebar-1' ); ?><?php } ?>
          </section>
          <section class="large-6 medium-4 columns column-widget <?php echo esc_attr($footer_align_2);?>">
          <?php if ( is_active_sidebar( 'footer-sidebar-2' ) ) { ?><?php dynamic_sidebar( 'footer-sidebar-2' ); ?><?php } ?>
          </section>
          <section class="large-3 medium-4 columns column-widget <?php echo esc_attr($footer_align_3);?>">
          <?php if ( is_active_sidebar( 'footer-sidebar-3' ) ) { ?><?php dynamic_sidebar( 'footer-sidebar-3' ); ?><?php } ?>
          </section>
        </div><!-- .row -->
        <?php endif; ?>

        <?php if ( $number_of_widgets == 9 ) : ?>
        <div class="row">
          <section class="large-6 medium-4 columns column-widget <?php echo esc_attr($footer_align_1);?>">
          <?php if ( is_active_sidebar( 'footer-sidebar-1' ) ) { ?><?php dynamic_sidebar( 'footer-sidebar-1' ); ?><?php } ?>
          </section>
          <section class="large-3 medium-4 columns column-widget <?php echo esc_attr($footer_align_2);?>">
          <?php if ( is_active_sidebar( 'footer-sidebar-2' ) ) { ?><?php dynamic_sidebar( 'footer-sidebar-2' ); ?><?php } ?>
          </section>
          <section class="large-3 medium-4 columns column-widget <?php echo esc_attr($footer_align_3);?>">
          <?php if ( is_active_sidebar( 'footer-sidebar-3' ) ) { ?><?php dynamic_sidebar( 'footer-sidebar-3' ); ?><?php } ?>
          </section>
        </div>
        <?php endif; ?>


        </div>
        <?php } ?>

        <div class="f-copyright">
          <div class="row">
            <div class="medium-12 columns socials">
              <div class="footer-divider"></div>
                  <?php if ( (isset($tdl_options['tdl_footer_social'])) && ($tdl_options['tdl_footer_social'] == "1") ) : ?>
                    <?php eva_socials(); ?>
                  <?php endif; ?>
            </div>
            <div class="medium-12 columns copytxt"><p><?php echo _e(wp_kses( $footer_text, 'default' ), 'lipoblue'); ?></p></div>
          </div>
        </div>
      </footer>

      </div><!-- .page-wrapper -->
    </div><!-- .offcanvas_main_content -->


    <!-- OffCanvas Aside Content Left -->
    <div class="offcanvas_aside offcanvas_aside_left">
      <div class="nano">
        <div class="nano-content">
          <div class="offcanvas_aside_content">
            <?php get_template_part( 'offcanvas', 'left' ); ?>
          </div>
        </div>
      </div>
    </div>

      <!-- OffCanvas Aside Content Right -->
      <div class="offcanvas_aside offcanvas_aside_right">
      <div class="nano">
        <div class="nano-content">
          <div class="offcanvas_aside_content">
            <?php get_template_part( 'offcanvas', 'right' ); ?>
          </div>
        </div>
      </div>
      </div>

      <div class="offcanvas_overlay"></div>
		</div><!-- .offcanvas_container -->

    <div class="cd-quick-view woocommerce">
    </div> <!-- cd-quick-view -->

    <!-- ******************************************************************** -->
    <!-- * Custom Footer JavaScript Code ************************************ -->
    <!-- ******************************************************************** -->

    <?php if ( (isset($tdl_options['tdl_custom_js_footer'])) && ($tdl_options['tdl_custom_js_footer'] != "") ) : ?>
      <?php echo do_shortcode($tdl_options['tdl_custom_js_footer']); ?>
    <?php endif; ?>

		<?php wp_footer(); ?>
    <?php do_action( 'eva_after_footer' ); ?>
	</body>
</html>