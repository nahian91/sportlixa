<?php
/**
 * The template for displaying all single posts
 *
 * @package Sportlixa
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$default_placeholder = get_theme_file_uri( '/assets/img/placeholder.jpg' );

while ( have_posts() ) :
	the_post();

	// Calculate dynamic reading time
	$raw_content = strip_tags( strip_shortcodes( get_the_content() ) );
	$post_words  = str_word_count( $raw_content );
	$read_time   = max( 1, (int) ceil( $post_words / 200 ) );

	// Category data
	$categories  = get_the_category();
	$primary_cat = ! empty( $categories ) ? $categories[0] : null;

	// Featured image & author data
	$thumb_id      = get_post_thumbnail_id();
	$thumb_caption = wp_get_attachment_caption( $thumb_id );
	$thumb_alt     = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );
	$author_id     = get_the_author_meta( 'ID' );
	$author_bio    = get_the_author_meta( 'description' );

	// Social share data
	$share_url   = rawurlencode( get_permalink() );
	$share_title = rawurlencode( html_entity_decode( get_the_title(), ENT_QUOTES, 'UTF-8' ) );
	?>

	<!-- ==========================================================================
	     EMBEDDED SCOPED SOCIAL SHARE STYLES
	     ========================================================================== -->
	<style>
		.devnahian-sportlixa-share-bar {
			display: flex;
			align-items: center;
			gap: 0.5rem;
			flex-wrap: wrap;
		}

		.devnahian-sportlixa-share-label {
			font-size: 0.75rem;
			font-weight: 800;
			text-transform: uppercase;
			letter-spacing: 0.06em;
			color: var(--devnahian-sportlixa-text-dim, #64758b);
			margin-right: 0.25rem;
		}

		.devnahian-sportlixa-share-btn {
			width: 38px;
			height: 38px;
			border-radius: var(--devnahian-sportlixa-radius-sm, 6px);
			display: inline-flex;
			align-items: center;
			justify-content: center;
			background: var(--devnahian-sportlixa-bg-input, #151e2e);
			border: 1px solid var(--devnahian-sportlixa-border-card, #1e2a3f);
			color: var(--devnahian-sportlixa-text-muted, #95a5b8);
			text-decoration: none;
			cursor: pointer;
			padding: 0;
			transition: all var(--devnahian-sportlixa-transition-fast, 0.2s ease);
			flex-shrink: 0;
		}

		.devnahian-sportlixa-share-btn svg {
			display: block;
			transition: transform 0.2s ease;
		}

		.devnahian-sportlixa-share-btn:hover {
			transform: translateY(-2px);
		}

		.devnahian-sportlixa-share-btn:hover svg {
			transform: scale(1.1);
		}

		/* Platform Hover Palette */
		.devnahian-sportlixa-share-btn.share-x:hover {
			background: #000000;
			color: #ffffff;
			border-color: rgba(255, 255, 255, 0.3);
		}

		.devnahian-sportlixa-share-btn.share-fb:hover {
			background: #1877f2;
			color: #ffffff;
			border-color: #1877f2;
		}

		.devnahian-sportlixa-share-btn.share-wa:hover {
			background: #25d366;
			color: #ffffff;
			border-color: #25d366;
		}

		.devnahian-sportlixa-share-btn.share-in:hover {
			background: #0a66c2;
			color: #ffffff;
			border-color: #0a66c2;
		}

		.devnahian-sportlixa-share-btn.share-copy:hover {
			background: rgba(200, 255, 0, 0.12);
			color: var(--devnahian-sportlixa-brand-volt, #c8ff00);
			border-color: var(--devnahian-sportlixa-brand-volt, #c8ff00);
		}

		.devnahian-sportlixa-share-btn.share-save:hover,
		.devnahian-sportlixa-share-btn.share-save.active,
		.devnahian-sportlixa-share-btn.share-save.is-bookmarked {
			background: var(--devnahian-sportlixa-brand-volt, #c8ff00);
			color: #000000;
			border-color: var(--devnahian-sportlixa-brand-volt, #c8ff00);
		}

		.devnahian-sportlixa-share-btn.share-save.active svg,
		.devnahian-sportlixa-share-btn.share-save.is-bookmarked svg {
			fill: #000000;
		}

		@media (max-width: 640px) {
			.devnahian-sportlixa-share-bar {
				width: 100%;
				justify-content: flex-start;
			}
		}
	</style>

	<main class="devnahian-sportlixa-container" id="primary" role="main">

		<!-- ==========================================================================
		     ARTICLE HEADER & BREADCRUMBS
		     ========================================================================== -->
		<header class="devnahian-sportlixa-article-header" style="position: static !important;">
			<nav class="devnahian-sportlixa-breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'sportlixa' ); ?>" style="position: static !important; top: auto !important;">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'sportlixa' ); ?></a>
				<span aria-hidden="true">/</span>
				<?php if ( $primary_cat ) : ?>
					<a href="<?php echo esc_url( get_category_link( $primary_cat->term_id ) ); ?>"><?php echo esc_html( $primary_cat->name ); ?></a>
					<span aria-hidden="true">/</span>
				<?php endif; ?>
				<span aria-current="page"><?php the_title(); ?></span>
			</nav>

			<div>
				<span class="devnahian-sportlixa-badge-tag">
					<?php echo $primary_cat ? esc_html( strtoupper( $primary_cat->name ) ) : esc_html__( 'SPORTS', 'sportlixa' ); ?>
				</span>
			</div>

			<h1 class="devnahian-sportlixa-post-title"><?php the_title(); ?></h1>

			<?php if ( has_excerpt() ) : ?>
				<p class="devnahian-sportlixa-post-subtitle">
					<?php echo esc_html( get_the_excerpt() ); ?>
				</p>
			<?php endif; ?>

			<div class="devnahian-sportlixa-author-bar">
				<div class="devnahian-sportlixa-author-info">
					<div class="devnahian-sportlixa-author-avatar">
						<?php echo get_avatar( $author_id, 80, '', the_title_attribute( [ 'echo' => false ] ) ); ?>
					</div>
					<div class="devnahian-sportlixa-author-details">
						<div class="devnahian-sportlixa-author-name">
							<a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>">
								<?php the_author(); ?>
							</a>
							<span class="devnahian-sportlixa-verified-badge" title="<?php esc_attr_e( 'Verified Sports Analyst', 'sportlixa' ); ?>">
								<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
							</span>
						</div>
						<div class="devnahian-sportlixa-author-role">
							<?php
							printf(
								/* translators: 1: formatted date, 2: reading time in minutes */
								esc_html__( 'Updated %1$s • %2$d min read', 'sportlixa' ),
								esc_html( get_the_modified_date() ),
								(int) $read_time
							);
							?>
						</div>
					</div>
				</div>

				<!-- Social Share Bar -->
				<div class="devnahian-sportlixa-share-bar" aria-label="<?php esc_attr_e( 'Share this article', 'sportlixa' ); ?>">
					<span class="devnahian-sportlixa-share-label"><?php esc_html_e( 'Share:', 'sportlixa' ); ?></span>

					<!-- X / Twitter -->
					<a href="https://twitter.com/intent/tweet?url=<?php echo $share_url; ?>&amp;text=<?php echo $share_title; ?>" 
					   target="_blank" 
					   rel="noopener noreferrer" 
					   class="devnahian-sportlixa-share-btn share-x" 
					   aria-label="<?php esc_attr_e( 'Share on X', 'sportlixa' ); ?>"
					   title="<?php esc_attr_e( 'Share on X', 'sportlixa' ); ?>">
						<svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false">
							<path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
						</svg>
					</a>

					<!-- Facebook -->
					<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_url; ?>" 
					   target="_blank" 
					   rel="noopener noreferrer" 
					   class="devnahian-sportlixa-share-btn share-fb" 
					   aria-label="<?php esc_attr_e( 'Share on Facebook', 'sportlixa' ); ?>"
					   title="<?php esc_attr_e( 'Share on Facebook', 'sportlixa' ); ?>">
						<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false">
							<path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
						</svg>
					</a>

					<!-- WhatsApp -->
					<a href="https://api.whatsapp.com/send?text=<?php echo $share_title . '%20' . $share_url; ?>" 
					   target="_blank" 
					   rel="noopener noreferrer" 
					   class="devnahian-sportlixa-share-btn share-wa" 
					   aria-label="<?php esc_attr_e( 'Share via WhatsApp', 'sportlixa' ); ?>"
					   title="<?php esc_attr_e( 'Share via WhatsApp', 'sportlixa' ); ?>">
						<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false">
							<path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
						</svg>
					</a>

					<!-- LinkedIn -->
					<a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $share_url; ?>" 
					   target="_blank" 
					   rel="noopener noreferrer" 
					   class="devnahian-sportlixa-share-btn share-in" 
					   aria-label="<?php esc_attr_e( 'Share on LinkedIn', 'sportlixa' ); ?>"
					   title="<?php esc_attr_e( 'Share on LinkedIn', 'sportlixa' ); ?>">
						<svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false">
							<path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
						</svg>
					</a>

					<!-- Copy Link Trigger -->
					<button type="button" 
					        class="devnahian-sportlixa-share-btn share-copy sl-share-trigger" 
					        data-post-title="<?php echo the_title_attribute( [ 'echo' => false ] ); ?>" 
					        data-post-url="<?php echo esc_url( get_permalink() ); ?>"
					        aria-label="<?php esc_attr_e( 'Copy article link', 'sportlixa' ); ?>"
					        title="<?php esc_attr_e( 'Copy link', 'sportlixa' ); ?>">
						<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" aria-hidden="true" focusable="false">
							<path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/>
							<path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>
						</svg>
					</button>

					<!-- Save / Bookmark Trigger -->
					<button type="button" 
					        class="devnahian-sportlixa-share-btn share-save sl-bookmark-trigger" 
					        id="devnahian-sportlixa-btnBookmarkPost" 
					        aria-label="<?php esc_attr_e( 'Save to bookmarks', 'sportlixa' ); ?>"
					        title="<?php esc_attr_e( 'Bookmark article', 'sportlixa' ); ?>">
						<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" aria-hidden="true" focusable="false">
							<path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/>
						</svg>
					</button>
				</div>
			</div>
		</header>

		<!-- ==========================================================================
		     MAIN CONTENT & EDITORIAL SIDEBAR
		     ========================================================================== -->
		<div class="devnahian-sportlixa-post-layout">
			<!-- Left Column: Article Body -->
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'devnahian-sportlixa-post-main' ); ?>>
				
				<?php if ( has_post_thumbnail() ) : ?>
					<figure class="devnahian-sportlixa-featured-media-box">
						<?php the_post_thumbnail( 'full', [
							'class'   => 'devnahian-sportlixa-featured-img',
							'loading' => 'eager',
							'alt'     => ! empty( $thumb_alt ) ? esc_attr( $thumb_alt ) : the_title_attribute( [ 'echo' => false ] ),
						] ); ?>

						<?php if ( ! empty( $thumb_caption ) ) : ?>
							<figcaption class="devnahian-sportlixa-media-caption">
								<span><?php echo esc_html( $thumb_caption ); ?></span>
								<span><?php esc_html_e( 'Photo: SportLixa Visual Wire', 'sportlixa' ); ?></span>
							</figcaption>
						<?php endif; ?>
					</figure>
				<?php endif; ?>

				<!-- Rich Editorial Body -->
				<div class="devnahian-sportlixa-editorial-body entry-content">
					<?php
					the_content();

					wp_link_pages( [
						'before' => '<nav class="page-links" aria-label="' . esc_attr__( 'Page pagination', 'sportlixa' ) . '">' . esc_html__( 'Pages:', 'sportlixa' ),
						'after'  => '</nav>',
					] );
					?>
				</div>

				<!-- Dynamic Post Tags -->
				<?php
				$post_tags = get_the_tags();
				if ( ! empty( $post_tags ) ) :
					?>
					<div class="devnahian-sportlixa-post-tags" aria-label="<?php esc_attr_e( 'Article Tags', 'sportlixa' ); ?>">
						<?php foreach ( $post_tags as $tag ) : ?>
							<a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="devnahian-sportlixa-tag-pill">
								#<?php echo esc_html( $tag->name ); ?>
							</a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<!-- Author Bio Card -->
				<div class="devnahian-sportlixa-author-bio-card">
					<div class="devnahian-sportlixa-bio-avatar">
						<?php echo get_avatar( $author_id, 100, '', the_title_attribute( [ 'echo' => false ] ) ); ?>
					</div>
					<div class="devnahian-sportlixa-bio-details">
						<div class="devnahian-sportlixa-bio-name">
							<a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>">
								<?php the_author(); ?>
							</a>
						</div>
						<p class="devnahian-sportlixa-bio-text">
							<?php
							if ( ! empty( $author_bio ) ) {
								echo esc_html( $author_bio );
							} else {
								esc_html_e( 'Senior sports contributor and film breakdown columnist for SportLixa.', 'sportlixa' );
							}
							?>
						</p>
					</div>
				</div>

				<!-- WordPress Threaded Comments -->
				<?php
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
				?>

			</article>

			<!-- Right Column: Sidebar -->
			<aside class="devnahian-sportlixa-post-sidebar devnahian-sportlixa-editorial-sidebar" aria-label="<?php esc_attr_e( 'Article Sidebar', 'sportlixa' ); ?>">

				<?php if ( is_active_sidebar( 'sportlixa-post-sidebar' ) ) : ?>
					<?php dynamic_sidebar( 'sportlixa-post-sidebar' ); ?>
				<?php else : ?>

					<!-- 1. Latest Posts Widget -->
					<div class="devnahian-sportlixa-sidebar-card">
						<div class="devnahian-sportlixa-section-title" style="margin-bottom: 1rem;">
							<h3 class="devnahian-sportlixa-title-left" style="font-size: 0.85rem; margin:0;"><?php esc_html_e( 'LATEST STORIES', 'sportlixa' ); ?></h3>
						</div>

						<div class="devnahian-sportlixa-sidebar-posts-list">
							<?php
							$latest_sidebar_posts = new WP_Query( [
								'posts_per_page'      => 4,
								'post__not_in'        => [ get_the_ID() ],
								'post_status'         => 'publish',
								'ignore_sticky_posts' => 1,
								'no_found_rows'       => true,
							] );

							if ( $latest_sidebar_posts->have_posts() ) :
								while ( $latest_sidebar_posts->have_posts() ) :
									$latest_sidebar_posts->the_post();
									$side_thumb = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ) : $default_placeholder;
									
									$raw_content = strip_tags( strip_shortcodes( get_the_content() ) );
									$side_read   = max( 1, (int) ceil( str_word_count( $raw_content ) / 200 ) );
									?>
									<article class="devnahian-sportlixa-side-post-row">
										<a href="<?php the_permalink(); ?>" class="devnahian-sportlixa-side-post-thumb" tabindex="-1" aria-hidden="true">
											<img src="<?php echo esc_url( $side_thumb ); ?>" alt="<?php echo the_title_attribute( [ 'echo' => false ] ); ?>" loading="lazy">
										</a>
										<div class="devnahian-sportlixa-side-post-info">
											<h4 class="devnahian-sportlixa-side-post-title">
												<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											</h4>
											<div class="devnahian-sportlixa-meta-time">
												<span><?php echo esc_html( get_the_date() ); ?></span>
												<span aria-hidden="true">•</span>
												<span><?php printf( esc_html__( '%d min read', 'sportlixa' ), (int) $side_read ); ?></span>
											</div>
										</div>
									</article>
									<?php
								endwhile;
								wp_reset_postdata();
							endif;
							?>
						</div>
					</div>

					<!-- 2. League Categories Widget -->
					<div class="devnahian-sportlixa-sidebar-card">
						<div class="devnahian-sportlixa-section-title" style="margin-bottom: 1rem;">
							<h3 class="devnahian-sportlixa-title-left" style="font-size: 0.85rem; margin:0;"><?php esc_html_e( 'EXPLORE LEAGUES', 'sportlixa' ); ?></h3>
						</div>

						<ul class="devnahian-sportlixa-categories-list">
							<?php
							$all_categories = get_categories( [
								'orderby'    => 'count',
								'order'      => 'DESC',
								'number'     => 6,
								'hide_empty' => true,
							] );

							if ( ! is_wp_error( $all_categories ) && ! empty( $all_categories ) ) :
								foreach ( $all_categories as $cat ) :
									?>
									<li class="devnahian-sportlixa-cat-item">
										<a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>">
											<span class="cat-name"><?php echo esc_html( $cat->name ); ?></span>
											<span class="cat-count"><?php echo (int) $cat->count; ?></span>
										</a>
									</li>
									<?php
								endforeach;
							endif;
							?>
						</ul>
					</div>

					<!-- 3. Popular Tags Widget -->
					<div class="devnahian-sportlixa-sidebar-card">
						<div class="devnahian-sportlixa-section-title" style="margin-bottom: 1rem;">
							<h3 class="devnahian-sportlixa-title-left" style="font-size: 0.85rem; margin:0;"><?php esc_html_e( 'POPULAR TOPICS', 'sportlixa' ); ?></h3>
						</div>

						<div class="devnahian-sportlixa-tags-cloud">
							<?php
							$popular_tags = get_tags( [
								'orderby' => 'count',
								'order'   => 'DESC',
								'number'  => 8,
							] );

							if ( ! is_wp_error( $popular_tags ) && ! empty( $popular_tags ) ) :
								foreach ( $popular_tags as $ptag ) :
									?>
									<a href="<?php echo esc_url( get_tag_link( $ptag->term_id ) ); ?>" class="devnahian-sportlixa-tag-pill">
										#<?php echo esc_html( $ptag->name ); ?>
									</a>
									<?php
								endforeach;
							endif;
							?>
						</div>
					</div>

				<?php endif; ?>

			</aside>
		</div>

		<!-- ==========================================================================
		     RELATED STORIES
		     ========================================================================== -->
		<?php
		if ( $primary_cat ) :
			$related_query = new WP_Query( [
				'category__in'        => [ $primary_cat->term_id ],
				'post__not_in'        => [ get_the_ID() ],
				'posts_per_page'      => 3,
				'post_status'         => 'publish',
				'ignore_sticky_posts' => 1,
				'no_found_rows'       => true,
			] );

			if ( $related_query->have_posts() ) :
				?>
				<section class="devnahian-sportlixa-related-section" aria-label="<?php esc_attr_e( 'Related Stories', 'sportlixa' ); ?>">
					<div class="devnahian-sportlixa-section-title">
						<div class="devnahian-sportlixa-title-left"><?php esc_html_e( 'RELATED STORIES', 'sportlixa' ); ?></div>
						<a href="<?php echo esc_url( get_category_link( $primary_cat->term_id ) ); ?>" class="devnahian-sportlixa-title-link">
							<?php printf( esc_html__( 'More in %s →', 'sportlixa' ), esc_html( $primary_cat->name ) ); ?>
						</a>
					</div>

					<div class="devnahian-sportlixa-related-grid">
						<?php
						while ( $related_query->have_posts() ) :
							$related_query->the_post();
							$rel_thumb = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'medium_large' ) : $default_placeholder;
							
							$raw_content = strip_tags( strip_shortcodes( get_the_content() ) );
							$rel_read    = max( 1, (int) ceil( str_word_count( $raw_content ) / 200 ) );
							?>
							<article class="devnahian-sportlixa-related-card">
								<div class="devnahian-sportlixa-related-thumb devnahian-sportlixa-img-box">
									<span class="devnahian-sportlixa-badge-tag devnahian-sportlixa-related-badge">
										<?php echo esc_html( strtoupper( $primary_cat->name ) ); ?>
									</span>
									<a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
										<img 
											src="<?php echo esc_url( $rel_thumb ); ?>" 
											alt="<?php echo the_title_attribute( [ 'echo' => false ] ); ?>" 
											loading="lazy"
										>
									</a>
								</div>
								<div class="devnahian-sportlixa-related-content">
									<h4 class="devnahian-sportlixa-related-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h4>
									<div class="devnahian-sportlixa-meta-time">
										<span><?php echo esc_html( get_the_date() ); ?></span>
										<span aria-hidden="true">•</span>
										<span><?php printf( esc_html__( '%d min read', 'sportlixa' ), (int) $rel_read ); ?></span>
									</div>
								</div>
							</article>
							<?php
						endwhile;
						wp_reset_postdata();
						?>
					</div>
				</section>
				<?php
			endif;
		endif;
		?>

	</main>

	<?php
endwhile;

get_footer();