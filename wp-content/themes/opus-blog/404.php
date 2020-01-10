<?php
/**
* The template for displaying 404 pages (not found)
*
* @link https://codex.wordpress.org/Creating_an_Error_404_Page
*
* @package Opus_Blog
*/
get_header();
?>
<section id="content" class="site-content posts-container">
    <div class="container">
        <div class="row">
            <div id="primary" class="col-md-12 page-404-container">
                <main id="main" class="site-main">
                    <div class="page-404-content">
                        <h1 class="error-code"><?php esc_html_e('404', 'opus-blog'); ?></h1>
                        <h1 class="page-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'opus-blog'); ?></h1>
                        <p><?php esc_html_e('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'opus-blog'); ?></p>
                        <?php get_search_form(); ?>
                        <div class="back_home">
                            <a href="<?php echo esc_url(home_url('/')); ?>"
                            rel="home"><?php esc_html_e('Back to Home', 'opus-blog'); ?></a>
                    </div>
                    </div><!-- .error-404 -->
                </main><!-- #main -->
            </div><!-- #primary -->
        </div><!-- .row -->
    </div><!-- .container -->
</section><!-- #content -->
<?php get_footer();