<?php
/**
 * Plugin Name:       WPlaybook Shimmer Button
 * Plugin URI:        https://wplaybook.com
 * Description:       Adds a beautiful shimmer effect to buttons with the 'wplaybook-button' class.
 * Version:           1.0.0
 * Author:            WPlaybook
 * Author URI:        https://wplaybook.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wplaybook-shimmer-button
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Enqueue plugin styles.
 */
function wplaybook_shimmer_button_enqueue_styles() {
    wp_enqueue_style(
        'wplaybook-shimmer-button-style',
        plugin_dir_url( __FILE__ ) . 'assets/css/wplaybook-shimmer-button.css',
        array(),
        '1.0.0',
        'all'
    );
}
add_action( 'wp_enqueue_scripts', 'wplaybook_shimmer_button_enqueue_styles' );
