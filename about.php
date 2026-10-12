<?php
/**
 * Template Name: About Page Template
 *
 * The template for displaying the custom Sportlixa About Us company page.
 *
 * @package Sportlixa
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header(); ?>

	<main class="devnahian-sportlixa-container" id="primary" role="main">
		<!-- ==========================================================================
		     ABOUT US HERO & BREADCRUMBS
		     ========================================================================== -->
		<section class="devnahian-sportlixa-about-hero">
			<nav class="devnahian-sportlixa-breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'sportlixa' ); ?>">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'sportlixa' ); ?></a>
				<span aria-hidden="true">/</span>
				<span><?php esc_html_e( 'Company', 'sportlixa' ); ?></span>
				<span aria-hidden="true">/</span>
				<span aria-current="page"><?php the_title(); ?></span>
			</nav>

			<span class="devnahian-sportlixa-badge-tag"><?php esc_html_e( 'THE DEFINITIVE NEWSROOM', 'sportlixa' ); ?></span>
			<h1 class="devnahian-sportlixa-about-heading">
				<?php
				$about_title = get_the_title();
				echo esc_html( ! empty( $about_title ) ? $about_title : __( 'Your Sports. Your Game. Your Edge.', 'sportlixa' ) );
				?>
			</h1>
			<p class="devnahian-sportlixa-about-subtext">
				<?php
				if ( has_excerpt() ) {
					echo esc_html( get_the_excerpt() );
				} else {
					esc_html_e( 'SportLixa was engineered from the turf up to kill sports noise. We combine low-latency telemetry feeds, film-study journalism, and unbiased statistical modeling to give die-hard fans and bettors an undeniable analytical advantage.', 'sportlixa' );
				}
				?>
			</p>
		</section>

		<!-- ==========================================================================
		     KEY NUMBERS & METRICS STRIP
		     ========================================================================== -->
		<section class="devnahian-sportlixa-metrics-grid" aria-label="<?php esc_attr_e( 'Key Performance Metrics', 'sportlixa' ); ?>">
			<div class="devnahian-sportlixa-metric-card">
				<div class="devnahian-sportlixa-metric-num">2.4M+</div>
				<div class="devnahian-sportlixa-metric-label"><?php esc_html_e( 'Monthly Active Fans', 'sportlixa' ); ?></div>
				<div class="devnahian-sportlixa-metric-sub"><?php esc_html_e( 'Across 42 countries worldwide', 'sportlixa' ); ?></div>
			</div>
			<div class="devnahian-sportlixa-metric-card">
				<div class="devnahian-sportlixa-metric-num">0.28s</div>
				<div class="devnahian-sportlixa-metric-label"><?php esc_html_e( 'Feed Telemetry Latency', 'sportlixa' ); ?></div>
				<div class="devnahian-sportlixa-metric-sub"><?php esc_html_e( 'Direct official league wire relays', 'sportlixa' ); ?></div>
			</div>
			<div class="devnahian-sportlixa-metric-card">
				<div class="devnahian-sportlixa-metric-num">35+</div>
				<div class="devnahian-sportlixa-metric-label"><?php esc_html_e( 'Scouts & Analysts', 'sportlixa' ); ?></div>
				<div class="devnahian-sportlixa-metric-sub"><?php esc_html_e( 'Covering NFL, NBA, MLB & UCL', 'sportlixa' ); ?></div>
			</div>
			<div class="devnahian-sportlixa-metric-card">
				<div class="devnahian-sportlixa-metric-num">99.9%</div>
				<div class="devnahian-sportlixa-metric-label"><?php esc_html_e( 'Gameday Uptime', 'sportlixa' ); ?></div>
				<div class="devnahian-sportlixa-metric-sub"><?php esc_html_e( 'Zero-downtime playoff architecture', 'sportlixa' ); ?></div>
			</div>
		</section>

		<!-- ==========================================================================
		     MISSION & VISION SPLIT (WITH WP CONTENT SUPPORT)
		     ========================================================================== -->
		<section class="devnahian-sportlixa-mission-grid">
			<div class="devnahian-sportlixa-mission-card">
				<div>
					<span class="devnahian-sportlixa-badge-tag"><?php esc_html_e( 'ORIGIN & PURPOSE', 'sportlixa' ); ?></span>
					<h2><?php esc_html_e( 'Built for the Fan Who Demands the Film, Not the Fluff', 'sportlixa' ); ?></h2>
					
					<?php
					if ( have_posts() ) :
						while ( have_posts() ) :
							the_post();
							if ( get_the_content() ) :
								?>
								<div class="devnahian-sportlixa-editorial-body">
									<?php the_content(); ?>
								</div>
								<?php
							else :
								?>
								<p>
									<?php esc_html_e( 'Sports media has devolved into talking-head debate theater and clickbait trade speculation. SportLixa was founded by former collegiate scouts, data engineers, and investigative sports journalists who wanted something better: clean, immediate, high-density sports intelligence.', 'sportlixa' ); ?>
								</p>
								<p>
									<?php esc_html_e( "Whether it's dissecting defensive front adjustments, verifying real-time recovery timetables on our injury wire, or tracking drive charts with sub-second accuracy, SportLixa exists to inform your passion with uncompromising precision.", 'sportlixa' ); ?>
								</p>
								<?php
							endif;
						endwhile;
					endif;
					?>
				</div>
				<div class="devnahian-sportlixa-lead-quote">
					<?php esc_html_e( '"We don\'t tell you who to root for. We give you the data, the tape, and the breakdown so you understand why the game was won."', 'sportlixa' ); ?>
				</div>
			</div>

			<div class="devnahian-sportlixa-mission-image-card">
				<?php
				if ( has_post_thumbnail() ) {
					the_post_thumbnail( 'full', [
						'alt'     => the_title_attribute( [ 'echo' => false ] ),
						'loading' => 'lazy',
					] );
				} else {
					$default_mission_img = get_theme_file_uri( '/assets/img/mission-default.jpg' );
					?>
					<img 
						src="<?php echo esc_url( $default_mission_img ); ?>" 
						alt="<?php esc_attr_e( 'Field-Level Perspective', 'sportlixa' ); ?>"
						loading="lazy"
					>
				<?php } ?>
				<div class="devnahian-sportlixa-mission-overlay-badge">
					<?php esc_html_e( 'Field-Level Perspective • Highmark Stadium', 'sportlixa' ); ?>
				</div>
			</div>
		</section>

		<!-- ==========================================================================
		     FOUR PILLARS OF OUR EDGE
		     ========================================================================== -->
		<section class="devnahian-sportlixa-pillars-section">
			<div class="devnahian-sportlixa-section-title">
				<div class="devnahian-sportlixa-title-left"><?php esc_html_e( 'THE FOUR PILLARS OF OUR EDGE', 'sportlixa' ); ?></div>
			</div>

			<div class="devnahian-sportlixa-pillars-grid">
				<div class="devnahian-sportlixa-pillar-card">
					<div class="devnahian-sportlixa-pillar-icon" aria-hidden="true">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" focusable="false"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
					</div>
					<h3 class="devnahian-sportlixa-pillar-title"><?php esc_html_e( 'Sub-Second Telemetry', 'sportlixa' ); ?></h3>
					<p class="devnahian-sportlixa-pillar-desc">
						<?php esc_html_e( 'Direct high-frequency API ingestion pipelines ensure every touchdown, buzzer-beater, and strikeout reaches your screen ahead of the television broadcast.', 'sportlixa' ); ?>
					</p>
				</div>

				<div class="devnahian-sportlixa-pillar-card">
					<div class="devnahian-sportlixa-pillar-icon" aria-hidden="true">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" focusable="false"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
					</div>
					<h3 class="devnahian-sportlixa-pillar-title"><?php esc_html_e( 'All-22 Film Breakdown', 'sportlixa' ); ?></h3>
					<p class="devnahian-sportlixa-pillar-desc">
						<?php esc_html_e( "We don't skim box scores. Our staff studies the coaches' tape, defensive front adjustments, EPA per dropback, and pre-snap motions that dictate real football.", 'sportlixa' ); ?>
					</p>
				</div>

				<div class="devnahian-sportlixa-pillar-card">
					<div class="devnahian-sportlixa-pillar-icon" aria-hidden="true">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" focusable="false"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
					</div>
					<h3 class="devnahian-sportlixa-pillar-title"><?php esc_html_e( 'Verified Injury Wire', 'sportlixa' ); ?></h3>
					<p class="devnahian-sportlixa-pillar-desc">
						<?php esc_html_e( 'Direct clinical medical reviews cross-referenced with team walkthrough reports to provide genuine fantasy analysis and waiver wire intelligence.', 'sportlixa' ); ?>
					</p>
				</div>

				<div class="devnahian-sportlixa-pillar-card">
					<div class="devnahian-sportlixa-pillar-icon" aria-hidden="true">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" focusable="false"><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>
					</div>
					<h3 class="devnahian-sportlixa-pillar-title"><?php esc_html_e( 'Zero Ad-Tech Tracking', 'sportlixa' ); ?></h3>
					<p class="devnahian-sportlixa-pillar-desc">
						<?php esc_html_e( 'No popup takeovers, no auto-playing loud video ads, and no behavioral ad tracker networks. A pure, dark-mode athletic sanctuary built for fans.', 'sportlixa' ); ?>
					</p>
				</div>
			</div>
		</section>

		<!-- ==========================================================================
		     EDITORIAL LEADERSHIP & SCOUTING ROSTER (Dynamic WP Authors Query)
		     ========================================================================== -->
		<section class="devnahian-sportlixa-team-section">
			<div class="devnahian-sportlixa-section-title">
				<div class="devnahian-sportlixa-title-left"><?php esc_html_e( 'EDITORIAL LEADERSHIP & FILM SCOUTS', 'sportlixa' ); ?></div>
			</div>

			<div class="devnahian-sportlixa-team-grid">
				<?php
				$team_members = get_users( [
					'role__in' => [ 'administrator', 'editor', 'author' ],
					'number'   => 4,
					'orderby'  => 'post_count',
					'order'    => 'DESC',
				] );

				if ( ! empty( $team_members ) ) :
					foreach ( $team_members as $member ) :
						$member_id   = $member->ID;
						$member_name = $member->display_name;
						$member_bio  = get_the_author_meta( 'description', $member_id );
						$roles       = (array) $member->roles;
						$primary_role = ! empty( $roles ) ? ucfirst( $roles[0] ) : __( 'Analyst', 'sportlixa' );
						?>
						<div class="devnahian-sportlixa-team-card">
							<div class="devnahian-sportlixa-team-thumb devnahian-sportlixa-img-box">
								<?php echo get_avatar( $member_id, 300, '', esc_attr( $member_name ) ); ?>
							</div>
							<div class="devnahian-sportlixa-team-info">
								<span class="devnahian-sportlixa-team-role">
									<?php echo esc_html( $primary_role ); ?>
								</span>
								<div class="devnahian-sportlixa-team-name">
									<a href="<?php echo esc_url( get_author_posts_url( $member_id ) ); ?>">
										<?php echo esc_html( $member_name ); ?>
									</a>
								</div>
								<p class="devnahian-sportlixa-team-bio">
									<?php
									echo esc_html( ! empty( $member_bio ) ? $member_bio : __( 'Senior analyst and sports breakdown contributor at SportLixa.', 'sportlixa' ) );
									?>
								</p>
							</div>
						</div>
						<?php
					endforeach;
				else :
					$placeholder_avatar = get_theme_file_uri( '/assets/img/author-default.png' );
					?>
					<div class="devnahian-sportlixa-team-card">
						<div class="devnahian-sportlixa-team-thumb devnahian-sportlixa-img-box">
							<img src="<?php echo esc_url( $placeholder_avatar ); ?>" alt="<?php esc_attr_e( 'Senior Scout', 'sportlixa' ); ?>">
						</div>
						<div class="devnahian-sportlixa-team-info">
							<span class="devnahian-sportlixa-team-role"><?php esc_html_e( 'Film Analyst', 'sportlixa' ); ?></span>
							<div class="devnahian-sportlixa-team-name"><?php esc_html_e( 'Sportlixa Staff Scout', 'sportlixa' ); ?></div>
							<p class="devnahian-sportlixa-team-bio"><?php esc_html_e( 'Covering defensive schemes, live metrics, and real-time wire analytics.', 'sportlixa' ); ?></p>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</section>

		<!-- ==========================================================================
		     CALL TO ACTION BANNER
		     ========================================================================== -->
		<section class="devnahian-sportlixa-cta-banner">
			<div class="devnahian-sportlixa-cta-content">
				<span class="devnahian-sportlixa-badge-tag">
					<?php esc_html_e( 'JOIN THE HUD', 'sportlixa' ); ?>
				</span>
				<h2 class="devnahian-sportlixa-cta-title">
					<?php esc_html_e( 'Never Miss a Snap, Buzzer-Beater, or Injury Wire', 'sportlixa' ); ?>
				</h2>
				<p class="devnahian-sportlixa-cta-desc">
					<?php esc_html_e( 'Get real-time scoring updates, film study breakdowns, and verified medical news delivered straight to your inbox every morning at 7:00 AM ET.', 'sportlixa' ); ?>
				</p>
			</div>

			<div class="devnahian-sportlixa-cta-actions">
				<?php
				$nfl_cat  = get_category_by_slug( 'nfl' );
				$nfl_url  = ( ! empty( $nfl_cat ) && ! is_wp_error( $nfl_cat ) ) ? get_category_link( $nfl_cat->term_id ) : home_url( '/#nfl' );

				$contact_post = get_page_by_path( 'contact' );
				$contact_url  = ( $contact_post instanceof WP_Post ) ? get_permalink( $contact_post->ID ) : home_url( '/contact/' );
				?>
				<a href="<?php echo esc_url( $nfl_url ); ?>" class="devnahian-sportlixa-btn-cta-primary">
					<?php esc_html_e( 'Explore NFL Hub →', 'sportlixa' ); ?>
				</a>
				<a href="<?php echo esc_url( $contact_url ); ?>" class="devnahian-sportlixa-btn-cta-secondary">
					<?php esc_html_e( 'Contact Newsroom', 'sportlixa' ); ?>
				</a>
			</div>
		</section>
	</main>

<?php get_footer(); ?>