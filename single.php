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
    $categories  = get_the_category();
    $primary_cat = ! empty( $categories ) ? $categories[0] : null;

    // Featured image & author data
    $thumb_id      = get_post_thumbnail_id();
    $thumb_caption = wp_get_attachment_caption( $thumb_id );
    $thumb_alt     = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );
    $author_id     = get_the_author_meta( 'ID' );
    $author_bio    = get_the_author_meta( 'description' );
    ?>

  <main class="devnahian-sportlixa-container">

    <!-- ==========================================================================
       ARTICLE HEADER & NON-STICKY BREADCRUMBS
       ========================================================================== -->
    <header class="devnahian-sportlixa-article-header" style="position: static !important;">
      <nav class="devnahian-sportlixa-breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'sportlixa' ); ?>" style="position: static !important; top: auto !important;">
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
       MAIN CONTENT & NON-STICKY EDITORIAL SIDEBAR
       ========================================================================== -->
    <div class="devnahian-sportlixa-post-layout">
      <!-- Left Column: Article Body -->
      <article id="post-<?php the_ID(); ?>" <?php post_class( 'devnahian-sportlixa-post-main' ); ?>>
        
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
        <div class="devnahian-sportlixa-editorial-body entry-content">
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

      <!-- Right Column: Sidebar (Non-Sticky, Replaced with Latest Posts & Categories) -->
      <aside class="devnahian-sportlixa-post-sidebar devnahian-sportlixa-editorial-sidebar" aria-label="<?php esc_attr_e( 'Article Sidebar', 'sportlixa' ); ?>">

        <?php if ( is_active_sidebar( 'sportlixa-post-sidebar' ) ) : ?>
          <?php dynamic_sidebar( 'sportlixa-post-sidebar' ); ?>
        <?php else : ?>

          <!-- 1. LATEST POSTS WIDGET -->
          <div class="devnahian-sportlixa-sidebar-card">
            <div class="devnahian-sportlixa-section-title" style="margin-bottom: 1rem;">
              <div class="devnahian-sportlixa-title-left" style="font-size: 0.85rem;"><?php esc_html_e( 'LATEST STORIES', 'sportlixa' ); ?></div>
            </div>

            <div class="devnahian-sportlixa-sidebar-posts-list">
              <?php
              $latest_sidebar_posts = new WP_Query( [
                  'posts_per_page'      => 4,
                  'post__not_in'        => [ get_the_ID() ],
                  'post_status'         => 'publish',
                  'ignore_sticky_posts' => 1,
              ] );

              if ( $latest_sidebar_posts->have_posts() ) :
                  while ( $latest_sidebar_posts->have_posts() ) :
                      $latest_sidebar_posts->the_post();
                      $side_thumb = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ) : 'https://images.unsplash.com/photo-1546519638-68e109498ffc?auto=format&fit=crop&w=150&q=80';
                      $side_words = str_word_count( strip_tags( get_the_content() ) );
                      $side_read  = max( 1, ceil( $side_words / 200 ) );
                      ?>
                      <article class="devnahian-sportlixa-side-post-row">
                        <a href="<?php the_permalink(); ?>" class="devnahian-sportlixa-side-post-thumb">
                          <img src="<?php echo esc_url( $side_thumb ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" loading="lazy">
                        </a>
                        <div class="devnahian-sportlixa-side-post-info">
                          <h4 class="devnahian-sportlixa-side-post-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                          </h4>
                          <span class="devnahian-sportlixa-meta-time">
                            <?php echo esc_html( get_the_date( 'M j, Y' ) ); ?> • <?php printf( esc_html__( '%d min read', 'sportlixa' ), $side_read ); ?>
                          </span>
                        </div>
                      </article>
                      <?php
                  endwhile;
                  wp_reset_postdata();
              endif;
              ?>
            </div>
          </div>

          <!-- 2. LEAGUE CATEGORIES WIDGET -->
          <div class="devnahian-sportlixa-sidebar-card">
            <div class="devnahian-sportlixa-section-title" style="margin-bottom: 1rem;">
              <div class="devnahian-sportlixa-title-left" style="font-size: 0.85rem;"><?php esc_html_e( 'EXPLORE LEAGUES', 'sportlixa' ); ?></div>
            </div>

            <ul class="devnahian-sportlixa-categories-list">
              <?php
              $all_categories = get_categories( [
                  'orderby'    => 'count',
                  'order'      => 'DESC',
                  'number'     => 6,
                  'hide_empty' => true,
              ] );

              foreach ( $all_categories as $cat ) :
                  ?>
                  <li class="devnahian-sportlixa-cat-item">
                    <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>">
                      <span class="cat-name"><?php echo esc_html( $cat->name ); ?></span>
                      <span class="cat-count"><?php echo esc_html( $cat->count ); ?></span>
                    </a>
                  </li>
                  <?php
              endforeach;
              ?>
            </ul>
          </div>

          <!-- 3. POPULAR TAGS WIDGET -->
          <div class="devnahian-sportlixa-sidebar-card">
            <div class="devnahian-sportlixa-section-title" style="margin-bottom: 1rem;">
              <div class="devnahian-sportlixa-title-left" style="font-size: 0.85rem;"><?php esc_html_e( 'POPULAR TOPICS', 'sportlixa' ); ?></div>
            </div>

            <div class="devnahian-sportlixa-tags-cloud">
              <?php
              $popular_tags = get_tags( [
                  'orderby' => 'count',
                  'order'   => 'DESC',
                  'number'  => 8,
              ] );

              if ( ! empty( $popular_tags ) ) :
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
                          <span><?php echo esc_html( get_the_date( 'M j, Y' ) ); ?></span> •
                          <span><?php printf( esc_html__( '%d min read', 'sportlixa' ), $rel_read ); ?></span>
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