<?php
/**
 * Opus Blog Promo Default
 * @since Opus Blog 1.0.0
 *
 * @param null
 * @return void
 *
 */
global $opus_blog_theme_options;
$promo_cat = absint($opus_blog_theme_options['opus-blog-promo-select-category']);
if( $promo_cat > 0 && is_home() )
{ ?>
    <section class="opus-blog-promo-section">
        <?php if ( is_front_page() && is_home() )
        {  ?>
            <div class="container">
                <div class="promo-section promo-one">
                    <?php
                    $args = array(
                        'cat' => $promo_cat ,
                        'posts_per_page' => 3,
                        'order'=> 'DESC'
                    );
                    
                    $query = new WP_Query($args);
                    if($query->have_posts()):
                        while($query->have_posts()):
                            $query->the_post();
                            ?>
                            <div class="item">
                                <a href="<?php the_permalink(); ?>">
                                    <?php
                                    
                                    if(has_post_thumbnail())
                                    {
                                        
                                        $image_id  = get_post_thumbnail_id();
                                        $image_url = wp_get_attachment_image_src($image_id,'opus-blog-promo-post',true);
                                        ?>
                                        
                                        <figure>
                                            <img src="<?php echo esc_url($image_url[0]);?>">
                                        </figure>
                                    <?php   } ?>
                                    <div class="promo-content">
                                        <div class="post-tags">
                                            <?php $posttags = get_the_tags();
                                            
                                            if( !empty( $posttags ))
                                            {
                                                ?>
                                                
                                                <?php
                                                $count = 0;
                                                if ( $posttags )
                                                {
                                                    foreach( $posttags as $c_tag )
                                                    {
                                                        $count++;
                                                        if ( 1 == $count )
                                                        {
                                                            echo $c_tag->name;
                                                        }
                                                    }
                                                } ?>
                                            <?php   } ?>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endwhile; endif; wp_reset_postdata(); ?>
                </div>
            </div>
        <?php } ?>
    </section>
<?php   }