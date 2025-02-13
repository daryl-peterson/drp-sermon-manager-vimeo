<?php

namespace DRPSMVimeo\Tests;

use DRPSMVimeo\AdminPage;
use DRPSMVimeo\App;

/**
 * Class description.
 *
 * @category
 *
 * @author      Daryl Peterson <@gmail.com>
 * @copyright   Copyright (c) 2024, Daryl Peterson
 * @license     https://www.gnu.org/licenses/gpl-3.0.txt
 *
 * @since       1.0.0
 */
class AdminPageTest extends BaseTest {

	public function setUp(): void {
		parent::setUp();
		if ( ! defined( 'WP_ADMIN' ) ) {
			define( 'WP_ADMIN', true );
		}

		if ( ! function_exists( '\add_submenu_page' ) ) {
			$file = ABSPATH . 'wp-admin/includes/plugin.php';
			require_once $file;
		}

		if ( ! function_exists( '\add_settings_section' ) ) {
			$file = ABSPATH . 'wp-admin/includes/template.php';
			require_once $file;
		}
	}

	public function testConstructor() {
		$obj = new AdminPage();
		$this->assertInstanceOf( AdminPage::class, $obj );
	}

	public function tester() {
		$obj = App::getAdminPage();
		$obj->init();
		do_action( 'admin_init' );
		do_action( 'admin_menu', '' );

		ob_start();
		$obj->showAdminPage();
		$page = ob_end_clean();
		$this->assertNotNull( $page );

		$settings = get_option( $obj->settingsName );
		$result   = $obj->sanitize( $settings );
		$this->assertIsArray( $result );
	}
}
