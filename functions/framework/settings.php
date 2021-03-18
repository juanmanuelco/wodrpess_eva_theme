<?php if ( ! defined('EVA_THEME_PATH')) exit('No direct script access allowed');

/**
 * ------------------------------------------------------------------------------------------------
 * Init Theme Settings and Options with Redux plugin
 * ------------------------------------------------------------------------------------------------
 */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    $opt_name = "tdl_options";


    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        'opt_name'             => $opt_name,
        'display_name'         => $theme->get( 'Name' ),
        'display_version'      => $theme->get( 'Version' ),
        'menu_type'            => 'menu',
        'allow_sub_menu'       => true,
        'menu_title'           => __( 'Theme Settings', 'eva' ),
        'page_title'           => __( 'Theme Settings', 'eva' ),
        'google_api_key'       => '',
        'google_update_weekly' => false,
        'async_typography'     => false,
        'admin_bar'            => true,
        'admin_bar_icon'       => 'dashicons-portfolio',
        'admin_bar_priority'   => 50,
        'global_variable'      => '',
        'dev_mode'             => false,
        'update_notice'        => true,
        'customizer'           => true,
        'page_priority'        => 3,
        'page_parent'          => 'themes.php',
        'page_permissions'     => 'manage_options',
        // 'menu_icon'            => EVA_THEME_PATH . '/images/theme-options/theme-admin-icon.png', 
        'menu_icon'            => '', 
        'last_tab'             => '',
        'page_icon'            => 'icon-themes',
        'page_slug'            => '_options',
        'save_defaults'        => true,
        'default_show'         => false,
        'default_mark'         => '',
        'show_import_export'   => true,
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        'output_tag'           => true,
        'footer_credit'     =>  '1.0',                  
        'database'             => '',
        'system_info'          => false,
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'light',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    Redux::setArgs( $opt_name, $args );


/* ---------------------------------------------------------------- */
/* General Settings
/* ---------------------------------------------------------------- */

    Redux::setSection( $opt_name, array(
                'title'     => esc_html__('General Settings', 'eva'),
                'icon'      => 'fa fa-cogs',
                 'fields'    => array(
 
                array(
                    'id' => 'tdl_maincontent_width',
                    'type' => 'slider',
                    'title' => esc_html__('Main Content Max Width', 'eva'),
                    'subtitle' => esc_html__('This example displays float values', 'eva'),
                    'desc' => esc_html__('Min: 1170, max: 1440, step: 1, default value: 1440', 'eva'),
                    "default" => 1440,
                    "min" => 940,
                    "step" => 1,
                    "max" => 1440,
                    'resolution' => 1,
                    'display_value' => 'text'
                ),

                 array(
                    'title' => esc_html__('Off-canvas Social Media Icons', 'eva'),
                     'subtitle' => esc_html__('Show social icons in Off-canvas navigation menu', 'eva'),
                    'id' => 'tdl_offcanvas_social',
                    'on' => esc_html__('Enabled', 'eva'),
                    'off' => esc_html__('Disabled', 'eva'),
                    'type' => 'switch',
                    'default' => 1,
                ),  

                array(
                    'id'       => 'tdl_google_map_api_key',
                    'type'     => 'text',
                    'title'    => esc_html__('Google map API key', 'eva'), 
                    'subtitle' => __('Obrain API key <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">here</a> to use our Google Map VC element.', 'eva')
                ),                                                                   
        )
    ) ); 

/* ---------------------------------------------------------------- */
/* Header Settings
/* ---------------------------------------------------------------- */


    Redux::setSection( $opt_name, array(
            'title' => esc_html__('Header Settings', 'eva' ),
            'icon'  => 'fa fa-chevron-up',
            'fields'    => array(

                array(
                    'id' => 'tdl_header_info',
                    'type' => 'info',
                    'raw' => esc_html__('Header Settings', 'eva'),
                ),                

                 array(
                    'id' => 'tdl_header_padding',
                    'type' => 'slider',
                    'title' => esc_html__('Header Paddings (Top/Bottom)', 'eva'),
                    'desc' => esc_html__('Enter Top/Bottom padding (pixels)', 'eva'),
                    "default" => 30,
                    "min" => 0,
                    "step" => 1,
                    "max" => 200,
                    'display_value' => 'text',
                ),

                array(
                    'id'       => 'tdl_header_layout',
                    'type'     => 'image_select',
                    'compiler' => true,
                    'title'    => esc_html__( 'Header Layout', 'eva' ),
                    'subtitle' => esc_html__( 'Select the Layout style for the Header.', 'eva' ),
                    'options'  => array(
                        '1' => array(
                            'alt' => 'Layout 1',
                            'img' => get_template_directory_uri() . '/images/theme-options/header_1.png'
                        ),
                        '2' => array(
                            'alt' => 'Layout 2',
                            'img' => get_template_directory_uri() . '/images/theme-options/header_2.png'
                        ),
                        '3' => array(
                            'alt' => 'Layout 32',
                            'img' => get_template_directory_uri() . '/images/theme-options/header_3.png'
                        ),                        
                    ),
                    'default'  => '1'
                ),                 

                 // Header Contact seaction

                array(
                    'id' => 'topbar_info',
                    'icon' => true,
                    'type' => 'info',
                    'raw' => esc_html__( 'Top Bar', 'eva' ),
                ), 

                array(
                    'title' => esc_html__('Top Bar', 'eva'),
                    'subtitle' => esc_html__('Enable / Disable the Top Bar.', 'eva'),
                    'id' => 'tdl_topbar_switch',
                    'on' => esc_html__('Enabled', 'eva'),
                    'off' => esc_html__('Disabled', 'eva'),
                    'type' => 'switch',
                    'default'  => 0,
                ),

                array(
                    'title' => esc_html__('Top Bar Login/My Account', 'eva'),
                    'subtitle' => esc_html__('Enable / Disable Top Bar Login/My Account link', 'eva'),
                    'id' => 'tdl_topbar_login',
                    'on' => esc_html__('Enabled', 'eva'),
                    'off' => esc_html__('Disabled', 'eva'),
                    'required' => array( 'tdl_topbar_switch', 'equals', array( '1' ) ),
                    'type' => 'switch',
                    'default'  => 1,
                ),

                array(
                    'title' => esc_html__('Top Bar Contact', 'eva'),
                    'subtitle' => esc_html__('Enable / Disable Top Bar Contact section', 'eva'),
                    'id' => 'tdl_topbar_contact',
                    'on' => esc_html__('Enabled', 'eva'),
                    'off' => esc_html__('Disabled', 'eva'),
                    'required' => array( 'tdl_topbar_switch', 'equals', array( '1' ) ),
                    'type' => 'switch',
                    'default'  => 1,
                ),

                array(
                    'title' => esc_html__('Top Bar Header Contact Section Icon', 'eva'),
                    'subtitle' => esc_html__('Enable / Disable the Top Bar Contact section Icon in header', 'eva'),
                    'id' => 'tdl_topbar_contact_icon',
                    'on' => esc_html__('Enabled', 'eva'),
                    'off' => esc_html__('Disabled', 'eva'),
                    'required' => array( 'tdl_topbar_contact', 'equals', array( '1' ) ),
                    'type' => 'switch',
                    'default' => 0,
                ),   

                array(
                    'id' => 'tdl_topbar_contact_subtitle',
                    'type' => 'text',
                    'title' => esc_html__('Top Bar Customer Support bar Subtitle', 'eva'),
                    'subtitle' => esc_html__('Enter the Top Bar Customer Support bar Subtitle', 'eva'),
                    'default' => 'Need Help?',
                    'required' => array( 'tdl_topbar_contact', 'equals', array( '1' ) ),
                ),                

                array(
                    'id' => 'tdl_topbar_contact_title',
                    'type' => 'text',
                    'title' => esc_html__('Top Bar Customer Support bar Title', 'eva'),
                    'subtitle' => esc_html__('Enter the Top Bar Customer Support Title', 'eva'),
                    'default' => '1-800-123-45-67',
                    'required' => array( 'tdl_topbar_contact', 'equals', array( '1' ) ),
                ),                

                array(
                    'title' => esc_html__('Top Bar Social', 'eva'),
                    'subtitle' => esc_html__('Enable / Disable Top Bar Social Icons section', 'eva'),
                    'id' => 'tdl_topbar_social',
                    'on' => esc_html__('Enabled', 'eva'),
                    'off' => esc_html__('Disabled', 'eva'),
                    'required' => array( 'tdl_topbar_switch', 'equals', array( '1' ) ),
                    'type' => 'switch',
                    'default'  => 1,
                ),                  
                              
                 // Header Contact seaction

                array(
                    'id' => 'contact_info',
                    'icon' => true,
                    'type' => 'info',
                    'raw' => esc_html__( 'Header Contact Section', 'eva' ),
                ), 

                array(
                    'title' => esc_html__('Header Contact Section', 'eva'),
                    'subtitle' => esc_html__('Enable / Disable the Contact section in header', 'eva'),
                    'id' => 'tdl_contact_bar',
                    'on' => esc_html__('Enabled', 'eva'),
                    'off' => esc_html__('Disabled', 'eva'),
                    'type' => 'switch',
                    'default' => 1,
                ), 

                array(
                    'title' => esc_html__('Header Contact Section Icon', 'eva'),
                    'subtitle' => esc_html__('Enable / Disable the Contact section Icon in header', 'eva'),
                    'id' => 'tdl_contact_icon',
                    'on' => esc_html__('Enabled', 'eva'),
                    'off' => esc_html__('Disabled', 'eva'),
                    'required' => array( 'tdl_contact_bar', 'equals', array( '1' ) ),
                    'type' => 'switch',
                    'default' => 0,
                ),                 

                array(
                    'id' => 'tdl_contact_subtitle',
                    'type' => 'text',
                    'title' => esc_html__('Customer Support bar Subtitle', 'eva'),
                    'subtitle' => esc_html__('Enter the Customer Support bar Subtitle', 'eva'),
                    'default' => 'Need Help?',
                    'required' => array( 'tdl_contact_bar', 'equals', array( '1' ) ),
                ),                

                array(
                    'id' => 'tdl_contact_title',
                    'type' => 'text',
                    'title' => esc_html__('Customer Support bar Title', 'eva'),
                    'subtitle' => esc_html__('Enter the Customer Support Title', 'eva'),
                    'default' => '1-800-123-45-67',
                    'required' => array( 'tdl_contact_bar', 'equals', array( '1' ) ),
                ),



                // Header Search bar

                array(
                    'id' => 'search_info',
                    'icon' => true,
                    'type' => 'info',
                    'raw' => esc_html__( 'Header Search', 'eva' ),
                ),

                array(
                    'title' => esc_html__('Header Search', 'eva'),
                    'subtitle' => esc_html__('Enable / Disable the Search in the Header.', 'eva'),
                    'id' => 'tdl_header_search_bar',
                    'on' => esc_html__('Enabled', 'eva'),
                    'off' => esc_html__('Disabled', 'eva'),
                    'type' => 'switch',
                    'default' => 1,
                ),

 

                // Header My Account

                 array(
                    'id' => 'header_myacc_info',
                    'icon' => true,
                    'type' => 'info',
                    'raw' => esc_html__( 'Header My Account Icon', 'eva' ),
                ), 

                array(
                    'title' => esc_html__('My Account Icon', 'eva'),
                    'subtitle' => esc_html__('Enable / Disable My Account Icon in header.', 'eva'),
                    'id' => 'tdl_header_my_account',
                    'on' => esc_html__('Enabled', 'eva'),
                    'off' => esc_html__('Disabled', 'eva'),
                    'type' => 'switch',
                    'default' => 0,
                ),   
                
                 // Sticky Header                                        

                array(
                    'id' => 'tdl_stickyheader_info',
                    'type' => 'info',
                    'raw' => esc_html__('Sticky Header', 'eva'),
                ),

                array(
                    'id' => 'tdl_sticky_menu',
                    'type' => 'switch',
                    'title' => esc_html__( 'Header Sticky Menu', 'eva' ),
                    'subtitle' => esc_html__( 'Check to enable Header Sticky Menu', 'eva' ),
                    'default' => 1,
                ),

                array(
                    'id' => 'tdl_sticky_menu_hide',
                    'type' => 'switch',
                    'on' => esc_html__('Enabled', 'eva'),
                    'off' => esc_html__('Disabled', 'eva'),
                    'title' => esc_html__( 'Header Sticky Menu Show/Hide on Scroll', 'eva' ),
                    'subtitle' => esc_html__( 'Check to enable Hide Header Sticky Menu on ScrollDown and Show on ScrollUp. Disable to Always Show Header Sticky Header.', 'eva' ),
                    'required' => array( 'tdl_sticky_menu', 'equals', array( '1' ) ),
                    'default' => 0,
                ),                
             
                array(
                    'id' => 'tdl_sticky_menu_mobile',
                    'type' => 'switch',
                    'on' => esc_html__('Show', 'eva'),
                    'off' => esc_html__('Hide', 'eva'),
                    'title' => esc_html__( 'Sticky Menu on Tablet/Mobile devices', 'eva' ),
                    'subtitle' => esc_html__( 'Check to Show Hide Header Sticky Menu on Tablet/Mobile devices.', 'eva' ),
                    'required' => array( 'tdl_sticky_menu', 'equals', array( '1' ) ),
                    'default' => 1,
                ),                 

         )
    ) );  


/* ---------------------------------------------------------------- */
/* Logo Settings
/* ---------------------------------------------------------------- */
    
    Redux::setSection( $opt_name, array(
            'title' => esc_html__('Logo & Favicon', 'eva' ),
            'icon'  => 'fa fa-rocket',
            'subsection' => true,
            'fields'    => array(

                array(
                    'id' => 'tdl_mainlogo_info',
                    'type' => 'info',
                    'raw' => esc_html__('Main Logo', 'eva'),
                ),                 
 
                array(
                    'subtitle' => esc_html__('Upload your logo image.', 'eva' ),
                    'id' => 'tdl_main_logo_noretina',
                    'type' => 'media',
                    'title' => esc_html__('Your Logo Image', 'eva' ),
                    'url' => false,                 
                ),

                array(
                    'subtitle' => esc_html__('Upload a higher-resolution image to be used for retina display devices.', 'eva' ),
                    'id' => 'tdl_main_logo_retina',
                    'type' => 'media',
                    'title' => esc_html__('Your Retina Logo Image', 'eva' ),
                    'url' => false,                 
                ),

                array(
                    'subtitle' => esc_html__('Upload your logo image for eark backgrounds.', 'eva' ),
                    'id' => 'tdl_main_logo_noretina_light',
                    'type' => 'media',
                    'title' => esc_html__('Your Logo Image for Dark Backgrounds', 'eva' ),
                    'url' => false,                 
                ),

                array(
                    'subtitle' => esc_html__('Upload a higher-resolution logo image to be used for retina display devices.', 'eva' ),
                    'id' => 'tdl_main_logo_retina_light',
                    'type' => 'media',
                    'title' => esc_html__('Your Retina Logo Image for Dark Backgrounds', 'eva' ),
                    'url' => false,                 
                ), 

                array(
                    'id' => 'tdl_site_logo_width',
                    'type' => 'slider',
                    'title' => esc_html__('Logo Width', 'eva'),
                    'subtitle' => esc_html__('Enter logo width (px)', 'eva'),
                    "default" => 125,
                    "min" => 50,
                    "step" => 1,
                    "max" => 500,
                    'display_value' => 'text',
                ),                                

                array(
                    'id' => 'tdl_site_logo_height',
                    'type' => 'slider',
                    'title' => esc_html__('Logo Height', 'eva'),
                    'subtitle' => esc_html__('Enter logo width (px)', 'eva'),
                    "default" => 93,
                    "min" => 30,
                    "step" => 1,
                    "max" => 500,
                    'display_value' => 'text',
                ), 
                
                array(
                    'id' => 'tdl_stickylogo_info',
                    'type' => 'info',
                    'raw' => esc_html__('Sticky Header Logo', 'eva'),
                ), 

                array(
                    'subtitle' => esc_html__('Upload your sticky header logo image.', 'eva' ),
                    'id' => 'tdl_sticky_logo_noretina',
                    'type' => 'media',
                    'title' => esc_html__('Your Sticky Header Logo Image', 'eva' ),
                    'url' => false,                 
                ),

                array(
                    'subtitle' => esc_html__('Upload a higher-resolution sticky header logo image to be used for retina display devices.', 'eva' ),
                    'id' => 'tdl_sticky_logo_retina',
                    'type' => 'media',
                    'title' => esc_html__('Your Retina Sticky Header Logo Image', 'eva' ),
                    'url' => false,                 
                ), 

                array(
                    'id' => 'tdl_sticky_logo_width',
                    'type' => 'slider',
                    'title' => esc_html__('Sticky Logo Width', 'eva'),
                    'subtitle' => esc_html__('Enter sticky logo width (px)', 'eva'),
                    "default" => 124,
                    "min" => 20,
                    "step" => 1,
                    "max" => 500,
                    'display_value' => 'text',
                ),                 

                array(
                    'id' => 'tdl_sticky_logo_height',
                    'type' => 'slider',
                    'title' => esc_html__('Sticky Logo Height', 'eva'),
                    'subtitle' => esc_html__('Enter sticky logo height (px)', 'eva'),
                    "default" => 35,
                    "min" => 20,
                    "step" => 1,
                    "max" => 300,
                    'display_value' => 'text',
                ),

                array(
                    'id' => 'tdl_mobilelogo_info',
                    'type' => 'info',
                    'raw' => esc_html__('Mobile Logo Settings', 'eva'),
                ),  

                array(
                    'id' => 'tdl_mobile_logo_height',
                    'type' => 'slider',
                    'title' => esc_html__('Mobile Logo Max Height', 'eva'),
                    'subtitle' => esc_html__('Enter mobile logo max height (px)', 'eva'),
                    "default" => 60,
                    "min" => 20,
                    "step" => 1,
                    "max" => 300,
                    'display_value' => 'text',
                ),                              


                array(
                    'id' => 'tdl_textlogo_info',
                    'type' => 'info',
                    'raw' => esc_html__('Text Logo Settings', 'eva'),
                ),  

                array(
                    'id'=> 'tdl_logo_font',
                    'type' => 'typography',
                    'title' => esc_html__('Logo Font', 'eva'),
                    'subtitle' => esc_html__('Specify the logo font properties.', 'eva'),
                    'google'=> true,
                    'font-backup'=>true,
                    'font-size'=>false,
                    'line-height'=>false,
                    'text-align'=>false,
                    'text-transform'=>true,
                    'letter-spacing'=>true,
                    'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                    'output' => array('.site-branding h1'), // An array of CSS selectors to apply this font style to dynamically
                    'compiler' => array('.site-branding h1'), // An array of CSS selectors to apply this font style to dynamically
                    'units'=>'px', // Defaults to px
                    'default' => array(
                        'color'=>'#333333',
                        'font-family'=>'Dosis',
                        'text-transform'=>'Uppercase',
                        'font-weight'=>'500',
                        'letter-spacing'  => 0,
                        'subsets' => 'latin'
                    ),
                ),  

                array(
                    'subtitle' => esc_html__('Check to show the description (tagline) for your site. Will be displayed next to a logo.', 'eva'),
                    'id' => 'tdl_logo_description',
                    'type' => 'switch',
                    'title' => esc_html__('Show Logo Tagline', 'eva'),
                    'default'  => 1,
                ),

                array(
                    'id'=> 'tdl_logo_tagline_font',
                    'type' => 'typography',
                    'title' => esc_html__('Logo Tagline Font', 'eva'),
                    'subtitle' => esc_html__('Specify the logo Tagline font properties.', 'eva'),
                    'google'=> true,
                    'font-backup'=>true,
                    'line-height'=>false,
                    'text-align'=>false,
                    'font-size'=>false,
                    'text-transform'=>true,
                    'letter-spacing'=>true,
                    'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                    'output' => array('.site-branding small'), // An array of CSS selectors to apply this font style to dynamically
                    'compiler' => array('.site-branding small'), // An array of CSS selectors to apply this font style to dynamically
                    'units'=>'px', // Defaults to px
                    'default' => array(
                        'color'=>'#666666',
                        'font-family'=>'Dosis',
                        'font-weight'=>'300',
                        'letter-spacing'  => 0,
                        'text-transform'=>'None',
                        'subsets' => 'latin'
                        ),
                    'required' => array( 'tdl_logo_description', 'equals', array( '1' ) ),
                ), 
    

                //  Favicon Settings

                array(
                    'id' => 'tdl_favicon_info',
                    'type' => 'info',
                    'raw' => esc_html__('Favicon Settings', 'eva'),
                ),   

                array(
                    'desc' => esc_html__('Add your custom Favicon image. Upload image: png, ico', 'eva'),
                    'id' => 'tdl_favicon_image',
                    'type' => 'media',
                    'title' => esc_html__('Favicon', 'eva'),  
                    'url' => false,
                          'default' => array (
                          'url' => get_template_directory_uri() . '/images/favicon.png',
                    ),                                      
                ),  

                array(
                    'id' => 'tdl_favicon_image_retina',
                    'type' => 'media',
                    'desc' => esc_html__('Add your custom Favicon image. Upload image: png, ico', 'eva'),
                    'operator' => 'and',
                    'title' => esc_html__('Favicon retina image', 'eva'),
                     'url' => false,
                          'default' => array (
                          'url' => get_template_directory_uri() . '/images/apple-touch-icon-152x152-precomposed.png',
                    ),                    
                ),                                                                                                     
        )
    ) );

/* ---------------------------------------------------------------- */
/* Off-canvas Settings
/* ---------------------------------------------------------------- */


    Redux::setSection( $opt_name, array(
            'title' => esc_html__('Off-canvas Settings', 'eva' ),
            'icon'  => 'fa fa-columns',
            'fields'    => array(


                 array(
                    'title' => esc_html__('Mobile Off-canvas Search', 'eva'),
                    'subtitle' => esc_html__('Enable / Disable the Search in off-canvas sidebar in Mobile', 'eva'),
                    'id' => 'tdl_mobile_search_bar',
                    'on' => esc_html__('Enabled', 'eva'),
                    'off' => esc_html__('Disabled', 'eva'),
                    'required' => array( 'tdl_header_search_bar', 'equals', array( '1' ) ),
                    'type' => 'switch',
                    'default' => 1,
                ), 

                 array(
                    'title' => esc_html__('Off-canvas My Account/Login', 'eva'),
                    'subtitle' => esc_html__('Enable / Disable the My Account in off-canvas sidebar', 'eva'),
                    'id' => 'tdl_offcanvas_myccount',
                    'on' => esc_html__('Enabled', 'eva'),
                    'off' => esc_html__('Disabled', 'eva'),
                    'type' => 'switch',
                    'default' => 1,
                ),                  

         )
    ) );

/* ---------------------------------------------------------------- */
/* Typography Settings
/* ---------------------------------------------------------------- */

    Redux::setSection( $opt_name, array(
            'title' => esc_html__('Typography', 'eva'),
            'icon'  => 'fa fa-font',
            'fields'    => array(
 
                array(
                    'id' => 'tdl_heading_font_info',
                    'type' => 'info',
                    'raw' => esc_html__('Main Font', 'eva'),
                ), 

                array(
                    'id'=>'tdl_heading_font',
                    'type' => 'typography',
                    'title' => esc_html__('Heading Font', 'eva'),
                    'subtitle' => esc_html__('Specify the heading font properties.', 'eva'),
                    'google'=> true,
                    'font-backup'=>true,
                    'text-align'=>false,
                    'font-size'     => false,
                    'line-height'   => false,
                    'color'=>false,
                    'letter-spacing'=>true,
                    'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                    'output' => array('h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, header.site-header .header-wrapper .nav .header-nav .menu-trigger .menu-title, header.site-header .header-wrapper .tools ul li.cart-button .cart-desc, .mm-menu .mm-listview > li a, .mm-navbar a, .mm-navbar a, .offcanvas_aside_right .offcanvas_minicart .widget_shopping_cart_content .cart_list li a, .woocommerce ul.products li.product .shop_product_metas h3 a, .widget-area .widget.woocommerce.widget_products li a, .woocommerce-cart .entry-content .woocommerce form table tbody td.product-name, .woocommerce .product_infos .group_table tr td a, .cd-quick-view .cd-item-info .product_infos .cart .group_table label a,
                    .woocommerce-checkout:not(.woocommerce-order-received) .woocommerce-checkout .checkout_right_wrapper .order_review_wrapper .woocommerce-checkout-review-order-table tbody td.product-name, .woocommerce-order-received .woocommerce .thank_you_header_text p, .woocommerce-order-received .woocommerce .order_detail_box table.shop_table tbody td.product-name a, .my_account_container .order-container table.shop_table tbody td.product-name a, .woocommerce table.wishlist_table tbody td.product-name a, .vc_tta-tab a, .shortcode_banner .shortcode_banner_inside .shortcode_banner_content h3.primary_font, .shortcode_banner .shortcode_banner_inside .shortcode_banner_content h4.primary_font, .woocommerce .woocommerce-tabs ul.tabs li a, .page-header .list_shop_categories li a, .offcanvas_search .suggestion_results .guaven_woos_suggestion ul li.guaven_woos_suggestion_list a .guaven_woos_titlediv, .button, .widget-area .widget.widget_mc4wp_form_widget table td input[type="submit"], .swiper-slide .slider-content .slider-content-wrapper h1.primary_font, .swiper-slide .slider-content .slider-content-wrapper p.primary_font, #header-top-bar .topbar_left .topbar_myaccount a'), // An array of CSS selectors to apply this font style to dynamically
                    'compiler' => array('h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, header.site-header .header-wrapper .nav .header-nav .menu-trigger .menu-title, header.site-header .header-wrapper .tools ul li.cart-button .cart-desc, .mm-menu .mm-listview > li a, .mm-navbar a, .mm-navbar a, .offcanvas_aside_right .offcanvas_minicart .widget_shopping_cart_content .cart_list li a, .woocommerce ul.products li.product .shop_product_metas h3 a, .widget-area .widget.woocommerce.widget_products li a, .woocommerce-cart .entry-content .woocommerce form table tbody td.product-name, .woocommerce .product_infos .group_table tr td a, .cd-quick-view .cd-item-info .product_infos .cart .group_table label a, .woocommerce-checkout:not(.woocommerce-order-received) .woocommerce-checkout .checkout_right_wrapper .order_review_wrapper .woocommerce-checkout-review-order-table tbody td.product-name, .woocommerce-order-received .woocommerce .thank_you_header_text p, .woocommerce-order-received .woocommerce .order_detail_box table.shop_table tbody td.product-name a, .my_account_container .order-container table.shop_table tbody td.product-name a, .woocommerce table.wishlist_table tbody td.product-name a. .vc_tta-tab a, .shortcode_banner .shortcode_banner_inside .shortcode_banner_content h3.primary_font, .shortcode_banner .shortcode_banner_inside .shortcode_banner_content h4.primary_font, .woocommerce .woocommerce-tabs ul.tabs li a, .page-header .list_shop_categories li a, .offcanvas_search .suggestion_results .guaven_woos_suggestion ul li.guaven_woos_suggestion_list a .guaven_woos_titlediv, .button, .widget-area .widget.widget_mc4wp_form_widget table td input[type="submit"], .swiper-slide .slider-content .slider-content-wrapper h1.primary_font, .swiper-slide .slider-content .slider-content-wrapper p.primary_font, #header-top-bar .topbar_left .topbar_myaccount a'), // An array of CSS selectors to apply this font style to dynamically
                    'units'=>'px', // Defaults to px
                    'default' => array(
                        'font-family'=>'Dosis',
                        'font-weight'=>'600',
                        'letter-spacing'  => 1,
                        'subsets' => 'latin'
                    ),
                ),

                array(
                    'id'=>'tdl_header_title_font',
                    'type' => 'typography',
                    'title' => esc_html__('Header Title Font', 'eva'),
                    'subtitle' => esc_html__('Specify the header title font properties.', 'eva'),
                    'google'=> true,
                    'font-backup'=>true,
                    'text-align'=>false,
                    'font-size'     => false,
                    'line-height'   => false,
                    'color'=>false,
                    'text-transform'=>true,
                    'letter-spacing'=>true,
                    'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                    'output' => array('.page-header h1.page-title, .offcanvas_aside_right .offcanvas_minicart .widget_shopping_cart_content .cart_list li a.remove'), // An array of CSS selectors to apply this font style to dynamically
                    'compiler' => array('.page-header h1.page-title. .offcanvas_aside_right .offcanvas_minicart .widget_shopping_cart_content .cart_list li a.remove'), // An array of CSS selectors to apply this font style to dynamically
                    'units'=>'px', // Defaults to px
                    'default' => array(
                        'font-family'=>'Dosis',
                        'font-weight'=>'600',
                        'text-transform'=>'Inherit',
                        'letter-spacing'  => 1,
                        'subsets' => 'latin'
                    ),
                ),  

                array(
                    'id'=>'tdl_nav_font',
                    'type' => 'typography',
                    'title' => esc_html__('Navigation Font', 'eva'),
                    'subtitle' => esc_html__('Specify the header title font properties.', 'eva'),
                    'google'=> true,
                    'font-backup'=>true,
                    'text-align'=>false,
                    'font-size'     => true,
                    'line-height'   => false,
                    'color'=>false,
                    'text-transform'=>true,
                    'letter-spacing'=>true,
                    'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                    'output' => array('.mm-listview span div, .mm-navbar .mm-title, .language_currency ul li, .language_currency ul li a, .main-navigation ul li a'), // An array of CSS selectors to apply this font style to dynamically
                    'compiler' => array('.mm-listview span div, .mm-navbar .mm-title, .language_currency ul li, .language_currency ul li a, .main-navigation ul li a'), // An array of CSS selectors to apply this font style to dynamically
                    'units'=>'px', // Defaults to px
                    'default' => array(
                        'font-family'=>'Dosis',
                        'font-weight'=>'500',
                        'text-transform'=>'Uppercase',
                        'letter-spacing'  => 1,
                        'subsets' => 'latin'
                    ),
                ),             

                array(
                    'id' => 'tdl_secondary_font_info',
                    'type' => 'info',
                    'raw' => esc_html__('Secondary Font', 'eva'),
                ),

                array(
                    'id'=>'tdl_secondary_font',
                    'type' => 'typography',
                    'title' => esc_html__('Secondary Font', 'eva'),
                    'subtitle' => esc_html__('Specify the secondary font properties.', 'eva'),
                    'google'=> true,
                    'font-backup'=>true,
                    'text-align'=>false,
                    'font-size'     => false,
                    'line-height'   => false,
                    'color'=>false,
                    'letter-spacing'=>true,
                    'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                    'output' => array('body, p, a, .shortcode_banner .shortcode_banner_inside .shortcode_banner_content h3.secondary_font, .shortcode_banner .shortcode_banner_inside .shortcode_banner_content h4.secondary_font, .blog-list-wrapper .blog-list-item .blog-list-comment i span, .swiper-slide .slider-content .slider-content-wrapper h1.secondary_font, .swiper-slide .slider-content .slider-content-wrapper p.secondary_font, .main-navigation ul ul li a'), // An array of CSS selectors to apply this font style to dynamically
                    'compiler' => array('body, p, a, .shortcode_banner .shortcode_banner_inside .shortcode_banner_content h3.secondary_font, .shortcode_banner .shortcode_banner_inside .shortcode_banner_content h4.secondary_font, .blog-list-wrapper .blog-list-item .blog-list-comment i span, .swiper-slide .slider-content .slider-content-wrapper h1.secondary_font, .swiper-slide .slider-content .slider-content-wrapper p.secondary_font, .main-navigation ul ul li a'), // An array of CSS selectors to apply this font style to dynamically
                    'units'=>'px', // Defaults to px
                    'default' => array(
                        'font-family'=>'Roboto',
                        'font-weight'=>'300',
                        'letter-spacing'  => 0.5,
                        'subsets' => 'latin'
                    ),
                ),                
                                                           

        )
    ) );

/* ---------------------------------------------------------------- */
/* Styling Settings
/* ---------------------------------------------------------------- */


    Redux::setSection( $opt_name, array(
            'title' => esc_html__('Styling', 'eva'),
            'icon'  => 'fa fa-magic',
            'fields'    => array(

                array(
                    'subtitle' => esc_html__('Select a main color for your site.', 'eva'),
                    'id' => 'tdl_main_color',
                    'type' => 'color',
                    'title' => esc_html__('Main Theme Color', 'eva'),
                    'default' => '#a8e8e2',
                    'transparent' => false,
                ),

                array(
                    'id'       => 'tdl_main_color_scheme',
                    'type'     => 'image_select',
                    'compiler' => true,
                    'title' => esc_html__('Color for content of elements (buttons, counters, etc.)', 'eva'),
                    'subtitle' => esc_html__('Choose Color Scheme for elements like buttons, counters, menu hover etc. when you use contrast (darker) Main Color.', 'eva'),
                    'options'  => array(
                        'mc_light' => array(
                            'alt' => 'Light Colors',
                            'img' => get_template_directory_uri() . '/images/theme-options/color_1.png'
                        ),
                        'mc_dark' => array(
                            'alt' => 'Contrast Colors',
                            'img' => get_template_directory_uri() . '/images/theme-options/color_2.png'
                        ),
                    ),
                    'default'  => 'mc_light'
                ),


                array(
                    'subtitle' => esc_html__('Select a color for website background.', 'eva'),
                    'id' => 'tdl_main_bg_color',
                    'type' => 'color',
                    'title' => esc_html__('Background Color', 'eva'),
                    'default' => '#ffffff',
                    'transparent' => false,
                ),                


                array(
                    'id' => 'tdl_form_style', 
                    'type' => 'select', 
                    'title' => __('Overall Form Style', 'eva'),
                    'subtitle' => __('Sets the style of all form elements used.', 'eva'),
                    'options' => array(
                        "default" => __('Default', 'eva'),
                        "minimal" => __('Minimal', 'eva'),
                    ),
                    'default' => 'default'
                ),   

                 array(
                    'id' => 'info-loader',
                    'icon' => true,
                    'type' => 'info',
                    'raw' => esc_html__('Page Loader', 'eva'),
                ),

                 array(
                    'id'       => 'tdl_page_loader_spinner',
                    'type'     => 'image_select',
                    'compiler' => true,
                    'title'    => esc_html__( 'Page Loader Icon', 'eva' ),
                    'subtitle' => esc_html__( 'Select the Page Loader Icon', 'eva' ),
                    'required' => array( 'tdl_page_loader', 'equals', array( '1' ) ),
                    'options'  => array(
                        '1' => array(
                            'alt' => 'Spinner Icon 1',
                            'img' => get_template_directory_uri() . '/images/theme-options/main_loader_1.png'
                        ),                        
                        '2' => array(
                            'alt' => 'Spinner Icon 2',
                            'img' => get_template_directory_uri() . '/images/theme-options/main_loader_2.png'
                        ),   
                        '3' => array(
                            'alt' => 'Spinner Icon 3',
                            'img' => get_template_directory_uri() . '/images/theme-options/main_loader_3.png'
                        ),
                        '4' => array(
                            'alt' => 'Spinner Icon 4',
                            'img' => get_template_directory_uri() . '/images/theme-options/main_loader_4.png'
                        ),                                                               
                    ),
                    'default'  => '1'
                ),                 

                array(
                    'subtitle' => esc_html__('Select a color for loader', 'eva'),
                    'id' => 'tdl_page_loader_color',
                    'type' => 'color',
                    'title' => esc_html__('Loader Color', 'eva'),
                    'default' => '#a8e8e2',
                    'transparent' => false,
                    'required' => array( 'tdl_page_loader', 'equals', array( '1' ) ),
                ), 


                array(
                    'subtitle' => esc_html__('Select a color for loader background', 'eva'),
                    'id' => 'tdl_page_loader_bg',
                    'type' => 'color',
                    'title' => esc_html__('Loader Background Color', 'eva'),
                    'default' => '#ffffff',
                    'transparent' => false,
                    'required' => array( 'tdl_page_loader', 'equals', array( '1' ) ),
                ), 

                array(
                    'subtitle' => esc_html__('Enable/Disable Page Loader', 'eva'),
                    'id' => 'tdl_page_loader',
                    'on' => esc_html__('Enable', 'eva'),
                    'off' => esc_html__('Disable', 'eva'),
                    'type' => 'switch',
                    'title' => esc_html__('Page Loader', 'eva'),
                    'default' => 0,
                ),                             


        )
    ) ); 

/* ---------------------------------------------------------------- */
/* Header Settings
/* ---------------------------------------------------------------- */

    Redux::setSection( $opt_name, array(
            'title' => esc_html__('Header', 'eva' ),
            'icon'  => 'fa fa-rocket',
            'subsection' => true,
            'fields'    => array(

                array(
                    'id' => 'menu_trgigger_info',
                    'icon' => true,
                    'type' => 'info',
                    'raw' => esc_html__('Menu Trigger', 'eva')
                ),           

                 array(
                    'id'       => 'tdl_trigger_menu_style',
                    'type'     => 'image_select',
                    'compiler' => true,
                    'title'    => esc_html__( 'Menu Trigger Style', 'eva' ),
                    'subtitle' => esc_html__( 'Select the style of Menu Trigger', 'eva' ),
                    'options'  => array(
                        'menu_trigger_1' => array(
                            'alt' => 'Menu Trigger 1',
                            'img' => get_template_directory_uri() . '/images/theme-options/menu_trigger_1.png'
                        ),
                        'menu_trigger_2' => array(
                            'alt' => 'Menu Trigger 2',
                            'img' => get_template_directory_uri() . '/images/theme-options/menu_trigger_2.png'
                        ),
                        'menu_trigger_3' => array(
                            'alt' => 'Menu Trigger 3',
                            'img' => get_template_directory_uri() . '/images/theme-options/menu_trigger_3.png'
                        ),
                        'menu_trigger_4' => array(
                            'alt' => 'Menu Trigger 4',
                            'img' => get_template_directory_uri() . '/images/theme-options/menu_trigger_4.png'
                        ),                       
                    ),

                    'default'  => 'menu_trigger_1'
                ),

        )
    ) ); 

/* ---------------------------------------------------------------- */
/* Shop Settings
/* ---------------------------------------------------------------- */


    Redux::setSection( $opt_name, array(
            'title' => esc_html__('Shop Settings', 'eva'),
            'icon'  => 'fa fa-shopping-cart',
                 'fields'    => array(

                array(
                    'subtitle' => esc_html__('Check to enable Catalog Mode. You can hide all "Add to cart" buttons, cart widget, cart and checkout pages. This will allow you to showcase your products as an online catalog without ability to make a purchase.', 'eva'),
                    'id' => 'tdl_catalog_mode',
                    'type' => 'switch',
                    'on' => esc_html__('Enable', 'eva'),
                    'off' => esc_html__('Disable', 'eva'),
                    'title' => 'Catalog Mode',
                    'default'  => 0,
                ),                    

        )
    ) ); 


/* ---------------------------------------------------------------- */
/* Shop Catalog
/* ---------------------------------------------------------------- */

    Redux::setSection( $opt_name, array(
                'title' => esc_html__('Shop Catalog', 'eva'),
                'subsection' => true,
                'fields'    => array(


                array(
                    'title' => __('Sidebar Style', 'eva'),
                    'id' => 'tdl_sidebar_style',
                    'on' => __('On Page', 'eva'),
                    'off' => __('Off-Canvas', 'eva'),
                    'type' => 'switch',
                    'default' => 1,
                ),                    

                array(
                    'id' => 'info_shop_display',
                    'icon' => true,
                    'type' => 'info',
                    'raw' => esc_html__( 'Shop Display', 'eva' ),
                ),  

                array(
                    'id'       => 'tdl_shop_pagination',
                    'type'     => 'button_set',
                    'title'    => __('Shop Pagination', 'eva'), 
                    'subtitle' => __('You can set type of shop pagination', 'eva'),
                    'options'  => array(
                        'classic' => __('Classic', 'eva'), 
                        'load_more' => __('Load More', 'eva'),  
                        'infinite_scroll' => __('Infinite', 'eva'), 
                    ),
                    'default' => 'classic'
                ),                                  

                array(
                    'id'=>'tdl_product_count',
                    'type' => 'text',
                    'title' => esc_html__('Number of Products per Page', 'eva'),
                    'subtitle' => esc_html__('Comma separated list of product counts.', 'eva'),
                    'default' => '12,24,36',
                    'required' => array( 'tdl_shop_pagination', 'equals', array( 'classic' ) ),
                ),

                array(
                    'title' => esc_html__('Number of Products per Page', 'eva'),
                    'subtitle' => esc_html__('Drag the slider to set the number of categories per column to be listed on the shop page and catalog pages.', 'eva'),
                    'id' => 'tdl_products_per_page',
                    'min' => '1',
                    'step' => '1',
                    'max' => '48',
                    'type' => 'slider',
                    'default' => '4',
                    'required' => array( 'tdl_shop_pagination', 'equals', array( 'load_more','infinite_scroll' ) ),
                ),                

                array(
                    'title' => esc_html__('Number of Categories per Column', 'eva'),
                    'subtitle' => esc_html__('Drag the slider to set the number of categories per column to be listed on the shop page and catalog pages.', 'eva'),
                    'id' => 'tdl_categories_per_column',
                    'min' => '2',
                    'step' => '1',
                    'max' => '5',
                    'type' => 'slider',
                    'default' => '4',
                ),  

                array(
                    'subtitle' => __('Select effect for categories view on hover', 'eva'),
                    'id' => 'tdl_category_view',
                    'type' => 'select',
                    'options' => array (
                        'perspective_hover' => __('Hover Perspective', 'eva'), 
                        'zoom_hover' => __('Hover Zoom', 'eva'), 
                    ),
                    'title' => __('Categories View on Hover', 'eva'), 
                    'default' => 'perspective_hover',
                ),                                                         

                array(
                    'title' => esc_html__('Number of Products per Column', 'eva'),
                    'subtitle' => esc_html__('Drag the slider to set the number of products per column to be listed on the shop page and catalog pages.', 'eva'),
                    'id' => 'tdl_products_per_column',
                    'min' => '2',
                    'step' => '1',
                    'max' => '6',
                    'type' => 'slider',
                    'default' => '4',
                ), 

                array(
                    'id' => 'tdl_shop_second_image',
                    'type' => 'switch',
                    'on' => esc_html__('Enabled', 'eva'),
                    'off' => esc_html__('Disabled', 'eva'),
                    'title' => esc_html__( 'Second Image on Hover', 'eva' ),
                    'subtitle' => esc_html__( 'Enable / Disable the Second Image on Product Listing.', 'eva' ),
                    'default' => 1,
                ),   


                array(
                    'title' => __('Quick View', 'eva'),
                    'id' => 'tdl_quick_view',
                    'on' => __('Enabled', 'eva'),
                    'off' => __('Disabled', 'eva'),
                    'type' => 'switch',
                ),                              

                array(
                    'subtitle' => __('Display Category/Categories name in Product Listing', 'eva'),
                    'id' => 'tdl_category_listing',
                    'type' => 'select',
                    'options' => array (
                        'none' => __('Disable', 'eva'), 
                        'categories' => __('Display All Product Categories', 'eva'), 
                        'first_category' => __('Display Only First Category', 'eva'), 
                    ),
                    'title' => __('Category/Categories name in Product Listing', 'eva'), 
                    'default' => 'first_category',
                ), 

                array(
                    'title' => __('Show Review Rating in Product Listing', 'eva'),
                    'id' => 'tdl_review_off',
                    'on' => __('Enable', 'eva'),
                    'off' => __('Disable', 'eva'),
                    'type' => 'switch',
                    'default' => 1,
                ),               

                array(
                    'title' => __('Add to Cart Button Display', 'eva'),
                    'id' => 'tdl_add_to_cart_display',
                    'on' => __('When hovering', 'eva'),
                    'off' => __('At all times', 'eva'),
                    'type' => 'switch',
                    'default' => 1
                ), 

                array(
                    'id' => 'shop_badge_onfo',
                    'icon' => true,
                    'type' => 'info',
                    'raw' => esc_html__('Shop Badges', 'eva'),
                ), 

                array(
                    'title' => esc_html__('% Sale Badge', 'eva'),
                    'subtitle' => esc_html__('Check to enable "- %" Badge in percentages instead "Sale" Badge', 'eva'),
                    'id' => 'tdl_sale_percentages',
                    'on' => esc_html__('Enabled', 'eva'),
                    'off' => esc_html__('Disabled', 'eva'),
                    'type' => 'switch',
                    'default' => 1,
                ),  

                array(
                    'title' => esc_html__('"Sale" Badge Label', 'eva'),
                    'subtitle' => esc_html__('Type in your custom "Sale" Badge Label Text.', 'eva'),
                    'id' => 'tdl_salebadge_text',
                    'type' => 'text',
                    'default' => 'Sale',
                    'required' => array( 'tdl_sale_percentages', 'equals', array( '0' ) )
                ),                           
                                                          

                array(
                    'title' => esc_html__('"Out of Stock" Label Text', 'eva'),
                    'subtitle' => esc_html__('Type in your custom "Out of Stock" Label Text.', 'eva'),
                    'id' => 'tdl_out_of_stock_text',
                    'type' => 'text',
                    'default' => 'Out of stock'
                ),                                                             

        )
    ) ); 

/* ---------------------------------------------------------------- */
/* Product Page
/* ---------------------------------------------------------------- */


    Redux::setSection( $opt_name, array(
                'title' => esc_html__('Product Page', 'eva'),
                'subsection' => true,
                'fields'    => array(

                array(
                    'title' => esc_html__('Product Gallery Zoom', 'eva'),
                    'subtitle' => esc_html__('Enable / Disable Product Gallery Zoom.', 'eva'),
                    'id' => 'tdl_product_gallery_zoom',
                    'on' => esc_html__('Enabled', 'eva'),
                    'off' => esc_html__('Disabled', 'eva'),
                    'type' => 'switch',
                    'default' => 1,
                ),

                array(
                    'title' => esc_html__('Product Gallery Lightbox', 'eva'),
                    'subtitle' => esc_html__('Enable / Disable Product Gallery Lightbox.', 'eva'),
                    'id' => 'tdl_product_gallery_lightbox',
                    'on' => esc_html__('Enabled', 'eva'),
                    'off' => esc_html__('Disabled', 'eva'),
                    'type' => 'switch',
                    'default' => 1,
                ),

                 array(
                    'title' => esc_html__('Add to Cart Ajax', 'eva'),
                    'subtitle' => esc_html__('Disable the add to cart AJAX on the product page.', 'eva'),
                    'id' => 'tdl_product_addtocart_ajax',
                    'on' => esc_html__('Enabled', 'eva'),
                    'off' => esc_html__('Disabled', 'eva'),
                    'type' => 'switch',
                    'default' => 1,
                ),               

                array(
                    'title' => esc_html__('Size Chart', 'eva'),
                    'subtitle' => esc_html__('Enable / Disable Size Chart.', 'eva'),
                    'id' => 'tdl_size_chart',
                    'on' => esc_html__('Enabled', 'eva'),
                    'off' => esc_html__('Disabled', 'eva'),
                    'type' => 'switch',
                    'default' => 0,
                ),

                array(
                    'title' => esc_html__('"Size Chart Title', 'eva'),
                    'subtitle' => esc_html__('Type your Size Chart Title', 'eva'),
                    'id' => 'tdl_sizechart_title',
                    'type' => 'text',
                    'default' => 'Size Chart',
                    'required' => array( 'tdl_size_chart', 'equals', array( '1' ) )
                ),

                array(
                    'id'       => 'tdl_size_chart_page',
                    'type'     => 'select',
                    'multi'    => false,
                    'data'     => 'pages',
                    'title'    => esc_html__( 'Size Chart Page', 'eva' ),
                    'subtitle' => esc_html__( 'Select page that will be displayed in Size chart sidebar', 'eva' ),
                    'required' => array( 'tdl_size_chart', 'equals', array( '1' ) )
                ),


                array(
                    'subtitle' => __('Choose between different predefined designs', 'eva'),
                    'id' => 'tdl_product_design',
                    'type' => 'select',
                    'options' => array (
                        'default' => __('Default', 'eva'), 
                        'images_scroll' => __('Images Scroll', 'eva'), 
                    ),
                    'title' => __('Product page design', 'eva'), 
                    'default' => 'default',
                ), 


                array(
                    'title' => esc_html__('Product background', 'eva'),
                    'subtitle' => esc_html__('Set background for your products page. You can also specify different background for particular products while editing it.', 'eva'),
                    'id' => 'tdl_product_background',
                    'type' => 'background',
                    'transparent' => true,
                    'required' => array( 'tdl_product_design', 'equals', array( 'images_scroll' ) ),
                    'default'  => array(
                        'background-color' => '#e8e8e8',
                    )
                ),      

                array(
                    'title' => esc_html__('Number of Related Products per View', 'eva'),
                    'subtitle' => esc_html__('Drag the slider to set the number of Related Products per View.', 'eva'),
                    'id' => 'tdl_related_products_per_view',
                    'min' => '3',
                    'step' => '1',
                    'max' => '6',
                    'type' => 'slider',
                    'default' => '4',
                ), 

                array(
                    'title' => esc_html__('Sharing Options', 'eva'),
                    'subtitle' => esc_html__('Enable / Disable Sharing Options on Product page.', 'eva'),
                    'id' => 'tdl_sharing_options',
                    'on' => esc_html__('Enabled', 'eva'),
                    'off' => esc_html__('Disabled', 'eva'),
                    'type' => 'switch',
                    'default' => 1,
                ),  

                array(
                    'title' => esc_html__('Review Tab', 'eva'),
                    'subtitle' => esc_html__('Enable / Disable Review Tab on Product page.', 'eva'),
                    'id' => 'tdl_review_tab',
                    'on' => esc_html__('Enabled', 'eva'),
                    'off' => esc_html__('Disabled', 'eva'),
                    'type' => 'switch',
                    'default' => 1,
                ),                             
              
        )
    ) );

/* ---------------------------------------------------------------- */
/* Social Settings
/* ---------------------------------------------------------------- */


    Redux::setSection( $opt_name, array(
                'icon'   => 'fa fa-share',
                'title'  => esc_html__( 'Social Media / Sharing', 'eva' ),
                'fields'    => array(

                    array (
                        'id' => 'tdl_share_intro',
                        'icon' => true,
                        'type' => 'info',
                        'style' => 'warning',
                        'raw' => esc_html__('Social Network for Sharing', 'eva')
                    ),                   

                        array (
                            'id'       => 'tdl_share_select',
                            'type'     => 'select',
                            'multi'    => true,
                            'title'    => esc_html__('Social Network for Share', 'eva'), 
                            'subtitle' => esc_html__('Select Social Networks for Share', 'eva'),
                            //Must provide key => value pairs for radio options
                            'options'  => array(
                                'twitter' => 'Twitter',
                                'facebook' => 'Facebook',
                                'google' => 'Google+',
                                'pinterest' => 'Pinterest',
                                'linkedin' => 'LinkedIn',
                                'vk' => 'Vkontakte',
                                'blogger' => 'Blogger',
                                'delicious' => 'Delicious',
                                'digg' => 'Digg',
                                'friendFeed' => 'FriendFeed',
                                'myspace' => 'MySpace',
                                'stumbleUpon' => 'StumbleUpon',
                                'tumblr' => 'Tumblr',
                                'windows' => 'Windows',
                                'yahoo' => 'Yahoo',
                                'whatsapp' => 'WhatsApp'),
                            'default'  => array('twitter','facebook','google','pinterest','linkedin'),
                        ),

                    array (
                        'id' => 'tdl_social_intro',
                        'icon' => true,
                        'type' => 'info',
                        'style' => 'warning',
                        'raw' => esc_html__('Social Networks profiles', 'eva')
                    ),                            
 
                        array (
                            'title' => __('<i class="fa fa-twitter"></i> Twitter', 'eva'),
                            'subtitle' => esc_html__('Type your Twitter profile URL here.', 'eva'),
                            'id' => 'twitter_link',
                            'type' => 'text',
                            'default' => 'http://twitter.com/username',
                        ),                        
                        
                        array (
                            'title' => __('<i class="fa fa-facebook"></i> Facebook', 'eva'),
                            'subtitle' => esc_html__('Type your Facebook profile URL here.', 'eva'),
                            'id' => 'facebook_link',
                            'type' => 'text',
                            'default' => 'https://www.facebook.com/username',
                        ),

                        array (
                            'title' => __('<i class="fa fa-google-plus"></i> Google+', 'eva'),
                            'subtitle' => esc_html__('Type your Google+ profile URL here.', 'eva'),
                            'id' => 'googleplus_link',
                            'type' => 'text',
                        ), 

                        array (
                            'title' => __('<i class="fa fa-pinterest"></i> Pinterest', 'eva'),
                            'subtitle' => esc_html__('Type your Pinterest profile URL here.', 'eva'),
                            'id' => 'pinterest_link',
                            'type' => 'text',
                            'default' => 'http://www.pinterest.com/',
                        ),

                        array (
                            'title' => __('<i class="fa fa-vimeo-square"></i> Vimeo', 'eva'),
                            'subtitle' => esc_html__('Type your Vimeo profile URL here.', 'eva'),
                            'id' => 'vimeo_link',
                            'type' => 'text',
                        ), 
                        
                        array (
                            'title' => __('<i class="fa fa-youtube-play"></i> Youtube', 'eva'),
                            'subtitle' => esc_html__('Type your Youtube profile URL here.', 'eva'),
                            'id' => 'youtube_link',
                            'type' => 'text',
                        ),  

                        array (
                            'title' => __('<i class="fa fa-flickr"></i> Flickr', 'eva'),
                            'subtitle' => esc_html__('Type your Flickr profile URL here.', 'eva'),
                            'id' => 'flickr_link',
                            'type' => 'text',
                        ),

                       array (
                            'title' => __('<i class="fa fa-skype"></i> Skype', 'eva'),
                            'subtitle' => esc_html__('Type your Skype profile URL here.', 'eva'),
                            'id' => 'skype_link',
                            'type' => 'text',
                        ),

                        array (
                            'title' => __('<i class="fa fa-behance"></i> Behance', 'eva'),
                            'subtitle' => esc_html__('Type your Behance profile URL here.', 'eva'),
                            'id' => 'behance_link',
                            'type' => 'text',
                        ),

                        array (
                            'title' => __('<i class="fa fa-dribbble"></i> Dribble', 'eva'),
                            'subtitle' => esc_html__('Type your Dribble profile URL here.', 'eva'),
                            'id' => 'dribble_link',
                            'type' => 'text',
                        ),

                        array (
                            'title' => __('<i class="fa fa-tumblr"></i> Tumblr', 'eva'),
                            'subtitle' => esc_html__('Type your Tumblr URL here.', 'eva'),
                            'id' => 'tumblr_link',
                            'type' => 'text',
                        ),

                        array (
                            'title' => __('<i class="fa fa-linkedin"></i> LinkedIn', 'eva'),
                            'subtitle' => esc_html__('Type your LinkedIn profile URL here.', 'eva'),
                            'id' => 'linkedin_link',
                            'type' => 'text',
                        ),

                        array (
                            'title' => __('<i class="fa fa-github"></i> Github', 'eva'),
                            'subtitle' => esc_html__('Type your Github profile URL here.', 'eva'),
                            'id' => 'github_link',
                            'type' => 'text',
                        ),

                        array (
                            'title' => __('<i class="fa fa-vine"></i> Vine', 'eva'),
                            'subtitle' => esc_html__('Type your Vine profile URL here.', 'eva'),
                            'id' => 'vine_link',
                            'type' => 'text',
                        ),

                        array (
                            'title' => __('<i class="fa fa-instagram"></i> Instagram', 'eva'),
                            'subtitle' => esc_html__('Type your Instagram profile URL here.', 'eva'),
                            'id' => 'instagram_link',
                            'type' => 'text',
                        ),

                        array (
                            'title' => __('<i class="fa fa-dropbox"></i> Dropbox', 'eva'),
                            'subtitle' => esc_html__('Type your Dropbox profile URL here.', 'eva'),
                            'id' => 'dropbox_link',
                            'type' => 'text',
                        ),

                        array (
                            'title' => __('<i class="fa fa-rss"></i> RSS', 'eva'),
                            'subtitle' => esc_html__('Type your RSS Feed URL here.', 'eva'),
                            'id' => 'rss_link',
                            'type' => 'text',
                        ),
                        
                        array (
                            'title' => __('<i class="fa fa-stumbleupon"></i> Stumbleupon', 'eva'),
                            'subtitle' => esc_html__('Type your Stumbleupon URL here.', 'eva'),
                            'id' => 'stumbleupon_link',
                            'type' => 'text',
                        ),
                        
                        array (
                            'title' => __('<i class="fa fa-paypal"></i> Paypal', 'eva'),
                            'subtitle' => esc_html__('Type your Paypal URL here.', 'eva'),
                            'id' => 'paypal_link',
                            'type' => 'text',
                        ),

                        array (
                            'title' => __('<i class="fa fa-foursquare"></i> Foursquare', 'eva'),
                            'subtitle' => esc_html__('Type your Foursquare profile URL here.', 'eva'),
                            'id' => 'foursquare_link',
                            'type' => 'text',
                        ), 

                        array (
                            'title' => __('<i class="fa fa-soundcloud"></i> Soundcloud', 'eva'),
                            'subtitle' => esc_html__('Type your Soundcloud profile URL here.', 'eva'),
                            'id' => 'soundcloud_link',
                            'type' => 'text',
                        ),                                          

                        array (
                            'title' => __('<i class="fa fa-spotify"></i> Spotify', 'eva'),
                            'subtitle' => esc_html__('Type your Spotify profile URL here.', 'eva'),
                            'id' => 'spotify_link',
                            'type' => 'text',
                        ),                        

                        array (
                            'title' => __('<i class="fa fa-vk"></i> VKontakte', 'eva'),
                            'subtitle' => esc_html__('Type your VK profile URL here.', 'eva'),
                            'id' => 'vk_link',
                            'type' => 'text',
                        ),                        

                        array (
                            'title' => __('<i class="fa fa-android"></i> Android', 'eva'),
                            'subtitle' => esc_html__('Type your Android URL here.', 'eva'),
                            'id' => 'android_link',
                            'type' => 'text',
                        ), 

                        array (
                            'title' => __('<i class="fa fa-apple"></i> Apple', 'eva'),
                            'subtitle' => esc_html__('Type your Apple URL here.', 'eva'),
                            'id' => 'apple_link',
                            'type' => 'text',
                        ),
                        
                        array (
                            'title' => __('<i class="fa fa-windows"></i> Windows', 'eva'),
                            'subtitle' => esc_html__('Type your Windows profile URL here.', 'eva'),
                            'id' => 'windows_link',
                            'type' => 'text',
                        ),                        
              
        )
    ) );

/* ---------------------------------------------------------------- */
/* Blog Settings
/* ---------------------------------------------------------------- */


    Redux::setSection( $opt_name, array(
            'title' => esc_html__('Blog Settings', 'eva'),
            'icon'   => 'fa fa-comments-o',
            'fields'    => array(
 
                array(
                    'id'       => 'tdl_blog_layout',
                    'type'     => 'image_select',
                    'compiler' => true,
                    'title'    => esc_html__( 'Blog Layout', 'eva' ),
                    'subtitle' => esc_html__( 'Select the layout style for the Blog Listing.', 'eva' ),
                    'options'  => array(
                        '0' => array(
                            'alt' => 'No Sidebar',
                            'img' => get_template_directory_uri() . '/images/theme-options/blog-layout-1.png'
                        ),
                        '1' => array(
                            'alt' => 'Right Sidebar',
                            'img' => get_template_directory_uri() . '/images/theme-options/blog-layout-2.png'
                        ),
                    ),
                    'default'  => '1'
                ),

                array(
                    'id'       => 'tdl_single_blog_layout',
                    'type'     => 'image_select',
                    'compiler' => true,
                    'title'    => esc_html__( 'Single Blog Post Layout', 'eva' ),
                    'subtitle' => esc_html__( 'Select the layout style for the Blog Post.', 'eva' ),
                    'options'  => array(
                        '0' => array(
                            'alt' => 'No Sidebar',
                            'img' => get_template_directory_uri() . '/images/theme-options/blog-layout-1.png'
                        ),
                        '1' => array(
                            'alt' => 'Right Sidebar',
                            'img' => get_template_directory_uri() . '/images/theme-options/blog-layout-2.png'
                        ),
                    ),
                    'default'  => '1'
                ),               

                array(
                    'title' => esc_html__('Sharing Options', 'eva'),
                    'subtitle' => esc_html__('Enable / Disable Sharing Options on Blog single page.', 'eva'),
                    'id' => 'tdl_blog_sharing_options',
                    'on' => esc_html__('Enabled', 'eva'),
                    'off' => esc_html__('Disabled', 'eva'),
                    'type' => 'switch',
                    'default' => 1,
                ),  
              
        )
    ) );

/* ---------------------------------------------------------------- */
/* Footer Settings
/* ---------------------------------------------------------------- */


    Redux::setSection( $opt_name, array(
            'title' => esc_html__('Footer Settings', 'eva'),
            'icon'  => 'fa fa-chevron-down',
            'fields'    => array(
 
                array(
                    'subtitle' => esc_html__('Select how many footer widget areas you want to display.', 'eva'),
                    'id' => 'tdl_footer_layout',
                    'type' => 'image_select',
                    'options' => array (
                        '0' => array(
                            'alt' => esc_html__('Layout Off', 'eva'),
                            'img' => get_template_directory_uri() . '/images/theme-options/layout-off.png'
                        ),
                        '1' => array(
                            'alt' => esc_html__('Footer 1 column', 'eva'),
                            'img' => get_template_directory_uri() . '/images/theme-options/footer-widgets-1.png'
                        ),
                        '2' => array(
                            'alt' => esc_html__('Footer 2 columns', 'eva'),
                            'img' => get_template_directory_uri() . '/images/theme-options/footer-widgets-2.png'
                        ),      
                        '3' => array(
                            'alt' => esc_html__('Footer 3 columns', 'eva'),
                            'img' => get_template_directory_uri() . '/images/theme-options/footer-widgets-3.png'
                        ), 
                        '4' => array(
                            'alt' => esc_html__('Footer 4 columns', 'eva'),
                            'img' => get_template_directory_uri() . '/images/theme-options/footer-widgets-4.png'
                        ),
                        '5' => array(
                            'alt' => esc_html__('Footer 5 columns', 'eva'),
                            'img' => get_template_directory_uri() . '/images/theme-options/footer-widgets-5.png'
                        ),   
                        '6' => array(
                            'alt' => esc_html__('Footer 1-1-1-2 columns', 'eva'),
                            'img' => get_template_directory_uri() . '/images/theme-options/footer-widgets-1-1-1-2.png'
                        ),                                               
                        '7' => array(
                            'alt' => esc_html__('Footer 1-1-2 columns', 'eva'),
                            'img' => get_template_directory_uri() . '/images/theme-options/footer-widgets-1-1-2.png'
                        ),                         
                        '8' => array(
                            'alt' => esc_html__('Footer 1-2-1 columns', 'eva'),
                            'img' => get_template_directory_uri() . '/images/theme-options/footer-widgets-1-2-1.png'
                        ), 
                        '9' => array(
                            'alt' => esc_html__('Footer 2-1-1 columns', 'eva'),
                            'img' => get_template_directory_uri() . '/images/theme-options/footer-widgets-2-1-1.png'
                        ),                        
                    ),
                    'title' => esc_html__('Footer Widget Areas', 'eva'),
                    'default' => 0,
                ),

                array(
                    'id'       => 'tdl_footer_1_align',
                    'type'     => 'button_set',
                    'title'    => __('Footer 1 Sidebar Align', 'eva'), 
                    'subtitle' => __('Select align for footer 1 sidebar', 'eva'),
                    'options'  => array(
                        'left-align' => __('Left Align', 'eva'), 
                        'right-align' => __('Right Align', 'eva'),  
                    ),
                    'default' => 'left-align'
                ),   

                array(
                    'id'       => 'tdl_footer_2_align',
                    'type'     => 'button_set',
                    'title'    => __('Footer 2 Sidebar Align', 'eva'), 
                    'subtitle' => __('Select align for footer 2 sidebar', 'eva'),
                    'options'  => array(
                        'left-align' => __('Left Align', 'eva'), 
                        'right-align' => __('Right Align', 'eva'),  
                    ),
                    'default' => 'left-align'
                ),
                
                array(
                    'id'       => 'tdl_footer_3_align',
                    'type'     => 'button_set',
                    'title'    => __('Footer 3 Sidebar Align', 'eva'), 
                    'subtitle' => __('Select align for footer 3 sidebar', 'eva'),
                    'options'  => array(
                        'left-align' => __('Left Align', 'eva'), 
                        'right-align' => __('Right Align', 'eva'),  
                    ),
                    'default' => 'left-align'
                ),    

                array(
                    'id'       => 'tdl_footer_4_align',
                    'type'     => 'button_set',
                    'title'    => __('Footer 4 Sidebar Align', 'eva'), 
                    'subtitle' => __('Select align for footer 4 sidebar', 'eva'),
                    'options'  => array(
                        'left-align' => __('Left Align', 'eva'), 
                        'right-align' => __('Right Align', 'eva'),  
                    ),
                    'default' => 'left-align'
                ),

                array(
                    'id'       => 'tdl_footer_5_align',
                    'type'     => 'button_set',
                    'title'    => __('Footer 5 Sidebar Align', 'eva'), 
                    'subtitle' => __('Select align for footer 5 sidebar', 'eva'),
                    'options'  => array(
                        'left-align' => __('Left Align', 'eva'), 
                        'right-align' => __('Right Align', 'eva'),  
                    ),
                    'default' => 'left-align'
                ),

                array(
                    'id' => 'tdl_instagram_intro',
                    'icon' => true,
                    'type' => 'info',
                    'style' => 'warning',
                    'raw' => esc_html__('Instagram Feed', 'eva')
                ),

                array(
                    'title' => esc_html__('Instagram Feed', 'eva'),
                    'subtitle' => esc_html__('Please make sure you have "WP Instagram Widget" plugin installed.', 'eva'),
                    'id' => 'tdl_instagram_feed',
                    'on' => esc_html__('Enabled', 'eva'),
                    'off' => esc_html__('Disabled', 'eva'),
                    'type' => 'switch',
                    'default' => 2,
                ), 

                array(
                    'id' => 'tdl_instagram_name',
                    'type' => 'text',
                    'title' => esc_html__('Instagram username', 'eva'),
                    'default' => 'username',
                    'required' => array( 'tdl_instagram_feed', 'equals', array( '1' ) ),
                ),

                array(
                    'id' => 'tdl_instagram_text',
                    'type' => 'text',
                    'title' => esc_html__('Link text', 'eva'),
                    'default' => 'Follow Our Instagram',
                    'required' => array( 'tdl_instagram_feed', 'equals', array( '1' ) ),
                ), 

                array(
                    'id'       => 'tdl_instagram_link',
                    'type'     => 'button_set',
                    'title'    => __('Link target', 'eva'), 
                    'required' => array( 'tdl_instagram_feed', 'equals', array( '1' ) ),
                    'options'  => array(
                        '_self' => __('_self', 'eva'), 
                        '_blank' => __('_blank', 'eva'),  
                    ),
                    'default' => '_self'
                ),   

                array(
                    'id' => 'tdl_footer_social_intro',
                    'icon' => true,
                    'type' => 'info',
                    'style' => 'warning',
                    'raw' => esc_html__('Footer Social Media Icons', 'eva')
                ), 

                array(
                    'title' => esc_html__('Footer Social Media Icons', 'eva'),
                    'id' => 'tdl_footer_social',
                    'on' => esc_html__('Enabled', 'eva'),
                    'off' => esc_html__('Disabled', 'eva'),
                    'type' => 'switch',
                    'default' => 1,
                ),                                                                                           

                array(
                    'id' => 'tdl_copy_intro',
                    'icon' => true,
                    'type' => 'info',
                    'style' => 'warning',
                    'raw' => esc_html__('Footer Copyright', 'eva')
                ),                                                                                           


                array(
                    'subtitle' => esc_html__('Whatever text you enter here will be displayed in your website\'s footer area. The primary purpose of this option is to display your website\'s Copyright text, but you can enter whatever text you like.', 'eva'),
                    'id' => 'tdl_footer_text',
                    'type' => 'textarea',
                    'title' => esc_html__('Footer Copyright Text', 'eva'),
                    'default' => '&copy; 2017 - Eva Woocommerce Theme. Created by <a href=\'http://www.temashdesign.com\'>TemashDesign</a>',
                ),


        )
    ) );

/* ---------------------------------------------------------------- */
/* Custom Code Settings
/* ---------------------------------------------------------------- */


    Redux::setSection( $opt_name, array(
            'title' => esc_html__('Custom Code', 'eva'),
            'icon'   => 'fa fa-code',
            'fields'    => array(

                array(
                    'subtitle' => esc_html__('Paste your custom CSS code here. The code will be added to the header of your site.', 'eva'),
                    'id' => 'tdl_custom_css',
                    'type' => 'ace_editor',
                    'mode' => 'css',
                    'title' => esc_html__('Custom CSS', 'eva'),
                ),

                array(
                    'subtitle' => esc_html__('Here is the place to paste your Google Analytics code or any other JS code you might want to add to be loaded in the footer of your website.', 'eva'),
                    'id' => 'tdl_custom_js_footer',
                    'type' => 'ace_editor',
                    'mode' => 'javascript',
                    'title' => esc_html__('Google Analytics / Footer JavaScript Code', 'eva'),
                ), 

        )
    ) );

    Redux::setSection( $opt_name, array(
            'title' => esc_html__('Theme Documentation', 'eva'),
            'icon'   => 'fa fa-file-text-o',
            'fields'    => array(

            array(
                'id'   => 'info_docs',
                'type' => 'info',
                'style' => 'warning',
                'desc' => __('
                <a href="https://temashdesign.ticksy.com/articles/100007167" target="_blank"><strong>Eva Theme&#39;s Documentation</strong></a></br> Everything you need to know about the theme, from installation and setup to customization.</br></br>
                <a href="http://codex.wordpress.org/Installing_WordPress" target="_blank"><strong>Installing WordPress</strong></a></br> Installing WordPress</br></br>
                <a href="https://www.youtube.com/playlist?list=PLfOXCtnURNbZjLUyU_Isp39VdAjqEctNw" target="_blank"><strong>WordPress for Beginners 2015</strong></a></br> WordPress for Beginners 2015 is a course specifically designed by the great folks from WordPress Informer for those who want to learn WordPress step-by-step, from the very beginning.</br></br>
                <a href="https://docs.woothemes.com/documentation/plugins/woocommerce/" target="_blank"><strong>WooThemes Documentation</strong></a></br> Documentation, Reference Materials, and Tutorials for your WooThemes products</br></br>
                <a href="https://www.youtube.com/watch?v=Cw5vU49ZOWg&list=PLHdG8zvZd0E575Ia8Mu3w1h750YLXNfsC" target="_blank"><strong>WooCommerce Guided Tour</strong></a></br> This series of videos covers anything and everything you&#39;d need to know about installing & setting up WooCommerce.</br></br>', 'eva')
            ),

        )
    ) );

    Redux::setSection( $opt_name, array(
        'id' => 'wbc_importer_section',
        'title'  => esc_html__( 'Demo Importer', 'eva' ),
        'desc'   => __( 'Works best to import on a new install of WordPress. Recommend using the <a href="https://wordpress.org/plugins/wordpress-reset/" target="_blank">WordPress Reset plugin</a> before switching between demos. If the progress bar hangs for quite some time or doesn’t start at all it means that your server PHP memory settings and max execution time are to low to complete the process, <a href="https://temashdesign.ticksy.com/article/9772/">Demo Import Article</a> just need to up your PHP memory limits to at least 512MB via php.ini and increase your max execution time to 40000, your hosting provider can assit with this.<br><br>

            <strong>Steps to take before using this plugin:</strong></br></br>
            1. The import process will work best on a clean install. You can use a plugin such as WordPress Reset to clear your data for you.</br>
            2. Ensure all plugins are installed beforehand, e.g. WooCommerce - any plugins that you add content to.</br>
            3. Once you start the process, please leave it running and uninteruppted.</br>
            4. Run Woocommerce Setup Wizard.</br>
            5. Enjoy</br>', 'eva' ),
        'icon'   => 'fa fa-cloud-download',
        'fields' => array(
            array(
                'id'   => 'wbc_demo_importer',
                'type' => 'wbc_importer'
            )
        )
    ) );


    // Load extensions
    // Redux::setExtensions( $opt_name, EVA_THEME_PATH . '/functions/framework/extensions' );

    //add_filter('redux/options/' . $opt_name . '/compiler', array( $this, 'eva_typography_compiler' ), 10, 3);

    if( ! function_exists( 'eva_typography_compiler' ) ) {
        function eva_typography_compiler($options, $css, $changed_values) {
            echo '<h1>The compiler hook has run!</h1>';
             
            print_r ($options);
            print_r ($css);
            print_r ($changed_values);
        }
    }

    function eva_removeDemoModeLink() { // Be sure to rename this function to something more unique
        if ( class_exists('ReduxFrameworkPlugin') ) {
            remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
        }
        if ( class_exists('ReduxFrameworkPlugin') ) {
            remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
        }
    }
    add_action('init', 'eva_removeDemoModeLink', 1520);

