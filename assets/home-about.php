<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

function mtt_vina_about_enabled() {
    return (bool) get_option( 'mtt_vina_about_enabled', true );
}

function mtt_vina_about_enqueue() {
    if ( is_admin() || ! is_front_page() || ! mtt_vina_about_enabled() ) { return; }
    $base = plugin_dir_url( __FILE__ );
    wp_enqueue_style( 'mtt-vina-home-about', $base . 'home-about.css', array( 'flatsome-main' ), MTT_VINA_CONTACT_ICONS_VERSION );
    wp_enqueue_script( 'mtt-vina-home-about', $base . 'home-about.js', array(), MTT_VINA_CONTACT_ICONS_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'mtt_vina_about_enqueue', 30 );

function mtt_vina_about_normalize( $html ) {
    $html = preg_replace( '#<(style|script)\b[^>]*>.*?</\1>#is', '', $html );
    return trim( preg_replace( '/\s+/u', ' ', html_entity_decode( wp_strip_all_tags( $html ), ENT_QUOTES, 'UTF-8' ) ) );
}

// Only replace the verified, isolated Flatsome section at render time.
// The original page content stays in WordPress, so disabling is a true rollback.
function mtt_vina_about_render( $output, $tag, $attr, $match ) {
    if ( 'section' !== $tag || is_admin() || ! is_front_page() || ! mtt_vina_about_enabled() ) { return $output; }
    if ( strpos( $output, 'mtt-vina-about' ) !== false || substr_count( $output, '<section' ) !== 1 ) { return $output; }
    $expected = 'MTT VINA – ĐỐI TÁC CƠ KHÍ CHO NHÀ MÁY SẢN XUẤT MTT Vina Hà Nội chuyên thiết kế, gia công và cung cấp các giải pháp cơ khí, thiết bị phụ trợ cho nhà máy sản xuất, đặc biệt là các doanh nghiệp FDI tại Việt Nam. Với kinh nghiệm trong lĩnh vực cơ khí và tự động hóa công nghiệp, MTT cung cấp các sản phẩm như Jig & Fixture, băng tải, bàn thao tác, giá kệ, thiết bị dây chuyền và gia công cơ khí chính xác theo yêu cầu. Thiết kế theo yêu cầu – Chú trọng chất lượng – Đồng hành cùng khách hàng. KHÁM PHÁ NĂNG LỰC MTT';
    if ( mtt_vina_about_normalize( $output ) !== $expected ) { return $output; }
    if ( ! preg_match_all( '#<img\b[^>]*>#i', $output, $images ) || count( $images[0] ) !== 1 ) { return $output; }
    $image = $images[0][0];
    if ( strpos( $image, '/2022/03/z6800707862036_3bbc6cf5d14380004bf22e4eec35d367-1024x768.jpg' ) === false ) { return $output; }
    if ( ! preg_match( '#<a\b[^>]*href=["\']([^"\']+)["\'][^>]*>#i', $output, $link ) ) { return $output; }
    if ( ! preg_match( '#<section\b[^>]*id=["\']([^"\']+)["\']#i', $output, $section ) ) { return $output; }
    $image = preg_replace( '/\balt=(["\'])\1/i', 'alt="Máy gia công và khu vực làm việc trong nhà xưởng MTT VINA"', $image );
    ob_start();
    include __DIR__ . '/home-about-template.php';
    return ob_get_clean();
}
add_filter( 'do_shortcode_tag', 'mtt_vina_about_render', 20, 4 );

function mtt_vina_about_admin_menu() {
    add_options_page( 'MTT Giới thiệu trang chủ', 'MTT Giới thiệu trang chủ', 'manage_options', 'mtt-vina-about', 'mtt_vina_about_settings_page' );
}
add_action( 'admin_menu', 'mtt_vina_about_admin_menu' );

function mtt_vina_about_register_setting() {
    register_setting( 'mtt_vina_about', 'mtt_vina_about_enabled', array(
        'type' => 'boolean', 'default' => true, 'sanitize_callback' => 'rest_sanitize_boolean',
    ) );
}
add_action( 'admin_init', 'mtt_vina_about_register_setting' );

function mtt_vina_about_settings_page() {
    if ( ! current_user_can( 'manage_options' ) ) { return; }
    ?>
    <div class="wrap">
        <h1>MTT Giới thiệu trang chủ — bản test</h1>
        <p>Thiết kế hai cột, bốn thế mạnh và ảnh nhà xưởng hiện tại. Nội dung gốc trong UX Builder được giữ nguyên.</p>
        <form action="options.php" method="post">
            <?php settings_fields( 'mtt_vina_about' ); ?>
            <input type="hidden" name="mtt_vina_about_enabled" value="0">
            <label><input type="checkbox" name="mtt_vina_about_enabled" value="1" <?php checked( mtt_vina_about_enabled() ); ?>> Bật thiết kế Giới thiệu mới trên trang chủ</label>
            <?php submit_button( 'Lưu thay đổi' ); ?>
        </form>
        <p><strong>Quay về giao diện ban đầu:</strong> bỏ chọn ô trên, lưu và xóa cache trang chủ nếu website có cache. Không cần tắt toàn bộ plugin.</p>
        <p>Công tắc chỉ áp dụng cho khối Giới thiệu. URL, thiết lập SEO, cover và nút liên hệ không thay đổi.</p>
    </div>
    <?php
}
