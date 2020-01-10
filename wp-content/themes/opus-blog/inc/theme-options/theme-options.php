<?php
/* Theme Options Panel */
$wp_customize->add_panel('opus_blog_panel', array(
    'priority' => 30,
    'capability' => 'edit_theme_options',
    'title' => __('Theme Options', 'opus-blog'),
));

/* Customizer Options */
require get_template_directory() . '/inc/theme-options/typography-options.php';
require get_template_directory() . '/inc/theme-options/color-options.php';
require get_template_directory() . '/inc/theme-options/top-header-options.php';
require get_template_directory() . '/inc/theme-options/menu-options.php';
require get_template_directory() . '/inc/theme-options/slider-options.php';
require get_template_directory() . '/inc/theme-options/promo-options.php';
require get_template_directory() . '/inc/theme-options/blog-page-options.php';
require get_template_directory() . '/inc/theme-options/single-page-options.php';
require get_template_directory() . '/inc/theme-options/sidebar-options.php';
require get_template_directory() . '/inc/theme-options/footer-options.php';
require get_template_directory() . '/inc/theme-options/extra-options.php';
