<?php
/*Top Header Options*/
$wp_customize->add_section('opus_blog_menu_options_section', array(
    'priority' => 20,
    'capability' => 'edit_theme_options',
    'theme_supports' => '',
    'title' => __('Menu', 'opus-blog'),
    'panel' => 'opus_blog_panel',
));

/*Enable Sticky Menu*/
$wp_customize->add_setting('opus_blog_options[opus_blog_enable_sticky_menu]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['opus_blog_enable_sticky_menu'],
    'sanitize_callback' => 'opus_blog_sanitize_checkbox'
));

$wp_customize->add_control('opus_blog_options[opus_blog_enable_sticky_menu]', array(
    'label' => __('Enable Sticky Menu', 'opus-blog'),
    'description' => __('The main primary menu and the search icon will be sticky along with logo.', 'opus-blog'),
    'section' => 'opus_blog_menu_options_section',
    'settings' => 'opus_blog_options[opus_blog_enable_sticky_menu]',
    'type' => 'checkbox',
    'priority' => 5
));

/*Enable Search Icons In Menu*/
$wp_customize->add_setting('opus_blog_options[opus_blog_enable_top_header_search]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['opus_blog_enable_top_header_search'],
    'sanitize_callback' => 'opus_blog_sanitize_checkbox'
));

$wp_customize->add_control('opus_blog_options[opus_blog_enable_top_header_search]', array(
    'label' => __('Enable Search Icon', 'opus-blog'),
    'description' => __('You can show the search field in Menu Section.', 'opus-blog'),
    'section' => 'opus_blog_menu_options_section',
    'settings' => 'opus_blog_options[opus_blog_enable_top_header_search]',
    'type' => 'checkbox',
    'priority' => 5
));
/*Enable WooCommerce Cart In Menu*/
if ( class_exists( 'WooCommerce' ) ) {
    $wp_customize->add_setting('opus_blog_options[opus_blog_enable_top_header_woo]', array(
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'default' => $default['opus_blog_enable_top_header_woo'],
        'sanitize_callback' => 'opus_blog_sanitize_checkbox'
    ));
    
    $wp_customize->add_control('opus_blog_options[opus_blog_enable_top_header_woo]', array(
        'label' => __('Enable WooCommerce Cart', 'opus-blog'),
        'description' => __('This is a WooCommerce Cart and it will only visible if you install and activate WooCommerce plugin.', 'opus-blog'),
        'section' => 'opus_blog_menu_options_section',
        'settings' => 'opus_blog_options[opus_blog_enable_top_header_woo]',
        'type' => 'checkbox',
        'priority' => 5
    ));
}