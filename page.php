<?php
/**
 * The universal template for displaying all single pages (page.php)
 *
 * Serves as the standard template for generic pages, legal documents,
 * documentation, and editorial policies across the Sportlixa theme.
 *
 * @package Sportlixa
 */

get_header();

while ( have_posts() ) :
    the_post();

    // Determine category or badge label
    $ancestors   = get_post_ancestors( get_the_ID() );
    $parent_id   = ! empty( $ancestors ) ? end( $ancestors ) : null;
    $badge_label = $parent_id ? get_the_title( $parent_id ) : __( 'Official Document', 'sportlixa' );
    ?>

  <!-- ==========================================================================
       INLINE COMPONENT STYLES (No Sticky / Standard Flow)
       ========================================================================== -->
  <style>
    :root {
      --sl-volt: #ccff00;
      --sl-bg: #0b0e14;
      --sl-surface: #121721;
      --sl-border: rgba(255, 255, 255, 0.08);
      --sl-text-primary: #f1f5f9;
      --sl-text-secondary: #94a3b8;
      --sl-text-muted: #64748b;
      --sl-radius-sm: 6px;
      --sl-radius-md: 12px;
    }

    .sportlixa-page-wrapper {
      background-color: var(--sl-bg);
      color: var(--sl-text-primary);
      min-height: 100vh;
      position: static;
    }

    .sportlixa-container {
      width: 100%;
      max-width: 1200px;
      margin-left: auto;
      margin-right: auto;
      padding-left: 1.5rem;
      padding-right: 1.5rem;
      box-sizing: border-box;
    }

    /* Standard Hero Banner - Static Flow */
    .sportlixa-hero-banner {
      position: static;
      padding: 3.5rem 0 2.5rem;
      border-bottom: 1px solid var(--sl-border);
      background: radial-gradient(circle at 10% 10%, rgba(204, 255, 0, 0.04) 0%, transparent 40%);
    }

    /* Normal Inline Breadcrumbs */
    .sportlixa-breadcrumbs {
      position: static;
      margin-bottom: 1.25rem;
    }

    .sportlixa-breadcrumbs-list {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      gap: 0.5rem;
      list-style: none;
      padding: 0;
      margin: 0;
      font-size: 0.85rem;
      color: var(--sl-text-secondary);
    }

    .sportlixa-breadcrumbs-list a {
      color: var(--sl-text-secondary);
      text-decoration: none;
      transition: color 0.2s ease;
    }

    .sportlixa-breadcrumbs-list a:hover {
      color: var(--sl-volt);
    }

    .sportlixa-breadcrumbs-separator {
      color: var(--sl-text-muted);
      user-select: none;
    }

    .sportlixa-breadcrumbs-current {
      color: var(--sl-text-primary);
      font-weight: 500;
    }

    /* Badge */
    .sportlixa-badge-tag {
      display: inline-block;
      font-size: 0.72rem;
      font-weight: 700;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      padding: 0.25rem 0.65rem;
      border-radius: var(--sl-radius-sm);
      background: rgba(204, 255, 0, 0.1);
      color: var(--sl-volt);
      border: 1px solid rgba(204, 255, 0, 0.25);
      margin-bottom: 0.75rem;
    }

    .sportlixa-page-title {
      font-size: clamp(2rem, 3.5vw, 2.75rem);
      font-weight: 800;
      line-height: 1.15;
      letter-spacing: -0.025em;
      margin: 0 0 1rem;
      color: #ffffff;
    }

    .sportlixa-page-excerpt {
      font-size: 1.1rem;
      line-height: 1.6;
      color: var(--sl-text-secondary);
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
      font-weight: 500;
      color: var(--sl-text-secondary);
      background: var(--sl-surface);
      border: 1px solid var(--sl-border);
      padding: 0.35rem 0.85rem;
      border-radius: 9999px;
    }

    .sportlixa-compliance-chip svg {
      width: 14px;
      height: 14px;
      stroke: var(--sl-volt);
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

    /* Static TOC Sidebar (NO STICKY) */
    .sportlixa-sidebar {
      position: static;
    }

    .sportlixa-toc-card {
      position: static; /* Completely static scrolling */
      background: var(--sl-surface);
      border: 1px solid var(--sl-border);
      border-radius: var(--sl-radius-md);
      padding: 1.25rem;
    }

    .sportlixa-toc-header {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      font-size: 0.8rem;
      font-weight: 700;
      letter-spacing: 0.05em;
      text-transform: uppercase;
      color: #ffffff;
      margin-bottom: 1rem;
      padding-bottom: 0.75rem;
      border-bottom: 1px solid var(--sl-border);
    }

    .sportlixa-toc-header svg {
      stroke: var(--sl-volt);
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
      color: var(--sl-text-secondary);
      text-decoration: none;
      line-height: 1.4;
      display: block;
      transition: all 0.2s ease;
    }

    .sportlixa-toc-list a:hover,
    .sportlixa-toc-list a.active {
      color: var(--sl-volt);
      transform: translateX(3px);
    }

    /* Editorial / Content Body */
    .sportlixa-featured-media {
      margin: 0 0 2rem;
      border-radius: var(--sl-radius-md);
      overflow: hidden;
      border: 1px solid var(--sl-border);
    }

    .sportlixa-featured-img {
      width: 100%;
      height: auto;
      display: block;
      object-fit: cover;
    }

    .sportlixa-prose-content {
      color: var(--sl-text-primary);
      line-height: 1.75;
      font-size: 1.05rem;
      max-width: 75ch;
    }

    .sportlixa-prose-content h2 {
      font-size: 1.6rem;
      font-weight: 700;
      color: #ffffff;
      margin: 2.5rem 0 1rem;
      scroll-margin-top: 1rem;
    }

    .sportlixa-prose-content h3 {
      font-size: 1.3rem;
      font-weight: 600;
      color: #ffffff;
      margin: 2rem 0 0.75rem;
      scroll-margin-top: 1rem;
    }

    .sportlixa-prose-content p {
      margin: 0 0 1.4rem;
    }

    .sportlixa-prose-content ul,
    .sportlixa-prose-content ol {
      margin: 0 0 1.5rem 1.5rem;
      padding: 0;
    }

    .sportlixa-prose-content li {
      margin-bottom: 0.5rem;
    }

    .sportlixa-prose-content a {
      color: var(--sl-volt);
      text-decoration: underline;
      text-underline-offset: 3px;
    }

    .sportlixa-prose-content a:hover {
      text-decoration: none;
    }

    .sportlixa-prose-content blockquote {
      border-left: 3px solid var(--sl-volt);
      background: var(--sl-surface);
      margin: 1.75rem 0;
      padding: 1rem 1.5rem;
      border-radius: 0 var(--sl-radius-sm) var(--sl-radius-sm) 0;
      color: var(--sl-text-secondary);
      font-style: italic;
    }

    /* Pagination */
    .page-links {
      margin-top: 2.5rem;
      padding-top: 1.5rem;
      border-top: 1px solid var(--sl-border);
      display: flex;
      gap: 0.5rem;
      align-items: center;
      font-size: 0.9rem;
    }

    .page-links .post-page-numbers {
      padding: 0.35rem 0.75rem;
      border-radius: var(--sl-radius-sm);
      background: var(--sl-surface);
      border: 1px solid var(--sl-border);
      color: var(--sl-text-secondary);
      text-decoration: none;
    }

    .page-links .post-page-numbers.current {
      background: var(--sl-volt);
      color: #000000;
      font-weight: 700;
      border-color: var(--sl-volt);
    }

    /* Mobile / Tablet Viewport */
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

  <!-- ==========================================================================
       PAGE STRUCTURE
       ========================================================================== -->
  <main class="sportlixa-page-wrapper" id="primary">

    <!-- PAGE HERO & STATIC BREADCRUMBS -->
    <header class="sportlixa-hero-banner">
      <div class="sportlixa-container">
        
        <nav class="sportlixa-breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'sportlixa' ); ?>">
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

        <h1 class="sportlixa-page-title"><?php the_title(); ?></h1>

        <?php if ( has_excerpt() ) : ?>
          <p class="sportlixa-page-excerpt">
            <?php echo esc_html( get_the_excerpt() ); ?>
          </p>
        <?php endif; ?>

        <div class="sportlixa-compliance-row">
          <div class="sportlixa-compliance-chip">
            <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path d="M12 2a10 10 0 1 0 10 10 4 4 0 0 1-5-5z"/><circle cx="8.5" cy="8.5" r="1.5"/><circle cx="12" cy="15" r="1"/><circle cx="16" cy="11" r="1"/></svg>
            <span><?php esc_html_e( 'Verified Sports Telemetry', 'sportlixa' ); ?></span>
          </div>

          <div class="sportlixa-compliance-chip">
            <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            <time datetime="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>">
              <?php
              printf(
                  esc_html__( 'Last Updated: %s', 'sportlixa' ),
                  esc_html( get_the_modified_date( 'F j, Y' ) )
              );
              ?>
            </time>
          </div>

          <div class="sportlixa-compliance-chip">
            <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            <span><?php esc_html_e( 'Zero Third-Party Ad Trackers', 'sportlixa' ); ?></span>
          </div>
        </div>

      </div>
    </header>

    <!-- CONTENT GRID -->
    <div class="sportlixa-container">
      <div class="sportlixa-content-layout">

        <!-- Left Column: Normal Flow TOC Sidebar -->
        <aside class="sportlixa-sidebar" aria-label="<?php esc_attr_e( 'Table of Contents', 'sportlixa' ); ?>">
          <div class="sportlixa-toc-card" id="devnahian-sportlixa-tocCard">
            <div class="sportlixa-toc-header">
              <svg aria-hidden="true" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke-width="2.5"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
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
        <article id="post-<?php the_ID(); ?>" <?php post_class( 'sportlixa-main-article' ); ?>>
          
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

    <?php
endwhile;

get_footer();