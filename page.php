<?php
/**
 * The template for displaying all single pages
 *
 * Serves as the universal template for standard pages, legal documents,
 * and editorial policies across the Sportlixa theme.
 *
 * @package Sportlixa
 */

get_header();

while ( have_posts() ) :
    the_post();

    // Determine category or badge label
    $ancestors   = get_post_ancestors( get_the_ID() );
    $parent_id   = ! empty( $ancestors ) ? end( $ancestors ) : null;
    $badge_label = $parent_id ? get_the_title( $parent_id ) : __( 'OFFICIAL DISPATCH', 'sportlixa' );
    ?>

  <main class="devnahian-sportlixa-container">

    <!-- ==========================================================================
       PAGE HERO & BREADCRUMBS
       ========================================================================== -->
    <section class="devnahian-sportlixa-legal-banner">
      <nav class="devnahian-sportlixa-breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'sportlixa' ); ?>">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'sportlixa' ); ?></a>
        <span>/</span>
        <?php
        if ( ! empty( $ancestors ) ) :
            foreach ( array_reverse( $ancestors ) as $ancestor_id ) :
                ?>
                <a href="<?php echo esc_url( get_permalink( $ancestor_id ) ); ?>">
                  <?php echo esc_html( get_the_title( $ancestor_id ) ); ?>
                </a>
                <span>/</span>
                <?php
            endforeach;
        endif;
        ?>
        <span aria-current="page"><?php the_title(); ?></span>
      </nav>

      <span class="devnahian-sportlixa-badge-tag"><?php echo esc_html( strtoupper( $badge_label ) ); ?></span>
      
      <h1 class="devnahian-sportlixa-legal-heading" style="margin-top: 10px;"><?php the_title(); ?></h1>

      <?php if ( has_excerpt() ) : ?>
        <p class="devnahian-sportlixa-legal-subtext">
          <?php echo esc_html( get_the_excerpt() ); ?>
        </p>
      <?php endif; ?>

      <!-- Dynamic Verification & Compliance Strip -->
      <div class="devnahian-sportlixa-compliance-badge-row">
        <div class="devnahian-sportlixa-compliance-chip">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path d="M12 2a10 10 0 1 0 10 10 4 4 0 0 1-5-5 4 4 0 0 1-5-5z"/><circle cx="8.5" cy="8.5" r="1.5"/><circle cx="12" cy="15" r="1"/><circle cx="16" cy="11" r="1"/></svg>
          <?php esc_html_e( 'Verified Sports Telemetry', 'sportlixa' ); ?>
        </div>
        <div class="devnahian-sportlixa-compliance-chip">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
          <?php
          printf(
              /* translators: %s: formatted last updated date */
              esc_html__( 'Last Updated: %s', 'sportlixa' ),
              esc_html( get_the_modified_date( 'F j, Y' ) )
          );
          ?>
        </div>
        <div class="devnahian-sportlixa-compliance-chip">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
          <?php esc_html_e( 'Zero Third-Party Ad Trackers', 'sportlixa' ); ?>
        </div>
      </div>
    </section>

    <!-- ==========================================================================
       MAIN PAGE LAYOUT (AUTO TOC SIDEBAR + EDITORIAL BODY)
       ========================================================================== -->
    <div class="devnahian-sportlixa-legal-grid">

      <!-- Left Column: Sticky Table of Contents (Auto-Generated via JS from H2s) -->
      <aside aria-label="<?php esc_attr_e( 'Table of Contents', 'sportlixa' ); ?>">
        <div class="devnahian-sportlixa-toc-card" id="devnahian-sportlixa-tocCard">
          <div class="devnahian-sportlixa-toc-title">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--devnahian-sportlixa-brand-volt)" stroke-width="2.5"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
            <?php esc_html_e( 'Contents', 'sportlixa' ); ?>
          </div>
          <ul class="devnahian-sportlixa-toc-list" id="devnahian-sportlixa-tocList">
            <!-- Populated automatically by assets/js/main.js -->
          </ul>
        </div>
      </aside>

      <!-- Right Column: Page Content -->
      <article id="post-<?php the_ID(); ?>" <?php post_class( 'devnahian-sportlixa-legal-body' ); ?>>
        
        <?php if ( has_post_thumbnail() ) : ?>
          <div class="devnahian-sportlixa-legal-featured-image" style="border-radius: var(--devnahian-sportlixa-radius-md); overflow:hidden; border:1px solid var(--devnahian-sportlixa-border-card);">
            <?php the_post_thumbnail( 'full', [ 'class' => 'devnahian-sportlixa-page-hero-img' ] ); ?>
          </div>
        <?php endif; ?>

        <div class="devnahian-sportlixa-legal-section devnahian-sportlixa-editorial-body" id="devnahian-sportlixa-pageContent">
          <?php
          the_content();

          wp_link_pages( [
              'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'sportlixa' ),
              'after'  => '</div>',
          ] );
          ?>
        </div>

        <?php
        // Optional comments if enabled on the page
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;
        ?>

      </article>
    </div>

  </main>

    <?php
endwhile;

get_footer();