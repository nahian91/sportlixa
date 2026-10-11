<?php include ('header.php');?>

  <main class="devnahian-sportlixa-container">
    <!-- ==========================================================================
       CATEGORY BANNER & BREADCRUMBS
       ========================================================================== -->
    <section class="devnahian-sportlixa-category-banner">
      <div class="devnahian-sportlixa-breadcrumbs">
        <a href="index.html">Home</a>
        <span>/</span>
        <a href="#">Leagues</a>
        <span>/</span>
        <span>NFL</span>
      </div>

      <div class="devnahian-sportlixa-category-title-row">
        <div class="devnahian-sportlixa-category-head-left">
          <div class="devnahian-sportlixa-category-season-pill">
            <span class="devnahian-sportlixa-ticker-pulse-dot" style="background:var(--devnahian-sportlixa-brand-volt)"></span>
            Week 5 &bull; 2026 Regular Season
          </div>
          <h1 class="devnahian-sportlixa-category-heading">NFL Hub</h1>
          <p class="devnahian-sportlixa-category-desc">
            Complete insider coverage: real-time live scoring, division standings, MVP metrics, injury wire wire updates, and matchup film analysis.
          </p>
        </div>

        <div class="devnahian-sportlixa-category-subnav">
          <button type="button" class="devnahian-sportlixa-subnav-btn active" onclick="switchCategoryTab('all', this)">All Stories</button>
          <button type="button" class="devnahian-sportlixa-subnav-btn" onclick="switchCategoryTab('recaps', this)">Game Recaps</button>
          <button type="button" class="devnahian-sportlixa-subnav-btn" onclick="switchCategoryTab('film', this)">Film Analysis</button>
          <button type="button" class="devnahian-sportlixa-subnav-btn" onclick="switchCategoryTab('injury', this)">Injury Wire</button>
          <button type="button" class="devnahian-sportlixa-subnav-btn" onclick="switchCategoryTab('fantasy', this)">Fantasy Sleepers</button>
        </div>
      </div>
    </section>

    <!-- ==========================================================================
       CATEGORY LIVE SCORES STRIP (CONTAINED, MATCHING HOME)
       ========================================================================== -->
    <section class="devnahian-sportlixa-live-scores-container-block" id="scores">
      <div class="devnahian-sportlixa-scores-header">
        <div class="devnahian-sportlixa-title-left" style="font-size:13px;">NFL WEEK 5 LIVE SCOREBOARD</div>
        <div class="devnahian-sportlixa-meta-time">Updated live &bull; Official NFL Feed</div>
      </div>

      <div class="devnahian-sportlixa-live-scores-scroller">
        <span class="devnahian-sportlixa-live-pill">&bull; LIVE</span>

        <!-- Game 1: Chiefs vs Bills -->
        <div class="devnahian-sportlixa-score-card">
          <div class="devnahian-sportlixa-score-card-header">
            <span>WEEK 5</span>
            <span class="live-indicator">LIVE</span>
          </div>
          <div class="devnahian-sportlixa-score-match-row">
            <div class="devnahian-sportlixa-score-team-side">
              <svg class="devnahian-sportlixa-team-crest-svg" viewBox="0 0 40 40">
                <polygon points="4,20 34,6 38,20 34,34" fill="#E31837" stroke="#FFB81C" stroke-width="2"/>
                <text x="20" y="24" fill="#fff" font-size="10" font-weight="900" text-anchor="middle">KC</text>
              </svg>
              <span class="devnahian-sportlixa-team-code">KC</span>
            </div>
            <div class="devnahian-sportlixa-score-board-nums">
              <span class="lead-score">24</span>
              <span class="score-hyphen">-</span>
              <span>17</span>
            </div>
            <div class="devnahian-sportlixa-score-team-side">
              <span class="devnahian-sportlixa-team-code">BUF</span>
              <svg class="devnahian-sportlixa-team-crest-svg" viewBox="0 0 40 40">
                <rect x="4" y="8" width="32" height="24" rx="4" fill="#00338D"/>
                <line x1="6" y1="20" x2="34" y2="20" stroke="#C60C30" stroke-width="3"/>
                <text x="20" y="24" fill="#fff" font-size="9" font-weight="900" text-anchor="middle">BUF</text>
              </svg>
            </div>
          </div>
          <div class="devnahian-sportlixa-score-time-status">
            <span>Q4 02:34</span>
            <span class="possession-dot">&#9670; KC Poss</span>
          </div>
        </div>

        <!-- Game 2: Ravens vs Bengals -->
        <div class="devnahian-sportlixa-score-card">
          <div class="devnahian-sportlixa-score-card-header">
            <span>WEEK 5</span>
            <span class="live-indicator">LIVE</span>
          </div>
          <div class="devnahian-sportlixa-score-match-row">
            <div class="devnahian-sportlixa-score-team-side">
              <svg class="devnahian-sportlixa-team-crest-svg" viewBox="0 0 40 40">
                <circle cx="20" cy="20" r="16" fill="#241773"/>
                <text x="20" y="24" fill="#fff" font-size="9" font-weight="900" text-anchor="middle">BAL</text>
              </svg>
              <span class="devnahian-sportlixa-team-code">BAL</span>
            </div>
            <div class="devnahian-sportlixa-score-board-nums">
              <span class="lead-score">31</span>
              <span class="score-hyphen">-</span>
              <span>28</span>
            </div>
            <div class="devnahian-sportlixa-score-team-side">
              <span class="devnahian-sportlixa-team-code">CIN</span>
              <svg class="devnahian-sportlixa-team-crest-svg" viewBox="0 0 40 40">
                <circle cx="20" cy="20" r="16" fill="#FB4F14"/>
                <text x="20" y="24" fill="#000" font-size="9" font-weight="900" text-anchor="middle">CIN</text>
              </svg>
            </div>
          </div>
          <div class="devnahian-sportlixa-score-time-status">
            <span>Q4 08:15</span>
            <span class="possession-dot">&#9670; CIN Red Zone</span>
          </div>
        </div>

        <!-- Game 3: 49ers vs Rams -->
        <div class="devnahian-sportlixa-score-card">
          <div class="devnahian-sportlixa-score-card-header">
            <span>WEEK 5</span>
            <span style="color:var(--devnahian-sportlixa-text-dim)">FINAL</span>
          </div>
          <div class="devnahian-sportlixa-score-match-row">
            <div class="devnahian-sportlixa-score-team-side">
              <svg class="devnahian-sportlixa-team-crest-svg" viewBox="0 0 40 40">
                <circle cx="20" cy="20" r="16" fill="#AA0000"/>
                <text x="20" y="24" fill="#B3995D" font-size="9" font-weight="900" text-anchor="middle">SF</text>
              </svg>
              <span class="devnahian-sportlixa-team-code">SF</span>
            </div>
            <div class="devnahian-sportlixa-score-board-nums">
              <span class="lead-score">30</span>
              <span class="score-hyphen">-</span>
              <span>23</span>
            </div>
            <div class="devnahian-sportlixa-score-team-side">
              <span class="devnahian-sportlixa-team-code">LAR</span>
              <svg class="devnahian-sportlixa-team-crest-svg" viewBox="0 0 40 40">
                <circle cx="20" cy="20" r="16" fill="#003594"/>
                <text x="20" y="24" fill="#FFA300" font-size="8" font-weight="900" text-anchor="middle">LAR</text>
              </svg>
            </div>
          </div>
          <div class="devnahian-sportlixa-score-time-status">
            <span>FINAL</span>
            <span>Purdy: 3 TD</span>
          </div>
        </div>

        <!-- Game 4: Cowboys vs Eagles -->
        <div class="devnahian-sportlixa-score-card">
          <div class="devnahian-sportlixa-score-card-header">
            <span>WEEK 5</span>
            <span style="color:var(--devnahian-sportlixa-brand-volt-text)">TODAY 8:20 PM</span>
          </div>
          <div class="devnahian-sportlixa-score-match-row">
            <div class="devnahian-sportlixa-score-team-side">
              <svg class="devnahian-sportlixa-team-crest-svg" viewBox="0 0 40 40">
                <circle cx="20" cy="20" r="16" fill="#003594"/>
                <text x="20" y="24" fill="#fff" font-size="9" font-weight="900" text-anchor="middle">DAL</text>
              </svg>
              <span class="devnahian-sportlixa-team-code">DAL</span>
            </div>
            <div class="devnahian-sportlixa-score-board-nums">
              <span>--</span>
              <span class="score-hyphen">-</span>
              <span>--</span>
            </div>
            <div class="devnahian-sportlixa-score-team-side">
              <span class="devnahian-sportlixa-team-code">PHI</span>
              <svg class="devnahian-sportlixa-team-crest-svg" viewBox="0 0 40 40">
                <circle cx="20" cy="20" r="16" fill="#004C54"/>
                <text x="20" y="24" fill="#fff" font-size="9" font-weight="900" text-anchor="middle">PHI</text>
              </svg>
            </div>
          </div>
          <div class="devnahian-sportlixa-score-time-status">
            <span>NBC SUN NIGHT</span>
            <span>Line: PHI -3.5</span>
          </div>
        </div>
      </div>
    </section>

    <!-- ==========================================================================
       MAIN CATEGORY LAYOUT (FEED + SIDEBAR)
       ========================================================================== -->
    <div class="devnahian-sportlixa-cat-main-layout">
      <!-- Left Column: Story Feed & Toolbar -->
      <div>
        <div class="devnahian-sportlixa-feed-toolbar">
          <div class="devnahian-sportlixa-feed-filter-tags">
            <button type="button" class="devnahian-sportlixa-feed-tag-btn active" onclick="filterCategoryFeed('all', this)">All (12)</button>
            <button type="button" class="devnahian-sportlixa-feed-tag-btn" onclick="filterCategoryFeed('breaking', this)">Breaking</button>
            <button type="button" class="devnahian-sportlixa-feed-tag-btn" onclick="filterCategoryFeed('film', this)">Film Room</button>
            <button type="button" class="devnahian-sportlixa-feed-tag-btn" onclick="filterCategoryFeed('fantasy', this)">Fantasy</button>
          </div>

          <div class="devnahian-sportlixa-view-toggles">
            <span style="font-size:11px; color:var(--devnahian-sportlixa-text-dim); text-transform:uppercase; font-weight:800;">Layout:</span>
            <button type="button" class="devnahian-sportlixa-btn-view-mode active" id="devnahian-sportlixa-btnGridView" onclick="toggleFeedLayout('grid')" aria-label="Grid View">
              <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
            </button>
            <button type="button" class="devnahian-sportlixa-btn-view-mode" id="devnahian-sportlixa-btnListView" onclick="toggleFeedLayout('list')" aria-label="List View">
              <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
            </button>
          </div>
        </div>

        <!-- Article Feed Grid (Supports Grid or List View) -->
        <div class="devnahian-sportlixa-feed-grid" id="devnahian-sportlixa-articleFeed">
          
          <!-- Article 1 -->
          <article class="devnahian-sportlixa-article-card" data-category="breaking">
            <div class="devnahian-sportlixa-card-thumb-wrap devnahian-sportlixa-img-box">
              <span class="devnahian-sportlixa-badge-tag devnahian-sportlixa-card-badge">BREAKING</span>
              <img 
                src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/77/Patrick_Mahomes_gets_ready_to_snap_the_ball.jpg/800px-Patrick_Mahomes_gets_ready_to_snap_the_ball.jpg" 
                alt="Patrick Mahomes" 
                loading="lazy"
                onerror="this.src='https://images.unsplash.com/photo-1566577739112-5180d4bf9390?auto=format&fit=crop&w=800&q=80'"
              >
            </div>
            <div class="devnahian-sportlixa-card-content">
              <div>
                <a href="#article" class="devnahian-sportlixa-card-headline">Chiefs vs Bills: 5 Tactical Adjustments Mahomes Made in the Red Zone</a>
                <p class="devnahian-sportlixa-card-excerpt">Kansas City introduced bunch formations to exploit Buffalo's two-high shell, creating clean seams for rookie wideouts.</p>
              </div>
              <div class="devnahian-sportlixa-card-footer">
                <span>By Dan Orlovsky &bull; 4 min read</span>
                <div class="devnahian-sportlixa-card-actions">
                  <button type="button" class="devnahian-sportlixa-btn-action-icon" onclick="bookmarkArticle(this)" aria-label="Bookmark article">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/></svg>
                  </button>
                  <button type="button" class="devnahian-sportlixa-btn-action-icon" onclick="shareArticle('Chiefs vs Bills')" aria-label="Share article">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg>
                  </button>
                </div>
              </div>
            </div>
          </article>

          <!-- Article 2 -->
          <article class="devnahian-sportlixa-article-card" data-category="film">
            <div class="devnahian-sportlixa-card-thumb-wrap devnahian-sportlixa-img-box">
              <span class="devnahian-sportlixa-badge-tag devnahian-sportlixa-card-badge">FILM ROOM</span>
              <img 
                src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/50/Josh_Allen_SEPT2021_%28cropped%29.jpg/800px-Josh_Allen_SEPT2021_%28cropped%29.jpg" 
                alt="Josh Allen" 
                loading="lazy"
                onerror="this.src='https://images.unsplash.com/photo-1566577739112-5180d4bf9390?auto=format&fit=crop&w=800&q=80'"
              >
            </div>
            <div class="devnahian-sportlixa-card-content">
              <div>
                <a href="#article" class="devnahian-sportlixa-card-headline">Josh Allen's MVP Case: Why His EPA per Dropback Leads All Quarterbacks</a>
                <p class="devnahian-sportlixa-card-excerpt">A deep statistical breakdown of Allen's pre-snap audibles and lethal second-reaction accuracy through the first five games.</p>
              </div>
              <div class="devnahian-sportlixa-card-footer">
                <span>By Mina Kimes &bull; 6 min read</span>
                <div class="devnahian-sportlixa-card-actions">
                  <button type="button" class="devnahian-sportlixa-btn-action-icon" onclick="bookmarkArticle(this)" aria-label="Bookmark article">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/></svg>
                  </button>
                  <button type="button" class="devnahian-sportlixa-btn-action-icon" onclick="shareArticle('Josh Allen MVP Breakdown')" aria-label="Share article">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg>
                  </button>
                </div>
              </div>
            </div>
          </article>

          <!-- Article 3 -->
          <article class="devnahian-sportlixa-article-card" data-category="fantasy">
            <div class="devnahian-sportlixa-card-thumb-wrap devnahian-sportlixa-img-box">
              <span class="devnahian-sportlixa-badge-tag devnahian-sportlixa-card-badge">FANTASY</span>
              <img 
                src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/07/Kenneth_Walker_III.jpg/800px-Kenneth_Walker_III.jpg" 
                alt="Kenneth Walker III" 
                loading="lazy"
                onerror="this.src='https://images.unsplash.com/photo-1566577739112-5180d4bf9390?auto=format&fit=crop&w=800&q=80'"
              >
            </div>
            <div class="devnahian-sportlixa-card-content">
              <div>
                <a href="#article" class="devnahian-sportlixa-card-headline">Week 6 Waiver Wire Targets & Must-Start Sleepers</a>
                <p class="devnahian-sportlixa-card-excerpt">With key running backs landing on injured reserve, here are three high-upside handcuffs to stash immediately.</p>
              </div>
              <div class="devnahian-sportlixa-card-footer">
                <span>By Field Yates &bull; 5 min read</span>
                <div class="devnahian-sportlixa-card-actions">
                  <button type="button" class="devnahian-sportlixa-btn-action-icon" onclick="bookmarkArticle(this)" aria-label="Bookmark article">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/></svg>
                  </button>
                  <button type="button" class="devnahian-sportlixa-btn-action-icon" onclick="shareArticle('Waiver Wire Sleepers')" aria-label="Share article">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg>
                  </button>
                </div>
              </div>
            </div>
          </article>

          <!-- Article 4 -->
          <article class="devnahian-sportlixa-article-card" data-category="breaking">
            <div class="devnahian-sportlixa-card-thumb-wrap devnahian-sportlixa-img-box">
              <span class="devnahian-sportlixa-badge-tag devnahian-sportlixa-card-badge">INJURY WIRE</span>
              <img 
                src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d4/Lamar_Jackson_2020.jpg/800px-Lamar_Jackson_2020.jpg" 
                alt="Lamar Jackson" 
                loading="lazy"
                onerror="this.src='https://images.unsplash.com/photo-1566577739112-5180d4bf9390?auto=format&fit=crop&w=800&q=80'"
              >
            </div>
            <div class="devnahian-sportlixa-card-content">
              <div>
                <a href="#article" class="devnahian-sportlixa-card-headline">Lamar Jackson Clears Ankle Protocol, Practicing With No Limitations</a>
                <p class="devnahian-sportlixa-card-excerpt">Baltimore's medical staff confirmed the dual-threat quarterback suffered zero structural setback following MRI exams.</p>
              </div>
              <div class="devnahian-sportlixa-card-footer">
                <span>By Adam Schefter &bull; 3 min read</span>
                <div class="devnahian-sportlixa-card-actions">
                  <button type="button" class="devnahian-sportlixa-btn-action-icon" onclick="bookmarkArticle(this)" aria-label="Bookmark article">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/></svg>
                  </button>
                  <button type="button" class="devnahian-sportlixa-btn-action-icon" onclick="shareArticle('Lamar Jackson Status Update')" aria-label="Share article">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg>
                  </button>
                </div>
              </div>
            </div>
          </article>
        </div>

        <div class="devnahian-sportlixa-load-more-wrap">
          <button type="button" class="devnahian-sportlixa-btn-load-more" id="devnahian-sportlixa-btnLoadMore" onclick="loadMoreArticles()">
            <span>Load More Stories</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="6 9 12 15 18 9"/></svg>
          </button>
        </div>
      </div>

      <!-- Right Column: Sidebar -->
      <aside class="devnahian-sportlixa-cat-sidebar">
        <!-- Division Standings Card -->
        <div class="devnahian-sportlixa-nfl-standings-box" id="standings">
          <div class="devnahian-sportlixa-standings-tabs">
            <button class="devnahian-sportlixa-tab-btn active" id="devnahian-sportlixa-tabAfcBtn">AFC Playoff Race</button>
            <button class="devnahian-sportlixa-tab-btn" id="devnahian-sportlixa-tabNfcBtn">NFC</button>
          </div>
          <div class="devnahian-sportlixa-table-responsive-wrapper">
            <table class="devnahian-sportlixa-standings-table">
              <thead>
                <tr>
                  <th>Team</th>
                  <th>W</th>
                  <th>L</th>
                  <th>PCT</th>
                  <th>STRK</th>
                </tr>
              </thead>
              <tbody id="devnahian-sportlixa-standingsTableBody">
                <tr>
                  <td class="devnahian-sportlixa-team-cell"><span class="devnahian-sportlixa-rank-dot">1</span> KC Chiefs</td>
                  <td>4</td>
                  <td>0</td>
                  <td>1.000</td>
                  <td class="devnahian-sportlixa-streak-green">4W</td>
                </tr>
                <tr>
                  <td class="devnahian-sportlixa-team-cell"><span class="devnahian-sportlixa-rank-dot">2</span> BUF Bills</td>
                  <td>3</td>
                  <td>1</td>
                  <td>.750</td>
                  <td>1W</td>
                </tr>
                <tr>
                  <td class="devnahian-sportlixa-team-cell"><span class="devnahian-sportlixa-rank-dot">3</span> BAL Ravens</td>
                  <td>3</td>
                  <td>1</td>
                  <td>.750</td>
                  <td class="devnahian-sportlixa-streak-green">2W</td>
                </tr>
                <tr>
                  <td class="devnahian-sportlixa-team-cell"><span class="devnahian-sportlixa-rank-dot">4</span> JAX Jaguars</td>
                  <td>3</td>
                  <td>1</td>
                  <td>.750</td>
                  <td class="devnahian-sportlixa-streak-green">2W</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Stat Leaders -->
        <div class="devnahian-sportlixa-nfl-leaders-box">
          <div class="devnahian-sportlixa-section-title" style="margin-bottom:0">
            <div class="devnahian-sportlixa-title-left" style="font-size:12.5px;">NFL STAT LEADERS</div>
          </div>
          
          <div class="devnahian-sportlixa-leader-row">
            <div class="devnahian-sportlixa-leader-player-wrap">
              <div class="devnahian-sportlixa-leader-avatar">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/77/Patrick_Mahomes_gets_ready_to_snap_the_ball.jpg/300px-Patrick_Mahomes_gets_ready_to_snap_the_ball.jpg" alt="Patrick Mahomes">
              </div>
              <div>
                <div class="devnahian-sportlixa-leader-player-name">P. Mahomes</div>
                <div class="devnahian-sportlixa-leader-cat">Pass Yds &bull; KC</div>
              </div>
            </div>
            <div class="devnahian-sportlixa-leader-stat">
              <div class="devnahian-sportlixa-leader-value">1,315</div>
              <div class="devnahian-sportlixa-leader-unit">11 TD</div>
            </div>
          </div>

          <div class="devnahian-sportlixa-leader-row">
            <div class="devnahian-sportlixa-leader-player-wrap">
              <div class="devnahian-sportlixa-leader-avatar">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/07/Kenneth_Walker_III.jpg/300px-Kenneth_Walker_III.jpg" alt="Kenneth Walker">
              </div>
              <div>
                <div class="devnahian-sportlixa-leader-player-name">K. Walker III</div>
                <div class="devnahian-sportlixa-leader-cat">Rush Yds &bull; SEA</div>
              </div>
            </div>
            <div class="devnahian-sportlixa-leader-stat">
              <div class="devnahian-sportlixa-leader-value">537</div>
              <div class="devnahian-sportlixa-leader-unit">6 TD</div>
            </div>
          </div>
        </div>

        <!-- SportLixa Audio / Podcast Episode -->
        <div class="devnahian-sportlixa-audio-widget-card">
          <div class="devnahian-sportlixa-audio-badge">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14"/></svg>
            SPORTLIXA NFL PODCAST
          </div>
          <h4 class="devnahian-sportlixa-audio-title">The Tape Never Lies: Breaking Down Week 5 Coverages & Trade Targets</h4>
          <p style="font-size:11.5px; color:var(--devnahian-sportlixa-text-muted);">Hosted by Brian Baldinger &bull; Ep 142 &bull; 34 mins</p>
          <div class="devnahian-sportlixa-audio-player-row">
            <button type="button" class="devnahian-sportlixa-btn-play-pill" onclick="showToast('Streaming SportLixa NFL Podcast...')">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg>
              LISTEN NOW
            </button>
            <span style="font-size:11px; color:var(--devnahian-sportlixa-text-dim)">Apple &bull; Spotify</span>
          </div>
        </div>

        <!-- Trending in NFL -->
        <div class="devnahian-sportlixa-trending-box">
          <div class="devnahian-sportlixa-trending-header">TRENDING IN NFL</div>
          <ol class="devnahian-sportlixa-trending-list">
            <li class="devnahian-sportlixa-trending-item">
              <span class="devnahian-sportlixa-trending-num">1</span>
              <a href="#article">Mahomes vs Allen Head-to-Head History</a>
            </li>
            <li class="devnahian-sportlixa-trending-item">
              <span class="devnahian-sportlixa-trending-num">2</span>
              <a href="#article">Davante Adams Trade Destination Odds</a>
            </li>
            <li class="devnahian-sportlixa-trending-item">
              <span class="devnahian-sportlixa-trending-num">3</span>
              <a href="#article">NFC North Wild Card Standings Battle</a>
            </li>
            <li class="devnahian-sportlixa-trending-item">
              <span class="devnahian-sportlixa-trending-num">4</span>
              <a href="#article">Week 6 Power Rankings Top 10</a>
            </li>
          </ol>
        </div>
      </aside>
    </div>
  </main>

<?php include ('footer.php');?>