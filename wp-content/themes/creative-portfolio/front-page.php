<?php
/**
 * Front page template: one-page sections for smooth scroll.
 *
 * @package Creative_Portfolio
 */

get_header();
?>
	<section id="home" class="flex min-h-screen flex-col items-center justify-center px-5 py-24 lg:px-8">
		<div class="mx-auto max-w-4xl text-center">
			<h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">
				<span class="bg-gradient-to-r from-fuchsia-400 to-pink-400 bg-clip-text text-transparent"><?php bloginfo( 'name' ); ?></span>
			</h1>
			<p class="mt-6 text-lg text-neutral-400">
				<?php bloginfo( 'description' ); ?>
			</p>
		</div>
	</section>

	<section id="work" class="flex min-h-screen flex-col items-center justify-center px-5 py-24 lg:px-8">
		<div class="mx-auto max-w-4xl text-center">
			<h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl"><?php esc_html_e( 'Work', 'creative-portfolio' ); ?></h2>
			<p class="mt-4 text-neutral-500"><?php esc_html_e( 'Portfolio and projects placeholder.', 'creative-portfolio' ); ?></p>
		</div>
	</section>

	<section id="about" class="flex min-h-screen flex-col items-center justify-center px-5 py-24 lg:px-8">
		<div class="mx-auto max-w-4xl text-center">
			<h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl"><?php esc_html_e( 'About', 'creative-portfolio' ); ?></h2>
			<p class="mt-4 text-neutral-500"><?php esc_html_e( 'About us placeholder.', 'creative-portfolio' ); ?></p>
		</div>
	</section>

	<section id="services" class="flex min-h-screen flex-col items-center justify-center px-5 py-24 lg:px-8">
		<div class="mx-auto max-w-4xl text-center">
			<h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl"><?php esc_html_e( 'Services', 'creative-portfolio' ); ?></h2>
			<p class="mt-4 text-neutral-500"><?php esc_html_e( 'Services placeholder.', 'creative-portfolio' ); ?></p>
		</div>
	</section>

	<section id="contact" class="flex min-h-screen flex-col items-center justify-center px-5 py-24 lg:px-8">
		<div class="mx-auto max-w-4xl text-center">
			<h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl"><?php esc_html_e( 'Contact', 'creative-portfolio' ); ?></h2>
			<p class="mt-4 text-neutral-500"><?php esc_html_e( 'Contact form and details placeholder.', 'creative-portfolio' ); ?></p>
		</div>
	</section>
<?php
get_footer();
