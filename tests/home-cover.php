<?php
// Boot the released plugin with a previously enabled cover option.
define( 'ABSPATH', __DIR__ );
$hooks = array();
function add_action( $hook, $callback ) { global $hooks; $hooks[] = $hook; }
function add_filter( $hook, $callback ) { global $hooks; $hooks[] = $hook; }
function get_option( $key, $default = false ) { return true; }
require __DIR__ . '/../mtt-vina-contact-icons.php';
if ( in_array( 'pre_do_shortcode_tag', $hooks, true ) || in_array( 'admin_menu', $hooks, true ) || function_exists( 'mtt_vina_home_cover_shortcode' ) ) {
    fwrite( STDERR, "Cover override must not load even with saved enabled option\n" ); exit( 1 );
}
if ( ! in_array( 'wp_enqueue_scripts', $hooks, true ) || ! in_array( 'plugins_loaded', $hooks, true ) ) {
    fwrite( STDERR, "Contact icons and updater must remain registered\n" ); exit( 1 );
}
echo "PASS: original cover restored, stale option ignored, icons and updater preserved\n";
