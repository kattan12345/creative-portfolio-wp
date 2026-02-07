<?php
/**
 * Single post template.
 *
 * @package Creative_Portfolio
 */

get_header();
?>
	<div class="mx-auto max-w-3xl px-5 py-12 lg:px-8">
		<?php
		while ( have_posts() ) {
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'space-y-6' ); ?>>
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="overflow-hidden rounded-lg">
						<?php the_post_thumbnail( 'hero-image', array( 'class' => 'h-auto w-full object-cover' ) ); ?>
					</div>
				<?php endif; ?>

				<header>
					<?php the_title( '<h1 class="text-3xl font-bold tracking-tight text-white lg:text-4xl">', '</h1>' ); ?>
					<div class="mt-2 flex flex-wrap gap-x-4 gap-y-1 text-sm text-neutral-500">
						<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
						<span aria-hidden="true">·</span>
						<span class="author vcard">
							<?php the_author(); ?>
						</span>
					</div>
				</header>

				<div class="prose prose-invert max-w-none text-neutral-300">
					<?php the_content(); ?>
				</div>

				<?php
				$tags = get_the_tags();
				if ( $tags && ! is_wp_error( $tags ) ) :
					?>
					<footer class="border-t border-white/[0.06] pt-6">
						<p class="text-sm text-neutral-500">
							<?php esc_html_e( 'Tags:', 'creative-portfolio' ); ?>
							<?php
							foreach ( $tags as $tag ) {
								printf(
									'<a href="%1$s" class="ml-1 text-fuchsia-400 hover:text-fuchsia-300 transition-colors">%2$s</a>',
									esc_url( get_tag_link( $tag ) ),
									esc_html( $tag->name )
								);
								if ( $tag !== end( $tags ) ) {
									echo ', ';
								}
							}
							?>
						</p>
					</footer>
				<?php endif; ?>
			</article>
			<?php
		}
		?>
	</div>
<?php
get_footer();
