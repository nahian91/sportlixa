<?php
/**
 * Template Name: NFL - 5-Tab Interactive Hub
 * Template Post Type: page
 *
 * @package Sportlixa
 */

get_header();

// 1. Tab definitions in exact order (News first)
$valid_tabs = [
    'news'      => __( 'Latest News', 'sportlixa' ),
    'scores'    => __( 'Live Scores', 'sportlixa' ),
    'schedule'  => __( 'Full Schedule', 'sportlixa' ),
    'standings' => __( 'Standings', 'sportlixa' ),
    'odds'      => __( 'Vegas Odds', 'sportlixa' ),
];

// 2. Determine active tab; defaults to 'news'
$active_tab = isset( $_GET['tab'] ) && array_key_exists( sanitize_key( $_GET['tab'] ), $valid_tabs )
    ? sanitize_key( $_GET['tab'] )
    : 'news';

$active_label     = $valid_tabs[ $active_tab ];
$current_page_url = get_permalink();
?>

<!-- Scoped inline safety rules to maintain layout structure -->
<style>
  .nfl-page-wrap {
    padding-top: 1.5rem;
    padding-bottom: 4rem;
  }
  .sportlixa-breadcrumbs {
    margin-bottom: 1.25rem;
  }
  .sportlixa-breadcrumbs-list {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 0.5rem;
    list-style: none;
    padding: 0;
    margin: 0;
    font-size: 0.85rem;
    color: var(--sl-text-secondary, #94a3b8);
  }
  .sportlixa-breadcrumbs-list a {
    color: var(--sl-text-secondary, #94a3b8);
    text-decoration: none;
    transition: color 0.2s ease;
  }
  .sportlixa-breadcrumbs-list a:hover {
    color: var(--sl-volt, #ccff00);
  }
  .sportlixa-breadcrumbs-separator {
    color: var(--sl-text-muted, #64748b);
    user-select: none;
  }
  .sportlixa-breadcrumbs-current {
    color: var(--sl-text-primary, #f1f5f9);
    font-weight: 500;
  }
  .nfl-hub-header {
    border-bottom: 1px solid var(--sl-border, rgba(255, 255, 255, 0.08));
    padding-bottom: 1.5rem;
    margin-bottom: 2rem;
  }
  .nfl-brand-row {
    display: flex;
    align-items: center;
    gap: 1.25rem;
    margin: 0.75rem 0 1.5rem;
  }
  .nfl-shield-icon {
    width: 50px;
    height: 60px;
    flex-shrink: 0;
  }
  .nfl-hub-title {
    font-size: clamp(1.8rem, 3.2vw, 2.4rem);
    font-weight: 900;
    margin: 0;
    color: #ffffff;
    letter-spacing: 0.02em;
  }
  .nfl-hub-subtitle {
    color: var(--sl-text-secondary, #94a3b8);
    font-size: 0.9rem;
    margin: 0.35rem 0 0;
  }
  .nfl-subnav-tabs {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
  }
  .nfl-tab-link {
    display: inline-flex;
    align-items: center;
    padding: 0.55rem 1.25rem;
    font-size: 0.78rem;
    font-weight: 800;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: var(--sl-text-secondary, #94a3b8);
    background: var(--sl-surface, #121721);
    border: 1px solid var(--sl-border, rgba(255, 255, 255, 0.08));
    border-radius: var(--sl-radius-sm, 6px);
    text-decoration: none;
    transition: all 0.2s ease;
  }
  .nfl-tab-link:hover,
  .nfl-tab-link.active {
    background: var(--sl-volt, #ccff00);
    color: #000000;
    border-color: var(--sl-volt, #ccff00);
    transform: translateY(-2px);
  }
  .nfl-scores-grid {
    display: grid !important;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)) !important;
    gap: 1.5rem !important;
  }
  .nfl-table-card {
    padding: 0;
    overflow-x: auto;
    border-radius: 12px;
    border: 1px solid var(--sl-border, rgba(255, 255, 255, 0.08));
  }
  .nfl-table {
    width: 100%;
    border-collapse: collapse;
  }
  .nfl-table th {
    padding: 1rem 1.25rem;
    background: rgba(255, 255, 255, 0.02);
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    text-align: left;
    font-size: 0.8rem;
    font-weight: 700;
    color: var(--sl-text-secondary, #94a3b8);
  }
  .nfl-table td {
    padding: 1rem 1.25rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.04);
  }
  .nfl-standings-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 2rem;
  }
  .nfl-conf-title {
    color: #ffffff;
    font-size: 1.1rem;
    font-weight: 800;
    margin: 0 0 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
  }
</style>

<main class="devnahian-sportlixa-container nfl-hub-container nfl-page-wrap">

  <!-- ==========================================================================
       DYNAMIC BREADCRUMB (Reflects Active Tab Automatically)
       ========================================================================== -->
  <nav class="sportlixa-breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'sportlixa' ); ?>">
    <ol class="sportlixa-breadcrumbs-list">
      <li>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'sportlixa' ); ?></a>
      </li>
      <li class="sportlixa-breadcrumbs-separator" aria-hidden="true">/</li>
      <li>
        <a href="<?php echo esc_url( $current_page_url ); ?>"><?php esc_html_e( 'NFL', 'sportlixa' ); ?></a>
      </li>
      <li class="sportlixa-breadcrumbs-separator" aria-hidden="true">/</li>
      <li class="sportlixa-breadcrumbs-current" aria-current="page">
        <?php echo esc_html( $active_label ); ?>
      </li>
    </ol>
  </nav>

  <!-- ==========================================================================
       HUB MASTHEAD & 5-TAB NAVIGATION (News First)
       ========================================================================== -->
  <header class="nfl-hub-header">
    <div style="margin-bottom: 0.5rem;">
      <span class="devnahian-sportlixa-badge-tag"><?php esc_html_e( 'NFL GAMEDAY', 'sportlixa' ); ?></span>
    </div>

    <div class="nfl-brand-row">
      <div class="nfl-shield-icon">
        <svg viewBox="0 0 100 120" fill="none">
          <path d="M50 5 L88 24 L80 82 L50 115 L20 82 L12 24 Z" stroke="#003369" stroke-width="8" fill="#013369"/>
          <text x="50" y="55" fill="#ffffff" font-size="20" font-weight="900" font-style="italic" text-anchor="middle">NFL</text>
          <circle cx="50" cy="80" r="8" fill="var(--sl-volt, #ccff00)"/>
        </svg>
      </div>
      <div>
        <h1 class="nfl-hub-title"><?php echo esc_html( strtoupper( $active_label ) ); ?></h1>
        <p class="nfl-hub-subtitle"><?php esc_html_e( 'Latest headlines, live scoreboard, season schedule, standings, and consensus lines.', 'sportlixa' ); ?></p>
      </div>
    </div>

    <!-- 5 Subnav Tabs -->
    <nav class="nfl-subnav-tabs" aria-label="<?php esc_attr_e( 'NFL Section Tabs', 'sportlixa' ); ?>">
      <?php foreach ( $valid_tabs as $tab_key => $tab_name ) : 
          $tab_url = ( 'news' === $tab_key ) 
              ? $current_page_url 
              : add_query_arg( 'tab', $tab_key, $current_page_url );
          $is_active = ( $tab_key === $active_tab );
          ?>
          <a href="<?php echo esc_url( $tab_url ); ?>" class="nfl-tab-link <?php echo $is_active ? 'active' : ''; ?>">
            <?php echo esc_html( $tab_name ); ?>
          </a>
      <?php endforeach; ?>
    </nav>
  </header>

  <!-- ==========================================================================
       ACTIVE TAB CONTENT PANELS
       ========================================================================== -->
  <section class="nfl-view-content">

    <?php if ( 'news' === $active_tab ) : ?>
      <!-- TAB 1: ALL NFL CATEGORY NEWS (DEFAULT) -->
      <?php
      $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );

      $news_args = [
          'post_type'           => 'post',
          'post_status'         => 'publish',
          'posts_per_page'      => 9,
          'paged'               => $paged,
          'ignore_sticky_posts' => 1,
          'tax_query'           => [
              [
                  'taxonomy'         => 'category',
                  'field'            => 'slug',
                  'terms'            => [ 'nfl' ],
                  'include_children' => true,
              ],
          ],
      ];

      $nfl_news = new WP_Query( $news_args );

      // Fallback: If no category with slug 'nfl' exists, search by category name 'NFL'
      if ( ! $nfl_news->have_posts() ) {
          $nfl_term = get_term_by( 'name', 'NFL', 'category' );
          if ( $nfl_term ) {
              $news_args['tax_query'][0]['field'] = 'term_id';
              $news_args['tax_query'][0]['terms'] = [ $nfl_term->term_id ];
              $nfl_news = new WP_Query( $news_args );
          }
      }
      ?>

      <?php if ( $nfl_news->have_posts() ) : ?>
        <div class="nfl-news-grid" style="display:grid; grid-template-columns:repeat(auto-fill, minmax(300px, 1fr)); gap:1.75rem;">
          <?php while ( $nfl_news->have_posts() ) : $nfl_news->the_post(); 
              $post_cats = get_the_category();
              $badge_cat = ! empty( $post_cats ) ? esc_html( $post_cats[0]->name ) : 'NFL';
              ?>
              <article class="devnahian-sportlixa-article-card" style="background:var(--sl-surface, #121721); border:1px solid var(--sl-border, rgba(255,255,255,0.08)); border-radius:12px; overflow:hidden; display:flex; flex-direction:column; transition:transform 0.2s ease, border-color 0.2s ease;">
                
                <?php if ( has_post_thumbnail() ) : ?>
                  <a href="<?php the_permalink(); ?>" style="display:block; aspect-ratio:16/9; overflow:hidden; position:relative;">
                    <?php the_post_thumbnail( 'medium_large', [ 'style' => 'width:100%; height:100%; object-fit:cover; transition:transform 0.3s ease;' ] ); ?>
                    <span style="position:absolute; top:12px; left:12px; background:rgba(11,14,20,0.85); color:var(--sl-volt, #ccff00); font-size:0.7rem; font-weight:800; letter-spacing:0.06em; text-transform:uppercase; padding:0.3rem 0.65rem; border-radius:4px; border:1px solid rgba(204,255,0,0.3); backdrop-filter:blur(4px);">
                      <?php echo $badge_cat; ?>
                    </span>
                  </a>
                <?php endif; ?>

                <div style="padding:1.25rem; display:flex; flex-direction:column; flex-grow:1;">
                  <div style="display:flex; align-items:center; gap:0.5rem; font-size:0.75rem; color:var(--sl-text-muted, #64748b); margin-bottom:0.6rem;">
                    <span><?php echo esc_html( get_the_date( 'M j, Y' ) ); ?></span>
                    <span>•</span>
                    <span><?php echo esc_html( ceil( str_word_count( wp_strip_all_tags( get_the_content() ) ) / 200 ) ); ?> min read</span>
                  </div>

                  <h3 style="font-size:1.1rem; font-weight:700; line-height:1.4; margin:0 0 0.75rem;">
                    <a href="<?php the_permalink(); ?>" style="color:#ffffff; text-decoration:none; transition:color 0.2s ease;" onmouseover="this.style.color='var(--sl-volt, #ccff00)'" onmouseout="this.style.color='#ffffff'">
                      <?php the_title(); ?>
                    </a>
                  </h3>

                  <p style="color:var(--sl-text-secondary, #94a3b8); font-size:0.875rem; margin:0; line-height:1.6; flex-grow:1;">
                    <?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?>
                  </p>

                  <div style="margin-top:1.25rem; padding-top:0.85rem; border-top:1px solid rgba(255,255,255,0.05); display:flex; justify-content:space-between; align-items:center;">
                    <a href="<?php the_permalink(); ?>" style="color:var(--sl-volt, #ccff00); font-size:0.8rem; font-weight:800; text-decoration:none; display:inline-flex; align-items:center; gap:0.3rem;">
                      <span>Read Story</span>
                      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                    </a>
                  </div>
                </div>

              </article>
          <?php endwhile; ?>
        </div>

        <!-- News Pagination -->
        <?php if ( $nfl_news->max_num_pages > 1 ) : ?>
          <nav class="nfl-news-pagination" style="margin-top:2.5rem; display:flex; justify-content:center; gap:0.5rem;">
            <?php
            echo paginate_links( [
                'base'      => add_query_arg( 'paged', '%#%' ),
                'format'    => '',
                'current'   => max( 1, $paged ),
                'total'     => $nfl_news->max_num_pages,
                'prev_text' => '&larr; Prev',
                'next_text' => 'Next &rarr;',
            ] );
            ?>
          </nav>
        <?php endif; ?>

        <?php wp_reset_postdata(); ?>

      <?php else : ?>
        <div class="devnahian-sportlixa-sidebar-card" style="text-align:center; padding:50px 20px;">
          <h3 style="color:#ffffff; margin-bottom:0.5rem;"><?php esc_html_e( 'No NFL articles found.', 'sportlixa' ); ?></h3>
          <p style="color:var(--sl-text-secondary, #94a3b8); margin:0; font-size:0.9rem;">
            <?php esc_html_e( 'Assign posts to the "NFL" category in Posts &rarr; Categories to display them here.', 'sportlixa' ); ?>
          </p>
        </div>
      <?php endif; ?>

    <?php elseif ( 'scores' === $active_tab ) : ?>
      <!-- TAB 2: LIVE SCORES -->
      <?php $scoreboard = sportlixa_api_get_nfl_scoreboard(); ?>
      <?php if ( ! empty( $scoreboard ) ) : ?>
        <div class="nfl-scores-grid">
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
                  <div class="devnahian-sportlixa-score-team-side">
                    <?php if ( ! empty( $game['home']['logo'] ) ) : ?>
                      <img src="<?php echo esc_url( $game['home']['logo'] ); ?>" alt="<?php echo esc_attr( $game['home']['code'] ); ?>" class="devnahian-sportlixa-team-crest-svg" style="width:32px; height:32px; object-fit:contain;" loading="lazy">
                    <?php endif; ?>
                    <span class="devnahian-sportlixa-team-code"><?php echo esc_html( $game['home']['code'] ); ?></span>
                  </div>
                  <div class="devnahian-sportlixa-score-board-nums">
                    <span class="<?php echo $home_lead ? 'lead-score' : ''; ?>"><?php echo esc_html( $game['home']['score'] ); ?></span>
                    <span class="score-hyphen">-</span>
                    <span class="<?php echo $away_lead ? 'lead-score' : ''; ?>"><?php echo esc_html( $game['away']['score'] ); ?></span>
                  </div>
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

    <?php elseif ( 'schedule' === $active_tab ) : ?>
      <!-- TAB 3: FULL SCHEDULE -->
      <?php $schedule = sportlixa_api_get_nfl_schedule(); ?>
      <div class="devnahian-sportlixa-sidebar-card nfl-table-card">
        <table class="devnahian-sportlixa-standings-table nfl-table">
          <thead>
            <tr>
              <th><?php esc_html_e( 'Matchup', 'sportlixa' ); ?></th>
              <th><?php esc_html_e( 'Status / Kickoff Time', 'sportlixa' ); ?></th>
              <th><?php esc_html_e( 'Broadcast', 'sportlixa' ); ?></th>
              <th><?php esc_html_e( 'Stadium / Location', 'sportlixa' ); ?></th>
            </tr>
          </thead>
          <tbody>
            <?php if ( ! empty( $schedule ) ) : ?>
              <?php foreach ( $schedule as $item ) : ?>
                <tr>
                  <td style="font-weight:800; font-size:0.95rem;">
                    <?php echo esc_html( $item['name'] ); ?>
                  </td>
                  <td style="color:var(--sl-volt, #ccff00); font-weight:700;">
                    <?php echo esc_html( $item['detail'] ); ?>
                  </td>
                  <td><?php echo esc_html( $item['broadcast'] ); ?></td>
                  <td style="color:var(--sl-text-muted, #64748b);"><?php echo esc_html( $item['venue'] ); ?></td>
                </tr>
              <?php endforeach; ?>
            <?php else : ?>
              <tr><td colspan="4" style="text-align:center; padding:30px;"><?php esc_html_e( 'Schedule updating from ESPN API...', 'sportlixa' ); ?></td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

    <?php elseif ( 'standings' === $active_tab ) : ?>
      <!-- TAB 4: STANDINGS -->
      <?php $standings = sportlixa_api_get_nfl_standings(); ?>
      <div class="devnahian-sportlixa-nfl-dual-grid nfl-standings-grid">
        <!-- AFC -->
        <div class="devnahian-sportlixa-nfl-standings-box">
          <h3 class="nfl-conf-title"><?php esc_html_e( 'AFC Standings', 'sportlixa' ); ?></h3>
          <div style="overflow-x:auto;">
            <table class="devnahian-sportlixa-standings-table nfl-table">
              <thead><tr><th>Team</th><th>W</th><th>L</th><th>PCT</th><th>DIV</th><th>STRK</th></tr></thead>
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
        <!-- NFC -->
        <div class="devnahian-sportlixa-nfl-standings-box">
          <h3 class="nfl-conf-title"><?php esc_html_e( 'NFC Standings', 'sportlixa' ); ?></h3>
          <div style="overflow-x:auto;">
            <table class="devnahian-sportlixa-standings-table nfl-table">
              <thead><tr><th>Team</th><th>W</th><th>L</th><th>PCT</th><th>DIV</th><th>STRK</th></tr></thead>
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

    <?php elseif ( 'odds' === $active_tab ) : ?>
      <!-- TAB 5: CONSENSUS VEGAS ODDS -->
      <?php $odds = sportlixa_api_get_nfl_odds(); ?>
      <div class="devnahian-sportlixa-sidebar-card nfl-table-card">
        <table class="devnahian-sportlixa-standings-table nfl-table">
          <thead>
            <tr>
              <th><?php esc_html_e( 'Matchup', 'sportlixa' ); ?></th>
              <th><?php esc_html_e( 'Consensus Spread', 'sportlixa' ); ?></th>
              <th><?php esc_html_e( 'Over / Under', 'sportlixa' ); ?></th>
              <th><?php esc_html_e( 'Moneyline (Away / Home)', 'sportlixa' ); ?></th>
              <th><?php esc_html_e( 'Game Status', 'sportlixa' ); ?></th>
            </tr>
          </thead>
          <tbody>
            <?php if ( ! empty( $odds ) ) : ?>
              <?php foreach ( $odds as $o ) : ?>
                <tr>
                  <td style="font-weight:800; font-size:0.95rem;">
                    <?php echo esc_html( $o['matchup'] ); ?>
                  </td>
                  <td style="color:var(--sl-volt, #ccff00); font-weight:800;">
                    <?php echo esc_html( $o['spread'] ); ?>
                  </td>
                  <td style="font-weight:700;"><?php echo esc_html( $o['total'] ); ?></td>
                  <td><?php echo esc_html( $o['moneyline'] ); ?></td>
                  <td style="color:var(--sl-text-muted, #64748b); font-size:0.825rem;"><?php echo esc_html( $o['status'] ); ?></td>
                </tr>
              <?php endforeach; ?>
            <?php else : ?>
              <tr><td colspan="5" style="text-align:center; padding:30px;"><?php esc_html_e( 'Betting lines updating for upcoming slate...', 'sportlixa' ); ?></td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

    <?php endif; ?>

  </section>

</main>

<?php get_footer(); ?>