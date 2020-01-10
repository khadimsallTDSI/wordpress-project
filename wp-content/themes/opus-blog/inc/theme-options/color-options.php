<?php
/* Primary Color Section Inside Core Color Option */
$wp_customize->add_setting('opus_blog_options[opus_blog_primary_color]',
    array(
        'default' => $default['opus_blog_primary_color'],
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'opus_blog_options[opus_blog_primary_color]',
        array(
            'label' => esc_html__('Primary Color', 'opus-blog'),
            'description' => esc_html__('Applied to main color of site.', 'opus-blog'),
            'section' => 'colors',
        )
    )
);