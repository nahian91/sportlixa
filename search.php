<?php
/**
 * The template for displaying search results pages
 *
 * @package Sportlixa
 */

get_header();

global $wp_query;
$search_query = get_search_query();
$total_posts  = $wp_query->found_posts;
?>

  <main class="devnahian-sportlixa-container">

    <!-- ==========================================================================
       DEDICATED SEARCH PAGE HERO & INTERACTIVE QUERY BAR
       ========================================================================== -->
    <section class="devnahian-sportlixa-search-hero">
      <nav class="devnahian-sportlixa-breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'sportlixa' ); ?>">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'sportlixa' ); ?></a>
        <span>/</span>
        <span><?php esc_html_e( 'Search Center', 'sportlixa' ); ?></span>
        <span>/</span>
        <span id="devnahian-sportlixa-queryBreadcrumb">"<?php echo esc_html( $search_query ); ?>"</span>
      </nav>

      <!-- Prominent Search Bar (Submits standard WordPress ?s= query) -->
      <form role="search" method="get" class="devnahian-sportlixa-search-box-large" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <svg class="devnahian-sportlixa-search-icon-left" viewBox="0 0 24 24" fill="none" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
        <input 
          type="search" 
          name="s" 
          class="devnahian-sportlixa-search-input-large" 
          id="devnahian-sportlixa-pageSearchInput" 
          value="<?php echo esc_attr( $search_query ); ?>" 
          placeholder="<?php esc_attr_e( 'Search by team, player, keyword, or matchup...', 'sportlixa' ); ?>"
          required
        >
        <button type="button" class="devnahian-sportlixa-search-clear-btn" id="devnahian-sportlixa-searchClearBtn" onclick="clearSearchInput()" aria-label="<?php esc_attr_e( 'Clear Search Input', 'sportlixa' ); ?>">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
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
          <span style="font-size:11px; text-transform:uppercase; font-weight:800; color:var(--sp-text-dim);"><?php esc_html_e( 'Suggested:', 'sportlixa' ); ?></span>
          <a href="<?php echo esc_url( home_url( '/?s=Patrick+Mahomes' ) ); ?>" class="devnahian-sportlixa-quick-tag">Patrick Mahomes</a>
          <a href="<?php echo esc_url( home_url( '/?s=Josh+Allen' ) ); ?>" class="devnahian-sportlixa-quick-tag">Josh Allen</a>
          <a href="<?php echo esc_url( home_url( '/?s=Lakers' ) ); ?>" class="devnahian-sportlixa-quick-tag">Lakers vs Celtics</a>
          <a href="<?php echo esc_url( home_url( '/?s=Injury+Wire' ) ); ?>" class="devnahian-sportlixa-quick-tag">Injury Wire</a>
        </div>
      </div>
    </section>

    <!-- Facet Filter Bar -->
    <div class="devnahian-sportlixa-facets-toolbar">
      <div class="devnahian-sportlixa-facets-nav">
        <button type="button" class="devnahian-sportlixa-facet-tab active" onclick="switchSearchFacet('all', this)">
          <?php printf( esc_html__( 'All Results (%d)', 'sportlixa' ), (int) $total_posts ); ?>
        </button>
      </div>

      <div class="devnahian-sportlixa-sort-wrap">
        <span><?php esc_html_e( 'Order:', 'sportlixa' ); ?></span>
        <select class="devnahian-sportlixa-sort-select" onchange="window.location.href = this.value;">
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
      <section class="devnahian-sportlixa-results-feed" id="devnahian-sportlixa-resultsFeed">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) :
                the_post();

                $post_cats = get_the_category();
                $badge_lbl = ! empty( $post_cats ) ? esc_html( strtoupper( $post_cats[0]->name ) ) : esc_html__( 'NEWS', 'sportlixa' );
                $thumb_url = has_post_thumbnail() 
                    ? get_the_post_thumbnail_url( get_the_ID(), 'medium_large' ) 
                    : 'https://images.unsplash.com/photo-1566577739112-5180d4bf9390?auto=format&fit=crop&w=800&q=80';

                $words     = str_word_count( strip_tags( get_the_content() ) );
                $read_time = max( 1, ceil( $words / 200 ) );

                // Highlight searched term in title & excerpt
                $raw_title   = get_the_title();
                $raw_excerpt = wp_trim_words( get_the_excerpt(), 24 );

                if ( ! empty( $search_query ) ) {
                    $highlighted_title   = preg_replace( '/(' . preg_quote( $search_query, '/' ) . ')/i', '<span class="devnahian-sportlixa-highlight-term">$1</span>', $raw_title );
                    $highlighted_excerpt = preg_replace( '/(' . preg_quote( $search_query, '/' ) . ')/i', '<span class="devnahian-sportlixa-highlight-term">$1</span>', $raw_excerpt );
                } else {
                    $highlighted_title   = $raw_title;
                    $highlighted_excerpt = $raw_excerpt;
                }
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'devnahian-sportlixa-result-card' ); ?> data-facet="articles">
                  <div class="devnahian-sportlixa-result-thumb devnahian-sportlixa-img-box">
                    <span class="devnahian-sportlixa-badge-tag devnahian-sportlixa-result-badge"><?php echo $badge_lbl; ?></span>
                    <a href="<?php the_permalink(); ?>">
                      <img 
                        src="<?php echo esc_url( $thumb_url ); ?>" 
                        alt="<?php echo esc_attr( get_the_title() ); ?>" 
                        loading="lazy"
                      >
                    </a>
                  </div>
                  <div class="devnahian-sportlixa-result-content">
                    <div>
                      <a href="<?php the_permalink(); ?>" class="devnahian-sportlixa-result-title">
                        <?php echo wp_kses_post( $highlighted_title ); ?>
                      </a>
                      <p class="devnahian-sportlixa-result-snippet">
                        <?php echo wp_kses_post( $highlighted_excerpt ); ?>
                      </p>
                    </div>
                    <div class="devnahian-sportlixa-result-footer">
                      <span>
                        <?php
                        printf(
                            /* translators: 1: author, 2: date, 3: minutes read */
                            esc_html__( 'By %1$s • %2$s • %3$d min read', 'sportlixa' ),
                            esc_html( get_the_author() ),
                            esc_html( get_the_date( 'M j, Y' ) ),
                            $read_time
                        );
                        ?>
                      </span>
                      <a href="<?php the_permalink(); ?>" class="devnahian-sportlixa-title-link"><?php esc_html_e( 'Read Full →', 'sportlixa' ); ?></a>
                    </div>
                  </div>
                </article>
                <?php
            endwhile;

            // WordPress native pagination
            ?>
            <div class="devnahian-sportlixa-pagination-wrap">
              <?php
              the_posts_pagination( [
                  'mid_size'  => 2,
                  'prev_text' => esc_html__( '« Previous', 'sportlixa' ),
                  'next_text' => esc_html__( 'Next »', 'sportlixa' ),
              ] );
              ?>
            </div>
            <?php

        else :
            ?>
            <!-- No Results Found Card -->
            <div class="devnahian-sportlixa-no-results-card" style="background:var(--sp-bg-surface); border:1px solid var(--sp-border-subtle); border-radius:var(--sp-radius-md); padding:40px 24px; text-align:center;">
              <span class="devnahian-sportlixa-badge-tag" style="background:var(--devnahian-sportlixa-brand-orange); color:#fff !important; margin-bottom:12px;">
                <?php esc_html_e( 'PLAY INCOMPLETE', 'sportlixa' ); ?>
              </span>
              <h2 style="font-size:22px; font-weight:900; font-style:italic; text-transform:uppercase; margin-bottom:10px; color:var(--sp-text-main);">
                <?php esc_html_e( 'No Matches On The Tape', 'sportlixa' ); ?>
              </h2>
              <p style="font-size:14px; color:var(--sp-text-muted); max-width:520px; margin:0 auto 20px;">
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
            <a href="<?php echo esc_url( add_query_arg( 's', $search_query, home_url( '/' ) ) ); ?>" style="color:var(--devnahian-sportlixa-brand-volt); font-size:10px; font-weight:800;">
              <?php esc_html_e( 'Reset', 'sportlixa' ); ?>
            </a>
          </div>
          <ul class="devnahian-sportlixa-filter-list">
            <?php
            $leagues = get_categories( [ 'hide_empty' => true, 'number' => 6 ] );
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
                    <span class="devnahian-sportlixa-count-pill"><?php echo esc_html( $league->count ); ?></span>
                  </a>
                </li>
            <?php endforeach; ?>
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

<?php get_footer(); ?>