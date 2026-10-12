<?php
/**
 * Template Name: Injury Wire & Fantasy Hub
 * Description: Dedicated hub for real-time injury tracking and fantasy football advice.
 *
 * @package Sportlixa
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

// Fetch repeater data with a realistic fallback model
$default_injuries = [
	[
		'name'     => 'Christian McCaffrey',
		'team_pos' => 'SF • RB',
		'status'   => 'Questionable',
		'desc'     => 'Achilles tendinitis recovery progressing smoothly through walkthrough drills. Limited Friday participation.',
		'fantasy'  => 'Jordan Mason remains priority hold & high-end RB2 start if active.',
	],
	[
		'name'     => 'Cooper Kupp',
		'team_pos' => 'LAR • WR',
		'status'   => 'Doubtful',
		'desc'     => 'High ankle sprain protocol. Sidelined for team scrimmage drills; gameday activation unlikely.',
		'fantasy'  => 'Tutu Atwell & Jordan Whittington absorb target share bump.',
	],
	[
		'name'     => 'Isiah Pacheco',
		'team_pos' => 'KC • RB',
		'status'   => 'Out',
		'desc'     => 'Fractured fibula recovery ongoing on Injured Reserve. Targeted return remains mid-season window.',
		'fantasy'  => 'Kareem Hunt maintains lead goal-line touch share in backfield committee.',
	],
	[
		'name'     => 'A.J. Brown',
		'team_pos' => 'PHI • WR',
		'status'   => 'Probable',
		'desc'     => 'Hamstring tightness cleared by clinical medical staff following full practice participation Thursday.',
		'fantasy'  => 'Lock in as WR1 starter across all PPR and standard formats.',
	],
	[
		'name'     => 'Nico Collins',
		'team_pos' => 'HOU • WR',
		'status'   => 'Questionable',
		'desc'     => 'Hamstring strain suffered during long touchdown reception. Game-time decision after Saturday walkthrough.',
		'fantasy'  => 'Stefon Diggs and Tank Dell command elevated target distribution.',
	],
	[
		'name'     => 'Tua Tagovailoa',
		'team_pos' => 'MIA • QB',
		'status'   => 'Out',
		'desc'     => 'Concussion protocol. Consultation with external neurological specialists ongoing.',
		'fantasy'  => 'Downgrade Tyreek Hill and Jaylen Waddle to volatile WR2/WR3 tier.',
	],
];

$injury_items = function_exists( 'sportlixa_get_injury_wire_items' ) ? sportlixa_get_injury_wire_items() : [];
if ( empty( $injury_items ) ) {
	$injury_items = $default_injuries;
}

// Aggregate telemetry metrics
$status_counts = [
	'all'          => count( $injury_items ),
	'questionable' => 0,
	'probable'     => 0,
	'out'          => 0,
];

foreach ( $injury_items as $item ) {
	$st = strtolower( $item['status'] ?? '' );
	if ( strpos( $st, 'questionable' ) !== false || strpos( $st, 'gtd' ) !== false || strpos( $st, 'doubtful' ) !== false ) {
		$status_counts['questionable']++;
	} elseif ( strpos( $st, 'probable' ) !== false || strpos( $st, 'healthy' ) !== false ) {
		$status_counts['probable']++;
	} elseif ( strpos( $st, 'out' ) !== false || strpos( $st, 'ir' ) !== false ) {
		$status_counts['out']++;
	}
}
?>

<main class="devnahian-sportlixa-container sportlixa-fantasy-wire-page" id="primary" role="main">

	<!-- ==========================================================================
	     PAGE HEADER & TELEMETRY STRIP
	     ========================================================================== -->
	<header class="sportlixa-wire-header">
		<div class="sportlixa-wire-badge">
			<span class="live-dot" aria-hidden="true"></span>
			<span><?php esc_html_e( 'LIVE TELEMETRY & WAIVER INTEL', 'sportlixa' ); ?></span>
		</div>
		<h1 class="sportlixa-wire-title"><?php esc_html_e( 'NFL INJURY WIRE & FANTASY SLEEPERS', 'sportlixa' ); ?></h1>
		<p class="sportlixa-wire-subtext">
			<?php esc_html_e( 'Updated game-time decisions, practice participation logs, and actionable fantasy waiver pivots.', 'sportlixa' ); ?>
		</p>

		<!-- Quick Status Counter Bar -->
		<div class="sportlixa-wire-counters-row" aria-label="<?php esc_attr_e( 'Injury Status Metrics', 'sportlixa' ); ?>">
			<div class="counter-box">
				<span class="counter-val"><?php echo (int) $status_counts['all']; ?></span>
				<span class="counter-lbl"><?php esc_html_e( 'Monitored Players', 'sportlixa' ); ?></span>
			</div>
			<div class="counter-box warning">
				<span class="counter-val"><?php echo (int) $status_counts['questionable']; ?></span>
				<span class="counter-lbl"><?php esc_html_e( 'Questionable / GTD', 'sportlixa' ); ?></span>
			</div>
			<div class="counter-box danger">
				<span class="counter-val"><?php echo (int) $status_counts['out']; ?></span>
				<span class="counter-lbl"><?php esc_html_e( 'Ruled Out / IR', 'sportlixa' ); ?></span>
			</div>
			<div class="counter-box success">
				<span class="counter-val"><?php echo (int) $status_counts['probable']; ?></span>
				<span class="counter-lbl"><?php esc_html_e( 'Active / Probable', 'sportlixa' ); ?></span>
			</div>
		</div>
	</header>

	<!-- ==========================================================================
	     CONTROLS: FILTER PILLS & LIVE SEARCH
	     ========================================================================== -->
	<section class="sportlixa-wire-controls-wrap" aria-label="<?php esc_attr_e( 'Filter Controls', 'sportlixa' ); ?>">
		<div class="sportlixa-wire-filters" role="group" aria-label="<?php esc_attr_e( 'Filter by Status', 'sportlixa' ); ?>">
			<button type="button" class="sportlixa-filter-pill active" data-filter-status="all">
				<?php esc_html_e( 'ALL', 'sportlixa' ); ?> (<?php echo (int) $status_counts['all']; ?>)
			</button>
			<button type="button" class="sportlixa-filter-pill" data-filter-status="questionable">
				<?php esc_html_e( 'QUESTIONABLE', 'sportlixa' ); ?> (<?php echo (int) $status_counts['questionable']; ?>)
			</button>
			<button type="button" class="sportlixa-filter-pill" data-filter-status="out">
				<?php esc_html_e( 'OUT / IR', 'sportlixa' ); ?> (<?php echo (int) $status_counts['out']; ?>)
			</button>
			<button type="button" class="sportlixa-filter-pill" data-filter-status="probable">
				<?php esc_html_e( 'PROBABLE', 'sportlixa' ); ?> (<?php echo (int) $status_counts['probable']; ?>)
			</button>
		</div>

		<div class="sportlixa-wire-search-wrap">
			<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
			<input type="text" id="sportlixaWireSearchInput" placeholder="<?php esc_attr_e( 'Filter by player name or team...', 'sportlixa' ); ?>" aria-label="<?php esc_attr_e( 'Search Injury Wire', 'sportlixa' ); ?>" autocomplete="off" />
		</div>
	</section>

	<!-- ==========================================================================
	     CARDS GRID
	     ========================================================================== -->
	<section class="sportlixa-wire-cards-grid" id="sportlixaInjuryGrid" aria-label="<?php esc_attr_e( 'Player Injury Dispatches', 'sportlixa' ); ?>">
		<?php if ( ! empty( $injury_items ) ) : ?>
			<?php foreach ( $injury_items as $player ) : 
				$name_raw     = trim( $player['name'] ?? 'Player' );
				$team_pos_raw = trim( $player['team_pos'] ?? 'NFL' );
				$status_raw   = trim( $player['status'] ?? 'Questionable' );
				$desc_raw     = trim( $player['desc'] ?? '' );
				$fantasy_raw  = trim( $player['fantasy'] ?? '' );

				// Initials calculation from clean raw name
				$words    = explode( ' ', $name_raw );
				$initials = '';
				foreach ( array_slice( $words, 0, 2 ) as $w ) {
					$initials .= strtoupper( substr( $w, 0, 1 ) );
				}

				// Status classification
				$st_lower    = strtolower( $status_raw );
				$filter_key  = 'questionable';
				$badge_class = 'wire-status-questionable';

				if ( strpos( $st_lower, 'probable' ) !== false || strpos( $st_lower, 'healthy' ) !== false ) {
					$filter_key  = 'probable';
					$badge_class = 'wire-status-probable';
				} elseif ( strpos( $st_lower, 'out' ) !== false || strpos( $st_lower, 'ir' ) !== false ) {
					$filter_key  = 'out';
					$badge_class = 'wire-status-out';
				} elseif ( strpos( $st_lower, 'doubtful' ) !== false ) {
					$filter_key  = 'questionable';
					$badge_class = 'wire-status-doubtful';
				}
				?>
				<article 
					class="devnahian-sportlixa-wire-pro-card sportlixa-injury-item" 
					data-status="<?php echo esc_attr( $filter_key ); ?>"
					data-search="<?php echo esc_attr( strtolower( $name_raw . ' ' . $team_pos_raw ) ); ?>"
				>
					<div class="wire-pro-header">
						<div class="wire-pro-avatar" aria-hidden="true"><?php echo esc_html( $initials ?: 'NFL' ); ?></div>
						<div class="wire-pro-info">
							<h3 class="wire-pro-name"><?php echo esc_html( $name_raw ); ?></h3>
							<span class="wire-pro-sub"><?php echo esc_html( $team_pos_raw ); ?></span>
						</div>
						<span class="wire-pro-pill <?php echo esc_attr( $badge_class ); ?>"><?php echo esc_html( $status_raw ); ?></span>
					</div>

					<div class="wire-pro-body">
						<p class="wire-pro-desc"><?php echo esc_html( $desc_raw ); ?></p>
					</div>

					<?php if ( ! empty( $fantasy_raw ) ) : ?>
						<div class="wire-pro-fantasy">
							<span class="fantasy-badge"><?php esc_html_e( 'FANTASY & WAIVER INTEL', 'sportlixa' ); ?></span>
							<span class="fantasy-action"><?php echo esc_html( $fantasy_raw ); ?></span>
						</div>
					<?php endif; ?>
				</article>
			<?php endforeach; ?>
		<?php else : ?>
			<p style="color:var(--devnahian-sportlixa-text-muted, #95a5b8); padding: 40px 0; text-align:center; grid-column: 1/-1;">
				<?php esc_html_e( 'No active injury wire reports found.', 'sportlixa' ); ?>
			</p>
		<?php endif; ?>
	</section>

</main>

<!-- ==========================================================================
     EMBEDDED SCOPED STYLES
     ========================================================================== -->
<style>
	.sportlixa-fantasy-wire-page {
		padding-top: 36px;
		padding-bottom: 70px;
	}
	.sportlixa-wire-header {
		margin-bottom: 28px;
	}
	.sportlixa-wire-badge {
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
	.sportlixa-wire-badge .live-dot {
		width: 7px;
		height: 7px;
		background: var(--devnahian-sportlixa-red-live, #ff2e43);
		border-radius: 50%;
		box-shadow: 0 0 8px var(--devnahian-sportlixa-red-live-glow, rgba(255, 46, 67, 0.45));
	}
	.sportlixa-wire-title {
		font-size: clamp(24px, 4vw, 34px);
		font-weight: 900;
		font-style: italic;
		color: var(--devnahian-sportlixa-text-white, #ffffff);
		margin: 0 0 8px 0;
		text-transform: uppercase;
		letter-spacing: -0.5px;
		line-height: 1.2;
	}
	.sportlixa-wire-subtext {
		color: var(--devnahian-sportlixa-text-muted, #95a5b8);
		font-size: 15px;
		margin: 0 0 24px 0;
		max-width: 680px;
		line-height: 1.6;
	}

	/* Telemetry Stat Strip */
	.sportlixa-wire-counters-row {
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
		gap: 14px;
		margin-bottom: 30px;
	}
	.counter-box {
		background: var(--devnahian-sportlixa-bg-card, #121926);
		border: 1px solid var(--devnahian-sportlixa-border-card, #1e2a3f);
		border-radius: var(--devnahian-sportlixa-radius-md, 10px);
		padding: 16px 20px;
		display: flex;
		flex-direction: column;
		gap: 4px;
		box-shadow: var(--devnahian-sportlixa-shadow-card, 0 4px 20px rgba(0, 0, 0, 0.28));
	}
	.counter-val {
		font-size: 28px;
		font-weight: 900;
		font-style: italic;
		color: var(--devnahian-sportlixa-text-white, #ffffff);
		line-height: 1;
	}
	.counter-lbl {
		font-size: 11px;
		color: var(--devnahian-sportlixa-text-dim, #64758b);
		font-weight: 800;
		text-transform: uppercase;
		letter-spacing: 0.5px;
	}
	.counter-box.warning .counter-val { color: var(--devnahian-sportlixa-orange-warn, #f59e0b); }
	.counter-box.danger .counter-val  { color: var(--devnahian-sportlixa-red-live, #ff2e43); }
	.counter-box.success .counter-val { color: var(--devnahian-sportlixa-green-ok, #10b981); }

	/* Controls: Filters & Search */
	.sportlixa-wire-controls-wrap {
		display: flex;
		justify-content: space-between;
		align-items: center;
		flex-wrap: wrap;
		gap: 16px;
		margin-bottom: 26px;
		padding-bottom: 18px;
		border-bottom: 1px solid var(--devnahian-sportlixa-border-color, #1a2538);
	}
	.sportlixa-wire-filters {
		display: flex;
		gap: 8px;
		flex-wrap: wrap;
	}
	.sportlixa-filter-pill {
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
	.sportlixa-filter-pill:hover,
	.sportlixa-filter-pill.active {
		background: var(--devnahian-sportlixa-brand-volt, #c8ff00);
		color: #000000;
		border-color: var(--devnahian-sportlixa-brand-volt, #c8ff00);
		box-shadow: 0 0 12px var(--devnahian-sportlixa-brand-volt-glow, rgba(200, 255, 0, 0.28));
	}
	.sportlixa-wire-search-wrap {
		position: relative;
		min-width: 260px;
		flex-grow: 0;
	}
	.sportlixa-wire-search-wrap svg {
		position: absolute;
		left: 12px;
		top: 50%;
		transform: translateY(-50%);
		stroke: var(--devnahian-sportlixa-brand-volt, #c8ff00);
		pointer-events: none;
	}
	.sportlixa-wire-search-wrap input {
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
	.sportlixa-wire-search-wrap input:focus {
		border-color: var(--devnahian-sportlixa-brand-volt, #c8ff00);
		box-shadow: 0 0 10px var(--devnahian-sportlixa-brand-volt-glow, rgba(200, 255, 0, 0.28));
	}

	/* Cards Grid */
	.sportlixa-wire-cards-grid {
		display: grid;
		grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
		gap: 20px;
	}

	/* Card Interior */
	.devnahian-sportlixa-wire-pro-card {
		background: var(--devnahian-sportlixa-bg-card, #121926);
		border: 1px solid var(--devnahian-sportlixa-border-card, #1e2a3f);
		border-radius: var(--devnahian-sportlixa-radius-md, 10px);
		padding: 20px;
		display: flex;
		flex-direction: column;
		gap: 12px;
		box-shadow: var(--devnahian-sportlixa-shadow-card, 0 4px 20px rgba(0, 0, 0, 0.28));
		transition: transform var(--devnahian-sportlixa-transition-smooth, 0.35s cubic-bezier(0.16, 1, 0.3, 1)), border-color var(--devnahian-sportlixa-transition-smooth, 0.35s cubic-bezier(0.16, 1, 0.3, 1));
	}
	.devnahian-sportlixa-wire-pro-card:hover {
		transform: translateY(-3px);
		border-color: var(--devnahian-sportlixa-brand-volt, #c8ff00);
	}
	.wire-pro-header {
		display: flex;
		align-items: center;
		gap: 12px;
	}
	.wire-pro-avatar {
		width: 44px;
		height: 44px;
		border-radius: var(--devnahian-sportlixa-radius-sm, 6px);
		background: var(--devnahian-sportlixa-bg-input, #151e2e);
		border: 1.5px solid var(--devnahian-sportlixa-brand-volt, #c8ff00);
		display: flex;
		align-items: center;
		justify-content: center;
		font-weight: 900;
		font-style: italic;
		font-size: 14px;
		color: var(--devnahian-sportlixa-brand-volt-text, #c8ff00);
		flex-shrink: 0;
	}
	.wire-pro-info {
		flex: 1;
		min-width: 0;
	}
	.wire-pro-name {
		margin: 0;
		font-size: 15px;
		font-weight: 800;
		color: var(--devnahian-sportlixa-text-white, #ffffff);
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
		line-height: 1.25;
	}
	.wire-pro-sub {
		font-size: 11px;
		font-weight: 700;
		text-transform: uppercase;
		color: var(--devnahian-sportlixa-text-dim, #64758b);
	}
	.wire-pro-pill {
		font-size: 10px;
		font-weight: 900;
		text-transform: uppercase;
		padding: 4px 8px;
		border-radius: 4px;
		letter-spacing: 0.5px;
		white-space: nowrap;
	}
	.wire-status-questionable {
		background: rgba(245, 158, 11, 0.15);
		color: var(--devnahian-sportlixa-orange-warn, #f59e0b);
		border: 1px solid var(--devnahian-sportlixa-orange-warn, #f59e0b);
	}
	.wire-status-probable {
		background: rgba(16, 185, 129, 0.15);
		color: var(--devnahian-sportlixa-green-ok, #10b981);
		border: 1px solid var(--devnahian-sportlixa-green-ok, #10b981);
	}
	.wire-status-out {
		background: rgba(255, 46, 67, 0.15);
		color: var(--devnahian-sportlixa-red-live, #ff2e43);
		border: 1px solid var(--devnahian-sportlixa-red-live, #ff2e43);
	}
	.wire-status-doubtful {
		background: rgba(255, 46, 67, 0.12);
		color: var(--devnahian-sportlixa-red-live, #ff2e43);
		border: 1px solid rgba(255, 46, 67, 0.35);
	}
	.wire-pro-desc {
		margin: 0;
		font-size: 13px;
		line-height: 1.55;
		color: var(--devnahian-sportlixa-text-light, #e5ebf5);
	}
	.wire-pro-fantasy {
		background: var(--devnahian-sportlixa-bg-input, #151e2e);
		border-left: 3px solid var(--devnahian-sportlixa-brand-volt, #c8ff00);
		padding: 10px 12px;
		border-radius: 0 var(--devnahian-sportlixa-radius-sm, 6px) var(--devnahian-sportlixa-radius-sm, 6px) 0;
		font-size: 12px;
	}
	.fantasy-badge {
		display: block;
		font-size: 9.5px;
		font-weight: 900;
		text-transform: uppercase;
		color: var(--devnahian-sportlixa-brand-volt-text, #c8ff00);
		letter-spacing: 0.6px;
		margin-bottom: 2px;
	}
	.fantasy-action {
		color: var(--devnahian-sportlixa-text-white, #ffffff);
		font-weight: 600;
		line-height: 1.45;
	}

	@media (max-width: 768px) {
		.sportlixa-wire-title { font-size: 24px; }
		.sportlixa-wire-search-wrap { width: 100%; min-width: 100%; }
		.sportlixa-wire-cards-grid { grid-template-columns: 1fr; }
	}
</style>

<!-- ==========================================================================
     UNOBTRUSIVE REAL-TIME FILTERING SCRIPT
     ========================================================================== -->
<script>
	document.addEventListener('DOMContentLoaded', function () {
		let currentStatusFilter = 'all';
		let currentSearchQuery  = '';

		const filterButtons = document.querySelectorAll('[data-filter-status]');
		const searchInput   = document.getElementById('sportlixaWireSearchInput');
		const cards         = document.querySelectorAll('.sportlixa-injury-item');

		function applyFilters() {
			cards.forEach(function (card) {
				const cardStatus = card.getAttribute('data-status');
				const cardSearch = card.getAttribute('data-search') || '';

				const matchesStatus = (currentStatusFilter === 'all' || cardStatus === currentStatusFilter);
				const matchesSearch = (!currentSearchQuery || cardSearch.indexOf(currentSearchQuery) !== -1);

				if (matchesStatus && matchesSearch) {
					card.style.display = 'flex';
				} else {
					card.style.display = 'none';
				}
			});
		}

		filterButtons.forEach(function (btn) {
			btn.addEventListener('click', function () {
				filterButtons.forEach(b => b.classList.remove('active'));
				this.classList.add('active');
				currentStatusFilter = this.getAttribute('data-filter-status');
				applyFilters();
			});
		});

		if (searchInput) {
			searchInput.addEventListener('input', function () {
				currentSearchQuery = this.value.toLowerCase().trim();
				applyFilters();
			});
		}
	});
</script>

<?php get_footer(); ?>