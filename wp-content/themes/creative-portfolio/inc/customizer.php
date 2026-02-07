<?php
/**
 * WordPress Customizer options for Creative Portfolio theme.
 *
 * @package Creative_Portfolio
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Customizer sections and settings.
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 */
function creative_portfolio_customize_register( WP_Customize_Manager $wp_customize ): void {
	// -------------------------------------------------------------------------
	// 1. Hero Section
	// -------------------------------------------------------------------------
	$wp_customize->add_section(
		'creative_portfolio_hero',
		array(
			'title'    => __( 'Hero Section', 'creative-portfolio' ),
			'priority' => 30,
		)
	);

	$wp_customize->add_setting( 'hero_eyebrow', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'hero_eyebrow', array(
		'label'   => __( 'Eyebrow text', 'creative-portfolio' ),
		'section' => 'creative_portfolio_hero',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'hero_headline', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'hero_headline', array(
		'label'   => __( 'Headline', 'creative-portfolio' ),
		'section' => 'creative_portfolio_hero',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'hero_subheadline', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'hero_subheadline', array(
		'label'   => __( 'Subheadline', 'creative-portfolio' ),
		'section' => 'creative_portfolio_hero',
		'type'    => 'textarea',
	) );

	$wp_customize->add_setting( 'hero_cta_primary_text', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'hero_cta_primary_text', array(
		'label'   => __( 'Primary CTA text', 'creative-portfolio' ),
		'section' => 'creative_portfolio_hero',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'hero_cta_primary_url', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'hero_cta_primary_url', array(
		'label'   => __( 'Primary CTA URL', 'creative-portfolio' ),
		'section' => 'creative_portfolio_hero',
		'type'    => 'url',
	) );

	$wp_customize->add_setting( 'hero_cta_secondary_text', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'hero_cta_secondary_text', array(
		'label'   => __( 'Secondary CTA text', 'creative-portfolio' ),
		'section' => 'creative_portfolio_hero',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'hero_cta_secondary_url', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'hero_cta_secondary_url', array(
		'label'   => __( 'Secondary CTA URL', 'creative-portfolio' ),
		'section' => 'creative_portfolio_hero',
		'type'    => 'url',
	) );

	// -------------------------------------------------------------------------
	// 2. Social Links
	// -------------------------------------------------------------------------
	$wp_customize->add_section(
		'creative_portfolio_social',
		array(
			'title'    => __( 'Social Links', 'creative-portfolio' ),
			'priority' => 40,
		)
	);

	$wp_customize->add_setting( 'social_github', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'social_github', array(
		'label'   => __( 'GitHub URL', 'creative-portfolio' ),
		'section' => 'creative_portfolio_social',
		'type'    => 'url',
	) );

	$wp_customize->add_setting( 'social_twitter', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'social_twitter', array(
		'label'   => __( 'Twitter / X URL', 'creative-portfolio' ),
		'section' => 'creative_portfolio_social',
		'type'    => 'url',
	) );

	$wp_customize->add_setting( 'social_linkedin', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'social_linkedin', array(
		'label'   => __( 'LinkedIn URL', 'creative-portfolio' ),
		'section' => 'creative_portfolio_social',
		'type'    => 'url',
	) );

	$wp_customize->add_setting( 'social_dribbble', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'social_dribbble', array(
		'label'   => __( 'Dribbble URL', 'creative-portfolio' ),
		'section' => 'creative_portfolio_social',
		'type'    => 'url',
	) );

	// -------------------------------------------------------------------------
	// 3. Footer
	// -------------------------------------------------------------------------
	$wp_customize->add_section(
		'creative_portfolio_footer',
		array(
			'title'    => __( 'Footer', 'creative-portfolio' ),
			'priority' => 50,
		)
	);

	$wp_customize->add_setting( 'footer_copyright', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'footer_copyright', array(
		'label'   => __( 'Copyright text', 'creative-portfolio' ),
		'section' => 'creative_portfolio_footer',
		'type'    => 'textarea',
	) );
}
add_action( 'customize_register', 'creative_portfolio_customize_register' );
