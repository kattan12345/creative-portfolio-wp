<?php
/**
 * Portfolio Custom Post Type and Taxonomy registration.
 *
 * @package Creative_Portfolio
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Portfolio CPT and taxonomy on init.
 */
function creative_portfolio_register_portfolio_cpt(): void {
	$labels = array(
		'name'                  => _x( 'Portfolios', 'post type general name', 'creative-portfolio' ),
		'singular_name'         => _x( 'Portfolio', 'post type singular name', 'creative-portfolio' ),
		'menu_name'             => _x( 'Portfolio', 'admin menu', 'creative-portfolio' ),
		'name_admin_bar'        => _x( 'Portfolio', 'add new on admin bar', 'creative-portfolio' ),
		'add_new'               => __( 'Add New Portfolio', 'creative-portfolio' ),
		'add_new_item'          => __( 'Add New Portfolio', 'creative-portfolio' ),
		'new_item'              => __( 'New Portfolio', 'creative-portfolio' ),
		'edit_item'             => __( 'Edit Portfolio', 'creative-portfolio' ),
		'view_item'             => __( 'View Portfolio', 'creative-portfolio' ),
		'all_items'             => __( 'All Portfolios', 'creative-portfolio' ),
		'search_items'          => __( 'Search Portfolios', 'creative-portfolio' ),
		'parent_item_colon'     => __( 'Parent Portfolios:', 'creative-portfolio' ),
		'not_found'             => __( 'No portfolios found.', 'creative-portfolio' ),
		'not_found_in_trash'    => __( 'No portfolios found in Trash.', 'creative-portfolio' ),
		'item_published'        => __( 'Portfolio published.', 'creative-portfolio' ),
		'item_updated'          => __( 'Portfolio updated.', 'creative-portfolio' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'portfolio' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'menu_icon'          => 'dashicons-portfolio',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'portfolio', $args );
}
add_action( 'init', 'creative_portfolio_register_portfolio_cpt' );

/**
 * Register Portfolio Category taxonomy.
 */
function creative_portfolio_register_portfolio_taxonomy(): void {
	$labels = array(
		'name'              => _x( 'Categories', 'taxonomy general name', 'creative-portfolio' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name', 'creative-portfolio' ),
		'search_items'      => __( 'Search Categories', 'creative-portfolio' ),
		'all_items'         => __( 'All Categories', 'creative-portfolio' ),
		'parent_item'       => __( 'Parent Category', 'creative-portfolio' ),
		'parent_item_colon' => __( 'Parent Category:', 'creative-portfolio' ),
		'edit_item'         => __( 'Edit Category', 'creative-portfolio' ),
		'update_item'       => __( 'Update Category', 'creative-portfolio' ),
		'add_new_item'      => __( 'Add New Category', 'creative-portfolio' ),
		'new_item_name'     => __( 'New Category Name', 'creative-portfolio' ),
		'menu_name'         => __( 'Categories', 'creative-portfolio' ),
	);

	$args = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_in_rest'      => true,
		'rewrite'           => array( 'slug' => 'portfolio-category' ),
	);

	register_taxonomy( 'portfolio_category', array( 'portfolio' ), $args );
}
add_action( 'init', 'creative_portfolio_register_portfolio_taxonomy', 0 );

/**
 * Add meta box: Portfolio project details (Year, URL, Client).
 */
function creative_portfolio_add_portfolio_meta_boxes(): void {
	add_meta_box(
		'creative_portfolio_project_details',
		__( 'Project Details', 'creative-portfolio' ),
		'creative_portfolio_render_project_details_meta_box',
		'portfolio',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'creative_portfolio_add_portfolio_meta_boxes' );

/**
 * Render Project Details meta box fields.
 *
 * @param WP_Post $post Current post object.
 */
function creative_portfolio_render_project_details_meta_box( WP_Post $post ): void {
	wp_nonce_field( 'creative_portfolio_project_details', 'creative_portfolio_project_details_nonce' );

	$year   = get_post_meta( $post->ID, '_portfolio_project_year', true );
	$url    = get_post_meta( $post->ID, '_portfolio_project_url', true );
	$client = get_post_meta( $post->ID, '_portfolio_client_name', true );
	?>
	<table class="form-table">
		<tr>
			<th><label for="portfolio_project_year"><?php esc_html_e( 'Project Year', 'creative-portfolio' ); ?></label></th>
			<td>
				<input type="text" id="portfolio_project_year" name="portfolio_project_year" value="<?php echo esc_attr( $year ); ?>" class="regular-text" />
			</td>
		</tr>
		<tr>
			<th><label for="portfolio_project_url"><?php esc_html_e( 'Project URL', 'creative-portfolio' ); ?></label></th>
			<td>
				<input type="url" id="portfolio_project_url" name="portfolio_project_url" value="<?php echo esc_url( $url ); ?>" class="large-text" />
			</td>
		</tr>
		<tr>
			<th><label for="portfolio_client_name"><?php esc_html_e( 'Client Name', 'creative-portfolio' ); ?></label></th>
			<td>
				<input type="text" id="portfolio_client_name" name="portfolio_client_name" value="<?php echo esc_attr( $client ); ?>" class="regular-text" />
			</td>
		</tr>
	</table>
	<?php
}

/**
 * Save Portfolio meta box data.
 *
 * @param int $post_id Post ID.
 */
function creative_portfolio_save_portfolio_meta( int $post_id ): void {
	if ( ! isset( $_POST['creative_portfolio_project_details_nonce'] ) ||
		! wp_verify_nonce(
			sanitize_text_field( wp_unslash( $_POST['creative_portfolio_project_details_nonce'] ) ),
			'creative_portfolio_project_details'
		) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	if ( get_post_type( $post_id ) !== 'portfolio' ) {
		return;
	}

	if ( isset( $_POST['portfolio_project_year'] ) ) {
		update_post_meta( $post_id, '_portfolio_project_year', sanitize_text_field( wp_unslash( $_POST['portfolio_project_year'] ) ) );
	}
	if ( isset( $_POST['portfolio_project_url'] ) ) {
		update_post_meta( $post_id, '_portfolio_project_url', esc_url_raw( wp_unslash( $_POST['portfolio_project_url'] ) ) );
	}
	if ( isset( $_POST['portfolio_client_name'] ) ) {
		update_post_meta( $post_id, '_portfolio_client_name', sanitize_text_field( wp_unslash( $_POST['portfolio_client_name'] ) ) );
	}
}
add_action( 'save_post_portfolio', 'creative_portfolio_save_portfolio_meta' );

/**
 * Default portfolio categories to create on theme activation.
 *
 * @return string[]
 */
function creative_portfolio_default_portfolio_categories(): array {
	return array( 'Web Design', 'Branding', 'App Development', 'Marketing' );
}

/**
 * Flush rewrite rules (e.g. after CPT/taxonomy registration changes).
 * Call on theme activation or when permalinks need refreshing.
 */
function creative_portfolio_flush_rewrite_rules(): void {
	flush_rewrite_rules();
}

/**
 * Create default portfolio categories and flush rewrite rules on theme activation.
 */
function creative_portfolio_activation_portfolio_setup(): void {
	creative_portfolio_register_portfolio_cpt();
	creative_portfolio_register_portfolio_taxonomy();

	$default_cats = creative_portfolio_default_portfolio_categories();
	foreach ( $default_cats as $name ) {
		if ( ! term_exists( $name, 'portfolio_category' ) ) {
			wp_insert_term( $name, 'portfolio_category' );
		}
	}

	creative_portfolio_flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'creative_portfolio_activation_portfolio_setup' );
