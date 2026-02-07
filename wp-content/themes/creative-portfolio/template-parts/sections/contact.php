<?php
/**
 * Template part: Contact section (converted from v0.dev React Contact).
 *
 * @package Creative_Portfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$contact_eyebrow    = get_theme_mod( 'contact_eyebrow', 'Get In Touch' );
$contact_title      = get_theme_mod( 'contact_title', "Let's Work Together" );
$contact_description = get_theme_mod( 'contact_description', "Have a project in mind? We'd love to hear about it and help bring your vision to life." );
$contact_email      = get_theme_mod( 'contact_email', 'hello@creative.agency' );
$contact_phone      = get_theme_mod( 'contact_phone', '+1 (555) 123-4567' );
$contact_location   = get_theme_mod( 'contact_location', 'San Francisco, CA' );

$social_github   = get_theme_mod( 'social_github', '' );
$social_twitter  = get_theme_mod( 'social_twitter', '' );
$social_linkedin = get_theme_mod( 'social_linkedin', '' );
$social_dribbble = get_theme_mod( 'social_dribbble', '' );

$contact_cards = array(
	array(
		'icon'  => 'mail',
		'label' => __( 'Email', 'creative-portfolio' ),
		'value' => $contact_email,
		'href'  => $contact_email ? 'mailto:' . $contact_email : null,
	),
	array(
		'icon'  => 'phone',
		'label' => __( 'Phone', 'creative-portfolio' ),
		'value' => $contact_phone,
		'href'  => $contact_phone ? 'tel:' . preg_replace( '/\s+/', '', $contact_phone ) : null,
	),
	array(
		'icon'  => 'map-pin',
		'label' => __( 'Location', 'creative-portfolio' ),
		'value' => $contact_location,
		'href'  => null,
	),
);

$social_links = array();
if ( $social_github ) {
	$social_links[] = array( 'icon' => 'github', 'label' => 'GitHub', 'href' => $social_github ); }
if ( $social_twitter ) {
	$social_links[] = array( 'icon' => 'twitter', 'label' => 'Twitter', 'href' => $social_twitter ); }
if ( $social_linkedin ) {
	$social_links[] = array( 'icon' => 'linkedin', 'label' => 'LinkedIn', 'href' => $social_linkedin ); }
if ( $social_dribbble ) {
	$social_links[] = array( 'icon' => 'dribbble', 'label' => 'Dribbble', 'href' => $social_dribbble ); }
?>
<section
	id="contact"
	class="relative overflow-hidden bg-gradient-to-b from-black via-neutral-950 to-black py-24 lg:py-32"
	aria-labelledby="contact-heading"
>
	<?php /* Background grid */ ?>
	<div
		class="pointer-events-none absolute inset-0 opacity-[0.025]"
		style="background-image: linear-gradient(rgba(255,255,255,.15) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.15) 1px, transparent 1px); background-size: 64px 64px;"
		aria-hidden="true"
	></div>

	<?php /* Ambient glow */ ?>
	<div
		class="pointer-events-none absolute right-[-10%] bottom-[10%] h-[500px] w-[500px] rounded-full opacity-[0.06] blur-[120px] lg:h-[700px] lg:w-[700px]"
		style="background: radial-gradient(circle, #d946ef, transparent 70%);"
		aria-hidden="true"
	></div>
	<div
		class="pointer-events-none absolute left-[-5%] top-[10%] h-[400px] w-[400px] rounded-full opacity-[0.04] blur-[120px] lg:h-[500px] lg:w-[500px]"
		style="background: radial-gradient(circle, #ec4899, transparent 70%);"
		aria-hidden="true"
	></div>

	<div class="relative z-10 mx-auto max-w-6xl px-6">
		<?php /* Section header */ ?>
		<div
			class="mb-16 text-center"
			data-contact-animate="fade-left"
			id="contact-heading"
		>
			<span class="mb-4 inline-block font-mono text-xs font-medium uppercase tracking-[0.3em] text-neutral-500">
				04 / contact
			</span>
		</div>

		<div class="grid grid-cols-1 gap-12 lg:grid-cols-2">
			<?php /* Left column - Contact Info */ ?>
			<div data-contact-animate="fade-left" data-contact-stagger>
				<div data-contact-animate="fade-left">
					<span class="mb-3 inline-block bg-gradient-to-r from-fuchsia-400 to-pink-400 bg-clip-text text-sm font-semibold uppercase tracking-widest text-transparent">
						<?php echo esc_html( $contact_eyebrow ); ?>
					</span>
					<h2 class="mb-4 text-4xl font-extrabold leading-tight tracking-tight text-white text-balance md:text-5xl">
						<?php echo esc_html( $contact_title ); ?>
					</h2>
					<p class="mb-10 max-w-md text-base leading-relaxed text-neutral-400">
						<?php echo esc_html( $contact_description ); ?>
					</p>
				</div>

				<?php /* Contact cards */ ?>
				<div class="mb-10 space-y-4">
					<?php foreach ( $contact_cards as $card ) : ?>
						<div data-contact-animate="fade-left" data-contact-stagger>
							<?php if ( ! empty( $card['href'] ) ) : ?>
								<a
									href="<?php echo esc_url( $card['href'] ); ?>"
									class="group flex items-center gap-4 rounded-xl border border-neutral-800 bg-neutral-900/50 p-4 transition-all duration-300 hover:border-fuchsia-500/50 hover:bg-neutral-900/80"
								>
									<div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-neutral-800/80 transition-colors duration-300 group-hover:bg-fuchsia-500/10">
										<?php if ( 'mail' === $card['icon'] ) : ?>
											<svg class="h-5 w-5 text-fuchsia-400" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
										<?php elseif ( 'phone' === $card['icon'] ) : ?>
											<svg class="h-5 w-5 text-fuchsia-400" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
										<?php else : ?>
											<svg class="h-5 w-5 text-fuchsia-400" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
										<?php endif; ?>
									</div>
									<div>
										<p class="text-xs font-medium uppercase tracking-wider text-neutral-500"><?php echo esc_html( $card['label'] ); ?></p>
										<p class="text-sm font-medium text-white"><?php echo esc_html( $card['value'] ); ?></p>
									</div>
								</a>
							<?php else : ?>
								<div class="group flex items-center gap-4 rounded-xl border border-neutral-800 bg-neutral-900/50 p-4">
									<div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-neutral-800/80">
										<?php if ( 'mail' === $card['icon'] ) : ?>
											<svg class="h-5 w-5 text-fuchsia-400" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
										<?php elseif ( 'phone' === $card['icon'] ) : ?>
											<svg class="h-5 w-5 text-fuchsia-400" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
										<?php else : ?>
											<svg class="h-5 w-5 text-fuchsia-400" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
										<?php endif; ?>
									</div>
									<div>
										<p class="text-xs font-medium uppercase tracking-wider text-neutral-500"><?php echo esc_html( $card['label'] ); ?></p>
										<p class="text-sm font-medium text-white"><?php echo esc_html( $card['value'] ); ?></p>
									</div>
								</div>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>

				<?php /* Social links */ ?>
				<?php if ( ! empty( $social_links ) ) : ?>
					<div data-contact-animate="fade-left">
						<p class="mb-4 text-sm font-medium text-neutral-400"><?php esc_html_e( 'Follow Us', 'creative-portfolio' ); ?></p>
						<div class="flex gap-3">
							<?php foreach ( $social_links as $social ) : ?>
								<a
									href="<?php echo esc_url( $social['href'] ); ?>"
									aria-label="<?php echo esc_attr( $social['label'] ); ?>"
									class="flex h-10 w-10 items-center justify-center rounded-full border border-neutral-700 text-neutral-400 transition-all duration-300 hover:border-fuchsia-500 hover:text-fuchsia-400 hover:shadow-lg hover:shadow-fuchsia-500/10"
								>
									<?php if ( 'github' === $social['icon'] ) : ?>
										<svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.403 5.403 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65-.17.6-.22 1.23-.15 1.85v4"/><path d="M9 18c-4.51 2-5-2-7-2"/></svg>
									<?php elseif ( 'twitter' === $social['icon'] ) : ?>
										<svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg>
									<?php elseif ( 'linkedin' === $social['icon'] ) : ?>
										<svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/></svg>
									<?php else : ?>
										<svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M19.13 5.09C15.22 9.14 10 10.44 8.96 12.96c-1.75 4.37 2 8 5.04 9.04 4.95 1.61 10.17-2.11 10.13-7.04-.04-4.37-2.5-8.48-5.01-9.87"/><path d="M11 14.96c0-2 .5-4 1.96-4 2.5 0 2.5 2 2.5 4 0 1-.5 1.96-1 2.96"/></svg>
									<?php endif; ?>
								</a>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>
			</div>

			<?php /* Right column - Contact Form */ ?>
			<div data-contact-animate="fade-right">
				<div class="rounded-2xl border border-neutral-800 bg-neutral-900/50 p-6 backdrop-blur-xl sm:p-8">
					<h3 class="mb-6 text-xl font-semibold text-white"><?php esc_html_e( 'Send us a message', 'creative-portfolio' ); ?></h3>

					<?php /* Status message container - hidden by default, filled by JS or server */ ?>
					<div
						id="contact-status"
						class="hidden mb-6 flex items-center gap-3 rounded-lg border p-4"
						role="alert"
						aria-live="polite"
					>
						<span class="contact-status-icon shrink-0" aria-hidden="true"></span>
						<p class="contact-status-message text-sm"></p>
					</div>

					<form
						id="contact-form"
						data-contact-form
						action=""
						method="post"
						class="space-y-5"
						novalidate
					>
						<?php wp_nonce_field( 'contact_form_nonce', 'nonce' ); ?>

						<div>
							<label for="contact-name" class="mb-2 block text-sm font-medium text-neutral-300">
								<?php esc_html_e( 'Name', 'creative-portfolio' ); ?>
							</label>
							<input
								id="contact-name"
								name="name"
								type="text"
								required
								placeholder="<?php esc_attr_e( 'Your name', 'creative-portfolio' ); ?>"
								class="w-full rounded-lg border border-neutral-800 bg-neutral-950 px-4 py-3 text-sm text-white placeholder:text-neutral-500 transition-all duration-300 focus:border-fuchsia-500 focus:outline-none focus:ring-1 focus:ring-fuchsia-500"
								autocomplete="name"
							/>
						</div>

						<div>
							<label for="contact-email" class="mb-2 block text-sm font-medium text-neutral-300">
								<?php esc_html_e( 'Email', 'creative-portfolio' ); ?>
							</label>
							<input
								id="contact-email"
								name="email"
								type="email"
								required
								placeholder="your@email.com"
								class="w-full rounded-lg border border-neutral-800 bg-neutral-950 px-4 py-3 text-sm text-white placeholder:text-neutral-500 transition-all duration-300 focus:border-fuchsia-500 focus:outline-none focus:ring-1 focus:ring-fuchsia-500"
								autocomplete="email"
							/>
						</div>

						<div>
							<label for="contact-subject" class="mb-2 block text-sm font-medium text-neutral-300">
								<?php esc_html_e( 'Subject', 'creative-portfolio' ); ?>
							</label>
							<input
								id="contact-subject"
								name="subject"
								type="text"
								required
								placeholder="<?php esc_attr_e( 'Project inquiry', 'creative-portfolio' ); ?>"
								class="w-full rounded-lg border border-neutral-800 bg-neutral-950 px-4 py-3 text-sm text-white placeholder:text-neutral-500 transition-all duration-300 focus:border-fuchsia-500 focus:outline-none focus:ring-1 focus:ring-fuchsia-500"
								autocomplete="off"
							/>
						</div>

						<div>
							<label for="contact-message" class="mb-2 block text-sm font-medium text-neutral-300">
								<?php esc_html_e( 'Message', 'creative-portfolio' ); ?>
							</label>
							<textarea
								id="contact-message"
								name="message"
								required
								rows="5"
								placeholder="<?php esc_attr_e( 'Tell us about your project...', 'creative-portfolio' ); ?>"
								class="w-full resize-none rounded-lg border border-neutral-800 bg-neutral-950 px-4 py-3 text-sm text-white placeholder:text-neutral-500 transition-all duration-300 focus:border-fuchsia-500 focus:outline-none focus:ring-1 focus:ring-fuchsia-500"
							></textarea>
						</div>

						<button
							type="submit"
							class="group flex w-full items-center justify-center gap-2 rounded-lg bg-gradient-to-r from-fuchsia-600 to-pink-600 px-8 py-4 font-semibold text-white transition-all duration-300 hover:from-fuchsia-500 hover:to-pink-500 hover:shadow-lg hover:shadow-fuchsia-500/20 focus:outline-none focus:ring-2 focus:ring-fuchsia-500 focus:ring-offset-2 focus:ring-offset-neutral-950 disabled:cursor-not-allowed disabled:opacity-60"
							aria-busy="false"
							data-contact-submit
						>
							<span class="contact-submit-text"><?php esc_html_e( 'Send Message', 'creative-portfolio' ); ?></span>
							<span class="contact-submit-icon ml-1 transition-transform duration-300 group-hover:translate-x-1" aria-hidden="true">
								<svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
							</span>
							<span class="contact-submit-loading hidden items-center justify-center gap-2" aria-hidden="true">
								<svg class="h-5 w-5 animate-spin" viewBox="0 0 24 24" fill="none" aria-hidden="true">
									<circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
									<path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
								</svg>
								<?php esc_html_e( 'Sending...', 'creative-portfolio' ); ?>
							</span>
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
