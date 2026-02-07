<?php
/**
 * Template part: Services section (converted from v0.dev React Services).
 *
 * @package Creative_Portfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$services_eyebrow    = get_theme_mod( 'services_eyebrow', 'What We Do' );
$services_title      = get_theme_mod( 'services_title', 'Our Services' );
$services_description = get_theme_mod( 'services_description', 'Comprehensive digital solutions tailored to your needs' );

$services = array(
	array(
		'title'       => 'Web Design & Development',
		'description' => 'Custom websites that combine stunning design with powerful functionality',
		'features'    => array( 'Responsive Design', 'Modern UI/UX', 'Performance Optimization', 'SEO Ready' ),
		'icon'        => 'code',
	),
	array(
		'title'       => 'Brand Identity Design',
		'description' => 'Distinctive brand identities that resonate with your target audience',
		'features'    => array( 'Logo Design', 'Brand Guidelines', 'Visual Identity', 'Print Design' ),
		'icon'        => 'palette',
	),
	array(
		'title'       => 'Mobile App Development',
		'description' => 'Native and cross-platform mobile apps that users love to use',
		'features'    => array( 'iOS & Android', 'React Native', 'User Experience', 'App Store Ready' ),
		'icon'        => 'smartphone',
	),
	array(
		'title'       => 'Digital Marketing',
		'description' => 'Data-driven marketing strategies that deliver measurable results',
		'features'    => array( 'Social Media', 'Content Strategy', 'SEO/SEM', 'Analytics' ),
		'icon'        => 'chart',
	),
);
?>
<section class="relative bg-black py-24" id="services" aria-labelledby="services-heading">
	<?php /* Background glows */ ?>
	<div
		class="pointer-events-none absolute right-0 top-1/2 h-[600px] w-[600px] -translate-y-1/2 translate-x-1/4 rounded-full opacity-[0.04] blur-[120px]"
		style="background: radial-gradient(circle, #ec4899, transparent 70%);"
		aria-hidden="true"
	></div>
	<div
		class="pointer-events-none absolute bottom-0 left-0 h-[500px] w-[500px] -translate-x-1/4 rounded-full opacity-[0.04] blur-[120px]"
		style="background: radial-gradient(circle, #d946ef, transparent 70%);"
		aria-hidden="true"
	></div>

	<div class="relative mx-auto max-w-7xl px-6">
		<?php /* Section header */ ?>
		<div class="mb-16 text-center" data-services-animate="section-header" id="services-heading">
			<span class="mb-4 inline-block text-sm font-medium uppercase tracking-[0.3em]">
				<span class="bg-gradient-to-r from-fuchsia-400 to-pink-400 bg-clip-text text-transparent">
					<?php echo esc_html( $services_eyebrow ); ?>
				</span>
			</span>
			<h2 class="mb-4 text-4xl font-extrabold tracking-tight text-white text-balance md:text-5xl lg:text-6xl">
				<?php echo esc_html( $services_title ); ?>
			</h2>
			<p class="mx-auto max-w-xl text-base leading-relaxed text-neutral-400 md:text-lg">
				<?php echo esc_html( $services_description ); ?>
			</p>
		</div>

		<?php /* Grid */ ?>
		<div class="grid grid-cols-1 gap-8 md:grid-cols-2">
			<?php foreach ( $services as $i => $service ) : ?>
				<article
					class="group relative overflow-hidden rounded-2xl border border-neutral-800 backdrop-blur-sm transition-all duration-300 hover:border-fuchsia-500/50 hover:shadow-[0_0_40px_-12px_rgba(217,70,239,0.15)]"
					style="background: linear-gradient(to bottom right, rgba(23,23,23,0.8), rgba(10,10,10,0.8));"
					data-services-animate="card"
					data-delay="<?php echo (int) ( $i * 100 ); ?>"
				>
					<div
						class="pointer-events-none absolute -inset-px rounded-2xl opacity-0 transition-opacity duration-500 group-hover:opacity-100"
						style="background: linear-gradient(to bottom right, rgba(192,38,211,0.15), rgba(219,39,119,0.15));"
						aria-hidden="true"
					></div>

					<div class="relative p-8">
						<?php /* Icon */ ?>
						<div class="service-icon mb-6 inline-flex h-16 w-16 items-center justify-center rounded-xl bg-gradient-to-br from-fuchsia-600 to-pink-600 text-white shadow-lg shadow-fuchsia-500/20 transition-transform duration-300 group-hover:rotate-6" data-service-icon aria-hidden="true">
							<?php
							switch ( $service['icon'] ) {
								case 'code':
									?>
									<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
										<polyline points="16 18 22 12 16 6"/>
										<polyline points="8 6 2 12 8 18"/>
									</svg>
									<?php
									break;
								case 'palette':
									?>
									<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
										<circle cx="13.5" cy="6.5" r="0.5" fill="currentColor"/>
										<circle cx="17.5" cy="10.5" r="0.5" fill="currentColor"/>
										<circle cx="8.5" cy="7.5" r="0.5" fill="currentColor"/>
										<circle cx="6.5" cy="12.5" r="0.5" fill="currentColor"/>
										<path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.926 0 1.648-.746 1.648-1.688 0-.437-.18-.835-.437-1.125-.29-.289-.438-.652-.438-1.125a1.64 1.64 0 0 1 1.668-1.668h1.996c3.051 0 5.555-2.503 5.555-5.554C21.965 6.012 17.461 2 12 2z"/>
									</svg>
									<?php
									break;
								case 'smartphone':
									?>
									<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
										<rect width="14" height="20" x="5" y="2" rx="2" ry="2"/>
										<path d="M12 18h.01"/>
									</svg>
									<?php
									break;
								case 'chart':
								default:
									?>
									<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
										<polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
									</svg>
									<?php
									break;
							}
							?>
						</div>

						<h3 class="mb-3 text-xl font-bold text-white"><?php echo esc_html( $service['title'] ); ?></h3>
						<p class="mb-6 text-sm leading-relaxed text-neutral-400"><?php echo esc_html( $service['description'] ); ?></p>

						<ul class="mb-6 flex flex-col gap-2" aria-label="<?php echo esc_attr( $service['title'] . ' ' . __( 'features', 'creative-portfolio' ) ); ?>">
							<?php foreach ( $service['features'] as $feature ) : ?>
								<li class="flex items-center gap-3">
									<svg width="16" height="16" viewBox="0 0 16 16" fill="none" class="shrink-0 text-fuchsia-400" aria-hidden="true">
										<path d="M3.5 8.5L6.5 11.5L12.5 4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
									<span class="text-sm text-neutral-500"><?php echo esc_html( $feature ); ?></span>
								</li>
							<?php endforeach; ?>
						</ul>

						<div class="translate-y-2 opacity-0 transition-all duration-300 ease-out group-hover:translate-y-0 group-hover:opacity-100">
							<span class="inline-flex items-center gap-1.5 text-sm font-medium">
								<span class="bg-gradient-to-r from-fuchsia-400 to-pink-400 bg-clip-text text-transparent">
									<?php esc_html_e( 'Learn More', 'creative-portfolio' ); ?>
								</span>
								<svg width="14" height="14" viewBox="0 0 14 14" fill="none" aria-hidden="true" class="text-pink-400 transition-transform duration-300 group-hover:translate-x-1">
									<path d="M1 7h12M8 2l5 5-5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</span>
						</div>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
