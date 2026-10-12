<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package Sportlixa
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header(); ?>

	<main class="devnahian-sportlixa-container" id="primary" role="main">
		<!-- ==========================================================================
		     404 ERROR HERO (PUNCHY SPORTS THEME)
		     ========================================================================== -->
		<section class="devnahian-sportlixa-404-hero">
			<div class="devnahian-sportlixa-whistle-badge">
				<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true" focusable="false"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
				<span><?php esc_html_e( 'Whistle Blown • Penalty on the Play', 'sportlixa' ); ?></span>
			</div>

			<div class="devnahian-sportlixa-404-glitch-number" aria-hidden="true">404</div>

			<h1 class="devnahian-sportlixa-404-title"><?php esc_html_e( 'Out of Bounds • Play Under Review', 'sportlixa' ); ?></h1>
			<p class="devnahian-sportlixa-404-subtitle">
				<?php esc_html_e( 'The play you called was intercepted, ruled incomplete by the referees, or traded to another division. Check your playbook or run a quick audible below.', 'sportlixa' ); ?>
			</p>

			<!-- In-Page Fast WordPress Search Box -->
			<form role="search" method="get" class="devnahian-sportlixa-404-search-box" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<svg class="devnahian-sportlixa-404-search-icon" viewBox="0 0 24 24" fill="none" stroke-width="2.5" aria-hidden="true" focusable="false"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
				<input 
					type="search" 
					name="s" 
					class="devnahian-sportlixa-404-search-input" 
					id="devnahian-sportlixa-recoveryInput" 
					placeholder="<?php esc_attr_e( 'Search teams, players, scores, or news...', 'sportlixa' ); ?>" 
					value="<?php echo get_search_query(); ?>" 
					required
				>
				<button type="submit" class="devnahian-sportlixa-404-search-btn"><?php esc_html_e( 'Search', 'sportlixa' ); ?></button>
			</form>

			<!-- Primary Recovery Action Buttons -->
			<div class="devnahian-sportlixa-404-actions-row">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="devnahian-sportlixa-btn-primary">
					<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true" focusable="false"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
					<?php esc_html_e( 'Return to Home Field', 'sportlixa' ); ?>
				</a>
				<a href="<?php echo esc_url( home_url( '/#scores' ) ); ?>" class="devnahian-sportlixa-btn-secondary">
					<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true" focusable="false"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
					<?php esc_html_e( 'Check Live Scores', 'sportlixa' ); ?>
				</a>
				<?php
				$nfl_category = get_category_by_slug( 'nfl' );
				$nfl_link     = ( ! empty( $nfl_category ) && ! is_wp_error( $nfl_category ) ) ? get_category_link( $nfl_category->term_id ) : home_url( '/#nfl' );
				?>
				<a href="<?php echo esc_url( $nfl_link ); ?>" class="devnahian-sportlixa-btn-secondary">
					<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true" focusable="false"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
					<?php esc_html_e( 'Explore NFL Hub', 'sportlixa' ); ?>
				</a>
			</div>

			<!-- Suggested Popular Articles (Dynamic 3 Equal Width Columns) -->
			<section class="devnahian-sportlixa-recovery-section" aria-label="<?php esc_attr_e( 'Popular Stories', 'sportlixa' ); ?>">
				<div class="devnahian-sportlixa-section-title">
					<div class="devnahian-sportlixa-title-left"><?php esc_html_e( 'POPULAR PLAYS RIGHT NOW', 'sportlixa' ); ?></div>
					<?php
					$posts_page_id    = get_option( 'page_for_posts' );
					$all_stories_link = ( ! empty( $posts_page_id ) ) ? get_permalink( $posts_page_id ) : home_url( '/' );
					?>
					<a href="<?php echo esc_url( $all_stories_link ); ?>" class="devnahian-sportlixa-title-link">
						<?php esc_html_e( 'View all stories →', 'sportlixa' ); ?>
					</a>
				</div>

				<div class="devnahian-sportlixa-recovery-grid">
					<?php
					$popular_recovery_query = new WP_Query( [
						'posts_per_page'      => 3,
						'orderby'             => 'comment_count',
						'order'               => 'DESC',
						'post_status'         => 'publish',
						'ignore_sticky_posts' => 1,
						'no_found_rows'       => true,
					] );

					if ( $popular_recovery_query->have_posts() ) :
						while ( $popular_recovery_query->have_posts() ) :
							$popular_recovery_query->the_post();

							$categories = get_the_category();
							$cat_badge  = ( ! empty( $categories ) && isset( $categories[0]->name ) ) ? strtoupper( $categories[0]->name ) : __( 'SPORTS', 'sportlixa' );

							$default_placeholder = get_template_directory_uri() . '/assets/img/placeholder.jpg';
							$thumb_url           = has_post_thumbnail() 
								? get_the_post_thumbnail_url( get_the_ID(), 'medium_large' ) 
								: $default_placeholder;

							$raw_content = strip_tags( strip_shortcodes( get_the_content() ) );
							$word_count  = str_word_count( $raw_content );
							$read_time   = max( 1, (int) ceil( $word_count / 200 ) );
							?>
							<article class="devnahian-sportlixa-recovery-card">
								<div class="devnahian-sportlixa-recovery-thumb devnahian-sportlixa-img-box">
									<span class="devnahian-sportlixa-badge-tag devnahian-sportlixa-recovery-badge">
										<?php echo esc_html( $cat_badge ); ?>
									</span>
									<a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
										<img 
											src="<?php echo esc_url( $thumb_url ); ?>" 
											alt="<?php echo esc_attr( get_the_title() ); ?>" 
											loading="lazy"
										>
									</a>
								</div>
								<div class="devnahian-sportlixa-recovery-content">
									<h3 class="devnahian-sportlixa-recovery-headline">
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
			</section>

		</section>
	</main>

<?php get_footer(); ?>