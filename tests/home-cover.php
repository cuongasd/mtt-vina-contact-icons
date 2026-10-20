<?php
define( 'ABSPATH', __DIR__ );
$state = array( 'admin' => false, 'front' => true, 'main' => true, 'loop' => true, 'enabled' => true );
function add_action() {}
function add_filter() {}
function is_admin() { global $state; return $state['admin']; }
function is_front_page() { global $state; return $state['front']; }
function is_main_query() { global $state; return $state['main']; }
function in_the_loop() { global $state; return $state['loop']; }
function get_option( $key, $default ) { global $state; return $state['enabled']; }
function plugin_dir_url( $file ) { return 'https://example.org/plugin/assets/'; }
function esc_url( $value ) { return $value; }
require __DIR__ . '/../assets/home-cover.php';
function verify( $condition, $message ) {
    if ( ! $condition ) { fwrite( STDERR, $message . "\n" ); exit( 1 ); }
}
$match = array( 5 => 'GIẢI PHÁP CƠ KHÍ &amp; THIẾT BỊ NHÀ MÁY ĐỒ GÁ JIG' );
function render_cover( $match ) { return mtt_vina_home_cover_shortcode( false, 'ux_slider', array(), $match ); }
$original = $match;
verify( false !== strpos( render_cover( $match ), 'home-cover-6-years.gif' ), 'Hero must render GIF' );
verify( $match === $original, 'Source must remain unchanged' );
verify( false === render_cover( array( 5 => 'Products' ) ), 'Other sliders must remain unchanged' );
verify( 'existing' === mtt_vina_home_cover_shortcode( 'existing', 'ux_slider', array(), $match ), 'Respect prior filter' );
foreach ( array( 'front', 'main', 'loop', 'enabled' ) as $key ) {
    $state[$key] = false;
    verify( false === render_cover( $match ), 'Must preserve original when ' . $key . ' is disabled' );
    $state[$key] = true;
}
$state['admin'] = true;
verify( false === render_cover( $match ), 'Editor must retain original slider' );
echo "PASS: hero replacement, rollback, original data, other sliders, admin and page scope\n";
