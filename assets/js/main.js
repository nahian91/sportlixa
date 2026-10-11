(() => {
  'use strict';

  /* ==========================================================================
     1. THEME ENGINE (DARK / LIGHT WITH SYSTEM PERSISTENCE)
     ========================================================================== */
  const themeToggleBtn = document.getElementById('devnahian-sportlixa-themeToggleBtn');
  const themeToggleText = document.getElementById('devnahian-sportlixa-themeToggleText');
  const htmlElement = document.documentElement;

  // Initialize theme from localStorage or system preference
  const savedTheme = localStorage.getItem('devnahian_sportlixa_theme');
  const systemPrefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
  const initialTheme = savedTheme || (systemPrefersDark ? 'dark' : 'dark'); // Default dark
  
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
      showToast(`Switched to ${targetTheme.toUpperCase()} theme`);
    });
  }

  /* ==========================================================================
     2. MOBILE DRAWER NAVIGATION
     ========================================================================== */
  const mobileDrawer = document.getElementById('devnahian-sportlixa-mobileDrawer');
  const drawerOverlay = document.getElementById('devnahian-sportlixa-drawerOverlay');
  const mobileMenuTrigger = document.getElementById('devnahian-sportlixa-mobileMenuTrigger');
  const drawerCloseBtn = document.getElementById('devnahian-sportlixa-drawerCloseBtn');
  const mobileMenuTab = document.getElementById('devnahian-sportlixa-mobileMenuTab');

  function openMobileDrawer() {
    if (!mobileDrawer || !drawerOverlay) return;
    mobileDrawer.classList.add('active');
    drawerOverlay.classList.add('active');
    document.body.style.overflow = 'hidden';
  }

  function closeMobileDrawer() {
    if (!mobileDrawer || !drawerOverlay) return;
    mobileDrawer.classList.remove('active');
    drawerOverlay.classList.remove('active');
    document.body.style.overflow = '';
  }

  if (mobileMenuTrigger) mobileMenuTrigger.addEventListener('click', openMobileDrawer);
  if (drawerCloseBtn) drawerCloseBtn.addEventListener('click', closeMobileDrawer);
  if (drawerOverlay) drawerOverlay.addEventListener('click', closeMobileDrawer);
  if (mobileMenuTab) mobileMenuTab.addEventListener('click', openMobileDrawer);

  /* ==========================================================================
     3. READING PROGRESS & SMOOTH BACK TO TOP (FRAME-THROTTLED)
     ========================================================================== */
  const progressLine = document.getElementById('devnahian-sportlixa-progressLine');
  const backToTopBtn = document.getElementById('devnahian-sportlixa-backToTop');
  let isTicking = false;

  window.addEventListener('scroll', () => {
    if (!isTicking) {
      window.requestAnimationFrame(() => {
        const winScroll = document.documentElement.scrollTop || document.body.scrollTop;
        const totalHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        
        if (progressLine && totalHeight > 0) {
          const scrolledPercent = (winScroll / totalHeight) * 100;
          progressLine.style.width = `${Math.min(100, Math.max(0, scrolledPercent))}%`;
        }

        if (backToTopBtn) {
          if (winScroll > 320) {
            backToTopBtn.classList.add('active');
          } else {
            backToTopBtn.classList.remove('active');
          }
        }
        isTicking = false;
      });
      isTicking = true;
    }
  }, { passive: true });

  if (backToTopBtn) {
    backToTopBtn.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  /* ==========================================================================
     4. HUD TOAST NOTIFICATION SYSTEM
     ========================================================================== */
  const toastElem = document.getElementById('devnahian-sportlixa-toast');
  const toastMsg = document.getElementById('devnahian-sportlixa-toast-msg');
  let toastTimer = null;

  window.showToast = function(message) {
    if (!toastElem) return;
    if (toastMsg) toastMsg.textContent = message;
    
    toastElem.classList.add('active');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => {
      toastElem.classList.remove('active');
    }, 2600);
  };

  /* ==========================================================================
     5. INSTANT SEARCH MODAL (CMD + K & REAL-TIME FILTERING)
     ========================================================================== */
  const searchModalBackdrop = document.getElementById('devnahian-sportlixa-searchModalBackdrop');
  const searchLauncher = document.getElementById('devnahian-sportlixa-searchLauncher');
  const modalSearchInput = document.getElementById('devnahian-sportlixa-modalSearchInput');
  const searchResultsList = document.getElementById('devnahian-sportlixa-searchResults');

  function openSearchModal() {
    if (!searchModalBackdrop) return;
    searchModalBackdrop.classList.add('active');
    document.body.style.overflow = 'hidden';
    if (modalSearchInput) {
      setTimeout(() => modalSearchInput.focus(), 80);
    }
  }

  function closeSearchModal() {
    if (!searchModalBackdrop) return;
    searchModalBackdrop.classList.remove('active');
    document.body.style.overflow = '';
    if (modalSearchInput) modalSearchInput.value = '';
    
    // Reset any filtered items
    if (searchResultsList) {
      searchResultsList.querySelectorAll('.devnahian-sportlixa-search-result-item').forEach(item => {
        item.style.display = 'flex';
      });
    }
  }

  if (searchLauncher) {
    searchLauncher.addEventListener('click', openSearchModal);
  }

  if (searchModalBackdrop) {
    searchModalBackdrop.addEventListener('click', (e) => {
      if (e.target === searchModalBackdrop) closeSearchModal();
    });
  }

  // Live filter results inside the modal
  if (modalSearchInput && searchResultsList) {
    modalSearchInput.addEventListener('input', (e) => {
      const term = e.target.value.toLowerCase().trim();
      const items = searchResultsList.querySelectorAll('.devnahian-sportlixa-search-result-item');
      
      items.forEach(item => {
        const text = item.textContent.toLowerCase();
        item.style.display = text.includes(term) ? 'flex' : 'none';
      });
    });
  }

  // Global Keyboard Shortcuts
  window.addEventListener('keydown', (e) => {
    // Open modal via / or Cmd/Ctrl + K
    if ((e.metaKey || e.ctrlKey) && e.key.toLowerCase() === 'k') {
      e.preventDefault();
      if (searchModalBackdrop && searchModalBackdrop.classList.contains('active')) {
        closeSearchModal();
      } else {
        openSearchModal();
      }
    }
    // Close on Escape
    if (e.key === 'Escape') {
      if (searchModalBackdrop && searchModalBackdrop.classList.contains('active')) {
        closeSearchModal();
      }
      if (mobileDrawer && mobileDrawer.classList.contains('active')) {
        closeMobileDrawer();
      }
    }
  });

  // Safe Search Result Navigation (Supports hash anchors AND page links)
  window.selectSearchResult = function(target) {
    closeSearchModal();
    if (!target) return;

    if (target.startsWith('#')) {
      try {
        const element = document.querySelector(target);
        if (element) {
          element.scrollIntoView({ behavior: 'smooth' });
          return;
        }
      } catch (err) {
        console.warn('Selector error:', err);
      }
    }
    // Fallback or external link redirect
    window.location.href = target;
  };

  /* ==========================================================================
     6. LIVE SCORES FILTERING
     ========================================================================== */
  window.filterLiveScores = function(sport, button) {
    const pills = document.querySelectorAll('.devnahian-sportlixa-filter-pill');
    pills.forEach(pill => pill.classList.remove('active'));
    if (button) button.classList.add('active');

    const cards = document.querySelectorAll('.devnahian-sportlixa-score-card');
    cards.forEach(card => {
      if (sport === 'all' || card.dataset.sport === sport) {
        card.classList.remove('hidden');
      } else {
        card.classList.add('hidden');
      }
    });
  };

  /* ==========================================================================
     7. MARQUEE FAN PICK'EM VOTING
     ========================================================================== */
  window.castMatchupPick = function(button, team) {
    if (!button) return;
    const parentRow = button.closest('.devnahian-sportlixa-pick-row');
    if (parentRow) {
      parentRow.querySelectorAll('.devnahian-sportlixa-btn-pick').forEach(btn => {
        btn.classList.remove('picked');
      });
    }
    button.classList.add('picked');
    showToast(`Pick registered for ${team}!`);
  };

  /* ==========================================================================
     8. NFL STANDINGS TAB ENGINE (DEFENSIVE NULL CHECK)
     ========================================================================== */
  const tabAfcBtn = document.getElementById('devnahian-sportlixa-tabAfcBtn');
  const tabNfcBtn = document.getElementById('devnahian-sportlixa-tabNfcBtn');
  const standingsTableBody = document.getElementById('devnahian-sportlixa-standingsTableBody');

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

})();