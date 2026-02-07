<?php
/**
 * Custom template tag functions for Creative Portfolio theme.
 *
 * @package Creative_Portfolio
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Display post date with semantic time tag.
 * Format: "Posted on January 15, 2026"
 *
 * @return void Outputs HTML.
 */
if ( ! function_exists( 'creative_portfolio_posted_on' ) ) {
	function creative_portfolio_posted_on(): void {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() )
		);
		printf(
			/* translators: %s: post date. */
			esc_html__( 'Posted on %s', 'creative-portfolio' ),
			$time_string // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- time tag built with esc_attr/esc_html
		);
	}
}

/**
 * Display post author with link.
 * Format: "by Author Name"
 *
 * @return void Outputs HTML.
 */
if ( ! function_exists( 'creative_portfolio_posted_by' ) ) {
	function creative_portfolio_posted_by(): void {
		printf(
			/* translators: %s: post author link. */
			esc_html__( 'by %s', 'creative-portfolio' ),
			'<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>' // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- URL and author name escaped above
		);
	}
}

/**
 * Display categories and tags in entry footer.
 * Format: "Posted in Category | Tagged tag1, tag2"
 *
 * @return void Outputs HTML.
 */
if ( ! function_exists( 'creative_portfolio_entry_footer' ) ) {
	function creative_portfolio_entry_footer(): void {
		$categories_list = get_the_category_list( wp_get_list_item_separator() );
		$tags_list       = get_the_tag_list( '', wp_get_list_item_separator() );

		if ( $categories_list || $tags_list ) {
			echo '<div class="entry-footer-meta">';
			if ( $categories_list ) {
				printf(
					/* translators: %s: categories list. */
					'<span class="cat-links">' . esc_html__( 'Posted in %s', 'creative-portfolio' ) . '</span>',
					$categories_list // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- get_the_category_list is escaped
				);
			}
			if ( $categories_list && $tags_list ) {
				echo ' <span class="sep">|</span> ';
			}
			if ( $tags_list ) {
				printf(
					/* translators: %s: tags list. */
					'<span class="tags-links">' . esc_html__( 'Tagged %s', 'creative-portfolio' ) . '</span>',
					$tags_list // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- get_the_tag_list is escaped
				);
			}
			echo '</div>';
		}
	}
}

/**
 * Display featured image with link to post; responsive classes.
 *
 * @param int|null $post_id Optional. Post ID. Default current post.
 * @param string  $size    Optional. Image size. Default 'post-thumbnail'.
 * @return void Outputs HTML.
 */
if ( ! function_exists( 'creative_portfolio_post_thumbnail' ) ) {
	function creative_portfolio_post_thumbnail( ?int $post_id = null, string $size = 'post-thumbnail' ): void {
		$post_id = $post_id ?? get_the_ID();
		if ( ! $post_id || ! has_post_thumbnail( $post_id ) ) {
			return;
		}
		?>
		<a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>" class="post-thumbnail block overflow-hidden rounded-lg" aria-hidden="true" tabindex="-1">
			<?php echo get_the_post_thumbnail( $post_id, $size, array( 'class' => 'h-auto w-full object-cover' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- thumbnail output ?>
		</a>
		<?php
	}
}

/**
 * Calculate and return reading time for a post.
 * Format: "5 min read"
 *
 * @param int|null $post_id Optional. Post ID. Default current post.
 * @return string Formatted reading time string.
 */
if ( ! function_exists( 'creative_portfolio_reading_time' ) ) {
	function creative_portfolio_reading_time( ?int $post_id = null ): string {
		$post_id = $post_id ?? get_the_ID();
		if ( ! $post_id ) {
			return esc_html__( '1 min read', 'creative-portfolio' );
		}
		$content = get_post_field( 'post_content', $post_id );
		if ( ! is_string( $content ) || $content === '' ) {
			return esc_html__( '1 min read', 'creative-portfolio' );
		}
		$content  = wp_strip_all_tags( $content );
		$words    = str_word_count( $content );
		$wpm      = 200;
		$minutes  = (int) max( 1, ceil( $words / $wpm ) );
		return sprintf(
			/* translators: %d: number of minutes. */
			esc_html( _n( '%d min read', '%d min read', $minutes, 'creative-portfolio' ) ),
			$minutes
		);
	}
}
