<?php
	$tdl_options = eva_global_var();
    $quote = get_field('tdl_quote_text');
    $author = get_field('tdl_quote_author');    
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
        <?php if ( $blog_with_sidebar == "yes" ) : ?>
            <div class="large-12 columns">
        <?php else : ?>
            <div class="large-8 large-centered columns without-sidebar">
        <?php endif; ?>
            
            <div class="entry-content">

                <?php 
                    echo '<blockquote>'; ?>

                <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                    <div class="entry-thumbnail">
                        <?php the_post_thumbnail(array(130,130)); ?>
                    </div>
                <?php endif; ?> 

                <?php    echo '<p>';
                    echo esc_attr($quote);
                    echo '</p>';
                    if ($author)
                        echo '<cite>' . $author . '</cite>';
                    echo '</blockquote>';           
                ?> 

				<?php
                if( ($post->post_excerpt) && (!is_single()) ) {
                    the_excerpt();
                    ?>
                    <a href="<?php the_permalink(); ?>" class="more-link"><?php esc_html_e('Continue reading &rarr;', 'eva'); ?></a>
                <?php
                } else {
                    the_content( esc_html__( 'Continue reading &rarr;', 'eva' ) );
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
