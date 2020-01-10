<?php
/**
 * Template aside post format part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Opus_Blog
 */
global $opus_blog_theme_options;
$masonry = esc_attr($opus_blog_theme_options['opus-blog-column-blog-page']);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($masonry); ?>>
    <div class="post-wrap <?php echo esc_attr($image_location); ?>">
        <?php if(has_post_thumbnail()) { ?>
            <div class="post-media">
                <?php opus_blog_post_thumbnail(); ?>
            </div>
        <?php } ?>
        <div class="post-content">
            <div class="date_title">
                <span class="post-format"></span>
                <?php
                if ('post' === get_post_type()) :
                    ?>
                    <div class="post-date">
                        <div class="entry-meta">
                            <?php
                            opus_blog_posted_on();
                            opus_blog_posted_by();
                            ?>
                        </div><!-- .entry-meta -->
                    </div>
                <?php endif; ?>
                <?php
                if (is_singular()) :
                    the_title('<h1 class="post-title entry-title">', '</h1>');
                else :
                    the_title('<h2 class="post-title entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                    ?>
                <?php endif; ?>
            </div>
            <div class="post-excerpt entry-content">
                <?php
                if (has_post_format('aside') && !is_singular())
                    $content = apply_filters('the_content', get_the_content());
                echo $content .= ' <a href="' . esc_url(get_permalink()) . '">&#8734;</a>';
                ?>
            </div>
            <!-- .entry-content end -->
            <footer class="post-footer entry-footer">
                <?php opus_blog_entry_footer(); ?>
                <?php do_action( 'opus_blog_social_sharing' ,get_the_ID() );?>
            </footer><!-- .entry-footer end -->
            <?php
                /**
                 * opus_blog_related_posts hook
                 * @since Opus Blog 1.0.2
                 *
                 * @hooked opus_blog_related_posts -  10
                 */
                if(! is_singular() ):
                    do_action( 'opus_blog_blog_related_posts' ,get_the_ID() );
                endif;
            ?>
        </div>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->