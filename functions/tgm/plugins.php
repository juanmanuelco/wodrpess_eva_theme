<?php

add_action( 'tgmpa_register', 'eva_theme_register_required_plugins' );
function eva_theme_register_required_plugins() {
    
    $plugins = array(

        //from WP repository


            array(
                'name'      => 'Redux Framework',
                'slug'      => 'redux-framework',
                'required'  => true,
            ),
            array(
                'name'      => 'Advanced Custom Fields',
                'slug'      => 'advanced-custom-fields',
                'required'  => true,
            ),

            array(
                'name'      => 'WooCommerce',
                'slug'      => 'woocommerce',
                'required'  => false,
            ),

            array(
                'name'      => 'Wishlist',
                'slug'      => 'yith-woocommerce-wishlist',
                'required'  => false,
            ),

            array(
                'name'      => 'Breadcrumb NavXT',
                'slug'      => 'breadcrumb-navxt',
                'required'  => false,
            ),

            array(
                'name'      => 'Contact Form 7',
                'slug'      => 'contact-form-7',
                'required'  => false,
            ),

            array(
                'name'      => 'WP Instagram Widget',
                'slug'      => 'wp-instagram-widget',
                'required'  => false,
            ),

        // delivered with the theme

        array(
            'name'                  => 'Eva Theme Extensions', // The plugin name
            'slug'                  => 'tdl-extensions', // The plugin slug (typically the folder name)
            'source'                => 'http://temashdesign.com/themeforest/eva_plugins/1.1/tdl-extensions.zip', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '1.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),

        array(
            'name'                  => 'WPBakery Visual Composer', // The plugin name
            'slug'                  => 'js_composer', // The plugin slug (typically the folder name)
            'source'                => 'http://temashdesign.com/themeforest/eva_plugins/js_composer.zip', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '5.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),


        array(
            'name'                  => 'Slider Revolution', // The plugin name
            'slug'                  => 'revslider', // The plugin slug (typically the folder name)
            'source'                => 'http://temashdesign.com/themeforest/eva_plugins/revslider.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '5.4.5.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),

        array(
            'name'                  => 'Woo Search Box', // The plugin name
            'slug'                  => 'woo-search-box', // The plugin slug (typically the folder name)
            'source'                => 'http://temashdesign.com/themeforest/eva_plugins/1.0.3/woo-search-box.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '1.6.4', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),

        array(
            'name'                  => 'Envato Market', // The plugin name
            'slug'                  => 'envato-market', // The plugin slug (typically the folder name)
            'source'                => 'http://temashdesign.com/themeforest/eva_plugins/envato-market.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '1.0.0-RC2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),

    );

    $config = array(
        'domain'       => 'eva',          // Text domain - likely want to be the same as your theme.
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => esc_html__( 'Install Required Plugins', 'eva' ),
            'menu_title'                      => esc_html__( 'Install Plugins', 'eva' ),
            'installing'                      => esc_html__( 'Installing Plugin: %s', 'eva' ), // %s = plugin name.
            'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'eva' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'eva' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'eva' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'eva' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'eva' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'eva' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'eva' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'eva' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'eva' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'eva' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'eva' ),
            'return'                          => esc_html__( 'Return to Required Plugins Installer', 'eva' ),
            'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'eva' ),
            'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'eva' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );

}

?>