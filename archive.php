<?php include ('header.php');?>

  <main id="primary" class="site-main devnahian-sportlixa-container">
    <!-- ==========================================================================
       ARCHIVE BANNER, BREADCRUMBS & SEASON VAULT SWITCHER
       ========================================================================== -->
    <header class="page-header devnahian-sportlixa-archive-banner">
      <nav class="devnahian-sportlixa-breadcrumbs" aria-label="Breadcrumb">
        <a href="index.html">Home</a>
        <span>/</span>
        <a href="#">Chronicle</a>
        <span>/</span>
        <span aria-current="page">Season Archive</span>
      </nav>

      <div class="devnahian-sportlixa-archive-title-row">
        <div>
          <span class="devnahian-sportlixa-badge-tag">HISTORICAL REPOSITORY</span>
          <h1 class="page-title devnahian-sportlixa-archive-heading" style="margin-top:10px;">The Season Vault</h1>
          <div class="archive-description devnahian-sportlixa-archive-desc">
            Explore our complete archive of over 14,800+ documented gamecasts, all-22 film studies, playoff race breakdowns, and clinical injury reports arranged chronologically.
          </div>
        </div>

        <div class="devnahian-sportlixa-meta-time" style="font-weight:700;">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--devnahian-sportlixa-brand-volt)" stroke-width="2.5"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
          Complete Archives: 2022 &ndash; 2026
        </div>
      </div>

      <!-- Year Season Vault Selector -->
      <div class="devnahian-sportlixa-vault-years-bar" role="tablist" aria-label="Season Archives">
        <button type="button" class="devnahian-sportlixa-year-chip active" role="tab" aria-selected="true" onclick="switchArchiveYear('2026', this)">
          <span class="season-label">Active Season</span>
          <span class="year-num">2026</span>
        </button>
        <button type="button" class="devnahian-sportlixa-year-chip" role="tab" aria-selected="false" onclick="switchArchiveYear('2025', this)">
          <span class="season-label">Championship</span>
          <span class="year-num">2025</span>
        </button>
        <button type="button" class="devnahian-sportlixa-year-chip" role="tab" aria-selected="false" onclick="switchArchiveYear('2024', this)">
          <span class="season-label">Completed</span>
          <span class="year-num">2024</span>
        </button>
        <button type="button" class="devnahian-sportlixa-year-chip" role="tab" aria-selected="false" onclick="switchArchiveYear('2023', this)">
          <span class="season-label">Completed</span>
          <span class="year-num">2023</span>
        </button>
        <button type="button" class="devnahian-sportlixa-year-chip" role="tab" aria-selected="false" onclick="switchArchiveYear('2022', this)">
          <span class="season-label">Inception</span>
          <span class="year-num">2022</span>
        </button>
      </div>
    </header>

    <!-- Month & Sport Filter Controls -->
    <div class="devnahian-sportlixa-archive-toolbar">
      <div class="devnahian-sportlixa-archive-months" role="group" aria-label="Filter by month">
        <button type="button" class="devnahian-sportlixa-filter-pill-btn active" onclick="filterArchiveMonth('all', this)">All Months (2026)</button>
        <button type="button" class="devnahian-sportlixa-filter-pill-btn" onclick="filterArchiveMonth('oct', this)">October (Current)</button>
        <button type="button" class="devnahian-sportlixa-filter-pill-btn" onclick="filterArchiveMonth('sep', this)">September</button>
        <button type="button" class="devnahian-sportlixa-filter-pill-btn" onclick="filterArchiveMonth('aug', this)">August</button>
        <button type="button" class="devnahian-sportlixa-filter-pill-btn" onclick="filterArchiveMonth('jul', this)">July</button>
      </div>

      <div class="devnahian-sportlixa-archive-sports" role="group" aria-label="Filter by sport category">
        <button type="button" class="devnahian-sportlixa-filter-pill-btn active" onclick="filterArchiveSport('all', this)">All Sports</button>
        <button type="button" class="devnahian-sportlixa-filter-pill-btn" onclick="filterArchiveSport('nfl', this)">NFL</button>
        <button type="button" class="devnahian-sportlixa-filter-pill-btn" onclick="filterArchiveSport('nba', this)">NBA</button>
        <button type="button" class="devnahian-sportlixa-filter-pill-btn" onclick="filterArchiveSport('mlb', this)">MLB</button>
        <button type="button" class="devnahian-sportlixa-filter-pill-btn" onclick="filterArchiveSport('soccer', this)">Soccer</button>
      </div>
    </div>

    <!-- ==========================================================================
       ARCHIVE 2-COLUMN LAYOUT (TIMELINE ENTRIES + SIDEBAR)
       ========================================================================== -->
    <div class="devnahian-sportlixa-archive-layout">
      <!-- Left Column: Chronological Story Timeline -->
      <section class="devnahian-sportlixa-archive-timeline" id="devnahian-sportlixa-timelineRoot">
        
        <!-- TIMELINE GROUP 1: OCTOBER 5, 2026 -->
        <div class="devnahian-sportlixa-timeline-group" data-month="oct">
          <div class="devnahian-sportlixa-timeline-group-header">
            <time class="devnahian-sportlixa-timeline-badge" datetime="2026-10-05">October 5, 2026</time>
            <div class="devnahian-sportlixa-timeline-line"></div>
          </div>

          <div class="devnahian-sportlixa-archive-entries-wrap">
            <!-- Entry 1 (WordPress article post type schema) -->
            <article id="post-101" class="post-101 post type-post status-publish format-standard has-post-thumbnail hentry category-nfl devnahian-sportlixa-archive-card" data-sport="nfl">
              <div class="post-thumbnail devnahian-sportlixa-archive-thumb devnahian-sportlixa-img-box">
                <span class="cat-links devnahian-sportlixa-badge-tag devnahian-sportlixa-archive-tag-pos"><a href="category.html">NFL FILM</a></span>
                <a href="single-post.html" tabindex="-1" aria-hidden="true">
                  <img 
                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/77/Patrick_Mahomes_gets_ready_to_snap_the_ball.jpg/800px-Patrick_Mahomes_gets_ready_to_snap_the_ball.jpg" 
                    alt="Patrick Mahomes reading defense pre-snap"
                    class="attachment-post-thumbnail size-post-thumbnail wp-post-image"
                    loading="lazy"
                    referrerpolicy="no-referrer"
                    onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1566577739112-5180d4bf9390?auto=format&fit=crop&w=800&q=80';"
                  >
                </a>
              </div>
              <div class="entry-body devnahian-sportlixa-archive-content">
                <header class="entry-header">
                  <h2 class="entry-title devnahian-sportlixa-archive-title">
                    <a href="single-post.html" rel="bookmark">Chiefs vs Bills: 5 Key Matchups That Decided the Week 5 Showdown</a>
                  </h2>
                </header>
                <div class="entry-summary devnahian-sportlixa-archive-excerpt">
                  <p>Kansas City exposed Buffalo's two-high quarters coverage in the red zone with pre-snap motion, leaving Andy Reid's offense firmly atop the AFC.</p>
                </div>
                <footer class="entry-footer devnahian-sportlixa-archive-footer">
                  <span class="entry-meta-author byline author vcard">By <a class="url fn n" href="about-us.html">Marcus Thompson</a> &bull; 6 min read</span>
                  <a href="single-post.html" class="devnahian-sportlixa-title-link more-link">Read Archive &rarr;</a>
                </footer>
              </div>
            </article>

            <!-- Entry 2 -->
            <article id="post-102" class="post-102 post type-post status-publish format-standard has-post-thumbnail hentry category-nba devnahian-sportlixa-archive-card" data-sport="nba">
              <div class="post-thumbnail devnahian-sportlixa-archive-thumb devnahian-sportlixa-img-box">
                <span class="cat-links devnahian-sportlixa-badge-tag devnahian-sportlixa-archive-tag-pos"><a href="#nba">NBA RECAP</a></span>
                <a href="single-post.html" tabindex="-1" aria-hidden="true">
                  <img 
                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/bf/LeBron_James_-_51959723161_%28cropped%29.jpg/800px-LeBron_James_-_51959723161_%28cropped%29.jpg" 
                    alt="LeBron James shooting free throw"
                    class="attachment-post-thumbnail size-post-thumbnail wp-post-image"
                    loading="lazy"
                    referrerpolicy="no-referrer"
                    onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1546519638-68e109498ffc?auto=format&fit=crop&w=800&q=80';"
                  >
                </a>
              </div>
              <div class="entry-body devnahian-sportlixa-archive-content">
                <header class="entry-header">
                  <h2 class="entry-title devnahian-sportlixa-archive-title">
                    <a href="single-post.html" rel="bookmark">Lakers Edge Celtics 98-94 Behind LeBron James' 28-Point Masterclass</a>
                  </h2>
                </header>
                <div class="entry-summary devnahian-sportlixa-archive-excerpt">
                  <p>In a tense fourth-quarter battle at TD Garden, Los Angeles secured defensive stops on three straight possessions to capture the rivalry win.</p>
                </div>
                <footer class="entry-footer devnahian-sportlixa-archive-footer">
                  <span class="entry-meta-author byline author vcard">By <a class="url fn n" href="about-us.html">Elena Vance</a> &bull; 4 min read</span>
                  <a href="single-post.html" class="devnahian-sportlixa-title-link more-link">Read Archive &rarr;</a>
                </footer>
              </div>
            </article>
          </div>
        </div>

        <!-- TIMELINE GROUP 2: OCTOBER 4, 2026 -->
        <div class="devnahian-sportlixa-timeline-group" data-month="oct">
          <div class="devnahian-sportlixa-timeline-group-header">
            <time class="devnahian-sportlixa-timeline-badge" datetime="2026-10-04">October 4, 2026</time>
            <div class="devnahian-sportlixa-timeline-line"></div>
          </div>

          <div class="devnahian-sportlixa-archive-entries-wrap">
            <!-- Entry 3 -->
            <article id="post-103" class="post-103 post type-post status-publish format-standard has-post-thumbnail hentry category-nfl devnahian-sportlixa-archive-card" data-sport="nfl">
              <div class="post-thumbnail devnahian-sportlixa-archive-thumb devnahian-sportlixa-img-box">
                <span class="cat-links devnahian-sportlixa-badge-tag devnahian-sportlixa-archive-tag-pos"><a href="category.html">INJURY WIRE</a></span>
                <a href="single-post.html" tabindex="-1" aria-hidden="true">
                  <img 
                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d4/Lamar_Jackson_2020.jpg/800px-Lamar_Jackson_2020.jpg" 
                    alt="Lamar Jackson on the sideline"
                    class="attachment-post-thumbnail size-post-thumbnail wp-post-image"
                    loading="lazy"
                    referrerpolicy="no-referrer"
                    onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1566577739112-5180d4bf9390?auto=format&fit=crop&w=800&q=80';"
                  >
                </a>
              </div>
              <div class="entry-body devnahian-sportlixa-archive-content">
                <header class="entry-header">
                  <h2 class="entry-title devnahian-sportlixa-archive-title">
                    <a href="single-post.html" rel="bookmark">Lamar Jackson Clears Ankle Protocol Ahead of Divisional Clash</a>
                  </h2>
                </header>
                <div class="entry-summary devnahian-sportlixa-archive-excerpt">
                  <p>Baltimore's medical staff reported no structural tendon damage, enabling full mobility for standard option packages on Sunday.</p>
                </div>
                <footer class="entry-footer devnahian-sportlixa-archive-footer">
                  <span class="entry-meta-author byline author vcard">By <a class="url fn n" href="about-us.html">Adam Schefter</a> &bull; 3 min read</span>
                  <a href="single-post.html" class="devnahian-sportlixa-title-link more-link">Read Archive &rarr;</a>
                </footer>
              </div>
            </article>

            <!-- Entry 4 -->
            <article id="post-104" class="post-104 post type-post status-publish format-standard has-post-thumbnail hentry category-mlb devnahian-sportlixa-archive-card" data-sport="mlb">
              <div class="post-thumbnail devnahian-sportlixa-archive-thumb devnahian-sportlixa-img-box">
                <span class="cat-links devnahian-sportlixa-badge-tag devnahian-sportlixa-archive-tag-pos"><a href="#mlb">MLB WILD CARD</a></span>
                <a href="single-post.html" tabindex="-1" aria-hidden="true">
                  <img 
                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/ba/Aaron_Judge_batting_2022_%28cropped%29.jpg/800px-Aaron_Judge_batting_2022_%28cropped%29.jpg" 
                    alt="Aaron Judge batting stance"
                    class="attachment-post-thumbnail size-post-thumbnail wp-post-image"
                    loading="lazy"
                    referrerpolicy="no-referrer"
                    onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1508344928928-7165b67de128?auto=format&fit=crop&w=800&q=80';"
                  >
                </a>
              </div>
              <div class="entry-body devnahian-sportlixa-archive-content">
                <header class="entry-header">
                  <h2 class="entry-title devnahian-sportlixa-archive-title">
                    <a href="single-post.html" rel="bookmark">Yankees Take AL Wild Card Opener With 5-3 Victory at Fenway</a>
                  </h2>
                </header>
                <div class="entry-summary devnahian-sportlixa-archive-excerpt">
                  <p>Aaron Judge blasted a 438-foot solo shot into center field as the New York bullpen slammed the door with three scoreless relief innings.</p>
                </div>
                <footer class="entry-footer devnahian-sportlixa-archive-footer">
                  <span class="entry-meta-author byline author vcard">By <a class="url fn n" href="about-us.html">Jeff Passan</a> &bull; 5 min read</span>
                  <a href="single-post.html" class="devnahian-sportlixa-title-link more-link">Read Archive &rarr;</a>
                </footer>
              </div>
            </article>
          </div>
        </div>

        <!-- TIMELINE GROUP 3: SEPTEMBER 28, 2026 -->
        <div class="devnahian-sportlixa-timeline-group" data-month="sep">
          <div class="devnahian-sportlixa-timeline-group-header">
            <time class="devnahian-sportlixa-timeline-badge" datetime="2026-09-28">September 28, 2026</time>
            <div class="devnahian-sportlixa-timeline-line"></div>
          </div>

          <div class="devnahian-sportlixa-archive-entries-wrap">
            <!-- Entry 5 -->
            <article id="post-105" class="post-105 post type-post status-publish format-standard has-post-thumbnail hentry category-soccer devnahian-sportlixa-archive-card" data-sport="soccer">
              <div class="post-thumbnail devnahian-sportlixa-archive-thumb devnahian-sportlixa-img-box">
                <span class="cat-links devnahian-sportlixa-badge-tag devnahian-sportlixa-archive-tag-pos"><a href="#soccer">MLS REPORT</a></span>
                <a href="single-post.html" tabindex="-1" aria-hidden="true">
                  <img 
                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b4/Lionel-Messi-Argentina-2022-FIFA-World-Cup_%28cropped%29.jpg/800px-Lionel-Messi-Argentina-2022-FIFA-World-Cup_%28cropped%29.jpg" 
                    alt="Lionel Messi in action"
                    class="attachment-post-thumbnail size-post-thumbnail wp-post-image"
                    loading="lazy"
                    referrerpolicy="no-referrer"
                    onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1508098682722-e99c43a406b2?auto=format&fit=crop&w=800&q=80';"
                  >
                </a>
              </div>
              <div class="entry-body devnahian-sportlixa-archive-content">
                <header class="entry-header">
                  <h2 class="entry-title devnahian-sportlixa-archive-title">
                    <a href="single-post.html" rel="bookmark">Messi Delivers Two Masterful Assists in Inter Miami 3-1 Triumph</a>
                  </h2>
                </header>
                <div class="entry-summary devnahian-sportlixa-archive-excerpt">
                  <p>Precision set-piece execution secured three vital points as Miami solidifies home-pitch advantage for the upcoming Eastern Conference playoffs.</p>
                </div>
                <footer class="entry-footer devnahian-sportlixa-archive-footer">
                  <span class="entry-meta-author byline author vcard">By <a class="url fn n" href="about-us.html">Liam Sterling</a> &bull; 4 min read</span>
                  <a href="single-post.html" class="devnahian-sportlixa-title-link more-link">Read Archive &rarr;</a>
                </footer>
              </div>
            </article>
          </div>
        </div>

      </section>

      <!-- Right Column: Sidebar (WordPress widget-area structure) -->
      <aside id="secondary" class="widget-area devnahian-sportlixa-archive-sidebar" aria-label="Archive Sidebar">
        <!-- Widget 1: Vault Overview -->
        <section id="vault_stats_widget-1" class="widget devnahian-sportlixa-vault-stats-card">
          <div class="devnahian-sportlixa-section-title" style="margin-bottom:0">
            <h2 class="widget-title devnahian-sportlixa-title-left" style="font-size:12.5px;">VAULT INDEX OVERVIEW</h2>
          </div>
          <ul class="devnahian-sportlixa-stats-list">
            <li class="devnahian-sportlixa-stat-row">
              <span>Articles in Vault</span>
              <span class="devnahian-sportlixa-stat-val-bold">14,842</span>
            </li>
            <li class="devnahian-sportlixa-stat-row">
              <span>Box Scores Preserved</span>
              <span class="devnahian-sportlixa-stat-val-bold">5,210</span>
            </li>
            <li class="devnahian-sportlixa-stat-row">
              <span>All-22 Film Studies</span>
              <span class="devnahian-sportlixa-stat-val-bold">1,480</span>
            </li>
            <li class="devnahian-sportlixa-stat-row">
              <span>Verified Injury Logs</span>
              <span class="devnahian-sportlixa-stat-val-bold">3,912</span>
            </li>
          </ul>
        </section>

        <!-- Widget 2: Milestone Reel -->
        <section id="milestone_widget-1" class="widget devnahian-sportlixa-milestone-card">
          <span class="devnahian-sportlixa-milestone-tag">ARCHIVED MILESTONE</span>
          <h3 class="widget-title devnahian-sportlixa-milestone-title">Super Bowl LVIII: Complete 4th Quarter &amp; Overtime Film Vault</h3>
          <p style="font-size:11.5px; color:var(--devnahian-sportlixa-text-muted); line-height:1.45;">
            Revisit every pass rush split, blitz pickup, and playcall chart from the legendary overtime battle in Las Vegas.
          </p>
          <a href="single-post.html" class="devnahian-sportlixa-title-link" style="margin-top:4px;">Open Vault Reel &rarr;</a>
        </section>

        <!-- Widget 3: Popular Archives -->
        <section id="trending_archive_widget-1" class="widget devnahian-sportlixa-trending-box">
          <h2 class="widget-title devnahian-sportlixa-trending-header">MOST VIEWED ARCHIVES</h2>
          <ol class="devnahian-sportlixa-trending-list">
            <li class="devnahian-sportlixa-trending-item">
              <span class="devnahian-sportlixa-trending-num" aria-hidden="true">1</span>
              <a href="single-post.html">Mahomes vs Allen 2024 AFC Championship</a>
            </li>
            <li class="devnahian-sportlixa-trending-item">
              <span class="devnahian-sportlixa-trending-num" aria-hidden="true">2</span>
              <a href="single-post.html">Celtics 2024 Finals Defensive Rating</a>
            </li>
            <li class="devnahian-sportlixa-trending-item">
              <span class="devnahian-sportlixa-trending-num" aria-hidden="true">3</span>
              <a href="single-post.html">Aaron Judge 62 Home Run Season Log</a>
            </li>
            <li class="devnahian-sportlixa-trending-item">
              <span class="devnahian-sportlixa-trending-num" aria-hidden="true">4</span>
              <a href="single-post.html">Messi Inter Miami Leagues Cup Run</a>
            </li>
          </ol>
        </section>
      </aside>
    </div>

    <!-- Standard WordPress Pagination Markup -->
    <nav class="navigation pagination" aria-label="Posts">
      <h2 class="screen-reader-text">Posts navigation</h2>
      <div class="nav-links devnahian-sportlixa-pagination-wrap">
        <a class="prev page-numbers" href="#" onclick="event.preventDefault(); showToast('Loading previous archive page');" aria-label="Previous page">&laquo;</a>
        <span aria-current="page" class="page-numbers current">1</span>
        <a class="page-numbers" href="#" onclick="event.preventDefault(); showToast('Loading archive page 2');">2</a>
        <a class="page-numbers" href="#" onclick="event.preventDefault(); showToast('Loading archive page 3');">3</a>
        <span class="page-numbers dots">&hellip;</span>
        <a class="page-numbers" href="#" onclick="event.preventDefault(); showToast('Loading archive page 42');">42</a>
        <a class="next page-numbers" href="#" onclick="event.preventDefault(); showToast('Loading next archive page');" aria-label="Next page">&raquo;</a>
      </div>
    </nav>
  </main>

  <?php include ('footer.php');?>