<?php
/**
 * Sportlixa Theme Functions & Dynamic Menu System
 *
 * @package Sportlixa
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Theme Supports & Navigation Menu Locations
 */
function sportlixa_setup() {
    load_theme_textdomain( 'sportlixa', get_template_directory() . '/languages' );

    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ] );
    add_theme_support( 'custom-logo', [
        'height'      => 80,
        'width'       => 280,
        'flex-height' => true,
        'flex-width'  => true,
    ] );

    register_nav_menus( [
        'primary-menu'       => esc_html__( 'Primary Desktop Navigation', 'sportlixa' ),
        'drawer-menu'        => esc_html__( 'Mobile Drawer Navigation', 'sportlixa' ),
        'league-chips'       => esc_html__( 'Mobile Quick Chips Bar', 'sportlixa' ),
        'mobile-bottom-bar'  => esc_html__( 'Mobile Bottom App Bar', 'sportlixa' ),
        'footer-quick-links' => esc_html__( 'Footer: Quick Links (Col 2)', 'sportlixa' ),
        'footer-more'        => esc_html__( 'Footer: More (Col 3)', 'sportlixa' ),
        'footer-legal'       => esc_html__( 'Footer: Legal (Col 4)', 'sportlixa' ),
    ] );
}
add_action( 'after_setup_theme', 'sportlixa_setup' );

/**
 * Enqueue Styles & Scripts for Sportlixa
 */
function sportlixa_enqueue_scripts() {
    $theme_version = wp_get_theme()->get( 'Version' );

    // 1. Google Fonts Montserrat
    wp_enqueue_style( 
        'sportlixa-google-fonts', 
        'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,700;1,800;1,900&display=swap', 
        [], 
        null 
    );

    // 2. Custom Stylesheet (assets/css/style.css)
    wp_enqueue_style( 
        'sportlixa-custom-style', 
        get_template_directory_uri() . '/assets/css/style.css', 
        [ 'sportlixa-google-fonts' ], 
        $theme_version 
    );

    // 3. Main Theme Root Stylesheet (style.css - contains theme header data)
    wp_enqueue_style( 
        'sportlixa-theme-style', 
        get_stylesheet_uri(), 
        [ 'sportlixa-custom-style' ], 
        $theme_version 
    );

    // 4. Main JavaScript (assets/js/main.js)
    wp_enqueue_script( 
        'sportlixa-main-script', 
        get_template_directory_uri() . '/assets/js/main.js', 
        [], 
        $theme_version, 
        true 
    );
}
add_action( 'wp_enqueue_scripts', 'sportlixa_enqueue_scripts' );

/**
 * Add Preconnect hints for Google Fonts performance
 */
function sportlixa_resource_hints( $urls, $relation_type ) {
    if ( wp_style_is( 'sportlixa-google-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
        $urls[] = [
            'href' => 'https://fonts.googleapis.com',
        ];
        $urls[] = [
            'href'        => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        ];
    }
    return $urls;
}
add_filter( 'wp_resource_hints', 'sportlixa_resource_hints', 10, 2 );

/* ==========================================================================
   CUSTOM MENU WALKERS
   ========================================================================== */

/**
 * 1. Desktop Navigation Walker with Dropdown Support
 */
class Sportlixa_Desktop_Nav_Walker extends Walker_Nav_Menu {

    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '<div class="devnahian-sportlixa-dropdown-menu">';
    }

    public function end_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '</div>';
    }

    public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
        $classes      = empty( $data_object->classes ) ? [] : (array) $data_object->classes;
        $has_children = in_array( 'menu-item-has-children', $classes, true );
        $is_active    = in_array( 'current-menu-item', $classes, true ) || in_array( 'current_page_item', $classes, true );
        $url          = ! empty( $data_object->url ) ? esc_url( $data_object->url ) : '#';

        if ( 0 === $depth ) {
            $wrapper_class = 'devnahian-sportlixa-nav-item' . ( $has_children ? ' has-dropdown' : '' );
            $link_class    = 'devnahian-sportlixa-nav-link' . ( $is_active ? ' active' : '' );

            $output .= '<div class="' . esc_attr( $wrapper_class ) . '">';
            $output .= '<a href="' . $url . '" class="' . esc_attr( $link_class ) . '">';
            $output .= '<span>' . esc_html( $data_object->title ) . '</span>';
            if ( $has_children ) {
                $output .= '<svg class="dropdown-caret" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="6 9 12 15 18 9"/></svg>';
            }
            $output .= '</a>';
        } else {
            // Dropdown child item
            $link_class = 'devnahian-sportlixa-dropdown-link' . ( $is_active ? ' active' : '' );
            $output .= '<a href="' . $url . '" class="' . esc_attr( $link_class ) . '">';
            $output .= esc_html( $data_object->title );
            $output .= '</a>';
        }
    }

    public function end_el( &$output, $data_object, $depth = 0, $args = null ) {
        if ( 0 === $depth ) {
            $output .= '</div>';
        }
    }
}

/**
 * 2. Mobile Drawer Navigation Walker with Accordion Submenu Support
 */
class Sportlixa_Drawer_Nav_Walker extends Walker_Nav_Menu {

    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '<div class="devnahian-sportlixa-mobile-submenu">';
    }

    public function end_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '</div>';
    }

    public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
        $classes      = empty( $data_object->classes ) ? [] : (array) $data_object->classes;
        $has_children = in_array( 'menu-item-has-children', $classes, true );
        $is_active    = in_array( 'current-menu-item', $classes, true ) || in_array( 'current_page_item', $classes, true );
        $url          = ! empty( $data_object->url ) ? esc_url( $data_object->url ) : '#';

        $item_class = 'devnahian-sportlixa-mobile-nav-item' . ( $has_children ? ' has-dropdown' : '' );
        $link_class = 'devnahian-sportlixa-mobile-nav-link' . ( $is_active ? ' active' : '' );
        if ( $depth > 0 ) {
            $link_class .= ' is-sub-item';
        }

        $output .= '<div class="' . esc_attr( $item_class ) . '">';
        $output .= '<div class="devnahian-sportlixa-drawer-row">';
        $output .= '<a href="' . $url . '" class="' . esc_attr( $link_class ) . '">';
        $output .= '<span>' . esc_html( $data_object->title ) . '</span>';
        $output .= '</a>';

        if ( $has_children ) {
            $output .= '<button type="button" class="devnahian-sportlixa-drawer-toggle-btn" aria-label="Toggle submenu" onclick="event.preventDefault(); this.closest(\'.devnahian-sportlixa-mobile-nav-item\').classList.toggle(\'open\');">';
            $output .= '<svg class="drawer-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>';
            $output .= '</button>';
        } else {
            $output .= '<span class="drawer-leaf-icon"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg></span>';
        }
        $output .= '</div>';
    }

    public function end_el( &$output, $data_object, $depth = 0, $args = null ) {
        $output .= '</div>';
    }
}

/**
 * 3. Mobile Quick Chips Walker
 */
class Sportlixa_League_Chips_Walker extends Walker_Nav_Menu {
    public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
        $classes   = empty( $data_object->classes ) ? [] : (array) $data_object->classes;
        $is_active = in_array( 'current-menu-item', $classes, true ) || in_array( 'current_page_item', $classes, true );

        $class_names = 'devnahian-sportlixa-league-chip' . ( $is_active ? ' active' : '' );
        $url         = ! empty( $data_object->url ) ? esc_url( $data_object->url ) : '#';

        $output .= '<a href="' . $url . '" class="' . esc_attr( $class_names ) . '">' . esc_html( $data_object->title ) . '</a>';
    }
}

/**
 * 4. Mobile Bottom App Bar Walker
 */
class Sportlixa_Bottom_Bar_Nav_Walker extends Walker_Nav_Menu {
    public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
        $classes     = empty( $data_object->classes ) ? [] : (array) $data_object->classes;
        $is_active   = in_array( 'current-menu-item', $classes, true ) || in_array( 'current_page_item', $classes, true );
        $class_names = 'devnahian-sportlixa-bottom-bar-item' . ( $is_active ? ' active' : '' );
        $url         = ! empty( $data_object->url ) ? esc_url( $data_object->url ) : '#';
        $title       = strtolower( trim( $data_object->title ) );

        if ( str_contains( $title, 'score' ) ) {
            $svg = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>';
        } elseif ( str_contains( $title, 'nfl' ) || str_contains( $title, 'league' ) || str_contains( $title, 'cup' ) ) {
            $svg = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>';
        } elseif ( str_contains( $title, 'trend' ) || str_contains( $title, 'hot' ) || str_contains( $title, 'buzz' ) ) {
            $svg = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>';
        } else {
            $svg = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>';
        }

        $output .= '<a href="' . $url . '" class="' . esc_attr( $class_names ) . '">';
        $output .= $svg;
        $output .= '<span>' . esc_html( $data_object->title ) . '</span>';
        $output .= '</a>';
    }
}

/**
 * 5. Footer Menu Walker
 */
class Sportlixa_Footer_Nav_Walker extends Walker_Nav_Menu {
    public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
        $url   = ! empty( $data_object->url ) ? esc_url( $data_object->url ) : '#';
        $title = esc_html( $data_object->title );

        $output .= '<li>';
        $output .= '<a href="' . $url . '">';
        $output .= '<svg class="devnahian-sportlixa-footer-menu-arrow" viewBox="0 0 24 24" fill="none" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>';
        $output .= '<span>' . $title . '</span>';
        $output .= '</a>';
        $output .= '</li>';
    }
}

// Load theme settings panel
if ( file_exists( get_template_directory() . '/inc/theme-settings.php' ) ) {
    require_once get_template_directory() . '/inc/theme-settings.php';
}

/* ==========================================================================
   NFL DEDICATED API ENGINE (ESPN LIVE FEEDS)
   ========================================================================== */

/**
 * Universal safe remote fetcher with custom user-agent & SSL bypass
 */
function sportlixa_fetch_api_data( $url, $timeout = 8 ) {
    $response = wp_remote_get( $url, [
        'timeout'   => $timeout,
        'sslverify' => false,
        'headers'   => [
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
            'Accept'     => 'application/json',
        ],
    ] );

    if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
        return false;
    }

    $body = wp_remote_retrieve_body( $response );
    return json_decode( $body, true );
}

/**
 * 1. NFL Scoreboard & Live Scores API (Cached for 60s)
 */
function sportlixa_api_get_nfl_scoreboard() {
    $transient_key = 'sportlixa_nfl_scores_cache';
    $cached = get_transient( $transient_key );
    if ( false !== $cached ) {
        return $cached;
    }

    $url   = 'https://site.api.espn.com/apis/site/v2/sports/football/nfl/scoreboard';
    $data  = sportlixa_fetch_api_data( $url, 6 );
    $games = [];

    if ( $data && ! empty( $data['events'] ) ) {
        foreach ( $data['events'] as $event ) {
            $competition = $event['competitions'][0] ?? [];
            $competitors = $competition['competitors'] ?? [];
            $status_type = $event['status']['type'] ?? [];
            $broadcast   = $competition['broadcasts'][0]['names'][0] ?? 'CBS/FOX';
            $venue       = $competition['venue']['fullName'] ?? 'NFL Stadium';

            $home = [ 'code' => 'HOM', 'name' => 'Home', 'score' => 0, 'logo' => '' ];
            $away = [ 'code' => 'AWY', 'name' => 'Away', 'score' => 0, 'logo' => '' ];

            foreach ( $competitors as $c ) {
                $team_info = [
                    'code'  => $c['team']['abbreviation'] ?? 'NFL',
                    'name'  => $c['team']['displayName'] ?? 'Team',
                    'score' => (int) ( $c['score'] ?? 0 ),
                    'logo'  => $c['team']['logo'] ?? '',
                ];
                if ( ( $c['homeAway'] ?? '' ) === 'home' ) {
                    $home = $team_info;
                } else {
                    $away = $team_info;
                }
            }

            $games[] = [
                'status'     => $status_type['shortDetail'] ?? 'SCHEDULED',
                'detail'     => $status_type['detail'] ?? '',
                'is_live'    => ( $status_type['state'] ?? '' ) === 'in',
                'is_final'   => ( $status_type['state'] ?? '' ) === 'post',
                'home'       => $home,
                'away'       => $away,
                'broadcast'  => $broadcast,
                'venue'      => $venue,
            ];
        }
    }

    if ( empty( $games ) ) {
        $games = [
            [
                'status'    => 'FINAL',
                'detail'    => 'Final',
                'is_live'   => false,
                'is_final'  => true,
                'home'      => [ 'code' => 'KC', 'name' => 'Kansas City Chiefs', 'score' => 27, 'logo' => 'https://a.espncdn.com/i/teamlogos/nfl/500/kc.png' ],
                'away'      => [ 'code' => 'BUF', 'name' => 'Buffalo Bills', 'score' => 24, 'logo' => 'https://a.espncdn.com/i/teamlogos/nfl/500/buf.png' ],
                'broadcast' => 'CBS',
                'venue'     => 'Arrowhead Stadium',
            ]
        ];
    } else {
        set_transient( $transient_key, $games, 60 );
    }

    return $games;
}

/**
 * 2. NFL Full Schedule API (Cached for 1 Hour)
 */
function sportlixa_api_get_nfl_schedule() {
    $transient_key = 'sportlixa_nfl_schedule_cache';
    $cached = get_transient( $transient_key );
    if ( false !== $cached ) {
        return $cached;
    }

    $url      = 'https://site.api.espn.com/apis/site/v2/sports/football/nfl/scoreboard';
    $data     = sportlixa_fetch_api_data( $url, 8 );
    $schedule = [];

    if ( $data && ! empty( $data['events'] ) ) {
        foreach ( $data['events'] as $event ) {
            $competition = $event['competitions'][0] ?? [];
            $competitors = $competition['competitors'] ?? [];
            $status_type = $event['status']['type'] ?? [];
            $broadcast   = $competition['broadcasts'][0]['names'][0] ?? 'FOX/CBS';
            $venue_info  = $competition['venue'] ?? [];
            $venue_name  = ( $venue_info['fullName'] ?? 'NFL Stadium' ) . ( ! empty( $venue_info['address']['city'] ) ? ' (' . $venue_info['address']['city'] . ')' : '' );

            $home_team = 'Home';
            $away_team = 'Away';
            foreach ( $competitors as $c ) {
                if ( ( $c['homeAway'] ?? '' ) === 'home' ) {
                    $home_team = $c['team']['displayName'] ?? 'Home';
                } else {
                    $away_team = $c['team']['displayName'] ?? 'Away';
                }
            }

            $date_str = $event['date'] ?? '';
            $kickoff  = ! empty( $date_str ) ? date( 'D, M j - g:i A T', strtotime( $date_str ) ) : ( $status_type['detail'] ?? 'TBD' );

            $schedule[] = [
                'name'      => $away_team . ' @ ' . $home_team,
                'detail'    => $kickoff,
                'status'    => $status_type['shortDetail'] ?? 'Upcoming',
                'broadcast' => $broadcast,
                'venue'     => $venue_name,
            ];
        }
    }

    set_transient( $transient_key, $schedule, 3600 );
    return $schedule;
}

/**
 * 3. NFL Division Standings API (Cached for 1 Hour)
 */
function sportlixa_api_get_nfl_standings() {
    $transient_key = 'sportlixa_nfl_standings_cache';
    $cached = get_transient( $transient_key );
    if ( false !== $cached ) {
        return $cached;
    }

    $url       = 'https://site.api.espn.com/apis/v2/sports/football/nfl/standings';
    $data      = sportlixa_fetch_api_data( $url, 8 );
    $standings = [ 'afc' => [], 'nfc' => [] ];

    if ( $data && ! empty( $data['children'] ) ) {
        foreach ( $data['children'] as $conf ) {
            $conf_name = strtolower( $conf['name'] ?? '' );
            $conf_key  = strpos( $conf_name, 'american' ) !== false ? 'afc' : ( strpos( $conf_name, 'national' ) !== false ? 'nfc' : null );
            if ( ! $conf_key ) {
                continue;
            }

            foreach ( $conf['standings']['entries'] ?? [] as $entry ) {
                $team = $entry['team'] ?? [];
                $stats_map = [];
                foreach ( $entry['stats'] ?? [] as $s ) {
                    $stats_map[ $s['name'] ?? '' ] = $s['displayValue'] ?? '-';
                }

                $standings[ $conf_key ][] = [
                    'name'   => $team['displayName'] ?? 'Team',
                    'logo'   => $team['logos'][0]['href'] ?? '',
                    'w'      => $stats_map['wins'] ?? '0',
                    'l'      => $stats_map['losses'] ?? '0',
                    'pct'    => $stats_map['winPercent'] ?? '.000',
                    'div'    => $stats_map['divisionWinPercent'] ?? '0-0',
                    'streak' => $stats_map['streak'] ?? '1W',
                ];
            }
        }
    }

    set_transient( $transient_key, $standings, 3600 );
    return $standings;
}

/**
 * 4. NFL Consensus Betting Odds API (Cached for 5 Mins)
 */
function sportlixa_api_get_nfl_odds() {
    $transient_key = 'sportlixa_nfl_odds_cache';
    $cached = get_transient( $transient_key );
    if ( false !== $cached ) {
        return $cached;
    }

    $url       = 'https://site.api.espn.com/apis/site/v2/sports/football/nfl/scoreboard';
    $data      = sportlixa_fetch_api_data( $url, 6 );
    $odds_list = [];

    if ( $data && ! empty( $data['events'] ) ) {
        foreach ( $data['events'] as $event ) {
            $comp = $event['competitions'][0] ?? [];
            $odds = $comp['odds'][0] ?? [];

            $home = 'HOM';
            $away = 'AWY';
            foreach ( $comp['competitors'] ?? [] as $c ) {
                if ( ( $c['homeAway'] ?? '' ) === 'home' ) {
                    $home = $c['team']['abbreviation'] ?? 'HOM';
                } else {
                    $away = $c['team']['abbreviation'] ?? 'AWY';
                }
            }

            $spread     = $odds['details'] ?? ( $home . ' -2.5' );
            $over_under = isset( $odds['overUnder'] ) ? 'O/U ' . $odds['overUnder'] : 'O/U 46.5';
            
            $away_ml = $odds['awayTeamOdds']['moneyLine'] ?? '+115';
            $home_ml = $odds['homeTeamOdds']['moneyLine'] ?? '-135';

            $odds_list[] = [
                'matchup'   => $away . ' @ ' . $home,
                'spread'    => $spread,
                'total'     => $over_under,
                'moneyline' => $away . ' (' . $away_ml . ') / ' . $home . ' (' . $home_ml . ')',
                'status'    => $event['status']['type']['detail'] ?? 'Upcoming',
            ];
        }
    }

    set_transient( $transient_key, $odds_list, 300 );
    return $odds_list;
}

/**
 * --------------------------------------------------------------------------
 * 1. ESPN LIVE SCORES API (Cached for 60s) - ALL GAMES & OFFICIAL LOGOS
 * --------------------------------------------------------------------------
 */
function sportlixa_get_espn_live_scores() {
    $transient_key = 'sportlixa_cached_live_scores';

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

    if ( empty( $matches ) ) {
        $matches = [
            [ 'sport' => 'nfl', 'is_live' => true,  'status' => 'LIVE',     'detail' => 'Q4 02:34',   'possession' => 'KC Poss',       'home_code' => 'KC',  'home_score' => 24, 'home_logo' => '', 'away_code' => 'BUF', 'away_score' => 17, 'away_logo' => '' ],
            [ 'sport' => 'nba', 'is_live' => true,  'status' => 'LIVE',     'detail' => 'Q4 06:12',   'possession' => 'Bonus',         'home_code' => 'LAL', 'home_score' => 98, 'home_logo' => '', 'away_code' => 'BOS', 'away_score' => 94, 'away_logo' => '' ],
            [ 'sport' => 'mlb', 'is_live' => true,  'status' => 'LIVE',     'detail' => 'Top 7th',    'possession' => '1 Out • 1 on',   'home_code' => 'NYY', 'home_score' => 5,  'home_logo' => '', 'away_code' => 'BOS', 'away_score' => 3,  'away_logo' => '' ],
            [ 'sport' => 'nhl', 'is_live' => false, 'status' => 'PERIOD 2', 'detail' => '2nd 08:45', 'possession' => 'SOG: 19 - 28',  'home_code' => 'TOR', 'home_score' => 2,  'home_logo' => '', 'away_code' => 'BOS', 'away_score' => 4,  'away_logo' => '' ],
        ];
    } else {
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

/**
 * --------------------------------------------------------------------------
 * ESPN UPCOMING MATCHUPS & PREDICTIONS API (Cached for 10 mins)
 * --------------------------------------------------------------------------
 */
function sportlixa_get_espn_predictions() {
    $transient_key = 'sportlixa_cached_predictions';
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

    $predictions = [];

    foreach ( $leagues as $sport => $url ) {
        $response = wp_remote_get( $url, [
            'timeout'   => 8,
            'sslverify' => false,
            'headers'   => [ 'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)' ]
        ] );

        if ( is_wp_error( $response ) ) {
            continue;
        }

        $data   = json_decode( wp_remote_retrieve_body( $response ), true );
        $events = $data['events'] ?? [];

        foreach ( $events as $event ) {
            $competition = $event['competitions'][0] ?? [];
            $status_type = $event['status']['type'] ?? [];

            // Focus on scheduled or upcoming games (pre-game or active)
            $is_pre = ( $status_type['state'] ?? '' ) === 'pre';
            $competitors = $competition['competitors'] ?? [];

            $home = [ 'id' => '', 'code' => 'HOM', 'name' => 'Home Team', 'record' => '', 'logo' => '', 'win_pct' => 50 ];
            $away = [ 'id' => '', 'code' => 'AWY', 'name' => 'Away Team', 'record' => '', 'logo' => '', 'win_pct' => 50 ];

            foreach ( $competitors as $c ) {
                $team_info = [
                    'id'     => $c['id'] ?? '',
                    'code'   => $c['team']['abbreviation'] ?? 'TBD',
                    'name'   => $c['team']['shortDisplayName'] ?? $c['team']['name'] ?? 'Team',
                    'record' => $c['records'][0]['summary'] ?? '',
                    'logo'   => $c['team']['logo'] ?? '',
                    'win_pct'=> 50,
                ];

                if ( ( $c['homeAway'] ?? '' ) === 'home' ) {
                    $home = $team_info;
                } else {
                    $away = $team_info;
                }
            }

            // Extract ESPN Predictor Win Probabilities if available
            $predictor = $competition['predictor'] ?? [];
            if ( ! empty( $predictor['homeTeam']['gameProjection'] ) ) {
                $home['win_pct'] = round( (float) $predictor['homeTeam']['gameProjection'] );
                $away['win_pct'] = 100 - $home['win_pct'];
            }

            // Extract Odds & Spread
            $odds_item = $competition['odds'][0] ?? [];
            $spread    = $odds_item['details'] ?? 'EVEN';
            $over_under= ! empty( $odds_item['overUnder'] ) ? 'O/U ' . $odds_item['overUnder'] : 'O/U 46.5';
            $venue     = $competition['venue']['fullName'] ?? 'Stadium';
            $broadcast = $competition['broadcasts'][0]['names'][0] ?? 'TV';
            $game_date = ! empty( $event['date'] ) ? date( 'D, M j • g:i A', strtotime( $event['date'] ) ) : 'TBD';

            $predictions[] = [
                'id'         => $event['id'] ?? uniqid(),
                'sport'      => $sport,
                'is_pre'     => $is_pre,
                'game_date'  => $game_date,
                'venue'      => $venue,
                'broadcast'  => $broadcast,
                'spread'     => $spread,
                'over_under' => $over_under,
                'home'       => $home,
                'away'       => $away,
            ];
        }
    }

    // Cache results for 10 minutes (600 seconds)
    set_transient( $transient_key, $predictions, 600 );
    return $predictions;
}