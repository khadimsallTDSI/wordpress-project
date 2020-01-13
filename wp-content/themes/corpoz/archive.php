<?php
       /**
       * The template for displaying all posts.
       *
       * This is the template that displays all posts by default.
       * Please note that this is the WordPress construct of posts
       * and that other 'posts' on your WordPress site will use a
       * different template.
       *
       * @package corpoz 
       */
       get_header();
       
       ?>
  <div class="carousel-item active">
    <div class="carousel-caption1">
     <?php the_archive_title('<h2>', '</h2>'); ?>
    </div>
  </div>  

 <div class="sp-100">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-12">
          <div class="row">
              <?php if(have_posts()) : ?>
               <?php while(have_posts()) : the_post(); ?>
            <div class="col-md-12">
              <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
               <?php get_template_part('content-parts/content', get_post_format()); ?>
              </div> 
            </div>
             <?php endwhile; ?>
             <?php endif; ?>
            <div class="pagination">
              <?php the_posts_pagination(
                array(
               'prev_text' => esc_html__('&lt;','corpoz'),
               'next_text' => esc_html__('&gt;','corpoz')
                 )
                 ); 
               ?>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-12">
         <?php get_sidebar(); ?>
        </div>
      </div>
    </div>
  </div>
  <?php get_footer(); ?>    