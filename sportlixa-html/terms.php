<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>Terms of Service — SPORTLIXA — Your Sports. Your Game. Your Edge.</title>
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
      
      --shadow-dropdown: 0 14px 32px rgba(0, 0, 0, 0.12);
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
      line-height: 1.5;
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
    }

    .devnahian-sportlixa-meta-time {
      font-size: 11.5px;
      color: var(--devnahian-sportlixa-text-dim);
      display: flex;
      align-items: center;
      gap: 6px;
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
    .devnahian-sportlixa-nav-link:hover { color: var(--devnahian-sportlixa-brand-volt-text); }
    .devnahian-sportlixa-nav-link:hover::after {
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
    .devnahian-sportlixa-league-chip:hover {
      background: var(--devnahian-sportlixa-brand-volt);
      color: #000;
      border-color: var(--devnahian-sportlixa-brand-volt);
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
    .devnahian-sportlixa-mobile-nav-link:hover {
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
       TERMS HERO & BREADCRUMBS
       ========================================================================== */
    .devnahian-sportlixa-legal-banner {
      padding: 28px 0 24px;
      border-bottom: 1px solid var(--devnahian-sportlixa-border-color);
      margin-bottom: 32px;
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

    .devnahian-sportlixa-legal-heading {
      font-size: 34px;
      font-weight: 900;
      font-style: italic;
      color: var(--devnahian-sportlixa-text-white);
      line-height: 1.15;
      letter-spacing: -0.6px;
      text-transform: uppercase;
      margin-bottom: 10px;
    }
    .devnahian-sportlixa-legal-subtext {
      font-size: 14px;
      color: var(--devnahian-sportlixa-text-muted);
      max-width: 780px;
      line-height: 1.6;
    }
    .devnahian-sportlixa-compliance-badge-row {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-top: 14px;
      flex-wrap: wrap;
    }
    .devnahian-sportlixa-compliance-chip {
      background: var(--devnahian-sportlixa-bg-input);
      border: 1px solid var(--devnahian-sportlixa-border-card);
      color: var(--devnahian-sportlixa-text-light);
      padding: 4px 10px;
      border-radius: var(--devnahian-sportlixa-radius-sm);
      font-size: 11px;
      font-weight: 700;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }
    .devnahian-sportlixa-compliance-chip svg { width: 13px; height: 13px; stroke: var(--devnahian-sportlixa-brand-volt); }

    /* ==========================================================================
       LEGAL 2-COLUMN LAYOUT (STICKY TOC + MAIN CONTENT)
       ========================================================================== */
    .devnahian-sportlixa-legal-grid {
      display: grid;
      grid-template-columns: 290px 1fr;
      gap: 36px;
      margin-bottom: 60px;
      align-items: start;
    }

    /* Sticky Table of Contents */
    .devnahian-sportlixa-toc-card {
      background: var(--devnahian-sportlixa-bg-card);
      border: 1px solid var(--devnahian-sportlixa-border-card);
      border-radius: var(--devnahian-sportlixa-radius-md);
      padding: 22px;
      position: sticky;
      top: 86px;
      box-shadow: var(--devnahian-sportlixa-shadow-card);
    }
    .devnahian-sportlixa-toc-title {
      font-size: 12px;
      font-weight: 800;
      color: var(--devnahian-sportlixa-text-white);
      text-transform: uppercase;
      letter-spacing: 0.6px;
      margin-bottom: 14px;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .devnahian-sportlixa-toc-list {
      list-style: none;
      display: flex;
      flex-direction: column;
      gap: 6px;
    }
    .devnahian-sportlixa-toc-link {
      display: block;
      font-size: 12.5px;
      font-weight: 600;
      color: var(--devnahian-sportlixa-text-muted);
      padding: 6px 10px;
      border-radius: var(--devnahian-sportlixa-radius-sm);
      border-left: 2px solid transparent;
      transition: all var(--devnahian-sportlixa-transition-fast);
    }
    .devnahian-sportlixa-toc-link:hover, .devnahian-sportlixa-toc-link.active {
      background: var(--devnahian-sportlixa-bg-input);
      color: var(--devnahian-sportlixa-brand-volt-text);
      border-left-color: var(--devnahian-sportlixa-brand-volt);
      padding-left: 14px;
    }

    /* Legal Body Sections */
    .devnahian-sportlixa-legal-body {
      display: flex;
      flex-direction: column;
      gap: 28px;
    }
    .devnahian-sportlixa-legal-section {
      background: var(--devnahian-sportlixa-bg-card);
      border: 1px solid var(--devnahian-sportlixa-border-card);
      border-radius: var(--devnahian-sportlixa-radius-md);
      padding: 28px 30px;
      box-shadow: var(--devnahian-sportlixa-shadow-card);
      scroll-margin-top: 90px;
    }
    .devnahian-sportlixa-legal-section h2 {
      font-size: 20px;
      font-weight: 900;
      font-style: italic;
      color: var(--devnahian-sportlixa-text-white);
      margin-bottom: 12px;
      letter-spacing: -0.3px;
    }
    .devnahian-sportlixa-legal-section p {
      font-size: 14.5px;
      color: var(--devnahian-sportlixa-text-light);
      line-height: 1.7;
      margin-bottom: 14px;
    }
    .devnahian-sportlixa-legal-section p:last-child {
      margin-bottom: 0;
    }

    .devnahian-sportlixa-legal-list {
      margin: 12px 0 16px 20px;
      display: flex;
      flex-direction: column;
      gap: 8px;
      font-size: 14px;
      color: var(--devnahian-sportlixa-text-light);
    }
    .devnahian-sportlixa-legal-list li strong {
      color: var(--devnahian-sportlixa-text-white);
    }

    .devnahian-sportlixa-legal-callout {
      background: var(--devnahian-sportlixa-bg-input);
      border-left: 4px solid var(--devnahian-sportlixa-brand-volt);
      padding: 16px 20px;
      border-radius: 0 var(--devnahian-sportlixa-radius-sm) var(--devnahian-sportlixa-radius-sm) 0;
      margin: 16px 0;
      font-size: 13.5px;
      line-height: 1.6;
    }
    .devnahian-sportlixa-legal-callout strong {
      color: var(--devnahian-sportlixa-brand-volt-text);
    }

    .devnahian-sportlixa-terms-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 14px;
      font-size: 13px;
    }
    .devnahian-sportlixa-terms-table th {
      text-align: left;
      font-size: 11px;
      color: var(--devnahian-sportlixa-text-dim);
      font-weight: 800;
      text-transform: uppercase;
      padding: 10px 14px;
      background: var(--devnahian-sportlixa-bg-input);
      border-bottom: 1px solid var(--devnahian-sportlixa-border-color);
    }
    .devnahian-sportlixa-terms-table td {
      padding: 12px 14px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.04);
      color: var(--devnahian-sportlixa-text-light);
    }

    /* ==========================================================================
       PROFESSIONAL FOOTER & MENU WITH ARROW SVGS
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

    /* Modal Backdrop & Search */
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

      .devnahian-sportlixa-legal-grid { grid-template-columns: 1fr; }
      .devnahian-sportlixa-toc-card { display: none; }
      .devnahian-sportlixa-footer-top { grid-template-columns: 1fr 1fr; gap: 28px; }
      .devnahian-sportlixa-footer-top > div:first-child { grid-column: span 2; }
      .devnahian-sportlixa-footer-top > div:last-child { grid-column: span 2; }
    }

    @media (max-width: 640px) {
      .devnahian-sportlixa-container { padding: 0 14px; }
      .devnahian-sportlixa-brand-title { font-size: 20px; }
      .devnahian-sportlixa-legal-heading { font-size: 26px; }
      .devnahian-sportlixa-legal-section { padding: 20px 16px; }
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
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/></svg>
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
    <a href="search.html" class="devnahian-sportlixa-bottom-bar-item">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
      <span>Search</span>
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
            <a href="#" aria-label="YouTube"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg></a>
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
       TERMS OF SERVICE BANNER
       ========================================================================== -->
    <section class="devnahian-sportlixa-legal-banner">
      <nav class="devnahian-sportlixa-breadcrumbs" aria-label="Breadcrumb">
        <a href="index.html">Home</a>
        <span>/</span>
        <a href="#">Legal</a>
        <span>/</span>
        <span>Terms of Service</span>
      </nav>

      <span class="devnahian-sportlixa-badge-tag">USER AGREEMENT</span>
      <h1 class="devnahian-sportlixa-legal-heading" style="margin-top: 10px;">Terms of Service</h1>
      <p class="devnahian-sportlixa-legal-subtext">
        These Terms of Service govern your access to and use of SportLixa's digital properties, real-time sports scoreboards, editorial analyses, fantasy wire content, and associated interactive features. By viewing or interacting with our services, you accept and agree to be bound by these provisions.
      </p>

      <div class="devnahian-sportlixa-compliance-badge-row">
        <div class="devnahian-sportlixa-compliance-chip">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
          Binding Agreement
        </div>
        <div class="devnahian-sportlixa-compliance-chip">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
          Effective Date: October 11, 2026
        </div>
        <div class="devnahian-sportlixa-compliance-chip">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
          Global Operations
        </div>
      </div>
    </section>

    <!-- ==========================================================================
       MAIN LEGAL LAYOUT (TOC + SECTIONS)
       ========================================================================== -->
    <div class="devnahian-sportlixa-legal-grid">
      <!-- Left Column: Sticky Table of Contents -->
      <aside>
        <div class="devnahian-sportlixa-toc-card">
          <div class="devnahian-sportlixa-toc-title">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--devnahian-sportlixa-brand-volt)" stroke-width="2.5"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
            Terms Outline
          </div>
          <ul class="devnahian-sportlixa-toc-list">
            <li><a href="#acceptance" class="devnahian-sportlixa-toc-link active" onclick="activateToc(this)">1. Acceptance of Terms</a></li>
            <li><a href="#intellectual-property" class="devnahian-sportlixa-toc-link" onclick="activateToc(this)">2. IP &amp; Editorial Content</a></li>
            <li><a href="#sports-data" class="devnahian-sportlixa-toc-link" onclick="activateToc(this)">3. Scores, Odds &amp; Data</a></li>
            <li><a href="#acceptable-use" class="devnahian-sportlixa-toc-link" onclick="activateToc(this)">4. Acceptable Conduct</a></li>
            <li><a href="#user-contributions" class="devnahian-sportlixa-toc-link" onclick="activateToc(this)">5. User Comments &amp; Votes</a></li>
            <li><a href="#disclaimers" class="devnahian-sportlixa-toc-link" onclick="activateToc(this)">6. Disclaimers &amp; Wagering</a></li>
            <li><a href="#liability" class="devnahian-sportlixa-toc-link" onclick="activateToc(this)">7. Limitation of Liability</a></li>
            <li><a href="#governing-law" class="devnahian-sportlixa-toc-link" onclick="activateToc(this)">8. Dispute Resolution</a></li>
          </ul>
        </div>
      </aside>

      <!-- Right Column: Terms of Service Content -->
      <article class="devnahian-sportlixa-legal-body">
        
        <!-- Section 1 -->
        <section class="devnahian-sportlixa-legal-section" id="acceptance">
          <h2>1. Acceptance of Terms</h2>
          <p>
            By accessing SportLixa via web, mobile device, or RSS syndication, you acknowledge that you have read, understood, and agreed to these Terms of Service, along with our <a href="privacy-policy.html" style="color:var(--devnahian-sportlixa-brand-volt-text); font-weight:800; text-decoration:underline;">Privacy Policy</a> and <a href="cookie-policy.html" style="color:var(--devnahian-sportlixa-brand-volt-text); font-weight:800; text-decoration:underline;">Cookie Policy</a>.
          </p>
          <p>
            If you do not agree to these terms, you must immediately cease using SportLixa. We reserve the right to amend or update these terms at our sole discretion, with updates taking immediate effect upon posting.
          </p>
        </section>

        <!-- Section 2 -->
        <section class="devnahian-sportlixa-legal-section" id="intellectual-property">
          <h2>2. Intellectual Property &amp; Editorial Rights</h2>
          <p>
            All original journalism, film breakdowns, design assets, audio podcasts, code scripts, logos, and branding elements across SportLixa are the exclusive property of SportLixa Digital Media Inc. and are protected under international copyright, trademark, and trade dress regulations.
          </p>
          <ul class="devnahian-sportlixa-legal-list">
            <li><strong>Permitted Editorial Sharing:</strong> You may share links to our articles and quote small excerpts (under 100 words) provided clear attribution and a direct hyperlink to SportLixa are provided.</li>
            <li><strong>Prohibited Reproduction:</strong> You may not scrape, mirror, systematically extract, republish, or broadcast our comprehensive written articles or proprietary datasets without express written authorization.</li>
          </ul>
        </section>

        <!-- Section 3 -->
        <section class="devnahian-sportlixa-legal-section" id="sports-data">
          <h2>3. Real-Time Scores, Lines &amp; Statistical Feeds</h2>
          <p>
            SportLixa displays sports statistics, drive charts, player milestones, and live scores sourced from official league feeds and third-party sports telemetry partners.
          </p>
          <div class="devnahian-sportlixa-legal-callout">
            <strong>Latency &amp; Accuracy Notice:</strong> While we aim for sub-second updates, live scores, quarter clocks, and team possessions are provided for informational and entertainment purposes only and may experience occasional network delays.
          </div>
        </section>

        <!-- Section 4 -->
        <section class="devnahian-sportlixa-legal-section" id="acceptable-use">
          <h2>4. Acceptable Conduct &amp; Platform Restrictions</h2>
          <p>
            As a condition of using SportLixa, you agree not to engage in prohibited behaviors:
          </p>
          <table class="devnahian-sportlixa-terms-table">
            <thead>
              <tr>
                <th>Category</th>
                <th>Prohibited Activity</th>
                <th>Enforcement Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>Automated Scraping</strong></td>
                <td>Deploying bots, spiders, or scrapers to harvest scores or article bodies.</td>
                <td>Immediate IP Blacklisting &amp; Firewall Block</td>
              </tr>
              <tr>
                <td><strong>Platform Integrity</strong></td>
                <td>Attempting DDoS attacks, probing server vulnerabilities, or injecting code.</td>
                <td>Legal Action &amp; Law Enforcement Referral</td>
              </tr>
              <tr>
                <td><strong>Community Harassment</strong></td>
                <td>Posting defamatory, hateful, abusive, or commercial spam comments.</td>
                <td>Comment Removal &amp; Permanent Profile Ban</td>
              </tr>
            </tbody>
          </table>
        </section>

        <!-- Section 5 -->
        <section class="devnahian-sportlixa-legal-section" id="user-contributions">
          <h2>5. User Comments &amp; Interactive Picks</h2>
          <p>
            When you post comments in the discussion section, participate in fan game picks, or submit feedback, you grant SportLixa a worldwide, royalty-free, perpetual license to display and moderate that content across our digital network.
          </p>
          <p>
            SportLixa is not responsible for user-generated opinions expressed in comment sections. We reserve the right to review, edit, or purge any comment that breaches community decency guidelines.
          </p>
        </section>

        <!-- Section 6 -->
        <section class="devnahian-sportlixa-legal-section" id="disclaimers">
          <h2>6. Sports Wagering &amp; Financial Disclaimers</h2>
          <p>
            SportLixa provides statistical insights, betting trends, odds, and computer simulations strictly for journalistic, editorial, and recreational purposes.
          </p>
          <div class="devnahian-sportlixa-legal-callout">
            <strong>Not a Gambling Operator:</strong> SportLixa is not a sportsbook and does not accept wagers or process bets. We make no warranty regarding the success or profitability of any athletic projection or spread analysis. Please wager responsibly and observe local gambling laws.
          </div>
        </section>

        <!-- Section 7 -->
        <section class="devnahian-sportlixa-legal-section" id="liability">
          <h2>7. Limitation of Liability</h2>
          <p>
            In no event shall SportLixa, its officers, analysts, editors, or parent entities be liable for any indirect, incidental, punitive, or consequential damages resulting from your use of the platform, service interruptions, scoring inaccuracies, or decisions based on editorial content.
          </p>
        </section>

        <!-- Section 8 -->
        <section class="devnahian-sportlixa-legal-section" id="governing-law">
          <h2>8. Governing Law &amp; Dispute Resolution</h2>
          <p>
            These Terms of Service are governed by and construed in accordance with the laws of the State of New York, USA, without regard to its conflict of law principles.
          </p>
          <p>
            Any dispute arising out of or relating to these terms shall be settled through binding arbitration administered in New York County, New York, in accordance with standard commercial arbitration rules.
          </p>
        </section>

      </article>
    </div>
  </main>

  <!-- ==========================================================================
     PROFESSIONAL FOOTER & MENU WITH ARROW SVGS
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
            <a href="#" aria-label="YouTube"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg></a>
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
              <a href="privacy-policy.html">
                <svg class="devnahian-sportlixa-footer-menu-arrow" viewBox="0 0 24 24" fill="none" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                <span>Privacy Policy</span>
              </a>
            </li>
            <li>
              <a href="terms-of-service.html">
                <svg class="devnahian-sportlixa-footer-menu-arrow" viewBox="0 0 24 24" fill="none" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                <span>Terms of Service</span>
              </a>
            </li>
            <li>
              <a href="cookie-policy.html">
                <svg class="devnahian-sportlixa-footer-menu-arrow" viewBox="0 0 24 24" fill="none" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                <span>Cookie Policy</span>
              </a>
            </li>
            <li>
              <a href="contact-us.html">
                <svg class="devnahian-sportlixa-footer-menu-arrow" viewBox="0 0 24 24" fill="none" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                <span>Contact Us</span>
              </a>
            </li>
            <li>
              <a href="about-us.html">
                <svg class="devnahian-sportlixa-footer-menu-arrow" viewBox="0 0 24 24" fill="none" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                <span>About Us</span>
              </a>
            </li>
          </ul>
        </div>

        <!-- Col 5: Stay Updated -->
        <div>
          <div class="devnahian-sportlixa-footer-col-title">Stay Updated</div>
          <p style="font-size:12px; color:var(--devnahian-sportlixa-text-muted); line-height:1.45;">Get sports highlights &amp; daily updates.</p>
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
        <input type="text" class="devnahian-sportlixa-search-modal-input" id="devnahian-sportlixa-modalSearchInput" placeholder="Search live games, scores, or legal topics...">
      </div>
      <ul class="devnahian-sportlixa-search-results-list" id="devnahian-sportlixa-searchResults">
        <li class="devnahian-sportlixa-search-result-item" onclick="selectSearchResult('terms-of-service.html#intellectual-property')">
          <span>📜 <strong>Editorial IP Rights</strong> — Content &amp; Media Licensing</span>
          <span style="font-size:11px; color:var(--devnahian-sportlixa-brand-volt-text)">TERMS</span>
        </li>
        <li class="devnahian-sportlixa-search-result-item" onclick="selectSearchResult('terms-of-service.html#disclaimers')">
          <span>⚖️ <strong>Wagering Disclaimers</strong> — Sportsbook &amp; Odds Notice</span>
          <span style="font-size:11px; color:var(--devnahian-sportlixa-brand-volt-text)">TERMS</span>
        </li>
        <li class="devnahian-sportlixa-search-result-item" onclick="selectSearchResult('contact-us.html')">
          <span>✉️ <strong>Legal Contact</strong> — Inquiries &amp; Permissions</span>
          <span style="font-size:11px; color:var(--devnahian-sportlixa-brand-volt-text)">LEGAL</span>
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

    // Active Table of Contents Highlighter
    function activateToc(el) {
      document.querySelectorAll('.devnahian-sportlixa-toc-link').forEach(link => link.classList.remove('active'));
      el.classList.add('active');
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