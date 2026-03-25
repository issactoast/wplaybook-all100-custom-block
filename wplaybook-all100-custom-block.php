<?php
/**
 * Plugin Name:       WPlaybook All100 Custom Block
 * Plugin URI:        https://wplaybook.com
 * Description:       <a href="https://community.wplaybook.com/products/all100-reborn-add-on/" target="_blank">워플 커스텀 블록</a>을 사용해서 반짝이고 예쁜 버튼을 달아보세요.
 * Version:           1.2.1
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
        '1.2.1',
        'all'
    );
}
add_action('wp_enqueue_scripts', 'wplaybook_all100_custom_block_enqueue_styles');

// 커스텀 별점 숏코드 생성 [stars score="4.8"]
function custom_star_rating_shortcode($atts) {
    // 숏코드 기본 설정값
    $atts = shortcode_atts(array(
        'score'     => '5',        // 기본 별점
        'max'       => '5',        // 최대 별점 개수
        'size'      => '20px',     // 별 크기 (기본 20px로 확대)
        'font_size' => '20px',     // 글자 크기 (기본 18px로 확대)
        'color'     => '#f59e0b',  // 채워진 별 색상
        'empty'     => '#e2e8f0',  // 빈 별 색상
        'text'      => 'true'      // 숫자를 별 옆에 표시할지 여부
    ), $atts);

    $score = floatval($atts['score']);
    $max = intval($atts['max']);
    $size = esc_attr($atts['size']);
    $font_size = esc_attr($atts['font_size']);
    $color = esc_attr($atts['color']);
    $empty = esc_attr($atts['empty']);
    $show_text = filter_var($atts['text'], FILTER_VALIDATE_BOOLEAN);

    // 점수를 0~최대값 사이로 제한하고 퍼센트(%) 계산
    $score = max(0, min($max, $score));
    $percent = ($score / $max) * 100;

    // SVG 별 모양 아이콘 코드
    $star_svg = '<svg viewBox="0 0 24 24" width="' . $size . '" height="' . $size . '" xmlns="http://www.w3.org/2000/svg"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>';

    // 빈 별 5개 생성
    $empty_stars = str_repeat('<span style="color:' . $empty . '; fill:currentColor; display:inline-block; line-height:0;">' . $star_svg . '</span>', $max);
    
    // 채워진 별 5개 생성
    $filled_stars = str_repeat('<span style="color:' . $color . '; fill:currentColor; display:inline-block; line-height:0;">' . $star_svg . '</span>', $max);

    // HTML 출력 (인라인 플렉스로 글씨와 나란히 배치)
    $html = '<span class="custom-star-rating" style="display:inline-flex; align-items:center; gap:6px; vertical-align:middle; line-height:1;">';
    
    // 1. '평점: 숫자' 텍스트 (font_size 독립 적용)
    if ($show_text) {
        $html .= '<span style="font-weight:700; font-size:' . $font_size . '; color:#111827;">평점: ' . $score . '</span>';
    }

    // 2. 별 레이어 겹치기 (점수 뒤에 배치)
    $html .= '<span style="position:relative; display:inline-flex; width:calc(' . $size . ' * ' . $max . '); height:' . $size . ';">';
    // 배경: 빈 별 (회색)
    $html .= '<span style="position:absolute; top:0; left:0; display:flex; width:100%;">' . $empty_stars . '</span>';
    // 전경: 채워진 별 (점수 퍼센트만큼만 잘라서 보여줌)
    $html .= '<span style="position:absolute; top:0; left:0; display:flex; overflow:hidden; width:' . $percent . '%;">' . $filled_stars . '</span>';
    $html .= '</span>';
    
    $html .= '</span>';

    return $html;
}
add_shortcode('stars', 'custom_star_rating_shortcode');

// 마지막 가격 확인 날짜 숏코드 [price_check]
function custom_last_price_check_shortcode() {
    // 현재 글의 마지막 수정 날짜와 시간 가져오기 (형식: YYYY-MM-DD HH시 mm분)
    $modified_date = get_the_modified_date('Y-m-d H시 i분');
    
    // 텍스트 반환
    return '마지막 가격 확인: ' . $modified_date;
}
add_shortcode('price_check', 'custom_last_price_check_shortcode');
