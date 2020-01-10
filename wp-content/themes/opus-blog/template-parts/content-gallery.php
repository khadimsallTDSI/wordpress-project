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
$drop_cap = absint($opus_blog_theme_options['opus-blog-drop-cap-letter']);
$drop_cap_class = esc_attr(( $drop_cap == 1 ) ? 'drop-cap' : '');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($masonry); ?>>
    <div class="post-wrap">
        <div class="post-media">
            <?php
            if (!is_single() && get_post_gallery()) { ?>
                <div class="blog-gallery">

                    <div id="gallery-2"
                         class="gallery-post-format-section galleryid-201 gallery-columns-1 gallery-size-medium">
                        <?php $gallery = get_post_gallery(get_the_ID(), false);
                        foreach ($gallery['src'] AS $src) { ?>
                            <div class="gallery-icon landscape">
                                <figure class="gallery-item">
                                    <a class="fancybox" data-fancybox-group="gallery"
                                       href="<?php echo esc_url($src); ?>">
                                        <img src="<?php echo esc_url($src); ?>" class="img-responsive"
                                             alt="Gallery image"/>
                                    </a>
                                </figure>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
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
            <div class="post-excerpt entry-content <?php echo $drop_cap_class; ?>">
                <?php
                if (is_singular()) {
                    the_content();
                } else {
                    if ($show_content_from == 'excerpt') {
                        the_excerpt();
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
                    <a class="more-link" href="<?php the_permalink(); ?>"><?php echo esc_html($read_more); ?> <i
                                class="fa fa-long-arrow-right"></i>
                    </a>
                <?php endif; ?>
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
</article><!-- #post-<?php //the_ID(); ?> -->