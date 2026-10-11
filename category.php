<?php
/**
 * The template for displaying Category Archive pages
 *
 * @package Sportlixa
 */

get_header();

$current_cat    = get_queried_object();
$cat_id         = $current_cat->term_id ?? 0;
$cat_slug       = strtolower( $current_cat->slug ?? 'nfl' );
$cat_name       = single_cat_title( '', false );
$cat_desc       = category_description();
$current_season = date( 'Y' ) . ' ' . esc_html__( 'Season', 'sportlixa' );

/**
 * --------------------------------------------------------------------------
 * 1. CATEGORY-SPECIFIC LIVE SCORES API (Cached for 60s)
 * --------------------------------------------------------------------------
 */
function sportlixa_get_category_live_scores( $sport_slug ) {
    $sport_slug = strtolower( trim( $sport_slug ) );

    $endpoints = [
        'nfl'    => 'https://site.api.espn.com/apis/site/v2/sports/football/nfl/scoreboard',
        'nba'    => 'https://site.api.espn.com/apis/site/v2/sports/basketball/nba/scoreboard',
        'mlb'    => 'https://site.api.espn.com/apis/site/v2/sports/baseball/mlb/scoreboard',
        'nhl'    => 'https://site.api.espn.com/apis/site/v2/sports/hockey/nhl/scoreboard',
        'soccer' => 'https://site.api.espn.com/apis/site/v2/sports/soccer/eng.1/scoreboard',
    ];

    $target_sport = isset( $endpoints[ $sport_slug ] ) ? $sport_slug : 'nfl';
    $transient_key = 'sportlixa_cat_scores_' . $target_sport;
    $cached = get_transient( $transient_key );
    if ( false !== $cached ) {
        return $cached;
    }

    $response = wp_remote_get( $endpoints[ $target_sport ], [
        'timeout'   => 8,
        'sslverify' => false,
        'headers'   => [
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
        ],
    ] );

    $matches = [];

    if ( ! is_wp_error( $response ) ) {
        $body   = wp_remote_retrieve_body( $response );
        $data   = json_decode( $body, true );
        $events = $data['events'] ?? [];

        foreach ( $events as $event ) {
            $competition = $event['competitions'][0] ?? [];
            $competitors = $competition['competitors'] ?? [];
            $status_type = $event['status']['type'] ?? [];
            $situation   = $competition['situation'] ?? [];

            $is_live = ( $status_type['state'] ?? '' ) === 'in';
            $status  = $status_type['shortDetail'] ?? 'LIVE';
            $detail  = $status_type['detail'] ?? '';

            $home = [ 'id' => '', 'code' => 'HOM', 'score' => 0, 'logo' => '' ];
            $away = [ 'id' => '', 'code' => 'AWY', 'score' => 0, 'logo' => '' ];

            foreach ( $competitors as $c ) {
                $team_info = [
                    'id'    => $c['id'] ?? '',
                    'code'  => $c['team']['abbreviation'] ?? 'TBD',
                    'score' => (int) ( $c['score'] ?? 0 ),
                    'logo'  => $c['team']['logo'] ?? '',
                ];
                if ( ( $c['homeAway'] ?? '' ) === 'home' ) {
                    $home = $team_info;
                } else {
                    $away = $team_info;
                }
            }

            $possession = '';
            if ( $is_live && ! empty( $situation['possession'] ) ) {
                $poss_id = $situation['possession'];
                if ( $poss_id === $home['id'] ) {
                    $possession = $home['code'] . ' Poss';
                } elseif ( $poss_id === $away['id'] ) {
                    $possession = $away['code'] . ' Poss';
                }
            } elseif ( $target_sport === 'nba' && $is_live ) {
                $possession = 'In-Play';
            } elseif ( $target_sport === 'mlb' && $is_live ) {
                $outs = $situation['outs'] ?? 0;
                $possession = $outs . ' Out';
            }

            $matches[] = [
                'sport'      => $target_sport,
                'is_live'    => $is_live,
                'status'     => $status,
                'detail'     => $detail,
                'possession' => $possession,
                'home_code'  => $home['code'],
                'home_score' => $home['score'],
                'home_logo'  => $home['logo'],
                'away_code'  => $away['code'],
                'away_score' => $away['score'],
                'away_logo'  => $away['logo'],
            ];
        }
    }

    if ( empty( $matches ) ) {
        $matches = [
            [ 'sport' => 'nfl', 'is_live' => true,  'status' => 'WEEK 5', 'detail' => 'Q4 02:34', 'possession' => 'KC Poss',        'home_code' => 'KC',  'home_score' => 24, 'home_logo' => '', 'away_code' => 'BUF', 'away_score' => 17, 'away_logo' => '' ],
            [ 'sport' => 'nfl', 'is_live' => true,  'status' => 'WEEK 5', 'detail' => 'Q4 08:15', 'possession' => 'CIN Red Zone',   'home_code' => 'BAL', 'home_score' => 31, 'home_logo' => '', 'away_code' => 'CIN', 'away_score' => 28, 'away_logo' => '' ],
            [ 'sport' => 'nfl', 'is_live' => false, 'status' => 'FINAL',  'detail' => 'Purdy: 3 TD', 'possession' => '',             'home_code' => 'SF',  'home_score' => 30, 'home_logo' => '', 'away_code' => 'LAR', 'away_score' => 23, 'away_logo' => '' ],
            [ 'sport' => 'nfl', 'is_live' => false, 'status' => 'TODAY 8:20 PM', 'detail' => 'NBC SUN NIGHT', 'possession' => '',   'home_code' => 'DAL', 'home_score' => '--', 'home_logo' => '', 'away_code' => 'PHI', 'away_score' => '--', 'away_logo' => '' ],
        ];
    } else {
        set_transient( $transient_key, $matches, 60 );
    }

    return $matches;
}

/**
 * --------------------------------------------------------------------------
 * 2. STANDINGS API (Cached for 1 Hour)
 * --------------------------------------------------------------------------
 */
function sportlixa_get_category_standings( $sport_slug ) {
    $sport_slug = strtolower( trim( $sport_slug ) );

    $endpoints = [
        'nfl' => 'https://site.api.espn.com/apis/v2/sports/football/nfl/standings',
        'nba' => 'https://site.api.espn.com/apis/v2/sports/basketball/nba/standings',
        'mlb' => 'https://site.api.espn.com/apis/v2/sports/baseball/mlb/standings',
        'nhl' => 'https://site.api.espn.com/apis/v2/sports/hockey/nhl/standings',
    ];

    $url = $endpoints[ $sport_slug ] ?? $endpoints['nfl'];
    $transient_key = 'sportlixa_cat_standings_' . $sport_slug;
    $cached = get_transient( $transient_key );
    if ( false !== $cached ) {
        return $cached;
    }

    $response = wp_remote_get( $url, [
        'timeout'   => 8,
        'sslverify' => false,
        'headers'   => [
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
        ],
    ] );

    $standings = [];

    if ( ! is_wp_error( $response ) ) {
        $body = wp_remote_retrieve_body( $response );
        $data = json_decode( $body, true );
        $children = $data['children'] ?? [];

        foreach ( $children as $division ) {
            foreach ( $division['standings']['entries'] ?? [] as $entry ) {
                $team = $entry['team']['displayName'] ?? 'Team';
                $stats_map = [];
                foreach ( $entry['stats'] ?? [] as $s ) {
                    $stats_map[ $s['name'] ?? '' ] = $s['displayValue'] ?? '-';
                }

                $standings[] = [
                    'team'   => $team,
                    'w'      => $stats_map['wins'] ?? '0',
                    'l'      => $stats_map['losses'] ?? '0',
                    'pct'    => $stats_map['winPercent'] ?? '.000',
                    'streak' => $stats_map['streak'] ?? '1W',
                ];
            }
        }
        $standings = array_slice( $standings, 0, 5 );
    }

    if ( empty( $standings ) ) {
        $standings = [
            [ 'team' => 'KC Chiefs',   'w' => '4', 'l' => '0', 'pct' => '1.000', 'streak' => '4W' ],
            [ 'team' => 'BUF Bills',   'w' => '3', 'l' => '1', 'pct' => '.750',  'streak' => '1W' ],
            [ 'team' => 'BAL Ravens',  'w' => '3', 'l' => '1', 'pct' => '.750',  'streak' => '2W' ],
            [ 'team' => 'JAX Jaguars', 'w' => '3', 'l' => '1', 'pct' => '.750',  'streak' => '2W' ],
        ];
    } else {
        set_transient( $transient_key, $standings, 3600 );
    }

    return $standings;
}

/**
 * --------------------------------------------------------------------------
 * 3. HELPER: RENDER OFFICIAL LOGO WITH SVG FALLBACK
 * --------------------------------------------------------------------------
 */
function sportlixa_render_cat_crest( $code, $logo_url = '' ) {
    if ( ! empty( $logo_url ) ) {
        echo '<img src="' . esc_url( $logo_url ) . '" alt="' . esc_attr( $code ) . '" class="devnahian-sportlixa-team-crest-svg" style="object-fit:contain;" loading="lazy">';
        return;
    }

    $c = strtoupper( trim( $code ) );
    switch ( $c ) {
        case 'KC':
            ?>
            <svg class="devnahian-sportlixa-team-crest-svg" viewBox="0 0 40 40">
              <polygon points="4,20 34,6 38,20 34,34" fill="#E31837" stroke="#FFB81C" stroke-width="2"/>
              <text x="20" y="24" fill="#fff" font-size="10" font-weight="900" text-anchor="middle">KC</text>
            </svg>
            <?php break;
        case 'BUF':
            ?>
            <svg class="devnahian-sportlixa-team-crest-svg" viewBox="0 0 40 40">
              <rect x="4" y="8" width="32" height="24" rx="4" fill="#00338D"/>
              <line x1="6" y1="20" x2="34" y2="20" stroke="#C60C30" stroke-width="3"/>
              <text x="20" y="24" fill="#fff" font-size="9" font-weight="900" text-anchor="middle">BUF</text>
            </svg>
            <?php break;
        case 'BAL':
            ?>
            <svg class="devnahian-sportlixa-team-crest-svg" viewBox="0 0 40 40">
              <circle cx="20" cy="20" r="16" fill="#241773"/>
              <text x="20" y="24" fill="#fff" font-size="9" font-weight="900" text-anchor="middle">BAL</text>
            </svg>
            <?php break;
        case 'CIN':
            ?>
            <svg class="devnahian-sportlixa-team-crest-svg" viewBox="0 0 40 40">
              <circle cx="20" cy="20" r="16" fill="#FB4F14"/>
              <text x="20" y="24" fill="#000" font-size="9" font-weight="900" text-anchor="middle">CIN</text>
            </svg>
            <?php break;
        case 'SF':
            ?>
            <svg class="devnahian-sportlixa-team-crest-svg" viewBox="0 0 40 40">
              <circle cx="20" cy="20" r="16" fill="#AA0000"/>
              <text x="20" y="24" fill="#B3995D" font-size="9" font-weight="900" text-anchor="middle">SF</text>
            </svg>
            <?php break;
        case 'LAR':
            ?>
            <svg class="devnahian-sportlixa-team-crest-svg" viewBox="0 0 40 40">
              <circle cx="20" cy="20" r="16" fill="#003594"/>
              <text x="20" y="24" fill="#FFA300" font-size="8" font-weight="900" text-anchor="middle">LAR</text>
            </svg>
            <?php break;
        case 'DAL':
            ?>
            <svg class="devnahian-sportlixa-team-crest-svg" viewBox="0 0 40 40">
              <circle cx="20" cy="20" r="16" fill="#003594"/>
              <text x="20" y="24" fill="#fff" font-size="9" font-weight="900" text-anchor="middle">DAL</text>
            </svg>
            <?php break;
        case 'PHI':
            ?>
            <svg class="devnahian-sportlixa-team-crest-svg" viewBox="0 0 40 40">
              <circle cx="20" cy="20" r="16" fill="#004C54"/>
              <text x="20" y="24" fill="#fff" font-size="9" font-weight="900" text-anchor="middle">PHI</text>
            </svg>
            <?php break;
        default:
            ?>
            <svg class="devnahian-sportlixa-team-crest-svg" viewBox="0 0 40 40">
              <circle cx="20" cy="20" r="16" fill="#141822" stroke="rgba(255,255,255,0.2)" stroke-width="1.5"/>
              <text x="20" y="24" fill="#fff" font-size="8.5" font-weight="900" text-anchor="middle"><?php echo esc_html( substr( $c, 0, 3 ) ); ?></text>
            </svg>
            <?php break;
    }
}

$cat_scores_data    = sportlixa_get_category_live_scores( $cat_slug );
$cat_standings_data = sportlixa_get_category_standings( $cat_slug );
?>

  <main class="devnahian-sportlixa-container">

    <!-- ==========================================================================
       CATEGORY BANNER & BREADCRUMBS
       ========================================================================== -->
    <section class="devnahian-sportlixa-category-banner">
      <nav class="devnahian-sportlixa-breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'sportlixa' ); ?>">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'sportlixa' ); ?></a>
        <span>/</span>
        <a href="<?php echo esc_url( home_url( '/#leagues' ) ); ?>"><?php esc_html_e( 'Leagues', 'sportlixa' ); ?></a>
        <span>/</span>
        <span aria-current="page"><?php echo esc_html( $cat_name ); ?></span>
      </nav>

      <div class="devnahian-sportlixa-category-title-row">
        <div class="devnahian-sportlixa-category-head-left">
          <div class="devnahian-sportlixa-category-season-pill">
            <span class="devnahian-sportlixa-ticker-pulse-dot" style="background:var(--devnahian-sportlixa-brand-volt)"></span>
            <?php echo esc_html( $current_season ); ?>
          </div>
          <h1 class="devnahian-sportlixa-category-heading"><?php echo esc_html( $cat_name ); ?></h1>
          <p class="devnahian-sportlixa-category-desc">
            <?php
            if ( ! empty( $cat_desc ) ) {
                echo wp_kses_post( wpautop( $cat_desc ) );
            } else {
                printf(
                    /* translators: %s: category name */
                    esc_html__( 'Complete insider coverage for %s: real-time live scoring, division standings, MVP metrics, injury wire updates, and matchup film analysis.', 'sportlixa' ),
                    esc_html( $cat_name )
                );
            }
            ?>
          </p>
        </div>

        <!-- Subcategories or Filter Navigation -->
        <div class="devnahian-sportlixa-category-subnav">
          <a href="<?php echo esc_url( get_category_link( $cat_id ) ); ?>" class="devnahian-sportlixa-subnav-btn active">
            <?php esc_html_e( 'All Stories', 'sportlixa' ); ?>
          </a>
          <?php
          $subcategories = get_categories( [
              'parent'     => $cat_id,
              'hide_empty' => true,
              'number'     => 4,
          ] );

          if ( ! empty( $subcategories ) ) :
              foreach ( $subcategories as $subcat ) :
                  ?>
                  <a href="<?php echo esc_url( get_category_link( $subcat->term_id ) ); ?>" class="devnahian-sportlixa-subnav-btn">
                    <?php echo esc_html( $subcat->name ); ?>
                  </a>
                  <?php
              endforeach;
          else :
              ?>
              <button type="button" class="devnahian-sportlixa-subnav-btn" onclick="filterCategoryFeed('recaps', this)"><?php esc_html_e( 'Game Recaps', 'sportlixa' ); ?></button>
              <button type="button" class="devnahian-sportlixa-subnav-btn" onclick="filterCategoryFeed('film', this)"><?php esc_html_e( 'Film Analysis', 'sportlixa' ); ?></button>
              <button type="button" class="devnahian-sportlixa-subnav-btn" onclick="filterCategoryFeed('injury', this)"><?php esc_html_e( 'Injury Wire', 'sportlixa' ); ?></button>
              <button type="button" class="devnahian-sportlixa-subnav-btn" onclick="filterCategoryFeed('fantasy', this)"><?php esc_html_e( 'Fantasy', 'sportlixa' ); ?></button>
          <?php endif; ?>
        </div>
      </div>
    </section>

    <!-- ==========================================================================
       CATEGORY LIVE SCORES STRIP (CONTAINED & POWERED BY LIVE API)
       ========================================================================== -->
    <section class="devnahian-sportlixa-live-scores-container-block" id="scores">
      <div class="devnahian-sportlixa-scores-header">
        <div class="devnahian-sportlixa-title-left" style="font-size:13px;">
          <?php printf( esc_html__( '%s LIVE SCOREBOARD', 'sportlixa' ), esc_html( strtoupper( $cat_name ) ) ); ?>
        </div>
        <div class="devnahian-sportlixa-meta-time"><?php esc_html_e( 'Updated live • Official League Feed', 'sportlixa' ); ?></div>
      </div>

      <div class="devnahian-sportlixa-live-scores-scroller">
        <span class="devnahian-sportlixa-live-pill">&bull; <?php esc_html_e( 'LIVE', 'sportlixa' ); ?></span>

        <?php foreach ( $cat_scores_data as $game ) : 
            $home_lead = is_numeric( $game['home_score'] ) && is_numeric( $game['away_score'] ) && ( $game['home_score'] > $game['away_score'] );
            $away_lead = is_numeric( $game['home_score'] ) && is_numeric( $game['away_score'] ) && ( $game['away_score'] > $game['home_score'] );
            ?>
            <div class="devnahian-sportlixa-score-card">
              <div class="devnahian-sportlixa-score-card-header">
                <span><?php echo esc_html( strtoupper( $game['status'] ) ); ?></span>
                <span class="<?php echo $game['is_live'] ? 'live-indicator' : ''; ?>" style="<?php echo ! $game['is_live'] ? 'color:var(--sp-text-dim);' : ''; ?>">
                  <?php echo $game['is_live'] ? esc_html__( 'LIVE', 'sportlixa' ) : esc_html( $game['status'] ); ?>
                </span>
              </div>
              <div class="devnahian-sportlixa-score-match-row">
                <!-- Home Team Side -->
                <div class="devnahian-sportlixa-score-team-side">
                  <?php sportlixa_render_cat_crest( $game['home_code'], $game['home_logo'] ); ?>
                  <span class="devnahian-sportlixa-team-code"><?php echo esc_html( $game['home_code'] ); ?></span>
                </div>
                <!-- Numbers -->
                <div class="devnahian-sportlixa-score-board-nums">
                  <span class="<?php echo $home_lead ? 'lead-score' : ''; ?>"><?php echo esc_html( $game['home_score'] ); ?></span>
                  <span class="score-hyphen">-</span>
                  <span class="<?php echo $away_lead ? 'lead-score' : ''; ?>"><?php echo esc_html( $game['away_score'] ); ?></span>
                </div>
                <!-- Away Team Side -->
                <div class="devnahian-sportlixa-score-team-side">
                  <span class="devnahian-sportlixa-team-code"><?php echo esc_html( $game['away_code'] ); ?></span>
                  <?php sportlixa_render_cat_crest( $game['away_code'], $game['away_logo'] ); ?>
                </div>
              </div>
              <div class="devnahian-sportlixa-score-time-status">
                <span><?php echo esc_html( $game['detail'] ); ?></span>
                <?php if ( ! empty( $game['possession'] ) ) : ?>
                  <span class="possession-dot">&#9670; <?php echo esc_html( $game['possession'] ); ?></span>
                <?php endif; ?>
              </div>
            </div>
        <?php endforeach; ?>

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
            <span class="devnahian-sportlixa-feed-count" style="font-size:12px; font-weight:700; color:var(--sp-text-muted);">
              <?php
              global $wp_query;
              printf(
                  /* translators: %d: number of posts */
                  esc_html__( '%d Total Stories', 'sportlixa' ),
                  (int) $wp_query->found_posts
              );
              ?>
            </span>
          </div>

          <div class="devnahian-sportlixa-view-toggles">
            <span style="font-size:11px; color:var(--sp-text-dim); text-transform:uppercase; font-weight:800;"><?php esc_html_e( 'Layout:', 'sportlixa' ); ?></span>
            <button type="button" class="devnahian-sportlixa-btn-view-mode active" id="devnahian-sportlixa-btnGridView" onclick="toggleFeedLayout('grid')" aria-label="<?php esc_attr_e( 'Grid View', 'sportlixa' ); ?>">
              <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
            </button>
            <button type="button" class="devnahian-sportlixa-btn-view-mode" id="devnahian-sportlixa-btnListView" onclick="toggleFeedLayout('list')" aria-label="<?php esc_attr_e( 'List View', 'sportlixa' ); ?>">
              <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
            </button>
          </div>
        </div>

        <!-- Article Feed Grid -->
        <div class="devnahian-sportlixa-feed-grid" id="devnahian-sportlixa-articleFeed">
          <?php
          if ( have_posts() ) :
              while ( have_posts() ) :
                  the_post();

                  $post_words = str_word_count( strip_tags( get_the_content() ) );
                  $read_time  = max( 1, ceil( $post_words / 200 ) );
                  $post_cats  = get_the_category();
                  $badge_text = ! empty( $post_cats ) ? esc_html( strtoupper( $post_cats[0]->name ) ) : esc_html( strtoupper( $cat_name ) );
                  $thumb_url  = has_post_thumbnail() 
                      ? get_the_post_thumbnail_url( get_the_ID(), 'medium_large' ) 
                      : 'https://images.unsplash.com/photo-1566577739112-5180d4bf9390?auto=format&fit=crop&w=800&q=80';
                  ?>
                  <article id="post-<?php the_ID(); ?>" <?php post_class( 'devnahian-sportlixa-article-card' ); ?>>
                    <div class="devnahian-sportlixa-card-thumb-wrap devnahian-sportlixa-img-box">
                      <span class="devnahian-sportlixa-badge-tag devnahian-sportlixa-card-badge">
                        <?php echo $badge_text; ?>
                      </span>
                      <a href="<?php the_permalink(); ?>">
                        <img 
                          src="<?php echo esc_url( $thumb_url ); ?>" 
                          alt="<?php echo esc_attr( get_the_title() ); ?>" 
                          loading="lazy"
                        >
                      </a>
                    </div>
                    <div class="devnahian-sportlixa-card-content">
                      <div>
                        <a href="<?php the_permalink(); ?>" class="devnahian-sportlixa-card-headline">
                          <?php the_title(); ?>
                        </a>
                        <p class="devnahian-sportlixa-card-excerpt">
                          <?php echo esc_html( wp_trim_words( get_the_excerpt(), 20 ) ); ?>
                        </p>
                      </div>
                      <div class="devnahian-sportlixa-card-footer">
                        <span>
                          <?php
                          printf(
                              /* translators: 1: author name, 2: reading time in minutes */
                              esc_html__( 'By %1$s • %2$d min read', 'sportlixa' ),
                              esc_html( get_the_author() ),
                              $read_time
                          );
                          ?>
                        </span>
                        <div class="devnahian-sportlixa-card-actions">
                          <button type="button" class="devnahian-sportlixa-btn-action-icon" onclick="togglePostBookmark(this)" aria-label="<?php esc_attr_e( 'Bookmark article', 'sportlixa' ); ?>">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/></svg>
                          </button>
                          <button type="button" class="devnahian-sportlixa-btn-action-icon" onclick="shareArticle('<?php echo esc_js( get_the_title() ); ?>')" aria-label="<?php esc_attr_e( 'Share article', 'sportlixa' ); ?>">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg>
                          </button>
                        </div>
                      </div>
                    </div>
                  </article>
                  <?php
              endwhile;
          else :
              ?>
              <div class="devnahian-sportlixa-no-posts" style="grid-column: 1 / -1; padding: 40px; background: var(--sp-bg-surface); border: 1px solid var(--sp-border-subtle); border-radius: 8px; text-align: center;">
                <h3><?php esc_html_e( 'No stories published in this league yet.', 'sportlixa' ); ?></h3>
                <p style="color:var(--sp-text-muted); margin-top:8px;"><?php esc_html_e( 'Check back shortly as our film room scouts file live game reports.', 'sportlixa' ); ?></p>
              </div>
          <?php endif; ?>
        </div>

        <!-- WordPress Native Pagination -->
        <div class="devnahian-sportlixa-load-more-wrap">
          <?php
          the_posts_pagination( [
              'mid_size'           => 2,
              'prev_text'          => esc_html__( '← Previous', 'sportlixa' ),
              'next_text'          => esc_html__( 'Next Stories →', 'sportlixa' ),
              'screen_reader_text' => esc_html__( 'Posts navigation', 'sportlixa' ),
          ] );
          ?>
        </div>
      </div>

      <!-- Right Column: Sidebar -->
      <aside class="devnahian-sportlixa-cat-sidebar" aria-label="<?php esc_attr_e( 'League Sidebar', 'sportlixa' ); ?>">

        <!-- Division Standings Card (Dynamic API) -->
        <div class="devnahian-sportlixa-nfl-standings-box" id="standings">
          <div class="devnahian-sportlixa-standings-tabs">
            <button class="devnahian-sportlixa-tab-btn active" id="devnahian-sportlixa-tabAfcBtn"><?php echo esc_html( $cat_name ); ?> <?php esc_html_e( 'Leaders', 'sportlixa' ); ?></button>
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
                <?php 
                $rank = 1;
                foreach ( $cat_standings_data as $row ) : 
                    $is_win = strpos( $row['streak'], 'W' ) !== false;
                    ?>
                    <tr>
                      <td class="devnahian-sportlixa-team-cell">
                        <span class="devnahian-sportlixa-rank-dot"><?php echo $rank++; ?></span> 
                        <?php echo esc_html( $row['team'] ); ?>
                      </td>
                      <td><?php echo esc_html( $row['w'] ); ?></td>
                      <td><?php echo esc_html( $row['l'] ); ?></td>
                      <td><?php echo esc_html( $row['pct'] ); ?></td>
                      <td class="<?php echo $is_win ? 'devnahian-sportlixa-streak-green' : ''; ?>">
                        <?php echo esc_html( $row['streak'] ); ?>
                      </td>
                    </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Stat Leaders -->
        <div class="devnahian-sportlixa-nfl-leaders-box">
          <div class="devnahian-sportlixa-section-title" style="margin-bottom:0">
            <div class="devnahian-sportlixa-title-left" style="font-size:12.5px;">
              <?php printf( esc_html__( '%s STAT LEADERS', 'sportlixa' ), esc_html( strtoupper( $cat_name ) ) ); ?>
            </div>
          </div>
          
          <div class="devnahian-sportlixa-leader-row">
            <div class="devnahian-sportlixa-leader-player-wrap">
              <div class="devnahian-sportlixa-leader-avatar">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/77/Patrick_Mahomes_gets_ready_to_snap_the_ball.jpg/300px-Patrick_Mahomes_gets_ready_to_snap_the_ball.jpg" alt="Patrick Mahomes" loading="lazy">
              </div>
              <div>
                <div class="devnahian-sportlixa-leader-player-name">P. Mahomes</div>
                <div class="devnahian-sportlixa-leader-cat">Pass Yds • KC</div>
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
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/07/Kenneth_Walker_III.jpg/300px-Kenneth_Walker_III.jpg" alt="Kenneth Walker" loading="lazy">
              </div>
              <div>
                <div class="devnahian-sportlixa-leader-player-name">K. Walker III</div>
                <div class="devnahian-sportlixa-leader-cat">Rush Yds • SEA</div>
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
            <?php printf( esc_html__( 'SPORTLIXA %s PODCAST', 'sportlixa' ), esc_html( strtoupper( $cat_name ) ) ); ?>
          </div>
          <h4 class="devnahian-sportlixa-audio-title"><?php esc_html_e( 'The Tape Never Lies: Breaking Down Coverage Schemes & Matchups', 'sportlixa' ); ?></h4>
          <p style="font-size:11.5px; color:var(--sp-text-muted);"><?php esc_html_e( 'Hosted by Senior Scouts • Ep 142 • 34 mins', 'sportlixa' ); ?></p>
          <div class="devnahian-sportlixa-audio-player-row">
            <button type="button" class="devnahian-sportlixa-btn-play-pill" onclick="showToast('Streaming SportLixa Podcast...')">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg>
              <?php esc_html_e( 'LISTEN NOW', 'sportlixa' ); ?>
            </button>
            <span style="font-size:11px; color:var(--sp-text-dim);">Apple • Spotify</span>
          </div>
        </div>

        <!-- Dynamic Trending Stories Query for this Category -->
        <div class="devnahian-sportlixa-trending-box">
          <div class="devnahian-sportlixa-trending-header">
            <?php printf( esc_html__( 'TRENDING IN %s', 'sportlixa' ), esc_html( strtoupper( $cat_name ) ) ); ?>
          </div>
          <ol class="devnahian-sportlixa-trending-list">
            <?php
            $cat_trending = new WP_Query( [
                'cat'                 => $cat_id,
                'posts_per_page'      => 4,
                'orderby'             => 'comment_count',
                'post_status'         => 'publish',
                'ignore_sticky_posts' => 1,
            ] );

            $rank_num = 1;
            if ( $cat_trending->have_posts() ) :
                while ( $cat_trending->have_posts() ) :
                    $cat_trending->the_post();
                    ?>
                    <li class="devnahian-sportlixa-trending-item">
                      <span class="devnahian-sportlixa-trending-num"><?php echo $rank_num++; ?></span>
                      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </li>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                ?>
                <li class="devnahian-sportlixa-trending-item">
                  <span class="devnahian-sportlixa-trending-num">1</span>
                  <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Check front page for top breaking sports news', 'sportlixa' ); ?></a>
                </li>
            <?php endif; ?>
          </ol>
        </div>

      </aside>
    </div>
  </main>

  <script>
    function toggleFeedLayout(mode) {
      const feed = document.getElementById('devnahian-sportlixa-articleFeed');
      const btnGrid = document.getElementById('devnahian-sportlixa-btnGridView');
      const btnList = document.getElementById('devnahian-sportlixa-btnListView');

      if (!feed) return;

      if (mode === 'list') {
        feed.classList.add('list-view');
        btnList.classList.add('active');
        btnGrid.classList.remove('active');
      } else {
        feed.classList.remove('list-view');
        btnGrid.classList.add('active');
        btnList.classList.remove('active');
      }
    }
  </script>

<?php get_footer(); ?>