<?php 
$tdl_options = eva_global_var();
$page_for_posts = get_option('page_for_posts');
$blog = get_post($page_for_posts);      
$page_title_option = get_field('tdl_hide_title', $page_for_posts);

$blog_with_sidebar = "yes";
if ( (isset($tdl_options['tdl_blog_layout'])) && ($tdl_options['tdl_blog_layout'] == "0" ) ) $blog_with_sidebar = "no";
if ( (isset($tdl_options['tdl_blog_layout'])) && ($tdl_options['tdl_blog_layout'] == "1" ) ) $blog_with_sidebar = "yes";

if (isset($_GET["blog_with_sidebar"])) $blog_with_sidebar = $_GET["blog_with_sidebar"]; 

?>

<?php get_header(); ?>

<div id="primary" class="blog-content-area">
	<?php get_template_part( 'includes/headers/archive', 'header' ); ?>
	
	<div class="row">
	<?php if ( $blog_with_sidebar == "yes" ) : ?>
		<div class="large-8 columns with-sidebar">
	<?php else: ?>
		<div class="large-12 columns no-sidebar">
	<?php endif; ?>

	<div id="content" class="site-content" role="main"> 
		<?php if ( have_posts() ) : ?>
                   
				<?php while ( have_posts() ) : the_post(); ?>
                                
					<?php get_template_part( 'includes/content', get_post_format() ); ?>
                 
				<?php endwhile; ?>
                
				<?php eva_content_nav( 'nav-below' ); ?>
                            
				<!--no posts found-->
			<?php else : ?>
            
				<?php get_template_part( 'content', 'none' ); ?>
            
			<?php endif; ?>	
	</div>

		</div><!-- .columns -->

	<?php if ( $blog_with_sidebar == "yes" ) : ?>
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
	<?php endif; ?>

	</div><!-- .row -->

</div>

<?php get_footer(); ?>