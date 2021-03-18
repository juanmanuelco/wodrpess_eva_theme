<?php
/*
Template Name: Page with Right Sidebar
*/
?>

<?php
	$tdl_options = eva_global_var();

  $page_id = "";
    if ( is_single() || is_page() ) {
        $page_id = get_the_ID();
    } else if ( is_home() ) {
        $page_id = get_option('page_for_posts');    
    }
?>

<?php get_header(); ?>

	<div id="primary" class="page-content-area content-area">

      <?php get_template_part( 'includes/headers/page', 'header' ); ?>

  <div id="content" class="site-content" role="main">

			<?php if (function_exists('wc_print_notices')) : ?>
				<div class="row woocommerce">
					<div class="large-12 columns wc-notice">
						<?php wc_print_notices(); ?>
					</div>
				</div>
			<?php endif; ?>  

            <div class="row">
                <div class="large-8 columns with-sidebar">
                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php get_template_part( 'content', 'page' ); ?>
                        
                        <?php if (function_exists('is_cart') && is_cart()) : ?>
                        <?php else: ?>    
                            <div class="clearfix"></div>
                        <?php endif; ?>

                    <?php
                        // If comments are open or we have at least one comment, load up the comment template
                        if ( comments_open() || '0' != get_comments_number() ) comments_template();
                    ?>

                <?php endwhile; // end of the loop. ?>               
                </div>

                <div class="large-4 columns">                           
                    <div class="row">
                        <div class="large-11 large-push-1 columns"> 
                            <?php if ( is_active_sidebar( 'sidebar' ) ) { ?>
                                <div id="secondary" class="widget-area" role="complementary">
                                    <?php dynamic_sidebar( 'sidebar' ); ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>                
                </div><!-- .columns -->
            </div>  




        </div><!-- #content -->           
        
    </div><!-- #primary -->
    
<?php get_footer(); ?>
