<?php
/*Single Page Options*/
$wp_customize->add_section('opus_blog_single_page_section', array(
    'priority' => 20,
    'capability' => 'edit_theme_options',
    'theme_supports' => '',
    'title' => __('Single Page', 'opus-blog'),
    'panel' => 'opus_blog_panel',
));

/*Single Page Sidebar Layout*/
$wp_customize->add_setting('opus_blog_options[opus-blog-sidebar-single-page]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['opus-blog-sidebar-single-page'],
    'sanitize_callback' => 'opus_blog_sanitize_select'
));

$wp_customize->add_control('opus_blog_options[opus-blog-sidebar-single-page]', array(
    'choices' => array(
        'single-right-sidebar' => __('Right Sidebar', 'opus-blog'),
        'single-left-sidebar' => __('Left Sidebar', 'opus-blog'),
        'single-no-sidebar' => __('No Sidebar', 'opus-blog'),
        'single-middle-column' => __('Middle Column', 'opus-blog'),
    ),
    'label' => __('Select the preferred sidebar', 'opus-blog'),
    'description' => __('This sidebar will work for all single Pages. You can change the sidebar for individual pages from the post templates on single post as well.', 'opus-blog'),
    'section' => 'opus_blog_single_page_section',
    'settings' => 'opus_blog_options[opus-blog-sidebar-single-page]',
    'type' => 'select',
    'priority' => 15,
));

/*Drop Camp letter*/
$wp_customize->add_setting('opus_blog_options[opus-blog-drop-cap-single-letter]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['opus-blog-drop-cap-single-letter'],
    'sanitize_callback' => 'opus_blog_sanitize_checkbox'

));

$wp_customize->add_control('opus_blog_options[opus-blog-drop-cap-single-letter]', array(
    'label' => __('Drop Cap Option', 'opus-blog'),
    'description' => __('Single Page First Letter Big', 'opus-blog'),
    'section' => 'opus_blog_single_page_section',
    'settings' => 'opus_blog_options[opus-blog-drop-cap-single-letter]',
    'type' => 'checkbox',
    'priority' => 15,
));


/*Author Box Show Hide*/
$wp_customize->add_setting('opus_blog_options[opus-blog-single-page-author-info]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['opus-blog-single-page-author-info'],
    'sanitize_callback' => 'opus_blog_sanitize_checkbox'
));

$wp_customize->add_control('opus_blog_options[opus-blog-single-page-author-info]', array(
    'label' => __('Enable Author Bio', 'opus-blog'),
    'description' => __('Go to Users > Edit users and add the users information. That information of the author/user will appear on the single page.', 'opus-blog'),
    'section' => 'opus_blog_single_page_section',
    'settings' => 'opus_blog_options[opus-blog-single-page-author-info]',
    'type' => 'checkbox',
    'priority' => 15,
));


/*Related Post Options*/
$wp_customize->add_setting('opus_blog_options[opus-blog-single-page-related-posts]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['opus-blog-single-page-related-posts'],
    'sanitize_callback' => 'opus_blog_sanitize_checkbox'
));

$wp_customize->add_control('opus_blog_options[opus-blog-single-page-related-posts]', array(
    'label' => __('Enable Related Posts', 'opus-blog'),
    'description' => __('2 Posts from similar category will display at the end of the page.', 'opus-blog'),
    'section' => 'opus_blog_single_page_section',
    'settings' => 'opus_blog_options[opus-blog-single-page-related-posts]',
    'type' => 'checkbox',
    'priority' => 15,
));


/*callback functions related posts*/
if (!function_exists('opus_blog_related_post_callback')) :
    function opus_blog_related_post_callback()
    {
        global $opus_blog_theme_options;
        $related_posts = absint($opus_blog_theme_options['opus-blog-single-page-related-posts']);
        if (1 == $related_posts) {
            return true;
        } else {
            return false;
        }
    }
endif;

/*Related Post Title*/
$wp_customize->add_setting('opus_blog_options[opus-blog-single-page-related-posts-title]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['opus-blog-single-page-related-posts-title'],
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_control('opus_blog_options[opus-blog-single-page-related-posts-title]', array(
    'label' => __('Related Posts Title', 'opus-blog'),
    'description' => __('Give the appropriate title for related posts', 'opus-blog'),
    'section' => 'opus_blog_single_page_section',
    'settings' => 'opus_blog_options[opus-blog-single-page-related-posts-title]',
    'type' => 'text',
    'priority' => 15,
    'active_callback' => 'opus_blog_related_post_callback'
));