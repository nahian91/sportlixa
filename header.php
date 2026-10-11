<?php
/**
 * Header Template - Fully Dynamic Menus
 *
 * @package Sportlixa
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?> data-theme="dark">
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

  <!-- Reading Progress Bar -->
  <div class="devnahian-sportlixa-progress-line" id="devnahian-sportlixa-progressLine"></div>

  <!-- HUD Toast Notification -->
  <div class="devnahian-sportlixa-toast" id="devnahian-sportlixa-toast" role="alert" aria-live="polite">
    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--devnahian-sportlixa-brand-volt)" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
    <span id="devnahian-sportlixa-toast-msg"><?php esc_html_e( 'Action completed', 'sportlixa' ); ?></span>
  </div>

  <!-- Back to Top Floating Pill -->
  <button type="button" class="devnahian-sportlixa-back-to-top" id="devnahian-sportlixa-backToTop" aria-label="<?php esc_attr_e( 'Scroll Back to Top', 'sportlixa' ); ?>">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="18 15 12 9 6 15"/></svg>
  </button>

  <!-- ==========================================================================
       LATEST NEWS TICKER
       ========================================================================== -->
  <div class="devnahian-sportlixa-news-ticker-bar">
    <div class="devnahian-sportlixa-ticker-badge-wrap">
      <span class="devnahian-sportlixa-ticker-pulse-dot"></span>
      <span><?php esc_html_e( 'Latest News', 'sportlixa' ); ?></span>
    </div>
    <div class="devnahian-sportlixa-ticker-marquee-box">
      <div class="devnahian-sportlixa-ticker-track">
        <?php
        $sportlixa_ticker = new WP_Query( [
            'posts_per_page'      => 6,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
        ] );

        if ( $sportlixa_ticker->have_posts() ) :
            while ( $sportlixa_ticker->have_posts() ) :
                $sportlixa_ticker->the_post();
                $cats = get_the_category();
                $cat_badge = ! empty( $cats ) ? esc_html( $cats[0]->name ) : esc_html__( 'Live', 'sportlixa' );
                ?>
                <a href="<?php the_permalink(); ?>" class="devnahian-sportlixa-ticker-item">
                  <span class="tag"><?php echo $cat_badge; ?></span>
                  <?php the_title(); ?>
                  <span class="sep">&bull;</span>
                </a>
                <?php
            endwhile;
            wp_reset_postdata();
        else :
            ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="devnahian-sportlixa-ticker-item">
              <span class="tag"><?php esc_html_e( 'SPORTLIXA', 'sportlixa' ); ?></span>
              <?php esc_html_e( 'Your Sports. Your Game. Your Edge.', 'sportlixa' ); ?>
              <span class="sep">&bull;</span>
            </a>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <!-- ==========================================================================
       MOBILE DRAWER (Dynamic 'drawer-menu')
       ========================================================================== -->
  <div class="devnahian-sportlixa-drawer-overlay" id="devnahian-sportlixa-drawerOverlay"></div>
  <aside class="devnahian-sportlixa-mobile-drawer" id="devnahian-sportlixa-mobileDrawer" aria-label="<?php esc_attr_e( 'Mobile Navigation Menu', 'sportlixa' ); ?>">
    <div class="devnahian-sportlixa-drawer-header">
      <div class="devnahian-sportlixa-brand-logo-wrap">
        <?php
        if ( has_custom_logo() ) :
            the_custom_logo();
        else :
            ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="devnahian-sportlixa-brand-title" style="font-size:20px;">
              <span class="part-sport">SPORT</span><span class="part-lixa">LIXA</span>
            </a>
        <?php endif; ?>
      </div>
      <button type="button" class="devnahian-sportlixa-drawer-close-btn" id="devnahian-sportlixa-drawerCloseBtn" aria-label="<?php esc_attr_e( 'Close Navigation', 'sportlixa' ); ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <line x1="18" y1="6" x2="6" y2="18"/>
          <line x1="6" y1="6" x2="18" y2="18"/>
        </svg>
      </button>
    </div>

    <div class="devnahian-sportlixa-drawer-content">
      <?php
      if ( has_nav_menu( 'drawer-menu' ) ) :
          wp_nav_menu( [
              'theme_location' => 'drawer-menu',
              'container'      => false,
              'items_wrap'     => '%3$s',
              'walker'         => new Sportlixa_Drawer_Nav_Walker(),
          ] );
      elseif ( has_nav_menu( 'primary-menu' ) ) :
          wp_nav_menu( [
              'theme_location' => 'primary-menu',
              'container'      => false,
              'items_wrap'     => '%3$s',
              'walker'         => new Sportlixa_Drawer_Nav_Walker(),
          ] );
      else :
          ?>
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="devnahian-sportlixa-mobile-nav-link active">
            <span><?php esc_html_e( 'Home', 'sportlixa' ); ?></span>
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
          </a>
      <?php endif; ?>
    </div>
  </aside>

  <!-- ==========================================================================
       MOBILE APP BOTTOM BAR (Dynamic 'mobile-bottom-bar' + Drawer Trigger)
       ========================================================================== -->
  <nav class="devnahian-sportlixa-mobile-bottom-bar" aria-label="<?php esc_attr_e( 'Mobile Bottom App Bar', 'sportlixa' ); ?>">
    <?php
    if ( has_nav_menu( 'mobile-bottom-bar' ) ) :
        wp_nav_menu( [
            'theme_location' => 'mobile-bottom-bar',
            'container'      => false,
            'items_wrap'     => '%3$s',
            'walker'         => new Sportlixa_Bottom_Bar_Nav_Walker(),
        ] );
    else :
        ?>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="devnahian-sportlixa-bottom-bar-item <?php echo is_front_page() ? 'active' : ''; ?>">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
          <span><?php esc_html_e( 'Home', 'sportlixa' ); ?></span>
        </a>
        <a href="<?php echo esc_url( home_url( '/#scores' ) ); ?>" class="devnahian-sportlixa-bottom-bar-item">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/></svg>
          <span><?php esc_html_e( 'Scores', 'sportlixa' ); ?></span>
        </a>
        <a href="<?php echo esc_url( home_url( '/#nfl-standings' ) ); ?>" class="devnahian-sportlixa-bottom-bar-item">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
          <span><?php esc_html_e( 'NFL', 'sportlixa' ); ?></span>
        </a>
        <a href="<?php echo esc_url( home_url( '/#trending' ) ); ?>" class="devnahian-sportlixa-bottom-bar-item">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
          <span><?php esc_html_e( 'Trending', 'sportlixa' ); ?></span>
        </a>
    <?php endif; ?>

    <!-- Drawer trigger tab (retained at the end of bottom bar) -->
    <div class="devnahian-sportlixa-bottom-bar-item" id="devnahian-sportlixa-mobileMenuTab" role="button" tabindex="0" aria-label="<?php esc_attr_e( 'Open Navigation Menu', 'sportlixa' ); ?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
      <span><?php esc_html_e( 'Menu', 'sportlixa' ); ?></span>
    </div>
  </nav>

  <!-- ==========================================================================
       HEADER & DIRECT NAVBAR
       ========================================================================== -->
  <header>
    <div class="devnahian-sportlixa-container">
      <div class="devnahian-sportlixa-header-top">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="devnahian-sportlixa-brand-logo-wrap" rel="home">
          <?php
          if ( has_custom_logo() ) :
              the_custom_logo();
          else :
              ?>
              <div class="devnahian-sportlixa-brand-title">
                <span class="part-sport">SPORT</span><span class="part-lixa">LIXA</span>
              </div>
          <?php endif; ?>
        </a>

        <div class="devnahian-sportlixa-header-actions">
          <div class="devnahian-sportlixa-social-links">
            <a href="https://twitter.com" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'X Twitter', 'sportlixa' ); ?>"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg></a>
            <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Facebook', 'sportlixa' ); ?>"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M9 8H6v4h3v12h5V12h3.642L18 8h-4V6.333C14 5.374 14.5 5 15.5 5H18V0h-3.808C10.595 0 9 1.583 9 4.615V8z"/></svg></a>
            <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Instagram', 'sportlixa' ); ?>"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg></a>
            <a href="https://youtube.com" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'YouTube', 'sportlixa' ); ?>"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg></a>
          </div>

          <button type="button" class="devnahian-sportlixa-theme-toggle-btn" id="devnahian-sportlixa-themeToggleBtn" aria-label="<?php esc_attr_e( 'Switch Theme', 'sportlixa' ); ?>">
            <svg class="moon-icon" viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
            <svg class="sun-icon" viewBox="0 0 24 24" fill="none" stroke-width="2"><circle cx="12" cy="12" r="5"/><path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/></svg>
            <span id="devnahian-sportlixa-themeToggleText"><?php esc_html_e( 'Dark', 'sportlixa' ); ?></span>
          </button>

          <!-- Interactive Search Launcher -->
          <div class="devnahian-sportlixa-search-launcher" id="devnahian-sportlixa-searchLauncher" role="button" tabindex="0" aria-label="<?php esc_attr_e( 'Search articles and scores', 'sportlixa' ); ?>">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
            <span><?php esc_html_e( 'Search...', 'sportlixa' ); ?></span>
            <span class="devnahian-sportlixa-search-kbd">&#8984;K</span>
          </div>

          <button type="button" class="devnahian-sportlixa-mobile-menu-trigger" id="devnahian-sportlixa-mobileMenuTrigger" aria-label="<?php esc_attr_e( 'Open Navigation Drawer', 'sportlixa' ); ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
          </button>
        </div>
      </div>

      <!-- Direct Navbar Links (Dynamic 'primary-menu') -->
      <nav class="devnahian-sportlixa-navbar" aria-label="<?php esc_attr_e( 'Primary Navigation', 'sportlixa' ); ?>">
        <?php
        if ( has_nav_menu( 'primary-menu' ) ) :
            wp_nav_menu( [
                'theme_location' => 'primary-menu',
                'container'      => false,
                'items_wrap'     => '%3$s',
                'walker'         => new Sportlixa_Desktop_Nav_Walker(),
            ] );
        else :
            ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="devnahian-sportlixa-nav-link active"><?php esc_html_e( 'HOME', 'sportlixa' ); ?></a>
        <?php endif; ?>
      </nav>
    </div>

    <!-- Quick Touch League Bar (Dynamic 'league-chips') -->
    <div class="devnahian-sportlixa-mobile-chips-bar" aria-label="<?php esc_attr_e( 'League Filter Bar', 'sportlixa' ); ?>">
      <?php
      if ( has_nav_menu( 'league-chips' ) ) :
          wp_nav_menu( [
              'theme_location' => 'league-chips',
              'container'      => false,
              'items_wrap'     => '%3$s',
              'walker'         => new Sportlixa_League_Chips_Walker(),
          ] );
      else :
          $cats = get_categories( [ 'number' => 8, 'orderby' => 'count', 'order' => 'DESC' ] );
          echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="devnahian-sportlixa-league-chip ' . ( is_home() || is_front_page() ? 'active' : '' ) . '">' . esc_html__( 'All', 'sportlixa' ) . '</a>';
          foreach ( $cats as $cat ) {
              $active = is_category( $cat->term_id ) ? 'active' : '';
              echo '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '" class="devnahian-sportlixa-league-chip ' . esc_attr( $active ) . '">' . esc_html( $cat->name ) . '</a>';
          }
      endif;
      ?>
    </div>
  </header>