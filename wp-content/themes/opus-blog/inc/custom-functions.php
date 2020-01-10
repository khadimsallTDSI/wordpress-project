<?php
/**
 * Add sidebar class in body
 *
 * @since Opus Blog 1.0.0
 *
 */

add_filter('body_class', 'opus_blog_body_class');
function opus_blog_body_class($classes)
{
    $classes[] = 'at-sticky-sidebar';
    global $opus_blog_theme_options;
    
    if (is_singular()) {
        $sidebar = esc_attr($opus_blog_theme_options['opus-blog-sidebar-single-page']);
        if ($sidebar == 'single-no-sidebar') {
            $classes[] = 'single-no-sidebar';
        } elseif ($sidebar == 'single-left-sidebar') {
            $classes[] = 'single-left-sidebar';
        } elseif ($sidebar == 'single-middle-column') {
            $classes[] = 'single-middle-column';
        } else {
            $classes[] = 'single-right-sidebar';
        }
    }
    
        $sidebar = esc_attr($opus_blog_theme_options['opus-blog-sidebar-blog-page']);
        if ($sidebar == 'no-sidebar') {
            $classes[] = 'no-sidebar';
        } elseif ($sidebar == 'left-sidebar') {
            $classes[] = 'left-sidebar';
        } elseif ($sidebar == 'middle-column') {
            $classes[] = 'middle-column';
        } else {
            $classes[] = 'right-sidebar';
        }
    return $classes;
}

/**
 * Add layout class in body
 *
 * @since Opus Blog 1.0.0
 *
 */

add_filter('body_class', 'opus_blog_layout_body_class');
function opus_blog_layout_body_class($classes)
{
    global $opus_blog_theme_options;
    $layout = esc_attr($opus_blog_theme_options['opus-blog-column-blog-page']);
    if ($layout == 'masonry-post') {
        $classes[] = 'masonry-post';
    } else {
        $classes[] = 'one-column';
    }
    return $classes;
}

/**
 * Remove ... From Excerpt
 *
 * @since 1.0.0
 */
if (!function_exists('opus_blog_excerpt_more')) :
    function opus_blog_excerpt_more($more)
    {
        if (!is_admin()) {
            return '';
        }
    }
endif;
add_filter('excerpt_more', 'opus_blog_excerpt_more');

/**
 * Filter to change excerpt lenght size
 *
 * @since 1.0.0
 */
if (!function_exists('opus_blog_alter_excerpt')) :
    function opus_blog_alter_excerpt($length)
    {
        if (is_admin()) {
            return $length;
        }
        global $opus_blog_theme_options;
        $excerpt_length = absint($opus_blog_theme_options['opus-blog-excerpt-length']);
        if (!empty($excerpt_length)) {
            return $excerpt_length;
        }
        return 50;
    }
endif;
add_filter('excerpt_length', 'opus_blog_alter_excerpt');


/**
 * Post Navigation Function
 *
 * @since Opus Blog 1.0.0
 *
 * @param null
 * @return void
 *
 */
if (!function_exists('opus_blog_posts_navigation')) :
    function opus_blog_posts_navigation()
    {
        global $opus_blog_theme_options;
        $opus_blog_pagination_option = $opus_blog_theme_options['opus-blog-pagination-options'];
        if ('default' == $opus_blog_pagination_option) {
            the_posts_navigation();
        } elseif ('numeric' == $opus_blog_pagination_option) {
            echo "<div class='pagination'>";
            global $wp_query;
            $big = 999999999; // need an unlikely integer
            echo paginate_links(array(
                'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format' => '?paged=%#%',
                'current' => max(1, get_query_var('paged')),
                'total' => $wp_query->max_num_pages,
                'prev_text' => __('&laquo; Prev', 'opus-blog'),
                'next_text' => __('Next &raquo;', 'opus-blog'),
            ));
            echo "<div>";
        } else {
            return false;
        }
    }
endif;
add_action('opus_blog_action_navigation', 'opus_blog_posts_navigation', 10);

/**
 * Display related posts from same category
 *
 * @since Opus Blog 1.0.0
 *
 * @param int $post_id
 * @return void
 *
 */
if (!function_exists('opus_blog_related_post')) :
    
    function opus_blog_related_post($post_id)
    {
        
        global $opus_blog_theme_options;
        $title = esc_html($opus_blog_theme_options['opus-blog-single-page-related-posts-title']);
        if (0 == absint($opus_blog_theme_options['opus-blog-single-page-related-posts'])) {
            return;
        }
        $categories = get_the_category($post_id);
        if ($categories) {
            $category_ids = array();
            $category = get_category($category_ids);
            $categories = get_the_category($post_id);
            foreach ($categories as $category) {
                $category_ids[] = $category->term_id;
            }
            $count = $category->category_count;
            if ($count > 1) {
                ?>
                <div class="related-posts clearfix">
                    <h2 class="widget-title">
                        <?php echo esc_html($title); ?>
                    </h2>
                    <div class="related-posts-list">
                        <?php
                        $opus_blog_cat_post_args = array(
                            'category__in' => $category_ids,
                            'post__not_in' => array($post_id),
                            'post_type' => 'post',
                            'posts_per_page' => 2,
                            'post_status' => 'publish',
                            'ignore_sticky_posts' => true
                        );
                        $opus_blog_featured_query = new WP_Query($opus_blog_cat_post_args);
                        
                        while ($opus_blog_featured_query->have_posts()) : $opus_blog_featured_query->the_post();
                            ?>
                            <div class="show-2-related-posts">
                                <div class="post-wrap">
                                    <?php
                                    if (has_post_thumbnail()):
                                        ?>
                                        <figure class="post-media">
                                            <a href="<?php the_permalink() ?>">
                                                <?php the_post_thumbnail('full'); ?>
                                            </a>
                                        </figure>
                                        <?php
                                    endif;
                                    ?>
                                    <div class="post-content">
                                        <h2 class="post-title entry-title"><a
                                                    href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
                                        <div class="post-date">
                                            <?php echo get_the_date(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>
                </div> <!-- .related-post-block -->
                <?php
            }
        }
    }
endif;
add_action('opus_blog_related_posts', 'opus_blog_related_post', 10, 1);

/**
 * Display related posts from same category in Blog Page
 *
 * @since Opus Blog 1.0.2
 *
 * @param int $post_id
 * @return void
 *
 */
if (!function_exists('opus_blog_blog_related_post')) :
    
    function opus_blog_blog_related_post($post_id)
    {
        
        global $opus_blog_theme_options;
        $title = esc_html($opus_blog_theme_options['opus-blog-blog-page-related-posts-title']);
        if (0 == absint($opus_blog_theme_options['opus-blog-blog-page-related-posts'])) {
            return;
        }
        $categories = get_the_category($post_id);
        if ($categories) {
            $category_ids = array();
            $category = get_category($category_ids);
            $categories = get_the_category($post_id);
            foreach ($categories as $category) {
                $category_ids[] = $category->term_id;
            }
            $count = $category->category_count;
            if ($count > 1) {
                ?>
                <div class="related-posts clearfix">
                    <h2 class="related-post-widget-title">
                        <?php echo esc_html($title); ?>
                    </h2>
                    <div class="related-posts-list related-slide row">
                        <?php
                        $opus_blog_cat_post_args = array(
                            'category__in' => $category_ids,
                            'post__not_in' => array($post_id),
                            'post_type' => 'post',
                            'posts_per_page' => 5,
                            'post_status' => 'publish',
                            'ignore_sticky_posts' => true
                        );
                        $opus_blog_featured_query = new WP_Query($opus_blog_cat_post_args);
                        
                        while ($opus_blog_featured_query->have_posts()) : $opus_blog_featured_query->the_post();
                            ?>
                            <div class="col-sm-4">
                                <div class="post-wrap">
                                    <?php
                                    if (has_post_thumbnail()):
                                        ?>
                                        <figure class="post-media">
                                            <a href="<?php the_permalink() ?>">
                                                <?php the_post_thumbnail('opus-blog-related-size'); ?>
                                            </a>
                                        </figure>
                                        <?php
                                    endif;
                                    ?>
                                    <div class="post-content">
                                        <h2 class="post-title entry-title"><a
                                                    href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
                                        <div class="post-date">
                                            <?php echo get_the_date(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>
                </div> <!-- .related-post-block -->
                <?php
            }
        }
    }
endif;
add_action('opus_blog_blog_related_posts', 'opus_blog_blog_related_post', 10, 1);

/**
 * Goto Top functions
 *
 * @since Opus Blog 1.0.0
 *
 */

if (!function_exists('opus_blog_go_to_top')) :
    function opus_blog_go_to_top()
    {
        global $opus_blog_theme_options;
        $to_top = absint($opus_blog_theme_options['opus-blog-go-to-top']);
        if ($to_top == 1) {
            ?>
            <a id="toTop" class="go-to-top" href="#" title="<?php esc_attr_e('Go to Top', 'opus-blog'); ?>">
                <i class="fa fa-angle-double-up"></i>
            </a>
        <?php } else {
            return false;
        }
    } endif;
add_action('opus_blog_go_to_top_hook', 'opus_blog_go_to_top', 10, 1);

/**
 * Masonry Start Class and Id functions
 *
 * @since Opus Blog 1.0.0
 *
 */
if (!function_exists('opus_blog_masonry_start')) :
    function opus_blog_masonry_start()
    { ?>
        <div class="masonry-start"><div id="masonry-loop">
        
        <?php
    }
endif;
add_action('opus_blog_masonry_start_hook', 'opus_blog_masonry_start', 10, 1);

/**
 * Masonry end Div
 *
 * @since Opus Blog 1.0.0
 *
 */
if (!function_exists('opus_blog_masonry_end')) :
    function opus_blog_masonry_end()
    { ?>
        </div>
        </div>
        
        <?php
    }
endif;
add_action('opus_blog_masonry_end_hook', 'opus_blog_masonry_end', 10, 1);


/**
 * Functions to manage breadcrumbs
 */
if (!function_exists('opus_blog_breadcrumb_options')) :
    function opus_blog_breadcrumb_options()
    {
        global $opus_blog_theme_options;
        if (1 == absint($opus_blog_theme_options['opus-blog-extra-breadcrumb'])) {
            opus_blog_breadcrumbs();
        }
    }
endif;
add_action('opus_blog_breadcrumb_options_hook', 'opus_blog_breadcrumb_options');

/**
 * BreadCrumb Settings
 */
if (!function_exists('opus_blog_breadcrumbs')):
    function opus_blog_breadcrumbs()
    {
        if (!function_exists('opus_blog_breadcrumb_trail')) {
            require get_template_directory() . '/inc/breadcrumbs/breadcrumbs.php';
        }
        $breadcrumb_args = array(
            'container' => 'div',
            'show_browse' => false
        );
        global $opus_blog_theme_options;
        
        $opus_blog_you_are_here_text = esc_html($opus_blog_theme_options['opus-blog-breadcrumb-text']);
        if (!empty($opus_blog_you_are_here_text)) {
            $opus_blog_you_are_here_text = "<span class='location'>" . $opus_blog_you_are_here_text . " : </span>";
        }
        echo "<div class='breadcrumbs'>" . $opus_blog_you_are_here_text . "<div id='opus_blog-breadcrumbs'>";
        opus_blog_breadcrumb_trail($breadcrumb_args);
        echo "</div></div>";
    }
endif;
add_action('opus_blog_breadcrumbs_hook', 'opus_blog_breadcrumbs');

/**
 * Custom theme hooks
 *
 * This file contains hook functions attached to theme hooks.
 *
 * @package Opus Blog
 */
if (!function_exists('opus_blog_add_main_header')) :
    
    /**
     * Add main header.
     *
     * @since 1.0.0
     */
    function opus_blog_add_main_header()
    {
        
        get_template_part('template-parts/header/header', 'default');
    }
endif;

add_action('opus_blog_action_header', 'opus_blog_add_main_header', 10);

/**
 * Custom theme hook for slider
 *
 * This file contains hook functions attached to theme hooks.
 *
 * @package Opus Blog
 */
if (!function_exists('opus_blog_add_main_slider')) :
    
    /**
     * Add main slider.
     *
     * @since 1.0.0
     */
    function opus_blog_add_main_slider()
    {
        global $opus_blog_theme_options;
        $slider_default = $opus_blog_theme_options['opus-blog-select-category'];
        if ($slider_default <= 0) {
            get_template_part('template-parts/slider/slider', 'demo');
        } else {
            get_template_part('template-parts/slider/slider', 'default');
        }
    }
endif;
add_action('opus_blog_action_slider', 'opus_blog_add_main_slider', 10);

/**
 * Custom theme hook for promo section
 *
 * This file contains hook functions attached to theme hooks.
 *
 * @package Opus Blog
 */
if ( ! function_exists( 'opus_blog_promo_section' ) ) :
    
    /**
     * Add main slider.
     *
     * @since 1.0.0
     */
    function opus_blog_promo_section() {
            get_template_part( 'template-parts/promo/promo','default' );
    }
endif;
add_action( 'opus_blog_action_promo', 'opus_blog_promo_section', 10 );

/**
 * Jetpack Top Posts widget Image size
 * @since Opus Blog 1.0.0
 *
 * @param null
 * @return void
 */
function opus_blog_custom_thumb_size($get_image_options)
{
    $get_image_options['avatar_size'] = 600;
    
    return $get_image_options;
}

add_filter('jetpack_top_posts_widget_image_options', 'opus_blog_custom_thumb_size');


/**
 * Social Sharing Hook *
 * @since 1.0.0
 *
 * @param int $post_id
 * @return void
 *
 */
if ( !function_exists('opus_blog_social_sharing') ) :
  function opus_blog_social_sharing($post_id) {
      global $opus_blog_theme_options;
      if(0 === absint($opus_blog_theme_options['opus-blog-content-social-hide'])){
          return;
      }
    
    $opus_blog_url = get_the_permalink($post_id);
    $opus_blog_title = get_the_title($post_id);
    $opus_blog_image = get_the_post_thumbnail_url($post_id);

    //sharing url
    $opus_blog_twitter_sharing_url = esc_url('http://twitter.com/share?text='.$opus_blog_title.'&url='.$opus_blog_url);
    $opus_blog_facebook_sharing_url = esc_url('https://www.facebook.com/sharer/sharer.php?u='.$opus_blog_url);
    $opus_blog_pinterest_sharing_url = esc_url('http://pinterest.com/pin/create/button/?url='.$opus_blog_url.'&media='.$opus_blog_image.'&description='.$opus_blog_title);
    $opus_blog_linkedin_sharing_url = esc_url('http://www.linkedin.com/shareArticle?mini=true&title=' . $opus_blog_title . '&url=' . $opus_blog_url);

    ?>
    <div class="meta_bottom">
      <div class="text_share"><a href=""><i class="fa fa-share-alt"></i> <?php _e('Share', 'opus-blog');?></a></div>
      <div class="post-share">
        <a target="_blank" href="<?php echo esc_url($opus_blog_facebook_sharing_url); ?>"><i class="fa fa-facebook"></i></a>
        <a target="_blank" href="<?php echo esc_url($opus_blog_twitter_sharing_url); ?>"><i class="fa fa-twitter"></i></a>
        <a target="_blank" href="<?php echo esc_url($opus_blog_pinterest_sharing_url); ?>"><i class="fa fa-pinterest"></i></a>
        <a target="_blank" href="<?php echo esc_url($opus_blog_linkedin_sharing_url); ?>"><i class="fa fa-linkedin"></i></a>
      </div>
    </div>
    <?php
  }
endif;
add_action( 'opus_blog_social_sharing', 'opus_blog_social_sharing', 10 );


/**
 * Google Fonts
 *
 * @since Opus Blog 1.0.1
 *
 * @param null
 * @return array
 *
 */
if ( !function_exists('opus_blog_google_fonts') ) :
    function opus_blog_google_fonts() {
        $opus_blog_google_fonts =  array(
            'ABeeZee:400,400italic' => 'ABeeZee',
            'Abel' => 'Abel',
            'Abril+Fatface' => 'Abril Fatface',
            'Aldrich' => 'Aldrich',
            'Alegreya:400,400italic,700,900' => 'Alegreya',
            'Alex+Brush' => 'Alex Brush',
            'Alfa+Slab+One' => 'Alfa Slab One',
            'Amaranth:400,400italic,700' => 'Amaranth',
            'Andada' => 'Andada',
            'Anton' => 'Anton',
            'Archivo+Black' => 'Archivo Black',
            'Archivo+Narrow:400,400italic,700' => 'Archivo Narrow',
            'Arimo:400,400italic,700' => 'Arimo',
            'Arvo:400,400italic,700' => 'Arvo',
            'Asap:400,400italic,700' => 'Asap',
            'Bangers' => 'Bangers',
            'BenchNine:400,700' => 'BenchNine',
            'Bevan' => 'Bevan',
            'Bitter:400,400italic,700' => 'Bitter',
            'Bree+Serif' => 'Bree Serif',
            'Cabin:400,400italic,500,600,700' => 'Cabin',
            'Cabin+Condensed:400,500,600,700' => 'Cabin Condensed',
            'Cantarell:400,400italic,700' => 'Cantarell',
            'Carme' => 'Carme',
            'Cherry+Cream+Soda' => 'Cherry Cream Soda',
            'Cinzel:400,700,900' => 'Cinzel',
            'Comfortaa:400,300,700' => 'Comfortaa',
            'Cookie' => 'Cookie',
            'Covered+By+Your+Grace' => 'Covered By Your Grace',
            'Crete+Round:400,400italic' => 'Crete Round',
            'Crimson+Text:400,400italic,600,700' => 'Crimson Text',
            'Cuprum:400,400italic' => 'Cuprum',
            'Dancing+Script:400,700' => 'Dancing Script',
            'Didact+Gothic' => 'Didact Gothic',
            'Droid+Sans:400,700' => 'Droid Sans',
            'Dosis:400,300,600,800' => 'Dosis',
            'Droid+Serif:400,400italic,700' => 'Droid Serif',
            'Economica:400,700,400italic' => 'Economica',
            'EB+Garamond' => 'EB Garamond',
            'Exo:400,300,400italic,600,800' => 'Exo',
            'Exo +2:400,300,400italic,600,700,900' => 'Exo 2',
            'Fira+Sans:400,500' => 'Fira Sans',
            'Fjalla+One' => 'Fjalla One',
            'Francois+One' => 'Francois One',
            'Fredericka+the+Great' => 'Fredericka the Great',
            'Fredoka+One' => 'Fredoka One',
            'Fugaz+One' => 'Fugaz One',
            'Great+Vibes' => 'Great Vibes',
            'Handlee' => 'Handlee',
            'Hammersmith+One' => 'Hammersmith One',
            'Hind:400,300,600,700' => 'Hind',
            'Inconsolata:400,700' => 'Inconsolata',
            'Indie+Flower' => 'Indie Flower',
            'Istok+Web:400,400italic,700' => 'Istok Web',
            'Josefin+Sans:400,600,700,400italic' => 'Josefin Sans',
            'Josefin+Slab:400,400italic,700,600' => 'Josefin Slab',
            'Jura:400,300,500,600' => 'Jura',
            'Karla:400,400italic,700' => 'Karla',
            'Kaushan+Script' => 'Kaushan Script',
            'Kreon:400,300,700' => 'Kreon',
            'Lateef' => 'Lateef',
            'Lato:400,300,400italic,900,700' => 'Lato',
            'Libre+Baskerville:400,400italic,700' => 'Libre Baskerville',
            'Limelight' => 'Limelight',
            'Lobster' => 'Lobster',
            'Lobster+Two:400,700,700italic' => 'Lobster Two',
            'Lora:400,400i' => 'Lora, serif',
            'Maven+Pro:400,500,700,900' => 'Maven Pro',
            'Merriweather:400,400italic,300,900,700' => 'Merriweather',
            'Merriweather+Sans:400,400italic,700,800' => 'Merriweather Sans',
            'Monda:400,700' => 'Monda',
            'Montserrat:400,700' => 'Montserrat',
            'Muli:400,300italic,300' => 'Muli',
            'News+Cycle:400,700' => 'News Cycle',
            'Noticia+Text:400,400italic,700' => 'Noticia Text',
            'Noto +Sans:400,400italic,700' => 'Noto Sans',
            'Noto +Serif:400,400italic,700' => 'Noto Serif',
            'Nunito:400,300,700' => 'Nunito',
            'Old+Standard +TT:400,400italic,700' => 'Old Standard TT',
            'Open+Sans:400,400italic,600,700' => 'Open Sans',
            'Open+Sans+Condensed:300,300italic,700' => 'Open Sans Condensed',
            'Oswald:400,300,700' => 'Oswald',
            'Oxygen:400,300,700' => 'Oxygen',
            'Pacifico' => 'Pacifico',
            'Passion+One:400,700,900' => 'Passion One',
            'Pathway+Gothic+One' => 'Pathway Gothic One',
            'Patua+One' => 'Patua One',
            'Poiret+One' => 'Poiret One',
            'Pontano+Sans' => 'Pontano Sans',
            'Play:400,700' => 'Play',
            'Playball' => 'Playball',
            'Playfair+Display:400,400italic,700,900' => 'Playfair Display',
            'PT+Sans:400,400italic,700' => 'PT Sans',
            'PT+Sans+Caption:400,700' => 'PT Sans Caption',
            'PT+Sans+Narrow:400,700' => 'PT Sans Narrow',
            'PT+Serif:400,400italic,700' => 'PT Serif',
            'Quattrocento+Sans:400,700,400italic' => 'Quattrocento Sans',
            'Questrial' => 'Questrial',
            'Quicksand:400,700' => 'Quicksand',
            'Raleway:400,300,500,600,700,900' => 'Raleway',
            'Righteous' => 'Righteous',
            'Roboto:400,500,300,700,400italic' => 'Roboto',
            'Roboto+Condensed:400,300,400italic,700' => 'Roboto Condensed',
            'Roboto+Slab:400,300,700' => 'Roboto Slab',
            'Rokkitt:400,700' => 'Rokkitt',
            'Ropa+Sans:400,400italic' => 'Ropa Sans',
            'Russo+One' => 'Russo One',
            'Sanchez:400,400italic' => 'Sanchez',
            'Satisfy' => 'Satisfy',
            'Shadows+Into+Light' => 'Shadows Into Light',
            'Sigmar+One' => 'Sigmar One',
            'Signika:400,300,700' => 'Signika',
            'Six+Caps' => 'Six Caps',
            'Slabo+27px' => 'Slabo 27px',
            'Source+Sans+Pro:400,400italic,600,900,300' => 'Source Sans Pro',
            'Squada+One' => 'Squada One',
            'Tangerine:400,700' => 'Tangerine',
            'Tinos:400,400italic,700' => 'Tinos',
            'Titillium+Web:400,300,400italic,700,900' => 'Titillium Web',
            'Ubuntu:400,400italic,500,700' => 'Ubuntu',
            'Ubuntu+Condensed' => 'Ubuntu Condensed',
            'Varela+Round' => 'Varela Round',
            'Vollkorn:400,400italic,700' => 'Vollkorn',
            'Voltaire' => 'Voltaire',
            'Yanone+Kaffeesatz:400,300,700' => 'Yanone Kaffeesatz'
        );
        return apply_filters( 'opus_blog_google_fonts', $opus_blog_google_fonts );
    }
endif;


/**
 * Enqueue the list of fonts.
 */
function opus_blog_customizer_fonts() {
    wp_enqueue_style( 'opus_blog_customizer_fonts', 'https://fonts.googleapis.com/css?family=ABeeZee|Abel|Abril+Fatface|Aldrich|Alegreya|Alex+Brush|Alfa+Slab+One|Amaranth|Andada|Anton|Archivo+Black|Archivo+Narrow|Arimo|Arimo|Arvo|Asap|Bangers|BenchNine|Bevan|Bitter|Bree+Serif|Cabin|Cabin+Condensed|Cantarell|Carme|Cherry+Cream+Soda|Cinzel|Comfortaa|Cookie|Covered+By+Your+Grace|Crete+Round|Crimson+Text|Cuprum|Dancing+Script|Didact+Gothic|Droid+Sans|Dosis|Droid+Serif|Economica|EB+Garamond|Exo|Exo|Fira+Sans|Fjalla+One|Francois+One|Fredericka+the+Great|Fredoka+One|Fugaz+One|Great+Vibes|Handlee|Hammersmith+One|Hind|Inconsolata|Indie+Flower|Istok+Web|Josefin+Sans|Josefin+Slab|Jura|Karla|Kaushan+Script|Kreon|Lateef|Lato|Lato|Libre+Baskerville|Limelight|Lobster|Lobster+Two|Lora|Maven+Pro|Merriweather|Merriweather+Sans|Monda|Montserrat|Muli|News+Cycle|Noticia+Text|Noto +Sans|Noto +Serif|Nunito|Old+Standard +TT|Open+Sans|Open+Sans+Condensed|Oswald|Oxygen|Pacifico|Passion+One|Passion One|Pathway+Gothic+One|Patua+One|Poiret+One|Pontano+Sans|Play|Playball|Playfair+Display|PT+Sans|PT+Sans+Caption|PT+Sans+Narrow|PT+Serif|Quattrocento+Sans|Questrial|Quicksand|Raleway|Righteous|Roboto|Roboto+Condensed|Roboto+Slab|Rokkitt|Ropa+Sans|Russo+One|Sanchez|Satisfy|Shadows+Into+Light|Sigmar+One|Signika|Six+Caps|Slabo+27px|Source+Sans+Pro|Squada+One|Tangerine|Tinos|Titillium+Web|Ubuntu|Ubuntu+Condensed|Varela+Round|Vollkorn|Voltaire|Yanone+Kaffeesatz', array(), null );
}
add_action( 'customize_controls_print_styles', 'opus_blog_customizer_fonts' );
add_action( 'customize_preview_init', 'opus_blog_customizer_fonts' );

add_action(
    'customize_controls_print_styles',
    function() {
        ?>
        <style>
            <?php
            $arr = array( 'ABeeZee','Abel','Abril+Fatface','Aldrich','Alegreya','Alex+Brush','Alfa+Slab+One','Amaranth','Andada','Anton','Archivo+Black','Archivo+Narrow','Arimo','Arimo','Arvo','Asap','Bangers','BenchNine','Bevan','Bitter','Bree+Serif','Cabin','Cabin+Condensed','Cantarell','Carme','Cherry+Cream+Soda','Cinzel','Comfortaa','Cookie','Covered+By+Your+Grace','Crete+Round','Crimson+Text','Cuprum','Dancing+Script','Didact+Gothic','Droid+Sans','Dosis','Droid+Serif','Economica','EB+Garamond','Exo','Exo','Fira+Sans','Fjalla+One','Francois+One','Fredericka+the+Great','Fredoka+One','Fugaz+One','Great+Vibes','Handlee','Hammersmith+One','Hind','Inconsolata','Indie+Flower','Istok+Web','Josefin+Sans','Josefin+Slab','Jura','Karla','Kaushan+Script','Kreon','Lateef','Lato','Lato','Libre+Baskerville','Limelight','Lobster','Lobster+Two','Lora','Maven+Pro','Merriweather','Merriweather+Sans','Monda','Montserrat','Muli','News+Cycle','Noticia+Text','Noto +Sans','Noto +Serif','Nunito','Old+Standard +TT','Open+Sans','Open+Sans+Condensed','Oswald','Oxygen','Pacifico','Passion+One','Passion One','Pathway+Gothic+One','Patua+One','Poiret+One','Pontano+Sans','Play','Playball','Playfair+Display','PT+Sans','PT+Sans+Caption','PT+Sans+Narrow','PT+Serif','Quattrocento+Sans','Questrial','Quicksand','Raleway','Righteous','Roboto','Roboto+Condensed','Roboto+Slab','Rokkitt','Ropa+Sans','Russo+One','Sanchez','Satisfy','Shadows+Into+Light','Sigmar+One','Signika','Six+Caps','Slabo+27px','Source+Sans+Pro','Squada+One','Tangerine','Tinos','Titillium+Web','Ubuntu','Ubuntu+Condensed','Varela+Round','Vollkorn','Voltaire','Yanone+Kaffeesatz');
    
            foreach ( $arr as $font ) {
                echo '.customize-control select option[value*="' . $font . '"] {font-family: ' . $font . '; font-size: 22px;}';
            }
            ?>
        </style>
        <?php
    }
);

// Change number or products per row to 3
add_filter('loop_shop_columns', 'opus_blog_loop_columns');
if (!function_exists('opus_blog_loop_columns')) {
    function opus_blog_loop_columns() {
        return 3; // 3 products per row
    }
}