<?php
/**
 * Temporary homepage cover. Original UX Builder content is never written.
 * Set the default below to false in a NEW release to roll back via GitHub.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
define( 'MTT_VINA_HOME_COVER_DEFAULT', true );

function mtt_vina_home_cover_enabled() {
    return (bool) get_option( 'mtt_vina_home_cover_enabled', MTT_VINA_HOME_COVER_DEFAULT );
}

function mtt_vina_home_cover_shortcode( $output, $tag, $attr, $match ) {
    if ( false !== $output || 'ux_slider' !== $tag || is_admin() ||
        ! is_front_page() || ! is_main_query() || ! in_the_loop() ||
        ! mtt_vina_home_cover_enabled() ) {
        return $output;
    }
    // Match this hero only; never replace product sliders or unrelated carousels.
    if ( empty( $match[5] ) || false === strpos( $match[5], 'GIẢI PHÁP CƠ KHÍ' ) ||
        false === strpos( $match[5], 'ĐỒ GÁ JIG' ) ) {
        return $output;
    }
    $src = plugin_dir_url( __FILE__ ) . 'home-cover-6-years.gif';
    return '<div class="mtt-home-cover-test" style="width:100%;margin:0 auto 30px;">'
        . '<img src="' . esc_url( $src ) . '" width="600" height="200" '
        . 'alt="MTT VINA Hà Nội — 6 năm đồng hành và phát triển. Tận tâm hợp tác — Vững bền niềm tin." '
        . 'loading="eager" fetchpriority="high" style="display:block;width:100%;height:auto;max-width:100%;aspect-ratio:3/1;">'
        . '</div>';
}
add_filter( 'pre_do_shortcode_tag', 'mtt_vina_home_cover_shortcode', 10, 4 );

function mtt_vina_home_cover_register() {
    register_setting( 'mtt_vina_home_cover', 'mtt_vina_home_cover_enabled', array(
        'type' => 'boolean',
        'sanitize_callback' => 'rest_sanitize_boolean',
        'default' => MTT_VINA_HOME_COVER_DEFAULT,
    ) );
}
add_action( 'admin_init', 'mtt_vina_home_cover_register' );

function mtt_vina_home_cover_menu() {
    add_options_page( 'MTT Cover trang chủ', 'MTT Cover trang chủ', 'manage_options', 'mtt-home-cover', 'mtt_vina_home_cover_settings' );
}
add_action( 'admin_menu', 'mtt_vina_home_cover_menu' );

function mtt_vina_home_cover_settings() {
    if ( ! current_user_can( 'manage_options' ) ) { return; }
    echo '<div class="wrap"><h1>MTT — Test cover trang chủ</h1>';
    echo '<p>Bỏ chọn để khôi phục nguyên slider cũ. Nội dung UX Builder và ảnh gốc luôn được giữ nguyên. Sau khi lưu, xóa cache website nếu có.</p>';
    echo '<form method="post" action="options.php">';
    settings_fields( 'mtt_vina_home_cover' );
    echo '<input type="hidden" name="mtt_vina_home_cover_enabled" value="0">';
    echo '<label><input type="checkbox" name="mtt_vina_home_cover_enabled" value="1" '
        . checked( mtt_vina_home_cover_enabled(), true, false )
        . '> Bật cover GIF sinh nhật 6 năm</label>';
    submit_button();
    echo '</form></div>';
}
