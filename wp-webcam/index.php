<?php
/*
Plugin Name: webcam upload
Description: Plugin for Upload pics using webcam
Plugin URI: http://cosmowhiz.com/
Author URI: http://cosmowhiz.com/
Author: Rajesh Kumar
License: Public Domain
Version: 0.1
*/
include_once 'include/admin_menu.php';

include_once 'include/webcam_upload.php';


function webcam_js_include() 
{
wp_register_script( 'webcam-script', plugins_url( '/js/webcam.min.js', __FILE__ ), array( 'jquery' ) );
wp_enqueue_script( 'webcam-script' );wp_enqueue_style( 'prefix-style' );
wp_register_style( 'webcam-style', plugins_url('/css/style.css', __FILE__) );
wp_enqueue_style( 'webcam-style' );
}
add_action( 'wp_enqueue_scripts', 'webcam_js_include');

function webcam_activate() {
add_option( 'webcam_image_width', '', '', 'yes' );
add_option( 'webcam_image_height', '', '', 'yes' );
add_option( 'webcam_image_format', '', '', 'yes');
add_option( 'webcam_image_quality', '', '', 'yes');

}
register_activation_hook( __FILE__, 'webcam_activate');
function webcam_settings_link( $links ) {
    $settings_link = '<a href="options-general.php?page=Webcam">' . __( 'Settings' ) . '</a>';
    array_push( $links, $settings_link );
    return $links;
}
$plugin = plugin_basename( __FILE__ );
add_filter( "plugin_action_links_$plugin", 'webcam_settings_link' );
?>