<?php
define( 'ABSPATH', __DIR__ );
$enabled = true;
$front = true;
$admin = false;
function add_action( $hook, $callback, $priority = 10, $args = 1 ) {}
function add_filter( $hook, $callback, $priority = 10, $args = 1 ) {}
function get_option( $key, $default = false ) { global $enabled; return $enabled; }
function is_admin() { global $admin; return $admin; }
function is_front_page() { global $front; return $front; }
function wp_strip_all_tags( $text ) { return strip_tags( $text ); }
function esc_attr( $text ) { return htmlspecialchars( $text, ENT_QUOTES, 'UTF-8' ); }
function esc_url( $text ) { return htmlspecialchars( $text, ENT_QUOTES, 'UTF-8' ); }
require __DIR__ . '/../assets/home-about.php';
function verify( $condition, $message ) {
    if ( ! $condition ) { fwrite( STDERR, $message . "\n" ); exit( 1 ); }
}
$original = file_get_contents( __DIR__ . '/fixtures/home-about-original.html' );
$rendered = mtt_vina_about_render( $original, 'section', array(), array() );
verify( $rendered !== $original && strpos( $rendered, 'class="mtt-vina-about"' ) !== false, 'Verified section must render approved design' );
foreach ( array( 'Chính xác', 'Nhanh chóng', '25 năm', 'Toàn diện', 'Jig &amp; Fixture', 'Thiết kế theo yêu cầu – Chú trọng chất lượng – Đồng hành cùng khách hàng.' ) as $text ) {
    verify( strpos( $rendered, $text ) !== false, 'Missing approved text: ' . $text );
}
preg_match( '/srcset="([^"]+)"/', $original, $old_srcset );
verify( strpos( $rendered, $old_srcset[0] ) !== false, 'Preserve responsive original image' );
preg_match( '/<a[^>]+href="([^"]+)"/', $original, $old_href );
verify( strpos( $rendered, 'href="' . $old_href[1] . '"' ) !== false, 'Preserve CTA destination' );
preg_match( '/<section[^>]+id="([^"]+)"/', $original, $old_id );
verify( strpos( $rendered, 'id="' . $old_id[1] . '"' ) !== false, 'Preserve section ID' );
$enabled = false;
verify( mtt_vina_about_render( $original, 'section', array(), array() ) === $original, 'OFF must return original byte-for-byte' );
$enabled = true;
$front = false;
verify( mtt_vina_about_render( $original, 'section', array(), array() ) === $original, 'Other pages unchanged' );
$front = true;
$admin = true;
verify( mtt_vina_about_render( $original, 'section', array(), array() ) === $original, 'Admin unchanged' );
$admin = false;
verify( mtt_vina_about_render( $original, 'ux_slider', array(), array() ) === $original, 'Hero unchanged' );
foreach ( array(
    str_replace( 'FDI', 'NỘI DUNG MỚI', $original ),
    str_replace( 'z6800707862036_', 'new-photo_', $original ),
    str_replace( '</section>', '<p>New important content</p></section>', $original ),
    '<section>' . $original . '</section>',
    $rendered,
) as $changed ) {
    verify( mtt_vina_about_render( $changed, 'section', array(), array() ) === $changed, 'Unrecognized/new content must remain untouched' );
}
if ( isset( $argv[1] ) ) { file_put_contents( $argv[1], $rendered ); }
echo "PASS: approved content, original image/link/ID, exact rollback, scope and changed-source safeguards\n";
