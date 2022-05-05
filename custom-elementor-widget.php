<?php
/**
 * Plugin Name: Custom Elementor Widgets
 * Description: Elementor custom widgets
 * Plugin URI:  https://letsgetdaniel.com
 * Version:     1.0.0
 * Author:      Daniel Singian
 * Author URI:  https://letsgetdaniel.com
 * Text Domain: custom-elementor-widget
 * 
 * Elementor tested up to: 3.5.0
 * Elementor Pro tested up to: 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Register Blurb Widget.
 *
 * Include widget file and register widget class.
 *
 * @since 1.0.0
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 * @return void
 */
function register_blurb_widget( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/blurb-widget.php' );

	$widgets_manager->register( new \Elementor_Blurb_Widget() );

}
add_action( 'elementor/widgets/register', 'register_blurb_widget' );