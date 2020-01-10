<?php
/*Footer Options*/
$wp_customize->add_section('opus_blog_footer_section', array(
    'priority' => 20,
    'capability' => 'edit_theme_options',
    'theme_supports' => '',
    'title' => __('Footer', 'opus-blog'),
    'panel' => 'opus_blog_panel',
));

/*Copyright Setting*/
$wp_customize->add_setting('opus_blog_options[opus-blog-footer-copyright]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['opus-blog-footer-copyright'],
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_control('opus_blog_options[opus-blog-footer-copyright]', array(
    'label' => __('Copyright Text', 'opus-blog'),
    'description' => __('Enter your own copyright text.', 'opus-blog'),
    'section' => 'opus_blog_footer_section',
    'settings' => 'opus_blog_options[opus-blog-footer-copyright]',
    'type' => 'text',
    'priority' => 15,
));

/*Go to Top Setting*/
$wp_customize->add_setting('opus_blog_options[opus-blog-go-to-top]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['opus-blog-go-to-top'],
    'sanitize_callback' => 'opus_blog_sanitize_checkbox'
));

$wp_customize->add_control('opus_blog_options[opus-blog-go-to-top]', array(
    'label' => __('Enable Go to Top', 'opus-blog'),
    'description' => __('Checked to Enable Go to Top', 'opus-blog'),
    'section' => 'opus_blog_footer_section',
    'settings' => 'opus_blog_options[opus-blog-go-to-top]',
    'type' => 'checkbox',
    'priority' => 15,
));