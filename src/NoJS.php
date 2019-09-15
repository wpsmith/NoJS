<?php
/**
 * NoJS Class
 *
 * Adds `no-js` class to body tag and replaces it with `js` if JS is enabled.
 *
 * You may copy, distribute and modify the software as long as you track changes/dates in source files.
 * Any modifications to or software including (via compiler) GPL-licensed code must also be made
 * available under the GPL along with build & install instructions.
 *
 * @package    WPS\WP\Scripts
 * @author     Travis Smith <t@wpsmith.net>
 * @copyright  2015-2019 Travis Smith
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License v2
 * @link       https://github.com/wpsmith/WPS
 * @version    1.0.0
 * @since      0.1.0
 */

namespace WPS\WP\Scripts;

use WPS\Core\Singleton;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( __NAMESPACE__ . '\NoJS' ) ) {
	/**
	 * NoJS Class
	 *
	 * Determines whether JS is enabled.
	 *
	 * @package WPS\WP\Scripts
	 * @author  Travis Smith <t@wpsmith.net>
	 */
	class NoJS extends Singleton {

		protected function __construct() {

			parent::__construct();

			add_filter( 'body_class', function ( $classes ) {
				$classes[] = 'no-js';

				return $classes;
			} );

			$hook = 'wp_footer';
			if ( function_exists( 'wp_body_open' ) ) {
				$hook = 'wp_body_open';
			}

			add_action( $hook, function () {
				?>
				<script>
                    //<![CDATA[
                    (function () {
                        var c = document.body.classList;
                        c.remove('no-js');
                        c.add('js');
                    })();
                    //]]>
				</script>
				<?php
			}, -1 );

		}

	}
}
