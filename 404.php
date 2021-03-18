<?php get_header(); ?>

	<div id="primary" class="content-area">
	<?php get_template_part( 'includes/headers/page', 'header' ); ?>

		<div class="row">
			<div class="large-9 large-centered columns"> 
				<main id="main" class="site-main">
					<header class="page-header oops-header">
						<h1 class="page-title"><?php esc_html_e( '404', 'eva' ); ?></h1>
						<h2 class="page-sub-title"><?php esc_html_e( 'Sorry but we couldn&rsquo;t find the page you are looking for.', 'eva' ); ?></h2>
					</header><!-- .page-header -->

					<section class="error-404 not-found">
						<div class="page-content">
							<p><?php esc_html_e( 'Please check to make sure you&rsquo;ve typed the URL correctly. Maybe try a search?', 'eva' ); ?></p>
                
							<?php get_search_form(); ?>
						</div><!-- .page-content -->                           
					</section><!-- .error-404 -->
				</main><!-- #main -->
			</div>
		</div>
	</div><!-- #primary -->

<?php get_footer(); ?>
