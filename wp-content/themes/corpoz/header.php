<?php wp_head(); ?> 
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif; ?>
<?php wp_head(); ?>

</head>
   <div id="preloader"></div>
<body <?php body_class(); ?>>
  <!-- /scroll_to_top start-->
  <a href="<?php echo esc_url('#','corpoz') ?>" class="scrollToTop">
    <i class="fa fa-arrow-up" aria-hidden="true"></i>
  </a>

 <header class="menu-one">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <nav class="navbar navbar-expand-lg">
            <!-- Brand -->
            <h2 class="nav-brand">
              <?php if (has_custom_logo()) : ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <?php the_custom_logo(); ?>
                        </a>
                        <?php  
                            else : 
                             if (display_header_text()==true){ ?>
                             <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-link d-flex align-items-center">
                                <h2 class="blogtitle">
                                <?php bloginfo( 'title' ); ?>
                                </h2>
                             </a>
                             <?php } endif; ?>
            </h2>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-content" aria-controls="nav-content"
              aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
              <span class="navbar-toggler-icon"></span>
              <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Links -->
            <div class="main-menu collapse navbar-collapse" id="nav-content">
              <?php wp_nav_menu( 
                            array(
                               'container'        => '', 
                               'theme_location'    => 'primary', 
                               'menu_class'        => 'dropdown', 
                               'items_wrap'        => '<ul class="navbar-nav">%3$s</ul>',
                               'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                                'walker'            => new WP_Bootstrap_Navwalker()
                            )
                            ); 
                            ?>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </header>