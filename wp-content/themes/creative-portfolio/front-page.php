<?php
/**
 * Front page template: one-page sections for smooth scroll.
 *
 * @package Creative_Portfolio
 */

get_header();
?>
	<?php get_template_part( 'template-parts/sections/hero' ); ?>

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
