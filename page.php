<?php
/**
 * The universal template for displaying all single pages (page.php)
 *
 * Serves as the standard template for generic pages, legal documents,
 * documentation, and editorial policies across the Sportlixa theme.
 *
 * @package Sportlixa
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();

	// Determine category or badge label
	$ancestors   = get_post_ancestors( get_the_ID() );
	$parent_id   = ! empty( $ancestors ) ? end( $ancestors ) : null;
	$badge_label = $parent_id ? get_the_title( $parent_id ) : __( 'Official Document', 'sportlixa' );
	?>

	<!-- ==========================================================================
	     PAGE STRUCTURE
	     ========================================================================== -->
	<main class="sportlixa-page-wrapper" id="primary" role="main">

		<!-- PAGE HERO & STATIC BREADCRUMBS -->
		<header class="sportlixa-hero-banner">
			<div class="devnahian-sportlixa-container">
				
				<nav class="devnahian-sportlixa-breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'sportlixa' ); ?>">
					<ol class="sportlixa-breadcrumbs-list">
						<li>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'sportlixa' ); ?></a>
						</li>
						<li class="sportlixa-breadcrumbs-separator" aria-hidden="true">/</li>
						<?php
						if ( ! empty( $ancestors ) ) :
							foreach ( array_reverse( $ancestors ) as $ancestor_id ) :
								?>
								<li>
									<a href="<?php echo esc_url( get_permalink( $ancestor_id ) ); ?>">
										<?php echo esc_html( get_the_title( $ancestor_id ) ); ?>
									</a>
								</li>
								<li class="sportlixa-breadcrumbs-separator" aria-hidden="true">/</li>
								<?php
							endforeach;
						endif;
						?>
						<li class="sportlixa-breadcrumbs-current" aria-current="page">
							<?php the_title(); ?>
						</li>
					</ol>
				</nav>

				<span class="devnahian-sportlixa-badge-tag"><?php echo esc_html( $badge_label ); ?></span>

				<h1 class="sportlixa-page-title"><?php the_title(); ?></h1>

				<?php if ( has_excerpt() ) : ?>
					<p class="sportlixa-page-excerpt">
						<?php echo esc_html( get_the_excerpt() ); ?>
					</p>
				<?php endif; ?>

				<div class="sportlixa-compliance-row" aria-label="<?php esc_attr_e( 'Page Badges', 'sportlixa' ); ?>">
					<div class="sportlixa-compliance-chip">
						<svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2a10 10 0 1 0 10 10 4 4 0 0 1-5-5z"/><circle cx="8.5" cy="8.5" r="1.5"/><circle cx="12" cy="15" r="1"/><circle cx="16" cy="11" r="1"/></svg>
						<span><?php esc_html_e( 'Verified Sports Telemetry', 'sportlixa' ); ?></span>
					</div>

					<div class="sportlixa-compliance-chip">
						<svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
						<time datetime="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>">
							<?php
							printf(
								/* translators: %s: modified date */
								esc_html__( 'Last Updated: %s', 'sportlixa' ),
								esc_html( get_the_modified_date( 'F j, Y' ) )
							);
							?>
						</time>
					</div>

					<div class="sportlixa-compliance-chip">
						<svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
						<span><?php esc_html_e( 'Zero Third-Party Ad Trackers', 'sportlixa' ); ?></span>
					</div>
				</div>

			</div>
		</header>

		<!-- CONTENT GRID -->
		<div class="devnahian-sportlixa-container">
			<div class="sportlixa-content-layout">

				<!-- Left Column: Normal Flow Dynamic TOC Sidebar -->
				<aside class="sportlixa-sidebar" id="devnahian-sportlixa-sidebarCol" aria-label="<?php esc_attr_e( 'Table of Contents', 'sportlixa' ); ?>">
					<div class="sportlixa-toc-card" id="devnahian-sportlixa-tocCard">
						<div class="sportlixa-toc-header">
							<svg aria-hidden="true" focusable="false" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
							<span><?php esc_html_e( 'Contents', 'sportlixa' ); ?></span>
						</div>
						<nav aria-label="<?php esc_attr_e( 'In-page navigation', 'sportlixa' ); ?>">
							<ul class="sportlixa-toc-list" id="devnahian-sportlixa-tocList">
								<!-- Populated automatically by assets/js/main.js -->
							</ul>
						</nav>
					</div>
				</aside>

				<!-- Right Column: Page Content -->
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'sportlixa-main-article entry-content devnahian-sportlixa-editorial-body' ); ?>>
					
					<?php if ( has_post_thumbnail() ) : ?>
						<figure class="sportlixa-featured-media">
							<?php the_post_thumbnail( 'full', [ 'class' => 'sportlixa-featured-img' ] ); ?>
						</figure>
					<?php endif; ?>

					<div class="sportlixa-prose-content" id="devnahian-sportlixa-pageContent">
						<?php
						the_content();

						wp_link_pages( [
							'before' => '<nav class="page-links" aria-label="' . esc_attr__( 'Page pagination', 'sportlixa' ) . '">' . esc_html__( 'Pages:', 'sportlixa' ),
							'after'  => '</nav>',
						] );
						?>
					</div>

					<?php
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
					?>

				</article>

			</div>
		</div>

	</main>

	<!-- ==========================================================================
	     EMBEDDED SCOPED STYLES
	     ========================================================================== -->
	<style>
		.sportlixa-page-wrapper {
			background-color: var(--devnahian-sportlixa-bg-body, #0d121c);
			color: var(--devnahian-sportlixa-text-light, #e5ebf5);
			min-height: 100vh;
			position: static;
		}

		/* Standard Hero Banner - Static Flow */
		.sportlixa-hero-banner {
			position: static;
			padding: 3rem 0 2rem;
			border-bottom: 1px solid var(--devnahian-sportlixa-border-color, #1a2538);
			background: radial-gradient(circle at 10% 10%, var(--devnahian-sportlixa-brand-volt-subtle, rgba(200, 255, 0, 0.05)) 0%, transparent 45%);
		}

		/* Breadcrumbs */
		.sportlixa-breadcrumbs-list {
			display: flex;
			flex-wrap: wrap;
			align-items: center;
			gap: 0.5rem;
			list-style: none;
			padding: 0;
			margin: 0;
			font-size: 0.85rem;
		}

		.sportlixa-breadcrumbs-list a {
			color: var(--devnahian-sportlixa-text-dim, #64758b);
			text-decoration: none;
			transition: color var(--devnahian-sportlixa-transition-fast, 0.2s ease);
		}

		.sportlixa-breadcrumbs-list a:hover {
			color: var(--devnahian-sportlixa-brand-volt, #c8ff00);
		}

		.sportlixa-breadcrumbs-separator {
			color: var(--devnahian-sportlixa-border-card, #1e2a3f);
			user-select: none;
		}

		.sportlixa-breadcrumbs-current {
			color: var(--devnahian-sportlixa-text-white, #ffffff);
			font-weight: 700;
		}

		.sportlixa-page-title {
			font-size: clamp(2rem, 3.5vw, 2.75rem);
			font-weight: 900;
			font-style: italic;
			line-height: 1.15;
			letter-spacing: -0.025em;
			margin: 0.75rem 0 1rem;
			color: var(--devnahian-sportlixa-text-white, #ffffff);
		}

		.sportlixa-page-excerpt {
			font-size: 1.1rem;
			line-height: 1.6;
			color: var(--devnahian-sportlixa-text-muted, #95a5b8);
			max-width: 780px;
			margin: 0 0 1.5rem;
		}

		/* Compliance Strip */
		.sportlixa-compliance-row {
			display: flex;
			flex-wrap: wrap;
			gap: 0.75rem;
			margin-top: 1.5rem;
		}

		.sportlixa-compliance-chip {
			display: inline-flex;
			align-items: center;
			gap: 0.5rem;
			font-size: 0.8rem;
			font-weight: 600;
			color: var(--devnahian-sportlixa-text-muted, #95a5b8);
			background: var(--devnahian-sportlixa-bg-input, #151e2e);
			border: 1px solid var(--devnahian-sportlixa-border-card, #1e2a3f);
			padding: 0.35rem 0.85rem;
			border-radius: 9999px;
		}

		.sportlixa-compliance-chip svg {
			width: 14px;
			height: 14px;
			stroke: var(--devnahian-sportlixa-brand-volt, #c8ff00);
			flex-shrink: 0;
		}

		/* Grid Layout */
		.sportlixa-content-layout {
			display: grid;
			grid-template-columns: 280px 1fr;
			gap: 3.5rem;
			padding: 3rem 0;
			align-items: start;
		}

		.sportlixa-content-layout.no-sidebar {
			grid-template-columns: 1fr;
			max-width: 860px;
			margin-inline: auto;
		}

		/* Static TOC Sidebar */
		.sportlixa-sidebar {
			position: static;
		}

		.sportlixa-toc-card {
			position: static;
			background: var(--devnahian-sportlixa-bg-card, #121926);
			border: 1px solid var(--devnahian-sportlixa-border-card, #1e2a3f);
			border-radius: var(--devnahian-sportlixa-radius-md, 10px);
			padding: 1.25rem;
			box-shadow: var(--devnahian-sportlixa-shadow-card, 0 4px 20px rgba(0, 0, 0, 0.28));
		}

		.sportlixa-toc-header {
			display: flex;
			align-items: center;
			gap: 0.5rem;
			font-size: 0.8rem;
			font-weight: 800;
			letter-spacing: 0.05em;
			text-transform: uppercase;
			color: var(--devnahian-sportlixa-text-white, #ffffff);
			margin-bottom: 1rem;
			padding-bottom: 0.75rem;
			border-bottom: 1px solid var(--devnahian-sportlixa-border-card, #1e2a3f);
		}

		.sportlixa-toc-header svg {
			stroke: var(--devnahian-sportlixa-brand-volt, #c8ff00);
		}

		.sportlixa-toc-list {
			list-style: none;
			padding: 0;
			margin: 0;
			display: flex;
			flex-direction: column;
			gap: 0.5rem;
			font-size: 0.875rem;
		}

		.sportlixa-toc-list a {
			color: var(--devnahian-sportlixa-text-muted, #95a5b8);
			text-decoration: none;
			line-height: 1.4;
			display: block;
			transition: all var(--devnahian-sportlixa-transition-fast, 0.2s ease);
		}

		.sportlixa-toc-list a:hover,
		.sportlixa-toc-list a.active {
			color: var(--devnahian-sportlixa-brand-volt, #c8ff00);
			transform: translateX(3px);
		}

		/* Featured Image */
		.sportlixa-featured-media {
			margin: 0 0 2rem;
			border-radius: var(--devnahian-sportlixa-radius-md, 10px);
			overflow: hidden;
			border: 1px solid var(--devnahian-sportlixa-border-card, #1e2a3f);
		}

		.sportlixa-featured-img {
			width: 100%;
			height: auto;
			display: block;
			object-fit: cover;
		}

		/* Prose / Body Content */
		.sportlixa-prose-content {
			color: var(--devnahian-sportlixa-text-light, #e5ebf5);
			line-height: 1.75;
			font-size: 1.05rem;
		}

		/* Pagination */
		.page-links {
			margin-top: 2.5rem;
			padding-top: 1.5rem;
			border-top: 1px solid var(--devnahian-sportlixa-border-card, #1e2a3f);
			display: flex;
			gap: 0.5rem;
			align-items: center;
			font-size: 0.9rem;
		}

		.page-links .post-page-numbers {
			padding: 0.35rem 0.75rem;
			border-radius: var(--devnahian-sportlixa-radius-sm, 6px);
			background: var(--devnahian-sportlixa-bg-input, #151e2e);
			border: 1px solid var(--devnahian-sportlixa-border-card, #1e2a3f);
			color: var(--devnahian-sportlixa-text-muted, #95a5b8);
			text-decoration: none;
		}

		.page-links .post-page-numbers.current {
			background: var(--devnahian-sportlixa-brand-volt, #c8ff00);
			color: #000000;
			font-weight: 800;
			border-color: var(--devnahian-sportlixa-brand-volt, #c8ff00);
		}

		/* Responsive Breakdown */
		@media (max-width: 991px) {
			.sportlixa-content-layout {
				grid-template-columns: 1fr;
				gap: 2rem;
			}

			.sportlixa-sidebar {
				order: -1;
			}
		}
	</style>

	<?php
endwhile;

get_footer();