<?php
/**
 * Template Name: NFL - Vegas Odds
 * Template Post Type: page
 *
 * @package Sportlixa
 */

get_header(); 
$odds = sportlixa_api_get_nfl_odds();
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
        <?php esc_html_e( 'Vegas Odds', 'sportlixa' ); ?>
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
        <h1 class="nfl-hub-title" style="font-size:clamp(1.8rem, 3.2vw, 2.4rem); font-weight:900; margin:0; color:#fff;"><?php esc_html_e( 'VEGAS ODDS', 'sportlixa' ); ?></h1>
        <p class="nfl-hub-subtitle" style="color:var(--sl-text-secondary, #94a3b8); font-size:0.9rem; margin:0.35rem 0 0;"><?php esc_html_e( 'Consensus point spreads, over/under totals, and two-way moneylines for the current slate.', 'sportlixa' ); ?></p>
      </div>
    </div>
  </header>

  <!-- Odds Table -->
  <section class="nfl-view-content" style="padding-bottom: 4rem;">
    <div class="devnahian-sportlixa-sidebar-card" style="padding:0; overflow-x:auto; border-radius:12px; border:1px solid var(--sl-border, rgba(255,255,255,0.08));">
      <table class="devnahian-sportlixa-standings-table" style="width:100%; border-collapse:collapse;">
        <thead>
          <tr>
            <th style="padding:1rem 1.25rem; background:rgba(255,255,255,0.02); border-bottom:1px solid rgba(255,255,255,0.08);"><?php esc_html_e( 'Matchup', 'sportlixa' ); ?></th>
            <th style="padding:1rem 1.25rem; background:rgba(255,255,255,0.02); border-bottom:1px solid rgba(255,255,255,0.08);"><?php esc_html_e( 'Consensus Spread', 'sportlixa' ); ?></th>
            <th style="padding:1rem 1.25rem; background:rgba(255,255,255,0.02); border-bottom:1px solid rgba(255,255,255,0.08);"><?php esc_html_e( 'Over / Under', 'sportlixa' ); ?></th>
            <th style="padding:1rem 1.25rem; background:rgba(255,255,255,0.02); border-bottom:1px solid rgba(255,255,255,0.08);"><?php esc_html_e( 'Moneyline (Away / Home)', 'sportlixa' ); ?></th>
            <th style="padding:1rem 1.25rem; background:rgba(255,255,255,0.02); border-bottom:1px solid rgba(255,255,255,0.08);"><?php esc_html_e( 'Game Status', 'sportlixa' ); ?></th>
          </tr>
        </thead>
        <tbody>
          <?php if ( ! empty( $odds ) ) : ?>
            <?php foreach ( $odds as $o ) : ?>
              <tr>
                <td style="padding:1rem 1.25rem; border-bottom:1px solid rgba(255,255,255,0.04); font-weight:800; font-size:0.95rem;">
                  <?php echo esc_html( $o['matchup'] ); ?>
                </td>
                <td style="padding:1rem 1.25rem; border-bottom:1px solid rgba(255,255,255,0.04); color:var(--sl-volt, #ccff00); font-weight:800;">
                  <?php echo esc_html( $o['spread'] ); ?>
                </td>
                <td style="padding:1rem 1.25rem; border-bottom:1px solid rgba(255,255,255,0.04); font-weight:700;"><?php echo esc_html( $o['total'] ); ?></td>
                <td style="padding:1rem 1.25rem; border-bottom:1px solid rgba(255,255,255,0.04);"><?php echo esc_html( $o['moneyline'] ); ?></td>
                <td style="padding:1rem 1.25rem; border-bottom:1px solid rgba(255,255,255,0.04); color:var(--sl-text-muted, #64748b); font-size:0.825rem;"><?php echo esc_html( $o['status'] ); ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else : ?>
            <tr><td colspan="5" style="text-align:center; padding:30px;"><?php esc_html_e( 'Betting lines updating for upcoming slate...', 'sportlixa' ); ?></td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </section>

</main>

<?php get_footer(); ?>