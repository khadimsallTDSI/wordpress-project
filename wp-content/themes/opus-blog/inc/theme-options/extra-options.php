<?php
/*Extra Options*/

$wp_customize->add_section('opus_blog_extra_options', array(
    'priority' => 20,
    'capability' => 'edit_theme_options',
    'theme_supports' => '',
    'title' => __('Extras', 'opus-blog'),
    'panel' => 'opus_blog_panel',

));

/*Breadcrumb Enable*/
$wp_customize->add_setting('opus_blog_options[opus-blog-extra-breadcrumb]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['opus-blog-extra-breadcrumb'],
    'sanitize_callback' => 'opus_blog_sanitize_checkbox'

));

$wp_customize->add_control('opus_blog_options[opus-blog-extra-breadcrumb]', array(
    'label' => __('Enable Breadcrumb', 'opus-blog'),
    'description' => __('Breadcrumb will appear on all pages except home page', 'opus-blog'),
    'section' => 'opus_blog_extra_options',
    'settings' => 'opus_blog_options[opus-blog-extra-breadcrumb]',
    'type' => 'checkbox',
    'priority' => 15,
));


/*Breadcrumb Text*/
$wp_customize->add_setting('opus_blog_options[opus-blog-breadcrumb-text]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['opus-blog-breadcrumb-text'],
    'sanitize_callback' => 'sanitize_text_field'

));

$wp_customize->add_control('opus_blog_options[opus-blog-breadcrumb-text]', array(
    'label' => __('Breadcrumb Text', 'opus-blog'),
    'description' => __('Write your own text in place of You are Here', 'opus-blog'),
    'section' => 'opus_blog_extra_options',
    'settings' => 'opus_blog_options[opus-blog-breadcrumb-text]',
    'type' => 'text',
    'priority' => 15,
));
