<?php
/**
 * Template part: Portfolio grid section (converted from v0.dev React PortfolioGrid).
 *
 * @package Creative_Portfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$portfolio_eyebrow    = get_theme_mod( 'portfolio_eyebrow', 'Selected Works' );
$portfolio_title      = get_theme_mod( 'portfolio_title', 'Featured Projects' );
$portfolio_description = get_theme_mod( 'portfolio_description', 'Explore our latest creative endeavors' );

$portfolio_query = new WP_Query(
	array(
		'post_type'      => 'portfolio',
		'posts_per_page' => 9,
		'orderby'        => 'date',
		'order'          => 'DESC',
		'post_status'    => 'publish',
	)
);

$portfolio_terms = get_terms(
	array(
		'taxonomy'   => 'portfolio_category',
		'hide_empty' => true,
	)
);

if ( ! is_array( $portfolio_terms ) ) {
	$portfolio_terms = array();
}
?>
<section class="relative py-24" id="work" aria-labelledby="portfolio-heading">
	<?php /* Background glow */ ?>
	<div
		class="pointer-events-none absolute left-1/2 top-0 h-[600px] w-[800px] -translate-x-1/2 rounded-full opacity-[0.05] blur-[120px]"
		style="background: radial-gradient(circle, #d946ef, transparent 70%);"
		aria-hidden="true"
	></div>

	<div class="relative mx-auto max-w-7xl px-6">
		<?php /* Section header */ ?>
		<div
			class="mb-16 text-center"
			data-portfolio-animate="section-header"
			id="portfolio-heading"
		>
			<span class="mb-4 inline-block text-sm font-medium uppercase tracking-[0.3em]">
				<span class="bg-gradient-to-r from-fuchsia-400 to-pink-400 bg-clip-text text-transparent">
					<?php echo esc_html( $portfolio_eyebrow ); ?>
				</span>
			</span>
			<h2 class="mb-4 text-4xl font-extrabold tracking-tight text-white text-balance md:text-5xl lg:text-6xl">
				<?php echo esc_html( $portfolio_title ); ?>
			</h2>
			<p class="mx-auto max-w-xl text-base leading-relaxed text-neutral-400 md:text-lg">
				<?php echo esc_html( $portfolio_description ); ?>
			</p>
		</div>

		<?php /* Filter tabs */ ?>
		<div
			class="mb-12 flex flex-wrap items-center justify-center gap-3"
			data-portfolio-animate="filter-tabs"
			role="tablist"
			aria-label="<?php esc_attr_e( 'Project category filter', 'creative-portfolio' ); ?>"
		>
			<button
				type="button"
				role="tab"
				aria-selected="true"
				data-filter="all"
				class="portfolio-filter relative rounded-full px-5 py-2 text-sm font-medium transition-all duration-300 text-white shadow-lg shadow-fuchsia-500/20"
				style="background: linear-gradient(to right, rgb(192, 38, 211), rgb(219, 39, 119));"
			>
				<?php esc_html_e( 'All', 'creative-portfolio' ); ?>
			</button>
			<?php foreach ( $portfolio_terms as $term ) : ?>
				<button
					type="button"
					role="tab"
					aria-selected="false"
					data-filter="<?php echo esc_attr( $term->slug ); ?>"
					class="portfolio-filter relative rounded-full px-5 py-2 text-sm font-medium transition-all duration-300 border border-neutral-700 text-neutral-400 hover:border-neutral-500 hover:text-white"
					style="background: transparent;"
				>
					<?php echo esc_html( $term->name ); ?>
				</button>
			<?php endforeach; ?>
		</div>

		<?php /* Grid */ ?>
		<div
			class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3"
			data-portfolio-grid
			role="tabpanel"
			aria-label="<?php esc_attr_e( 'Portfolio projects', 'creative-portfolio' ); ?>"
		>
			<?php
			if ( $portfolio_query->have_posts() ) :
				while ( $portfolio_query->have_posts() ) :
					$portfolio_query->the_post();
					$post_id   = get_the_ID();
					$terms     = get_the_terms( $post_id, 'portfolio_category' );
					$term_list = is_array( $terms ) && ! empty( $terms )
						? wp_list_pluck( $terms, 'slug' )
						: array( 'uncategorized' );
					$term_names = is_array( $terms ) && ! empty( $terms )
						? wp_list_pluck( $terms, 'name' )
						: array( __( 'Uncategorized', 'creative-portfolio' ) );
					$categories_slugs = implode( ',', $term_list );
					$year = get_post_meta( $post_id, '_portfolio_project_year', true );
					if ( ! $year ) {
						$year = get_the_date( 'Y' );
					}
					$thumb_url = get_the_post_thumbnail_url( $post_id, 'large' );
					?>
					<article
						class="group relative cursor-pointer overflow-hidden rounded-2xl border border-neutral-800 bg-neutral-900"
						data-portfolio-item
						data-categories="<?php echo esc_attr( $categories_slugs ); ?>"
						data-portfolio-animate="card"
					>
						<a href="<?php the_permalink(); ?>" class="block">
							<div class="relative aspect-[4/3] overflow-hidden">
								<?php if ( $thumb_url ) : ?>
									<img
										src="<?php echo esc_url( $thumb_url ); ?>"
										alt="<?php the_title_attribute( array( 'echo' => false ) ); ?>"
										class="h-full w-full object-cover transition-transform duration-500 ease-out group-hover:scale-105"
										loading="lazy"
									/>
								<?php else : ?>
									<div class="flex h-full w-full items-center justify-center bg-neutral-800 text-neutral-600" aria-hidden="true">
										<svg class="h-16 w-16" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14" />
										</svg>
									</div>
								<?php endif; ?>

								<div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100" aria-hidden="true"></div>

								<div class="absolute left-4 top-4 translate-y-2 opacity-0 transition-all duration-300 ease-out group-hover:translate-y-0 group-hover:opacity-100">
									<span class="inline-flex items-center rounded-full border border-fuchsia-500/40 bg-black/60 px-3 py-1 text-xs font-medium text-fuchsia-300 backdrop-blur-sm">
										<?php echo esc_html( $term_names[0] ); ?>
									</span>
								</div>

								<div class="absolute inset-x-0 bottom-0 flex translate-y-4 flex-col gap-3 p-6 opacity-0 transition-all duration-300 ease-out group-hover:translate-y-0 group-hover:opacity-100">
									<div class="flex items-end justify-between">
										<div>
											<p class="mb-1 font-mono text-xs text-neutral-500"><?php echo esc_html( $year ); ?></p>
											<h3 class="text-xl font-bold text-white md:text-2xl"><?php the_title(); ?></h3>
										</div>
										<span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-white/20 text-white backdrop-blur-sm transition-all duration-300 group-hover:border-fuchsia-500/50 group-hover:bg-fuchsia-600/20" aria-hidden="true">
											<svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
												<path d="M4 12L12 4M12 4H6M12 4v6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											</svg>
										</span>
									</div>
								</div>
							</div>
						</a>
					</article>
					<?php
				endwhile;
				wp_reset_postdata();
			endif;
			?>
		</div>

		<?php /* Empty state (no portfolio posts at all) */ ?>
		<?php if ( $portfolio_query->post_count === 0 ) : ?>
			<div class="py-20 text-center" data-portfolio-empty>
				<p class="text-neutral-500"><?php esc_html_e( 'No projects found.', 'creative-portfolio' ); ?></p>
			</div>
		<?php endif; ?>
	</div>
</section>
