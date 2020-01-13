<?php
       /**
       * Template Name: Full-width 
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
      <h2><?php the_title(); ?></h2>
      <div class="breadcrumbs">
      </div>
    </div>
  </div>

  <section class="page sp-100">
    <div class="container">
      <div class="row clearfix">
      	<?php if(have_posts()) : ?>
      		<?php while(have_posts()) : the_post(); ?>
          <div class="col-sm-12">
		   <?php if(has_post_thumbnail()) : ?>
            <?php the_post_thumbnail(); ?>
			<?php endif; ?>
             <?php the_content(); ?>
              <?php
               wp_link_pages( array(
                 'before' => '<div class="page-links">' . esc_html__('Pages: ', 'corpoz' ),
                'after'  => '</div>',
                ) );
                  ?>
                  <div class="col-md-12">
                   <?php if ( comments_open() || get_comments_number() ) :
                      comments_template();
                      endif; ?> 
                </div>
          </div>
         <?php endwhile; ?>
         <?php endif; ?>
      </div>
    </div>
  </section>
 <?php get_footer(); ?>