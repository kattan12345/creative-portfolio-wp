<?php
/**
 * Security hardening: version removal, XML-RPC, version query strings, headers.
 *
 * @package Creative_Portfolio
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// -----------------------------------------------------------------------------
// 1. Remove WordPress version from head and feeds
// -----------------------------------------------------------------------------

/**
 * Removes generator meta from wp_head and empty string from the_generator (feeds, etc.).
 */
function creative_portfolio_security_remove_version(): void {
	remove_action( 'wp_head', 'wp_generator' );
	add_filter( 'the_generator', '__return_empty_string' );
}
add_action( 'after_setup_theme', 'creative_portfolio_security_remove_version' );

// -----------------------------------------------------------------------------
// 2. Disable XML-RPC
// -----------------------------------------------------------------------------

/**
 * Disables XML-RPC (pingback, remote publishing).
 */
function creative_portfolio_security_disable_xmlrpc(): void {
	add_filter( 'xmlrpc_enabled', '__return_false' );
}
add_action( 'after_setup_theme', 'creative_portfolio_security_disable_xmlrpc' );

// -----------------------------------------------------------------------------
// 3. Remove version query strings from scripts and styles
// -----------------------------------------------------------------------------

/**
 * Strips version query arg from script URLs.
 *
 * @param string $src    Script src URL.
 * @param string $handle Handle.
 * @return string
 */
function creative_portfolio_security_remove_script_version( string $src, string $handle ): string {
	if ( strpos( $src, 'ver=' ) !== false ) {
		$src = remove_query_arg( 'ver', $src );
	}
	return $src;
}

/**
 * Strips version query arg from stylesheet URLs.
 *
 * @param string $src    Stylesheet src URL.
 * @param string $handle Handle.
 * @return string
 */
function creative_portfolio_security_remove_style_version( string $src, string $handle ): string {
	if ( strpos( $src, 'ver=' ) !== false ) {
		$src = remove_query_arg( 'ver', $src );
	}
	return $src;
}

add_filter( 'script_loader_src', 'creative_portfolio_security_remove_script_version', 15, 2 );
add_filter( 'style_loader_src', 'creative_portfolio_security_remove_style_version', 15, 2 );

// -----------------------------------------------------------------------------
// 4. Security headers
// -----------------------------------------------------------------------------

/**
 * Sends security headers on front end.
 */
function creative_portfolio_security_headers(): void {
	if ( is_admin() ) {
		return;
	}
	header( 'X-Content-Type-Options: nosniff' );
	header( 'X-Frame-Options: SAMEORIGIN' );
	header( 'X-XSS-Protection: 1; mode=block' );
}
add_action( 'send_headers', 'creative_portfolio_security_headers' );
