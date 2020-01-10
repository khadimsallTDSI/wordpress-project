<?php
/**
 * Opus Blog functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Opus_Blog
 */

if (!function_exists('opus_blog_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function opus_blog_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Opus Blog, use a find and replace
         * to change 'opus-blog' to the name of your theme in all the template files.
         */
        load_theme_textdomain('opus-blog');
        
        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');
        
        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');
        
        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');
        
        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'menu-1' => esc_html__('Primary', 'opus-blog'),
            'top' => esc_html__('Top Header', 'opus-blog'),
            'footer' => esc_html__('Footer Menu', 'opus-blog'),
            'social' => esc_html__('Social Icons', 'opus-blog'),
        ));
        
        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));
        
        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('opus_blog_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));
        
        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');
        
        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo', array(
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        ));

        /**
         * Add theme support for New Image
         *
         * @link https://developer.wordpress.org/reference/functions/add_image_size/
         */
        
        add_image_size('opus-blog-thumbnail-size', 800, 800, true); // Blog Left Images
        add_image_size('opus-blog-related-size', 600, 400, true); // Blog Related Post Images

        /**
         * Add theme support for WooCommerce
         *
         * @link https://wordpress.org/plugins/woocommerce/
         */
        add_theme_support('woocommerce');
        
        /*
        * Enable support for Post Formats.
        *
        * See: https://codex.wordpress.org/Post_Formats
        */
        add_theme_support('post-formats', array(
            'aside',
            'image',
            'video',
            'quote',
            'link',
            'gallery',
            'status',
            'audio',
            'chat',
        ));
    
        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );
    
        // Add support for responsive embedded content.
        add_theme_support( 'responsive-embeds' );
    
        // Add support for default block styles.
        add_theme_support( 'wp-block-styles' );
    
        /*
         * Add support custom font sizes.
         *
         * Add the line below to disable the custom color picker in the editor.
         * add_theme_support( 'disable-custom-font-sizes' );
         */
        add_theme_support(
            'editor-font-sizes',
            array(
                array(
                    'name'      => __( 'Small', 'opus-blog' ),
                    'shortName' => __( 'S', 'opus-blog' ),
                    'size'      => 15,
                    'slug'      => 'small',
                ),
                array(
                    'name'      => __( 'Medium', 'opus-blog' ),
                    'shortName' => __( 'M', 'opus-blog' ),
                    'size'      => 25,
                    'slug'      => 'medium',
                ),
                array(
                    'name'      => __( 'Large', 'opus-blog' ),
                    'shortName' => __( 'L', 'opus-blog' ),
                    'size'      => 31,
                    'slug'      => 'large',
                ),
                array(
                    'name'      => __( 'Larger', 'opus-blog' ),
                    'shortName' => __( 'XL', 'opus-blog' ),
                    'size'      => 39,
                    'slug'      => 'larger',
                ),
            )
        );
    }
endif;
add_action('after_setup_theme', 'opus_blog_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function opus_blog_content_width()
{
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters('opus_blog_content_width', 640);
}

add_action('after_setup_theme', 'opus_blog_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function opus_blog_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'opus-blog'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'opus-blog'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    
    register_sidebar(array(
        'name' => esc_html__('Footer One', 'opus-blog'),
        'id' => 'footer-1',
        'description' => esc_html__('Add widgets here.', 'opus-blog'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    
    register_sidebar(array(
        'name' => esc_html__('Footer Two', 'opus-blog'),
        'id' => 'footer-2',
        'description' => esc_html__('Add widgets here.', 'opus-blog'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    
    register_sidebar(array(
        'name' => esc_html__('Footer Three', 'opus-blog'),
        'id' => 'footer-3',
        'description' => esc_html__('Add widgets here.', 'opus-blog'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    
    register_sidebar(array(
        'name' => esc_html__('Footer Four', 'opus-blog'),
        'id' => 'footer-4',
        'description' => esc_html__('Add widgets here.', 'opus-blog'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}
add_action('widgets_init', 'opus_blog_widgets_init');

if ( ! function_exists( 'opus_blog_fonts_url' ) ) {
    /**
     * Register custom fonts.
     * Credits:
     * Twenty Seventeen WordPress Theme, Copyright 2016 WordPress.org
     * Twenty Seventeen is distributed under the terms of the GNU GPL
     */
    function opus_blog_fonts_url() {
        $fonts_url = '';
        
        $font_families   = array();
    
        global $opus_blog_theme_options;
    
        $font_families[] = $opus_blog_theme_options['opus-blog-font-family-name-cast'];
        $font_families[] = 'Source+Sans+Pro:400,600,600i,700,700i,900,900i';
        
        $font_families = array_unique( $font_families );
        
        $query_args = array(
            'family' => rawurlencode( implode( '|', $font_families ) ),
            'subset' => rawurlencode( 'latin,latin-ext' ),
        );
        
        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
        
        return esc_url_raw( $fonts_url );
    }
}

/**
 * Enqueue scripts and styles.
 */
function opus_blog_scripts()
{
    
    /*google font  */
    global $opus_blog_theme_options;
    
    $opus_blog_google_fonts_name = opus_blog_google_fonts();
    $opus_blog_body_fonts = $opus_blog_theme_options['opus-blog-font-family-name-cast'];
    $opus_blog_body_font = $opus_blog_google_fonts_name[$opus_blog_body_fonts];
    $opus_blog_google_fonts_enqueue = array(
        $opus_blog_body_font );
    $opus_blog_google_fonts_enqueue_uniques = (array_unique($opus_blog_google_fonts_enqueue));
    foreach( $opus_blog_google_fonts_enqueue_uniques as $opus_blog_google_fonts_enqueue_unique ){
        wp_enqueue_style( $opus_blog_google_fonts_enqueue_unique, '//fonts.googleapis.com/css?family='.$opus_blog_google_fonts_enqueue_unique.'', array(), '' );
    }
    /*body  */
    wp_enqueue_style('opus-blog-body', '//fonts.googleapis.com/css?family=Lora&display=swap', array(), null);
    /*heading  */
    wp_enqueue_style('opus-blog-heading', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,600i,700,700i,900,900i&display=swap', array(), null);
    /*Author signature google font  */
    wp_enqueue_style('opus-blog-sign', '//fonts.googleapis.com/css?family=Monsieur+La+Doulaise&display=swap', array(), null);
    
    //*Font-Awesome-master*/
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.5.0');
    
    wp_enqueue_style('grid-css', get_template_directory_uri() . '/css/grid.min.css', array(), '4.5.0');
    
    /*Slick CSS*/
    wp_enqueue_style('slick', get_template_directory_uri() . '/assets/css/slick.css', array(), '4.5.0');

    
    
    $masonry = esc_attr($opus_blog_theme_options['opus-blog-column-blog-page']);
    if ('masonry-post' == $masonry) {
        wp_enqueue_script('masonry');
        wp_enqueue_script('opus-blog-custom-masonry', get_template_directory_uri() . '/assets/js/custom-masonry.js', array('jquery'), '4.6.0');
    }

    wp_enqueue_style('opus-blog-style', get_stylesheet_uri());

    wp_style_add_data( 'opus-blog-style', 'rtl', 'replace' );

    
    /*imagesloaded JS*/
    wp_enqueue_script('imagesloaded', get_template_directory_uri() . '/assets/js/imagesloaded.js', array('jquery'), '4.6.0');
    
    wp_enqueue_script('opus-blog-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true);
    
    /*Slick JS*/
    wp_enqueue_script('slick', get_template_directory_uri() . '/assets/js/slick.js', array('jquery'), '4.6.0');
    
    wp_enqueue_script('opus-blog-script', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), '20151215', true);
    
    /*Sticky Menu*/
    if (1 == absint($opus_blog_theme_options['opus_blog_enable_sticky_menu'])) {
        wp_enqueue_script('opus-blog-sticky-menu', get_template_directory_uri() . '/assets/js/sticky-menu.js', array('jquery'), '20151215', true);
    }
    /*Custom Scripts*/
    wp_enqueue_script('opus-blog-custom', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), '20151215', true);
    
    wp_enqueue_script('opus-blog-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array('jquery'), '20151215', true);
    
    /*Sticky Sidebar*/
    global $opus_blog_theme_options;
    if (1 == absint($opus_blog_theme_options['opus-blog-enable-sticky-sidebar'])) {
        wp_enqueue_script('theia-sticky-sidebar', get_template_directory_uri() . '/assets/js/theia-sticky-sidebar.js', array('jquery'), '20151215', true);
        wp_enqueue_script('opus-blog-sticky-sidebar', get_template_directory_uri() . '/assets/js/custom-sticky-sidebar.js', array('jquery'), '20151215', true);
        
    }
    
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'opus_blog_scripts',1);

function opus_blog_remove_scripts() {
    wp_dequeue_style( 'slick-theme' );
}
add_action( 'wp_enqueue_scripts', 'opus_blog_remove_scripts', 999 );

/**
 * By default gutentor use fontawesome 5
 * Changing default gutentor fontawesome to 4
 *
 * @param  array  $defaults, All default options of gutentor
 * @return array $defaults, modified version of default
 */
function opus_blog_gutentor_alter_default_options( $defaults ) {
    $defaults['gutentor_font_awesome_version'] = 4;/*default is fontawesome 5, we change here 4*/
    return $defaults;
}
add_action( 'gutentor_default_options', 'opus_blog_gutentor_alter_default_options', 999 );

if ( ! function_exists( 'opus_blog_editor_css' ) ) {
    /**
     * Add styles and fonts for the editor.
     */
    function opus_blog_editor_css() {
        wp_enqueue_style( 'opus-blog-fonts', opus_blog_fonts_url(), array(), null );
        wp_enqueue_style( 'opus-blog-editor-blocks', get_template_directory_uri().'/css/block-editor.css' , false );
    }
    add_action( 'enqueue_block_editor_assets', 'opus_blog_editor_css' );
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/getting-started.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load custom functions file
 */
require get_template_directory() . '/inc/custom-functions.php';

/**
 * Load sanitize functions file
 */
require get_template_directory() . '/inc/sanitize-functions.php';

/**
 * Load category dropdown functions
 */
require get_template_directory() . '/inc/customizer-category-control.php';

/**
 * Dynamic CSS file load
 */
require get_template_directory() . '/inc/dynamic-css.php';

/**
 * Load custom widgets
 */
require get_template_directory() . '/inc/widgets/widget-init.php';
require get_template_directory() . '/inc/widgets/aki-author-widget.php';
require get_template_directory() . '/inc/widgets/aki-featured-posts-widget.php';
require get_template_directory() . '/inc/widgets/aki-social-widget.php';

/**
* Load Update to Pro section
*/
require get_template_directory() . '/inc/upgrade-to-pro/class-customize.php';

// Update CSS within in Admin
function opus_blog_admin_style() {
  wp_enqueue_style('opus-blog-about', get_template_directory_uri() . '/css/about.css', array(), '4.5.0');
}
add_action('admin_enqueue_scripts', 'opus_blog_admin_style');