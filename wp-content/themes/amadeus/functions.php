<?php
/**
 * Amadeus functions and definitions
 *
 * @package Amadeus
 */


if ( ! function_exists( 'amadeus_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function amadeus_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Amadeus, use a find and replace
		 * to change 'amadeus' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'amadeus', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Content width
		global $content_width;
		if ( ! isset( $content_width ) ) {
			$content_width = 1040;
		}

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'amadeus-entry-thumb', 750 );
		add_image_size( 'amadeus-slider-size', 1000, 250, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'amadeus' ),
			'social'  => __( 'Social', 'amadeus' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'amadeus_custom_background_args', array(
			'default-color' => 'f7f3f0',
			'default-image' => '',
		) ) );

		/* Add custom logo support */
		add_theme_support( 'custom-logo' );

		/* migrate the old logo option to the new option */
		if ( get_theme_mod( 'site_logo' ) ) {
			$logo = attachment_url_to_postid( get_theme_mod( 'site_logo' ) );
			if ( is_int( $logo ) ) {
				set_theme_mod( 'custom_logo', $logo );
			}
			remove_theme_mod( 'site_logo' );
		}
	}
endif; // amadeus_setup
add_action( 'after_setup_theme', 'amadeus_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function amadeus_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'amadeus' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer left', 'amadeus' ),
		'id'            => 'sidebar-4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer center', 'amadeus' ),
		'id'            => 'sidebar-5',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer right', 'amadeus' ),
		'id'            => 'sidebar-6',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	// Custom widgets
	register_widget( 'Amadeus_Video' );
	register_widget( 'Amadeus_Recent_Comments' );
	register_widget( 'Amadeus_Recent_Posts' );
	register_widget( 'Amadeus_About' );
}
add_action( 'widgets_init', 'amadeus_widgets_init' );

// Custom widgets
require get_template_directory() . '/widgets/video-widget.php';
require get_template_directory() . '/widgets/recent-comments.php';
require get_template_directory() . '/widgets/recent-posts.php';
require get_template_directory() . '/widgets/about-me.php';

/**
 * Enqueue scripts and styles.
 */
function amadeus_scripts() {

	wp_enqueue_style( 'amadeus-bootstrap', get_template_directory_uri() . '/css/bootstrap/css/bootstrap.min.css', array(), true );

	if ( get_theme_mod( 'body_font_name' ) != '' ) {
		wp_enqueue_style( 'amadeus-body-fonts', '//fonts.googleapis.com/css?family=' . esc_attr( get_theme_mod( 'body_font_name' ) ) );
	} else {
		wp_enqueue_style( 'amadeus-body-fonts', '//fonts.googleapis.com/css?family=Noto+Serif:400,700,400italic,700italic' );
	}

	if ( get_theme_mod( 'headings_font_name' ) != '' ) {
		wp_enqueue_style( 'amadeus-headings-fonts', '//fonts.googleapis.com/css?family=' . esc_attr( get_theme_mod( 'headings_font_name' ) ) );
	} else {
		wp_enqueue_style( 'amadeus-headings-fonts', '//fonts.googleapis.com/css?family=Playfair+Display:400,700' );
	}

	wp_enqueue_style( 'amadeus-style', get_stylesheet_uri() );

	wp_enqueue_style( 'amadeus-font-awesome', get_template_directory_uri() . '/fonts/font-awesome.min.css' );

	wp_enqueue_script( 'amadeus-parallax', get_template_directory_uri() . '/js/parallax.min.js', array( 'jquery' ), true );

	wp_enqueue_script( 'amadeus-slicknav', get_template_directory_uri() . '/js/jquery.slicknav.min.js', array( 'jquery' ), true );

	wp_enqueue_script( 'amadeus-fitvids', get_template_directory_uri() . '/js/jquery.fitvids.min.js', array( 'jquery' ), true );

	wp_enqueue_script( 'amadeus-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), true );

	wp_enqueue_script( 'amadeus-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'amadeus-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'amadeus_scripts' );

/**
 * Customizer styles
 */
function amadeus_customizer_styles() {

	wp_enqueue_style( 'amadeus-customizer-styles', get_template_directory_uri() . '/css/customizer.css' );

	wp_enqueue_style( 'amadeus-font-awesome', get_template_directory_uri() . '/fonts/font-awesome.min.css' );

}
add_action( 'customize_controls_print_styles', 'amadeus_customizer_styles' );

/* tgm-plugin-activation */
require_once get_template_directory() . '/class-tgm-plugin-activation.php';

/**
 * TGMPA register
 */
function amadeus_register_required_plugins() {
	$plugins = array(

		array(
			'name'      => 'Nivo Slider Lite',
			'slug'      => 'nivo-slider-lite',
			'required'  => false,
		),

		array(
			'name'      => 'Intergeo Maps - Google Maps Plugin',
			'slug'      => 'intergeo-maps',
			'required'  => false,
		),

		array(
			'name'     => 'Pirate Forms',
			'slug' 	   => 'pirate-forms',
			'required' => false,
		),
	);

	$config = array(
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
		'strings'      => array(
			'page_title'                      => esc_html__( 'Install Required Plugins', 'amadeus' ),
			'menu_title'                      => esc_html__( 'Install Plugins', 'amadeus' ),
			'installing'                      => esc_html__( 'Installing Plugin: %s', 'amadeus' ),
			'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'amadeus' ),
			'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'amadeus' ),
			'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'amadeus' ),
			'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'amadeus' ),
			'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'amadeus' ),
			'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'amadeus' ),
			'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'amadeus' ),
			'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'amadeus' ),
			'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'amadeus' ),
			'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'amadeus' ),
			'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'amadeus' ),
			'return'                          => esc_html__( 'Return to Required Plugins Installer', 'amadeus' ),
			'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'amadeus' ),
			'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'amadeus' ),
			'nag_type'                        => 'updated',
		),
	);

	tgmpa( $plugins, $config );

}
add_action( 'tgmpa_register', 'amadeus_register_required_plugins' );


/**
 * Change the excerpt length
 */
function amadeus_excerpt_length( $length ) {
	$excerpt = get_theme_mod( 'exc_lenght', '55' );
	return $excerpt;
}
add_filter( 'excerpt_length', 'amadeus_excerpt_length', 999 );


/**
 * Footer credits
 */
function amadeus_footer_credits() {
	echo '<a href="' . esc_url( __( 'http://wordpress.org/', 'amadeus' ) ) . '" rel="nofollow">';
	printf( __( 'Proudly powered by %s', 'amadeus' ), 'WordPress' );
	echo '</a>';
	echo '<span class="sep"> | </span>';
	printf( __( 'Theme: %2$s by %1$s.', 'amadeus' ), 'Themeisle', '<a href="http://themeisle.com/themes/amadeus/" rel="nofollow">Amadeus</a>' );
}
add_action( 'amadeus_footer', 'amadeus_footer_credits' );

/**
 * Load html5shiv
 */
function amadeus_html5shiv() {
	echo '<!--[if lt IE 9]>' . "\n";
	echo '<script src="' . esc_url( get_template_directory_uri() . '/js/html5shiv.js' ) . '"></script>' . "\n";
	echo '<![endif]-->' . "\n";
}
add_action( 'wp_head', 'amadeus_html5shiv' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Banner
 */
require get_template_directory() . '/inc/banner.php';

/**
 * Styles
 */
require get_template_directory() . '/inc/styles.php';

/**
 *  Customizer info
 */
require_once get_template_directory() . '/inc/customizer-info/class/class-singleton-customizer-info-section.php';

/**
 * Filter for post's classes.
 *
 * @param array $classes Classes from posts.
 *
 * @return array
 */
function amadeus_post_class( $classes ) {
	global $post;

	$amadeus_index_feat_image = get_theme_mod( 'index_feat_image' );
	$amadeus_post_feat_image = get_theme_mod( 'post_feat_image' );

	if ( ( is_single() && ! empty( $amadeus_post_feat_image ) && ($amadeus_post_feat_image == 1) ) || ( is_home() && ! empty( $amadeus_index_feat_image ) && ($amadeus_index_feat_image == 1) ) ) {
		$classes[] = 'amadeus-image-hidden';
	}

	return $classes;
}
add_filter( 'post_class', 'amadeus_post_class' );
