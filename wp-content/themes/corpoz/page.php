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
            	<?php if(have_posts()):?>
            		<?php while(have_posts()) : the_post(); ?>
						<div class="col-lg-8 col-md-12">
							<?php if(has_post_thumbnail()) : ?>
							<?php the_post_thumbnail(); ?>&nbsp;
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
                <div class="col-lg-4 col-md-12">
                   <?php get_sidebar(); ?>
                </div>
            </div>
        </div>
    </div>
  <?php get_footer(); ?>