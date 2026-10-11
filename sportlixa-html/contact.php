<?php include ('header.php');?>

  <main class="devnahian-sportlixa-container">
    <!-- ==========================================================================
       CONTACT US HERO & BREADCRUMBS
       ========================================================================== -->
    <section class="devnahian-sportlixa-contact-hero">
      <nav class="devnahian-sportlixa-breadcrumbs" aria-label="Breadcrumb">
        <a href="index.html">Home</a>
        <span>/</span>
        <a href="#">Support</a>
        <span>/</span>
        <span>Contact Us</span>
      </nav>

      <span class="devnahian-sportlixa-badge-tag">GET IN TOUCH</span>
      <h1 class="devnahian-sportlixa-contact-heading" style="margin-top: 10px;">Contact SportLixa Newsroom</h1>
      <p class="devnahian-sportlixa-contact-subtext">
        Have a news tip, a correction, a partnership proposal, or feedback regarding our real-time telemetry? Send an inquiry directly to our editorial or engineering desks below.
      </p>
    </section>

    <!-- ==========================================================================
       CONTACT 2-COLUMN LAYOUT (FORM + OFFICE LOCATIONS)
       ========================================================================== -->
    <div class="devnahian-sportlixa-contact-grid">
      <!-- Left Column: Secure Inquiry Form -->
      <section class="devnahian-sportlixa-contact-form-card">
        <h2 class="devnahian-sportlixa-form-title">Send Us a Dispatch</h2>
        <p class="devnahian-sportlixa-form-subtitle">All inquiries are routed securely. Our desk responds within 24 hours.</p>

        <form id="devnahian-sportlixa-contactForm" onsubmit="event.preventDefault(); submitContactInquiry();">
          <div class="devnahian-sportlixa-form-group">
            <label class="devnahian-sportlixa-form-label" for="devnahian-sportlixa-inquiryDept">Department / Subject</label>
            <select class="devnahian-sportlixa-form-select" id="devnahian-sportlixa-inquiryDept" required>
              <option value="editorial">Editorial Desk &amp; Story Tips</option>
              <option value="corrections">Corrections &amp; Fact-Checking</option>
              <option value="technical">Technical Support &amp; Scoreboard Bugs</option>
              <option value="advertising">Advertising &amp; Brand Partnerships</option>
              <option value="legal">Legal &amp; Data Privacy Inquiries</option>
            </select>
          </div>

          <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 14px;">
            <div class="devnahian-sportlixa-form-group">
              <label class="devnahian-sportlixa-form-label" for="devnahian-sportlixa-senderName">Your Full Name</label>
              <input type="text" class="devnahian-sportlixa-form-input" id="devnahian-sportlixa-senderName" placeholder="e.g. Marcus Vance" required>
            </div>
            <div class="devnahian-sportlixa-form-group">
              <label class="devnahian-sportlixa-form-label" for="devnahian-sportlixa-senderEmail">Email Address</label>
              <input type="email" class="devnahian-sportlixa-form-input" id="devnahian-sportlixa-senderEmail" placeholder="e.g. marcus@domain.com" required>
            </div>
          </div>

          <div class="devnahian-sportlixa-form-group">
            <label class="devnahian-sportlixa-form-label" for="devnahian-sportlixa-subjectLine">Subject</label>
            <input type="text" class="devnahian-sportlixa-form-input" id="devnahian-sportlixa-subjectLine" placeholder="e.g. Week 5 Stats Inaccuracy on Chiefs Gamecast" required>
          </div>

          <div class="devnahian-sportlixa-form-group">
            <label class="devnahian-sportlixa-form-label" for="devnahian-sportlixa-messageBody">Message</label>
            <textarea class="devnahian-sportlixa-form-textarea" id="devnahian-sportlixa-messageBody" placeholder="Provide detailed context, links, or feedback..." required></textarea>
          </div>

          <button type="submit" class="devnahian-sportlixa-btn-submit-inquiry">Send Message &rarr;</button>
        </form>
      </section>

      <!-- Right Column: Office Locations & Desk Contacts -->
      <aside class="devnahian-sportlixa-contact-sidebar">
        <!-- New York Newsroom -->
        <div class="devnahian-sportlixa-office-card">
          <span class="devnahian-sportlixa-badge-tag" style="width:fit-content;">HEADQUARTERS</span>
          <h3 class="devnahian-sportlixa-office-title">New York Newsroom</h3>
          
          <div class="devnahian-sportlixa-office-detail-row">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <span>SportLixa Digital Media Inc.<br>100 Stadium Way, Suite 400<br>New York, NY 10001 USA</span>
          </div>
          <div class="devnahian-sportlixa-office-detail-row">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            <span>editorial@sportlixa.com</span>
          </div>
        </div>

        <!-- London Bureau -->
        <div class="devnahian-sportlixa-office-card">
          <span class="devnahian-sportlixa-badge-tag" style="width:fit-content;">EUROPEAN BUREAU</span>
          <h3 class="devnahian-sportlixa-office-title">London News Desk</h3>
          
          <div class="devnahian-sportlixa-office-detail-row">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <span>SportLixa UK Ltd.<br>45 Pall Mall, St. James's<br>London SW1Y 5JG United Kingdom</span>
          </div>
          <div class="devnahian-sportlixa-office-detail-row">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            <span>uk-desk@sportlixa.com</span>
          </div>
        </div>

        <!-- Direct Inquiries Quick Info -->
        <div class="devnahian-sportlixa-office-card">
          <h3 class="devnahian-sportlixa-office-title">Direct Contacts</h3>
          <div class="devnahian-sportlixa-office-detail-row">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            <span>+1 (800) 555-LIXA (Toll-Free)</span>
          </div>
          <div class="devnahian-sportlixa-office-detail-row">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            <span>Support Hours: Mon–Fri, 8am–8pm ET</span>
          </div>
        </div>
      </aside>
    </div>
  </main>

<?php include ('footer.php');?>