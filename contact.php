<?php
/**
 * Template Name: Contact Page Template
 *
 * The template for displaying the custom Sportlixa Contact Us page,
 * equipped with secure dispatch handling and server-side email notifications.
 *
 * @package Sportlixa
 */

get_header();

// Process contact form submission securely
$sportlixa_form_status = null;
$sportlixa_form_msg    = '';

if ( 'POST' === $_SERVER['REQUEST_METHOD'] && isset( $_POST['sportlixa_contact_nonce_field'] ) ) {
    if ( wp_verify_nonce( sanitize_key( $_POST['sportlixa_contact_nonce_field'] ), 'sportlixa_submit_contact_action' ) ) {
        $department   = isset( $_POST['inquiry_dept'] ) ? sanitize_text_field( wp_unslash( $_POST['inquiry_dept'] ) ) : 'editorial';
        $sender_name  = isset( $_POST['sender_name'] ) ? sanitize_text_field( wp_unslash( $_POST['sender_name'] ) ) : '';
        $sender_email = isset( $_POST['sender_email'] ) ? sanitize_email( wp_unslash( $_POST['sender_email'] ) ) : '';
        $subject_line = isset( $_POST['subject_line'] ) ? sanitize_text_field( wp_unslash( $_POST['subject_line'] ) ) : '';
        $message_body = isset( $_POST['message_body'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message_body'] ) ) : '';

        if ( ! empty( $sender_name ) && is_email( $sender_email ) && ! empty( $message_body ) ) {
            $to      = get_option( 'admin_email' );
            $subject = sprintf( '[%s Dispatch] %s - %s', get_bloginfo( 'name' ), ucfirst( $department ), $subject_line );
            $body    = "Name: {$sender_name}\n";
            $body   .= "Email: {$sender_email}\n";
            $body   .= "Department: {$department}\n";
            $body   .= "Subject: {$subject_line}\n\n";
            $body   .= "Message:\n{$message_body}\n";

            $headers = [
                'From: ' . get_bloginfo( 'name' ) . ' <' . $to . '>',
                'Reply-To: ' . $sender_name . ' <' . $sender_email . '>',
                'Content-Type: text/plain; charset=UTF-8',
            ];

            if ( wp_mail( $to, $subject, $body, $headers ) ) {
                $sportlixa_form_status = 'success';
                $sportlixa_form_msg    = __( 'Your dispatch has been delivered to our newsroom desk. An editor will follow up within 24 hours.', 'sportlixa' );
            } else {
                $sportlixa_form_status = 'error';
                $sportlixa_form_msg    = __( 'Dispatch server could not transmit message. Please contact us directly via email.', 'sportlixa' );
            }
        } else {
            $sportlixa_form_status = 'error';
            $sportlixa_form_msg    = __( 'Please provide a valid name, email address, and message.', 'sportlixa' );
        }
    } else {
        $sportlixa_form_status = 'error';
        $sportlixa_form_msg    = __( 'Security check failed. Please refresh and try again.', 'sportlixa' );
    }
}
?>

  <main class="devnahian-sportlixa-container">
    <!-- ==========================================================================
       CONTACT US HERO & BREADCRUMBS
       ========================================================================== -->
    <section class="devnahian-sportlixa-contact-hero">
      <nav class="devnahian-sportlixa-breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'sportlixa' ); ?>">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'sportlixa' ); ?></a>
        <span>/</span>
        <span><?php esc_html_e( 'Support', 'sportlixa' ); ?></span>
        <span>/</span>
        <span aria-current="page"><?php the_title(); ?></span>
      </nav>

      <span class="devnahian-sportlixa-badge-tag"><?php esc_html_e( 'GET IN TOUCH', 'sportlixa' ); ?></span>
      <h1 class="devnahian-sportlixa-contact-heading" style="margin-top: 10px;">
        <?php
        $contact_title = get_the_title();
        echo esc_html( ! empty( $contact_title ) ? $contact_title : __( 'Contact SportLixa Newsroom', 'sportlixa' ) );
        ?>
      </h1>
      <p class="devnahian-sportlixa-contact-subtext">
        <?php
        if ( has_excerpt() ) {
            echo esc_html( get_the_excerpt() );
        } else {
            esc_html_e( 'Have a news tip, a correction, a partnership proposal, or feedback regarding our real-time telemetry? Send an inquiry directly to our editorial or engineering desks below.', 'sportlixa' );
        }
        ?>
      </p>
    </section>

    <!-- ==========================================================================
       CONTACT 2-COLUMN LAYOUT (FORM + OFFICE LOCATIONS)
       ========================================================================== -->
    <div class="devnahian-sportlixa-contact-grid">
      <!-- Left Column: Secure Inquiry Form -->
      <section class="devnahian-sportlixa-contact-form-card">
        <h2 class="devnahian-sportlixa-form-title"><?php esc_html_e( 'Send Us a Dispatch', 'sportlixa' ); ?></h2>
        <p class="devnahian-sportlixa-form-subtitle">
          <?php esc_html_e( 'All inquiries are routed securely. Our desk responds within 24 hours.', 'sportlixa' ); ?>
        </p>

        <?php if ( 'success' === $sportlixa_form_status ) : ?>
          <div class="devnahian-sportlixa-form-alert devnahian-sportlixa-alert-success" style="padding:14px 18px; margin-bottom:20px; background:rgba(0,255,102,0.12); border-left:3px solid var(--devnahian-sportlixa-brand-volt); border-radius:4px; font-weight:600; font-size:13px; color:var(--sp-text-main);">
            <?php echo esc_html( $sportlixa_form_msg ); ?>
          </div>
        <?php elseif ( 'error' === $sportlixa_form_status ) : ?>
          <div class="devnahian-sportlixa-form-alert devnahian-sportlixa-alert-error" style="padding:14px 18px; margin-bottom:20px; background:rgba(255,69,0,0.15); border-left:3px solid var(--devnahian-sportlixa-brand-orange); border-radius:4px; font-weight:600; font-size:13px; color:var(--sp-text-main);">
            <?php echo esc_html( $sportlixa_form_msg ); ?>
          </div>
        <?php endif; ?>

        <form id="devnahian-sportlixa-contactForm" method="post" action="<?php echo esc_url( get_permalink() ); ?>">
          <?php wp_nonce_field( 'sportlixa_submit_contact_action', 'sportlixa_contact_nonce_field' ); ?>

          <div class="devnahian-sportlixa-form-group">
            <label class="devnahian-sportlixa-form-label" for="devnahian-sportlixa-inquiryDept"><?php esc_html_e( 'Department / Subject', 'sportlixa' ); ?></label>
            <select class="devnahian-sportlixa-form-select" id="devnahian-sportlixa-inquiryDept" name="inquiry_dept" required>
              <option value="editorial"><?php esc_html_e( 'Editorial Desk & Story Tips', 'sportlixa' ); ?></option>
              <option value="corrections"><?php esc_html_e( 'Corrections & Fact-Checking', 'sportlixa' ); ?></option>
              <option value="technical"><?php esc_html_e( 'Technical Support & Scoreboard Bugs', 'sportlixa' ); ?></option>
              <option value="advertising"><?php esc_html_e( 'Advertising & Brand Partnerships', 'sportlixa' ); ?></option>
              <option value="legal"><?php esc_html_e( 'Legal & Data Privacy Inquiries', 'sportlixa' ); ?></option>
            </select>
          </div>

          <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 14px;">
            <div class="devnahian-sportlixa-form-group">
              <label class="devnahian-sportlixa-form-label" for="devnahian-sportlixa-senderName"><?php esc_html_e( 'Your Full Name', 'sportlixa' ); ?></label>
              <input type="text" class="devnahian-sportlixa-form-input" id="devnahian-sportlixa-senderName" name="sender_name" placeholder="<?php esc_attr_e( 'e.g. Marcus Vance', 'sportlixa' ); ?>" required>
            </div>
            <div class="devnahian-sportlixa-form-group">
              <label class="devnahian-sportlixa-form-label" for="devnahian-sportlixa-senderEmail"><?php esc_html_e( 'Email Address', 'sportlixa' ); ?></label>
              <input type="email" class="devnahian-sportlixa-form-input" id="devnahian-sportlixa-senderEmail" name="sender_email" placeholder="<?php esc_attr_e( 'e.g. marcus@domain.com', 'sportlixa' ); ?>" required>
            </div>
          </div>

          <div class="devnahian-sportlixa-form-group">
            <label class="devnahian-sportlixa-form-label" for="devnahian-sportlixa-subjectLine"><?php esc_html_e( 'Subject', 'sportlixa' ); ?></label>
            <input type="text" class="devnahian-sportlixa-form-input" id="devnahian-sportlixa-subjectLine" name="subject_line" placeholder="<?php esc_attr_e( 'e.g. Week 5 Stats Inaccuracy on Chiefs Gamecast', 'sportlixa' ); ?>" required>
          </div>

          <div class="devnahian-sportlixa-form-group">
            <label class="devnahian-sportlixa-form-label" for="devnahian-sportlixa-messageBody"><?php esc_html_e( 'Message', 'sportlixa' ); ?></label>
            <textarea class="devnahian-sportlixa-form-textarea" id="devnahian-sportlixa-messageBody" name="message_body" placeholder="<?php esc_attr_e( 'Provide detailed context, links, or feedback...', 'sportlixa' ); ?>" required></textarea>
          </div>

          <button type="submit" class="devnahian-sportlixa-btn-submit-inquiry">
            <?php esc_html_e( 'Send Message →', 'sportlixa' ); ?>
          </button>
        </form>
      </section>

      <!-- Right Column: Office Locations & Desk Contacts -->
      <aside class="devnahian-sportlixa-contact-sidebar">
        <!-- New York Newsroom -->
        <div class="devnahian-sportlixa-office-card">
          <span class="devnahian-sportlixa-badge-tag" style="width:fit-content;"><?php esc_html_e( 'HEADQUARTERS', 'sportlixa' ); ?></span>
          <h3 class="devnahian-sportlixa-office-title"><?php esc_html_e( 'New York Newsroom', 'sportlixa' ); ?></h3>
          
          <div class="devnahian-sportlixa-office-detail-row">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <span>SportLixa Digital Media Inc.<br>100 Stadium Way, Suite 400<br>New York, NY 10001 USA</span>
          </div>
          <div class="devnahian-sportlixa-office-detail-row">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            <a href="mailto:editorial@sportlixa.com">editorial@sportlixa.com</a>
          </div>
        </div>

        <!-- London Bureau -->
        <div class="devnahian-sportlixa-office-card">
          <span class="devnahian-sportlixa-badge-tag" style="width:fit-content;"><?php esc_html_e( 'EUROPEAN BUREAU', 'sportlixa' ); ?></span>
          <h3 class="devnahian-sportlixa-office-title"><?php esc_html_e( 'London News Desk', 'sportlixa' ); ?></h3>
          
          <div class="devnahian-sportlixa-office-detail-row">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <span>SportLixa UK Ltd.<br>45 Pall Mall, St. James's<br>London SW1Y 5JG United Kingdom</span>
          </div>
          <div class="devnahian-sportlixa-office-detail-row">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            <a href="mailto:uk-desk@sportlixa.com">uk-desk@sportlixa.com</a>
          </div>
        </div>

        <!-- Direct Inquiries Quick Info -->
        <div class="devnahian-sportlixa-office-card">
          <h3 class="devnahian-sportlixa-office-title"><?php esc_html_e( 'Direct Contacts', 'sportlixa' ); ?></h3>
          <div class="devnahian-sportlixa-office-detail-row">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            <span><a href="tel:18005555492">+1 (800) 555-LIXA (Toll-Free)</a></span>
          </div>
          <div class="devnahian-sportlixa-office-detail-row">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            <span><?php esc_html_e( 'Support Hours: Mon–Fri, 8am–8pm ET', 'sportlixa' ); ?></span>
          </div>
        </div>
      </aside>
    </div>
  </main>

<?php get_footer(); ?>