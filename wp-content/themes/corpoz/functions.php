<?php 

/**
* corpoz functions and definitions
* @package corpoz
*/

if( ! function_exists( 'corpoz_theme_setup' ) )
{

function corpoz_theme_setup() {
	
    load_theme_textdomain( 'corpoz', get_template_directory() . '/lang' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	
	// Add default title support
	add_theme_support( 'title-tag' ); 		

	// Add default logo support		
    add_theme_support( 'custom-logo' );	

    // To use additional css
	    add_editor_style( 'css/editor-style.css' );		

	
    
	add_theme_support('post-thumbnails');
	
	$defaults = array(
		'default-image'          => get_template_directory_uri() .'/assets/images/banner.jpg',
		'width'                  => 1920,
		'height'                 => 540,
		'uploads'                => true,
		'default-text-color'     => "#fff",
	    'wp-head-callback'       => 'corpoz_header_style',

	);
	add_theme_support( 'custom-header', $defaults );

	/**
	* Set the content width in pixels, based on the theme's design and stylesheet.
	*/
	$GLOBALS['content_width'] = apply_filters( 'corpoz_content_width', 980 );
	
	// Add theme support for Semantic Markup
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption'
	) );
	 
	 add_theme_support( 'customize-selective-refresh-widgets' );
	 
	// add excerpt support for pages
	add_post_type_support( 'page', 'excerpt' );
	
	if ( is_singular() && comments_open() ) {
		wp_enqueue_script( 'comment-reply' );
	}
   

    register_nav_menus(array(
   'primary' => esc_html__('primary Menu', 'corpoz')
   ));	
	
	//Welcome Message 		
	if ( is_admin() ) {
		require( get_template_directory() . '/welcome-message.php');
	}

}
add_action( 'after_setup_theme', 'corpoz_theme_setup' );
}

function corpoz_header_style()
{
		$corpoz_header_text_color = get_header_textcolor();

	?>
		<style type="text/css">
			<?php
				//Check if user has defined any header image.
				if ( get_header_image() ) :
			?>

			.blogtitle
			 {
			color: #<?php echo esc_attr($corpoz_header_text_color); ?>;
			
			  }
			.carousel-item.active,.content1
			  {
				background-image:url('<?php header_image(); ?>');
			  }
		
			<?php endif; ?>	
		</style>
	<?php

}

/**
* Customizer additions.
*/
// Register Nav Walker class_alias
require get_template_directory() . '/class-wp-bootstrap-navwalker.php';
require get_template_directory(). '/customizer.php';
require get_template_directory(). '/pro-feat.php';

	/**
 * Load Upsell Button In Customizer
 * 2016 &copy; [Justin Tadlock](http://justintadlock.com).
 */

require_once( trailingslashit( get_template_directory() ) . '/lib/upgrade/class-customize.php' );

add_action( 'admin_init', 'corpoz_detect_button' );
	function corpoz_detect_button() {
	wp_enqueue_style( 'corpoz-info-button', get_template_directory_uri() . '/assets/css/import-buttons.css' );
}

/**
 * admin  JS scripts
 */
function corpoz_admin_enqueue_scripts( $hook ) { 
	wp_enqueue_style( 
		'font-awesome', 
		get_template_directory_uri() . '/assets/css/font-awesome.css', 
		array(), 
		'4.7.0', 
		'all' 
	);
	wp_enqueue_style( 
		'corpoz-admin', 
		get_template_directory_uri() . '/assets/admin/css/admin.css', 
		array(), 
		'1.0.0', 
		'all' 
	);
 
}
add_action( 'admin_enqueue_scripts', 'corpoz_admin_enqueue_scripts' );

/**
* Enqueue CSS stylesheets
*/

if( ! function_exists( 'corpoz_enqueue_styles' ) ) {
	function corpoz_enqueue_styles() {
		
		wp_enqueue_style('corpoz-font', 'https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Raleway:400,500,600,700');
		wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css');
		wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.css');
		wp_enqueue_style('header', get_template_directory_uri() . '/assets/css/header.css');
		wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/assets/css/owl.carousel.css');
		wp_enqueue_style('corpoz-owl-theme-default', get_template_directory_uri() . '/assets/css/owl.theme.default.css');
		wp_enqueue_style('corpoz-responsive', get_template_directory_uri() . '/assets/css/responsive.css');

		wp_enqueue_style('corpoz-style', get_stylesheet_uri() );

	}
	add_action( 'wp_enqueue_scripts', 'corpoz_enqueue_styles' );
}

	/**
	* Enqueue JS scripts
	*/

if( ! function_exists( 'corpoz_enqueue_scripts' ) ) {
	function corpoz_enqueue_scripts() {   
	  wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.js',array('jquery'),'', true);
      wp_enqueue_script('jquery-owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.js', array(), '', true);
	 wp_enqueue_script('corpoz-custom', get_template_directory_uri() . '/assets/js/custom.js', array(), '', true);
	
	}
	add_action( 'wp_enqueue_scripts', 'corpoz_enqueue_scripts' );	
}


function corpoz_sidebars() {

	// Blog Sidebar

	register_sidebar(array(
		'name' => esc_html__( 'Blog Sidebar', "corpoz"),
		'id' => 'blog-sidebar',
		'description' => esc_html__( 'Sidebar on the blog layout.', "corpoz"),
		'before_widget' => '<div id=""%1$s" class="categories_box %2$s clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="sidebar_title">',
		'after_title' => '</h5>',
	));
		

	// Footer Sidebar

	register_sidebar(array(
		'name' => esc_html__( 'Footer Widget Area', "corpoz"),
		'id' => 'corpoz-footer-widget-area',
		'description' => esc_html__( 'The footer widget area', "corpoz"),
		'before_widget' => '<div class="%2$s footer-widget col-md-3 col-sm-6 col-xs-12">',
		'after_widget' => '</div>',
		'before_title' => ' <h1>',
		'after_title' => '</h1>',
	));	

	
		
}
add_action( 'widgets_init', 'corpoz_sidebars' );