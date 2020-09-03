<?php
/**
 * WordPress update chcker for non wordpress.org plugins.
 *
 * @since      1.0.0
 *
 * @package    Content_Pilot\Wp_Plugin_Update_Checker
 */

namespace Content_Pilot\Wp_Plugin_Update_Checker;

/**
 *
 *
 * @since      1.0.0
 */
class Init {

	/**
	 * Repository slug
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string
	 */
	private $slug;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param    string $slug    The slug of this plugin.
	 */
	public function __construct( string $slug ) {
		$this->slug = $slug;
	}

	/**
	 * Use library to check for updates at cloud repo.
	 *
	 * @since    1.0.0
	 */
	public function update_from_cloud() {
		if ( class_exists( 'Puc_v4_Factory' ) ) {
			$update_checker = \Puc_v4_Factory::buildUpdateChecker(
				sprintf(
					'https://github.com/content-pilot/%s',
					esc_attr( $this->slug )
				),
				plugin_dir_path( dirname( __FILE__ ) ) . esc_attr( $this->slug ) . '.php',
				esc_attr( $this->slug )
			);

			$global_settings = get_option( 'content_pilot_global_settings' );
			if ( ! empty( $global_settings ) ) {
				if ( isset( $global_settings['access_token'] ) ) {
					$update_checker->setAuthentication( $global_settings['access_token'] );
				}
			}
		}
	}


}
