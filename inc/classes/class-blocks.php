<?php
/**
 * Blocks
 *
 * @package Aquila
 */

namespace FUTUREWORDPRESS_PROJECT\Inc;

use FUTUREWORDPRESS_PROJECT\Inc\Traits\Singleton;

class Blocks {
	use Singleton;

	protected function __construct() {
    $this->setup_hooks();
	}
	protected function setup_hooks() {
		add_action( 'init', [ $this, 'init' ], 10, 0 );
	}
  public function init() {
    // add_rewrite_endpoint( 'apply', EP_ROOT | EP_PAGES ); // add_rewrite_endpoint( 'cources', EP_PAGES );
    /**
     * Jobs appling URL.
     * 1: Job ID
     * 2: ...
     */
    add_rewrite_rule( 'apply/([^/]*)/([^/]*)/?', 'index.php?apply=$matches[1]&post_id=$matches[2]', 'top' );
    add_rewrite_rule( 'dashboard/(candidate|company)/([^/]*)/?', 'index.php?dashboard=$matches[1]&dashpage=$matches[2]', 'top' );

    add_filter( 'query_vars', [ $this, 'query_vars' ], 10, 1 );
    add_filter( 'template_include', [ $this, 'template_include' ], 10, 1 );
    // add_filter( 'template_redirect', [ $this, 'template_include' ], 10, 1 );
    // add_action( 'rest_api_init', [ $this, 'restEndpoint' ], 10, 0 );

    add_shortcode( 'jobs_grid',[ $this, 'jobsGrid' ] );
  }
  public function query_vars( $query_vars  ) {
		$query_vars[] = 'apply';
		$query_vars[] = 'post_id';
		$query_vars[] = 'dashboard';
		$query_vars[] = 'dashpage';
    return $query_vars;
	}
	public function template_include( $template ) {
    $apply = get_query_var( 'apply' );$dashboard = get_query_var( 'dashboard' );
    if ( ( $apply == false || $apply == '' ) && ( $dashboard == false || $dashboard == '' ) ) {
      return $template;
    } else {
      if( $apply !== false && $apply != '' ) {
        $file = FUTUREWORDPRESS_PROJECT_DIR_PATH . '/template-parts/jobs/apply.php';
        if( file_exists( $file ) ) {
          // add_action( 'wp_head', [ $this, 'wp_head' ], 10, 0 );
          return $file;
        } else {
          return $template;
        }
      } elseif( $dashboard !== false && $dashboard != '' ) {
        $file = FUTUREWORDPRESS_PROJECT_DIR_PATH . '/template-parts/jobs/dashboard.php';
        if( file_exists( $file ) ) {
          // add_action( 'wp_head', [ $this, 'wp_head' ], 10, 0 );
          return $file;
        } else {
          return $template;
        }
      } else {
        return $template;
      }
    }
	}
	public function restEndpoint() {
    register_rest_route( 'certificate/v1', '/learner/(?P<id>\d+)', [
      // 'methods'  => 'GET',
      'methods'     => WP_REST_Server::READABLE,
      'callback'    => [ $this, 'restCertificate' ],
      'args'        => [],
      'permission_callback' => [ $this, 'restPermission' ],
    ] );
	}
  public function restPermission() {
		/**
		 * Permit if this user has access on this course.
		 */
		return true;
	}
  public function restCertificate() {
		$posts = get_posts( [
			'author' => $data['id'],
		] );
		if ( empty( $posts ) ) {
			return null;
		}
		return $posts;
		// return $posts[0]->post_title;
	}

  /**
   * Short code content.
   */
  public function jobsGrid( $args = [] ) {
    $args = wp_parse_args( $args, [] );
		// if( ! $args[ 'course' ] ) {return;}
    $file = FUTUREWORDPRESS_PROJECT_DIR_PATH . '/template-parts/jobs/list.php';
    if( file_exists( $file ) && ! is_dir( $file ) ) {
      ob_start();
      // add_action( 'wp_head', [ $this, 'wp_head' ], 10, 0 );
      include $file;
      return ob_get_clean();
    } else {
      wp_die( 'We\'re sorry to say, your tergated content can\'t be displayed at this moment. Because of our file is missing currently. Please contact to administative.', __( 'File missing', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ) );
    }
    ?>
    <?php
  }
  public function filemtime( $file ) {
    return ( file_exists( $file ) && ! is_dir( $file ) ) ? filemtime( $file ) : rand( 0, 999999 );
  }
}
