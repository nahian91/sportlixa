<?php
/**
 * Template Name: Predictions Hub
 * Description: Displays upcoming matchups, win probabilities, and consensus voting from ESPN API.
 *
 * @package Sportlixa
 */

get_header();

$predictions_data = function_exists( 'sportlixa_get_espn_predictions' ) ? sportlixa_get_espn_predictions() : [];

$league_counts = [
    'all' => count( $predictions_data ),
    'nfl' => 0,
    'nba' => 0,
    'mlb' => 0,
    'nhl' => 0,
];

foreach ( $predictions_data as $p ) {
    $sp = strtolower( $p['sport'] );
    if ( isset( $league_counts[ $sp ] ) ) {
        $league_counts[ $sp ]++;
    }
}
?>

<main class="devnahian-sportlixa-container sportlixa-predictions-page">

  <!-- Header -->
  <header class="sportlixa-pred-header">
    <div class="sportlixa-pred-badge">
      <span class="pulse-indicator"></span>
      <?php esc_html_e( 'ESPN ANALYTICS & MARKET ODDS', 'sportlixa' ); ?>
    </div>
    <h1 class="sportlixa-pred-title"><?php esc_html_e( 'GAME DAY PREDICTIONS & CONSENSUS PICKS', 'sportlixa' ); ?></h1>
    <p class="sportlixa-pred-subtext">
      <?php esc_html_e( 'Automated win projections, current Vegas lines, and real-time community pick consensus.', 'sportlixa' ); ?>
    </p>

    <!-- Filter Pills -->
    <div class="sportlixa-pred-pills-row">
      <button type="button" class="sportlixa-pred-pill active" onclick="filterPredictions('all', this)">
        ALL (<?php echo esc_html( $league_counts['all'] ); ?>)
      </button>
      <button type="button" class="sportlixa-pred-pill" onclick="filterPredictions('nfl', this)">
        NFL (<?php echo esc_html( $league_counts['nfl'] ); ?>)
      </button>
      <button type="button" class="sportlixa-pred-pill" onclick="filterPredictions('nba', this)">
        NBA (<?php echo esc_html( $league_counts['nba'] ); ?>)
      </button>
      <button type="button" class="sportlixa-pred-pill" onclick="filterPredictions('mlb', this)">
        MLB (<?php echo esc_html( $league_counts['mlb'] ); ?>)
      </button>
      <button type="button" class="sportlixa-pred-pill" onclick="filterPredictions('nhl', this)">
        NHL (<?php echo esc_html( $league_counts['nhl'] ); ?>)
      </button>
    </div>
  </header>

  <!-- Prediction Grid -->
  <section class="sportlixa-pred-grid" id="predictionsGrid">
    <?php if ( ! empty( $predictions_data ) ) : ?>
      <?php foreach ( $predictions_data as $game ) : 
          $game_id   = esc_attr( $game['id'] );
          $sport     = esc_attr( $game['sport'] );
          $home      = $game['home'];
          $away      = $game['away'];
      ?>
        <article class="sportlixa-pred-card" data-sport="<?php echo $sport; ?>" id="game-card-<?php echo $game_id; ?>">
          
          <div class="pred-card-top">
            <span class="pred-sport-tag"><?php echo strtoupper( $sport ); ?></span>
            <span class="pred-schedule-time"><?php echo esc_html( $game['game_date'] ); ?> • <?php echo esc_html( $game['broadcast'] ); ?></span>
          </div>

          <!-- Teams Board -->
          <div class="pred-teams-board">
            
            <!-- Away Team -->
            <div class="pred-team-col">
              <div class="pred-logo-wrap">
                <?php if ( ! empty( $away['logo'] ) ) : ?>
                  <img src="<?php echo esc_url( $away['logo'] ); ?>" alt="<?php echo esc_attr( $away['code'] ); ?>" loading="lazy" />
                <?php else : ?>
                  <span class="pred-fallback-code"><?php echo esc_html( $away['code'] ); ?></span>
                <?php endif; ?>
              </div>
              <h3 class="pred-team-name"><?php echo esc_html( $away['name'] ); ?></h3>
              <?php if ( ! empty( $away['record'] ) ) : ?>
                <span class="pred-team-rec"><?php echo esc_html( $away['record'] ); ?></span>
              <?php endif; ?>
            </div>

            <div class="pred-vs-circle">VS</div>

            <!-- Home Team -->
            <div class="pred-team-col">
              <div class="pred-logo-wrap">
                <?php if ( ! empty( $home['logo'] ) ) : ?>
                  <img src="<?php echo esc_url( $home['logo'] ); ?>" alt="<?php echo esc_attr( $home['code'] ); ?>" loading="lazy" />
                <?php else : ?>
                  <span class="pred-fallback-code"><?php echo esc_html( $home['code'] ); ?></span>
                <?php endif; ?>
              </div>
              <h3 class="pred-team-name"><?php echo esc_html( $home['name'] ); ?></h3>
              <?php if ( ! empty( $home['record'] ) ) : ?>
                <span class="pred-team-rec"><?php echo esc_html( $home['record'] ); ?></span>
              <?php endif; ?>
            </div>

          </div>

          <!-- Win Probability Bar (From ESPN Model) -->
          <div class="pred-win-meter-wrap">
            <div class="pred-win-labels">
              <span><?php echo esc_html( $away['code'] ); ?> <?php echo esc_html( $away['win_pct'] ); ?>%</span>
              <span class="meter-title"><?php esc_html_e( 'Win Predictor', 'sportlixa' ); ?></span>
              <span><?php echo esc_html( $home['win_pct'] ); ?>% <?php echo esc_html( $home['code'] ); ?></span>
            </div>
            <div class="pred-meter-bar">
              <div class="pred-meter-away" style="width: <?php echo esc_attr( $away['win_pct'] ); ?>%;"></div>
              <div class="pred-meter-home" style="width: <?php echo esc_attr( $home['win_pct'] ); ?>%;"></div>
            </div>
          </div>

          <!-- Vegas Lines -->
          <div class="pred-odds-strip">
            <span>Spread: <strong><?php echo esc_html( $game['spread'] ); ?></strong></span>
            <span>Total: <strong><?php echo esc_html( $game['over_under'] ); ?></strong></span>
          </div>

          <!-- Interactive User Pick Buttons -->
          <div class="pred-pick-actions">
            <button 
              type="button" 
              class="pred-btn-pick" 
              data-game="<?php echo $game_id; ?>" 
              data-pick="away"
              onclick="castGameVote('<?php echo $game_id; ?>', 'away', this)"
            >
              Pick <?php echo esc_html( $away['code'] ); ?>
            </button>
            <button 
              type="button" 
              class="pred-btn-pick" 
              data-game="<?php echo $game_id; ?>" 
              data-pick="home"
              onclick="castGameVote('<?php echo $game_id; ?>', 'home', this)"
            >
              Pick <?php echo esc_html( $home['code'] ); ?>
            </button>
          </div>

        </article>
      <?php endforeach; ?>
    <?php else : ?>
      <p style="color:#8c9ba5; padding: 40px 0; text-align:center; grid-column: 1/-1;">
        <?php esc_html_e( 'No upcoming matchups available for projection at this time.', 'sportlixa' ); ?>
      </p>
    <?php endif; ?>
  </section>

</main>

<style>
  .sportlixa-predictions-page { padding-top: 36px; padding-bottom: 70px; }
  .sportlixa-pred-header { margin-bottom: 30px; }
  .sportlixa-pred-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 11px;
    font-weight: 800;
    color: var(--devnahian-sportlixa-brand-volt, #b9f700);
    text-transform: uppercase;
    margin-bottom: 8px;
  }
  .pulse-indicator { width: 7px; height: 7px; background: #b9f700; border-radius: 50%; box-shadow: 0 0 8px #b9f700; }
  .sportlixa-pred-title { font-size: 32px; font-weight: 900; color: #fff; margin: 0 0 8px 0; }
  .sportlixa-pred-subtext { color: #8c9ba5; font-size: 15px; margin: 0 0 20px 0; max-width: 680px; }
  
  .sportlixa-pred-pills-row { display: flex; gap: 8px; flex-wrap: wrap; }
  .sportlixa-pred-pill {
    background: #141822;
    border: 1px solid rgba(255,255,255,0.1);
    color: #9aa5b5;
    font-size: 12px;
    font-weight: 700;
    padding: 8px 16px;
    border-radius: 20px;
    cursor: pointer;
    transition: all 0.2s;
  }
  .sportlixa-pred-pill.active,
  .sportlixa-pred-pill:hover {
    background: var(--devnahian-sportlixa-brand-volt, #b9f700);
    color: #000;
    border-color: var(--devnahian-sportlixa-brand-volt, #b9f700);
  }

  /* Grid */
  .sportlixa-pred-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(330px, 1fr));
    gap: 20px;
  }
  .sportlixa-pred-card {
    background: #11151c;
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 12px;
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 16px;
    transition: transform 0.2s ease, border-color 0.2s ease;
  }
  .sportlixa-pred-card:hover {
    transform: translateY(-3px);
    border-color: rgba(255,255,255,0.2);
  }
  .pred-card-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 11px;
    font-weight: 800;
  }
  .pred-sport-tag { color: var(--devnahian-sportlixa-brand-volt, #b9f700); }
  .pred-schedule-time { color: #8c9ba5; }

  /* Teams Board */
  .pred-teams-board {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: rgba(0,0,0,0.25);
    padding: 16px;
    border-radius: 10px;
  }
  .pred-team-col {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    width: 40%;
  }
  .pred-logo-wrap { width: 44px; height: 44px; display: flex; align-items: center; justify-content: center; margin-bottom: 6px; }
  .pred-logo-wrap img { width: 40px; height: 40px; object-fit: contain; }
  .pred-fallback-code { font-weight: 900; font-size: 16px; color: #fff; }
  .pred-team-name { margin: 0; font-size: 14px; font-weight: 800; color: #fff; }
  .pred-team-rec { font-size: 11px; color: #8c9ba5; margin-top: 2px; }
  .pred-vs-circle { font-size: 11px; font-weight: 900; color: #64748b; background: rgba(255,255,255,0.05); padding: 4px 8px; border-radius: 50%; }

  /* Probability Meter */
  .pred-win-meter-wrap { display: flex; flex-direction: column; gap: 6px; }
  .pred-win-labels { display: flex; justify-content: space-between; font-size: 11px; font-weight: 800; color: #cbd5e1; }
  .pred-win-labels .meter-title { color: #64748b; text-transform: uppercase; font-size: 10px; }
  .pred-meter-bar { height: 6px; width: 100%; border-radius: 3px; overflow: hidden; display: flex; background: #222; }
  .pred-meter-away { background: #3b82f6; }
  .pred-meter-home { background: var(--devnahian-sportlixa-brand-volt, #b9f700); }

  /* Odds Strip */
  .pred-odds-strip {
    display: flex;
    justify-content: space-between;
    background: rgba(255,255,255,0.03);
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 12px;
    color: #94a3b8;
  }
  .pred-odds-strip strong { color: #fff; }

  /* Pick Buttons */
  .pred-pick-actions { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
  .pred-btn-pick {
    background: #1a202c;
    border: 1px solid rgba(255,255,255,0.12);
    color: #fff;
    padding: 10px;
    font-size: 12.5px;
    font-weight: 700;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s;
  }
  .pred-btn-pick:hover {
    background: #2d3748;
    border-color: rgba(255,255,255,0.25);
  }
  .pred-btn-pick.picked {
    background: var(--devnahian-sportlixa-brand-volt, #b9f700);
    color: #000;
    border-color: var(--devnahian-sportlixa-brand-volt, #b9f700);
  }
</style>

<script>
  function filterPredictions(sport, btn) {
    document.querySelectorAll('.sportlixa-pred-pill').forEach(b => b.classList.remove('active'));
    if (btn) btn.classList.add('active');

    document.querySelectorAll('.sportlixa-pred-card').forEach(card => {
      const cardSport = card.getAttribute('data-sport');
      if (sport === 'all' || cardSport === sport) {
        card.style.display = 'flex';
      } else {
        card.style.display = 'none';
      }
    });
  }

  function castGameVote(gameId, side, btn) {
    const parent = btn.parentElement;
    parent.querySelectorAll('.pred-btn-pick').forEach(b => b.classList.remove('picked'));
    btn.classList.add('picked');
    localStorage.setItem('sportlixa_pick_' + gameId, side);
  }

  // Restore saved user votes from localStorage on load
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.pred-btn-pick').forEach(btn => {
      const gId = btn.getAttribute('data-game');
      const side = btn.getAttribute('data-pick');
      if (localStorage.getItem('sportlixa_pick_' + gId) === side) {
        btn.classList.add('picked');
      }
    });
  });
</script>

<?php get_footer(); ?>