<?php
/**
 * Sportlixa Theme Functions & Dynamic Menu System
 *
 * @package Sportlixa
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Theme Supports & All 7 Navigation Menu Locations
 */
function sportlixa_setup() {
    load_theme_textdomain( 'sportlixa', get_template_directory() . '/languages' );

    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ] );
    add_theme_support( 'custom-logo', [
        'height'      => 80,
        'width'       => 280,
        'flex-height' => true,
        'flex-width'  => true,
    ] );

    register_nav_menus( [
        'primary-menu'       => esc_html__( 'Primary Desktop Navigation', 'sportlixa' ),
        'drawer-menu'        => esc_html__( 'Mobile Drawer Navigation', 'sportlixa' ),
        'league-chips'       => esc_html__( 'Mobile Quick Chips Bar', 'sportlixa' ),
        'mobile-bottom-bar'  => esc_html__( 'Mobile Bottom App Bar', 'sportlixa' ),
        'footer-quick-links' => esc_html__( 'Footer: Quick Links (Col 2)', 'sportlixa' ),
        'footer-more'        => esc_html__( 'Footer: More (Col 3)', 'sportlixa' ),
        'footer-legal'       => esc_html__( 'Footer: Legal (Col 4)', 'sportlixa' ),
    ] );
}
add_action( 'after_setup_theme', 'sportlixa_setup' );

/**
 * Enqueue Styles & Scripts for Sportlixa
 */
function sportlixa_enqueue_scripts() {
    $theme_version = wp_get_theme()->get( 'Version' );

    // 1. Google Fonts Montserrat
    wp_enqueue_style( 
        'sportlixa-google-fonts', 
        'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,700;1,800;1,900&display=swap', 
        [], 
        null 
    );

    // 2. Custom Stylesheet (assets/css/style.css)
    wp_enqueue_style( 
        'sportlixa-custom-style', 
        get_template_directory_uri() . '/assets/css/style.css', 
        [ 'sportlixa-google-fonts' ], 
        $theme_version 
    );

    // 3. Main Theme Root Stylesheet (style.css - contains theme header data)
    wp_enqueue_style( 
        'sportlixa-theme-style', 
        get_stylesheet_uri(), 
        [ 'sportlixa-custom-style' ], 
        $theme_version 
    );

    // 4. Main JavaScript (assets/js/main.js)
    wp_enqueue_script( 
        'sportlixa-main-script', 
        get_template_directory_uri() . '/assets/js/main.js', 
        [], 
        $theme_version, 
        true 
    );
}
add_action( 'wp_enqueue_scripts', 'sportlixa_enqueue_scripts' );

/**
 * Add Preconnect hints for Google Fonts performance
 */
function sportlixa_resource_hints( $urls, $relation_type ) {
    if ( wp_style_is( 'sportlixa-google-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
        $urls[] = [
            'href' => 'https://fonts.googleapis.com',
        ];
        $urls[] = [
            'href'        => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        ];
    }
    return $urls;
}
add_filter( 'wp_resource_hints', 'sportlixa_resource_hints', 10, 2 );

/* ==========================================================================
   CUSTOM MENU WALKERS
   ========================================================================== */

/**
 * 1. Desktop Navbar Walker
 */
class Sportlixa_Desktop_Nav_Walker extends Walker_Nav_Menu {
    public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
        $classes   = empty( $data_object->classes ) ? [] : (array) $data_object->classes;
        $is_active = in_array( 'current-menu-item', $classes ) || in_array( 'current_page_item', $classes );

        $class_names = 'devnahian-sportlixa-nav-link' . ( $is_active ? ' active' : '' );
        $url         = ! empty( $data_object->url ) ? esc_url( $data_object->url ) : '#';

        $output .= '<a href="' . $url . '" class="' . esc_attr( $class_names ) . '">' . esc_html( $data_object->title ) . '</a>';
    }
}

/**
 * 2. Mobile Drawer Navigation Walker
 */
class Sportlixa_Drawer_Nav_Walker extends Walker_Nav_Menu {
    public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
        $classes   = empty( $data_object->classes ) ? [] : (array) $data_object->classes;
        $is_active = in_array( 'current-menu-item', $classes ) || in_array( 'current_page_item', $classes );

        $class_names = 'devnahian-sportlixa-mobile-nav-link' . ( $is_active ? ' active' : '' );
        $url         = ! empty( $data_object->url ) ? esc_url( $data_object->url ) : '#';

        $output .= '<a href="' . $url . '" class="' . esc_attr( $class_names ) . '">';
        $output .= '<span>' . esc_html( $data_object->title ) . '</span>';
        $output .= '<svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>';
        $output .= '</a>';
    }
}

/**
 * 3. Mobile Quick Chips Walker
 */
class Sportlixa_League_Chips_Walker extends Walker_Nav_Menu {
    public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
        $classes   = empty( $data_object->classes ) ? [] : (array) $data_object->classes;
        $is_active = in_array( 'current-menu-item', $classes ) || in_array( 'current_page_item', $classes );

        $class_names = 'devnahian-sportlixa-league-chip' . ( $is_active ? ' active' : '' );
        $url         = ! empty( $data_object->url ) ? esc_url( $data_object->url ) : '#';

        $output .= '<a href="' . $url . '" class="' . esc_attr( $class_names ) . '">' . esc_html( $data_object->title ) . '</a>';
    }
}

/**
 * 4. Mobile Bottom App Bar Walker (Injects dynamic athletic SVG icons)
 */
class Sportlixa_Bottom_Bar_Nav_Walker extends Walker_Nav_Menu {
    public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
        $classes   = empty( $data_object->classes ) ? [] : (array) $data_object->classes;
        $is_active = in_array( 'current-menu-item', $classes ) || in_array( 'current_page_item', $classes );
        $class_names = 'devnahian-sportlixa-bottom-bar-item' . ( $is_active ? ' active' : '' );
        $url       = ! empty( $data_object->url ) ? esc_url( $data_object->url ) : '#';
        $title     = strtolower( trim( $data_object->title ) );

        // Dynamic athletic icon matching
        if ( str_contains( $title, 'score' ) ) {
            $svg = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>';
        } elseif ( str_contains( $title, 'nfl' ) || str_contains( $title, 'league' ) || str_contains( $title, 'cup' ) ) {
            $svg = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>';
        } elseif ( str_contains( $title, 'trend' ) || str_contains( $title, 'hot' ) || str_contains( $title, 'buzz' ) ) {
            $svg = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>';
        } else {
            // Default home/feed icon
            $svg = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>';
        }

        $output .= '<a href="' . $url . '" class="' . esc_attr( $class_names ) . '">';
        $output .= $svg;
        $output .= '<span>' . esc_html( $data_object->title ) . '</span>';
        $output .= '</a>';
    }
}

/**
 * 5. Footer Menu Walker (Injects forward arrow SVGs)
 */
class Sportlixa_Footer_Nav_Walker extends Walker_Nav_Menu {
    public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
        $url   = ! empty( $data_object->url ) ? esc_url( $data_object->url ) : '#';
        $title = esc_html( $data_object->title );

        $output .= '<li>';
        $output .= '<a href="' . $url . '">';
        $output .= '<svg class="devnahian-sportlixa-footer-menu-arrow" viewBox="0 0 24 24" fill="none" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>';
        $output .= '<span>' . $title . '</span>';
        $output .= '</a>';
        $output .= '</li>';
    }
}