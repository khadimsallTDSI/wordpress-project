<?php
/*Slider Options*/

$wp_customize->add_section('opus_blog_slider_section', array(
    'priority' => 20,
    'capability' => 'edit_theme_options',
    'theme_supports' => '',
    'title' => __('Slider', 'opus-blog'),
    'panel' => 'opus_blog_panel',
));

/*callback functions slider*/
if (!function_exists('opus_blog_slider_active_callback')) :
    function opus_blog_slider_active_callback()
    {
        global $opus_blog_theme_options;
        $enable_slider = absint($opus_blog_theme_options['opus_blog_enable_slider']);
        if (1 == $enable_slider) {
            return true;
        } else {
            return false;
        }
    }
endif;

/*Slider Enable Option*/
$wp_customize->add_setting('opus_blog_options[opus_blog_enable_slider]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['opus_blog_enable_slider'],
    'sanitize_callback' => 'opus_blog_sanitize_checkbox'
));

$wp_customize->add_control('opus_blog_options[opus_blog_enable_slider]', array(
    'label' => __('Enable Slider', 'opus-blog'),
    'description' => __('Checked to Enable Slider In Home Page. Make sure header image is not set to display the slider', 'opus-blog'),
    'section' => 'opus_blog_slider_section',
    'settings' => 'opus_blog_options[opus_blog_enable_slider]',
    'type' => 'checkbox',
    'priority' => 5,

));

/*Full and Boxed Slider*/
$wp_customize->add_setting('opus_blog_options[opus_blog_enable_slider_boxed]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['opus_blog_enable_slider_boxed'],
    'sanitize_callback' => 'opus_blog_sanitize_select'
));

$wp_customize->add_control('opus_blog_options[opus_blog_enable_slider_boxed]', array(
    'label' => __('Box Slider ', 'opus-blog'),
    'description' => __('Box Slider Section', 'opus-blog'),
    'section' => 'opus_blog_slider_section',
    'settings' => 'opus_blog_options[opus_blog_enable_slider_boxed]',
    'type' => 'select',
    'priority' => 15,
    'choices' => array(
        'full-layout' => __('Full Width', 'opus-blog'),
        'boxed' => __('Boxed', 'opus-blog'),
    ),
    'active_callback' => 'opus_blog_slider_active_callback',
));


/*Slider Category Selection*/
$wp_customize->add_setting('opus_blog_options[opus-blog-select-category]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['opus-blog-select-category'],
    'sanitize_callback' => 'absint'

));

$wp_customize->add_control(
    new Opus_Blog_Customize_Category_Dropdown_Control(
        $wp_customize,
        'opus_blog_options[opus-blog-select-category]',
        array(
            'label' => __('Select Category For Slider', 'opus-blog'),
            'description' => __('From the dropdown select the category for the slider. Category having post will display in below dropdown.', 'opus-blog'),
            'section' => 'opus_blog_slider_section',
            'settings' => 'opus_blog_options[opus-blog-select-category]',
            'type' => 'category_dropdown',
            'priority' => 5,
            'active_callback' => 'opus_blog_slider_active_callback'
        )
    )

);
/*Slider Number*/

$wp_customize->add_setting('opus_blog_options[opus-blog-slider-number]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['opus-blog-slider-number'],
    'sanitize_callback' => 'opus_blog_sanitize_number_range'
));

$wp_customize->add_control('opus_blog_options[opus-blog-slider-number]', array(
    'label' => __('Number of Slides ', 'opus-blog'),
    'description' => __('Select the number of slide. Maximum slide is 5 and minimum 1', 'opus-blog'),
    'section' => 'opus_blog_slider_section',
    'settings' => 'opus_blog_options[opus-blog-slider-number]',
    'type' => 'number',
    'priority' => 15,
    'active_callback' => 'opus_blog_slider_active_callback',
    'input_attrs' => array(
        'min' => '1',
        'max' => '5',
        'step' => '1',
    ),
));

/*Slider Recommendation Enable Option*/
$wp_customize->add_setting('opus_blog_options[opus_blog_enable_slider_recommendation]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['opus_blog_enable_slider_recommendation'],
    'sanitize_callback' => 'opus_blog_sanitize_checkbox'
));

$wp_customize->add_control('opus_blog_options[opus_blog_enable_slider_recommendation]', array(
    'label' => __('Enable Slider Recommendation Section', 'opus-blog'),
    'description' => __('Checked to Show the Slider Recommendation on the Slider Section', 'opus-blog'),
    'section' => 'opus_blog_slider_section',
    'settings' => 'opus_blog_options[opus_blog_enable_slider_recommendation]',
    'type' => 'checkbox',
    'priority' => 15,
    'active_callback' => 'opus_blog_slider_active_callback',
));