<?php
/**
 * Plugin Name:       WPlaybook All100 Custom Block
 * Plugin URI:        https://wplaybook.com
 * Description:       Adds a beautiful shimmer effect to buttons with the 'wplaybook-button' class.
 * Version:           1.0.0
 * Author:            WPlaybook
 * Author URI:        https://wplaybook.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wplaybook-all100-custom-block
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue plugin styles.
 */
function wplaybook_all100_custom_block_enqueue_styles()
{
    wp_enqueue_style(
        'wplaybook-all100-custom-block-style',
        plugin_dir_url(__FILE__) . 'assets/css/wplaybook-all100-custom-block.css',
        array(),
        '1.0.0',
        'all'
    );
}
add_action('wp_enqueue_scripts', 'wplaybook_all100_custom_block_enqueue_styles');
