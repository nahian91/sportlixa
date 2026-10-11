<?php
/**
 * Template Name: NFL - Standings
 * Template Post Type: page
 *
 * @package Sportlixa
 */

get_header(); 
$standings = sportlixa_api_get_nfl_standings();
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
        <?php esc_html_e( 'Standings', 'sportlixa' ); ?>
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
        <h1 class="nfl-hub-title" style="font-size:clamp(1.8rem, 3.2vw, 2.4rem); font-weight:900; margin:0; color:#fff;"><?php esc_html_e( 'STANDINGS', 'sportlixa' ); ?></h1>
        <p class="nfl-hub-subtitle" style="color:var(--sl-text-secondary, #94a3b8); font-size:0.9rem; margin:0.35rem 0 0;"><?php esc_html_e( 'Division races, conference wild card standings, win percentage, and streak telemetry.', 'sportlixa' ); ?></p>
      </div>
    </div>
  </header>

  <!-- Standings Dual Column Section -->
  <section class="nfl-view-content" style="padding-bottom: 4rem;">
    <div class="devnahian-sportlixa-nfl-dual-grid" style="display:grid; grid-template-columns:repeat(auto-fit, minmax(320px, 1fr)); gap:2rem;">
      
      <!-- AFC Conference -->
      <div class="devnahian-sportlixa-nfl-standings-box">
        <h3 style="color:#fff; font-size:1.1rem; font-weight:800; margin:0 0 1rem; padding-bottom:0.5rem; border-bottom:1px solid rgba(255,255,255,0.08);"><?php esc_html_e( 'AFC Standings', 'sportlixa' ); ?></h3>
        <div style="overflow-x:auto;">
          <table class="devnahian-sportlixa-standings-table" style="width:100%; border-collapse:collapse;">
            <thead>
              <tr><th>Team</th><th>W</th><th>L</th><th>PCT</th><th>DIV</th><th>STRK</th></tr>
            </thead>
            <tbody>
              <?php if ( ! empty( $standings['afc'] ) ) : ?>
                <?php foreach ( $standings['afc'] as $team ) : ?>
                  <tr>
                    <td class="devnahian-sportlixa-team-cell">
                      <?php if ( ! empty( $team['logo'] ) ) : ?>
                        <img src="<?php echo esc_url( $team['logo'] ); ?>" alt="" style="width:20px; height:20px; object-fit:contain; vertical-align:middle; margin-right:8px;" loading="lazy">
                      <?php endif; ?>
                      <?php echo esc_html( $team['name'] ); ?>
                    </td>
                    <td><?php echo esc_html( $team['w'] ); ?></td>
                    <td><?php echo esc_html( $team['l'] ); ?></td>
                    <td><?php echo esc_html( $team['pct'] ); ?></td>
                    <td><?php echo esc_html( $team['div'] ); ?></td>
                    <td class="<?php echo strpos( $team['streak'], 'W' ) !== false ? 'devnahian-sportlixa-streak-green' : ''; ?>"><?php echo esc_html( $team['streak'] ); ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>

      <!-- NFC Conference -->
      <div class="devnahian-sportlixa-nfl-standings-box">
        <h3 style="color:#fff; font-size:1.1rem; font-weight:800; margin:0 0 1rem; padding-bottom:0.5rem; border-bottom:1px solid rgba(255,255,255,0.08);"><?php esc_html_e( 'NFC Standings', 'sportlixa' ); ?></h3>
        <div style="overflow-x:auto;">
          <table class="devnahian-sportlixa-standings-table" style="width:100%; border-collapse:collapse;">
            <thead>
              <tr><th>Team</th><th>W</th><th>L</th><th>PCT</th><th>DIV</th><th>STRK</th></tr>
            </thead>
            <tbody>
              <?php if ( ! empty( $standings['nfc'] ) ) : ?>
                <?php foreach ( $standings['nfc'] as $team ) : ?>
                  <tr>
                    <td class="devnahian-sportlixa-team-cell">
                      <?php if ( ! empty( $team['logo'] ) ) : ?>
                        <img src="<?php echo esc_url( $team['logo'] ); ?>" alt="" style="width:20px; height:20px; object-fit:contain; vertical-align:middle; margin-right:8px;" loading="lazy">
                      <?php endif; ?>
                      <?php echo esc_html( $team['name'] ); ?>
                    </td>
                    <td><?php echo esc_html( $team['w'] ); ?></td>
                    <td><?php echo esc_html( $team['l'] ); ?></td>
                    <td><?php echo esc_html( $team['pct'] ); ?></td>
                    <td><?php echo esc_html( $team['div'] ); ?></td>
                    <td class="<?php echo strpos( $team['streak'], 'W' ) !== false ? 'devnahian-sportlixa-streak-green' : ''; ?>"><?php echo esc_html( $team['streak'] ); ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </section>

</main>

<?php get_footer(); ?>