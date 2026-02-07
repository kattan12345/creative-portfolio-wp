<?php
/**
 * Basic SEO: meta description, Open Graph, Twitter Card.
 *
 * @package Creative_Portfolio
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Max length for meta description (chars). */
const CREATIVE_PORTFOLIO_META_DESC_LENGTH = 160;

/**
 * Truncates string to length, breaking at word boundary.
 *
 * @param string $text   Input text.
 * @param int    $length Max length in characters.
 * @return string
 */
function creative_portfolio_truncate_meta( string $text, int $length = CREATIVE_PORTFOLIO_META_DESC_LENGTH ): string {
	$text = wp_strip_all_tags( $text );
	$text = preg_replace( '/\s+/', ' ', $text );
	$text = trim( $text );
	if ( mb_strlen( $text ) <= $length ) {
		return $text;
	}
	$cut = mb_substr( $text, 0, $length + 1 );
	$last = mb_strrpos( $cut, ' ' );
	if ( false !== $last ) {
		return mb_substr( $text, 0, $last );
	}
	return mb_substr( $text, 0, $length );
}

/**
 * Returns meta description for current context.
 *
 * @return string
 */
function creative_portfolio_get_meta_description(): string {
	if ( is_front_page() ) {
		$desc = get_bloginfo( 'description' );
	} elseif ( is_singular() ) {
		$desc = has_excerpt() ? get_the_excerpt() : wp_trim_words( get_the_content(), 25 );
	} else {
		$desc = get_bloginfo( 'description' );
	}
	return creative_portfolio_truncate_meta( $desc, CREATIVE_PORTFOLIO_META_DESC_LENGTH );
}

/**
 * Returns OG/Twitter image URL: featured image, then custom logo, then empty.
 *
 * @return string URL or empty.
 */
function creative_portfolio_seo_image_url(): string {
	if ( is_singular() && has_post_thumbnail() ) {
		$id = get_post_thumbnail_id();
		$url = wp_get_attachment_image_url( $id, 'hero-image' );
		if ( $url ) {
			return $url;
		}
	}
	$logo_id = get_theme_mod( 'custom_logo' );
	if ( $logo_id ) {
		$url = wp_get_attachment_image_url( $logo_id, 'full' );
		if ( $url ) {
			return $url;
		}
	}
	return '';
}

/**
 * Outputs meta description, Open Graph, and Twitter Card tags in head.
 */
function creative_portfolio_seo_meta(): void {
	$title = wp_get_document_title();
	$desc  = creative_portfolio_get_meta_description();
	$url   = is_singular() ? get_permalink() : home_url( '/' );
	$type  = is_front_page() ? 'website' : 'article';
	$image = creative_portfolio_seo_image_url();

	// Meta description.
	if ( $desc ) {
		echo '<meta name="description" content="' . esc_attr( $desc ) . '" />' . "\n";
	}

	// Open Graph.
	echo '<meta property="og:title" content="' . esc_attr( $title ) . '" />' . "\n";
	echo '<meta property="og:description" content="' . esc_attr( $desc ) . '" />' . "\n";
	echo '<meta property="og:type" content="' . esc_attr( $type ) . '" />' . "\n";
	echo '<meta property="og:url" content="' . esc_url( $url ) . '" />' . "\n";
	if ( $image ) {
		echo '<meta property="og:image" content="' . esc_url( $image ) . '" />' . "\n";
	}

	// Twitter Card.
	echo '<meta name="twitter:card" content="summary_large_image" />' . "\n";
	echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '" />' . "\n";
	echo '<meta name="twitter:description" content="' . esc_attr( $desc ) . '" />' . "\n";
	if ( $image ) {
		echo '<meta name="twitter:image" content="' . esc_url( $image ) . '" />' . "\n";
	}
}
add_action( 'wp_head', 'creative_portfolio_seo_meta', 1 );
