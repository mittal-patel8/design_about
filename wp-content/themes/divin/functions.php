<?php
/**
 * Divin functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Divin
 */

if ( ! function_exists( 'divin_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function divin_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Divin, use a find and replace
	 * to change 'divin' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'divin', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for custom logo.
	 *
	 *  @since Divin 1.0
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 100,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	// Divin styles the visual editor to resemble the theme style.
	add_editor_style( array( 'assets/css/editor-style.css', divin_fonts_url() ) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1060, 596, true ); /* Ratio 16:9 */
	add_image_size( 'divin-featured', 664, 373, true ); /* Ratio 16:9 */
	add_image_size( 'divin-slider', 1170, 658, true ); /* Ratio 16:9 */
	add_image_size( 'divin-featured-square', 666, 666, true );  /* Ratio 1:1 */
	add_image_size( 'divin-testimonial', 90, 90, true ); /* Ratio 1:1 */
	add_image_size( 'divin-header', 1920, 1280, true );

	// This theme uses wp_nav_menu() in three location.
	register_nav_menus( array(
		'menu-1'	=> esc_html__( 'Primary Menu', 'divin' ),
		'social'	=> esc_html__( 'Social Menu', 'divin' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	if ( class_exists( 'To_Top' ) ) {
		// Disable Scroll Up option if To Top plugin is activated
		set_theme_mod( 'divin_disable_scrollup', 1 );
	}
}
endif;
add_action( 'after_setup_theme', 'divin_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function divin_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'divin_content_width', 664 );
}
add_action( 'after_setup_theme', 'divin_content_width', 0 );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet for different value other than the default one
 *
 * @global int $content_width
 */
function divin_template_redirect() {
    $layout = divin_get_theme_layout();

    if ( 'no-sidebar-full-width' == $layout ) {
		$GLOBALS['content_width'] = 1060;
	}
}
add_action( 'template_redirect', 'divin_template_redirect' );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function divin_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'divin' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'divin' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'divin' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'divin' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'divin' ),
		'id'            => 'sidebar-3',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'divin' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'divin' ),
		'id'            => 'sidebar-4',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'divin' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'divin_widgets_init' );

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 *
 * @since Divin 0.1
 */
function divin_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-2' ) ) {
		$count++;
	}

	if ( is_active_sidebar( 'sidebar-3' ) ) {
		$count++;
	}

	if ( is_active_sidebar( 'sidebar-4' ) ) {
		$count++;
	}

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
	}

	if ( $class )
		echo 'class="widget-area footer-widget-area ' . $class . '"';
}

if ( ! function_exists( 'divin_fonts_url' ) ) :
/**
 * Register Google fonts for Verity Pro.
 *
 * Create your own divin_fonts_url() function to override in a child theme.
 *
 * @since Verity Pro 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function divin_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	* supported by Cousine, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$cousine = esc_html_x( 'on', 'Cousine font: on or off', 'divin' );

	if ( 'off' === $cousine ) {
		// Return if font is not supported for translation
		return;
	}

	$font = 'Cousine:400,700,900,400italic,700italic,900italic';

	$query_args = array(
		'family' => urlencode( $font ),
		'subset' => urlencode( 'latin,latin-ext' ),
	);

	$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

	return esc_url( $fonts_url );
}
endif;

/**
 * Add preconnect for Google Fonts.
 */
function divin_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'divin-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'divin_resource_hints', 10, 2 );

/**
 * Enqueues scripts and styles.
 *
 * @since Divin 0.1
 */
function divin_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'divin-fonts', divin_fonts_url(), array(), null );

	// Theme stylesheet.
	wp_enqueue_style( 'divin-style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'divin-ie', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'css/ie.css', array( 'divin-style' ), '20160816' );
	wp_style_add_data( 'divin-ie', 'conditional', 'lt IE 10' );

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'divin-ie8', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'css/ie8.css', array( 'divin-style' ), '20160816' );
	wp_style_add_data( 'divin-ie8', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'divin-ie7', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'css/ie7.css', array( 'divin-style' ), '20160816' );
	wp_style_add_data( 'divin-ie7', 'conditional', 'lt IE 8' );

	// Load the html5 shiv.
	wp_enqueue_script( 'divin-html5', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/html5.min.js', array(), '3.7.3' );
	wp_script_add_data( 'divin-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'divin-skip-link-focus-fix', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/skip-link-focus-fix.min.js', array(), '20160816', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'divin-keyboard-image-navigation', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/keyboard-image-navigation.min.js', array( 'jquery' ), '20160816' );
	}

 	wp_register_script( 'jquery-match-height', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/jquery.matchHeight.min.js', array( 'jquery' ), '20151215', true );

	wp_enqueue_script( 'divin-script', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/functions.min.js', array( 'jquery', 'jquery-match-height' ), '20160816', true );

	wp_localize_script( 'divin-script', 'screenReaderText', array(
		'expand'   => esc_html__( 'expand child menu', 'divin' ),
		'collapse' => esc_html__( 'collapse child menu', 'divin' ),
		'icon'     => divin_get_svg( array(
			'icon'     => 'angle-down',
			'fallback' => true,
		) ),
	) );

	//Slider Scripts
	$enable_slider      = get_theme_mod( 'divin_slider_option', 'disabled' );
	$enable_testimonial = get_theme_mod( 'divin_testimonial_option', 'homepage' );

	if ( divin_check_section( $enable_slider ) || divin_check_section( $enable_testimonial ) ) {
		wp_enqueue_script( 'jquery-cycle2', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/jquery.cycle/jquery.cycle2.min.js', array( 'jquery' ), '2.1.5', true );

		$transition_effects = array(
			get_theme_mod( 'divin_slider_transition_effects', 'fade' ),
		);

		/**
		 * Condition checks for additional slider transition plugins
		 */
		// Scroll Vertical transition plugin addition.
		if ( in_array( 'scrollVert', $transition_effects, true ) ) {
			wp_enqueue_script( 'jquery-cycle2-scrollVert', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/jquery.cycle/jquery.cycle2.scrollVert.min.js', array( 'jquery-cycle2' ), '2.1.5', true );
		}

		// Flip transition plugin addition.
		if ( in_array( 'flipHorz', $transition_effects, true ) || in_array( 'flipVert', $transition_effects, true ) ) {
			wp_enqueue_script( 'jquery-cycle2-flip', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/jquery.cycle/jquery.cycle2.flip.min.js', array( 'jquery-cycle2' ), '2.1.5', true );
		}

		// Shuffle transition plugin addition.
		if ( in_array( 'tileSlide', $transition_effects, true ) || in_array( 'tileBlind', $transition_effects, true ) ) {
			wp_enqueue_script( 'jquery-cycle2-tile', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/jquery.cycle/jquery.cycle2.tile.min.js', array( 'jquery-cycle2' ), '2.1.5', true );
		}

		// Shuffle transition plugin addition.
		if ( in_array( 'shuffle', $transition_effects, true ) ) {
			wp_enqueue_script( 'jquery-cycle2-shuffle', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/jquery.cycle/jquery.cycle2.shuffle.min.js', array( 'jquery-cycle2' ), '2.1.5', true );
		}
	}

	// Enqueue fitvid if JetPack is not installed.
	if ( ! class_exists( 'Jetpack' ) ) {
		wp_enqueue_script( 'jquery-fitvids', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/fitvids.min.js', array( 'jquery' ), '1.1', true );
	}

}
add_action( 'wp_enqueue_scripts', 'divin_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path( 'inc/custom-header.php' );

/**
 * Include Header Background Color Options
 */
require get_parent_theme_file_path( 'inc/header-background-color.php' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( 'inc/template-tags.php' );

/**
 * Custom functions that act independently of the theme templates.
 */
require get_parent_theme_file_path( 'inc/extras.php' );

/**
 * Load Jetpack compatibility file.
 */
require get_parent_theme_file_path( 'inc/jetpack.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( 'inc/customizer/customizer.php' );

/**
 * Custom Breadcrumb options
 */
require get_parent_theme_file_path( 'inc/breadcrumb.php' );

/**
 * Custom Breadcrumb options
 */
require get_parent_theme_file_path( 'inc/featured-slider.php' );

/**
 * Custom Breadcrumb options
 */
require get_parent_theme_file_path( 'inc/service.php' );

/**
 * Custom Breadcrumb options
 */
require get_parent_theme_file_path( 'inc/icon-functions.php' );

/**
 * Custom Metabox Options
 */
require get_parent_theme_file_path( 'inc/metabox/metabox.php' );


/**
 * Include the TGM_Plugin_Activation class.
 */
require get_parent_theme_file_path( 'inc/class-tgm-plugin-activation.php' );

/**
 * Register the required plugins for this theme.
 *
 */
function divin_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		// Reading time
		array(
			'name' => 'Reading Time WP',
			'slug' => 'reading-time-wp',
		),
		// Catch Web Tools.
		array(
			'name' => 'Catch Web Tools',
			'slug' => 'catch-web-tools',
		),
		// Catch IDs
		array(
			'name' => 'Catch IDs',
			'slug' => 'catch-ids',
		),
		// Catch Infinite Scroll
		array(
			'name' => 'Catch Infinite Scroll',
			'slug' => 'catch-infinite-scroll',
		),
		// Catch Instagram Feed Gallery Widget.
		array(
			'name' => 'Catch Instagram Feed Gallery & Widget',
			'slug' => 'catch-instagram-feed-gallery-widget',
		),
		// Essential Content types.
		array(
			'name' => 'Essential Content Types',
			'slug' => 'essential-content-types',
		),
		// Essential Widgets.
		array(
			'name' => 'Essential Widgets',
			'slug' => 'essential-widgets',
		),
		// To Top.
		array(
			'name' => 'To top',
			'slug' => 'to-top',
		),
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'divin',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'divin_register_required_plugins' );
