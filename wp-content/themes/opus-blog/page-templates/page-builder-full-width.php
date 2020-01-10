<?php
/**
 * Template Name: Page Builder(Elementor) Full Width
 * Template Post Type: page
 *
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Opus_Blog
 */
get_header();
?>

<?php
    /*
    * Content section for full width layout
    * Every section on this page will managed from Page Builder Plugins
    */
    the_content(); 
?>

<?php
get_footer();