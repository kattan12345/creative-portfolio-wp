<?php
/**
 * Template part: Hero section (converted from v0.dev React Hero).
 *
 * @package Creative_Portfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$hero_eyebrow         = get_theme_mod( 'hero_eyebrow', 'Creative Digital Agency' );
$hero_headline        = get_theme_mod( 'hero_headline', 'We Create Digital<br>Experiences' );
$hero_subheadline     = get_theme_mod( 'hero_subheadline', 'Award-winning creative agency specializing in modern web design & development that captivates and converts.' );
$hero_cta_primary     = get_theme_mod( 'hero_cta_primary_text', 'View Our Work' );
$hero_cta_primary_url = get_theme_mod( 'hero_cta_primary_url', '#work' );
$hero_cta_secondary   = get_theme_mod( 'hero_cta_secondary_text', 'Get in Touch' );
$hero_cta_secondary_url = get_theme_mod( 'hero_cta_secondary_url', '#contact' );
?>
<section
	id="home"
	class="relative flex min-h-screen items-center justify-center overflow-hidden bg-gradient-to-b from-purple-950 via-slate-900 to-black"
	aria-label="<?php esc_attr_e( 'Hero section', 'creative-portfolio' ); ?>"
>
	<?php /* ── Background floating orbs (animation via JS/CSS using data-hero-orb) ── */ ?>
	<div
		class="pointer-events-none absolute top-[10%] left-[5%] h-64 w-64 rounded-full bg-fuchsia-500/20 blur-3xl lg:h-96 lg:w-96"
		data-hero-orb="1"
		aria-hidden="true"
	></div>
	<div
		class="pointer-events-none absolute bottom-[15%] right-[8%] h-80 w-80 rounded-full bg-pink-500/15 blur-3xl lg:h-[28rem] lg:w-[28rem]"
		data-hero-orb="2"
		aria-hidden="true"
	></div>
	<div
		class="pointer-events-none absolute top-[50%] right-[25%] h-56 w-56 rounded-full bg-fuchsia-600/10 blur-3xl lg:h-80 lg:w-80"
		data-hero-orb="3"
		aria-hidden="true"
	></div>

	<?php /* ── Subtle grid pattern ── */ ?>
	<div
		class="pointer-events-none absolute inset-0 opacity-[0.03]"
		style="background-image: linear-gradient(rgba(255,255,255,.15) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.15) 1px, transparent 1px); background-size: 64px 64px;"
		aria-hidden="true"
	></div>

	<?php /* ── Main content ── */ ?>
	<div class="relative z-10 mx-auto max-w-5xl px-6 py-32 text-center">
		<p
			class="hero-eyebrow mb-6 text-sm font-medium uppercase tracking-[0.3em] lg:text-base"
			data-hero-animate="fade-up"
			data-delay="500"
		>
			<span class="bg-gradient-to-r from-fuchsia-400 to-pink-400 bg-clip-text text-transparent">
				<?php echo esc_html( $hero_eyebrow ); ?>
			</span>
		</p>

		<h1
			class="hero-headline mb-8 text-5xl font-black leading-[1.05] tracking-tight text-balance md:text-6xl lg:text-7xl xl:text-8xl"
			data-hero-animate="fade-up"
			data-delay="700"
		>
			<span class="bg-gradient-to-r from-white via-white to-neutral-400 bg-clip-text text-transparent">
				<?php echo wp_kses_post( $hero_headline ); ?>
			</span>
		</h1>

		<p
			class="hero-subheadline mx-auto mb-12 max-w-3xl text-lg leading-relaxed text-neutral-400 md:text-xl lg:text-2xl"
			data-hero-animate="fade-up"
			data-delay="900"
		>
			<?php echo esc_html( $hero_subheadline ); ?>
		</p>

		<div
			class="hero-ctas flex flex-col items-center justify-center gap-4 sm:flex-row"
			data-hero-animate="fade-up"
			data-delay="1100"
		>
			<a
				href="<?php echo esc_url( $hero_cta_primary_url ); ?>"
				class="group relative inline-flex items-center gap-2 overflow-hidden rounded-full bg-gradient-to-r from-fuchsia-600 to-pink-600 px-8 py-4 text-base font-semibold text-white transition-all duration-300 hover:scale-105 hover:from-fuchsia-500 hover:to-pink-500 hover:shadow-[0_0_40px_rgba(217,70,239,0.3)]"
				data-smooth-scroll
			>
				<?php echo esc_html( $hero_cta_primary ); ?>
				<svg width="16" height="16" viewBox="0 0 14 14" fill="none" aria-hidden="true" class="transition-transform duration-300 group-hover:translate-x-1">
					<path d="M1 7h12M8 2l5 5-5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</a>
			<a
				href="<?php echo esc_url( $hero_cta_secondary_url ); ?>"
				class="inline-flex items-center gap-2 rounded-full border border-neutral-700 px-8 py-4 text-base font-medium text-neutral-300 transition-all duration-300 hover:border-neutral-500 hover:bg-white/5 hover:text-white"
				data-smooth-scroll
			>
				<?php echo esc_html( $hero_cta_secondary ); ?>
			</a>
		</div>
	</div>

	<?php /* ── Scroll indicator ── */ ?>
	<div
		class="absolute bottom-8 left-1/2 flex -translate-x-1/2 flex-col items-center gap-2"
		data-hero-animate="fade-up"
		data-delay="1300"
		data-scroll-indicator
	>
		<div class="flex h-8 w-5 items-start justify-center rounded-full border border-neutral-600 p-1" aria-hidden="true">
			<div class="h-1.5 w-1 rounded-full bg-gradient-to-b from-fuchsia-400 to-pink-400 hero-scroll-dot" aria-hidden="true"></div>
		</div>
		<span class="text-xs text-neutral-500"><?php esc_html_e( 'Scroll to explore', 'creative-portfolio' ); ?></span>
	</div>
</section>
