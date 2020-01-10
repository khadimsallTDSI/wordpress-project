<?php
/*Top Header Options*/
$wp_customize->add_section('opus_blog_header_section', array(
    'priority' => 20,
    'capability' => 'edit_theme_options',
    'theme_supports' => '',
    'title' => __('Header', 'opus-blog'),
    'panel' => 'opus_blog_panel',
));

/*callback functions header section*/
if (!function_exists('opus_blog_header_active_callback')) :
    function opus_blog_header_active_callback()
    {
        global $opus_blog_theme_options;
        $enable_header = absint($opus_blog_theme_options['opus_blog_enable_top_header']);
        if (1 == $enable_header) {
            return true;
        } else {
            return false;
        }
    }
endif;

/*Enable Top Header Section*/
$wp_customize->add_setting('opus_blog_options[opus_blog_enable_top_header]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['opus_blog_enable_top_header'],
    'sanitize_callback' => 'opus_blog_sanitize_checkbox'
));

$wp_customize->add_control('opus_blog_options[opus_blog_enable_top_header]', array(
    'label' => __('Enable Top Header', 'opus-blog'),
    'description' => __('Checked to show the top header section like search and social icons', 'opus-blog'),
    'section' => 'opus_blog_header_section',
    'settings' => 'opus_blog_options[opus_blog_enable_top_header]',
    'type' => 'checkbox',
    'priority' => 5,
));

/*Enable Social Icons In Header*/
$wp_customize->add_setting('opus_blog_options[opus_blog_enable_top_header_social]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['opus_blog_enable_top_header_social'],
    'sanitize_callback' => 'opus_blog_sanitize_checkbox'
));

$wp_customize->add_control('opus_blog_options[opus_blog_enable_top_header_social]', array(
    'label' => __('Enable Social Icons', 'opus-blog'),
    'description' => __('You can show the social icons here. Manage social icons from Appearance > Menus. Social Menu will display here.', 'opus-blog'),
    'section' => 'opus_blog_header_section',
    'settings' => 'opus_blog_options[opus_blog_enable_top_header_social]',
    'type' => 'checkbox',
    'priority' => 5,
    'active_callback' => 'opus_blog_header_active_callback'
));

/*Enable Menu in top Header*/

$wp_customize->add_setting('opus_blog_options[opus_blog_enable_top_header_menu]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['opus_blog_enable_top_header_menu'],
    'sanitize_callback' => 'opus_blog_sanitize_checkbox'
));


$wp_customize->add_control('opus_blog_options[opus_blog_enable_top_header_menu]', array(
    'label' => __('Menu in Header', 'opus-blog'),
    'description' => __('Top Header Menu will display here. Go to Appearance < Menu.', 'opus-blog'),
    'section' => 'opus_blog_header_section',
    'settings' => 'opus_blog_options[opus_blog_enable_top_header_menu]',
    'type' => 'checkbox',
    'priority' => 5,
    'active_callback' => 'opus_blog_header_active_callback'
));