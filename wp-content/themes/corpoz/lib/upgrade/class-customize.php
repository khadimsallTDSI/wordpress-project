<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Corpoz_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		require_once( trailingslashit( get_template_directory() ) . '/lib/upgrade/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'corpoz_Customize_Section_Pro' );

		// doc sections.
		$manager->add_section(
			new corpoz_Customize_Section_Pro(
				$manager,
				'corpoz',
				array(
					'title'    => esc_html__( 'Theme Documentation', 'corpoz' ),
					'pro_text' => esc_html__( 'Click Here', 'corpoz' ),
					'pro_url'  => 'http://themeslook.com/docs/corpo-free-doc/documentation.htm',
					'priority'  => 1
				)
			)
		);
	 
		// upgrade sections.
		$manager->add_section(
			new corpoz_Customize_Section_Pro(
				$manager,
				'upgrade-pro',
				array(
					'title'    => esc_html__( 'Upgrade To Pro', 'corpoz'),
					'pro_text' => esc_html__( 'View Pro', 'corpoz'),
					'pro_url'  => 'http://themeslook.com/themes/pro-details/',
					'priority'  => 2
				)
			)
		);
		
		// upgrade sections.
		$manager->add_section(
			new corpoz_Customize_Section_Pro(
				$manager,
				'upgrade-pross',
				array(
					'title'    => esc_html__( 'More Detail', 'corpoz'),
					'pro_text' => esc_html__( 'View', 'corpoz'),
					'pro_url'  => 'http://themeslook.com/themes/pro-details/',
					'priority'  => 500
				)
			)
		);
	}


	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'corpoz-customize-controls', trailingslashit( get_template_directory_uri() ) . '/lib/upgrade/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'corpoz-customize-controls', trailingslashit( get_template_directory_uri() ) . '/lib/upgrade/customize-controls.css' );
	}
}

// Doing this customizer thang!
corpoz_Customize::get_instance();