<?php
/*Sticky Sidebar*/
$wp_customize->add_section('opus_blog_sticky_sidebar', array(
    'priority' => 20,
    'capability' => 'edit_theme_options',
    'theme_supports' => '',
    'title' => __('Sidebar', 'opus-blog'),
    'panel' => 'opus_blog_panel',
));

/*Sticky Sidebar Setting*/
$wp_customize->add_setting('opus_blog_options[opus-blog-enable-sticky-sidebar]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['opus-blog-enable-sticky-sidebar'],
    'sanitize_callback' => 'opus_blog_sanitize_checkbox'
));

$wp_customize->add_control('opus_blog_options[opus-blog-enable-sticky-sidebar]', array(
    'label' => __('Enable Sticky Sidebar', 'opus-blog'),
    'description' => __('Enable and Disable sticky sidebar from this section.', 'opus-blog'),
    'section' => 'opus_blog_sticky_sidebar',
    'settings' => 'opus_blog_options[opus-blog-enable-sticky-sidebar]',
    'type' => 'checkbox',
    'priority' => 15,
));