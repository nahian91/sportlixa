<?php
/**
 * Sportlixa Theme Settings
 * 6 Focused Tabs: Header, Footer, Featured Posts, Top Stories, Injury Wire & Fantasy, Videos.
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
    // TAB 1: Header (Ticker & Social Links)
    // =========================================================================
    add_settings_section(
        'sportlixa_section_header',
        __( 'Header & News Ticker Settings', 'sportlixa' ),
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
        __( 'Category Chips Bar', 'sportlixa' ),
        'sportlixa_render_checkbox_field',
        'sportlixa-settings-header',
        'sportlixa_section_header',
        [ 'id' => 'enable_league_chips', 'label' => __( 'Show horizontal category chips beneath header', 'sportlixa' ) ]
    );

    // Social Icons inside Header
    add_settings_field(
        'twitter_url',
        __( 'X / Twitter Profile URL', 'sportlixa' ),
        'sportlixa_render_text_field',
        'sportlixa-settings-header',
        'sportlixa_section_header',
        [ 'id' => 'twitter_url', 'placeholder' => 'https://x.com/yourhandle' ]
    );

    add_settings_field(
        'facebook_url',
        __( 'Facebook Profile URL', 'sportlixa' ),
        'sportlixa_render_text_field',
        'sportlixa-settings-header',
        'sportlixa_section_header',
        [ 'id' => 'facebook_url', 'placeholder' => 'https://facebook.com/yourpage' ]
    );

    add_settings_field(
        'instagram_url',
        __( 'Instagram Profile URL', 'sportlixa' ),
        'sportlixa_render_text_field',
        'sportlixa-settings-header',
        'sportlixa_section_header',
        [ 'id' => 'instagram_url', 'placeholder' => 'https://instagram.com/yourhandle' ]
    );

    add_settings_field(
        'youtube_url',
        __( 'YouTube Channel URL', 'sportlixa' ),
        'sportlixa_render_text_field',
        'sportlixa-settings-header',
        'sportlixa_section_header',
        [ 'id' => 'youtube_url', 'placeholder' => 'https://youtube.com/@yourchannel' ]
    );

    // =========================================================================
    // TAB 2: Footer (About Us, Column Titles, Contact, Copyright)
    // =========================================================================
    add_settings_section(
        'sportlixa_section_footer',
        __( 'Footer Content & Column Titles', 'sportlixa' ),
        null,
        'sportlixa-settings-footer'
    );

    add_settings_field(
        'footer_about_text',
        __( 'About Us Description', 'sportlixa' ),
        'sportlixa_render_textarea_field',
        'sportlixa-settings-footer',
        'sportlixa_section_footer',
        [
            'id'          => 'footer_about_text',
            'placeholder' => __( 'Sportlixa delivers real-time sports telemetries, deep roster analytics, scores, and breaking headlines...', 'sportlixa' ),
        ]
    );

    add_settings_field(
        'footer_col1_title',
        __( 'Footer Column 1 Title', 'sportlixa' ),
        'sportlixa_render_text_field',
        'sportlixa-settings-footer',
        'sportlixa_section_footer',
        [ 'id' => 'footer_col1_title', 'placeholder' => 'Quick Links' ]
    );

    add_settings_field(
        'footer_col2_title',
        __( 'Footer Column 2 Title', 'sportlixa' ),
        'sportlixa_render_text_field',
        'sportlixa-settings-footer',
        'sportlixa_section_footer',
        [ 'id' => 'footer_col2_title', 'placeholder' => 'Leagues & Coverage' ]
    );

    add_settings_field(
        'footer_col3_title',
        __( 'Footer Column 3 Title', 'sportlixa' ),
        'sportlixa_render_text_field',
        'sportlixa-settings-footer',
        'sportlixa_section_footer',
        [ 'id' => 'footer_col3_title', 'placeholder' => 'Stay Connected' ]
    );

    add_settings_field(
        'contact_email',
        __( 'Contact Email', 'sportlixa' ),
        'sportlixa_render_text_field',
        'sportlixa-settings-footer',
        'sportlixa_section_footer',
        [ 'id' => 'contact_email', 'placeholder' => 'contact@sportlixa.com' ]
    );

    add_settings_field(
        'contact_phone',
        __( 'Phone Number', 'sportlixa' ),
        'sportlixa_render_text_field',
        'sportlixa-settings-footer',
        'sportlixa_section_footer',
        [ 'id' => 'contact_phone', 'placeholder' => '+1 (800) 555-0199' ]
    );

    add_settings_field(
        'footer_tagline',
        __( 'Copyright & Brand Tagline', 'sportlixa' ),
        'sportlixa_render_text_field',
        'sportlixa-settings-footer',
        'sportlixa_section_footer',
        [ 'id' => 'footer_tagline', 'placeholder' => 'Your Sports. Your Game. Your Edge.' ]
    );

    // =========================================================================
    // TAB 3: Featured Posts (Individual Post Switches)
    // =========================================================================
    add_settings_section(
        'sportlixa_section_featured',
        __( 'Featured Posts Picker', 'sportlixa' ),
        'sportlixa_featured_section_desc',
        'sportlixa-settings-featured'
    );

    add_settings_field(
        'featured_posts_list',
        __( 'Select Featured Posts', 'sportlixa' ),
        'sportlixa_render_posts_switch_table',
        'sportlixa-settings-featured',
        'sportlixa_section_featured',
        [ 'key' => 'featured_post_ids', 'badge' => 'Featured' ]
    );

    // =========================================================================
    // TAB 4: Top Stories (Individual Post Switches)
    // =========================================================================
    add_settings_section(
        'sportlixa_section_top_stories',
        __( 'Top Stories Picker', 'sportlixa' ),
        'sportlixa_top_stories_section_desc',
        'sportlixa-settings-top_stories'
    );

    add_settings_field(
        'top_stories_list',
        __( 'Select Top Stories', 'sportlixa' ),
        'sportlixa_render_posts_switch_table',
        'sportlixa-settings-top_stories',
        'sportlixa_section_top_stories',
        [ 'key' => 'top_story_post_ids', 'badge' => 'Top Story' ]
    );

    // =========================================================================
    // TAB 5: Injury Wire & Fantasy (Repeater)
    // =========================================================================
    add_settings_section(
        'sportlixa_section_injuries',
        __( 'NFL Injury Wire & Fantasy Intel', 'sportlixa' ),
        'sportlixa_injuries_section_desc',
        'sportlixa-settings-injuries'
    );

    add_settings_field(
        'injury_wire_repeater',
        __( 'Player Injury Cards', 'sportlixa' ),
        'sportlixa_render_injuries_repeater',
        'sportlixa-settings-injuries',
        'sportlixa_section_injuries'
    );

    // =========================================================================
    // TAB 6: Videos (Repeater)
    // =========================================================================
    add_settings_section(
        'sportlixa_section_videos',
        __( 'Featured Videos & Popup Player', 'sportlixa' ),
        'sportlixa_videos_section_desc',
        'sportlixa-settings-videos'
    );

    add_settings_field(
        'videos_repeater',
        __( 'Video Cards', 'sportlixa' ),
        'sportlixa_render_videos_repeater',
        'sportlixa-settings-videos',
        'sportlixa_section_videos'
    );
}
add_action( 'admin_init', 'sportlixa_settings_init' );

/**
 * 3. Section Descriptions
 */
function sportlixa_featured_section_desc() {
    echo '<p style="color:#64748b; font-size:13.5px;">' . esc_html__( 'Toggle the posts you want displayed in the homepage Featured block and Hero sections.', 'sportlixa' ) . '</p>';
}

function sportlixa_top_stories_section_desc() {
    echo '<p style="color:#64748b; font-size:13.5px;">' . esc_html__( 'Toggle the posts you want to pin inside the Homepage Top Stories section.', 'sportlixa' ) . '</p>';
}

function sportlixa_injuries_section_desc() {
    echo '<p style="color:#64748b; font-size:13.5px;">' . esc_html__( 'Add, edit, or remove players on the NFL Injury Report Wire along with fantasy recommendations.', 'sportlixa' ) . '</p>';
}

function sportlixa_videos_section_desc() {
    echo '<p style="color:#64748b; font-size:13.5px;">' . esc_html__( 'Add, edit, or remove video items. Embed links will automatically play in the frontend modal popup.', 'sportlixa' ) . '</p>';
}

/**
 * 4. Custom Post Switch Table Renderer
 */
function sportlixa_render_posts_switch_table( $args ) {
    $options   = get_option( 'sportlixa_options', [] );
    $key       = $args['key'];$badge_txt = $args['badge'];$saved_ids = isset( $options[$key ] ) && is_array( $options[$key ] ) ? array_map( 'absint', $options[$key ] ) : [];

    $posts = get_posts( [
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 40,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ] );

    if ( empty( $posts ) ) {
        echo '<p style="color:#64748b;">' . esc_html__( 'No published posts found.', 'sportlixa' ) . '</p>';
        return;
    }
    ?>
    <style>
      .sportlixa-post-switch-table {
        width: 100%;
        max-width: 820px;
        border-collapse: collapse;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        overflow: hidden;
      }
      .sportlixa-post-switch-table th {
        background: #f8fafc;
        padding: 10px 14px;
        text-align: left;
        font-size: 12px;
        font-weight: 700;
        color: #475569;
        border-bottom: 1px solid #e2e8f0;
      }
      .sportlixa-post-switch-table td {
        padding: 10px 14px;
        border-bottom: 1px solid #f1f5f9;
        font-size: 13px;
        color: #1e293b;
        vertical-align: middle;
      }
      .sportlixa-post-switch-table tr:last-child td {
        border-bottom: none;
      }
      .sportlixa-switch {
        position: relative;
        display: inline-block;
        width: 44px;
        height: 24px;
      }
      .sportlixa-switch input {
        opacity: 0;
        width: 0;
        height: 0;
      }
      .sportlixa-slider {
        position: absolute;
        cursor: pointer;
        top: 0; left: 0; right: 0; bottom: 0;
        background-color: #cbd5e1;
        transition: .3s;
        border-radius: 24px;
      }
      .sportlixa-slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: .3s;
        border-radius: 50%;
      }
      .sportlixa-switch input:checked + .sportlixa-slider {
        background-color: #0f172a;
      }
      .sportlixa-switch input:checked + .sportlixa-slider:before {
        transform: translateX(20px);
        background-color: #ccff00;
      }
      .sportlixa-tag-badge {
        font-size: 11px;
        font-weight: 700;
        background: #e2e8f0;
        color: #334155;
        padding: 2px 8px;
        border-radius: 4px;
      }
    </style>

    <div style="max-height: 480px; overflow-y: auto; border: 1px solid #e2e8f0; border-radius: 8px;">
      <table class="sportlixa-post-switch-table">
        <thead>
          <tr>
            <th style="width: 70px; text-align: center;"><?php esc_html_e( 'Toggle', 'sportlixa' ); ?></th>
            <th><?php esc_html_e( 'Title', 'sportlixa' ); ?></th>
            <th><?php esc_html_e( 'Category', 'sportlixa' ); ?></th>
            <th><?php esc_html_e( 'Published Date', 'sportlixa' ); ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ( $posts as$p ) : 
              $is_checked = in_array($p->ID, $saved_ids, true );$cats       = get_the_category( $p->ID );$cat_name   = ! empty( $cats ) ?$cats[0]->name : 'General';
              ?>
              <tr>
                <td style="text-align: center;">
                  <label class="sportlixa-switch">
                    <input type="checkbox" 
                           name="sportlixa_options[<?php echo esc_attr( $key ); ?>][]" 
                           value="<?php echo esc_attr( $p->ID ); ?>" 
                           <?php checked( $is_checked, true ); ?> />
                    <span class="sportlixa-slider"></span>
                  </label>
                </td>
                <td>
                  <strong><?php echo esc_html( $p->post_title ); ?></strong>
                </td>
                <td>
                  <span class="sportlixa-tag-badge"><?php echo esc_html( $cat_name ); ?></span>
                </td>
                <td style="color: #64748b; font-size: 12px;">
                  <?php echo esc_html( get_the_date( 'M j, Y', $p->ID ) ); ?>
                </td>
              </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <p class="description" style="margin-top: 8px; color: #64748b;">
      <?php printf( esc_html__( 'Checked posts will be added to the %s query pool.', 'sportlixa' ), esc_html( $badge_txt ) ); ?>
    </p>
    <?php
}

/**
 * 5. Repeaters Renderers (Injuries & Videos)
 */
function sportlixa_render_injuries_repeater() {
    $options = get_option( 'sportlixa_options', [] );
    $items   = isset($options['injury_wire_items'] ) && is_array( $options['injury_wire_items'] ) ?$options['injury_wire_items'] : [];
    ?>
    <div id="sportlixa-injuries-container" style="max-width: 820px;">
        <div id="sportlixa-injuries-list">
            <?php if ( ! empty( $items ) ) : ?>
                <?php foreach ( $items as $idx =>$item ) : ?>
                    <?php sportlixa_render_single_injury_row( $idx,$item ); ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <button type="button" class="button button-secondary" id="sportlixa-add-injury-btn" style="margin-top: 8px;">
            + <?php esc_html_e( 'Add Player Injury', 'sportlixa' ); ?>
        </button>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const addBtn = document.getElementById('sportlixa-add-injury-btn');
        if (addBtn) {
            addBtn.addEventListener('click', function() {
                const list = document.getElementById('sportlixa-injuries-list');
                const idx = Date.now();
                const tpl = `
                    <div class="sportlixa-repeater-card">
                        <div class="sportlixa-repeater-row">
                            <div class="sportlixa-repeater-col">
                                <label>Player Name</label>
                                <input type="text" name="sportlixa_options[injury_wire_items][${idx}][name]" placeholder="e.g. Rashee Rice" required />
                            </div>
                            <div class="sportlixa-repeater-col">
                                <label>Team & Position</label>
                                <input type="text" name="sportlixa_options[injury_wire_items][${idx}][team_pos]" placeholder="e.g. Kansas City Chiefs • WR" />
                            </div>
                        </div>
                        <div class="sportlixa-repeater-row">
                            <div class="sportlixa-repeater-col">
                                <label>Injury Status</label>
                                <select name="sportlixa_options[injury_wire_items][${idx}][status]">
                                    <option value="Questionable">Questionable</option>
                                    <option value="Probable">Probable</option>
                                    <option value="Out (IR)">Out (IR)</option>
                                    <option value="Doubtful">Doubtful</option>
                                </select>
                            </div>
                            <div class="sportlixa-repeater-col">
                                <label>Fantasy Intel / Sleeper Action</label>
                                <input type="text" name="sportlixa_options[injury_wire_items][${idx}][fantasy]" placeholder="e.g. Elevate Xavier Worthy into WR2 slot." />
                            </div>
                        </div>
                        <div class="sportlixa-repeater-row full-width">
                            <div class="sportlixa-repeater-col">
                                <label>Status / Injury Note</label>
                                <textarea name="sportlixa_options[injury_wire_items][${idx}][desc]" rows="2" placeholder="Hamstring strain sustained during Week 5. Game-time decision..."></textarea>
                            </div>
                        </div>
                        <button type="button" class="button-link-delete" onclick="this.closest('.sportlixa-repeater-card').remove();" style="color:#b32d2e; text-decoration:none; font-size:12px; cursor:pointer;">
                            ✕ <?php echo esc_js( __( 'Remove Card', 'sportlixa' ) ); ?>
                        </button>
                    </div>`;
                list.insertAdjacentHTML('beforeend', tpl);
            });
        }
    });
    </script>
    <?php
}

function sportlixa_render_single_injury_row( $idx,$item = [] ) {
    $status =$item['status'] ?? 'Questionable';
    ?>
    <div class="sportlixa-repeater-card">
        <div class="sportlixa-repeater-row">
            <div class="sportlixa-repeater-col">
                <label><?php esc_html_e( 'Player Name', 'sportlixa' ); ?></label>
                <input type="text" name="sportlixa_options[injury_wire_items][<?php echo esc_attr( $idx ); ?>][name]" value="<?php echo esc_attr( $item['name'] ?? '' ); ?>" required />
            </div>
            <div class="sportlixa-repeater-col">
                <label><?php esc_html_e( 'Team & Position', 'sportlixa' ); ?></label>
                <input type="text" name="sportlixa_options[injury_wire_items][<?php echo esc_attr( $idx ); ?>][team_pos]" value="<?php echo esc_attr( $item['team_pos'] ?? '' ); ?>" />
            </div>
        </div>
        <div class="sportlixa-repeater-row">
            <div class="sportlixa-repeater-col">
                <label><?php esc_html_e( 'Injury Status', 'sportlixa' ); ?></label>
                <select name="sportlixa_options[injury_wire_items][<?php echo esc_attr( $idx ); ?>][status]">
                    <option value="Questionable" <?php selected( $status, 'Questionable' ); ?>>Questionable</option>
                    <option value="Probable" <?php selected( $status, 'Probable' ); ?>>Probable</option>
                    <option value="Out (IR)" <?php selected( $status, 'Out (IR)' ); ?>>Out (IR)</option>
                    <option value="Doubtful" <?php selected( $status, 'Doubtful' ); ?>>Doubtful</option>
                </select>
            </div>
            <div class="sportlixa-repeater-col">
                <label><?php esc_html_e( 'Fantasy Intel / Sleeper Action', 'sportlixa' ); ?></label>
                <input type="text" name="sportlixa_options[injury_wire_items][<?php echo esc_attr( $idx ); ?>][fantasy]" value="<?php echo esc_attr( $item['fantasy'] ?? '' ); ?>" />
            </div>
        </div>
        <div class="sportlixa-repeater-row full-width">
            <div class="sportlixa-repeater-col">
                <label><?php esc_html_e( 'Status / Injury Note', 'sportlixa' ); ?></label>
                <textarea name="sportlixa_options[injury_wire_items][<?php echo esc_attr( $idx ); ?>][desc]" rows="2"><?php echo esc_textarea( $item['desc'] ?? '' ); ?></textarea>
            </div>
        </div>
        <button type="button" class="button-link-delete" onclick="this.closest('.sportlixa-repeater-card').remove();" style="color:#b32d2e; text-decoration:none; font-size:12px; cursor:pointer;">
            ✕ <?php esc_html_e( 'Remove Card', 'sportlixa' ); ?>
        </button>
    </div>
    <?php
}

function sportlixa_render_videos_repeater() {
    $options = get_option( 'sportlixa_options', [] );
    $items   = isset($options['video_items'] ) && is_array( $options['video_items'] ) ?$options['video_items'] : [];
    ?>
    <div id="sportlixa-videos-container" style="max-width: 820px;">
        <div id="sportlixa-videos-list">
            <?php if ( ! empty( $items ) ) : ?>
                <?php foreach ( $items as $idx =>$item ) : ?>
                    <?php sportlixa_render_single_video_row( $idx,$item ); ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <button type="button" class="button button-secondary" id="sportlixa-add-video-btn" style="margin-top: 8px;">
            + <?php esc_html_e( 'Add Video Card', 'sportlixa' ); ?>
        </button>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const addBtn = document.getElementById('sportlixa-add-video-btn');
        if (addBtn) {
            addBtn.addEventListener('click', function() {
                const list = document.getElementById('sportlixa-videos-list');
                const idx = Date.now();
                const tpl = `
                    <div class="sportlixa-repeater-card">
                        <div class="sportlixa-repeater-row">
                            <div class="sportlixa-repeater-col">
                                <label>Video Title</label>
                                <input type="text" name="sportlixa_options[video_items][${idx}][title]" placeholder="e.g. Top 10 Plays of the Week" required />
                            </div>
                            <div class="sportlixa-repeater-col">
                                <label>Duration</label>
                                <input type="text" name="sportlixa_options[video_items][${idx}][duration]" placeholder="e.g. 04:32" />
                            </div>
                        </div>
                        <div class="sportlixa-repeater-row">
                            <div class="sportlixa-repeater-col">
                                <label>Thumbnail Image URL</label>
                                <input type="url" name="sportlixa_options[video_items][${idx}][thumb]" placeholder="https://..." />
                            </div>
                            <div class="sportlixa-repeater-col">
                                <label>Embed / Popup URL</label>
                                <input type="url" name="sportlixa_options[video_items][${idx}][embed_url]" placeholder="https://www.youtube.com/embed/..." required />
                            </div>
                        </div>
                        <div class="sportlixa-repeater-row full-width">
                            <div class="sportlixa-repeater-col">
                                <label>Meta Subtitle / Views</label>
                                <input type="text" name="sportlixa_options[video_items][${idx}][meta]" placeholder="e.g. Oct 5, 2026 • 2.4K views" />
                            </div>
                        </div>
                        <button type="button" class="button-link-delete" onclick="this.closest('.sportlixa-repeater-card').remove();" style="color:#b32d2e; text-decoration:none; font-size:12px; cursor:pointer;">
                            ✕ <?php echo esc_js( __( 'Remove Video', 'sportlixa' ) ); ?>
                        </button>
                    </div>`;
                list.insertAdjacentHTML('beforeend', tpl);
            });
        }
    });
    </script>
    <?php
}

function sportlixa_render_single_video_row( $idx,$item = [] ) {
    ?>
    <div class="sportlixa-repeater-card">
        <div class="sportlixa-repeater-row">
            <div class="sportlixa-repeater-col">
                <label><?php esc_html_e( 'Video Title', 'sportlixa' ); ?></label>
                <input type="text" name="sportlixa_options[video_items][<?php echo esc_attr( $idx ); ?>][title]" value="<?php echo esc_attr( $item['title'] ?? '' ); ?>" required />
            </div>
            <div class="sportlixa-repeater-col">
                <label><?php esc_html_e( 'Duration', 'sportlixa' ); ?></label>
                <input type="text" name="sportlixa_options[video_items][<?php echo esc_attr( $idx ); ?>][duration]" value="<?php echo esc_attr( $item['duration'] ?? '' ); ?>" />
            </div>
        </div>
        <div class="sportlixa-repeater-row">
            <div class="sportlixa-repeater-col">
                <label><?php esc_html_e( 'Thumbnail Image URL', 'sportlixa' ); ?></label>
                <input type="url" name="sportlixa_options[video_items][<?php echo esc_attr( $idx ); ?>][thumb]" value="<?php echo esc_url( $item['thumb'] ?? '' ); ?>" />
            </div>
            <div class="sportlixa-repeater-col">
                <label><?php esc_html_e( 'Embed / Popup URL', 'sportlixa' ); ?></label>
                <input type="url" name="sportlixa_options[video_items][<?php echo esc_attr( $idx ); ?>][embed_url]" value="<?php echo esc_url( $item['embed_url'] ?? '' ); ?>" required />
            </div>
        </div>
        <div class="sportlixa-repeater-row full-width">
            <div class="sportlixa-repeater-col">
                <label><?php esc_html_e( 'Meta Subtitle / Views', 'sportlixa' ); ?></label>
                <input type="text" name="sportlixa_options[video_items][<?php echo esc_attr( $idx ); ?>][meta]" value="<?php echo esc_attr( $item['meta'] ?? '' ); ?>" />
            </div>
        </div>
        <button type="button" class="button-link-delete" onclick="this.closest('.sportlixa-repeater-card').remove();" style="color:#b32d2e; text-decoration:none; font-size:12px; cursor:pointer;">
            ✕ <?php esc_html_e( 'Remove Video', 'sportlixa' ); ?>
        </button>
    </div>
    <?php
}

/**
 * 6. General Form Input Renderers
 */
function sportlixa_render_text_field( $args ) {
    $options = get_option( 'sportlixa_options', [] );$id      = $args['id'];$val     = $options[$id ] ?? '';
    $holder  =$args['placeholder'] ?? '';
    printf(
        '<input type="text" id="%1$s" name="sportlixa_options[\%1$s]" value="%2$s" placeholder="\%3$s" class="regular-text" style="width:100%%; max-width:550px;" />',
        esc_attr( $id ),
        esc_attr( $val ),
        esc_attr( $holder )
    );
}

function sportlixa_render_textarea_field( $args ) {
    $options = get_option( 'sportlixa_options', [] );$id      = $args['id'];$val     = $options[$id ] ?? '';
    $holder  =$args['placeholder'] ?? '';
    printf(
        '<textarea id="%1$s" name="sportlixa_options[\%1$s]" rows="4" cols="60" placeholder="%3$s" class="large-text" style="max-width:550px;">\%2$s</textarea>',
        esc_attr( $id ),
        esc_textarea( $val ),
        esc_attr( $holder )
    );
}

function sportlixa_render_checkbox_field( $args ) {
    $options = get_option( 'sportlixa_options', [] );$id      = $args['id'];$checked = ! empty( $options[$id ] );
    $label   =$args['label'] ?? '';
    printf(
        '<label><input type="checkbox" id="%1$s" name="sportlixa_options[\%1$s]" value="1" %2$s /> \%3$s</label>',
        esc_attr( $id ),
        checked( $checked, true, false ),
        esc_html( $label )
    );
}

function sportlixa_render_number_field( $args ) {$options = get_option( 'sportlixa_options', [] );
    $id      =$args['id'];
    $val     =$options[ $id ] ?? ($args['default'] ?? 3 );
    $min     =$args['min'] ?? 1;
    $max     =$args['max'] ?? 20;
    printf(
        '<input type="number" id="%1$s" name="sportlixa_options[%1$s]" value="\%2$s" min="%3$d" max="\%4$d" class="small-text" />',
        esc_attr( $id ),
        esc_attr( (string) $val ),
        (int) $min,
        (int) $max
    );
}

/**
 * 7. Data Sanitization
 */
function sportlixa_sanitize_options( $input ) {$existing   = get_option( 'sportlixa_options', [] );
    $clean      = is_array($existing ) ? $existing : [];$active_tab = isset( $_POST['sportlixa_tab_submitted'] ) ? sanitize_key( $_POST['sportlixa_tab_submitted'] ) : '';

    // Tab 1: Header
    if ( 'header' === $active_tab ) {
        $clean['enable_news_ticker']  = ! empty( $input['enable_news_ticker'] ) ? 1 : 0;
        $clean['enable_league_chips'] = ! empty( $input['enable_league_chips'] ) ? 1 : 0;

        if ( isset( $input['ticker_badge_label'] ) ) $clean['ticker_badge_label'] = sanitize_text_field($input['ticker_badge_label'] );
        if ( isset( $input['ticker_post_count'] ) )  $clean['ticker_post_count']  = absint($input['ticker_post_count'] );

        if ( isset( $input['twitter_url'] ) )   $clean['twitter_url']   = esc_url_raw( trim($input['twitter_url'] ) );
        if ( isset( $input['facebook_url'] ) )  $clean['facebook_url']  = esc_url_raw( trim($input['facebook_url'] ) );
        if ( isset( $input['instagram_url'] ) ) $clean['instagram_url'] = esc_url_raw( trim($input['instagram_url'] ) );
        if ( isset( $input['youtube_url'] ) )   $clean['youtube_url']   = esc_url_raw( trim($input['youtube_url'] ) );
    }

    // Tab 2: Footer
    if ( 'footer' === $active_tab ) {
        if ( isset( $input['footer_about_text'] ) ) $clean['footer_about_text'] = sanitize_textarea_field($input['footer_about_text'] );
        if ( isset( $input['footer_col1_title'] ) ) $clean['footer_col1_title'] = sanitize_text_field($input['footer_col1_title'] );
        if ( isset( $input['footer_col2_title'] ) ) $clean['footer_col2_title'] = sanitize_text_field($input['footer_col2_title'] );
        if ( isset( $input['footer_col3_title'] ) ) $clean['footer_col3_title'] = sanitize_text_field($input['footer_col3_title'] );
        if ( isset( $input['contact_email'] ) )     $clean['contact_email']     = sanitize_email($input['contact_email'] );
        if ( isset( $input['contact_phone'] ) )     $clean['contact_phone']     = sanitize_text_field($input['contact_phone'] );
        if ( isset( $input['footer_tagline'] ) )    $clean['footer_tagline']    = sanitize_text_field($input['footer_tagline'] );
    }

    // Tab 3: Featured Posts
    if ( 'featured' === $active_tab ) {
        if ( isset( $input['featured_post_ids'] ) && is_array($input['featured_post_ids'] ) ) {
            $clean['featured_post_ids'] = array_map( 'absint',$input['featured_post_ids'] );
        } else {
            $clean['featured_post_ids'] = [];
        }
    }

    // Tab 4: Top Stories
    if ( 'top_stories' === $active_tab ) {
        if ( isset( $input['top_story_post_ids'] ) && is_array($input['top_story_post_ids'] ) ) {
            $clean['top_story_post_ids'] = array_map( 'absint',$input['top_story_post_ids'] );
        } else {
            $clean['top_story_post_ids'] = [];
        }
    }

    // Tab 5: Injury Wire & Fantasy
    if ( 'injuries' === $active_tab ) {$clean['injury_wire_items'] = [];
        if ( isset( $input['injury_wire_items'] ) && is_array($input['injury_wire_items'] ) ) {
            foreach ( $input['injury_wire_items'] as$item ) {
                if ( ! empty( $item['name'] ) ) {$clean['injury_wire_items'][] = [
                        'name'     => sanitize_text_field( $item['name'] ),
                        'team_pos' => sanitize_text_field( $item['team_pos'] ?? '' ),
                        'status'   => sanitize_text_field( $item['status'] ?? 'Questionable' ),
                        'fantasy'  => sanitize_text_field( $item['fantasy'] ?? '' ),
                        'desc'     => sanitize_textarea_field( $item['desc'] ?? '' ),
                    ];
                }
            }
        }
    }

    // Tab 6: Videos
    if ( 'videos' === $active_tab ) {$clean['video_items'] = [];
        if ( isset( $input['video_items'] ) && is_array($input['video_items'] ) ) {
            foreach ( $input['video_items'] as$item ) {
                if ( ! empty( $item['title'] ) ) {$clean['video_items'][] = [
                        'title'     => sanitize_text_field( $item['title'] ),
                        'duration'  => sanitize_text_field( $item['duration'] ?? '' ),
                        'thumb'     => esc_url_raw( $item['thumb'] ?? '' ),
                        'embed_url' => esc_url_raw( $item['embed_url'] ?? '' ),
                        'meta'      => sanitize_text_field( $item['meta'] ?? '' ),
                    ];
                }
            }
        }
    }

    return $clean;
}

/**
 * 8. Tabbed Admin Settings Page
 */
function sportlixa_settings_page_html() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    $active_tab = isset($_GET['tab'] ) ? sanitize_key( $_GET['tab'] ) : 'header';$tabs = [
        'header'      => __( 'Header Settings', 'sportlixa' ),
        'footer'      => __( 'Footer Settings', 'sportlixa' ),
        'featured'    => __( 'Featured Posts', 'sportlixa' ),
        'top_stories' => __( 'Top Stories', 'sportlixa' ),
        'injuries'    => __( 'Injury Wire & Fantasy', 'sportlixa' ),
        'videos'      => __( 'Videos', 'sportlixa' ),
    ];
    ?>
    <div class="wrap sportlixa-settings-wrap">
      <h1 style="margin-bottom: 18px;"><?php echo esc_html( get_admin_page_title() ); ?></h1>
      
      <?php settings_errors(); ?>

      <nav class="nav-tab-wrapper" style="margin-bottom: 22px;">
        <?php foreach ( $tabs as $tab_key =>$tab_name ) : ?>
          <a href="<?php echo esc_url( add_query_arg( [ 'page' => 'sportlixa-settings', 'tab' => $tab_key ], admin_url( 'themes.php' ) ) ); ?>" 
             class="nav-tab <?php echo ( $active_tab ===$tab_key ) ? 'nav-tab-active' : ''; ?>">
            <?php echo esc_html( $tab_name ); ?>
          </a>
        <?php endforeach; ?>
      </nav>

      <form action="options.php" method="post" style="background:#fff; border:1px solid #ccd0d4; padding:22px 28px; border-radius:6px; max-width:900px; box-shadow:0 1px 3px rgba(0,0,0,0.04);">
        <input type="hidden" name="sportlixa_tab_submitted" value="<?php echo esc_attr( $active_tab ); ?>" />
        <?php
        settings_fields( 'sportlixa_options_group' );
        do_settings_sections( 'sportlixa-settings-' . $active_tab );
        submit_button( __( 'Save Changes', 'sportlixa' ) );
        ?>
      </form>
    </div>

    <style>
      .sportlixa-repeater-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 16px;
        margin-bottom: 14px;
      }
      .sportlixa-repeater-row {
        display: flex;
        gap: 16px;
        margin-bottom: 12px;
      }
      .sportlixa-repeater-col {
        flex: 1;
      }
      .sportlixa-repeater-row.full-width .sportlixa-repeater-col {
        flex: 100%;
      }
      .sportlixa-repeater-card label {
        display: block;
        font-weight: 600;
        font-size: 12px;
        margin-bottom: 4px;
        color: #334155;
      }
      .sportlixa-repeater-card input[type="text"],
      .sportlixa-repeater-card input[type="url"],
      .sportlixa-repeater-card select,
      .sportlixa-repeater-card textarea {
        width: 100%;
        max-width: 100%;
      }
    </style>
    <?php
}

/**
 * 9. Global Helper Functions to Use in Front-end Templates
 */
function sportlixa_get_option( $key, $default = '' ) {$options = get_option( 'sportlixa_options', [] );
    return ( isset( $options[ $key ] ) && '' !==$options[ $key ] ) ?$options[ $key ] :$default;
}

/**
 * Helper to query Featured Posts flagged in admin
 */
function sportlixa_get_featured_posts( $count = 4 ) {$ids = sportlixa_get_option( 'featured_post_ids', [] );
    if ( empty( $ids ) ) {
        return new WP_Query( [ 'posts_per_page' => $count, 'post_status' => 'publish' ] );
    }
    return new WP_Query( [
        'post__in'       => $ids,
        'orderby'        => 'post__in',
        'posts_per_page' => $count,
        'post_status'    => 'publish',
    ] );
}

/**
 * Helper to query Top Stories flagged in admin
 */
function sportlixa_get_top_stories_posts( $count = 6 ) {$ids = sportlixa_get_option( 'top_story_post_ids', [] );
    if ( empty( $ids ) ) {
        return new WP_Query( [ 'posts_per_page' => $count, 'post_status' => 'publish' ] );
    }
    return new WP_Query( [
        'post__in'       => $ids,
        'orderby'        => 'post__in',
        'posts_per_page' => $count,
        'post_status'    => 'publish',
    ] );
}

/**
 * Helper to retrieve Injury Wire & Fantasy repeater items
 */
function sportlixa_get_injury_wire_items() {
    $items = sportlixa_get_option( 'injury_wire_items', [] );
    if ( ! empty( $items ) && is_array($items ) ) {
        return $items;
    }
    // Clean fallback sample items if nothing has been saved yet
    return [
        [
            'name'     => 'Rashee Rice',
            'team_pos' => 'Kansas City Chiefs • WR',
            'status'   => 'Questionable',
            'desc'     => 'Hamstring strain sustained during Week 5. Underwent limited walkthroughs on Thursday; game-time decision.',
            'fantasy'  => 'Elevate Xavier Worthy into WR2 slot.',
        ],
        [
            'name'     => 'Lamar Jackson',
            'team_pos' => 'Baltimore Ravens • QB',
            'status'   => 'Probable',
            'desc'     => 'Cleared ankle soreness protocol following negative scan. Full participant in Friday scrimmage.',
            'fantasy'  => 'Must-start QB1 across all standard & DFS formats.',
        ],
        [
            'name'     => 'Christian McCaffrey',
            'team_pos' => 'San Francisco 49ers • RB',
            'status'   => 'Out (IR)',
            'desc'     => 'Remains on designated short-term injured reserve recovering from Achilles tendinitis.',
            'fantasy'  => 'Jordan Mason retains lead bellcow carries.',
        ],
    ];
}

/**
 * Helper to retrieve Video repeater items
 */
function sportlixa_get_video_items() {
    $items = sportlixa_get_option( 'video_items', [] );
    if ( ! empty( $items ) && is_array($items ) ) {
        return $items;
    }
    // Clean fallback sample video if none saved yet
    return [
        [
            'title'     => 'Top 10 Plays of the Week',
            'duration'  => '04:32',
            'thumb'     => 'https://images.unsplash.com/photo-1546519638-68e109498ffc?auto=format&fit=crop&w=800&q=80',
            'embed_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1',
            'meta'      => 'Oct 5, 2026 • 2.4K views',
        ],
    ];
}