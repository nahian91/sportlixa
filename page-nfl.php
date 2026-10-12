<?php
/**
 * Template Name: NFL - 5-Tab Interactive Hub
 * Template Post Type: page
 *
 * @package Sportlixa
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

// ==========================================================================
// 1. TAB CONTROLLER & PARAMETERS
// ==========================================================================
$valid_tabs = [
	'news'      => __( 'Latest News', 'sportlixa' ),
	'scores'    => __( 'Live Scores', 'sportlixa' ),
	'schedule'  => __( 'Full Schedule', 'sportlixa' ),
	'standings' => __( 'Standings', 'sportlixa' ),
	'odds'      => __( 'Vegas Odds', 'sportlixa' ),
];

$active_tab = isset( $_GET['tab'] ) && array_key_exists( sanitize_key( wp_unslash( $_GET['tab'] ) ), $valid_tabs )
	? sanitize_key( wp_unslash( $_GET['tab'] ) )
	: 'news';

$active_label     = $valid_tabs[ $active_tab ];
$current_page_url = get_permalink();
$default_thumb    = get_theme_file_uri( '/assets/img/placeholder.jpg' );

// ==========================================================================
// 2. SELF-CONTAINED DATA MODELS & FALLBACKS
// ==========================================================================

// Scores Fallback
$nfl_scores_data = function_exists( 'sportlixa_api_get_nfl_scoreboard' ) ? sportlixa_api_get_nfl_scoreboard() : [
	[
		'status'  => 'Q4 02:14',
		'is_live' => true,
		'detail'  => 'KC 2nd & Goal',
		'home'    => [ 'code' => 'KC', 'score' => 27, 'logo' => '' ],
		'away'    => [ 'code' => 'BUF', 'score' => 24, 'logo' => '' ],
	],
	[
		'status'  => 'FINAL',
		'is_live' => false,
		'detail'  => 'Jackson: 3 Total TD',
		'home'    => [ 'code' => 'BAL', 'score' => 31, 'logo' => '' ],
		'away'    => [ 'code' => 'CIN', 'score' => 28, 'logo' => '' ],
	],
	[
		'status'  => 'FINAL',
		'is_live' => false,
		'detail'  => 'Purdy: 285 Pass Yds',
		'home'    => [ 'code' => 'SF', 'score' => 30, 'logo' => '' ],
		'away'    => [ 'code' => 'LAR', 'score' => 20, 'logo' => '' ],
	],
	[
		'status'  => 'SUN 8:20 PM',
		'is_live' => false,
		'detail'  => 'NBC Sunday Night',
		'home'    => [ 'code' => 'DAL', 'score' => '--', 'logo' => '' ],
		'away'    => [ 'code' => 'PHI', 'score' => '--', 'logo' => '' ],
	],
];

// Schedule Fallback
$nfl_schedule_data = function_exists( 'sportlixa_api_get_nfl_schedule' ) ? sportlixa_api_get_nfl_schedule() : [
	[ 'name' => 'Kansas City Chiefs vs Buffalo Bills', 'detail' => 'Sunday, 4:25 PM ET', 'broadcast' => 'CBS', 'venue' => 'GEHA Field at Arrowhead Stadium' ],
	[ 'name' => 'Dallas Cowboys vs Philadelphia Eagles', 'detail' => 'Sunday, 8:20 PM ET', 'broadcast' => 'NBC', 'venue' => 'AT&T Stadium' ],
	[ 'name' => 'Baltimore Ravens vs Cincinnati Bengals', 'detail' => 'Thursday, 8:15 PM ET', 'broadcast' => 'Prime Video', 'venue' => 'M&T Bank Stadium' ],
	[ 'name' => 'San Francisco 49ers vs Seattle Seahawks', 'detail' => 'Monday, 8:15 PM ET', 'broadcast' => 'ESPN / ABC', 'venue' => 'Levi\'s Stadium' ],
];

// Standings Fallback
$nfl_standings_data = function_exists( 'sportlixa_api_get_nfl_standings' ) ? sportlixa_api_get_nfl_standings() : [
	'afc' => [
		[ 'name' => 'Kansas City Chiefs', 'w' => 5, 'l' => 0, 'pct' => '1.000', 'div' => '2-0', 'streak' => '5W', 'logo' => '' ],
		[ 'name' => 'Buffalo Bills',       'w' => 4, 'l' => 1, 'pct' => '.800',  'div' => '2-0', 'streak' => '1W', 'logo' => '' ],
		[ 'name' => 'Baltimore Ravens',    'w' => 4, 'l' => 1, 'pct' => '.800',  'div' => '1-0', 'streak' => '3W', 'logo' => '' ],
		[ 'name' => 'Houston Texans',     'w' => 4, 'l' => 1, 'pct' => '.800',  'div' => '2-0', 'streak' => '2W', 'logo' => '' ],
	],
	'nfc' => [
		[ 'name' => 'Minnesota Vikings',   'w' => 5, 'l' => 0, 'pct' => '1.000', 'div' => '1-0', 'streak' => '5W', 'logo' => '' ],
		[ 'name' => 'Detroit Lions',       'w' => 4, 'l' => 1, 'pct' => '.800',  'div' => '1-1', 'streak' => '3W', 'logo' => '' ],
		[ 'name' => 'Washington Command',  'w' => 4, 'l' => 1, 'pct' => '.800',  'div' => '1-0', 'streak' => '4W', 'logo' => '' ],
		[ 'name' => 'Tampa Bay Buccaneers', 'w' => 3, 'l' => 2, 'pct' => '.600',  'div' => '1-1', 'streak' => '1L', 'logo' => '' ],
	],
];

// Odds Fallback
$nfl_odds_data = function_exists( 'sportlixa_api_get_nfl_odds' ) ? sportlixa_api_get_nfl_odds() : [
	[ 'matchup' => 'BUF Bills @ KC Chiefs',     'spread' => 'KC -2.5',   'total' => 'O/U 48.5', 'moneyline' => '+120 / -140', 'status' => 'Sun 4:25 PM' ],
	[ 'matchup' => 'PHI Eagles @ DAL Cowboys',  'spread' => 'PHI -3.0',  'total' => 'O/U 44.5', 'moneyline' => '-155 / +135', 'status' => 'Sun 8:20 PM' ],
	[ 'matchup' => 'BAL Ravens @ CIN Bengals',  'spread' => 'BAL -1.5',  'total' => 'O/U 50.5', 'moneyline' => '-125 / +105', 'status' => 'Thu 8:15 PM' ],
	[ 'matchup' => 'SF 49ers @ SEA Seahawks',   'spread' => 'SF -3.5',   'total' => 'O/U 47.0', 'moneyline' => '-175 / +150', 'status' => 'Mon 8:15 PM' ],
];
?>

<!-- ==========================================================================
     EMBEDDED SCOPED STYLES
     ========================================================================== -->
<style>
	.nfl-page-wrap {
		padding-top: 1.5rem;
		padding-bottom: 4rem;
	}
	.nfl-breadcrumbs {
		margin-bottom: 1.25rem;
	}
	.nfl-breadcrumbs-list {
		display: flex;
		flex-wrap: wrap;
		align-items: center;
		gap: 0.5rem;
		list-style: none;
		padding: 0;
		margin: 0;
		font-size: 0.85rem;
	}
	.nfl-breadcrumbs-list a {
		color: var(--devnahian-sportlixa-text-muted, #95a5b8);
		text-decoration: none;
		transition: color var(--devnahian-sportlixa-transition-fast, 0.2s ease);
	}
	.nfl-breadcrumbs-list a:hover {
		color: var(--devnahian-sportlixa-brand-volt, #c8ff00);
	}
	.nfl-breadcrumbs-separator {
		color: var(--devnahian-sportlixa-text-dim, #64758b);
		user-select: none;
	}
	.nfl-breadcrumbs-current {
		color: var(--devnahian-sportlixa-text-white, #ffffff);
		font-weight: 700;
	}
	.nfl-hub-header {
		border-bottom: 1px solid var(--devnahian-sportlixa-border-color, #1a2538);
		padding-bottom: 1.5rem;
		margin-bottom: 2rem;
		position: static;
	}
	.nfl-brand-row {
		display: flex;
		align-items: center;
		gap: 1.25rem;
		margin: 0.75rem 0 1.5rem;
	}
	.nfl-shield-icon {
		width: 48px;
		height: 58px;
		flex-shrink: 0;
	}
	.nfl-hub-title {
		font-size: clamp(1.8rem, 3.2vw, 2.4rem);
		font-weight: 900;
		font-style: italic;
		margin: 0;
		color: var(--devnahian-sportlixa-text-white, #ffffff);
		letter-spacing: -0.02em;
		line-height: 1.15;
	}
	.nfl-hub-subtitle {
		color: var(--devnahian-sportlixa-text-muted, #95a5b8);
		font-size: 0.9rem;
		margin: 0.35rem 0 0;
		line-height: 1.5;
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
		color: var(--devnahian-sportlixa-text-muted, #95a5b8);
		background: var(--devnahian-sportlixa-bg-input, #151e2e);
		border: 1px solid var(--devnahian-sportlixa-border-card, #1e2a3f);
		border-radius: var(--devnahian-sportlixa-radius-sm, 6px);
		text-decoration: none;
		transition: all var(--devnahian-sportlixa-transition-fast, 0.2s ease);
	}
	.nfl-tab-link:hover,
	.nfl-tab-link.active {
		background: var(--devnahian-sportlixa-brand-volt, #c8ff00);
		color: #000000;
		border-color: var(--devnahian-sportlixa-brand-volt, #c8ff00);
		box-shadow: 0 0 12px var(--devnahian-sportlixa-brand-volt-glow, rgba(200, 255, 0, 0.28));
		transform: translateY(-2px);
	}
	.nfl-scores-grid {
		display: grid;
		grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
		gap: 1.5rem;
	}
	.nfl-table-card {
		background: var(--devnahian-sportlixa-bg-card, #121926);
		border-radius: var(--devnahian-sportlixa-radius-md, 10px);
		border: 1px solid var(--devnahian-sportlixa-border-card, #1e2a3f);
		box-shadow: var(--devnahian-sportlixa-shadow-card, 0 4px 20px rgba(0, 0, 0, 0.28));
		overflow-x: auto;
	}
	.nfl-table {
		width: 100%;
		border-collapse: collapse;
		font-size: 13px;
	}
	.nfl-table th {
		padding: 1rem 1.25rem;
		background: var(--devnahian-sportlixa-bg-dark, #080c14);
		border-bottom: 1px solid var(--devnahian-sportlixa-border-card, #1e2a3f);
		text-align: left;
		font-size: 0.75rem;
		font-weight: 800;
		text-transform: uppercase;
		letter-spacing: 0.05em;
		color: var(--devnahian-sportlixa-text-dim, #64758b);
	}
	.nfl-table td {
		padding: 1rem 1.25rem;
		border-bottom: 1px solid var(--devnahian-sportlixa-border-card, #1e2a3f);
		color: var(--devnahian-sportlixa-text-light, #e5ebf5);
		font-weight: 600;
	}
	.nfl-table tr:hover td {
		background: var(--devnahian-sportlixa-bg-input, #151e2e);
	}
	.nfl-standings-grid {
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
		gap: 2rem;
	}
	.nfl-conf-title {
		color: var(--devnahian-sportlixa-text-white, #ffffff);
		font-size: 1.1rem;
		font-weight: 800;
		font-style: italic;
		margin: 0 0 1rem;
		padding-bottom: 0.5rem;
		border-bottom: 1px solid var(--devnahian-sportlixa-border-color, #1a2538);
	}
	.nfl-news-grid {
		display: grid;
		grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
		gap: 1.75rem;
	}
	.nfl-news-card {
		background: var(--devnahian-sportlixa-bg-card, #121926);
		border: 1px solid var(--devnahian-sportlixa-border-card, #1e2a3f);
		border-radius: var(--devnahian-sportlixa-radius-md, 10px);
		overflow: hidden;
		display: flex;
		flex-direction: column;
		box-shadow: var(--devnahian-sportlixa-shadow-card, 0 4px 20px rgba(0, 0, 0, 0.28));
		transition: transform var(--devnahian-sportlixa-transition-smooth, 0.35s cubic-bezier(0.16, 1, 0.3, 1)), border-color var(--devnahian-sportlixa-transition-smooth, 0.35s cubic-bezier(0.16, 1, 0.3, 1));
	}
	.nfl-news-card:hover {
		transform: translateY(-3px);
		border-color: var(--devnahian-sportlixa-brand-volt, #c8ff00);
	}
</style>

<main class="devnahian-sportlixa-container nfl-page-wrap" id="primary" role="main">

	<!-- ==========================================================================
	     BREADCRUMB
	     ========================================================================== -->
	<nav class="nfl-breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'sportlixa' ); ?>">
		<ol class="nfl-breadcrumbs-list">
			<li>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'sportlixa' ); ?></a>
			</li>
			<li class="nfl-breadcrumbs-separator" aria-hidden="true">/</li>
			<li>
				<a href="<?php echo esc_url( $current_page_url ); ?>"><?php esc_html_e( 'NFL', 'sportlixa' ); ?></a>
			</li>
			<li class="nfl-breadcrumbs-separator" aria-hidden="true">/</li>
			<li class="nfl-breadcrumbs-current" aria-current="page">
				<?php echo esc_html( $active_label ); ?>
			</li>
		</ol>
	</nav>

	<!-- ==========================================================================
	     HUB MASTHEAD & 5-TAB NAVIGATION
	     ========================================================================== -->
	<header class="nfl-hub-header">
		<div style="margin-bottom: 0.5rem;">
			<span class="devnahian-sportlixa-badge-tag"><?php esc_html_e( 'NFL GAMEDAY', 'sportlixa' ); ?></span>
		</div>

		<div class="nfl-brand-row">
			<div class="nfl-shield-icon" aria-hidden="true">
				<svg viewBox="0 0 100 120" fill="none">
					<path d="M50 5 L88 24 L80 82 L50 115 L20 82 L12 24 Z" stroke="#003369" stroke-width="8" fill="#013369"/>
					<text x="50" y="55" fill="#ffffff" font-size="20" font-weight="900" font-style="italic" text-anchor="middle" font-family="Montserrat">NFL</text>
					<circle cx="50" cy="80" r="8" fill="var(--devnahian-sportlixa-brand-volt, #c8ff00)"/>
				</svg>
			</div>
			<div>
				<h1 class="nfl-hub-title"><?php echo esc_html( strtoupper( $active_label ) ); ?></h1>
				<p class="nfl-hub-subtitle"><?php esc_html_e( 'Latest headlines, live scoreboard, season schedule, standings, and consensus lines.', 'sportlixa' ); ?></p>
			</div>
		</div>

		<!-- 5 Subnav Tabs -->
		<nav class="nfl-subnav-tabs" role="tablist" aria-label="<?php esc_attr_e( 'NFL Section Tabs', 'sportlixa' ); ?>">
			<?php foreach ( $valid_tabs as $tab_key => $tab_name ) : 
				$tab_url   = ( 'news' === $tab_key ) ? $current_page_url : add_query_arg( 'tab', $tab_key, $current_page_url );
				$is_active = ( $tab_key === $active_tab );
				?>
				<a 
					href="<?php echo esc_url( $tab_url ); ?>" 
					class="nfl-tab-link <?php echo $is_active ? 'active' : ''; ?>"
					role="tab"
					aria-selected="<?php echo $is_active ? 'true' : 'false'; ?>"
				>
					<?php echo esc_html( $tab_name ); ?>
				</a>
			<?php endforeach; ?>
		</nav>
	</header>

	<!-- ==========================================================================
	     ACTIVE TAB CONTENT PANELS
	     ========================================================================== -->
	<section class="nfl-view-content" role="tabpanel" aria-label="<?php echo esc_attr( $active_label ); ?>">

		<?php if ( 'news' === $active_tab ) : ?>
			<!-- TAB 1: ALL NFL CATEGORY NEWS -->
			<?php
			$paged     = max( 1, (int) get_query_var( 'paged' ), (int) get_query_var( 'page' ) );
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

			// Fallback: If no category with slug 'nfl' exists, search by term name
			if ( ! $nfl_news->have_posts() ) {
				$nfl_term = get_term_by( 'name', 'NFL', 'category' );
				if ( $nfl_term ) {
					$news_args['tax_query'][0]['field'] = 'term_id';
					$news_args['tax_query'][0]['terms'] = [ $nfl_term->term_id ];
					$nfl_news                           = new WP_Query( $news_args );
				}
			}
			?>

			<?php if ( $nfl_news->have_posts() ) : ?>
				<div class="nfl-news-grid">
					<?php while ( $nfl_news->have_posts() ) : $nfl_news->the_post(); 
						$post_cats   = get_the_category();
						$badge_cat   = ! empty( $post_cats ) ? $post_cats[0]->name : 'NFL';
						$raw_content = strip_tags( strip_shortcodes( get_the_content() ) );
						$read_time   = max( 1, (int) ceil( str_word_count( $raw_content ) / 200 ) );
						?>
						<article class="nfl-news-card">
							<?php if ( has_post_thumbnail() ) : ?>
								<a href="<?php the_permalink(); ?>" style="display:block; aspect-ratio:16/9; overflow:hidden; position:relative;" tabindex="-1" aria-hidden="true">
									<?php the_post_thumbnail( 'medium_large', [ 'style' => 'width:100%; height:100%; object-fit:cover;' ] ); ?>
									<span class="devnahian-sportlixa-badge-tag" style="position:absolute; top:12px; left:12px;">
										<?php echo esc_html( $badge_cat ); ?>
									</span>
								</a>
							<?php endif; ?>

							<div style="padding:1.25rem; display:flex; flex-direction:column; flex-grow:1;">
								<div class="devnahian-sportlixa-meta-time" style="margin-bottom:0.6rem;">
									<span><?php echo esc_html( get_the_date() ); ?></span>
									<span aria-hidden="true">•</span>
									<span><?php printf( esc_html__( '%d min read', 'sportlixa' ), (int) $read_time ); ?></span>
								</div>

								<h3 style="font-size:1.1rem; font-weight:800; line-height:1.35; margin:0 0 0.75rem;">
									<a href="<?php the_permalink(); ?>">
										<?php the_title(); ?>
									</a>
								</h3>

								<p style="color:var(--devnahian-sportlixa-text-muted); font-size:0.875rem; margin:0; line-height:1.6; flex-grow:1;">
									<?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?>
								</p>

								<div style="margin-top:1.25rem; padding-top:0.85rem; border-top:1px solid rgba(255,255,255,0.05); display:flex; justify-content:space-between; align-items:center;">
									<a href="<?php the_permalink(); ?>" class="devnahian-sportlixa-title-link">
										<span><?php esc_html_e( 'Read Story', 'sportlixa' ); ?></span>
										<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true" focusable="false"><polyline points="9 18 15 12 9 6"/></svg>
									</a>
								</div>
							</div>
						</article>
					<?php endwhile; ?>
				</div>

				<!-- News Pagination -->
				<?php if ( $nfl_news->max_num_pages > 1 ) : ?>
					<div class="devnahian-sportlixa-load-more-wrap" style="margin-top:2.5rem;">
						<?php
						echo paginate_links( [
							'base'      => add_query_arg( 'paged', '%#%' ),
							'format'    => '',
							'current'   => max( 1, $paged ),
							'total'     => $nfl_news->max_num_pages,
							'prev_text' => esc_html__( '← Previous', 'sportlixa' ),
							'next_text' => esc_html__( 'Next Stories →', 'sportlixa' ),
						] );
						?>
					</div>
				<?php endif; ?>

				<?php wp_reset_postdata(); ?>

			<?php else : ?>
				<div class="devnahian-sportlixa-sidebar-card" style="text-align:center; padding:50px 20px;">
					<h3 style="color:#ffffff; margin-bottom:0.5rem;"><?php esc_html_e( 'No NFL articles found.', 'sportlixa' ); ?></h3>
					<p style="color:var(--devnahian-sportlixa-text-muted); margin:0; font-size:0.9rem;">
						<?php esc_html_e( 'Assign posts to the "NFL" category in Posts → Categories to display them here.', 'sportlixa' ); ?>
					</p>
				</div>
			<?php endif; ?>

		<?php elseif ( 'scores' === $active_tab ) : ?>
			<!-- TAB 2: LIVE SCORES -->
			<?php if ( ! empty( $nfl_scores_data ) ) : ?>
				<div class="nfl-scores-grid">
					<?php foreach ( $nfl_scores_data as $game ) : 
						$home_score = is_numeric( $game['home']['score'] ?? '' ) ? (int) $game['home']['score'] : 0;
						$away_score = is_numeric( $game['away']['score'] ?? '' ) ? (int) $game['away']['score'] : 0;
						$home_lead  = $home_score > $away_score;
						$away_lead  = $away_score > $home_score;
						?>
						<div class="devnahian-sportlixa-score-card">
							<div class="devnahian-sportlixa-score-card-header">
								<span>NFL • <?php echo esc_html( $game['status'] ); ?></span>
								<span class="<?php echo ! empty( $game['is_live'] ) ? 'live-indicator' : ''; ?>" style="<?php echo empty( $game['is_live'] ) ? 'color:var(--devnahian-sportlixa-text-dim);' : ''; ?>">
									<?php echo ! empty( $game['is_live'] ) ? esc_html__( 'LIVE', 'sportlixa' ) : esc_html( $game['status'] ); ?>
								</span>
							</div>
							<div class="devnahian-sportlixa-score-match-row">
								<div class="devnahian-sportlixa-score-team-side">
									<?php if ( ! empty( $game['home']['logo'] ) ) : ?>
										<img src="<?php echo esc_url( $game['home']['logo'] ); ?>" alt="<?php echo esc_attr( $game['home']['code'] ); ?>" class="devnahian-sportlixa-team-crest-svg" style="width:28px; height:28px; object-fit:contain;" loading="lazy">
									<?php else : ?>
										<div class="devnahian-sportlixa-team-code"><?php echo esc_html( $game['home']['code'] ); ?></div>
									<?php endif; ?>
								</div>
								<div class="devnahian-sportlixa-score-board-nums">
									<span class="<?php echo $home_lead ? 'lead-score' : ''; ?>"><?php echo esc_html( $game['home']['score'] ); ?></span>
									<span class="score-hyphen" aria-hidden="true">-</span>
									<span class="<?php echo $away_lead ? 'lead-score' : ''; ?>"><?php echo esc_html( $game['away']['score'] ); ?></span>
								</div>
								<div class="devnahian-sportlixa-score-team-side">
									<?php if ( ! empty( $game['away']['logo'] ) ) : ?>
										<img src="<?php echo esc_url( $game['away']['logo'] ); ?>" alt="<?php echo esc_attr( $game['away']['code'] ); ?>" class="devnahian-sportlixa-team-crest-svg" style="width:28px; height:28px; object-fit:contain;" loading="lazy">
									<?php else : ?>
										<div class="devnahian-sportlixa-team-code"><?php echo esc_html( $game['away']['code'] ); ?></div>
									<?php endif; ?>
								</div>
							</div>
							<div class="devnahian-sportlixa-score-time-status">
								<span><?php echo esc_html( $game['detail'] ); ?></span>
								<?php if ( ! empty( $game['is_live'] ) ) : ?>
									<span class="possession-dot">&#9670; <?php esc_html_e( 'In-Play', 'sportlixa' ); ?></span>
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
			<div class="nfl-table-card">
				<table class="nfl-table">
					<thead>
						<tr>
							<th><?php esc_html_e( 'Matchup', 'sportlixa' ); ?></th>
							<th><?php esc_html_e( 'Status / Kickoff Time', 'sportlixa' ); ?></th>
							<th><?php esc_html_e( 'Broadcast', 'sportlixa' ); ?></th>
							<th><?php esc_html_e( 'Stadium / Location', 'sportlixa' ); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php if ( ! empty( $nfl_schedule_data ) ) : ?>
							<?php foreach ( $nfl_schedule_data as $item ) : ?>
								<tr>
									<td style="font-weight:800; font-size:0.95rem; color:#fff;">
										<?php echo esc_html( $item['name'] ); ?>
									</td>
									<td style="color:var(--devnahian-sportlixa-brand-volt); font-weight:700;">
										<?php echo esc_html( $item['detail'] ); ?>
									</td>
									<td><?php echo esc_html( $item['broadcast'] ); ?></td>
									<td style="color:var(--devnahian-sportlixa-text-muted);"><?php echo esc_html( $item['venue'] ); ?></td>
								</tr>
							<?php endforeach; ?>
						<?php else : ?>
							<tr><td colspan="4" style="text-align:center; padding:30px;"><?php esc_html_e( 'Schedule updating from live feed...', 'sportlixa' ); ?></td></tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>

		<?php elseif ( 'standings' === $active_tab ) : ?>
			<!-- TAB 4: STANDINGS -->
			<div class="nfl-standings-grid">
				<!-- AFC -->
				<div class="devnahian-sportlixa-nfl-standings-box">
					<h3 class="nfl-conf-title"><?php esc_html_e( 'AFC Standings', 'sportlixa' ); ?></h3>
					<div style="overflow-x:auto;">
						<table class="devnahian-sportlixa-standings-table nfl-table">
							<thead>
								<tr>
									<th><?php esc_html_e( 'Team', 'sportlixa' ); ?></th>
									<th><?php esc_html_e( 'W', 'sportlixa' ); ?></th>
									<th><?php esc_html_e( 'L', 'sportlixa' ); ?></th>
									<th><?php esc_html_e( 'PCT', 'sportlixa' ); ?></th>
									<th><?php esc_html_e( 'DIV', 'sportlixa' ); ?></th>
									<th><?php esc_html_e( 'STRK', 'sportlixa' ); ?></th>
								</tr>
							</thead>
							<tbody>
								<?php if ( ! empty( $nfl_standings_data['afc'] ) ) : ?>
									<?php foreach ( $nfl_standings_data['afc'] as $team ) : ?>
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
							<thead>
								<tr>
									<th><?php esc_html_e( 'Team', 'sportlixa' ); ?></th>
									<th><?php esc_html_e( 'W', 'sportlixa' ); ?></th>
									<th><?php esc_html_e( 'L', 'sportlixa' ); ?></th>
									<th><?php esc_html_e( 'PCT', 'sportlixa' ); ?></th>
									<th><?php esc_html_e( 'DIV', 'sportlixa' ); ?></th>
									<th><?php esc_html_e( 'STRK', 'sportlixa' ); ?></th>
								</tr>
							</thead>
							<tbody>
								<?php if ( ! empty( $nfl_standings_data['nfc'] ) ) : ?>
									<?php foreach ( $nfl_standings_data['nfc'] as $team ) : ?>
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
			<div class="nfl-table-card">
				<table class="nfl-table">
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
						<?php if ( ! empty( $nfl_odds_data ) ) : ?>
							<?php foreach ( $nfl_odds_data as $o ) : ?>
								<tr>
									<td style="font-weight:800; font-size:0.95rem; color:#fff;">
										<?php echo esc_html( $o['matchup'] ); ?>
									</td>
									<td style="color:var(--devnahian-sportlixa-brand-volt); font-weight:800;">
										<?php echo esc_html( $o['spread'] ); ?>
									</td>
									<td style="font-weight:700;"><?php echo esc_html( $o['total'] ); ?></td>
									<td><?php echo esc_html( $o['moneyline'] ); ?></td>
									<td style="color:var(--devnahian-sportlixa-text-muted); font-size:0.825rem;"><?php echo esc_html( $o['status'] ); ?></td>
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