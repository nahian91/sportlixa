<?php
/**
 * Footer Template - Fully Dynamic Footer Menus
 *
 * @package Sportlixa
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

  <!-- ==========================================================================
       PROFESSIONAL FOOTER (Columns 2, 3, 4 Dynamic)
       ========================================================================== -->
  <footer>
    <div class="devnahian-sportlixa-container">
      <div class="devnahian-sportlixa-footer-top">

        <!-- Col 1: Brand & Socials -->
        <div class="devnahian-sportlixa-footer-col">
          <div class="devnahian-sportlixa-brand-logo-wrap" style="margin-bottom: 14px;">
            <?php
            if ( has_custom_logo() ) :
                the_custom_logo();
            else :
                ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                  <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo.png' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                </a>
            <?php endif; ?>
          </div>
          <p class="devnahian-sportlixa-footer-desc">
            <?php
            $desc = get_bloginfo( 'description' );
            echo esc_html( ! empty( $desc ) ? $desc : __( 'The definitive digital sports newsroom delivering real-time NFL analytics, verified injury reports, video breakdowns, and live scoreboards.', 'sportlixa' ) );
            ?>
          </p>
          <div class="devnahian-sportlixa-social-links" style="display:flex; margin-top: 14px;">
            <a href="https://twitter.com" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'X Twitter', 'sportlixa' ); ?>"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg></a>
            <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Facebook', 'sportlixa' ); ?>"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M9 8H6v4h3v12h5V12h3.642L18 8h-4V6.333C14 5.374 14.5 5 15.5 5H18V0h-3.808C10.595 0 9 1.583 9 4.615V8z"/></svg></a>
            <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Instagram', 'sportlixa' ); ?>"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg></a>
            <a href="https://youtube.com" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'YouTube', 'sportlixa' ); ?>"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg></a>
          </div>
        </div>

        <!-- Col 2: Dynamic Quick Links -->
        <div class="devnahian-sportlixa-footer-col">
          <div class="devnahian-sportlixa-footer-col-title"><?php esc_html_e( 'Quick Links', 'sportlixa' ); ?></div>
          <ul class="devnahian-sportlixa-footer-links-list">
            <?php
            if ( has_nav_menu( 'footer-quick-links' ) ) :
                wp_nav_menu( [
                    'theme_location' => 'footer-quick-links',
                    'container'      => false,
                    'items_wrap'     => '%3$s',
                    'walker'         => new Sportlixa_Footer_Nav_Walker(),
                ] );
            else :
                ?>
                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><svg class="devnahian-sportlixa-footer-menu-arrow" viewBox="0 0 24 24" fill="none" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg><span><?php esc_html_e( 'Home', 'sportlixa' ); ?></span></a></li>
            <?php endif; ?>
          </ul>
        </div>

        <!-- Col 3: Dynamic More Links -->
        <div class="devnahian-sportlixa-footer-col">
          <div class="devnahian-sportlixa-footer-col-title"><?php esc_html_e( 'More', 'sportlixa' ); ?></div>
          <ul class="devnahian-sportlixa-footer-links-list">
            <?php
            if ( has_nav_menu( 'footer-more' ) ) :
                wp_nav_menu( [
                    'theme_location' => 'footer-more',
                    'container'      => false,
                    'items_wrap'     => '%3$s',
                    'walker'         => new Sportlixa_Footer_Nav_Walker(),
                ] );
            else :
                ?>
                <li><a href="<?php echo esc_url( home_url( '/category/scores/' ) ); ?>"><svg class="devnahian-sportlixa-footer-menu-arrow" viewBox="0 0 24 24" fill="none" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg><span><?php esc_html_e( 'Live Scores', 'sportlixa' ); ?></span></a></li>
            <?php endif; ?>
          </ul>
        </div>

        <!-- Col 4: Dynamic Legal Links -->
        <div class="devnahian-sportlixa-footer-col">
          <div class="devnahian-sportlixa-footer-col-title"><?php esc_html_e( 'Legal', 'sportlixa' ); ?></div>
          <ul class="devnahian-sportlixa-footer-links-list">
            <?php
            if ( has_nav_menu( 'footer-legal' ) ) :
                wp_nav_menu( [
                    'theme_location' => 'footer-legal',
                    'container'      => false,
                    'items_wrap'     => '%3$s',
                    'walker'         => new Sportlixa_Footer_Nav_Walker(),
                ] );
            else :
                ?>
                <li><a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><svg class="devnahian-sportlixa-footer-menu-arrow" viewBox="0 0 24 24" fill="none" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg><span><?php esc_html_e( 'Privacy Policy', 'sportlixa' ); ?></span></a></li>
            <?php endif; ?>
          </ul>
        </div>

        <!-- Col 5: Stay Updated -->
        <div class="devnahian-sportlixa-footer-col">
          <div class="devnahian-sportlixa-footer-col-title"><?php esc_html_e( 'Stay Updated', 'sportlixa' ); ?></div>
          <p style="font-size:12px; color:var(--sp-text-muted); line-height:1.45;">
            <?php esc_html_e( 'Get sports highlights & daily updates.', 'sportlixa' ); ?>
          </p>
          <form class="devnahian-sportlixa-footer-subscribe-box" id="devnahian-sportlixa-newsletter-form">
            <input type="email" class="devnahian-sportlixa-footer-subscribe-input" placeholder="<?php esc_attr_e( 'Enter your email', 'sportlixa' ); ?>" required>
            <button type="submit" class="devnahian-sportlixa-footer-subscribe-btn" aria-label="<?php esc_attr_e( 'Send Email', 'sportlixa' ); ?>">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
            </button>
          </form>
        </div>

      </div>

      <!-- Footer Bottom Copyright & Tagline -->
      <div class="devnahian-sportlixa-footer-bottom">
        <div>&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved.', 'sportlixa' ); ?></div>
        <div class="devnahian-sportlixa-footer-bottom-tagline">
          <?php esc_html_e( 'Your Sports. Your Game. Your Edge.', 'sportlixa' ); ?>
        </div>
      </div>
    </div>
  </footer>

  <!-- ==========================================================================
       COMMAND-K / INSTANT SEARCH OVERLAY MODAL
       ========================================================================== -->
  <div class="devnahian-sportlixa-search-modal-backdrop" id="devnahian-sportlixa-searchModalBackdrop" aria-hidden="true">
    <div class="devnahian-sportlixa-search-modal" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Site Search', 'sportlixa' ); ?>">
      <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="devnahian-sportlixa-search-modal-input-wrap">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
        <input type="search" name="s" class="devnahian-sportlixa-search-modal-input" id="devnahian-sportlixa-modalSearchInput" placeholder="<?php esc_attr_e( 'Type a sport, team, or player (e.g. Mahomes, Lakers, MLB)...', 'sportlixa' ); ?>" autocomplete="off">
        <button type="button" class="devnahian-sportlixa-search-modal-close" id="devnahian-sportlixa-modalCloseBtn" aria-label="<?php esc_attr_e( 'Close Search', 'sportlixa' ); ?>">ESC</button>
      </form>

      <ul class="devnahian-sportlixa-search-results-list" id="devnahian-sportlixa-searchResults">
        <?php
        $sportlixa_search_preview = new WP_Query( [
            'posts_per_page'      => 5,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
        ] );

        if ( $sportlixa_search_preview->have_posts() ) :
            while ( $sportlixa_search_preview->have_posts() ) :
                $sportlixa_search_preview->the_post();
                $cats = get_the_category();
                $cat_badge = ! empty( $cats ) ? strtoupper( $cats[0]->name ) : 'SPORT';
                ?>
                <li class="devnahian-sportlixa-search-result-item" data-url="<?php the_permalink(); ?>">
                  <span><strong><?php the_title(); ?></strong></span>
                  <span class="sport-badge"><?php echo esc_html( $cat_badge ); ?></span>
                </li>
                <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
      </ul>
    </div>
  </div>

  <?php wp_footer(); ?>
</body>
</html>