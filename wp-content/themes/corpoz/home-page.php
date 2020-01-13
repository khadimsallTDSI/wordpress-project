<?php 
	/**
	 * Template Name: Home Page
	 *
	 */

get_header();
get_template_part('section-parts/front-page-slider');
get_template_part('section-parts/front-page-about');
get_template_part( 'section-parts/front-page-testimonial' );
get_template_part( 'section-parts/front-page-thecontent' );
get_template_part( 'section-parts/front-page-blogs' );

 get_footer(); ?>