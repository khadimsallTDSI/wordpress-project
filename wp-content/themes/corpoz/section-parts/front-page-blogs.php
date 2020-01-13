<?php           
    $corpoz_blog_section =  get_theme_mod( 'corpoz_blog_section_hideshow', 'show' );
    $corpoz_blog_title=get_theme_mod('corpoz_blog_title');
    $corpoz_blog_subtitle=get_theme_mod('corpoz_blog_subtitle');

    if ($corpoz_blog_section =='show') { ?>
<section class="news sp-100" id="blog">
    <div class="container">
      <div class="row">
        <div class="offset-lg-2 col-lg-8">
          <?php if($corpoz_blog_title != "")   {?>
          <div class="title_box title_box-60">
            
            <h2><?php echo esc_html(get_theme_mod('corpoz_blog_title')); ?></h2>
            
            <div class="title_border"></div>
            <?php if($corpoz_blog_subtitle != "")   {?>
            <p><?php echo esc_html(get_theme_mod('corpoz_blog_subtitle')); ?></p>
            <?php } ?>
          </div>
          <?php } ?>
        </div>
      </div>
      <div class="row">
        <div class="dots-2 owl-carousel owl-theme ss_carousel latest_news_slider" id="slider1">
             <?php 
            $corpoz_latest_blog_posts = new WP_Query( array( 'posts_per_page' => 6 ) );
            if ( $corpoz_latest_blog_posts->have_posts() ) : 
                while ( $corpoz_latest_blog_posts->have_posts() ) : $corpoz_latest_blog_posts->the_post(); 
                    ?>       
				  <div class="item">
					<div class="col-md-12">
					  <div class="news_box">
						<div class="news_img">
						  <?php if(has_post_thumbnail()) : 
						   the_post_thumbnail();
						   endif; 
						   ?>                  
						</div>
						<div class="news_detail">
						  <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
						  <ul class="post-info">
							<li>
							  <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
								<i class="fa fa-user"></i><?php the_author(); ?></a>
							</li>
							<li>
							  <a>
								<i class="fa fa-calendar"></i></a> <a href="<?php echo esc_url( get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d') ) ) ; ?>"><?php echo esc_html(get_the_date()); ?></a>
							</li>
						   
						  </ul>
						<?php the_excerpt(); ?>
						  <a href="<?php the_permalink(); ?>" class="read-btn"><?php echo esc_html__('Read More','corpoz'); ?>
							<i class="fa fa-chevron-right" aria-hidden="true"></i>
						  </a>
						</div>
					  </div>
					</div>
				  </div>
			  <?php 
            endwhile; 
			 wp_reset_postdata();
            endif;
          ?>     
        </div>
      </div>
    </div>
  </section>
  <?php } ?>