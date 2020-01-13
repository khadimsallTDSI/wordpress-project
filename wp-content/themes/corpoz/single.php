<?php
   /**
   * The template for displaying all pages.
   *
   * This is the template that displays all pages by default.
   * Please note that this is the WordPress construct of pages
   * and that other 'pages' on your WordPress site will use a
   * different template.
   *
   * @package corpoz 
   */
   get_header();
   
   ?>
<div class="carousel-item active">
    <div class="carousel-caption1">
      <h2><?php the_title(); ?></h2>
    </div>
  </div>
<div class="sp-100">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-8">
            <?php if(have_posts()) : ?>
            <?php while(have_posts()) : the_post(); ?>
         <?php  get_template_part( 'content-parts/content','single' ); ?>
          <?php endwhile; ?>
            <?php endif; ?>
        </div>
       
         <div class="col-lg-4 col-md-4">
          <?php get_sidebar(); ?>
        </div>
      </div>
    </div>
  </div>
  <?php get_footer(); ?>