<?php
/**
 * Opus Blog Theme Customizer
 *
 * @package Opus_Blog
 */

if (!function_exists('opus_blog_default_theme_options_values')) :
    
    function opus_blog_default_theme_options_values()
    {
        
        $default_theme_options = array(
            
            /*Top Header Section Default Value*/
            'opus_blog_primary_color' => '#6ca4db',
            
            /*Top Header Section Default Value*/
            'opus_blog_enable_top_header' => 0,
            'opus_blog_enable_top_header_social' => 0,
            'opus_blog_enable_top_header_menu' => 0,
            
            /*Menu Section Default Value*/
            'opus_blog_enable_sticky_menu' => 1,
            'opus_blog_enable_top_header_search' => 0,
            'opus_blog_enable_top_header_woo'=> 0,
            
            /*Slider Section Default Value*/
            'opus_blog_enable_slider' => 1,
            'opus-blog-select-category' => 0,
            'opus-blog-slider-number' => 3,
            'opus_blog_enable_slider_recommendation' => 1,
            'opus_blog_enable_slider_boxed' => 'full-layout',
    
            /*Promo Section Default Value*/
            'opus_blog_enable_promo'       => 1,
            'opus-blog-promo-select-category'=> 0,
            
            /*Blog Page Default Value*/
            'opus-blog-sidebar-blog-page' => 'right-sidebar',
            'opus-blog-column-blog-page' => 'one-column',
            'opus-blog-blog-image-layout' => 'full-image',
            'opus-blog-content-show-from' => 'excerpt',
            'opus-blog-excerpt-length' => 25,
            'opus-blog-pagination-options' => 'numeric',
            'opus-blog-read-more-text' => esc_html__('Read More', 'opus-blog'),
            'opus-blog-content-social-hide' => 1,
            'opus-blog-content-meta-hide' => 1,
            'opus-blog-content-post-format-hide' => 'block',
            'opus-blog-blog-page-related-posts'  => 0,
            'opus-blog-blog-page-related-posts-title' => esc_html__('You May Like', 'opus-blog'),
    
            /*Single Page Default Value*/
            'opus-blog-single-page-related-posts' => 0,
            'opus-blog-single-page-related-posts-title' => esc_html__('Related Posts', 'opus-blog'),
            'opus-blog-single-page-author-info' => 0,
            'opus-blog-sidebar-single-page' => 'single-right-sidebar',
            'opus-blog-drop-cap-single-letter' => 0,
            
            /*Sticky Sidebar Options*/
            'opus-blog-enable-sticky-sidebar' => 1,
            
            /*Footer Section*/
            'opus-blog-footer-copyright' => esc_html__('All Right Reserved 2019', 'opus-blog'),
            'opus-blog-go-to-top' => 1,
            
            /*Paragraph Options*/
            'opus-blog-font-family-name-cast'=> 'Lora:400,400i',
            'opus-blog-font-paragraph-font-size' => 15,
            'opus-blog-font-paragraph-line-height' => 25,
            'opus-blog-font-paragraph-letter-spacing' => 0,
            
            /*Extra Options*/
            'opus-blog-extra-breadcrumb' => 1,
            'opus-blog-breadcrumb-text' => esc_html__('You are Here', 'opus-blog'),
            'opus-blog-drop-cap-letter' => 0
        
        );
        return apply_filters('opus_blog_default_theme_options_values', $default_theme_options);
    }
endif;
/**
 *  Opus Blog Theme Options and Settings
 *
 * @since Opus Blog 1.0.0
 *
 * @param null
 * @return array opus_blog_get_options_value
 *
 */
if (!function_exists('opus_blog_get_options_value')) :
    function opus_blog_get_options_value()
    {
        $opus_blog_default_theme_options_values = opus_blog_default_theme_options_values();
        $opus_blog_get_options_value = get_theme_mod('opus_blog_options');
        if (is_array($opus_blog_get_options_value)) {
            return array_merge($opus_blog_default_theme_options_values, $opus_blog_get_options_value);
        } else {
            return $opus_blog_default_theme_options_values;
        }
    }
endif;

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function opus_blog_customize_register($wp_customize)
{
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';
    
    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial('blogname', array(
            'selector' => '.site-title a',
            'render_callback' => 'opus_blog_customize_partial_blogname',
        ));
        $wp_customize->selective_refresh->add_partial('blogdescription', array(
            'selector' => '.site-description',
            'render_callback' => 'opus_blog_customize_partial_blogdescription',
        ));
    }
    $default = opus_blog_default_theme_options_values();
    
    require get_template_directory() . '/inc/theme-options/theme-options.php';
}

add_action('customize_register', 'opus_blog_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function opus_blog_customize_partial_blogname()
{
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function opus_blog_customize_partial_blogdescription()
{
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function opus_blog_customize_preview_js()
{
    wp_enqueue_script('opus-blog-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), '20151215', true);
}
add_action('customize_preview_init', 'opus_blog_customize_preview_js');

/*
** Load dynamic logic for the customizer controls area.
*/
function opus_blog_panels_css() {
     wp_enqueue_style('opus-blog-customizer-css', get_template_directory_uri() . '/css/customizer-css.css', array(), '4.5.0');
}
add_action( 'customize_controls_enqueue_scripts', 'opus_blog_panels_css' );