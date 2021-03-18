<section class="no-results not-found">
	
	<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'eva' ); ?></h1>

	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'eva' ), admin_url( 'post-new.php' ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<div class="search-no-results">
				<div class="sorry-no-results">
					<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'eva' ); ?></p>
				</div>
				<?php get_search_form(); ?>
			</div>

		<?php else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'eva' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div><!-- .page-content -->
	
</section><!-- .no-results -->
