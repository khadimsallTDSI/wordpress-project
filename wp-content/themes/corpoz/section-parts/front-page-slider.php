 <?php
        /**
        * Template part - Features Section of FrontPage
        *
        * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
        *
        * @package corpoz
        */
        $corpoz_slider_section     = get_theme_mod( 'corpoz_slider_section_hideshow','hide');
        $corpoz_slider_no        = 3;
        $corpoz_slider_pages      = array();
        for( $i = 1; $i <= $corpoz_slider_no; $i++ ) {
        $corpoz_slider_pages[]    =  get_theme_mod( "corpoz_slider_page_$i", 1 );
        $corpoz_slider_btntxt[]    =  get_theme_mod( "corpoz_slider_btntxt_$i", '' );
        $corpoz_slider_btnurl[]    =  get_theme_mod( "corpoz_slider_btnurl_$i", '' );
        $corpoz_slider_btntxt2[]    =  get_theme_mod( "corpoz_slider_btntxt2_$i", '' );
        $corpoz_slider_btnurl2[]    =  get_theme_mod( "corpoz_slider_btnurl2_$i", '' );
        }
        $corpoz_slider_args  = array(
        'post_type' => 'page',
        'post__in' => array_map( 'absint', $corpoz_slider_pages ),
        'posts_per_page' => absint($corpoz_slider_no),
        'orderby' => 'post__in'
        ); 
        $corpoz_slider_query = new wp_Query( $corpoz_slider_args );
        if ($corpoz_slider_section =='show' && $corpoz_slider_query->have_posts() ) { ?>
  <section class="corp-slider slider-1">
    <div class="carousel-inner main-slider theme-1 owl-carousel owl-theme">
      <?php $count=0;
        while($corpoz_slider_query->have_posts()):
          $corpoz_slider_query->the_post();
          ?>
        <div class="slide-item">
          <?php if(has_post_thumbnail()) : 
                 the_post_thumbnail();
                 endif; 
            ?>
         <div class="slide-overlay">
          <div class="slide-table">
            <div class="slide-table-cell">
              <div class="container">
                <div class="slide-content">
                  <h2><?php the_title(); ?></h2>
                    <?php the_excerpt(); ?>
                  <div class="slider_btn">
                     <?php
                     if ( !empty( $corpoz_slider_btntxt[$count] ) && !empty( $corpoz_slider_btnurl[$count]) ) { ?>
                     <a href="<?php echo esc_url($corpoz_slider_btnurl[$count]); ?>" class="btn-custom get_started"><?php echo esc_html($corpoz_slider_btntxt[$count]); ?></a>
                     <?php } ?>
                      <?php
                    if(!empty($corpoz_slider_btntxt2[$count])) { ?>
                    <a href="<?php echo esc_url($corpoz_slider_btnurl2[$count]); ?>" class="btn-custom explore"><?php echo esc_html($corpoz_slider_btntxt2[$count]); ?></a>
                  <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
           
      </div>
      <?php $count=$count+1;
             endwhile;
             wp_reset_postdata();
             ?>
    </div>
  </section>
   <?php }
else
{?>
	<div class="carousel-item active">
    <div class="carousel-caption1">
      <?php if (is_home() || is_front_page()) { ?>
        <h2><?php echo esc_html__('Home', 'corpoz') ?></h2>
     <?php } ?>
    </div>
  </div>
<?php }


   ?>