<?php
/**
 * Creative Portfolio theme functions and definitions.
 *
 * @package Creative_Portfolio
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Theme version (fallback when filemtime not used). */
define( 'CREATIVE_PORTFOLIO_VERSION', '1.0.0' );

/** Content width for oEmbed and image sizing (pixels). */
$content_width = 1200;

// -----------------------------------------------------------------------------
// 1. THEME SETUP
// -----------------------------------------------------------------------------

/**
 * Sets up theme defaults and registers support for WordPress features.
 */
function creative_portfolio_setup(): void {
	// Title tag (no manual <title> in header).
	add_theme_support( 'title-tag' );

	// Post thumbnails (featured images).
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 675, true );

	// Custom image sizes.
	add_image_size( 'portfolio-thumbnail', 600, 400, true );
	add_image_size( 'hero-image', 1920, 1080, true );

	// HTML5 markup for forms and elements.
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Custom logo (used in header).
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 36,
			'width'       => 36,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	// Editor styles (block editor).
	add_theme_support( 'editor-styles' );

	// Responsive embeds (YouTube, etc.).
	add_theme_support( 'responsive-embeds' );

	// Navigation menus.
	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'creative-portfolio' ),
			'footer'  => __( 'Footer Menu', 'creative-portfolio' ),
		)
	);

	// Load text domain for translations.
	load_theme_textdomain( 'creative-portfolio', get_theme_file_path( 'languages' ) );
}
add_action( 'after_setup_theme', 'creative_portfolio_setup' );

// -----------------------------------------------------------------------------
// 2. ENQUEUE SCRIPTS & STYLES
// -----------------------------------------------------------------------------

/**
 * Enqueues front-end styles and scripts with filemtime versioning.
 * TailwindCSS loaded via CDN script in header.php (temporary).
 */
function creative_portfolio_enqueue_assets(): void {
	$theme_uri  = get_theme_file_uri( '' );
	$theme_path = get_theme_file_path( '' );

	// Main theme stylesheet (only if file exists to avoid 404).
	$style_path = $theme_path . '/style.css';
	if ( file_exists( $style_path ) ) {
		wp_enqueue_style(
			'creative-portfolio-style',
			get_stylesheet_uri(),
			array(),
			(string) filemtime( $style_path )
		);
	}

	// Header JavaScript (footer, defer).
	$header_js_path = $theme_path . '/assets/js/header.js';
	wp_enqueue_script(
		'creative-portfolio-header',
		$theme_uri . '/assets/js/header.js',
		array(),
		file_exists( $header_js_path ) ? (string) filemtime( $header_js_path ) : CREATIVE_PORTFOLIO_VERSION,
		true
	);

	// Main JavaScript (placeholder for future; footer, defer).
	$main_js_path = $theme_path . '/assets/js/main.js';
	wp_enqueue_script(
		'creative-portfolio-main',
		$theme_uri . '/assets/js/main.js',
		array(),
		file_exists( $main_js_path ) ? (string) filemtime( $main_js_path ) : CREATIVE_PORTFOLIO_VERSION,
		true
	);

	// Localized data for scripts (e.g. AJAX, nonce, home URL).
	wp_localize_script(
		'creative-portfolio-header',
		'creativePortfolio',
		array(
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'creative-portfolio-nonce' ),
			'homeUrl' => home_url( '/' ),
		)
	);
	wp_localize_script(
		'creative-portfolio-main',
		'creativePortfolio',
		array(
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'creative-portfolio-nonce' ),
			'homeUrl' => home_url( '/' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'creative_portfolio_enqueue_assets' );

// -----------------------------------------------------------------------------
// 3. SCRIPT ATTRIBUTES (DEFER)
// -----------------------------------------------------------------------------

/**
 * Adds 'defer' to theme scripts for non-blocking loading.
 *
 * @param string $tag    The script tag.
 * @param string $handle The script handle.
 * @param string $src    The script src.
 * @return string Modified script tag.
 */
function creative_portfolio_script_loader_tag( string $tag, string $handle, string $src ): string {
	$defer_handles = array( 'creative-portfolio-header', 'creative-portfolio-main' );
	if ( in_array( $handle, $defer_handles, true ) ) {
		if ( str_contains( $tag, ' defer' ) ) {
			return $tag;
		}
		return str_replace( ' src', ' defer src', $tag );
	}
	return $tag;
}
add_filter( 'script_loader_tag', 'creative_portfolio_script_loader_tag', 10, 3 );

// -----------------------------------------------------------------------------
// 4. WIDGET AREAS
// -----------------------------------------------------------------------------

/**
 * Registers widget areas (sidebars).
 */
function creative_portfolio_widgets_init(): void {
	register_sidebar(
		array(
			'name'          => __( 'Footer Widget Area', 'creative-portfolio' ),
			'id'            => 'footer-1',
			'description'   => __( 'Widgets in this area appear in the footer.', 'creative-portfolio' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'creative_portfolio_widgets_init' );

// -----------------------------------------------------------------------------
// 5. CUSTOM FUNCTIONS (EXCERPT, READING TIME)
// -----------------------------------------------------------------------------

/**
 * Sets the excerpt length to 30 words.
 *
 * @param int $length Default excerpt length.
 * @return int Modified length.
 */
function creative_portfolio_excerpt_length( int $length ): int {
	return 30;
}
add_filter( 'excerpt_length', 'creative_portfolio_excerpt_length' );

/**
 * Replaces the default excerpt "..." with a proper ellipsis.
 *
 * @param string $more Default more string.
 * @return string Modified more string.
 */
function creative_portfolio_excerpt_more( string $more ): string {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'creative_portfolio_excerpt_more' );

// -----------------------------------------------------------------------------
// 6. INCLUDE FILES
// -----------------------------------------------------------------------------

$creative_portfolio_inc_dir = get_theme_file_path( 'inc' );

if ( file_exists( $creative_portfolio_inc_dir . '/template-tags.php' ) ) {
	require_once $creative_portfolio_inc_dir . '/template-tags.php';
}

if ( file_exists( $creative_portfolio_inc_dir . '/customizer.php' ) ) {
	require_once $creative_portfolio_inc_dir . '/customizer.php';
}

// -----------------------------------------------------------------------------
// 7. CONTENT WIDTH (handled by global $content_width at top of file)
// -----------------------------------------------------------------------------

// -----------------------------------------------------------------------------
// 8. SECURITY (VERSION REMOVAL, XML-RPC)
// -----------------------------------------------------------------------------

/**
 * Removes WordPress version from head (generator meta and scripts/styles).
 */
function creative_portfolio_remove_version(): void {
	remove_action( 'wp_head', 'wp_generator' );
	add_filter( 'the_generator', '__return_empty_string' );
}
add_action( 'after_setup_theme', 'creative_portfolio_remove_version' );

/**
 * Disables XML-RPC (pingback and remote publishing) if not needed.
 */
function creative_portfolio_disable_xml_rpc(): void {
	add_filter( 'xmlrpc_enabled', '__return_false' );
}
add_action( 'after_setup_theme', 'creative_portfolio_disable_xml_rpc' );

// -----------------------------------------------------------------------------
// NAV MENU WALKER (used by header.php for primary menu)
// -----------------------------------------------------------------------------

/**
 * Custom nav menu walker: outputs desktop nav links with gradient underline and data-section.
 */
class Creative_Portfolio_Nav_Walker extends Walker_Nav_Menu {

	/**
	 * Starts the element output.
	 *
	 * @param string   $output Used to append additional content.
	 * @param WP_Post  $item   Menu item data object.
	 * @param int      $depth  Depth of menu item.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 * @param int      $id    Current item ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ): void {
		if ( $depth !== 0 || ! isset( $args->menu_class ) ) {
			parent::start_el( $output, $item, $depth, $args, $id );
			return;
		}

		$section = '';
		$href    = $item->url;
		if ( preg_match( '/#([a-z0-9_-]+)/i', $href, $m ) ) {
			$section = $m[1];
		} elseif ( $item->object === 'custom' && $href ) {
			$parsed = wp_parse_url( $href );
			if ( ! empty( $parsed['fragment'] ) ) {
				$section = $parsed['fragment'];
			}
		}

		$atts                = array();
		$atts['href']        = esc_url( $href );
		$atts['class']       = 'group relative px-1 py-2 text-sm font-medium tracking-wide';
		$atts['data-smooth-scroll'] = '';
		if ( $section !== '' ) {
			$atts['data-section'] = $section;
		}

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( $value === '' ) {
				$attributes .= ' ' . esc_attr( $attr );
			} else {
				$attributes .= ' ' . esc_attr( $attr ) . '="' . esc_attr( $value ) . '"';
			}
		}

		$li_classes = array_filter( (array) $item->classes );
		$li_class   = $args->link_before ? '' : implode( ' ', apply_filters( 'nav_menu_css_class', $li_classes, $item, $args, $depth ) );
		if ( $li_class !== '' ) {
			$output .= '<li class="' . esc_attr( $li_class ) . '">';
		} else {
			$output .= '<li>';
		}

		$output .= '<a' . $attributes . '>';
		$output .= '<span class="nav-link-text transition-colors duration-300 text-neutral-400 group-hover:text-white">';
		$output .= esc_html( $item->title );
		$output .= '</span>';
		$output .= '<span class="absolute -bottom-0.5 left-0 right-0 h-px bg-gradient-to-r from-fuchsia-500 to-pink-500 origin-center transition-transform duration-300 ease-in-out scale-x-0" data-active-underline aria-hidden="true"></span>';
		$output .= '<span class="absolute -bottom-0.5 left-0 right-0 h-px origin-left scale-x-0 bg-gradient-to-r from-fuchsia-500/60 to-pink-500/60 transition-transform duration-300 ease-out group-hover:scale-x-100" aria-hidden="true"></span>';
		$output .= '</a>';
	}

	/**
	 * Ends the element output.
	 *
	 * @param string   $output Used to append additional content.
	 * @param WP_Post  $item   Menu item data object.
	 * @param int      $depth  Depth of menu item.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 */
	public function end_el( &$output, $item, $depth = 0, $args = null ): void {
		$output .= '</li>';
	}
}
