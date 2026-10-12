<?php
/**
 * The template for displaying search results pages
 *
 * @package Sportlixa
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

global $wp_query;
$search_query   = get_search_query();
$total_posts    = (int) $wp_query->found_posts;
$default_thumb  = get_theme_file_uri( '/assets/img/placeholder.jpg' );
?>

<main class="devnahian-sportlixa-container" id="primary" role="main">

	<!-- ==========================================================================
	     DEDICATED SEARCH PAGE HERO & INTERACTIVE QUERY BAR
	     ========================================================================== -->
	<section class="devnahian-sportlixa-search-hero">
		<nav class="devnahian-sportlixa-breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'sportlixa' ); ?>">
			<ol class="sportlixa-breadcrumbs-list" style="display:flex; flex-wrap:wrap; align-items:center; gap:0.5rem; list-style:none; padding:0; margin:0; font-size:0.85rem;">
				<li>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'sportlixa' ); ?></a>
				</li>
				<li class="sportlixa-breadcrumbs-separator" aria-hidden="true">/</li>
				<li>
					<span><?php esc_html_e( 'Search Center', 'sportlixa' ); ?></span>
				</li>
				<li class="sportlixa-breadcrumbs-separator" aria-hidden="true">/</li>
				<li class="sportlixa-breadcrumbs-current" id="devnahian-sportlixa-queryBreadcrumb" aria-current="page">
					"<?php echo esc_html( $search_query ); ?>"
				</li>
			</ol>
		</nav>

		<!-- Prominent Search Bar (Submits standard WordPress ?s= query) -->
		<form role="search" method="get" class="devnahian-sportlixa-search-box-large" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<svg class="devnahian-sportlixa-search-icon-left" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true" focusable="false"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
			<input 
				type="search" 
				name="s" 
				class="devnahian-sportlixa-search-input-large" 
				id="devnahian-sportlixa-pageSearchInput" 
				value="<?php echo esc_attr( $search_query ); ?>" 
				placeholder="<?php esc_attr_e( 'Search by team, player, keyword, or matchup...', 'sportlixa' ); ?>"
				required
			>
			<button type="button" class="devnahian-sportlixa-search-clear-btn" id="devnahian-sportlixa-searchClearBtn" aria-label="<?php esc_attr_e( 'Clear Search Input', 'sportlixa' ); ?>">
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true" focusable="false"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
			</button>
			<button type="submit" class="devnahian-sportlixa-btn-search-submit"><?php esc_html_e( 'Search', 'sportlixa' ); ?></button>
		</form>

		<!-- Search Query Info & Popular Tags -->
		<div class="devnahian-sportlixa-search-meta-row">
			<div class="devnahian-sportlixa-query-count">
				<?php
				printf(
					/* translators: 1: number of results, 2: search term */
					esc_html__( 'Found %1$s results for "%2$s"', 'sportlixa' ),
					'<strong id="devnahian-sportlixa-matchTotal">' . esc_html( (string) $total_posts ) . '</strong>',
					'<strong>' . esc_html( $search_query ) . '</strong>'
				);
				?>
			</div>

			<div class="devnahian-sportlixa-quick-tags-wrap">
				<span style="font-size:11px; text-transform:uppercase; font-weight:800; color:var(--devnahian-sportlixa-text-dim);"><?php esc_html_e( 'Suggested:', 'sportlixa' ); ?></span>
				<a href="<?php echo esc_url( home_url( '/?s=Patrick+Mahomes' ) ); ?>" class="devnahian-sportlixa-quick-tag">Patrick Mahomes</a>
				<a href="<?php echo esc_url( home_url( '/?s=Josh+Allen' ) ); ?>" class="devnahian-sportlixa-quick-tag">Josh Allen</a>
				<a href="<?php echo esc_url( home_url( '/?s=Lakers' ) ); ?>" class="devnahian-sportlixa-quick-tag">Lakers vs Celtics</a>
				<a href="<?php echo esc_url( home_url( '/?s=Injury+Wire' ) ); ?>" class="devnahian-sportlixa-quick-tag">Injury Wire</a>
			</div>
		</div>
	</section>

	<!-- Facet Filter Bar -->
	<div class="devnahian-sportlixa-facets-toolbar">
		<div class="devnahian-sportlixa-facets-nav" role="tablist" aria-label="<?php esc_attr_e( 'Result Facets', 'sportlixa' ); ?>">
			<button type="button" class="devnahian-sportlixa-facet-tab active" data-search-facet="all">
				<?php printf( esc_html__( 'All Results (%d)', 'sportlixa' ), (int) $total_posts ); ?>
			</button>
		</div>

		<div class="devnahian-sportlixa-sort-wrap">
			<label for="devnahian-sportlixa-sortSelect"><?php esc_html_e( 'Order:', 'sportlixa' ); ?></label>
			<select id="devnahian-sportlixa-sortSelect" class="devnahian-sportlixa-sort-select">
				<option value="<?php echo esc_url( add_query_arg( [ 's' => $search_query, 'orderby' => 'relevance' ], home_url( '/' ) ) ); ?>" <?php selected( get_query_var( 'orderby' ), 'relevance' ); ?>><?php esc_html_e( 'Most Relevant', 'sportlixa' ); ?></option>
				<option value="<?php echo esc_url( add_query_arg( [ 's' => $search_query, 'orderby' => 'date', 'order' => 'DESC' ], home_url( '/' ) ) ); ?>" <?php selected( get_query_var( 'orderby' ), 'date' ); ?>><?php esc_html_e( 'Newest First', 'sportlixa' ); ?></option>
				<option value="<?php echo esc_url( add_query_arg( [ 's' => $search_query, 'orderby' => 'comment_count', 'order' => 'DESC' ], home_url( '/' ) ) ); ?>" <?php selected( get_query_var( 'orderby' ), 'comment_count' ); ?>><?php esc_html_e( 'Most Discussed', 'sportlixa' ); ?></option>
			</select>
		</div>
	</div>

	<!-- ==========================================================================
	     MAIN SEARCH RESULTS LAYOUT (FEED + SIDEBAR)
	     ========================================================================== -->
	<div class="devnahian-sportlixa-search-layout">

		<!-- Left Column: Results List -->
		<section class="devnahian-sportlixa-results-feed" id="devnahian-sportlixa-resultsFeed" aria-label="<?php esc_attr_e( 'Search Results Feed', 'sportlixa' ); ?>">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();

					$post_cats = get_the_category();
					$badge_lbl = ! empty( $post_cats ) ? strtoupper( $post_cats[0]->name ) : __( 'NEWS', 'sportlixa' );
					$thumb_url = has_post_thumbnail() 
						? get_the_post_thumbnail_url( get_the_ID(), 'medium_large' ) 
						: $default_thumb;

					$raw_content = strip_tags( strip_shortcodes( get_the_content() ) );
					$read_time   = max( 1, (int) ceil( str_word_count( $raw_content ) / 200 ) );

					// Highlight searched term safely
					$raw_title   = esc_html( get_the_title() );
					$raw_excerpt = esc_html( wp_trim_words( get_the_excerpt(), 24 ) );

					if ( ! empty( trim( $search_query ) ) ) {
						$escaped_query       = preg_quote( trim( $search_query ), '/' );
						$highlighted_title   = preg_replace( '/(' . $escaped_query . ')/i', '<mark class="devnahian-sportlixa-highlight-term">$1</mark>', $raw_title );
						$highlighted_excerpt = preg_replace( '/(' . $escaped_query . ')/i', '<mark class="devnahian-sportlixa-highlight-term">$1</mark>', $raw_excerpt );
					} else {
						$highlighted_title   = $raw_title;
						$highlighted_excerpt = $raw_excerpt;
					}
					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'devnahian-sportlixa-result-card' ); ?> data-facet="articles">
						<div class="devnahian-sportlixa-result-thumb devnahian-sportlixa-img-box">
							<span class="devnahian-sportlixa-badge-tag devnahian-sportlixa-result-badge"><?php echo esc_html( $badge_lbl ); ?></span>
							<a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
								<img 
									src="<?php echo esc_url( $thumb_url ); ?>" 
									alt="<?php echo the_title_attribute( [ 'echo' => false ] ); ?>" 
									loading="lazy"
								>
							</a>
						</div>
						<div class="devnahian-sportlixa-result-content">
							<div>
								<h2 class="devnahian-sportlixa-result-title">
									<a href="<?php the_permalink(); ?>">
										<?php echo wp_kses( $highlighted_title, [ 'mark' => [ 'class' => [] ] ] ); ?>
									</a>
								</h2>
								<p class="devnahian-sportlixa-result-snippet">
									<?php echo wp_kses( $highlighted_excerpt, [ 'mark' => [ 'class' => [] ] ] ); ?>
								</p>
							</div>
							<div class="devnahian-sportlixa-result-footer">
								<span>
									<?php
									printf(
										/* translators: 1: author, 2: date, 3: minutes read */
										esc_html__( 'By %1$s • %2$s • %3$d min read', 'sportlixa' ),
										esc_html( get_the_author() ),
										esc_html( get_the_date() ),
										(int) $read_time
									);
									?>
								</span>
								<a href="<?php the_permalink(); ?>" class="devnahian-sportlixa-title-link"><?php esc_html_e( 'Read Full →', 'sportlixa' ); ?></a>
							</div>
						</div>
					</article>
					<?php
				endwhile;

				// Native accessible WordPress pagination
				the_posts_pagination( [
					'mid_size'  => 2,
					'prev_text' => esc_html__( '« Previous', 'sportlixa' ),
					'next_text' => esc_html__( 'Next »', 'sportlixa' ),
					'class'     => 'devnahian-sportlixa-pagination-wrap',
				] );

			else :
				?>
				<!-- No Results Found Card -->
				<div class="devnahian-sportlixa-no-results-card" style="background:var(--devnahian-sportlixa-bg-card); border:1px solid var(--devnahian-sportlixa-border-card); border-radius:var(--devnahian-sportlixa-radius-md); padding:40px 24px; text-align:center;">
					<span class="devnahian-sportlixa-badge-tag" style="background:var(--devnahian-sportlixa-orange-warn); color:#000000 !important; margin-bottom:12px;">
						<?php esc_html_e( 'PLAY INCOMPLETE', 'sportlixa' ); ?>
					</span>
					<h2 style="font-size:22px; font-weight:900; font-style:italic; text-transform:uppercase; margin-bottom:10px; color:var(--devnahian-sportlixa-text-white);">
						<?php esc_html_e( 'No Matches On The Tape', 'sportlixa' ); ?>
					</h2>
					<p style="font-size:14px; color:var(--devnahian-sportlixa-text-muted); max-width:520px; margin:0 auto 20px; line-height:1.6;">
						<?php printf( esc_html__( 'We could not locate any articles or match reports matching "%s". Try checking for typos or searching a broader term.', 'sportlixa' ), esc_html( $search_query ) ); ?>
					</p>
					<div style="display:flex; justify-content:center; gap:10px; flex-wrap:wrap;">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="devnahian-sportlixa-btn-primary" style="padding:10px 18px; font-size:12px;">
							<?php esc_html_e( 'Back to Home Field', 'sportlixa' ); ?>
						</a>
						<a href="<?php echo esc_url( home_url( '/#scores' ) ); ?>" class="devnahian-sportlixa-btn-secondary" style="padding:10px 18px; font-size:12px;">
							<?php esc_html_e( 'Live Score Center', 'sportlixa' ); ?>
						</a>
					</div>
				</div>
			<?php endif; ?>
		</section>

		<!-- Right Column: Sidebar Facet Filters & Trending -->
		<aside class="devnahian-sportlixa-search-sidebar" aria-label="<?php esc_attr_e( 'Search Filters Sidebar', 'sportlixa' ); ?>">

			<!-- Filter by League Facet -->
			<div class="devnahian-sportlixa-filter-card">
				<div class="devnahian-sportlixa-filter-title">
					<span><?php esc_html_e( 'Filter By League', 'sportlixa' ); ?></span>
					<a href="<?php echo esc_url( add_query_arg( 's', $search_query, home_url( '/' ) ) ); ?>" style="color:var(--devnahian-sportlixa-brand-volt-text); font-size:10px; font-weight:800; text-transform:uppercase;">
						<?php esc_html_e( 'Reset', 'sportlixa' ); ?>
					</a>
				</div>
				<ul class="devnahian-sportlixa-filter-list">
					<?php
					$leagues = get_categories( [ 'hide_empty' => true, 'number' => 6 ] );
					if ( ! is_wp_error( $leagues ) && ! empty( $leagues ) ) :
						foreach ( $leagues as $league ) :
							$league_search_url = add_query_arg( [
								's'   => $search_query,
								'cat' => $league->term_id,
							], home_url( '/' ) );
							$is_selected = ( (int) get_query_var( 'cat' ) === (int) $league->term_id );
							?>
							<li>
								<a href="<?php echo esc_url( $league_search_url ); ?>" class="devnahian-sportlixa-filter-option <?php echo $is_selected ? 'selected' : ''; ?>">
									<span><?php echo esc_html( $league->name ); ?></span>
									<span class="devnahian-sportlixa-count-pill"><?php echo (int) $league->count; ?></span>
								</a>
							</li>
							<?php
						endforeach;
					endif;
					?>
				</ul>
			</div>

			<!-- Trending Searches -->
			<div class="devnahian-sportlixa-filter-card">
				<div class="devnahian-sportlixa-filter-title">
					<span><?php esc_html_e( 'Popular Queries', 'sportlixa' ); ?></span>
				</div>
				<div class="devnahian-sportlixa-quick-tags-wrap" style="gap:6px;">
					<a href="<?php echo esc_url( home_url( '/?s=Chiefs+vs+Bills' ) ); ?>" class="devnahian-sportlixa-quick-tag">#ChiefsVsBills</a>
					<a href="<?php echo esc_url( home_url( '/?s=LeBron+James' ) ); ?>" class="devnahian-sportlixa-quick-tag">#LeBronStats</a>
					<a href="<?php echo esc_url( home_url( '/?s=Aaron+Judge' ) ); ?>" class="devnahian-sportlixa-quick-tag">#JudgePostseason</a>
					<a href="<?php echo esc_url( home_url( '/?s=Lionel+Messi' ) ); ?>" class="devnahian-sportlixa-quick-tag">#MessiMiami</a>
					<a href="<?php echo esc_url( home_url( '/?s=Injury+Report' ) ); ?>" class="devnahian-sportlixa-quick-tag">#InjuryWire</a>
				</div>
			</div>

		</aside>
	</div>
</main>

<style>
	.devnahian-sportlixa-highlight-term {
		background: rgba(200, 255, 0, 0.18);
		color: var(--devnahian-sportlixa-brand-volt-text);
		font-weight: 800;
		padding: 1px 3px;
		border-radius: 2px;
	}
	.devnahian-sportlixa-filter-card {
		background: var(--devnahian-sportlixa-bg-card);
		border: 1px solid var(--devnahian-sportlixa-border-card);
		border-radius: var(--devnahian-sportlixa-radius-md);
		padding: 20px;
		margin-bottom: 20px;
		box-shadow: var(--devnahian-sportlixa-shadow-card);
	}
	.devnahian-sportlixa-filter-title {
		display: flex;
		justify-content: space-between;
		align-items: center;
		font-size: 13px;
		font-weight: 800;
		color: var(--devnahian-sportlixa-text-white);
		text-transform: uppercase;
		margin-bottom: 14px;
		padding-bottom: 8px;
		border-bottom: 1px solid var(--devnahian-sportlixa-border-color);
	}
	.devnahian-sportlixa-filter-list {
		list-style: none;
		padding: 0;
		margin: 0;
		display: flex;
		flex-direction: column;
		gap: 6px;
	}
	.devnahian-sportlixa-filter-option {
		display: flex;
		justify-content: space-between;
		align-items: center;
		padding: 8px 12px;
		border-radius: var(--devnahian-sportlixa-radius-sm);
		background: var(--devnahian-sportlixa-bg-input);
		border: 1px solid var(--devnahian-sportlixa-border-card);
		color: var(--devnahian-sportlixa-text-muted);
		font-size: 12px;
		font-weight: 700;
		text-decoration: none;
		transition: all var(--devnahian-sportlixa-transition-fast);
	}
	.devnahian-sportlixa-filter-option:hover,
	.devnahian-sportlixa-filter-option.selected {
		background: var(--devnahian-sportlixa-brand-volt);
		color: #000000;
		border-color: var(--devnahian-sportlixa-brand-volt);
	}
	.devnahian-sportlixa-count-pill {
		font-size: 10px;
		font-weight: 900;
		background: rgba(0, 0, 0, 0.2);
		padding: 2px 6px;
		border-radius: 10px;
	}
</style>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		const searchInput = document.getElementById('devnahian-sportlixa-pageSearchInput');
		const clearBtn    = document.getElementById('devnahian-sportlixa-searchClearBtn');
		const sortSelect  = document.getElementById('devnahian-sportlixa-sortSelect');

		if (clearBtn && searchInput) {
			clearBtn.addEventListener('click', function() {
				searchInput.value = '';
				searchInput.focus();
			});
		}

		if (sortSelect) {
			sortSelect.addEventListener('change', function() {
				if (this.value) {
					window.location.href = this.value;
				}
			});
		}
	});
</script>

<?php get_footer(); ?>