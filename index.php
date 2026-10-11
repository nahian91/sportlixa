<?php
/**
 * The main template file / Front Page
 *
 * @package Sportlixa
 */

get_header();

/**
 * --------------------------------------------------------------------------
 * 1. ESPN LIVE SCORES API (Cached for 60s) - ALL GAMES & OFFICIAL LOGOS
 * --------------------------------------------------------------------------
 */
function sportlixa_get_espn_live_scores() {
    $transient_key = 'sportlixa_cached_live_scores';
    
    // Uncomment this line once if you need to force-clear an old cached failure:
    // delete_transient( $transient_key );

    $cached = get_transient( $transient_key );
    if ( false !== $cached ) {
        return $cached;
    }

    $leagues = [
        'nfl' => 'https://site.api.espn.com/apis/site/v2/sports/football/nfl/scoreboard',
        'nba' => 'https://site.api.espn.com/apis/site/v2/sports/basketball/nba/scoreboard',
        'mlb' => 'https://site.api.espn.com/apis/site/v2/sports/baseball/mlb/scoreboard',
        'nhl' => 'https://site.api.espn.com/apis/site/v2/sports/hockey/nhl/scoreboard',
    ];

    $matches = [];

    foreach ( $leagues as $sport => $url ) {
        // Fix: sslverify => false prevents local cURL SSL cert failures
        $response = wp_remote_get( $url, [
            'timeout'   => 8,
            'sslverify' => false,
            'headers'   => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
            ]
        ] );

        if ( is_wp_error( $response ) ) {
            continue;
        }

        $body = wp_remote_retrieve_body( $response );
        $data = json_decode( $body, true );
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
                $team_data = [
                    'id'    => $c['id'] ?? '',
                    'code'  => $c['team']['abbreviation'] ?? 'TBD',
                    'score' => (int)( $c['score'] ?? 0 ),
                    'logo'  => $c['team']['logo'] ?? '',
                ];
                if ( ( $c['homeAway'] ?? '' ) === 'home' ) {
                    $home = $team_data;
                } else {
                    $away = $team_data;
                }
            }

            // Live situation detection
            $possession = '';
            if ( $is_live && ! empty( $situation['possession'] ) ) {
                $poss_id = $situation['possession'];
                if ( $poss_id === $home['id'] ) {
                    $possession = $home['code'] . ' Poss';
                } elseif ( $poss_id === $away['id'] ) {
                    $possession = $away['code'] . ' Poss';
                }
            } elseif ( $sport === 'nba' && $is_live ) {
                $possession = 'In-Play';
            } elseif ( $sport === 'mlb' && $is_live ) {
                $outs = $situation['outs'] ?? 0;
                $possession = $outs . ' Out';
            }

            $matches[] = [
                'sport'      => $sport,
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

    // Only use fallback if all endpoints failed or returned 0 events
    if ( empty( $matches ) ) {
        $matches = [
            [ 'sport' => 'nfl', 'is_live' => true,  'status' => 'LIVE',     'detail' => 'Q4 02:34',   'possession' => 'KC Poss',       'home_code' => 'KC',  'home_score' => 24, 'home_logo' => '', 'away_code' => 'BUF', 'away_score' => 17, 'away_logo' => '' ],
            [ 'sport' => 'nba', 'is_live' => true,  'status' => 'LIVE',     'detail' => 'Q4 06:12',   'possession' => 'Bonus',         'home_code' => 'LAL', 'home_score' => 98, 'home_logo' => '', 'away_code' => 'BOS', 'away_score' => 94, 'away_logo' => '' ],
            [ 'sport' => 'mlb', 'is_live' => true,  'status' => 'LIVE',     'detail' => 'Top 7th',    'possession' => '1 Out • 1 on',   'home_code' => 'NYY', 'home_score' => 5,  'home_logo' => '', 'away_code' => 'BOS', 'away_score' => 3,  'away_logo' => '' ],
            [ 'sport' => 'nhl', 'is_live' => false, 'status' => 'PERIOD 2', 'detail' => '2nd 08:45', 'possession' => 'SOG: 19 - 28',  'home_code' => 'TOR', 'home_score' => 2,  'home_logo' => '', 'away_code' => 'BOS', 'away_score' => 4,  'away_logo' => '' ],
        ];
    } else {
        // Cache the real data for 60 seconds
        set_transient( $transient_key, $matches, 60 );
    }

    return $matches;
}

/**
 * --------------------------------------------------------------------------
 * 2. NFL STANDINGS API (Cached for 1 hour)
 * --------------------------------------------------------------------------
 */
function sportlixa_get_nfl_standings() {
    $transient_key = 'sportlixa_cached_nfl_standings';
    $cached = get_transient( $transient_key );
    if ( false !== $cached ) {
        return $cached;
    }

    $url = 'https://site.api.espn.com/apis/v2/sports/football/nfl/standings';
    $response = wp_remote_get( $url, [ 'timeout' => 5 ] );

    $standings = [ 'afc' => [], 'nfc' => [] ];

    if ( ! is_wp_error( $response ) ) {
        $body = json_decode( wp_remote_retrieve_body( $response ), true );
        $children = $body['children'] ?? [];

        foreach ( $children as $conference ) {
            $conf_name = strtolower( $conference['name'] ?? '' );
            $target = strpos( $conf_name, 'american' ) !== false ? 'afc' : ( strpos( $conf_name, 'national' ) !== false ? 'nfc' : null );
            if ( ! $target ) continue;

            $entries = [];
            foreach ( $conference['standings']['entries'] ?? [] as $entry ) {
                $team = $entry['team']['displayName'] ?? 'Team';
                $stats_map = [];
                foreach ( $entry['stats'] ?? [] as $s ) {
                    $stats_map[ $s['name'] ?? '' ] = $s['displayValue'] ?? '-';
                }

                $entries[] = [
                    'team'   => $team,
                    'w'      => $stats_map['wins'] ?? '0',
                    'l'      => $stats_map['losses'] ?? '0',
                    'pct'    => $stats_map['winPercent'] ?? '.000',
                    'div'    => $stats_map['divisionWinPercent'] ?? '0-0',
                    'streak' => $stats_map['streak'] ?? '1W',
                ];
            }
            $standings[ $target ] = array_slice( $entries, 0, 5 );
        }
    }

    if ( empty( $standings['afc'] ) ) {
        $standings['afc'] = [
            [ 'team' => 'Kansas City Chiefs',   'w' => '4', 'l' => '0', 'pct' => '1.000', 'div' => '2-0', 'streak' => '4W' ],
            [ 'team' => 'Buffalo Bills',        'w' => '3', 'l' => '1', 'pct' => '.750',  'div' => '1-0', 'streak' => '1W' ],
            [ 'team' => 'Baltimore Ravens',     'w' => '3', 'l' => '1', 'pct' => '.750',  'div' => '2-0', 'streak' => '2W' ],
            [ 'team' => 'Jacksonville Jaguars', 'w' => '3', 'l' => '1', 'pct' => '.750',  'div' => '1-1', 'streak' => '2W' ],
            [ 'team' => 'Las Vegas Raiders',    'w' => '3', 'l' => '1', 'pct' => '.750',  'div' => '1-1', 'streak' => '1L' ],
        ];
    }
    if ( empty( $standings['nfc'] ) ) {
        $standings['nfc'] = [
            [ 'team' => 'Minnesota Vikings',     'w' => '4', 'l' => '0', 'pct' => '1.000', 'div' => '1-0', 'streak' => '4W' ],
            [ 'team' => 'Detroit Lions',         'w' => '3', 'l' => '1', 'pct' => '.750',  'div' => '1-1', 'streak' => '2W' ],
            [ 'team' => 'Washington Commanders', 'w' => '3', 'l' => '1', 'pct' => '.750',  'div' => '1-0', 'streak' => '3W' ],
            [ 'team' => 'Seattle Seahawks',      'w' => '3', 'l' => '1', 'pct' => '.750',  'div' => '0-0', 'streak' => '1L' ],
            [ 'team' => 'Philadelphia Eagles',   'w' => '2', 'l' => '2', 'pct' => '.500',  'div' => '0-0', 'streak' => '1L' ],
        ];
    }

    set_transient( $transient_key, $standings, 3600 );
    return $standings;
}

/**
 * --------------------------------------------------------------------------
 * 3. HELPER: RENDER OFFICIAL LOGO WITH SVG FALLBACK
 * --------------------------------------------------------------------------
 */
function sportlixa_render_team_crest_svg( $code, $logo_url = '' ) {
    if ( ! empty( $logo_url ) ) {
        echo '<img src="' . esc_url( $logo_url ) . '" alt="' . esc_attr( $code ) . '" class="devnahian-sportlixa-team-crest-svg" style="object-fit:contain;" loading="lazy">';
        return;
    }

    $code = strtoupper( trim( $code ) );
    switch ( $code ) {
        case 'KC':
            ?>
            <svg class="devnahian-sportlixa-team-crest-svg" viewBox="0 0 40 40">
              <polygon points="4,20 34,6 38,20 34,34" fill="#E31837" stroke="#FFB81C" stroke-width="2"/>
              <text x="20" y="24" fill="#fff" font-size="10" font-weight="900" text-anchor="middle">KC</text>
            </svg>
            <?php
            break;
        case 'BUF':
            ?>
            <svg class="devnahian-sportlixa-team-crest-svg" viewBox="0 0 40 40">
              <rect x="4" y="8" width="32" height="24" rx="4" fill="#00338D"/>
              <line x1="6" y1="20" x2="34" y2="20" stroke="#C60C30" stroke-width="3"/>
              <text x="20" y="24" fill="#fff" font-size="9" font-weight="900" text-anchor="middle">BUF</text>
            </svg>
            <?php
            break;
        case 'LAL':
            ?>
            <svg class="devnahian-sportlixa-team-crest-svg" viewBox="0 0 40 40">
              <circle cx="20" cy="20" r="16" fill="#552583" stroke="#FDB927" stroke-width="2"/>
              <text x="20" y="24" fill="#FDB927" font-size="9" font-weight="900" text-anchor="middle">LAL</text>
            </svg>
            <?php
            break;
        case 'BOS':
            ?>
            <svg class="devnahian-sportlixa-team-crest-svg" viewBox="0 0 40 40">
              <circle cx="20" cy="20" r="16" fill="#007A33" stroke="#BA9653" stroke-width="2"/>
              <text x="20" y="24" fill="#fff" font-size="9" font-weight="900" text-anchor="middle">BOS</text>
            </svg>
            <?php
            break;
        case 'NYY':
            ?>
            <svg class="devnahian-sportlixa-team-crest-svg" viewBox="0 0 40 40">
              <circle cx="20" cy="20" r="16" fill="#003087"/>
              <text x="20" y="24" fill="#ffffff" font-size="9" font-weight="900" text-anchor="middle">NYY</text>
            </svg>
            <?php
            break;
        case 'TOR':
            ?>
            <svg class="devnahian-sportlixa-team-crest-svg" viewBox="0 0 40 40">
              <polygon points="20,4 25,14 36,14 27,22 31,34 20,26 9,34 13,22 4,14 15,14" fill="#00205B"/>
              <text x="20" y="22" fill="#fff" font-size="7" font-weight="900" text-anchor="middle">TOR</text>
            </svg>
            <?php
            break;
        default:
            ?>
            <svg class="devnahian-sportlixa-team-crest-svg" viewBox="0 0 40 40">
              <circle cx="20" cy="20" r="16" fill="#141822" stroke="rgba(255,255,255,0.2)" stroke-width="1.5"/>
              <text x="20" y="24" fill="#fff" font-size="8.5" font-weight="900" text-anchor="middle"><?php echo esc_html( substr( $code, 0, 3 ) ); ?></text>
            </svg>
            <?php
            break;
    }
}

$live_games_data = sportlixa_get_espn_live_scores();
$nfl_standings   = sportlixa_get_nfl_standings();

$pill_counts = [ 'all' => count( $live_games_data ), 'nfl' => 0, 'nba' => 0, 'mlb' => 0, 'nhl' => 0 ];
foreach ( $live_games_data as $lg ) {
    $sp = strtolower( $lg['sport'] );
    if ( isset( $pill_counts[ $sp ] ) ) {
        $pill_counts[ $sp ]++;
    }
}
?>

  <main class="devnahian-sportlixa-container">

    <!-- ==========================================================================
       HERO SECTION (#nfl)
       ========================================================================== -->
    <section class="devnahian-sportlixa-hero-section" id="nfl">
      <div class="devnahian-sportlixa-hero-grid">

        <?php
        // Query Lead Hero Story (1 post)
        $hero_lead_query = new WP_Query( [
            'posts_per_page'      => 1,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
        ] );

        if ( $hero_lead_query->have_posts() ) :
            while ( $hero_lead_query->have_posts() ) : $hero_lead_query->the_post();
                $categories = get_the_category();
                $cat_name   = ! empty( $categories ) ? esc_html( $categories[0]->name ) : esc_html__( 'NFL', 'sportlixa' );
                $thumb_url  = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'full' ) : 'https://images.unsplash.com/photo-1566577739112-5180d4bf9390?auto=format&fit=crop&w=1280&q=80';
                $words      = str_word_count( strip_tags( get_the_content() ) );
                $read_time  = max( 1, ceil( $words / 200 ) );
                ?>
                <!-- Main Lead Story -->
                <article class="devnahian-sportlixa-hero-lead-card">
                  <img 
                    src="<?php echo esc_url( $thumb_url ); ?>" 
                    alt="<?php echo esc_attr( get_the_title() ); ?>" 
                    class="devnahian-sportlixa-hero-bg-img" 
                    loading="eager"
                  >
                  <div class="devnahian-sportlixa-hero-overlay"></div>
                  <div class="devnahian-sportlixa-hero-content">
                    <span class="devnahian-sportlixa-badge-tag"><?php echo $cat_name; ?></span>
                    <h1 class="devnahian-sportlixa-hero-headline">
                      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h1>
                    <p class="devnahian-sportlixa-hero-subtext"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 24 ) ); ?></p>
                    <div class="devnahian-sportlixa-hero-meta-row">
                      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                      <span><?php echo esc_html( get_the_date( 'M j, Y' ) ); ?></span>
                      <span>•</span>
                      <span><?php printf( esc_html__( '%d min read', 'sportlixa' ), $read_time ); ?></span>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="devnahian-sportlixa-btn-lime"><?php esc_html_e( 'READ FULL BREAKDOWN &rarr;', 'sportlixa' ); ?></a>
                  </div>
                </article>
                <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>

        <!-- Right 3 Stacked Cards -->
        <aside class="devnahian-sportlixa-hero-stacked">
          <?php
          // Query Next 3 Featured Posts
          $hero_stacked_query = new WP_Query( [
              'posts_per_page'      => 3,
              'offset'              => 1,
              'post_status'         => 'publish',
              'ignore_sticky_posts' => 1,
          ] );

          if ( $hero_stacked_query->have_posts() ) :
              while ( $hero_stacked_query->have_posts() ) : $hero_stacked_query->the_post();
                  $categories = get_the_category();
                  $cat_name   = ! empty( $categories ) ? esc_html( $categories[0]->name ) : esc_html__( 'Sports', 'sportlixa' );
                  $thumb_url  = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'medium_large' ) : 'https://images.unsplash.com/photo-1546519638-68e109498ffc?auto=format&fit=crop&w=800&q=80';
                  $words      = str_word_count( strip_tags( get_the_content() ) );
                  $read_time  = max( 1, ceil( $words / 200 ) );
                  ?>
                  <article class="devnahian-sportlixa-stacked-card">
                    <div class="devnahian-sportlixa-stacked-thumb devnahian-sportlixa-img-box">
                      <img 
                        src="<?php echo esc_url( $thumb_url ); ?>" 
                        alt="<?php echo esc_attr( get_the_title() ); ?>" 
                        loading="lazy"
                      >
                    </div>
                    <div class="devnahian-sportlixa-stacked-info">
                      <div><span class="devnahian-sportlixa-badge-tag"><?php echo $cat_name; ?></span></div>
                      <h3 class="devnahian-sportlixa-stacked-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                      </h3>
                      <div class="devnahian-sportlixa-meta-time">
                        <span><?php echo esc_html( get_the_date( 'M j, Y' ) ); ?></span> •
                        <span><?php printf( esc_html__( '%d min read', 'sportlixa' ), $read_time ); ?></span>
                      </div>
                    </div>
                  </article>
                  <?php
              endwhile;
              wp_reset_postdata();
          endif;
          ?>
        </aside>

      </div>
    </section>

    <!-- ==========================================================================
       CONTAINED PROFESSIONAL LIVE SCORES STRIP (POWERED BY LIVE API)
       ========================================================================== -->
    <section class="devnahian-sportlixa-live-scores-container-block" id="scores">
      <div class="devnahian-sportlixa-scores-header">
        <div class="devnahian-sportlixa-title-left" style="font-size:13px;"><?php esc_html_e( 'LIVE SCORE CENTER', 'sportlixa' ); ?></div>
        <div class="devnahian-sportlixa-score-filters">
          <button type="button" class="devnahian-sportlixa-filter-pill active" onclick="filterLiveScores('all', this)">ALL (<?php echo esc_html( $pill_counts['all'] ); ?>)</button>
          <button type="button" class="devnahian-sportlixa-filter-pill" onclick="filterLiveScores('nfl', this)">NFL (<?php echo esc_html( $pill_counts['nfl'] ); ?>)</button>
          <button type="button" class="devnahian-sportlixa-filter-pill" onclick="filterLiveScores('nba', this)">NBA (<?php echo esc_html( $pill_counts['nba'] ); ?>)</button>
          <button type="button" class="devnahian-sportlixa-filter-pill" onclick="filterLiveScores('mlb', this)">MLB (<?php echo esc_html( $pill_counts['mlb'] ); ?>)</button>
          <button type="button" class="devnahian-sportlixa-filter-pill" onclick="filterLiveScores('nhl', this)">NHL (<?php echo esc_html( $pill_counts['nhl'] ); ?>)</button>
        </div>
      </div>

      <div class="devnahian-sportlixa-live-scores-scroller" id="sportlixaScoresScroller">
        <span class="devnahian-sportlixa-live-pill">&bull; <?php esc_html_e( 'LIVE', 'sportlixa' ); ?></span>

        <?php foreach ( $live_games_data as $game ) : 
            $home_lead = $game['home_score'] > $game['away_score'];
            $away_lead = $game['away_score'] > $game['home_score'];
            ?>
            <div class="devnahian-sportlixa-score-card" data-sport="<?php echo esc_attr( strtolower( $game['sport'] ) ); ?>">
              <div class="devnahian-sportlixa-score-card-header">
                <span><?php echo esc_html( strtoupper( $game['sport'] ) ); ?></span>
                <span class="<?php echo $game['is_live'] ? 'live-indicator' : ''; ?>" style="<?php echo ! $game['is_live'] ? 'color:var(--sp-text-dim, #888);' : ''; ?>">
                  <?php echo esc_html( $game['status'] ); ?>
                </span>
              </div>
              <div class="devnahian-sportlixa-score-match-row">
                <!-- Home Team -->
                <div class="devnahian-sportlixa-score-team-side">
                  <?php sportlixa_render_team_crest_svg( $game['home_code'], $game['home_logo'] ); ?>
                  <span class="devnahian-sportlixa-team-code"><?php echo esc_html( $game['home_code'] ); ?></span>
                </div>
                <!-- Score Numbers -->
                <div class="devnahian-sportlixa-score-board-nums">
                  <span class="<?php echo $home_lead ? 'lead-score' : ''; ?>"><?php echo esc_html( $game['home_score'] ); ?></span>
                  <span class="score-hyphen">-</span>
                  <span class="<?php echo $away_lead ? 'lead-score' : ''; ?>"><?php echo esc_html( $game['away_score'] ); ?></span>
                </div>
                <!-- Away Team -->
                <div class="devnahian-sportlixa-score-team-side">
                  <span class="devnahian-sportlixa-team-code"><?php echo esc_html( $game['away_code'] ); ?></span>
                  <?php sportlixa_render_team_crest_svg( $game['away_code'], $game['away_logo'] ); ?>
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
       TOP STORIES SECTION (ALL EQUAL 3 COLUMNS)
       ========================================================================== -->
    <section class="devnahian-sportlixa-top-stories-section">
      <div class="devnahian-sportlixa-section-title">
        <div class="devnahian-sportlixa-title-left"><?php esc_html_e( 'TOP STORIES', 'sportlixa' ); ?></div>
        <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="devnahian-sportlixa-title-link"><?php esc_html_e( 'View all &rarr;', 'sportlixa' ); ?></a>
      </div>

      <div class="devnahian-sportlixa-top-stories-grid">

        <!-- Column 1: Lead Top Story Card -->
        <?php
        $top_story_hero = new WP_Query( [
            'posts_per_page'      => 1,
            'offset'              => 4,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
        ] );

        if ( $top_story_hero->have_posts() ) :
            while ( $top_story_hero->have_posts() ) : $top_story_hero->the_post();
                $categories = get_the_category();
                $cat_name   = ! empty( $categories ) ? esc_html( $categories[0]->name ) : esc_html__( 'Top Story', 'sportlixa' );
                $thumb_url  = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'large' ) : 'https://images.unsplash.com/photo-1566577739112-5180d4bf9390?auto=format&fit=crop&w=800&q=80';
                $words      = str_word_count( strip_tags( get_the_content() ) );
                $read_time  = max( 1, ceil( $words / 200 ) );
                ?>
                <article class="devnahian-sportlixa-top-story-hero">
                  <img 
                    src="<?php echo esc_url( $thumb_url ); ?>" 
                    alt="<?php echo esc_attr( get_the_title() ); ?>" 
                    class="devnahian-sportlixa-top-story-bg-img" 
                    loading="lazy"
                  >
                  <div class="overlay"></div>
                  <div class="devnahian-sportlixa-top-story-hero-content">
                    <span class="devnahian-sportlixa-badge-tag"><?php echo $cat_name; ?></span>
                    <h2 class="devnahian-sportlixa-top-story-hero-title">
                      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    <div class="devnahian-sportlixa-meta-time" style="color:#b5c0d0;">
                      <span><?php echo esc_html( get_the_date( 'M j, Y' ) ); ?></span> •
                      <span><?php printf( esc_html__( '%d min read', 'sportlixa' ), $read_time ); ?></span>
                    </div>
                  </div>
                </article>
                <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>

        <!-- Column 2: Mid Column Wire (3 Posts) -->
        <div class="devnahian-sportlixa-mid-stories-column">
          <?php
          $mid_stories = new WP_Query( [
              'posts_per_page'      => 3,
              'offset'              => 5,
              'post_status'         => 'publish',
              'ignore_sticky_posts' => 1,
          ] );

          if ( $mid_stories->have_posts() ) :
              while ( $mid_stories->have_posts() ) : $mid_stories->the_post();
                  $categories = get_the_category();
                  $cat_name   = ! empty( $categories ) ? esc_html( $categories[0]->name ) : esc_html__( 'Sports', 'sportlixa' );
                  $thumb_url  = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'medium' ) : 'https://images.unsplash.com/photo-1546519638-68e109498ffc?auto=format&fit=crop&w=800&q=80';
                  $words      = str_word_count( strip_tags( get_the_content() ) );
                  $read_time  = max( 1, ceil( $words / 200 ) );
                  ?>
                  <article class="devnahian-sportlixa-mid-story-card">
                    <div class="devnahian-sportlixa-mid-story-thumb devnahian-sportlixa-img-box">
                      <img 
                        src="<?php echo esc_url( $thumb_url ); ?>" 
                        alt="<?php echo esc_attr( get_the_title() ); ?>" 
                        loading="lazy"
                      >
                    </div>
                    <div class="devnahian-sportlixa-mid-story-info">
                      <div><span class="devnahian-sportlixa-badge-tag"><?php echo $cat_name; ?></span></div>
                      <h3 class="devnahian-sportlixa-mid-story-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                      </h3>
                      <div class="devnahian-sportlixa-meta-time">
                        <span><?php echo esc_html( get_the_date( 'M j, Y' ) ); ?></span> •
                        <span><?php printf( esc_html__( '%d min read', 'sportlixa' ), $read_time ); ?></span>
                      </div>
                    </div>
                  </article>
                  <?php
              endwhile;
              wp_reset_postdata();
          endif;
          ?>
        </div>

        <!-- Column 3: Sidebar Marquee Matchup & Dynamic Trending Wire -->
        <aside class="devnahian-sportlixa-sidebar-column">
          <div class="devnahian-sportlixa-marquee-game-card">
            <div class="devnahian-sportlixa-marquee-header">
              <span class="devnahian-sportlixa-marquee-live-tag"><?php esc_html_e( 'NEXT BIG MATCHUP', 'sportlixa' ); ?></span>
              <span>SUN 4:25 PM • CBS</span>
            </div>
            <div class="devnahian-sportlixa-marquee-teams">
              <div class="devnahian-sportlixa-marquee-team">
                <span class="abbr">KC</span>
                <span class="rec">(4-0)</span>
              </div>
              <span class="devnahian-sportlixa-marquee-vs">VS</span>
              <div class="devnahian-sportlixa-marquee-team">
                <span class="abbr">BUF</span>
                <span class="rec">(3-1)</span>
              </div>
            </div>
            <div class="devnahian-sportlixa-marquee-odds">
              <span>Spread: <strong>KC -2.5</strong></span>
              <span>Total: <strong>O/U 48.5</strong></span>
            </div>
            <div class="devnahian-sportlixa-pick-row">
              <button type="button" class="devnahian-sportlixa-btn-pick" onclick="castMatchupPick(this, 'KC Chiefs')">Pick KC (64%)</button>
              <button type="button" class="devnahian-sportlixa-btn-pick" onclick="castMatchupPick(this, 'BUF Bills')">Pick BUF (36%)</button>
            </div>
          </div>

          <!-- Dynamic Trending Posts -->
          <div class="devnahian-sportlixa-trending-box" id="trending">
            <div class="devnahian-sportlixa-trending-header"><?php esc_html_e( 'TRENDING NOW', 'sportlixa' ); ?></div>
            <ol class="devnahian-sportlixa-trending-list">
              <?php
              $trending_query = new WP_Query( [
                  'posts_per_page'      => 5,
                  'orderby'             => 'comment_count',
                  'post_status'         => 'publish',
                  'ignore_sticky_posts' => 1,
              ] );

              $trend_counter = 1;
              if ( $trending_query->have_posts() ) :
                  while ( $trending_query->have_posts() ) : $trending_query->the_post();
                      ?>
                      <li class="devnahian-sportlixa-trending-item">
                        <span class="devnahian-sportlixa-trending-num"><?php echo $trend_counter++; ?></span>
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                      </li>
                      <?php
                  endwhile;
                  wp_reset_postdata();
              endif;
              ?>
            </ol>
          </div>
        </aside>

      </div>
    </section>

    <!-- ==========================================================================
       DEDICATED MULTI-SPORT SPOTLIGHT HUB (Querying By Category Slugs)
       ========================================================================== -->
    <section class="devnahian-sportlixa-multisport-section">
      <div class="devnahian-sportlixa-section-title">
        <div class="devnahian-sportlixa-title-left"><?php esc_html_e( 'LEAGUE SPOTLIGHTS', 'sportlixa' ); ?></div>
        <a href="#leagues" class="devnahian-sportlixa-title-link"><?php esc_html_e( 'All Leagues &rarr;', 'sportlixa' ); ?></a>
      </div>

      <div class="devnahian-sportlixa-multisport-grid">
        <?php
        $leagues = [ 'nba', 'mlb', 'nhl', 'soccer' ];
        foreach ( $leagues as $league_slug ) :
            $league_post = new WP_Query( [
                'category_name'       => $league_slug,
                'posts_per_page'      => 1,
                'post_status'         => 'publish',
                'ignore_sticky_posts' => 1,
            ] );

            if ( $league_post->have_posts() ) :
                while ( $league_post->have_posts() ) : $league_post->the_post();
                    $thumb_url = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'medium_large' ) : 'https://images.unsplash.com/photo-1546519638-68e109498ffc?auto=format&fit=crop&w=800&q=80';
                    $words     = str_word_count( strip_tags( get_the_content() ) );
                    $read_time = max( 1, ceil( $words / 200 ) );
                    ?>
                    <article class="sport-spot-card" id="<?php echo esc_attr( $league_slug ); ?>">
                      <div class="sport-spot-img-wrap devnahian-sportlixa-img-box">
                        <span class="badge-tag sport-spot-badge"><?php echo strtoupper( esc_html( $league_slug ) ); ?></span>
                        <img 
                          src="<?php echo esc_url( $thumb_url ); ?>" 
                          alt="<?php echo esc_attr( get_the_title() ); ?>" 
                          loading="lazy"
                        >
                      </div>
                      <div class="sport-spot-content">
                        <h4 class="sport-spot-headline">
                          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h4>
                        <p class="sport-spot-desc"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 14 ) ); ?></p>
                        <div class="meta-time"><?php printf( esc_html__( '%d min read • League Wire', 'sportlixa' ), $read_time ); ?></div>
                      </div>
                    </article>
                    <?php
                endwhile;
                wp_reset_postdata();
            endif;
        endforeach;
        ?>
      </div>
    </section>

    <!-- ==========================================================================
       NFL STANDINGS (POWERED BY ESPN STANDINGS API) & MVP STAT LEADERS
       ========================================================================== -->
    <section class="devnahian-sportlixa-nfl-expanded-section" id="nfl-standings">
      <div class="devnahian-sportlixa-section-title">
        <div class="devnahian-sportlixa-title-left"><?php esc_html_e( 'NFL DIVISION RACE & MVP STAT LEADERS', 'sportlixa' ); ?></div>
        <a href="#scores" class="devnahian-sportlixa-title-link"><?php esc_html_e( 'Full Standings &rarr;', 'sportlixa' ); ?></a>
      </div>

      <div class="devnahian-sportlixa-nfl-dual-grid">
        <!-- Standings Table Box -->
        <div class="devnahian-sportlixa-nfl-standings-box">
          <div class="devnahian-sportlixa-standings-tabs">
            <button class="devnahian-sportlixa-tab-btn active" id="devnahian-sportlixa-tabAfcBtn" onclick="switchStandingsConference('afc')">AFC Leaders</button>
            <button class="devnahian-sportlixa-tab-btn" id="devnahian-sportlixa-tabNfcBtn" onclick="switchStandingsConference('nfc')">NFC Leaders</button>
          </div>
          <div class="devnahian-sportlixa-table-responsive-wrapper">
            <table class="devnahian-sportlixa-standings-table">
              <thead>
                <tr>
                  <th>Team</th>
                  <th>W</th>
                  <th>L</th>
                  <th>PCT</th>
                  <th>DIV</th>
                  <th>STRK</th>
                </tr>
              </thead>
              <tbody id="devnahian-sportlixa-standingsTableBody">
                <?php 
                $rank = 1;
                foreach ( $nfl_standings['afc'] as $team_row ) : ?>
                  <tr>
                    <td class="devnahian-sportlixa-team-cell"><span class="devnahian-sportlixa-rank-dot"><?php echo $rank++; ?></span> <?php echo esc_html( $team_row['team'] ); ?></td>
                    <td><?php echo esc_html( $team_row['w'] ); ?></td>
                    <td><?php echo esc_html( $team_row['l'] ); ?></td>
                    <td><?php echo esc_html( $team_row['pct'] ); ?></td>
                    <td><?php echo esc_html( $team_row['div'] ); ?></td>
                    <td class="<?php echo strpos( $team_row['streak'], 'W' ) !== false ? 'devnahian-sportlixa-streak-green' : ''; ?>"><?php echo esc_html( $team_row['streak'] ); ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>

        <!-- NFL MVP & Stat Leaderboards -->
        <div class="devnahian-sportlixa-nfl-leaders-box" id="nfl-leaders">
          <!-- 1. Patrick Mahomes -->
          <div class="devnahian-sportlixa-leader-row">
            <div class="devnahian-sportlixa-leader-player-wrap">
              <div class="devnahian-sportlixa-leader-avatar">
                <img 
                  src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/77/Patrick_Mahomes_gets_ready_to_snap_the_ball.jpg/300px-Patrick_Mahomes_gets_ready_to_snap_the_ball.jpg" 
                  alt="Patrick Mahomes" 
                  loading="lazy"
                >
              </div>
              <div>
                <div class="devnahian-sportlixa-leader-player-name">Patrick Mahomes</div>
                <div class="devnahian-sportlixa-leader-cat">Passing Leader • KC</div>
              </div>
            </div>
            <div class="devnahian-sportlixa-leader-stat">
              <div class="devnahian-sportlixa-leader-value">1,315</div>
              <div class="devnahian-sportlixa-leader-unit">Pass Yds / 11 TD</div>
            </div>
          </div>

          <!-- 2. Josh Allen -->
          <div class="devnahian-sportlixa-leader-row">
            <div class="devnahian-sportlixa-leader-player-wrap">
              <div class="devnahian-sportlixa-leader-avatar">
                <img 
                  src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/50/Josh_Allen_SEPT2021_%28cropped%29.jpg/300px-Josh_Allen_SEPT2021_%28cropped%29.jpg" 
                  alt="Josh Allen" 
                  loading="lazy"
                >
              </div>
              <div>
                <div class="devnahian-sportlixa-leader-player-name">Josh Allen</div>
                <div class="devnahian-sportlixa-leader-cat">Total QBR • BUF</div>
              </div>
            </div>
            <div class="devnahian-sportlixa-leader-stat">
              <div class="devnahian-sportlixa-leader-value">84.2</div>
              <div class="devnahian-sportlixa-leader-unit">QBR Rating</div>
            </div>
          </div>

          <!-- 3. Kenneth Walker III -->
          <div class="devnahian-sportlixa-leader-row">
            <div class="devnahian-sportlixa-leader-player-wrap">
              <div class="devnahian-sportlixa-leader-avatar">
                <img 
                  src="https://commons.wikimedia.org/wiki/Special:FilePath/Kenneth_Walker_III_being_interviewed_by_Time2Football_2026_(cropped).png" 
                  alt="Kenneth Walker III Seattle Seahawks" 
                  loading="lazy"
                >
              </div>
              <div>
                <div class="devnahian-sportlixa-leader-player-name">Kenneth Walker III</div>
                <div class="devnahian-sportlixa-leader-cat">Rushing Leader • SEA</div>
              </div>
            </div>
            <div class="devnahian-sportlixa-leader-stat">
              <div class="devnahian-sportlixa-leader-value">537</div>
              <div class="devnahian-sportlixa-leader-unit">Rush Yds / 6 TD</div>
            </div>
          </div>

          <!-- 4. CeeDee Lamb -->
          <div class="devnahian-sportlixa-leader-row">
            <div class="devnahian-sportlixa-leader-player-wrap">
              <div class="devnahian-sportlixa-leader-avatar">
                <img 
                  src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/91/Ceedee_Lamb_2021.jpg/300px-Ceedee_Lamb_2021.jpg" 
                  alt="CeeDee Lamb Dallas Cowboys" 
                  loading="lazy"
                >
              </div>
              <div>
                <div class="devnahian-sportlixa-leader-player-name">CeeDee Lamb</div>
                <div class="devnahian-sportlixa-leader-cat">Receiving Leader • DAL</div>
              </div>
            </div>
            <div class="devnahian-sportlixa-leader-stat">
              <div class="devnahian-sportlixa-leader-value">498</div>
              <div class="devnahian-sportlixa-leader-unit">Rec Yds / 4 TD</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ==========================================================================
       INJURY REPORT WIRE & FANTASY SLEEPERS
       ========================================================================== -->
    <section class="devnahian-sportlixa-nfl-expanded-section" id="nfl-wire">
      <div class="devnahian-sportlixa-section-title">
        <div class="devnahian-sportlixa-title-left"><?php esc_html_e( 'NFL INJURY WIRE & FANTASY SLEEPERS', 'sportlixa' ); ?></div>
        <a href="#scores" class="devnahian-sportlixa-title-link"><?php esc_html_e( 'Score Center &rarr;', 'sportlixa' ); ?></a>
      </div>

      <div class="devnahian-sportlixa-nfl-wire-grid">
        <article class="devnahian-sportlixa-nfl-wire-card">
          <div class="wire-badge-row">
            <span class="status-badge status-questionable">Questionable</span>
            <span class="wire-team-tag">Chiefs WR</span>
          </div>
          <div class="wire-player">Rashee Rice</div>
          <p class="wire-note">Hamstring strain sustained during Week 5. Underwent limited walkthroughs on Thursday; game-time decision for Sunday.</p>
          <div class="wire-fantasy-chip">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/></svg>
            Fantasy: Start Xavier Worthy as WR2
          </div>
        </article>

        <article class="devnahian-sportlixa-nfl-wire-card">
          <div class="wire-badge-row">
            <span class="status-badge status-healthy">Probable</span>
            <span class="wire-team-tag">Ravens QB</span>
          </div>
          <div class="wire-player">Lamar Jackson</div>
          <p class="wire-note">Cleared ankle soreness protocol following standard magnetic scan. Full participant in Friday offensive scrimmages.</p>
          <div class="wire-fantasy-chip">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/></svg>
            Fantasy: Elite Tier 1 Start
          </div>
        </article>

        <article class="devnahian-sportlixa-nfl-wire-card">
          <div class="wire-badge-row">
            <span class="status-badge status-out">Out (IR)</span>
            <span class="wire-team-tag">49ers RB</span>
          </div>
          <div class="wire-player">Christian McCaffrey</div>
          <p class="wire-note">Remains on designated short-term injured reserve recovering from Achilles tendinitis. Jordan Mason retains lead carries.</p>
          <div class="wire-fantasy-chip">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/></svg>
            Waiver Target: Jordan Mason (98% Rostered)
          </div>
        </article>
      </div>
    </section>

    <!-- ==========================================================================
       LEAGUES SECTION
       ========================================================================== -->
    <section class="devnahian-sportlixa-leagues-section" id="leagues">
      <div class="devnahian-sportlixa-section-title">
        <div class="devnahian-sportlixa-title-left"><?php esc_html_e( 'LEAGUES', 'sportlixa' ); ?></div>
      </div>

      <div class="devnahian-sportlixa-leagues-row">
        <!-- NFL -->
        <div class="devnahian-sportlixa-league-card">
          <div class="devnahian-sportlixa-league-icon-wrapper">
            <svg viewBox="0 0 100 120" fill="none">
              <path d="M50 5 L88 24 L80 82 L50 115 L20 82 L12 24 Z" stroke="#003369" stroke-width="8" fill="#013369"/>
              <text x="50" y="55" fill="#ffffff" font-size="20" font-weight="900" font-style="italic" text-anchor="middle" font-family="Montserrat">NFL</text>
              <circle cx="50" cy="80" r="8" fill="var(--devnahian-sportlixa-brand-volt)"/>
            </svg>
          </div>
          <h3 class="devnahian-sportlixa-league-name">NFL</h3>
          <p class="devnahian-sportlixa-league-subtext"><?php esc_html_e( 'Latest News | Scores | Standings', 'sportlixa' ); ?></p>
          <a href="<?php echo esc_url( get_category_link( get_category_by_slug( 'nfl' ) ) ); ?>" class="devnahian-sportlixa-league-view-link"><?php esc_html_e( 'View &rarr;', 'sportlixa' ); ?></a>
        </div>

        <!-- NBA -->
        <div class="devnahian-sportlixa-league-card">
          <div class="devnahian-sportlixa-league-icon-wrapper">
            <svg viewBox="0 0 70 120" fill="none">
              <rect x="5" y="10" width="60" height="100" rx="30" fill="#17408B"/>
              <path d="M5 10 H35 V110 H5 Z" fill="#C9082A"/>
              <path d="M35 10 H65 V110 H35 Z" fill="#17408B"/>
              <circle cx="45" cy="35" r="7" fill="#ffffff"/>
              <path d="M35 50 Q 25 75 45 95" stroke="#ffffff" stroke-width="6" fill="none"/>
            </svg>
          </div>
          <h3 class="devnahian-sportlixa-league-name">NBA</h3>
          <p class="devnahian-sportlixa-league-subtext"><?php esc_html_e( 'Latest News | Scores | Standings', 'sportlixa' ); ?></p>
          <a href="<?php echo esc_url( get_category_link( get_category_by_slug( 'nba' ) ) ); ?>" class="devnahian-sportlixa-league-view-link"><?php esc_html_e( 'View &rarr;', 'sportlixa' ); ?></a>
        </div>

        <!-- MLB -->
        <div class="devnahian-sportlixa-league-card">
          <div class="devnahian-sportlixa-league-icon-wrapper">
            <svg viewBox="0 0 120 80" fill="none">
              <rect x="5" y="10" width="110" height="60" rx="30" fill="#002D72"/>
              <path d="M5 10 H60 V70 H5 Z" fill="#002D72"/>
              <path d="M60 10 H115 V70 H60 Z" fill="#BA0C2F"/>
              <circle cx="85" cy="40" r="12" fill="#ffffff"/>
              <path d="M35 25 L55 55" stroke="#ffffff" stroke-width="5"/>
            </svg>
          </div>
          <h3 class="devnahian-sportlixa-league-name">MLB</h3>
          <p class="devnahian-sportlixa-league-subtext"><?php esc_html_e( 'Latest News | Scores | Standings', 'sportlixa' ); ?></p>
          <a href="<?php echo esc_url( get_category_link( get_category_by_slug( 'mlb' ) ) ); ?>" class="devnahian-sportlixa-league-view-link"><?php esc_html_e( 'View &rarr;', 'sportlixa' ); ?></a>
        </div>

        <!-- NHL -->
        <div class="devnahian-sportlixa-league-card">
          <div class="devnahian-sportlixa-league-icon-wrapper">
            <svg viewBox="0 0 100 120" fill="none">
              <path d="M50 10 L85 28 L78 88 L50 110 L22 88 L15 28 Z" stroke="currentColor" stroke-width="5" fill="#000000"/>
              <text x="50" y="65" fill="#ffffff" font-size="19" font-weight="900" font-style="italic" text-anchor="middle" font-family="Montserrat">NHL</text>
            </svg>
          </div>
          <h3 class="devnahian-sportlixa-league-name">NHL</h3>
          <p class="devnahian-sportlixa-league-subtext"><?php esc_html_e( 'Latest News | Scores | Standings', 'sportlixa' ); ?></p>
          <a href="<?php echo esc_url( get_category_link( get_category_by_slug( 'nhl' ) ) ); ?>" class="devnahian-sportlixa-league-view-link"><?php esc_html_e( 'View &rarr;', 'sportlixa' ); ?></a>
        </div>

        <!-- SOCCER -->
        <div class="devnahian-sportlixa-league-card">
          <div class="devnahian-sportlixa-league-icon-wrapper">
            <svg viewBox="0 0 100 100" fill="none">
              <circle cx="50" cy="50" r="42" stroke="currentColor" stroke-width="4" fill="#38003c"/>
              <path d="M35 45 C35 30 65 30 65 45 C65 65 50 75 50 75 C50 75 35 65 35 45 Z" fill="#ffffff"/>
              <circle cx="50" cy="38" r="4" fill="#38003c"/>
            </svg>
          </div>
          <h3 class="devnahian-sportlixa-league-name">SOCCER</h3>
          <p class="devnahian-sportlixa-league-subtext"><?php esc_html_e( 'Latest News | Scores | Standings', 'sportlixa' ); ?></p>
          <a href="<?php echo esc_url( get_category_link( get_category_by_slug( 'soccer' ) ) ); ?>" class="devnahian-sportlixa-league-view-link"><?php esc_html_e( 'View &rarr;', 'sportlixa' ); ?></a>
        </div>
      </div>
    </section>

    <!-- ==========================================================================
       BOTTOM TRIPLET (STRICT 1:1 EQUAL HEIGHT MODULE)
       ========================================================================== -->
    <section class="devnahian-sportlixa-bottom-triplet-section">
      <div class="devnahian-sportlixa-triplet-grid">

        <!-- 1. Game Previews -->
        <div class="devnahian-sportlixa-triplet-col">
          <div class="devnahian-sportlixa-section-title">
            <div class="devnahian-sportlixa-title-left"><?php esc_html_e( 'GAME PREVIEWS', 'sportlixa' ); ?></div>
          </div>
          <div class="devnahian-sportlixa-preview-card">
            <div class="devnahian-sportlixa-matchup-row">
              <div class="devnahian-sportlixa-matchup-team">
                <div class="devnahian-sportlixa-team-shield">
                  <svg width="44" height="32" viewBox="0 0 60 40">
                    <polygon points="5,20 50,5 55,20 50,35" fill="#E31837" stroke="#FFB81C" stroke-width="2"/>
                    <text x="30" y="24" fill="#ffffff" font-size="12" font-weight="900">KC</text>
                  </svg>
                </div>
                <span class="devnahian-sportlixa-team-abbr">KC</span>
              </div>
              <div class="matchup-vs">VS</div>
              <div class="matchup-team">
                <div class="team-shield">
                  <svg width="44" height="32" viewBox="0 0 60 40">
                    <rect x="8" y="8" width="44" height="24" rx="4" fill="#00338D"/>
                    <path d="M10 20 H50" stroke="#C60C30" stroke-width="3"/>
                    <text x="30" y="24" fill="#ffffff" font-size="10" font-weight="900" text-anchor="middle">BUF</text>
                  </svg>
                </div>
                <span class="team-abbr">BUF</span>
              </div>
            </div>
            <h4 class="matchup-title">Chiefs vs Bills</h4>
            <div class="matchup-time">Oct 6, 2026 • 1:00 PM (ET)</div>
            <a href="#scores" class="matchup-action-link"><?php esc_html_e( 'MATCH CENTER & PREVIEW &rarr;', 'sportlixa' ); ?></a>
          </div>
        </div>

        <!-- 2. Sports Analysis (Dynamic Post) -->
        <div class="devnahian-sportlixa-triplet-col">
          <div class="devnahian-sportlixa-section-title">
            <div class="devnahian-sportlixa-title-left"><?php esc_html_e( 'SPORTS ANALYSIS', 'sportlixa' ); ?></div>
          </div>
          <?php
          $analysis_post = new WP_Query( [
              'posts_per_page'      => 1,
              'offset'              => 8,
              'post_status'         => 'publish',
              'ignore_sticky_posts' => 1,
          ] );

          if ( $analysis_post->have_posts() ) :
              while ( $analysis_post->have_posts() ) : $analysis_post->the_post();
                  $thumb_url = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'medium_large' ) : 'https://images.unsplash.com/photo-1566577739112-5180d4bf9390?auto=format&fit=crop&w=800&q=80';
                  $words     = str_word_count( strip_tags( get_the_content() ) );
                  $read_time = max( 1, ceil( $words / 200 ) );
                  ?>
                  <div class="devnahian-sportlixa-analysis-card">
                    <div class="devnahian-sportlixa-analysis-thumb devnahian-sportlixa-img-box">
                      <img 
                        src="<?php echo esc_url( $thumb_url ); ?>" 
                        alt="<?php echo esc_attr( get_the_title() ); ?>" 
                        loading="lazy"
                      >
                    </div>
                    <div class="devnahian-sportlixa-analysis-content">
                      <div>
                        <h4 class="devnahian-sportlixa-analysis-title">
                          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h4>
                        <p class="devnahian-sportlixa-analysis-excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 15 ) ); ?></p>
                        <div class="meta-time">
                          <span><?php echo esc_html( get_the_date( 'M j, Y' ) ); ?></span> •
                          <span><?php printf( esc_html__( '%d min read', 'sportlixa' ), $read_time ); ?></span>
                        </div>
                      </div>
                      <a href="<?php the_permalink(); ?>" class="analysis-action-link"><?php esc_html_e( 'READ MORE &rarr;', 'sportlixa' ); ?></a>
                    </div>
                  </div>
                  <?php
              endwhile;
              wp_reset_postdata();
          endif;
          ?>
        </div>

        <!-- 3. Latest Videos -->
        <div class="devnahian-sportlixa-triplet-col">
          <div class="devnahian-sportlixa-section-title">
            <div class="devnahian-sportlixa-title-left"><?php esc_html_e( 'LATEST VIDEOS', 'sportlixa' ); ?></div>
          </div>
          <div class="devnahian-sportlixa-video-card">
            <img 
              src="https://images.unsplash.com/photo-1546519638-68e109498ffc?auto=format&fit=crop&w=800&q=80" 
              alt="NBA highlights video poster" 
              class="devnahian-sportlixa-video-card-bg" 
              loading="lazy"
            >
            <div class="devnahian-sportlixa-video-overlay"></div>
            <div class="devnahian-sportlixa-video-duration">04:32</div>
            <div class="devnahian-sportlixa-play-btn-circle">
              <svg viewBox="0 0 24 24"><polygon points="5 3 19 12 5 21 5 3"/></svg>
            </div>
            <div class="devnahian-sportlixa-video-details">
              <h4 class="devnahian-sportlixa-video-title">Top 10 Plays of the Week</h4>
              <div class="devnahian-sportlixa-video-footer">
                <span class="devnahian-sportlixa-meta-time" style="margin-top:0; color:#c4cdd8;">Oct 5, 2026 • 2.4K views</span>
                <a href="#scores" class="devnahian-sportlixa-video-footer-link"><?php esc_html_e( 'VIEW ALL VIDEOS &rarr;', 'sportlixa' ); ?></a>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>

  </main>

  <script>
    function filterLiveScores(sport, buttonEl) {
      const buttons = document.querySelectorAll('.devnahian-sportlixa-filter-pill');
      buttons.forEach(function(btn) { btn.classList.remove('active'); });
      if (buttonEl) buttonEl.classList.add('active');

      const cards = document.querySelectorAll('.devnahian-sportlixa-score-card');
      cards.forEach(function(card) {
        const cardSport = card.getAttribute('data-sport');
        if (sport === 'all' || cardSport === sport) {
          card.style.display = 'flex';
        } else {
          card.style.display = 'none';
        }
      });
    }

    function castMatchupPick(buttonEl, teamName) {
      const pickButtons = buttonEl.parentElement.querySelectorAll('.devnahian-sportlixa-btn-pick');
      pickButtons.forEach(function(btn) { btn.classList.remove('active'); });
      buttonEl.classList.add('active');
    }

    const nflStandingsData = <?php echo json_encode( $nfl_standings ); ?>;
    function switchStandingsConference(conf) {
      const afcBtn = document.getElementById('devnahian-sportlixa-tabAfcBtn');
      const nfcBtn = document.getElementById('devnahian-sportlixa-tabNfcBtn');
      const tbody  = document.getElementById('devnahian-sportlixa-standingsTableBody');

      if (!tbody || !nflStandingsData[conf]) return;

      if (conf === 'afc') {
        afcBtn.classList.add('active');
        nfcBtn.classList.remove('active');
      } else {
        nfcBtn.classList.add('active');
        afcBtn.classList.remove('active');
      }

      let html = '';
      nflStandingsData[conf].forEach(function(row, index) {
        const isWin = row.streak.indexOf('W') !== -1;
        html += '<tr>' +
          '<td class="devnahian-sportlixa-team-cell"><span class="devnahian-sportlixa-rank-dot">' + (index + 1) + '</span> ' + row.team + '</td>' +
          '<td>' + row.w + '</td>' +
          '<td>' + row.l + '</td>' +
          '<td>' + row.pct + '</td>' +
          '<td>' + row.div + '</td>' +
          '<td class="' + (isWin ? 'devnahian-sportlixa-streak-green' : '') + '">' + row.streak + '</td>' +
        '</tr>';
      });
      tbody.innerHTML = html;
    }
  </script>

<?php get_footer(); ?>