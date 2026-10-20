<?php
/**
 * Plugin Name: MTT VINA Contact Icons
 * Description: Hien thi icon cho hai nut lien he hien co, giu nguyen duong dan.
 * Version: 1.1.0
 * Requires at least: 5.0
 * Requires PHP: 7.2
 * Author: MTT VINA
 * License: GPL-2.0-or-later
 * Update URI: https://github.com/cuongasd/mtt-vina-contact-icons
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
define( 'MTT_VINA_CONTACT_ICONS_VERSION', '1.1.0' );
function mtt_vina_contact_icons_enqueue() {
    if ( is_admin() ) { return; }
    $base = plugin_dir_url( __FILE__ );
    wp_enqueue_style( 'mtt-vina-contact-icons', $base . 'assets/contact-icons.css', array(), MTT_VINA_CONTACT_ICONS_VERSION );
    wp_enqueue_script( 'mtt-vina-contact-icons', $base . 'assets/contact-icons.js', array(), MTT_VINA_CONTACT_ICONS_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'mtt_vina_contact_icons_enqueue' );

// Initialize for both dashboard and cron. Never fall back to an unreleased branch/tag.
function mtt_vina_contact_icons_init_updater() {
    require_once __DIR__ . '/lib/plugin-update-checker/plugin-update-checker.php';
    $checker = \YahnisElsts\PluginUpdateChecker\v5p7\PucFactory::buildUpdateChecker(
        'https://github.com/cuongasd/mtt-vina-contact-icons/',
        __FILE__,
        'mtt-vina-contact-icons'
    );
    $checker->setBranch( 'main' );
    add_filter( $checker->getUniqueName( 'vcs_update_detection_strategies' ), 'mtt_vina_contact_icons_release_only' );
    $checker->getVcsApi()->enableReleaseAssets(
        '/^mtt-vina-contact-icons-[0-9]+\.[0-9]+\.[0-9]+\.zip$/',
        \YahnisElsts\PluginUpdateChecker\v5p7\Vcs\Api::REQUIRE_RELEASE_ASSETS
    );
}
function mtt_vina_contact_icons_release_only( $strategies ) {
    return isset( $strategies['latest_release'] ) ? array( 'latest_release' => $strategies['latest_release'] ) : array();
}
add_action( 'plugins_loaded', 'mtt_vina_contact_icons_init_updater' );
