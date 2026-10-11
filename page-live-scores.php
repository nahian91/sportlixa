<?php
/**
 * Template Name: Live Score Center Hub
 * Description: Displays comprehensive real-time scores, period telemetry, and game status.
 *
 * @package Sportlixa
 */

get_header();

// Fetch live scores data from the ESPN API helper
$all_games = function_exists( 'sportlixa_get_espn_live_scores' ) ? sportlixa_get_espn_live_scores() : [];

// Aggregate telemetry metrics
$sport_counts = [
    'all'  => count( $all_games ),
    'live' => 0,
    'nfl'  => 0,
    'nba'  => 0,
    'mlb'  => 0,
    'nhl'  => 0,
];

foreach ( $all_games as $g ) {
    $sp = strtolower( $g['sport'] ?? '' );
    if ( isset( $sport_counts[ $sp ] ) ) {
        $sport_counts[ $sp ]++;
    }
    if ( ! empty( $g['is_live'] ) ) {
        $sport_counts['live']++;
    }
}
?>

<main class="devnahian-sportlixa-container sportlixa-scores-page">

  <!-- ==========================================================================
     PAGE HEADER & TELEMETRY STRIP
     ========================================================================== -->
  <header class="sportlixa-scores-page-header">
    <div class="sportlixa-scores-badge">
      <span class="live-dot-pulse"></span>
      <?php esc_html_e( 'ESPN LIVE TELEMETRY', 'sportlixa' ); ?>
    </div>
    <div class="sportlixa-scores-header-row">
      <div>
        <h1 class="sportlixa-scores-page-title"><?php esc_html_e( 'LIVE SCORE CENTER', 'sportlixa' ); ?></h1>
        <p class="sportlixa-scores-page-subtext">
          <?php esc_html_e( 'Real-time score updates, clock timing, team possession, and final results across all major sports leagues.', 'sportlixa' ); ?>
        </p>
      </div>

      <!-- Quick Action Controls -->
      <div class="sportlixa-scores-header-actions">
        <button type="button" class="sportlixa-btn-refresh" onclick="window.location.reload();">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="23 4 23 10 17 10"/><polyline points="1 20 1 14 7 14"/><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/></svg>
          <?php esc_html_e( 'Refresh Scores', 'sportlixa' ); ?>
        </button>
      </div>
    </div>

    <!-- Quick Telemetry Counter Strip -->
    <div class="sportlixa-scores-metrics-bar">
      <div class="score-metric-box">
        <span class="val"><?php echo esc_html( $sport_counts['all'] ); ?></span>
        <span class="lbl"><?php esc_html_e( 'Total Games', 'sportlixa' ); ?></span>
      </div>
      <div class="score-metric-box live-pulse">
        <span class="val" style="color:var(--devnahian-sportlixa-brand-volt, #b9f700);"><?php echo esc_html( $sport_counts['live'] ); ?></span>
        <span class="lbl"><?php esc_html_e( 'Live In-Play', 'sportlixa' ); ?></span>
      </div>
      <div class="score-metric-box">
        <span class="val"><?php echo esc_html( $sport_counts['nfl'] ); ?></span>
        <span class="lbl">NFL</span>
      </div>
      <div class="score-metric-box">
        <span class="val"><?php echo esc_html( $sport_counts['nba'] ); ?></span>
        <span class="lbl">NBA</span>
      </div>
      <div class="score-metric-box">
        <span class="val"><?php echo esc_html( $sport_counts['mlb'] ); ?></span>
        <span class="lbl">MLB</span>
      </div>
      <div class="score-metric-box">
        <span class="val"><?php echo esc_html( $sport_counts['nhl'] ); ?></span>
        <span class="lbl">NHL</span>
      </div>
    </div>
  </header>

  <!-- ==========================================================================
     INTERACTIVE FILTER BAR
     ========================================================================== -->
  <section class="sportlixa-scores-controls-row">
    <div class="sportlixa-scores-pills-wrap">
      <button type="button" class="sportlixa-score-pill active" onclick="filterScoreCategory('all', this)">
        <?php esc_html_e( 'ALL LEAGUES', 'sportlixa' ); ?> (<?php echo esc_html( $sport_counts['all'] ); ?>)
      </button>
      <button type="button" class="sportlixa-score-pill" onclick="filterScoreCategory('live', this)">
        &bull; <?php esc_html_e( 'LIVE ONLY', 'sportlixa' ); ?> (<?php echo esc_html( $sport_counts['live'] ); ?>)
      </button>
      <button type="button" class="sportlixa-score-pill" onclick="filterScoreCategory('nfl', this)">
        NFL (<?php echo esc_html( $sport_counts['nfl'] ); ?>)
      </button>
      <button type="button" class="sportlixa-score-pill" onclick="filterScoreCategory('nba', this)">
        NBA (<?php echo esc_html( $sport_counts['nba'] ); ?>)
      </button>
      <button type="button" class="sportlixa-score-pill" onclick="filterScoreCategory('mlb', this)">
        MLB (<?php echo esc_html( $sport_counts['mlb'] ); ?>)
      </button>
      <button type="button" class="sportlixa-score-pill" onclick="filterScoreCategory('nhl', this)">
        NHL (<?php echo esc_html( $sport_counts['nhl'] ); ?>)
      </button>
    </div>

    <!-- Search / Filter input -->
    <div class="sportlixa-scores-search-box">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <input type="text" id="scoreSearchInput" placeholder="<?php esc_attr_e( 'Search team code (KC, BUF, LAL)...', 'sportlixa' ); ?>" onkeyup="searchScoreCards(this.value)" />
    </div>
  </section>

  <!-- ==========================================================================
     COMPREHENSIVE GAME CARDS GRID
     ========================================================================== -->
  <section class="sportlixa-scores-main-grid" id="sportlixaScoresGrid">
    <?php if ( ! empty( $all_games ) ) : ?>
      <?php foreach ( $all_games as $game ) : 
          $sport      = strtolower( $game['sport'] ?? '' );
          $is_live    = ! empty( $game['is_live'] );
          $home_lead  = (int)( $game['home_score'] ?? 0 ) > (int)( $game['away_score'] ?? 0 );
          $away_lead  = (int)( $game['away_score'] ?? 0 ) > (int)( $game['home_score'] ?? 0 );
          $home_code  = esc_html( $game['home_code'] ?? 'HOM' );
          $away_code  = esc_html( $game['away_code'] ?? 'AWY' );
          $search_key = strtolower( $sport . ' ' . $home_code . ' ' . $away_code );
      ?>
        <article 
          class="sportlixa-full-game-card <?php echo $is_live ? 'is-live-game' : ''; ?>"
          data-sport="<?php echo esc_attr( $sport ); ?>"
          data-live="<?php echo $is_live ? 'yes' : 'no'; ?>"
          data-search="<?php echo esc_attr( $search_key ); ?>"
        >
          <!-- Card Header -->
          <div class="game-card-top-bar">
            <span class="game-league-tag"><?php echo esc_html( strtoupper( $game['sport'] ?? '' ) ); ?></span>
            <div class="game-status-box">
              <?php if ( $is_live ) : ?>
                <span class="live-status-badge">&bull; <?php echo esc_html( $game['status'] ?? 'LIVE' ); ?></span>
              <?php else : ?>
                <span class="final-status-badge"><?php echo esc_html( $game['status'] ?? 'FINAL' ); ?></span>
              <?php endif; ?>
            </div>
          </div>

          <!-- Match Teams and Scores Rows -->
          <div class="game-matchup-board">
            
            <!-- Home Team Row -->
            <div class="game-team-row <?php echo $home_lead ? 'lead' : ''; ?>">
              <div class="team-meta">
                <div class="team-logo-wrap">
                  <?php 
                  if ( function_exists( 'sportlixa_render_team_crest_svg' ) ) {
                      sportlixa_render_team_crest_svg( $game['home_code'] ?? '', $game['home_logo'] ?? '' );
                  } 
                  ?>
                </div>
                <span class="team-name"><?php echo $home_code; ?></span>
              </div>
              <span class="team-score-num"><?php echo esc_html( $game['home_score'] ?? '0' ); ?></span>
            </div>

            <!-- Away Team Row -->
            <div class="game-team-row <?php echo $away_lead ? 'lead' : ''; ?>">
              <div class="team-meta">
                <div class="team-logo-wrap">
                  <?php 
                  if ( function_exists( 'sportlixa_render_team_crest_svg' ) ) {
                      sportlixa_render_team_crest_svg( $game['away_code'] ?? '', $game['away_logo'] ?? '' );
                  } 
                  ?>
                </div>
                <span class="team-name"><?php echo $away_code; ?></span>
              </div>
              <span class="team-score-num"><?php echo esc_html( $game['away_score'] ?? '0' ); ?></span>
            </div>

          </div>

          <!-- Card Footer Details / Situation -->
          <div class="game-card-footer">
            <span class="game-clock-detail">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
              <?php echo esc_html( $game['detail'] ?? '' ); ?>
            </span>
            <?php if ( ! empty( $game['possession'] ) ) : ?>
              <span class="game-possession-chip">&#9670; <?php echo esc_html( $game['possession'] ); ?></span>
            <?php endif; ?>
          </div>
        </article>
      <?php endforeach; ?>
    <?php else : ?>
      <p style="color:#8c9ba5; padding: 40px 0; text-align:center; grid-column: 1/-1;">
        <?php esc_html_e( 'No score events available right now. Please check back shortly.', 'sportlixa' ); ?>
      </p>
    <?php endif; ?>
  </section>

</main>

<style>
  /* --------------------------------------------------------------------------
     LIVE SCORES PAGE STYLES
     -------------------------------------------------------------------------- */
  .sportlixa-scores-page {
    padding-top: 36px;
    padding-bottom: 70px;
  }
  .sportlixa-scores-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 1px;
    color: var(--devnahian-sportlixa-brand-volt, #b9f700);
    text-transform: uppercase;
    margin-bottom: 8px;
  }
  .live-dot-pulse {
    width: 7px;
    height: 7px;
    background: #ff3b30;
    border-radius: 50%;
    box-shadow: 0 0 8px #ff3b30;
  }
  .sportlixa-scores-header-row {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-wrap: wrap;
    gap: 16px;
    margin-bottom: 24px;
  }
  .sportlixa-scores-page-title {
    font-size: 32px;
    font-weight: 900;
    color: #fff;
    margin: 0 0 6px 0;
    text-transform: uppercase;
    letter-spacing: -0.5px;
  }
  .sportlixa-scores-page-subtext {
    color: #8c9ba5;
    font-size: 15px;
    margin: 0;
    max-width: 680px;
  }
  .sportlixa-btn-refresh {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #141822;
    border: 1px solid rgba(255, 255, 255, 0.12);
    color: #fff;
    font-size: 12.5px;
    font-weight: 700;
    padding: 9px 16px;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s ease;
  }
  .sportlixa-btn-refresh:hover {
    background: var(--devnahian-sportlixa-brand-volt, #b9f700);
    color: #000;
    border-color: var(--devnahian-sportlixa-brand-volt, #b9f700);
  }

  /* Telemetry Metrics Bar */
  .sportlixa-scores-metrics-bar {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
    gap: 12px;
    margin-bottom: 30px;
  }
  .score-metric-box {
    background: #11151c;
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 10px;
    padding: 14px 18px;
    display: flex;
    flex-direction: column;
    gap: 4px;
  }
  .score-metric-box .val {
    font-size: 24px;
    font-weight: 900;
    color: #fff;
    line-height: 1;
  }
  .score-metric-box .lbl {
    font-size: 11px;
    font-weight: 700;
    color: #8c9ba5;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  /* Controls: Pills & Search */
  .sportlixa-scores-controls-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
    margin-bottom: 26px;
    padding-bottom: 18px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
  }
  .sportlixa-scores-pills-wrap {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
  }
  .sportlixa-score-pill {
    background: #141822;
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: #9aa5b5;
    font-size: 12px;
    font-weight: 700;
    padding: 8px 14px;
    border-radius: 20px;
    cursor: pointer;
    transition: all 0.2s ease;
  }
  .sportlixa-score-pill:hover,
  .sportlixa-score-pill.active {
    background: var(--devnahian-sportlixa-brand-volt, #b9f700);
    color: #0b0e14;
    border-color: var(--devnahian-sportlixa-brand-volt, #b9f700);
  }
  .sportlixa-scores-search-box {
    position: relative;
    min-width: 260px;
  }
  .sportlixa-scores-search-box svg {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #8c9ba5;
  }
  .sportlixa-scores-search-box input {
    width: 100%;
    background: #141822;
    border: 1px solid rgba(255, 255, 255, 0.1);
    padding: 8px 14px 8px 34px;
    border-radius: 20px;
    color: #fff;
    font-size: 13px;
    outline: none;
    transition: border-color 0.2s;
  }
  .sportlixa-scores-search-box input:focus {
    border-color: var(--devnahian-sportlixa-brand-volt, #b9f700);
  }

  /* Score Cards Grid */
  .sportlixa-scores-main-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 18px;
  }

  /* Full Score Card */
  .sportlixa-full-game-card {
    background: #11151c;
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 12px;
    padding: 16px;
    display: flex;
    flex-direction: column;
    gap: 14px;
    transition: transform 0.2s ease, border-color 0.2s ease;
  }
  .sportlixa-full-game-card:hover {
    transform: translateY(-3px);
    border-color: rgba(255, 255, 255, 0.2);
  }
  .sportlixa-full-game-card.is-live-game {
    border-color: rgba(185, 247, 0, 0.3);
  }

  .game-card-top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .game-league-tag {
    font-size: 11px;
    font-weight: 800;
    color: #8c9ba5;
    letter-spacing: 0.5px;
  }
  .live-status-badge {
    font-size: 11px;
    font-weight: 800;
    color: var(--devnahian-sportlixa-brand-volt, #b9f700);
    background: rgba(185, 247, 0, 0.1);
    padding: 3px 8px;
    border-radius: 4px;
  }
  .final-status-badge {
    font-size: 11px;
    font-weight: 700;
    color: #8c9ba5;
  }

  /* Matchup Board */
  .game-matchup-board {
    display: flex;
    flex-direction: column;
    gap: 10px;
    background: rgba(0, 0, 0, 0.25);
    padding: 12px 14px;
    border-radius: 8px;
    border: 1px solid rgba(255, 255, 255, 0.04);
  }
  .game-team-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .team-meta {
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .team-logo-wrap {
    width: 28px;
    height: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .team-logo-wrap img,
  .team-logo-wrap svg {
    width: 26px;
    height: 26px;
  }
  .team-name {
    font-size: 15px;
    font-weight: 800;
    color: #e2e8f0;
  }
  .team-score-num {
    font-size: 18px;
    font-weight: 800;
    color: #94a3b8;
  }
  .game-team-row.lead .team-name {
    color: #fff;
  }
  .game-team-row.lead .team-score-num {
    color: #fff;
  }

  /* Card Footer */
  .game-card-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 12px;
    color: #8c9ba5;
  }
  .game-clock-detail {
    display: inline-flex;
    align-items: center;
    gap: 5px;
  }
  .game-possession-chip {
    font-size: 11px;
    font-weight: 700;
    color: var(--devnahian-sportlixa-brand-volt, #b9f700);
    background: rgba(185, 247, 0, 0.08);
    padding: 2px 6px;
    border-radius: 4px;
  }

  @media (max-width: 768px) {
    .sportlixa-scores-page-title { font-size: 24px; }
    .sportlixa-scores-search-box { width: 100%; min-width: 100%; }
    .sportlixa-scores-main-grid { grid-template-columns: 1fr; }
  }
</style>

<script>
  let currentCategory = 'all';
  let searchQuery = '';

  function filterScoreCategory(cat, btnEl) {
    currentCategory = cat;
    const buttons = document.querySelectorAll('.sportlixa-score-pill');
    buttons.forEach(b => b.classList.remove('active'));
    if (btnEl) btnEl.classList.add('active');
    applyScoreFilters();
  }

  function searchScoreCards(val) {
    searchQuery = val.toLowerCase().trim();
    applyScoreFilters();
  }

  function applyScoreFilters() {
    const cards = document.querySelectorAll('.sportlixa-full-game-card');
    cards.forEach(card => {
      const sport = card.getAttribute('data-sport');
      const isLive = card.getAttribute('data-live') === 'yes';
      const searchKey = card.getAttribute('data-search');

      let matchesCat = false;
      if (currentCategory === 'all') {
        matchesCat = true;
      } else if (currentCategory === 'live') {
        matchesCat = isLive;
      } else {
        matchesCat = (sport === currentCategory);
      }

      const matchesSearch = (!searchQuery || searchKey.indexOf(searchQuery) !== -1);

      if (matchesCat && matchesSearch) {
        card.style.display = 'flex';
      } else {
        card.style.display = 'none';
      }
    });
  }
</script>

<?php get_footer(); ?>