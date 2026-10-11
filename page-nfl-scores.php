<?php
/**
 * Template Name: NFL - Live Scores
 * Template Post Type: page
 *
 * @package Sportlixa
 */

get_header(); 
$scoreboard = sportlixa_api_get_nfl_scoreboard();
?>

<main class="devnahian-sportlixa-container nfl-hub-container">

  <!-- Universal In-Flow Breadcrumbs -->
  <nav class="sportlixa-breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'sportlixa' ); ?>" style="margin: 1.5rem 0 1rem;">
    <ol class="sportlixa-breadcrumbs-list" style="display:flex; flex-wrap:wrap; align-items:center; gap:0.5rem; list-style:none; padding:0; margin:0; font-size:0.85rem;">
      <li>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="color:var(--sl-text-secondary, #94a3b8); text-decoration:none;"><?php esc_html_e( 'Home', 'sportlixa' ); ?></a>
      </li>
      <li style="color:var(--sl-text-muted, #64748b);" aria-hidden="true">/</li>
      <li>
        <a href="<?php echo esc_url( home_url( '/nfl-scores/' ) ); ?>" style="color:var(--sl-text-secondary, #94a3b8); text-decoration:none;"><?php esc_html_e( 'NFL', 'sportlixa' ); ?></a>
      </li>
      <li style="color:var(--sl-text-muted, #64748b);" aria-hidden="true">/</li>
      <li style="color:var(--sl-text-primary, #f1f5f9); font-weight:500;" aria-current="page">
        <?php esc_html_e( 'Live Scores', 'sportlixa' ); ?>
      </li>
    </ol>
  </nav>

  <!-- Masthead Header (No Tabs) -->
  <header class="nfl-hub-header" style="border-bottom:1px solid var(--sl-border, rgba(255,255,255,0.08)); padding-bottom:1.5rem; margin-bottom:2rem;">
    <div style="margin-bottom:0.5rem;">
      <span class="devnahian-sportlixa-badge-tag"><?php esc_html_e( 'NFL GAMEDAY', 'sportlixa' ); ?></span>
    </div>

    <div class="nfl-brand-row" style="display:flex; align-items:center; gap:1.25rem; margin:0.75rem 0 0;">
      <div class="nfl-shield-icon" style="width:50px; height:60px; flex-shrink:0;">
        <svg viewBox="0 0 100 120" fill="none">
          <path d="M50 5 L88 24 L80 82 L50 115 L20 82 L12 24 Z" stroke="#003369" stroke-width="8" fill="#013369"/>
          <text x="50" y="55" fill="#ffffff" font-size="20" font-weight="900" font-style="italic" text-anchor="middle">NFL</text>
          <circle cx="50" cy="80" r="8" fill="var(--sl-volt, #ccff00)"/>
        </svg>
      </div>
      <div>
        <h1 class="nfl-hub-title" style="font-size:clamp(1.8rem, 3.2vw, 2.4rem); font-weight:900; margin:0; color:#fff;"><?php esc_html_e( 'LIVE SCORES', 'sportlixa' ); ?></h1>
        <p class="nfl-hub-subtitle" style="color:var(--sl-text-secondary, #94a3b8); font-size:0.9rem; margin:0.35rem 0 0;"><?php esc_html_e( 'Real-time telemetry, live scores, possession indicators, and game results via ESPN API.', 'sportlixa' ); ?></p>
      </div>
    </div>
  </header>

  <!-- Scores Grid Section -->
  <section class="nfl-view-content" style="padding-bottom: 4rem;">
    <?php if ( ! empty( $scoreboard ) ) : ?>
      <div class="nfl-scores-grid" style="display:grid; grid-template-columns:repeat(auto-fill, minmax(280px, 1fr)); gap:1.5rem;">
        <?php foreach ( $scoreboard as $game ) : 
            $home_lead = $game['home']['score'] > $game['away']['score'];
            $away_lead = $game['away']['score'] > $game['home']['score'];
            ?>
            <div class="devnahian-sportlixa-score-card">
              <div class="devnahian-sportlixa-score-card-header">
                <span>NFL • <?php echo esc_html( $game['status'] ); ?></span>
                <span class="<?php echo $game['is_live'] ? 'live-indicator' : ''; ?>" style="<?php echo ! $game['is_live'] ? 'color:var(--sp-text-dim, #718096);' : ''; ?>">
                  <?php echo $game['is_live'] ? 'LIVE' : esc_html( $game['status'] ); ?>
                </span>
              </div>
              <div class="devnahian-sportlixa-score-match-row">
                <!-- Home Team -->
                <div class="devnahian-sportlixa-score-team-side">
                  <?php if ( ! empty( $game['home']['logo'] ) ) : ?>
                    <img src="<?php echo esc_url( $game['home']['logo'] ); ?>" alt="<?php echo esc_attr( $game['home']['code'] ); ?>" class="devnahian-sportlixa-team-crest-svg" style="width:32px; height:32px; object-fit:contain;" loading="lazy">
                  <?php endif; ?>
                  <span class="devnahian-sportlixa-team-code"><?php echo esc_html( $game['home']['code'] ); ?></span>
                </div>
                <!-- Scores -->
                <div class="devnahian-sportlixa-score-board-nums">
                  <span class="<?php echo $home_lead ? 'lead-score' : ''; ?>"><?php echo esc_html( $game['home']['score'] ); ?></span>
                  <span class="score-hyphen">-</span>
                  <span class="<?php echo $away_lead ? 'lead-score' : ''; ?>"><?php echo esc_html( $game['away']['score'] ); ?></span>
                </div>
                <!-- Away Team -->
                <div class="devnahian-sportlixa-score-team-side">
                  <span class="devnahian-sportlixa-team-code"><?php echo esc_html( $game['away']['code'] ); ?></span>
                  <?php if ( ! empty( $game['away']['logo'] ) ) : ?>
                    <img src="<?php echo esc_url( $game['away']['logo'] ); ?>" alt="<?php echo esc_attr( $game['away']['code'] ); ?>" class="devnahian-sportlixa-team-crest-svg" style="width:32px; height:32px; object-fit:contain;" loading="lazy">
                  <?php endif; ?>
                </div>
              </div>
              <div class="devnahian-sportlixa-score-time-status">
                <span><?php echo esc_html( $game['detail'] ); ?></span>
                <?php if ( $game['is_live'] ) : ?>
                  <span class="possession-dot">&#9670; In-Play</span>
                <?php endif; ?>
              </div>
            </div>
        <?php endforeach; ?>
      </div>
    <?php else : ?>
      <div class="devnahian-sportlixa-sidebar-card" style="text-align:center; padding:40px;">
        <h3><?php esc_html_e( 'No games currently active on the NFL scoreboard.', 'sportlixa' ); ?></h3>
      </div>
    <?php endif; ?>
  </section>

</main>

<?php get_footer(); ?>