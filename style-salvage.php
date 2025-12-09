<?php
/**
 * Plugin Name: Tomatillo Design Style Salvage 2025
 * Plugin URI: https://tomatillodesign.com
 * Description: Restores and replaces lost stylesheets that broke in WordPress 6.9. Attempts to re-enqueue original stylesheets with fallback to replacement CSS.
 * Version: 1.0.0
 * Author: Tomatillo Design
 * Author URI: https://tomatillodesign.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: tomatillo-style-salvage
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define plugin constants
define( 'TDSS_VERSION', '1.0.0' );
define( 'TDSS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'TDSS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * Configuration array for stylesheets to restore
 * 
 * Add your broken/missing stylesheets here. Each entry should have:
 * - handle: The stylesheet handle (required)
 * - src: The original stylesheet path/URL (required)
 * - version: Stylesheet version number (optional, defaults to plugin version)
 * - deps: Array of dependencies (optional, defaults to empty array)
 * - media: Media type (optional, defaults to 'all')
 */
function tdss_get_stylesheets_to_restore() {
	return apply_filters( 'tdss_stylesheets_to_restore', array(
		// Example configuration (uncomment and modify as needed):
		/*
		array(
			'handle' => 'my-old-stylesheet',
			'src'    => get_template_directory_uri() . '/css/old-styles.css',
			'version' => '1.0.0',
			'deps'   => array(),
			'media'  => 'all',
		),
		*/
	) );
}

/**
 * Attempt to restore missing stylesheets
 */
function tdss_restore_stylesheets() {
	$stylesheets = tdss_get_stylesheets_to_restore();
	
	if ( empty( $stylesheets ) ) {
		return;
	}
	
	foreach ( $stylesheets as $stylesheet ) {
		// Validate required fields
		if ( empty( $stylesheet['handle'] ) || empty( $stylesheet['src'] ) ) {
			continue;
		}
		
		// Set defaults
		$handle  = $stylesheet['handle'];
		$src     = $stylesheet['src'];
		$version = isset( $stylesheet['version'] ) ? $stylesheet['version'] : TDSS_VERSION;
		$deps    = isset( $stylesheet['deps'] ) ? $stylesheet['deps'] : array();
		$media   = isset( $stylesheet['media'] ) ? $stylesheet['media'] : 'all';
		
		// Check if stylesheet is already enqueued
		if ( ! wp_style_is( $handle, 'enqueued' ) && ! wp_style_is( $handle, 'registered' ) ) {
			// Attempt to enqueue the original stylesheet
			wp_enqueue_style( $handle, $src, $deps, $version, $media );
		} elseif ( wp_style_is( $handle, 'registered' ) && ! wp_style_is( $handle, 'enqueued' ) ) {
			// If registered but not enqueued, enqueue it
			wp_enqueue_style( $handle );
		}
	}
}

/**
 * Enqueue fallback replacement CSS
 */
function tdss_enqueue_fallback_css() {
	// Enqueue the replacement CSS file as fallback
	wp_enqueue_style(
		'tomatillo-style-salvage',
		TDSS_PLUGIN_URL . 'assets/css/style-salvage.css',
		array(),
		TDSS_VERSION,
		'all'
	);
}

/**
 * Hook into WordPress enqueue system for frontend
 */
function tdss_enqueue_scripts() {
	// First, attempt to restore original stylesheets
	tdss_restore_stylesheets();
	
	// Then, enqueue fallback CSS (will load regardless, but can be used as replacement)
	tdss_enqueue_fallback_css();
}
add_action( 'wp_enqueue_scripts', 'tdss_enqueue_scripts', 99 ); // Priority 99 to run after most other enqueues

/**
 * Enqueue in block editor (Gutenberg)
 */
function tdss_enqueue_block_editor_assets() {
	// Attempt to restore original stylesheets
	tdss_restore_stylesheets();
	
	// Enqueue fallback CSS for block editor
	tdss_enqueue_fallback_css();
}
add_action( 'enqueue_block_editor_assets', 'tdss_enqueue_block_editor_assets', 99 );

/**
 * Enqueue in admin area (for other admin pages if needed)
 */
function tdss_admin_enqueue_scripts() {
	tdss_restore_stylesheets();
	tdss_enqueue_fallback_css();
}
add_action( 'admin_enqueue_scripts', 'tdss_admin_enqueue_scripts', 99 );







/**
 * Force-load Genesis Blocks global stylesheet on the front end.
 *
 * This assumes the Genesis plugin lives in:
 * wp-content/plugins/genesis-page-builder
 */
function td_force_genesis_blocks_styles() {

        // Front-end only (remove this guard if you also want it in the editor).
        if ( is_admin() ) {
                return;
        }

        // Absolute path to the compiled Genesis Blocks CSS.
        $genesis_style_path = WP_PLUGIN_DIR . '/genesis-page-builder/lib/genesis-blocks/dist/blocks.style.build.css';

        // Bail if the Genesis plugin (or its dist CSS) isn't actually there.
        if ( ! file_exists( $genesis_style_path ) ) {
                return;
        }

        // URL for that CSS file.
        $genesis_style_url = WP_PLUGIN_URL . '/genesis-page-builder/lib/genesis-blocks/dist/blocks.style.build.css';

        // If Genesis already registered the handle, just enqueue it.
        if ( wp_style_is( 'genesis-blocks-style-css', 'registered' ) || wp_style_is( 'genesis-blocks-style-css', 'enqueued' ) ) {
                wp_enqueue_style( 'genesis-blocks-style-css' );
                return;
        }

        // Otherwise, register + enqueue it ourselves.
        wp_register_style(
                'genesis-blocks-style-css',
                $genesis_style_url,
                array(),
                filemtime( $genesis_style_path ) // cache-busting version
        );

        wp_enqueue_style( 'genesis-blocks-style-css' );
}
add_action( 'wp_enqueue_scripts', 'td_force_genesis_blocks_styles', 20 );
