<?php
/**
 * LoadmorePosts
 *
 * @package Aquila
 */

namespace FUTUREWORDPRESS_PROJECT\Inc;

use FUTUREWORDPRESS_PROJECT\Inc\Traits\Singleton;
use \WP_Query;

class Shortcodes {

	use Singleton;

	protected function __construct() {
		// load class.
		$this->setup_hooks();
	}

	protected function setup_hooks() {
    ( ! is_FwpActive( 'shortcodes-grid' ) )|| add_shortcode( 'jobs_grid',[ $this, 'jobsGrid' ] );
		! is_FwpActive( 'shortcodes-featured' ) || add_shortcode( 'ajo-featured', [ $this, 'featuredJob' ] );
		! is_FwpActive( 'shortcodes-latest' ) || add_shortcode( 'ajo-latest', [ $this, 'latestJob' ] );
		! is_FwpActive( 'shortcodes-list' ) || add_shortcode( 'ajo-list', [ $this, 'listJob' ] );
	}
  /**
   * Short code content.
   */
  public function jobsGrid( $args = [] ) {
    $args = wp_parse_args( $args, [] );
		// if( ! $args[ 'course' ] ) {return;}
		$args = wp_parse_args( $args, [
			'type'					=> 'grid',
			'limit' 				=> 12,
			'order'					=> 'DESC',
			'hideInactive'	=> true,
			'include'				=> false,
			'exclude'				=> false
		] );
		$postArgs = [
      'numberposts'   => $args[ 'limit' ],
      'post_type'     => FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS,
      'post_status'   => 'publish',
			'order'					=> $args[ 'order' ],
      'meta_key'      => 'fwp_jobs-featuredlisting',
      'meta_value'    => 'on'
    ];
		if( $args[ 'hideInactive' ] ) {
			$postArgs[ 'meta_query' ] = isset( $postArgs[ 'meta_query' ] ) ? $postArgs[ 'meta_query' ] : [];
			$postArgs[ 'meta_query' ][ 'fwp_jobs-positionfilled' ] = 0;
			// $postArgs[ 'meta_query' ][] = [ 'key'				=> 'fwp_jobs-positionfilled', 'value'			=> 'on', 'compare'		=> '!=' ];
		}
		if( $args[ 'include' ] ) {
			$args[ 'include' ] = str_replace( [ ' ' ], [ '' ], $args[ 'include' ] );
			$args[ 'include' ] = explode( ',', $args[ 'include' ] );
			$postArgs[ 'include' ] = $args[ 'include' ];
		}
		if( $args[ 'exclude' ] ) {
			$args[ 'exclude' ] = str_replace( [ ' ' ], [ '' ], $args[ 'exclude' ] );
			$args[ 'exclude' ] = explode( ',', $args[ 'exclude' ] );
			$postArgs[ 'exclude' ] = $args[ 'exclude' ];
		}
		$getPosts = get_posts( $postArgs );
		$list = '<div class="row fwp-ajo-jobs-grid">'; // print_r( $getPosts );
		foreach( $getPosts as $post ) {
			$list .= is_FwpActive( 'shortcodes-grid-error' ) ? apply_filters( 'futurewordpress/project/job/card', get_post( $post->ID ), ( $args[ 'type' ] != 'grid' ) ) : '';
		}
		$list .= '</div>';
		return $list;
  }
	public function featuredJob( $args ) {
		$args = wp_parse_args( $args, [
			'type'					=> 'list',
			'limit' 				=> 6,
			'order'					=> 'DESC',
			'hideInactive'	=> true,
		] );
		$postArgs = [
      'numberposts'   => $args[ 'limit' ],
      'post_type'     => FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS,
      'post_status'   => 'publish',
			'order'					=> $args[ 'order' ],
      'meta_key'      => 'fwp_jobs-featuredlisting',
      'meta_value'    => 'on'
    ];
		if( $args[ 'hideInactive' ] ) {
			$postArgs[ 'meta_query' ] = isset( $postArgs[ 'meta_query' ] ) ? $postArgs[ 'meta_query' ] : [];
			$postArgs[ 'meta_query' ][ 'fwp_jobs-positionfilled' ] = 0;
			// $postArgs[ 'meta_query' ][] = [ 'key'				=> 'fwp_jobs-positionfilled', 'value'			=> 'on', 'compare'		=> '!=' ];
		}
		$getPosts = get_posts( $postArgs );
		if( count( $getPosts ) >= 1 ) :
			$list = '<div class="row fwp-ajo-jobs-grid">'; // print_r( $getPosts );
			foreach( $getPosts as $post ) {
				$list .= apply_filters( 'futurewordpress/project/job/card', get_post( $post->ID ), ( $args[ 'type' ] != 'grid' ) );
			}
			$list .= '</div>';
		else:
			$list .= is_FwpActive( 'shortcodes-featured-error' ) ? apply_filters( 'futurewordpress/project/error/image', '', [ 'shortcode' => 'featured' ] ) : '';
		endif;
		return $list;
	}
	public function latestJob( $args ) {
		$args = wp_parse_args( $args, [
			'type'					=> 'list',
			'limit' 				=> 6,
			'hideInactive'	=> true,
		] );
		$postArgs = [
      'numberposts'   => $args[ 'limit' ],
      'post_type'     => FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS,
      'post_status'   => 'publish',
			'order'					=> 'DESC',
      // 'meta_key'      => 'fwp_jobs-featuredlisting',
      // 'meta_value'    => 'on'
    ];
		if( $args[ 'hideInactive' ] ) {
			$postArgs[ 'meta_query' ] = isset( $postArgs[ 'meta_query' ] ) ? $postArgs[ 'meta_query' ] : [];
			$postArgs[ 'meta_query' ][ 'fwp_jobs-positionfilled' ] = 0;
			// $postArgs[ 'meta_query' ][] = [ 'key'				=> 'fwp_jobs-positionfilled', 'value'			=> 'on', 'compare'		=> '!=' ];
		}
		$getPosts = get_posts( $postArgs );
		if( count( $getPosts ) >= 1 ) :
			$list = '<div class="row fwp-ajo-jobs-grid">'; // print_r( $getPosts );
			foreach( $getPosts as $post ) {
				$list .= apply_filters( 'futurewordpress/project/job/card', get_post( $post->ID ), ( $args[ 'type' ] != 'grid' ) );
			}
			$list .= '</div>';
		else:
			$list .= is_FwpActive( 'shortcodes-latest-error' ) ? apply_filters( 'futurewordpress/project/error/image', '', [ 'shortcode' => 'latest' ] ) : '';
		endif;
		return $list;
	}
	public function listJob( $args ) {
		$args = wp_parse_args( $args, [
			'type'					=> 'list',
			'limit' 				=> 6,
			'order'					=> 'DESC',
			'hideInactive'	=> true,
			'include'				=> false,
			'exclude'				=> false
		] );
		$postArgs = [
      'numberposts'   => $args[ 'limit' ],
      'post_type'     => FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS,
      'post_status'   => 'publish',
			'order'					=> $args[ 'order' ],
      // 'meta_key'      => 'fwp_jobs-featuredlisting',
      // 'meta_value'    => 'on'
    ];
		if( $args[ 'hideInactive' ] ) {
			$postArgs[ 'meta_query' ] = isset( $postArgs[ 'meta_query' ] ) ? $postArgs[ 'meta_query' ] : [];
			$postArgs[ 'meta_query' ][ 'fwp_jobs-positionfilled' ] = 0;
			// $postArgs[ 'meta_query' ][] = [ 'key'				=> 'fwp_jobs-positionfilled', 'value'			=> 'on', 'compare'		=> '!=' ];
		}
		if( $args[ 'include' ] ) {
			$args[ 'include' ] = str_replace( [ ' ' ], [ '' ], $args[ 'include' ] );
			$args[ 'include' ] = explode( ',', $args[ 'include' ] );
			$postArgs[ 'include' ] = $args[ 'include' ];
		}
		if( $args[ 'exclude' ] ) {
			$args[ 'exclude' ] = str_replace( [ ' ' ], [ '' ], $args[ 'exclude' ] );
			$args[ 'exclude' ] = explode( ',', $args[ 'exclude' ] );
			$postArgs[ 'exclude' ] = $args[ 'exclude' ];
		}
		$getPosts = get_posts( $postArgs );
		if( count( $getPosts ) >= 1 ) :
			$list = '<div class="row fwp-ajo-jobs-grid">'; // print_r( $getPosts );
			foreach( $getPosts as $post ) {
				$list .= apply_filters( 'futurewordpress/project/job/card', get_post( $post->ID ), ( $args[ 'type' ] != 'grid' ) );
			}
			$list .= '</div>';
		else:
			$list .= is_FwpActive( 'shortcodes-list-error' ) ? apply_filters( 'futurewordpress/project/error/image', '', [ 'shortcode' => 'list' ] ) : '';
		endif;
		return $list;
	}

}
