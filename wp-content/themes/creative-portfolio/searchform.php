<?php
/**
 * Search form template (used by get_search_form()).
 *
 * @package Creative_Portfolio
 */
?>
<form role="search" method="get" class="search-form inline-flex max-w-md gap-2" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="search-field-404" class="screen-reader-text"><?php esc_html_e( 'Search', 'creative-portfolio' ); ?></label>
	<input
		type="search"
		id="search-field-404"
		class="w-full rounded-lg border border-white/10 bg-neutral-900 px-4 py-2.5 text-white placeholder-neutral-500 focus:border-fuchsia-500 focus:outline-none focus:ring-1 focus:ring-fuchsia-500"
		placeholder="<?php esc_attr_e( 'Search&hellip;', 'creative-portfolio' ); ?>"
		value="<?php echo get_search_query() ? esc_attr( get_search_query() ) : ''; ?>"
		name="s"
	/>
	<button type="submit" class="rounded-lg bg-fuchsia-600 px-4 py-2.5 font-medium text-white transition-colors hover:bg-fuchsia-500">
		<?php esc_html_e( 'Search', 'creative-portfolio' ); ?>
	</button>
</form>
