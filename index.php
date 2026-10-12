<?php
/**
 * The main template file / Front Page (All-in-One Standalone)
 *
 * @package Sportlixa
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

// ==========================================================================
// 1. DATA PREPARATION & SAFE FALLBACKS
// ==========================================================================
$default_thumb = get_theme_file_uri( '/assets/img/placeholder.jpg' );

// Pill Counts Fallback
$pill_counts = isset( $pill_counts ) && is_array( $pill_counts ) ? $pill_counts : [
	'all' => 4,
	'nfl' => 2,
	'nba' => 1,
	'mlb' => 1,
	'nhl' => 0,
];

// Live Games Data Fallback
$live_games_data = isset( $live_games_data ) && is_array( $live_games_data ) ? $live_games_data : [
	[ 'sport' => 'nfl', 'is_live' => true,  'status' => 'WEEK 5', 'detail' => 'Q4 02:34', 'possession' => 'KC Poss',        'home_code' => 'KC',  'home_score' => 24, 'home_logo' => '', 'away_code' => 'BUF', 'away_score' => 17, 'away_logo' => '' ],
	[ 'sport' => 'nfl', 'is_live' => true,  'status' => 'WEEK 5', 'detail' => 'Q4 08:15', 'possession' => 'CIN Red Zone',   'home_code' => 'BAL', 'home_score' => 31, 'home_logo' => '', 'away_code' => 'CIN', 'away_score' => 28, 'away_logo' => '' ],
	[ 'sport' => 'nba', 'is_live' => false, 'status' => 'FINAL',  'detail' => 'Tatum: 34 PTS', 'possession' => '',          'home_code' => 'BOS', 'home_score' => 112, 'home_logo' => '', 'away_code' => 'MIA', 'away_score' => 104, 'away_logo' => '' ],
	[ 'sport' => 'mlb', 'is_live' => false, 'status' => 'FINAL',  'detail' => 'Judge: 2 HR', 'possession' => '',            'home_code' => 'NYY', 'home_score' => 6,  'home_logo' => '', 'away_code' => 'LAD', 'away_score' => 4,  'away_logo' => '' ],
];

// NFL Standings Fallback
$nfl_standings = isset( $nfl_standings ) && is_array( $nfl_standings ) ? $nfl_standings : [
	'afc' => [
		[ 'team' => 'KC Chiefs',   'w' => 4, 'l' => 0, 'pct' => '1.000', 'div' => '2-0', 'streak' => '4W' ],
		[ 'team' => 'BUF Bills',   'w' => 3, 'l' => 1, 'pct' => '.750',  'div' => '1-0', 'streak' => '1W' ],
		[ 'team' => 'BAL Ravens',  'w' => 3, 'l' => 1, 'pct' => '.750',  'div' => '2-0', 'streak' => '2W' ],
		[ 'team' => 'HOU Texans',  'w' => 3, 'l' => 1, 'pct' => '.750',  'div' => '2-0', 'streak' => '1W' ],
	],
	'nfc' => [
		[ 'team' => 'MIN Vikings', 'w' => 4, 'l' => 0, 'pct' => '1.000', 'div' => '2-0', 'streak' => '4W' ],
		[ 'team' => 'DET Lions',   'w' => 3, 'l' => 1, 'pct' => '.750',  'div' => '1-1', 'streak' => '2W' ],
		[ 'team' => 'WAS Command', 'w' => 3, 'l' => 1, 'pct' => '.750',  'div' => '1-0', 'streak' => '3W' ],
		[ 'team' => 'TB Bucs',     'w' => 3, 'l' => 1, 'pct' => '.750',  'div' => '1-0', 'streak' => '1W' ],
	],
];

// Team Logo Fallback Helper
if ( ! function_exists( 'sportlixa_standalone_team_crest' ) ) {
	function sportlixa_standalone_team_crest( $code, $logo_url = '' ) {
		if ( ! empty( $logo_url ) ) {
			echo '<img src="' . esc_url( $logo_url ) . '" alt="' . esc_attr( $code ) . '" class="devnahian-sportlixa-team-crest-svg" style="object-fit:contain;" loading="lazy">';
			return;
		}
		$c = strtoupper( trim( $code ) );
		?>
		<svg class="devnahian-sportlixa-team-crest-svg" viewBox="0 0 40 40" aria-hidden="true" focusable="false">
			<circle cx="20" cy="20" r="16" fill="#141822" stroke="rgba(255,255,255,0.2)" stroke-width="1.5"/>
			<text x="20" y="24" fill="#ffffff" font-size="8.5" font-weight="900" text-anchor="middle"><?php echo esc_html( substr( $c, 0, 3 ) ); ?></text>
		</svg>
		<?php
	}
}
?>

<main class="devnahian-sportlixa-container" id="primary" role="main">

	<!-- ==========================================================================
	     HERO SECTION (#nfl)
	     ========================================================================== -->
	<section class="devnahian-sportlixa-hero-section" id="nfl" aria-label="<?php esc_attr_e( 'Featured Hero Stories', 'sportlixa' ); ?>">
		<div class="devnahian-sportlixa-hero-grid">

			<?php
			$hero_featured_query = function_exists( 'sportlixa_get_featured_posts' ) 
				? sportlixa_get_featured_posts( 4 ) 
				: new WP_Query( [ 'posts_per_page' => 4, 'post_status' => 'publish', 'no_found_rows' => true ] );

			if ( $hero_featured_query->have_posts() ) :
				$hero_featured_query->the_post();
				$categories = get_the_category();
				$cat_name   = ( ! empty( $categories ) && isset( $categories[0]->name ) ) ? $categories[0]->name : __( 'NFL', 'sportlixa' );
				$thumb_url  = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'full' ) : $default_thumb;
				$words      = str_word_count( strip_tags( strip_shortcodes( get_the_content() ) ) );
				$read_time  = max( 1, (int) ceil( $words / 200 ) );
				?>
				<article class="devnahian-sportlixa-hero-lead-card">
					<img 
						src="<?php echo esc_url( $thumb_url ); ?>" 
						alt="<?php echo the_title_attribute( [ 'echo' => false ] ); ?>" 
						class="devnahian-sportlixa-hero-bg-img" 
						loading="eager"
					>
					<div class="devnahian-sportlixa-hero-overlay"></div>
					<div class="devnahian-sportlixa-hero-content">
						<span class="devnahian-sportlixa-badge-tag"><?php echo esc_html( $cat_name ); ?></span>
						<h1 class="devnahian-sportlixa-hero-headline">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h1>
						<p class="devnahian-sportlixa-hero-subtext"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 24 ) ); ?></p>
						<div class="devnahian-sportlixa-hero-meta-row">
							<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
							<span><?php echo esc_html( get_the_date() ); ?></span>
							<span aria-hidden="true">•</span>
							<span><?php printf( esc_html__( '%d min read', 'sportlixa' ), (int) $read_time ); ?></span>
						</div>
						<a href="<?php the_permalink(); ?>" class="devnahian-sportlixa-btn-lime"><?php esc_html_e( 'READ FULL BREAKDOWN →', 'sportlixa' ); ?></a>
					</div>
				</article>

				<aside class="devnahian-sportlixa-hero-stacked" aria-label="<?php esc_attr_e( 'Stacked Lead Stories', 'sportlixa' ); ?>">
					<?php
					while ( $hero_featured_query->have_posts() ) :
						$hero_featured_query->the_post();
						$categories = get_the_category();
						$cat_name   = ( ! empty( $categories ) && isset( $categories[0]->name ) ) ? $categories[0]->name : __( 'Sports', 'sportlixa' );
						$thumb_url  = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'medium_large' ) : $default_thumb;
						$words      = str_word_count( strip_tags( strip_shortcodes( get_the_content() ) ) );
						$read_time  = max( 1, (int) ceil( $words / 200 ) );
						?>
						<article class="devnahian-sportlixa-stacked-card">
							<div class="devnahian-sportlixa-stacked-thumb devnahian-sportlixa-img-box">
								<img 
									src="<?php echo esc_url( $thumb_url ); ?>" 
									alt="<?php echo the_title_attribute( [ 'echo' => false ] ); ?>" 
									loading="lazy"
								>
							</div>
							<div class="devnahian-sportlixa-stacked-info">
								<div><span class="devnahian-sportlixa-badge-tag"><?php echo esc_html( $cat_name ); ?></span></div>
								<h3 class="devnahian-sportlixa-stacked-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>
								<div class="devnahian-sportlixa-meta-time">
									<span><?php echo esc_html( get_the_date() ); ?></span>
									<span aria-hidden="true">•</span>
									<span><?php printf( esc_html__( '%d min read', 'sportlixa' ), (int) $read_time ); ?></span>
								</div>
							</div>
						</article>
						<?php
					endwhile;
					?>
				</aside>
				<?php
				wp_reset_postdata();
			endif;
			?>

		</div>
	</section>

	<!-- ==========================================================================
	     CONTAINED PROFESSIONAL LIVE SCORES STRIP
	     ========================================================================== -->
	<section class="devnahian-sportlixa-live-scores-container-block" id="scores" aria-label="<?php esc_attr_e( 'Live Scoreboard Center', 'sportlixa' ); ?>">
		<div class="devnahian-sportlixa-scores-header">
			<div class="devnahian-sportlixa-title-left" style="font-size:13px;"><?php esc_html_e( 'LIVE SCORE CENTER', 'sportlixa' ); ?></div>
			<div class="devnahian-sportlixa-score-filters">
				<button type="button" class="devnahian-sportlixa-filter-pill active" onclick="filterLiveScores('all', this)"><?php printf( esc_html__( 'ALL (%d)', 'sportlixa' ), (int) $pill_counts['all'] ); ?></button>
				<button type="button" class="devnahian-sportlixa-filter-pill" onclick="filterLiveScores('nfl', this)"><?php printf( esc_html__( 'NFL (%d)', 'sportlixa' ), (int) $pill_counts['nfl'] ); ?></button>
				<button type="button" class="devnahian-sportlixa-filter-pill" onclick="filterLiveScores('nba', this)"><?php printf( esc_html__( 'NBA (%d)', 'sportlixa' ), (int) $pill_counts['nba'] ); ?></button>
				<button type="button" class="devnahian-sportlixa-filter-pill" onclick="filterLiveScores('mlb', this)"><?php printf( esc_html__( 'MLB (%d)', 'sportlixa' ), (int) $pill_counts['mlb'] ); ?></button>
				<button type="button" class="devnahian-sportlixa-filter-pill" onclick="filterLiveScores('nhl', this)"><?php printf( esc_html__( 'NHL (%d)', 'sportlixa' ), (int) $pill_counts['nhl'] ); ?></button>
			</div>
		</div>

		<div class="devnahian-sportlixa-live-scores-scroller" id="sportlixaScoresScroller">
			<span class="devnahian-sportlixa-live-pill">&bull; <?php esc_html_e( 'LIVE', 'sportlixa' ); ?></span>

			<?php foreach ( $live_games_data as $game ) : 
				$home_score = is_numeric( $game['home_score'] ) ? (int) $game['home_score'] : 0;
				$away_score = is_numeric( $game['away_score'] ) ? (int) $game['away_score'] : 0;
				$home_lead  = $home_score > $away_score;
				$away_lead  = $away_score > $home_score;
				?>
				<div class="devnahian-sportlixa-score-card" data-sport="<?php echo esc_attr( strtolower( $game['sport'] ) ); ?>">
					<div class="devnahian-sportlixa-score-card-header">
						<span><?php echo esc_html( strtoupper( $game['sport'] ) ); ?></span>
						<span class="<?php echo ! empty( $game['is_live'] ) ? 'live-indicator' : ''; ?>">
							<?php echo esc_html( $game['status'] ); ?>
						</span>
					</div>
					<div class="devnahian-sportlixa-score-match-row">
						<div class="devnahian-sportlixa-score-team-side">
							<?php sportlixa_standalone_team_crest( $game['home_code'], $game['home_logo'] ); ?>
							<span class="devnahian-sportlixa-team-code"><?php echo esc_html( $game['home_code'] ); ?></span>
						</div>
						<div class="devnahian-sportlixa-score-board-nums">
							<span class="<?php echo $home_lead ? 'lead-score' : ''; ?>"><?php echo esc_html( $game['home_score'] ); ?></span>
							<span class="score-hyphen" aria-hidden="true">-</span>
							<span class="<?php echo $away_lead ? 'lead-score' : ''; ?>"><?php echo esc_html( $game['away_score'] ); ?></span>
						</div>
						<div class="devnahian-sportlixa-score-team-side">
							<span class="devnahian-sportlixa-team-code"><?php echo esc_html( $game['away_code'] ); ?></span>
							<?php sportlixa_standalone_team_crest( $game['away_code'], $game['away_logo'] ); ?>
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
			<?php
			$blog_page_id = get_option( 'page_for_posts' );
			$all_url      = ! empty( $blog_page_id ) ? get_permalink( $blog_page_id ) : home_url( '/' );
			?>
			<a href="<?php echo esc_url( $all_url ); ?>" class="devnahian-sportlixa-title-link"><?php esc_html_e( 'View all →', 'sportlixa' ); ?></a>
		</div>

		<div class="devnahian-sportlixa-top-stories-grid">

			<!-- Column 1: Lead Top Story Card -->
			<?php
			$top_story_hero = function_exists( 'sportlixa_get_top_stories_posts' ) 
				? sportlixa_get_top_stories_posts( 1 ) 
				: new WP_Query( [ 'posts_per_page' => 1, 'offset' => 4, 'post_status' => 'publish', 'no_found_rows' => true ] );

			if ( $top_story_hero->have_posts() ) :
				while ( $top_story_hero->have_posts() ) :
					$top_story_hero->the_post();
					$categories = get_the_category();
					$cat_name   = ( ! empty( $categories ) && isset( $categories[0]->name ) ) ? $categories[0]->name : __( 'Top Story', 'sportlixa' );
					$thumb_url  = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'large' ) : $default_thumb;
					$words      = str_word_count( strip_tags( strip_shortcodes( get_the_content() ) ) );
					$read_time  = max( 1, (int) ceil( $words / 200 ) );
					?>
					<article class="devnahian-sportlixa-top-story-hero">
						<img 
							src="<?php echo esc_url( $thumb_url ); ?>" 
							alt="<?php echo the_title_attribute( [ 'echo' => false ] ); ?>" 
							class="devnahian-sportlixa-top-story-bg-img" 
							loading="lazy"
						>
						<div class="overlay"></div>
						<div class="devnahian-sportlixa-top-story-hero-content">
							<span class="devnahian-sportlixa-badge-tag"><?php echo esc_html( $cat_name ); ?></span>
							<h2 class="devnahian-sportlixa-top-story-hero-title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h2>
							<div class="devnahian-sportlixa-meta-time" style="color:#b5c0d0;">
								<span><?php echo esc_html( get_the_date() ); ?></span>
								<span aria-hidden="true">•</span>
								<span><?php printf( esc_html__( '%d min read', 'sportlixa' ), (int) $read_time ); ?></span>
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
				$top_story_ids = function_exists( 'sportlixa_get_option' ) ? sportlixa_get_option( 'top_story_post_ids', [] ) : [];

				if ( ! empty( $top_story_ids ) ) {
					$mid_stories = new WP_Query( [
						'post__in'       => $top_story_ids,
						'orderby'        => 'post__in',
						'posts_per_page' => 3,
						'offset'         => 1,
						'post_status'    => 'publish',
						'no_found_rows'  => true,
					] );
				} else {
					$mid_stories = new WP_Query( [
						'posts_per_page'      => 3,
						'offset'              => 5,
						'post_status'         => 'publish',
						'ignore_sticky_posts' => 1,
						'no_found_rows'       => true,
					] );
				}

				if ( $mid_stories->have_posts() ) :
					while ( $mid_stories->have_posts() ) :
						$mid_stories->the_post();
						$categories = get_the_category();
						$cat_name   = ( ! empty( $categories ) && isset( $categories[0]->name ) ) ? $categories[0]->name : __( 'Sports', 'sportlixa' );
						$thumb_url  = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'medium' ) : $default_thumb;
						$words      = str_word_count( strip_tags( strip_shortcodes( get_the_content() ) ) );
						$read_time  = max( 1, (int) ceil( $words / 200 ) );
						?>
						<article class="devnahian-sportlixa-mid-story-card">
							<div class="devnahian-sportlixa-mid-story-thumb devnahian-sportlixa-img-box">
								<img 
									src="<?php echo esc_url( $thumb_url ); ?>" 
									alt="<?php echo the_title_attribute( [ 'echo' => false ] ); ?>" 
									loading="lazy"
								>
							</div>
							<div class="devnahian-sportlixa-mid-story-info">
								<div><span class="devnahian-sportlixa-badge-tag"><?php echo esc_html( $cat_name ); ?></span></div>
								<h3 class="devnahian-sportlixa-mid-story-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>
								<div class="devnahian-sportlixa-meta-time">
									<span><?php echo esc_html( get_the_date() ); ?></span>
									<span aria-hidden="true">•</span>
									<span><?php printf( esc_html__( '%d min read', 'sportlixa' ), (int) $read_time ); ?></span>
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
						<span><?php esc_html_e( 'SUN 4:25 PM • CBS', 'sportlixa' ); ?></span>
					</div>
					<div class="devnahian-sportlixa-marquee-teams">
						<div class="devnahian-sportlixa-marquee-team">
							<span class="abbr">KC</span>
							<span class="rec">(4-0)</span>
						</div>
						<span class="devnahian-sportlixa-marquee-vs" aria-hidden="true">VS</span>
						<div class="devnahian-sportlixa-marquee-team">
							<span class="abbr">BUF</span>
							<span class="rec">(3-1)</span>
						</div>
					</div>
					<div class="devnahian-sportlixa-marquee-odds">
						<span><?php esc_html_e( 'Spread:', 'sportlixa' ); ?> <strong>KC -2.5</strong></span>
						<span><?php esc_html_e( 'Total:', 'sportlixa' ); ?> <strong>O/U 48.5</strong></span>
					</div>
					<div class="devnahian-sportlixa-pick-row">
						<button type="button" class="devnahian-sportlixa-btn-pick" onclick="castMatchupPick(this, 'KC Chiefs')"><?php esc_html_e( 'Pick KC (64%)', 'sportlixa' ); ?></button>
						<button type="button" class="devnahian-sportlixa-btn-pick" onclick="castMatchupPick(this, 'BUF Bills')"><?php esc_html_e( 'Pick BUF (36%)', 'sportlixa' ); ?></button>
					</div>
				</div>

				<div class="devnahian-sportlixa-trending-box" id="trending">
					<div class="devnahian-sportlixa-trending-header"><?php esc_html_e( 'TRENDING NOW', 'sportlixa' ); ?></div>
					<ol class="devnahian-sportlixa-trending-list">
						<?php
						$trending_query = new WP_Query( [
							'posts_per_page'      => 5,
							'orderby'             => 'comment_count',
							'order'               => 'DESC',
							'post_status'         => 'publish',
							'ignore_sticky_posts' => 1,
							'no_found_rows'       => true,
						] );

						$trend_counter = 1;
						if ( $trending_query->have_posts() ) :
							while ( $trending_query->have_posts() ) :
								$trending_query->the_post();
								?>
								<li class="devnahian-sportlixa-trending-item">
									<span class="devnahian-sportlixa-trending-num" aria-hidden="true"><?php echo (int) $trend_counter++; ?></span>
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
	     DEDICATED MULTI-SPORT SPOTLIGHT HUB
	     ========================================================================== -->
	<section class="devnahian-sportlixa-multisport-section">
		<div class="devnahian-sportlixa-section-title">
			<div class="devnahian-sportlixa-title-left"><?php esc_html_e( 'LEAGUE SPOTLIGHTS', 'sportlixa' ); ?></div>
			<a href="#leagues" class="devnahian-sportlixa-title-link"><?php esc_html_e( 'All Leagues →', 'sportlixa' ); ?></a>
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
					'no_found_rows'       => true,
				] );

				if ( $league_post->have_posts() ) :
					while ( $league_post->have_posts() ) :
						$league_post->the_post();
						$thumb_url = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'medium_large' ) : $default_thumb;
						$words     = str_word_count( strip_tags( strip_shortcodes( get_the_content() ) ) );
						$read_time = max( 1, (int) ceil( $words / 200 ) );
						?>
						<article class="sport-spot-card" id="<?php echo esc_attr( $league_slug ); ?>">
							<div class="sport-spot-img-wrap devnahian-sportlixa-img-box">
								<span class="devnahian-sportlixa-badge-tag sport-spot-badge"><?php echo esc_html( strtoupper( $league_slug ) ); ?></span>
								<img 
									src="<?php echo esc_url( $thumb_url ); ?>" 
									alt="<?php echo the_title_attribute( [ 'echo' => false ] ); ?>" 
									loading="lazy"
								>
							</div>
							<div class="sport-spot-content">
								<h4 class="sport-spot-headline">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h4>
								<p class="sport-spot-desc"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 14 ) ); ?></p>
								<div class="meta-time"><?php printf( esc_html__( '%d min read • League Wire', 'sportlixa' ), (int) $read_time ); ?></div>
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
	     NFL STANDINGS & MVP STAT LEADERS
	     ========================================================================== -->
	<section class="devnahian-sportlixa-nfl-expanded-section" id="nfl-standings">
		<div class="devnahian-sportlixa-section-title">
			<div class="devnahian-sportlixa-title-left"><?php esc_html_e( 'NFL DIVISION RACE & MVP STAT LEADERS', 'sportlixa' ); ?></div>
			<a href="#scores" class="devnahian-sportlixa-title-link"><?php esc_html_e( 'Full Standings →', 'sportlixa' ); ?></a>
		</div>

		<div class="devnahian-sportlixa-nfl-dual-grid">
			<div class="devnahian-sportlixa-nfl-standings-box">
				<div class="devnahian-sportlixa-standings-tabs">
					<button type="button" class="devnahian-sportlixa-tab-btn active" id="devnahian-sportlixa-tabAfcBtn" onclick="switchStandingsConference('afc')"><?php esc_html_e( 'AFC Leaders', 'sportlixa' ); ?></button>
					<button type="button" class="devnahian-sportlixa-tab-btn" id="devnahian-sportlixa-tabNfcBtn" onclick="switchStandingsConference('nfc')"><?php esc_html_e( 'NFC Leaders', 'sportlixa' ); ?></button>
				</div>
				<div class="devnahian-sportlixa-table-responsive-wrapper">
					<table class="devnahian-sportlixa-standings-table">
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
						<tbody id="devnahian-sportlixa-standingsTableBody">
							<?php 
							$rank = 1;
							foreach ( $nfl_standings['afc'] as $team_row ) : ?>
								<tr>
									<td class="devnahian-sportlixa-team-cell"><span class="devnahian-sportlixa-rank-dot"><?php echo (int) $rank++; ?></span> <?php echo esc_html( $team_row['team'] ); ?></td>
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

			<div class="devnahian-sportlixa-nfl-leaders-box" id="nfl-leaders">
				<?php
				$player_avatar = get_theme_file_uri( '/assets/img/player-leader-1.jpg' );
				?>
				<!-- 1. Patrick Mahomes -->
				<div class="devnahian-sportlixa-leader-row">
					<div class="devnahian-sportlixa-leader-player-wrap">
						<div class="devnahian-sportlixa-leader-avatar">
							<img src="<?php echo esc_url( $player_avatar ); ?>" alt="<?php esc_attr_e( 'Patrick Mahomes', 'sportlixa' ); ?>" loading="lazy">
						</div>
						<div>
							<div class="devnahian-sportlixa-leader-player-name">Patrick Mahomes</div>
							<div class="devnahian-sportlixa-leader-cat"><?php esc_html_e( 'Passing Leader • KC', 'sportlixa' ); ?></div>
						</div>
					</div>
					<div class="devnahian-sportlixa-leader-stat">
						<div class="devnahian-sportlixa-leader-value">1,315</div>
						<div class="devnahian-sportlixa-leader-unit"><?php esc_html_e( 'Pass Yds / 11 TD', 'sportlixa' ); ?></div>
					</div>
				</div>

				<!-- 2. Josh Allen -->
				<div class="devnahian-sportlixa-leader-row">
					<div class="devnahian-sportlixa-leader-player-wrap">
						<div class="devnahian-sportlixa-leader-avatar">
							<img src="<?php echo esc_url( $player_avatar ); ?>" alt="<?php esc_attr_e( 'Josh Allen', 'sportlixa' ); ?>" loading="lazy">
						</div>
						<div>
							<div class="devnahian-sportlixa-leader-player-name">Josh Allen</div>
							<div class="devnahian-sportlixa-leader-cat"><?php esc_html_e( 'Total QBR • BUF', 'sportlixa' ); ?></div>
						</div>
					</div>
					<div class="devnahian-sportlixa-leader-stat">
						<div class="devnahian-sportlixa-leader-value">84.2</div>
						<div class="devnahian-sportlixa-leader-unit"><?php esc_html_e( 'QBR Rating', 'sportlixa' ); ?></div>
					</div>
				</div>

				<!-- 3. Kenneth Walker III -->
				<div class="devnahian-sportlixa-leader-row">
					<div class="devnahian-sportlixa-leader-player-wrap">
						<div class="devnahian-sportlixa-leader-avatar">
							<img src="<?php echo esc_url( $player_avatar ); ?>" alt="<?php esc_attr_e( 'Kenneth Walker III', 'sportlixa' ); ?>" loading="lazy">
						</div>
						<div>
							<div class="devnahian-sportlixa-leader-player-name">Kenneth Walker III</div>
							<div class="devnahian-sportlixa-leader-cat"><?php esc_html_e( 'Rushing Leader • SEA', 'sportlixa' ); ?></div>
						</div>
					</div>
					<div class="devnahian-sportlixa-leader-stat">
						<div class="devnahian-sportlixa-leader-value">537</div>
						<div class="devnahian-sportlixa-leader-unit"><?php esc_html_e( 'Rush Yds / 6 TD', 'sportlixa' ); ?></div>
					</div>
				</div>

				<!-- 4. CeeDee Lamb -->
				<div class="devnahian-sportlixa-leader-row">
					<div class="devnahian-sportlixa-leader-player-wrap">
						<div class="devnahian-sportlixa-leader-avatar">
							<img src="<?php echo esc_url( $player_avatar ); ?>" alt="<?php esc_attr_e( 'CeeDee Lamb', 'sportlixa' ); ?>" loading="lazy">
						</div>
						<div>
							<div class="devnahian-sportlixa-leader-player-name">CeeDee Lamb</div>
							<div class="devnahian-sportlixa-leader-cat"><?php esc_html_e( 'Receiving Leader • DAL', 'sportlixa' ); ?></div>
						</div>
					</div>
					<div class="devnahian-sportlixa-leader-stat">
						<div class="devnahian-sportlixa-leader-value">498</div>
						<div class="devnahian-sportlixa-leader-unit"><?php esc_html_e( 'Rec Yds / 4 TD', 'sportlixa' ); ?></div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- ==========================================================================
	     DYNAMIC: INJURY REPORT WIRE & FANTASY SLEEPERS
	     ========================================================================== -->
	<section class="devnahian-sportlixa-nfl-expanded-section" id="nfl-wire">
		<div class="devnahian-sportlixa-section-title">
			<div class="devnahian-sportlixa-title-left">
				<span style="display:inline-block; width:8px; height:8px; background:var(--devnahian-sportlixa-red-live); border-radius:50%; margin-right:6px;"></span>
				<?php esc_html_e( 'NFL INJURY WIRE & FANTASY SLEEPERS', 'sportlixa' ); ?>
			</div>
			<?php
			$fantasy_cat = get_category_by_slug( 'fantasy-injuries' );
			$fantasy_url = ( ! empty( $fantasy_cat ) && ! is_wp_error( $fantasy_cat ) ) ? get_category_link( $fantasy_cat->term_id ) : home_url( '/#nfl-wire' );
			?>
			<a href="<?php echo esc_url( $fantasy_url ); ?>" class="devnahian-sportlixa-title-link"><?php esc_html_e( 'Fantasy & Injury →', 'sportlixa' ); ?></a>
		</div>

		<div class="devnahian-sportlixa-nfl-wire-grid">
			<?php
			$saved_injuries = function_exists( 'sportlixa_get_injury_wire_items' ) ? sportlixa_get_injury_wire_items() : [
				[ 'name' => 'Christian McCaffrey', 'team_pos' => 'SF • RB', 'status' => 'Questionable', 'desc' => 'Achilles tendinitis recovery progressing smoothly through walkthrough drills.', 'fantasy' => 'Jordan Mason priority hold.' ],
				[ 'name' => 'Cooper Kupp', 'team_pos' => 'LAR • WR', 'status' => 'Doubtful', 'desc' => 'High ankle sprain protocol. Limited participation expected through gameday.', 'fantasy' => 'Tutu Atwell targets trend upward.' ],
				[ 'name' => 'Isiah Pacheco', 'team_pos' => 'KC • RB', 'status' => 'Out', 'desc' => 'Fractured fibula recovery ongoing. Targeted return remains mid-season.', 'fantasy' => 'Kareem Hunt maintains lead touch share.' ],
			];

			foreach ( $saved_injuries as $player ) :
				$name     = esc_html( $player['name'] ?? '' );
				$team_pos = esc_html( $player['team_pos'] ?? '' );
				$status   = $player['status'] ?? 'Questionable';
				$desc     = esc_html( $player['desc'] ?? '' );
				$fantasy  = esc_html( $player['fantasy'] ?? '' );

				$initials   = '';
				$name_parts = explode( ' ', trim( $name ) );
				foreach ( array_slice( $name_parts, 0, 2 ) as $np ) {
					$initials .= strtoupper( substr( $np, 0, 1 ) );
				}

				$badge_class = 'devnahian-sportlixa-status-questionable';
				if ( stripos( $status, 'Probable' ) !== false || stripos( $status, 'Healthy' ) !== false ) {
					$badge_class = 'devnahian-sportlixa-status-healthy';
				} elseif ( stripos( $status, 'Out' ) !== false ) {
					$badge_class = 'devnahian-sportlixa-status-out';
				}
				?>
				<article class="devnahian-sportlixa-nfl-wire-card">
					<div class="devnahian-sportlixa-wire-badge-row">
						<span class="devnahian-sportlixa-wire-team-tag"><?php echo $team_pos; ?></span>
						<span class="devnahian-sportlixa-status-badge <?php echo esc_attr( $badge_class ); ?>"><?php echo esc_html( $status ); ?></span>
					</div>
					<div class="devnahian-sportlixa-wire-player"><?php echo $name; ?></div>
					<p class="devnahian-sportlixa-wire-note"><?php echo $desc; ?></p>
					<?php if ( ! empty( $fantasy ) ) : ?>
						<div class="devnahian-sportlixa-wire-fantasy-chip">
							<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true" focusable="false"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
							<span><?php echo $fantasy; ?></span>
						</div>
					<?php endif; ?>
				</article>
			<?php endforeach; ?>
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
			<?php
			$league_configs = [
				'nfl'    => [ 'name' => 'NFL', 'sub' => __( 'Latest News | Scores | Standings', 'sportlixa' ) ],
				'nba'    => [ 'name' => 'NBA', 'sub' => __( 'Latest News | Scores | Standings', 'sportlixa' ) ],
				'mlb'    => [ 'name' => 'MLB', 'sub' => __( 'Latest News | Scores | Standings', 'sportlixa' ) ],
				'nhl'    => [ 'name' => 'NHL', 'sub' => __( 'Latest News | Scores | Standings', 'sportlixa' ) ],
				'soccer' => [ 'name' => 'SOCCER', 'sub' => __( 'Latest News | Scores | Standings', 'sportlixa' ) ],
			];

			foreach ( $league_configs as $slug => $data ) :
				$cat_obj  = get_category_by_slug( $slug );
				$cat_link = ( ! empty( $cat_obj ) && ! is_wp_error( $cat_obj ) ) ? get_category_link( $cat_obj->term_id ) : home_url( '/' . $slug . '/' );
				?>
				<div class="devnahian-sportlixa-league-card">
					<div class="devnahian-sportlixa-league-icon-wrapper" aria-hidden="true">
						<?php if ( 'nfl' === $slug ) : ?>
							<svg viewBox="0 0 100 120" fill="none">
								<path d="M50 5 L88 24 L80 82 L50 115 L20 82 L12 24 Z" stroke="#003369" stroke-width="8" fill="#013369"/>
								<text x="50" y="55" fill="#ffffff" font-size="20" font-weight="900" font-style="italic" text-anchor="middle" font-family="Montserrat">NFL</text>
								<circle cx="50" cy="80" r="8" fill="var(--devnahian-sportlixa-brand-volt)"/>
							</svg>
						<?php elseif ( 'nba' === $slug ) : ?>
							<svg viewBox="0 0 70 120" fill="none">
								<rect x="5" y="10" width="60" height="100" rx="30" fill="#17408B"/>
								<path d="M5 10 H35 V110 H5 Z" fill="#C9082A"/>
								<path d="M35 10 H65 V110 H35 Z" fill="#17408B"/>
								<circle cx="45" cy="35" r="7" fill="#ffffff"/>
								<path d="M35 50 Q 25 75 45 95" stroke="#ffffff" stroke-width="6" fill="none"/>
							</svg>
						<?php elseif ( 'mlb' === $slug ) : ?>
							<svg viewBox="0 0 120 80" fill="none">
								<rect x="5" y="10" width="110" height="60" rx="30" fill="#002D72"/>
								<path d="M5 10 H60 V70 H5 Z" fill="#002D72"/>
								<path d="M60 10 H115 V70 H60 Z" fill="#BA0C2F"/>
								<circle cx="85" cy="40" r="12" fill="#ffffff"/>
								<path d="M35 25 L55 55" stroke="#ffffff" stroke-width="5"/>
							</svg>
						<?php elseif ( 'nhl' === $slug ) : ?>
							<svg viewBox="0 0 100 120" fill="none">
								<path d="M50 10 L85 28 L78 88 L50 110 L22 88 L15 28 Z" stroke="currentColor" stroke-width="5" fill="#000000"/>
								<text x="50" y="65" fill="#ffffff" font-size="19" font-weight="900" font-style="italic" text-anchor="middle" font-family="Montserrat">NHL</text>
							</svg>
						<?php else : ?>
							<svg viewBox="0 0 100 100" fill="none">
								<circle cx="50" cy="50" r="42" stroke="currentColor" stroke-width="4" fill="#38003c"/>
								<path d="M35 45 C35 30 65 30 65 45 C65 65 50 75 50 75 C50 75 35 65 35 45 Z" fill="#ffffff"/>
								<circle cx="50" cy="38" r="4" fill="#38003c"/>
							</svg>
						<?php endif; ?>
					</div>
					<h3 class="devnahian-sportlixa-league-name"><?php echo esc_html( $data['name'] ); ?></h3>
					<p class="devnahian-sportlixa-league-subtext"><?php echo esc_html( $data['sub'] ); ?></p>
					<a href="<?php echo esc_url( $cat_link ); ?>" class="devnahian-sportlixa-league-view-link"><?php esc_html_e( 'View →', 'sportlixa' ); ?></a>
				</div>
			<?php endforeach; ?>
		</div>
	</section>

	<!-- ==========================================================================
	     BOTTOM TRIPLET (MATCHUP BREAKDOWN | SOCCER ANALYSIS | VIDEO POPUP)
	     ========================================================================== -->
	<section class="devnahian-sportlixa-bottom-triplet-section">
		<div class="devnahian-sportlixa-triplet-grid">

			<!-- 1. Matchup Breakdown -->
			<div class="devnahian-sportlixa-triplet-col">
				<div class="devnahian-sportlixa-section-title">
					<div class="devnahian-sportlixa-title-left"><?php esc_html_e( 'MATCHUP BREAKDOWN', 'sportlixa' ); ?></div>
					<a href="#scores" class="devnahian-sportlixa-title-link"><?php esc_html_e( 'All Matchups →', 'sportlixa' ); ?></a>
				</div>
				<div class="devnahian-sportlixa-preview-card">
					<div class="devnahian-sportlixa-matchup-row">
						<div class="devnahian-sportlixa-matchup-team">
							<div class="devnahian-sportlixa-team-shield" aria-hidden="true">
								<svg width="44" height="32" viewBox="0 0 60 40">
									<polygon points="5,20 50,5 55,20 50,35" fill="#E31837" stroke="#FFB81C" stroke-width="2"/>
									<text x="30" y="24" fill="#ffffff" font-size="12" font-weight="900">KC</text>
								</svg>
							</div>
							<span class="devnahian-sportlixa-team-abbr">KC</span>
						</div>
						<div class="devnahian-sportlixa-matchup-vs" aria-hidden="true">VS</div>
						<div class="devnahian-sportlixa-matchup-team">
							<div class="devnahian-sportlixa-team-shield" aria-hidden="true">
								<svg width="44" height="32" viewBox="0 0 60 40">
									<rect x="8" y="8" width="44" height="24" rx="4" fill="#00338D"/>
									<path d="M10 20 H50" stroke="#C60C30" stroke-width="3"/>
									<text x="30" y="24" fill="#ffffff" font-size="10" font-weight="900" text-anchor="middle">BUF</text>
								</svg>
							</div>
							<span class="devnahian-sportlixa-team-abbr">BUF</span>
						</div>
					</div>
					<h4 class="devnahian-sportlixa-matchup-title">Chiefs vs Bills</h4>
					<div class="devnahian-sportlixa-matchup-time"><?php esc_html_e( 'Upcoming Matchup • 1:00 PM (ET)', 'sportlixa' ); ?></div>
					<a href="#scores" class="devnahian-sportlixa-matchup-action-link"><?php esc_html_e( 'VIEW BREAKDOWN & INTEL →', 'sportlixa' ); ?></a>
				</div>
			</div>

			<!-- 2. Sports Analysis -->
			<div class="devnahian-sportlixa-triplet-col">
				<div class="devnahian-sportlixa-section-title">
					<div class="devnahian-sportlixa-title-left"><?php esc_html_e( 'SPORTS ANALYSIS', 'sportlixa' ); ?></div>
				</div>
				<?php
				$soccer_analysis_post = new WP_Query( [
					'category_name'       => 'soccer',
					'posts_per_page'      => 1,
					'post_status'         => 'publish',
					'ignore_sticky_posts' => 1,
					'no_found_rows'       => true,
				] );

				if ( ! $soccer_analysis_post->have_posts() ) {
					$soccer_analysis_post = new WP_Query( [
						'posts_per_page'      => 1,
						'offset'              => 8,
						'post_status'         => 'publish',
						'ignore_sticky_posts' => 1,
						'no_found_rows'       => true,
					] );
				}

				if ( $soccer_analysis_post->have_posts() ) :
					while ( $soccer_analysis_post->have_posts() ) :
						$soccer_analysis_post->the_post();
						$thumb_url = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'medium_large' ) : $default_thumb;
						$words     = str_word_count( strip_tags( strip_shortcodes( get_the_content() ) ) );
						$read_time = max( 1, (int) ceil( $words / 200 ) );
						?>
						<div class="devnahian-sportlixa-analysis-card">
							<div class="devnahian-sportlixa-analysis-thumb devnahian-sportlixa-img-box">
								<img 
									src="<?php echo esc_url( $thumb_url ); ?>" 
									alt="<?php echo the_title_attribute( [ 'echo' => false ] ); ?>" 
									loading="lazy"
								>
							</div>
							<div class="devnahian-sportlixa-analysis-content">
								<div>
									<h4 class="devnahian-sportlixa-analysis-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h4>
									<p class="devnahian-sportlixa-analysis-excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 15 ) ); ?></p>
									<div class="devnahian-sportlixa-meta-time">
										<span><?php echo esc_html( get_the_date() ); ?></span>
										<span aria-hidden="true">•</span>
										<span><?php printf( esc_html__( '%d min read', 'sportlixa' ), (int) $read_time ); ?></span>
									</div>
								</div>
								<a href="<?php the_permalink(); ?>" class="devnahian-sportlixa-analysis-action-link"><?php esc_html_e( 'READ TACTICAL REPORT →', 'sportlixa' ); ?></a>
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
					<?php
					$video_cat = get_category_by_slug( 'videos' );
					$video_url = ( ! empty( $video_cat ) && ! is_wp_error( $video_cat ) ) ? get_category_link( $video_cat->term_id ) : home_url( '/videos/' );
					?>
					<a href="<?php echo esc_url( $video_url ); ?>" class="devnahian-sportlixa-title-link"><?php esc_html_e( 'All Videos →', 'sportlixa' ); ?></a>
				</div>

				<?php
				$saved_videos = function_exists( 'sportlixa_get_video_items' ) ? sportlixa_get_video_items() : [];
				$first_video  = ! empty( $saved_videos ) ? reset( $saved_videos ) : null;

				$vid_title    = $first_video['title'] ?? __( 'Top 10 Plays of the Week', 'sportlixa' );
				$vid_duration = $first_video['duration'] ?? '04:32';
				$vid_thumb    = ! empty( $first_video['thumb'] ) ? $first_video['thumb'] : $default_thumb;
				$vid_embed    = $first_video['embed_url'] ?? '';
				$vid_meta     = $first_video['meta'] ?? __( 'Recent Breakdown', 'sportlixa' );
				?>
				<div 
					class="devnahian-sportlixa-video-card" 
					style="cursor:pointer;" 
					role="button"
					tabindex="0"
					aria-label="<?php echo esc_attr( $vid_title ); ?>"
					onclick="openSportlixaVideoModal('<?php echo esc_url( $vid_embed ); ?>', '<?php echo esc_js( $vid_title ); ?>')"
					onkeydown="if(event.key === 'Enter') openSportlixaVideoModal('<?php echo esc_url( $vid_embed ); ?>', '<?php echo esc_js( $vid_title ); ?>')"
				>
					<img 
						src="<?php echo esc_url( $vid_thumb ); ?>" 
						alt="<?php echo esc_attr( $vid_title ); ?>" 
						class="devnahian-sportlixa-video-card-bg" 
						loading="lazy"
					>
					<div class="devnahian-sportlixa-video-overlay"></div>
					<?php if ( ! empty( $vid_duration ) ) : ?>
						<div class="devnahian-sportlixa-video-duration"><?php echo esc_html( $vid_duration ); ?></div>
					<?php endif; ?>
					<div class="devnahian-sportlixa-play-btn-circle" aria-hidden="true">
						<svg viewBox="0 0 24 24"><polygon points="5 3 19 12 5 21 5 3"/></svg>
					</div>
					<div class="devnahian-sportlixa-video-details">
						<h4 class="devnahian-sportlixa-video-title"><?php echo esc_html( $vid_title ); ?></h4>
						<div class="devnahian-sportlixa-video-footer">
							<span class="devnahian-sportlixa-meta-time" style="margin-top:0; color:#c4cdd8;"><?php echo esc_html( $vid_meta ); ?></span>
							<span class="devnahian-sportlixa-video-footer-link"><?php esc_html_e( 'WATCH NOW →', 'sportlixa' ); ?></span>
						</div>
					</div>
				</div>
			</div>

		</div>
	</section>

</main>

<!-- ==========================================================================
     VIDEO POPUP MODAL DIALOG
     ========================================================================== -->
<div id="sportlixaVideoModal" class="sportlixa-video-modal" aria-hidden="true" role="dialog" aria-modal="true">
	<div class="sportlixa-video-modal-backdrop" onclick="closeSportlixaVideoModal()"></div>
	<div class="sportlixa-video-modal-dialog">
		<div class="sportlixa-video-modal-header">
			<h4 id="sportlixaVideoModalTitle" class="sportlixa-video-modal-heading"><?php esc_html_e( 'Video Player', 'sportlixa' ); ?></h4>
			<button type="button" class="sportlixa-video-modal-close" onclick="closeSportlixaVideoModal()" aria-label="<?php esc_attr_e( 'Close video player', 'sportlixa' ); ?>">&times;</button>
		</div>
		<div class="sportlixa-video-modal-iframe-wrap">
			<iframe id="sportlixaVideoPlayerFrame" src="" title="<?php esc_attr_e( 'Video Player', 'sportlixa' ); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>
	</div>
</div>

<!-- ==========================================================================
     EMBEDDED STYLES FOR POPUP MODAL & WIRE CARDS
     ========================================================================== -->
<style>
	.sportlixa-video-modal {
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		z-index: 999999;
		display: none;
		align-items: center;
		justify-content: center;
		padding: 20px;
	}
	.sportlixa-video-modal.is-active {
		display: flex;
	}
	.sportlixa-video-modal-backdrop {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background: rgba(5, 7, 10, 0.85);
		backdrop-filter: blur(8px);
	}
	.sportlixa-video-modal-dialog {
		position: relative;
		width: 100%;
		max-width: 860px;
		background: #0f131a;
		border: 1px solid rgba(255, 255, 255, 0.12);
		border-radius: 12px;
		overflow: hidden;
		box-shadow: 0 25px 60px rgba(0, 0, 0, 0.7);
		z-index: 2;
		animation: sportlixaModalFadeIn 0.25s cubic-bezier(0.16, 1, 0.3, 1);
	}
	@keyframes sportlixaModalFadeIn {
		from { opacity: 0; transform: scale(0.95); }
		to { opacity: 1; transform: scale(1); }
	}
	.sportlixa-video-modal-header {
		display: flex;
		justify-content: space-between;
		align-items: center;
		padding: 12px 18px;
		background: #141923;
		border-bottom: 1px solid rgba(255, 255, 255, 0.08);
	}
	.sportlixa-video-modal-heading {
		margin: 0;
		font-size: 15px;
		font-weight: 700;
		color: #fff;
	}
	.sportlixa-video-modal-close {
		background: transparent;
		border: none;
		color: #8c9ba5;
		font-size: 26px;
		line-height: 1;
		cursor: pointer;
		padding: 0 4px;
		transition: color 0.15s;
	}
	.sportlixa-video-modal-close:hover {
		color: #fff;
	}
	.sportlixa-video-modal-iframe-wrap {
		position: relative;
		width: 100%;
		padding-top: 56.25%;
		background: #000;
	}
	.sportlixa-video-modal-iframe-wrap iframe {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		border: 0;
	}
</style>

<!-- ==========================================================================
     EMBEDDED INTERACTIVE CONTROLLERS
     ========================================================================== -->
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
		pickButtons.forEach(function(btn) { btn.classList.remove('active', 'picked'); });
		buttonEl.classList.add('active', 'picked');
		if (typeof window.showToast === 'function') {
			window.showToast('Pick registered for ' + teamName + '!');
		}
	}

	const nflStandingsData = <?php echo wp_json_encode( $nfl_standings ); ?>;
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
			const isWin = String(row.streak).indexOf('W') !== -1;
			html += '<tr>' +
				'<td class="devnahian-sportlixa-team-cell"><span class="devnahian-sportlixa-rank-dot">' + (index + 1) + '</span> ' + row.team + '</td>' +
				'<td>' + row.w + '</td>' +
				'<td>' + row.l + '</td>' +
				'<td>' + row.pct + '</td>' +
				'<td>' + (row.div || '-') + '</td>' +
				'<td class="' + (isWin ? 'devnahian-sportlixa-streak-green' : '') + '">' + row.streak + '</td>' +
			'</tr>';
		});
		tbody.innerHTML = html;
	}

	function openSportlixaVideoModal(videoSrc, title) {
		const modal = document.getElementById('sportlixaVideoModal');
		const frame = document.getElementById('sportlixaVideoPlayerFrame');
		const heading = document.getElementById('sportlixaVideoModalTitle');

		if (title && heading) heading.textContent = title;
		if (frame) frame.src = videoSrc;
		if (modal) {
			modal.classList.add('is-active');
			modal.setAttribute('aria-hidden', 'false');
		}
		document.body.style.overflow = 'hidden';
	}

	function closeSportlixaVideoModal() {
		const modal = document.getElementById('sportlixaVideoModal');
		const frame = document.getElementById('sportlixaVideoPlayerFrame');

		if (frame) frame.src = '';
		if (modal) {
			modal.classList.remove('is-active');
			modal.setAttribute('aria-hidden', 'true');
		}
		document.body.style.overflow = '';
	}

	document.addEventListener('keydown', function(event) {
		if (event.key === 'Escape') {
			closeSportlixaVideoModal();
		}
	});
</script>

<?php get_footer(); ?>