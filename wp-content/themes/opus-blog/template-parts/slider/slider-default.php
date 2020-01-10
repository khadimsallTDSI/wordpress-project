<?php
/**
 * Opus Blog Slider Function
 * @since Opus Blog 1.0.0
 *
 * @param null
 * @return void
 *
 */
global $opus_blog_theme_options;
$s_cat_id = absint($opus_blog_theme_options['opus-blog-select-category']);
$slider_num = absint($opus_blog_theme_options['opus-blog-slider-number']);
$slide_recommend = absint($opus_blog_theme_options['opus_blog_enable_slider_recommendation']);
$slide_boxed = esc_attr($opus_blog_theme_options['opus_blog_enable_slider_boxed']);

$args = array(
    'posts_per_page' => $slider_num,
    'paged' => 1,
    'cat' => $s_cat_id,
    'post_type' => 'post'
);
$slider_query = new WP_Query($args);
if ($slider_query->have_posts()):
    ?>
    <div class="full <?php echo $slide_boxed;?> ">
        <div class="main-slider">
            <?php while ($slider_query->have_posts()) : $slider_query->the_post();
                if (has_post_thumbnail()) {
                    $image_id = get_post_thumbnail_id();
                    $image_url = wp_get_attachment_image_src($image_id, '', true);
                    ?>
                    <div class="slider-items ">
                        <div class="d-flex align-items-center slider-height img-cover"
                             style="background-image: url(<?php echo esc_url($image_url[0]); ?>)">
                            <div class="container">
                                <div class="caption">
                                    <?php
                                    $categories = get_the_category();
                                    if (!empty($categories)) {
                                        echo '<a class="s-cat" href="' . esc_url(get_category_link($categories[0]->term_id)) . '" title="Lifestyle">' . esc_html($categories[0]->name) . '</a>';
                                    }
                                    ?>
                                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    <div class="entry-meta">
                                        <?php
                                        opus_blog_posted_on();
                                        opus_blog_posted_by();
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="overley"></div>
                        </div>
                    </div>
                <?php } endwhile;
            wp_reset_postdata(); ?>
        </div>
    </div>
<?php endif; ?>

<?php
$args = array(
    'posts_per_page' => $slider_num,
    'paged' => 1,
    'cat' => $s_cat_id,
    'post_type' => 'post'
);
$slider_query = new WP_Query($args);
if ($slider_query->have_posts()):
    ?>
    <?php if($slide_recommend == 1 ){ ?>
    <div class="bottom-caption">
        <div class="container <?php echo $slide_boxed;?>">
            <div class="header-slider-thumbnail">
                <?php $i = 1; ?>
                <?php while ($slider_query->have_posts()) : $slider_query->the_post(); ?>
                    <div class="slider-items">
                        <?php
                        $categories = get_the_category();
                        if (!empty($categories)) {
                            echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '" title="Lifestyle">' . esc_html($categories[0]->name) . '</a>';
                        }
                        ?>
                        <h4><?php the_title(); ?></h4>
                        <span><?php echo $i; ?></span>
                    </div>
                    <?php $i++; ?>
                <?php endwhile;
                wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
    <?php } ?>
<?php endif;