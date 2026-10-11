<?php
/**
 * Template Name: Injury Wire & Fantasy Hub
 * Description: Dedicated hub for real-time injury tracking and fantasy football advice.
 *
 * @package Sportlixa
 */

get_header();

// Fetch repeater data from theme settings helper
$injury_items = function_exists( 'sportlixa_get_injury_wire_items' ) ? sportlixa_get_injury_wire_items() : [];

// Aggregate count metrics for telemetry header
$status_counts = [
    'all'          => count( $injury_items ),
    'questionable' => 0,
    'probable'     => 0,
    'out'          => 0,
];

foreach ( $injury_items as $item ) {
    $st = strtolower( $item['status'] ?? '' );
    if ( strpos( $st, 'questionable' ) !== false ) {
        $status_counts['questionable']++;
    } elseif ( strpos( $st, 'probable' ) !== false ) {
        $status_counts['probable']++;
    } elseif ( strpos( $st, 'out' ) !== false || strpos( $st, 'ir' ) !== false ) {
        $status_counts['out']++;
    }
}
?>

<main class="devnahian-sportlixa-container sportlixa-fantasy-wire-page">

  <!-- ==========================================================================
     PAGE HEADER & TELEMETRY STRIP
     ========================================================================== -->
  <header class="sportlixa-wire-header">
    <div class="sportlixa-wire-badge">
      <span class="live-dot"></span>
      <?php esc_html_e( 'LIVE TELEMETRY & WAIVER INTEL', 'sportlixa' ); ?>
    </div>
    <h1 class="sportlixa-wire-title"><?php esc_html_e( 'NFL INJURY WIRE & FANTASY SLEEPERS', 'sportlixa' ); ?></h1>
    <p class="sportlixa-wire-subtext">
      <?php esc_html_e( 'Updated game-time decisions, practice participation logs, and actionable fantasy waiver pivots.', 'sportlixa' ); ?>
    </p>

    <!-- Quick Status Counter Bar -->
    <div class="sportlixa-wire-counters-row">
      <div class="counter-box">
        <span class="counter-val"><?php echo esc_html( $status_counts['all'] ); ?></span>
        <span class="counter-lbl"><?php esc_html_e( 'Monitored Players', 'sportlixa' ); ?></span>
      </div>
      <div class="counter-box warning">
        <span class="counter-val"><?php echo esc_html( $status_counts['questionable'] ); ?></span>
        <span class="counter-lbl"><?php esc_html_e( 'Questionable / GTD', 'sportlixa' ); ?></span>
      </div>
      <div class="counter-box danger">
        <span class="counter-val"><?php echo esc_html( $status_counts['out'] ); ?></span>
        <span class="counter-lbl"><?php esc_html_e( 'Ruled Out / IR', 'sportlixa' ); ?></span>
      </div>
      <div class="counter-box success">
        <span class="counter-val"><?php echo esc_html( $status_counts['probable'] ); ?></span>
        <span class="counter-lbl"><?php esc_html_e( 'Active / Probable', 'sportlixa' ); ?></span>
      </div>
    </div>
  </header>

  <!-- ==========================================================================
     CONTROLS: FILTER PILLS & LIVE SEARCH
     ========================================================================== -->
  <section class="sportlixa-wire-controls-wrap">
    <div class="sportlixa-wire-filters">
      <button type="button" class="sportlixa-filter-pill active" onclick="filterInjuryStatus('all', this)">
        <?php esc_html_e( 'ALL', 'sportlixa' ); ?> (<?php echo esc_html( $status_counts['all'] ); ?>)
      </button>
      <button type="button" class="sportlixa-filter-pill" onclick="filterInjuryStatus('questionable', this)">
        <?php esc_html_e( 'QUESTIONABLE', 'sportlixa' ); ?> (<?php echo esc_html( $status_counts['questionable'] ); ?>)
      </button>
      <button type="button" class="sportlixa-filter-pill" onclick="filterInjuryStatus('out', this)">
        <?php esc_html_e( 'OUT / IR', 'sportlixa' ); ?> (<?php echo esc_html( $status_counts['out'] ); ?>)
      </button>
      <button type="button" class="sportlixa-filter-pill" onclick="filterInjuryStatus('probable', this)">
        <?php esc_html_e( 'PROBABLE', 'sportlixa' ); ?> (<?php echo esc_html( $status_counts['probable'] ); ?>)
      </button>
    </div>

    <div class="sportlixa-wire-search-wrap">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <input type="text" id="sportlixaWireSearchInput" placeholder="<?php esc_attr_e( 'Filter by player name or team...', 'sportlixa' ); ?>" onkeyup="searchInjuryCards(this.value)" />
    </div>
  </section>

  <!-- ==========================================================================
     CARDS GRID
     ========================================================================== -->
  <section class="sportlixa-wire-cards-grid" id="sportlixaInjuryGrid">
    <?php if ( ! empty( $injury_items ) ) : ?>
      <?php foreach ( $injury_items as $player ) : 
          $name     = esc_html( $player['name'] ?? 'Player' );
          $team_pos = esc_html( $player['team_pos'] ?? 'NFL' );
          $status   = $player['status'] ?? 'Questionable';
          $desc     = esc_html( $player['desc'] ?? '' );
          $fantasy  = esc_html( $player['fantasy'] ?? '' );

          // Derive initials for avatar
          $words = explode( ' ', trim( $name ) );
          $initials = '';
          foreach ( array_slice( $words, 0, 2 ) as $w ) {
              $initials .= strtoupper( substr( $w, 0, 1 ) );
          }

          // Normalized status slug for filtering
          $st_lower = strtolower( $status );
          $filter_key = 'questionable';
          $badge_class = 'wire-status-questionable';

          if ( strpos( $st_lower, 'probable' ) !== false ) {
              $filter_key  = 'probable';
              $badge_class = 'wire-status-probable';
          } elseif ( strpos( $st_lower, 'out' ) !== false || strpos( $st_lower, 'ir' ) !== false ) {
              $filter_key  = 'out';
              $badge_class = 'wire-status-out';
          } elseif ( strpos( $st_lower, 'doubtful' ) !== false ) {
              $filter_key  = 'questionable';
              $badge_class = 'wire-status-doubtful';
          }
      ?>
        <article 
          class="devnahian-sportlixa-wire-pro-card sportlixa-injury-item" 
          data-status="<?php echo esc_attr( $filter_key ); ?>"
          data-search="<?php echo esc_attr( strtolower( $name . ' ' . $team_pos ) ); ?>"
        >
          <div class="wire-pro-header">
            <div class="wire-pro-avatar"><?php echo esc_html( $initials ?: 'NFL' ); ?></div>
            <div class="wire-pro-info">
              <h3 class="wire-pro-name"><?php echo $name; ?></h3>
              <span class="wire-pro-sub"><?php echo $team_pos; ?></span>
            </div>
            <span class="wire-pro-pill <?php echo esc_attr( $badge_class ); ?>"><?php echo esc_html( $status ); ?></span>
          </div>

          <div class="wire-pro-body">
            <p class="wire-pro-desc"><?php echo $desc; ?></p>
          </div>

          <?php if ( ! empty( $fantasy ) ) : ?>
            <div class="wire-pro-fantasy">
              <span class="fantasy-badge">FANTASY & WAIVER INTEL</span>
              <span class="fantasy-action"><?php echo $fantasy; ?></span>
            </div>
          <?php endif; ?>
        </article>
      <?php endforeach; ?>
    <?php else : ?>
      <p style="color:#8c9ba5; padding: 40px 0; text-align:center; grid-column: 1/-1;">
        <?php esc_html_e( 'No injury reports recorded yet. Manage items in Appearance > Sportlixa Settings > Injury Wire & Fantasy.', 'sportlixa' ); ?>
      </p>
    <?php endif; ?>
  </section>

</main>

<style>
  /* --------------------------------------------------------------------------
     INJURY HUB PAGE STYLES
     -------------------------------------------------------------------------- */
  .sportlixa-fantasy-wire-page {
    padding-top: 36px;
    padding-bottom: 70px;
  }
  .sportlixa-wire-header {
    margin-bottom: 28px;
  }
  .sportlixa-wire-badge {
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
  .sportlixa-wire-badge .live-dot {
    width: 7px;
    height: 7px;
    background: #ff3b30;
    border-radius: 50%;
    box-shadow: 0 0 8px #ff3b30;
  }
  .sportlixa-wire-title {
    font-size: 32px;
    font-weight: 900;
    color: #fff;
    margin: 0 0 8px 0;
    text-transform: uppercase;
    letter-spacing: -0.5px;
  }
  .sportlixa-wire-subtext {
    color: #8c9ba5;
    font-size: 15px;
    margin: 0 0 24px 0;
    max-width: 680px;
  }

  /* Telemetry Stat Strip */
  .sportlixa-wire-counters-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 14px;
    margin-bottom: 30px;
  }
  .counter-box {
    background: #11151c;
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 10px;
    padding: 16px 20px;
    display: flex;
    flex-direction: column;
    gap: 4px;
  }
  .counter-val {
    font-size: 26px;
    font-weight: 900;
    color: #fff;
    line-height: 1;
  }
  .counter-lbl {
    font-size: 12px;
    color: #8c9ba5;
    font-weight: 600;
    text-transform: uppercase;
  }
  .counter-box.warning .counter-val { color: #ffb300; }
  .counter-box.danger .counter-val  { color: #ff3d00; }
  .counter-box.success .counter-val { color: #00e676; }

  /* Controls: Filters & Search */
  .sportlixa-wire-controls-wrap {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
    margin-bottom: 26px;
    padding-bottom: 18px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
  }
  .sportlixa-wire-filters {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
  }
  .sportlixa-filter-pill {
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
  .sportlixa-filter-pill:hover,
  .sportlixa-filter-pill.active {
    background: var(--devnahian-sportlixa-brand-volt, #b9f700);
    color: #0b0e14;
    border-color: var(--devnahian-sportlixa-brand-volt, #b9f700);
  }
  .sportlixa-wire-search-wrap {
    position: relative;
    min-width: 260px;
  }
  .sportlixa-wire-search-wrap svg {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #8c9ba5;
  }
  .sportlixa-wire-search-wrap input {
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
  .sportlixa-wire-search-wrap input:focus {
    border-color: var(--devnahian-sportlixa-brand-volt, #b9f700);
  }

  /* Cards Grid */
  .sportlixa-wire-cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
    gap: 20px;
  }

  /* Card Interior */
  .devnahian-sportlixa-wire-pro-card {
    background: #11151c;
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 12px;
    padding: 18px;
    display: flex;
    flex-direction: column;
    gap: 12px;
    transition: transform 0.2s ease, border-color 0.2s ease;
  }
  .devnahian-sportlixa-wire-pro-card:hover {
    transform: translateY(-3px);
    border-color: rgba(255, 255, 255, 0.2);
  }
  .wire-pro-header {
    display: flex;
    align-items: center;
    gap: 12px;
  }
  .wire-pro-avatar {
    width: 44px;
    height: 44px;
    border-radius: 8px;
    background: linear-gradient(135deg, #202636, #161a24);
    border: 1px solid rgba(255, 255, 255, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    font-size: 14px;
    color: #fff;
    flex-shrink: 0;
  }
  .wire-pro-info {
    flex: 1;
    min-width: 0;
  }
  .wire-pro-name {
    margin: 0;
    font-size: 16px;
    font-weight: 800;
    color: #fff;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  .wire-pro-sub {
    font-size: 12px;
    color: #8c9ba5;
    font-weight: 500;
  }
  .wire-pro-pill {
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    padding: 4px 8px;
    border-radius: 4px;
    letter-spacing: 0.5px;
    white-space: nowrap;
  }
  .wire-status-questionable {
    background: rgba(255, 179, 0, 0.15);
    color: #ffb300;
    border: 1px solid rgba(255, 179, 0, 0.3);
  }
  .wire-status-probable {
    background: rgba(0, 230, 118, 0.15);
    color: #00e676;
    border: 1px solid rgba(0, 230, 118, 0.3);
  }
  .wire-status-out {
    background: rgba(255, 61, 0, 0.15);
    color: #ff3d00;
    border: 1px solid rgba(255, 61, 0, 0.3);
  }
  .wire-status-doubtful {
    background: rgba(233, 30, 99, 0.15);
    color: #e91e63;
    border: 1px solid rgba(233, 30, 99, 0.3);
  }
  .wire-pro-desc {
    margin: 0;
    font-size: 13.5px;
    line-height: 1.55;
    color: #c5ced8;
  }
  .wire-pro-fantasy {
    background: rgba(255, 255, 255, 0.03);
    border-left: 3px solid var(--devnahian-sportlixa-brand-volt, #b9f700);
    padding: 10px 12px;
    border-radius: 0 6px 6px 0;
    font-size: 12.5px;
  }
  .fantasy-badge {
    display: block;
    font-size: 10px;
    font-weight: 800;
    color: var(--devnahian-sportlixa-brand-volt, #b9f700);
    letter-spacing: 0.5px;
    margin-bottom: 2px;
  }
  .fantasy-action {
    color: #e3e9f0;
    font-weight: 500;
  }

  @media (max-width: 768px) {
    .sportlixa-wire-title { font-size: 24px; }
    .sportlixa-wire-search-wrap { width: 100%; min-width: 100%; }
    .sportlixa-wire-cards-grid { grid-template-columns: 1fr; }
  }
</style>

<script>
  let currentStatusFilter = 'all';
  let currentSearchQuery = '';

  function filterInjuryStatus(status, btnEl) {
    currentStatusFilter = status;
    const buttons = document.querySelectorAll('.sportlixa-filter-pill');
    buttons.forEach(btn => btn.classList.remove('active'));
    if (btnEl) btnEl.classList.add('active');
    applyCombinedFilters();
  }

  function searchInjuryCards(query) {
    currentSearchQuery = query.toLowerCase().trim();
    applyCombinedFilters();
  }

  function applyCombinedFilters() {
    const cards = document.querySelectorAll('.sportlixa-injury-item');
    cards.forEach(card => {
      const cardStatus = card.getAttribute('data-status');
      const cardSearch = card.getAttribute('data-search');

      const matchesStatus = (currentStatusFilter === 'all' || cardStatus === currentStatusFilter);
      const matchesSearch = (!currentSearchQuery || cardSearch.indexOf(currentSearchQuery) !== -1);

      if (matchesStatus && matchesSearch) {
        card.style.display = 'flex';
      } else {
        card.style.display = 'none';
      }
    });
  }
</script>

<?php get_footer(); ?>