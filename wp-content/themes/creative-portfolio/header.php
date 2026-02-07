<?php
/**
 * Theme header: document start, skip link, site header bar, and mobile menu.
 * Converted from v0.dev React header; TailwindCSS classes preserved.
 *
 * @package Creative_Portfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Scroll threshold (px) for "scrolled" state and header shrink. */
$header_scroll_threshold = 20;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Styles loaded via compiled TailwindCSS in functions.php -->
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'bg-black text-white antialiased' ); ?>>
<?php wp_body_open(); ?>

<a href="#content" class="skip-link screen-reader-text focus:not-sr-only focus:absolute focus:left-5 focus:top-4 focus:z-[100] focus:rounded focus:bg-white focus:px-3 focus:py-2 focus:text-black focus:outline-none">
	<?php esc_html_e( 'Skip to content', 'creative-portfolio' ); ?>
</a>

<div id="page" class="site">

	<?php
	// Logo: custom logo or fallback to site name (CREATIVE). data-scrolled is toggled by JS for letter-spacing.
	$has_logo = has_custom_logo();
	$site_name = get_bloginfo( 'name' ) ?: 'CREATIVE';
	?>

	<!-- ──────────────── Header bar (fixed) ──────────────── -->
	<header class="creative-header fixed left-0 right-0 top-0 z-50 transition-all duration-700 ease-out" data-header aria-label="<?php esc_attr_e( 'Site header', 'creative-portfolio' ); ?>">
		<div
			class="header-inner relative transition-all duration-500 ease-out bg-black/0 backdrop-blur-none"
			data-header-inner
		>
			<div
				class="header-row mx-auto flex max-w-7xl items-center justify-between px-5 transition-all duration-500 ease-out py-5 lg:px-8 lg:py-6"
				data-header-row
			>
				<!-- Left: Logo (custom logo or fallback C + wordmark; data-scrolled / data-logo-wordmark for JS) -->
				<?php if ( $has_logo ) : ?>
					<div class="relative z-10 flex items-center gap-2.5 transition-transform duration-200 hover:scale-[1.03] active:scale-[0.97]" data-logo>
						<?php the_custom_logo(); ?>
					</div>
				<?php else : ?>
					<a
						href="<?php echo esc_url( home_url( '/' ) ); ?>"
						class="relative z-10 flex items-center gap-2.5 transition-transform duration-200 hover:scale-[1.03] active:scale-[0.97]"
						aria-label="<?php echo esc_attr( $site_name . ' - ' . __( 'Home', 'creative-portfolio' ) ); ?>"
						data-logo
					>
						<!-- Icon mark (gradient C) -->
						<div class="relative">
							<div class="absolute -inset-1 rounded-lg bg-gradient-to-r from-fuchsia-500 to-pink-500 opacity-70 blur-sm transition-opacity duration-300 group-hover:opacity-100" aria-hidden="true"></div>
							<div class="relative flex h-8 w-8 items-center justify-center rounded-lg bg-black ring-1 ring-white/10 lg:h-9 lg:w-9">
								<span class="bg-gradient-to-br from-fuchsia-400 to-pink-400 bg-clip-text text-sm font-black text-transparent lg:text-base">C</span>
							</div>
						</div>
						<!-- Wordmark (letter-spacing animated by JS when scrolled) -->
						<span class="logo-wordmark text-lg font-extrabold tracking-[0.2em] text-white transition-[letter-spacing] duration-400 ease-out lg:text-xl" data-logo-wordmark><?php echo esc_html( $site_name ); ?></span>
					</a>
				<?php endif; ?>

				<!-- Center: Desktop Navigation (wp_nav_menu with custom walker) -->
				<nav
					class="header-nav hidden items-center gap-8 lg:flex"
					role="navigation"
					aria-label="<?php esc_attr_e( 'Main navigation', 'creative-portfolio' ); ?>"
				>
					<?php
					if ( has_nav_menu( 'primary' ) ) {
						wp_nav_menu( array(
							'theme_location' => 'primary',
							'container'      => false,
							'menu_class'     => 'flex items-center gap-8',
							'fallback_cb'    => false,
							'walker'         => new Creative_Portfolio_Nav_Walker(),
							'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
						) );
					}
					?>
				</nav>

				<!-- Right: CTA + Hamburger -->
				<div class="flex items-center gap-3">
					<!-- CTA Button (smooth scroll to #contact) -->
					<a
						href="#contact"
						class="group relative hidden overflow-hidden rounded-full transition-transform duration-200 hover:scale-[1.04] active:scale-[0.96] lg:inline-flex"
						data-smooth-scroll
					>
						<span class="absolute inset-0 bg-gradient-to-r from-fuchsia-600 to-pink-600 opacity-0 blur-xl transition-opacity duration-500 group-hover:opacity-60" aria-hidden="true"></span>
						<span class="absolute inset-0 bg-gradient-to-r from-fuchsia-600 to-pink-600 transition-all duration-300 group-hover:from-fuchsia-500 group-hover:to-pink-500" aria-hidden="true"></span>
						<span class="relative flex items-center gap-2 px-6 py-2.5 text-sm font-semibold text-white">
							<?php esc_html_e( 'Get Started', 'creative-portfolio' ); ?>
							<svg width="14" height="14" viewBox="0 0 14 14" fill="none" aria-hidden="true" class="transition-transform duration-300 group-hover:translate-x-0.5">
								<path d="M1 7h12M8 2l5 5-5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</span>
					</a>
					<!-- Hamburger (mobile only) -->
					<button
						type="button"
						class="relative z-50 flex h-10 w-10 items-center justify-center rounded-full border border-neutral-800 bg-neutral-900/80 backdrop-blur-sm transition-transform duration-200 active:scale-90 lg:hidden"
						aria-label="<?php esc_attr_e( 'Open navigation menu', 'creative-portfolio' ); ?>"
						aria-expanded="false"
						data-mobile-toggle
					>
						<div class="hamburger-bars flex w-[18px] flex-col items-center justify-center gap-[5px]" aria-hidden="true">
							<span class="hamburger-line block h-px w-full rounded-full bg-white transition-all duration-350 ease-out"></span>
							<span class="hamburger-line block h-px w-full rounded-full bg-white transition-all duration-250"></span>
							<span class="hamburger-line block h-px w-full rounded-full bg-white transition-all duration-350 ease-out"></span>
						</div>
					</button>
				</div>
			</div>

			<!-- Scroll progress bar (animated by JS) -->
			<div
				class="absolute bottom-0 left-0 right-0 h-[2px] origin-left"
				data-scroll-progress
				aria-hidden="true"
			>
				<div class="h-full w-full bg-gradient-to-r from-fuchsia-500 via-pink-500 to-fuchsia-400"></div>
			</div>
		</div>
	</header>

	<!-- ──────────────── Mobile menu (panel + backdrop) ──────────────── -->
	<div
		class="mobile-menu fixed inset-0 z-40 hidden lg:hidden"
		aria-hidden="true"
		data-mobile-menu
	>
		<!-- Backdrop -->
		<div
			class="absolute inset-0 bg-black/70 backdrop-blur-sm transition-opacity duration-300"
			data-mobile-backdrop
			aria-hidden="true"
		></div>

		<!-- Slide-in panel (starts off-screen with translate-x-full; JS removes to slide in) -->
		<nav
			class="mobile-panel absolute bottom-0 right-0 top-0 flex w-full max-w-sm flex-col border-l border-white/[0.06] bg-neutral-950/95 backdrop-blur-2xl translate-x-full transition-transform duration-500 ease-out"
			role="navigation"
			aria-label="<?php esc_attr_e( 'Mobile navigation', 'creative-portfolio' ); ?>"
			data-mobile-panel
		>
			<!-- Nav items (with sequential animation delays via CSS) -->
			<div class="flex flex-1 flex-col justify-center px-10">
				<div class="flex flex-col gap-1 mobile-nav-links" data-mobile-nav-links>
					<?php
					$nav_links = array(
						array( 'label' => __( 'Home', 'creative-portfolio' ), 'href' => '#home' ),
						array( 'label' => __( 'Work', 'creative-portfolio' ), 'href' => '#work' ),
						array( 'label' => __( 'About', 'creative-portfolio' ), 'href' => '#about' ),
						array( 'label' => __( 'Services', 'creative-portfolio' ), 'href' => '#services' ),
						array( 'label' => __( 'Contact', 'creative-portfolio' ), 'href' => '#contact' ),
					);
					if ( has_nav_menu( 'primary' ) ) {
						$locations = get_nav_menu_locations();
						$menu_id   = isset( $locations['primary'] ) ? $locations['primary'] : 0;
						$nav_links = array();
						if ( $menu_id ) {
							$items = wp_get_nav_menu_items( $menu_id );
							if ( $items ) {
								foreach ( $items as $i => $item ) {
									$nav_links[] = array(
										'label' => $item->title,
										'href'  => $item->url,
										'id'    => preg_match( '/#([a-z0-9_-]+)/i', $item->url, $m ) ? $m[1] : '',
									);
								}
							}
						}
					}
					foreach ( $nav_links as $i => $link ) :
						$section = isset( $link['id'] ) ? $link['id'] : trim( str_replace( '#', '', $link['href'] ) );
						$num     = str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT );
					?>
						<a
							href="<?php echo esc_url( $link['href'] ); ?>"
							class="mobile-nav-link group relative block opacity-0 transition-opacity duration-450 ease-out"
							style="transition-delay: <?php echo (int) $i * 70; ?>ms;"
							data-smooth-scroll
							data-section="<?php echo esc_attr( $section ); ?>"
						>
							<div class="flex items-center gap-5 py-3">
								<span class="mobile-nav-num font-mono text-[11px] tabular-nums text-neutral-600" data-mobile-nav-num><?php echo esc_html( $num ); ?></span>
								<span class="mobile-nav-label text-3xl font-bold tracking-tight transition-colors duration-300 md:text-4xl text-white group-hover:text-neutral-300" data-mobile-nav-label><?php echo esc_html( $link['label'] ); ?></span>
								<span class="mobile-nav-line ml-auto h-px flex-1 origin-left bg-gradient-to-r from-neutral-800 to-transparent scale-x-0 transition-transform duration-500" style="transition-delay: <?php echo (int) $i * 70 + 200; ?>ms;" data-mobile-nav-line aria-hidden="true"></span>
							</div>
						</a>
					<?php endforeach; ?>
				</div>

				<!-- Mobile CTA -->
				<div class="mt-10 mobile-cta opacity-0 transition-opacity duration-400" style="transition-delay: 400ms;" data-mobile-cta>
					<a
						href="#contact"
						class="group flex w-full items-center justify-center gap-2 rounded-full bg-gradient-to-r from-fuchsia-600 to-pink-600 px-8 py-4 text-base font-semibold text-white transition-all duration-300 hover:from-fuchsia-500 hover:to-pink-500"
						data-smooth-scroll
					>
						<?php esc_html_e( 'Get Started', 'creative-portfolio' ); ?>
						<svg width="16" height="16" viewBox="0 0 14 14" fill="none" aria-hidden="true" class="transition-transform duration-300 group-hover:translate-x-1">
							<path d="M1 7h12M8 2l5 5-5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</a>
				</div>
			</div>

			<!-- Footer -->
			<div class="border-t border-white/[0.06] px-10 py-6 opacity-0 transition-opacity duration-300" style="transition-delay: 500ms;" data-mobile-footer>
				<p class="text-xs text-neutral-600">© <?php echo (int) date( 'Y' ); ?> <?php echo esc_html( $site_name ); ?></p>
			</div>
		</nav>
	</div>

	<main id="content" class="site-main" role="main">
