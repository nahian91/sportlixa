<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>Search Results — SPORTLIXA — Your Sports. Your Game. Your Edge.</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <style>
    /* ==========================================================================
       DESIGN SYSTEM & COLOR TOKENS (EXACT SITE-WIDE MATCH)
       ========================================================================== */
    :root {
      --devnahian-sportlixa-bg-dark: #080c14;
      --devnahian-sportlixa-bg-body: #0d121c;
      --devnahian-sportlixa-bg-card: #121926;
      --devnahian-sportlixa-bg-card-hover: #172235;
      --devnahian-sportlixa-bg-input: #151e2e;
      --devnahian-sportlixa-border-color: #1a2538;
      --devnahian-sportlixa-border-card: #1e2a3f;
      
      --devnahian-sportlixa-text-white: #ffffff;
      --devnahian-sportlixa-text-light: #e5ebf5;
      --devnahian-sportlixa-text-muted: #95a5b8;
      --devnahian-sportlixa-text-dim: #64758b;
      
      --devnahian-sportlixa-brand-volt: #c8ff00;
      --devnahian-sportlixa-brand-volt-text: #c8ff00;
      --devnahian-sportlixa-brand-volt-hover: #b5eb00;
      --devnahian-sportlixa-brand-volt-glow: rgba(200, 255, 0, 0.28);
      --devnahian-sportlixa-brand-volt-subtle: rgba(200, 255, 0, 0.09);
      
      --devnahian-sportlixa-red-live: #ff2e43;
      --devnahian-sportlixa-red-live-glow: rgba(255, 46, 67, 0.45);
      --devnahian-sportlixa-orange-warn: #f59e0b;
      --devnahian-sportlixa-green-ok: #10b981;
      
      --devnahian-sportlixa-radius-sm: 6px;
      --devnahian-sportlixa-radius-md: 10px;
      --devnahian-sportlixa-radius-lg: 14px;
      
      --devnahian-sportlixa-ease-out: cubic-bezier(0.16, 1, 0.3, 1);
      --devnahian-sportlixa-transition-fast: 0.2s ease;
      --devnahian-sportlixa-transition-smooth: 0.35s cubic-bezier(0.16, 1, 0.3, 1);
      
      --devnahian-sportlixa-shadow-card: 0 4px 20px rgba(0, 0, 0, 0.28);
      --devnahian-sportlixa-shadow-card-hover: 0 14px 34px rgba(0, 0, 0, 0.52), 0 0 20px var(--devnahian-sportlixa-brand-volt-glow);
    }

    [data-theme="light"] {
      --devnahian-sportlixa-bg-dark: #ffffff;
      --devnahian-sportlixa-bg-body: #f4f6fa;
      --devnahian-sportlixa-bg-card: #ffffff;
      --devnahian-sportlixa-bg-card-hover: #f9fbfe;
      --devnahian-sportlixa-bg-input: #eaf0f8;
      --devnahian-sportlixa-border-color: #dde4ee;
      --devnahian-sportlixa-border-card: #dde4ee;
      
      --devnahian-sportlixa-text-white: #0a0e17;
      --devnahian-sportlixa-text-light: #1e2838;
      --devnahian-sportlixa-text-muted: #536377;
      --devnahian-sportlixa-text-dim: #7f8fa4;
      
      --devnahian-sportlixa-brand-volt: #9bd200;
      --devnahian-sportlixa-brand-volt-text: #3c5400;
      --devnahian-sportlixa-brand-volt-hover: #88bc00;
      --devnahian-sportlixa-brand-volt-glow: rgba(155, 210, 0, 0.22);
      --devnahian-sportlixa-brand-volt-subtle: rgba(155, 210, 0, 0.12);
      
      --devnahian-sportlixa-shadow-card: 0 4px 18px rgba(0, 0, 0, 0.05);
      --devnahian-sportlixa-shadow-card-hover: 0 14px 28px rgba(0, 0, 0, 0.1), 0 0 16px var(--devnahian-sportlixa-brand-volt-glow);
    }

    *, *::before, *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      -webkit-tap-highlight-color: transparent;
    }

    html { scroll-behavior: smooth; }

    body {
      background-color: var(--devnahian-sportlixa-bg-body);
      color: var(--devnahian-sportlixa-text-light);
      font-family: 'Montserrat', -apple-system, BlinkMacSystemFont, sans-serif;
      line-height: 1.48;
      -webkit-font-smoothing: antialiased;
      transition: background-color var(--devnahian-sportlixa-transition-smooth), color var(--devnahian-sportlixa-transition-smooth);
      overflow-x: hidden;
      padding-bottom: 70px;
    }

    @media (min-width: 1025px) {
      body { padding-bottom: 0; }
    }

    a { color: inherit; text-decoration: none; }

    :focus-visible {
      outline: 2px solid var(--devnahian-sportlixa-brand-volt);
      outline-offset: 3px;
    }

    .devnahian-sportlixa-progress-line {
      position: fixed;
      top: 0;
      left: 0;
      height: 3px;
      background: var(--devnahian-sportlixa-brand-volt);
      box-shadow: 0 0 12px var(--devnahian-sportlixa-brand-volt);
      z-index: 999;
      width: 0%;
      transition: width 0.1s linear;
    }

    .devnahian-sportlixa-container {
      width: 100%;
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 16px;
    }

    .devnahian-sportlixa-img-box {
      width: 100%;
      height: 100%;
      overflow: hidden;
      position: relative;
      background-color: #0b111b;
    }
    .devnahian-sportlixa-img-box img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
      transition: transform 0.5s var(--devnahian-sportlixa-ease-out);
    }

    .devnahian-sportlixa-section-title {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 18px;
    }
    .devnahian-sportlixa-title-left {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 15px;
      font-weight: 800;
      letter-spacing: 0.8px;
      text-transform: uppercase;
      color: var(--devnahian-sportlixa-text-white);
    }
    .devnahian-sportlixa-title-left::before {
      content: '';
      display: inline-block;
      width: 4px;
      height: 18px;
      background-color: var(--devnahian-sportlixa-brand-volt);
      border-radius: 2px;
      flex-shrink: 0;
      box-shadow: 0 0 12px var(--devnahian-sportlixa-brand-volt);
    }

    .devnahian-sportlixa-badge-tag {
      background-color: var(--devnahian-sportlixa-brand-volt);
      color: #000 !important;
      font-size: 10px;
      font-weight: 900;
      font-style: italic;
      text-transform: uppercase;
      padding: 4px 9px;
      border-radius: 3px;
      display: inline-block;
      letter-spacing: 0.6px;
      line-height: 1.1;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }

    .devnahian-sportlixa-meta-time {
      font-size: 11.5px;
      color: var(--devnahian-sportlixa-text-dim);
      display: flex;
      align-items: center;
      gap: 6px;
      margin-top: 4px;
    }

    /* ==========================================================================
       LATEST NEWS TICKER
       ========================================================================== */
    .devnahian-sportlixa-news-ticker-bar {
      background-color: var(--devnahian-sportlixa-bg-dark);
      border-bottom: 1px solid var(--devnahian-sportlixa-border-color);
      height: 38px;
      display: flex;
      align-items: center;
      overflow: hidden;
      position: relative;
      z-index: 101;
    }
    .devnahian-sportlixa-ticker-badge-wrap {
      background-color: var(--devnahian-sportlixa-brand-volt);
      color: #000;
      font-size: 10.5px;
      font-weight: 900;
      font-style: italic;
      text-transform: uppercase;
      letter-spacing: 0.8px;
      padding: 0 14px;
      height: 100%;
      display: flex;
      align-items: center;
      gap: 7px;
      flex-shrink: 0;
      z-index: 2;
      box-shadow: 4px 0 16px rgba(0, 0, 0, 0.45);
    }
    .devnahian-sportlixa-ticker-pulse-dot {
      width: 7px;
      height: 7px;
      border-radius: 50%;
      background-color: #000;
      animation: devnahian-sportlixa-tickerPulse 1.2s infinite ease-in-out;
    }
    @keyframes devnahian-sportlixa-tickerPulse {
      0% { opacity: 1; transform: scale(1); }
      50% { opacity: 0.25; transform: scale(0.7); }
      100% { opacity: 1; transform: scale(1); }
    }
    .devnahian-sportlixa-ticker-marquee-box {
      flex: 1;
      overflow: hidden;
      white-space: nowrap;
      position: relative;
      height: 100%;
      display: flex;
      align-items: center;
    }
    .devnahian-sportlixa-ticker-track {
      display: inline-flex;
      align-items: center;
      white-space: nowrap;
      animation: devnahian-sportlixa-tickerScroll 42s linear infinite;
    }
    .devnahian-sportlixa-ticker-track:hover { animation-play-state: paused; }
    .devnahian-sportlixa-ticker-item {
      display: inline-flex;
      align-items: center;
      margin-right: 36px;
      font-size: 12px;
      font-weight: 600;
      color: var(--devnahian-sportlixa-text-light);
      transition: color var(--devnahian-sportlixa-transition-fast);
    }
    .devnahian-sportlixa-ticker-item:hover { color: var(--devnahian-sportlixa-brand-volt-text); }
    .devnahian-sportlixa-ticker-item .tag {
      color: var(--devnahian-sportlixa-brand-volt-text);
      font-weight: 800;
      font-style: italic;
      margin-right: 6px;
      text-transform: uppercase;
    }
    .devnahian-sportlixa-ticker-item .sep {
      color: var(--devnahian-sportlixa-text-dim);
      margin-left: 14px;
    }
    @keyframes devnahian-sportlixa-tickerScroll {
      0% { transform: translateX(0); }
      100% { transform: translateX(-50%); }
    }

    /* ==========================================================================
       HEADER & DIRECT NAVBAR
       ========================================================================== */
    header {
      background-color: var(--devnahian-sportlixa-bg-dark);
      border-bottom: 1px solid var(--devnahian-sportlixa-border-color);
      position: sticky;
      top: 0;
      z-index: 100;
      backdrop-filter: blur(14px);
      transition: background-color var(--devnahian-sportlixa-transition-smooth), border-color var(--devnahian-sportlixa-transition-smooth);
    }
    .devnahian-sportlixa-header-top {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 12px 0 10px;
    }
    .devnahian-sportlixa-brand-logo-wrap {
      display: flex;
      align-items: center;
      gap: 10px;
      cursor: pointer;
      transition: transform var(--devnahian-sportlixa-transition-fast);
    }
    .devnahian-sportlixa-brand-logo-wrap:hover { transform: scale(1.02); }
    .devnahian-sportlixa-brand-mark-svg {
      width: 42px;
      height: 28px;
      flex-shrink: 0;
      filter: drop-shadow(0 0 10px var(--devnahian-sportlixa-brand-volt-glow));
    }
    .devnahian-sportlixa-brand-text-block { display: flex; flex-direction: column; }
    .devnahian-sportlixa-brand-title {
      font-size: 24px;
      font-weight: 900;
      font-style: italic;
      letter-spacing: -0.6px;
      line-height: 1;
      display: flex;
      align-items: center;
    }
    .devnahian-sportlixa-brand-title .part-sport { color: var(--devnahian-sportlixa-text-white); }
    .devnahian-sportlixa-brand-title .part-lixa {
      color: var(--devnahian-sportlixa-brand-volt-text);
      text-shadow: 0 0 14px var(--devnahian-sportlixa-brand-volt-glow);
    }
    .devnahian-sportlixa-brand-slogan {
      font-size: 9px;
      font-weight: 800;
      letter-spacing: 0.9px;
      text-transform: uppercase;
      color: var(--devnahian-sportlixa-text-muted);
      margin-top: 3px;
    }

    .devnahian-sportlixa-header-actions {
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .devnahian-sportlixa-social-links {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .devnahian-sportlixa-social-links a {
      color: var(--devnahian-sportlixa-text-dim);
      display: flex;
      padding: 6px;
      border-radius: 50%;
      transition: color var(--devnahian-sportlixa-transition-fast), background-color var(--devnahian-sportlixa-transition-fast);
    }
    .devnahian-sportlixa-social-links a:hover {
      color: var(--devnahian-sportlixa-brand-volt-text);
      background-color: var(--devnahian-sportlixa-brand-volt-subtle);
    }

    .devnahian-sportlixa-theme-toggle-btn {
      background: var(--devnahian-sportlixa-bg-input);
      border: 1px solid var(--devnahian-sportlixa-border-card);
      border-radius: 20px;
      padding: 6px 14px;
      display: flex;
      align-items: center;
      gap: 6px;
      cursor: pointer;
      color: var(--devnahian-sportlixa-text-light);
      font-size: 11px;
      font-weight: 800;
      min-height: 36px;
      transition: all var(--devnahian-sportlixa-transition-fast);
    }
    .devnahian-sportlixa-theme-toggle-btn:hover {
      border-color: var(--devnahian-sportlixa-brand-volt);
      color: var(--devnahian-sportlixa-brand-volt-text);
      box-shadow: 0 0 12px var(--devnahian-sportlixa-brand-volt-glow);
    }
    .devnahian-sportlixa-theme-toggle-btn svg { width: 14px; height: 14px; stroke: currentColor; }
    [data-theme="dark"] .moon-icon { display: block; }
    [data-theme="dark"] .sun-icon { display: none; }
    [data-theme="light"] .moon-icon { display: none; }
    [data-theme="light"] .sun-icon { display: block; }

    .devnahian-sportlixa-search-launcher {
      display: flex;
      align-items: center;
      gap: 8px;
      background-color: var(--devnahian-sportlixa-bg-input);
      border: 1px solid var(--devnahian-sportlixa-border-card);
      border-radius: var(--devnahian-sportlixa-radius-sm);
      padding: 8px 12px;
      font-size: 12px;
      color: var(--devnahian-sportlixa-text-muted);
      cursor: pointer;
      transition: all var(--devnahian-sportlixa-transition-fast);
    }
    .devnahian-sportlixa-search-launcher:hover {
      border-color: var(--devnahian-sportlixa-brand-volt);
      color: var(--devnahian-sportlixa-text-light);
      box-shadow: 0 0 12px var(--devnahian-sportlixa-brand-volt-glow);
    }
    .devnahian-sportlixa-search-kbd {
      font-size: 10px;
      background: var(--devnahian-sportlixa-bg-card);
      border: 1px solid var(--devnahian-sportlixa-border-color);
      border-radius: 3px;
      padding: 1px 5px;
      color: var(--devnahian-sportlixa-text-dim);
    }

    .devnahian-sportlixa-mobile-menu-trigger {
      display: none;
      background: var(--devnahian-sportlixa-bg-input);
      border: 1px solid var(--devnahian-sportlixa-border-card);
      border-radius: var(--devnahian-sportlixa-radius-sm);
      width: 38px;
      height: 38px;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      color: var(--devnahian-sportlixa-text-white);
      transition: border-color var(--devnahian-sportlixa-transition-fast);
    }
    .devnahian-sportlixa-mobile-menu-trigger:hover { border-color: var(--devnahian-sportlixa-brand-volt); }
    .devnahian-sportlixa-mobile-menu-trigger svg { width: 20px; height: 20px; }

    .devnahian-sportlixa-navbar {
      display: flex;
      align-items: center;
      gap: 26px;
      padding: 8px 0 10px;
    }
    .devnahian-sportlixa-nav-link {
      font-size: 11.5px;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 0.9px;
      color: var(--devnahian-sportlixa-text-muted);
      padding: 6px 0;
      white-space: nowrap;
      position: relative;
      transition: color var(--devnahian-sportlixa-transition-fast);
    }
    .devnahian-sportlixa-nav-link::after {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 0;
      width: 100%;
      height: 2.5px;
      background-color: var(--devnahian-sportlixa-brand-volt);
      box-shadow: 0 0 10px var(--devnahian-sportlixa-brand-volt);
      transform: scaleX(0);
      transform-origin: right;
      transition: transform 0.3s var(--devnahian-sportlixa-ease-out);
    }
    .devnahian-sportlixa-nav-link:hover, .devnahian-sportlixa-nav-link.active {
      color: var(--devnahian-sportlixa-brand-volt-text);
    }
    .devnahian-sportlixa-nav-link:hover::after, .devnahian-sportlixa-nav-link.active::after {
      transform: scaleX(1);
      transform-origin: left;
    }

    .devnahian-sportlixa-mobile-chips-bar {
      display: none;
      background: var(--devnahian-sportlixa-bg-card);
      border-bottom: 1px solid var(--devnahian-sportlixa-border-color);
      padding: 10px 16px;
      overflow-x: auto;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
      gap: 8px;
    }
    .devnahian-sportlixa-mobile-chips-bar::-webkit-scrollbar { display: none; }
    .devnahian-sportlixa-league-chip {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 6px 14px;
      border-radius: 20px;
      background: var(--devnahian-sportlixa-bg-input);
      border: 1px solid var(--devnahian-sportlixa-border-card);
      font-size: 11px;
      font-weight: 800;
      text-transform: uppercase;
      color: var(--devnahian-sportlixa-text-light);
      flex-shrink: 0;
      transition: all var(--devnahian-sportlixa-transition-fast);
    }
    .devnahian-sportlixa-league-chip:hover, .devnahian-sportlixa-league-chip.active {
      background: var(--devnahian-sportlixa-brand-volt);
      color: #000;
      border-color: var(--devnahian-sportlixa-brand-volt);
      box-shadow: 0 2px 10px var(--devnahian-sportlixa-brand-volt-glow);
    }

    /* Mobile Drawer */
    .devnahian-sportlixa-drawer-overlay {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.82);
      backdrop-filter: blur(8px);
      z-index: 200;
      opacity: 0;
      visibility: hidden;
      transition: all 0.25s ease;
    }
    .devnahian-sportlixa-drawer-overlay.active { opacity: 1; visibility: visible; }
    .devnahian-sportlixa-mobile-drawer {
      position: fixed;
      top: 0;
      left: 0;
      bottom: 0;
      width: 300px;
      max-width: 85vw;
      background-color: var(--devnahian-sportlixa-bg-dark);
      border-right: 1px solid var(--devnahian-sportlixa-border-color);
      z-index: 201;
      transform: translateX(-100%);
      transition: transform 0.35s var(--devnahian-sportlixa-ease-out);
      display: flex;
      flex-direction: column;
      overflow-y: auto;
    }
    .devnahian-sportlixa-mobile-drawer.active { transform: translateX(0); }
    .devnahian-sportlixa-drawer-header {
      padding: 18px 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      border-bottom: 1px solid var(--devnahian-sportlixa-border-color);
    }
    .devnahian-sportlixa-drawer-close-btn {
      background: none;
      border: none;
      color: var(--devnahian-sportlixa-text-muted);
      cursor: pointer;
      display: flex;
      padding: 4px;
    }
    .devnahian-sportlixa-drawer-close-btn svg { width: 22px; height: 22px; }
    .devnahian-sportlixa-drawer-content { padding: 14px 0; flex: 1; }
    .devnahian-sportlixa-mobile-nav-link {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 15px 22px;
      font-size: 13.5px;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 0.8px;
      color: var(--devnahian-sportlixa-text-light);
      border-bottom: 1px solid rgba(255, 255, 255, 0.04);
      transition: all var(--devnahian-sportlixa-transition-fast);
    }
    .devnahian-sportlixa-mobile-nav-link:hover, .devnahian-sportlixa-mobile-nav-link.active {
      color: var(--devnahian-sportlixa-brand-volt-text);
      background-color: var(--devnahian-sportlixa-brand-volt-subtle);
      padding-left: 26px;
    }
    .devnahian-sportlixa-mobile-nav-link svg {
      width: 14px;
      height: 14px;
      stroke: var(--devnahian-sportlixa-brand-volt);
    }

    .devnahian-sportlixa-mobile-bottom-bar {
      display: none;
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      background-color: var(--devnahian-sportlixa-bg-dark);
      border-top: 1px solid var(--devnahian-sportlixa-border-color);
      z-index: 99;
      height: 60px;
      padding: 0 10px;
      justify-content: space-around;
      align-items: center;
      backdrop-filter: blur(10px);
    }
    .devnahian-sportlixa-bottom-bar-item {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 3px;
      color: var(--devnahian-sportlixa-text-dim);
      font-size: 10px;
      font-weight: 700;
      text-transform: uppercase;
      flex: 1;
      height: 100%;
      cursor: pointer;
      transition: color var(--devnahian-sportlixa-transition-fast);
    }
    .devnahian-sportlixa-bottom-bar-item.active { color: var(--devnahian-sportlixa-brand-volt-text); }
    .devnahian-sportlixa-bottom-bar-item svg { width: 18px; height: 18px; }

    /* ==========================================================================
       DEDICATED SEARCH PAGE HERO & INTERACTIVE QUERY BAR
       ========================================================================== */
    .devnahian-sportlixa-search-hero {
      padding: 30px 0 24px;
      border-bottom: 1px solid var(--devnahian-sportlixa-border-color);
      margin-bottom: 28px;
    }
    .devnahian-sportlixa-breadcrumbs {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
      color: var(--devnahian-sportlixa-text-dim);
      margin-bottom: 14px;
      letter-spacing: 0.6px;
    }
    .devnahian-sportlixa-breadcrumbs a:hover { color: var(--devnahian-sportlixa-brand-volt-text); }
    .devnahian-sportlixa-breadcrumbs span { color: var(--devnahian-sportlixa-brand-volt-text); }

    .devnahian-sportlixa-search-box-large {
      position: relative;
      display: flex;
      align-items: center;
      width: 100%;
      max-width: 820px;
      margin-bottom: 16px;
    }
    .devnahian-sportlixa-search-input-large {
      width: 100%;
      background: var(--devnahian-sportlixa-bg-input);
      border: 2px solid var(--devnahian-sportlixa-border-card);
      border-radius: var(--devnahian-sportlixa-radius-md);
      padding: 16px 120px 16px 52px;
      font-size: 16px;
      font-weight: 600;
      color: var(--devnahian-sportlixa-text-white);
      font-family: inherit;
      box-shadow: var(--devnahian-sportlixa-shadow-card);
      transition: all var(--devnahian-sportlixa-transition-fast);
    }
    .devnahian-sportlixa-search-input-large:focus {
      outline: none;
      border-color: var(--devnahian-sportlixa-brand-volt);
      box-shadow: 0 0 22px var(--devnahian-sportlixa-brand-volt-glow);
    }
    .devnahian-sportlixa-search-icon-left {
      position: absolute;
      left: 18px;
      width: 20px;
      height: 20px;
      stroke: var(--devnahian-sportlixa-brand-volt);
      pointer-events: none;
    }
    .devnahian-sportlixa-search-clear-btn {
      position: absolute;
      right: 90px;
      background: none;
      border: none;
      color: var(--devnahian-sportlixa-text-dim);
      cursor: pointer;
      padding: 6px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: color var(--devnahian-sportlixa-transition-fast);
    }
    .devnahian-sportlixa-search-clear-btn:hover { color: var(--devnahian-sportlixa-brand-volt-text); }
    .devnahian-sportlixa-search-clear-btn svg { width: 16px; height: 16px; stroke: currentColor; }

    .devnahian-sportlixa-btn-search-submit {
      position: absolute;
      right: 8px;
      background: var(--devnahian-sportlixa-brand-volt);
      color: #000;
      border: none;
      padding: 10px 18px;
      border-radius: var(--devnahian-sportlixa-radius-sm);
      font-weight: 900;
      font-style: italic;
      font-size: 11.5px;
      letter-spacing: 0.6px;
      text-transform: uppercase;
      cursor: pointer;
      font-family: inherit;
      transition: all var(--devnahian-sportlixa-transition-fast);
    }
    .devnahian-sportlixa-btn-search-submit:hover {
      background: var(--devnahian-sportlixa-brand-volt-hover);
      transform: translateY(-1px);
    }

    /* Query Metrics and Quick Tags */
    .devnahian-sportlixa-search-meta-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 12px;
      font-size: 13px;
      color: var(--devnahian-sportlixa-text-muted);
    }
    .devnahian-sportlixa-query-count {
      color: var(--devnahian-sportlixa-text-white);
      font-weight: 700;
    }
    .devnahian-sportlixa-query-count strong {
      color: var(--devnahian-sportlixa-brand-volt-text);
    }
    .devnahian-sportlixa-quick-tags-wrap {
      display: flex;
      align-items: center;
      gap: 8px;
      flex-wrap: wrap;
    }
    .devnahian-sportlixa-quick-tag {
      background: var(--devnahian-sportlixa-bg-input);
      border: 1px solid var(--devnahian-sportlixa-border-card);
      color: var(--devnahian-sportlixa-text-dim);
      padding: 4px 10px;
      border-radius: 14px;
      font-size: 11px;
      font-weight: 700;
      cursor: pointer;
      transition: all var(--devnahian-sportlixa-transition-fast);
    }
    .devnahian-sportlixa-quick-tag:hover {
      color: var(--devnahian-sportlixa-brand-volt-text);
      border-color: var(--devnahian-sportlixa-brand-volt);
    }

    /* ==========================================================================
       FACET TABS & SORT CONTROLS
       ========================================================================== */
    .devnahian-sportlixa-facets-toolbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 24px;
      padding-bottom: 12px;
      border-bottom: 1px solid var(--devnahian-sportlixa-border-color);
      flex-wrap: wrap;
      gap: 12px;
    }
    .devnahian-sportlixa-facets-nav {
      display: flex;
      gap: 8px;
      overflow-x: auto;
    }
    .devnahian-sportlixa-facet-tab {
      background: none;
      border: none;
      color: var(--devnahian-sportlixa-text-dim);
      font-size: 12px;
      font-weight: 800;
      text-transform: uppercase;
      cursor: pointer;
      font-family: inherit;
      padding: 6px 8px;
      position: relative;
      transition: color var(--devnahian-sportlixa-transition-fast);
      white-space: nowrap;
    }
    .devnahian-sportlixa-facet-tab:hover, .devnahian-sportlixa-facet-tab.active {
      color: var(--devnahian-sportlixa-brand-volt-text);
    }
    .devnahian-sportlixa-facet-tab.active::after {
      content: '';
      position: absolute;
      bottom: -13px;
      left: 0;
      width: 100%;
      height: 2px;
      background: var(--devnahian-sportlixa-brand-volt);
      box-shadow: 0 0 10px var(--devnahian-sportlixa-brand-volt);
    }

    .devnahian-sportlixa-sort-wrap {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 11.5px;
      font-weight: 800;
      color: var(--devnahian-sportlixa-text-dim);
      text-transform: uppercase;
    }
    .devnahian-sportlixa-sort-select {
      background: var(--devnahian-sportlixa-bg-input);
      border: 1px solid var(--devnahian-sportlixa-border-card);
      color: var(--devnahian-sportlixa-text-light);
      padding: 6px 12px;
      border-radius: var(--devnahian-sportlixa-radius-sm);
      font-family: inherit;
      font-size: 12px;
      font-weight: 700;
      cursor: pointer;
      outline: none;
    }
    .devnahian-sportlixa-sort-select:focus {
      border-color: var(--devnahian-sportlixa-brand-volt);
    }

    /* ==========================================================================
       SEARCH LAYOUT: 2-COLUMN (RESULTS FEED + SIDEBAR)
       ========================================================================== */
    .devnahian-sportlixa-search-layout {
      display: grid;
      grid-template-columns: 2.15fr 1fr;
      gap: 28px;
      margin-bottom: 50px;
    }

    .devnahian-sportlixa-results-feed {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    /* ENTITY SPOTLIGHT (KNOWLEDGE PANEL SNIPPET) */
    .devnahian-sportlixa-entity-spotlight-card {
      background: linear-gradient(135deg, var(--devnahian-sportlixa-bg-card) 0%, rgba(200, 255, 0, 0.05) 100%);
      border: 1px solid var(--devnahian-sportlixa-brand-volt);
      border-radius: var(--devnahian-sportlixa-radius-md);
      padding: 22px;
      display: flex;
      align-items: center;
      gap: 20px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.35), 0 0 16px var(--devnahian-sportlixa-brand-volt-glow);
    }
    .devnahian-sportlixa-entity-avatar {
      width: 72px;
      height: 72px;
      border-radius: 50%;
      overflow: hidden;
      border: 2px solid var(--devnahian-sportlixa-brand-volt);
      flex-shrink: 0;
      background: #080c14;
    }
    .devnahian-sportlixa-entity-avatar img { width: 100%; height: 100%; object-fit: cover; }
    .devnahian-sportlixa-entity-details {
      flex: 1;
      display: flex;
      flex-direction: column;
      gap: 4px;
    }
    .devnahian-sportlixa-entity-badge {
      color: var(--devnahian-sportlixa-brand-volt-text);
      font-size: 10px;
      font-weight: 900;
      text-transform: uppercase;
      letter-spacing: 0.8px;
    }
    .devnahian-sportlixa-entity-name {
      font-size: 20px;
      font-weight: 900;
      font-style: italic;
      color: var(--devnahian-sportlixa-text-white);
      line-height: 1.1;
    }
    .devnahian-sportlixa-entity-meta {
      font-size: 12px;
      color: var(--devnahian-sportlixa-text-muted);
    }
    .devnahian-sportlixa-entity-stats-row {
      display: flex;
      gap: 16px;
      margin-top: 6px;
    }
    .devnahian-sportlixa-entity-stat {
      display: flex;
      flex-direction: column;
      font-size: 11px;
      color: var(--devnahian-sportlixa-text-dim);
      text-transform: uppercase;
    }
    .devnahian-sportlixa-entity-stat strong {
      font-size: 15px;
      color: var(--devnahian-sportlixa-brand-volt-text);
    }
    .devnahian-sportlixa-btn-view-profile {
      align-self: center;
      background: var(--devnahian-sportlixa-brand-volt);
      color: #000;
      padding: 10px 18px;
      border-radius: var(--devnahian-sportlixa-radius-sm);
      font-size: 11px;
      font-weight: 900;
      font-style: italic;
      text-transform: uppercase;
      white-space: nowrap;
      transition: all var(--devnahian-sportlixa-transition-fast);
      box-shadow: 0 4px 14px var(--devnahian-sportlixa-brand-volt-glow);
    }
    .devnahian-sportlixa-btn-view-profile:hover {
      background: var(--devnahian-sportlixa-brand-volt-hover);
      transform: translateY(-2px);
    }

    /* Result Article Card (List View Optimized) */
    .devnahian-sportlixa-result-card {
      background: var(--devnahian-sportlixa-bg-card);
      border: 1px solid var(--devnahian-sportlixa-border-card);
      border-radius: var(--devnahian-sportlixa-radius-md);
      overflow: hidden;
      display: flex;
      height: 170px;
      box-shadow: var(--devnahian-sportlixa-shadow-card);
      transition: transform var(--devnahian-sportlixa-transition-smooth), border-color var(--devnahian-sportlixa-transition-smooth), box-shadow var(--devnahian-sportlixa-transition-smooth);
    }
    .devnahian-sportlixa-result-card:hover {
      transform: translateY(-3px);
      border-color: var(--devnahian-sportlixa-brand-volt);
      box-shadow: var(--devnahian-sportlixa-shadow-card-hover);
    }
    .devnahian-sportlixa-result-card:hover .devnahian-sportlixa-img-box img {
      transform: scale(1.08);
    }
    .devnahian-sportlixa-result-thumb {
      width: 230px;
      min-width: 230px;
      height: 100%;
      position: relative;
    }
    .devnahian-sportlixa-result-badge {
      position: absolute;
      top: 10px;
      left: 10px;
      z-index: 2;
    }
    .devnahian-sportlixa-result-content {
      padding: 16px 20px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      flex: 1;
      gap: 6px;
    }
    .devnahian-sportlixa-result-title {
      font-size: 15px;
      font-weight: 800;
      color: var(--devnahian-sportlixa-text-white);
      line-height: 1.35;
      transition: color var(--devnahian-sportlixa-transition-fast);
    }
    .devnahian-sportlixa-result-title:hover {
      color: var(--devnahian-sportlixa-brand-volt-text);
    }
    .devnahian-sportlixa-result-snippet {
      font-size: 12px;
      color: var(--devnahian-sportlixa-text-muted);
      line-height: 1.45;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
    .devnahian-sportlixa-highlight-term {
      color: var(--devnahian-sportlixa-brand-volt-text);
      font-weight: 800;
      background: var(--devnahian-sportlixa-brand-volt-subtle);
      padding: 0 3px;
      border-radius: 2px;
    }
    .devnahian-sportlixa-result-footer {
      display: flex;
      align-items: center;
      justify-content: space-between;
      font-size: 11px;
      color: var(--devnahian-sportlixa-text-dim);
      border-top: 1px solid rgba(255, 255, 255, 0.04);
      padding-top: 8px;
    }

    /* Embedded Result Game Score snippet */
    .devnahian-sportlixa-result-game-embed {
      background: var(--devnahian-sportlixa-bg-input);
      border: 1px solid var(--devnahian-sportlixa-border-card);
      border-radius: var(--devnahian-sportlixa-radius-md);
      padding: 16px 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 16px;
      box-shadow: var(--devnahian-sportlixa-shadow-card);
      transition: border-color var(--devnahian-sportlixa-transition-fast);
    }
    .devnahian-sportlixa-result-game-embed:hover {
      border-color: var(--devnahian-sportlixa-brand-volt);
    }
    .devnahian-sportlixa-embed-match-info {
      display: flex;
      align-items: center;
      gap: 16px;
    }
    .devnahian-sportlixa-embed-score-digits {
      font-size: 20px;
      font-weight: 900;
      font-style: italic;
      color: var(--devnahian-sportlixa-text-white);
      background: var(--devnahian-sportlixa-bg-card);
      padding: 4px 12px;
      border-radius: var(--devnahian-sportlixa-radius-sm);
      border: 1px solid var(--devnahian-sportlixa-border-color);
    }
    .devnahian-sportlixa-embed-score-digits .win {
      color: var(--devnahian-sportlixa-brand-volt-text);
    }

    /* Pagination */
    .devnahian-sportlixa-pagination-wrap {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      margin-top: 32px;
    }
    .devnahian-sportlixa-page-btn {
      background: var(--devnahian-sportlixa-bg-input);
      border: 1px solid var(--devnahian-sportlixa-border-card);
      color: var(--devnahian-sportlixa-text-light);
      min-width: 38px;
      height: 38px;
      padding: 0 12px;
      border-radius: var(--devnahian-sportlixa-radius-sm);
      font-size: 12px;
      font-weight: 800;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      font-family: inherit;
      transition: all var(--devnahian-sportlixa-transition-fast);
    }
    .devnahian-sportlixa-page-btn:hover, .devnahian-sportlixa-page-btn.active {
      background: var(--devnahian-sportlixa-brand-volt);
      color: #000;
      border-color: var(--devnahian-sportlixa-brand-volt);
      box-shadow: 0 0 12px var(--devnahian-sportlixa-brand-volt-glow);
    }

    /* ==========================================================================
       SEARCH SIDEBAR (FILTER FACETS & TRENDING)
       ========================================================================== */
    .devnahian-sportlixa-search-sidebar {
      display: flex;
      flex-direction: column;
      gap: 24px;
    }

    .devnahian-sportlixa-filter-card {
      background: var(--devnahian-sportlixa-bg-card);
      border: 1px solid var(--devnahian-sportlixa-border-card);
      border-radius: var(--devnahian-sportlixa-radius-md);
      padding: 20px;
      box-shadow: var(--devnahian-sportlixa-shadow-card);
    }
    .devnahian-sportlixa-filter-title {
      font-size: 12px;
      font-weight: 800;
      color: var(--devnahian-sportlixa-text-white);
      text-transform: uppercase;
      letter-spacing: 0.6px;
      margin-bottom: 14px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .devnahian-sportlixa-filter-list {
      list-style: none;
      display: flex;
      flex-direction: column;
      gap: 8px;
    }
    .devnahian-sportlixa-filter-option {
      display: flex;
      align-items: center;
      justify-content: space-between;
      font-size: 12px;
      color: var(--devnahian-sportlixa-text-muted);
      cursor: pointer;
      padding: 6px 8px;
      border-radius: var(--devnahian-sportlixa-radius-sm);
      transition: all var(--devnahian-sportlixa-transition-fast);
    }
    .devnahian-sportlixa-filter-option:hover, .devnahian-sportlixa-filter-option.selected {
      background: var(--devnahian-sportlixa-bg-input);
      color: var(--devnahian-sportlixa-brand-volt-text);
      font-weight: 700;
    }
    .devnahian-sportlixa-count-pill {
      font-size: 10px;
      background: var(--devnahian-sportlixa-bg-dark);
      padding: 2px 7px;
      border-radius: 10px;
      color: var(--devnahian-sportlixa-text-dim);
    }

    /* ==========================================================================
       PROFESSIONAL FOOTER & MENU WITH ARROW SVGS (EXACT MATCH)
       ========================================================================== */
    footer {
      background-color: var(--devnahian-sportlixa-bg-dark);
      border-top: 1px solid var(--devnahian-sportlixa-border-color);
      padding: 56px 0 24px;
      transition: background-color var(--devnahian-sportlixa-transition-smooth), border-color var(--devnahian-sportlixa-transition-smooth);
    }
    .devnahian-sportlixa-footer-top {
      display: grid;
      grid-template-columns: 2fr 1fr 1fr 1fr 1.6fr;
      gap: 36px;
      margin-bottom: 40px;
    }
    .devnahian-sportlixa-footer-col-title {
      font-size: 12px;
      font-weight: 800;
      color: var(--devnahian-sportlixa-text-white);
      text-transform: uppercase;
      letter-spacing: 0.6px;
      margin-bottom: 18px;
    }
    .devnahian-sportlixa-footer-links-list {
      list-style: none;
      display: flex;
      flex-direction: column;
      gap: 10px;
    }
    .devnahian-sportlixa-footer-links-list a {
      font-size: 12px;
      color: var(--devnahian-sportlixa-text-muted);
      transition: color var(--devnahian-sportlixa-transition-fast), transform var(--devnahian-sportlixa-transition-fast);
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }
    .devnahian-sportlixa-footer-links-list a:hover {
      color: var(--devnahian-sportlixa-brand-volt-text);
      transform: translateX(4px);
    }
    .devnahian-sportlixa-footer-menu-arrow {
      width: 11px;
      height: 11px;
      stroke: var(--devnahian-sportlixa-brand-volt);
      flex-shrink: 0;
      transition: transform var(--devnahian-sportlixa-transition-fast);
      opacity: 0.85;
    }
    .devnahian-sportlixa-footer-links-list a:hover .devnahian-sportlixa-footer-menu-arrow {
      transform: translateX(2px);
      opacity: 1;
    }

    .devnahian-sportlixa-footer-subscribe-box {
      display: flex;
      position: relative;
      margin-top: 14px;
    }
    .devnahian-sportlixa-footer-subscribe-input {
      background-color: var(--devnahian-sportlixa-bg-input);
      border: 1px solid var(--devnahian-sportlixa-border-card);
      border-radius: var(--devnahian-sportlixa-radius-sm);
      padding: 10px 46px 10px 12px;
      font-size: 12px;
      color: var(--devnahian-sportlixa-text-light);
      width: 100%;
      font-family: inherit;
      transition: all var(--devnahian-sportlixa-transition-fast);
    }
    .devnahian-sportlixa-footer-subscribe-input:focus {
      outline: none;
      border-color: var(--devnahian-sportlixa-brand-volt);
      box-shadow: 0 0 10px var(--devnahian-sportlixa-brand-volt-glow);
    }
    .devnahian-sportlixa-footer-subscribe-btn {
      position: absolute;
      right: 4px;
      top: 4px;
      bottom: 4px;
      background-color: var(--devnahian-sportlixa-brand-volt);
      border: none;
      border-radius: var(--devnahian-sportlixa-radius-sm);
      width: 36px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all var(--devnahian-sportlixa-transition-fast);
      box-shadow: 0 0 10px var(--devnahian-sportlixa-brand-volt-glow);
    }
    .devnahian-sportlixa-footer-subscribe-btn:hover {
      background-color: var(--devnahian-sportlixa-brand-volt-hover);
      transform: scale(1.05);
    }
    .devnahian-sportlixa-footer-subscribe-btn svg { width: 15px; height: 15px; stroke: #000; }

    .devnahian-sportlixa-footer-bottom {
      border-top: 1px solid var(--devnahian-sportlixa-border-color);
      padding-top: 24px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      font-size: 11px;
      color: var(--devnahian-sportlixa-text-dim);
    }
    .devnahian-sportlixa-footer-bottom-tagline {
      font-weight: 700;
      color: var(--devnahian-sportlixa-text-muted);
    }

    /* Modal Backdrop & HUD Toast */
    .devnahian-sportlixa-search-modal-backdrop {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.75);
      backdrop-filter: blur(8px);
      z-index: 300;
      opacity: 0;
      visibility: hidden;
      transition: all 0.2s ease;
      display: flex;
      align-items: flex-start;
      justify-content: center;
      padding-top: 10vh;
    }
    .devnahian-sportlixa-search-modal-backdrop.active { opacity: 1; visibility: visible; }
    .devnahian-sportlixa-search-modal {
      width: 90%;
      max-width: 600px;
      background: var(--devnahian-sportlixa-bg-card);
      border: 1px solid var(--devnahian-sportlixa-border-card);
      border-radius: var(--devnahian-sportlixa-radius-md);
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.7);
      overflow: hidden;
      transform: translateY(-16px);
      transition: transform 0.25s var(--devnahian-sportlixa-ease-out);
    }
    .devnahian-sportlixa-search-modal-backdrop.active .devnahian-sportlixa-search-modal { transform: translateY(0); }
    .devnahian-sportlixa-search-modal-input-wrap {
      display: flex;
      align-items: center;
      padding: 16px 20px;
      border-bottom: 1px solid var(--devnahian-sportlixa-border-color);
      gap: 12px;
    }
    .devnahian-sportlixa-search-modal-input-wrap svg {
      width: 18px;
      height: 18px;
      stroke: var(--devnahian-sportlixa-brand-volt);
      flex-shrink: 0;
    }
    .devnahian-sportlixa-search-modal-input {
      background: none;
      border: none;
      color: var(--devnahian-sportlixa-text-white);
      font-size: 15px;
      font-weight: 600;
      width: 100%;
      font-family: inherit;
    }
    .devnahian-sportlixa-search-modal-input:focus { outline: none; }
    .devnahian-sportlixa-search-results-list {
      max-height: 340px;
      overflow-y: auto;
      padding: 10px;
      list-style: none;
      display: flex;
      flex-direction: column;
      gap: 4px;
    }
    .devnahian-sportlixa-search-result-item {
      padding: 10px 14px;
      border-radius: var(--devnahian-sportlixa-radius-sm);
      display: flex;
      align-items: center;
      justify-content: space-between;
      color: var(--devnahian-sportlixa-text-light);
      font-size: 13px;
      cursor: pointer;
      transition: background-color var(--devnahian-sportlixa-transition-fast);
    }
    .devnahian-sportlixa-search-result-item:hover {
      background-color: var(--devnahian-sportlixa-bg-input);
      color: var(--devnahian-sportlixa-brand-volt-text);
    }

    .devnahian-sportlixa-back-to-top {
      position: fixed;
      bottom: 24px;
      right: 24px;
      width: 42px;
      height: 42px;
      border-radius: 50%;
      background: var(--devnahian-sportlixa-bg-card);
      border: 1px solid var(--devnahian-sportlixa-brand-volt);
      color: var(--devnahian-sportlixa-brand-volt);
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      z-index: 95;
      box-shadow: 0 4px 16px rgba(0,0,0,0.4);
      opacity: 0;
      visibility: hidden;
      transform: translateY(10px);
      transition: all var(--devnahian-sportlixa-transition-fast);
    }
    .devnahian-sportlixa-back-to-top.active { opacity: 1; visibility: visible; transform: translateY(0); }
    .devnahian-sportlixa-back-to-top:hover {
      background: var(--devnahian-sportlixa-brand-volt);
      color: #000;
      transform: translateY(-2px);
    }

    .devnahian-sportlixa-toast {
      position: fixed;
      bottom: 24px;
      left: 50%;
      transform: translateX(-50%) translateY(20px);
      background: #080c14;
      border: 1px solid var(--devnahian-sportlixa-brand-volt);
      color: #fff;
      padding: 10px 20px;
      border-radius: 30px;
      font-size: 12px;
      font-weight: 700;
      z-index: 400;
      box-shadow: 0 10px 24px rgba(0,0,0,0.6), 0 0 16px var(--devnahian-sportlixa-brand-volt-glow);
      opacity: 0;
      visibility: hidden;
      transition: all 0.25s var(--devnahian-sportlixa-ease-out);
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .devnahian-sportlixa-toast.active {
      opacity: 1;
      visibility: visible;
      transform: translateX(-50%) translateY(0);
    }

    /* ==========================================================================
       RESPONSIVE BREAKPOINTS
       ========================================================================== */
    @media (max-width: 1024px) {
      .devnahian-sportlixa-navbar { display: none; }
      .devnahian-sportlixa-mobile-menu-trigger { display: flex; }
      .devnahian-sportlixa-mobile-chips-bar { display: flex; }
      .devnahian-sportlixa-mobile-bottom-bar { display: flex; }
      .devnahian-sportlixa-social-links { display: none; }
      .devnahian-sportlixa-search-launcher { display: none; }

      .devnahian-sportlixa-search-layout { grid-template-columns: 1fr; }
      .devnahian-sportlixa-footer-top { grid-template-columns: 1fr 1fr; gap: 28px; }
      .devnahian-sportlixa-footer-top > div:first-child { grid-column: span 2; }
      .devnahian-sportlixa-footer-top > div:last-child { grid-column: span 2; }
    }

    @media (max-width: 640px) {
      .devnahian-sportlixa-container { padding: 0 14px; }
      .devnahian-sportlixa-brand-title { font-size: 20px; }
      .devnahian-sportlixa-search-input-large { font-size: 14px; padding-right: 80px; }
      .devnahian-sportlixa-btn-search-submit { padding: 8px 12px; font-size: 10.5px; }
      .devnahian-sportlixa-search-clear-btn { right: 65px; }
      .devnahian-sportlixa-result-card { flex-direction: column; height: auto; }
      .devnahian-sportlixa-result-thumb { width: 100%; height: 160px; min-width: 100%; }
      .devnahian-sportlixa-entity-spotlight-card { flex-direction: column; text-align: center; }
      .devnahian-sportlixa-entity-stats-row { justify-content: center; }
      .devnahian-sportlixa-footer-top { grid-template-columns: 1fr; gap: 24px; }
      .devnahian-sportlixa-footer-top > div:first-child,
      .devnahian-sportlixa-footer-top > div:last-child { grid-column: span 1; }
      .devnahian-sportlixa-footer-bottom { flex-direction: column; gap: 10px; text-align: center; }
    }
  </style>
</head>
<body>

  <!-- Reading Progress Bar -->
  <div class="devnahian-sportlixa-progress-line" id="devnahian-sportlixa-progressLine"></div>

  <!-- HUD Toast Notification -->
  <div class="devnahian-sportlixa-toast" id="devnahian-sportlixa-toast">
    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--devnahian-sportlixa-brand-volt)" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
    <span id="devnahian-sportlixa-toast-msg">Action completed</span>
  </div>

  <!-- Back to Top Floating Button -->
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
        <a href="category.html" class="devnahian-sportlixa-ticker-item"><span class="tag">NFL</span> Chiefs outduel Bills 24-17 in Week 5 thriller as Mahomes records 3 TDs <span class="sep">&bull;</span></a>
        <a href="#nba" class="devnahian-sportlixa-ticker-item"><span class="tag">NBA</span> Lakers edge Celtics 98-94 behind LeBron James' 28-point performance <span class="sep">&bull;</span></a>
        <a href="single-post.html" class="devnahian-sportlixa-ticker-item"><span class="tag">NFL Wire</span> Rashee Rice listed questionable for Sunday following walkthrough <span class="sep">&bull;</span></a>
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
        <svg class="devnahian-sportlixa-brand-mark-svg" viewBox="0 0 76 42" fill="none">
          <path d="M14 6 L38 6 L31 16 L6 16 Z" fill="#ffffff"/>
          <path d="M28 20 L5 20 L0 32 L34 32 L39 20 Z" fill="#ffffff"/>
          <path d="M46 2 L26 38 L48 38 L54 28 L38 28 L51 6 Z" fill="var(--devnahian-sportlixa-brand-volt)"/>
        </svg>
        <div class="devnahian-sportlixa-brand-text-block">
          <div class="devnahian-sportlixa-brand-title" style="font-size: 20px;">
            <span class="part-sport">SPORT</span>
            <span class="part-lixa">LIXA</span>
          </div>
        </div>
      </div>
      <button type="button" class="devnahian-sportlixa-drawer-close-btn" id="devnahian-sportlixa-drawerCloseBtn" aria-label="Close Navigation">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </button>
    </div>

    <div class="devnahian-sportlixa-drawer-content">
      <a href="index.html" class="devnahian-sportlixa-mobile-nav-link">
        <span>Home</span>
        <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      </a>
      <a href="category.html" class="devnahian-sportlixa-mobile-nav-link">
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
      <a href="scores.html" class="devnahian-sportlixa-mobile-nav-link">
        <span>Live Scores</span>
        <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      </a>
    </div>
  </aside>

  <!-- ==========================================================================
     MOBILE APP BOTTOM BAR
     ========================================================================== -->
  <nav class="devnahian-sportlixa-mobile-bottom-bar" aria-label="Mobile Bottom App Bar">
    <a href="index.html" class="devnahian-sportlixa-bottom-bar-item">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
      <span>Home</span>
    </a>
    <a href="scores.html" class="devnahian-sportlixa-bottom-bar-item">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
      <span>Scores</span>
    </a>
    <a href="category.html" class="devnahian-sportlixa-bottom-bar-item">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
      <span>NFL</span>
    </a>
    <a href="#" class="devnahian-sportlixa-bottom-bar-item active">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
      <span>Search</span>
    </a>
    <div class="devnahian-sportlixa-bottom-bar-item" id="devnahian-sportlixa-mobileMenuTab">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
      <span>Menu</span>
    </div>
  </nav>

  <!-- ==========================================================================
     HEADER & DIRECT NAVBAR (EXACT SITE-WIDE MATCH)
     ========================================================================== -->
  <header>
    <div class="devnahian-sportlixa-container">
      <div class="devnahian-sportlixa-header-top">
        <a href="index.html" class="devnahian-sportlixa-brand-logo-wrap">
          <svg class="devnahian-sportlixa-brand-mark-svg" viewBox="0 0 76 42" fill="none">
            <path d="M14 6 L38 6 L31 16 L6 16 Z" fill="#ffffff"/>
            <path d="M28 20 L5 20 L0 32 L34 32 L39 20 Z" fill="#ffffff"/>
            <path d="M46 2 L26 38 L48 38 L54 28 L38 28 L51 6 Z" fill="var(--devnahian-sportlixa-brand-volt)"/>
          </svg>
          <div class="devnahian-sportlixa-brand-text-block">
            <div class="devnahian-sportlixa-brand-title">
              <span class="part-sport">SPORT</span>
              <span class="part-lixa">LIXA</span>
            </div>
            <div class="devnahian-sportlixa-brand-slogan">YOUR SPORTS. YOUR GAME. YOUR EDGE.</div>
          </div>
        </a>

        <div class="devnahian-sportlixa-header-actions">
          <div class="devnahian-sportlixa-social-links">
            <a href="#" aria-label="X Twitter"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg></a>
            <a href="#" aria-label="Facebook"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M9 8H6v4h3v12h5V12h3.642L18 8h-4V6.333C14 5.374 14.5 5 15.5 5H18V0h-3.808C10.595 0 9 1.583 9 4.615V8z"/></svg></a>
            <a href="#" aria-label="Instagram"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg></a>
            <a href="#" aria-label="YouTube"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg></a>
          </div>

          <button type="button" class="devnahian-sportlixa-theme-toggle-btn" id="devnahian-sportlixa-themeToggleBtn" aria-label="Switch Theme">
            <svg class="moon-icon" viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
            <svg class="sun-icon" viewBox="0 0 24 24" fill="none" stroke-width="2"><circle cx="12" cy="12" r="5"/><path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/></svg>
            <span id="devnahian-sportlixa-themeToggleText">Dark</span>
          </button>

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

      <nav class="devnahian-sportlixa-navbar">
        <a href="index.html" class="devnahian-sportlixa-nav-link">HOME</a>
        <a href="category.html" class="devnahian-sportlixa-nav-link">NFL</a>
        <a href="#nba" class="devnahian-sportlixa-nav-link">NBA</a>
        <a href="#mlb" class="devnahian-sportlixa-nav-link">MLB</a>
        <a href="#nhl" class="devnahian-sportlixa-nav-link">NHL</a>
        <a href="#soccer" class="devnahian-sportlixa-nav-link">SOCCER</a>
        <a href="scores.html" class="devnahian-sportlixa-nav-link">LIVE SCORES</a>
      </nav>
    </div>

    <div class="devnahian-sportlixa-mobile-chips-bar">
      <a href="index.html" class="devnahian-sportlixa-league-chip">Home</a>
      <a href="category.html" class="devnahian-sportlixa-league-chip">NFL</a>
      <a href="#nba" class="devnahian-sportlixa-league-chip">NBA</a>
      <a href="#mlb" class="devnahian-sportlixa-league-chip">MLB</a>
      <a href="#nhl" class="devnahian-sportlixa-league-chip">NHL</a>
      <a href="#soccer" class="devnahian-sportlixa-league-chip">Soccer</a>
      <a href="scores.html" class="devnahian-sportlixa-league-chip">Scores</a>
    </div>
  </header>

  <main class="devnahian-sportlixa-container">
    <!-- ==========================================================================
       DEDICATED SEARCH PAGE HERO & INTERACTIVE QUERY BAR
       ========================================================================== -->
    <section class="devnahian-sportlixa-search-hero">
      <nav class="devnahian-sportlixa-breadcrumbs" aria-label="Breadcrumb">
        <a href="index.html">Home</a>
        <span>/</span>
        <a href="#">Search Center</a>
        <span>/</span>
        <span id="devnahian-sportlixa-queryBreadcrumb">"Patrick Mahomes"</span>
      </nav>

      <!-- Prominent Search Bar -->
      <form class="devnahian-sportlixa-search-box-large" onsubmit="event.preventDefault(); executePageSearch();">
        <svg class="devnahian-sportlixa-search-icon-left" viewBox="0 0 24 24" fill="none" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
        <input 
          type="text" 
          class="devnahian-sportlixa-search-input-large" 
          id="devnahian-sportlixa-pageSearchInput" 
          value="Patrick Mahomes" 
          placeholder="Search by team, player, keyword, or matchup..."
          required
        >
        <button type="button" class="devnahian-sportlixa-search-clear-btn" id="devnahian-sportlixa-searchClearBtn" onclick="clearSearchInput()" aria-label="Clear Search Input">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
        <button type="submit" class="devnahian-sportlixa-btn-search-submit">Search</button>
      </form>

      <!-- Search Query Info & Popular Tags -->
      <div class="devnahian-sportlixa-search-meta-row">
        <div class="devnahian-sportlixa-query-count">
          Found <strong id="devnahian-sportlixa-matchTotal">24 results</strong> in <strong>0.04 seconds</strong>
        </div>

        <div class="devnahian-sportlixa-quick-tags-wrap">
          <span style="font-size:11px; text-transform:uppercase; font-weight:800; color:var(--devnahian-sportlixa-text-dim);">Suggested:</span>
          <button type="button" class="devnahian-sportlixa-quick-tag" onclick="quickFillSearch('Josh Allen')">Josh Allen</button>
          <button type="button" class="devnahian-sportlixa-quick-tag" onclick="quickFillSearch('Lakers vs Celtics')">Lakers vs Celtics</button>
          <button type="button" class="devnahian-sportlixa-quick-tag" onclick="quickFillSearch('NFL Week 5')">NFL Week 5</button>
          <button type="button" class="devnahian-sportlixa-quick-tag" onclick="quickFillSearch('Yankees Wild Card')">Yankees Wild Card</button>
        </div>
      </div>
    </section>

    <!-- Facet Filter Bar (All / Articles / Scores / Profiles / Videos) -->
    <div class="devnahian-sportlixa-facets-toolbar">
      <div class="devnahian-sportlixa-facets-nav">
        <button type="button" class="devnahian-sportlixa-facet-tab active" onclick="switchSearchFacet('all', this)">All Results (24)</button>
        <button type="button" class="devnahian-sportlixa-facet-tab" onclick="switchSearchFacet('articles', this)">Articles (16)</button>
        <button type="button" class="devnahian-sportlixa-facet-tab" onclick="switchSearchFacet('scores', this)">Scores &amp; Games (3)</button>
        <button type="button" class="devnahian-sportlixa-facet-tab" onclick="switchSearchFacet('players', this)">Player Profiles (1)</button>
        <button type="button" class="devnahian-sportlixa-facet-tab" onclick="switchSearchFacet('videos', this)">Videos (4)</button>
      </div>

      <div class="devnahian-sportlixa-sort-wrap">
        <span>Sort By:</span>
        <select class="devnahian-sportlixa-sort-select" onchange="showToast('Sorted by ' + this.value)">
          <option value="Relevance">Most Relevant</option>
          <option value="Newest">Newest First</option>
          <option value="Popularity">Most Viewed</option>
        </select>
      </div>
    </div>

    <!-- ==========================================================================
       MAIN SEARCH RESULTS LAYOUT (FEED + SIDEBAR)
       ========================================================================== -->
    <div class="devnahian-sportlixa-search-layout">
      <!-- Left Column: Results List -->
      <section class="devnahian-sportlixa-results-feed" id="devnahian-sportlixa-resultsFeed">

        <!-- 1. ENTITY KNOWLEDGE SPOTLIGHT CARD (Rich Snippet for Player Search) -->
        <div class="devnahian-sportlixa-entity-spotlight-card" data-facet="players">
          <div class="devnahian-sportlixa-entity-avatar">
            <img 
              src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/77/Patrick_Mahomes_gets_ready_to_snap_the_ball.jpg/300px-Patrick_Mahomes_gets_ready_to_snap_the_ball.jpg" 
              alt="Patrick Mahomes"
              onerror="this.src='https://images.unsplash.com/photo-1566577739112-5180d4bf9390?auto=format&fit=crop&w=200&q=80'"
            >
          </div>
          <div class="devnahian-sportlixa-entity-details">
            <span class="devnahian-sportlixa-entity-badge">NFL Player Spotlight &bull; Active Quarterback</span>
            <h2 class="devnahian-sportlixa-entity-name">Patrick Mahomes II</h2>
            <div class="devnahian-sportlixa-entity-meta">Kansas City Chiefs &bull; #15 &bull; 3x Super Bowl Champion &bull; Texas Tech</div>
            <div class="devnahian-sportlixa-entity-stats-row">
              <div class="devnahian-sportlixa-entity-stat">
                <span>Pass Yds</span>
                <strong>1,315</strong>
              </div>
              <div class="devnahian-sportlixa-entity-stat">
                <span>TD / INT</span>
                <strong>11 / 2</strong>
              </div>
              <div class="devnahian-sportlixa-entity-stat">
                <span>Total QBR</span>
                <strong>84.2</strong>
              </div>
              <div class="devnahian-sportlixa-entity-stat">
                <span>Comp %</span>
                <strong>68.9%</strong>
              </div>
            </div>
          </div>
          <a href="category.html" class="devnahian-sportlixa-btn-view-profile">View Player Hub &rarr;</a>
        </div>

        <!-- 2. EMBEDDED LIVE GAME CARD MATCH -->
        <div class="devnahian-sportlixa-result-game-embed" data-facet="scores">
          <div class="devnahian-sportlixa-embed-match-info">
            <span class="devnahian-sportlixa-badge-tag" style="background:var(--devnahian-sportlixa-red-live); color:#fff !important;">LIVE GAME</span>
            <div>
              <div style="font-size:14px; font-weight:800; color:var(--devnahian-sportlixa-text-white)">
                Kansas City Chiefs vs Buffalo Bills
              </div>
              <div class="devnahian-sportlixa-meta-time">NFL Week 5 &bull; Q4 02:34 &bull; Highmark Stadium</div>
            </div>
          </div>
          <div style="display:flex; align-items:center; gap:16px;">
            <div class="devnahian-sportlixa-embed-score-digits">
              <span class="win">KC 24</span> - <span>17 BUF</span>
            </div>
            <a href="scores.html" class="devnahian-sportlixa-title-link" style="font-weight:800;">Gamecast &rarr;</a>
          </div>
        </div>

        <!-- 3. ARTICLE RESULT 1 -->
        <article class="devnahian-sportlixa-result-card" data-facet="articles">
          <div class="devnahian-sportlixa-result-thumb devnahian-sportlixa-img-box">
            <span class="devnahian-sportlixa-badge-tag devnahian-sportlixa-result-badge">FILM ROOM</span>
            <img 
              src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/77/Patrick_Mahomes_gets_ready_to_snap_the_ball.jpg/800px-Patrick_Mahomes_gets_ready_to_snap_the_ball.jpg" 
              alt="Patrick Mahomes"
              loading="lazy"
              onerror="this.src='https://images.unsplash.com/photo-1566577739112-5180d4bf9390?auto=format&fit=crop&w=800&q=80'"
            >
          </div>
          <div class="devnahian-sportlixa-result-content">
            <div>
              <a href="single-post.html" class="devnahian-sportlixa-result-title">
                Chiefs vs Bills: 5 Tactical Adjustments <span class="devnahian-sportlixa-highlight-term">Patrick Mahomes</span> Made in the Red Zone
              </a>
              <p class="devnahian-sportlixa-result-snippet">
                Kansas City introduced bunch formations to exploit Buffalo's two-high shell, creating clean seams for rookie wideouts while <span class="devnahian-sportlixa-highlight-term">Mahomes</span> shredded underneath coverage.
              </p>
            </div>
            <div class="devnahian-sportlixa-result-footer">
              <span>By Marcus Thompson &bull; Oct 5, 2026 &bull; 6 min read</span>
              <a href="single-post.html" class="devnahian-sportlixa-title-link">Read Full &rarr;</a>
            </div>
          </div>
        </article>

        <!-- 4. ARTICLE RESULT 2 -->
        <article class="devnahian-sportlixa-result-card" data-facet="articles">
          <div class="devnahian-sportlixa-result-thumb devnahian-sportlixa-img-box">
            <span class="devnahian-sportlixa-badge-tag devnahian-sportlixa-result-badge">ANALYSIS</span>
            <img 
              src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/50/Josh_Allen_SEPT2021_%28cropped%29.jpg/800px-Josh_Allen_SEPT2021_%28cropped%29.jpg" 
              alt="Josh Allen"
              loading="lazy"
              onerror="this.src='https://images.unsplash.com/photo-1566577739112-5180d4bf9390?auto=format&fit=crop&w=800&q=80'"
            >
          </div>
          <div class="devnahian-sportlixa-result-content">
            <div>
              <a href="single-post.html" class="devnahian-sportlixa-result-title">
                The Historic Rivalry: Comparing <span class="devnahian-sportlixa-highlight-term">Mahomes</span> vs. Josh Allen Through 8 Career Matchups
              </a>
              <p class="devnahian-sportlixa-result-snippet">
                Analyzing EPA per play, fourth-quarter comebacks, and passer rating inside hostile dome and cold-weather outdoor environments across their legendary duels.
              </p>
            </div>
            <div class="devnahian-sportlixa-result-footer">
              <span>By Mina Kimes &bull; Oct 4, 2026 &bull; 5 min read</span>
              <a href="single-post.html" class="devnahian-sportlixa-title-link">Read Full &rarr;</a>
            </div>
          </div>
        </article>

        <!-- 5. VIDEO RESULT -->
        <article class="devnahian-sportlixa-result-card" data-facet="videos">
          <div class="devnahian-sportlixa-result-thumb devnahian-sportlixa-img-box">
            <span class="devnahian-sportlixa-badge-tag devnahian-sportlixa-result-badge" style="background:#fff; color:#000 !important;">VIDEO CLIP</span>
            <img 
              src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/87/Travis_Kelce_2021.jpg/800px-Travis_Kelce_2021.jpg" 
              alt="Travis Kelce and Patrick Mahomes"
              loading="lazy"
              onerror="this.src='https://images.unsplash.com/photo-1546519638-68e109498ffc?auto=format&fit=crop&w=800&q=80'"
            >
          </div>
          <div class="devnahian-sportlixa-result-content">
            <div>
              <a href="#video" class="devnahian-sportlixa-result-title">
                Film Breakdown: Every No-Look Pass by <span class="devnahian-sportlixa-highlight-term">Patrick Mahomes</span> in Week 5
              </a>
              <p class="devnahian-sportlixa-result-snippet">
                Watch full coaches' film breakdown dissecting how safety manipulation creates wide-open passing lanes in third-and-long situations.
              </p>
            </div>
            <div class="devnahian-sportlixa-result-footer">
              <span>SportLixa Video Hub &bull; 04:32 Runtime &bull; 14.8K Views</span>
              <a href="#video" class="devnahian-sportlixa-title-link">Watch Video &rarr;</a>
            </div>
          </div>
        </article>

      </section>

      <!-- Right Column: Sidebar Facet Filters & Trending -->
      <aside class="devnahian-sportlixa-search-sidebar">
        <!-- Filter by League Facet -->
        <div class="devnahian-sportlixa-filter-card">
          <div class="devnahian-sportlixa-filter-title">
            <span>Filter By League</span>
            <button type="button" style="background:none; border:none; color:var(--devnahian-sportlixa-brand-volt-text); font-size:10px; font-weight:800; cursor:pointer;" onclick="resetSidebarFilters()">Reset</button>
          </div>
          <ul class="devnahian-sportlixa-filter-list">
            <li class="devnahian-sportlixa-filter-option selected" onclick="toggleSidebarOption(this)">
              <span>NFL Football</span>
              <span class="devnahian-sportlixa-count-pill">18</span>
            </li>
            <li class="devnahian-sportlixa-filter-option" onclick="toggleSidebarOption(this)">
              <span>NBA Basketball</span>
              <span class="devnahian-sportlixa-count-pill">3</span>
            </li>
            <li class="devnahian-sportlixa-filter-option" onclick="toggleSidebarOption(this)">
              <span>MLB Baseball</span>
              <span class="devnahian-sportlixa-count-pill">2</span>
            </li>
            <li class="devnahian-sportlixa-filter-option" onclick="toggleSidebarOption(this)">
              <span>Soccer &amp; MLS</span>
              <span class="devnahian-sportlixa-count-pill">1</span>
            </li>
          </ul>
        </div>

        <!-- Filter by Date Facet -->
        <div class="devnahian-sportlixa-filter-card">
          <div class="devnahian-sportlixa-filter-title">
            <span>Published Date</span>
          </div>
          <ul class="devnahian-sportlixa-filter-list">
            <li class="devnahian-sportlixa-filter-option selected" onclick="toggleSidebarOption(this)">
              <span>Any Time</span>
              <span class="devnahian-sportlixa-count-pill">24</span>
            </li>
            <li class="devnahian-sportlixa-filter-option" onclick="toggleSidebarOption(this)">
              <span>Past 24 Hours</span>
              <span class="devnahian-sportlixa-count-pill">6</span>
            </li>
            <li class="devnahian-sportlixa-filter-option" onclick="toggleSidebarOption(this)">
              <span>Past 7 Days</span>
              <span class="devnahian-sportlixa-count-pill">14</span>
            </li>
            <li class="devnahian-sportlixa-filter-option" onclick="toggleSidebarOption(this)">
              <span>Past 30 Days</span>
              <span class="devnahian-sportlixa-count-pill">21</span>
            </li>
          </ul>
        </div>

        <!-- Trending Searches -->
        <div class="devnahian-sportlixa-filter-card">
          <div class="devnahian-sportlixa-filter-title">
            <span>Popular Queries</span>
          </div>
          <div class="devnahian-sportlixa-quick-tags-wrap" style="gap:6px;">
            <button type="button" class="devnahian-sportlixa-quick-tag" onclick="quickFillSearch('Chiefs vs Bills')">#ChiefsVsBills</button>
            <button type="button" class="devnahian-sportlixa-quick-tag" onclick="quickFillSearch('LeBron James')">#LeBron28Pts</button>
            <button type="button" class="devnahian-sportlixa-quick-tag" onclick="quickFillSearch('Aaron Judge')">#JudgePostseason</button>
            <button type="button" class="devnahian-sportlixa-quick-tag" onclick="quickFillSearch('Lionel Messi')">#MessiInterMiami</button>
            <button type="button" class="devnahian-sportlixa-quick-tag" onclick="quickFillSearch('NFL Injury Wire')">#InjuryWire</button>
          </div>
        </div>
      </aside>
    </div>

    <!-- Pagination -->
    <div class="devnahian-sportlixa-pagination-wrap">
      <button type="button" class="devnahian-sportlixa-page-btn" aria-label="Previous Page" onclick="showToast('Loading page 1')">&laquo;</button>
      <button type="button" class="devnahian-sportlixa-page-btn active">1</button>
      <button type="button" class="devnahian-sportlixa-page-btn" onclick="showToast('Loading page 2')">2</button>
      <button type="button" class="devnahian-sportlixa-page-btn" onclick="showToast('Loading page 3')">3</button>
      <button type="button" class="devnahian-sportlixa-page-btn" aria-label="Next Page" onclick="showToast('Loading next page')">&raquo;</button>
    </div>
  </main>

  <!-- ==========================================================================
     PROFESSIONAL FOOTER & MENU WITH ARROW SVGS (EXACT MATCH)
     ========================================================================== -->
  <footer>
    <div class="devnahian-sportlixa-container">
      <div class="devnahian-sportlixa-footer-top">
        <!-- Col 1: Brand & Socials -->
        <div>
          <a href="index.html" class="devnahian-sportlixa-brand-logo-wrap" style="margin-bottom: 14px;">
            <svg class="devnahian-sportlixa-brand-mark-svg" viewBox="0 0 76 42" fill="none">
              <path d="M14 6 L38 6 L31 16 L6 16 Z" fill="#ffffff"/>
              <path d="M28 20 L5 20 L0 32 L34 32 L39 20 Z" fill="#ffffff"/>
              <path d="M46 2 L26 38 L48 38 L54 28 L38 28 L51 6 Z" fill="var(--devnahian-sportlixa-brand-volt)"/>
            </svg>
            <div class="devnahian-sportlixa-brand-text-block">
              <div class="devnahian-sportlixa-brand-title">
                <span class="part-sport">SPORT</span>
                <span class="part-lixa">LIXA</span>
              </div>
              <div class="devnahian-sportlixa-brand-slogan">YOUR SPORTS. YOUR GAME. YOUR EDGE.</div>
            </div>
          </a>
          <p style="font-size:12px; color:var(--devnahian-sportlixa-text-muted); line-height:1.55; margin-bottom:16px;">
            The definitive digital sports newsroom delivering real-time NFL analytics, verified injury reports, video breakdowns, and live scoreboards.
          </p>
          <div class="devnahian-sportlixa-social-links" style="display:flex; margin-top: 14px;">
            <a href="#" aria-label="X Twitter"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg></a>
            <a href="#" aria-label="Facebook"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M9 8H6v4h3v12h5V12h3.642L18 8h-4V6.333C14 5.374 14.5 5 15.5 5H18V0h-3.808C10.595 0 9 1.583 9 4.615V8z"/></svg></a>
            <a href="#" aria-label="Instagram"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg></a>
            <a href="#" aria-label="YouTube"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg></a>
          </div>
        </div>

        <!-- Col 2: Quick Links -->
        <div>
          <div class="devnahian-sportlixa-footer-col-title">Quick Links</div>
          <ul class="devnahian-sportlixa-footer-links-list">
            <li>
              <a href="index.html">
                <svg class="devnahian-sportlixa-footer-menu-arrow" viewBox="0 0 24 24" fill="none" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                <span>Home</span>
              </a>
            </li>
            <li>
              <a href="category.html">
                <svg class="devnahian-sportlixa-footer-menu-arrow" viewBox="0 0 24 24" fill="none" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                <span>NFL</span>
              </a>
            </li>
            <li>
              <a href="#nba">
                <svg class="devnahian-sportlixa-footer-menu-arrow" viewBox="0 0 24 24" fill="none" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                <span>NBA</span>
              </a>
            </li>
            <li>
              <a href="#mlb">
                <svg class="devnahian-sportlixa-footer-menu-arrow" viewBox="0 0 24 24" fill="none" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                <span>MLB</span>
              </a>
            </li>
            <li>
              <a href="#nhl">
                <svg class="devnahian-sportlixa-footer-menu-arrow" viewBox="0 0 24 24" fill="none" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                <span>NHL</span>
              </a>
            </li>
            <li>
              <a href="#soccer">
                <svg class="devnahian-sportlixa-footer-menu-arrow" viewBox="0 0 24 24" fill="none" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                <span>Soccer</span>
              </a>
            </li>
          </ul>
        </div>

        <!-- Col 3: More -->
        <div>
          <div class="devnahian-sportlixa-footer-col-title">More</div>
          <ul class="devnahian-sportlixa-footer-links-list">
            <li>
              <a href="scores.html">
                <svg class="devnahian-sportlixa-footer-menu-arrow" viewBox="0 0 24 24" fill="none" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                <span>Live Scores</span>
              </a>
            </li>
            <li>
              <a href="category.html#standings">
                <svg class="devnahian-sportlixa-footer-menu-arrow" viewBox="0 0 24 24" fill="none" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                <span>NFL Standings</span>
              </a>
            </li>
            <li>
              <a href="category.html#injury">
                <svg class="devnahian-sportlixa-footer-menu-arrow" viewBox="0 0 24 24" fill="none" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                <span>Injury Wire</span>
              </a>
            </li>
            <li>
              <a href="#trending">
                <svg class="devnahian-sportlixa-footer-menu-arrow" viewBox="0 0 24 24" fill="none" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                <span>Trending Buzz</span>
              </a>
            </li>
          </ul>
        </div>

        <!-- Col 4: Legal -->
        <div>
          <div class="devnahian-sportlixa-footer-col-title">Legal</div>
          <ul class="devnahian-sportlixa-footer-links-list">
            <li>
              <a href="#">
                <svg class="devnahian-sportlixa-footer-menu-arrow" viewBox="0 0 24 24" fill="none" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                <span>Privacy Policy</span>
              </a>
            </li>
            <li>
              <a href="#">
                <svg class="devnahian-sportlixa-footer-menu-arrow" viewBox="0 0 24 24" fill="none" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                <span>Terms of Service</span>
              </a>
            </li>
            <li>
              <a href="#">
                <svg class="devnahian-sportlixa-footer-menu-arrow" viewBox="0 0 24 24" fill="none" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                <span>Cookie Policy</span>
              </a>
            </li>
            <li>
              <a href="#">
                <svg class="devnahian-sportlixa-footer-menu-arrow" viewBox="0 0 24 24" fill="none" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                <span>Contact Us</span>
              </a>
            </li>
          </ul>
        </div>

        <!-- Col 5: Stay Updated -->
        <div>
          <div class="devnahian-sportlixa-footer-col-title">Stay Updated</div>
          <p style="font-size:12px; color:var(--devnahian-sportlixa-text-muted); line-height:1.45;">Get sports highlights & daily updates.</p>
          <form class="devnahian-sportlixa-footer-subscribe-box" onsubmit="event.preventDefault(); showToast('Subscribed to SportLixa!');">
            <input type="email" class="devnahian-sportlixa-footer-subscribe-input" placeholder="Enter your email" required>
            <button type="submit" class="devnahian-sportlixa-footer-subscribe-btn" aria-label="Send Email">
              <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
            </button>
          </form>
        </div>
      </div>

      <div class="devnahian-sportlixa-footer-bottom">
        <div>&copy; 2026 SportLixa. All rights reserved.</div>
        <div class="devnahian-sportlixa-footer-bottom-tagline">
          Your Sports. Your Game. Your Edge.
        </div>
      </div>
    </div>
  </footer>

  <!-- ==========================================================================
     COMMAND-K / SEARCH OVERLAY MODAL
     ========================================================================== -->
  <div class="devnahian-sportlixa-search-modal-backdrop" id="devnahian-sportlixa-searchModalBackdrop">
    <div class="devnahian-sportlixa-search-modal" role="dialog" aria-modal="true">
      <div class="devnahian-sportlixa-search-modal-input-wrap">
        <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
        <input type="text" class="devnahian-sportlixa-search-modal-input" id="devnahian-sportlixa-modalSearchInput" placeholder="Search live games, scores, or teams...">
      </div>
      <ul class="devnahian-sportlixa-search-results-list" id="devnahian-sportlixa-searchResults">
        <li class="devnahian-sportlixa-search-result-item" onclick="selectSearchResult('category.html')">
          <span>🏈 <strong>Chiefs vs Bills</strong> — Live Scoreboard &amp; Linescore</span>
          <span style="font-size:11px; color:var(--devnahian-sportlixa-brand-volt-text)">LIVE</span>
        </li>
        <li class="devnahian-sportlixa-search-result-item" onclick="selectSearchResult('scores.html')">
          <span>🏀 <strong>Lakers vs Celtics</strong> — 4th Quarter Box Score</span>
          <span style="font-size:11px; color:var(--devnahian-sportlixa-brand-volt-text)">LIVE</span>
        </li>
        <li class="devnahian-sportlixa-search-result-item" onclick="selectSearchResult('scores.html')">
          <span>⚾ <strong>Yankees vs Red Sox</strong> — AL Wild Card Duel</span>
          <span style="font-size:11px; color:var(--devnahian-sportlixa-brand-volt-text)">LIVE</span>
        </li>
      </ul>
    </div>
  </div>

  <!-- ==========================================================================
     INTERACTIVE JAVASCRIPT
     ========================================================================== -->
  <script>
    // Theme Toggle Logic
    const themeToggleBtn = document.getElementById('devnahian-sportlixa-themeToggleBtn');
    const themeToggleText = document.getElementById('devnahian-sportlixa-themeToggleText');
    const htmlElement = document.documentElement;

    const currentTheme = localStorage.getItem('devnahian_sportlixa_theme') || 'dark';
    htmlElement.setAttribute('data-theme', currentTheme);
    themeToggleText.textContent = currentTheme === 'dark' ? 'Dark' : 'Light';

    themeToggleBtn.addEventListener('click', () => {
      const activeTheme = htmlElement.getAttribute('data-theme');
      const targetTheme = activeTheme === 'dark' ? 'light' : 'dark';
      
      htmlElement.setAttribute('data-theme', targetTheme);
      themeToggleText.textContent = targetTheme === 'dark' ? 'Dark' : 'Light';
      localStorage.setItem('devnahian_sportlixa_theme', targetTheme);
    });

    // Mobile Drawer Logic
    const mobileDrawer = document.getElementById('devnahian-sportlixa-mobileDrawer');
    const drawerOverlay = document.getElementById('devnahian-sportlixa-drawerOverlay');
    const mobileMenuTrigger = document.getElementById('devnahian-sportlixa-mobileMenuTrigger');
    const drawerCloseBtn = document.getElementById('devnahian-sportlixa-drawerCloseBtn');
    const mobileMenuTab = document.getElementById('devnahian-sportlixa-mobileMenuTab');

    function openMobileDrawer() {
      mobileDrawer.classList.add('active');
      drawerOverlay.classList.add('active');
      document.body.style.overflow = 'hidden';
    }

    function closeMobileDrawer() {
      mobileDrawer.classList.remove('active');
      drawerOverlay.classList.remove('active');
      document.body.style.overflow = '';
    }

    mobileMenuTrigger.addEventListener('click', openMobileDrawer);
    drawerCloseBtn.addEventListener('click', closeMobileDrawer);
    drawerOverlay.addEventListener('click', closeMobileDrawer);
    mobileMenuTab.addEventListener('click', openMobileDrawer);

    // Reading Progress Indicator & Back to Top
    const progressLine = document.getElementById('devnahian-sportlixa-progressLine');
    const backToTopBtn = document.getElementById('devnahian-sportlixa-backToTop');

    window.addEventListener('scroll', () => {
      const winScroll = document.documentElement.scrollTop || document.body.scrollTop;
      const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
      const scrolled = (winScroll / height) * 100;
      progressLine.style.width = scrolled + '%';

      if (winScroll > 320) {
        backToTopBtn.classList.add('active');
      } else {
        backToTopBtn.classList.remove('active');
      }
    });

    backToTopBtn.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    // Toast HUD Alert
    const toastElem = document.getElementById('devnahian-sportlixa-toast');
    const toastMsg = document.getElementById('devnahian-sportlixa-toast-msg');
    let toastTimeout;

    function showToast(message) {
      toastMsg.textContent = message;
      toastElem.classList.add('active');
      clearTimeout(toastTimeout);
      toastTimeout = setTimeout(() => {
        toastElem.classList.remove('active');
      }, 2600);
    }

    // Interactive Search Execution
    const pageSearchInput = document.getElementById('devnahian-sportlixa-pageSearchInput');
    const queryBreadcrumb = document.getElementById('devnahian-sportlixa-queryBreadcrumb');

    function executePageSearch() {
      const query = pageSearchInput.value.trim();
      if (!query) return;
      queryBreadcrumb.textContent = `"${query}"`;
      showToast(`Searching for "${query}"...`);
    }

    function clearSearchInput() {
      pageSearchInput.value = '';
      pageSearchInput.focus();
    }

    function quickFillSearch(term) {
      pageSearchInput.value = term;
      queryBreadcrumb.textContent = `"${term}"`;
      showToast(`Filtered by "${term}"`);
    }

    // Facet Tabs (All / Articles / Scores / Players / Videos)
    function switchSearchFacet(facet, btn) {
      const tabs = document.querySelectorAll('.devnahian-sportlixa-facet-tab');
      tabs.forEach(t => t.classList.remove('active'));
      btn.classList.add('active');

      const items = document.querySelectorAll('#devnahian-sportlixa-resultsFeed > *');
      let count = 0;

      items.forEach(item => {
        if (facet === 'all' || item.dataset.facet === facet) {
          item.style.display = 'flex';
          count++;
        } else {
          item.style.display = 'none';
        }
      });
      showToast(`Showing ${count} result(s)`);
    }

    // Sidebar Filter Selection
    function toggleSidebarOption(el) {
      const parent = el.parentElement;
      parent.querySelectorAll('.devnahian-sportlixa-filter-option').forEach(opt => opt.classList.remove('selected'));
      el.classList.add('selected');
      const text = el.querySelector('span').textContent;
      showToast(`Filter applied: ${text}`);
    }

    function resetSidebarFilters() {
      document.querySelectorAll('.devnahian-sportlixa-filter-list').forEach(list => {
        const options = list.querySelectorAll('.devnahian-sportlixa-filter-option');
        options.forEach(opt => opt.classList.remove('selected'));
        if (options[0]) options[0].classList.add('selected');
      });
      showToast('Filters reset to default');
    }

    // Command-K / Search Modal
    const searchModalBackdrop = document.getElementById('devnahian-sportlixa-searchModalBackdrop');
    const searchLauncher = document.getElementById('devnahian-sportlixa-searchLauncher');
    const modalSearchInput = document.getElementById('devnahian-sportlixa-modalSearchInput');

    function openSearchModal() {
      searchModalBackdrop.classList.add('active');
      setTimeout(() => modalSearchInput.focus(), 80);
      document.body.style.overflow = 'hidden';
    }

    function closeSearchModal() {
      searchModalBackdrop.classList.remove('active');
      document.body.style.overflow = '';
    }

    searchLauncher.addEventListener('click', openSearchModal);

    searchModalBackdrop.addEventListener('click', (e) => {
      if (e.target === searchModalBackdrop) closeSearchModal();
    });

    window.addEventListener('keydown', (e) => {
      if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
        e.preventDefault();
        openSearchModal();
      }
      if (e.key === 'Escape' && searchModalBackdrop.classList.contains('active')) {
        closeSearchModal();
      }
    });

    function selectSearchResult(targetId) {
      closeSearchModal();
      window.location.href = targetId;
    }
  </script>

</body>
</html>