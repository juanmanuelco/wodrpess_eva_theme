<?php


// -----------------------------------------------------------------------------
// Body Class - No Animation
// -----------------------------------------------------------------------------

function eva_no_animation($classes) {
    $classes[] = 'no-offcanvas-animation';
    return $classes;
}


// -----------------------------------------------------------------------------
// Print Body Classes
// -----------------------------------------------------------------------------
    
function eva_custom_body_classes() {    

    add_filter( 'body_class', 'eva_no_animation' );

}

add_action( 'wp_head', 'eva_custom_body_classes', 100 );