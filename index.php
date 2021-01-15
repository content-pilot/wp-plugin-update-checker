<?php
/**
 * WordPress update checker for non wordpress.org plugins.
 *
 * @since      1.0.0
 *
 * @package    Content_Pilot\Wp_Plugin_Update_Checker
 */

namespace Content_Pilot\Wp_Plugin_Update_Checker;

/**
 * Checks for updates from cloud repository if credentials are present in database.
 *
 * @since      1.0.0
 */
class Bootstrap {

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
				sprintf(
					'%s/wp-content/plugins/%s/%s.php',
					ABSPATH,
					esc_attr( $this->slug ),
					esc_attr( $this->slug )
				),
				esc_attr( $this->slug )
			);

			// Authenticate with database option value.
			$update_checker->setAuthentication( get_option( 'content_pilot_access_token', '' ) );

			// Use release assets to get built version.
			$update_checker->getVcsApi()->enableReleaseAssets();
		}
	}

}
