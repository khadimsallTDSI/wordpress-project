<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Opus_Blog
 */

get_header();
?>
<section id="content" class="site-content posts-container">
    <div class="container">
        <div class="row">
            <section class="breadcrumbs-wrap">
                <?php do_action('opus_blog_breadcrumb_options_hook'); ?> <!-- Breadcrumb hook -->
            </section>
            <div id="primary" class="col-md-8 content-area">
                <main id="main" class="site-main">
                    <?php
                    while (have_posts()) :
                        the_post();
                        
                        get_template_part('template-parts/content', 'page');
                        
                        // If comments are open or we have at least one comment, load up the comment template.
                        if (comments_open() || get_comments_number()) :
                            comments_template();
                        endif;
                    
                    endwhile; // End of the loop.
                    ?>
                </main><!-- #main -->
            </div><!-- #primary -->
        <?php get_sidebar(); ?>
        </div><!-- .row -->
    </div><!-- .container -->
</section><!-- #content -->
<?php
get_footer();
