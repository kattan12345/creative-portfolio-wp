<?php
/**
 * Portfolio sample data generation for Creative Portfolio theme.
 *
 * @package Creative_Portfolio
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Option key to mark that sample data has been added (prevents duplicates). */
const CREATIVE_PORTFOLIO_SAMPLE_OPTION = 'creative_portfolio_sample_data_added';

/**
 * Create 8 sample portfolio posts matching v0.dev data.
 * Skips if sample data option is already set.
 */
function creative_portfolio_add_sample_data(): int {
	if ( get_option( CREATIVE_PORTFOLIO_SAMPLE_OPTION, false ) ) {
		return 0;
	}

	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';

	$samples = array(
		array(
			'title'      => 'Aurora Dashboard',
			'categories' => array( 'Web Design', 'App Development' ),
			'year'       => '2026',
			'picsum_id'  => 1,
		),
		array(
			'title'      => 'Luxe Brand Identity',
			'categories' => array( 'Branding' ),
			'year'       => '2025',
			'picsum_id'  => 2,
		),
		array(
			'title'      => 'Fitness Tracker App',
			'categories' => array( 'App Development' ),
			'year'       => '2026',
			'picsum_id'  => 3,
		),
		array(
			'title'      => 'E-commerce Platform',
			'categories' => array( 'Web Design' ),
			'year'       => '2025',
			'picsum_id'  => 4,
		),
		array(
			'title'      => 'Restaurant Rebrand',
			'categories' => array( 'Branding', 'Marketing' ),
			'year'       => '2025',
			'picsum_id'  => 5,
		),
		array(
			'title'      => 'Portfolio Website',
			'categories' => array( 'Web Design' ),
			'year'       => '2026',
			'picsum_id'  => 6,
		),
		array(
			'title'      => 'Task Management Tool',
			'categories' => array( 'App Development' ),
			'year'       => '2026',
			'picsum_id'  => 7,
		),
		array(
			'title'      => 'Marketing Campaign',
			'categories' => array( 'Marketing' ),
			'year'       => '2025',
			'picsum_id'  => 8,
		),
	);

	$created = 0;

	foreach ( $samples as $item ) {
		$term_ids = array();
		foreach ( $item['categories'] as $cat_name ) {
			$term = get_term_by( 'name', $cat_name, 'portfolio_category' );
			if ( $term && ! is_wp_error( $term ) ) {
				$term_ids[] = (int) $term->term_id;
			}
		}

		$post_id = wp_insert_post(
			array(
				'post_type'   => 'portfolio',
				'post_title'  => $item['title'],
				'post_status' => 'publish',
				'post_content' => sprintf(
					'<p>%s</p>',
					esc_html__( 'Sample portfolio item. Replace with your own content.', 'creative-portfolio' )
				),
			),
			true
		);

		if ( is_wp_error( $post_id ) ) {
			continue;
		}

		if ( ! empty( $term_ids ) ) {
			wp_set_object_terms( $post_id, $term_ids, 'portfolio_category' );
		}

		update_post_meta( $post_id, '_portfolio_project_year', $item['year'] );

		$image_url = sprintf( 'https://picsum.photos/id/%d/800/600', $item['picsum_id'] );
		$tmp       = download_url( $image_url );
		if ( ! is_wp_error( $tmp ) ) {
			$file_array = array(
				'name'     => 'portfolio-sample-' . $item['picsum_id'] . '.jpg',
				'tmp_name' => $tmp,
			);
			$attach_id  = media_handle_sideload( $file_array, $post_id );
			if ( ! is_wp_error( $attach_id ) ) {
				set_post_thumbnail( $post_id, $attach_id );
			}
			@unlink( $tmp );
		}

		$created++;
	}

	if ( $created > 0 ) {
		update_option( CREATIVE_PORTFOLIO_SAMPLE_OPTION, true );
	}

	return $created;
}

/**
 * Admin notice with "Add Sample Portfolio Data" button.
 * Only shown when no portfolio posts exist and sample data not yet added.
 */
function creative_portfolio_sample_data_admin_notice(): void {
	if ( get_option( CREATIVE_PORTFOLIO_SAMPLE_OPTION, false ) ) {
		return;
	}
	$count = wp_count_posts( 'portfolio' );
	if ( ! $count || (int) $count->publish > 0 ) {
		return;
	}
	?>
	<div class="notice notice-info is-dismissible" id="creative-portfolio-sample-notice">
		<p>
			<?php esc_html_e( 'Add sample portfolio items to get started.', 'creative-portfolio' ); ?>
			<button type="button" class="button button-primary" id="creative-portfolio-add-sample-data" style="margin-left: 8px;">
				<?php esc_html_e( 'Add Sample Portfolio Data', 'creative-portfolio' ); ?>
			</button>
			<span class="spinner" style="float: none; margin: 0 0 0 5px;"></span>
		</p>
	</div>
	<?php
}
add_action( 'admin_notices', 'creative_portfolio_sample_data_admin_notice' );

/**
 * Enqueue admin script for sample data button (AJAX).
 * Runs on all admin pages when notice is shown so the button works everywhere.
 */
function creative_portfolio_sample_data_admin_script( string $hook ): void {
	if ( get_option( CREATIVE_PORTFOLIO_SAMPLE_OPTION, false ) ) {
		return;
	}
	$count = wp_count_posts( 'portfolio' );
	if ( $count && (int) $count->publish > 0 ) {
		return;
	}
	wp_add_inline_script(
		'jquery',
		'jQuery(function($){
			$("#creative-portfolio-add-sample-data").on("click", function(){
				var $btn = $(this), $spinner = $btn.next(".spinner");
				$btn.prop("disabled", true);
				$spinner.addClass("is-active");
				$.post(ajaxurl, {
					action: "creative_portfolio_ajax_add_sample_data",
					nonce: "' . esc_js( wp_create_nonce( 'creative_portfolio_sample_data' ) ) . '"
				}).done(function(r){
					if (r.success) {
						$("#creative-portfolio-sample-notice").fadeOut(function(){ $(this).remove(); });
						if (typeof window.location !== "undefined") window.location.reload();
					} else {
						$btn.prop("disabled", false);
						$spinner.removeClass("is-active");
						alert(r.data && r.data.message ? r.data.message : "Error adding sample data.");
					}
				}).fail(function(){
					$btn.prop("disabled", false);
					$spinner.removeClass("is-active");
					alert("Request failed.");
				});
			});
		});'
	);
}
add_action( 'admin_enqueue_scripts', 'creative_portfolio_sample_data_admin_script' );

/**
 * AJAX handler: add sample portfolio data.
 */
function creative_portfolio_ajax_add_sample_data(): void {
	check_ajax_referer( 'creative_portfolio_sample_data', 'nonce' );
	if ( ! current_user_can( 'edit_posts' ) ) {
		wp_send_json_error( array( 'message' => __( 'Permission denied.', 'creative-portfolio' ) ) );
	}
	$created = creative_portfolio_add_sample_data();
	wp_send_json_success( array( 'created' => $created ) );
}
add_action( 'wp_ajax_creative_portfolio_ajax_add_sample_data', 'creative_portfolio_ajax_add_sample_data' );
