<?php
/**
 * Template Name: Live Score Center Hub
 * Description: Displays comprehensive real-time scores, period telemetry, and game status.
 *
 * @package Sportlixa
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

// Fetch live scores data from helper or fall back to realistic telemetry model
$all_games = function_exists( 'sportlixa_get_espn_live_scores' ) ? sportlixa_get_espn_live_scores() : [];

if ( empty( $all_games ) ) {
	$all_games = [
		[
			'sport'      => 'nfl',
			'is_live'    => true,
			'status'     => 'WEEK 5',
			'detail'     => 'Q4 02:34',
			'possession' => 'KC Poss',
			'home_code'  => 'KC',
			'home_score' => 24,
			'home_logo'  => '',
			'away_code'  => 'BUF',
			'away_score' => 20,
			'away_logo'  => '',
		],
		[
			'sport'      => 'nfl',
			'is_live'    => true,
			'status'     => 'WEEK 5',
			'detail'     => 'Q3 08:15',
			'possession' => 'BAL Red Zone',
			'home_code'  => 'BAL',
			'home_score' => 31,
			'home_logo'  => '',
			'away_code'  => 'CIN',
			'away_score' => 28,
			'away_logo'  => '',
		],
		[
			'sport'      => 'nba',
			'is_live'    => true,
			'status'     => '3RD QTR',
			'detail'     => '04:12',
			'possession' => 'In-Play',
			'home_code'  => 'BOS',
			'home_score' => 84,
			'home_logo'  => '',
			'away_code'  => 'MIA',
			'away_score' => 76,
			'away_logo'  => '',
		],
		[
			'sport'      => 'nba',
			'is_live'    => false,
			'status'     => 'FINAL',
			'detail'     => 'Lakers: 32 PTS',
			'possession' => '',
			'home_code'  => 'LAL',
			'home_score' => 118,
			'home_logo'  => '',
			'away_code'  => 'GSW',
			'away_score' => 112,
			'away_logo'  => '',
		],
		[
			'sport'      => 'mlb',
			'is_live'    => true,
			'status'     => 'BOT 8TH',
			'detail'     => 'Judge: 2 HR',
			'possession' => '2 Out',
			'home_code'  => 'NYY',
			'home_score' => 6,
			'home_logo'  => '',
			'away_code'  => 'LAD',
			'away_score' => 4,
			'away_logo'  => '',
		],
		[
			'sport'      => 'nhl',
			'is_live'    => false,
			'status'     => 'FINAL (OT)',
			'detail'     => 'McDavid: GWG',
			'possession' => '',
			'home_code'  => 'EDM',
			'home_score' => 4,
			'home_logo'  => '',
			'away_code'  => 'TOR',
			'away_score' => 3,
			'away_logo'  => '',
		],
	];
}

// Aggregate telemetry metrics
$sport_counts = [
	'all'  => count( $all_games ),
	'live' => 0,
	'nfl'  => 0,
	'nba'  => 0,
	'mlb'  => 0,
	'nhl'  => 0,
];

foreach ( $all_games as $g ) {
	$sp = strtolower( $g['sport'] ?? '' );
	if ( isset( $sport_counts[ $sp ] ) ) {
		$sport_counts[ $sp ]++;
	}
	if ( ! empty( $g['is_live'] ) ) {
		$sport_counts['live']++;
	}
}

// Local helper to guarantee logo/crest render
if ( ! function_exists( 'sportlixa_render_hub_crest' ) ) {
	function sportlixa_render_hub_crest( $code, $logo = '' ) {
		if ( ! empty( $logo ) ) {
			echo '<img src="' . esc_url( $logo ) . '" alt="' . esc_attr( $code ) . '" class="team-logo-img" loading="lazy">';
			return;
		}
		if ( function_exists( 'sportlixa_render_team_crest_svg' ) ) {
			sportlixa_render_team_crest_svg( $code, $logo );
			return;
		}
		$c = strtoupper( substr( trim( $code ), 0, 3 ) );
		?>
		<svg class="team-logo-svg" viewBox="0 0 40 40" aria-hidden="true" focusable="false">
			<circle cx="20" cy="20" r="16" fill="#151e2e" stroke="rgba(255,255,255,0.15)" stroke-width="1.5"/>
			<text x="20" y="24" fill="#ffffff" font-size="8.5" font-weight="900" text-anchor="middle"><?php echo esc_html( $c ); ?></text>
		</svg>
		<?php
	}
}
?>

<main class="devnahian-sportlixa-container sportlixa-scores-page" id="primary" role="main">

	<!-- ==========================================================================
	     BREADCRUMB NAVIGATION
	     ========================================================================== -->
	<nav class="sportlixa-static-breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'sportlixa' ); ?>">
		<ol class="sportlixa-breadcrumb-list">
			<li class="sportlixa-breadcrumb-item">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'sportlixa' ); ?></a>
			</li>
			<li class="sportlixa-breadcrumb-separator" aria-hidden="true">&rsaquo;</li>
			<li class="sportlixa-breadcrumb-item active" aria-current="page">
				<?php esc_html_e( 'Live Scores', 'sportlixa' ); ?>
			</li>
		</ol>
	</nav>

	<!-- ==========================================================================
	     PAGE HEADER & TELEMETRY STRIP
	     ========================================================================== -->
	<header class="sportlixa-scores-page-header">
		<div class="sportlixa-scores-badge">
			<span class="live-dot-pulse" aria-hidden="true"></span>
			<span><?php esc_html_e( 'ESPN LIVE TELEMETRY', 'sportlixa' ); ?></span>
		</div>
		<div class="sportlixa-scores-header-row">
			<div>
				<h1 class="sportlixa-scores-page-title"><?php esc_html_e( 'LIVE SCORE CENTER', 'sportlixa' ); ?></h1>
				<p class="sportlixa-scores-page-subtext">
					<?php esc_html_e( 'Real-time score updates, clock timing, team possession, and final results across all major sports leagues.', 'sportlixa' ); ?>
				</p>
			</div>

			<!-- Quick Refresh Action -->
			<div class="sportlixa-scores-header-actions">
				<button type="button" class="sportlixa-btn-refresh" id="sportlixaScoresRefreshBtn" aria-label="<?php esc_attr_e( 'Refresh Scores', 'sportlixa' ); ?>">
					<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true" focusable="false"><polyline points="23 4 23 10 17 10"/><polyline points="1 20 1 14 7 14"/><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/></svg>
					<span><?php esc_html_e( 'Refresh Scores', 'sportlixa' ); ?></span>
				</button>
			</div>
		</div>

		<!-- Quick Telemetry Counter Strip -->
		<div class="sportlixa-scores-metrics-bar" aria-label="<?php esc_attr_e( 'League Metrics', 'sportlixa' ); ?>">
			<div class="score-metric-box">
				<span class="val"><?php echo (int) $sport_counts['all']; ?></span>
				<span class="lbl"><?php esc_html_e( 'Total Games', 'sportlixa' ); ?></span>
			</div>
			<div class="score-metric-box live-pulse">
				<span class="val" style="color:var(--devnahian-sportlixa-brand-volt, #c8ff00);"><?php echo (int) $sport_counts['live']; ?></span>
				<span class="lbl"><?php esc_html_e( 'Live In-Play', 'sportlixa' ); ?></span>
			</div>
			<div class="score-metric-box">
				<span class="val"><?php echo (int) $sport_counts['nfl']; ?></span>
				<span class="lbl">NFL</span>
			</div>
			<div class="score-metric-box">
				<span class="val"><?php echo (int) $sport_counts['nba']; ?></span>
				<span class="lbl">NBA</span>
			</div>
			<div class="score-metric-box">
				<span class="val"><?php echo (int) $sport_counts['mlb']; ?></span>
				<span class="lbl">MLB</span>
			</div>
			<div class="score-metric-box">
				<span class="val"><?php echo (int) $sport_counts['nhl']; ?></span>
				<span class="lbl">NHL</span>
			</div>
		</div>
	</header>

	<!-- ==========================================================================
	     INTERACTIVE FILTER BAR
	     ========================================================================== -->
	<section class="sportlixa-scores-controls-row" aria-label="<?php esc_attr_e( 'Filter Scoreboards', 'sportlixa' ); ?>">
		<div class="sportlixa-scores-pills-wrap" role="group" aria-label="<?php esc_attr_e( 'Filter by Category', 'sportlixa' ); ?>">
			<button type="button" class="sportlixa-score-pill active" data-score-category="all">
				<?php esc_html_e( 'ALL LEAGUES', 'sportlixa' ); ?> (<?php echo (int) $sport_counts['all']; ?>)
			</button>
			<button type="button" class="sportlixa-score-pill" data-score-category="live">
				&bull; <?php esc_html_e( 'LIVE ONLY', 'sportlixa' ); ?> (<?php echo (int) $sport_counts['live']; ?>)
			</button>
			<button type="button" class="sportlixa-score-pill" data-score-category="nfl">
				NFL (<?php echo (int) $sport_counts['nfl']; ?>)
			</button>
			<button type="button" class="sportlixa-score-pill" data-score-category="nba">
				NBA (<?php echo (int) $sport_counts['nba']; ?>)
			</button>
			<button type="button" class="sportlixa-score-pill" data-score-category="mlb">
				MLB (<?php echo (int) $sport_counts['mlb']; ?>)
			</button>
			<button type="button" class="sportlixa-score-pill" data-score-category="nhl">
				NHL (<?php echo (int) $sport_counts['nhl']; ?>)
			</button>
		</div>

		<!-- Search / Filter input -->
		<div class="sportlixa-scores-search-box">
			<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true" focusable="false"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
			<input type="text" id="scoreSearchInput" placeholder="<?php esc_attr_e( 'Search team code (KC, BUF, LAL)...', 'sportlixa' ); ?>" aria-label="<?php esc_attr_e( 'Search by Team Code', 'sportlixa' ); ?>" autocomplete="off" />
		</div>
	</section>

	<!-- ==========================================================================
	     COMPREHENSIVE GAME CARDS GRID
	     ========================================================================== -->
	<section class="sportlixa-scores-main-grid" id="sportlixaScoresGrid" aria-label="<?php esc_attr_e( 'Live Games Feed', 'sportlixa' ); ?>">
		<?php if ( ! empty( $all_games ) ) : ?>
			<?php foreach ( $all_games as $game ) : 
				$sport      = strtolower( $game['sport'] ?? '' );
				$is_live    = ! empty( $game['is_live'] );
				$home_score = is_numeric( $game['home_score'] ?? '' ) ? (int) $game['home_score'] : 0;
				$away_score = is_numeric( $game['away_score'] ?? '' ) ? (int) $game['away_score'] : 0;
				$home_lead  = $home_score > $away_score;
				$away_lead  = $away_score > $home_score;
				$home_code  = trim( $game['home_code'] ?? 'HOM' );
				$away_code  = trim( $game['away_code'] ?? 'AWY' );
				$search_key = strtolower( $sport . ' ' . $home_code . ' ' . $away_code );
			?>
				<article 
					class="sportlixa-full-game-card <?php echo $is_live ? 'is-live-game' : ''; ?>"
					data-sport="<?php echo esc_attr( $sport ); ?>"
					data-live="<?php echo $is_live ? 'yes' : 'no'; ?>"
					data-search="<?php echo esc_attr( $search_key ); ?>"
				>
					<!-- Card Header -->
					<div class="game-card-top-bar">
						<span class="game-league-tag"><?php echo esc_html( strtoupper( $game['sport'] ?? '' ) ); ?></span>
						<div class="game-status-box">
							<?php if ( $is_live ) : ?>
								<span class="live-status-badge">&bull; <?php echo esc_html( $game['status'] ?? 'LIVE' ); ?></span>
							<?php else : ?>
								<span class="final-status-badge"><?php echo esc_html( $game['status'] ?? 'FINAL' ); ?></span>
							<?php endif; ?>
						</div>
					</div>

					<!-- Match Teams and Scores Rows -->
					<div class="game-matchup-board">
						
						<!-- Home Team Row -->
						<div class="game-team-row <?php echo $home_lead ? 'lead' : ''; ?>">
							<div class="team-meta">
								<div class="team-logo-wrap">
									<?php sportlixa_render_hub_crest( $home_code, $game['home_logo'] ?? '' ); ?>
								</div>
								<span class="team-name"><?php echo esc_html( $home_code ); ?></span>
							</div>
							<span class="team-score-num"><?php echo esc_html( $game['home_score'] ?? '0' ); ?></span>
						</div>

						<!-- Away Team Row -->
						<div class="game-team-row <?php echo $away_lead ? 'lead' : ''; ?>">
							<div class="team-meta">
								<div class="team-logo-wrap">
									<?php sportlixa_render_hub_crest( $away_code, $game['away_logo'] ?? '' ); ?>
								</div>
								<span class="team-name"><?php echo esc_html( $away_code ); ?></span>
							</div>
							<span class="team-score-num"><?php echo esc_html( $game['away_score'] ?? '0' ); ?></span>
						</div>

					</div>

					<!-- Card Footer Details / Situation -->
					<div class="game-card-footer">
						<span class="game-clock-detail">
							<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
							<?php echo esc_html( $game['detail'] ?? '' ); ?>
						</span>
						<?php if ( ! empty( $game['possession'] ) ) : ?>
							<span class="game-possession-chip">&#9670; <?php echo esc_html( $game['possession'] ); ?></span>
						<?php endif; ?>
					</div>
				</article>
			<?php endforeach; ?>
		<?php else : ?>
			<p style="color:var(--devnahian-sportlixa-text-muted, #95a5b8); padding: 40px 0; text-align:center; grid-column: 1/-1;">
				<?php esc_html_e( 'No score events available right now. Please check back shortly.', 'sportlixa' ); ?>
			</p>
		<?php endif; ?>
	</section>

</main>

<!-- ==========================================================================
     EMBEDDED SCOPED STYLES
     ========================================================================== -->
<style>
	.sportlixa-static-breadcrumb {
		margin: 0 0 20px 0;
		padding: 0;
		background: transparent;
	}
	.sportlixa-breadcrumb-list {
		list-style: none;
		margin: 0;
		padding: 0;
		display: flex;
		align-items: center;
		gap: 8px;
		font-size: 13px;
		line-height: 1;
	}
	.sportlixa-breadcrumb-item a {
		color: var(--devnahian-sportlixa-text-dim, #64758b);
		text-decoration: none;
		transition: color var(--devnahian-sportlixa-transition-fast, 0.2s ease);
	}
	.sportlixa-breadcrumb-item a:hover {
		color: var(--devnahian-sportlixa-brand-volt, #c8ff00);
	}
	.sportlixa-breadcrumb-separator {
		color: var(--devnahian-sportlixa-border-card, #1e2a3f);
		font-size: 14px;
		user-select: none;
	}
	.sportlixa-breadcrumb-item.active {
		color: var(--devnahian-sportlixa-text-light, #e5ebf5);
		font-weight: 700;
	}

	.sportlixa-scores-page {
		padding-top: 24px;
		padding-bottom: 70px;
	}
	.sportlixa-scores-badge {
		display: inline-flex;
		align-items: center;
		gap: 8px;
		font-size: 11px;
		font-weight: 800;
		letter-spacing: 1px;
		color: var(--devnahian-sportlixa-brand-volt, #c8ff00);
		text-transform: uppercase;
		margin-bottom: 8px;
	}
	.live-dot-pulse {
		width: 7px;
		height: 7px;
		background: var(--devnahian-sportlixa-red-live, #ff2e43);
		border-radius: 50%;
		box-shadow: 0 0 8px var(--devnahian-sportlixa-red-live-glow, rgba(255, 46, 67, 0.45));
	}
	.sportlixa-scores-header-row {
		display: flex;
		justify-content: space-between;
		align-items: flex-start;
		flex-wrap: wrap;
		gap: 16px;
		margin-bottom: 24px;
	}
	.sportlixa-scores-page-title {
		font-size: clamp(24px, 4vw, 34px);
		font-weight: 900;
		font-style: italic;
		color: var(--devnahian-sportlixa-text-white, #ffffff);
		margin: 0 0 6px 0;
		text-transform: uppercase;
		letter-spacing: -0.5px;
		line-height: 1.2;
	}
	.sportlixa-scores-page-subtext {
		color: var(--devnahian-sportlixa-text-muted, #95a5b8);
		font-size: 15px;
		margin: 0;
		max-width: 680px;
		line-height: 1.6;
	}
	.sportlixa-btn-refresh {
		display: inline-flex;
		align-items: center;
		gap: 8px;
		background: var(--devnahian-sportlixa-bg-input, #151e2e);
		border: 1px solid var(--devnahian-sportlixa-border-card, #1e2a3f);
		color: var(--devnahian-sportlixa-text-light, #e5ebf5);
		font-size: 12px;
		font-weight: 800;
		text-transform: uppercase;
		letter-spacing: 0.6px;
		padding: 10px 18px;
		border-radius: var(--devnahian-sportlixa-radius-sm, 6px);
		cursor: pointer;
		font-family: inherit;
		transition: all var(--devnahian-sportlixa-transition-fast, 0.2s ease);
	}
	.sportlixa-btn-refresh:hover {
		background: var(--devnahian-sportlixa-brand-volt, #c8ff00);
		color: #000000;
		border-color: var(--devnahian-sportlixa-brand-volt, #c8ff00);
		box-shadow: 0 0 12px var(--devnahian-sportlixa-brand-volt-glow, rgba(200, 255, 0, 0.28));
	}

	/* Telemetry Metrics Bar */
	.sportlixa-scores-metrics-bar {
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
		gap: 12px;
		margin-bottom: 30px;
	}
	.score-metric-box {
		background: var(--devnahian-sportlixa-bg-card, #121926);
		border: 1px solid var(--devnahian-sportlixa-border-card, #1e2a3f);
		border-radius: var(--devnahian-sportlixa-radius-md, 10px);
		padding: 14px 18px;
		display: flex;
		flex-direction: column;
		gap: 4px;
		box-shadow: var(--devnahian-sportlixa-shadow-card, 0 4px 20px rgba(0, 0, 0, 0.28));
	}
	.score-metric-box .val {
		font-size: 26px;
		font-weight: 900;
		font-style: italic;
		color: var(--devnahian-sportlixa-text-white, #ffffff);
		line-height: 1;
	}
	.score-metric-box .lbl {
		font-size: 11px;
		font-weight: 800;
		color: var(--devnahian-sportlixa-text-dim, #64758b);
		text-transform: uppercase;
		letter-spacing: 0.5px;
	}

	/* Controls */
	.sportlixa-scores-controls-row {
		display: flex;
		justify-content: space-between;
		align-items: center;
		flex-wrap: wrap;
		gap: 16px;
		margin-bottom: 26px;
		padding-bottom: 18px;
		border-bottom: 1px solid var(--devnahian-sportlixa-border-color, #1a2538);
	}
	.sportlixa-scores-pills-wrap {
		display: flex;
		gap: 8px;
		flex-wrap: wrap;
	}
	.sportlixa-score-pill {
		background: var(--devnahian-sportlixa-bg-input, #151e2e);
		border: 1px solid var(--devnahian-sportlixa-border-card, #1e2a3f);
		color: var(--devnahian-sportlixa-text-muted, #95a5b8);
		font-size: 11px;
		font-weight: 800;
		text-transform: uppercase;
		letter-spacing: 0.6px;
		padding: 8px 14px;
		border-radius: 20px;
		cursor: pointer;
		font-family: inherit;
		transition: all var(--devnahian-sportlixa-transition-fast, 0.2s ease);
	}
	.sportlixa-score-pill:hover,
	.sportlixa-score-pill.active {
		background: var(--devnahian-sportlixa-brand-volt, #c8ff00);
		color: #000000;
		border-color: var(--devnahian-sportlixa-brand-volt, #c8ff00);
		box-shadow: 0 0 12px var(--devnahian-sportlixa-brand-volt-glow, rgba(200, 255, 0, 0.28));
	}
	.sportlixa-scores-search-box {
		position: relative;
		min-width: 260px;
	}
	.sportlixa-scores-search-box svg {
		position: absolute;
		left: 12px;
		top: 50%;
		transform: translateY(-50%);
		stroke: var(--devnahian-sportlixa-brand-volt, #c8ff00);
		pointer-events: none;
	}
	.sportlixa-scores-search-box input {
		width: 100%;
		background: var(--devnahian-sportlixa-bg-input, #151e2e);
		border: 1px solid var(--devnahian-sportlixa-border-card, #1e2a3f);
		padding: 8px 14px 8px 34px;
		border-radius: 20px;
		color: var(--devnahian-sportlixa-text-white, #ffffff);
		font-size: 13px;
		font-family: inherit;
		outline: none;
		transition: all var(--devnahian-sportlixa-transition-fast, 0.2s ease);
	}
	.sportlixa-scores-search-box input:focus {
		border-color: var(--devnahian-sportlixa-brand-volt, #c8ff00);
		box-shadow: 0 0 10px var(--devnahian-sportlixa-brand-volt-glow, rgba(200, 255, 0, 0.28));
	}

	/* Score Cards Grid */
	.sportlixa-scores-main-grid {
		display: grid;
		grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
		gap: 18px;
	}

	/* Full Score Card */
	.sportlixa-full-game-card {
		background: var(--devnahian-sportlixa-bg-card, #121926);
		border: 1px solid var(--devnahian-sportlixa-border-card, #1e2a3f);
		border-radius: var(--devnahian-sportlixa-radius-md, 10px);
		padding: 16px;
		display: flex;
		flex-direction: column;
		gap: 14px;
		box-shadow: var(--devnahian-sportlixa-shadow-card, 0 4px 20px rgba(0, 0, 0, 0.28));
		transition: transform var(--devnahian-sportlixa-transition-smooth, 0.35s cubic-bezier(0.16, 1, 0.3, 1)), border-color var(--devnahian-sportlixa-transition-smooth, 0.35s cubic-bezier(0.16, 1, 0.3, 1));
	}
	.sportlixa-full-game-card:hover {
		transform: translateY(-3px);
		border-color: var(--devnahian-sportlixa-brand-volt, #c8ff00);
	}
	.sportlixa-full-game-card.is-live-game {
		border-color: rgba(200, 255, 0, 0.35);
	}

	.game-card-top-bar {
		display: flex;
		justify-content: space-between;
		align-items: center;
	}
	.game-league-tag {
		font-size: 11px;
		font-weight: 800;
		color: var(--devnahian-sportlixa-text-dim, #64758b);
		letter-spacing: 0.6px;
	}
	.live-status-badge {
		font-size: 10px;
		font-weight: 900;
		color: var(--devnahian-sportlixa-brand-volt-text, #c8ff00);
		background: rgba(200, 255, 0, 0.1);
		padding: 3px 8px;
		border-radius: 4px;
		letter-spacing: 0.5px;
		text-transform: uppercase;
	}
	.final-status-badge {
		font-size: 10px;
		font-weight: 800;
		color: var(--devnahian-sportlixa-text-dim, #64758b);
		text-transform: uppercase;
		letter-spacing: 0.5px;
	}

	/* Matchup Board */
	.game-matchup-board {
		display: flex;
		flex-direction: column;
		gap: 10px;
		background: var(--devnahian-sportlixa-bg-input, #151e2e);
		padding: 12px 14px;
		border-radius: var(--devnahian-sportlixa-radius-sm, 6px);
		border: 1px solid var(--devnahian-sportlixa-border-card, #1e2a3f);
	}
	.game-team-row {
		display: flex;
		justify-content: space-between;
		align-items: center;
	}
	.team-meta {
		display: flex;
		align-items: center;
		gap: 10px;
	}
	.team-logo-wrap {
		width: 28px;
		height: 28px;
		display: flex;
		align-items: center;
		justify-content: center;
		flex-shrink: 0;
	}
	.team-logo-wrap .team-logo-img,
	.team-logo-wrap .team-logo-svg,
	.team-logo-wrap svg {
		width: 24px;
		height: 24px;
	}
	.team-name {
		font-size: 15px;
		font-weight: 800;
		color: var(--devnahian-sportlixa-text-light, #e5ebf5);
		letter-spacing: 0.5px;
	}
	.team-score-num {
		font-size: 18px;
		font-weight: 900;
		font-style: italic;
		color: var(--devnahian-sportlixa-text-muted, #95a5b8);
	}
	.game-team-row.lead .team-name {
		color: var(--devnahian-sportlixa-text-white, #ffffff);
	}
	.game-team-row.lead .team-score-num {
		color: var(--devnahian-sportlixa-brand-volt-text, #c8ff00);
		text-shadow: 0 0 10px var(--devnahian-sportlixa-brand-volt-glow, rgba(200, 255, 0, 0.28));
	}

	/* Card Footer */
	.game-card-footer {
		display: flex;
		justify-content: space-between;
		align-items: center;
		font-size: 11px;
		font-weight: 700;
		color: var(--devnahian-sportlixa-text-dim, #64758b);
	}
	.game-clock-detail {
		display: inline-flex;
		align-items: center;
		gap: 5px;
	}
	.game-possession-chip {
		font-size: 10px;
		font-weight: 800;
		color: var(--devnahian-sportlixa-brand-volt-text, #c8ff00);
		background: rgba(200, 255, 0, 0.09);
		padding: 2px 6px;
		border-radius: 4px;
	}

	@media (max-width: 768px) {
		.sportlixa-scores-page-title { font-size: 24px; }
		.sportlixa-scores-search-box { width: 100%; min-width: 100%; }
		.sportlixa-scores-main-grid { grid-template-columns: 1fr; }
	}
</style>

<!-- ==========================================================================
     UNOBTRUSIVE REAL-TIME FILTERING CONTROLLER
     ========================================================================== -->
<script>
	document.addEventListener('DOMContentLoaded', function () {
		let currentCategory = 'all';
		let searchQuery     = '';

		const pills       = document.querySelectorAll('[data-score-category]');
		const searchInput = document.getElementById('scoreSearchInput');
		const refreshBtn  = document.getElementById('sportlixaScoresRefreshBtn');
		const cards       = document.querySelectorAll('.sportlixa-full-game-card');

		function applyScoreFilters() {
			cards.forEach(function (card) {
				const sport     = card.getAttribute('data-sport') || '';
				const isLive    = card.getAttribute('data-live') === 'yes';
				const searchKey = card.getAttribute('data-search') || '';

				let matchesCat = false;
				if (currentCategory === 'all') {
					matchesCat = true;
				} else if (currentCategory === 'live') {
					matchesCat = isLive;
				} else {
					matchesCat = (sport === currentCategory);
				}

				const matchesSearch = (!searchQuery || searchKey.indexOf(searchQuery) !== -1);

				if (matchesCat && matchesSearch) {
					card.style.display = 'flex';
				} else {
					card.style.display = 'none';
				}
			});
		}

		pills.forEach(function (pill) {
			pill.addEventListener('click', function () {
				pills.forEach(p => p.classList.remove('active'));
				this.classList.add('active');
				currentCategory = this.getAttribute('data-score-category');
				applyScoreFilters();
			});
		});

		if (searchInput) {
			searchInput.addEventListener('input', function () {
				searchQuery = this.value.toLowerCase().trim();
				applyScoreFilters();
			});
		}

		if (refreshBtn) {
			refreshBtn.addEventListener('click', function () {
				window.location.reload();
			});
		}
	});
</script>

<?php get_footer(); ?>