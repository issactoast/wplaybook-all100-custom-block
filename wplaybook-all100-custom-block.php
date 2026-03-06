<?php
/**
 * Plugin Name:       WPlaybook All100 Custom Block
 * Plugin URI:        https://wplaybook.com
 * Description:       워플 커스텀 블록을 사용해서 반짝이고 예쁜 버튼을 달아보세요. <a href="https://community.wplaybook.com/products/all100-reborn-add-on/" target="_blank">워플 커스텀 블록 구매하기</a>
 * Version:           1.1.0
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

// 깃허브 자동 업데이트 구현 (Plugin Update Checker)
require 'plugin-update-checker/plugin-update-checker.php';
$wplaybook_update_checker = YahnisElsts\PluginUpdateChecker\v5\PucFactory::buildUpdateChecker(
    'https://github.com/issactoast/wplaybook-all100-custom-block/',
    __FILE__,
    'wplaybook-all100-custom-block'
);
// 메인 브랜치 혹은 최신 릴리즈 기준으로 업데이트를 체크합니다.
$wplaybook_update_checker->setBranch('main');

/**
 * Enqueue plugin styles.
 */
function wplaybook_all100_custom_block_enqueue_styles()
{
    wp_enqueue_style(
        'wplaybook-all100-custom-block-style',
        plugin_dir_url(__FILE__) . 'assets/css/wplaybook-all100-custom-block.css',
        array(),
        '1.1.0',
        'all'
    );
}
add_action('wp_enqueue_scripts', 'wplaybook_all100_custom_block_enqueue_styles');
