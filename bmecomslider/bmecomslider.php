<?php
/**
 * Plugin Name: BMECOM Slider
 * Description: A responsive banner slider widget for Elementor.
 * Plugin URI:  https://example.com/
 * Version:     1.0.0
 * Author:      Jules
 * Author URI:  https://example.com/
 * Text Domain: bmecomslider
 * Elementor tested up to: 3.22.0
 * Elementor Pro tested up to: 3.22.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Register scripts and styles.
 *
 * @since 1.0.0
 */
function bmecomslider_register_assets() {
    wp_register_style(
        'bmecomslider',
        plugins_url( 'assets/css/bmecomslider.css', __FILE__ )
    );
    wp_register_script(
        'bmecomslider',
        plugins_url( 'assets/js/bmecomslider.js', __FILE__ ),
        [],
        '1.0.0',
        true
    );
}
add_action( 'wp_enqueue_scripts', 'bmecomslider_register_assets' );

/**
 * Register the widget.
 *
 * @since 1.0.0
 *
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 *
 * @return void
 */
function register_bmecom_slider_widget( $widgets_manager ) {

    require_once( __DIR__ . '/includes/class-bmecomslider-widget.php' );

    $widgets_manager->register( new \BMECOM_Slider_Widget() );

}
add_action( 'elementor/widgets/register', 'register_bmecom_slider_widget' );
