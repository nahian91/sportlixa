<?php
/**
 * The template for displaying archive pages (Season Vault / Chronological Repository)
 *
 * @package Sportlixa
 */

get_header();

// Determine archive title context
$archive_title  = get_the_archive_title();
$archive_desc   = get_the_archive_description();
$current_year   = date( 'Y' );
?>

  <main id="primary" class="site-main devnahian-sportlixa-container">

    <!-- ==========================================================================
       ARCHIVE BANNER, BREADCRUMBS & SEASON VAULT SWITCHER
       ========================================================================== -->
    <header class="page-header devnahian-sportlixa-archive-banner">
      <nav class="devnahian-sportlixa-breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'sportlixa' ); ?>">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'sportlixa' ); ?></a>
        <span>/</span>
        <a href="<?php echo esc_url( home_url( '/#chronicle' ) ); ?>"><?php esc_html_e( 'Chronicle', 'sportlixa' ); ?></a>
        <span>/</span>
        <span aria-current="page"><?php esc_html_e( 'Season Archive', 'sportlixa' ); ?></span>
      </nav>

      <div class="devnahian-sportlixa-archive-title-row">
        <div>
          <span class="devnahian-sportlixa-badge-tag"><?php esc_html_e( 'HISTORICAL REPOSITORY', 'sportlixa' ); ?></span>
          <h1 class="page-title devnahian-sportlixa-archive-heading" style="margin-top:10px;">
            <?php echo esc_html( ! empty( $archive_title ) ? $archive_title : __( 'The Season Vault', 'sportlixa' ) ); ?>
          </h1>
          <div class="archive-description devnahian-sportlixa-archive-desc">
            <?php
            if ( ! empty( $archive_desc ) ) {
                echo wp_kses_post( wpautop( $archive_desc ) );
            } else {
                esc_html_e( 'Explore our complete chronological archive of documented gamecasts, all-22 film studies, playoff race breakdowns, and clinical injury reports.', 'sportlixa' );
            }
            ?>
          </div>
        </div>

        <div class="devnahian-sportlixa-meta-time" style="font-weight:700;">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--devnahian-sportlixa-brand-volt)" stroke-width="2.5"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
          <?php
          printf(
              /* translators: %s: current year */
              esc_html__( 'Active Repository: 2022 – %s', 'sportlixa' ),
              esc_html( $current_year )
          );
          ?>
        </div>
      </div>

      <!-- Year Season Vault Selector (Links to yearly archive URLs) -->
      <div class="devnahian-sportlixa-vault-years-bar" role="tablist" aria-label="<?php esc_attr_e( 'Season Archives', 'sportlixa' ); ?>">
        <?php
        $years = [ '2026', '2025', '2024', '2023', '2022' ];
        foreach ( $years as $yr ) :
            $is_active = ( $yr === $current_year );
            $year_url  = get_year_link( $yr );
            $label     = ( $yr === '2026' ) ? __( 'Active Season', 'sportlixa' ) : ( ( $yr === '2022' ) ? __( 'Inception', 'sportlixa' ) : __( 'Completed', 'sportlixa' ) );
            ?>
            <a href="<?php echo esc_url( $year_url ); ?>" class="devnahian-sportlixa-year-chip <?php echo $is_active ? 'active' : ''; ?>" role="tab" aria-selected="<?php echo $is_active ? 'true' : 'false'; ?>">
              <span class="season-label"><?php echo esc_html( $label ); ?></span>
              <span class="year-num"><?php echo esc_html( $yr ); ?></span>
            </a>
        <?php endforeach; ?>
      </div>
    </header>

    <!-- Month & Sport Filter Controls -->
    <div class="devnahian-sportlixa-archive-toolbar">
      <div class="devnahian-sportlixa-archive-months" role="group" aria-label="<?php esc_attr_e( 'Filter by month', 'sportlixa' ); ?>">
        <button type="button" class="devnahian-sportlixa-filter-pill-btn active" onclick="filterArchiveMonth('all', this)"><?php esc_html_e( 'All Months', 'sportlixa' ); ?></button>
        <button type="button" class="devnahian-sportlixa-filter-pill-btn" onclick="filterArchiveMonth('oct', this)"><?php esc_html_e( 'October', 'sportlixa' ); ?></button>
        <button type="button" class="devnahian-sportlixa-filter-pill-btn" onclick="filterArchiveMonth('sep', this)"><?php esc_html_e( 'September', 'sportlixa' ); ?></button>
        <button type="button" class="devnahian-sportlixa-filter-pill-btn" onclick="filterArchiveMonth('aug', this)"><?php esc_html_e( 'August', 'sportlixa' ); ?></button>
        <button type="button" class="devnahian-sportlixa-filter-pill-btn" onclick="filterArchiveMonth('jul', this)"><?php esc_html_e( 'July', 'sportlixa' ); ?></button>
      </div>

      <div class="devnahian-sportlixa-archive-sports" role="group" aria-label="<?php esc_attr_e( 'Filter by sport category', 'sportlixa' ); ?>">
        <button type="button" class="devnahian-sportlixa-filter-pill-btn active" onclick="filterArchiveSport('all', this)"><?php esc_html_e( 'All Sports', 'sportlixa' ); ?></button>
        <button type="button" class="devnahian-sportlixa-filter-pill-btn" onclick="filterArchiveSport('nfl', this)">NFL</button>
        <button type="button" class="devnahian-sportlixa-filter-pill-btn" onclick="filterArchiveSport('nba', this)">NBA</button>
        <button type="button" class="devnahian-sportlixa-filter-pill-btn" onclick="filterArchiveSport('mlb', this)">MLB</button>
        <button type="button" class="devnahian-sportlixa-filter-pill-btn" onclick="filterArchiveSport('soccer', this)">Soccer</button>
      </div>
    </div>

    <!-- ==========================================================================
       ARCHIVE 2-COLUMN LAYOUT (TIMELINE ENTRIES + SIDEBAR)
       ========================================================================== -->
    <div class="devnahian-sportlixa-archive-layout">

      <!-- Left Column: Chronological Story Timeline -->
      <section class="devnahian-sportlixa-archive-timeline" id="devnahian-sportlixa-timelineRoot">
        
        <?php
        if ( have_posts() ) :
            $current_date_group = '';

            while ( have_posts() ) :
                the_post();

                $post_date  = get_the_date( 'F j, Y' );
                $date_attr  = get_the_date( 'Y-m-d' );
                $month_slug = strtolower( get_the_date( 'M' ) ); // e.g. oct, sep

                // Group posts by date
                if ( $current_date_group !== $post_date ) :
                    if ( '' !== $current_date_group ) :
                        echo '</div></div>'; // Close previous entries wrap & timeline group
                    endif;
                    $current_date_group = $post_date;
                    ?>
                    <div class="devnahian-sportlixa-timeline-group" data-month="<?php echo esc_attr( $month_slug ); ?>">
                      <div class="devnahian-sportlixa-timeline-group-header">
                        <time class="devnahian-sportlixa-timeline-badge" datetime="<?php echo esc_attr( $date_attr ); ?>">
                          <?php echo esc_html( $post_date ); ?>
                        </time>
                        <div class="devnahian-sportlixa-timeline-line"></div>
                      </div>
                      <div class="devnahian-sportlixa-archive-entries-wrap">
                    <?php
                endif;

                // Post details
                $categories = get_the_category();
                $cat_name   = ! empty( $categories ) ? esc_html( strtoupper( $categories[0]->name ) ) : esc_html__( 'CHRONICLE', 'sportlixa' );
                $cat_link   = ! empty( $categories ) ? esc_url( get_category_link( $categories[0]->term_id ) ) : '#';
                $thumb_url  = has_post_thumbnail() 
                    ? get_the_post_thumbnail_url( get_the_ID(), 'medium_large' ) 
                    : 'https://images.unsplash.com/photo-1566577739112-5180d4bf9390?auto=format&fit=crop&w=800&q=80';

                $words      = str_word_count( strip_tags( get_the_content() ) );
                $read_time  = max( 1, ceil( $words / 200 ) );
                $sport_slug = ! empty( $categories ) ? strtolower( $categories[0]->slug ) : 'general';
                ?>
                
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'devnahian-sportlixa-archive-card' ); ?> data-sport="<?php echo esc_attr( $sport_slug ); ?>">
                  <div class="post-thumbnail devnahian-sportlixa-archive-thumb devnahian-sportlixa-img-box">
                    <span class="cat-links devnahian-sportlixa-badge-tag devnahian-sportlixa-archive-tag-pos">
                      <a href="<?php echo $cat_link; ?>"><?php echo $cat_name; ?></a>
                    </span>
                    <a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
                      <img 
                        src="<?php echo esc_url( $thumb_url ); ?>" 
                        alt="<?php echo esc_attr( get_the_title() ); ?>" 
                        class="attachment-post-thumbnail size-post-thumbnail wp-post-image"
                        loading="lazy"
                      >
                    </a>
                  </div>
                  <div class="entry-body devnahian-sportlixa-archive-content">
                    <header class="entry-header">
                      <h2 class="entry-title devnahian-sportlixa-archive-title">
                        <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                      </h2>
                    </header>
                    <div class="entry-summary devnahian-sportlixa-archive-excerpt">
                      <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 20 ) ); ?></p>
                    </div>
                    <footer class="entry-footer devnahian-sportlixa-archive-footer">
                      <span class="entry-meta-author byline author vcard">
                        <?php
                        printf(
                            /* translators: 1: author name, 2: reading time */
                            esc_html__( 'By %1$s • %2$d min read', 'sportlixa' ),
                            '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>',
                            $read_time
                        );
                        ?>
                      </span>
                      <a href="<?php the_permalink(); ?>" class="devnahian-sportlixa-title-link more-link">
                        <?php esc_html_e( 'Read Archive →', 'sportlixa' ); ?>
                      </a>
                    </footer>
                  </div>
                </article>

                <?php
            endwhile;

            if ( '' !== $current_date_group ) :
                echo '</div></div>'; // Close final entries wrap & timeline group
            endif;

        else :
            ?>
            <div class="devnahian-sportlixa-no-posts" style="padding: 40px; background: var(--sp-bg-surface); border: 1px solid var(--sp-border-subtle); border-radius: 8px; text-align: center;">
              <h3><?php esc_html_e( 'No archival records found for this period.', 'sportlixa' ); ?></h3>
              <p style="color:var(--sp-text-muted); margin-top:8px;"><?php esc_html_e( 'Try selecting a different season or sport category above.', 'sportlixa' ); ?></p>
            </div>
        <?php endif; ?>

      </section>

      <!-- Right Column: Sidebar (WordPress widget-area structure) -->
      <aside id="secondary" class="widget-area devnahian-sportlixa-archive-sidebar" aria-label="<?php esc_attr_e( 'Archive Sidebar', 'sportlixa' ); ?>">
        
        <!-- Widget 1: Vault Overview Stats -->
        <section id="vault_stats_widget-1" class="widget devnahian-sportlixa-vault-stats-card">
          <div class="devnahian-sportlixa-section-title" style="margin-bottom:0">
            <h2 class="widget-title devnahian-sportlixa-title-left" style="font-size:12.5px;"><?php esc_html_e( 'VAULT INDEX OVERVIEW', 'sportlixa' ); ?></h2>
          </div>
          <ul class="devnahian-sportlixa-stats-list">
            <li class="devnahian-sportlixa-stat-row">
              <span><?php esc_html_e( 'Articles in Vault', 'sportlixa' ); ?></span>
              <span class="devnahian-sportlixa-stat-val-bold">14,842</span>
            </li>
            <li class="devnahian-sportlixa-stat-row">
              <span><?php esc_html_e( 'Box Scores Preserved', 'sportlixa' ); ?></span>
              <span class="devnahian-sportlixa-stat-val-bold">5,210</span>
            </li>
            <li class="devnahian-sportlixa-stat-row">
              <span><?php esc_html_e( 'All-22 Film Studies', 'sportlixa' ); ?></span>
              <span class="devnahian-sportlixa-stat-val-bold">1,480</span>
            </li>
            <li class="devnahian-sportlixa-stat-row">
              <span><?php esc_html_e( 'Verified Injury Logs', 'sportlixa' ); ?></span>
              <span class="devnahian-sportlixa-stat-val-bold">3,912</span>
            </li>
          </ul>
        </section>

        <!-- Widget 2: Milestone Reel -->
        <section id="milestone_widget-1" class="widget devnahian-sportlixa-milestone-card">
          <span class="devnahian-sportlixa-milestone-tag"><?php esc_html_e( 'ARCHIVED MILESTONE', 'sportlixa' ); ?></span>
          <h3 class="widget-title devnahian-sportlixa-milestone-title"><?php esc_html_e( 'Super Bowl LVIII: Complete 4th Quarter & Overtime Film Vault', 'sportlixa' ); ?></h3>
          <p style="font-size:11.5px; color:var(--sp-text-muted); line-height:1.45;">
            <?php esc_html_e( 'Revisit every pass rush split, blitz pickup, and playcall chart from the legendary overtime battle in Las Vegas.', 'sportlixa' ); ?>
          </p>
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="devnahian-sportlixa-title-link" style="margin-top:4px;"><?php esc_html_e( 'Open Vault Reel →', 'sportlixa' ); ?></a>
        </section>

        <!-- Widget 3: Most Viewed Archives (Dynamic WP Query) -->
        <section id="trending_archive_widget-1" class="widget devnahian-sportlixa-trending-box">
          <h2 class="widget-title devnahian-sportlixa-trending-header"><?php esc_html_e( 'MOST VIEWED ARCHIVES', 'sportlixa' ); ?></h2>
          <ol class="devnahian-sportlixa-trending-list">
            <?php
            $popular_archives = new WP_Query( [
                'posts_per_page'      => 4,
                'orderby'             => 'comment_count',
                'post_status'         => 'publish',
                'ignore_sticky_posts' => 1,
            ] );

            $rank = 1;
            if ( $popular_archives->have_posts() ) :
                while ( $popular_archives->have_posts() ) :
                    $popular_archives->the_post();
                    ?>
                    <li class="devnahian-sportlixa-trending-item">
                      <span class="devnahian-sportlixa-trending-num" aria-hidden="true"><?php echo esc_html( $rank++ ); ?></span>
                      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </li>
                    <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
          </ol>
        </section>

      </aside>
    </div>

    <!-- Standard WordPress Pagination Markup -->
    <nav class="navigation pagination" aria-label="<?php esc_attr_e( 'Archive Navigation', 'sportlixa' ); ?>">
      <h2 class="screen-reader-text"><?php esc_html_e( 'Posts navigation', 'sportlixa' ); ?></h2>
      <div class="nav-links devnahian-sportlixa-pagination-wrap">
        <?php
        the_posts_pagination( [
            'mid_size'  => 2,
            'prev_text' => esc_html__( '« Previous', 'sportlixa' ),
            'next_text' => esc_html__( 'Next »', 'sportlixa' ),
        ] );
        ?>
      </div>
    </nav>
  </main>

<?php get_footer(); ?>