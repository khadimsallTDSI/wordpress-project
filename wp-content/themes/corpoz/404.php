<?php
       /**
       * The template for displaying error.
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
  <main class="content1">
        <div class="error_con">
            <h1><?php echo esc_html__('We Are Sorry...','corpoz'); ?></h1>
            <p><?php echo esc_html__('Page Not Found','corpoz'); ?></p>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="back_to_home"><?php echo esc_html__('Back To Home','corpoz'); ?> </a>
        </div>
    </main>
  <?php get_footer(); ?>    