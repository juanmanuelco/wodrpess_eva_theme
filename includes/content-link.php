<?php
	$tdl_options = eva_global_var();
    $link = get_field('tdl_link_url');
    $blog_with_sidebar = "";

    if (is_single()) {
        $blog_with_sidebar = (!empty($tdl_options['tdl_single_blog_layout'])) ? $tdl_options['tdl_single_blog_layout'] : '';
    } else {
        $blog_with_sidebar = (!empty($tdl_options['tdl_blog_layout'])) ? $tdl_options['tdl_blog_layout'] : '';        
    }     

    if ( $blog_with_sidebar == "1" ) $blog_with_sidebar = "yes";
    if (isset($_GET["blog_with_sidebar"])) $blog_with_sidebar = $_GET["blog_with_sidebar"];    
?>
            
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        
    <div class="row">
        <div class="large-12 columns">
            
            <header class="entry-header">
            
                <div class="row">


                    <?php if ( $blog_with_sidebar == "yes" ) : ?>
                    <div class="large-12 columns with-sidebar post-section">
                    <?php else : ?>
                    <div class="large-8 large-centered columns without-sidebar post-section">
                    <?php endif; ?>
                    
                    <?php if ( !is_single() ) : ?>
                        <h2 class="entry-title">
                            <i class="icon-px-outline-link post-link-icon"></i><a href="<?php echo esc_url( $link ); ?>"><?php the_title(); ?></a>
                            <a href="<?php echo esc_url( $link ); ?>" class="post-link-url"><?php echo esc_url( $link ); ?></a>
                        </h2>
                    <?php endif; // is_single() ?>
                        
                    </div>
                </div>
                

        
            </header><!-- .entry-header -->
            
        </div><!-- .columns -->
    </div><!-- .row -->

    <div class="row">
        <?php if ( $blog_with_sidebar == "yes" ) : ?>
            <div class="large-12 columns">
        <?php else : ?>
            <div class="large-8 large-centered columns without-sidebar">
        <?php endif; ?>
            
            <div class="entry-content">
				<?php
                if( ($post->post_excerpt) && (!is_single()) ) {
                    the_excerpt();
                    ?>
                    <a href="<?php the_permalink(); ?>" class="more-link"><?php esc_html_e('Continue reading &rarr;', 'eva'); ?></a>
                <?php
                } else { ?>

                <h2 class="entry-title">
                    <i class="icon-px-outline-link post-link-icon"></i><a href="<?php echo esc_url( $link ); ?>"><?php the_title(); ?></a><br/>
                    <a href="<?php echo esc_url( $link ); ?>" class="post-link-url"><?php echo esc_url( $link ); ?></a>
                </h2>

                <?php  the_content( esc_html__( 'Continue reading &rarr;', 'eva' ) );
                }
                ?>
                <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'eva' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>

                <?php if ( is_single() ) : ?>
                            
                    <footer class="entry-meta">
                        
                        <?php eva_entry_meta(); echo "."; ?>
                        <?php edit_post_link( esc_html__( 'Edit', 'eva' ), '<div class="edit-link">', '</div>' ); ?>
                        
                    </footer><!-- .entry-meta -->

                <?php else: ?>
                    <div class="comment-link">
                    <?php 
                        if ( comments_open() ) :
                          echo '<p>';
                          comments_popup_link( 
                            esc_html__( 'No comments yet', 'eva' ), 
                            esc_html__( '1 Comment', 'eva' ), 
                            esc_html__( '% Comments', 'eva' ),
                            'comments-link',
                            esc_html__( 'Comments are off for this post', 'eva' )
                            );
                          echo '</p>';
                        endif;
                     ?>
                    </div>
                <?php endif; ?>

            </div><!-- .entry-content -->
        

                               
        </div><!-- .columns -->
    </div><!-- .row -->

</article><!-- #post -->
