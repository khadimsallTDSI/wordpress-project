<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Opus_Blog
 */
global $opus_blog_theme_options;
$show_content_from = esc_attr($opus_blog_theme_options['opus-blog-content-show-from']);
$read_more = esc_html($opus_blog_theme_options['opus-blog-read-more-text']);
$masonry = esc_attr($opus_blog_theme_options['opus-blog-column-blog-page']);
$image_location = esc_attr($opus_blog_theme_options['opus-blog-blog-image-layout']);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($masonry); ?>>
    <div class="post-wrap <?php echo esc_attr($image_location); ?>">
        <div class="post-content">
            <div class="date_title">
                <span class="post-format"></span>
                <div class="post-date">
                    <?php
                    if ('post' === get_post_type()) :
                        ?>
                        <div class="entry-meta">
                            <?php
                            opus_blog_posted_on();
                            opus_blog_posted_by();
                            ?>
                        </div><!-- .entry-meta -->
                    <?php endif; ?>
                </div>
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
                if (is_singular()) {
                    the_content();
                } else {
                    if ($show_content_from == 'excerpt') {
                        $content = get_the_content();
                        $content_link = wp_extract_urls($content);
                        echo "<a class='link-format' href=".$content_link[0].">$content_link[0]</a>";
                    } else {
                        the_content();
                    }
                }
                wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'opus-blog'),
                    'after' => '</div>',
                ));
                ?>
                <!-- read more -->
                <?php if (!empty($read_more) && $show_content_from == 'excerpt'): ?>
                    <a class="more-link" href="<?php the_permalink(); ?>"><?php echo esc_html($read_more); ?>
                        <i class="fa fa-long-arrow-right"></i>
                    </a>
                <?php endif; ?>
            </div>
            <!-- .entry-content end -->
            <footer class="post-footer entry-footer">
                <?php opus_blog_entry_footer(); ?>
                <?php do_action( 'opus_blog_social_sharing' ,get_the_ID() );?>
            </footer><!-- .entry-footer end -->
        </div>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->