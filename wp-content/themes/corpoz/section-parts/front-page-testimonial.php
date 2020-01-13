<?php
/**
 * Template part - Service Section of FrontPage
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package corpoz
*/
$corpoz_testis_section = get_theme_mod( 'corpoz_testis_section_hideshow','hide');
$corpoz_testis_title   =  get_theme_mod('corpoz_testis_title');  

$corpoz_testi_no = 6;

$corpoz_testi_page      = array();
for( $x = 1; $x <= $corpoz_testi_no; $x++ ) {
    $corpoz_testi_page[]    =  get_theme_mod( "corpoz_testi_page_$x", 1 );
    $corpoz_testi_position[]  =  get_theme_mod("corpoz_testi_position_$x",' ');

}

$corpoz_testi_args  = array(
    'post_type' => 'page',
    'post__in' => array_map( 'absint', $corpoz_testi_page ),
    'posts_per_page' => absint($corpoz_testi_no),
    'orderby' => 'post__in'
); 

$corpoz_testi_query = new wp_Query( $corpoz_testi_args );


if( $corpoz_testis_section == "show") {
    ?>
<section class="testimonials gradi-after sp-100">
    <div class="container">
      <div class="row ">
        <div class="offset-lg-2 col-lg-8">
            <?php if($corpoz_testis_title != "")  {?>
          <div class="title_box title_box-60 white">            
            <h2><?php echo esc_html($corpoz_testis_title); ?></h2>              
            <div class="title_border"></div>
          </div>
          <?php } ?>
        </div>
      </div>     
      <div class="row">
        <div class="col-md-12">
          <div class="owl-carousel owl-theme testimonials_slider">
            <?php
              $count = 0;
              while($corpoz_testi_query->have_posts() && $count <= 5 ) :
                  $corpoz_testi_query->the_post();
                  ?>
					<div class="item">
					  <div class="testimonials_detail1">
						<?php if(has_post_thumbnail()) : 
						 the_post_thumbnail();
						 endif; ?>
						<div class="client_detail_box">
						  <?php the_excerpt(); ?>
						  <div class="client_name">
							<h2><?php the_title(); ?></h2>
						   <?php if($corpoz_testi_position[$count] != "")  {?>
							<p><?php echo esc_html($corpoz_testi_position[$count]); ?></p>
							<?php } ?>
						  </div>
						</div>
					  </div>
					</div>
             <?php
              $count = $count + 1;
              endwhile;
              wp_reset_postdata();
              ?>
          </div>
        </div>
      </div>
     
    </div>
  </section>
  <?php } ?>