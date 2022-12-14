<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * @package   Advanced Job Opening - Futurewordpress.com
 * @author    Remal <info@futurewordpress.com>
 * @link      https://futurewordpress.com
 * @copyright 2022-2025 Future Wordpress
 *
 * Plugin Name: Advanced Job Opening
 * Plugin URI: https://github.com/mahmudremal/advanced-job-openings/
 * Author: Future Wordpress
 * Author URI: https://futurewordpress.com/
 * Version: 1.0.7
 * Description: A simple and lightweight plugin for wordpress Job Listing and Job opening Platform.
 * Text Domain: fwp-ajo
 * Domain Path: /languages
 */

defined( 'FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN' ) || define( 'FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN', 'fwp-ajo' );

defined( 'FUTUREWORDPRESS_PROJECT__FILE__' ) || define( 'FUTUREWORDPRESS_PROJECT__FILE__', __FILE__ );
defined( 'FUTUREWORDPRESS_PROJECT_DIR_PATH' ) || define( 'FUTUREWORDPRESS_PROJECT_DIR_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
defined( 'FUTUREWORDPRESS_PROJECT_DIR_URI' ) || define( 'FUTUREWORDPRESS_PROJECT_DIR_URI', untrailingslashit( plugin_dir_url( __FILE__ ) ) );
defined( 'FUTUREWORDPRESS_PROJECT_BUILD_URI' ) || define( 'FUTUREWORDPRESS_PROJECT_BUILD_URI', untrailingslashit( plugin_dir_url( __FILE__ )
 ) . '/assets/src' );
defined( 'FUTUREWORDPRESS_PROJECT_BUILD_PATH' ) || define( 'FUTUREWORDPRESS_PROJECT_BUILD_PATH', untrailingslashit( plugin_dir_path( __FILE__ )
 ) . '/assets/src' );
defined( 'FUTUREWORDPRESS_PROJECT_BUILD_JS_URI' ) || define( 'FUTUREWORDPRESS_PROJECT_BUILD_JS_URI', untrailingslashit( plugin_dir_url( __FILE__ )
 ) . '/assets/src/js' );
defined( 'FUTUREWORDPRESS_PROJECT_BUILD_JS_DIR_PATH' ) || define( 'FUTUREWORDPRESS_PROJECT_BUILD_JS_DIR_PATH', untrailingslashit( plugin_dir_path( __FILE__ )
 ) . '/assets/src/js' );
defined( 'FUTUREWORDPRESS_PROJECT_BUILD_IMG_URI' ) || define( 'FUTUREWORDPRESS_PROJECT_BUILD_IMG_URI', untrailingslashit( plugin_dir_url( __FILE__ )
 ) . '/assets/src/img' );
defined( 'FUTUREWORDPRESS_PROJECT_BUILD_CSS_URI' ) || define( 'FUTUREWORDPRESS_PROJECT_BUILD_CSS_URI', untrailingslashit( plugin_dir_url( __FILE__ )
 ) . '/assets/src/css' );
defined( 'FUTUREWORDPRESS_PROJECT_BUILD_CSS_DIR_PATH' ) || define( 'FUTUREWORDPRESS_PROJECT_BUILD_CSS_DIR_PATH', untrailingslashit( plugin_dir_path( __FILE__ )
 ) . '/assets/src/css' );
defined( 'FUTUREWORDPRESS_PROJECT_BUILD_LIB_URI' ) || define( 'FUTUREWORDPRESS_PROJECT_BUILD_LIB_URI', untrailingslashit( plugin_dir_url( __FILE__ ) ) . '/assets/src/library' );
defined( 'FUTUREWORDPRESS_PROJECT_BUILD_LIB_PATH' ) || define( 'FUTUREWORDPRESS_PROJECT_BUILD_LIB_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) . '/assets/src/library' );
defined( 'FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS' ) || define( 'FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS', 'job_openings' );
defined( 'FUTUREWORDPRESS_PROJECT_ARCHIVE_POST_PER_PAGE' ) || define( 'FUTUREWORDPRESS_PROJECT_ARCHIVE_POST_PER_PAGE', 9 );
defined( 'FUTUREWORDPRESS_PROJECT_SEARCH_RESULTS_POST_PER_PAGE' ) || define( 'FUTUREWORDPRESS_PROJECT_SEARCH_RESULTS_POST_PER_PAGE', 9 );
defined( 'FUTUREWORDPRESS_PROJECT_OPTIONS' ) || define( 'FUTUREWORDPRESS_PROJECT_OPTIONS', get_option( 'advanced-job-openings' ) );
defined( 'FUTUREWORDPRESS_PROJECT_CV_UPLOAD_DIR_PATH' ) || define( 'FUTUREWORDPRESS_PROJECT_CV_UPLOAD_DIR_PATH', ABSPATH . '/wp-content/advanced-job-openings-upload' );
defined( 'FUTUREWORDPRESS_PROJECT_CV_UPLOAD_DIR_URI' ) || define( 'FUTUREWORDPRESS_PROJECT_CV_UPLOAD_DIR_URI', str_replace( [ ABSPATH ], [ site_url() ], FUTUREWORDPRESS_PROJECT_CV_UPLOAD_DIR_PATH ) );

require_once FUTUREWORDPRESS_PROJECT_DIR_PATH . '/inc/helpers/autoloader.php';
require_once FUTUREWORDPRESS_PROJECT_DIR_PATH . '/inc/helpers/template-tags.php';

function futurewordpress_project_get_theme_instance() {
	\FUTUREWORDPRESS_PROJECT\Inc\PROJECT::get_instance();
}
futurewordpress_project_get_theme_instance();
