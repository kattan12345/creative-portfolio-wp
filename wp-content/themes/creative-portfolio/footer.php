<?php
/**
 * Theme footer: close main, site footer, #page, wp_footer, body, html.
 *
 * @package Creative_Portfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
	</main><!-- #content.site-main -->

	<footer class="site-footer border-t border-white/[0.06] bg-black py-12 text-neutral-400">
		<div class="mx-auto max-w-7xl px-5 lg:px-8">
			<p class="text-center text-sm">
				© 2026 Creative Portfolio. <?php esc_html_e( 'All rights reserved.', 'creative-portfolio' ); ?>
			</p>
			<p class="mt-2 text-center text-xs text-neutral-500">
				<?php esc_html_e( 'Built with ❤️ using v0.dev + Cursor', 'creative-portfolio' ); ?>
			</p>
		</div>
	</footer>

	<!-- Back to top (fixed bottom-right, hidden initially; toggle via JS if needed) -->
	<a
		href="#content"
		class="back-to-top fixed bottom-6 right-6 z-40 hidden rounded-full bg-neutral-800 p-3 text-white shadow-lg transition-all duration-300 hover:bg-fuchsia-600 focus:outline-none focus:ring-2 focus:ring-fuchsia-500"
		aria-label="<?php esc_attr_e( 'Back to top', 'creative-portfolio' ); ?>"
		data-back-to-top
	>
		<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
		</svg>
	</a>
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
