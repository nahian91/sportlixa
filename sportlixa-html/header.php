<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>SPORTLIXA — Your Sports. Your Game. Your Edge.</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

  <!-- Reading Progress Bar -->
  <div class="devnahian-sportlixa-progress-line" id="devnahian-sportlixa-progressLine"></div>

  <!-- HUD Toast Notification -->
  <div class="devnahian-sportlixa-toast" id="devnahian-sportlixa-toast">
    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--devnahian-sportlixa-brand-volt)" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
    <span id="devnahian-sportlixa-toast-msg">Action completed</span>
  </div>

  <!-- Back to Top Floating Pill -->
  <button type="button" class="devnahian-sportlixa-back-to-top" id="devnahian-sportlixa-backToTop" aria-label="Scroll Back to Top">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="18 15 12 9 6 15"/></svg>
  </button>

  <!-- ==========================================================================
     LATEST NEWS TICKER
     ========================================================================== -->
  <div class="devnahian-sportlixa-news-ticker-bar">
    <div class="devnahian-sportlixa-ticker-badge-wrap">
      <span class="devnahian-sportlixa-ticker-pulse-dot"></span>
      <span>Latest News</span>
    </div>
    <div class="devnahian-sportlixa-ticker-marquee-box">
      <div class="devnahian-sportlixa-ticker-track">
        <a href="#nfl" class="devnahian-sportlixa-ticker-item"><span class="tag">NFL</span> Chiefs outduel Bills 24-17 in Week 5 thriller as Mahomes records 3 TDs <span class="sep">&bull;</span></a>
        <a href="#nba" class="devnahian-sportlixa-ticker-item"><span class="tag">NBA</span> Lakers edge Celtics 98-94 behind LeBron James' 28-point performance <span class="sep">&bull;</span></a>
        <a href="#nfl-wire" class="devnahian-sportlixa-ticker-item"><span class="tag">NFL Wire</span> Rashee Rice listed questionable for Sunday following walkthrough <span class="sep">&bull;</span></a>
        <a href="#mlb" class="devnahian-sportlixa-ticker-item"><span class="tag">MLB</span> Yankees take AL East opener with 5-3 victory over Red Sox <span class="sep">&bull;</span></a>
        <a href="#soccer" class="devnahian-sportlixa-ticker-item"><span class="tag">Soccer</span> Inter Miami secures 3-1 victory as Messi delivers 2 assists <span class="sep">&bull;</span></a>
        <a href="#nhl" class="devnahian-sportlixa-ticker-item"><span class="tag">NHL</span> Bruins explode in regular season blowout behind Pastrňák hat-trick <span class="sep">&bull;</span></a>
      </div>
    </div>
  </div>

  <!-- ==========================================================================
     MOBILE DRAWER
     ========================================================================== -->
  <div class="devnahian-sportlixa-drawer-overlay" id="devnahian-sportlixa-drawerOverlay"></div>
  <aside class="devnahian-sportlixa-mobile-drawer" id="devnahian-sportlixa-mobileDrawer">
    <div class="devnahian-sportlixa-drawer-header">
      <div class="devnahian-sportlixa-brand-logo-wrap">
        <img src="assets/img/logo.png" alt="">
      </div>
      <button type="button" class="devnahian-sportlixa-drawer-close-btn" id="devnahian-sportlixa-drawerCloseBtn" aria-label="Close Navigation">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </button>
    </div>

    <div class="devnahian-sportlixa-drawer-content">
      <a href="#" class="devnahian-sportlixa-mobile-nav-link active">
        <span>Home</span>
        <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      </a>
      <a href="#nfl" class="devnahian-sportlixa-mobile-nav-link">
        <span>NFL</span>
        <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      </a>
      <a href="#nba" class="devnahian-sportlixa-mobile-nav-link">
        <span>NBA</span>
        <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      </a>
      <a href="#mlb" class="devnahian-sportlixa-mobile-nav-link">
        <span>MLB</span>
        <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      </a>
      <a href="#nhl" class="devnahian-sportlixa-mobile-nav-link">
        <span>NHL</span>
        <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      </a>
      <a href="#soccer" class="devnahian-sportlixa-mobile-nav-link">
        <span>Soccer</span>
        <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      </a>
      <a href="#scores" class="devnahian-sportlixa-mobile-nav-link">
        <span>Live Scores</span>
        <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      </a>
    </div>
  </aside>

  <!-- ==========================================================================
     MOBILE APP BOTTOM BAR
     ========================================================================== -->
  <nav class="devnahian-sportlixa-mobile-bottom-bar" aria-label="Mobile Bottom App Bar">
    <a href="#" class="devnahian-sportlixa-bottom-bar-item active">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
      <span>Home</span>
    </a>
    <a href="#scores" class="devnahian-sportlixa-bottom-bar-item">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
      <span>Scores</span>
    </a>
    <a href="#nfl-standings" class="devnahian-sportlixa-bottom-bar-item">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
      <span>NFL</span>
    </a>
    <a href="#trending" class="devnahian-sportlixa-bottom-bar-item">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
      <span>Trending</span>
    </a>
    <div class="devnahian-sportlixa-bottom-bar-item" id="devnahian-sportlixa-mobileMenuTab">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
      <span>Menu</span>
    </div>
  </nav>

  <!-- ==========================================================================
     HEADER & DIRECT NAVBAR
     ========================================================================== -->
  <header>
    <div class="devnahian-sportlixa-container">
      <div class="devnahian-sportlixa-header-top">
        <a href="#" class="devnahian-sportlixa-brand-logo-wrap">
         <img src="assets/img/logo.png" alt="">
        </a>

        <div class="devnahian-sportlixa-header-actions">
          <div class="devnahian-sportlixa-social-links">
            <a href="#" aria-label="X Twitter"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg></a>
            <a href="#" aria-label="Facebook"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M9 8H6v4h3v12h5V12h3.642L18 8h-4V6.333C14 5.374 14.5 5 15.5 5H18V0h-3.808C10.595 0 9 1.583 9 4.615V8z"/></svg></a>
            <a href="#" aria-label="Instagram"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg></a>
            <a href="#" aria-label="YouTube"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg></a>
          </div>

          <button type="button" class="devnahian-sportlixa-theme-toggle-btn" id="devnahian-sportlixa-themeToggleBtn" aria-label="Switch Theme">
            <svg class="moon-icon" viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
            <svg class="sun-icon" viewBox="0 0 24 24" fill="none" stroke-width="2"><circle cx="12" cy="12" r="5"/><path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/></svg>
            <span id="devnahian-sportlixa-themeToggleText">Dark</span>
          </button>

          <!-- Interactive Search Launcher -->
          <div class="devnahian-sportlixa-search-launcher" id="devnahian-sportlixa-searchLauncher" role="button" tabindex="0" aria-label="Search articles and scores">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
            <span>Search...</span>
            <span class="devnahian-sportlixa-search-kbd">&#8984;K</span>
          </div>

          <button type="button" class="devnahian-sportlixa-mobile-menu-trigger" id="devnahian-sportlixa-mobileMenuTrigger" aria-label="Open Navigation Drawer">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
          </button>
        </div>
      </div>

      <!-- Direct Navbar Links -->
      <nav class="devnahian-sportlixa-navbar">
        <a href="#" class="devnahian-sportlixa-nav-link active">HOME</a>
        <a href="#nfl" class="devnahian-sportlixa-nav-link">NFL</a>
        <a href="#nba" class="devnahian-sportlixa-nav-link">NBA</a>
        <a href="#mlb" class="devnahian-sportlixa-nav-link">MLB</a>
        <a href="#nhl" class="devnahian-sportlixa-nav-link">NHL</a>
        <a href="#soccer" class="devnahian-sportlixa-nav-link">SOCCER</a>
        <a href="#scores" class="devnahian-sportlixa-nav-link">LIVE SCORES</a>
      </nav>
    </div>

    <!-- Quick Touch League Bar -->
    <div class="devnahian-sportlixa-mobile-chips-bar">
      <a href="#" class="devnahian-sportlixa-league-chip active">All</a>
      <a href="#nfl" class="devnahian-sportlixa-league-chip">NFL</a>
      <a href="#nba" class="devnahian-sportlixa-league-chip">NBA</a>
      <a href="#mlb" class="devnahian-sportlixa-league-chip">MLB</a>
      <a href="#nhl" class="devnahian-sportlixa-league-chip">NHL</a>
      <a href="#soccer" class="devnahian-sportlixa-league-chip">Soccer</a>
      <a href="#scores" class="devnahian-sportlixa-league-chip">Scores</a>
    </div>
  </header>