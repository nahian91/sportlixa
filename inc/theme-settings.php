<?php
/**
 * Sportlixa Theme Settings
 * Clean, functional options panel without style/color settings.
 *
 * @package Sportlixa
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * 1. Register Admin Menu under "Appearance"
 */
function sportlixa_add_admin_menu() {
    add_theme_page(
        __( 'Sportlixa Settings', 'sportlixa' ),
        __( 'Sportlixa Settings', 'sportlixa' ),
        'manage_options',
        'sportlixa-settings',
        'sportlixa_settings_page_html'
    );
}
add_action( 'admin_menu', 'sportlixa_add_admin_menu' );

/**
 * 2. Register Settings, Sections, and Fields
 */
function sportlixa_settings_init() {
    register_setting(
        'sportlixa_options_group',
        'sportlixa_options',
        'sportlixa_sanitize_options'
    );

    // =========================================================================
    // TAB 1: Header & Ticker
    // =========================================================================
    add_settings_section(
        'sportlixa_section_header',
        __( 'Header & News Ticker', 'sportlixa' ),
        null,
        'sportlixa-settings-header'
    );

    add_settings_field(
        'enable_news_ticker',
        __( 'Enable News Ticker', 'sportlixa' ),
        'sportlixa_render_checkbox_field',
        'sportlixa-settings-header',
        'sportlixa_section_header',
        [ 'id' => 'enable_news_ticker', 'label' => __( 'Show scrolling news ticker at the top', 'sportlixa' ) ]
    );

    add_settings_field(
        'ticker_badge_label',
        __( 'Ticker Badge Text', 'sportlixa' ),
        'sportlixa_render_text_field',
        'sportlixa-settings-header',
        'sportlixa_section_header',
        [ 'id' => 'ticker_badge_label', 'placeholder' => 'Latest News' ]
    );

    add_settings_field(
        'ticker_post_count',
        __( 'Ticker Post Count', 'sportlixa' ),
        'sportlixa_render_number_field',
        'sportlixa-settings-header',
        'sportlixa_section_header',
        [ 'id' => 'ticker_post_count', 'default' => 6, 'min' => 2, 'max' => 15 ]
    );

    add_settings_field(
        'enable_league_chips',
        __( 'Show Category Chips', 'sportlixa' ),
        'sportlixa_render_checkbox_field',
        'sportlixa-settings-header',
        'sportlixa_section_header',
        [ 'id' => 'enable_league_chips', 'label' => __( 'Show quick category chips below header', 'sportlixa' ) ]
    );

    // =========================================================================
    // TAB 2: Post & Comments Menu
    // =========================================================================
    add_settings_section(
        'sportlixa_section_single',
        __( 'Post & Comments Settings', 'sportlixa' ),
        null,
        'sportlixa-settings-single'
    );

    add_settings_field(
        'show_menu_after_comments',
        __( 'Show Menu After Comments', 'sportlixa' ),
        'sportlixa_render_checkbox_field',
        'sportlixa-settings-single',
        'sportlixa_section_single',
        [ 'id' => 'show_menu_after_comments', 'label' => __( 'Display the main menu directly below comments', 'sportlixa' ) ]
    );

    add_settings_field(
        'post_menu_bar_title',
        __( 'Menu Title Label', 'sportlixa' ),
        'sportlixa_render_text_field',
        'sportlixa-settings-single',
        'sportlixa_section_single',
        [ 'id' => 'post_menu_bar_title', 'placeholder' => 'Explore SportLixa' ]
    );

    add_settings_field(
        'enable_reading_time',
        __( 'Show Reading Time', 'sportlixa' ),
        'sportlixa_render_checkbox_field',
        'sportlixa-settings-single',
        'sportlixa_section_single',
        [ 'id' => 'enable_reading_time', 'label' => __( 'Display reading time (e.g. 5 min read)', 'sportlixa' ) ]
    );

    add_settings_field(
        'enable_author_bio',
        __( 'Show Author Bio', 'sportlixa' ),
        'sportlixa_render_checkbox_field',
        'sportlixa-settings-single',
        'sportlixa_section_single',
        [ 'id' => 'enable_author_bio', 'label' => __( 'Display author box below post content', 'sportlixa' ) ]
    );

    add_settings_field(
        'related_posts_count',
        __( 'Related Posts Count', 'sportlixa' ),
        'sportlixa_render_number_field',
        'sportlixa-settings-single',
        'sportlixa_section_single',
        [ 'id' => 'related_posts_count', 'default' => 3, 'min' => 1, 'max' => 6 ]
    );

    // =========================================================================
    // TAB 3: Scores & Matchup
    // =========================================================================
    add_settings_section(
        'sportlixa_section_marquee',
        __( 'Featured Matchup Box', 'sportlixa' ),
        null,
        'sportlixa-settings-marquee'
    );

    add_settings_field(
        'marquee_live_tag',
        __( 'Badge Text', 'sportlixa' ),
        'sportlixa_render_text_field',
        'sportlixa-settings-marquee',
        'sportlixa_section_marquee',
        [ 'id' => 'marquee_live_tag', 'placeholder' => 'NEXT BIG MATCHUP' ]
    );

    add_settings_field(
        'marquee_game_schedule',
        __( 'Match Schedule', 'sportlixa' ),
        'sportlixa_render_text_field',
        'sportlixa-settings-marquee',
        'sportlixa_section_marquee',
        [ 'id' => 'marquee_game_schedule', 'placeholder' => 'SUN 4:25 PM • CBS' ]
    );

    add_settings_field(
        'marquee_team1_abbr',
        __( 'Team 1 Info', 'sportlixa' ),
        'sportlixa_render_text_field',
        'sportlixa-settings-marquee',
        'sportlixa_section_marquee',
        [ 'id' => 'marquee_team1_abbr', 'placeholder' => 'KC (4-0)' ]
    );

    add_settings_field(
        'marquee_team2_abbr',
        __( 'Team 2 Info', 'sportlixa' ),
        'sportlixa_render_text_field',
        'sportlixa-settings-marquee',
        'sportlixa_section_marquee',
        [ 'id' => 'marquee_team2_abbr', 'placeholder' => 'BUF (3-1)' ]
    );

    add_settings_field(
        'marquee_game_odds',
        __( 'Match Odds Line', 'sportlixa' ),
        'sportlixa_render_text_field',
        'sportlixa-settings-marquee',
        'sportlixa_section_marquee',
        [ 'id' => 'marquee_game_odds', 'placeholder' => 'Spread: KC -2.5 | Total: O/U 48.5' ]
    );

    // =========================================================================
    // TAB 4: Social & Contact
    // =========================================================================
    add_settings_section(
        'sportlixa_section_social',
        __( 'Social Links & Contact Info', 'sportlixa' ),
        null,
        'sportlixa-settings-social'
    );

    add_settings_field(
        'twitter_url',
        __( 'X / Twitter URL', 'sportlixa' ),
        'sportlixa_render_text_field',
        'sportlixa-settings-social',
        'sportlixa_section_social',
        [ 'id' => 'twitter_url', 'placeholder' => 'https://x.com/yourhandle' ]
    );

    add_settings_field(
        'facebook_url',
        __( 'Facebook URL', 'sportlixa' ),
        'sportlixa_render_text_field',
        'sportlixa-settings-social',
        'sportlixa_section_social',
        [ 'id' => 'facebook_url', 'placeholder' => 'https://facebook.com/yourpage' ]
    );

    add_settings_field(
        'instagram_url',
        __( 'Instagram URL', 'sportlixa' ),
        'sportlixa_render_text_field',
        'sportlixa-settings-social',
        'sportlixa_section_social',
        [ 'id' => 'instagram_url', 'placeholder' => 'https://instagram.com/yourhandle' ]
    );

    add_settings_field(
        'youtube_url',
        __( 'YouTube URL', 'sportlixa' ),
        'sportlixa_render_text_field',
        'sportlixa-settings-social',
        'sportlixa_section_social',
        [ 'id' => 'youtube_url', 'placeholder' => 'https://youtube.com/@yourchannel' ]
    );

    add_settings_field(
        'contact_email',
        __( 'Contact Email', 'sportlixa' ),
        'sportlixa_render_text_field',
        'sportlixa-settings-social',
        'sportlixa_section_social',
        [ 'id' => 'contact_email', 'placeholder' => 'contact@sportlixa.com' ]
    );

    add_settings_field(
        'contact_phone',
        __( 'Phone Number', 'sportlixa' ),
        'sportlixa_render_text_field',
        'sportlixa-settings-social',
        'sportlixa_section_social',
        [ 'id' => 'contact_phone', 'placeholder' => '+1 (800) 555-0199' ]
    );

    add_settings_field(
        'footer_tagline',
        __( 'Footer Tagline', 'sportlixa' ),
        'sportlixa_render_text_field',
        'sportlixa-settings-social',
        'sportlixa_section_social',
        [ 'id' => 'footer_tagline', 'placeholder' => 'Your Sports. Your Game. Your Edge.' ]
    );

    // =========================================================================
    // TAB 5: Custom Scripts
    // =========================================================================
    add_settings_section(
        'sportlixa_section_code',
        __( 'Custom Tracking & Scripts', 'sportlixa' ),
        null,
        'sportlixa-settings-code'
    );

    add_settings_field(
        'custom_header_code',
        __( 'Header Scripts (Inside <head>)', 'sportlixa' ),
        'sportlixa_render_textarea_field',
        'sportlixa-settings-code',
        'sportlixa_section_code',
        [ 'id' => 'custom_header_code', 'placeholder' => '<!-- Google Analytics or Tag Manager -->' ]
    );

    add_settings_field(
        'custom_footer_code',
        __( 'Footer Scripts (Before </body>)', 'sportlixa' ),
        'sportlixa_render_textarea_field',
        'sportlixa-settings-code',
        'sportlixa_section_code',
        [ 'id' => 'custom_footer_code', 'placeholder' => '<script>/* Custom scripts */</script>' ]
    );
}
add_action( 'admin_init', 'sportlixa_settings_init' );

/**
 * 3. Form Input Renderers
 */
function sportlixa_render_text_field( $args ) {
    $options = get_option( 'sportlixa_options', [] );
    $id      = $args['id'];
    $val     = $options[ $id ] ?? '';
    $holder  = $args['placeholder'] ?? '';
    printf(
        '<input type="text" id="%1$s" name="sportlixa_options[%1$s]" value="%2$s" placeholder="%3$s" class="regular-text" />',
        esc_attr( $id ),
        esc_attr( $val ),
        esc_attr( $holder )
    );
}

function sportlixa_render_textarea_field( $args ) {
    $options = get_option( 'sportlixa_options', [] );
    $id      = $args['id'];
    $val     = $options[ $id ] ?? '';
    $holder  = $args['placeholder'] ?? '';
    printf(
        '<textarea id="%1$s" name="sportlixa_options[%1$s]" rows="4" cols="60" placeholder="%3$s" class="large-text code">%2$s</textarea>',
        esc_attr( $id ),
        esc_textarea( $val ),
        esc_attr( $holder )
    );
}

function sportlixa_render_checkbox_field( $args ) {
    $options = get_option( 'sportlixa_options', [] );
    $id      = $args['id'];
    $checked = ! empty( $options[ $id ] );
    $label   = $args['label'] ?? '';
    printf(
        '<label><input type="checkbox" id="%1$s" name="sportlixa_options[%1$s]" value="1" %2$s /> %3$s</label>',
        esc_attr( $id ),
        checked( $checked, true, false ),
        esc_html( $label )
    );
}

function sportlixa_render_number_field( $args ) {
    $options = get_option( 'sportlixa_options', [] );
    $id      = $args['id'];
    $val     = $options[ $id ] ?? ( $args['default'] ?? 3 );
    $min     = $args['min'] ?? 1;
    $max     = $args['max'] ?? 20;
    printf(
        '<input type="number" id="%1$s" name="sportlixa_options[%1$s]" value="%2$s" min="%3$d" max="%4$d" class="small-text" />',
        esc_attr( $id ),
        esc_attr( (string) $val ),
        (int) $min,
        (int) $max
    );
}

/**
 * 4. Data Sanitization
 */
function sportlixa_sanitize_options( $input ) {
    $existing = get_option( 'sportlixa_options', [] );
    $clean    = is_array( $existing ) ? $existing : [];

    // Checkboxes
    $checkboxes = [
        'enable_news_ticker',
        'enable_league_chips',
        'show_menu_after_comments',
        'enable_reading_time',
        'enable_author_bio',
    ];

    foreach ( $checkboxes as $cb ) {
        if ( isset( $input[ $cb ] ) ) {
            $clean[ $cb ] = 1;
        } elseif ( isset( $_POST['sportlixa_tab_submitted'] ) ) {
            $clean[ $cb ] = 0;
        }
    }

    // Text inputs
    if ( isset( $input['ticker_badge_label'] ) )    $clean['ticker_badge_label']    = sanitize_text_field( $input['ticker_badge_label'] );
    if ( isset( $input['ticker_post_count'] ) )     $clean['ticker_post_count']     = absint( $input['ticker_post_count'] );
    if ( isset( $input['post_menu_bar_title'] ) )   $clean['post_menu_bar_title']   = sanitize_text_field( $input['post_menu_bar_title'] );
    if ( isset( $input['related_posts_count'] ) )   $clean['related_posts_count']   = absint( $input['related_posts_count'] );
    if ( isset( $input['marquee_live_tag'] ) )      $clean['marquee_live_tag']      = sanitize_text_field( $input['marquee_live_tag'] );
    if ( isset( $input['marquee_game_schedule'] ) ) $clean['marquee_game_schedule'] = sanitize_text_field( $input['marquee_game_schedule'] );
    if ( isset( $input['marquee_team1_abbr'] ) )    $clean['marquee_team1_abbr']    = sanitize_text_field( $input['marquee_team1_abbr'] );
    if ( isset( $input['marquee_team2_abbr'] ) )    $clean['marquee_team2_abbr']    = sanitize_text_field( $input['marquee_team2_abbr'] );
    if ( isset( $input['marquee_game_odds'] ) )     $clean['marquee_game_odds']     = sanitize_text_field( $input['marquee_game_odds'] );
    if ( isset( $input['footer_tagline'] ) )        $clean['footer_tagline']        = sanitize_text_field( $input['footer_tagline'] );
    if ( isset( $input['contact_phone'] ) )         $clean['contact_phone']         = sanitize_text_field( $input['contact_phone'] );
    if ( isset( $input['contact_email'] ) )         $clean['contact_email']         = sanitize_email( $input['contact_email'] );

    // URLs
    if ( isset( $input['twitter_url'] ) )   $clean['twitter_url']   = esc_url_raw( trim( $input['twitter_url'] ) );
    if ( isset( $input['facebook_url'] ) )  $clean['facebook_url']  = esc_url_raw( trim( $input['facebook_url'] ) );
    if ( isset( $input['instagram_url'] ) ) $clean['instagram_url'] = esc_url_raw( trim( $input['instagram_url'] ) );
    if ( isset( $input['youtube_url'] ) )   $clean['youtube_url']   = esc_url_raw( trim( $input['youtube_url'] ) );

    // Custom code
    if ( isset( $input['custom_header_code'] ) ) $clean['custom_header_code'] = current_user_can( 'unfiltered_html' ) ? $input['custom_header_code'] : wp_strip_all_tags( $input['custom_header_code'] );
    if ( isset( $input['custom_footer_code'] ) ) $clean['custom_footer_code'] = current_user_can( 'unfiltered_html' ) ? $input['custom_footer_code'] : wp_strip_all_tags( $input['custom_footer_code'] );

    return $clean;
}

/**
 * 5. Tabbed Admin Settings Page
 */
function sportlixa_settings_page_html() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    $active_tab = isset( $_GET['tab'] ) ? sanitize_key( $_GET['tab'] ) : 'header';
    $tabs = [
        'header'  => __( 'Header & Ticker', 'sportlixa' ),
        'single'  => __( 'Post & Comments Menu', 'sportlixa' ),
        'marquee' => __( 'Scores & Matchup', 'sportlixa' ),
        'social'  => __( 'Social & Contact', 'sportlixa' ),
        'code'    => __( 'Custom Scripts', 'sportlixa' ),
    ];
    ?>
    <div class="wrap sportlixa-settings-wrap">
      <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
      
      <?php settings_errors(); ?>

      <nav class="nav-tab-wrapper" style="margin-bottom: 20px;">
        <?php foreach ( $tabs as $tab_key => $tab_name ) : ?>
          <a href="<?php echo esc_url( add_query_arg( [ 'page' => 'sportlixa-settings', 'tab' => $tab_key ], admin_url( 'themes.php' ) ) ); ?>" 
             class="nav-tab <?php echo ( $active_tab === $tab_key ) ? 'nav-tab-active' : ''; ?>">
            <?php echo esc_html( $tab_name ); ?>
          </a>
        <?php endforeach; ?>
      </nav>

      <form action="options.php" method="post" style="background:#fff; border:1px solid #ccd0d4; padding:20px 28px; border-radius:4px; max-width:800px;">
        <input type="hidden" name="sportlixa_tab_submitted" value="<?php echo esc_attr( $active_tab ); ?>" />
        <?php
        settings_fields( 'sportlixa_options_group' );
        do_settings_sections( 'sportlixa-settings-' . $active_tab );
        submit_button( __( 'Save Changes', 'sportlixa' ) );
        ?>
      </form>
    </div>
    <?php
}

/**
 * 6. Global Theme Option Helper
 */
function sportlixa_get_option( $key, $default = '' ) {
    $options = get_option( 'sportlixa_options', [] );
    return ( isset( $options[ $key ] ) && '' !== $options[ $key ] ) ? $options[ $key ] : $default;
}

/**
 * 7. Inject Custom Header / Footer Code
 */
function sportlixa_output_custom_options() {
    $header_code = sportlixa_get_option( 'custom_header_code', '' );
    if ( ! empty( $header_code ) ) {
        echo $header_code . "\n";
    }
}
add_action( 'wp_head', 'sportlixa_output_custom_options', 99 );

function sportlixa_output_custom_footer_code() {
    $footer_code = sportlixa_get_option( 'custom_footer_code', '' );
    if ( ! empty( $footer_code ) ) {
        echo $footer_code . "\n";
    }
}
add_action( 'wp_footer', 'sportlixa_output_custom_footer_code', 99 );