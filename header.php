<?php
/**
 * Header Template - Fully Dynamic Menus, Theme Settings & Native SEO Engine
 *
 * @package Sportlixa
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?> data-theme="<?php echo esc_attr( apply_filters( 'sportlixa_initial_theme', 'dark' ) ); ?>">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php
	/* ==========================================================================
	   SPORTLIXA NATIVE SEO & OPEN GRAPH ENGINE
	   ========================================================================== */
	$has_seo_plugin = (
		defined( 'WPSEO_VERSION' ) ||             // Yoast SEO
		defined( 'RANK_MATH_VERSION' ) ||         // Rank Math
		defined( 'AIOSEO_VERSION' ) ||            // All in One SEO
		defined( 'SEOPRESS_VERSION' ) ||          // SEOPress
		class_exists( 'The_SEO_Framework\Load' )  // The SEO Framework
	);

	if ( ! $has_seo_plugin ) :
		global $post;

		$seo_site_name   = get_bloginfo( 'name' );
		$seo_title       = wp_get_document_title();
		$seo_description = get_bloginfo( 'description' );
		$seo_canonical   = home_url( '/' );
		$seo_type        = 'website';
		$seo_image       = get_template_directory_uri() . '/assets/img/logo.png';

		if ( is_singular() && ! empty( $post ) ) {
			$seo_type      = 'article';
			$seo_canonical = get_permalink( $post->ID );

			if ( has_excerpt( $post->ID ) ) {
				$seo_description = wp_strip_all_tags( get_the_excerpt( $post->ID ) );
			} else {
				$raw_content     = wp_strip_all_tags( strip_shortcodes( $post->post_content ) );
				$seo_description = ! empty( $raw_content ) ? wp_trim_words( $raw_content, 26, '...' ) : $seo_description;
			}

			if ( has_post_thumbnail( $post->ID ) ) {
				$thumb_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
				if ( ! empty( $thumb_src[0] ) ) {
					$seo_image = $thumb_src[0];
				}
			}
		} elseif ( is_category() || is_tag() || is_tax() ) {
			$term_desc       = wp_strip_all_tags( term_description() );
			$seo_description = ! empty( $term_desc ) ? $term_desc : $seo_description;
			$queried_obj     = get_queried_object();
			if ( ! empty( $queried_obj ) && ! is_wp_error( get_term_link( $queried_obj ) ) ) {
				$seo_canonical = get_term_link( $queried_obj );
			}
		} elseif ( is_author() ) {
			$author_obj      = get_queried_object();
			$author_bio      = ! empty( $author_obj->description ) ? wp_strip_all_tags( $author_obj->description ) : '';
			$seo_description = ! empty( $author_bio ) ? $author_bio : $seo_description;
			if ( ! empty( $author_obj->ID ) ) {
				$seo_canonical = get_author_posts_url( $author_obj->ID );
			}
		}
		?>
	<!-- Sportlixa Native SEO Engine -->
	<meta name="description" content="<?php echo esc_attr( $seo_description ); ?>">
	<link rel="canonical" href="<?php echo esc_url( $seo_canonical ); ?>">

	<!-- Open Graph Protocol -->
	<meta property="og:site_name" content="<?php echo esc_attr( $seo_site_name ); ?>">
	<meta property="og:type" content="<?php echo esc_attr( $seo_type ); ?>">
	<meta property="og:title" content="<?php echo esc_attr( $seo_title ); ?>">
	<meta property="og:description" content="<?php echo esc_attr( $seo_description ); ?>">
	<meta property="og:url" content="<?php echo esc_url( $seo_canonical ); ?>">
	<meta property="og:image" content="<?php echo esc_url( $seo_image ); ?>">
	<meta property="og:locale" content="<?php echo esc_attr( get_locale() ); ?>">

	<!-- Twitter Cards -->
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="<?php echo esc_attr( $seo_title ); ?>">
	<meta name="twitter:description" content="<?php echo esc_attr( $seo_description ); ?>">
	<meta name="twitter:image" content="<?php echo esc_url( $seo_image ); ?>">
		<?php
		$seo_twitter_user = function_exists( 'sportlixa_get_option' ) ? sportlixa_get_option( 'twitter_handle', '' ) : '';
		if ( ! empty( $seo_twitter_user ) ) :
			?>
	<meta name="twitter:site" content="@<?php echo esc_attr( ltrim( $seo_twitter_user, '@' ) ); ?>">
		<?php endif; ?>
	<!-- End Sportlixa Native SEO Engine -->
	<?php endif; ?>

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

	<!-- Reading Progress Bar -->
	<div class="devnahian-sportlixa-progress-line" id="devnahian-sportlixa-progressLine"></div>

	<!-- HUD Toast Notification -->
	<div class="devnahian-sportlixa-toast" id="devnahian-sportlixa-toast" role="alert" aria-live="polite">
		<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--devnahian-sportlixa-brand-volt)" stroke-width="3" aria-hidden="true" focusable="false"><polyline points="20 6 9 17 4 12"/></svg>
		<span id="devnahian-sportlixa-toast-msg"><?php esc_html_e( 'Action completed', 'sportlixa' ); ?></span>
	</div>

	<!-- Back to Top Floating Button -->
	<button type="button" class="devnahian-sportlixa-back-to-top" id="devnahian-sportlixa-backToTop" aria-label="<?php esc_attr_e( 'Scroll Back to Top', 'sportlixa' ); ?>">
		<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true" focusable="false"><polyline points="18 15 12 9 6 15"/></svg>
	</button>

	<!-- ==========================================================================
	     LATEST NEWS TICKER
	     ========================================================================== -->
	<?php if ( function_exists( 'sportlixa_get_option' ) ? sportlixa_get_option( 'enable_news_ticker', 1 ) : 1 ) : ?>
	<div class="devnahian-sportlixa-news-ticker-bar">
		<div class="devnahian-sportlixa-ticker-badge-wrap">
			<span class="devnahian-sportlixa-ticker-pulse-dot" aria-hidden="true"></span>
			<span><?php echo esc_html( function_exists( 'sportlixa_get_option' ) ? sportlixa_get_option( 'ticker_badge_label', __( 'Latest News', 'sportlixa' ) ) : __( 'Latest News', 'sportlixa' ) ); ?></span>
		</div>
		<div class="devnahian-sportlixa-ticker-marquee-box">
			<div class="devnahian-sportlixa-ticker-track">
				<?php
				$ticker_count = function_exists( 'sportlixa_get_option' ) ? (int) sportlixa_get_option( 'ticker_post_count', 6 ) : 6;
				$sportlixa_ticker = new WP_Query( [
					'posts_per_page'      => $ticker_count > 0 ? $ticker_count : 6,
					'post_status'         => 'publish',
					'ignore_sticky_posts' => 1,
					'no_found_rows'       => true,
				] );

				if ( $sportlixa_ticker->have_posts() ) :
					while ( $sportlixa_ticker->have_posts() ) :
						$sportlixa_ticker->the_post();
						$cats      = get_the_category();
						$cat_badge = ( ! empty( $cats ) && isset( $cats[0]->name ) ) ? esc_html( $cats[0]->name ) : esc_html__( 'Live', 'sportlixa' );
						?>
						<a href="<?php the_permalink(); ?>" class="devnahian-sportlixa-ticker-item">
							<span class="tag"><?php echo $cat_badge; ?></span>
							<?php the_title(); ?>
							<span class="sep" aria-hidden="true">&bull;</span>
						</a>
						<?php
					endwhile;
					wp_reset_postdata();
				else :
					?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="devnahian-sportlixa-ticker-item">
						<span class="tag"><?php esc_html_e( 'SPORTLIXA', 'sportlixa' ); ?></span>
						<?php esc_html_e( 'Your Sports. Your Game. Your Edge.', 'sportlixa' ); ?>
						<span class="sep" aria-hidden="true">&bull;</span>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<!-- ==========================================================================
	     MOBILE DRAWER
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
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo.png' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
					</a>
				<?php endif; ?>
			</div>
			<button type="button" class="devnahian-sportlixa-drawer-close-btn" id="devnahian-sportlixa-drawerCloseBtn" aria-label="<?php esc_attr_e( 'Close Navigation', 'sportlixa' ); ?>">
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true" focusable="false">
					<line x1="18" y1="6" x2="6" y2="18"/>
					<line x1="6" y1="6" x2="18" y2="18"/>
				</svg>
			</button>
		</div>

		<div class="devnahian-sportlixa-drawer-content">
			<?php
			$drawer_location = has_nav_menu( 'drawer-menu' ) ? 'drawer-menu' : ( has_nav_menu( 'primary-menu' ) ? 'primary-menu' : '' );

			if ( ! empty( $drawer_location ) ) :
				$drawer_args = [
					'theme_location' => $drawer_location,
					'container'      => false,
					'items_wrap'     => '%3$s',
				];

				if ( class_exists( 'Sportlixa_Drawer_Nav_Walker' ) ) {
					$drawer_args['walker'] = new Sportlixa_Drawer_Nav_Walker();
				}

				wp_nav_menu( $drawer_args );
			else :
				?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="devnahian-sportlixa-mobile-nav-link active">
					<span><?php esc_html_e( 'Home', 'sportlixa' ); ?></span>
					<svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" aria-hidden="true" focusable="false"><polyline points="9 18 15 12 9 6"/></svg>
				</a>
			<?php endif; ?>
		</div>
	</aside>

	<!-- ==========================================================================
	     HEADER & DIRECT NAVBAR
	     ========================================================================== -->
	<header class="site-header">
		<div class="devnahian-sportlixa-container">
			<div class="devnahian-sportlixa-header-top">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="devnahian-sportlixa-brand-logo-wrap" rel="home">
					<?php
					if ( has_custom_logo() ) :
						the_custom_logo();
					else :
						?>
						<div class="devnahian-sportlixa-brand-title">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo.png' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
						</div>
					<?php endif; ?>
				</a>

				<div class="devnahian-sportlixa-header-actions">
					<div class="devnahian-sportlixa-social-links">
						<?php
						$twitter_url   = function_exists( 'sportlixa_get_option' ) ? sportlixa_get_option( 'twitter_url', '' ) : '';
						$facebook_url  = function_exists( 'sportlixa_get_option' ) ? sportlixa_get_option( 'facebook_url', '' ) : '';
						$instagram_url = function_exists( 'sportlixa_get_option' ) ? sportlixa_get_option( 'instagram_url', '' ) : '';
						$youtube_url   = function_exists( 'sportlixa_get_option' ) ? sportlixa_get_option( 'youtube_url', '' ) : '';

						if ( ! empty( $twitter_url ) ) :
							?>
							<a href="<?php echo esc_url( $twitter_url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'X Twitter', 'sportlixa' ); ?>"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg></a>
						<?php endif; if ( ! empty( $facebook_url ) ) : ?>
							<a href="<?php echo esc_url( $facebook_url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Facebook', 'sportlixa' ); ?>"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false"><path d="M9 8H6v4h3v12h5V12h3.642L18 8h-4V6.333C14 5.374 14.5 5 15.5 5H18V0h-3.808C10.595 0 9 1.583 9 4.615V8z"/></svg></a>
						<?php endif; if ( ! empty( $instagram_url ) ) : ?>
							<a href="<?php echo esc_url( $instagram_url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Instagram', 'sportlixa' ); ?>"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg></a>
						<?php endif; if ( ! empty( $youtube_url ) ) : ?>
							<a href="<?php echo esc_url( $youtube_url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'YouTube', 'sportlixa' ); ?>"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg></a>
						<?php endif; ?>
					</div>

					<!-- Theme Switcher Button -->
					<button type="button" class="devnahian-sportlixa-theme-toggle-btn" id="devnahian-sportlixa-themeToggle" aria-label="<?php esc_attr_e( 'Toggle Theme', 'sportlixa' ); ?>">
						<svg class="sun-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
						<svg class="moon-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
					</button>

					<!-- Interactive Search Launcher -->
					<div class="devnahian-sportlixa-search-launcher" id="devnahian-sportlixa-searchLauncher" role="button" tabindex="0" aria-label="<?php esc_attr_e( 'Search articles and scores', 'sportlixa' ); ?>">
						<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true" focusable="false"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
						<span><?php esc_html_e( 'Search...', 'sportlixa' ); ?></span>
						<span class="devnahian-sportlixa-search-kbd">&#8984;K</span>
					</div>

					<button type="button" class="devnahian-sportlixa-mobile-menu-trigger" id="devnahian-sportlixa-mobileMenuTrigger" aria-label="<?php esc_attr_e( 'Open Navigation Drawer', 'sportlixa' ); ?>">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true" focusable="false"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
					</button>
				</div>
			</div>

			<!-- Direct Navbar Links (Dynamic 'primary-menu') -->
			<nav class="devnahian-sportlixa-navbar" aria-label="<?php esc_attr_e( 'Primary Navigation', 'sportlixa' ); ?>">
				<?php
				if ( has_nav_menu( 'primary-menu' ) ) :
					$nav_args = [
						'theme_location' => 'primary-menu',
						'container'      => false,
						'items_wrap'     => '%3$s',
					];

					if ( class_exists( 'Sportlixa_Desktop_Nav_Walker' ) ) {
						$nav_args['walker'] = new Sportlixa_Desktop_Nav_Walker();
					}

					wp_nav_menu( $nav_args );
				else :
					?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="devnahian-sportlixa-nav-link active"><?php esc_html_e( 'HOME', 'sportlixa' ); ?></a>
				<?php endif; ?>
			</nav>
		</div>

		<!-- Quick Touch League Bar (Dynamic 'league-chips') -->
		<?php if ( function_exists( 'sportlixa_get_option' ) ? sportlixa_get_option( 'enable_league_chips', 1 ) : 1 ) : ?>
		<div class="devnahian-sportlixa-mobile-chips-bar" aria-label="<?php esc_attr_e( 'League Filter Bar', 'sportlixa' ); ?>">
			<?php
			if ( has_nav_menu( 'league-chips' ) ) :
				$chips_args = [
					'theme_location' => 'league-chips',
					'container'      => false,
					'items_wrap'     => '%3$s',
				];

				if ( class_exists( 'Sportlixa_League_Chips_Walker' ) ) {
					$chips_args['walker'] = new Sportlixa_League_Chips_Walker();
				}

				wp_nav_menu( $chips_args );
			else :
				$cats = get_categories( [
					'number'     => 8,
					'orderby'    => 'count',
					'order'      => 'DESC',
					'hide_empty' => true,
				] );

				$is_front = is_home() || is_front_page();
				echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="devnahian-sportlixa-league-chip ' . ( $is_front ? 'active' : '' ) . '">' . esc_html__( 'All', 'sportlixa' ) . '</a>';

				if ( ! is_wp_error( $cats ) && ! empty( $cats ) ) {
					foreach ( $cats as $cat ) {
						$active = is_category( $cat->term_id ) ? 'active' : '';
						echo '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '" class="devnahian-sportlixa-league-chip ' . esc_attr( $active ) . '">' . esc_html( $cat->name ) . '</a>';
					}
				}
			endif;
			?>
		</div>
		<?php endif; ?>
	</header>