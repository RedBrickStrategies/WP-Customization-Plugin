<?php

/*
    Plugin Name: WP Customization Plugin
    Plugin URI:  http://redbrickstrategies.com/
    Description: Adds custom JS and CSS files to site, without having to edit theme.
    Version:     1.0.2
    Author:      Bradford Knowlton
    Author URI:  http://bradknowlton.com
    GitHub Plugin URI: https://github.com/RedBrickStrategies/WP-Customization-Plugin
*/

define( 'WCP_PLUGIN_VERSION', '1.0.2');

/**
 * Enqueue scripts
 *
 * @param string $handle Script name
 * @param string $src Script url
 * @param array $deps (optional) Array of script names on which this script depends
 * @param string|bool $ver (optional) Script version (used for cache busting), set to null to disable
 * @param bool $in_footer (optional) Whether to enqueue the script before </head> or before </body>
 */
function wcp_frontend_enqueue_scripts() {
    wp_enqueue_script( 'wcp-scripts', plugins_url( '/js/scripts.js' , __FILE__ ), array(), WCP_PLUGIN_VERSION, false);
    wp_enqueue_style( 'wcp-styles', plugins_url( '/css/styles.css' , __FILE__ ), array(), WCP_PLUGIN_VERSION );
    // Localize the script with new data
    /*
    $translation_array = array(
        'New_Friend_Added' => __( 'New Friend Added', 'wcp' ),
    );
    wp_localize_script( 'wcp-scripts-localize', 'wcp_strings', $translation_array );
    wp_enqueue_script( 'wcp-scripts-localize' );
    */
}

add_action( 'wp_enqueue_scripts', 'wcp_frontend_enqueue_scripts', 999 );    

add_filter( 'body_class','my_body_classes' );
function my_body_classes( $classes ) {
    global $page;
    $body_class =  get_post_meta(get_the_ID(), 'body-class', true);
    
        $classes[] = $body_class;
     
    return $classes;
     
}