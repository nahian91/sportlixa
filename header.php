<?php
/**
 * Header Template - Fully Dynamic Menus & Settings Integration
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
  <?php if ( sportlixa_get_option( 'enable_news_ticker', 1 ) ) : ?>
  <div class="devnahian-sportlixa-news-ticker-bar">
    <div class="devnahian-sportlixa-ticker-badge-wrap">
      <span class="devnahian-sportlixa-ticker-pulse-dot"></span>
      <span><?php echo esc_html( sportlixa_get_option( 'ticker_badge_label', 'Latest News' ) ); ?></span>
    </div>
    <div class="devnahian-sportlixa-ticker-marquee-box">
      <div class="devnahian-sportlixa-ticker-track">
        <?php
        $ticker_count = (int) sportlixa_get_option( 'ticker_post_count', 6 );
        $sportlixa_ticker = new WP_Query( [
            'posts_per_page'      => $ticker_count > 0 ? $ticker_count : 6,
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
  <?php endif; ?>

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
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" alt="">
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
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" alt="">
              </div>
          <?php endif; ?>
        </a>

        <div class="devnahian-sportlixa-header-actions">
          <div class="devnahian-sportlixa-social-links">
            <?php
            $twitter_url   = sportlixa_get_option( 'twitter_url', '' );
            $facebook_url  = sportlixa_get_option( 'facebook_url', '' );
            $instagram_url = sportlixa_get_option( 'instagram_url', '' );
            $youtube_url   = sportlixa_get_option( 'youtube_url', '' );

            if ( ! empty( $twitter_url ) ) :
            ?>
              <a href="<?php echo esc_url( $twitter_url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'X Twitter', 'sportlixa' ); ?>"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg></a>
            <?php endif; if ( ! empty( $facebook_url ) ) : ?>
              <a href="<?php echo esc_url( $facebook_url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Facebook', 'sportlixa' ); ?>"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M9 8H6v4h3v12h5V12h3.642L18 8h-4V6.333C14 5.374 14.5 5 15.5 5H18V0h-3.808C10.595 0 9 1.583 9 4.615V8z"/></svg></a>
            <?php endif; if ( ! empty( $instagram_url ) ) : ?>
              <a href="<?php echo esc_url( $instagram_url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Instagram', 'sportlixa' ); ?>"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg></a>
            <?php endif; if ( ! empty( $youtube_url ) ) : ?>
              <a href="<?php echo esc_url( $youtube_url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'YouTube', 'sportlixa' ); ?>"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg></a>
            <?php endif; ?>
          </div>

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
    <?php if ( sportlixa_get_option( 'enable_league_chips', 1 ) ) : ?>
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
    <?php endif; ?>
  </header>