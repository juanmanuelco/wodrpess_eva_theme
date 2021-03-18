<?php
/**
 * Load and register widgets
 *
 * @package Eva
 */

require_once( EVA_INCLUDES . '/widgets/woo-attributes-filter.php' );



/**
 * Register widgets
 *
 * @since  1.0
 *
 * @return void
 */


function eva_register_widgets() {
	if ( class_exists( 'WC_Widget' ) ) {
		register_widget( 'Eva_Widget_Attributes_Filter' );
	}

}

add_action( 'widgets_init', 'eva_register_widgets' );