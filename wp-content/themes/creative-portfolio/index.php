<?php
/**
 * Main template file: blog / post list.
 *
 * @package Creative_Portfolio
 */

get_header();
?>
	<div class="mx-auto max-w-7xl px-5 py-12 lg:px-8">
		<?php if ( have_posts() ) : ?>
			<div class="space-y-12">
				<?php
				while ( have_posts() ) {
					the_post();
					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'group' ); ?>>
						<header class="mb-3">
							<?php the_title( '<h2 class="text-2xl font-bold tracking-tight text-white lg:text-3xl"><a href="' . esc_url( get_permalink() ) . '" class="hover:text-fuchsia-400 transition-colors duration-300">', '</a></h2>' ); ?>
						</header>
						<div class="prose prose-invert max-w-none text-neutral-400">
							<?php the_excerpt(); ?>
						</div>
						<p class="mt-4">
							<a href="<?php the_permalink(); ?>" class="inline-flex items-center gap-1 text-sm font-medium text-fuchsia-400 transition-colors hover:text-fuchsia-300">
								<?php esc_html_e( 'Read more', 'creative-portfolio' ); ?>
								<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
								</svg>
							</a>
						</p>
					</article>
					<?php
				}
				?>
			</div>
			<nav class="mt-12" aria-label="<?php esc_attr_e( 'Posts navigation', 'creative-portfolio' ); ?>">
			<?php
			the_posts_pagination(
				array(
					'mid_size'  => 2,
					'prev_text' => '&larr; ' . __( 'Previous', 'creative-portfolio' ),
					'next_text' => __( 'Next', 'creative-portfolio' ) . ' &rarr;',
				)
			);
			?>
			</nav>
		<?php else : ?>
			<p class="text-center text-neutral-500">
				<?php esc_html_e( 'No posts found.', 'creative-portfolio' ); ?>
			</p>
		<?php endif; ?>
	</div>
<?php
get_footer();
