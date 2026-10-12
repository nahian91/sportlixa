<?php
/**
 * Template Name: Predictions Hub
 * Description: Displays upcoming matchups, win probabilities, and consensus voting from ESPN API.
 *
 * @package Sportlixa
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

// Fetch predictions from helper or fall back to an active multi-sport model
$predictions_data = function_exists( 'sportlixa_get_espn_predictions' ) ? sportlixa_get_espn_predictions() : [];

if ( empty( $predictions_data ) ) {
	$predictions_data = [
		[
			'id'         => 'pred_nfl_1',
			'sport'      => 'nfl',
			'game_date'  => 'Sun, 4:25 PM ET',
			'broadcast'  => 'CBS',
			'spread'     => 'KC -2.5',
			'over_under' => 'O/U 48.5',
			'away'       => [
				'code'    => 'BUF',
				'name'    => 'Buffalo Bills',
				'record'  => '4-1',
				'logo'    => '',
				'win_pct' => 46,
			],
			'home'       => [
				'code'    => 'KC',
				'name'    => 'Kansas City Chiefs',
				'record'  => '5-0',
				'logo'    => '',
				'win_pct' => 54,
			],
		],
		[
			'id'         => 'pred_nfl_2',
			'sport'      => 'nfl',
			'game_date'  => 'Sun, 8:20 PM ET',
			'broadcast'  => 'NBC',
			'spread'     => 'PHI -3.0',
			'over_under' => 'O/U 44.5',
			'away'       => [
				'code'    => 'DAL',
				'name'    => 'Dallas Cowboys',
				'record'  => '3-2',
				'logo'    => '',
				'win_pct' => 41,
			],
			'home'       => [
				'code'    => 'PHI',
				'name'    => 'Philadelphia Eagles',
				'record'  => '4-1',
				'logo'    => '',
				'win_pct' => 59,
			],
		],
		[
			'id'         => 'pred_nba_1',
			'sport'      => 'nba',
			'game_date'  => 'Mon, 7:30 PM ET',
			'broadcast'  => 'TNT',
			'spread'     => 'BOS -5.5',
			'over_under' => 'O/U 224.5',
			'away'       => [
				'code'    => 'MIA',
				'name'    => 'Miami Heat',
				'record'  => '2-2',
				'logo'    => '',
				'win_pct' => 38,
			],
			'home'       => [
				'code'    => 'BOS',
				'name'    => 'Boston Celtics',
				'record'  => '4-0',
				'logo'    => '',
				'win_pct' => 62,
			],
		],
		[
			'id'         => 'pred_mlb_1',
			'sport'      => 'mlb',
			'game_date'  => 'Tue, 8:08 PM ET',
			'broadcast'  => 'FOX',
			'spread'     => 'LAD -1.5',
			'over_under' => 'O/U 8.5',
			'away'       => [
				'code'    => 'NYY',
				'name'    => 'New York Yankees',
				'record'  => '94-68',
				'logo'    => '',
				'win_pct' => 47,
			],
			'home'       => [
				'code'    => 'LAD',
				'name'    => 'Los Angeles Dodgers',
				'record'  => '98-64',
				'logo'    => '',
				'win_pct' => 53,
			],
		],
		[
			'id'         => 'pred_nhl_1',
			'sport'      => 'nhl',
			'game_date'  => 'Wed, 7:00 PM ET',
			'broadcast'  => 'ESPN+',
			'spread'     => 'EDM -1.5',
			'over_under' => 'O/U 6.5',
			'away'       => [
				'code'    => 'TOR',
				'name'    => 'Toronto Maple Leafs',
				'record'  => '3-1-0',
				'logo'    => '',
				'win_pct' => 45,
			],
			'home'       => [
				'code'    => 'EDM',
				'name'    => 'Edmonton Oilers',
				'record'  => '4-0-0',
				'logo'    => '',
				'win_pct' => 55,
			],
		],
	];
}

$league_counts = [
	'all' => count( $predictions_data ),
	'nfl' => 0,
	'nba' => 0,
	'mlb' => 0,
	'nhl' => 0,
];

foreach ( $predictions_data as $p ) {
	$sp = strtolower( $p['sport'] ?? '' );
	if ( isset( $league_counts[ $sp ] ) ) {
		$league_counts[ $sp ]++;
	}
}

// Fallback crest render function
if ( ! function_exists( 'sportlixa_render_pred_crest' ) ) {
	function sportlixa_render_pred_crest( $code, $logo = '' ) {
		if ( ! empty( $logo ) ) {
			echo '<img src="' . esc_url( $logo ) . '" alt="' . esc_attr( $code ) . '" class="pred-crest-img" loading="lazy">';
			return;
		}
		if ( function_exists( 'sportlixa_render_team_crest_svg' ) ) {
			sportlixa_render_team_crest_svg( $code, $logo );
			return;
		}
		$c = strtoupper( substr( trim( $code ), 0, 3 ) );
		?>
		<svg class="pred-crest-svg" viewBox="0 0 40 40" aria-hidden="true" focusable="false">
			<circle cx="20" cy="20" r="16" fill="#151e2e" stroke="rgba(255,255,255,0.15)" stroke-width="1.5"/>
			<text x="20" y="24" fill="#ffffff" font-size="8.5" font-weight="900" text-anchor="middle"><?php echo esc_html( $c ); ?></text>
		</svg>
		<?php
	}
}
?>

<main class="devnahian-sportlixa-container sportlixa-predictions-page" id="primary" role="main">

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
				<?php esc_html_e( 'Predictions', 'sportlixa' ); ?>
			</li>
		</ol>
	</nav>

	<!-- ==========================================================================
	     HEADER & FILTER PILLS
	     ========================================================================== -->
	<header class="sportlixa-pred-header">
		<div class="sportlixa-pred-badge">
			<span class="pulse-indicator" aria-hidden="true"></span>
			<span><?php esc_html_e( 'ESPN ANALYTICS & MARKET ODDS', 'sportlixa' ); ?></span>
		</div>
		<h1 class="sportlixa-pred-title"><?php esc_html_e( 'GAME DAY PREDICTIONS & CONSENSUS PICKS', 'sportlixa' ); ?></h1>
		<p class="sportlixa-pred-subtext">
			<?php esc_html_e( 'Automated win projections, current Vegas lines, and real-time community pick consensus.', 'sportlixa' ); ?>
		</p>

		<!-- Filter Pills -->
		<div class="sportlixa-pred-pills-row" role="group" aria-label="<?php esc_attr_e( 'Filter Matches by Sport', 'sportlixa' ); ?>">
			<button type="button" class="sportlixa-pred-pill active" data-pred-sport="all">
				<?php printf( esc_html__( 'ALL (%d)', 'sportlixa' ), (int) $league_counts['all'] ); ?>
			</button>
			<button type="button" class="sportlixa-pred-pill" data-pred-sport="nfl">
				<?php printf( esc_html__( 'NFL (%d)', 'sportlixa' ), (int) $league_counts['nfl'] ); ?>
			</button>
			<button type="button" class="sportlixa-pred-pill" data-pred-sport="nba">
				<?php printf( esc_html__( 'NBA (%d)', 'sportlixa' ), (int) $league_counts['nba'] ); ?>
			</button>
			<button type="button" class="sportlixa-pred-pill" data-pred-sport="mlb">
				<?php printf( esc_html__( 'MLB (%d)', 'sportlixa' ), (int) $league_counts['mlb'] ); ?>
			</button>
			<button type="button" class="sportlixa-pred-pill" data-pred-sport="nhl">
				<?php printf( esc_html__( 'NHL (%d)', 'sportlixa' ), (int) $league_counts['nhl'] ); ?>
			</button>
		</div>
	</header>

	<!-- ==========================================================================
	     PREDICTION CARDS GRID
	     ========================================================================== -->
	<section class="sportlixa-pred-grid" id="predictionsGrid" aria-label="<?php esc_attr_e( 'Upcoming Projections', 'sportlixa' ); ?>">
		<?php if ( ! empty( $predictions_data ) ) : ?>
			<?php foreach ( $predictions_data as $game ) : 
				$game_id   = esc_attr( $game['id'] ?? uniqid( 'pred_' ) );
				$sport     = esc_attr( strtolower( $game['sport'] ?? 'nfl' ) );
				$home      = $game['home'] ?? [];
				$away      = $game['away'] ?? [];
				$home_code = trim( $home['code'] ?? 'HOM' );
				$away_code = trim( $away['code'] ?? 'AWY' );
				$home_pct  = max( 1, min( 99, (int) ( $home['win_pct'] ?? 50 ) ) );
				$away_pct  = 100 - $home_pct;
				$meta_time = trim( ( $game['game_date'] ?? '' ) . ( ! empty( $game['broadcast'] ) ? ' • ' . $game['broadcast'] : '' ) );
			?>
				<article class="sportlixa-pred-card" data-sport="<?php echo $sport; ?>" id="game-card-<?php echo $game_id; ?>">
					
					<div class="pred-card-top">
						<span class="pred-sport-tag"><?php echo esc_html( strtoupper( $sport ) ); ?></span>
						<span class="pred-schedule-time"><?php echo esc_html( $meta_time ); ?></span>
					</div>

					<!-- Teams Board -->
					<div class="pred-teams-board">
						
						<!-- Away Team -->
						<div class="pred-team-col">
							<div class="pred-logo-wrap">
								<?php sportlixa_render_pred_crest( $away_code, $away['logo'] ?? '' ); ?>
							</div>
							<h3 class="pred-team-name"><?php echo esc_html( $away['name'] ?? $away_code ); ?></h3>
							<?php if ( ! empty( $away['record'] ) ) : ?>
								<span class="pred-team-rec"><?php echo esc_html( $away['record'] ); ?></span>
							<?php endif; ?>
						</div>

						<div class="pred-vs-circle" aria-hidden="true">VS</div>

						<!-- Home Team -->
						<div class="pred-team-col">
							<div class="pred-logo-wrap">
								<?php sportlixa_render_pred_crest( $home_code, $home['logo'] ?? '' ); ?>
							</div>
							<h3 class="pred-team-name"><?php echo esc_html( $home['name'] ?? $home_code ); ?></h3>
							<?php if ( ! empty( $home['record'] ) ) : ?>
								<span class="pred-team-rec"><?php echo esc_html( $home['record'] ); ?></span>
							<?php endif; ?>
						</div>

					</div>

					<!-- Win Probability Bar (Analytics Model) -->
					<div class="pred-win-meter-wrap" aria-label="<?php esc_attr_e( 'Win Probability Projection', 'sportlixa' ); ?>">
						<div class="pred-win-labels">
							<span><?php echo esc_html( $away_code ); ?> <?php echo (int) $away_pct; ?>%</span>
							<span class="meter-title"><?php esc_html_e( 'Win Predictor', 'sportlixa' ); ?></span>
							<span><?php echo (int) $home_pct; ?>% <?php echo esc_html( $home_code ); ?></span>
						</div>
						<div class="pred-meter-bar">
							<div class="pred-meter-away" style="width: <?php echo (int) $away_pct; ?>%;"></div>
							<div class="pred-meter-home" style="width: <?php echo (int) $home_pct; ?>%;"></div>
						</div>
					</div>

					<!-- Vegas Lines -->
					<div class="pred-odds-strip">
						<span><?php esc_html_e( 'Spread:', 'sportlixa' ); ?> <strong><?php echo esc_html( $game['spread'] ?? 'EVEN' ); ?></strong></span>
						<span><?php esc_html_e( 'Total:', 'sportlixa' ); ?> <strong><?php echo esc_html( $game['over_under'] ?? 'O/U --' ); ?></strong></span>
					</div>

					<!-- Interactive User Pick Buttons -->
					<div class="pred-pick-actions">
						<button 
							type="button" 
							class="pred-btn-pick" 
							data-game="<?php echo $game_id; ?>" 
							data-pick-side="away"
							data-team-name="<?php echo esc_attr( $away['name'] ?? $away_code ); ?>"
						>
							<?php printf( esc_html__( 'Pick %s', 'sportlixa' ), esc_html( $away_code ) ); ?>
						</button>
						<button 
							type="button" 
							class="pred-btn-pick" 
							data-game="<?php echo $game_id; ?>" 
							data-pick-side="home"
							data-team-name="<?php echo esc_attr( $home['name'] ?? $home_code ); ?>"
						>
							<?php printf( esc_html__( 'Pick %s', 'sportlixa' ), esc_html( $home_code ) ); ?>
						</button>
					</div>

				</article>
			<?php endforeach; ?>
		<?php else : ?>
			<p style="color:var(--devnahian-sportlixa-text-muted, #95a5b8); padding: 40px 0; text-align:center; grid-column: 1/-1;">
				<?php esc_html_e( 'No upcoming matchups available for projection at this time.', 'sportlixa' ); ?>
			</p>
		<?php endif; ?>
	</section>

</main>

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

	.sportlixa-predictions-page {
		padding-top: 24px;
		padding-bottom: 70px;
	}
	.sportlixa-pred-header {
		margin-bottom: 30px;
	}
	.sportlixa-pred-badge {
		display: inline-flex;
		align-items: center;
		gap: 8px;
		font-size: 11px;
		font-weight: 800;
		color: var(--devnahian-sportlixa-brand-volt, #c8ff00);
		text-transform: uppercase;
		letter-spacing: 0.8px;
		margin-bottom: 8px;
	}
	.pulse-indicator {
		width: 7px;
		height: 7px;
		background: var(--devnahian-sportlixa-brand-volt, #c8ff00);
		border-radius: 50%;
		box-shadow: 0 0 8px var(--devnahian-sportlixa-brand-volt-glow, rgba(200, 255, 0, 0.28));
	}
	.sportlixa-pred-title {
		font-size: clamp(24px, 4vw, 34px);
		font-weight: 900;
		font-style: italic;
		color: var(--devnahian-sportlixa-text-white, #ffffff);
		margin: 0 0 8px 0;
		text-transform: uppercase;
		letter-spacing: -0.5px;
		line-height: 1.2;
	}
	.sportlixa-pred-subtext {
		color: var(--devnahian-sportlixa-text-muted, #95a5b8);
		font-size: 15px;
		margin: 0 0 20px 0;
		max-width: 680px;
		line-height: 1.6;
	}
	
	.sportlixa-pred-pills-row {
		display: flex;
		gap: 8px;
		flex-wrap: wrap;
	}
	.sportlixa-pred-pill {
		background: var(--devnahian-sportlixa-bg-input, #151e2e);
		border: 1px solid var(--devnahian-sportlixa-border-card, #1e2a3f);
		color: var(--devnahian-sportlixa-text-muted, #95a5b8);
		font-size: 11px;
		font-weight: 800;
		text-transform: uppercase;
		letter-spacing: 0.6px;
		padding: 8px 16px;
		border-radius: 20px;
		cursor: pointer;
		font-family: inherit;
		transition: all var(--devnahian-sportlixa-transition-fast, 0.2s ease);
	}
	.sportlixa-pred-pill.active,
	.sportlixa-pred-pill:hover {
		background: var(--devnahian-sportlixa-brand-volt, #c8ff00);
		color: #000000;
		border-color: var(--devnahian-sportlixa-brand-volt, #c8ff00);
		box-shadow: 0 0 12px var(--devnahian-sportlixa-brand-volt-glow, rgba(200, 255, 0, 0.28));
	}

	/* Grid & Cards */
	.sportlixa-pred-grid {
		display: grid;
		grid-template-columns: repeat(auto-fill, minmax(330px, 1fr));
		gap: 20px;
	}
	.sportlixa-pred-card {
		background: var(--devnahian-sportlixa-bg-card, #121926);
		border: 1px solid var(--devnahian-sportlixa-border-card, #1e2a3f);
		border-radius: var(--devnahian-sportlixa-radius-md, 10px);
		padding: 20px;
		display: flex;
		flex-direction: column;
		gap: 16px;
		box-shadow: var(--devnahian-sportlixa-shadow-card, 0 4px 20px rgba(0, 0, 0, 0.28));
		transition: transform var(--devnahian-sportlixa-transition-smooth, 0.35s cubic-bezier(0.16, 1, 0.3, 1)), border-color var(--devnahian-sportlixa-transition-smooth, 0.35s cubic-bezier(0.16, 1, 0.3, 1));
	}
	.sportlixa-pred-card:hover {
		transform: translateY(-3px);
		border-color: var(--devnahian-sportlixa-brand-volt, #c8ff00);
	}
	.pred-card-top {
		display: flex;
		justify-content: space-between;
		align-items: center;
		font-size: 11px;
		font-weight: 800;
	}
	.pred-sport-tag {
		color: var(--devnahian-sportlixa-brand-volt-text, #c8ff00);
		letter-spacing: 0.6px;
	}
	.pred-schedule-time {
		color: var(--devnahian-sportlixa-text-dim, #64758b);
	}

	/* Teams Board */
	.pred-teams-board {
		display: flex;
		justify-content: space-between;
		align-items: center;
		background: var(--devnahian-sportlixa-bg-input, #151e2e);
		padding: 16px;
		border-radius: var(--devnahian-sportlixa-radius-sm, 6px);
		border: 1px solid var(--devnahian-sportlixa-border-card, #1e2a3f);
	}
	.pred-team-col {
		display: flex;
		flex-direction: column;
		align-items: center;
		text-align: center;
		width: 42%;
	}
	.pred-logo-wrap {
		width: 44px;
		height: 44px;
		display: flex;
		align-items: center;
		justify-content: center;
		margin-bottom: 6px;
	}
	.pred-logo-wrap .pred-crest-img,
	.pred-logo-wrap img {
		width: 40px;
		height: 40px;
		object-fit: contain;
	}
	.pred-logo-wrap .pred-crest-svg {
		width: 36px;
		height: 36px;
	}
	.pred-team-name {
		margin: 0;
		font-size: 13.5px;
		font-weight: 800;
		color: var(--devnahian-sportlixa-text-white, #ffffff);
		line-height: 1.25;
	}
	.pred-team-rec {
		font-size: 11px;
		color: var(--devnahian-sportlixa-text-dim, #64758b);
		margin-top: 2px;
	}
	.pred-vs-circle {
		font-size: 10px;
		font-weight: 900;
		color: var(--devnahian-sportlixa-text-dim, #64758b);
		background: var(--devnahian-sportlixa-bg-card, #121926);
		border: 1px solid var(--devnahian-sportlixa-border-card, #1e2a3f);
		padding: 4px 8px;
		border-radius: 50%;
	}

	/* Probability Meter */
	.pred-win-meter-wrap {
		display: flex;
		flex-direction: column;
		gap: 6px;
	}
	.pred-win-labels {
		display: flex;
		justify-content: space-between;
		font-size: 11px;
		font-weight: 800;
		color: var(--devnahian-sportlixa-text-light, #e5ebf5);
	}
	.pred-win-labels .meter-title {
		color: var(--devnahian-sportlixa-text-dim, #64758b);
		text-transform: uppercase;
		font-size: 9.5px;
		letter-spacing: 0.5px;
	}
	.pred-meter-bar {
		height: 6px;
		width: 100%;
		border-radius: 3px;
		overflow: hidden;
		display: flex;
		background: #080c14;
	}
	.pred-meter-away {
		background: #3b82f6;
	}
	.pred-meter-home {
		background: var(--devnahian-sportlixa-brand-volt, #c8ff00);
	}

	/* Odds Strip */
	.pred-odds-strip {
		display: flex;
		justify-content: space-between;
		background: var(--devnahian-sportlixa-bg-input, #151e2e);
		border: 1px solid var(--devnahian-sportlixa-border-card, #1e2a3f);
		padding: 8px 12px;
		border-radius: var(--devnahian-sportlixa-radius-sm, 6px);
		font-size: 11.5px;
		color: var(--devnahian-sportlixa-text-muted, #95a5b8);
	}
	.pred-odds-strip strong {
		color: var(--devnahian-sportlixa-text-white, #ffffff);
	}

	/* Pick Buttons */
	.pred-pick-actions {
		display: grid;
		grid-template-columns: 1fr 1fr;
		gap: 10px;
	}
	.pred-btn-pick {
		background: var(--devnahian-sportlixa-bg-input, #151e2e);
		border: 1px solid var(--devnahian-sportlixa-border-card, #1e2a3f);
		color: var(--devnahian-sportlixa-text-light, #e5ebf5);
		padding: 10px;
		font-size: 11.5px;
		font-weight: 800;
		border-radius: var(--devnahian-sportlixa-radius-sm, 6px);
		cursor: pointer;
		font-family: inherit;
		transition: all var(--devnahian-sportlixa-transition-fast, 0.2s ease);
	}
	.pred-btn-pick:hover {
		border-color: var(--devnahian-sportlixa-brand-volt, #c8ff00);
		color: var(--devnahian-sportlixa-brand-volt-text, #c8ff00);
	}
	.pred-btn-pick.picked {
		background: var(--devnahian-sportlixa-brand-volt, #c8ff00);
		color: #000000;
		border-color: var(--devnahian-sportlixa-brand-volt, #c8ff00);
		box-shadow: 0 0 10px var(--devnahian-sportlixa-brand-volt-glow, rgba(200, 255, 0, 0.28));
	}

	@media (max-width: 768px) {
		.sportlixa-pred-title { font-size: 24px; }
		.sportlixa-pred-grid { grid-template-columns: 1fr; }
	}
</style>

<script>
	document.addEventListener('DOMContentLoaded', function () {
		const filterPills = document.querySelectorAll('[data-pred-sport]');
		const cards       = document.querySelectorAll('.sportlixa-pred-card');
		const pickButtons = document.querySelectorAll('.pred-btn-pick');

		// 1. Sport filtering
		filterPills.forEach(function (pill) {
			pill.addEventListener('click', function () {
				filterPills.forEach(p => p.classList.remove('active'));
				this.classList.add('active');

				const sport = this.getAttribute('data-pred-sport');
				cards.forEach(function (card) {
					const cardSport = card.getAttribute('data-sport');
					if (sport === 'all' || cardSport === sport) {
						card.style.display = 'flex';
					} else {
						card.style.display = 'none';
					}
				});
			});
		});

		// 2. Pick restoration & click persistence
		pickButtons.forEach(function (btn) {
			const gameId = btn.getAttribute('data-game');
			const side   = btn.getAttribute('data-pick-side');

			if (localStorage.getItem('sportlixa_pick_' + gameId) === side) {
				btn.classList.add('picked');
			}

			btn.addEventListener('click', function () {
				const parent = this.parentElement;
				parent.querySelectorAll('.pred-btn-pick').forEach(b => b.classList.remove('picked'));
				this.classList.add('picked');

				localStorage.setItem('sportlixa_pick_' + gameId, side);

				if (typeof window.showToast === 'function') {
					const team = this.getAttribute('data-team-name') || 'Team';
					window.showToast('Consensus pick registered for ' + team + '!');
				}
			});
		});
	});
</script>

<?php get_footer(); ?>