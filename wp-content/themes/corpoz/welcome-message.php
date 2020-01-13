<?php
/**
 * Welcome Screen Class
 */
class corpoz_screen {

	/**
	 * Constructor for the welcome screen
	 */
	public function __construct() {

		/* activation notice */
		add_action( 'load-themes.php', array( $this, 'corpoz_activation_admin_notice' ) );

	}
	
	public function corpoz_activation_admin_notice() {
		global $pagenow;

		if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'corpoz_admin_notice' ), 99 );
		}
	}

	/**
	 * Display an admin notice linking to the welcome screen
	 * @sfunctionse 1.8.2.4
	 */
	public function corpoz_admin_notice() {
		?>			
		<div class="updated notice is-dismissible construction-zone-notice">
			<h1><?php
			$theme_info = wp_get_theme();
			printf( esc_html__('Welcome to the Wordpress User!', 'corpoz'), esc_html( $theme_info->Name ), esc_html( $theme_info->Version ) ); ?>
			</h1>
			<p><?php echo sprintf( esc_html__("Heartily Welcome! Thanks for choosing our theme. To take full advantage of the features this theme has to offer visit our %1\$s welcome page %2\$s.", "corpoz"), '<a href="' . esc_url( admin_url( 'themes.php?page=corpoz_upgrade' ) ) . '">', '</a>' ); ?></p>
			<p><a href="<?php echo esc_url( admin_url( 'themes.php?page=corpoz_upgrade' ) ); ?>" class="button button-blue-secondary button_info" style="text-decoration: none;"><?php echo esc_html__('Get started with corpoz','corpoz'); ?></a></p>
		</div>
		<?php
	}
	
}

$GLOBALS['corpoz_screen'] = new corpoz_screen();