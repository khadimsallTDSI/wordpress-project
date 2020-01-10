<?php
/*Blog Page Options*/
$wp_customize->add_section('opus_blog_blog_page_section', array(
    'priority' => 20,
    'capability' => 'edit_theme_options',
    'theme_supports' => '',
    'title' => __('Blog Page', 'opus-blog'),
    'panel' => 'opus_blog_panel',
));
/*Blog Page Sidebar Layout*/

$wp_customize->add_setting('opus_blog_options[opus-blog-sidebar-blog-page]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['opus-blog-sidebar-blog-page'],
    'sanitize_callback' => 'opus_blog_sanitize_select'
));

$wp_customize->add_control('opus_blog_options[opus-blog-sidebar-blog-page]', array(
    'choices' => array(
        'right-sidebar' => __('Right Sidebar', 'opus-blog'),
        'left-sidebar' => __('Left Sidebar', 'opus-blog'),
        'no-sidebar' => __('No Sidebar', 'opus-blog'),
        'middle-column' => __('Middle Column', 'opus-blog'),
    ),
    'label' => __('Select the preferred sidebar', 'opus-blog'),
    'description' => __('This sidebar will work for all Pages', 'opus-blog'),
    'section' => 'opus_blog_blog_page_section',
    'settings' => 'opus_blog_options[opus-blog-sidebar-blog-page]',
    'type' => 'select',
    'priority' => 15,
));


/*Blog Page column number*/
$wp_customize->add_setting('opus_blog_options[opus-blog-column-blog-page]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['opus-blog-column-blog-page'],
    'sanitize_callback' => 'opus_blog_sanitize_select'
));

$wp_customize->add_control('opus_blog_options[opus-blog-column-blog-page]', array(
    'choices' => array(
        'one-column' => __('Single', 'opus-blog'),
        'masonry-post' => __('Masonry', 'opus-blog'),
    ),
    'label' => __('Blog Layout Column', 'opus-blog'),
    'description' => __('You can change the blog page and archive page layouts', 'opus-blog'),
    'section' => 'opus_blog_blog_page_section',
    'settings' => 'opus_blog_options[opus-blog-column-blog-page]',
    'type' => 'select',
    'priority' => 15,
));


/*Image Layout Options For Blog Page*/
$wp_customize->add_setting('opus_blog_options[opus-blog-blog-image-layout]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['opus-blog-blog-image-layout'],
    'sanitize_callback' => 'opus_blog_sanitize_select'
));

$wp_customize->add_control('opus_blog_options[opus-blog-blog-image-layout]', array(
    'choices' => array(
        'full-image' => __('Full Image', 'opus-blog'),
        'left-image' => __('Left Image', 'opus-blog'),
        'hide-image' => __('Hide Image', 'opus-blog'),
    
    ),
    'label' => __('Image Layout', 'opus-blog'),
    'description' => __('This will work only on Single Column Option', 'opus-blog'),
    'section' => 'opus_blog_blog_page_section',
    'settings' => 'opus_blog_options[opus-blog-blog-image-layout]',
    'type' => 'select',
    'priority' => 15,
));

/*Blog Page Show content from*/
$wp_customize->add_setting('opus_blog_options[opus-blog-content-show-from]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['opus-blog-content-show-from'],
    'sanitize_callback' => 'opus_blog_sanitize_select'
));

$wp_customize->add_control('opus_blog_options[opus-blog-content-show-from]', array(
    'choices' => array(
        'excerpt' => __('Excerpt', 'opus-blog'),
        'content' => __('Content', 'opus-blog'),
    ),
    'label' => __('Select Content Display Option', 'opus-blog'),
    'description' => __('You can enable excerpt from Screen Options inside post section of dashboard', 'opus-blog'),
    'section' => 'opus_blog_blog_page_section',
    'settings' => 'opus_blog_options[opus-blog-content-show-from]',
    'type' => 'select',
    'priority' => 15,
));


/*Blog Page excerpt length*/
$wp_customize->add_setting('opus_blog_options[opus-blog-excerpt-length]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['opus-blog-excerpt-length'],
    'sanitize_callback' => 'absint'

));

$wp_customize->add_control('opus_blog_options[opus-blog-excerpt-length]', array(
    'label' => __('Size of Excerpt Content', 'opus-blog'),
    'description' => __('Enter the number per Words to show the content in blog page.', 'opus-blog'),
    'section' => 'opus_blog_blog_page_section',
    'settings' => 'opus_blog_options[opus-blog-excerpt-length]',
    'type' => 'number',
    'priority' => 15,
));

/*Blog Page Pagination Options*/
$wp_customize->add_setting('opus_blog_options[opus-blog-pagination-options]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['opus-blog-pagination-options'],
    'sanitize_callback' => 'opus_blog_sanitize_select'

));

$wp_customize->add_control('opus_blog_options[opus-blog-pagination-options]', array(
    'choices' => array(
        'default' => __('Default', 'opus-blog'),
        'numeric' => __('Numeric', 'opus-blog'),
    ),
    'label' => __('Pagination Types', 'opus-blog'),
    'description' => __('Select the Required Pagination Type', 'opus-blog'),
    'section' => 'opus_blog_blog_page_section',
    'settings' => 'opus_blog_options[opus-blog-pagination-options]',
    'type' => 'select',
    'priority' => 15,
));

/*Blog Page read more text*/
$wp_customize->add_setting('opus_blog_options[opus-blog-read-more-text]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['opus-blog-read-more-text'],
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_control('opus_blog_options[opus-blog-read-more-text]', array(
    'label' => __('Enter Read More Text', 'opus-blog'),
    'description' => __('Read more text for blog and archive page.', 'opus-blog'),
    'section' => 'opus_blog_blog_page_section',
    'settings' => 'opus_blog_options[opus-blog-read-more-text]',
    'type' => 'text',
    'priority' => 15,
));

/*Drop Camp letter*/
$wp_customize->add_setting('opus_blog_options[opus-blog-drop-cap-letter]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['opus-blog-drop-cap-letter'],
    'sanitize_callback' => 'opus_blog_sanitize_checkbox'

));

$wp_customize->add_control('opus_blog_options[opus-blog-drop-cap-letter]', array(
    'label' => __('Drop Cap Option', 'opus-blog'),
    'description' => __('Make Blog Page First Letter Big', 'opus-blog'),
    'section' => 'opus_blog_blog_page_section',
    'settings' => 'opus_blog_options[opus-blog-drop-cap-letter]',
    'type' => 'checkbox',
    'priority' => 15,
));

/*Meta Options*/
$wp_customize->add_setting('opus_blog_options[opus-blog-content-meta-hide]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['opus-blog-content-meta-hide'],
    'sanitize_callback' => 'opus_blog_sanitize_checkbox'
));

$wp_customize->add_control('opus_blog_options[opus-blog-content-meta-hide]', array(
    'label' => __('Meta Options', 'opus-blog'),
    'description' => __('Show category, tags, author, comments etc.', 'opus-blog'),
    'section' => 'opus_blog_blog_page_section',
    'settings' => 'opus_blog_options[opus-blog-content-meta-hide]',
    'type' => 'checkbox',
    'priority' => 15,
));

/*Social Share*/
$wp_customize->add_setting('opus_blog_options[opus-blog-content-social-hide]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['opus-blog-content-social-hide'],
    'sanitize_callback' => 'opus_blog_sanitize_checkbox'
));

$wp_customize->add_control('opus_blog_options[opus-blog-content-social-hide]', array(
    'label' => __('Show Social Share', 'opus-blog'),
    'description' => __('Show the Social Share icons on the blog page and single page.', 'opus-blog'),
    'section' => 'opus_blog_blog_page_section',
    'settings' => 'opus_blog_options[opus-blog-content-social-hide]',
    'type' => 'checkbox',
    'priority' => 15,
));

/*Post Format*/
$wp_customize->add_setting('opus_blog_options[opus-blog-content-post-format-hide]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['opus-blog-content-post-format-hide'],
    'sanitize_callback' => 'opus_blog_sanitize_select'
));

$wp_customize->add_control('opus_blog_options[opus-blog-content-post-format-hide]', array(
    'label' => __('Show Postformat', 'opus-blog'),
    'description' => __('Show the post format icons after the title.', 'opus-blog'),
    'section' => 'opus_blog_blog_page_section',
    'settings' => 'opus_blog_options[opus-blog-content-post-format-hide]',
    'type' => 'select',
    'priority' => 15,
    'choices' => array(
        'block' => __('Show', 'opus-blog'),
        'none' => __('Hide', 'opus-blog'),
    ),
));

/*Related Posts*/
$wp_customize->add_setting('opus_blog_options[opus-blog-blog-page-related-posts]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['opus-blog-blog-page-related-posts'],
    'sanitize_callback' => 'opus_blog_sanitize_checkbox'
));

$wp_customize->add_control('opus_blog_options[opus-blog-blog-page-related-posts]', array(
    'label' => __('Show Related Posts', 'opus-blog'),
    'description' => __('Three Related post of same category will display just below the post in blog, archive and search page.', 'opus-blog'),
    'section' => 'opus_blog_blog_page_section',
    'settings' => 'opus_blog_options[opus-blog-blog-page-related-posts]',
    'type' => 'checkbox',
    'priority' => 15,
));

/*callback functions for blog page related posts section*/
if (!function_exists('opus_blog_related_posts_blog_active_callback')) :
    function opus_blog_related_posts_blog_active_callback()
    {
        global $opus_blog_theme_options;
        $enable_related_posts = absint($opus_blog_theme_options['opus-blog-blog-page-related-posts']);
        if (1 == $enable_related_posts) {
            return true;
        } else {
            return false;
        }
    }
endif;

/*Related Posts Title*/
$wp_customize->add_setting('opus_blog_options[opus-blog-blog-page-related-posts-title]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['opus-blog-blog-page-related-posts-title'],
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_control('opus_blog_options[opus-blog-blog-page-related-posts-title]', array(
    'label' => __('Related Posts Title', 'opus-blog'),
    'description' => __('Related Post will be display below the post in blog page. Write your own title.', 'opus-blog'),
    'section' => 'opus_blog_blog_page_section',
    'settings' => 'opus_blog_options[opus-blog-blog-page-related-posts-title]',
    'type' => 'text',
    'priority' => 15,
    'active_callback' => 'opus_blog_related_posts_blog_active_callback'
));
