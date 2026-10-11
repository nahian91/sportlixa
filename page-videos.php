<?php
/**
 * Template Name: Videos Archive / Gallery
 * Description: Displays all videos configured in the Sportlixa Theme Settings with modal playback.
 *
 * @package Sportlixa
 */

get_header();

// Fetch videos list from theme settings
$video_items = function_exists( 'sportlixa_get_video_items' ) ? sportlixa_get_video_items() : [];

// First video serves as the hero/spotlight feature
$featured_video = ! empty( $video_items ) ? $video_items[0] : null;
$grid_videos     = ! empty( $video_items ) ? array_slice( $video_items, 1 ) : [];
?>

<main class="devnahian-sportlixa-container sportlixa-video-archive-page">

  <!-- ==========================================================================
     PAGE HEADER
     ========================================================================== -->
  <header class="sportlixa-archive-header">
    <div class="sportlixa-archive-badge"><?php esc_html_e( 'MEDIA HUB', 'sportlixa' ); ?></div>
    <h1 class="sportlixa-archive-title"><?php esc_html_e( 'All Highlights & Game Videos', 'sportlixa' ); ?></h1>
    <p class="sportlixa-archive-subtext">
      <?php esc_html_e( 'Catch top 10 moments, game-winning drives, roster interviews, and deep tactical breakdowns.', 'sportlixa' ); ?>
    </p>
  </header>

  <?php if ( ! empty( $featured_video ) ) : 
      $feat_title    = $featured_video['title'] ?? 'Top Video';
      $feat_duration = $featured_video['duration'] ?? '04:32';
      $feat_thumb    = ! empty( $featured_video['thumb'] ) ? $featured_video['thumb'] : 'https://images.unsplash.com/photo-1546519638-68e109498ffc?auto=format&fit=crop&w=1280&q=80';
      $feat_embed    = $featured_video['embed_url'] ?? '';
      $feat_meta     = $featured_video['meta'] ?? 'Featured Highlights';
  ?>
  <!-- ==========================================================================
     FEATURED SPOTLIGHT HERO VIDEO
     ========================================================================== -->
  <section class="sportlixa-spotlight-video-section">
    <div 
      class="sportlixa-spotlight-card"
      role="button"
      tabindex="0"
      aria-label="<?php echo esc_attr( $feat_title ); ?>"
      onclick="openSportlixaVideoModal('<?php echo esc_url( $feat_embed ); ?>', '<?php echo esc_js( $feat_title ); ?>')"
      onkeydown="if(event.key === 'Enter') openSportlixaVideoModal('<?php echo esc_url( $feat_embed ); ?>', '<?php echo esc_js( $feat_title ); ?>')"
    >
      <img src="<?php echo esc_url( $feat_thumb ); ?>" alt="<?php echo esc_attr( $feat_title ); ?>" class="sportlixa-spotlight-bg" loading="eager" />
      <div class="sportlixa-spotlight-overlay"></div>
      
      <?php if ( ! empty( $feat_duration ) ) : ?>
        <span class="sportlixa-video-duration-pill"><?php echo esc_html( $feat_duration ); ?></span>
      <?php endif; ?>

      <div class="sportlixa-spotlight-play-wrap">
        <div class="sportlixa-spotlight-play-icon">
          <svg viewBox="0 0 24 24"><polygon points="5 3 19 12 5 21 5 3"/></svg>
        </div>
      </div>

      <div class="sportlixa-spotlight-caption">
        <span class="badge-tag" style="background:var(--devnahian-sportlixa-brand-volt, #b9f700); color:#000; font-weight:800; font-size:11px; padding:3px 8px; border-radius:4px;"><?php esc_html_e( 'FEATURED REPLAY', 'sportlixa' ); ?></span>
        <h2 class="sportlixa-spotlight-title"><?php echo esc_html( $feat_title ); ?></h2>
        <div class="sportlixa-spotlight-meta">
          <span><?php echo esc_html( $feat_meta ); ?></span> •
          <span style="color:var(--devnahian-sportlixa-brand-volt, #b9f700); font-weight:700;"><?php esc_html_e( 'Click To Watch Now &rarr;', 'sportlixa' ); ?></span>
        </div>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- ==========================================================================
     ALL VIDEOS GRID
     ========================================================================== -->
  <section class="sportlixa-videos-grid-section">
    <div class="devnahian-sportlixa-section-title">
      <div class="devnahian-sportlixa-title-left">
        <?php printf( esc_html__( 'MORE VIDEOS (%d)', 'sportlixa' ), count( $video_items ) ); ?>
      </div>
    </div>

    <?php if ( ! empty( $video_items ) ) : ?>
      <div class="sportlixa-videos-archive-grid">
        <?php foreach ( $video_items as $vid ) : 
            $title    = $vid['title'] ?? 'Game Video';
            $duration = $vid['duration'] ?? '';
            $thumb    = ! empty( $vid['thumb'] ) ? $vid['thumb'] : 'https://images.unsplash.com/photo-1546519638-68e109498ffc?auto=format&fit=crop&w=800&q=80';
            $embed    = $vid['embed_url'] ?? '';
            $meta     = $vid['meta'] ?? '';
        ?>
          <article 
            class="sportlixa-grid-video-card"
            role="button"
            tabindex="0"
            aria-label="<?php echo esc_attr( $title ); ?>"
            onclick="openSportlixaVideoModal('<?php echo esc_url( $embed ); ?>', '<?php echo esc_js( $title ); ?>')"
            onkeydown="if(event.key === 'Enter') openSportlixaVideoModal('<?php echo esc_url( $embed ); ?>', '<?php echo esc_js( $title ); ?>')"
          >
            <div class="sportlixa-grid-video-thumb-box">
              <img src="<?php echo esc_url( $thumb ); ?>" alt="<?php echo esc_attr( $title ); ?>" loading="lazy" />
              <div class="sportlixa-grid-thumb-overlay"></div>
              
              <?php if ( ! empty( $duration ) ) : ?>
                <span class="sportlixa-video-duration-pill"><?php echo esc_html( $duration ); ?></span>
              <?php endif; ?>

              <div class="sportlixa-grid-play-circle">
                <svg viewBox="0 0 24 24"><polygon points="5 3 19 12 5 21 5 3"/></svg>
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
      <p style="color:#8c9ba5; padding: 40px 0; text-align:center;">
        <?php esc_html_e( 'No video items configured yet. Please add them from Appearance > Sportlixa Settings > Videos.', 'sportlixa' ); ?>
      </p>
    <?php endif; ?>
  </section>

</main>

<!-- ==========================================================================
   VIDEO POPUP MODAL
   ========================================================================== -->
<div id="sportlixaVideoModal" class="sportlixa-video-modal" aria-hidden="true" role="dialog">
  <div class="sportlixa-video-modal-backdrop" onclick="closeSportlixaVideoModal()"></div>
  <div class="sportlixa-video-modal-dialog">
    <div class="sportlixa-video-modal-header">
      <h4 id="sportlixaVideoModalTitle" class="sportlixa-video-modal-heading"><?php esc_html_e( 'Video Player', 'sportlixa' ); ?></h4>
      <button type="button" class="sportlixa-video-modal-close" onclick="closeSportlixaVideoModal()" aria-label="Close video player">&times;</button>
    </div>
    <div class="sportlixa-video-modal-iframe-wrap">
      <iframe id="sportlixaVideoPlayerFrame" src="" title="Video Player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
  </div>
</div>

<style>
  /* --------------------------------------------------------------------------
     VIDEO ARCHIVE STYLES
     -------------------------------------------------------------------------- */
  .sportlixa-video-archive-page {
    padding-top: 32px;
    padding-bottom: 60px;
  }
  .sportlixa-archive-header {
    margin-bottom: 30px;
  }
  .sportlixa-archive-badge {
    display: inline-block;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 1px;
    color: var(--devnahian-sportlixa-brand-volt, #b9f700);
    text-transform: uppercase;
    margin-bottom: 6px;
  }
  .sportlixa-archive-title {
    font-size: 32px;
    font-weight: 900;
    color: #fff;
    margin: 0 0 8px 0;
    text-transform: uppercase;
  }
  .sportlixa-archive-subtext {
    color: #8c9ba5;
    font-size: 15px;
    margin: 0;
    max-width: 650px;
  }

  /* Spotlight Feature Card */
  .sportlixa-spotlight-video-section {
    margin-bottom: 40px;
  }
  .sportlixa-spotlight-card {
    position: relative;
    height: 440px;
    border-radius: 14px;
    overflow: hidden;
    cursor: pointer;
    border: 1px solid rgba(255, 255, 255, 0.1);
    background: #0d1117;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 30px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.5);
  }
  .sportlixa-spotlight-bg {
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
  }
  .sportlixa-spotlight-card:hover .sportlixa-spotlight-bg {
    transform: scale(1.03);
  }
  .sportlixa-spotlight-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(10,14,22,0.2) 0%, rgba(10,14,22,0.85) 75%, rgba(10,14,22,0.98) 100%);
  }
  .sportlixa-video-duration-pill {
    position: absolute;
    top: 20px;
    right: 20px;
    background: rgba(0, 0, 0, 0.75);
    color: #fff;
    font-size: 11px;
    font-weight: 700;
    padding: 4px 9px;
    border-radius: 6px;
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
    background: var(--devnahian-sportlixa-brand-volt, #b9f700);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 0 30px rgba(185, 247, 0, 0.45);
    transition: transform 0.25s ease;
  }
  .sportlixa-spotlight-card:hover .sportlixa-spotlight-play-icon {
    transform: scale(1.12);
  }
  .sportlixa-spotlight-play-icon svg {
    width: 26px;
    height: 26px;
    fill: #000;
    margin-left: 3px;
  }
  .sportlixa-spotlight-caption {
    position: relative;
    z-index: 2;
    max-width: 750px;
  }
  .sportlixa-spotlight-title {
    font-size: 26px;
    font-weight: 800;
    color: #fff;
    margin: 10px 0 6px 0;
  }
  .sportlixa-spotlight-meta {
    font-size: 13px;
    color: #c4cdd8;
  }

  /* Video Grid */
  .sportlixa-videos-archive-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 22px;
  }
  .sportlixa-grid-video-card {
    background: #11151c;
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 12px;
    overflow: hidden;
    cursor: pointer;
    transition: transform 0.2s ease, border-color 0.2s ease;
    display: flex;
    flex-direction: column;
  }
  .sportlixa-grid-video-card:hover {
    transform: translateY(-4px);
    border-color: rgba(255, 255, 255, 0.2);
  }
  .sportlixa-grid-video-thumb-box {
    position: relative;
    width: 100%;
    padding-top: 56.25%;
    overflow: hidden;
    background: #000;
  }
  .sportlixa-grid-video-thumb-box img {
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
  }
  .sportlixa-grid-video-card:hover .sportlixa-grid-video-thumb-box img {
    transform: scale(1.06);
  }
  .sportlixa-grid-thumb-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.3);
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
    border: 1px solid rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.2s, transform 0.2s;
  }
  .sportlixa-grid-video-card:hover .sportlixa-grid-play-circle {
    background: var(--devnahian-sportlixa-brand-volt, #b9f700);
    transform: translate(-50%, -50%) scale(1.1);
  }
  .sportlixa-grid-play-circle svg {
    width: 18px;
    height: 18px;
    fill: #fff;
    margin-left: 2px;
  }
  .sportlixa-grid-video-card:hover .sportlixa-grid-play-circle svg {
    fill: #000;
  }
  .sportlixa-grid-video-info {
    padding: 14px;
    display: flex;
    flex-direction: column;
    gap: 6px;
    flex: 1;
  }
  .sportlixa-grid-video-title {
    margin: 0;
    font-size: 15px;
    font-weight: 700;
    color: #fff;
    line-height: 1.35;
  }
  .sportlixa-grid-video-meta {
    font-size: 12px;
    color: #8c9ba5;
  }

  /* Modal Dialog */
  .sportlixa-video-modal {
    position: fixed;
    top: 0; left: 0; width: 100%; height: 100%;
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
    top: 0; left: 0; width: 100%; height: 100%;
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
    cursor: pointer;
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
    top: 0; left: 0; width: 100%; height: 100%;
    border: 0;
  }

  @media (max-width: 768px) {
    .sportlixa-spotlight-card {
      height: 320px;
      padding: 18px;
    }
    .sportlixa-spotlight-title {
      font-size: 20px;
    }
  }
</style>

<script>
  function openSportlixaVideoModal(videoSrc, title) {
    const modal   = document.getElementById('sportlixaVideoModal');
    const frame   = document.getElementById('sportlixaVideoPlayerFrame');
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