/**
 * SPORTLIXA — Theme Main JavaScript Engine
 * Author: devnahian
 * Version: 1.0.0
 * 
 * Features:
 *  1. Theme Engine (Dark / Light with System Sync & LocalStorage)
 *  2. Mobile Drawer Navigation & Touch Handlers
 *  3. Throttled Reading Progress & Back to Top Controller
 *  4. HUD Toast Notification System
 *  5. Instant Command-K Search Modal & Live Filtering
 *  6. Single Post Tools (Web Share API, Print, LocalStorage Bookmarks)
 *  7. Live Score Center Filtering Engine
 *  8. Fan Pick'em Real-time Voting
 *  9. NFL Standings Division Tab Switcher
 * 10. Category Feed Layout Switcher (Grid vs. List) & Category Filtering
 * 11. Search Page Query Handling, Clear Action & Facet Filters
 * 12. Archive / Season Vault Year, Month & Sport Slicing
 * 13. Dynamic Table of Contents (page.php) & Cookie Preferences Engine
 */

(() => {
  'use strict';

  /* ==========================================================================
     01. THEME ENGINE (DARK / LIGHT)
     ========================================================================== */
  const htmlElement      = document.documentElement;
  const themeToggleBtn   = document.getElementById('devnahian-sportlixa-themeToggleBtn');
  const themeToggleText  = document.getElementById('devnahian-sportlixa-themeToggleText');

  const savedTheme       = localStorage.getItem('devnahian_sportlixa_theme');
  const systemPrefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
  const initialTheme     = savedTheme || (systemPrefersDark ? 'dark' : 'dark'); // Default Dark

  htmlElement.setAttribute('data-theme', initialTheme);
  if (themeToggleText) {
    themeToggleText.textContent = initialTheme === 'dark' ? 'Dark' : 'Light';
  }

  if (themeToggleBtn) {
    themeToggleBtn.addEventListener('click', () => {
      const activeTheme = htmlElement.getAttribute('data-theme');
      const targetTheme = activeTheme === 'dark' ? 'light' : 'dark';

      htmlElement.setAttribute('data-theme', targetTheme);
      if (themeToggleText) {
        themeToggleText.textContent = targetTheme === 'dark' ? 'Dark' : 'Light';
      }
      localStorage.setItem('devnahian_sportlixa_theme', targetTheme);
      window.showToast(`Switched to ${targetTheme.toUpperCase()} mode`);
    });
  }

  /* ==========================================================================
     02. MOBILE DRAWER NAVIGATION
     ========================================================================== */
  const mobileDrawer      = document.getElementById('devnahian-sportlixa-mobileDrawer');
  const drawerOverlay     = document.getElementById('devnahian-sportlixa-drawerOverlay');
  const mobileMenuTrigger = document.getElementById('devnahian-sportlixa-mobileMenuTrigger');
  const drawerCloseBtn    = document.getElementById('devnahian-sportlixa-drawerCloseBtn');
  const mobileMenuTab     = document.getElementById('devnahian-sportlixa-mobileMenuTab');

  function openMobileDrawer() {
    if (!mobileDrawer || !drawerOverlay) return;
    mobileDrawer.classList.add('active', 'is-active');
    drawerOverlay.classList.add('active', 'is-active');
    document.body.style.overflow = 'hidden';
  }

  function closeMobileDrawer() {
    if (!mobileDrawer || !drawerOverlay) return;
    mobileDrawer.classList.remove('active', 'is-active');
    drawerOverlay.classList.remove('active', 'is-active');
    document.body.style.overflow = '';
  }

  if (mobileMenuTrigger) mobileMenuTrigger.addEventListener('click', openMobileDrawer);
  if (drawerCloseBtn) drawerCloseBtn.addEventListener('click', closeMobileDrawer);
  if (drawerOverlay) drawerOverlay.addEventListener('click', closeMobileDrawer);
  if (mobileMenuTab) mobileMenuTab.addEventListener('click', openMobileDrawer);

  /* ==========================================================================
     03. READING PROGRESS BAR & BACK TO TOP (FRAME THROTTLED)
     ========================================================================== */
  const progressLine = document.getElementById('devnahian-sportlixa-progressLine');
  const backToTopBtn = document.getElementById('devnahian-sportlixa-backToTop');
  let isScrollTicking = false;

  window.addEventListener('scroll', () => {
    if (!isScrollTicking) {
      window.requestAnimationFrame(() => {
        const winScroll    = window.scrollY || document.documentElement.scrollTop;
        const totalHeight  = document.documentElement.scrollHeight - document.documentElement.clientHeight;

        if (progressLine && totalHeight > 0) {
          const scrolledPercent = (winScroll / totalHeight) * 100;
          progressLine.style.width = `${Math.min(100, Math.max(0, scrolledPercent))}%`;
        }

        if (backToTopBtn) {
          if (winScroll > 320) {
            backToTopBtn.classList.add('active', 'is-visible');
          } else {
            backToTopBtn.classList.remove('active', 'is-visible');
          }
        }
        isScrollTicking = false;
      });
      isScrollTicking = true;
    }
  }, { passive: true });

  if (backToTopBtn) {
    backToTopBtn.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  /* ==========================================================================
     04. HUD TOAST NOTIFICATION SYSTEM
     ========================================================================== */
  const toastElem = document.getElementById('devnahian-sportlixa-toast');
  const toastMsg  = document.getElementById('devnahian-sportlixa-toast-msg');
  let toastTimer  = null;

  window.showToast = function(message) {
    if (!toastElem) return;
    if (toastMsg) toastMsg.textContent = message;

    toastElem.classList.add('active', 'is-active');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => {
      toastElem.classList.remove('active', 'is-active');
    }, 2800);
  };

  /* ==========================================================================
     05. INSTANT SEARCH MODAL (CMD + K & LIVE FILTER)
     ========================================================================== */
  const searchModalBackdrop = document.getElementById('devnahian-sportlixa-searchModalBackdrop');
  const searchLauncher      = document.getElementById('devnahian-sportlixa-searchLauncher');
  const modalSearchInput    = document.getElementById('devnahian-sportlixa-modalSearchInput');
  const searchResultsList   = document.getElementById('devnahian-sportlixa-searchResults');
  const modalCloseBtn       = document.getElementById('devnahian-sportlixa-modalCloseBtn');

  function openSearchModal() {
    if (!searchModalBackdrop) return;
    searchModalBackdrop.classList.add('active', 'is-active');
    searchModalBackdrop.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
    if (modalSearchInput) {
      setTimeout(() => modalSearchInput.focus(), 80);
    }
  }

  function closeSearchModal() {
    if (!searchModalBackdrop) return;
    searchModalBackdrop.classList.remove('active', 'is-active');
    searchModalBackdrop.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
    if (modalSearchInput) modalSearchInput.value = '';

    if (searchResultsList) {
      searchResultsList.querySelectorAll('.devnahian-sportlixa-search-result-item').forEach(item => {
        item.style.display = 'flex';
      });
    }
  }

  if (searchLauncher) searchLauncher.addEventListener('click', openSearchModal);
  if (modalCloseBtn) modalCloseBtn.addEventListener('click', closeSearchModal);

  if (searchModalBackdrop) {
    searchModalBackdrop.addEventListener('click', (e) => {
      if (e.target === searchModalBackdrop) closeSearchModal();
    });
  }

  // Live in-modal search input
  if (modalSearchInput && searchResultsList) {
    modalSearchInput.addEventListener('input', (e) => {
      const term  = e.target.value.toLowerCase().trim();
      const items = searchResultsList.querySelectorAll('.devnahian-sportlixa-search-result-item');

      items.forEach(item => {
        const text = item.textContent.toLowerCase();
        item.style.display = text.includes(term) ? 'flex' : 'none';
      });
    });
  }

  // Global Keyboard Shortcuts
  window.addEventListener('keydown', (e) => {
    if ((e.metaKey || e.ctrlKey) && e.key.toLowerCase() === 'k') {
      e.preventDefault();
      if (searchModalBackdrop && (searchModalBackdrop.classList.contains('active') || searchModalBackdrop.classList.contains('is-active'))) {
        closeSearchModal();
      } else {
        openSearchModal();
      }
    }

    if (e.key === 'Escape') {
      if (searchModalBackdrop && (searchModalBackdrop.classList.contains('active') || searchModalBackdrop.classList.contains('is-active'))) {
        closeSearchModal();
      }
      if (mobileDrawer && (mobileDrawer.classList.contains('active') || mobileDrawer.classList.contains('is-active'))) {
        closeMobileDrawer();
      }
    }
  });

  window.selectSearchResult = function(target) {
    closeSearchModal();
    if (!target) return;

    if (target.startsWith('#')) {
      try {
        const el = document.querySelector(target);
        if (el) {
          el.scrollIntoView({ behavior: 'smooth' });
          return;
        }
      } catch (err) {
        console.warn('Selector error:', err);
      }
    }
    window.location.href = target;
  };

  /* ==========================================================================
     06. SINGLE POST TOOLS (SHARE & BOOKMARK SYSTEM)
     ========================================================================== */
  window.shareArticle = function(title) {
    const shareUrl = window.location.href;
    const shareTitle = title || document.title;

    if (navigator.share) {
      navigator.share({
        title: shareTitle,
        url: shareUrl
      }).catch(() => {});
    } else if (navigator.clipboard) {
      navigator.clipboard.writeText(shareUrl).then(() => {
        window.showToast('Article URL copied to clipboard!');
      }).catch(() => {
        window.showToast('Press Ctrl+C to copy link');
      });
    } else {
      window.showToast('Sharing not supported on this browser');
    }
  };

  window.togglePostBookmark = function(button) {
    const postTitle = document.title;
    const postUrl   = window.location.href;
    let bookmarks   = [];

    try {
      bookmarks = JSON.parse(localStorage.getItem('devnahian_sportlixa_bookmarks') || '[]');
    } catch (e) {
      bookmarks = [];
    }

    const index = bookmarks.findIndex(item => item.url === postUrl);

    if (index > -1) {
      bookmarks.splice(index, 1);
      if (button) button.classList.remove('active', 'is-bookmarked');
      window.showToast('Removed from Bookmarks');
    } else {
      bookmarks.push({ title: postTitle, url: postUrl, date: new Date().toISOString() });
      if (button) button.classList.add('active', 'is-bookmarked');
      window.showToast('Saved to My Playbook!');
    }

    localStorage.setItem('devnahian_sportlixa_bookmarks', JSON.stringify(bookmarks));
  };

  window.bookmarkArticle = window.togglePostBookmark;

  // Restore single post bookmark button state on load
  const bookmarkBtn = document.getElementById('devnahian-sportlixa-btnBookmarkPost');
  if (bookmarkBtn) {
    try {
      const savedBookmarks = JSON.parse(localStorage.getItem('devnahian_sportlixa_bookmarks') || '[]');
      if (savedBookmarks.some(item => item.url === window.location.href)) {
        bookmarkBtn.classList.add('active', 'is-bookmarked');
      }
    } catch (e) {}
  }

  /* ==========================================================================
     07. LIVE SCORES FILTERING
     ========================================================================== */
  window.filterLiveScores = function(sport, button) {
    const pills = document.querySelectorAll('.devnahian-sportlixa-filter-pill');
    pills.forEach(pill => pill.classList.remove('active'));
    if (button) button.classList.add('active');

    const cards = document.querySelectorAll('.devnahian-sportlixa-score-card');
    cards.forEach(card => {
      const cardSport = (card.dataset.sport || '').toLowerCase();
      if (sport === 'all' || cardSport === sport.toLowerCase()) {
        card.style.display = 'flex';
      } else {
        card.style.display = 'none';
      }
    });
  };

  /* ==========================================================================
     08. MARQUEE FAN PICK'EM VOTING
     ========================================================================== */
  window.castMatchupPick = function(button, team) {
    if (!button) return;
    const parentRow = button.closest('.devnahian-sportlixa-pick-row');
    if (parentRow) {
      parentRow.querySelectorAll('.devnahian-sportlixa-btn-pick').forEach(btn => {
        btn.classList.remove('picked', 'active');
      });
    }
    button.classList.add('picked', 'active');
    window.showToast(`Pick registered for ${team}!`);
  };

  /* ==========================================================================
     09. NFL STANDINGS TAB ENGINE
     ========================================================================== */
  const tabAfcBtn           = document.getElementById('devnahian-sportlixa-tabAfcBtn');
  const tabNfcBtn           = document.getElementById('devnahian-sportlixa-tabNfcBtn');
  const standingsTableBody  = document.getElementById('devnahian-sportlixa-standingsTableBody');

  const afcData = `
    <tr>
      <td class="devnahian-sportlixa-team-cell"><span class="devnahian-sportlixa-rank-dot">1</span> Kansas City Chiefs</td>
      <td>4</td><td>0</td><td>1.000</td><td>2-0</td><td class="devnahian-sportlixa-streak-green">4W</td>
    </tr>
    <tr>
      <td class="devnahian-sportlixa-team-cell"><span class="devnahian-sportlixa-rank-dot">2</span> Buffalo Bills</td>
      <td>3</td><td>1</td><td>.750</td><td>1-0</td><td>1W</td>
    </tr>
    <tr>
      <td class="devnahian-sportlixa-team-cell"><span class="devnahian-sportlixa-rank-dot">3</span> Baltimore Ravens</td>
      <td>3</td><td>1</td><td>.750</td><td>2-0</td><td class="devnahian-sportlixa-streak-green">2W</td>
    </tr>
    <tr>
      <td class="devnahian-sportlixa-team-cell"><span class="devnahian-sportlixa-rank-dot">4</span> Jacksonville Jaguars</td>
      <td>3</td><td>1</td><td>.750</td><td>1-1</td><td class="devnahian-sportlixa-streak-green">2W</td>
    </tr>
    <tr>
      <td class="devnahian-sportlixa-team-cell"><span class="devnahian-sportlixa-rank-dot">5</span> Las Vegas Raiders</td>
      <td>3</td><td>1</td><td>.750</td><td>1-1</td><td>1L</td>
    </tr>
  `;

  const nfcData = `
    <tr>
      <td class="devnahian-sportlixa-team-cell"><span class="devnahian-sportlixa-rank-dot">1</span> Minnesota Vikings</td>
      <td>4</td><td>0</td><td>1.000</td><td>2-0</td><td class="devnahian-sportlixa-streak-green">4W</td>
    </tr>
    <tr>
      <td class="devnahian-sportlixa-team-cell"><span class="devnahian-sportlixa-rank-dot">2</span> San Francisco 49ers</td>
      <td>4</td><td>0</td><td>1.000</td><td>2-0</td><td class="devnahian-sportlixa-streak-green">4W</td>
    </tr>
    <tr>
      <td class="devnahian-sportlixa-team-cell"><span class="devnahian-sportlixa-rank-dot">3</span> Seattle Seahawks</td>
      <td>3</td><td>1</td><td>.750</td><td>1-0</td><td class="devnahian-sportlixa-streak-green">1W</td>
    </tr>
    <tr>
      <td class="devnahian-sportlixa-team-cell"><span class="devnahian-sportlixa-rank-dot">4</span> Chicago Bears</td>
      <td>3</td><td>1</td><td>.750</td><td>1-1</td><td class="devnahian-sportlixa-streak-green">2W</td>
    </tr>
    <tr>
      <td class="devnahian-sportlixa-team-cell"><span class="devnahian-sportlixa-rank-dot">5</span> Dallas Cowboys</td>
      <td>2</td><td>2</td><td>.500</td><td>1-0</td><td>1W</td>
    </tr>
  `;

  if (tabAfcBtn && tabNfcBtn && standingsTableBody) {
    tabAfcBtn.addEventListener('click', () => {
      tabAfcBtn.classList.add('active');
      tabNfcBtn.classList.remove('active');
      standingsTableBody.innerHTML = afcData;
    });

    tabNfcBtn.addEventListener('click', () => {
      tabNfcBtn.classList.add('active');
      tabAfcBtn.classList.remove('active');
      standingsTableBody.innerHTML = nfcData;
    });
  }

  /* ==========================================================================
     10. CATEGORY FEED (GRID / LIST VIEW TOGGLE & TAB FILTERING)
     ========================================================================== */
  const articleFeedContainer = document.getElementById('devnahian-sportlixa-articleFeed');
  const btnGridView          = document.getElementById('devnahian-sportlixa-btnGridView');
  const btnListView          = document.getElementById('devnahian-sportlixa-btnListView');

  window.toggleFeedLayout = function(mode) {
    if (!articleFeedContainer) return;

    if (mode === 'list') {
      articleFeedContainer.classList.add('is-list-view');
      btnListView?.classList.add('active');
      btnGridView?.classList.remove('active');
      localStorage.setItem('devnahian_sportlixa_feed_layout', 'list');
    } else {
      articleFeedContainer.classList.remove('is-list-view');
      btnGridView?.classList.add('active');
      btnListView?.classList.remove('active');
      localStorage.setItem('devnahian_sportlixa_feed_layout', 'grid');
    }
  };

  const savedFeedLayout = localStorage.getItem('devnahian_sportlixa_feed_layout');
  if (savedFeedLayout === 'list') {
    window.toggleFeedLayout('list');
  }

  window.filterCategoryFeed = function(tag, button) {
    const buttons = document.querySelectorAll('.devnahian-sportlixa-feed-tag-btn, .devnahian-sportlixa-subnav-btn');
    buttons.forEach(btn => btn.classList.remove('active'));
    if (button) button.classList.add('active');

    const cards = document.querySelectorAll('#devnahian-sportlixa-articleFeed .devnahian-sportlixa-article-card');
    let matchedCount = 0;

    cards.forEach(card => {
      const cardCategory = (card.dataset.category || '').toLowerCase();
      if (tag === 'all' || cardCategory.includes(tag.toLowerCase())) {
        card.style.display = 'flex';
        matchedCount++;
      } else {
        card.style.display = 'none';
      }
    });

    window.showToast(`Showing ${matchedCount} article(s)`);
  };

  window.switchCategoryTab = window.filterCategoryFeed;

  window.loadMoreArticles = function() {
    window.showToast('Fetching latest game dispatches...');
    // Allows standard pagination or AJAX load scripts to hook in
  };

  /* ==========================================================================
     11. SEARCH PAGE ENGINE (FACETS, CLEAR & SIDEBAR FILTERS)
     ========================================================================== */
  const pageSearchInput  = document.getElementById('devnahian-sportlixa-pageSearchInput');
  const queryBreadcrumb  = document.getElementById('devnahian-sportlixa-queryBreadcrumb');

  window.executePageSearch = function() {
    if (!pageSearchInput) return;
    const query = pageSearchInput.value.trim();
    if (!query) return;

    if (queryBreadcrumb) queryBreadcrumb.textContent = `"${query}"`;
    window.location.href = `${window.location.origin}/?s=${encodeURIComponent(query)}`;
  };

  window.clearSearchInput = function() {
    if (!pageSearchInput) return;
    pageSearchInput.value = '';
    pageSearchInput.focus();
  };

  window.quickFillSearch = function(term) {
    if (!pageSearchInput) return;
    pageSearchInput.value = term;
    window.executePageSearch();
  };

  window.switchSearchFacet = function(facet, button) {
    const tabs = document.querySelectorAll('.devnahian-sportlixa-facet-tab');
    tabs.forEach(t => t.classList.remove('active'));
    if (button) button.classList.add('active');

    const items = document.querySelectorAll('#devnahian-sportlixa-resultsFeed > *');
    let facetCount = 0;

    items.forEach(item => {
      const itemFacet = (item.dataset.facet || 'articles').toLowerCase();
      if (facet === 'all' || itemFacet === facet.toLowerCase()) {
        item.style.display = 'flex';
        facetCount++;
      } else {
        item.style.display = 'none';
      }
    });

    window.showToast(`Displaying ${facetCount} item(s)`);
  };

  window.toggleSidebarOption = function(element) {
    if (!element) return;
    const parentList = element.closest('.devnahian-sportlixa-filter-list');
    if (parentList) {
      parentList.querySelectorAll('.devnahian-sportlixa-filter-option').forEach(opt => {
        opt.classList.remove('selected');
      });
    }
    element.classList.add('selected');
    const label = element.querySelector('span')?.textContent || 'Option';
    window.showToast(`Applied filter: ${label}`);
  };

  window.resetSidebarFilters = function() {
    document.querySelectorAll('.devnahian-sportlixa-filter-list').forEach(list => {
      const options = list.querySelectorAll('.devnahian-sportlixa-filter-option');
      options.forEach(opt => opt.classList.remove('selected'));
      if (options[0]) options[0].classList.add('selected');
    });
    window.showToast('Filters reset to default');
  };

  /* ==========================================================================
     12. ARCHIVE / SEASON VAULT CHRONOLOGY SLICERS
     ========================================================================== */
  window.switchArchiveYear = function(year, button) {
    const chips = document.querySelectorAll('.devnahian-sportlixa-year-chip');
    chips.forEach(chip => {
      chip.classList.remove('active');
      chip.setAttribute('aria-selected', 'false');
    });

    if (button) {
      button.classList.add('active');
      button.setAttribute('aria-selected', 'true');
    }

    window.showToast(`Vault: Viewing ${year} Season Records`);
  };

  window.filterArchiveMonth = function(month, button) {
    const pills = document.querySelectorAll('.devnahian-sportlixa-archive-months .devnahian-sportlixa-filter-pill-btn');
    pills.forEach(p => p.classList.remove('active'));
    if (button) button.classList.add('active');

    const timelineGroups = document.querySelectorAll('#devnahian-sportlixa-timelineRoot .devnahian-sportlixa-timeline-group');
    let visibleGroups = 0;

    timelineGroups.forEach(group => {
      const groupMonth = (group.dataset.month || '').toLowerCase();
      if (month === 'all' || groupMonth === month.toLowerCase()) {
        group.style.display = 'block';
        visibleGroups++;
      } else {
        group.style.display = 'none';
      }
    });

    window.showToast(`Showing ${visibleGroups} timeline group(s)`);
  };

  window.filterArchiveSport = function(sport, button) {
    const pills = document.querySelectorAll('.devnahian-sportlixa-archive-sports .devnahian-sportlixa-filter-pill-btn');
    pills.forEach(p => p.classList.remove('active'));
    if (button) button.classList.add('active');

    const cards = document.querySelectorAll('#devnahian-sportlixa-timelineRoot .devnahian-sportlixa-archive-card');
    let matchedArticles = 0;

    cards.forEach(card => {
      const cardSport = (card.dataset.sport || '').toLowerCase();
      if (sport === 'all' || cardSport === sport.toLowerCase()) {
        card.style.display = 'flex';
        matchedArticles++;
      } else {
        card.style.display = 'none';
      }
    });

    window.showToast(`Showing ${matchedArticles} record(s)`);
  };

  /* ==========================================================================
     13. DYNAMIC TOC (page.php) & COOKIE POLICY INTERACTION
     ========================================================================== */
  const pageContentArea = document.getElementById('devnahian-sportlixa-pageContent');
  const tocList         = document.getElementById('devnahian-sportlixa-tocList');
  const tocCard         = document.getElementById('devnahian-sportlixa-tocCard');

  if (pageContentArea && tocList) {
    const headings = pageContentArea.querySelectorAll('h2');

    if (headings.length > 1) {
      headings.forEach((heading, idx) => {
        let headingId = heading.getAttribute('id');
        if (!headingId) {
          headingId = `section-${idx + 1}-${heading.textContent.trim().toLowerCase().replace(/[^a-z0-9]+/g, '-')}`;
          heading.setAttribute('id', headingId);
        }

        const li = document.createElement('li');
        const a  = document.createElement('a');
        a.href      = `#${headingId}`;
        a.className = `devnahian-sportlixa-toc-link${idx === 0 ? ' active' : ''}`;
        a.textContent = `${idx + 1}. ${heading.textContent.trim()}`;

        a.addEventListener('click', () => {
          document.querySelectorAll('.devnahian-sportlixa-toc-link').forEach(link => link.classList.remove('active'));
          a.classList.add('active');
        });

        li.appendChild(a);
        tocList.appendChild(li);
      });
    } else if (tocCard) {
      const legalGrid = document.querySelector('.devnahian-sportlixa-legal-grid');
      if (legalGrid) legalGrid.classList.add('no-sidebar');
      tocCard.style.display = 'none';
    }
  }

  window.activateToc = function(el) {
    document.querySelectorAll('.devnahian-sportlixa-toc-link').forEach(link => link.classList.remove('active'));
    if (el) el.classList.add('active');
  };

  // Cookie policy preferences storage
  window.saveCookiePreferences = function() {
    const analytics  = document.getElementById('devnahian-sportlixa-prefAnalytics')?.checked ?? true;
    const functional = document.getElementById('devnahian-sportlixa-prefFunctional')?.checked ?? true;

    localStorage.setItem('devnahian_sportlixa_cookie_prefs', JSON.stringify({
      analytics,
      functional,
      updated: new Date().toISOString()
    }));

    window.showToast('Cookie preferences updated & saved!');
  };

  // Restore saved cookie toggle state on load
  const savedCookiePrefs = localStorage.getItem('devnahian_sportlixa_cookie_prefs');
  if (savedCookiePrefs) {
    try {
      const parsed = JSON.parse(savedCookiePrefs);
      const prefAnalytics = document.getElementById('devnahian-sportlixa-prefAnalytics');
      const prefFunctional = document.getElementById('devnahian-sportlixa-prefFunctional');

      if (prefAnalytics && parsed.analytics !== undefined) prefAnalytics.checked = parsed.analytics;
      if (prefFunctional && parsed.functional !== undefined) prefFunctional.checked = parsed.functional;
    } catch (e) {}
  }

  // Newsletter subscribe form feedback
  const newsletterForm = document.getElementById('devnahian-sportlixa-newsletter-form');
  if (newsletterForm) {
    newsletterForm.addEventListener('submit', (e) => {
      e.preventDefault();
      newsletterForm.reset();
      window.showToast('Subscribed to SportLixa updates!');
    });
  }

})();