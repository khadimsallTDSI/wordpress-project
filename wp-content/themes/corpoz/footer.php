<footer>
    <div class="container">
      <div class="row clearfix">
      <?php dynamic_sidebar('corpoz-footer-widget-area'); ?>

      </div>
    </div>
  </footer>
   <?php $corpoz_footer_section = get_theme_mod('corpoz_footer_section_hideshow','show');
    $corpoz_footer_title = get_theme_mod('corpoz_footer_text');
    if ($corpoz_footer_section =='show') { 
?>
  <div class="footer_bottom">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="copyright">
            <?php if( $corpoz_footer_title ) : ?>
            <p><?php echo wp_kses_post( html_entity_decode($corpoz_footer_title)); ?></p>

            <p> <?php else : 
                        /* translators: 1: poweredby, 2: link, 3: span tag closed  */
                        printf( esc_html__( ' Theme: powered by:WordPress %1$sDesign By %2$s%3$s', 'corpoz' ), '<span>', '<a href="'. esc_url( __( 'https://profiles.wordpress.org/themeslook/', 'corpoz' ) ) .'" target="_blank">"'.esc_html__('themeslook','corpoz').'"</a>', '</span>' );?></p>
             <?php endif;  ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } 
wp_footer(); ?>