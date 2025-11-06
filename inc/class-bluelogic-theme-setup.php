<?php
 defined( 'ABSPATH' )  OR die;

 class bluelogicThemeSetup{

    function __construct(){
        
        add_action( 'after_setup_theme', [ $this, 'theme_setup' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'wp_enqueue_scripts' ] );

    }

	/**
	 * All Theme styles and script goes here
	 */
	function wp_enqueue_scripts(){

		wp_enqueue_style( 'style', get_theme_file_uri( '/style.css' ), [], wp_get_theme()->get( 'Version' ) );
		wp_enqueue_style( 'swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', [], wp_get_theme()->get( 'Version' ) );
		wp_enqueue_script( 'swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', [], true, wp_get_theme()->get( 'Version' ) );
		
		wp_enqueue_style( 'aos', "https://unpkg.com/aos@2.3.1/dist/aos.css", [], wp_get_theme()->get( 'Version' ) );
		wp_enqueue_script( 'aos', 'https://unpkg.com/aos@2.3.1/dist/aos.js' , [],true,  wp_get_theme()->get( 'Version' ) );

		wp_enqueue_style( 'main', get_theme_file_uri( '/assets/css/main.min.css' ), [], wp_get_theme()->get( 'Version' ) );
		wp_enqueue_script( 'main', get_theme_file_uri( '/assets/js/main.js' ), ["jquery"],true,  wp_get_theme()->get( 'Version' ) );

	}

    function theme_setup(){
        
        load_theme_textdomain( 'boilerplate-text-domain', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		add_post_type_support( 'page', 'excerpt' );

        /*
		 * Let WordPress manage the document title.
		 * This theme does not use a hard-coded <title> tag in the document head,
		 * WordPress will provide it for us.
		 */
		add_theme_support( 'title-tag' );

        add_theme_support( 'post-thumbnails' );

        register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary menu', 'text-domain' ),
				'footer_1'  => esc_html__( 'Footer menu 1', 'text-domain' ),
			)
		);

        /*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets',
			)
		);

        /*
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		$logo_width  = 300;
		$logo_height = 100;

		add_theme_support(
			'custom-logo',
			array(
				'height'               => $logo_height,
				'width'                => $logo_width,
				'flex-width'           => true,
				'flex-height'          => true,
				'unlink-homepage-logo' => false,
			)
		);

        // Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

        // Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Add support for custom line height controls.
		add_theme_support( 'custom-line-height' );

		// Add support for experimental link color control.
		add_theme_support( 'experimental-link-color' );

		// Add support for experimental cover block spacing.
		add_theme_support( 'custom-spacing' );

		// Add support for experimental cover block spacing.
		add_theme_support( 'woocommerce' );
		
		// Register widget area
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer', 'text-domain' ),
				'id'            => 'footer-1',
				'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'text-domain' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);

    }



 }

 new bluelogicThemeSetup();