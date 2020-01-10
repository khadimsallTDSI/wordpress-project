<?php
/**
 * Template quote post format part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Opus_Blog
 */
global $opus_blog_theme_options;
$masonry = esc_attr($opus_blog_theme_options['opus-blog-column-blog-page']);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($masonry); ?>>
    <div class="post-wrap">
        <div class="post-content">
            <div class="content post-excerpt entry-content">
                <blockquote>
                    <?php
                    if (has_post_format('quote') && !is_singular())
                        $content = apply_filters('the_content', get_the_content());
                    echo $content;
                    ?>
                </blockquote>
            </div>
        </div>
    </div>
</article><!-- #post-->