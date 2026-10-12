<?php
/**
 * Template Name: Videos Archive / Gallery
 * Description: Displays all videos configured in the Sportlixa Theme Settings with modal playback.
 *
 * @package Sportlixa
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$default_thumb = get_theme_file_uri( '/assets/img/placeholder.jpg' );

// Default fallback videos if theme settings repeater is empty
$default_videos = [
	[
		'title'     => __( 'Super Bowl LVIII: Complete 4th Quarter & Overtime Film Breakdown', 'sportlixa' ),
		'duration'  => '08:45',
		'thumb'     => $default_thumb,
		'embed_url' => 'https://www.youtube-nocookie.com/embed/dQw4w9WgXcQ?autoplay=1',
		'meta'      => __( 'Tactical Film Room • 124K Views', 'sportlixa' ),
	],
	[
		'title'     => __( 'Patrick Mahomes: Anatomy of a Two-Minute Drill Comeback', 'sportlixa' ),
		'duration'  => '05:12',
		'thumb'     => $default_thumb,
		'embed_url' => 'https://www.youtube-nocookie.com/embed/dQw4w9WgXcQ?autoplay=1',
		'meta'      => __( 'QB All-22 Study • 88K Views', 'sportlixa' ),
	],
	[
		'title'     => __( 'Top 10 High-Velocity Defensive Hits of the Regular Season', 'sportlixa' ),
		'duration'  => '04:30',
		'thumb'     => $default_thumb,
		'embed_url' => 'https://www.youtube-nocookie.com/embed/dQw4w9WgXcQ?autoplay=1',
		'meta'      => __( 'Game Highlights • 65K Views', 'sportlixa' ),
	],
	[
		'title'     => __( 'Red Zone Telemetry: Why Play-Action Bootlegs Beat Cover 3', 'sportlixa' ),
		'duration'  => '06:18',
		'thumb'     => $default_thumb,
		'embed_url' => 'https://www.youtube-nocookie.com/embed/dQw4w9WgXcQ?autoplay=1',
		'meta'      => __( 'Coaches Tape • 42K Views', 'sportlixa' ),
	],
	[
		'title'     => __( 'Speed vs. Power: Edge Rusher Get-Off Splits Measured by GPS', 'sportlixa' ),
		'duration'  => '07:05',
		'thumb'     => $default_thumb,
		'embed_url' => 'https://www.youtube-nocookie.com/embed/dQw4w9WgXcQ?autoplay=1',
		'meta'      => __( 'Combine Analytics • 51K Views', 'sportlixa' ),
	],
];

// Fetch videos list from theme settings or use defaults
$video_items = function_exists( 'sportlixa_get_video_items' ) ? sportlixa_get_video_items() : [];
if ( empty( $video_items ) ) {
	$video_items = $default_videos;
}

// First video serves as the spotlight feature
$featured_video = ! empty( $video_items ) ? $video_items[0] : null;
$grid_videos     = ! empty( $video_items ) ? array_slice( $video_items, 1 ) : [];
?>

<main class="devnahian-sportlixa-container sportlixa-video-archive-page" id="primary" role="main">

	<!-- ==========================================================================
	     PAGE HEADER
	     ========================================================================== -->
	<header class="sportlixa-archive-header">
		<span class="devnahian-sportlixa-badge-tag"><?php esc_html_e( 'MEDIA HUB', 'sportlixa' ); ?></span>
		<h1 class="sportlixa-archive-title"><?php esc_html_e( 'All Highlights & Game Videos', 'sportlixa' ); ?></h1>
		<p class="sportlixa-archive-subtext">
			<?php esc_html_e( 'Catch top 10 moments, game-winning drives, roster interviews, and deep tactical breakdowns.', 'sportlixa' ); ?>
		</p>
	</header>

	<?php if ( ! empty( $featured_video ) ) : 
		$feat_title    = $featured_video['title'] ?? __( 'Top Video', 'sportlixa' );
		$feat_duration = $featured_video['duration'] ?? '04:32';
		$feat_thumb    = ! empty( $featured_video['thumb'] ) ? $featured_video['thumb'] : $default_thumb;
		$feat_embed    = $featured_video['embed_url'] ?? '';
		$feat_meta     = $featured_video['meta'] ?? __( 'Featured Highlights', 'sportlixa' );
	?>
	<!-- ==========================================================================
	     FEATURED SPOTLIGHT HERO VIDEO
	     ========================================================================== -->
	<section class="sportlixa-spotlight-video-section" aria-label="<?php esc_attr_e( 'Featured Spotlight Video', 'sportlixa' ); ?>">
		<div 
			class="sportlixa-spotlight-card sl-video-trigger"
			role="button"
			tabindex="0"
			aria-label="<?php echo esc_attr( $feat_title ); ?>"
			data-video-src="<?php echo esc_url( $feat_embed ); ?>"
			data-video-title="<?php echo esc_attr( $feat_title ); ?>"
		>
			<img src="<?php echo esc_url( $feat_thumb ); ?>" alt="<?php echo esc_attr( $feat_title ); ?>" class="sportlixa-spotlight-bg" loading="eager" />
			<div class="sportlixa-spotlight-overlay"></div>
			
			<?php if ( ! empty( $feat_duration ) ) : ?>
				<span class="sportlixa-video-duration-pill"><?php echo esc_html( $feat_duration ); ?></span>
			<?php endif; ?>

			<div class="sportlixa-spotlight-play-wrap" aria-hidden="true">
				<div class="sportlixa-spotlight-play-icon">
					<svg viewBox="0 0 24 24" focusable="false"><polygon points="5 3 19 12 5 21 5 3"/></svg>
				</div>
			</div>

			<div class="sportlixa-spotlight-caption">
				<span class="devnahian-sportlixa-badge-tag" style="margin-bottom:8px;"><?php esc_html_e( 'FEATURED REPLAY', 'sportlixa' ); ?></span>
				<h2 class="sportlixa-spotlight-title"><?php echo esc_html( $feat_title ); ?></h2>
				<div class="sportlixa-spotlight-meta">
					<span><?php echo esc_html( $feat_meta ); ?></span> •
					<span style="color:var(--devnahian-sportlixa-brand-volt, #c8ff00); font-weight:700;"><?php esc_html_e( 'Click To Watch Now →', 'sportlixa' ); ?></span>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<!-- ==========================================================================
	     ALL VIDEOS GRID
	     ========================================================================== -->
	<section class="sportlixa-videos-grid-section" aria-label="<?php esc_attr_e( 'Video Archive Library', 'sportlixa' ); ?>">
		<div class="devnahian-sportlixa-section-title">
			<div class="devnahian-sportlixa-title-left">
				<?php printf( esc_html__( 'MORE VIDEOS (%d)', 'sportlixa' ), (int) count( $video_items ) ); ?>
			</div>
		</div>

		<?php if ( ! empty( $grid_videos ) ) : ?>
			<div class="sportlixa-videos-archive-grid">
				<?php foreach ( $grid_videos as $vid ) : 
					$title    = $vid['title'] ?? __( 'Game Video', 'sportlixa' );
					$duration = $vid['duration'] ?? '';
					$thumb    = ! empty( $vid['thumb'] ) ? $vid['thumb'] : $default_thumb;
					$embed    = $vid['embed_url'] ?? '';
					$meta     = $vid['meta'] ?? '';
				?>
					<article 
						class="sportlixa-grid-video-card sl-video-trigger"
						role="button"
						tabindex="0"
						aria-label="<?php echo esc_attr( $title ); ?>"
						data-video-src="<?php echo esc_url( $embed ); ?>"
						data-video-title="<?php echo esc_attr( $title ); ?>"
					>
						<div class="sportlixa-grid-video-thumb-box">
							<img src="<?php echo esc_url( $thumb ); ?>" alt="<?php echo esc_attr( $title ); ?>" loading="lazy" />
							<div class="sportlixa-grid-thumb-overlay"></div>
							
							<?php if ( ! empty( $duration ) ) : ?>
								<span class="sportlixa-video-duration-pill"><?php echo esc_html( $duration ); ?></span>
							<?php endif; ?>

							<div class="sportlixa-grid-play-circle" aria-hidden="true">
								<svg viewBox="0 0 24 24" focusable="false"><polygon points="5 3 19 12 5 21 5 3"/></svg>
							</div>
						</div>

						<div class="sportlixa-grid-video-info">
							<h3 class="sportlixa-grid-video-title"><?php echo esc_html( $title ); ?></h3>
							<?php if ( ! empty( $meta ) ) : ?>
								<div class="sportlixa-grid-video-meta"><?php echo esc_html( $meta ); ?></div>
							<?php endif; ?>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		<?php else : ?>
			<p style="color:var(--devnahian-sportlixa-text-muted, #95a5b8); padding: 40px 0; text-align:center;">
				<?php esc_html_e( 'No additional videos available right now.', 'sportlixa' ); ?>
			</p>
		<?php endif; ?>
	</section>

</main>

<!-- ==========================================================================
     VIDEO POPUP MODAL DIALOG
     ========================================================================== -->
<div id="sportlixaVideoModal" class="sportlixa-video-modal" aria-hidden="true" role="dialog" aria-modal="true">
	<div class="sportlixa-video-modal-backdrop" id="sportlixaModalBackdrop"></div>
	<div class="sportlixa-video-modal-dialog">
		<div class="sportlixa-video-modal-header">
			<h4 id="sportlixaVideoModalTitle" class="sportlixa-video-modal-heading"><?php esc_html_e( 'Video Player', 'sportlixa' ); ?></h4>
			<button type="button" class="sportlixa-video-modal-close" id="sportlixaModalClose" aria-label="<?php esc_attr_e( 'Close video player', 'sportlixa' ); ?>">&times;</button>
		</div>
		<div class="sportlixa-video-modal-iframe-wrap">
			<iframe id="sportlixaVideoPlayerFrame" src="" title="<?php esc_attr_e( 'Video Player', 'sportlixa' ); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>
	</div>
</div>

<!-- ==========================================================================
     EMBEDDED SCOPED STYLES
     ========================================================================== -->
<style>
	.sportlixa-video-archive-page {
		padding-top: 32px;
		padding-bottom: 60px;
	}
	.sportlixa-archive-header {
		margin-bottom: 30px;
	}
	.sportlixa-archive-title {
		font-size: clamp(24px, 4vw, 34px);
		font-weight: 900;
		font-style: italic;
		color: var(--devnahian-sportlixa-text-white, #ffffff);
		margin: 10px 0 8px 0;
		text-transform: uppercase;
		letter-spacing: -0.5px;
		line-height: 1.2;
	}
	.sportlixa-archive-subtext {
		color: var(--devnahian-sportlixa-text-muted, #95a5b8);
		font-size: 15px;
		margin: 0;
		max-width: 650px;
		line-height: 1.6;
	}

	/* Spotlight Feature Card */
	.sportlixa-spotlight-video-section {
		margin-bottom: 40px;
	}
	.sportlixa-spotlight-card {
		position: relative;
		height: 440px;
		border-radius: var(--devnahian-sportlixa-radius-lg, 14px);
		overflow: hidden;
		cursor: pointer;
		border: 1px solid var(--devnahian-sportlixa-border-card, #1e2a3f);
		background: var(--devnahian-sportlixa-bg-dark, #080c14);
		display: flex;
		flex-direction: column;
		justify-content: flex-end;
		padding: 30px;
		box-shadow: var(--devnahian-sportlixa-shadow-card, 0 4px 20px rgba(0,0,0,0.28));
		transition: border-color var(--devnahian-sportlixa-transition-smooth, 0.35s ease), box-shadow var(--devnahian-sportlixa-transition-smooth, 0.35s ease);
	}
	.sportlixa-spotlight-card:hover {
		border-color: var(--devnahian-sportlixa-brand-volt, #c8ff00);
		box-shadow: var(--devnahian-sportlixa-shadow-card-hover, 0 14px 34px rgba(0,0,0,0.52));
	}
	.sportlixa-spotlight-bg {
		position: absolute;
		top: 0; 
		left: 0; 
		width: 100%; 
		height: 100%;
		object-fit: cover;
		transition: transform 0.5s var(--devnahian-sportlixa-ease-out, cubic-bezier(0.16, 1, 0.3, 1));
	}
	.sportlixa-spotlight-card:hover .sportlixa-spotlight-bg {
		transform: scale(1.03);
	}
	.sportlixa-spotlight-overlay {
		position: absolute;
		inset: 0;
		background: linear-gradient(180deg, rgba(8,12,20,0.1) 0%, rgba(8,12,20,0.65) 55%, rgba(8,12,20,0.96) 100%);
	}
	.sportlixa-video-duration-pill {
		position: absolute;
		top: 20px;
		right: 20px;
		background: rgba(0, 0, 0, 0.78);
		color: #ffffff;
		font-size: 10.5px;
		font-weight: 800;
		padding: 4px 10px;
		border-radius: var(--devnahian-sportlixa-radius-sm, 6px);
		border: 1px solid rgba(255, 255, 255, 0.15);
		z-index: 2;
	}
	.sportlixa-spotlight-play-wrap {
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		z-index: 2;
	}
	.sportlixa-spotlight-play-icon {
		width: 68px;
		height: 68px;
		background: var(--devnahian-sportlixa-brand-volt, #c8ff00);
		border-radius: 50%;
		display: flex;
		align-items: center;
		justify-content: center;
		box-shadow: 0 0 24px var(--devnahian-sportlixa-brand-volt-glow, rgba(200, 255, 0, 0.28));
		transition: transform 0.25s ease;
	}
	.sportlixa-spotlight-card:hover .sportlixa-spotlight-play-icon {
		transform: scale(1.12);
	}
	.sportlixa-spotlight-play-icon svg {
		width: 24px;
		height: 24px;
		fill: #000000;
		margin-left: 3px;
	}
	.sportlixa-spotlight-caption {
		position: relative;
		z-index: 2;
		max-width: 750px;
	}
	.sportlixa-spotlight-title {
		font-size: clamp(20px, 3.2vw, 28px);
		font-weight: 900;
		font-style: italic;
		color: var(--devnahian-sportlixa-text-white, #ffffff);
		margin: 6px 0 8px 0;
		line-height: 1.25;
	}
	.sportlixa-spotlight-meta {
		font-size: 13px;
		color: var(--devnahian-sportlixa-text-light, #e5ebf5);
	}

	/* Video Grid */
	.sportlixa-videos-archive-grid {
		display: grid;
		grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
		gap: 22px;
	}
	.sportlixa-grid-video-card {
		background: var(--devnahian-sportlixa-bg-card, #121926);
		border: 1px solid var(--devnahian-sportlixa-border-card, #1e2a3f);
		border-radius: var(--devnahian-sportlixa-radius-md, 10px);
		overflow: hidden;
		cursor: pointer;
		transition: transform var(--devnahian-sportlixa-transition-smooth, 0.35s ease), border-color var(--devnahian-sportlixa-transition-smooth, 0.35s ease);
		display: flex;
		flex-direction: column;
		box-shadow: var(--devnahian-sportlixa-shadow-card, 0 4px 20px rgba(0,0,0,0.28));
	}
	.sportlixa-grid-video-card:hover {
		transform: translateY(-4px);
		border-color: var(--devnahian-sportlixa-brand-volt, #c8ff00);
	}
	.sportlixa-grid-video-thumb-box {
		position: relative;
		width: 100%;
		padding-top: 56.25%;
		overflow: hidden;
		background: #000000;
	}
	.sportlixa-grid-video-thumb-box img {
		position: absolute;
		top: 0; 
		left: 0; 
		width: 100%; 
		height: 100%;
		object-fit: cover;
		transition: transform 0.4s ease;
	}
	.sportlixa-grid-video-card:hover .sportlixa-grid-video-thumb-box img {
		transform: scale(1.06);
	}
	.sportlixa-grid-thumb-overlay {
		position: absolute;
		inset: 0;
		background: rgba(0, 0, 0, 0.35);
	}
	.sportlixa-grid-play-circle {
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		width: 44px;
		height: 44px;
		border-radius: 50%;
		background: rgba(0, 0, 0, 0.7);
		border: 1.5px solid var(--devnahian-sportlixa-brand-volt, #c8ff00);
		display: flex;
		align-items: center;
		justify-content: center;
		transition: background-color var(--devnahian-sportlixa-transition-fast, 0.2s ease), transform var(--devnahian-sportlixa-transition-fast, 0.2s ease);
	}
	.sportlixa-grid-video-card:hover .sportlixa-grid-play-circle {
		background: var(--devnahian-sportlixa-brand-volt, #c8ff00);
		transform: translate(-50%, -50%) scale(1.1);
	}
	.sportlixa-grid-play-circle svg {
		width: 16px;
		height: 16px;
		fill: var(--devnahian-sportlixa-brand-volt, #c8ff00);
		margin-left: 2px;
		transition: fill var(--devnahian-sportlixa-transition-fast, 0.2s ease);
	}
	.sportlixa-grid-video-card:hover .sportlixa-grid-play-circle svg {
		fill: #000000;
	}
	.sportlixa-grid-video-info {
		padding: 16px;
		display: flex;
		flex-direction: column;
		gap: 6px;
		flex: 1;
	}
	.sportlixa-grid-video-title {
		margin: 0;
		font-size: 14.5px;
		font-weight: 800;
		color: var(--devnahian-sportlixa-text-white, #ffffff);
		line-height: 1.35;
	}
	.sportlixa-grid-video-meta {
		font-size: 11.5px;
		color: var(--devnahian-sportlixa-text-dim, #64758b);
	}

	/* Modal Dialog */
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
		background: var(--devnahian-sportlixa-bg-card, #121926);
		border: 1px solid var(--devnahian-sportlixa-border-card, #1e2a3f);
		border-radius: var(--devnahian-sportlixa-radius-md, 10px);
		overflow: hidden;
		box-shadow: 0 25px 60px rgba(0, 0, 0, 0.7);
		z-index: 2;
	}
	.sportlixa-video-modal-header {
		display: flex;
		justify-content: space-between;
		align-items: center;
		padding: 14px 20px;
		background: var(--devnahian-sportlixa-bg-input, #151e2e);
		border-bottom: 1px solid var(--devnahian-sportlixa-border-color, #1a2538);
	}
	.sportlixa-video-modal-heading {
		margin: 0;
		font-size: 15px;
		font-weight: 800;
		color: #ffffff;
	}
	.sportlixa-video-modal-close {
		background: transparent;
		border: none;
		color: var(--devnahian-sportlixa-text-muted, #95a5b8);
		font-size: 26px;
		cursor: pointer;
		line-height: 1;
		transition: color 0.15s ease;
	}
	.sportlixa-video-modal-close:hover {
		color: #ffffff;
	}
	.sportlixa-video-modal-iframe-wrap {
		position: relative;
		width: 100%;
		padding-top: 56.25%;
		background: #000000;
	}
	.sportlixa-video-modal-iframe-wrap iframe {
		position: absolute;
		top: 0; 
		left: 0; 
		width: 100%; 
		height: 100%;
		border: 0;
	}

	@media (max-width: 768px) {
		.sportlixa-spotlight-card {
			height: 320px;
			padding: 20px;
		}
		.sportlixa-videos-archive-grid {
			grid-template-columns: 1fr;
		}
	}
</style>

<!-- ==========================================================================
     UNOBTRUSIVE VIDEO MODAL EVENT CONTROLLER
     ========================================================================== -->
<script>
	document.addEventListener('DOMContentLoaded', function () {
		const modal     = document.getElementById('sportlixaVideoModal');
		const frame     = document.getElementById('sportlixaVideoPlayerFrame');
		const heading   = document.getElementById('sportlixaVideoModalTitle');
		const backdrop  = document.getElementById('sportlixaModalBackdrop');
		const closeBtn  = document.getElementById('sportlixaModalClose');
		const triggers  = document.querySelectorAll('.sl-video-trigger');

		function openVideo(src, title) {
			if (!modal) return;
			if (title && heading) heading.textContent = title;
			if (src && frame) frame.src = src;
			modal.classList.add('is-active');
			modal.setAttribute('aria-hidden', 'false');
			document.body.style.overflow = 'hidden';
		}

		function closeVideo() {
			if (!modal) return;
			if (frame) frame.src = '';
			modal.classList.remove('is-active');
			modal.setAttribute('aria-hidden', 'true');
			document.body.style.overflow = '';
		}

		triggers.forEach(function (el) {
			const src   = el.getAttribute('data-video-src');
			const title = el.getAttribute('data-video-title');

			el.addEventListener('click', function () {
				openVideo(src, title);
			});

			el.addEventListener('keydown', function (e) {
				if (e.key === 'Enter') {
					openVideo(src, title);
				}
			});
		});

		if (backdrop) backdrop.addEventListener('click', closeVideo);
		if (closeBtn) closeBtn.addEventListener('click', closeVideo);

		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape') {
				closeVideo();
			}
		});
	});
</script>

<?php get_footer(); ?>