<?php 
 
define('EVA_OPTIONS_NAME', 'eva_options_theme_customizer');
define('EVA_THEME_PATH', get_template_directory());
define('EVA_CSS', get_template_directory() . '/css');
define('EVA_INCLUDES', get_template_directory() . '/includes');
define('EVA_FUNCTIONS', get_template_directory() . '/functions');
define('EVA_THEME_URI', get_template_directory_uri());
define('EVA_THEME_ENABLED', true);

include_once( EVA_FUNCTIONS . '/body-classes.php' ); // Theme Options
include_once( EVA_FUNCTIONS . '/theme-options.php' ); // Theme Options
include_once( EVA_FUNCTIONS . '/woo-options.php' ); // WooCommerce Options
include_once( EVA_INCLUDES . '/quick_view.php'); //Quick View
// include_once( EVA_INCLUDES . '/widgets.php'); // Widgets



#-----------------------------------------------------------------#
# Plugin recommendations
#-----------------------------------------------------------------#

require_once( EVA_FUNCTIONS . '/tgm/class-tgm-plugin-activation.php' );
require_once( EVA_FUNCTIONS . '/tgm/plugins.php' );


#-----------------------------------------------------------------#
# Custom Menu
#-----------------------------------------------------------------#
include_once( EVA_INCLUDES . '/menu/custom-menu.php'); //Quick View



#-----------------------------------------------------------------#
# Redux Framework
#-----------------------------------------------------------------#

if ( !isset( $redux_demo ) && file_exists( EVA_FUNCTIONS . '/framework/settings.php' ) ) {
    require_once( EVA_FUNCTIONS . '/framework/settings.php' );
}

/*-----------------------------------------------------------------------------------*/
/*	Add Font Awesome to Redux
/*-----------------------------------------------------------------------------------*/

function eva_reduxAwesome() {

    wp_register_style(
        'redux-font-awesome',
        get_template_directory_uri() . '/fonts/fontawesome/font-awesome.min.css',
        array(),
        time(),
        'all'
    );  
    wp_enqueue_style( 'redux-font-awesome' );
}
add_action( 'redux/page/tdl_options/enqueue', 'eva_reduxAwesome' );


/*-----------------------------------------------------------------------------------*/
/*	Register Global Var
/*-----------------------------------------------------------------------------------*/

function eva_global_var(){
   global $tdl_options;
   return $tdl_options;
}


/* ---------------------------------------------------------------- */
/* ACF theme fields
/* ---------------------------------------------------------------- */
require_once EVA_THEME_PATH . '/autoimport/custom_metaboxes.php';


/* ---------------------------------------------------------------- */
/* Add ACF fallback
/* ---------------------------------------------------------------- */
if (! is_admin() && ! function_exists('get_field')) {
	function get_field($name) {
		return false;
	}
}


/* ---------------------------------------------------------------- */
/* 	Register Navigation
/* ---------------------------------------------------------------- */

register_nav_menus( array(
	'main_navigation' 		=> esc_html__('Main Navigation', 'eva'),
));

/*-----------------------------------------------------------------------------------*/
/*	Sidebars
/*-----------------------------------------------------------------------------------*/

if( ! function_exists( 'eva_widgets_init' ) ):
	function eva_widgets_init() {

		register_sidebar(array(
			'name' => esc_html__('Sidebar', 'eva'),
			'id' => 'sidebar',
			'before_widget' => '<aside class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		));
		
		register_sidebar(array(
			'name' => esc_html__('Shop Sidebar', 'eva'),
			'id' => 'widgets-product-listing',
			'before_widget' => '<aside class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		));	
		
		register_sidebar(array(
			'name' => esc_html__('Footer 1', 'eva'),
			'id' => 'footer-sidebar-1',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		));
		
		register_sidebar(array(
			'name' => esc_html__('Footer 2', 'eva'),
			'id' => 'footer-sidebar-2',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		));
		
		register_sidebar(array(
			'name' => esc_html__('Footer 3', 'eva'),			
			'id' => 'footer-sidebar-3',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		));
		
		register_sidebar(array(
			'name' => esc_html__('Footer 4', 'eva'),			
			'id' => 'footer-sidebar-4',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		));

		register_sidebar(array(
			'name' => esc_html__('Footer 5', 'eva'),			
			'id' => 'footer-sidebar-5',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		));

}
endif;
add_action( 'widgets_init', 'eva_widgets_init' );


/*-----------------------------------------------------------------------------------*/
/*	Theme Support
/*-----------------------------------------------------------------------------------*/

	if ( ! function_exists( 'eva_theme_support' ) ) {
		function eva_theme_support() {
			global $tdl_options;
			
			// Let WordPress manage the document title (no hard-coded <title> tag in the document head)
			add_theme_support( 'title-tag' );

			// Add menu support
			add_theme_support( 'menus' );
			
			// Enables post and comment RSS feed links to head
			add_theme_support( 'automatic-feed-links' );
			
			// Add WooCommerce support
			add_theme_support( 'woocommerce' );
			
			// Add thumbnail theme support
			add_theme_support( 'post-thumbnails' );

			// Add Post Formats
			add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'quote', 'video' ) );
            	

			/** Add Image Sizes **/
			$shop_catalog_image_size = get_option( 'shop_catalog_image_size' );
			$shop_single_image_size = get_option( 'shop_single_image_size' );
			add_image_size('product_small_thumbnail', (int)$shop_catalog_image_size['width']/3, (int)$shop_catalog_image_size['height']/3, isset($shop_catalog_image_size['crop']) ? true : false); // made from shop_catalog_image_size
			add_image_size('shop_single_small_thumbnail', (int)$shop_single_image_size['width']/3, (int)$shop_single_image_size['height']/3, isset($shop_catalog_image_size['crop']) ? true : false); // made from shop_single_image_size
			add_image_size( 'blog-isotope', 620, 500, true ); 					
            
			// Localisation support
			load_theme_textdomain( 'eva', get_template_directory() . '/languages' );

			if ( (isset($tdl_options['tdl_shop_pagination'])) && ($tdl_options['tdl_shop_pagination'] != "classic") ) {
				// WooCommerce Number of products displayed per page
				add_filter( 'loop_shop_per_page', create_function( '$cols', 'return ' . $tdl_options['tdl_products_per_page'] . ';' ), 20 );
			}

			/******************************************************************************/
			/* WooCommerce remove review tab **********************************************/
			/******************************************************************************/
			if ( (isset($tdl_options['tdl_review_tab'])) && ($tdl_options['tdl_review_tab'] == "0" ) ) {
			add_filter( 'woocommerce_product_tabs', 'eva_remove_reviews_tab', 98);
				function eva_remove_reviews_tab($tabs) {
					unset($tabs['reviews']);
					return $tabs;
				}
			}			

		}
	}
	add_action( 'after_setup_theme', 'eva_theme_support' );


/******************************************************************************/
/****** Set woocommerce images sizes ******************************************/
/******************************************************************************/

/**
 * Hook in on activation
 */
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action( 'init', 'eva_woocommerce_image_dimensions', 1 );

/**
 * Define image sizes
 */

if ( ! function_exists('eva_woocommerce_image_dimensions') ) :
	function eva_woocommerce_image_dimensions() {
		global $pagenow;
	 
		if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
			return;
		}

	  	$catalog = array(
			'width' 	=> '300',	// px
			'height'	=> '372',	// px
			'crop'		=> 1 		// true
		);

		$single = array(
			'width' 	=> '564',	// px
			'height'	=> '720',	// px
			'crop'		=> 1 		// true
		);

		$thumbnail = array(
			'width' 	=> '150',	// px
			'height'	=> '200',	// px
			'crop'		=> 0 		// false
		);

		// Image sizes
		update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
		update_option( 'shop_single_image_size', $single ); 		// Single product image
		update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
	}
	add_action( 'after_switch_theme', 'eva_woocommerce_image_dimensions', 1 );
endif;

	
// Maximum width for media
if ( ! isset( $content_width ) ) {
	$content_width = 1200; // Pixels
}


/*-----------------------------------------------------------------------------------*/
/*	Registers and loads styles
/*-----------------------------------------------------------------------------------*/


if ( ! function_exists('eva_theme_styles') ) :

	function eva_theme_styles () {
		if (!is_admin()) {
			global $tdl_options, $wp_styles;

			$theme_info = wp_get_theme();

			// Edit CSS within their files
			wp_register_style( 'stylesheet', get_stylesheet_uri(), array(), '1.0', 'all' );
			wp_register_style( 'eva-app', get_template_directory_uri() .  "/css/app.css", array(), '1.0', null);
			wp_enqueue_style('animate', get_template_directory_uri() . '/css/animate.css', array(), '3.5.1', 'all' );
			wp_enqueue_style('fresco', get_template_directory_uri() . '/css/fresco/fresco.css', NULL, '1.3.0', 'all' );


			wp_enqueue_style('eva-font-linea-arrows', get_template_directory_uri() . '/fonts/linea-fonts/arrows/styles.css', NULL, eva_theme_version(), 'all' );
			wp_enqueue_style('eva-font-linea-basic', get_template_directory_uri() . '/fonts/linea-fonts/basic/styles.css', NULL, eva_theme_version(), 'all' );
			wp_enqueue_style('eva-font-linea-basic_elaboration', get_template_directory_uri() . '/fonts/linea-fonts/basic_elaboration/styles.css', NULL, eva_theme_version(), 'all' );
			wp_enqueue_style('eva-font-linea-ecommerce', get_template_directory_uri() . '/fonts/linea-fonts/ecommerce/styles.css', NULL, eva_theme_version(), 'all' );
			wp_enqueue_style('eva-font-linea-music', get_template_directory_uri() . '/fonts/linea-fonts/music/styles.css', NULL, eva_theme_version(), 'all' );
			wp_enqueue_style('eva-font-linea-software', get_template_directory_uri() . '/fonts/linea-fonts/software/styles.css', NULL, eva_theme_version(), 'all' );
			wp_enqueue_style('eva-font-linea-weather', get_template_directory_uri() . '/fonts/linea-fonts/weather/styles.css', NULL, eva_theme_version(), 'all' );

			wp_enqueue_style('eva-app');
			wp_enqueue_style('stylesheet' );

			ob_start(); 
			include( EVA_CSS . '/custom.php' ); 
			$style_custom = ob_get_clean();
			$style_custom = str_replace(array("\r\n", "\r"), "\n", $style_custom);
			$lines = explode("\n", $style_custom);
			$new_lines = array();
			foreach ($lines as $i => $line) { if(!empty($line)) $new_lines[] = trim($line); }

			wp_add_inline_style( 'eva-app', implode($new_lines) );

			if ( (isset($tdl_options['tdl_custom_css'])) && (trim($tdl_options['tdl_custom_css']) != "" ) ) {
				wp_add_inline_style( 'eva-app', html_entity_decode( $tdl_options['tdl_custom_css'] ) );
			}						

		}
	}
	add_action('wp_enqueue_scripts', 'eva_theme_styles' );

endif;

/*-----------------------------------------------------------------------------------*/
/*	Registers and loads front-end javascript
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists('eva_register_js') ) :

	function eva_register_js() {

	// Get theme version info

	global $tdl_options;

	if ( EVA_VISUAL_COMPOSER_IS_ACTIVE) // If VC exists/active load scripts after VC
	{
		$dependencies = array('jquery', 'wpb_composer_front_js');
	}
	else // Do not depend on VC
	{
		$dependencies = array('jquery');
	}
	wp_enqueue_script('eva-scripts', get_template_directory_uri() . '/js/min/eva-plugins.js', $dependencies, eva_theme_version(), TRUE);		
	wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/modernizr.js', array('jquery'), '2.8.3', TRUE);
	wp_enqueue_script('eva-custom-scripts', get_template_directory_uri() . '/js/min/app.js', array('jquery'), '1.0', TRUE);	

	if ( (isset($tdl_options['tdl_sticky_menu'])) && (trim($tdl_options['tdl_sticky_menu']) == "1" ) ) {	
		wp_enqueue_script('eva-sticky-header', get_template_directory_uri() . '/js/components/sticky-header.js', array('jquery'), '1.0', TRUE);
	}
		

	// Send variables to js
	$eva_scripts_vars_array = array(
		
		'ajax_load_more_locale' 	=> esc_html__( 'Load More Items', 'eva' ),
		'ajax_loading_locale' 		=> esc_html__( 'Loading Items', 'eva' ),
		'ajax_no_more_items_locale' => esc_html__( 'No more items available.', 'eva' ),

		'shop_pagination_type' 		=> (!empty($tdl_options['tdl_shop_pagination'])) ? $tdl_options['tdl_shop_pagination'] : 'classic',		
		'mapApiKey' => (!empty($tdl_options['tdl_google_map_api_key'])) ? $tdl_options['tdl_google_map_api_key'] : ''

	);
	
	wp_localize_script( 'eva-scripts', 'eva_scripts_vars', $eva_scripts_vars_array );


	if (is_singular() && comments_open() && get_option( 'thread_comments')) {
		wp_enqueue_script('comment-reply');
	}


	}

	add_action('wp_enqueue_scripts', 'eva_register_js');

endif;

function eva_admin_styles( $hook ) {

	if ( is_admin() ) {

    	wp_enqueue_style("eva-admin-styles", get_template_directory_uri() . "/css/wp-admin-custom.css", false, "1.0", "all");

			if (class_exists('WPBakeryVisualComposerAbstract')) { 
				wp_enqueue_style('eva-visual-composer', get_template_directory_uri() .'/css/visual-composer.css', false, "1.0", 'all');
				wp_enqueue_style('eva-font-linea-arrows', get_template_directory_uri() . '/fonts/linea-fonts/arrows/styles.css', false, eva_theme_version(), 'all' );
				wp_enqueue_style('eva-font-linea-basic', get_template_directory_uri() . '/fonts/linea-fonts/basic/styles.css', false, eva_theme_version(), 'all' );
				wp_enqueue_style('eva-font-linea-basic_elaboration', get_template_directory_uri() . '/fonts/linea-fonts/basic_elaboration/styles.css', false, eva_theme_version(), 'all' );
				wp_enqueue_style('eva-font-linea-ecommerce', get_template_directory_uri() . '/fonts/linea-fonts/ecommerce/styles.css', false, eva_theme_version(), 'all' );
				wp_enqueue_style('eva-font-linea-music', get_template_directory_uri() . '/fonts/linea-fonts/music/styles.css', false, eva_theme_version(), 'all' );
				wp_enqueue_style('eva-font-linea-software', get_template_directory_uri() . '/fonts/linea-fonts/software/styles.css', false, eva_theme_version(), 'all' );
				wp_enqueue_style('eva-font-linea-weather', get_template_directory_uri() . '/fonts/linea-fonts/weather/styles.css', false, eva_theme_version(), 'all' );				
			}
    	}
}
add_action('admin_enqueue_scripts', 'eva_admin_styles');





/**
 * Agregar un nuevo campo en el formulario de Checkout de WooCommerce
 * el campo es el número de teléfono y también se muestra en el panel de administración
 * 
 */

function custom_override_checkout_fields( $fields ) {
	$fields['billing']['billing_phone_new'] = array(
		'label'     => __('Phone Number', 'woocommerce'),
		'placeholder'  => _x('Phone Number', 'placeholder', 'woocommerce'),
		'required'  => true,
		'class'     => array('form-row-wide'),
		'clear'     => true
	);

	return $fields;
}
add_filter('woocommerce_checkout_fields','custom_override_checkout_fields');


/**
 * Process the checkout
 */
add_action('woocommerce_checkout_process', 'my_custom_checkout_field_process');

function my_custom_checkout_field_process() {
    // Check if set, if its not set add an error.
    if ( ! $_POST['billing_phone_new'] )
        wc_add_notice( __( '<strong>Phone Number</strong> is a required field' ), 'error' );
}


/**
 * Update the order meta with field value
 */
add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );

function my_custom_checkout_field_update_order_meta( $order_id ) {
    if ( ! empty( $_POST['billing_phone_new'] ) ) {
        update_post_meta( $order_id, 'billing_phone_new', sanitize_text_field( $_POST['billing_phone_new'] ) );
    }
}


/**
 * Display field value on the order edit page
 */
add_action( 'woocommerce_admin_order_data_after_billing_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );

function my_custom_checkout_field_display_admin_order_meta($order){
    echo '<p><strong>'.__('Phone Number').':</strong> <br/>' . get_post_meta( $order->get_id(), 'billing_phone_new', true ) . '</p>';
}

