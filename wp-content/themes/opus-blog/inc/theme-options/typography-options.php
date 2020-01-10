<?php
/*Font and Typography Options*/
$wp_customize->add_section('opus_blog_font_options', array(
    'priority' => 50,
    'capability' => 'edit_theme_options',
    'theme_supports' => '',
    'title' => __('Font Settings', 'opus-blog'),
    'panel' => 'opus_blog_panel',
));

/*Font Family Name*/
$wp_customize->add_setting('opus_blog_options[opus-blog-font-family-name-cast]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['opus-blog-font-family-name-cast'],
    'sanitize_callback' => 'wp_kses_post'
));
$choices = opus_blog_google_fonts();
$wp_customize->add_control('opus_blog_options[opus-blog-font-family-name-cast]', array(
    'label' => __('Font Family', 'opus-blog'),
    'description' => __('Select Font Family Name, Example: Barlow Semi Condensed, sans-serif', 'opus-blog'),
    'choices'  	=> $choices,
    'section' => 'opus_blog_font_options',
    'settings' => 'opus_blog_options[opus-blog-font-family-name-cast]',
    'type' => 'select',
    'priority' => 15,
));
/*Paragraph font Size*/
$wp_customize->add_setting('opus_blog_options[opus-blog-font-paragraph-font-size]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['opus-blog-font-paragraph-font-size'],
    'sanitize_callback' => 'opus_blog_sanitize_number_range'
));
$wp_customize->add_control('opus_blog_options[opus-blog-font-paragraph-font-size]', array(
    'label' => __('Paragraph Font Size', 'opus-blog'),
    'description' => __('Size apply only for paragraphs, not headings. ', 'opus-blog'),
    'section' => 'opus_blog_font_options',
    'settings' => 'opus_blog_options[opus-blog-font-paragraph-font-size]',
    'type' => 'number',
    'priority' => 15,
    'input_attrs' => array(
        'min' => 12,
        'max' => 20,
        'step' => 1,
    ),
));
/*Paragraph line spacing font Size*/
$wp_customize->add_setting('opus_blog_options[opus-blog-font-paragraph-line-height]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['opus-blog-font-paragraph-line-height'],
    'sanitize_callback' => 'opus_blog_sanitize_number_range'
));
$wp_customize->add_control('opus_blog_options[opus-blog-font-paragraph-line-height]', array(
    'label' => __('Paragraph Line Height', 'opus-blog'),
    'description' => __('Size apply only for paragraphs, not headings. ', 'opus-blog'),
    'section' => 'opus_blog_font_options',
    'settings' => 'opus_blog_options[opus-blog-font-paragraph-line-height]',
    'type' => 'number',
    'priority' => 15,
    'input_attrs' => array(
        'min' => 15,
        'max' => 40,
        'step' => 1,
    ),
));
/*Paragraph letter spacing font Size*/
$wp_customize->add_setting('opus_blog_options[opus-blog-font-paragraph-letter-spacing]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['opus-blog-font-paragraph-letter-spacing'],
    'sanitize_callback' => 'opus_blog_sanitize_number_range'
));
$wp_customize->add_control('opus_blog_options[opus-blog-font-paragraph-letter-spacing]', array(
    'label' => __('Paragraph Letter Spacing', 'opus-blog'),
    'description' => __('Size apply only for paragraphs, not headings. ', 'opus-blog'),
    'section' => 'opus_blog_font_options',
    'settings' => 'opus_blog_options[opus-blog-font-paragraph-letter-spacing]',
    'type' => 'number',
    'priority' => 15,
    'input_attrs' => array(
        'min' => 0,
        'max' => 55,
        'step' => 1,
    ),
));