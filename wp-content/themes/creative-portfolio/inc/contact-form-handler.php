<?php
/**
 * Contact form AJAX handler: nonce, sanitization, validation, wp_mail, JSON response.
 *
 * @package Creative_Portfolio
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Transient key for basic rate limiting (one submission per minute per IP).
 */
const CREATIVE_PORTFOLIO_CONTACT_RATE_LIMIT_KEY = 'creative_portfolio_contact_';

/**
 * Rate limit window in seconds (e.g. 60 = 1 submission per minute per IP).
 */
const CREATIVE_PORTFOLIO_CONTACT_RATE_LIMIT_SEC = 60;

/**
 * Handles contact form AJAX submission: nonce, sanitize, validate, send email, JSON response.
 */
function creative_portfolio_contact_form_submit(): void {
	// Nonce verification (dies with -1 if invalid; query arg must be 'nonce' in request).
	check_ajax_referer( 'contact_form_nonce', 'nonce' );

	// Basic rate limiting: one submission per IP per minute.
	$rate_key = CREATIVE_PORTFOLIO_CONTACT_RATE_LIMIT_KEY . md5( isset( $_SERVER['REMOTE_ADDR'] ) ? wp_unslash( $_SERVER['REMOTE_ADDR'] ) : '' );
	$rate     = get_transient( $rate_key );
	if ( false !== $rate ) {
		if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			// phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
			error_log( 'Creative Portfolio Contact: rate limit hit for ' . ( isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : 'unknown' ) );
		}
		wp_send_json_error(
			array( 'message' => __( 'Please wait a moment before sending another message.', 'creative-portfolio' ) ),
			429
		);
	}

	// Sanitize inputs.
	$name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$subject = isset( $_POST['subject'] ) ? sanitize_text_field( wp_unslash( $_POST['subject'] ) ) : '';
	$message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

	// Normalize for validation (trim).
	$name    = trim( $name );
	$email   = trim( $email );
	$subject = trim( $subject );
	$message = trim( $message );

	// Server-side validation.
	if ( '' === $name || '' === $email || '' === $subject || '' === $message ) {
		if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			// phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
			error_log( 'Creative Portfolio Contact: validation failed – missing required fields' );
		}
		wp_send_json_error(
			array( 'message' => __( 'Please fill in all fields correctly.', 'creative-portfolio' ) ),
			400
		);
	}

	if ( ! is_email( $email ) ) {
		if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			// phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
			error_log( 'Creative Portfolio Contact: validation failed – invalid email' );
		}
		wp_send_json_error(
			array( 'message' => __( 'Please enter a valid email address.', 'creative-portfolio' ) ),
			400
		);
	}

	// Set rate limit transient.
	set_transient( $rate_key, 1, CREATIVE_PORTFOLIO_CONTACT_RATE_LIMIT_SEC );

	// Build email.
	$to       = get_option( 'admin_email' );
	$mail_subject = sprintf(
		/* translators: %s: subject line from form */
		__( '[Creative Portfolio Contact] %s', 'creative-portfolio' ),
		$subject
	);
	$mail_body = creative_portfolio_contact_email_template( $name, $email, $subject, $message );

	$headers = array(
		sprintf( 'From: %s <%s>', $name, $email ),
		sprintf( 'Reply-To: %s', $email ),
		'Content-Type: text/html; charset=UTF-8',
	);

	$sent = wp_mail( $to, $mail_subject, $mail_body, $headers );

	if ( ! $sent ) {
		if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			// phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
			error_log( 'Creative Portfolio Contact: wp_mail() failed to send to ' . $to );
		}
		wp_send_json_error(
			array( 'message' => __( 'Failed to send message. Please try again later.', 'creative-portfolio' ) ),
			500
		);
	}

	if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
		// phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
		error_log( 'Creative Portfolio Contact: message sent successfully from ' . $email );
	}

	wp_send_json_success(
		array( 'message' => __( 'Message sent successfully! We will get back to you within 24 hours.', 'creative-portfolio' ) )
	);
}

/**
 * Builds HTML email body for contact form submission.
 *
 * @param string $name    Sender name.
 * @param string $email   Sender email.
 * @param string $subject Subject line.
 * @param string $message Message body.
 * @return string HTML email content.
 */
function creative_portfolio_contact_email_template( string $name, string $email, string $subject, string $message ): string {
	$date = wp_date( get_option( 'date_format' ) . ' ' . get_option( 'time_format' ) );
	$site = get_bloginfo( 'name' );

	$name_esc    = esc_html( $name );
	$email_esc   = esc_html( $email );
	$subject_esc = esc_html( $subject );
	$message_esc = wp_kses_post( wpautop( $message ) );
	$date_esc    = esc_html( $date );
	$site_esc    = esc_html( $site );

	ob_start();
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php echo $subject_esc; ?></title>
	</head>
	<body style="margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, sans-serif; font-size: 16px; line-height: 1.5; color: #333; background-color: #f5f5f5;">
		<table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color: #f5f5f5; padding: 24px 0;">
			<tr>
				<td align="center">
					<table role="presentation" width="600" cellspacing="0" cellpadding="0" style="max-width: 600px; width: 100%; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); overflow: hidden;">
						<tr>
							<td style="padding: 32px 40px;">
								<h1 style="margin: 0 0 8px; font-size: 18px; font-weight: 600; color: #111;"><?php echo $site_esc; ?></h1>
								<p style="margin: 0 0 24px; font-size: 13px; color: #666;"><?php esc_html_e( 'Contact form submission', 'creative-portfolio' ); ?></p>
								<table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border-collapse: collapse;">
									<tr>
										<td style="padding: 12px 0; border-bottom: 1px solid #eee; font-size: 12px; color: #666; width: 120px;"><?php esc_html_e( 'Date', 'creative-portfolio' ); ?></td>
										<td style="padding: 12px 0; border-bottom: 1px solid #eee;"><?php echo $date_esc; ?></td>
									</tr>
									<tr>
										<td style="padding: 12px 0; border-bottom: 1px solid #eee; font-size: 12px; color: #666;"><?php esc_html_e( 'Name', 'creative-portfolio' ); ?></td>
										<td style="padding: 12px 0; border-bottom: 1px solid #eee;"><?php echo $name_esc; ?></td>
									</tr>
									<tr>
										<td style="padding: 12px 0; border-bottom: 1px solid #eee; font-size: 12px; color: #666;"><?php esc_html_e( 'Email', 'creative-portfolio' ); ?></td>
										<td style="padding: 12px 0; border-bottom: 1px solid #eee;"><a href="mailto:<?php echo esc_attr( $email ); ?>" style="color: #0ea5e9;"><?php echo $email_esc; ?></a></td>
									</tr>
									<tr>
										<td style="padding: 12px 0; border-bottom: 1px solid #eee; font-size: 12px; color: #666;"><?php esc_html_e( 'Subject', 'creative-portfolio' ); ?></td>
										<td style="padding: 12px 0; border-bottom: 1px solid #eee;"><?php echo $subject_esc; ?></td>
									</tr>
								</table>
								<div style="margin-top: 24px;">
									<p style="margin: 0 0 8px; font-size: 12px; color: #666; font-weight: 600;"><?php esc_html_e( 'Message', 'creative-portfolio' ); ?></p>
									<div style="padding: 16px; background-color: #f9fafb; border-radius: 6px; border: 1px solid #eee;">
										<?php echo $message_esc; ?>
									</div>
								</div>
								<p style="margin: 24px 0 0; font-size: 12px; color: #999;"><?php echo esc_html( $site_esc ); ?> — <?php esc_html_e( 'This email was sent from the contact form on your website.', 'creative-portfolio' ); ?></p>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
	</html>
	<?php
	return ob_get_clean();
}

add_action( 'wp_ajax_contact_form_submit', 'creative_portfolio_contact_form_submit' );
add_action( 'wp_ajax_nopriv_contact_form_submit', 'creative_portfolio_contact_form_submit' );
