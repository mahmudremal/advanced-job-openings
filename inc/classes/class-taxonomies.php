<?php
/**
 * Register Custom Taxonomies
 *
 * @package Aquila
 */

namespace FUTUREWORDPRESS_PROJECT\Inc;

use FUTUREWORDPRESS_PROJECT\Inc\Traits\Singleton;

class Taxonomies {
	use Singleton;

	protected function __construct() {

		// load class.
		$this->setup_hooks();
	}

	protected function setup_hooks() {

		/**
		 * Actions.
		 */
		add_action( 'init', [ $this, 'job_opening_categories' ] );
		add_action( 'init', [ $this, 'job_opening_types' ] );
		add_action( 'init', [ $this, 'job_opening_locations' ] );

	}

	// Register Taxonomy JOB Categories
	public function job_opening_categories() {

    $labels = [
			'name'              => _x( 'Job categories', 'taxonomy general name', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'singular_name'     => _x( 'Job category', 'taxonomy singular name', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'search_items'      => __( 'Search Job Category', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'all_items'         => __( 'All categories', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'parent_item'       => __( 'Parent Job Category', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'parent_item_colon' => __( 'Parent Job Category:', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'edit_item'         => __( 'Edit Job Category', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'update_item'       => __( 'Update Job Category', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'add_new_item'      => __( 'Add New Job Category', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'new_item_name'     => __( 'New Job Category Name', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'menu_name'         => __( 'Job Category', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
		];
		$args   = [
			'labels'             => $labels,
			'description'        => __( 'Job Category', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'hierarchical'       => true,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => true,
			'show_tagcloud'      => true,
			'show_in_quick_edit' => true,
			'show_admin_column'  => true,
			'show_in_rest'       => true,
		];

		register_taxonomy( 'job_categories', [ FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS ], $args );

	}

	// Register Taxonomy JOB Types
	public function job_opening_types() {

		$labels = [
			'name'              => _x( 'Job types', 'taxonomy general name', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'singular_name'     => _x( 'Job type', 'taxonomy singular name', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'search_items'      => __( 'Search Job Types', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'all_items'         => __( 'All Job Types', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'parent_item'       => __( 'Parent Job Type', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'parent_item_colon' => __( 'Parent Job Type:', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'edit_item'         => __( 'Edit Job Type', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'update_item'       => __( 'Update Job Type', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'add_new_item'      => __( 'Add New Job Type', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'new_item_name'     => __( 'New Job Type Name', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'menu_name'         => __( 'Job Type', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
		];
		$args   = [
			'labels'             => $labels,
			'description'        => __( 'Job types', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'hierarchical'       => true,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => true,
			'show_tagcloud'      => true,
			'show_in_quick_edit' => true,
			'show_admin_column'  => true,
			'show_in_rest'       => true,
		];
		register_taxonomy( 'job_types', [ FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS ], $args );
	}

	// Register Taxonomy Job Location Area
	public function job_opening_locations() {

		$labels = [
			'name'              => _x( 'Job Locations', 'taxonomy general name', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'singular_name'     => _x( 'Job Location', 'taxonomy singular name', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'search_items'      => __( 'Search Job Locations', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'all_items'         => __( 'All Job Locations', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'parent_item'       => __( 'Parent Job Location', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'parent_item_colon' => __( 'Parent Job Location:', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'edit_item'         => __( 'Edit Job Location', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'update_item'       => __( 'Update Job Location', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'add_new_item'      => __( 'Add New Job Location', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'new_item_name'     => __( 'New Job Location Name', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'menu_name'         => __( 'Job Location', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
		];
		$args   = [
			'labels'             => $labels,
			'description'        => __( 'Job Locations', FUTUREWORDPRESS_PROJECT_TEXT_DOMAIN ),
			'hierarchical'       => true,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => true,
			'show_tagcloud'      => true,
			'show_in_quick_edit' => true,
			'show_admin_column'  => true,
			'show_in_rest'       => true,
		];
		register_taxonomy( 'job_locations', [ FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS ], $args );
	}

}
