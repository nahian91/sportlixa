<?php
/**
 * Template Name: Contact Page Template
 *
 * All-in-one static Sportlixa Contact Us page template with embedded styles.
 *
 * @package Sportlixa
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// --------------------------------------------------------------------------
// 1. SECURE SERVER-SIDE DISPATCH HANDLER
// --------------------------------------------------------------------------
$sportlixa_form_status = null;
$sportlixa_form_msg    = '';

if ( 'POST' === ( $_SERVER['REQUEST_METHOD'] ?? '' ) && isset( $_POST['sportlixa_contact_nonce_field'] ) ) {
	if ( wp_verify_nonce( sanitize_key( wp_unslash( $_POST['sportlixa_contact_nonce_field'] ) ), 'sportlixa_submit_contact_action' ) ) {
		$department   = isset( $_POST['inquiry_dept'] ) ? sanitize_text_field( wp_unslash( $_POST['inquiry_dept'] ) ) : 'editorial';
		$sender_name  = isset( $_POST['sender_name'] ) ? sanitize_text_field( wp_unslash( $_POST['sender_name'] ) ) : '';
		$sender_email = isset( $_POST['sender_email'] ) ? sanitize_email( wp_unslash( $_POST['sender_email'] ) ) : '';
		$subject_line = isset( $_POST['subject_line'] ) ? sanitize_text_field( wp_unslash( $_POST['subject_line'] ) ) : '';
		$message_body = isset( $_POST['message_body'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message_body'] ) ) : '';

		// Strip carriage returns to prevent email header injection
		$clean_name    = preg_replace( "/[\r\n]/", '', $sender_name );
		$clean_subject = preg_replace( "/[\r\n]/", '', $subject_line );

		if ( ! empty( $clean_name ) && is_email( $sender_email ) && ! empty( $message_body ) ) {
			$to       = get_option( 'admin_email' );
			$subject  = sprintf( '[SportLixa Dispatch] %s - %s', ucfirst( $department ), $clean_subject );
			$body     = "Name: {$clean_name}\n";
			$body    .= "Email: {$sender_email}\n";
			$body    .= "Department: {$department}\n";
			$body    .= "Subject: {$clean_subject}\n\n";
			$body    .= "Message:\n{$message_body}\n";

			$headers = [
				'From: SportLixa Newsroom <' . $to . '>',
				'Reply-To: ' . $clean_name . ' <' . $sender_email . '>',
				'Content-Type: text/plain; charset=UTF-8',
			];

			if ( wp_mail( $to, $subject, $body, $headers ) ) {
				$sportlixa_form_status = 'success';
				$sportlixa_form_msg    = esc_html__( 'Your dispatch has been delivered to our newsroom desk. An editor will follow up within 24 hours.', 'sportlixa' );
			} else {
				$sportlixa_form_status = 'error';
				$sportlixa_form_msg    = esc_html__( 'Dispatch server could not transmit message. Please contact us directly via email.', 'sportlixa' );
			}
		} else {
			$sportlixa_form_status = 'error';
			$sportlixa_form_msg    = esc_html__( 'Please provide a valid name, email address, and message.', 'sportlixa' );
		}
	} else {
		$sportlixa_form_status = 'error';
		$sportlixa_form_msg    = esc_html__( 'Security validation failed. Please refresh and try again.', 'sportlixa' );
	}
}

get_header(); ?>

<!-- ==========================================================================
     EMBEDDED SCOPED STYLES (Guarantees visible contact info & responsive grid)
     ========================================================================== -->
<style>
  /* 2-Column Responsive Layout */
  .sl-contact-grid {
    display: grid;
    grid-template-columns: 1.4fr 1fr;
    gap: 32px;
    margin-bottom: 60px;
  }
  @media (max-width: 1024px) {
    .sl-contact-grid {
      grid-template-columns: 1fr;
    }
  }

  /* Form Name/Email Row */
  .sl-form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
  }
  @media (max-width: 640px) {
    .sl-form-row {
      grid-template-columns: 1fr;
    }
  }

  /* Status Feedback Alerts */
  .sl-form-alert {
    padding: 14px 18px;
    margin-bottom: 20px;
    border-radius: var(--devnahian-sportlixa-radius-sm, 6px);
    font-weight: 600;
    font-size: 13px;
    color: #ffffff;
  }
  .sl-alert-success {
    background: rgba(16, 185, 129, 0.15);
    border-left: 3px solid var(--devnahian-sportlixa-green-ok, #10b981);
  }
  .sl-alert-error {
    background: rgba(255, 46, 67, 0.15);
    border-left: 3px solid var(--devnahian-sportlixa-red-live, #ff2e43);
  }

  /* Contact Sidebar Cards & Items */
  .sl-office-card {
    background: var(--devnahian-sportlixa-bg-card, #121926);
    border: 1px solid var(--devnahian-sportlixa-border-card, #1e2a3f);
    border-radius: var(--devnahian-sportlixa-radius-md, 10px);
    padding: 24px;
    display: flex;
    flex-direction: column;
    gap: 14px;
    box-shadow: var(--devnahian-sportlixa-shadow-card, 0 4px 20px rgba(0,0,0,0.28));
  }
  .sl-office-card .devnahian-sportlixa-badge-tag {
    display: inline-block;
    width: fit-content;
    margin-bottom: 2px;
  }
  .sl-office-title {
    font-size: 16px;
    font-weight: 900;
    font-style: italic;
    color: var(--devnahian-sportlixa-text-white, #ffffff);
    text-transform: uppercase;
    margin: 0;
  }
  .sl-office-detail-row {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    font-size: 13px;
    color: var(--devnahian-sportlixa-text-light, #e5ebf5);
    line-height: 1.5;
  }
  .sl-office-detail-row svg {
    width: 18px !important;
    height: 18px !important;
    min-width: 18px;
    stroke: var(--devnahian-sportlixa-brand-volt, #c8ff00);
    margin-top: 2px;
    flex-shrink: 0;
  }
  .sl-office-detail-row a {
    color: var(--devnahian-sportlixa-brand-volt-text, #c8ff00) !important;
    font-weight: 700;
    text-decoration: none;
    transition: color 0.2s ease, text-decoration 0.2s ease;
  }
  .sl-office-detail-row a:hover {
    color: #ffffff !important;
    text-decoration: underline;
  }
</style>

<main class="devnahian-sportlixa-container" id="primary" role="main">

  <!-- ==========================================================================
       HERO & BREADCRUMBS
       ========================================================================== -->
  <section class="devnahian-sportlixa-contact-hero">
    <nav class="devnahian-sportlixa-breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'sportlixa' ); ?>">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'sportlixa' ); ?></a>
      <span aria-hidden="true">/</span>
      <span><?php esc_html_e( 'Support', 'sportlixa' ); ?></span>
      <span aria-hidden="true">/</span>
      <span aria-current="page"><?php esc_html_e( 'Contact', 'sportlixa' ); ?></span>
    </nav>

    <span class="devnahian-sportlixa-badge-tag"><?php esc_html_e( 'GET IN TOUCH', 'sportlixa' ); ?></span>
    <h1 class="devnahian-sportlixa-contact-heading">
      <?php esc_html_e( 'Contact SportLixa Newsroom', 'sportlixa' ); ?>
    </h1>
    <p class="devnahian-sportlixa-contact-subtext">
      <?php esc_html_e( 'Have a breaking sports tip, film study inquiry, editorial correction, or partnership proposal? Send a direct dispatch to our specialized desks below.', 'sportlixa' ); ?>
    </p>
  </section>

  <!-- ==========================================================================
       CONTACT GRID (FORM + STATIC OFFICE LOCATIONS)
       ========================================================================== -->
  <div class="sl-contact-grid">

    <!-- Left Column: Inquiry Dispatch Form -->
    <section class="devnahian-sportlixa-contact-form-card" aria-label="<?php esc_attr_e( 'Dispatch Form', 'sportlixa' ); ?>">
      <h2 class="devnahian-sportlixa-form-title"><?php esc_html_e( 'Send Us a Dispatch', 'sportlixa' ); ?></h2>
      <p class="devnahian-sportlixa-form-subtitle">
        <?php esc_html_e( 'All dispatches route directly to our editorial floor. Expected response within 24 hours.', 'sportlixa' ); ?>
      </p>

      <?php if ( 'success' === $sportlixa_form_status ) : ?>
        <div class="sl-form-alert sl-alert-success" role="alert">
          <?php echo esc_html( $sportlixa_form_msg ); ?>
        </div>
      <?php elseif ( 'error' === $sportlixa_form_status ) : ?>
        <div class="sl-form-alert sl-alert-error" role="alert">
          <?php echo esc_html( $sportlixa_form_msg ); ?>
        </div>
      <?php endif; ?>

      <form id="devnahian-sportlixa-contactForm" method="post" action="<?php echo esc_url( get_permalink() ); ?>">
        <?php wp_nonce_field( 'sportlixa_submit_contact_action', 'sportlixa_contact_nonce_field' ); ?>

        <div class="devnahian-sportlixa-form-group">
          <label class="devnahian-sportlixa-form-label" for="sl-inquiryDept"><?php esc_html_e( 'Department / Desk', 'sportlixa' ); ?></label>
          <select class="devnahian-sportlixa-form-select" id="sl-inquiryDept" name="inquiry_dept" required>
            <option value="editorial"><?php esc_html_e( 'Editorial Desk & Breaking News Tips', 'sportlixa' ); ?></option>
            <option value="film-scouts"><?php esc_html_e( 'All-22 Film Breakdown & Analysis Inquiries', 'sportlixa' ); ?></option>
            <option value="corrections"><?php esc_html_e( 'Fact-Checking & Statistical Corrections', 'sportlixa' ); ?></option>
            <option value="technical"><?php esc_html_e( 'Telemetry Feed & Real-Time Scoreboard Bugs', 'sportlixa' ); ?></option>
            <option value="advertising"><?php esc_html_e( 'Brand Partnerships & Commercial Sponsorships', 'sportlixa' ); ?></option>
          </select>
        </div>

        <div class="sl-form-row">
          <div class="devnahian-sportlixa-form-group">
            <label class="devnahian-sportlixa-form-label" for="sl-senderName"><?php esc_html_e( 'Your Full Name', 'sportlixa' ); ?></label>
            <input type="text" class="devnahian-sportlixa-form-input" id="sl-senderName" name="sender_name" placeholder="<?php esc_attr_e( 'e.g. Marcus Vance', 'sportlixa' ); ?>" required>
          </div>
          <div class="devnahian-sportlixa-form-group">
            <label class="devnahian-sportlixa-form-label" for="sl-senderEmail"><?php esc_html_e( 'Email Address', 'sportlixa' ); ?></label>
            <input type="email" class="devnahian-sportlixa-form-input" id="sl-senderEmail" name="sender_email" placeholder="<?php esc_attr_e( 'e.g. marcus@domain.com', 'sportlixa' ); ?>" required>
          </div>
        </div>

        <div class="devnahian-sportlixa-form-group">
          <label class="devnahian-sportlixa-form-label" for="sl-subjectLine"><?php esc_html_e( 'Subject', 'sportlixa' ); ?></label>
          <input type="text" class="devnahian-sportlixa-form-input" id="sl-subjectLine" name="subject_line" placeholder="<?php esc_attr_e( 'e.g. AFC East Post-Game Telemetry Discrepancy', 'sportlixa' ); ?>" required>
        </div>

        <div class="devnahian-sportlixa-form-group">
          <label class="devnahian-sportlixa-form-label" for="sl-messageBody"><?php esc_html_e( 'Message Details', 'sportlixa' ); ?></label>
          <textarea class="devnahian-sportlixa-form-textarea" id="sl-messageBody" name="message_body" rows="6" placeholder="<?php esc_attr_e( 'Provide full context, game tape references, timecodes, or questions...', 'sportlixa' ); ?>" required></textarea>
        </div>

        <button type="submit" class="devnahian-sportlixa-btn-submit-inquiry">
          <?php esc_html_e( 'Transmit Dispatch →', 'sportlixa' ); ?>
        </button>
      </form>
    </section>

    <!-- Right Column: Hardcoded Static Bureau Details -->
    <aside class="devnahian-sportlixa-contact-sidebar">
      
      <!-- Card 1: Headquarters -->
      <div class="sl-office-card">
        <span class="devnahian-sportlixa-badge-tag"><?php esc_html_e( 'HEADQUARTERS', 'sportlixa' ); ?></span>
        <h3 class="sl-office-title"><?php esc_html_e( 'New York Newsroom', 'sportlixa' ); ?></h3>

        <div class="sl-office-detail-row">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
            <circle cx="12" cy="10" r="3"></circle>
          </svg>
          <div>
            <strong>SportLixa Digital Media Inc.</strong><br>
            100 Stadium Way, 4th Floor<br>
            New York, NY 10001, USA
          </div>
        </div>

        <div class="sl-office-detail-row">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
            <polyline points="22,6 12,13 2,6"></polyline>
          </svg>
          <div>
            <a href="mailto:editorial@sportlixa.com">editorial@sportlixa.com</a>
          </div>
        </div>
      </div>

      <!-- Card 2: European Bureau -->
      <div class="sl-office-card">
        <span class="devnahian-sportlixa-badge-tag"><?php esc_html_e( 'EUROPEAN BUREAU', 'sportlixa' ); ?></span>
        <h3 class="sl-office-title"><?php esc_html_e( 'London Football Desk', 'sportlixa' ); ?></h3>

        <div class="sl-office-detail-row">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
            <circle cx="12" cy="10" r="3"></circle>
          </svg>
          <div>
            <strong>SportLixa International Ltd.</strong><br>
            45 Pall Mall, St. James's<br>
            London SW1Y 5JG, United Kingdom
          </div>
        </div>

        <div class="sl-office-detail-row">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
            <polyline points="22,6 12,13 2,6"></polyline>
          </svg>
          <div>
            <a href="mailto:london-desk@sportlixa.com">london-desk@sportlixa.com</a>
          </div>
        </div>
      </div>

      <!-- Card 3: Direct Phone & Hours -->
      <div class="sl-office-card">
        <h3 class="sl-office-title"><?php esc_html_e( 'Immediate Wire Contacts', 'sportlixa' ); ?></h3>

        <div class="sl-office-detail-row">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
          </svg>
          <div>
            <a href="tel:+18005555492">+1 (800) 555-LIXA (Toll-Free)</a>
          </div>
        </div>

        <div class="sl-office-detail-row">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
            <circle cx="12" cy="12" r="10"></circle>
            <polyline points="12 6 12 12 16 14"></polyline>
          </svg>
          <div>
            <?php esc_html_e( 'Live Wire Hours: Mon–Sun, 7:00 AM – 11:00 PM ET', 'sportlixa' ); ?>
          </div>
        </div>
      </div>

    </aside>
  </div>

</main>

<?php get_footer(); ?>