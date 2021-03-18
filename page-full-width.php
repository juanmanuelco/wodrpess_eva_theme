<?php
/*
Template Name: Full Width Page
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

<div id="primary" class="content-area">

      <?php get_template_part( 'includes/headers/page', 'header' ); ?>

  <div id="content" class="site-content" role="main">

			<?php if (function_exists('wc_print_notices')) : ?>
				<div class="row woocommerce">
					<div class="large-12 columns wc-notice">
						<?php wc_print_notices(); ?>
					</div>
				</div>
			<?php endif; ?>    


            <?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'content', 'pagefull' ); ?>
                    
                <?php if (function_exists('is_cart') && is_cart()) : ?>
                <?php else: ?>    
                <div class="clearfix"></div>
                <?php endif; ?>

                <?php
                    // If comments are open or we have at least one comment, load up the comment template
                    if ( comments_open() || '0' != get_comments_number() ) comments_template();
                ?>

            <?php endwhile; // end of the loop. ?>

    </div><!-- #content -->           
        
</div><!-- #primary -->
    
<?php get_footer(); ?>
