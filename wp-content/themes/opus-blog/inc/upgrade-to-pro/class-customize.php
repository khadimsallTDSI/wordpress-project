<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Opus_Blog_Customize {

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
		require_once get_template_directory() . '/inc/upgrade-to-pro/section-pro.php';

		// Register custom section types.
		$manager->register_section_type( 'Opus_Blog_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Opus_Blog_Customize_Section_Pro(
				$manager,
				'opus-blog',
				array(
					'title'    => esc_html__( 'Premium Verison', 'opus-blog' ),
					'pro_text' => esc_html__( 'Get More Features',  'opus-blog' ),
					'pro_url'  => 'https://www.templatesell.com/item/opus-blog-plus-minimal-wordpress-blog-theme/',
					'priority' => 0
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
		require_once get_template_directory() . '/inc/upgrade-to-pro/section-pro.php';


		wp_enqueue_script( 'opus-blog-customize-controls', trailingslashit( get_template_directory_uri() ) . '/inc/upgrade-to-pro/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'opus-blog-customize-controls', trailingslashit( get_template_directory_uri() ) . '/inc/upgrade-to-pro/customize-controls.css' );
	}
}
// Doing this customizer thang!
Opus_Blog_Customize::get_instance();