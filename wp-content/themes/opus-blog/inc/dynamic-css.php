<?php
/**
 * Dynamic css
 *
 * @since Opus Blog 1.0.0
 *
 * @param null
 * @return null
 *
 */
if (!function_exists('opus_blog_dynamic_css')) :
    
    function opus_blog_dynamic_css()
    {
        global $opus_blog_theme_options;
        
        /* Color Options Options */
        $opus_blog_primary_color = esc_attr($opus_blog_theme_options['opus_blog_primary_color']);
        
        /* Paragraph Font Options */
        $opus_blog_google_fonts = opus_blog_google_fonts();
        $opus_blog_body_fonts = $opus_blog_theme_options['opus-blog-font-family-name-cast'];
        $opus_blog_font_family = $opus_blog_google_fonts[$opus_blog_body_fonts];
        
        //$opus_blog_font_family = wp_kses_post($opus_blog_theme_options['opus-blog-font-family-name']);
        $opus_blog_font_size = esc_attr($opus_blog_theme_options['opus-blog-font-paragraph-font-size']);
        $opus_blog_paragraph_line_height = esc_attr($opus_blog_theme_options['opus-blog-font-paragraph-line-height']);
        $opus_blog_paragraph_letter_spacing = esc_attr($opus_blog_theme_options['opus-blog-font-paragraph-letter-spacing']);
        
        /* Post Format Options */
        $opus_blog_post_format = esc_attr($opus_blog_theme_options['opus-blog-content-post-format-hide']);
        
        $custom_css = '';
        
        //Primary  Background
        if (!empty($opus_blog_primary_color)) {
            $custom_css .= "
            #toTop:hover,
            a.effect:before,
            .show-more,
            a.link-format,
            .sidebar-3 .widget-title:after,
            .caption .s-cat,
            .widget input[type='submit'],
            .bottom-caption .slick-current .slider-items span,
            .slide-wrap .caption .s-cat,
            aarticle.format-status .post-content .post-format::after,
            article.format-chat .post-content .post-format::after, 
            article.format-link .post-content .post-format::after,
            article.format-standard .post-content .post-format::after, 
            article.format-image .post-content .post-format::after, 
            article.hentry.sticky .post-content .post-format::after, 
            article.format-video .post-content .post-format::after, 
            article.format-gallery .post-content .post-format::after, 
            article.format-audio .post-content .post-format::after, 
            article.format-quote .post-content .post-format::after{ 
                background-color: " . $opus_blog_primary_color . "; 
                border-color: " . $opus_blog_primary_color . ";
            }";
            
        }
        
        //Primary Color
        if (!empty($opus_blog_primary_color)) {
            $custom_css .= "
            .main-header a:hover, 
            .main-header a:focus, 
            .main-header a:active,
            .top-menu > ul > li > a:hover,
            .main-menu ul li.current-menu-item > a, 
            .header-2 .main-menu > ul > li.current-menu-item > a,
            .main-menu ul li:hover > a,
            ul.trail-items li a:hover span,
            .author-socials a:hover,
            .post-date a:focus, 
            .post-date a:hover,
            .post-footer > span a:hover, 
            .post-footer > span a:focus,
            .widget a:hover, 
            .widget a:focus,
            .footer-menu li a:hover, 
            .footer-menu li a:focus,
            .footer-social-links a:hover,
            .footer-social-links a:focus,
            .site-footer a:hover, 
            .site-footer a:focus,
            .content-area .entry-content p a,
            { 
                color : " . $opus_blog_primary_color . "; 
            }";
        }
        
        //Paragraph Font Options
        if (!empty($opus_blog_font_family)) {
            $custom_css .= "
            body{ 
                font-family:" . $opus_blog_font_family . "; 
            }";
        }
        
        if (!empty($opus_blog_font_size)) {
            $custom_css .= "
            p{ 
                font-size: " . $opus_blog_font_size . "px; 
            }";
        }
        if (!empty($opus_blog_paragraph_line_height)) {
            $custom_css .= "
            p{ 
                line-height:" . $opus_blog_paragraph_line_height . "px; 
            }";
        }
        if (!empty($opus_blog_paragraph_letter_spacing)) {
            $custom_css .= "
            p{ 
                letter-spacing:" . $opus_blog_paragraph_letter_spacing . "px; 
            }";
        }
        /* Post Format Section */
        if (!empty($opus_blog_post_format)) {
            $custom_css .= "
            span.post-format 
            { 
                display:" . $opus_blog_post_format . "; 
            }";
        }
        
        wp_add_inline_style('opus-blog-style', $custom_css);
    }
endif;
add_action('wp_enqueue_scripts', 'opus_blog_dynamic_css', 99);