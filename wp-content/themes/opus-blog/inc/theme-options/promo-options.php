<?php
/*Promo Section Options*/

$wp_customize->add_section( 'opus_blog_promo_section', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Promo', 'opus-blog' ),
    'panel' 		 => 'opus_blog_panel',
) );

/*callback functions slider*/
if ( !function_exists('opus_blog_promo_active_callback') ) :
    function opus_blog_promo_active_callback(){
        global $opus_blog_theme_options;
        $enable_promo = absint($opus_blog_theme_options['opus_blog_enable_promo']);
        if( 1 == $enable_promo ){
            return true;
        }
        else{
            return false;
        }
    }
endif;

/*Promo Enable Option*/
$wp_customize->add_setting( 'opus_blog_options[opus_blog_enable_promo]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['opus_blog_enable_promo'],
    'sanitize_callback' => 'opus_blog_sanitize_checkbox'
) );

$wp_customize->add_control( 'opus_blog_options[opus_blog_enable_promo]', array(
    'label'     => __( 'Enable Promo', 'opus-blog' ),
    'description' => __('Checked to Enable Promo In Home Page. Posts of Selected Category will display there.', 'opus-blog'),
    'section'   => 'opus_blog_promo_section',
    'settings'  => 'opus_blog_options[opus_blog_enable_promo]',
    'type'      => 'checkbox',
    'priority'  => 5,

) );

/*Promo Category Selection*/
$wp_customize->add_setting( 'opus_blog_options[opus-blog-promo-select-category]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['opus-blog-promo-select-category'],
    'sanitize_callback' => 'absint'

) );

$wp_customize->add_control(
    new Opus_Blog_Customize_Category_Dropdown_Control(
        $wp_customize,
        'opus_blog_options[opus-blog-promo-select-category]',
        array(
            'label'     => __( 'Category For Promo', 'opus-blog' ),
            'description' => __('From the dropdown select the category for the Promo. Category having post will display in below promo section. Only 3 post of the selected category will display.', 'opus-blog'),
            'section'   => 'opus_blog_promo_section',
            'settings'  => 'opus_blog_options[opus-blog-promo-select-category]',
            'type'      => 'category_dropdown',
            'priority'  => 5,
            'active_callback'=>'opus_blog_promo_active_callback'
        )
    )
);