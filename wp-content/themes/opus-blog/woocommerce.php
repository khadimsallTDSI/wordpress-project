<?php
/**
 * The template for displaying WooCommerce Posts
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
<div class="breadcrumbs-wrap">
    <?php do_action('opus_blog_breadcrumb_options_hook'); ?> <!-- Breadcrumb hook -->
</div>
    <div id="primary" class="col-sm-8 col-md-8 content-area">
        <div class="content-area post-wrap">
            <div class="post-wrapper post-content">
                <article id="main">
                    <?php
                    if (have_posts()) :
                        woocommerce_content();
                    endif;
                    ?>
                </article><!-- #main -->
            </div>
        </div><!-- #primary -->
    </div>
        <?php get_sidebar(); ?>
        </div><!-- .row -->
    </div><!-- .container -->
</section><!-- #content -->
<?php
get_footer();