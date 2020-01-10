<?php
/**
 * Opus Blog Slider Dummy
 * @since Opus Blog 1.0.0
 *
 * @param null
 * @return void
 *
 */
?>
    <div class="main-slider">
        <?php $img_slide = get_template_directory_uri().'/assets/images/slider-demo.jpg'; ?>
                <div class="slider-items">
                    <div class="d-flex align-items-center slider-height img-cover"
                         style="background-image: url(<?php echo esc_url($img_slide); ?>)">
                        <div class="container">
                            <div class="caption">
                               <a class="s-cat" href="" title="Lifestyle"><?php esc_html_e('Slider','opus-blog'); ?></a>
                                <h2><a href="#"><?php esc_html_e('Welcome to Opus Blog','opus-blog'); ?></a></h2>
                                <div class="entry-meta">
                                    <?php
                                    opus_blog_posted_on();
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="overley"></div>
                    </div>
                </div>
    </div>