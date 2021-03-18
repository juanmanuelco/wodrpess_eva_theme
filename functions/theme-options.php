<?php 

define( 'EVA_WOOCOMMERCE_IS_ACTIVE',	class_exists( 'WooCommerce' ) );
define( 'EVA_VISUAL_COMPOSER_IS_ACTIVE',	defined( 'WPB_VC_VERSION' ) );
define( 'EVA_REV_SLIDER_IS_ACTIVE',	class_exists( 'RevSlider' ) );
define( 'EVA_WPML_IS_ACTIVE',	defined( 'ICL_SITEPRESS_VERSION' ) );
define( 'EVA_WISHLIST_IS_ACTIVE',	class_exists( 'YITH_WCWL' ) );
define( 'EVA_ACF_IS_ACTIVE',	class_exists( 'ACF' ) );

/**
 * Checks if the required plugin is active in network or single site.
 *
 * @param $plugin
 *
 * @return bool
 */
function plugins_is_active( $plugin ) {
	$network_active = false;
	if ( is_multisite() ) {
		$plugins = get_site_option( 'active_sitewide_plugins' );
		if ( isset( $plugins[$plugin] ) ) {
			$network_active = true;
		}
	}
	return in_array( $plugin, get_option( 'active_plugins' ) ) || $network_active;
}

// -----------------------------------------------------------------------------
// Theme Version
// -----------------------------------------------------------------------------

if ( ! function_exists( 'eva_theme_version' ) ) :
function eva_theme_version() {
	$eva_theme = wp_get_theme();
	return $eva_theme->get('Version');
}
endif;


/******************************************************************************/
/******************************** Favicon *************************************/
/******************************************************************************/

if( !function_exists( 'eva_favicon' ) ) {
	function eva_favicon() {
		global $tdl_options;
		if ( function_exists( 'has_site_icon' ) && has_site_icon() ) return '';

		$favicon = '';
		$touch_icon = '';

		$fav_uploaded = (!empty($tdl_options['tdl_favicon_image']['url'])) ? $tdl_options['tdl_favicon_image']['url'] : '';
		if(isset($fav_uploaded) && $fav_uploaded != '') {
			$favicon = $fav_uploaded;
		}

		$fav_uploaded_retina = (!empty($tdl_options['tdl_favicon_image_retina']['url'])) ? $tdl_options['tdl_favicon_image_retina']['url'] : '';
		if(isset($fav_uploaded_retina) && $fav_uploaded_retina != '') {
			$touch_icon = $fav_uploaded_retina;
		}

		?>
			<link rel="shortcut icon" href="<?php echo esc_attr($favicon); ?>">
			<link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo esc_attr($touch_icon); ?>">
		<?php
	}

	add_action( 'wp_head', 'eva_favicon' );
}


    /* PERFORMANCE FRIENDLY GET META FUNCTION
    ================================================== */
    if ( !function_exists( 'sf_get_post_meta' ) ) {
	    function sf_get_post_meta( $id, $key = "", $single = false ) {

	        $GLOBALS['sf_post_meta'] = isset( $GLOBALS['sf_post_meta'] ) ? $GLOBALS['sf_post_meta'] : array();
	        if ( ! isset( $id ) ) {
	            return;
	        }
	        if ( ! is_array( $id ) ) {
	            if ( ! isset( $GLOBALS['sf_post_meta'][ $id ] ) ) {
	                //$GLOBALS['sf_post_meta'][ $id ] = array();
	                $GLOBALS['sf_post_meta'][ $id ] = get_post_meta( $id );
	            }
	            if ( ! empty( $key ) && isset( $GLOBALS['sf_post_meta'][ $id ][ $key ] ) && ! empty( $GLOBALS['sf_post_meta'][ $id ][ $key ] ) ) {
	                if ( $single ) {
	                    return maybe_unserialize( $GLOBALS['sf_post_meta'][ $id ][ $key ][0] );
	                } else {
	                    return array_map( 'maybe_unserialize', $GLOBALS['sf_post_meta'][ $id ][ $key ] );
	                }
	            }

	            if ( $single ) {
	                return '';
	            } else {
	                return array();
	            }

	        }

	        return get_post_meta( $id, $key, $single );
	    }
    }


/*-----------------------------------------------------------------------------------*/
/*	WPML/Currency dropdown
/*-----------------------------------------------------------------------------------*/

	function eva_language_and_currency() { 

		?>

		<nav class="language_currency">
                
            <?php 
            if (function_exists('icl_get_languages')) {

            function languages_list(){
                $languages = icl_get_languages('skip_missing=N&link_empty_to=str');
                if(!empty($languages)){
                    echo '<ul class="languages">';
                    foreach($languages as $l){

                    	if (!$l['active']) {
                    		echo '<li><a href="'.$l['url'].'">'.icl_disp_language($l['translated_name']).'</a></li>';
                    	} else {
                    		echo '<li class="current-menu-item"><span>'.icl_disp_language($l['translated_name']).'</span></li>';
                    	}
                    }
                    echo '</ul>';
                }
            }
            	languages_list();
            }
            ?>
                
			<?php if (class_exists('woocommerce_wpml')) { ?>
				<?php do_action('currency_switcher', array('format' => '%code% (%symbol%)','switcher_style' => 'list')); ?>
			<?php } ?>
                
		</nav><!--.language-and-currency-->

	<?php }



	function eva_language_and_currency_topbar() { 

		?>

		<nav class="language_currency">
                
            <?php 
            if (function_exists('icl_get_languages')) {

            function languages_list_topbar(){
                $languages = icl_get_languages('skip_missing=N&link_empty_to=str');
                if(!empty($languages)){
                    echo '<ul class="languages">';
                    foreach($languages as $l){

                    	if (!$l['active']) {
                    		echo '<li><a href="'.$l['url'].'">'.icl_disp_language($l['translated_name']).'</a></li>';
                    	} else {
                    		echo '<li class="current-menu-item"><span>'.icl_disp_language($l['translated_name']).'</span></li>';
                    	}
                    }
                    echo '</ul>';
                }
            }
            	languages_list_topbar();
            }
            ?>
                
			<?php if (class_exists('woocommerce_wpml')) { ?>
				<?php do_action('currency_switcher', array('format' => '%code% (%symbol%)','switcher_style' => 'list')); ?>
			<?php } ?>
                
		</nav><!--.language-and-currency-->

	<?php }

/*-----------------------------------------------------------------------------------*/
/*	Read More Link
/*-----------------------------------------------------------------------------------*/

function eva_read_more_link() {
    return '<div class="morelink"><a class="more-link" href="' . get_permalink() . '">'. esc_html__( 'Continue reading &rarr;', 'eva' ). '</a></div>';
}
add_filter( 'the_content_more_link', 'eva_read_more_link' );

/*-----------------------------------------------------------------------------------*/
/*	Size Chart
/*-----------------------------------------------------------------------------------*/

function eva_size_chart() {
    global $tdl_options;
    if ( (isset($tdl_options['tdl_size_chart'])) && ($tdl_options['tdl_size_chart'] == "1" ) ) :
?>
    <div class="eva-size-chart">
    	<a href="#sizechart" class="eva-size-chart-link">
    		<i class="icon-px-solid-ruler"></i>
    		<span><?php esc_html_e($tdl_options['tdl_sizechart_title'], 'eva'); ?></span>
    	</a>
    </div><!--.eva-size-chart-->

<?php
    endif;
}

/*-----------------------------------------------------------------------------------*/
/*	Share
/*-----------------------------------------------------------------------------------*/

function eva_share() {
    global $post, $product, $tdl_options;
    if ( (isset($tdl_options['tdl_sharing_options'])) && ($tdl_options['tdl_sharing_options'] == "1" ) ) :
?>

    <div class="box-share-master-container" data-name="<?php esc_html_e( 'Share', 'eva' )?>" data-share-elem="<?php echo implode(',', $tdl_options['tdl_share_select']);?>">
		<a href="javascript:;" class="social-sharing" data-name="<?php echo get_the_title(); ?>">
			<i class="icon-px-solid-share"></i>
			<span><?php esc_html_e( 'Share', 'eva' )?></span>
		</a>
    </div><!--.box-share-master-container-->

<?php
    endif;
}


/******************************************************************************/
/****** Add Fresco to Galleries ***********************************************/
/******************************************************************************/

add_filter( 'wp_get_attachment_link', 'eva_sant_prettyadd', 10, 6);
function eva_sant_prettyadd ($content, $id, $size, $permalink, $icon, $text) {
    if ($permalink) {
    	return $content;    
    }
    $content = preg_replace("/<a/","<span class=\"fresco\" data-fresco-group=\"\"", $content, 1);
    return $content;
}


/*-----------------------------------------------------------------------------------*/
/*	BREADCRUMBS
/*-----------------------------------------------------------------------------------*/

	function eva_breadcrumbs() {
		$breadcrumb_output = "";
		
		if ( function_exists('bcn_display') ) {
			$breadcrumb_output .= '<div id="breadcrumbs">'. "\n";
			$breadcrumb_output .= bcn_display(true);
			$breadcrumb_output .= '</div>'. "\n";
		} else if ( function_exists('yoast_breadcrumb') ) {
			$breadcrumb_output .= '<div id="breadcrumbs">'. "\n";
			$breadcrumb_output .= yoast_breadcrumb("","",false);
			$breadcrumb_output .= '</div>'. "\n";			
		} else {
			if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			}
			$breadcrumb_output .= ''. "\n";
			// $breadcrumb_output .= '<div id="breadcrumbs">'. "\n";
			// $breadcrumb_output .= do_action('woocommerce_before_main_content_breadcrumb');
			// $breadcrumb_output .= '</div>'. "\n";
		}
		
		return $breadcrumb_output;
	}

// =============================================================================
// Ajax url
// =============================================================================

if ( ! function_exists('eva_ajax_url_fn') ) :
function eva_ajax_url_fn() {
?>
    <script type="text/javascript">
        var eva_ajax_url = '<?php echo admin_url('admin-ajax.php', 'relative'); ?>';
    </script>
<?php
}
add_action( 'wp_head','eva_ajax_url_fn' );
endif;


/*-----------------------------------------------------------------------------------*/
/*	Blog Navigation
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'eva_content_nav' ) ) :
function eva_content_nav( $nav_id ) {
	global $wp_query, $post, $tdl_options;
    
    $blog_with_sidebar = "";
    if ( (isset($tdl_options['tdl_single_blog_layout'])) && ($tdl_options['tdl_single_blog_layout'] == "1" ) ) $blog_with_sidebar = "yes";
    if (isset($_GET["blog_with_sidebar"])) $blog_with_sidebar = $_GET["blog_with_sidebar"];

	
	$blog_masonry = "";
	if ( (isset($tdl_options['tdl_blog_layout'])) && ($tdl_options['tdl_blog_layout'] == "2" ) ) :
		$blog_masonry = "yes";
	endif;
	
	
	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = ( is_single() ) ? 'post-navigation' : 'paging-navigation';

	?>
	<nav id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo esc_attr($nav_class); ?>">

        <div class="row">
        
			<?php if ( $blog_masonry == "yes" && !is_single() ) : ?>
            <div class="large-12 columns">
        	<?php elseif ( $blog_with_sidebar == "yes" ) : ?>
            <div class="large-12 columns">
        	<?php else : ?>
            <div class="large-8 large-centered columns without-sidebar">
        	<?php endif; ?>
        
				<?php if ( is_single() ) : // navigation links for single posts ?>
        
                    <div class="row">
                        
                        <div class="large-6 columns nav-left">
                            <?php previous_post_link( '<div class="nav-previous">%link', '<div class="nav-previous-title"><span>'.esc_html__( "Previous Reading", "eva" ).'</span></div>%title</div>' ); ?>
                        </div><!-- .columns -->
                        
                        <div class="large-6 columns nav-right">
                            <?php next_post_link( '<div class="nav-next">%link', '<div class="nav-next-title"><span>'.esc_html__( "Next Reading", "eva" ).'</span></div> %title</div>' ); ?>
                        </div><!-- .columns -->
                        
                    </div><!-- .row -->
            
				<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>
            
					<div class="archive-navigation">
						<div class="row">
							
							<div class="small-6 columns text-left">
								<?php if ( get_next_posts_link() ) : ?>
								<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'eva' ) ); ?></div>
								<?php endif; ?>
							</div>
							
							<div class="small-6 columns text-right">
								<?php if ( get_previous_posts_link() ) : ?>
								<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'eva' ) ); ?></div>
							<?php endif; ?>
							</div>
						
						</div>
					</div>
				
                <?php endif; ?>
            
            </div><!-- .columns -->
        
        </div><!-- .row -->

	</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
	<?php
}
endif; // eva_content_nav

/*-----------------------------------------------------------------------------------*/
/*	Post Meta Date
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'eva_post_header_date' ) ) :
function eva_post_header_date( $echo = true ) {
	if ( has_post_format( array( 'chat', 'status' ) ) )
		$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'eva' );
	else
		$format_prefix = '%2$s';

	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'eva' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);

	if ( $echo )
		echo wp_kses_post($date);

	return $date;
}
endif;

/*-----------------------------------------------------------------------------------*/
/*	Post Meta
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'eva_post_entry_meta' ) ) :
function eva_post_entry_meta($echo = true) {

	if ( has_post_format( array( 'chat', 'status' ) ) )
		$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'eva' );
	else
		$format_prefix = '%2$s';

	$date = sprintf( '<span class="post_date">'. __( ' on ', 'eva' ) . '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'eva' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);

	if ( $echo )
		echo wp_kses_post($date);

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( ', ' );
	if ( $categories_list ) {
		echo '<span class="post_categories">'. esc_html__( ' in ', 'eva' ) . $categories_list . '</span>';
	}

	eva_share();

}
endif;



/*-----------------------------------------------------------------------------------*/
/*	Blog Meta
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'eva_entry_meta' ) ) :
function eva_entry_meta() {
	
	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<span class="featured-post">' . esc_html__( 'Sticky', 'eva' ) . '</span>';

	// Post author
	if ( 'post' == get_post_type() ) {
		printf( esc_html__( ' This entry was posted by ', 'eva' ) . '<a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( esc_html__( 'View all posts by %s', 'eva' ), get_the_author() ) ),
			get_the_author()
		);
	}
	
	/*if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
		eva_post_header_entry();*/

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( ', ' );
	if ( $categories_list ) {
		echo esc_html__( ' in ', 'eva' ) . $categories_list . '';
	}

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		echo esc_html__( ' and tagged ', 'eva' ) . $tag_list . '';
	}
}
endif;

/*-----------------------------------------------------------------------------------*/
/*	Blog Comments
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'eva_comment' ) ) :
function eva_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php esc_html_e( 'Pingback:', 'eva' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( 'Edit', 'eva' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">

			<div class="comment-content">
				
				<div class="comment-author-avatar">
					<?php echo get_avatar( $comment, 140 ); ?>
				</div><!-- .comment-author-avatar -->
				
				<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'eva' ); ?></p>
				<?php endif; ?>
				
				<?php printf( esc_html__( '%s', 'eva' ), sprintf( '<h3 class="comment-author">%s</h3>', get_comment_author_link() ) ); ?>
                
                <div class="comment-metadata">
                    <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                        <time datetime="<?php comment_time( 'c' ); ?>">
                            <?php printf( esc_html__( '%1$s at %2$s', 'eva' ), get_comment_date(), get_comment_time() ); ?>
                        </time>
                    </a>
                </div><!-- .comment-metadata -->

				<div class="comment-text"><?php comment_text(); ?></div><!-- .comment-text -->
                
                <?php
					comment_reply_link( array_merge( $args, array(
						'add_below' => 'div-comment',
						'depth'     => $depth,
						'max_depth' => $args['max_depth'],
						'before'    => '<span class="comment-reply"><i class="fa fa-reply"></i>',
						'after'     => '</span>',
					) ) );
				?>
				
				<?php edit_comment_link( esc_html__( 'Edit', 'eva' ), '<span class="comment-edit-link"><i class="fa fa-pencil-square-o"></i>', '</span>' ); ?>
                
			</div><!-- .comment-content -->
            
		</article><!-- .comment-body -->

	<?php
	endif;
}
endif; // ends check for eva_comment()

/*-----------------------------------------------------------------------------------*/
/*	Blog Gallery
/*-----------------------------------------------------------------------------------*/


if ( ! is_admin() ) {

function eva_grab_ids_from_gallery() {
			
	global $post;
    
    if ( !isset($post) ) return;
    
	$attachment_ids = array();
	$pattern = get_shortcode_regex();
	$ids = array();
	
	if (preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches ) ) {   //finds the "gallery" shortcode and puts the image ids in an associative array at $matches[3]
		//$count = count($matches[3]); //in case there is more than one gallery in the post.
		$count = 1;
		for ($i = 0; $i < $count; $i++){
			$atts = shortcode_parse_atts( $matches[3][$i] );
			if ( isset( $atts['ids'] ) ){
				$attachment_ids = explode( ',', $atts['ids'] );
				$ids = array_merge($ids, $attachment_ids);
			}
		}
	}
	
	return $ids;
	
}
add_action( 'wp', 'eva_grab_ids_from_gallery' );

}

// =============================================================================
// Social Icons
// =============================================================================

if ( ! function_exists( 'eva_socials' ) ) :

	function eva_socials() {
	global $tdl_options;
?>

<ul class="social-icons">
	<?php if ( (isset($tdl_options['twitter_link'])) && (trim($tdl_options['twitter_link']) != "" ) ) { ?><li class="twitter"><a target="_blank" title="Twitter" href="<?php echo esc_url($tdl_options['twitter_link']); ?>"></a></li><?php } ?>
	<?php if ( (isset($tdl_options['facebook_link'])) && (trim($tdl_options['facebook_link']) != "" ) ) { ?><li class="facebook"><a target="_blank" title="Facebook" href="<?php echo esc_url($tdl_options['facebook_link']); ?>"></a></li><?php } ?>
	<?php if ( (isset($tdl_options['googleplus_link'])) && (trim($tdl_options['googleplus_link']) != "" ) ) { ?><li class="googleplus"><a target="_blank" title="Google Plus" href="<?php echo esc_url($tdl_options['googleplus_link']); ?>"></a></li><?php } ?>
  	<?php if ( (isset($tdl_options['pinterest_link'])) && (trim($tdl_options['pinterest_link']) != "" ) ) { ?><li class="pinterest"><a target="_blank" title="Pinterest" href="<?php echo esc_url($tdl_options['pinterest_link']); ?>"></a></li><?php } ?>
  	<?php if ( (isset($tdl_options['vimeo_link'])) && (trim($tdl_options['vimeo_link']) != "" ) ) { ?><li class="vimeo"><a target="_blank" title="Vimeo" href="<?php echo esc_url($tdl_options['vimeo_link']); ?>"></a></li><?php } ?>
  	<?php if ( (isset($tdl_options['youtube_link'])) && (trim($tdl_options['youtube_link']) != "" ) ) { ?><li class="youtube"><a target="_blank" title="YouTube" href="<?php echo esc_url($tdl_options['youtube_link']); ?>"></a></li><?php } ?>
  	<?php if ( (isset($tdl_options['flickr_link'])) && (trim($tdl_options['flickr_link']) != "" ) ) { ?><li class="flickr"><a target="_blank" title="Flickr" href="<?php echo esc_url($tdl_options['flickr_link']); ?>"></a></li><?php } ?>
  	<?php if ( (isset($tdl_options['skype_link'])) && (trim($tdl_options['skype_link']) != "" ) ) { ?><li class="skype"><a target="_blank" title="Skype" href="<?php echo esc_url($tdl_options['skype_link']); ?>"></a></li><?php } ?>
  	<?php if ( (isset($tdl_options['behance_link'])) && (trim($tdl_options['behance_link']) != "" ) ) { ?><li class="behance"><a target="_blank" title="Behance" href="<?php echo esc_url($tdl_options['behance_link']); ?>"></a></li><?php } ?>
  	<?php if ( (isset($tdl_options['dribbble_link'])) && (trim($tdl_options['dribbble_link']) != "" ) ) { ?><li class="dribbble"><a target="_blank" title="Dribbble" href="<?php echo esc_url($tdl_options['dribbble_link']); ?>"></a></li><?php } ?>
  	<?php if ( (isset($tdl_options['tumblr_link'])) && (trim($tdl_options['tumblr_link']) != "" ) ) { ?><li class="tumblr"><a target="_blank" title="Tumblr" href="<?php echo esc_url($tdl_options['tumblr_link']); ?>"></a></li><?php } ?>
  	<?php if ( (isset($tdl_options['linkedin_link'])) && (trim($tdl_options['linkedin_link']) != "" ) ) { ?><li class="linkedin"><a target="_blank" title="Linkedin" href="<?php echo esc_url($tdl_options['linkedin_link']); ?>"></a></li><?php } ?>
  	<?php if ( (isset($tdl_options['github_link'])) && (trim($tdl_options['github_link']) != "" ) ) { ?><li class="github"><a target="_blank" title="Github" href="<?php echo esc_url($tdl_options['github_link']); ?>"></a></li><?php } ?>
  	<?php if ( (isset($tdl_options['vine_link'])) && (trim($tdl_options['vine_link']) != "" ) ) { ?><li class="vine"><a target="_blank" title="Vine" href="<?php echo esc_url($tdl_options['vine_link']); ?>"></a></li><?php } ?>
	<?php if ( (isset($tdl_options['instagram_link'])) && (trim($tdl_options['instagram_link']) != "" ) ) { ?><li class="instagram"><a target="_blank" title="Instagram" href="<?php echo esc_url($tdl_options['instagram_link']); ?>"></a></li><?php } ?>
	<?php if ( (isset($tdl_options['dropbox_link'])) && (trim($tdl_options['dropbox_link']) != "" ) ) { ?><li class="dropbox"><a target="_blank" title="Dropbox" href="<?php echo esc_url($tdl_options['dropbox_link']); ?>"></a></li><?php } ?>
	<?php if ( (isset($tdl_options['rss_link'])) && (trim($tdl_options['rss_link']) != "" ) ) { ?><li class="rss"><a target="_blank" title="RSS" href="<?php echo esc_url($tdl_options['rss_link']); ?>"></a></li><?php } ?>
	<?php if ( (isset($tdl_options['stumbleupon_link'])) && (trim($tdl_options['stumbleupon_link']) != "" ) ) { ?><li class="stumbleupon"><a target="_blank" title="Stumbleupon" href="<?php echo esc_url($tdl_options['stumbleupon_link']); ?>"></a></li><?php } ?>
	<?php if ( (isset($tdl_options['paypal_link'])) && (trim($tdl_options['paypal_link']) != "" ) ) { ?><li class="paypal"><a target="_blank" title="Paypal" href="<?php echo esc_url($tdl_options['paypal_link']); ?>"></a></li><?php } ?>
	<?php if ( (isset($tdl_options['foursquare_link'])) && (trim($tdl_options['foursquare_link']) != "" ) ) { ?><li class="foursquare"><a target="_blank" title="Foursquare" href="<?php echo esc_url($tdl_options['foursquare_link']); ?>"></a></li><?php } ?>
	<?php if ( (isset($tdl_options['soundcloud_link'])) && (trim($tdl_options['soundcloud_link']) != "" ) ) { ?><li class="soundcloud"><a target="_blank" title="Soundcloud" href="<?php echo esc_url($tdl_options['soundcloud_link']); ?>"></a></li><?php } ?>
	<?php if ( (isset($tdl_options['spotify_link'])) && (trim($tdl_options['spotify_link']) != "" ) ) { ?><li class="spotify"><a target="_blank" title="Spotify" href="<?php echo esc_url($tdl_options['spotify_link']); ?>"></a></li><?php } ?>
	<?php if ( (isset($tdl_options['vk_link'])) && (trim($tdl_options['vk_link']) != "" ) ) { ?><li class="vk"><a target="_blank" title="VKontakte" href="<?php echo esc_url($tdl_options['vk_link']); ?>"></a></li><?php } ?>
	<?php if ( (isset($tdl_options['android_link'])) && (trim($tdl_options['android_link']) != "" ) ) { ?><li class="android"><a target="_blank" title="Android" href="<?php echo esc_url($tdl_options['android_link']); ?>"></a></li><?php } ?>
	<?php if ( (isset($tdl_options['apple_link'])) && (trim($tdl_options['apple_link']) != "" ) ) { ?><li class="apple"><a target="_blank" title="Apple" href="<?php echo esc_url($tdl_options['apple_link']); ?>"></a></li><?php } ?>
	<?php if ( (isset($tdl_options['windows_link'])) && (trim($tdl_options['windows_link']) != "" ) ) { ?><li class="windows"><a target="_blank" title="Windows" href="<?php echo esc_url($tdl_options['windows_link']); ?>"></a></li><?php } ?>                                 
</ul>

<?php
	}
endif;

// =============================================================================
// Instagram feed
// =============================================================================

if ( ! function_exists( 'eva_footer_instagram' ) ) :
	/**
	 * Prints HTML for footer Instagram feeds block.
	 */
	function eva_footer_instagram() {
		global $tdl_options;

$instagram_feed = (!empty($tdl_options['tdl_instagram_feed'])) ? $tdl_options['tdl_instagram_feed'] : '2';
$instagram_name = (!empty($tdl_options['tdl_instagram_name'])) ? $tdl_options['tdl_instagram_name'] : '';	
$instagram_link = (!empty($tdl_options['tdl_instagram_link'])) ? $tdl_options['tdl_instagram_link'] : '';	
$instagram_text = (!empty($tdl_options['tdl_instagram_text'])) ? $tdl_options['tdl_instagram_text'] : 'Follow Our Instagram';			

		if ( class_exists( 'null_instagram_widget' ) && $instagram_feed == '1' && '' !== $instagram_name ) {
			the_widget(
				'null_instagram_widget',
				array(
					'username' => $instagram_name,
					'number' => 8,
					'size' => 'small',
					'target' => $instagram_link,
					'link' => $instagram_text,
				),
				array(
					'before_widget' => '<div id="footer-instagram" class="footer-instagram-section">',
					'after_widget'  => '</div>',
					'before_title'  => '<h3 class="instagram-title">',
					'after_title'   => '</h3>',
				)
			);
		}
	}
endif;

/************************************************************************
* Extended Example:
* Way to set menu, import revolution slider, and set home page.
*************************************************************************/
if ( !function_exists( 'wbc_extended_example' ) ) {
	function wbc_extended_example( $demo_active_import , $demo_directory_path ) {
		reset( $demo_active_import );
		$current_key = key( $demo_active_import );	

		/************************************************************************
		* Import slider(s) for the current demo being imported
		*************************************************************************/
		if ( class_exists( 'RevSlider' ) ) {
			//If it's demo3 or demo5
			$wbc_sliders_array = array(
				'fashion' => 'homepage-slider.zip'
			);
			if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_sliders_array ) ) {
				$wbc_slider_import = $wbc_sliders_array[$demo_active_import[$current_key]['directory']];
				if ( file_exists( $demo_directory_path.$wbc_slider_import ) ) {
					$slider = new RevSlider();
					$slider->importSliderFromPost( true, true, $demo_directory_path.$wbc_slider_import );
				}
			}
		}

		//Import Sliders
		if ( class_exists( 'RevSlider' ) ) {
		    $wbc_sliders_array = array(
		        'fashion' => array('homepage-slider.zip','homepage-slider-2.zip')
		    );

		    if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_sliders_array ) ) {
		        $wbc_slider_import = $wbc_sliders_array[$demo_active_import[$current_key]['directory']];

		        if( is_array( $wbc_slider_import ) ){
		            foreach ($wbc_slider_import as $slider_zip) {
		                if ( !empty($slider_zip) && file_exists( $demo_directory_path.$slider_zip ) ) {
		                    $slider = new RevSlider();
		                    $slider->importSliderFromPost( true, true, $demo_directory_path.$slider_zip );
		                }
		            }
		        }else{
		            if ( file_exists( $demo_directory_path.$wbc_slider_import ) ) {
		                $slider = new RevSlider();
		                $slider->importSliderFromPost( true, true, $demo_directory_path.$wbc_slider_import );
		            }
		        }
		    }
		}
		
		/************************************************************************
		* Setting Menus
		*************************************************************************/

		// If it's demo1 - demo6
		$wbc_menu_array = array( 'fashion' );
		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
			$primary = get_term_by( 'name', 'Main Navigation', 'nav_menu' );
			if ( isset( $primary->term_id ) ) {
				set_theme_mod( 'nav_menu_locations', array(
						'main_navigation' => $primary->term_id
					)
				);
			}
		}

		/************************************************************************
		* Set HomePage
		*************************************************************************/
		// array of demos/homepages to check/select from
		$wbc_home_pages = array(
			'fashion' => 'Homepage'
		);
            if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_home_pages ) ) {
                $page = get_page_by_title( $wbc_home_pages[$demo_active_import[$current_key]['directory']] );
                if ( isset( $page->ID ) ) {
                    update_option( 'page_on_front', $page->ID );
                    update_option( 'show_on_front', 'page' );
                }
            }
	}
	// Uncomment the below
	add_action( 'wbc_importer_after_content_import', 'wbc_extended_example', 10, 2 );
}

?>