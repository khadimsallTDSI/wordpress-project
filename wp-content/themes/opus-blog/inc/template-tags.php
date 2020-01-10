<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Opus_Blog
 */
if (!function_exists('opus_blog_posted_on')) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function opus_blog_posted_on()
    {
        global $opus_blog_theme_options;
        $meta = absint($opus_blog_theme_options['opus-blog-content-meta-hide']);
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }
        
        $time_string = sprintf($time_string,
            esc_attr(get_the_date('c')),
            esc_html(get_the_date()),
            esc_attr(get_the_modified_date('c')),
            esc_html(get_the_modified_date())
        );
        
        $posted_on = sprintf(
            esc_html_x('%s', 'post date', 'opus-blog'),
            '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
        );
        
        $byline = sprintf(
            esc_html_x('By %s', 'post author', 'opus-blog'),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
        );
        if ( $meta === 1 )
        {
            echo '<span class="posted-on">' . $posted_on . '</span>';
        }
    }
endif;

if (!function_exists('opus_blog_posted_by')) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function opus_blog_posted_by()
    {
        $byline = sprintf(
        /* translators: %s: post author. */
            esc_html_x('by %s', 'post author', 'opus-blog'),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
        );
        global $opus_blog_theme_options;
        $meta = absint($opus_blog_theme_options['opus-blog-content-meta-hide']);
        if ( $meta === 1 )
        {
            echo '<span class="post_by"> ' . $byline . '</span>'; // WPCS: XSS OK.
        }
    }
endif;

if (!function_exists('opus_blog_entry_footer')) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function opus_blog_entry_footer()
    {
        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list(esc_html__(', ', 'opus-blog'));
            
            global $opus_blog_theme_options;
            $meta = absint($opus_blog_theme_options['opus-blog-content-meta-hide']);
            if ($categories_list && $meta === 1 ) {
                printf('<span class="cat-links">' . '<i class="fa fa-folder-open"></i>' . esc_html__('%1$s', 'opus-blog') . '</span>', $categories_list); // WPCS: XSS OK.
            }
            
            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', esc_html__(', ', 'opus-blog'));
            if ($tags_list && $meta === 1 ) {
                printf('<span class="tags-links">' . '<i class="fa fa-tag"></i>' . esc_html__('%1$s', 'opus-blog') . '</span>', $tags_list); // WPCS: XSS OK.
            }
            if( $meta === 1 ) {
                ?>
                <span class="comments-link"><i class="fa fa-comment"></i><a
                            href="<?php comments_link(); ?>"><?php comments_number('0 comments', '1 comments', '% comments'); ?></a> </span>
                <?php
            }
        }
        edit_post_link(
            sprintf('<i class="fa fa-pencil"></i>' .
            /* translators: %s: Name of current post */
                esc_html__('Edit %s', 'opus-blog'),
                the_title('<span class="screen-reader-text">"', '"</span>', false)
            ),
            '<span class="edit-link">',

            '</span>'
        );
    }
endif;

/**
 * Post Thumbnail
 *
 * @since Opus Blog 1.0.0
 */
if (!function_exists('opus_blog_post_thumbnail')) :
    /**
     * Displays an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index views, or a div
     * element when on single views.
     */
    function opus_blog_post_thumbnail()
    {
        if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
            return;
        }
        
        if (is_singular()) :
            ?>

            <div class="post-thumbnail">
                <?php the_post_thumbnail('full'); ?>
            </div><!-- .post-thumbnail -->
        
        <?php else : ?>
            <?php
            $image_size = 'thumbnail';
            global $opus_blog_theme_options;
            $image_location = esc_html($opus_blog_theme_options['opus-blog-blog-image-layout']);
            if ($image_location == 'full-image') {
                $image_size = 'full';
            } elseif ($image_location == 'left-image') {
                $image_size = 'full';
            } elseif ($image_location == 'right-image') {
                $image_size = 'medium';
            }
            if ($image_location != 'hide-image'):
                ?>
                <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
                    <?php
                    
                    the_post_thumbnail($image_size, array(
                        'class' => $image_location,
                        'alt' => the_title_attribute(array(
                                'echo' => false,
                            )
                        )
                    ));
                    ?>
                </a>
                <?php
            endif;
            ?>
        <?php endif; // End is_singular().
    }
endif;