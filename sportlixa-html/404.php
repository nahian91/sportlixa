<?php include ('header.php');?>

  <main class="devnahian-sportlixa-container">
    <!-- ==========================================================================
       404 ERROR HERO (PUNCHY SPORTS THEME)
       ========================================================================== -->
    <section class="devnahian-sportlixa-404-hero">
      <div class="devnahian-sportlixa-whistle-badge">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        Whistle Blown &bull; Penalty on the Play
      </div>

      <div class="devnahian-sportlixa-404-glitch-number" aria-hidden="true">404</div>

      <h1 class="devnahian-sportlixa-404-title">Out of Bounds &bull; Play Under Review</h1>
      <p class="devnahian-sportlixa-404-subtitle">
        The play you called was intercepted, ruled incomplete by the referees, or traded to another division. Check your playbook or run a quick audible below.
      </p>

      <!-- In-Page Fast Search Box -->
      <form class="devnahian-sportlixa-404-search-box" onsubmit="event.preventDefault(); executeSearchRecovery();">
        <svg class="devnahian-sportlixa-404-search-icon" viewBox="0 0 24 24" fill="none" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
        <input 
          type="text" 
          class="devnahian-sportlixa-404-search-input" 
          id="devnahian-sportlixa-recoveryInput" 
          placeholder="Search teams, players, scores, or news..." 
          required
        >
        <button type="submit" class="devnahian-sportlixa-404-search-btn">Search</button>
      </form>

      <!-- Primary Recovery Action Buttons -->
      <div class="devnahian-sportlixa-404-actions-row">
        <a href="index.html" class="devnahian-sportlixa-btn-primary">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
          Return to Home Field
        </a>
        <a href="scores.html" class="devnahian-sportlixa-btn-secondary">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
          Check Live Scores
        </a>
        <a href="category.html" class="devnahian-sportlixa-btn-secondary">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
          Explore NFL Hub
        </a>
      </div>

      <!-- Suggested Popular Articles (3 Equal Width Columns) -->
      <section class="devnahian-sportlixa-recovery-section">
        <div class="devnahian-sportlixa-section-title">
          <div class="devnahian-sportlixa-title-left">POPULAR PLAYS RIGHT NOW</div>
          <a href="category.html" class="devnahian-sportlixa-title-link">View all stories &rarr;</a>
        </div>

        <div class="devnahian-sportlixa-recovery-grid">
          <!-- Card 1 -->
          <article class="devnahian-sportlixa-recovery-card">
            <div class="devnahian-sportlixa-recovery-thumb devnahian-sportlixa-img-box">
              <span class="devnahian-sportlixa-badge-tag devnahian-sportlixa-recovery-badge">NFL FILM</span>
              <img 
                src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/77/Patrick_Mahomes_gets_ready_to_snap_the_ball.jpg/800px-Patrick_Mahomes_gets_ready_to_snap_the_ball.jpg" 
                alt="Patrick Mahomes"
                loading="lazy"
                onerror="this.src='https://images.unsplash.com/photo-1566577739112-5180d4bf9390?auto=format&fit=crop&w=800&q=80'"
              >
            </div>
            <div class="devnahian-sportlixa-recovery-content">
              <h3 class="devnahian-sportlixa-recovery-headline">
                <a href="single-post.html">Chiefs vs Bills: 5 Key Matchups That Will Decide Week 5</a>
              </h3>
              <div class="devnahian-sportlixa-meta-time">Oct 5, 2026 &bull; 6 min read</div>
            </div>
          </article>

          <!-- Card 2 -->
          <article class="devnahian-sportlixa-recovery-card">
            <div class="devnahian-sportlixa-recovery-thumb devnahian-sportlixa-img-box">
              <span class="devnahian-sportlixa-badge-tag devnahian-sportlixa-recovery-badge">NBA SPOTLIGHT</span>
              <img 
                src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/bf/LeBron_James_-_51959723161_%28cropped%29.jpg/800px-LeBron_James_-_51959723161_%28cropped%29.jpg" 
                alt="LeBron James"
                loading="lazy"
                onerror="this.src='https://images.unsplash.com/photo-1546519638-68e109498ffc?auto=format&fit=crop&w=800&q=80'"
              >
            </div>
            <div class="devnahian-sportlixa-recovery-content">
              <h3 class="devnahian-sportlixa-recovery-headline">
                <a href="single-post.html">Lakers vs Celtics: 3 Things to Watch in Tonight's Classic</a>
              </h3>
              <div class="devnahian-sportlixa-meta-time">Oct 5, 2026 &bull; 4 min read</div>
            </div>
          </article>

          <!-- Card 3 -->
          <article class="devnahian-sportlixa-recovery-card">
            <div class="devnahian-sportlixa-recovery-thumb devnahian-sportlixa-img-box">
              <span class="devnahian-sportlixa-badge-tag devnahian-sportlixa-recovery-badge">INJURY WIRE</span>
              <img 
                src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d4/Lamar_Jackson_2020.jpg/800px-Lamar_Jackson_2020.jpg" 
                alt="Lamar Jackson"
                loading="lazy"
                onerror="this.src='https://images.unsplash.com/photo-1566577739112-5180d4bf9390?auto=format&fit=crop&w=800&q=80'"
              >
            </div>
            <div class="devnahian-sportlixa-recovery-content">
              <h3 class="devnahian-sportlixa-recovery-headline">
                <a href="single-post.html">Lamar Jackson Cleared of Ankle Protocol, Practicing Full</a>
              </h3>
              <div class="devnahian-sportlixa-meta-time">Oct 5, 2026 &bull; 3 min read</div>
            </div>
          </article>
        </div>
      </section>
    </section>
  </main>

<?php include ('footer.php');?>