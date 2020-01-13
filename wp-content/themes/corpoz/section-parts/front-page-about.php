<?php 
/**
 * Template part - About Us Section of FrontPage
 *
 *
 * @package corpoz
 */

$corpoz_enable_about     = get_theme_mod( 'corpoz_aboutus_section_hideshow','hide'); 
$corpoz_count_section = get_theme_mod( 'corpoz_count_section_hideshow','hide');   
if( $corpoz_enable_about == "show" || $corpoz_count_section == "show" ) :
?>

<section class="about-3 sp-100">
    <div class="container">
      <?php


$corpoz_about_no        = 1;
$corpoz_about_pages      = array();
for( $i = 1; $i <= $corpoz_about_no; $i++ ) {
    $corpoz_about_pages[]    =  get_theme_mod( "corpoz_about_page_$i", 1 );
    $corpoz_about_btntxt[]    =  get_theme_mod( "corpoz_about_btntxt_$i", '' );
    $corpoz_about_btnurl[]    =  get_theme_mod( "corpoz_about_btnurl_$i", '' );
    $corpoz_about_title   =  get_theme_mod('corpoz_about_title');
}

$corpoz_about_args  = array(
    'post_type' => 'page',
    'post__in' => array_map( 'absint', $corpoz_about_pages ),
    'posts_per_page' => absint($corpoz_about_no),
    'orderby' => 'post__in'
    
); 

 if($corpoz_enable_about == "hide"){
      echo "<style>.achievements-2 {
        border-top: none !important;
        }</style>";
     }
$corpoz_about_query = new   wp_Query( $corpoz_about_args );

	if( $corpoz_enable_about == "show" && $corpoz_about_query->have_posts() ) :
		$count = 0;
		while($corpoz_about_query->have_posts()) :
			$corpoz_about_query->the_post();
			?>
		  <div class="row">
			<div class="col-lg-5 col-md-5">
			  <?php if(has_post_thumbnail()){ ?>
			  <div class="video_bg">
				<?php the_post_thumbnail(); ?>
			  </div>
			<?php } ?>
			</div>
			<div class="col-lg-7 col-md-7">
			  <div class="about_box">
				<?php if($corpoz_about_title != "") {?>
					<h4><?php echo esc_html($corpoz_about_title); ?></h4>
				 <?php } ?>
				<h3><?php the_title(); ?></h3>
				<?php the_content(); ?>
				<?php if (!empty($corpoz_about_btntxt[$count])) { ?>
				<div class="readmore">
				  <a href="<?php echo esc_url($corpoz_about_btnurl[$count]); ?>" class="about_btn dark"><?php echo esc_html($corpoz_about_btntxt[$count]); ?></a>
				</div>
			  <?php } ?>
			  </div>
			</div>
		  </div>
		  <?php
			$count = $count + 1;
			endwhile;
			wp_reset_postdata();
		   endif;
		?>
    </div>
     
  </section>
  <?php endif; ?>