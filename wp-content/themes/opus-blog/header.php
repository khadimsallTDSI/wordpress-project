<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Opus_Blog
 */
$GLOBALS['opus_blog_theme_options'] = opus_blog_get_options_value();
global $opus_blog_theme_options;
$enable_slider = absint($opus_blog_theme_options['opus_blog_enable_slider']);
$enable_promo = absint($opus_blog_theme_options['opus_blog_enable_promo']);
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
//wp_body_open hook from WordPress 5.2
if (function_exists('wp_body_open')) {
    wp_body_open();
}
?>
<div id="page" class="site container-main">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'opus-blog'); ?></a>
    <?php
    /**
     * Hook - opus_blog_action_header.
     *
     * @hooked opus_blog_add_main_header - 10
     */
    do_action('opus_blog_action_header');
    ?>
    <?php if ($enable_slider == 1 && (is_home() || is_front_page())) { ?>
        <section class="slider-wrapper">
            <?php
                // hook to display the slider - custom functions file
                do_action('opus_blog_action_slider');
            ?>
        </section>
    <?php } ?>
    <?php if ($enable_promo == 1 && (is_home() || is_front_page() ) )  { ?>
        <section class="promo-slider-wrapper">
            <?php
            // hook to display the slider - custom functions file
            do_action('opus_blog_action_promo');
            ?>
        </section>
    <?php } ?>
