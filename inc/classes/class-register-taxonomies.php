<?php
/**
 * Register Custom Taxonomies
 *
 * @package Aquila
 */

namespace FUTUREWORDPRESS_PROJECT\Inc;

use FUTUREWORDPRESS_PROJECT\Inc\Traits\Singleton;

class Register_Taxonomies {
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

	}

	// Register Taxonomy Genre
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

		register_taxonomy( 'job_categories', [ 'job_openings' ], $args );

	}

	// Register Taxonomy Year
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
		register_taxonomy( 'job_types', [ 'job_openings' ], $args );
	}

}
