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
		'default'           => 'Creative Digital Agency',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'hero_eyebrow', array(
		'label'   => __( 'Eyebrow text', 'creative-portfolio' ),
		'section' => 'creative_portfolio_hero',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'hero_headline', array(
		'default'           => 'We Create Digital<br>Experiences',
		'sanitize_callback' => 'wp_kses_post',
	) );
	$wp_customize->add_control( 'hero_headline', array(
		'label'       => __( 'Headline', 'creative-portfolio' ),
		'description' => __( 'Allowed HTML: e.g. &lt;br&gt; for line breaks.', 'creative-portfolio' ),
		'section'     => 'creative_portfolio_hero',
		'type'        => 'textarea',
	) );

	$wp_customize->add_setting( 'hero_subheadline', array(
		'default'           => 'Award-winning creative agency specializing in modern web design & development that captivates and converts.',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'hero_subheadline', array(
		'label'   => __( 'Subheadline', 'creative-portfolio' ),
		'section' => 'creative_portfolio_hero',
		'type'    => 'textarea',
	) );

	$wp_customize->add_setting( 'hero_cta_primary_text', array(
		'default'           => 'View Our Work',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'hero_cta_primary_text', array(
		'label'   => __( 'Primary CTA text', 'creative-portfolio' ),
		'section' => 'creative_portfolio_hero',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'hero_cta_primary_url', array(
		'default'           => '#work',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'hero_cta_primary_url', array(
		'label'   => __( 'Primary CTA URL', 'creative-portfolio' ),
		'section' => 'creative_portfolio_hero',
		'type'    => 'url',
	) );

	$wp_customize->add_setting( 'hero_cta_secondary_text', array(
		'default'           => 'Get in Touch',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'hero_cta_secondary_text', array(
		'label'   => __( 'Secondary CTA text', 'creative-portfolio' ),
		'section' => 'creative_portfolio_hero',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'hero_cta_secondary_url', array(
		'default'           => '#contact',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'hero_cta_secondary_url', array(
		'label'   => __( 'Secondary CTA URL', 'creative-portfolio' ),
		'section' => 'creative_portfolio_hero',
		'type'    => 'url',
	) );

	// -------------------------------------------------------------------------
	// 2. Portfolio Grid
	// -------------------------------------------------------------------------
	$wp_customize->add_section(
		'creative_portfolio_portfolio',
		array(
			'title'    => __( 'Portfolio Grid', 'creative-portfolio' ),
			'priority' => 35,
		)
	);

	$wp_customize->add_setting( 'portfolio_eyebrow', array(
		'default'           => 'Selected Works',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'portfolio_eyebrow', array(
		'label'   => __( 'Eyebrow text', 'creative-portfolio' ),
		'section' => 'creative_portfolio_portfolio',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'portfolio_title', array(
		'default'           => 'Featured Projects',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'portfolio_title', array(
		'label'   => __( 'Title', 'creative-portfolio' ),
		'section' => 'creative_portfolio_portfolio',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'portfolio_description', array(
		'default'           => 'Explore our latest creative endeavors',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'portfolio_description', array(
		'label'   => __( 'Description', 'creative-portfolio' ),
		'section' => 'creative_portfolio_portfolio',
		'type'    => 'textarea',
	) );

	// -------------------------------------------------------------------------
	// 3. Services Section
	// -------------------------------------------------------------------------
	$wp_customize->add_section(
		'creative_portfolio_services',
		array(
			'title'    => __( 'Services Section', 'creative-portfolio' ),
			'priority' => 37,
		)
	);

	$wp_customize->add_setting( 'services_eyebrow', array(
		'default'           => 'What We Do',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'services_eyebrow', array(
		'label'   => __( 'Eyebrow text', 'creative-portfolio' ),
		'section' => 'creative_portfolio_services',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'services_title', array(
		'default'           => 'Our Services',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'services_title', array(
		'label'   => __( 'Title', 'creative-portfolio' ),
		'section' => 'creative_portfolio_services',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'services_description', array(
		'default'           => 'Comprehensive digital solutions tailored to your needs',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'services_description', array(
		'label'   => __( 'Description', 'creative-portfolio' ),
		'section' => 'creative_portfolio_services',
		'type'    => 'textarea',
	) );

	// -------------------------------------------------------------------------
	// 4. Contact Section
	// -------------------------------------------------------------------------
	$wp_customize->add_section(
		'creative_portfolio_contact',
		array(
			'title'    => __( 'Contact Section', 'creative-portfolio' ),
			'priority' => 38,
		)
	);

	$wp_customize->add_setting( 'contact_eyebrow', array(
		'default'           => 'Get In Touch',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'contact_eyebrow', array(
		'label'   => __( 'Eyebrow text', 'creative-portfolio' ),
		'section' => 'creative_portfolio_contact',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'contact_title', array(
		'default'           => "Let's Work Together",
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'contact_title', array(
		'label'   => __( 'Title', 'creative-portfolio' ),
		'section' => 'creative_portfolio_contact',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'contact_description', array(
		'default'           => "Have a project in mind? We'd love to hear about it and help bring your vision to life.",
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'contact_description', array(
		'label'   => __( 'Description', 'creative-portfolio' ),
		'section' => 'creative_portfolio_contact',
		'type'    => 'textarea',
	) );

	$wp_customize->add_setting( 'contact_email', array(
		'default'           => 'hello@creative.agency',
		'sanitize_callback' => 'sanitize_email',
	) );
	$wp_customize->add_control( 'contact_email', array(
		'label'   => __( 'Email', 'creative-portfolio' ),
		'section' => 'creative_portfolio_contact',
		'type'    => 'email',
	) );

	$wp_customize->add_setting( 'contact_phone', array(
		'default'           => '+1 (555) 123-4567',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'contact_phone', array(
		'label'   => __( 'Phone', 'creative-portfolio' ),
		'section' => 'creative_portfolio_contact',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'contact_location', array(
		'default'           => 'San Francisco, CA',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'contact_location', array(
		'label'   => __( 'Location', 'creative-portfolio' ),
		'section' => 'creative_portfolio_contact',
		'type'    => 'text',
	) );

	// -------------------------------------------------------------------------
	// 5. Social Links
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
	// 6. Footer
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
