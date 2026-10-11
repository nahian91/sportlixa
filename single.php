<?php
/**
 * The template for displaying all single posts
 *
 * @package Sportlixa
 */

get_header();

while ( have_posts() ) :
    the_post();

    // Calculate dynamic reading time
    $post_words = str_word_count( strip_tags( get_the_content() ) );
    $read_time  = max( 1, ceil( $post_words / 200 ) );

    // Category data
    $categories = get_the_category();
    $primary_cat = ! empty( $categories ) ? $categories[0] : null;

    // Featured image data
    $thumb_id      = get_post_thumbnail_id();
    $thumb_caption = wp_get_attachment_caption( $thumb_id );
    $thumb_alt     = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );
    $author_id     = get_the_author_meta( 'ID' );
    $author_bio    = get_the_author_meta( 'description' );
    ?>

  <main class="devnahian-sportlixa-container">

    <!-- ==========================================================================
       ARTICLE HEADER & BREADCRUMBS
       ========================================================================== -->
    <header class="devnahian-sportlixa-article-header">
      <nav class="devnahian-sportlixa-breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'sportlixa' ); ?>">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'sportlixa' ); ?></a>
        <span>/</span>
        <?php if ( $primary_cat ) : ?>
          <a href="<?php echo esc_url( get_category_link( $primary_cat->term_id ) ); ?>"><?php echo esc_html( $primary_cat->name ); ?></a>
          <span>/</span>
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
            <?php echo get_avatar( $author_id, 80, '', esc_attr( get_the_author() ) ); ?>
          </div>
          <div class="devnahian-sportlixa-author-details">
            <div class="devnahian-sportlixa-author-name">
              <a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>">
                <?php the_author(); ?>
              </a>
              <span class="devnahian-sportlixa-verified-badge" title="<?php esc_attr_e( 'Verified Sports Analyst', 'sportlixa' ); ?>">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
              </span>
            </div>
            <div class="devnahian-sportlixa-author-role">
              <?php
              printf(
                  /* translators: 1: formatted date, 2: reading time in minutes */
                  esc_html__( 'Updated %1$s • %2$d min read', 'sportlixa' ),
                  get_the_modified_date( 'M j, Y' ),
                  $read_time
              );
              ?>
            </div>
          </div>
        </div>

        <div class="devnahian-sportlixa-share-bar">
          <button type="button" class="devnahian-sportlixa-share-btn" onclick="shareArticle('<?php echo esc_js( get_the_title() ); ?>')">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg>
            <?php esc_html_e( 'Share', 'sportlixa' ); ?>
          </button>
          <button type="button" class="devnahian-sportlixa-share-btn" id="devnahian-sportlixa-btnBookmarkPost" onclick="togglePostBookmark(this)">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/></svg>
            <?php esc_html_e( 'Save', 'sportlixa' ); ?>
          </button>
          <button type="button" class="devnahian-sportlixa-share-btn" onclick="window.print()">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
            <?php esc_html_e( 'Print', 'sportlixa' ); ?>
          </button>
        </div>
      </div>
    </header>

    <!-- ==========================================================================
       MAIN ARTICLE CONTENT & SIDEBAR GRID
       ========================================================================== -->
    <div class="devnahian-sportlixa-post-layout">
      <!-- Left Column: Editorial Body -->
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        
        <?php if ( has_post_thumbnail() ) : ?>
          <figure class="devnahian-sportlixa-featured-media-box">
            <?php the_post_thumbnail( 'full', [
                'class'   => 'devnahian-sportlixa-featured-img',
                'loading' => 'eager',
                'alt'     => ! empty( $thumb_alt ) ? esc_attr( $thumb_alt ) : esc_attr( get_the_title() ),
            ] ); ?>

            <?php if ( ! empty( $thumb_caption ) ) : ?>
              <figcaption class="devnahian-sportlixa-media-caption">
                <span><?php echo esc_html( $thumb_caption ); ?></span>
                <span><?php esc_html_e( 'Photo: SportLixa Visual Wire', 'sportlixa' ); ?></span>
              </figcaption>
            <?php endif; ?>
          </figure>
        <?php endif; ?>

        <!-- Rich Gutenberg Editorial Body -->
        <div class="devnahian-sportlixa-editorial-body">
          <?php
          the_content();

          wp_link_pages( [
              'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'sportlixa' ),
              'after'  => '</div>',
          ] );
          ?>
        </div>

        <!-- Dynamic Post Tags -->
        <?php
        $post_tags = get_the_tags();
        if ( ! empty( $post_tags ) ) :
            ?>
            <div class="devnahian-sportlixa-post-tags">
              <?php foreach ( $post_tags as $tag ) : ?>
                <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="devnahian-sportlixa-tag-pill">
                  #<?php echo esc_html( $tag->name ); ?>
                </a>
              <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Dynamic Author Bio Card -->
        <div class="devnahian-sportlixa-author-bio-card">
          <div class="devnahian-sportlixa-bio-avatar">
            <?php echo get_avatar( $author_id, 100, '', esc_attr( get_the_author() ) ); ?>
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

        <!-- WordPress Comments System -->
        <?php
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;
        ?>

      </article>

      <!-- Right Column: Sidebar -->
      <aside class="devnahian-sportlixa-post-sidebar" aria-label="<?php esc_attr_e( 'Article Sidebar', 'sportlixa' ); ?>">

        <!-- Live Matchup Marquee -->
        <div class="devnahian-sportlixa-marquee-game-card">
          <div class="devnahian-sportlixa-marquee-header">
            <span class="devnahian-sportlixa-marquee-live-tag"><?php esc_html_e( 'NEXT BIG MATCHUP', 'sportlixa' ); ?></span>
            <span>SUN 4:25 PM • CBS</span>
          </div>
          <div class="devnahian-sportlixa-marquee-teams">
            <div class="devnahian-sportlixa-marquee-team">
              <span class="abbr">KC</span>
              <span class="rec">(4-0)</span>
            </div>
            <span class="devnahian-sportlixa-marquee-vs">VS</span>
            <div class="devnahian-sportlixa-marquee-team">
              <span class="abbr">BUF</span>
              <span class="rec">(3-1)</span>
            </div>
          </div>
          <div class="devnahian-sportlixa-marquee-odds">
            <span>Spread: <strong>KC -2.5</strong></span>
            <span>Total: <strong>O/U 48.5</strong></span>
          </div>
          <a href="<?php echo esc_url( home_url( '/#scores' ) ); ?>" class="devnahian-sportlixa-btn-marquee-action">
            <?php esc_html_e( 'MATCHUP GAMECAST &rarr;', 'sportlixa' ); ?>
          </a>
        </div>

        <!-- NFL Stat Leaders (Quick Widget) -->
        <div class="devnahian-sportlixa-nfl-leaders-box">
          <div class="devnahian-sportlixa-section-title" style="margin-bottom:0">
            <div class="devnahian-sportlixa-title-left" style="font-size:12.5px;"><?php esc_html_e( 'NFL STAT LEADERS', 'sportlixa' ); ?></div>
          </div>

          <div class="devnahian-sportlixa-leader-row">
            <div class="devnahian-sportlixa-leader-player-wrap">
              <div class="devnahian-sportlixa-leader-avatar">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/77/Patrick_Mahomes_gets_ready_to_snap_the_ball.jpg/300px-Patrick_Mahomes_gets_ready_to_snap_the_ball.jpg" alt="Patrick Mahomes" loading="lazy">
              </div>
              <div>
                <div class="devnahian-sportlixa-leader-player-name">P. Mahomes</div>
                <div class="devnahian-sportlixa-leader-cat">Pass Yds • KC</div>
              </div>
            </div>
            <div class="devnahian-sportlixa-leader-stat">
              <div class="devnahian-sportlixa-leader-value">1,315</div>
              <div class="devnahian-sportlixa-leader-unit">11 TD</div>
            </div>
          </div>

          <div class="devnahian-sportlixa-leader-row">
            <div class="devnahian-sportlixa-leader-player-wrap">
              <div class="devnahian-sportlixa-leader-avatar">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/50/Josh_Allen_SEPT2021_%28cropped%29.jpg/300px-Josh_Allen_SEPT2021_%28cropped%29.jpg" alt="Josh Allen" loading="lazy">
              </div>
              <div>
                <div class="devnahian-sportlixa-leader-player-name">J. Allen</div>
                <div class="devnahian-sportlixa-leader-cat">Total QBR • BUF</div>
              </div>
            </div>
            <div class="devnahian-sportlixa-leader-stat">
              <div class="devnahian-sportlixa-leader-value">84.2</div>
              <div class="devnahian-sportlixa-leader-unit">Rating</div>
            </div>
          </div>

          <div class="devnahian-sportlixa-leader-row">
            <div class="devnahian-sportlixa-leader-player-wrap">
              <div class="devnahian-sportlixa-leader-avatar">
                <img src="https://commons.wikimedia.org/wiki/Special:FilePath/Kenneth_Walker_III_being_interviewed_by_Time2Football_2026_(cropped).png" alt="Kenneth Walker" loading="lazy">
              </div>
              <div>
                <div class="devnahian-sportlixa-leader-player-name">K. Walker III</div>
                <div class="devnahian-sportlixa-leader-cat">Rush Yds • SEA</div>
              </div>
            </div>
            <div class="devnahian-sportlixa-leader-stat">
              <div class="devnahian-sportlixa-leader-value">537</div>
              <div class="devnahian-sportlixa-leader-unit">6 TD</div>
            </div>
          </div>
        </div>

        <!-- Dynamic Trending Stories Query -->
        <div class="devnahian-sportlixa-trending-box">
          <div class="devnahian-sportlixa-trending-header"><?php esc_html_e( 'TRENDING STORIES', 'sportlixa' ); ?></div>
          <ol class="devnahian-sportlixa-trending-list">
            <?php
            $trending_posts = new WP_Query( [
                'posts_per_page'      => 4,
                'orderby'             => 'comment_count',
                'post__not_in'        => [ get_the_ID() ],
                'post_status'         => 'publish',
                'ignore_sticky_posts' => 1,
            ] );

            $rank = 1;
            if ( $trending_posts->have_posts() ) :
                while ( $trending_posts->have_posts() ) :
                    $trending_posts->the_post();
                    ?>
                    <li class="devnahian-sportlixa-trending-item">
                      <span class="devnahian-sportlixa-trending-num"><?php echo esc_html( $rank++ ); ?></span>
                      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </li>
                    <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
          </ol>
        </div>

      </aside>
    </div>

    <!-- ==========================================================================
       RELATED STORIES (Querying Same Category, Excluding Current Post)
       ========================================================================== -->
    <?php
    if ( $primary_cat ) :
        $related_query = new WP_Query( [
            'category__in'        => [ $primary_cat->term_id ],
            'post__not_in'        => [ get_the_ID() ],
            'posts_per_page'      => 3,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
        ] );

        if ( $related_query->have_posts() ) :
            ?>
            <section class="devnahian-sportlixa-related-section">
              <div class="devnahian-sportlixa-section-title">
                <div class="devnahian-sportlixa-title-left"><?php esc_html_e( 'RELATED STORIES', 'sportlixa' ); ?></div>
                <a href="<?php echo esc_url( get_category_link( $primary_cat->term_id ) ); ?>" class="devnahian-sportlixa-title-link">
                  <?php printf( esc_html__( 'More in %s &rarr;', 'sportlixa' ), esc_html( $primary_cat->name ) ); ?>
                </a>
              </div>

              <div class="devnahian-sportlixa-related-grid">
                <?php
                while ( $related_query->have_posts() ) :
                    $related_query->the_post();
                    $rel_thumb = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'medium_large' ) : 'https://images.unsplash.com/photo-1566577739112-5180d4bf9390?auto=format&fit=crop&w=800&q=80';
                    $rel_words = str_word_count( strip_tags( get_the_content() ) );
                    $rel_read  = max( 1, ceil( $rel_words / 200 ) );
                    ?>
                    <article class="devnahian-sportlixa-related-card">
                      <div class="devnahian-sportlixa-related-thumb devnahian-sportlixa-img-box">
                        <span class="devnahian-sportlixa-badge-tag devnahian-sportlixa-related-badge">
                          <?php echo esc_html( strtoupper( $primary_cat->name ) ); ?>
                        </span>
                        <img 
                          src="<?php echo esc_url( $rel_thumb ); ?>" 
                          alt="<?php echo esc_attr( get_the_title() ); ?>" 
                          loading="lazy"
                        >
                      </div>
                      <div class="devnahian-sportlixa-related-content">
                        <h4 class="devnahian-sportlixa-related-title">
                          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h4>
                        <div class="devnahian-sportlixa-meta-time">
                          <?php echo esc_html( get_the_date( 'M j, Y' ) ); ?> • <?php printf( esc_html__( '%d min read', 'sportlixa' ), $rel_read ); ?>
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