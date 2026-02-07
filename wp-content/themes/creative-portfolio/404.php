<?php
/**
 * 404 error template.
 *
 * @package Creative_Portfolio
 */

get_header();
?>
	<div class="mx-auto max-w-2xl px-5 py-24 text-center lg:px-8">
		<h1 class="text-6xl font-extrabold tracking-tight text-white sm:text-7xl lg:text-8xl">404</h1>
		<p class="mt-4 text-xl text-neutral-400"><?php esc_html_e( 'Page Not Found', 'creative-portfolio' ); ?></p>
		<p class="mt-2 text-neutral-500">
			<?php esc_html_e( 'The page you are looking for does not exist or has been moved.', 'creative-portfolio' ); ?>
		</p>

		<div class="mt-10">
			<?php get_search_form(); ?>
		</div>

		<p class="mt-8">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-fuchsia-600 to-pink-600 px-6 py-3 text-sm font-semibold text-white transition-all duration-300 hover:from-fuchsia-500 hover:to-pink-500">
				<?php esc_html_e( 'Back to home', 'creative-portfolio' ); ?>
				<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
				</svg>
			</a>
		</p>
	</div>
<?php
get_footer();
