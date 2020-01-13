<?php
/**
 * corpoz Theme Customizer
 *
 * @package corpoz
 */


/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */


function corpoz_customize_register( $wp_customize ) {
	
	// corpoz theme choice options
    if (!function_exists('corpoz_section_choice_option')) :
        function corpoz_section_choice_option()
        {
            $corpoz_section_choice_option = array(
                'show' => esc_html__('Show', 'corpoz'),
                'hide' => esc_html__('Hide', 'corpoz')
            );
            return apply_filters('corpoz_section_choice_option', $corpoz_section_choice_option);
        }
    endif;


    if (!function_exists('corpoz_column_layout_option')) :
        function corpoz_column_layout_option()
        {
            $corpoz_column_layout_option = array(
                '6' => esc_html__('2 Column Layout', 'corpoz'),
                '4' => esc_html__('3 Column Layout', 'corpoz'),
                '3' => esc_html__('4 Column Layout', 'corpoz'),
            );
            return apply_filters('corpoz_column_layout_option', $corpoz_column_layout_option);
        }
    endif;

	/**
	 * Important Link
	*/
	 class corpoz_theme_info_text extends WP_Customize_Control{
        public function render_content(){  ?>
            <span class="customize-control-title">
                <?php echo esc_html( $this->label ); ?>
            </span>
            <?php if($this->description){ ?>
                <span class="description customize-control-description">
                <?php echo wp_kses_post($this->description); ?>
                </span>
            <?php }
        }
    }
	
	 
	
	$wp_customize->add_section( 'corpoz_implink_section', array(
	  'title'       => esc_html__( 'Important Links', 'corpoz' ),
	  'priority'      => 200
	) );

	    $wp_customize->add_setting( 'corpoz_imp_links', array(
	      'sanitize_callback' => 'corpoz_text_sanitize'
	    ));

	    $wp_customize->add_control( new corpoz_theme_info_text( $wp_customize,'corpoz_imp_links', array(
	        'settings'    => 'corpoz_imp_links',
	        'section'   => 'corpoz_implink_section',
	        'description' => '<a class="implink" href="http://themeslook.com/docs/corpo-free-doc/documentation.htm" target="_blank">'.esc_html__('Documentation', 'corpoz').'</a><a class="implink" href="http://themeslook.com/themes/pro-details/" target="_blank">'.esc_html__('Live Demo', 'corpoz').'</a><a class="implink" href="https://wordpress.org/support/theme/corpoz" target="_blank">'.esc_html__('Support Forum', 'corpoz').'</a>',
	      )
	    ));

	    $wp_customize->add_setting( 'corpoz_rate_us', array(
	      'sanitize_callback' => 'corpoz_text_sanitize'
	    ));

	    $wp_customize->add_control( new corpoz_theme_info_text( $wp_customize, 'corpoz_rate_us', array(
	          'settings'    => 'corpoz_rate_us',
	          'section'   => 'corpoz_implink_section',
              /* translators: 1.text 2.theme */
	          'description' => sprintf(__( 'Please do rate our theme if you liked it %1$s', 'corpoz'), '<a class="implink" href="https://wordpress.org/support/theme/corpoz/reviews/?filter=5" target="_blank">'.esc_html__('Rate/Review','corpoz').'</a>' ),
	        )
	    ));

	
    /**
     * Sanitizing the select callback example
     *
    */
    if ( !function_exists('corpoz_sanitize_select') ) :
        function corpoz_sanitize_select( $input, $setting ) {

            // Ensure input is a slug.
            $input = sanitize_text_field( $input );

            // Get list of choices from the control associated with the setting.
            $choices = $setting->manager->get_control( $setting->id )->choices;

                // If the input is a valid key, return it; otherwise, return the default.
            return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
        }
    endif;


    if ( !function_exists('corpoz_column_layout_sanitize_select') ) :
        function corpoz_column_layout_sanitize_select( $input, $setting ) {

            // Ensure input is a slug.
            $input = sanitize_text_field( $input );

            // Get list of choices from the control associated with the setting.
            $choices = $setting->manager->get_control( $setting->id )->choices;

            // If the input is a valid key, return it; otherwise, return the default.
            return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
        }
    endif;
    

    function corpoz_sanitize_dropdown_pages( $page_id, $setting ) {
        // Ensure $input is an absolute integer.
        $page_id = absint( $page_id );
    
        // If $page_id is an ID of a published page, return it; otherwise, return the default.
        return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
    }


	
    /** Front Page Section Settings starts **/	

    $wp_customize->add_panel('corpoz_frontpage', 
        array(
            'title'       => esc_html__('Corpoz Options', 'corpoz'),        
		    'description' => '',                                        
		     'priority'   => 3,
        )
    );
	

 /** Slider Section Settings Start **/

    // Panel - Slider Section 1
    $wp_customize->add_section('corpoz_sliderinfo', 
        array(
            'title'       => esc_html__('Home Slider Section', 'corpoz'),
            'description' => '',
            'panel'       => 'corpoz_frontpage',
             'priority'   => 130
        )
    );

    // hide show
    
    $wp_customize->add_setting('corpoz_slider_section_hideshow',
        array(
            'default'           => 'hide',
            'sanitize_callback' => 'corpoz_sanitize_select',
        )
    );

    $corpoz_slider_section_hide_show_option = corpoz_section_choice_option();

    $wp_customize->add_control('corpoz_slider_section_hideshow',
        array(
            'type'        => 'radio',
            'label'       => esc_html__('Slider Option', 'corpoz'),
            'description' => esc_html__('Show/hide option for Slider Section.', 'corpoz'),
            'section'     => 'corpoz_sliderinfo',
            'choices'     => $corpoz_slider_section_hide_show_option,
            'priority'    => 1
        )
    );
  
    $slider_no = 3;
        for( $i = 1; $i <= $slider_no; $i++ ) {
            $corpoz_slider_page   = 'corpoz_slider_page_' .$i;
            $corpoz_slider_btntxt = 'corpoz_slider_btntxt_' . $i;
            $corpoz_slider_btnurl = 'corpoz_slider_btnurl_' .$i;
            $corpoz_slider_btntxt2 = 'corpoz_slider_btntxt2_' . $i;
            $corpoz_slider_btnurl2 = 'corpoz_slider_btnurl2_' .$i;


    $wp_customize->add_setting( $corpoz_slider_page,
        array(
            'default'           => 1,
            'sanitize_callback' => 'corpoz_sanitize_dropdown_pages',
        )
    );

    $wp_customize->add_control( $corpoz_slider_page,
        array(
            'label'     => esc_html__( 'Slider Page ', 'corpoz' ) .$i,
            'section'   => 'corpoz_sliderinfo',
            'type'      => 'dropdown-pages',
            'priority'  => 100,
        )
    );


    $wp_customize->add_setting( $corpoz_slider_btntxt,
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control( $corpoz_slider_btntxt,
        array(
            'label'        => esc_html__( 'Button - Text','corpoz' ),
            'section'      => 'corpoz_sliderinfo',
            'type'         => 'text',
            'priority'     => 100,
        )
    );
        
    $wp_customize->add_setting( $corpoz_slider_btnurl,
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control( $corpoz_slider_btnurl,
        array(
            'label'       => esc_html__( 'Button - URL', 'corpoz' ),
            'section'     => 'corpoz_sliderinfo',
            'type'        => 'text',
            'priority'    => 100,
        )
    );


$wp_customize->add_setting( $corpoz_slider_btntxt2,
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control( $corpoz_slider_btntxt2,
        array(
            'label'        => esc_html__( 'Button - Text2','corpoz' ),
            'section'      => 'corpoz_sliderinfo',
            'type'         => 'text',
            'priority'     => 100,
        )
    );
        
    $wp_customize->add_setting( $corpoz_slider_btnurl2,
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control( $corpoz_slider_btnurl2,
        array(
            'label'       => esc_html__( 'Button - URL2', 'corpoz' ),
            'section'     => 'corpoz_sliderinfo',
            'type'        => 'text',
            'priority'    => 100,
        )
    );

                
    }	
    /** About Section Settings  **/

$wp_customize->add_section('corpoz_about_info', array(
      'title'   => esc_html__('Home About/Counter section', 'corpoz'),
      'description' => '',
      'panel' => 'corpoz_frontpage',
      'priority'    => 130
    ));
  
  $wp_customize->add_setting(
    'corpoz_aboutus_section_hideshow',
    array(
        'default' => 'hide',
        'sanitize_callback' => 'corpoz_sanitize_select',
    )
    );
    $corpoz_a_section_hide_show_option =corpoz_section_choice_option();
    $wp_customize->add_control(
    'corpoz_aboutus_section_hideshow',
    array( 
        'type' => 'radio',
        'label' => esc_html__('Show/hide option for About Us Section.', 'corpoz'),
        'description' => '',
        'section' => 'corpoz_about_info',
        'choices' => $corpoz_a_section_hide_show_option,
        'priority' => 1
    )
    );
  
  $about_no = 1;
  for( $i = 1; $i <= $about_no; $i++ ) {
  $corpoz_about_page = 'corpoz_about_page_' . $i; 
  $corpoz_about_btntxt = 'corpoz_about_btntxt_' . $i;
  $corpoz_about_btnurl = 'corpoz_about_btnurl_' .$i;

    $wp_customize->add_setting( $corpoz_about_page,
      array(
        'default'           => 1,
        'sanitize_callback' => 'corpoz_sanitize_dropdown_pages',
      )
    );

$wp_customize->add_setting('corpoz_about_title', 
        array(
            'default'           => '',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );


    $wp_customize->add_control('corpoz_about_title',
        array(
           'label'    => esc_html__('Title', 'corpoz'),
           'section'  => 'corpoz_about_info',
           'priority' => 1
        )
    );


    $wp_customize->add_control( $corpoz_about_page,
      array(
        'label'         => esc_html__( 'About Page ', 'corpoz' ).$i,
        'section'       => 'corpoz_about_info',
        'type'          => 'dropdown-pages',
        'priority'      => 1,
      )
    );

$wp_customize->add_setting( $corpoz_about_btntxt,
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control( $corpoz_about_btntxt,
        array(
            'label'        => esc_html__( 'Button - Text','corpoz' ),
            'section'      => 'corpoz_about_info',
            'type'         => 'text',
            'priority'     => 1,
        )
    );
	$wp_customize->add_setting( $corpoz_about_btnurl,
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control( $corpoz_about_btnurl,
        array(
            'label'        => esc_html__( 'Button URL','corpoz' ),
            'section'      => 'corpoz_about_info',
            'type'         => 'text',
            'priority'     => 1,
        )
    );
 
  }
    
$wp_customize->add_section('corpoz_testis',              
        array(
            'title'       => esc_html__('Home Testimonial Section', 'corpoz'),          
            'description' => '',             
            'panel'       => 'corpoz_frontpage',      
            'priority'    => 160,
        )
    );
    
    $wp_customize->add_setting('corpoz_testis_section_hideshow',
        array(
            'default'           => 'hide',
            'sanitize_callback' => 'corpoz_sanitize_select',
        )
    );

    $corpoz_testis_section_hide_show_option = corpoz_section_choice_option();

    $wp_customize->add_control(
        'corpoz_testis_section_hideshow',
        array(
            'type'        => 'radio',
            'label'       => esc_html__('Testimonial Option', 'corpoz'),
            'description' => esc_html__('Show/hide option Section.', 'corpoz'),
            'section'     => 'corpoz_testis',
            'choices'     => $corpoz_testis_section_hide_show_option,
            'priority'    => 1
        )
    );


    // testis title
    $wp_customize->add_setting('corpoz_testis_title', 
        array(
            'default'           => '',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );


    $wp_customize->add_control('corpoz_testis_title',
        array(
           'label'    => esc_html__('Testimonial Title', 'corpoz'),
           'section'  => 'corpoz_testis',
           'priority' => 1
        )
    );


    // testis 
   
    $testi_no = 6;
        for( $i = 1; $i <= $testi_no; $i++ ) {
            $corpoz_testipage = 'corpoz_testi_page_' . $i;
            $corpoz_testi_position = 'corpoz_testi_position_' . $i;
       
   
        
    $wp_customize->add_setting( $corpoz_testipage,
        array(
            'default'           => 1,
            'sanitize_callback' => 'corpoz_sanitize_dropdown_pages',
        )
    );

    $wp_customize->add_control( $corpoz_testipage,
        array(
            'label'        => esc_html__( 'Testimonial Page ', 'corpoz' ) .$i,
            'section'      => 'corpoz_testis',
            'type'         => 'dropdown-pages',
            'priority'     => 100,
        )
    );

 $wp_customize->add_setting( $corpoz_testi_position,
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control( $corpoz_testi_position,
        array(
            'label'        => esc_html__( 'Position', 'corpoz' ) .$i,
            'section'      => 'corpoz_testis',
            'type'         => 'text',
            'priority'     => 100,
        )
    );


    }   

    /** Blog Section Settings Start **/

    $wp_customize->add_section('corpoz_blog_info', 
        array(
            'title'       => esc_html__('Home Blog Section', 'corpoz'),
            'description' => '',
            'panel'       => 'corpoz_frontpage',
            'priority'    => 160
        )
     );
    
    $wp_customize->add_setting('corpoz_blog_section_hideshow',
        array(
            'default'           => 'show',
            'sanitize_callback' => 'corpoz_sanitize_select',
        )
    );

    $corpoz_blog_section_hide_show_option = corpoz_section_choice_option();

    $wp_customize->add_control('corpoz_blog_section_hideshow',
        array(
            'type'        => 'radio',
            'label'       => esc_html__('Blog Option', 'corpoz'),
            'description' => esc_html__('Show/hide option for Blog Section.', 'corpoz'),
            'section'     => 'corpoz_blog_info',
            'choices'     => $corpoz_blog_section_hide_show_option,
            'priority'    => 1
        )
    );
    
    $wp_customize->add_setting('corpoz_blog_title', 
         array(
            'default'            => '',
            'type'               => 'theme_mod',
            'sanitize_callback'  => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control('corpoz_blog_title', 
        array(
            'label'    => esc_html__('Blog Title', 'corpoz'),
            'section'  => 'corpoz_blog_info',
            'priority' => 1
        )
    );


     $wp_customize->add_setting('corpoz_blog_subtitle', 
         array(
            'default'            => '',
            'type'               => 'theme_mod',
            'sanitize_callback'  => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control('corpoz_blog_subtitle', 
        array(
            'label'    => esc_html__('Blog Sub Title', 'corpoz'),
            'section'  => 'corpoz_blog_info',
            'priority' => 2
        )
    );
    
   
    /** Footer Section Settings Start **/

	 $wp_customize->add_section('footer',
        array(
            'title'       => esc_html__('Footer Section', 'corpoz'),
            'description' => '',
            'panel' => 'corpoz_frontpage',
            'priority'    => 180
        )
    );
    $wp_customize->add_setting('corpoz_footer_section_hideshow',
        array(
            'default'           => 'show',
            'sanitize_callback' => 'corpoz_sanitize_select',
        )
    );
    $corpoz_footer_section_hide_show_option = corpoz_section_choice_option();
    $wp_customize->add_control('corpoz_footer_section_hideshow',
        array(
            'type'        => 'radio',
            'label'       => esc_html__('Footer Option', 'corpoz'),
            'description' => esc_html__('Show/hide option for Footer Section.', 'corpoz'),
            'section'     => 'footer',
            'choices'     => $corpoz_footer_section_hide_show_option,
            'priority'    => 1
        ) 
    );
    $wp_customize->add_setting('corpoz_footer_text',
        array(
            'default'             => '',
            'type'                => 'theme_mod',
            'sanitize_callback'   => 'wp_kses_post'
        )
    );
    $wp_customize->add_control('corpoz_footer_text',
        array(
            'label'    => esc_html__('Copyright', 'corpoz'),
            'section'  => 'footer',
            'type'     => 'textarea',
            'priority' => 2
        )
    ); 
    
}
add_action( 'customize_register', 'corpoz_customize_register' );

